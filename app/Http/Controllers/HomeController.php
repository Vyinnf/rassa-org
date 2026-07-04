<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Menu;
use App\Models\Setting;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $articles = Article::latest()->take(3)->get();
        $menus = Menu::all();
        $setting = Setting::first(); 
        
        return view('home', compact('articles', 'menus', 'setting'));
    }

    // Fungsi baru untuk menampilkan detail satu berita
    public function showArticle($id)
    {
        $article = Article::findOrFail($id);
        $setting = Setting::first(); // Bawa data setting agar Navbar/Footer tidak error
        
        return view('article', compact('article', 'setting'));
    }
}