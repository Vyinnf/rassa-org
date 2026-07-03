<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use Illuminate\Http\Request;

class MenuController extends Controller
{
    public function index()
    {
        // Mengambil semua data menu dari yang terbaru
        $menus = Menu::latest()->get();

        return view('admin.menus.index', compact('menus'));
    }
}