<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'Admin Dashboard') - rassa.org</title>

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=inter:400,500,600,700&display=swap" rel="stylesheet" />
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<!-- x-data ditempatkan di body -->

<body class="bg-gray-50 font-sans text-gray-900 antialiased" x-data="{ profileModalOpen: false }">

    <!-- WRAPPER UTAMA: Wajib flex agar sejajar kiri-kanan -->
    <div class="flex h-screen overflow-hidden">

        <!-- SIDEBAR -->
        <aside class="w-64 flex-shrink-0 bg-white border-r border-gray-200 flex flex-col justify-between z-20">
            <div>
                <!-- Logo -->
                <div class="h-16 flex items-center px-8 border-b border-gray-100">
                    <a href="/" class="text-2xl font-extrabold tracking-tighter text-[#4A5D23]">rassa.</a>
                </div>

                <nav class="space-y-1 mt-4">
                    {{-- Menu Dashboard --}}
                    <a href="{{ route('admin.dashboard') }}"
                        class="flex items-center px-4 py-3 font-bold transition {{ request()->routeIs('admin.dashboard') ? 'bg-[#4A5D23]/5 text-[#4A5D23] border-r-4 border-[#4A5D23]' : 'text-gray-600 hover:bg-gray-50' }}">
                        <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 14a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 14a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z">
                            </path>
                        </svg>
                        Dashboard
                    </a>

                    {{-- Menu Berita --}}
                    <a href="{{ route('admin.articles.index') }}"
                        class="flex items-center px-4 py-3 font-bold transition {{ request()->routeIs('admin.articles.*') ? 'bg-[#4A5D23]/5 text-[#4A5D23] border-r-4 border-[#4A5D23]' : 'text-gray-600 hover:bg-gray-50' }}">
                        <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 100-4 2 2 0 000 4zm-4-10a2 2 0 100-4 2 2 0 000 4z">
                            </path>
                        </svg>
                        Berita / Artikel
                    </a>

                    {{-- Menu Kafe --}}
                    <a href="{{ route('admin.menus.index') }}"
                        class="flex items-center px-4 py-3 font-bold transition {{ request()->routeIs('admin.menus.*') ? 'bg-[#4A5D23]/5 text-[#4A5D23] border-r-4 border-[#4A5D23]' : 'text-gray-600 hover:bg-gray-50' }}">
                        <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 6V4m0 2a2 2 0 100 4m0-4a2 2 0 110 4m-6 8a2 2 0 100-4m0 4a2 2 0 110-4m0-4v2m0 6V12m0 0V8m0 8v2m0-6h10m-10 0H4">
                            </path>
                        </svg>
                        Menu Kafe
                    </a>

                    {{-- Menu Pengaturan --}}
                    <a href="{{ route('admin.settings.index') }}"
                        class="flex items-center px-4 py-3 font-bold transition {{ request()->routeIs('admin.settings.*') ? 'bg-[#4A5D23]/5 text-[#4A5D23] border-r-4 border-[#4A5D23]' : 'text-gray-600 hover:bg-gray-50' }}">
                        <!-- Ikon Gear/Settings -->
                        <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z">
                            </path>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                        </svg>
                        Pengaturan Kafe
                    </a>

                    {{-- Manajemen Akun --}}
                    <a href="{{ route('admin.users.index') }}"
                        class="flex items-center px-4 py-3 font-bold transition {{ request()->routeIs('admin.users.*') ? 'bg-[#4A5D23]/5 text-[#4A5D23] border-r-4 border-[#4A5D23]' : 'text-gray-600 hover:bg-gray-50' }}">
                        <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z">
                            </path>
                        </svg>
                        Manajemen Pengguna
                    </a>

                    {{-- Kotak Masuk --}}
                    <a href="{{ route('admin.messages.index') }}"
                        class="flex items-center px-4 py-3 font-bold transition {{ request()->routeIs('admin.messages.*') ? 'bg-[#4A5D23]/5 text-[#4A5D23] border-r-4 border-[#4A5D23]' : 'text-gray-600 hover:bg-gray-50' }}">
                        <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z">
                            </path>
                        </svg>
                        Kotak Masuk
                    </a>

                    {{-- Validasi Voucher --}}
                    <a href="{{ route('admin.vouchers.scan') }}"
                        class="flex items-center px-4 py-3 font-bold transition {{ request()->routeIs('admin.vouchers.*') ? 'bg-[#4A5D23]/5 text-[#4A5D23] border-r-4 border-[#4A5D23]' : 'text-gray-600 hover:bg-gray-50' }}">
                        <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M15 5v2m0 4v2m0 4v2M5 5a2 2 0 00-2 2v3a2 2 0 110 4v3a2 2 0 002 2h14a2 2 0 002-2v-3a2 2 0 110-4V7a2 2 0 00-2-2H5z">
                            </path>
                        </svg>
                        Validasi Voucher
                    </a>
                </nav>
            </div>

            <!-- Area Dropdown Profil (Bottom Sidebar) -->
            <div class="mt-auto border-t border-gray-100 p-4 bg-gray-50/30">
                <div x-data="{ open: false }" class="relative">

                    <!-- Tombol Trigger (Bisa diklik) -->
                    <button @click.prevent="open = !open" @click.away="open = false"
                        class="w-full flex items-center p-2 rounded-xl hover:bg-white hover:shadow-sm border border-transparent hover:border-gray-100 transition text-left group">

                        <div
                            class="w-10 h-10 rounded-full bg-[#4A5D23] text-white font-bold flex items-center justify-center mr-3 uppercase shadow-sm group-hover:scale-105 transition-transform">
                            {{ substr(Auth::user()->name, 0, 1) }}
                        </div>

                        <div class="flex-1 overflow-hidden">
                            <p class="text-sm font-bold text-gray-900 truncate">{{ Auth::user()->name }}</p>
                            <p class="text-xs text-gray-500 capitalize">{{ Auth::user()->role }}</p>
                        </div>

                        <svg class="w-4 h-4 text-gray-400 transition-transform duration-200"
                            :class="{'rotate-180': open}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 15l7-7 7 7">
                            </path>
                        </svg>
                    </button>

                    <!-- Menu Dropdown (Muncul ke atas / bottom-full) -->
                    <div x-show="open" x-transition:enter="transition ease-out duration-200"
                        x-transition:enter-start="opacity-0 transform scale-95 translate-y-2"
                        x-transition:enter-end="opacity-100 transform scale-100 translate-y-0"
                        x-transition:leave="transition ease-in duration-75"
                        x-transition:leave-start="opacity-100 transform scale-100 translate-y-0"
                        x-transition:leave-end="opacity-0 transform scale-95 translate-y-2"
                        class="absolute bottom-full left-0 w-full mb-2 bg-white rounded-xl shadow-[0_4px_20px_rgb(0,0,0,0.1)] border border-gray-100 overflow-hidden z-50"
                        style="display: none;">

                        <!-- Tombol Buka Modal Profil -->
                        <button @click.prevent="profileModalOpen = true; open = false"
                            class="w-full flex items-center px-4 py-3 text-sm font-bold text-gray-700 hover:bg-gray-50 hover:text-[#4A5D23] transition text-left">
                            <svg class="w-4 h-4 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z">
                                </path>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                            </svg>
                            Profil Saya
                        </button>

                        <!-- Divider -->
                        <div class="border-t border-gray-100"></div>

                        <!-- Form Logout -->
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
                <h1 class="text-xl font-bold text-gray-800">@yield('header', 'Dashboard')</h1>
                <div class="text-sm text-gray-500 font-medium">
                    {{ \Carbon\Carbon::now()->translatedFormat('l, d F Y') }}
                </div>
            </header>

            <!-- KONTEN DINAMIS -->
            <div class="flex-1 overflow-y-auto p-8">
                @yield('content')
            </div>

        </main>
    </div> <!-- Tutup Wrapper Flex -->

    <!-- ========================================== -->
    <!-- MODAL PENGATURAN PROFIL (POP-UP) -->
    <!-- ========================================== -->
    <div x-show="profileModalOpen"
        class="fixed inset-0 z-[100] flex items-center justify-center overflow-y-auto overflow-x-hidden p-4 sm:p-6 lg:p-8"
        style="display: none;">

        <!-- Latar Belakang Gelap (Backdrop Blur) -->
        <div x-show="profileModalOpen" x-transition:enter="ease-out duration-300" x-transition:enter-start="opacity-0"
            x-transition:enter-end="opacity-100" x-transition:leave="ease-in duration-200"
            x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0" @click="profileModalOpen = false"
            class="fixed inset-0 bg-gray-900/40 backdrop-blur-sm transition-opacity">
        </div>

        <!-- Kontainer Modal -->
        <div x-show="profileModalOpen" x-transition:enter="ease-out duration-300"
            x-transition:enter-start="opacity-0 translate-y-8 sm:translate-y-0 sm:scale-95"
            x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100" x-transition:leave="ease-in duration-200"
            x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100"
            x-transition:leave-end="opacity-0 translate-y-8 sm:translate-y-0 sm:scale-95"
            class="relative bg-white rounded-3xl shadow-2xl w-full max-w-5xl max-h-[90vh] overflow-hidden flex flex-col transform transition-all">

            <!-- Header Modal -->
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

            <!-- Isi Modal (Bisa di-scroll jika kepanjangan) -->
            <div class="p-8 overflow-y-auto bg-gray-50/50 flex-1">
                @php
                $user = Auth::user();
                @endphp

                <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
                    <!-- Kolom Kiri -->
                    <div class="space-y-8">
                        <div
                            class="bg-white p-6 rounded-2xl border border-gray-100 shadow-sm hover:shadow-md transition">
                            @include('profile.partials.update-profile-information-form')
                        </div>

                        <div class="bg-white p-6 rounded-2xl border border-red-50 shadow-sm hover:shadow-md transition">
                            @include('profile.partials.delete-user-form')
                        </div>
                    </div>

                    <!-- Kolom Kanan -->
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

</body>

</html>