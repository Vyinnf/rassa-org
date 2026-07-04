<?php

namespace App\Http\Controllers;

use App\Models\UserVoucher;
use Illuminate\Http\Request;

class AdminVoucherController extends Controller
{
    public function index(Request $request)
    {
        $voucher = null;
        if ($request->has('code')) {
            // Cari voucher berdasarkan kode (Case Insensitive)
            $voucher = UserVoucher::where('redeem_code', strtoupper($request->code))
                        ->with(['user', 'voucher'])
                        ->first();
        }
        return view('admin.vouchers.scan', compact('voucher'));
    }

    public function redeem(Request $request)
    {
        $userVoucher = UserVoucher::findOrFail($request->id);

        if ($userVoucher->is_used) {
            return back()->with('error', 'Voucher ini sudah pernah digunakan sebelumnya!');
        }

        if (now() > $userVoucher->expires_at) {
            return back()->with('error', 'Voucher ini sudah kadaluwarsa.');
        }

        $userVoucher->update([
            'is_used' => true,
            'used_at' => now()
        ]);

        return redirect()->route('admin.vouchers.scan')->with('success', 'Voucher berhasil divalidasi! Selamat menikmati kopi!');
    }
}