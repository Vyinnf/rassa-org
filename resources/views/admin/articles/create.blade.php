@extends('layouts.admin')

@section('title', 'Tambah Berita')
@section('header', 'Tulis Berita Baru')

@section('content')
    <div class="mb-6 flex items-center justify-between">
        <a href="{{ route('admin.articles.index') }}" class="text-sm font-medium text-gray-500 hover:text-[#4A5D23] transition flex items-center">
            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
            Kembali ke Daftar
        </a>
    </div>

    <div class="bg-white rounded-2xl border border-gray-100 shadow-sm overflow-hidden max-w-3xl">
        <!-- Perhatikan enctype="multipart/form-data", ini WAJIB ada kalau mau upload file/foto -->
        <form action="{{ route('admin.articles.store') }}" method="POST" enctype="multipart/form-data" class="p-8">
            @csrf

            <!-- Input Judul -->
            <div class="mb-6">
                <label for="title" class="block text-sm font-semibold text-gray-700 mb-2">Judul Berita</label>
                <input type="text" name="title" id="title" required value="{{ old('title') }}" placeholder="Contoh: Promo Spesial Kopi Susu Rassa"
                    class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:border-[#4A5D23] focus:ring focus:ring-[#4A5D23]/20 transition outline-none text-sm">
                @error('title') <span class="text-xs text-red-500 mt-1 block">{{ $message }}</span> @enderror
            </div>

            <!-- Input Konten -->
            <div class="mb-6">
                <label for="content" class="block text-sm font-semibold text-gray-700 mb-2">Isi Berita</label>
                <textarea name="content" id="content" rows="6" required placeholder="Tulis isi berita di sini..."
                    class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:border-[#4A5D23] focus:ring focus:ring-[#4A5D23]/20 transition outline-none text-sm">{{ old('content') }}</textarea>
                @error('content') <span class="text-xs text-red-500 mt-1 block">{{ $message }}</span> @enderror
            </div>

            <!-- Input Foto Thumbnail -->
            <div class="mb-8">
                <label for="image" class="block text-sm font-semibold text-gray-700 mb-2">Foto / Thumbnail (Opsional)</label>
                <input type="file" name="image" id="image" accept="image/*"
                    class="block w-full text-sm text-gray-500 file:mr-4 file:py-2.5 file:px-4 file:rounded-xl file:border-0 file:text-sm file:font-semibold file:bg-[#4A5D23]/10 file:text-[#4A5D23] hover:file:bg-[#4A5D23]/20 transition cursor-pointer border border-gray-200 rounded-xl">
                @error('image') <span class="text-xs text-red-500 mt-1 block">{{ $message }}</span> @enderror
            </div>

            <!-- Tombol Submit -->
            <div class="flex justify-end">
                <button type="submit" class="px-6 py-3 bg-[#4A5D23] text-white text-sm font-semibold rounded-xl hover:bg-[#3b4b1c] transition shadow-md">
                    Terbitkan Berita
                </button>
            </div>
        </form>
    </div>
@endsection