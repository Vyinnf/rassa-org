@extends('layouts.admin')

@section('title', 'Manajemen Menu')
@section('header', 'Daftar Menu Kafe')

@section('content')

<!-- Notifikasi Sukses -->
@if(session('success'))
<div
    class="mb-6 p-4 bg-green-50 border border-green-200 text-green-700 rounded-xl text-sm font-medium flex items-center shadow-sm animate-fade-in-up">
    <svg class="w-5 h-5 mr-3 text-green-500 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
            d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
    </svg>
    {{ session('success') }}
</div>
@endif

<div class="mb-6 flex flex-col sm:flex-row sm:justify-between sm:items-center gap-3">
    <p class="text-sm text-gray-500 font-medium">Kelola daftar minuman, makanan, dan ketersediaan stok di sini.</p>

    <a href="{{ route('admin.menus.create') }}"
        class="group w-full sm:w-auto justify-center px-5 py-2.5 bg-[#4A5D23] text-white text-sm font-semibold rounded-xl hover:bg-[#3b4b1c] hover:shadow-lg hover:-translate-y-0.5 active:translate-y-0 active:scale-[0.98] transition-all duration-200 shadow-md flex items-center">
        <svg class="w-4 h-4 mr-2 transition-transform duration-200 group-hover:rotate-90" fill="none"
            stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
        </svg>
        Tambah Menu
    </a>
</div>

<!-- ================================== -->
<!-- TAMPILAN KARTU (MOBILE, di bawah md) -->
<!-- ================================== -->
<div class="md:hidden space-y-3">
    @forelse ($menus as $menu)
    <div class="bg-white rounded-2xl border border-gray-100 shadow-[0_2px_10px_rgb(0,0,0,0.02)] p-4 hover:shadow-md transition-shadow duration-300 animate-fade-in-up"
        style="animation-delay: {{ $loop->index * 40 }}ms">
        <div class="flex items-start gap-3">
            @if($menu->image)
            <img src="{{ asset('storage/' . $menu->image) }}" alt="{{ $menu->name }}"
                class="w-12 h-12 rounded-lg object-cover border border-gray-200 flex-shrink-0">
            @else
            <div
                class="w-12 h-12 rounded-lg bg-gray-100 border border-gray-200 flex items-center justify-center flex-shrink-0 text-gray-400">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z">
                    </path>
                </svg>
            </div>
            @endif

            <div class="min-w-0 flex-1">
                <div class="flex items-start justify-between gap-2">
                    <span class="font-semibold text-gray-900 leading-snug">{{ $menu->name }}</span>
                    @if($menu->is_available)
                    <span
                        class="flex-shrink-0 px-2.5 py-1 bg-green-100 text-green-700 rounded-full text-[11px] font-bold tracking-wide">
                        Tersedia
                    </span>
                    @else
                    <span
                        class="flex-shrink-0 px-2.5 py-1 bg-red-100 text-red-700 rounded-full text-[11px] font-bold tracking-wide">
                        Habis
                    </span>
                    @endif
                </div>
                <p class="text-xs text-gray-500 font-medium mt-0.5">{{ $menu->category }}</p>
                <p class="text-sm font-semibold text-gray-900 mt-1">Rp {{ number_format($menu->price, 0, ',', '.') }}
                </p>
            </div>
        </div>

        <div class="mt-3 pt-3 border-t border-gray-100 flex items-center gap-5">
            <a href="{{ route('admin.menus.edit', $menu->id) }}"
                class="text-blue-600 hover:text-blue-800 active:scale-95 font-bold text-sm transition-colors duration-200">Edit</a>
            <form action="{{ route('admin.menus.destroy', $menu->id) }}" method="POST" class="inline-block">
                @csrf
                @method('DELETE')
                <button type="submit"
                    class="text-red-600 hover:text-red-800 active:scale-95 font-bold text-sm transition-colors duration-200"
                    onclick="return confirm('Yakin ingin menghapus menu ini secara permanen?')">Hapus</button>
            </form>
        </div>
    </div>
    @empty
    <div
        class="bg-white rounded-2xl border border-gray-100 shadow-[0_2px_10px_rgb(0,0,0,0.02)] px-6 py-12 text-center text-gray-400 animate-fade-in-up">
        <svg class="mx-auto h-12 w-12 text-gray-300 mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                d="M12 6V4m0 2a2 2 0 100 4m0-4a2 2 0 110 4m-6 8a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4m6 6v10m6-2a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4">
            </path>
        </svg>
        <span class="block font-medium text-gray-500">Belum ada daftar menu kafe.</span>
        <span class="block text-xs mt-1">Klik "Tambah Menu" untuk mulai memasukkan data.</span>
    </div>
    @endforelse
</div>

<!-- ================================== -->
<!-- TAMPILAN TABEL (DESKTOP/TABLET, md ke atas) -->
<!-- ================================== -->
<div
    class="hidden md:block bg-white rounded-2xl border border-gray-100 shadow-[0_2px_10px_rgb(0,0,0,0.02)] overflow-hidden">
    <div class="overflow-x-auto">
        <table class="w-full text-left text-sm whitespace-nowrap">
            <thead class="bg-gray-50 border-b border-gray-100 uppercase text-xs font-bold text-gray-800 tracking-wider">
                <tr>
                    <th class="px-6 py-4">Nama Menu</th>
                    <th class="px-6 py-4">Kategori</th>
                    <th class="px-6 py-4">Harga</th>
                    <th class="px-6 py-4">Status</th>
                    <th class="px-6 py-4 text-right">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-100 text-gray-700">

                @forelse ($menus as $menu)
                <tr class="hover:bg-gray-50/80 transition-colors duration-200 animate-fade-in"
                    style="animation-delay: {{ $loop->index * 40 }}ms">
                    <td class="px-6 py-4">
                        <div class="flex items-center">
                            @if($menu->image)
                            <img src="{{ asset('storage/' . $menu->image) }}" alt="{{ $menu->name }}"
                                class="w-10 h-10 rounded-lg object-cover border border-gray-200 mr-3">
                            @else
                            <div
                                class="w-10 h-10 rounded-lg bg-gray-100 border border-gray-200 flex items-center justify-center mr-3 text-gray-400">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z">
                                    </path>
                                </svg>
                            </div>
                            @endif
                            <span class="font-semibold text-gray-900">{{ $menu->name }}</span>
                        </div>
                    </td>
                    <td class="px-6 py-4 font-medium">
                        {{ $menu->category }}
                    </td>
                    <td class="px-6 py-4 font-semibold text-gray-900">
                        Rp {{ number_format($menu->price, 0, ',', '.') }}
                    </td>
                    <td class="px-6 py-4">
                        @if($menu->is_available)
                        <span
                            class="px-3 py-1 bg-green-100 text-green-700 rounded-full text-xs font-bold tracking-wide">
                            Tersedia
                        </span>
                        @else
                        <span class="px-3 py-1 bg-red-100 text-red-700 rounded-full text-xs font-bold tracking-wide">
                            Habis
                        </span>
                        @endif
                    </td>
                    <td class="px-6 py-4 text-right space-x-3">
                        <a href="{{ route('admin.menus.edit', $menu->id) }}"
                            class="text-blue-600 hover:text-blue-800 active:scale-95 font-bold transition-colors duration-200 inline-block">Edit</a>
                        <form action="{{ route('admin.menus.destroy', $menu->id) }}" method="POST" class="inline-block">
                            @csrf
                            @method('DELETE')
                            <button type="submit"
                                class="text-red-600 hover:text-red-800 active:scale-95 font-bold transition-colors duration-200"
                                onclick="return confirm('Yakin ingin menghapus menu ini secara permanen?')">Hapus</button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="px-6 py-12 text-center text-gray-400">
                        <svg class="mx-auto h-12 w-12 text-gray-300 mb-3" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                d="M12 6V4m0 2a2 2 0 100 4m0-4a2 2 0 110 4m-6 8a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4m6 6v10m6-2a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4">
                            </path>
                        </svg>
                        <span class="block font-medium text-gray-500">Belum ada daftar menu kafe.</span>
                        <span class="block text-xs mt-1">Klik "Tambah Menu" untuk mulai memasukkan data.</span>
                    </td>
                </tr>
                @endforelse

            </tbody>
        </table>
    </div>
</div>
@endsection