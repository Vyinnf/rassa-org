<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AdminController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\ArticleController;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\HomeController;

/*
|--------------------------------------------------------------------------
| AREA PUBLIK (Guest & Authenticated)
|--------------------------------------------------------------------------
| Halaman yang bisa diakses oleh siapa saja tanpa perlu login.
| Nantinya landing page rassa.org akan ada di sini.
*/
Route::get('/', function () {
    return view('welcome'); 
})->name('home');

Route::get('/', [HomeController::class, 'index'])->name('home');

/*
|--------------------------------------------------------------------------
| AREA UMUM (Memerlukan Login)
|--------------------------------------------------------------------------
| Berlaku untuk semua user yang sudah login, baik Admin maupun Customer.
*/
Route::middleware(['auth', 'verified'])->group(function () {
    
    // 1. Dispatcher: Pengarah arah setelah login
    Route::get('/dashboard', function () {
        return Auth::user()->role === 'admin' 
            ? redirect()->route('admin.dashboard') 
            : view('dashboard');
    })->name('dashboard');

    // 2. Manajemen Profil (Menggunakan Controller Grouping agar lebih rapi)
    Route::controller(ProfileController::class)->prefix('profile')->name('profile.')->group(function () {
        Route::get('/', 'edit')->name('edit');
        Route::patch('/', 'update')->name('update');
        Route::delete('/', 'destroy')->name('destroy');
    });

});


/*
|--------------------------------------------------------------------------
| AREA ADMIN KHUSUS
|--------------------------------------------------------------------------
| Hanya bisa diakses oleh user dengan role 'admin'.
*/
Route::middleware(['auth', 'role:admin'])->prefix('admin')->name('admin.')->group(function () {
    
    Route::get('/dashboard', [AdminController::class, 'index'])->name('dashboard');
    
    // Nanti route untuk manajemen berita, menu, dan galeri 
    // bisa kita kumpulkan semua di dalam blok ini.
    
});
Route::middleware(['auth', 'role:admin'])->prefix('admin')->name('admin.')->group(function () {

    Route::get('/dashboard', [AdminController::class, 'index'])->name('dashboard');
    Route::resource('articles', ArticleController::class);

});
Route::middleware(['auth', 'role:admin'])->prefix('admin')->name('admin.')->group(function () {

    Route::get('/dashboard', [AdminController::class, 'index'])->name('dashboard');
    Route::resource('articles', ArticleController::class);
    Route::resource('menus', MenuController::class);

});

/*
|--------------------------------------------------------------------------
| AREA AUTENTIKASI (Bawaan Breeze)
|--------------------------------------------------------------------------
*/
require __DIR__.'/auth.php';