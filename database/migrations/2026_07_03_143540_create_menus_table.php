<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
public function up(): void
{
    Schema::create('menus', function (Blueprint $table) {
        
        /*
        |--------------------------------------------------------------------------
        | PRIMARY KEY
        |--------------------------------------------------------------------------
        */
        $table->id();
        
        /*
        |--------------------------------------------------------------------------
        | INFORMASI MENU KAFE
        |--------------------------------------------------------------------------
        */
        // Nama produk (misal: "Es Kopi Susu Rassa")
        $table->string('name');
        
        // Slug untuk URL (misal: "es-kopi-susu-rassa")
        $table->string('slug')->unique(); 
        
        // Kategori menu (misal: "Coffee", "Non-Coffee", "Snack", "Main Course")
        $table->string('category');
        
        // Deskripsi singkat tentang rasa atau komposisi menu
        $table->text('description')->nullable();
        
        // Harga produk (menggunakan integer agar mudah dihitung/format Rupiah)
        $table->integer('price');
        
        /*
        |--------------------------------------------------------------------------
        | STATUS & MEDIA
        |--------------------------------------------------------------------------
        */
        // Foto produk
        $table->string('image')->nullable(); 
        
        // Status ketersediaan (Bisa di-on/off jika stok habis tanpa harus menghapus data)
        $table->boolean('is_available')->default(true);
        
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('menus');
    }
};
