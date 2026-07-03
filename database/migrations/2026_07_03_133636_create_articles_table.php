<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
public function up(): void
{
    Schema::create('articles', function (Blueprint $table) {
        
        /*
        |--------------------------------------------------------------------------
        | PRIMARY KEY & RELASI
        |--------------------------------------------------------------------------
        */
        $table->id();
        
        // Mencatat ID Admin yang menulis artikel ini (berelasi ke tabel users)
        $table->foreignId('user_id')->constrained()->onDelete('cascade'); 
        
        /*
        |--------------------------------------------------------------------------
        | INFORMASI KONTEN UTAMA
        |--------------------------------------------------------------------------
        */
        $table->string('title');
        
        // Slug untuk URL yang rapi dan SEO friendly (misal: promo-kopi-susu)
        $table->string('slug')->unique(); 
        
        $table->text('content');
        
        /*
        |--------------------------------------------------------------------------
        | MEDIA & TIMESTAMPS
        |--------------------------------------------------------------------------
        */
        // Nullable karena tidak semua berita wajib memiliki foto/thumbnail
        $table->string('image')->nullable(); 
        
        // Otomatis mencatat waktu pembuatan (created_at) dan pembaruan (updated_at)
        $table->timestamps();
        
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('articles');
    }
};
