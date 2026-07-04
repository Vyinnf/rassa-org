@extends('layouts.admin')

@section('title', 'Baca Pesan')
@section('header', 'Detail Pesan')

@section('content')
    <!-- Tombol Navigasi -->
    <div class="mb-6 flex items-center justify-between max-w-3xl">
        <a href="{{ route('admin.messages.index') }}" class="text-sm font-medium text-gray-500 hover:text-[#4A5D23] transition flex items-center">
            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
            Kembali ke Kotak Masuk
        </a>
        
        <!-- Tombol Hapus -->
        <form action="{{ route('admin.messages.destroy', $message->id) }}" method="POST" class="inline-block">
            @csrf
            @method('DELETE')
            <button type="submit" class="px-4 py-2 bg-red-50 text-red-600 text-sm font-bold rounded-xl hover:bg-red-100 transition" onclick="return confirm('Hapus pesan ini secara permanen?')">
                Hapus Pesan
            </button>
        </form>
    </div>

    <!-- Kotak Pesan -->
    <div class="bg-white rounded-2xl border border-gray-100 shadow-[0_2px_10px_rgb(0,0,0,0.02)] overflow-hidden max-w-3xl">
        
        <!-- Header Pesan (Info Pengirim) -->
        <div class="p-8 border-b border-gray-100 bg-white">
            <h2 class="text-2xl font-bold text-gray-900 mb-6">{{ $message->subject ?? 'Tanpa Subjek' }}</h2>
            
            <div class="flex items-center justify-between text-sm">
                <div class="flex items-center text-gray-600">
                    <!-- Avatar Inisial -->
                    <div class="w-12 h-12 rounded-full bg-[#4A5D23]/10 text-[#4A5D23] text-lg font-bold flex items-center justify-center mr-4 uppercase shadow-sm">
                        {{ substr($message->name, 0, 1) }}
                    </div>
                    <div>
                        <p class="font-bold text-gray-900 text-base">{{ $message->name }}</p>
                        <a href="mailto:{{ $message->email }}" class="text-sm text-[#4A5D23] hover:underline">{{ $message->email }}</a>
                    </div>
                </div>
                <div class="text-gray-400 font-medium text-right">
                    <p>{{ $message->created_at->format('d F Y') }}</p>
                    <p class="text-xs">{{ $message->created_at->format('H:i') }} WIB</p>
                </div>
            </div>
        </div>
        
        <!-- Isi Pesan -->
        <div class="p-8 bg-gray-50/50 min-h-[200px]">
            <p class="text-gray-700 font-medium whitespace-pre-wrap leading-relaxed">{{ $message->content }}</p>
        </div>
        
    </div>
@endsection