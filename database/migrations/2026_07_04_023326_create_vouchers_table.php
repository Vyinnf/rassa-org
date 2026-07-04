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
        Schema::create('vouchers', function (Blueprint $table) {
            $table->id();
            $table->string('name'); // Contoh: "Diskon 10% Kopi Susu"
            $table->integer('points_required'); // Harga tukarnya, misal: 100 poin
            $table->text('description')->nullable(); // Syarat & Ketentuan
            $table->integer('valid_days')->default(7); // Masa berlaku dalam hari
            $table->boolean('is_active')->default(true); // Apakah voucher ini sedang tayang
            $table->timestamps();
        });
    }
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('vouchers');
    }
};
