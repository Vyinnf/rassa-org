<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('settings', function (Blueprint $table) {
            $table->id();
            
            // Info Dasar
            $table->string('cafe_name')->default('Rassa.org');
            $table->string('hero_title')->default('Menikmati Kopi, Merajut Cerita.');
            $table->text('hero_text')->nullable();
            
            // Info Kontak & Lokasi
            $table->text('address')->nullable();
            $table->string('email')->nullable();
            $table->string('phone')->nullable();
            
            // Sosial Media (opsional)
            $table->string('instagram_url')->nullable();
            
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('settings');
    }
};