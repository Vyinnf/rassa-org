@extends('layouts.admin')

@section('title', 'Manajemen Pengguna')
@section('header', 'Daftar Akun Terdaftar')

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

<!-- Notifikasi Error -->
@if(session('error'))
<div
    class="mb-6 p-4 bg-red-50 border border-red-200 text-red-700 rounded-xl text-sm font-medium flex items-center shadow-sm animate-fade-in-up">
    <svg class="w-5 h-5 mr-3 text-red-500 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
            d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
    </svg>
    {{ session('error') }}
</div>
@endif

<div class="mb-6">
    <p class="text-sm text-gray-500 font-medium">Pantau dan kelola hak akses akun yang dapat masuk ke dalam dashboard
        pengurus Rassa.org.</p>
</div>

<!-- ================================== -->
<!-- TAMPILAN KARTU (MOBILE, di bawah md) -->
<!-- ================================== -->
<div class="md:hidden space-y-3">
    @forelse ($users as $user)
    <div class="bg-white rounded-2xl border border-gray-100 shadow-[0_2px_10px_rgb(0,0,0,0.02)] p-4 hover:shadow-md transition-shadow duration-300 animate-fade-in-up"
        style="animation-delay: {{ $loop->index * 40 }}ms">
        <div class="flex items-center gap-3">
            <div
                class="w-10 h-10 rounded-full bg-[#4A5D23]/10 text-[#4A5D23] font-bold flex items-center justify-center uppercase shadow-sm flex-shrink-0">
                {{ substr($user->name, 0, 1) }}
            </div>
            <div class="min-w-0 flex-1">
                <p class="font-semibold text-gray-900 truncate">{{ $user->name }}</p>
                <p class="text-xs text-gray-500 truncate">{{ $user->email }}</p>
            </div>
            @if($user->role === 'admin')
            <span
                class="flex-shrink-0 px-2.5 py-1 bg-[#4A5D23]/10 text-[#4A5D23] rounded-full text-[11px] font-bold tracking-wide">Administrator</span>
            @else
            <span
                class="flex-shrink-0 px-2.5 py-1 bg-gray-100 text-gray-600 rounded-full text-[11px] font-bold tracking-wide">Pengunjung</span>
            @endif
        </div>

        <div class="mt-3 flex items-center gap-4 text-xs text-gray-500">
            <span>Poin: <span class="font-bold text-[#4A5D23]">{{ $user->points }}</span></span>
            <span>Bergabung {{ $user->created_at->format('d M Y') }}</span>
        </div>

        <div class="mt-3 pt-3 border-t border-gray-100">
            @if(auth()->id() === $user->id)
            <span class="text-gray-400 font-medium italic text-xs px-3 py-1 bg-gray-50 rounded-lg inline-block">Akun
                Anda</span>
            @else
            <!-- Form Tambah Poin (Khusus Customer) -->
            @if($user->role === 'customer')
            <form action="{{ route('admin.users.add-points', $user->id) }}" method="POST" class="mb-2">
                @csrf
                <div class="flex items-center gap-2">
                    <input type="number" name="points" placeholder="50"
                        class="w-20 px-2 py-1.5 border border-gray-200 rounded-lg text-xs focus:ring-2 focus:ring-[#4A5D23] outline-none transition-shadow duration-200"
                        required>
                    <button type="submit"
                        class="text-xs bg-[#4A5D23] text-white px-3 py-1.5 rounded-lg hover:bg-[#3b4b1c] active:scale-95 transition-all duration-200 font-bold">+
                        Poin</button>
                </div>
            </form>
            @endif

            <!-- Tombol Hapus -->
            <form action="{{ route('admin.users.destroy', $user->id) }}" method="POST" class="inline-block">
                @csrf
                @method('DELETE')
                <button type="submit"
                    class="text-red-600 hover:text-red-800 active:scale-95 font-bold transition-all duration-200 px-3 py-1.5 hover:bg-red-50 rounded-lg text-xs"
                    onclick="return confirm('Peringatan: Hapus akun ini?')">Hapus Akses</button>
            </form>
            @endif
        </div>
    </div>
    @empty
    <div
        class="bg-white rounded-2xl border border-gray-100 shadow-[0_2px_10px_rgb(0,0,0,0.02)] px-6 py-12 text-center text-gray-400 animate-fade-in-up">
        <span class="block font-medium text-gray-500">Belum ada akun yang terdaftar.</span>
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
                    <th class="px-6 py-4">Pengguna</th>
                    <th class="px-6 py-4">Alamat Email</th>
                    <th class="px-6 py-4">Peran (Role)</th>
                    <th class="px-6 py-4">Poin</th>
                    <th class="px-6 py-4">Tanggal Bergabung</th>
                    <th class="px-6 py-4 text-right">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-100 text-gray-700">

                @forelse ($users as $user)
                <tr class="hover:bg-gray-50/80 transition-colors duration-200 animate-fade-in"
                    style="animation-delay: {{ $loop->index * 40 }}ms">
                    <!-- Kolom Pengguna -->
                    <td class="px-6 py-4">
                        <div class="flex items-center">
                            <div
                                class="w-10 h-10 rounded-full bg-[#4A5D23]/10 text-[#4A5D23] font-bold flex items-center justify-center mr-3 uppercase shadow-sm">
                                {{ substr($user->name, 0, 1) }}
                            </div>
                            <span class="font-semibold text-gray-900">{{ $user->name }}</span>
                        </div>
                    </td>

                    <!-- Kolom Email -->
                    <td class="px-6 py-4 font-medium">{{ $user->email }}</td>

                    <!-- Kolom Role -->
                    <td class="px-6 py-4">
                        @if($user->role === 'admin')
                        <span
                            class="px-3 py-1 bg-[#4A5D23]/10 text-[#4A5D23] rounded-full text-xs font-bold tracking-wide">Administrator</span>
                        @else
                        <span
                            class="px-3 py-1 bg-gray-100 text-gray-600 rounded-full text-xs font-bold tracking-wide">Pengunjung</span>
                        @endif
                    </td>

                    <!-- Kolom Poin -->
                    <td class="px-6 py-4 font-bold text-[#4A5D23]">
                        {{ $user->points }}
                    </td>

                    <!-- Kolom Tanggal -->
                    <td class="px-6 py-4 font-medium text-gray-500">
                        {{ $user->created_at->format('d M Y') }}
                    </td>

                    <!-- Kolom Aksi -->
                    <td class="px-6 py-4 text-right">
                        @if(auth()->id() === $user->id)
                        <span class="text-gray-400 font-medium italic text-xs px-3 py-1 bg-gray-50 rounded-lg">Akun
                            Anda</span>
                        @else
                        <!-- Form Tambah Poin (Khusus Customer) -->
                        @if($user->role === 'customer')
                        <form action="{{ route('admin.users.add-points', $user->id) }}" method="POST" class="mb-2">
                            @csrf
                            <div class="flex items-center justify-end space-x-2">
                                <input type="number" name="points" placeholder="50"
                                    class="w-16 px-2 py-1 border border-gray-200 rounded-lg text-xs focus:ring-2 focus:ring-[#4A5D23] outline-none transition-shadow duration-200"
                                    required>
                                <button type="submit"
                                    class="text-xs bg-[#4A5D23] text-white px-2 py-1 rounded-lg hover:bg-[#3b4b1c] active:scale-95 transition-all duration-200 font-bold">+
                                    Poin</button>
                            </div>
                        </form>
                        @endif

                        <!-- Tombol Hapus -->
                        <form action="{{ route('admin.users.destroy', $user->id) }}" method="POST" class="inline-block">
                            @csrf
                            @method('DELETE')
                            <button type="submit"
                                class="text-red-600 hover:text-red-800 active:scale-95 font-bold transition-all duration-200 px-3 py-1 hover:bg-red-50 rounded-lg text-xs"
                                onclick="return confirm('Peringatan: Hapus akun ini?')">Hapus Akses</button>
                        </form>
                        @endif
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" class="px-6 py-12 text-center text-gray-400">
                        <span class="block font-medium text-gray-500">Belum ada akun yang terdaftar.</span>
                    </td>
                </tr>
                @endforelse

            </tbody>
        </table>
    </div>
</div>
@endsection