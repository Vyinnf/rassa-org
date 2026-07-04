<?php

namespace App\Http\Controllers;

use App\Models\Setting;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    // Menampilkan form pengaturan
    public function index()
    {
        // Ambil data setting pertama. Jika kosong, buatkan data default secara otomatis.
        $setting = Setting::firstOrCreate(
            ['id' => 1],
            [
                'cafe_name'  => 'Rassa.org',
                'hero_title' => 'Menikmati Kopi, Merajut Cerita.',
                'hero_text'  => 'Selamat datang di Rassa. Tempat di mana setiap cangkir kopi diracik dengan hati, menyertai setiap obrolan dan bait cerita Anda.',
                'address'    => 'Jl. Raya Informatika No. 42, Kota Anda',
                'email'      => 'halo@rassa.org',
            ]
        );

        return view('admin.settings.index', compact('setting'));
    }

    // Menyimpan perubahan pengaturan
    public function update(Request $request)
    {
        $validated = $request->validate([
            'cafe_name'     => 'required|string|max:255',
            'hero_title'    => 'required|string|max:255',
            'hero_text'     => 'nullable|string',
            'address'       => 'nullable|string',
            'email'         => 'nullable|email|max:255',
            'phone'         => 'nullable|string|max:20',
            'instagram_url' => 'nullable|url|max:255',
        ]);

        // Ambil data setting (pasti ada karena index() sudah membuatkannya)
        $setting = Setting::first();
        $setting->update($validated);

        return redirect()->route('admin.settings.index')->with('success', 'Pengaturan profil kafe berhasil diperbarui!');
    }
}