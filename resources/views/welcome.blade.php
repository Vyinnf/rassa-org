<!DOCTYPE html>
<html lang="id" class="scroll-smooth">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>rassa.org - Semi Industrial Cafe</title>
    
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=inter:400,600,800&display=swap" rel="stylesheet" />

    <!-- Scripts (Vite + Tailwind) -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-white text-gray-900 font-sans antialiased selection:bg-[#4A5D23] selection:text-white">

    <!-- NAVBAR MINIMALIS -->
    <nav class="fixed w-full bg-white/80 backdrop-blur-md z-50 border-b border-gray-100">
        <div class="max-w-7xl mx-auto px-6 py-4 flex justify-between items-center">
            <a href="/" class="text-2xl font-extrabold tracking-tighter text-[#4A5D23]">
                rassa.
            </a>
            <div class="space-x-6 text-sm font-semibold hidden md:block">
                <a href="#" class="hover:text-[#4A5D23] transition">Menu</a>
                <a href="#" class="hover:text-[#4A5D23] transition">Cerita</a>
                <a href="#" class="hover:text-[#4A5D23] transition">Jurnal/Berita</a>
            </div>
            <div>
                @auth
                    <a href="{{ url('/dashboard') }}" class="px-5 py-2.5 bg-[#4A5D23] text-white text-sm font-semibold rounded-full hover:bg-[#3b4b1c] transition shadow-sm">Dashboard</a>
                @else
                    <a href="{{ route('login') }}" class="text-sm font-semibold text-gray-600 hover:text-[#4A5D23] transition">Login</a>
                @endauth
            </div>
        </div>
    </nav>

    <!-- HERO SECTION (Sambutan Pertama) -->
    <section class="relative h-screen flex items-center justify-center overflow-hidden">
        <div class="max-w-7xl mx-auto px-6 relative z-10 text-center flex flex-col items-center">
            
            <h1 class="text-5xl md:text-7xl font-extrabold tracking-tight text-gray-900 mb-6 leading-tight">
                Ruang rasa, <br>
                <span class="text-[#4A5D23]">tanpa jeda.</span>
            </h1>
            
            <p class="max-w-2xl text-lg text-gray-500 mb-10 leading-relaxed">
                Nikmati perpaduan ruang semi-industrial yang tenang dan seduhan kopi terbaik. Tempat berbagimu, di tengah hiruk-pikuk kota.
            </p>
            
            <div class="flex flex-col sm:flex-row gap-4">
                <a href="#" class="px-8 py-3.5 bg-[#4A5D23] text-white font-semibold rounded-full hover:bg-[#3b4b1c] transition shadow-lg hover:shadow-xl hover:-translate-y-0.5 transform">
                    Lihat Menu
                </a>
                <a href="#" class="px-8 py-3.5 bg-white text-[#4A5D23] border-2 border-[#4A5D23] font-semibold rounded-full hover:bg-gray-50 transition">
                    Reservasi Meja
                </a>
            </div>
        </div>

        <!-- Ornamen Latar Belakang (Opsional, memberi tekstur minimalis) -->
        <div class="absolute inset-0 z-0 opacity-10 bg-[radial-gradient(#4A5D23_1px,transparent_1px)] [background-size:24px_24px]"></div>
    </section>

    <!-- FOOTER SINGKAT -->
    <footer class="bg-gray-50 border-t border-gray-100 py-10">
        <div class="max-w-7xl mx-auto px-6 text-center text-sm text-gray-400">
            &copy; {{ date('Y') }} rassa.org. Estetika Semi Industrial.
        </div>
    </footer>

</body>
</html>