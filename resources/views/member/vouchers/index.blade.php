@extends('layouts.member')

@section('content')
<div class="max-w-4xl mx-auto">
    <div class="flex justify-between items-center mb-8">
        <h1 class="text-2xl font-bold text-gray-900">Katalog Voucher</h1>
        <div class="bg-[#4A5D23]/10 text-[#4A5D23] px-4 py-2 rounded-full font-bold text-sm">
            Poin Anda: {{ Auth::user()->points }}
        </div>
    </div>

    @if(session('error'))
        <div class="bg-red-50 text-red-600 p-4 rounded-xl mb-6 text-sm font-bold">{{ session('error') }}</div>
    @endif

    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        @foreach($vouchers as $voucher)
        <div class="bg-white p-6 rounded-2xl border border-gray-100 shadow-sm flex flex-col justify-between">
            <div>
                <h3 class="text-lg font-bold text-gray-900 mb-2">{{ $voucher->name }}</h3>
                <p class="text-sm text-gray-500 mb-4">{{ $voucher->description }}</p>
                <div class="inline-block bg-gray-100 px-3 py-1 rounded-lg text-xs font-bold text-gray-600 mb-4">
                    {{ $voucher->points_required }} Poin
                </div>
            </div>

<form id="form-redeem-{{ $voucher->id }}" action="{{ route('member.vouchers.redeem', $voucher->id) }}" method="POST">
    @csrf
    <button type="button" 
        @if(Auth::user()->points < $voucher->points_required) disabled @endif
        onclick="confirmRedeem('{{ $voucher->name }}', '{{ $voucher->points_required }}', document.getElementById('form-redeem-{{ $voucher->id }}'))"
        class="w-full py-3 rounded-xl font-bold transition {{ Auth::user()->points >= $voucher->points_required ? 'bg-[#4A5D23] text-white hover:bg-[#3b4b1c]' : 'bg-gray-100 text-gray-400 cursor-not-allowed' }}">
        {{ Auth::user()->points >= $voucher->points_required ? 'Tukar Sekarang' : 'Poin Tidak Cukup' }}
    </button>
</form>
        </div>
        @endforeach
    </div>
</div>

<script>
function confirmRedeem(voucherName, points, formElement) {
    Swal.fire({
        title: 'Konfirmasi Penukaran',
        text: `Anda yakin ingin menukar ${points} poin dengan "${voucherName}"? Tindakan ini tidak dapat dibatalkan.`,
        icon: 'question',
        showCancelButton: true,
        confirmButtonColor: '#4A5D23',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Ya, Tukar Sekarang',
        cancelButtonText: 'Batal',
        reverseButtons: true
    }).then((result) => {
        if (result.isConfirmed) {
            formElement.submit(); // Submit form jika user menekan tombol 'Ya'
        }
    });
}
</script>
@endsection