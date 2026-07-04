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
        Schema::create('messages', function (Blueprint $table) {
            $table->id();
            
            // Nama pengirim
            $table->string('name');
            
            // Email pengirim (agar bisa dihubungi balik)
            $table->string('email');
            
            // Subjek pesan (misal: "Reservasi Tempat" atau "Tanya Menu")
            $table->string('subject')->nullable();
            
            // Isi pesan dari pelanggan
            $table->text('content');
            
            // Status apakah pesan sudah dibaca oleh admin atau belum
            $table->boolean('is_read')->default(false);
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('messages');
    }
};
