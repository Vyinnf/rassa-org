@extends('layouts.admin')

@section('title', 'Pengaturan')
@section('header', 'Pengaturan Profil Kafe')

@section('content')
    @if(session('success'))
        <div class="mb-6 p-4 bg-green-50 border border-green-200 text-green-700 rounded-xl text-sm font-bold flex items-center shadow-sm">
            <svg class="w-5 h-5 mr-3 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
            {{ session('success') }}
        </div>
    @endif

    <div class="bg-white rounded-2xl border border-gray-100 shadow-[0_2px_10px_rgb(0,0,0,0.02)] overflow-hidden max-w-4xl">
        <form action="{{ route('admin.settings.update') }}" method="POST" class="p-8">
            @csrf
            @method('PUT')

            <!-- Section: Identitas Utama -->
            <div class="mb-8">
                <h3 class="text-lg font-bold text-gray-900 mb-4 border-b border-gray-100 pb-2">Identitas Halaman Depan</h3>
                
                <div class="mb-5">
                    <label for="cafe_name" class="block text-sm font-bold text-gray-700 mb-2">Nama Brand / Kafe</label>
                    <input type="text" name="cafe_name" id="cafe_name" value="{{ old('cafe_name', $setting->cafe_name) }}" required
                        class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:border-[#4A5D23] focus:ring focus:ring-[#4A5D23]/20 transition outline-none text-sm font-medium">
                </div>

                <div class="mb-5">
                    <label for="hero_title" class="block text-sm font-bold text-gray-700 mb-2">Slogan / Judul Utama (Hero)</label>
                    <input type="text" name="hero_title" id="hero_title" value="{{ old('hero_title', $setting->hero_title) }}" required
                        class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:border-[#4A5D23] focus:ring focus:ring-[#4A5D23]/20 transition outline-none text-sm font-medium">
                </div>

                <div class="mb-5">
                    <label for="hero_text" class="block text-sm font-bold text-gray-700 mb-2">Teks Sambutan Pendek</label>
                    <textarea name="hero_text" id="hero_text" rows="3"
                        class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:border-[#4A5D23] focus:ring focus:ring-[#4A5D23]/20 transition outline-none text-sm font-medium">{{ old('hero_text', $setting->hero_text) }}</textarea>
                </div>
            </div>

            <!-- Section: Info Kontak -->
            <div class="mb-8">
                <h3 class="text-lg font-bold text-gray-900 mb-4 border-b border-gray-100 pb-2">Informasi Kontak & Lokasi</h3>
                
                <div class="mb-5">
                    <label for="address" class="block text-sm font-bold text-gray-700 mb-2">Alamat Lengkap</label>
                    <textarea name="address" id="address" rows="2"
                        class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:border-[#4A5D23] focus:ring focus:ring-[#4A5D23]/20 transition outline-none text-sm font-medium">{{ old('address', $setting->address) }}</textarea>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-5">
                    <div>
                        <label for="email" class="block text-sm font-bold text-gray-700 mb-2">Alamat Email</label>
                        <input type="email" name="email" id="email" value="{{ old('email', $setting->email) }}"
                            class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:border-[#4A5D23] focus:ring focus:ring-[#4A5D23]/20 transition outline-none text-sm font-medium">
                    </div>
                    <div>
                        <label for="phone" class="block text-sm font-bold text-gray-700 mb-2">Nomor Telepon / WhatsApp</label>
                        <input type="text" name="phone" id="phone" value="{{ old('phone', $setting->phone) }}" placeholder="081234567890"
                            class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:border-[#4A5D23] focus:ring focus:ring-[#4A5D23]/20 transition outline-none text-sm font-medium">
                    </div>
                </div>

                <div class="mb-5">
                    <label for="instagram_url" class="block text-sm font-bold text-gray-700 mb-2">Tautan Instagram (Opsional)</label>
                    <input type="url" name="instagram_url" id="instagram_url" value="{{ old('instagram_url', $setting->instagram_url) }}" placeholder="https://instagram.com/namaakun"
                        class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:border-[#4A5D23] focus:ring focus:ring-[#4A5D23]/20 transition outline-none text-sm font-medium">
                </div>
            </div>

            <div class="flex justify-end pt-4">
                <button type="submit" class="px-8 py-3 bg-[#4A5D23] text-white text-sm font-bold rounded-xl hover:bg-[#3b4b1c] transition shadow-md">
                    Simpan Pengaturan
                </button>
            </div>
        </form>
    </div>
@endsection