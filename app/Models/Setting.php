<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    protected $fillable = [
        'cafe_name',
        'hero_title',
        'hero_text',
        'address',
        'email',
        'phone',
        'instagram_url',
    ];
}