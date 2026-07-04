<?php

namespace App\Http\Controllers;

use App\Models\Message;
use Illuminate\Http\Request;

class MessageController extends Controller
{
    // Menyimpan pesan dari pengunjung ke database
    public function store(Request $request)
    {
        // 1. Validasi data yang masuk
        $validated = $request->validate([
            'name'    => 'required|string|max:255',
            'email'   => 'required|email|max:255',
            'subject' => 'nullable|string|max:255',
            'content' => 'required|string',
        ]);

        // 2. Simpan ke database
        Message::create($validated);

        // 3. Kembalikan ke halaman depan (home) dengan pesan sukses
        return redirect('/#kontak')->with('success', 'Terima kasih! Pesan Anda telah kami terima dan akan segera kami balas.');
    }
}