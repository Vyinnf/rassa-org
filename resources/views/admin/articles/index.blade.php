@extends('layouts.admin')

@section('title', 'Manajemen Berita')
@section('header', 'Daftar Berita / Artikel')

@section('content')

<!-- Notifikasi Sukses -->
@if(session('success'))
<div
    class="mb-6 p-4 bg-green-50 border border-green-200 text-green-700 rounded-xl text-sm font-medium flex items-center animate-fade-in-up">
    <svg class="w-5 h-5 mr-3 text-green-500 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
            d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
    </svg>
    {{ session('success') }}
</div>
@endif

<div class="mb-6 flex flex-col sm:flex-row sm:justify-between sm:items-center gap-3">
    <p class="text-sm text-gray-500">Kelola semua artikel dan berita untuk pengunjung rassa.org di sini.</p>

    <a href="{{ route('admin.articles.create') }}"
        class="group w-full sm:w-auto justify-center px-5 py-2.5 bg-[#4A5D23] text-white text-sm font-semibold rounded-xl hover:bg-[#3b4b1c] hover:shadow-md hover:-translate-y-0.5 active:translate-y-0 active:scale-[0.98] transition-all duration-200 shadow-sm flex items-center">
        <svg class="w-4 h-4 mr-2 transition-transform duration-200 group-hover:rotate-90" fill="none"
            stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
        </svg>
        Tambah Berita
    </a>
</div>

<!-- ================================== -->
<!-- TAMPILAN KARTU (MOBILE, di bawah md) -->
<!-- ================================== -->
<div class="md:hidden space-y-3">
    @forelse ($articles as $article)
    <div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-4 hover:shadow-md transition-shadow duration-300 animate-fade-in-up"
        style="animation-delay: {{ $loop->index * 40 }}ms">
        <p class="font-semibold text-gray-900 leading-snug">{{ $article->title }}</p>
        <div class="mt-2.5 flex items-center gap-2 flex-wrap">
            <span class="px-2.5 py-1 bg-gray-100 text-gray-600 rounded-lg text-xs font-medium">
                {{ $article->user->name }}
            </span>
            <span class="text-xs text-gray-400">
                {{ $article->created_at->translatedFormat('d F Y') }}
            </span>
        </div>
        <div class="mt-3 pt-3 border-t border-gray-100 flex items-center gap-5">
            <a href="{{ route('admin.articles.edit', $article->id) }}"
                class="text-blue-600 hover:text-blue-800 active:scale-95 font-medium text-sm transition-colors duration-200">Edit</a>
            <form action="{{ route('admin.articles.destroy', $article->id) }}" method="POST" class="inline-block">
                @csrf
                @method('DELETE')
                <button type="submit"
                    class="text-red-600 hover:text-red-800 active:scale-95 font-medium text-sm transition-colors duration-200"
                    onclick="return confirm('Yakin ingin menghapus berita ini?')">Hapus</button>
            </form>
        </div>
    </div>
    @empty
    <div
        class="bg-white rounded-2xl border border-gray-100 shadow-sm px-6 py-12 text-center text-gray-400 animate-fade-in-up">
        <svg class="mx-auto h-12 w-12 text-gray-300 mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z">
            </path>
        </svg>
        <span class="block font-medium">Belum ada berita yang diterbitkan.</span>
        <span class="block text-xs mt-1">Klik "Tambah Berita" untuk memulai.</span>
    </div>
    @endforelse
</div>

<!-- ================================== -->
<!-- TAMPILAN TABEL (DESKTOP/TABLET, md ke atas) -->
<!-- ================================== -->
<div class="hidden md:block bg-white rounded-2xl border border-gray-100 shadow-sm overflow-hidden">
    <div class="overflow-x-auto">
        <table class="w-full text-left text-sm whitespace-nowrap">
            <thead
                class="bg-gray-50/80 border-b border-gray-100 uppercase text-xs font-semibold text-gray-500 tracking-wider">
                <tr>
                    <th class="px-6 py-4">Judul Berita</th>
                    <th class="px-6 py-4">Penulis</th>
                    <th class="px-6 py-4">Tanggal Dibuat</th>
                    <th class="px-6 py-4 text-right">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-100 text-gray-700">

                @forelse ($articles as $article)
                <tr class="hover:bg-gray-50/50 transition-colors duration-200 animate-fade-in"
                    style="animation-delay: {{ $loop->index * 40 }}ms">
                    <td class="px-6 py-4 font-medium text-gray-900">
                        {{ $article->title }}
                    </td>
                    <td class="px-6 py-4">
                        <span class="px-3 py-1 bg-gray-100 text-gray-600 rounded-lg text-xs font-medium">
                            {{ $article->user->name }}
                        </span>
                    </td>
                    <td class="px-6 py-4 text-gray-500">
                        {{ $article->created_at->translatedFormat('d F Y') }}
                    </td>
                    <td class="px-6 py-4 text-right space-x-2">
                        <a href="{{ route('admin.articles.edit', $article->id) }}"
                            class="text-blue-600 hover:text-blue-800 active:scale-95 font-medium transition-colors duration-200 inline-block">Edit</a>
                        <form action="{{ route('admin.articles.destroy', $article->id) }}" method="POST"
                            class="inline-block">
                            @csrf
                            @method('DELETE')
                            <button type="submit"
                                class="text-red-600 hover:text-red-800 active:scale-95 font-medium transition-colors duration-200"
                                onclick="return confirm('Yakin ingin menghapus berita ini?')">Hapus</button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="4" class="px-6 py-12 text-center text-gray-400">
                        <svg class="mx-auto h-12 w-12 text-gray-300 mb-3" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z">
                            </path>
                        </svg>
                        <span class="block font-medium">Belum ada berita yang diterbitkan.</span>
                        <span class="block text-xs mt-1">Klik "Tambah Berita" untuk memulai.</span>
                    </td>
                </tr>
                @endforelse

            </tbody>
        </table>
    </div>
</div>
@endsection