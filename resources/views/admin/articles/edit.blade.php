@extends('layouts.admin')

@section('title', 'Edit Berita')
@section('header', 'Edit Berita / Artikel')

@section('content')
<div class="mb-6 flex items-center justify-between">
    <a href="{{ route('admin.articles.index') }}"
        class="text-sm font-medium text-gray-500 hover:text-[#4A5D23] transition flex items-center">
        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18">
            </path>
        </svg>
        Batal & Kembali
    </a>
</div>

<div class="bg-white rounded-2xl border border-gray-100 shadow-sm overflow-hidden max-w-3xl">
    <form action="{{ route('admin.articles.update', $article->id) }}" method="POST" enctype="multipart/form-data"
        class="p-8">
        @csrf
        @method('PUT')

        <!-- Input Judul -->
        <div class="mb-6">
            <label for="title" class="block text-sm font-semibold text-gray-700 mb-2">Judul Berita</label>
            <input type="text" name="title" id="title" required value="{{ old('title', $article->title) }}"
                class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:border-[#4A5D23] focus:ring focus:ring-[#4A5D23]/20 transition outline-none text-sm">
            @error('title') <span class="text-xs text-red-500 mt-1 block">{{ $message }}</span> @enderror
        </div>

        <!-- Input Konten -->
        <div class="mb-6">
            <label for="content" class="block text-sm font-semibold text-gray-700 mb-2">Isi Berita</label>
            <textarea name="content" id="content" rows="6" required
                class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:border-[#4A5D23] focus:ring focus:ring-[#4A5D23]/20 transition outline-none text-sm">{{ old('content', $article->content) }}</textarea>
            @error('content') <span class="text-xs text-red-500 mt-1 block">{{ $message }}</span> @enderror
        </div>

        <!-- Preview & Upload -->
        <div class="mb-8">
            <label for="image" class="block text-sm font-semibold text-gray-700 mb-2">Foto Baru (Opsional)</label>

            <!-- 1. PREVIEW FOTO LAMA (YANG SUDAH ADA DI DATABASE) -->
            @if($article->image)
            <div class="mb-4" id="current-image-wrapper-{{ $article->id }}">
                <span class="block text-xs text-gray-500 mb-1">Foto saat ini:</span>
                <div class="relative inline-block mt-1">
                    <img src="{{ asset('storage/' . $article->image) }}" alt="Thumbnail Lama"
                        class="h-32 w-auto object-cover rounded-lg border border-gray-200">

                    <!-- Tombol Silang (X) DB (Ditambahkan z-10 agar tidak tertimpa) -->
                    <button type="button"
                        onclick="deleteImage('{{ route('admin.articles.delete-image', $article->id) }}', 'current-image-wrapper-{{ $article->id }}')"
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
                class="block w-full text-sm text-gray-500 file:mr-4 file:py-2.5 file:px-4 file:rounded-xl file:border-0 file:text-sm file:font-semibold file:bg-[#4A5D23]/10 file:text-[#4A5D23] hover:file:bg-[#4A5D23]/20 transition cursor-pointer border border-gray-200 rounded-xl">

            <!-- 2. CONTAINER PREVIEW FOTO BARU (BELUM DI-UPLOAD) -->
            <div id="imagePreviewContainer" class="mt-4 hidden">
                <span class="block text-xs font-semibold text-gray-500 mb-2">Pratinjau Foto Baru:</span>
                <div class="relative inline-block">
                    <img id="imagePreview" src="#" alt="Preview"
                        class="h-32 w-auto object-cover rounded-xl border border-gray-200 shadow-sm">

                    <!-- Tombol Silang (X) Lokal (Ditambahkan z-10) -->
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

            <p class="text-xs text-gray-400 mt-2">*Biarkan kosong jika tidak ingin mengubah foto.</p>
            @error('image') <span class="text-xs text-red-500 mt-1 block">{{ $message }}</span> @enderror
        </div>

        <div class="flex justify-end">
            <button type="submit"
                class="px-6 py-3 bg-[#4A5D23] text-white text-sm font-semibold rounded-xl hover:bg-[#3b4b1c] transition shadow-md">
                Simpan Perubahan
            </button>
        </div>
    </form>
</div>

<!-- Pastikan SweetAlert2 dimuat di halaman ini -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
// ==========================================
// A. SCRIPT UNTUK PREVIEW FOTO BARU (LOKAL)
// ==========================================
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

// Fungsi membatalkan file lokal yang dipilih (Klik X pada preview baru)
function clearPreview() {
    imageInput.value = '';
    imagePreviewContainer.classList.add('hidden');
    imagePreview.src = '#';
}

// ==========================================
// B. SCRIPT AJAX UNTUK HAPUS FOTO LAMA (DB)
// ==========================================
function deleteImage(url, containerId) {
    // Fallback jika internet mati atau CDN SweetAlert gagal dimuat
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