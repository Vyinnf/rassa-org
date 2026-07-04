<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Voucher extends Model
{
    protected $fillable = [
        'name',
        'points_required',
        'description',
        'valid_days',
        'is_active',
    ];

    // Relasi: Satu voucher bisa dimiliki banyak user dalam bentuk user_vouchers
    public function userVouchers()
    {
        return $this->hasMany(UserVoucher::class);
    }
}