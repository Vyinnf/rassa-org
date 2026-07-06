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
        // 1. Lakukan proses autentikasi (pengecekan email & password)
        $request->authenticate();

        // 2. Regenerasi session untuk mencegah session fixation attacks
        $request->session()->regenerate();

        // 3. Tangani balikan untuk AJAX (JSON)
        if ($request->wantsJson()) {
            return response()->json([
                'message' => 'Login berhasil',
                // Arahkan ke dashboard setelah login sukses
                'redirect' => route('member.dashboard', absolute: false)
            ]);
        }

        // 4. Balikan standar jika bukan dari AJAX (fallback)
        return redirect()->intended(route('member.dashboard', absolute: false));
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