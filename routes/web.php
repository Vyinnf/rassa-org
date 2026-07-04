<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\{
    ProfileController,
    AdminController,
    ArticleController,
    MenuController,
    HomeController,
    UserController,
    MessageController,
    SettingController,
    AdminMessageController,
    MemberController,
    DashboardController,
    MemberVoucherController,
    AdminVoucherController
};

/*
|--------------------------------------------------------------------------
| 1. AREA PUBLIK (Guest)
|--------------------------------------------------------------------------
*/
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/berita/{id}', [HomeController::class, 'showArticle'])->name('article.show');
Route::post('/kirim-pesan', [MessageController::class, 'store'])->name('message.store');

/*
|--------------------------------------------------------------------------
| 2. DASHBOARD DISPATCHER (Pintu Masuk Auth)
|--------------------------------------------------------------------------
| Setelah login, semua user diarahkan ke sini untuk diarahkan ke dasbor masing-masing.
*/
Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
});

/*
|--------------------------------------------------------------------------
| 3. AREA UMUM (Auth)
|--------------------------------------------------------------------------
| Halaman yang bisa diakses oleh siapa saja yang sudah login (Admin & Customer).
*/
Route::middleware(['auth', 'verified'])->group(function () {
    Route::prefix('profile')->name('profile.')->controller(ProfileController::class)->group(function () {
        Route::get('/', 'edit')->name('edit');
        Route::patch('/', 'update')->name('update');
        Route::delete('/', 'destroy')->name('destroy');
    });
});

/*
|--------------------------------------------------------------------------
| 4. AREA ADMIN KHUSUS (Role: admin)
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'role:admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [AdminController::class, 'index'])->name('dashboard');
    
    Route::resource('articles', ArticleController::class);
    Route::resource('menus', MenuController::class);
    Route::resource('users', UserController::class);
    Route::post('users/{id}/add-points', [UserController::class, 'addPoints'])->name('users.add-points');
    Route::resource('messages', AdminMessageController::class)->only(['index', 'show', 'destroy']);
    
    // Pengaturan
    Route::get('settings', [SettingController::class, 'index'])->name('settings.index');
    Route::put('settings', [SettingController::class, 'update'])->name('settings.update');

Route::prefix('vouchers')->name('vouchers.')->group(function () {
    Route::get('/scan', [AdminVoucherController::class, 'index'])->name('scan');
    Route::post('/confirm', [AdminVoucherController::class, 'redeem'])->name('confirm');
});

});

/*
|--------------------------------------------------------------------------
| 5. AREA MEMBER KHUSUS (Role: customer)
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'role:customer'])->prefix('member')->name('member.')->group(function () {
    Route::get('/dashboard', [MemberController::class, 'index'])->name('dashboard');
    Route::get('/vouchers', [MemberVoucherController::class, 'index'])->name('vouchers.index');
    Route::post('/vouchers/redeem/{id}', [MemberVoucherController::class, 'redeem'])->name('vouchers.redeem');
});

// Autentikasi Breeze
require __DIR__.'/auth.php';