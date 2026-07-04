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
        
        // Mengirimkan data variabel $totalArticles, $totalMenus, dan $totalUsers ke tampilan dashboard
        return view('admin.dashboard', compact('totalArticles', 'totalMenus', 'totalUsers', 'unreadMessages'));
    }
}