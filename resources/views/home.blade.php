@extends('layouts.main')

@section('content')
    <!-- Hero Section -->
    <section class="max-w-6xl mx-auto px-6 pt-16 pb-20 text-center">
        <h1 class="text-5xl md:text-6xl font-bold tracking-tight text-gray-900 mb-6">
            Menikmati Kopi, <br class="hidden md:block"><span class="text-[#4A5D23]">Merajut Cerita.</span>
        </h1>
        <p class="text-gray-500 max-w-xl mx-auto text-base md:text-lg mb-8 font-medium">
            Selamat datang di Rassa. Tempat di mana setiap cangkir kopi diracik dengan hati, menyertai setiap obrolan dan bait cerita Anda.
        </p>
        <div class="space-x-4">
            <a href="#menu" class="px-6 py-3 bg-[#4A5D23] text-white font-semibold rounded-xl hover:bg-[#3b4b1c] transition shadow-md">Lihat Menu</a>
            <a href="#berita" class="px-6 py-3 bg-white border border-gray-200 text-gray-700 font-semibold rounded-xl hover:bg-gray-50 transition">Baca Berita</a>
        </div>
    </section>

<!-- Menu Kafe Section -->
    <section id="menu" class="max-w-6xl mx-auto px-6 py-16">
        <div class="mb-12">
            <h2 class="text-3xl font-bold tracking-tight text-gray-900">Menu Pilihan Kami</h2>
            <p class="text-sm text-gray-500 mt-2 font-medium">Nikmati racikan kopi premium dan hidangan spesial dari dapur Rassa.</p>
        </div>

        <!-- Kita gunakan 'grid' dengan 'gap' yang pasti -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8 w-full">
            @forelse($menus as $menu)
    <!-- Tambahkan max-w-sm dan mx-auto agar card tidak melar -->
    <div class="bg-white rounded-2xl border border-gray-100 shadow-[0_2px_10px_rgb(0,0,0,0.02)] overflow-hidden flex flex-col hover:shadow-lg transition-shadow duration-300 w-full max-w-sm mx-auto">
        
        <!-- Foto Menu: Beri aspect-video agar ukuran fotonya konsisten -->
        <div class="w-full aspect-video bg-gray-100 relative overflow-hidden">
            @if($menu->image)
                <img src="{{ asset('storage/' . $menu->image) }}" 
                     alt="{{ $menu->name }}" 
                     class="w-full h-full object-cover">
            @else
                <div class="w-full h-full flex items-center justify-center text-gray-300">
                    <svg class="w-12 h-12" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                </div>
            @endif
            <div class="absolute top-4 right-4">
                <span class="px-3 py-1 bg-white/90 backdrop-blur-sm text-[10px] font-bold uppercase tracking-widest text-gray-800 rounded-full shadow-sm">
                    {{ $menu->category }}
                </span>
            </div>
        </div>

        <!-- Detail Info -->
        <div class="p-6 flex flex-col flex-grow">
            <h3 class="text-lg font-bold text-gray-900 mb-2">{{ $menu->name }}</h3>
            <p class="text-sm text-gray-500 font-medium line-clamp-2 mb-4 flex-grow">
                {{ $menu->description ?? 'Tidak ada deskripsi singkat.' }}
            </p>
            <div class="text-lg font-bold text-[#4A5D23]">
                Rp {{ number_format($menu->price, 0, ',', '.') }}
            </div>
        </div>
    </div>
@empty
    <p class="col-span-full text-center py-12 text-gray-400">Belum ada menu tersedia.</p>
@endforelse
        </div>
    </section>

    <!-- Berita / Artikel Section -->
    <section id="berita" class="max-w-6xl mx-auto px-6 py-16 border-t border-gray-100">
        <div class="mb-12">
            <h2 class="text-3xl font-bold tracking-tight text-gray-900">Cerita & Berita Rassa</h2>
            <p class="text-sm text-gray-500 mt-2 font-medium">Ikuti kabar terbaru, promo menarik, dan cerita seru dari balik meja barista.</p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            @forelse($articles as $article)
                <div class="bg-white rounded-2xl border border-gray-100 overflow-hidden shadow-[0_2px_10px_rgb(0,0,0,0.01)] flex flex-col hover:shadow-md transition duration-300">
                    <!-- Foto Berita -->
                    <div class="h-44 bg-gray-50">
                        @if($article->image)
                            <img src="{{ asset('storage/' . $article->image) }}" alt="{{ $article->title }}" class="w-full h-full object-cover">
                        @else
                            <div class="w-full h-full flex items-center justify-center text-gray-300">
                                <svg class="w-12 h-12" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"></path></svg>
                            </div>
                        @endif
                    </div>

                    <!-- Isi Cuplikan -->
                    <div class="p-6 flex-1 flex flex-col justify-between">
                        <div>
                            <span class="text-xs font-semibold text-gray-400 block mb-2">
                                {{ $article->created_at->translatedFormat('d F Y') }}
                            </span>
                            <h3 class="text-base font-bold text-gray-900 mb-2 line-clamp-2 hover:text-[#4A5D23] transition">
                                {{ $article->title }}
                            </h3>
                            <p class="text-xs text-gray-500 font-medium line-clamp-3 mb-4">
                                {{ Str::limit(strip_tags($article->content), 100) }}
                            </p>
                        </div>
                        <a href="#" class="text-xs font-bold text-[#4A5D23] hover:underline flex items-center">
                            Baca Selengkapnya
                            <svg class="w-3 h-3 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
                        </a>
                    </div>
                </div>
            @empty
                <div class="col-span-full text-center py-12 text-gray-400">
                    <p class="font-medium">Belum ada berita yang diterbitkan.</p>
                </div>
            @endforelse
        </div>
    </section>
@endsection