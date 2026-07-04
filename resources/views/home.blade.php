@extends('layouts.main')

@section('content')
    <!-- Hero Section -->
<section class="max-w-6xl mx-auto px-6 pt-16 pb-20 text-center">
        <h1 class="text-5xl md:text-6xl font-bold tracking-tight text-gray-900 mb-6">
            {{ $setting->hero_title ?? 'Menikmati Kopi, Merajut Cerita.' }}
        </h1>
        <p class="text-gray-500 max-w-xl mx-auto text-base md:text-lg mb-8 font-medium whitespace-pre-wrap">
            {{ $setting->hero_text ?? 'Selamat datang di Rassa...' }}
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
<a href="{{ route('article.show', $article->id) }}" class="text-xs font-bold text-[#4A5D23] hover:underline flex items-center mt-auto">
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
    <!-- Kontak / Hubungi Kami Section -->
    <section id="kontak" class="max-w-6xl mx-auto px-6 py-16 border-t border-gray-100 mb-10">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-12 items-start">
            
            <!-- Teks & Info -->
            <div>
                <h2 class="text-3xl font-bold tracking-tight text-gray-900 mb-4">Sapa Kami</h2>
                <p class="text-gray-500 font-medium mb-8">Punya pertanyaan seputar menu, ingin reservasi tempat untuk acara, atau sekadar ingin menyapa? Jangan ragu untuk mengirimkan pesan kepada kami.</p>
                
<div class="space-y-4">
                    <div class="flex items-center text-gray-600">
                        <div class="w-10 h-10 rounded-full bg-[#4A5D23]/10 flex items-center justify-center text-[#4A5D23] mr-4">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                        </div>
                        <span class="font-medium text-sm">{{ $setting->address ?? 'Alamat belum diatur' }}</span>
                    </div>
                    <div class="flex items-center text-gray-600">
                        <div class="w-10 h-10 rounded-full bg-[#4A5D23]/10 flex items-center justify-center text-[#4A5D23] mr-4">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>
                        </div>
                        <span class="font-medium text-sm">{{ $setting->email ?? 'Email belum diatur' }}</span>
                    </div>
                    
                    <!-- Tambahkan ini jika ingin nomor HP muncul -->
                    @if($setting->phone)
                    <div class="flex items-center text-gray-600">
                        <div class="w-10 h-10 rounded-full bg-[#4A5D23]/10 flex items-center justify-center text-[#4A5D23] mr-4">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path></svg>
                        </div>
                        <span class="font-medium text-sm">{{ $setting->phone }}</span>
                    </div>
                    @endif
                </div>
            </div>

            <!-- Form -->
            <div class="bg-white p-8 rounded-2xl border border-gray-100 shadow-[0_2px_10px_rgb(0,0,0,0.02)]">
                
                <!-- Notifikasi Berhasil -->
                @if(session('success'))
                    <div class="mb-6 p-4 bg-green-50 border border-green-200 text-green-700 rounded-xl text-sm font-bold flex items-center shadow-sm">
                        <svg class="w-5 h-5 mr-3 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                        {{ session('success') }}
                    </div>
                @endif

                <form action="{{ route('message.store') }}" method="POST">
                    @csrf
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                        <div>
                            <label for="name" class="block text-xs font-bold text-gray-700 mb-2 uppercase tracking-wide">Nama Anda</label>
                            <input type="text" name="name" id="name" required placeholder="Budi Santoso"
                                class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:border-[#4A5D23] focus:ring focus:ring-[#4A5D23]/20 transition outline-none text-sm font-medium">
                        </div>
                        <div>
                            <label for="email" class="block text-xs font-bold text-gray-700 mb-2 uppercase tracking-wide">Email</label>
                            <input type="email" name="email" id="email" required placeholder="budi@email.com"
                                class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:border-[#4A5D23] focus:ring focus:ring-[#4A5D23]/20 transition outline-none text-sm font-medium">
                        </div>
                    </div>

                    <div class="mb-4">
                        <label for="subject" class="block text-xs font-bold text-gray-700 mb-2 uppercase tracking-wide">Subjek (Opsional)</label>
                        <input type="text" name="subject" id="subject" placeholder="Misal: Reservasi Tempat"
                            class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:border-[#4A5D23] focus:ring focus:ring-[#4A5D23]/20 transition outline-none text-sm font-medium">
                    </div>

                    <div class="mb-6">
                        <label for="content" class="block text-xs font-bold text-gray-700 mb-2 uppercase tracking-wide">Pesan Anda</label>
                        <textarea name="content" id="content" rows="4" required placeholder="Tuliskan pesan Anda di sini..."
                            class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:border-[#4A5D23] focus:ring focus:ring-[#4A5D23]/20 transition outline-none text-sm font-medium"></textarea>
                    </div>

                    <button type="submit" class="w-full px-6 py-3 bg-[#4A5D23] text-white text-sm font-bold rounded-xl hover:bg-[#3b4b1c] transition shadow-md">
                        Kirim Pesan
                    </button>
                </form>
            </div>
            
        </div>
    </section>
@endsection