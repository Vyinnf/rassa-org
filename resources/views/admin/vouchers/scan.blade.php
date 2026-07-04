@extends('layouts.admin')

@section('title', 'Validasi Voucher')

@section('content')
<div class="max-w-xl mx-auto">
    <!-- Form Pencarian -->
    <div class="bg-white p-6 rounded-2xl border border-gray-100 shadow-sm mb-6">
        <h2 class="font-bold text-gray-900 mb-4">Scan/Masukkan Kode Voucher</h2>
        <form action="{{ route('admin.vouchers.scan') }}" method="GET" class="flex gap-2">
            <input type="text" name="code" value="{{ request('code') }}" placeholder="Contoh: RSS-XXXXXX" class="flex-1 px-4 py-2 border rounded-xl focus:ring-2 focus:ring-[#4A5D23] outline-none uppercase" required>
            <button type="submit" class="bg-[#4A5D23] text-white px-6 py-2 rounded-xl font-bold">Cari</button>
        </form>
    </div>

    @if(session('success'))
        <div class="p-4 mb-4 bg-green-50 text-green-700 rounded-xl font-bold">{{ session('success') }}</div>
    @endif

    @if(session('error'))
        <div class="p-4 mb-4 bg-red-50 text-red-700 rounded-xl font-bold">{{ session('error') }}</div>
    @endif

    <!-- Hasil Pengecekan -->
    @if($voucher)
        <div class="bg-white p-8 rounded-2xl border border-gray-100 shadow-lg">
            <h3 class="text-xs font-bold text-gray-400 uppercase tracking-widest mb-1">Detail Voucher</h3>
            <h2 class="text-2xl font-black text-gray-900 mb-6">{{ $voucher->voucher->name }}</h2>
            
            <div class="space-y-4 mb-8">
                <div class="flex justify-between border-b pb-2">
                    <span class="text-gray-500">Pemilik</span>
                    <span class="font-bold">{{ $voucher->user->name }}</span>
                </div>
                <div class="flex justify-between border-b pb-2">
                    <span class="text-gray-500">Status</span>
                    <span class="font-bold {{ $voucher->is_used ? 'text-red-500' : 'text-green-600' }}">
                        {{ $voucher->is_used ? 'Sudah Terpakai' : 'Aktif' }}
                    </span>
                </div>
            </div>

            @if(!$voucher->is_used && now() <= $voucher->expires_at)
                <form action="{{ route('admin.vouchers.confirm') }}" method="POST">
                    @csrf
                    <input type="hidden" name="id" value="{{ $voucher->id }}">
                    <button type="submit" class="w-full py-4 bg-[#4A5D23] text-white rounded-xl font-bold text-lg hover:bg-[#3b4b1c] transition">
                        Konfirmasi Penukaran
                    </button>
                </form>
            @else
                <button disabled class="w-full py-4 bg-gray-100 text-gray-400 rounded-xl font-bold cursor-not-allowed">
                    Voucher Tidak Dapat Digunakan
                </button>
            @endif
        </div>
    @elseif(request()->has('code'))
        <div class="text-center py-10 text-gray-400">Kode tidak ditemukan.</div>
    @endif
</div>
@endsection