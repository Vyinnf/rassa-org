<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\Validation\ValidationException;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws ValidationException
     */
public function store(Request $request): mixed // Ubah return type hint menjadi mixed atau Response
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:'.User::class],
            'password' => ['required', 'confirmed', \Illuminate\Validation\Rules\Password::defaults()],
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'customer', // Tambahan: Paksa role jadi customer
            'points' => 100,      // Tambahan: Welcome bonus 100 Poin
        ]);

        event(new Registered($user));

        Auth::login($user);

        // --- BAGIAN YANG DIUBAH ---
        // Jika request mengharapkan JSON (dari AJAX), kembalikan respons JSON
        if ($request->wantsJson()) {
            return response()->json([
                'message' => 'Registrasi berhasil',
                'redirect' => route('member.dashboard', absolute: false)
            ]);
        }

        // Jika bukan dari AJAX, lakukan redirect standar
        return redirect(route('member.dashboard', absolute: false));
    }
}