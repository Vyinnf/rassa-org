<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    // Menampilkan daftar semua pengguna
    public function index()
    {
        // Mengambil semua data pengguna, diurutkan dari yang terbaru
        $users = User::latest()->get();
        
        return view('admin.users.index', compact('users'));
    }

    // Menghapus akun pengguna
    public function destroy(User $user)
    {
        // Proteksi keamanan: Admin yang sedang login tidak boleh menghapus akunnya sendiri
        if (auth()->id() === $user->id) {
            return redirect()->route('admin.users.index')->with('error', 'Gagal! Anda tidak bisa menghapus akun Anda sendiri yang sedang aktif.');
        }

        $user->delete();

        return redirect()->route('admin.users.index')->with('success', 'Akun pengguna berhasil dihapus secara permanen!');
    }

    public function addPoints(Request $request, $id)
{
    $request->validate([
        'points' => 'required|integer|min:1',
    ]);

    $user = \App\Models\User::findOrFail($id);
    
    // Tambahkan poin
    $user->points += $request->points;
    $user->save();

    return back()->with('success', 'Berhasil menambahkan ' . $request->points . ' poin ke ' . $user->name);
}
}