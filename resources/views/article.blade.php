@extends('layouts.main')

@section('content')
    <article class="max-w-3xl mx-auto px-6 py-16">
        
        <!-- Tombol Kembali -->
        <div class="mb-8">
            <a href="{{ route('home') }}#berita" class="text-sm font-bold text-gray-400 hover:text-[#4A5D23] transition flex items-center">
                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
                Kembali ke Beranda
            </a>
        </div>

        <!-- Header Artikel -->
        <header class="mb-10 text-center">
            <div class="text-sm font-bold text-[#4A5D23] tracking-widest uppercase mb-3">
                Cerita Rassa
            </div>
            <h1 class="text-3xl md:text-5xl font-bold tracking-tight text-gray-900 mb-6 leading-tight">
                {{ $article->title }}
            </h1>
            <time class="text-sm font-medium text-gray-500">
                Dipublikasikan pada {{ $article->created_at->translatedFormat('d F Y') }}
            </time>
        </header>

        <!-- Gambar Sampul -->
        @if($article->image)
            <div class="w-full aspect-[21/9] bg-gray-100 rounded-2xl overflow-hidden mb-12 shadow-sm">
                <img src="{{ asset('storage/' . $article->image) }}" alt="{{ $article->title }}" class="w-full h-full object-cover">
            </div>
        @endif

        <!-- Isi Konten -->
        <div class="prose prose-lg prose-gray max-w-none text-gray-700 leading-relaxed">
            {!! nl2br(e($article->content)) !!}
        </div>
        
    </article>
@endsection