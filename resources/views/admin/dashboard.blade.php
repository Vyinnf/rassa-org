@extends('layouts.admin')

@section('title', 'Ringkasan')
@section('header', 'Ringkasan Dashboard')

@section('content')
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
        
        <!-- Card 1: Total Berita -->
        <div class="bg-white p-6 rounded-2xl border border-gray-100 shadow-sm flex items-center">
            <div class="w-14 h-14 rounded-full bg-[#4A5D23]/10 flex items-center justify-center text-[#4A5D23] mr-5">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"></path></svg>
            </div>
            <div>
                <div class="text-sm text-gray-500 font-medium mb-1">Total Berita</div>
                <div class="text-2xl font-bold text-gray-900">0</div>
            </div>
        </div>

        <!-- Card 2: Total Menu -->
        <div class="bg-white p-6 rounded-2xl border border-gray-100 shadow-sm flex items-center">
            <div class="w-14 h-14 rounded-full bg-[#4A5D23]/10 flex items-center justify-center text-[#4A5D23] mr-5">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6V4m0 2a2 2 0 100 4m0-4a2 2 0 110 4m-6 8a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4m6 6v10m6-2a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4"></path></svg>
            </div>
            <div>
                <div class="text-sm text-gray-500 font-medium mb-1">Menu Kafe</div>
                <div class="text-2xl font-bold text-gray-900">0</div>
            </div>
        </div>

    </div>

    <div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-8 text-center">
        <h2 class="text-lg font-bold text-gray-800 mb-2">Selamat Datang di Sistem Rassa.org!</h2>
        <p class="text-gray-500 text-sm">Pilih menu di sebelah kiri untuk mulai mengelola konten website kafe Anda.</p>
    </div>
@endsection