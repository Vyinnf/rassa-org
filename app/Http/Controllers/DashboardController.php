<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        if ($user->role === 'admin') {
            return redirect()->route('admin.dashboard');
        } 
        
        if ($user->role === 'customer') {
            return redirect()->route('member.dashboard');
        }

        return redirect('/');
    }
}