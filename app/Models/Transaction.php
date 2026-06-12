<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    protected $fillable = [
        'user_id',
        'package_id',
        'order_id',
        'amount',
        'status',
        'payment_type',
        'snap_token',
        'midtrans_response',
    ];

    protected $casts = [
        'midtrans_response' => 'array',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function package()
    {
        return $this->belongsTo(Package::class);
    }
}
