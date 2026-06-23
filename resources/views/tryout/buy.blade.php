<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Beli Paket</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="icon" type="image/png" href="{{ asset('images/juaraASNco.png') }}">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
</head>

<body class="bg-[#FFF9F5] text-gray-800 min-h-screen flex flex-col" style="font-family: 'Poppins', sans-serif;">

    @include('components.sidebar')
    @include('components.navbar')
    <div id="overlay" class="fixed inset-0 bg-black/40 z-40 hidden opacity-0 transition-opacity duration-300">
    </div>

    <main class="flex-1 max-w-4xl mx-auto px-4 pt-32 pb-12 w-full">

        <div class="bg-white rounded-3xl p-5 sm:p-8 shadow-sm">

            <span class="bg-orange-100 text-[#FF7A47] px-4 py-1 rounded-full text-sm font-bold">
                Premium
            </span>

            <h1 class="text-2xl sm:text-3xl font-bold mt-4 mb-3">
                {{ $package->name }}
            </h1>

            <p class="text-gray-500 mb-6">
                {{ $package->description ?? 'Paket try out premium dengan akses pembahasan.' }}
            </p>

            <div class="grid grid-cols-1 sm:grid-cols-3 gap-4 mb-8">

                <div class="bg-[#FFF5F0] rounded-2xl p-4 text-center">
                    <p class="text-sm text-gray-500">Jumlah Soal</p>
                    <p class="text-2xl font-bold">
                        {{ $package->questions->count() }}
                    </p>
                </div>

                <div class="bg-[#FFF5F0] rounded-2xl p-4 text-center">
                    <p class="text-sm text-gray-500">Durasi</p>
                    <p class="text-2xl font-bold">
                        {{ $package->duration_minutes }} Menit
                    </p>
                </div>

                <div class="bg-[#FFF5F0] rounded-2xl p-4 text-center">
                    <p class="text-sm text-gray-500">Pembahasan</p>
                    <p class="text-2xl font-bold">
                        Aktif
                    </p>
                </div>

            </div>

            <div class="bg-[#FF7A47] text-white rounded-3xl p-6 text-center">

                <p class="text-sm mb-2">Harga Paket</p>

                <h2 class="text-3xl sm:text-4xl font-bold mb-6">
                    Rp {{ number_format($package->price, 0, ',', '.') }}
                </h2>

                <form action="{{ route('payment.checkout', $package->id) }}" method="POST">
                    @csrf

                    <button type="submit"
                        class="bg-white text-[#FF7A47] px-6 sm:px-8 py-3 rounded-xl font-bold hover:scale-105 transition">
                        Bayar Sekarang
                    </button>
                </form>

            </div>

        </div>

    </main>
    @include('components.footer')

    @if (isset($snapToken))
        <script src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="{{ config('midtrans.clientKey') }}">
        </script>

        <script>
            snap.pay('{{ $snapToken }}', {
                onSuccess: function(result) {
                    window.location.href = "{{ route('payment.success', $transaction->id) }}";
                },
                onPending: function(result) {
                    alert('Pembayaran masih pending. Silakan selesaikan pembayaran.');
                },
                onError: function(result) {
                    alert('Pembayaran gagal.');
                },
                onClose: function() {
                    alert('Kamu menutup pembayaran sebelum selesai.');
                }
            });
        </script>
    @endif

</body>

</html>
