<?php

namespace App\Http\Controllers;

use App\Models\Message;
use Illuminate\Http\Request;

class AdminMessageController extends Controller
{
    // Menampilkan daftar pesan
    public function index()
    {
        // Ambil semua pesan dari yang paling baru
        $messages = Message::latest()->get();
        return view('admin.messages.index', compact('messages'));
    }

    // Membaca detail pesan
    public function show(Message $message)
    {
        // Ubah status pesan menjadi "sudah dibaca" (is_read = true) jika sebelumnya belum dibaca
        if (!$message->is_read) {
            $message->update(['is_read' => true]);
        }

        return view('admin.messages.show', compact('message'));
    }

    // Menghapus pesan
    public function destroy(Message $message)
    {
        $message->delete();
        return redirect()->route('admin.messages.index')->with('success', 'Pesan berhasil dihapus!');
    }
}