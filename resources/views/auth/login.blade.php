<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login - rassa.org</title>
    
    <!-- Fonts & Tailwind -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=inter:400,600,800&display=swap" rel="stylesheet" />
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-50 text-gray-900 font-sans antialiased flex items-center justify-center min-h-screen selection:bg-[#4A5D23] selection:text-white">

    <div class="w-full max-w-md bg-white p-10 rounded-3xl shadow-[0_8px_30px_rgb(0,0,0,0.04)] border border-gray-100">
        
        <div class="text-center mb-10">
            <a href="/" class="text-3xl font-extrabold tracking-tighter text-[#4A5D23]">rassa.</a>
            <p class="text-sm text-gray-500 mt-2 font-medium">Masuk ke ruang kerja Anda</p>
        </div>

        <!-- Alert Error (Hidden by default) -->
        <div id="error-alert" class="hidden mb-6 p-4 bg-red-50 border border-red-100 text-red-600 text-sm rounded-xl font-medium">
            <!-- Pesan error akan muncul di sini -->
        </div>

        <form id="login-form" method="POST" action="{{ route('login') }}">
            @csrf

            <!-- Email Address -->
            <div class="mb-5">
                <label for="email" class="block text-sm font-semibold text-gray-700 mb-2">Email</label>
                <input id="email" type="email" name="email" required autofocus autocomplete="username" 
                    class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:border-[#4A5D23] focus:ring focus:ring-[#4A5D23]/20 transition outline-none text-sm">
            </div>

            <!-- Password -->
            <div class="mb-6">
                <label for="password" class="block text-sm font-semibold text-gray-700 mb-2">Password</label>
                <input id="password" type="password" name="password" required autocomplete="current-password"
                    class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:border-[#4A5D23] focus:ring focus:ring-[#4A5D23]/20 transition outline-none text-sm">
            </div>

            <!-- Remember Me -->
            <div class="flex items-center justify-between mb-8">
                <label for="remember_me" class="inline-flex items-center">
                    <input id="remember_me" type="checkbox" name="remember" class="rounded border-gray-300 text-[#4A5D23] shadow-sm focus:ring-[#4A5D23]">
                    <span class="ml-2 text-sm text-gray-600 font-medium">Ingat saya</span>
                </label>
            </div>

            <button type="submit" id="submit-btn" 
                class="w-full py-3.5 bg-[#4A5D23] text-white text-sm font-semibold rounded-xl hover:bg-[#3b4b1c] transition shadow-md flex justify-center items-center">
                <span>Masuk Sekarang</span>
                <!-- Loading Spinner (Hidden by default) -->
                <svg id="spinner" class="hidden animate-spin ml-3 h-5 w-5 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                    <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                </svg>
            </button>
        </form>
    </div>

    <!-- AJAX LOGIC -->
    <script>
        document.getElementById('login-form').addEventListener('submit', async function(e) {
            e.preventDefault(); // Mencegah reload halaman

            let form = this;
            let submitBtn = document.getElementById('submit-btn');
            let spinner = document.getElementById('spinner');
            let errorAlert = document.getElementById('error-alert');
            
            // Ambil data form
            let formData = new FormData(form);

            // Tampilkan loading, sembunyikan error lama
            submitBtn.disabled = true;
            spinner.classList.remove('hidden');
            errorAlert.classList.add('hidden');
            errorAlert.innerHTML = '';

            try {
                let response = await fetch(form.action, {
                    method: 'POST',
                    headers: {
                        'X-Requested-With': 'XMLHttpRequest', // Memberitahu Laravel ini adalah AJAX
                        'Accept': 'application/json', // Meminta balikan berupa JSON
                    },
                    body: formData
                });

                let result = await response.json();

                if (response.ok) {
                    // Jika sukses, arahkan ke URL yang diberikan backend
                    window.location.href = result.redirect;
                } else {
                    // Jika gagal (validasi salah / kredensial salah)
                    submitBtn.disabled = false;
                    spinner.classList.add('hidden');
                    
                    errorAlert.classList.remove('hidden');
                    // Menampilkan pesan error dari Laravel (biasanya dari key 'email')
                    if(result.errors && result.errors.email) {
                        errorAlert.innerHTML = result.errors.email[0];
                    } else {
                        errorAlert.innerHTML = result.message || 'Terjadi kesalahan saat login.';
                    }
                }
            } catch (error) {
                submitBtn.disabled = false;
                spinner.classList.add('hidden');
                errorAlert.classList.remove('hidden');
                errorAlert.innerHTML = 'Koneksi terputus. Silakan coba lagi.';
            }
        });
    </script>
</body>
</html>