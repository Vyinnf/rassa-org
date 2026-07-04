<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
class MenuController extends Controller
{
    public function index()
    {
        // Mengambil semua data menu dari yang terbaru
        $menus = Menu::latest()->get();

        return view('admin.menus.index', compact('menus'));
    }

    // Menampilkan halaman form tambah menu
    public function create()
    {
        return view('admin.menus.create');
    }

    // Memproses penyimpanan data menu baru ke database
    public function store(Request $request)
    {
        // 1. Validasi Input
        $validated = $request->validate([
            'name'         => 'required|string|max:255',
            'category'     => 'required|string',
            'price'        => 'required|integer|min:0',
            'description'  => 'nullable|string',
            'is_available' => 'required|boolean',
            'image'        => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048', // maksimal 2MB
        ]);

        $data = $validated;
        
        // 2. Buat slug otomatis dari nama menu agar URL rapi (ditambah kode acak agar tidak bentrok)
        $data['slug'] = Str::slug($request->name) . '-' . Str::random(4);

        // 3. Proses upload foto (jika ada)
        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('menus', 'public');
        }

        // 4. Simpan ke database
        Menu::create($data);

        // 5. Kembali ke daftar menu dengan pesan sukses
        return redirect()->route('admin.menus.index')->with('success', 'Menu kafe berhasil ditambahkan!');
    }

    public function edit(Menu $menu)
    {
        return view('admin.menus.edit', compact('menu'));
    }

    public function update(Request $request, Menu $menu)
    {
        $validated = $request->validate([
            'name'         => 'required|string|max:255',
            'category'     => 'required|string',
            'price'        => 'required|integer|min:0',
            'description'  => 'nullable|string',
            'is_available' => 'required|boolean',
            'image'        => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        $data = $validated;
        $data['slug'] = Str::slug($request->name) . '-' . Str::random(4);

        if ($request->hasFile('image')) {
            if ($menu->image) {
                Storage::disk('public')->delete($menu->image);
            }
            $data['image'] = $request->file('image')->store('menus', 'public');
        }

        $menu->update($data);

        return redirect()->route('admin.menus.index')->with('success', 'Menu berhasil diperbarui!');
    }

    public function destroy(Menu $menu)
    {
        if ($menu->image) {
            Storage::disk('public')->delete($menu->image);
        }

        $menu->delete();

        return redirect()->route('admin.menus.index')->with('success', 'Menu berhasil dihapus!');
    }
}