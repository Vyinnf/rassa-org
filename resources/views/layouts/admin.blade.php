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
<body class="bg-gray-50 text-gray-900 font-sans antialiased flex h-screen overflow-hidden selection:bg-[#4A5D23] selection:text-white">

    <!-- SIDEBAR -->
    <aside class="w-64 bg-white border-r border-gray-200 flex flex-col justify-between">
        <div>
            <!-- Logo -->
            <div class="h-16 flex items-center px-8 border-b border-gray-100">
                <a href="/" class="text-2xl font-extrabold tracking-tighter text-[#4A5D23]">rassa.</a>
            </div>

            <!-- Navigation Links -->
            <nav class="p-4 space-y-1 mt-4">
                
                <!-- Link Dashboard -->
                <a href="{{ route('admin.dashboard') }}" 
                   class="flex items-center px-4 py-3 rounded-xl text-sm transition {{ request()->routeIs('admin.dashboard') ? 'bg-[#4A5D23]/10 text-[#4A5D23] font-semibold' : 'text-gray-500 hover:bg-gray-50 hover:text-[#4A5D23] font-medium' }}">
                    <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"></path></svg>
                    Dashboard
                </a>

                <!-- Link Berita / Artikel -->
                <!-- Menggunakan wildcard (*) agar menu tetap aktif saat di halaman Tambah/Edit Berita -->
                <a href="{{ route('admin.articles.index') }}" 
                   class="flex items-center px-4 py-3 rounded-xl text-sm transition {{ request()->routeIs('admin.articles.*') ? 'bg-[#4A5D23]/10 text-[#4A5D23] font-semibold' : 'text-gray-500 hover:bg-gray-50 hover:text-[#4A5D23] font-medium' }}">
                    <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"></path></svg>
                    Berita / Artikel
                </a>
                <!-- Link Menu Kafe -->
<a href="{{ route('admin.menus.index') }}" 
   class="flex items-center px-4 py-3 mt-1 rounded-xl text-sm transition {{ request()->routeIs('admin.menus.*') ? 'bg-[#4A5D23]/10 text-[#4A5D23] font-semibold' : 'text-gray-500 hover:bg-gray-50 hover:text-[#4A5D23] font-medium' }}">
    <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6V4m0 2a2 2 0 100 4m0-4a2 2 0 110 4m-6 8a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4m6 6v10m6-2a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4"></path></svg>
    Menu Kafe
</a>

            </nav>
        </div>

        <!-- Profil & Logout -->
        <div class="p-4 border-t border-gray-100">
            <div class="flex items-center px-4 py-3 mb-2">
                <div class="w-8 h-8 rounded-full bg-[#4A5D23] flex items-center justify-center text-white font-bold text-xs mr-3">
                    {{ substr(Auth::user()->name, 0, 1) }}
                </div>
                <div class="text-sm font-semibold text-gray-700 truncate">{{ Auth::user()->name }}</div>
            </div>
            
            <!-- Tombol Logout -->
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="w-full flex items-center px-4 py-2.5 text-red-600 hover:bg-red-50 rounded-xl font-medium text-sm transition">
                    <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path></svg>
                    Keluar Sistem
                </button>
            </form>
        </div>
    </aside>

    <!-- MAIN CONTENT AREA -->
    <main class="flex-1 flex flex-col h-screen overflow-hidden bg-gray-50/50">
        
        <!-- HEADER TOP -->
        <header class="h-16 bg-white border-b border-gray-200 flex items-center px-8 justify-between">
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

</body>
</html>