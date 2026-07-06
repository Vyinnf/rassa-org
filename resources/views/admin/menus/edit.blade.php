@extends('layouts.admin')

@section('title', 'Edit Menu')
@section('header', 'Edit Menu Kafe')

@section('content')
<div class="mb-6 flex items-center justify-between">
    <a href="{{ route('admin.menus.index') }}"
        class="text-sm font-medium text-gray-500 hover:text-[#4A5D23] transition flex items-center">
        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18">
            </path>
        </svg>
        Batal & Kembali
    </a>
</div>

<div class="bg-white rounded-2xl border border-gray-100 shadow-[0_2px_10px_rgb(0,0,0,0.02)] overflow-hidden max-w-3xl">
    <form action="{{ route('admin.menus.update', $menu->id) }}" method="POST" enctype="multipart/form-data" class="p-8">
        @csrf
        @method('PUT')

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
            <div>
                <label for="name" class="block text-sm font-bold text-gray-800 mb-2">Nama Produk</label>
                <input type="text" name="name" id="name" required value="{{ old('name', $menu->name) }}"
                    class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:border-[#4A5D23] focus:ring focus:ring-[#4A5D23]/20 transition outline-none text-sm font-medium">
            </div>
            <div>
                <label for="category" class="block text-sm font-bold text-gray-800 mb-2">Kategori</label>
                <select name="category" id="category" required
                    class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:border-[#4A5D23] focus:ring focus:ring-[#4A5D23]/20 transition outline-none text-sm font-medium bg-white">
                    <option value="Coffee" {{ old('category', $menu->category) == 'Coffee' ? 'selected' : '' }}>Coffee
                    </option>
                    <option value="Non-Coffee" {{ old('category', $menu->category) == 'Non-Coffee' ? 'selected' : '' }}>
                        Non-Coffee</option>
                    <option value="Snack" {{ old('category', $menu->category) == 'Snack' ? 'selected' : '' }}>Snack
                    </option>
                    <option value="Main Course"
                        {{ old('category', $menu->category) == 'Main Course' ? 'selected' : '' }}>Main Course</option>
                </select>
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
            <div>
                <label for="price" class="block text-sm font-bold text-gray-800 mb-2">Harga (Rp)</label>
                <input type="number" name="price" id="price" required value="{{ old('price', $menu->price) }}"
                    class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:border-[#4A5D23] focus:ring focus:ring-[#4A5D23]/20 transition outline-none text-sm font-medium">
            </div>
            <div>
                <label for="is_available" class="block text-sm font-bold text-gray-800 mb-2">Status</label>
                <select name="is_available" id="is_available" required
                    class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:border-[#4A5D23] focus:ring focus:ring-[#4A5D23]/20 transition outline-none text-sm font-medium bg-white">
                    <option value="1" {{ old('is_available', $menu->is_available) == '1' ? 'selected' : '' }}>Tersedia
                    </option>
                    <option value="0" {{ old('is_available', $menu->is_available) == '0' ? 'selected' : '' }}>Habis
                    </option>
                </select>
            </div>
        </div>

        <div class="mb-6">
            <label for="description" class="block text-sm font-bold text-gray-800 mb-2">Deskripsi</label>
            <textarea name="description" id="description" rows="3"
                class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:border-[#4A5D23] focus:ring focus:ring-[#4A5D23]/20 transition outline-none text-sm font-medium">{{ old('description', $menu->description) }}</textarea>
        </div>

        <div class="mb-8">
            <label for="image" class="block text-sm font-bold text-gray-800 mb-2">Foto Produk Baru (Opsional)</label>

            <!-- 1. PREVIEW FOTO LAMA (YANG SUDAH ADA DI DATABASE) -->
            @if($menu->image)
            <div class="mb-3" id="current-image-wrapper-{{ $menu->id }}">
                <span class="block text-xs text-gray-500 mb-1">Foto saat ini:</span>
                <div class="relative inline-block mt-1">
                    <img src="{{ asset('storage/' . $menu->image) }}" alt="Preview"
                        class="h-24 w-24 object-cover rounded-xl border border-gray-200">

                    <!-- Tombol Silang (X) DB -->
                    <button type="button"
                        onclick="deleteImage('{{ route('admin.menus.delete-image', $menu->id) }}', 'current-image-wrapper-{{ $menu->id }}')"
                        class="absolute -top-3 -right-3 z-10 bg-red-500 text-white rounded-full w-8 h-8 flex items-center justify-center hover:bg-red-600 hover:scale-110 transition shadow-md cursor-pointer"
                        title="Hapus foto ini secara permanen">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5"
                                d="M6 18L18 6M6 6l12 12"></path>
                        </svg>
                    </button>
                </div>
            </div>
            @endif

            <input type="file" name="image" id="image" accept="image/*"
                class="block w-full text-sm text-gray-500 file:mr-4 file:py-2.5 file:px-4 file:rounded-xl file:border-0 file:text-sm file:font-bold file:bg-[#4A5D23]/10 file:text-[#4A5D23] hover:file:bg-[#4A5D23]/20 transition cursor-pointer border border-gray-200 rounded-xl">

            <!-- 2. CONTAINER PREVIEW FOTO BARU (BELUM DI-UPLOAD) -->
            <div id="imagePreviewContainer" class="mt-4 hidden">
                <span class="block text-xs font-bold text-gray-500 mb-2">Pratinjau Foto Baru:</span>
                <div class="relative inline-block">
                    <img id="imagePreview" src="#" alt="Preview"
                        class="h-32 w-32 object-cover rounded-xl border border-gray-200 shadow-sm">
                    <!-- Tombol Silang (X) Lokal -->
                    <button type="button" onclick="clearPreview()"
                        class="absolute -top-3 -right-3 z-10 bg-red-500 text-white rounded-full w-8 h-8 flex items-center justify-center hover:bg-red-600 hover:scale-110 transition shadow-md cursor-pointer"
                        title="Batal pilih foto baru ini">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5"
                                d="M6 18L18 6M6 6l12 12"></path>
                        </svg>
                    </button>
                </div>
            </div>
        </div>

        <div class="flex justify-end">
            <button type="submit"
                class="px-6 py-3 bg-[#4A5D23] text-white text-sm font-bold rounded-xl hover:bg-[#3b4b1c] transition shadow-md">
                Simpan Perubahan
            </button>
        </div>
    </form>
</div>

<!-- Pastikan SweetAlert2 dimuat di halaman ini -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
const imageInput = document.getElementById('image');
const imagePreviewContainer = document.getElementById('imagePreviewContainer');
const imagePreview = document.getElementById('imagePreview');
const currentImageWrapper = document.getElementById('current-image-wrapper-{{ $menu->id ?? '
    ' }}');

// 1. Script untuk pratinjau foto lokal yang baru dipilih
imageInput.addEventListener('change', function() {
    const file = this.files[0];
    if (file) {
        const reader = new FileReader();
        reader.onload = function(e) {
            imagePreview.src = e.target.result;
            imagePreviewContainer.classList.remove('hidden');
            // Opsional: Sembunyikan foto lama saat memilih foto baru
            if (currentImageWrapper) currentImageWrapper.style.display = 'none';
        }
        reader.readAsDataURL(file);
    }
});

// Fungsi membatalkan file lokal yang dipilih
function clearPreview() {
    imageInput.value = '';
    imagePreviewContainer.classList.add('hidden');
    imagePreview.src = '#';
    // Munculkan kembali foto lama jika ada
    if (currentImageWrapper) currentImageWrapper.style.display = 'block';
}

// 2. Script AJAX untuk menghapus foto lama (DB)
function deleteImage(url, containerId) {
    if (typeof Swal === 'undefined') {
        if (confirm('Hapus foto ini secara permanen?')) {
            executeDelete(url, containerId);
        }
        return;
    }

    Swal.fire({
        title: 'Hapus foto ini?',
        text: "Tindakan ini akan langsung menghapus foto secara permanen!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#dc2626',
        cancelButtonColor: '#9ca3af',
        confirmButtonText: 'Ya, Hapus!',
        cancelButtonText: 'Batal',
        reverseButtons: true
    }).then((result) => {
        if (result.isConfirmed) {
            executeDelete(url, containerId);
        }
    });
}

function executeDelete(url, containerId) {
    fetch(url, {
            method: 'DELETE',
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                'Accept': 'application/json'
            }
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                const imgContainer = document.getElementById(containerId);
                imgContainer.style.transition = "opacity 0.3s ease, transform 0.3s ease";
                imgContainer.style.opacity = "0";
                imgContainer.style.transform = "scale(0.95)";
                setTimeout(() => imgContainer.remove(), 300);

                if (typeof Swal !== 'undefined') {
                    Swal.fire({
                        icon: 'success',
                        title: 'Terhapus!',
                        text: data.message,
                        timer: 2000,
                        showConfirmButton: false
                    });
                }
            } else {
                alert('Gagal! Terjadi kesalahan saat menghapus foto.');
            }
        })
        .catch(error => {
            alert('Error! Gagal menghubungi server.');
        });
}
</script>
@endsection