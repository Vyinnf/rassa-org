@extends('layouts.admin')

@section('title', 'Ringkasan')
@section('header', 'Ringkasan Dashboard')

@section('content')

    <!-- 1. Statistik Utama (Row 1) -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
        
        <!-- Statistik Card Component -->
        @php
            $stats = [
                ['label' => 'Total Berita', 'value' => $totalArticles, 'icon' => 'M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z', 'color' => 'text-[#4A5D23]'],
                ['label' => 'Total Menu', 'value' => $totalMenus, 'icon' => 'M12 6V4m0 2a2 2 0 100 4m0-4a2 2 0 110 4m-6 8a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4m6 6v10m6-2a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4', 'color' => 'text-[#4A5D23]'],
                ['label' => 'Total Pengguna', 'value' => $totalUsers, 'icon' => 'M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z', 'color' => 'text-[#4A5D23]'],
                ['label' => 'Pesan Baru', 'value' => $unreadMessages, 'icon' => 'M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z', 'color' => 'text-blue-500'],
            ];
        @endphp

        @foreach($stats as $stat)
        <div class="bg-white p-6 rounded-2xl border border-gray-100 shadow-sm flex items-center hover:shadow-md hover:border-[#4A5D23]/30 transition-all duration-300 transform hover:scale-[1.02]">
            <div class="w-14 h-14 rounded-full bg-gray-50 flex items-center justify-center {{ $stat['color'] }} mr-5">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="{{ $stat['icon'] }}"></path></svg>
            </div>
            <div>
                <div class="text-sm text-gray-500 font-medium mb-1">{{ $stat['label'] }}</div>
                <div class="text-2xl font-bold text-gray-900">{{ $stat['value'] }}</div>
            </div>
        </div>
        @endforeach
    </div>

    <!-- 2. Konten Utama (Row 2) -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 mb-8">
        
        <!-- Left: Berita Terbaru (2/3 width) -->
        <div class="lg:col-span-2 bg-white rounded-2xl border border-gray-100 shadow-sm overflow-hidden hover:shadow-md transition-all duration-300">
            <div class="p-6 border-b border-gray-100 flex justify-between items-center">
                <h3 class="font-bold text-gray-800">Berita Terbaru</h3>
                <a href="{{ route('admin.articles.index') }}" class="text-xs font-bold text-[#4A5D23] hover:underline">Lihat Semua</a>
            </div>
            <div class="overflow-x-auto">
                <table class="w-full text-sm">
                    <tbody class="divide-y divide-gray-50">
                        @forelse($recentArticles as $article)
                        <tr class="hover:bg-gray-50/50 transition">
                            <td class="px-6 py-4 font-medium text-gray-700">{{ $article->title }}</td>
                            <td class="px-6 py-4 text-right text-gray-400 text-xs">{{ $article->created_at->diffForHumans() }}</td>
                        </tr>
                        @empty
                        <tr><td colspan="2" class="px-6 py-4 text-center text-gray-400">Tidak ada berita.</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Right: Aksi & Pesan (1/3 width) -->
        <div class="space-y-6">
            <!-- Aksi Cepat -->
            <div class="bg-white p-6 rounded-2xl border border-gray-100 shadow-sm hover:shadow-md transition-all duration-300">
                <h3 class="font-bold text-gray-800 mb-4">Aksi Cepat</h3>
                <div class="space-y-3">
                    <a href="{{ route('admin.articles.create') }}" class="flex justify-center items-center w-full px-4 py-3 bg-[#4A5D23] text-white rounded-xl font-bold hover:bg-[#3b4b1c] hover:shadow-lg transition text-sm">
                        + Buat Berita Baru
                    </a>
                    <a href="{{ route('admin.menus.create') }}" class="flex justify-center items-center w-full px-4 py-3 bg-gray-100 text-gray-700 rounded-xl font-bold hover:bg-gray-200 transition text-sm">
                        + Tambah Menu Kafe
                    </a>
                </div>
            </div>

            <!-- Pesan Terakhir -->
            <div class="bg-white p-6 rounded-2xl border border-gray-100 shadow-sm hover:shadow-md transition-all duration-300">
                <h3 class="font-bold text-gray-800 mb-4">Pesan Masuk</h3>
                <div class="space-y-4">
                    @forelse($recentMessages as $msg)
                    <div class="text-sm p-3 rounded-xl bg-gray-50 hover:bg-gray-100 transition">
                        <p class="font-bold text-gray-800">{{ $msg->name }}</p>
                        <p class="text-gray-500 truncate">{{ $msg->message }}</p>
                    </div>
                    @empty
                    <p class="text-gray-400 text-sm">Tidak ada pesan baru.</p>
                    @endforelse
                </div>
            </div>
        </div>
    </div>

    <!-- 3. Footer Welcome -->
    <div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-8 text-center hover:border-[#4A5D23]/20 transition-all duration-300">
        <h2 class="text-lg font-bold text-gray-800 mb-2">Selamat Datang di Sistem Rassa.org!</h2>
        <p class="text-gray-500 text-sm">Pilih menu di sebelah kiri untuk mulai mengelola konten website kafe Anda.</p>
    </div>

@endsection