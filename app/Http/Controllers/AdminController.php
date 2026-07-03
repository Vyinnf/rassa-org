<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Article;

class AdminController extends Controller
{
    public function index()
    {
        // Menghitung total berita yang ada di database
        $totalArticles = Article::count();
        
        // Mengirimkan data variabel $totalArticles ke tampilan dashboard
        return view('admin.dashboard', compact('totalArticles'));
    }
}