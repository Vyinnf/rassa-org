<?php

namespace App\Http\Controllers;

use App\Models\Voucher;
use App\Models\UserVoucher;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class MemberVoucherController extends Controller
{
    public function index()
    {
        $vouchers = Voucher::where('is_active', true)->get();
        return view('member.vouchers.index', compact('vouchers'));
    }

    public function redeem(Request $request, $id)
    {
        $user = Auth::user();
        $voucher = Voucher::findOrFail($id);

        // 1. Cek apakah poin cukup
        if ($user->points < $voucher->points_required) {
            return back()->with('error', 'Poin tidak cukup untuk menukar voucher ini.');
        }

        // 2. Potong poin user
        $user->points -= $voucher->points_required;
        $user->save();

        // 3. Generate kode unik & simpan
        UserVoucher::create([
            'user_id' => $user->id,
            'voucher_id' => $voucher->id,
            'redeem_code' => 'RSS-' . strtoupper(Str::random(6)), // Contoh: RSS-A1B2C3
            'expires_at' => now()->addDays($voucher->valid_days),
        ]);

        return redirect()->route('member.dashboard')->with('success', 'Berhasil! Voucher ' . $voucher->name . ' telah ditambahkan ke koleksi Anda.');
    }
}