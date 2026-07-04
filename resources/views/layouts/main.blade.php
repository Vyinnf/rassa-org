<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Rassa.org | Kopi & Cerita</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600,700&display=swap" rel="stylesheet" />

    <!-- Scripts & Tailwind CSS -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans antialiased bg-gray-50 text-gray-900 scroll-smooth">

    <!-- Navbar Minimalis -->
    <nav class="sticky top-0 z-50 bg-white/80 backdrop-blur-md border-b border-gray-100">
        <div class="max-w-6xl mx-auto px-6 py-4 flex justify-between items-center">
            <a href="/" class="text-2xl font-bold tracking-tight text-[#4A5D23]">Rassa<span class="text-gray-400">.org</span></a>
            
            <div class="flex items-center space-x-6 text-sm font-semibold text-gray-600">
                <a href="#menu" class="hover:text-[#4A5D23] transition">Menu Kafe</a>
                <a href="#berita" class="hover:text-[#4A5D23] transition">Berita</a>
                
                @if (Route::has('login'))
                    <div class="border-l border-gray-200 pl-6 space-x-4">
                        @auth
                            <a href="{{ route('admin.dashboard') }}" class="px-4 py-2 rounded-xl bg-[#4A5D23]/10 text-[#4A5D23] hover:bg-[#4A5D23]/20 transition">Dashboard</a>
                        @else
                            <a href="{{ route('login') }}" class="hover:text-[#4A5D23] transition">Masuk</a>
                        @endauth
                    </div>
                @endif
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <main>
        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="bg-white border-t border-gray-100 py-12 mt-20">
        <div class="max-w-6xl mx-auto px-6 text-center text-sm text-gray-400">
            <p>&copy; {{ date('Y') }} Rassa.org. All rights reserved.</p>
        </div>
    </footer>

</body>
</html>