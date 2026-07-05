<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login - rassa.org</title>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=inter:400,500,600,700,800&display=swap" rel="stylesheet" />
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
    /* ─── Custom styles (pelengkap Tailwind) ─── */
    * {
        box-sizing: border-box;
    }

    body {
        font-family: 'Inter', sans-serif;
        background: #f6f5f0;
        min-height: 100vh;
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 1.5rem;
    }

    /* ─── Card enter animation ─── */
    .login-card {
        animation: cardIn 0.55s cubic-bezier(0.22, 1, 0.36, 1) both;
    }

    @keyframes cardIn {
        from {
            opacity: 0;
            transform: translateY(22px) scale(0.97);
        }

        to {
            opacity: 1;
            transform: translateY(0) scale(1);
        }
    }

    /* ─── Brand pulse ─── */
    .brand-dot {
        display: inline-block;
        width: 6px;
        height: 6px;
        border-radius: 50%;
        background: #4A5D23;
        margin-left: 1px;
        vertical-align: middle;
        animation: dotPulse 2.2s ease-in-out infinite;
    }

    @keyframes dotPulse {

        0%,
        100% {
            transform: scale(1);
            opacity: 1;
        }

        50% {
            transform: scale(1.5);
            opacity: 0.5;
        }
    }

    /* ─── Input wrapper ─── */
    .input-wrap {
        position: relative;
    }

    .input-wrap input {
        width: 100%;
        padding: 0.875rem 1rem;
        border: 1.5px solid #e5e7eb;
        border-radius: 0.875rem;
        font-size: 0.875rem;
        font-family: 'Inter', sans-serif;
        background: #fafaf9;
        color: #111;
        outline: none;
        transition: border-color 0.2s, box-shadow 0.2s, background 0.2s;
    }

    .input-wrap input:focus {
        border-color: #4A5D23;
        box-shadow: 0 0 0 3px rgba(74, 93, 35, 0.12);
        background: #fff;
    }

    .input-wrap input.error-state {
        border-color: #ef4444;
        box-shadow: 0 0 0 3px rgba(239, 68, 68, 0.10);
    }

    /* ─── Input field label float ─── */
    .field-group {
        position: relative;
        margin-bottom: 1.25rem;
    }

    .field-label {
        display: block;
        font-size: 0.8125rem;
        font-weight: 600;
        color: #374151;
        margin-bottom: 0.5rem;
        letter-spacing: 0.01em;
        transition: color 0.2s;
    }

    .field-group:focus-within .field-label {
        color: #4A5D23;
    }

    /* ─── Eye toggle button ─── */
    .eye-btn {
        position: absolute;
        right: 0.875rem;
        top: 50%;
        transform: translateY(-50%);
        background: none;
        border: none;
        cursor: pointer;
        padding: 4px;
        color: #9ca3af;
        display: flex;
        align-items: center;
        justify-content: center;
        transition: color 0.2s;
        border-radius: 6px;
    }

    .eye-btn:hover {
        color: #4A5D23;
    }

    .eye-btn svg {
        width: 18px;
        height: 18px;
        stroke: currentColor;
        fill: none;
        stroke-width: 1.8;
        stroke-linecap: round;
        stroke-linejoin: round;
        transition: opacity 0.15s;
    }

    /* password input padding untuk icon mata */
    #password {
        padding-right: 2.75rem;
    }

    /* ─── Submit button ─── */
    .submit-btn {
        width: 100%;
        padding: 0.9375rem;
        background: #4A5D23;
        color: #fff;
        font-size: 0.9rem;
        font-weight: 600;
        border: none;
        border-radius: 0.875rem;
        cursor: pointer;
        font-family: 'Inter', sans-serif;
        letter-spacing: 0.01em;
        position: relative;
        overflow: hidden;
        transition: background 0.2s, transform 0.15s, box-shadow 0.2s;
        box-shadow: 0 4px 14px rgba(74, 93, 35, 0.28);
    }

    .submit-btn:hover:not(:disabled) {
        background: #3b4b1c;
        box-shadow: 0 6px 20px rgba(74, 93, 35, 0.38);
        transform: translateY(-1px);
    }

    .submit-btn:active:not(:disabled) {
        transform: translateY(0);
        box-shadow: 0 2px 8px rgba(74, 93, 35, 0.25);
    }

    .submit-btn:disabled {
        cursor: not-allowed;
        opacity: 0.85;
    }

    /* Ripple effect */
    .submit-btn .ripple {
        position: absolute;
        border-radius: 50%;
        background: rgba(255, 255, 255, 0.3);
        transform: scale(0);
        animation: rippleAnim 0.55s linear;
        pointer-events: none;
    }

    @keyframes rippleAnim {
        to {
            transform: scale(4);
            opacity: 0;
        }
    }

    /* ─── Button inner layout ─── */
    .btn-inner {
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 0.5rem;
        transition: opacity 0.2s;
    }

    /* ─── Spinner ─── */
    .spinner {
        width: 18px;
        height: 18px;
        border: 2.5px solid rgba(255, 255, 255, 0.35);
        border-top-color: #fff;
        border-radius: 50%;
        animation: spin 0.7s linear infinite;
        display: none;
    }

    @keyframes spin {
        to {
            transform: rotate(360deg);
        }
    }

    .submit-btn.loading .spinner {
        display: block;
    }

    .submit-btn.loading .btn-text {
        opacity: 0.7;
    }

    /* ─── Error alert ─── */
    .error-alert {
        display: none;
        margin-bottom: 1.25rem;
        padding: 0.875rem 1rem;
        background: #fef2f2;
        border: 1px solid #fecaca;
        border-radius: 0.875rem;
        color: #dc2626;
        font-size: 0.8125rem;
        font-weight: 500;
        align-items: flex-start;
        gap: 0.5rem;
        animation: shakeIn 0.4s cubic-bezier(0.36, 0.07, 0.19, 0.97);
    }

    .error-alert.visible {
        display: flex;
    }

    @keyframes shakeIn {
        0% {
            transform: translateX(0);
        }

        15% {
            transform: translateX(-6px);
        }

        30% {
            transform: translateX(5px);
        }

        45% {
            transform: translateX(-4px);
        }

        60% {
            transform: translateX(3px);
        }

        75% {
            transform: translateX(-2px);
        }

        100% {
            transform: translateX(0);
        }
    }

    .error-alert svg {
        width: 15px;
        height: 15px;
        flex-shrink: 0;
        stroke: #dc2626;
        fill: none;
        stroke-width: 2;
        stroke-linecap: round;
        stroke-linejoin: round;
        margin-top: 1px;
    }

    /* ─── Success state ─── */
    .success-overlay {
        display: none;
        position: fixed;
        inset: 0;
        background: rgba(246, 245, 240, 0.85);
        backdrop-filter: blur(4px);
        z-index: 50;
        align-items: center;
        justify-content: center;
        flex-direction: column;
        gap: 1rem;
    }

    .success-overlay.visible {
        display: flex;
    }

    .success-icon {
        width: 64px;
        height: 64px;
        border-radius: 50%;
        background: #4A5D23;
        display: flex;
        align-items: center;
        justify-content: center;
        animation: popIn 0.4s cubic-bezier(0.22, 1, 0.36, 1);
    }

    @keyframes popIn {
        from {
            transform: scale(0.5);
            opacity: 0;
        }

        to {
            transform: scale(1);
            opacity: 1;
        }
    }

    .success-icon svg {
        width: 30px;
        height: 30px;
        stroke: #fff;
        fill: none;
        stroke-width: 2.5;
        stroke-linecap: round;
        stroke-linejoin: round;
        stroke-dasharray: 50;
        stroke-dashoffset: 50;
        animation: drawCheck 0.45s 0.2s ease forwards;
    }

    @keyframes drawCheck {
        to {
            stroke-dashoffset: 0;
        }
    }

    .success-text {
        font-size: 0.9375rem;
        font-weight: 600;
        color: #374151;
        animation: fadeUp 0.4s 0.35s ease both;
    }

    @keyframes fadeUp {
        from {
            opacity: 0;
            transform: translateY(8px);
        }

        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    /* ─── Checkbox custom ─── */
    input[type="checkbox"] {
        width: 15px;
        height: 15px;
        accent-color: #4A5D23;
        cursor: pointer;
    }

    /* ─── Divider ─── */
    .divider {
        height: 1px;
        background: #f0eeea;
        margin: 1.5rem 0;
    }

    /* ─── Strength bar (bonus visual) ─── */
    .field-hint {
        font-size: 0.72rem;
        color: #9ca3af;
        margin-top: 0.375rem;
    }
    </style>
</head>

<body>

    <!-- ─── Success Overlay ─── -->
    <div class="success-overlay" id="success-overlay">
        <div class="success-icon">
            <svg viewBox="0 0 24 24">
                <polyline points="20 6 9 17 4 12" />
            </svg>
        </div>
        <div class="success-text">Login berhasil, mengalihkan...</div>
    </div>

    <!-- ─── Card ─── -->
    <div
        class="login-card w-full max-w-md bg-white rounded-3xl shadow-[0_8px_40px_rgba(0,0,0,0.06)] border border-gray-100 p-10">

        <!-- Brand -->
        <div class="text-center mb-9">
            <a href="/" class="text-3xl font-extrabold tracking-tighter text-[#4A5D23]">
                rassa<span class="brand-dot"></span>
            </a>
            <p class="text-sm text-gray-400 mt-2 font-medium">Masuk ke ruang kerja Anda</p>
        </div>

        <!-- Error Alert -->
        <div id="error-alert" class="error-alert" role="alert">
            <svg viewBox="0 0 24 24">
                <circle cx="12" cy="12" r="10" />
                <line x1="12" y1="8" x2="12" y2="12" />
                <line x1="12" y1="16" x2="12.01" y2="16" />
            </svg>
            <span id="error-msg">Terjadi kesalahan.</span>
        </div>

        <form id="login-form" method="POST" action="{{ route('login') }}" novalidate>
            @csrf

            <!-- Email -->
            <div class="field-group">
                <label for="email" class="field-label">Email</label>
                <div class="input-wrap">
                    <input id="email" type="email" name="email" required autofocus autocomplete="username"
                        placeholder="nama@email.com" />
                </div>
            </div>

            <!-- Password -->
            <div class="field-group" style="margin-bottom: 1rem;">
                <label for="password" class="field-label">Password</label>
                <div class="input-wrap" style="position: relative;">
                    <input id="password" type="password" name="password" required autocomplete="current-password"
                        placeholder="••••••••" />
                    <!-- Eye toggle -->
                    <button type="button" class="eye-btn" id="eye-toggle" aria-label="Tampilkan password"
                        title="Tampilkan password">
                        <!-- Eye open (shown when password hidden) -->
                        <svg id="icon-eye-open" viewBox="0 0 24 24">
                            <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z" />
                            <circle cx="12" cy="12" r="3" />
                        </svg>
                        <!-- Eye closed (shown when password visible) -->
                        <svg id="icon-eye-closed" viewBox="0 0 24 24" style="display:none;">
                            <path
                                d="M17.94 17.94A10.07 10.07 0 0112 20c-7 0-11-8-11-8a18.45 18.45 0 015.06-5.94M9.9 4.24A9.12 9.12 0 0112 4c7 0 11 8 11 8a18.5 18.5 0 01-2.16 3.19m-6.72-1.07a3 3 0 11-4.24-4.24" />
                            <line x1="1" y1="1" x2="23" y2="23" />
                        </svg>
                    </button>
                </div>
            </div>

            <!-- Remember Me -->
            <div class="flex items-center justify-between mb-7">
                <label for="remember_me" class="inline-flex items-center gap-2 cursor-pointer">
                    <input id="remember_me" type="checkbox" name="remember">
                    <span class="text-sm text-gray-500 font-medium select-none">Ingat saya</span>
                </label>
                <span class="text-xs text-gray-400">v1.0</span>
            </div>

            <!-- Submit -->
            <button type="submit" class="submit-btn" id="submit-btn">
                <div class="btn-inner">
                    <div class="spinner" id="spinner"></div>
                    <span class="btn-text" id="btn-text">Masuk Sekarang</span>
                </div>
            </button>

        </form>

        <div class="divider"></div>
        <p class="text-center text-sm text-gray-500 font-medium mt-6">
            Belum memiliki akun?
            <a href="{{ route('register') }}" class="font-bold text-[#4A5D23] hover:underline transition">Daftar
                Member</a>
        </p>

        <div class="divider"></div>

        <p class="text-center text-xs text-gray-400">
            &copy; {{ date('Y') }} rassa.org &mdash; Semua hak dilindungi
        </p>
    </div>

    <script>
    (function() {
        /* ─── Eye toggle ─── */
        const eyeToggle = document.getElementById('eye-toggle');
        const passwordInput = document.getElementById('password');
        const iconOpen = document.getElementById('icon-eye-open');
        const iconClosed = document.getElementById('icon-eye-closed');

        eyeToggle.addEventListener('click', function() {
            const isHidden = passwordInput.type === 'password';
            passwordInput.type = isHidden ? 'text' : 'password';
            iconOpen.style.display = isHidden ? 'none' : 'block';
            iconClosed.style.display = isHidden ? 'block' : 'none';
            eyeToggle.setAttribute('aria-label', isHidden ? 'Sembunyikan password' : 'Tampilkan password');
            eyeToggle.setAttribute('title', isHidden ? 'Sembunyikan password' : 'Tampilkan password');
            // Fokus kembali ke input agar UX lebih smooth
            passwordInput.focus();
        });

        /* ─── Ripple effect on button ─── */
        const submitBtn = document.getElementById('submit-btn');

        submitBtn.addEventListener('click', function(e) {
            const ripple = document.createElement('span');
            const rect = submitBtn.getBoundingClientRect();
            const size = Math.max(rect.width, rect.height);
            ripple.className = 'ripple';
            ripple.style.cssText = `
            width: ${size}px; height: ${size}px;
            left: ${e.clientX - rect.left - size / 2}px;
            top:  ${e.clientY - rect.top  - size / 2}px;
        `;
            submitBtn.appendChild(ripple);
            ripple.addEventListener('animationend', () => ripple.remove());
        });

        /* ─── Helper: set error state ─── */
        function showError(msg) {
            const alert = document.getElementById('error-alert');
            const span = document.getElementById('error-msg');
            // Reset animasi dengan re-insert
            alert.classList.remove('visible');
            void alert.offsetWidth; // trigger reflow
            span.textContent = msg;
            alert.classList.add('visible');

            // Error state pada input
            document.getElementById('email').classList.add('error-state');
            document.getElementById('password').classList.add('error-state');
        }

        function clearError() {
            document.getElementById('error-alert').classList.remove('visible');
            document.getElementById('email').classList.remove('error-state');
            document.getElementById('password').classList.remove('error-state');
        }

        /* ─── Helper: button states ─── */
        function setLoading(on) {
            const btn = document.getElementById('submit-btn');
            const spinner = document.getElementById('spinner');
            const text = document.getElementById('btn-text');

            if (on) {
                btn.disabled = true;
                btn.classList.add('loading');
                spinner.style.display = 'block';
                text.textContent = 'Memverifikasi...';
            } else {
                btn.disabled = false;
                btn.classList.remove('loading');
                spinner.style.display = 'none';
                text.textContent = 'Masuk Sekarang';
            }
        }

        /* ─── Clear error saat user mulai mengetik ─── */
        ['email', 'password'].forEach(id => {
            document.getElementById(id).addEventListener('input', clearError);
        });

        /* ─── AJAX Submit ─── */
        document.getElementById('login-form').addEventListener('submit', async function(e) {
            e.preventDefault();
            clearError();

            // Client-side validation ringan
            const email = document.getElementById('email').value.trim();
            const password = document.getElementById('password').value;

            if (!email) {
                showError('Email tidak boleh kosong.');
                document.getElementById('email').focus();
                return;
            }
            if (!email.includes('@')) {
                showError('Format email tidak valid.');
                document.getElementById('email').focus();
                return;
            }
            if (!password) {
                showError('Password tidak boleh kosong.');
                document.getElementById('password').focus();
                return;
            }

            setLoading(true);

            // Tambahkan sedikit delay minimum agar spinner tidak kedip sesaat
            const minDelay = new Promise(r => setTimeout(r, 600));
            const fetchData = fetch(this.action, {
                method: 'POST',
                headers: {
                    'X-Requested-With': 'XMLHttpRequest',
                    'Accept': 'application/json',
                },
                body: new FormData(this),
            });

            try {
                const [response] = await Promise.all([fetchData, minDelay]);

                let result;
                try {
                    result = await response.json();
                } catch {
                    throw new Error('Respons server tidak valid.');
                }

                if (response.ok) {
                    // Tampilkan success overlay sebelum redirect
                    document.getElementById('success-overlay').classList.add('visible');
                    setTimeout(() => {
                        window.location.href = result.redirect || '/';
                    }, 900);
                } else {
                    setLoading(false);

                    // Parsing error Laravel
                    if (result.errors) {
                        const firstKey = Object.keys(result.errors)[0];
                        showError(result.errors[firstKey][0]);
                    } else if (result.message) {
                        showError(result.message);
                    } else {
                        showError('Email atau password salah.');
                    }
                }
            } catch (err) {
                setLoading(false);
                if (err.message === 'Failed to fetch') {
                    showError('Koneksi bermasalah. Periksa internet Anda dan coba lagi.');
                } else {
                    showError(err.message || 'Terjadi kesalahan. Silakan coba lagi.');
                }
            }
        });
    })();
    </script>

</body>

</html>