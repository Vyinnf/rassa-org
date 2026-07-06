<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Menu;
use App\Http\Resources\MenuResource;
use Illuminate\Http\Request;

class MenuController extends Controller
{
    // Menampilkan semua menu yang tersedia saja (opsional)
    public function index()
    {
        $menus = Menu::latest()->get(); // Bisa tambah ->where('is_available', 1) jika mau
        
        return response()->json([
            'success' => true,
            'message' => 'Daftar Menu Kafe',
            'data'    => MenuResource::collection($menus)
        ], 200);
    }

    // Menampilkan detail 1 menu
    public function show($id)
    {
        $menu = Menu::find($id);

        if (!$menu) {
            return response()->json([
                'success' => false,
                'message' => 'Menu tidak ditemukan'
            ], 404);
        }

        return response()->json([
            'success' => true,
            'message' => 'Detail Menu',
            'data'    => new MenuResource($menu)
        ], 200);
    }
}