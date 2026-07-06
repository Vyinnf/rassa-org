<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\ArticleController;
use App\Http\Controllers\Api\MenuController;

// 1. Endpoint User (Memerlukan Token/Login)
// Hanya bisa diakses jika user sudah login menggunakan Sanctum
Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

// 2. Endpoint Publik Artikel
// Bisa diakses siapa saja tanpa perlu login
Route::get('/articles', [ArticleController::class, 'index']);
Route::get('/articles/{id}', [ArticleController::class, 'show']);

// 3. Endpoint Publik Menu
// Bisa diakses siapa saja tanpa perlu login
Route::get('/menus', [MenuController::class, 'index']);
Route::get('/menus/{id}', [MenuController::class, 'show']);