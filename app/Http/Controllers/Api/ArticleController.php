<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Article;
use App\Http\Resources\ArticleResource;
use Illuminate\Http\Request;

class ArticleController extends Controller
{
    // Menampilkan semua artikel
    public function index()
    {
        $articles = Article::with('user')->latest()->get();
        
        return response()->json([
            'success' => true,
            'message' => 'Daftar Artikel',
            'data'    => ArticleResource::collection($articles)
        ], 200);
    }

    // Menampilkan detail 1 artikel
    public function show($id)
    {
        $article = Article::with('user')->find($id);

        if (!$article) {
            return response()->json([
                'success' => false,
                'message' => 'Artikel tidak ditemukan'
            ], 404);
        }

        return response()->json([
            'success' => true,
            'message' => 'Detail Artikel',
            'data'    => new ArticleResource($article)
        ], 200);
    }
}