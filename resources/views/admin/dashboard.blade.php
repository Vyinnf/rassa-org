@extends('layouts.admin')

@section('title', 'Ringkasan')
@section('header', 'Ringkasan Dashboard')

@section('content')
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
        
        <!-- Card 1: Total Berita -->
        <div class="bg-white p-6 rounded-2xl border border-gray-100 shadow-sm flex items-center">
            <div class="w-14 h-14 rounded-full bg-[#4A5D23]/10 flex items-center justify-center text-[#4A5D23] mr-5">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"></path></svg>
            </div>
            <div>
                <div class="text-sm text-gray-500 font-medium mb-1">Total Berita</div>
                <div class="text-2xl font-bold text-gray-900">{{ $totalArticles }}</div>
            </div>
        </div>

        <!-- Card 2: Total Menu -->
        <div class="bg-white p-6 rounded-2xl border border-gray-100 shadow-sm flex items-center">
            <div class="w-14 h-14 rounded-full bg-[#4A5D23]/10 flex items-center justify-center text-[#4A5D23] mr-5">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6V4m0 2a2 2 0 100 4m0-4a2 2 0 110 4m-6 8a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4m6 6v10m6-2a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4"></path></svg>
            </div>
            <div>
                <div class="text-sm text-gray-500 font-medium mb-1">Total Menu</div>
                <div class="text-2xl font-bold text-gray-900">{{ $totalMenus }}</div>
            </div>
        </div>

        <!-- Card 3: Total Pengguna -->
        <div class="bg-white p-6 rounded-2xl border border-gray-100 shadow-sm flex items-center">
            <div class="w-14 h-14 rounded-full bg-[#4A5D23]/10 flex items-center justify-center text-[#4A5D23] mr-5">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path></svg>
            </div>
            <div>
                <div class="text-sm text-gray-500 font-medium mb-1">Total Pengguna</div>
                <div class="text-2xl font-bold text-gray-900">{{ $totalUsers }}</div>
            </div>
        </div>

        <!-- Card 4: Pesan Baru (Unread) -->
        <a href="{{ route('admin.messages.index') }}" class="bg-white p-6 rounded-2xl border border-gray-100 shadow-sm flex items-center hover:shadow-md transition cursor-pointer group">
            <!-- Warna ikon dibuat biru agar sedikit berbeda dan menarik perhatian -->
            <div class="w-14 h-14 rounded-full bg-blue-50 flex items-center justify-center text-blue-500 mr-5 group-hover:bg-blue-100 transition">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>
            </div>
            <div>
                <div class="text-sm text-gray-500 font-medium mb-1">Pesan Baru</div>
                <div class="text-2xl font-bold text-gray-900">
                    {{ $unreadMessages }}
                    @if($unreadMessages > 0)
                        <span class="inline-flex relative h-3 w-3 ml-1 align-top">
                            <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-red-400 opacity-75"></span>
                            <span class="relative inline-flex rounded-full h-3 w-3 bg-red-500"></span>
                        </span>
                    @endif
                </div>
            </div>
        </a>

    </div>

    <!-- Welcome Section -->
    <div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-8 text-center">
        <h2 class="text-lg font-bold text-gray-800 mb-2">Selamat Datang di Sistem Rassa.org!</h2>
        <p class="text-gray-500 text-sm">Pilih menu di sebelah kiri untuk mulai mengelola konten website kafe Anda.</p>
    </div>
@endsection