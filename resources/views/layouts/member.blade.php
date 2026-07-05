<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Member Dashboard - Rassa.org</title>

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=inter:400,500,600,700&display=swap" rel="stylesheet" />
    <!-- Animate.css untuk efek SweetAlert2 yang lebih mulus -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-gray-50 font-sans text-gray-900 antialiased" x-data="{ profileModalOpen: false }">

    <!-- WRAPPER UTAMA: Menjaga layout tidak nabrak -->
    <div class="flex h-screen overflow-hidden">

        <!-- SIDEBAR -->
        <aside
            class="w-64 flex-shrink-0 bg-white border-r border-gray-200 hidden md:flex flex-col justify-between z-20">
            <div>
                <!-- Logo -->
                <div class="h-16 flex items-center px-8 border-b border-gray-100">
                    <a href="/" class="text-2xl font-extrabold tracking-tighter text-[#4A5D23]">rassa.</a>
                </div>

                <!-- Navigasi -->
                <nav class="space-y-1 mt-4">
                    {{-- Menu Dashboard --}}
                    <a href="{{ route('member.dashboard') }}"
                        class="flex items-center px-4 py-3 font-bold transition {{ request()->routeIs('member.dashboard') ? 'bg-[#4A5D23]/5 text-[#4A5D23] border-r-4 border-[#4A5D23]' : 'text-gray-600 hover:bg-gray-50' }}">
                        <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 14a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 14a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z">
                            </path>
                        </svg>
                        Dashboard
                    </a>

                    {{-- Katalog Voucher --}}
                    <a href="{{ route('member.vouchers.index') }}"
                        class="flex items-center px-4 py-3 font-bold transition {{ request()->routeIs('member.vouchers.*') ? 'bg-[#4A5D23]/5 text-[#4A5D23] border-r-4 border-[#4A5D23]' : 'text-gray-600 hover:bg-gray-50' }}">
                        <!-- Ikon Tiket/Voucher -->
                        <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M15 5v2m0 4v2m0 4v2M5 5a2 2 0 00-2 2v3a2 2 0 110 4v3a2 2 0 002 2h14a2 2 0 002-2v-3a2 2 0 110-4V7a2 2 0 00-2-2H5z">
                            </path>
                        </svg>
                        Katalog Voucher
                    </a>
                </nav>
            </div>

            <!-- Area Dropdown Profil (Bottom Sidebar) -->
            <div class="mt-auto border-t border-gray-100 p-4 bg-gray-50/30">
                <div x-data="{ open: false }" class="relative">

                    <!-- Tombol Trigger -->
                    <button @click.prevent="open = !open" @click.away="open = false"
                        class="w-full flex items-center p-2 rounded-xl hover:bg-white hover:shadow-sm border border-transparent hover:border-gray-100 transition text-left group">

                        <div
                            class="w-10 h-10 rounded-full bg-[#4A5D23]/10 text-[#4A5D23] font-bold flex items-center justify-center mr-3 uppercase shadow-sm group-hover:scale-105 transition-transform">
                            {{ substr(Auth::user()->name, 0, 1) }}
                        </div>

                        <div class="flex-1 overflow-hidden">
                            <p class="text-sm font-bold text-gray-900 truncate">{{ Auth::user()->name }}</p>
                            <p class="text-xs text-gray-500 capitalize">Member Rassa</p>
                        </div>

                        <svg class="w-4 h-4 text-gray-400 transition-transform duration-200"
                            :class="{'rotate-180': open}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 15l7-7 7 7">
                            </path>
                        </svg>
                    </button>

                    <!-- Menu Dropdown -->
                    <div x-show="open" x-transition:enter="transition ease-out duration-200"
                        x-transition:enter-start="opacity-0 transform scale-95 translate-y-2"
                        x-transition:enter-end="opacity-100 transform scale-100 translate-y-0"
                        x-transition:leave="transition ease-in duration-75"
                        x-transition:leave-start="opacity-100 transform scale-100 translate-y-0"
                        x-transition:leave-end="opacity-0 transform scale-95 translate-y-2"
                        class="absolute bottom-full left-0 w-full mb-2 bg-white rounded-xl shadow-[0_4px_20px_rgb(0,0,0,0.1)] border border-gray-100 overflow-hidden z-50"
                        style="display: none;">

                        <button @click.prevent="profileModalOpen = true; open = false"
                            class="w-full flex items-center px-4 py-3 text-sm font-bold text-gray-700 hover:bg-gray-50 hover:text-[#4A5D23] transition text-left">
                            <svg class="w-4 h-4 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z">
                                </path>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                            </svg>
                            Pengaturan Akun
                        </button>

                        <div class="border-t border-gray-100"></div>

                        <form action="{{ route('logout') }}" method="POST" class="block w-full">
                            @csrf
                            <button type="submit"
                                class="w-full flex items-center px-4 py-3 text-sm font-bold text-red-600 hover:bg-red-50 transition">
                                <svg class="w-4 h-4 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1">
                                    </path>
                                </svg>
                                Keluar Sistem
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </aside>

        <!-- MAIN CONTENT AREA -->
        <main class="flex-1 flex flex-col min-w-0 bg-gray-50/50">

            <!-- HEADER TOP -->
            <header
                class="h-16 flex-shrink-0 bg-white border-b border-gray-200 flex items-center px-8 justify-between z-10">
                <h1 class="text-xl font-bold text-gray-800">Member Area</h1>
                <div class="text-sm text-gray-500 font-medium">
                    Halo, <span class="font-bold text-[#4A5D23]">{{ Auth::user()->name }}</span>
                </div>
            </header>

            <!-- KONTEN DINAMIS -->
            <div class="flex-1 overflow-y-auto p-8">
                @yield('content')
            </div>

        </main>
    </div>

    <!-- ========================================== -->
    <!-- MODAL PENGATURAN PROFIL (POP-UP) -->
    <!-- ========================================== -->
    <div x-show="profileModalOpen"
        class="fixed inset-0 z-[100] flex items-center justify-center overflow-y-auto overflow-x-hidden p-4 sm:p-6 lg:p-8"
        style="display: none;">

        <div x-show="profileModalOpen" x-transition:enter="ease-out duration-300" x-transition:enter-start="opacity-0"
            x-transition:enter-end="opacity-100" x-transition:leave="ease-in duration-200"
            x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0" @click="profileModalOpen = false"
            class="fixed inset-0 bg-gray-900/40 backdrop-blur-sm transition-opacity">
        </div>

        <div x-show="profileModalOpen" x-transition:enter="ease-out duration-300"
            x-transition:enter-start="opacity-0 translate-y-8 sm:translate-y-0 sm:scale-95"
            x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100" x-transition:leave="ease-in duration-200"
            x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100"
            x-transition:leave-end="opacity-0 translate-y-8 sm:translate-y-0 sm:scale-95"
            class="relative bg-white rounded-3xl shadow-2xl w-full max-w-5xl max-h-[90vh] overflow-hidden flex flex-col transform transition-all">

            <div class="px-8 py-6 border-b border-gray-100 flex justify-between items-center bg-white z-10">
                <div>
                    <h2 class="text-2xl font-black text-gray-900">Pengaturan Akun</h2>
                    <p class="text-sm font-medium text-gray-500 mt-1">Sesuaikan informasi profil dan keamanan Anda.</p>
                </div>
                <button @click="profileModalOpen = false"
                    class="p-2 text-gray-400 hover:text-red-500 hover:bg-red-50 rounded-xl transition">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12">
                        </path>
                    </svg>
                </button>
            </div>

            <div class="p-8 overflow-y-auto bg-gray-50/50 flex-1">
                @php $user = Auth::user(); @endphp
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
                    <div class="space-y-8">
                        <div
                            class="bg-white p-6 rounded-2xl border border-gray-100 shadow-sm hover:shadow-md transition">
                            @include('profile.partials.update-profile-information-form')
                        </div>
                        <div class="bg-white p-6 rounded-2xl border border-red-50 shadow-sm hover:shadow-md transition">
                            @include('profile.partials.delete-user-form')
                        </div>
                    </div>
                    <div class="space-y-8">
                        <div
                            class="bg-white p-6 rounded-2xl border border-gray-100 shadow-sm hover:shadow-md transition">
                            @include('profile.partials.update-password-form')
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>

    <!-- SweetAlert2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    @if(session('success'))
    <script>
    Swal.fire({
        icon: 'success',
        title: 'Berhasil!',
        text: '{{ session("success") }}', // Tanda kutip diperbaiki di sini
        confirmButtonColor: '#4A5D23',
        confirmButtonText: 'Tutup',
        timer: 3000,
        timerProgressBar: true,
        showClass: {
            popup: 'animate__animated animate__fadeInDown'
        },
        hideClass: {
            popup: 'animate__animated animate__fadeOutUp'
        }
    });
    </script>
    @endif
</body>

</html>