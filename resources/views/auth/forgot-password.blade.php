<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Reset Password - rassa.org</title>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=inter:400,500,600,700,800&display=swap" rel="stylesheet" />
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
    *,
    *::before,
    *::after {
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

    /* ─── Card enter ─── */
    .forgot-card {
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

    /* ─── Header stagger ─── */
    .header-brand {
        animation: fadeUp 0.5s 0.05s cubic-bezier(0.22, 1, 0.36, 1) both;
    }

    .header-icon {
        animation: fadeUp 0.5s 0.10s cubic-bezier(0.22, 1, 0.36, 1) both;
    }

    .header-title {
        animation: fadeUp 0.5s 0.15s cubic-bezier(0.22, 1, 0.36, 1) both;
    }

    .header-sub {
        animation: fadeUp 0.5s 0.20s cubic-bezier(0.22, 1, 0.36, 1) both;
    }

    @keyframes fadeUp {
        from {
            opacity: 0;
            transform: translateY(12px);
        }

        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    /* ─── Brand dot ─── */
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

    /* ─── Lock icon ring ─── */
    .lock-ring {
        width: 56px;
        height: 56px;
        border-radius: 50%;
        background: rgba(74, 93, 35, 0.09);
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 1rem;
        animation: ringPop 0.5s 0.1s cubic-bezier(0.22, 1, 0.36, 1) both;
    }

    @keyframes ringPop {
        from {
            transform: scale(0.6);
            opacity: 0;
        }

        to {
            transform: scale(1);
            opacity: 1;
        }
    }

    .lock-ring svg {
        width: 26px;
        height: 26px;
        stroke: #4A5D23;
        fill: none;
        stroke-width: 2;
        stroke-linecap: round;
        stroke-linejoin: round;
    }

    /* ─── Field ─── */
    .field-group {
        margin-bottom: 1.25rem;
    }

    .field-label {
        display: block;
        font-size: 0.75rem;
        font-weight: 700;
        color: #374151;
        text-transform: uppercase;
        letter-spacing: 0.055em;
        margin-bottom: 0.5rem;
        transition: color 0.2s;
    }

    .field-group:focus-within .field-label {
        color: #4A5D23;
    }

    .input-wrap input {
        width: 100%;
        padding: 0.875rem 1rem;
        border: 1.5px solid #e5e7eb;
        border-radius: 0.875rem;
        font-size: 0.875rem;
        font-family: 'Inter', sans-serif;
        font-weight: 500;
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

    .field-error {
        font-size: 0.75rem;
        color: #dc2626;
        margin-top: 0.4rem;
        display: none;
    }

    .field-error.visible {
        display: block;
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

    /* ─── Submit button ─── */
    .submit-btn {
        width: 100%;
        padding: 1rem;
        background: #4A5D23;
        color: #fff;
        font-size: 0.9rem;
        font-weight: 700;
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
        box-shadow: 0 2px 8px rgba(74, 93, 35, 0.22);
    }

    .submit-btn:disabled {
        cursor: not-allowed;
        opacity: 0.82;
    }

    .submit-btn .ripple {
        position: absolute;
        border-radius: 50%;
        background: rgba(255, 255, 255, 0.28);
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

    .btn-inner {
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 0.5rem;
    }

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

    /* ─── Success state (ganti tampilan card) ─── */
    .success-view {
        display: none;
        flex-direction: column;
        align-items: center;
        text-align: center;
        padding: 0.5rem 0 0.75rem;
        animation: fadeUp 0.5s cubic-bezier(0.22, 1, 0.36, 1) both;
    }

    .success-view.visible {
        display: flex;
    }

    .form-view.hidden {
        display: none;
    }

    .success-circle {
        width: 68px;
        height: 68px;
        border-radius: 50%;
        background: #4A5D23;
        display: flex;
        align-items: center;
        justify-content: center;
        margin-bottom: 1.25rem;
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

    .success-circle svg {
        width: 32px;
        height: 32px;
        stroke: #fff;
        fill: none;
        stroke-width: 2.5;
        stroke-linecap: round;
        stroke-linejoin: round;
        stroke-dasharray: 50;
        stroke-dashoffset: 50;
        animation: drawCheck 0.45s 0.25s ease forwards;
    }

    @keyframes drawCheck {
        to {
            stroke-dashoffset: 0;
        }
    }

    .success-title {
        font-size: 1.0625rem;
        font-weight: 700;
        color: #1f2937;
        margin-bottom: 0.5rem;
    }

    .success-body {
        font-size: 0.8125rem;
        color: #6b7280;
        line-height: 1.6;
        max-width: 280px;
    }

    .success-body .email-highlight {
        font-weight: 600;
        color: #4A5D23;
    }

    .resend-hint {
        margin-top: 1.25rem;
        font-size: 0.75rem;
        color: #9ca3af;
    }

    .resend-hint button {
        background: none;
        border: none;
        color: #4A5D23;
        font-weight: 600;
        font-family: 'Inter', sans-serif;
        font-size: 0.75rem;
        cursor: pointer;
        padding: 0;
        transition: opacity 0.2s;
    }

    .resend-hint button:hover {
        opacity: 0.7;
        text-decoration: underline;
    }

    .resend-hint button:disabled {
        opacity: 0.4;
        cursor: not-allowed;
        text-decoration: none;
    }

    /* ─── Countdown ─── */
    #countdown-wrap {
        display: none;
    }

    #countdown-wrap.visible {
        display: inline;
    }

    /* ─── Divider ─── */
    .divider {
        height: 1px;
        background: #f0eeea;
        margin: 1.25rem 0;
    }

    /* ─── Back link ─── */
    .back-link {
        display: inline-flex;
        align-items: center;
        gap: 5px;
        font-size: 0.8125rem;
        font-weight: 600;
        color: #9ca3af;
        text-decoration: none;
        transition: color 0.2s;
    }

    .back-link:hover {
        color: #4A5D23;
    }

    .back-link svg {
        width: 14px;
        height: 14px;
        stroke: currentColor;
        fill: none;
        stroke-width: 2.2;
        stroke-linecap: round;
        stroke-linejoin: round;
    }
    </style>
</head>

<body>

    <div class="w-full max-w-md">

        <!-- Header -->
        <div class="text-center mb-8">
            <div class="header-brand">
                <a href="/" class="text-4xl font-extrabold tracking-tighter text-[#4A5D23]">
                    rassa<span class="brand-dot"></span>
                </a>
            </div>
        </div>

        <!-- Card -->
        <div
            class="forgot-card bg-white p-8 rounded-[2rem] border border-gray-100 shadow-[0_8px_40px_rgba(0,0,0,0.06)]">

            <!-- Form view -->
            <div id="form-view" class="form-view">

                <!-- Lock icon + title -->
                <div class="text-center mb-7">
                    <div class="header-icon">
                        <div class="lock-ring">
                            <svg viewBox="0 0 24 24">
                                <rect x="3" y="11" width="18" height="11" rx="2" ry="2" />
                                <path d="M7 11V7a5 5 0 0110 0v4" />
                            </svg>
                        </div>
                    </div>
                    <h2 class="header-title text-xl font-black text-gray-900">Lupa Sandi?</h2>
                    <p class="header-sub mt-2 text-sm text-gray-500 leading-relaxed">
                        Jangan khawatir. Masukkan email Anda dan kami akan mengirimkan tautan untuk mengatur ulang
                        sandi.
                    </p>
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

                <form id="forgot-form" method="POST" action="{{ route('password.email') }}" novalidate>
                    @csrf

                    <div class="field-group">
                        <label for="email" class="field-label">Email Anda</label>
                        <div class="input-wrap">
                            <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus
                                autocomplete="email" placeholder="nama@email.com" />
                        </div>
                        <div class="field-error" id="err-email"></div>
                        @error('email')
                        <div class="field-error visible">{{ $message }}</div>
                        @enderror
                    </div>

                    <button type="submit" class="submit-btn" id="submit-btn">
                        <div class="btn-inner">
                            <div class="spinner" id="spinner"></div>
                            <span class="btn-text" id="btn-text">Kirim Tautan Reset</span>
                        </div>
                    </button>

                </form>

                @if (session('status'))
                <div
                    class="mt-4 p-3 bg-green-50 border border-green-100 text-green-700 text-xs font-semibold rounded-xl">
                    {{ session('status') }}
                </div>
                @endif

            </div>

            <!-- Success view (ditampilkan setelah AJAX sukses) -->
            <div id="success-view" class="success-view">
                <div class="success-circle">
                    <svg viewBox="0 0 24 24">
                        <polyline points="20 6 9 17 4 12" />
                    </svg>
                </div>
                <div class="success-title">Email terkirim!</div>
                <p class="success-body">
                    Tautan reset sandi telah dikirim ke<br>
                    <span class="email-highlight" id="sent-email"></span>
                </p>
                <p class="success-body mt-2" style="font-size:0.75rem;">
                    Periksa folder <strong>Spam</strong> jika tidak ada di inbox.
                </p>
                <div class="resend-hint">
                    Tidak menerima email?
                    <button id="resend-btn" disabled>
                        Kirim ulang
                        <span id="countdown-wrap" class="visible">(<span id="countdown">60</span>s)</span>
                    </button>
                </div>
            </div>

        </div>

        <!-- Back to login -->
        <div class="text-center mt-7">
            <a href="{{ route('login') }}" class="back-link">
                <svg viewBox="0 0 24 24">
                    <polyline points="15 18 9 12 15 6" />
                </svg>
                Kembali ke Login
            </a>
        </div>

        <div class="text-center mt-4">
            <p class="text-xs text-gray-400">&copy; {{ date('Y') }} rassa.org &mdash; Semua hak dilindungi</p>
        </div>

    </div>

    <script>
    (function() {

        /* ─── Ripple ─── */
        const submitBtn = document.getElementById('submit-btn');

        submitBtn.addEventListener('click', function(e) {
            const ripple = document.createElement('span');
            const rect = submitBtn.getBoundingClientRect();
            const size = Math.max(rect.width, rect.height);
            ripple.className = 'ripple';
            ripple.style.cssText =
                `width:${size}px;height:${size}px;left:${e.clientX-rect.left-size/2}px;top:${e.clientY-rect.top-size/2}px;`;
            submitBtn.appendChild(ripple);
            ripple.addEventListener('animationend', () => ripple.remove());
        });

        /* ─── Helpers ─── */
        function showError(msg) {
            const alert = document.getElementById('error-alert');
            const span = document.getElementById('error-msg');
            alert.classList.remove('visible');
            void alert.offsetWidth;
            span.textContent = msg;
            alert.classList.add('visible');
            document.getElementById('email').classList.add('error-state');
        }

        function clearError() {
            document.getElementById('error-alert').classList.remove('visible');
            document.getElementById('email').classList.remove('error-state');
            document.getElementById('err-email').classList.remove('visible');
            document.getElementById('err-email').textContent = '';
        }

        function setLoading(on) {
            const spinner = document.getElementById('spinner');
            const text = document.getElementById('btn-text');
            submitBtn.disabled = on;
            submitBtn.classList.toggle('loading', on);
            spinner.style.display = on ? 'block' : 'none';
            text.textContent = on ? 'Mengirim...' : 'Kirim Tautan Reset';
        }

        document.getElementById('email').addEventListener('input', clearError);

        /* ─── Countdown untuk resend ─── */
        let countdownTimer = null;

        function startCountdown(seconds) {
            const btn = document.getElementById('resend-btn');
            const wrap = document.getElementById('countdown-wrap');
            const count = document.getElementById('countdown');
            let left = seconds;

            btn.disabled = true;
            wrap.classList.add('visible');
            count.textContent = left;

            countdownTimer = setInterval(() => {
                left--;
                count.textContent = left;
                if (left <= 0) {
                    clearInterval(countdownTimer);
                    btn.disabled = false;
                    wrap.classList.remove('visible');
                }
            }, 1000);
        }

        /* ─── Show success state ─── */
        function showSuccess(email) {
            document.getElementById('sent-email').textContent = email;
            document.getElementById('form-view').classList.add('hidden');
            document.getElementById('success-view').classList.add('visible');
            startCountdown(60);
        }

        /* ─── Resend button ─── */
        document.getElementById('resend-btn').addEventListener('click', async function() {
            const email = document.getElementById('sent-email').textContent;
            if (!email) return;

            this.disabled = true;

            try {
                const response = await fetch(document.getElementById('forgot-form').action, {
                    method: 'POST',
                    headers: {
                        'X-Requested-With': 'XMLHttpRequest',
                        'Accept': 'application/json',
                    },
                    body: (() => {
                        const fd = new FormData();
                        fd.append('email', email);
                        fd.append('_token', document.querySelector('[name=_token]')
                            .value);
                        return fd;
                    })(),
                });
                // Apapun hasilnya, mulai countdown lagi
            } catch (_) {}

            startCountdown(60);
        });

        /* ─── AJAX Submit ─── */
        document.getElementById('forgot-form').addEventListener('submit', async function(e) {
            e.preventDefault();
            clearError();

            const email = document.getElementById('email').value.trim();

            // Client-side validation
            if (!email) {
                const err = document.getElementById('err-email');
                err.textContent = 'Email tidak boleh kosong.';
                err.classList.add('visible');
                document.getElementById('email').classList.add('error-state');
                document.getElementById('email').focus();
                return;
            }
            if (!email.includes('@') || !email.includes('.')) {
                const err = document.getElementById('err-email');
                err.textContent = 'Format email tidak valid.';
                err.classList.add('visible');
                document.getElementById('email').classList.add('error-state');
                document.getElementById('email').focus();
                return;
            }

            setLoading(true);

            const minDelay = new Promise(r => setTimeout(r, 700));
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
                    setLoading(false);
                    showSuccess(email);
                } else {
                    setLoading(false);
                    if (result.errors && result.errors.email) {
                        showError(result.errors.email[0]);
                    } else {
                        showError(result.message || 'Terjadi kesalahan. Silakan coba lagi.');
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