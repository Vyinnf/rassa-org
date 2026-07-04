@extends('layouts.member')

@section('content')
<div class="max-w-4xl mx-auto px-6 py-12">
    <h1 class="text-2xl font-bold text-gray-900 mb-8">Halo, {{ $user->name }}!</h1>

    <!-- Kartu Member Digital -->
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-10">
        <div class="bg-[#4A5D23] rounded-3xl p-8 text-white shadow-xl relative overflow-hidden">
            <div class="relative z-10">
                <p class="text-[#D4E09B] text-sm font-bold uppercase tracking-wider mb-1">Status Member</p>
                <h2 class="text-3xl font-bold mb-8">Rassa Loyalty Card</h2>
                <div class="flex justify-between items-end">
                    <div>
                        <p class="text-[#D4E09B] text-xs font-bold uppercase mb-1">Total Poin</p>
                        <p class="text-5xl font-black">{{ $user->points }}</p>
                    </div>
                    <div class="text-right">
                        <p class="text-white/60 text-xs font-bold uppercase">Member Since</p>
                        <p class="font-bold">{{ $user->created_at->format('Y') }}</p>
                    </div>
                </div>
            </div>
            <!-- Aksen Dekoratif -->
            <div class="absolute -bottom-10 -right-10 w-40 h-40 bg-white/10 rounded-full"></div>
        </div>

        <!-- Info Cepat -->
        <div class="bg-white rounded-3xl p-8 border border-gray-100 shadow-sm flex flex-col justify-center">
            <h3 class="font-bold text-gray-900 mb-2">Cara Menambah Poin</h3>
            <p class="text-gray-500 text-sm mb-4">Setiap transaksi di atas Rp 50.000, kamu berhak mendapatkan 50 poin! Kumpulkan dan tukar dengan diskon menarik.</p>
            <a href="#" class="text-[#4A5D23] font-bold text-sm hover:underline">Lihat Katalog Voucher →</a>
        </div>
    </div>

    <!-- Riwayat Voucher -->
    <h2 class="text-xl font-bold text-gray-900 mb-6">Voucher Kamu</h2>
    <div class="bg-white rounded-2xl border border-gray-100 shadow-[0_2px_10px_rgb(0,0,0,0.02)] overflow-hidden">
        <table class="w-full text-left text-sm">
            <thead class="bg-gray-50 border-b border-gray-100 text-xs uppercase font-bold text-gray-600">
                <tr>
                    <th class="px-6 py-4">Nama Voucher</th>
                    <th class="px-6 py-4">Kode Redeem</th>
                    <th class="px-6 py-4">Status</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-100">
                @forelse($myVouchers as $item)
                <tr>
                    <td class="px-6 py-4 font-bold">{{ $item->voucher->name }}</td>
                    <td class="px-6 py-4 font-mono font-bold text-[#4A5D23] bg-gray-50 rounded">{{ $item->redeem_code }}</td>
                    <td class="px-6 py-4">
                        @if($item->is_used)
                            <span class="text-gray-400">Terpakai</span>
                        @elseif(now() > $item->expires_at)
                            <span class="text-red-500">Kadaluwarsa</span>
                        @else
                            <span class="text-green-600 font-bold">Aktif</span>
                        @endif
                    </td>
                </tr>
                @empty
                <tr><td colspan="3" class="px-6 py-8 text-center text-gray-400">Belum ada voucher yang ditukar.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection