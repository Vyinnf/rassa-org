<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class Article extends Model
{
    /*
    |--------------------------------------------------------------------------
    | MASS ASSIGNMENT (Pengaturan Keamanan)
    |--------------------------------------------------------------------------
    | Menentukan kolom database mana saja yang diizinkan untuk diisi 
    | secara massal (mass-assignment) dari input form.
    */
    protected $fillable = [
        'user_id',
        'title',
        'slug',
        'content',
        'image',
    ];

    /*
    |--------------------------------------------------------------------------
    | RELASI DATABASE
    |--------------------------------------------------------------------------
    */
    
    /**
     * Relasi (BelongsTo): 
     * Setiap 1 artikel dimiliki/ditulis oleh 1 orang User (Admin).
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}