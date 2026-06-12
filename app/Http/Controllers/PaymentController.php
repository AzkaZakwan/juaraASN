<?php

namespace App\Http\Controllers;

use App\Models\Package;
use App\Models\Transaction;
use Illuminate\Support\Facades\Auth;
use Midtrans\Config;
use Midtrans\Snap;
use App\Models\UserPackage;
use Illuminate\Http\Request;
use Midtrans\Transaction as MidtransTransaction;

class PaymentController extends Controller
{
    public function checkout(Package $package)
    {
        if ($package->price <= 0) {
            return redirect()->route('prepare', $package->id);
        }

        $user = \App\Models\User::find(Auth::id());

        $alreadyOwned = $user->packages()
            ->where('packages.id', $package->id)
            ->exists();

        if ($alreadyOwned) {
            return redirect()->route('prepare', $package->id);
        }

        Config::$serverKey = config('midtrans.serverKey');
        Config::$isProduction = config('midtrans.isProduction');
        Config::$isSanitized = config('midtrans.isSanitized');
        Config::$is3ds = config('midtrans.is3ds');

        $orderId = 'JuaraASN-' . time() . '-' . Auth::id();

        $transaction = Transaction::create([
            'user_id' => Auth::id(),
            'package_id' => $package->id,
            'order_id' => $orderId,
            'amount' => $package->price,
            'status' => 'pending',
        ]);

        $params = [
            'transaction_details' => [
                'order_id' => $orderId,
                'gross_amount' => $package->price,
            ],
            'customer_details' => [
                'first_name' => $user->name,
                'email' => $user->email,
            ],
            'item_details' => [
                [
                    'id' => $package->id,
                    'price' => $package->price,
                    'quantity' => 1,
                    'name' => $package->name,
                ],
            ],
        ];

        $snapToken = Snap::getSnapToken($params);

        $transaction->update([
            'snap_token' => $snapToken,
        ]);

        return view('tryout.buy', compact(
            'package',
            'transaction',
            'snapToken'
        ));
    }

    public function success(Transaction $transaction)
    {
        if ($transaction->user_id !== Auth::id()) {
            abort(403);
        }

        Config::$serverKey = config('midtrans.serverKey');
        Config::$isProduction = config('midtrans.isProduction');
        Config::$isSanitized = config('midtrans.isSanitized');
        Config::$is3ds = config('midtrans.is3ds');

        try {
            $status = MidtransTransaction::status($transaction->order_id);

            $transactionStatus = data_get($status, 'transaction_status');
            $paymentType = data_get($status, 'payment_type');

            if (
                $transactionStatus === 'settlement' ||
                $transactionStatus === 'capture'
            ) {
                $transaction->update([
                    'status' => 'paid',
                    'payment_type' => $paymentType,
                    'midtrans_response' => json_decode(json_encode($status), true),
                ]);

                UserPackage::firstOrCreate([
                    'user_id' => $transaction->user_id,
                    'package_id' => $transaction->package_id,
                ]);

                return redirect()
                    ->route('tryout')
                    ->with('success', 'Pembayaran berhasil. Paket sudah aktif.');
            }

            $transaction->update([
                'status' => $transactionStatus === 'pending' ? 'pending' : 'failed',
                'payment_type' => $paymentType,
                'midtrans_response' => json_decode(json_encode($status), true),
            ]);

            return redirect()
                ->route('tryout')
                ->with('success', 'Pembayaran sedang diverifikasi. Silakan cek kembali beberapa saat lagi.');

        } catch (\Exception $e) {
            return redirect()
                ->route('tryout')
                ->with('error', 'Gagal memverifikasi pembayaran. Silakan coba beberapa saat lagi.');
        }
    }
    public function callback(Request $request)
    {
        $serverKey = config('midtrans.serverKey');

        $signature = hash(
            'sha512',
            $request->order_id .
            $request->status_code .
            $request->gross_amount .
            $serverKey
        );

        if ($signature !== $request->signature_key) {
            return response()->json([
                'message' => 'Invalid signature'
            ], 403);
        }

        $transaction = Transaction::where('order_id', $request->order_id)->first();

        if (!$transaction) {
            return response()->json([
                'message' => 'Transaction not found'
            ], 404);
        }

        $status = $request->transaction_status;

        if ($status === 'settlement' || $status === 'capture') {

            $transaction->update([
                'status' => 'paid',
                'payment_type' => $request->payment_type,
                'midtrans_response' => $request->all(),
            ]);

            UserPackage::firstOrCreate([
                'user_id' => $transaction->user_id,
                'package_id' => $transaction->package_id,
            ]);

        } elseif ($status === 'pending') {

            $transaction->update([
                'status' => 'pending',
                'payment_type' => $request->payment_type,
                'midtrans_response' => $request->all(),
            ]);

        } elseif (in_array($status, ['deny', 'cancel', 'expire', 'failure'])) {

            $transaction->update([
                'status' => 'failed',
                'payment_type' => $request->payment_type,
                'midtrans_response' => $request->all(),
            ]);
        }

        return response()->json([
            'success' => true
        ]);
    }
}