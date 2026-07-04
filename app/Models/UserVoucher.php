<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserVoucher extends Model
{
    protected $fillable = [
        'user_id',
        'voucher_id',
        'redeem_code',
        'is_used',
        'used_at',
        'expires_at',
    ];

    // Relasi balik ke User
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Relasi balik ke Voucher
    public function voucher()
    {
        return $this->belongsTo(Voucher::class);
    }
}