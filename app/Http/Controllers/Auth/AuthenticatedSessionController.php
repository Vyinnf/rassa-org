<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */
    public function create(): View
    {
        return view('auth.login');
    }

/**
     * Handle an incoming authentication request.
     */
    public function store(LoginRequest $request): mixed
    {
        // 1. Lakukan proses autentikasi
        $request->authenticate();

        // 2. Regenerasi session
        $request->session()->regenerate();

        // 3. Cek role user yang baru saja login untuk menentukan arah redirect
        $user = Auth::user();
        $redirectUrl = '/'; // URL default (fallback)

        if ($user->role === 'admin') {
            // Jika admin, arahkan ke dashboard admin
            // (Sesuaikan 'admin.dashboard' dengan nama route admin kamu yang sebenarnya)
            $redirectUrl = route('admin.dashboard', absolute: false); 
        } elseif ($user->role === 'customer') {
            // Jika member/customer, arahkan ke dashboard member
            $redirectUrl = route('member.dashboard', absolute: false);
        }

        // 4. Tangani balikan untuk request dari AJAX (Frontend kamu menggunakan ini)
        if ($request->wantsJson()) {
            return response()->json([
                'message' => 'Login berhasil',
                'redirect' => $redirectUrl
            ]);
        }

        // 5. Balikan standar jika login tidak menggunakan AJAX
        return redirect()->intended($redirectUrl);
    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}