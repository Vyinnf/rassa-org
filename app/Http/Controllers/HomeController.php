<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Menu;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        // Ambil 3 berita terbaru untuk highlight
        $articles = Article::latest()->take(3)->get();
        
        // Ambil semua menu yang tersedia
        $menus = Menu::where('is_available', true)->get();
        
        return view('home', compact('articles', 'menus'));
    }
}