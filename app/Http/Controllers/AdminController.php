<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Article;
use App\Models\Message;
use App\Models\Menu;
use App\Models\User;

class AdminController extends Controller
{
    public function index()
    {
        // Menghitung total berita yang ada di database
        $totalArticles = Article::count();
        $totalMenus = Menu::count();
        $totalUsers = User::count();
        $unreadMessages = Message::where('is_read', false)->count();

        $recentArticles = \App\Models\Article::latest()->take(5)->get(); // 5 berita terbaru
    $recentMessages = \App\Models\Message::latest()->take(5)->get();
        
        // Mengirimkan data variabel $totalArticles, $totalMenus, dan $totalUsers ke tampilan dashboard
        return view('admin.dashboard', compact('totalArticles', 'totalMenus', 'totalUsers', 'unreadMessages', 'recentArticles', 'recentMessages'));
    }
}