<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Member Dashboard - Rassa.org</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-50 font-sans">

    <div class="min-h-screen flex">
        <!-- Sidebar -->
        <aside class="w-64 bg-white border-r border-gray-100 hidden md:flex flex-col">
            <div class="p-6">
                <a href="/" class="text-2xl font-bold text-[#4A5D23]">Rassa.org</a>
            </div>
            
<nav class="flex-1 px-4 space-y-2 mt-4">
    <a href="{{ route('member.dashboard') }}" class="flex items-center px-4 py-3 {{ request()->routeIs('member.dashboard') ? 'bg-[#4A5D23]/5 text-[#4A5D23]' : 'text-gray-600 hover:bg-gray-50' }} font-bold rounded-xl transition">
        Dashboard
    </a>
    <a href="{{ route('member.vouchers.index') }}" class="flex items-center px-4 py-3 {{ request()->routeIs('member.vouchers.*') ? 'bg-[#4A5D23]/5 text-[#4A5D23]' : 'text-gray-600 hover:bg-gray-50' }} font-bold rounded-xl transition">
        Katalog Voucher
    </a>
</nav>

            <div class="p-4 border-t border-gray-100">
                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button type="submit" class="w-full text-left px-4 py-3 text-red-500 font-bold hover:bg-red-50 rounded-xl transition">
                        Keluar
                    </button>
                </form>
            </div>
        </aside>

        <!-- Main Content -->
        <main class="flex-1 p-8">
            <header class="flex justify-between items-center mb-8">
                <h2 class="text-xl font-bold text-gray-900">Member Area</h2>
                <div class="text-sm text-gray-500">Halo, {{ Auth::user()->name }}</div>
            </header>

            @yield('content')
        </main>
    </div>
<!-- SweetAlert2 -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<!-- Script untuk Menampilkan Notifikasi Sukses -->
@if(session('success'))
<script>
    Swal.fire({
        icon: 'success',
        title: 'Penukaran Berhasil!',
        text: '{{ session('success') }}',
        confirmButtonColor: '#4A5D23',
        confirmButtonText: 'Terima Kasih',
        timer: 3000, // Menutup otomatis setelah 3 detik
        timerProgressBar: true,
        showClass: {
            popup: 'animate__animated animate__fadeInDown' // Animasi muncul
        },
        hideClass: {
            popup: 'animate__animated animate__fadeOutUp' // Animasi hilang
        }
    });
</script>
@endif
</body>
</html>