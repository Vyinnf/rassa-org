@extends('layouts.admin')

@section('title', 'Manajemen Pengguna')
@section('header', 'Daftar Akun Terdaftar')

@section('content')

    <!-- Notifikasi Sukses -->
    @if(session('success'))
        <div class="mb-6 p-4 bg-green-50 border border-green-200 text-green-700 rounded-xl text-sm font-medium flex items-center shadow-sm">
            <svg class="w-5 h-5 mr-3 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
            {{ session('success') }}
        </div>
    @endif

    <!-- Notifikasi Error (Jika mencoba menghapus diri sendiri) -->
    @if(session('error'))
        <div class="mb-6 p-4 bg-red-50 border border-red-200 text-red-700 rounded-xl text-sm font-medium flex items-center shadow-sm">
            <svg class="w-5 h-5 mr-3 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
            {{ session('error') }}
        </div>
    @endif

    <div class="mb-6">
        <p class="text-sm text-gray-500 font-medium">Pantau dan kelola hak akses akun yang dapat masuk ke dalam dashboard pengurus Rassa.org.</p>
    </div>

    <!-- Tabel Pengguna Minimalis -->
    <div class="bg-white rounded-2xl border border-gray-100 shadow-[0_2px_10px_rgb(0,0,0,0.02)] overflow-hidden">
        <table class="w-full text-left text-sm whitespace-nowrap">
            <thead class="bg-gray-50 border-b border-gray-100 uppercase text-xs font-bold text-gray-800 tracking-wider">
                <tr>
                    <th class="px-6 py-4">Pengguna</th>
                    <th class="px-6 py-4">Alamat Email</th>
                    <th class="px-6 py-4">Peran (Role)</th>
                    <th class="px-6 py-4">Tanggal Bergabung</th>
                    <th class="px-6 py-4 text-right">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-100 text-gray-700">
                
                @forelse ($users as $user)
                    <tr class="hover:bg-gray-50/80 transition">
                        <td class="px-6 py-4">
                            <div class="flex items-center">
                                <!-- Avatar Inisial -->
                                <div class="w-10 h-10 rounded-full bg-[#4A5D23]/10 text-[#4A5D23] font-bold flex items-center justify-center mr-3 uppercase shadow-sm">
                                    {{ substr($user->name, 0, 1) }}
                                </div>
                                <span class="font-semibold text-gray-900">{{ $user->name }}</span>
                            </div>
                        </td>
                        <td class="px-6 py-4 font-medium">
                            {{ $user->email }}
                        </td>
                        <td class="px-6 py-4">
                            @if($user->role === 'admin')
                                <span class="px-3 py-1 bg-[#4A5D23]/10 text-[#4A5D23] rounded-full text-xs font-bold tracking-wide">
                                    Administrator
                                </span>
                            @else
                                <span class="px-3 py-1 bg-gray-100 text-gray-600 rounded-full text-xs font-bold tracking-wide">
                                    Pengunjung
                                </span>
                            @endif
                        </td>
                        <td class="px-6 py-4 font-medium text-gray-500">
                            {{ $user->created_at->format('d M Y') }}
                        </td>
                        <td class="px-6 py-4 text-right">
                            @if(auth()->id() === $user->id)
                                <span class="text-gray-400 font-medium italic text-xs px-3 py-1 bg-gray-50 rounded-lg">Akun Anda (Aktif)</span>
                            @else
                                <form action="{{ route('admin.users.destroy', $user->id) }}" method="POST" class="inline-block">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-600 hover:text-red-800 font-bold transition px-3 py-1 hover:bg-red-50 rounded-lg" onclick="return confirm('Peringatan: Mencabut akses akan menghapus akun ini secara permanen. Lanjutkan?')">Hapus Akses</button>
                                </form>
                            @endif
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="px-6 py-12 text-center text-gray-400">
                            <svg class="mx-auto h-12 w-12 text-gray-300 mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path></svg>
                            <span class="block font-medium text-gray-500">Belum ada akun yang terdaftar.</span>
                        </td>
                    </tr>
                @endforelse
                
            </tbody>
        </table>
    </div>
@endsection