<?php

namespace App\Http\Controllers;

use App\Models\UserVoucher;
use Illuminate\Support\Facades\Auth;

class MemberController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        // Ambil riwayat voucher yang pernah ditukar member ini
        $myVouchers = UserVoucher::where('user_id', $user->id)
                        ->with('voucher')
                        ->latest()
                        ->get();

        return view('member.dashboard', compact('user', 'myVouchers'));
    }
}