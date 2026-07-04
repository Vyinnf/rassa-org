@extends('layouts.admin')

@section('title', 'Tambah Menu')
@section('header', 'Tambahkan Menu Kafe Baru')

@section('content')
    <div class="mb-6 flex items-center justify-between">
        <a href="{{ route('admin.menus.index') }}" class="text-sm font-medium text-gray-500 hover:text-[#4A5D23] transition flex items-center">
            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
            Kembali ke Daftar Menu
        </a>
    </div>

    <div class="bg-white rounded-2xl border border-gray-100 shadow-[0_2px_10px_rgb(0,0,0,0.02)] overflow-hidden max-w-3xl">
        <form action="{{ route('admin.menus.store') }}" method="POST" enctype="multipart/form-data" class="p-8">
            @csrf

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                <!-- Input Nama -->
                <div>
                    <label for="name" class="block text-sm font-bold text-gray-800 mb-2">Nama Produk</label>
                    <input type="text" name="name" id="name" required value="{{ old('name') }}" placeholder="Contoh: Es Kopi Susu Rassa"
                        class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:border-[#4A5D23] focus:ring focus:ring-[#4A5D23]/20 transition outline-none text-sm font-medium">
                    @error('name') <span class="text-xs text-red-500 mt-1 block">{{ $message }}</span> @enderror
                </div>

                <!-- Input Kategori -->
                <div>
                    <label for="category" class="block text-sm font-bold text-gray-800 mb-2">Kategori</label>
                    <select name="category" id="category" required
                        class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:border-[#4A5D23] focus:ring focus:ring-[#4A5D23]/20 transition outline-none text-sm font-medium bg-white">
                        <option value="" disabled selected>Pilih Kategori...</option>
                        <option value="Coffee" {{ old('category') == 'Coffee' ? 'selected' : '' }}>Coffee</option>
                        <option value="Non-Coffee" {{ old('category') == 'Non-Coffee' ? 'selected' : '' }}>Non-Coffee</option>
                        <option value="Snack" {{ old('category') == 'Snack' ? 'selected' : '' }}>Snack</option>
                        <option value="Main Course" {{ old('category') == 'Main Course' ? 'selected' : '' }}>Main Course</option>
                    </select>
                    @error('category') <span class="text-xs text-red-500 mt-1 block">{{ $message }}</span> @enderror
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                <!-- Input Harga -->
                <div>
                    <label for="price" class="block text-sm font-bold text-gray-800 mb-2">Harga (Rp)</label>
                    <input type="number" name="price" id="price" required value="{{ old('price') }}" placeholder="Contoh: 25000" min="0"
                        class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:border-[#4A5D23] focus:ring focus:ring-[#4A5D23]/20 transition outline-none text-sm font-medium">
                    @error('price') <span class="text-xs text-red-500 mt-1 block">{{ $message }}</span> @enderror
                </div>

                <!-- Input Status -->
                <div>
                    <label for="is_available" class="block text-sm font-bold text-gray-800 mb-2">Status Ketersediaan</label>
                    <select name="is_available" id="is_available" required
                        class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:border-[#4A5D23] focus:ring focus:ring-[#4A5D23]/20 transition outline-none text-sm font-medium bg-white">
                        <option value="1" {{ old('is_available') == '1' ? 'selected' : '' }}>Tersedia</option>
                        <option value="0" {{ old('is_available') == '0' ? 'selected' : '' }}>Habis</option>
                    </select>
                    @error('is_available') <span class="text-xs text-red-500 mt-1 block">{{ $message }}</span> @enderror
                </div>
            </div>

            <!-- Input Deskripsi -->
            <div class="mb-6">
                <label for="description" class="block text-sm font-bold text-gray-800 mb-2">Deskripsi Singkat (Opsional)</label>
                <textarea name="description" id="description" rows="3"
                    class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:border-[#4A5D23] focus:ring focus:ring-[#4A5D23]/20 transition outline-none text-sm font-medium">{{ old('description') }}</textarea>
                @error('description') <span class="text-xs text-red-500 mt-1 block">{{ $message }}</span> @enderror
            </div>

            <!-- Input Foto -->
            <div class="mb-8">
                <label for="image" class="block text-sm font-bold text-gray-800 mb-2">Foto Produk (Opsional)</label>
                <input type="file" name="image" id="image" accept="image/*"
                    class="block w-full text-sm text-gray-500 file:mr-4 file:py-2.5 file:px-4 file:rounded-xl file:border-0 file:text-sm file:font-bold file:bg-[#4A5D23]/10 file:text-[#4A5D23] hover:file:bg-[#4A5D23]/20 transition cursor-pointer border border-gray-200 rounded-xl">
                
                <!-- Container Preview -->
                <div id="imagePreviewContainer" class="mt-4 hidden">
                    <span class="block text-xs font-bold text-gray-500 mb-2">Pratinjau Foto:</span>
                    <img id="imagePreview" src="#" alt="Preview" class="h-32 w-32 object-cover rounded-xl border border-gray-200 shadow-sm">
                </div>
                @error('image') <span class="text-xs text-red-500 mt-1 block">{{ $message }}</span> @enderror
            </div>

            <div class="flex justify-end">
                <button type="submit" class="px-6 py-3 bg-[#4A5D23] text-white text-sm font-bold rounded-xl hover:bg-[#3b4b1c] transition shadow-md">
                    Simpan Menu
                </button>
            </div>
        </form>
    </div>

    <script>
        const imageInput = document.getElementById('image');
        const imagePreviewContainer = document.getElementById('imagePreviewContainer');
        const imagePreview = document.getElementById('imagePreview');

        imageInput.addEventListener('change', function() {
            const file = this.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    imagePreview.src = e.target.result;
                    imagePreviewContainer.classList.remove('hidden');
                }
                reader.readAsDataURL(file);
            } else {
                imagePreviewContainer.classList.add('hidden');
            }
        });
    </script>
@endsection