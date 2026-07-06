<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ArticleResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'slug' => $this->slug,
            'content' => $this->content,
            // Otomatis membuat URL penuh untuk gambar jika ada
            'image_url' => $this->image ? asset('storage/' . $this->image) : null,
            'author' => $this->user ? $this->user->name : 'Admin', 
            'published_at' => $this->created_at->format('d M Y H:i'),
        ];
    }
}