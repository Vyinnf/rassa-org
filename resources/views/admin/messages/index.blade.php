@extends('layouts.admin')

@section('title', 'Kotak Masuk')
@section('header', 'Pesan dari Pelanggan')

@section('content')
    @if(session('success'))
        <div class="mb-6 p-4 bg-green-50 border border-green-200 text-green-700 rounded-xl text-sm font-medium flex items-center shadow-sm">
            <svg class="w-5 h-5 mr-3 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
            {{ session('success') }}
        </div>
    @endif

    <div class="bg-white rounded-2xl border border-gray-100 shadow-[0_2px_10px_rgb(0,0,0,0.02)] overflow-hidden">
        <table class="w-full text-left text-sm whitespace-nowrap">
            <thead class="bg-gray-50 border-b border-gray-100 uppercase text-xs font-bold text-gray-800 tracking-wider">
                <tr>
                    <th class="px-6 py-4">Pengirim</th>
                    <th class="px-6 py-4">Subjek Pesan</th>
                    <th class="px-6 py-4">Tanggal</th>
                    <th class="px-6 py-4">Status</th>
                    <th class="px-6 py-4 text-right">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-100 text-gray-700">
                @forelse ($messages as $message)
                    <tr class="hover:bg-gray-50/80 transition {{ !$message->is_read ? 'bg-[#4A5D23]/5' : '' }}">
                        <td class="px-6 py-4">
                            <div class="font-bold {{ !$message->is_read ? 'text-gray-900' : 'text-gray-700' }}">
                                {{ $message->name }}
                            </div>
                            <div class="text-xs text-gray-500">{{ $message->email }}</div>
                        </td>
                        <td class="px-6 py-4">
                            <span class="{{ !$message->is_read ? 'font-bold text-gray-900' : 'font-medium text-gray-600' }}">
                                {{ $message->subject ?? 'Tanpa Subjek' }}
                            </span>
                        </td>
                        <td class="px-6 py-4 font-medium text-gray-500">
                            {{ $message->created_at->format('d M Y, H:i') }}
                        </td>
                        <td class="px-6 py-4">
                            @if(!$message->is_read)
                                <span class="px-3 py-1 bg-blue-50 text-blue-600 rounded-full text-xs font-bold tracking-wide flex items-center inline-flex">
                                    <span class="w-2 h-2 rounded-full bg-blue-500 mr-2"></span> Baru
                                </span>
                            @else
                                <span class="px-3 py-1 bg-gray-100 text-gray-500 rounded-full text-xs font-bold tracking-wide">Dibaca</span>
                            @endif
                        </td>
                        <td class="px-6 py-4 text-right space-x-2">
                            <a href="{{ route('admin.messages.show', $message->id) }}" class="text-[#4A5D23] hover:text-[#3b4b1c] font-bold transition px-3 py-1 hover:bg-[#4A5D23]/10 rounded-lg">Buka</a>
                            
                            <form action="{{ route('admin.messages.destroy', $message->id) }}" method="POST" class="inline-block">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-600 hover:text-red-800 font-bold transition px-3 py-1 hover:bg-red-50 rounded-lg" onclick="return confirm('Hapus pesan ini?')">Hapus</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="px-6 py-12 text-center text-gray-400">
                            <span class="block font-medium text-gray-500">Belum ada pesan yang masuk.</span>
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
@endsection