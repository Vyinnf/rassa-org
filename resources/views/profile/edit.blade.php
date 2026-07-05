{{-- Logic penentu Layout otomatis berdasarkan Role --}}
@extends(Auth::user()->role === 'admin' ? 'layouts.admin' : 'layouts.member')

@section('title', 'Pengaturan Akun')
@section('header', 'Profil Saya')

@section('content')
<div class="max-w-4xl space-y-6 pb-10">

    <!-- Header Halaman -->
    <div class="mb-8">
        <h2 class="text-2xl font-bold text-gray-900">Pengaturan Akun</h2>
        <p class="text-gray-500 text-sm mt-1">Kelola informasi profil dan keamanan akun Anda di sini.</p>
    </div>

    <!-- Form 1: Update Informasi (Nama & Email) -->
    <div
        class="bg-white p-8 rounded-3xl border border-gray-100 shadow-[0_2px_10px_rgb(0,0,0,0.02)] hover:shadow-lg transition-shadow duration-300 transform hover:-translate-y-1">
        <div class="max-w-xl">
            {{-- Menggunakan form bawaan Breeze --}}
            @include('profile.partials.update-profile-information-form')
        </div>
    </div>

    <!-- Form 2: Update Password -->
    <div
        class="bg-white p-8 rounded-3xl border border-gray-100 shadow-[0_2px_10px_rgb(0,0,0,0.02)] hover:shadow-lg transition-shadow duration-300 transform hover:-translate-y-1">
        <div class="max-w-xl">
            {{-- Menggunakan form bawaan Breeze --}}
            @include('profile.partials.update-password-form')
        </div>
    </div>

    <!-- Form 3: Hapus Akun -->
    <div
        class="bg-white p-8 rounded-3xl border border-red-100 shadow-[0_2px_10px_rgb(0,0,0,0.02)] hover:shadow-lg transition-shadow duration-300 transform hover:-translate-y-1">
        <div class="max-w-xl">
            {{-- Menggunakan form bawaan Breeze --}}
            @include('profile.partials.delete-user-form')
        </div>
    </div>

</div>
@endsection