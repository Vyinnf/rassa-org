<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Daftar Member - rassa.org</title>
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
    .register-card {
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

    /* ─── Header staggered fade-in ─── */
    .header-brand {
        animation: fadeUp 0.5s 0.05s cubic-bezier(0.22, 1, 0.36, 1) both;
    }

    .header-title {
        animation: fadeUp 0.5s 0.12s cubic-bezier(0.22, 1, 0.36, 1) both;
    }

    .header-sub {
        animation: fadeUp 0.5s 0.18s cubic-bezier(0.22, 1, 0.36, 1) both;
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

    /* ─── Points badge ─── */
    .points-badge {
        display: inline-flex;
        align-items: center;
        gap: 4px;
        padding: 3px 10px;
        background: rgba(74, 93, 35, 0.10);
        color: #4A5D23;
        border-radius: 20px;
        font-weight: 700;
        font-size: 0.875rem;
        animation: badgePop 0.5s 0.35s cubic-bezier(0.22, 1, 0.36, 1) both;
    }

    @keyframes badgePop {
        from {
            transform: scale(0.75);
            opacity: 0;
        }

        to {
            transform: scale(1);
            opacity: 1;
        }
    }

    /* ─── Field group ─── */
    .field-group {
        margin-bottom: 1.125rem;
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

    /* ─── Input ─── */
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

    .input-wrap input.success-state {
        border-color: #16a34a;
        box-shadow: 0 0 0 3px rgba(22, 163, 74, 0.10);
    }

    /* ─── Eye toggle ─── */
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
    }

    #password,
    #password_confirmation {
        padding-right: 2.75rem;
    }

    /* ─── Password strength bar ─── */
    .strength-wrap {
        margin-top: 0.5rem;
        display: none;
    }

    .strength-wrap.visible {
        display: block;
    }

    .strength-bars {
        display: flex;
        gap: 4px;
        margin-bottom: 4px;
    }

    .strength-bar {
        flex: 1;
        height: 4px;
        border-radius: 2px;
        background: #e5e7eb;
        transition: background 0.3s;
    }

    .strength-bar.weak {
        background: #ef4444;
    }

    .strength-bar.medium {
        background: #f59e0b;
    }

    .strength-bar.strong {
        background: #16a34a;
    }

    .strength-label {
        font-size: 0.72rem;
        color: #9ca3af;
        transition: color 0.2s;
    }

    /* ─── Confirm match indicator ─── */
    .match-hint {
        font-size: 0.72rem;
        margin-top: 0.35rem;
        display: none;
        align-items: center;
        gap: 4px;
    }

    .match-hint.visible {
        display: flex;
    }

    .match-hint.ok {
        color: #16a34a;
    }

    .match-hint.bad {
        color: #ef4444;
    }

    .match-hint svg {
        width: 12px;
        height: 12px;
        stroke: currentColor;
        fill: none;
        stroke-width: 2.5;
        stroke-linecap: round;
        stroke-linejoin: round;
        flex-shrink: 0;
    }

    /* ─── Error messages ─── */
    .field-error {
        font-size: 0.75rem;
        color: #dc2626;
        margin-top: 0.375rem;
        display: none;
    }

    .field-error.visible {
        display: block;
    }

    /* ─── Global error alert ─── */
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
        margin-top: 0.5rem;
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

    /* ─── Success overlay ─── */
    .success-overlay {
        display: none;
        position: fixed;
        inset: 0;
        background: rgba(246, 245, 240, 0.88);
        backdrop-filter: blur(6px);
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
        width: 68px;
        height: 68px;
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
        font-size: 1.125rem;
        font-weight: 700;
        color: #1f2937;
        animation: fadeUp 0.4s 0.4s ease both;
    }

    .success-sub {
        font-size: 0.875rem;
        color: #6b7280;
        animation: fadeUp 0.4s 0.5s ease both;
        display: flex;
        align-items: center;
        gap: 5px;
    }

    .success-sub .points {
        background: rgba(74, 93, 35, 0.12);
        color: #4A5D23;
        font-weight: 700;
        padding: 2px 8px;
        border-radius: 20px;
    }

    /* ─── Divider ─── */
    .divider {
        height: 1px;
        background: #f0eeea;
        margin: 1.25rem 0;
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
        <div class="success-title">Akun berhasil dibuat!</div>
        <div class="success-sub">
            Selamat, kamu mendapat <span class="points">+100 Poin</span> perdana 🎉
        </div>
    </div>

    <!-- ─── Wrapper ─── -->
    <div class="w-full max-w-md">

        <!-- Header -->
        <div class="text-center mb-8">
            <div class="header-brand">
                <a href="/" class="text-4xl font-extrabold tracking-tighter text-[#4A5D23]">
                    rassa<span class="brand-dot"></span>
                </a>
            </div>
            <h2 class="header-title mt-5 text-2xl font-bold text-gray-900">Bergabung Bersama Kami</h2>
            <p class="header-sub mt-2 text-sm text-gray-500 font-medium leading-relaxed">
                Daftar sekarang dan langsung dapatkan
                <span class="points-badge">⭐ 100 Poin</span>
                perdana Anda secara gratis!
            </p>
        </div>

        <!-- Card -->
        <div
            class="register-card bg-white p-8 rounded-[2rem] border border-gray-100 shadow-[0_8px_40px_rgba(0,0,0,0.06)]">

            <!-- Error Alert -->
            <div id="error-alert" class="error-alert" role="alert">
                <svg viewBox="0 0 24 24">
                    <circle cx="12" cy="12" r="10" />
                    <line x1="12" y1="8" x2="12" y2="12" />
                    <line x1="12" y1="16" x2="12.01" y2="16" />
                </svg>
                <span id="error-msg">Terjadi kesalahan.</span>
            </div>

            <form id="register-form" method="POST" action="{{ route('register') }}" novalidate>
                @csrf

                <!-- Name -->
                <div class="field-group">
                    <label for="name" class="field-label">Nama Lengkap</label>
                    <div class="input-wrap">
                        <input id="name" type="text" name="name" value="{{ old('name') }}" required autofocus
                            autocomplete="name" placeholder="John Doe" />
                    </div>
                    <div class="field-error" id="err-name"></div>
                    @error('name')
                    <div class="field-error visible">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Email -->
                <div class="field-group">
                    <label for="email" class="field-label">Alamat Email</label>
                    <div class="input-wrap">
                        <input id="email" type="email" name="email" value="{{ old('email') }}" required
                            autocomplete="username" placeholder="nama@email.com" />
                    </div>
                    <div class="field-error" id="err-email"></div>
                    @error('email')
                    <div class="field-error visible">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Password -->
                <div class="field-group">
                    <label for="password" class="field-label">Kata Sandi</label>
                    <div class="input-wrap">
                        <input id="password" type="password" name="password" required autocomplete="new-password"
                            placeholder="Minimal 8 karakter" />
                        <button type="button" class="eye-btn" id="eye-password" aria-label="Tampilkan password"
                            title="Tampilkan password">
                            <svg id="eye-pw-open" viewBox="0 0 24 24">
                                <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z" />
                                <circle cx="12" cy="12" r="3" />
                            </svg>
                            <svg id="eye-pw-closed" viewBox="0 0 24 24" style="display:none;">
                                <path
                                    d="M17.94 17.94A10.07 10.07 0 0112 20c-7 0-11-8-11-8a18.45 18.45 0 015.06-5.94M9.9 4.24A9.12 9.12 0 0112 4c7 0 11 8 11 8a18.5 18.5 0 01-2.16 3.19m-6.72-1.07a3 3 0 11-4.24-4.24" />
                                <line x1="1" y1="1" x2="23" y2="23" />
                            </svg>
                        </button>
                    </div>
                    <!-- Password strength -->
                    <div class="strength-wrap" id="strength-wrap">
                        <div class="strength-bars">
                            <div class="strength-bar" id="sb1"></div>
                            <div class="strength-bar" id="sb2"></div>
                            <div class="strength-bar" id="sb3"></div>
                            <div class="strength-bar" id="sb4"></div>
                        </div>
                        <div class="strength-label" id="strength-label">Masukkan password</div>
                    </div>
                    <div class="field-error" id="err-password"></div>
                    @error('password')
                    <div class="field-error visible">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Confirm Password -->
                <div class="field-group">
                    <label for="password_confirmation" class="field-label">Konfirmasi Sandi</label>
                    <div class="input-wrap">
                        <input id="password_confirmation" type="password" name="password_confirmation" required
                            autocomplete="new-password" placeholder="Ulangi kata sandi Anda" />
                        <button type="button" class="eye-btn" id="eye-confirm"
                            aria-label="Tampilkan konfirmasi password" title="Tampilkan konfirmasi">
                            <svg id="eye-cf-open" viewBox="0 0 24 24">
                                <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z" />
                                <circle cx="12" cy="12" r="3" />
                            </svg>
                            <svg id="eye-cf-closed" viewBox="0 0 24 24" style="display:none;">
                                <path
                                    d="M17.94 17.94A10.07 10.07 0 0112 20c-7 0-11-8-11-8a18.45 18.45 0 015.06-5.94M9.9 4.24A9.12 9.12 0 0112 4c7 0 11 8 11 8a18.5 18.5 0 01-2.16 3.19m-6.72-1.07a3 3 0 11-4.24-4.24" />
                                <line x1="1" y1="1" x2="23" y2="23" />
                            </svg>
                        </button>
                    </div>
                    <!-- Match indicator -->
                    <div class="match-hint" id="match-hint">
                        <svg id="match-icon" viewBox="0 0 24 24"></svg>
                        <span id="match-text"></span>
                    </div>
                    <div class="field-error" id="err-confirm"></div>
                    @error('password_confirmation')
                    <div class="field-error visible">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Submit -->
                <button type="submit" class="submit-btn" id="submit-btn">
                    <div class="btn-inner">
                        <div class="spinner" id="spinner"></div>
                        <span class="btn-text" id="btn-text">Buat Akun Member</span>
                    </div>
                </button>

            </form>
        </div>

        <!-- Link to Login -->
        <div class="text-center mt-7">
            <p class="text-sm text-gray-500 font-medium">
                Sudah memiliki akun?
                <a href="{{ route('login') }}" class="font-bold text-[#4A5D23] hover:underline transition">Masuk di
                    sini</a>
            </p>
        </div>

        <div class="text-center mt-4">
            <p class="text-xs text-gray-400">&copy; {{ date('Y') }} rassa.org &mdash; Semua hak dilindungi</p>
        </div>

    </div>

    <script>
    (function() {

        /* ─── Eye toggle helper ─── */
        function makeEyeToggle(btnId, inputId, openId, closedId) {
            const btn = document.getElementById(btnId);
            const input = document.getElementById(inputId);
            const open = document.getElementById(openId);
            const closed = document.getElementById(closedId);

            btn.addEventListener('click', function() {
                const isHidden = input.type === 'password';
                input.type = isHidden ? 'text' : 'password';
                open.style.display = isHidden ? 'none' : 'block';
                closed.style.display = isHidden ? 'block' : 'none';
                btn.setAttribute('aria-label', isHidden ? 'Sembunyikan password' : 'Tampilkan password');
                btn.setAttribute('title', isHidden ? 'Sembunyikan password' : 'Tampilkan password');
                input.focus();
            });
        }

        makeEyeToggle('eye-password', 'password', 'eye-pw-open', 'eye-pw-closed');
        makeEyeToggle('eye-confirm', 'password_confirmation', 'eye-cf-open', 'eye-cf-closed');

        /* ─── Password strength ─── */
        const pwInput = document.getElementById('password');
        const strengthWrap = document.getElementById('strength-wrap');
        const bars = [document.getElementById('sb1'), document.getElementById('sb2'),
            document.getElementById('sb3'), document.getElementById('sb4')
        ];
        const strengthLbl = document.getElementById('strength-label');

        function getStrength(pw) {
            let score = 0;
            if (pw.length >= 8) score++;
            if (pw.length >= 12) score++;
            if (/[A-Z]/.test(pw) && /[a-z]/.test(pw)) score++;
            if (/[0-9]/.test(pw)) score++;
            if (/[^A-Za-z0-9]/.test(pw)) score++;
            return Math.min(score, 4);
        }

        const levels = [{
                cls: 'weak',
                label: 'Sangat lemah',
                color: '#ef4444'
            },
            {
                cls: 'weak',
                label: 'Lemah',
                color: '#ef4444'
            },
            {
                cls: 'medium',
                label: 'Cukup kuat',
                color: '#f59e0b'
            },
            {
                cls: 'medium',
                label: 'Kuat',
                color: '#f59e0b'
            },
            {
                cls: 'strong',
                label: 'Sangat kuat',
                color: '#16a34a'
            },
        ];

        pwInput.addEventListener('input', function() {
            const val = this.value;
            if (!val) {
                strengthWrap.classList.remove('visible');
                bars.forEach(b => {
                    b.className = 'strength-bar';
                });
                return;
            }
            strengthWrap.classList.add('visible');
            const score = getStrength(val);
            const lvl = levels[score];
            bars.forEach((b, i) => {
                b.className = 'strength-bar' + (i < score ? ' ' + lvl.cls : '');
            });
            strengthLbl.textContent = lvl.label;
            strengthLbl.style.color = score > 0 ? lvl.color : '#9ca3af';

            // re-check confirm match
            checkMatch();
        });

        /* ─── Confirm match ─── */
        const cfInput = document.getElementById('password_confirmation');
        const matchHint = document.getElementById('match-hint');
        const matchIcon = document.getElementById('match-icon');
        const matchText = document.getElementById('match-text');

        function checkMatch() {
            const pw = pwInput.value;
            const cf = cfInput.value;
            if (!cf) {
                matchHint.classList.remove('visible', 'ok', 'bad');
                cfInput.classList.remove('success-state', 'error-state');
                return;
            }
            if (pw === cf) {
                matchHint.classList.add('visible', 'ok');
                matchHint.classList.remove('bad');
                matchIcon.innerHTML = '<polyline points="20 6 9 17 4 12"/>';
                matchText.textContent = 'Password cocok';
                cfInput.classList.add('success-state');
                cfInput.classList.remove('error-state');
            } else {
                matchHint.classList.add('visible', 'bad');
                matchHint.classList.remove('ok');
                matchIcon.innerHTML = '<line x1="18" y1="6" x2="6" y2="18"/><line x1="6" y1="6" x2="18" y2="18"/>';
                matchText.textContent = 'Password belum cocok';
                cfInput.classList.add('error-state');
                cfInput.classList.remove('success-state');
            }
        }

        cfInput.addEventListener('input', checkMatch);

        /* ─── Ripple ─── */
        const submitBtn = document.getElementById('submit-btn');

        submitBtn.addEventListener('click', function(e) {
            const ripple = document.createElement('span');
            const rect = submitBtn.getBoundingClientRect();
            const size = Math.max(rect.width, rect.height);
            ripple.className = 'ripple';
            ripple.style.cssText =
                `width:${size}px;height:${size}px;left:${e.clientX - rect.left - size/2}px;top:${e.clientY - rect.top - size/2}px;`;
            submitBtn.appendChild(ripple);
            ripple.addEventListener('animationend', () => ripple.remove());
        });

        /* ─── Field error helpers ─── */
        function fieldErr(id, msg) {
            const el = document.getElementById(id);
            if (!el) return;
            el.textContent = msg;
            el.classList.toggle('visible', !!msg);
        }

        function inputErr(id, hasErr) {
            const el = document.getElementById(id);
            if (!el) return;
            el.classList.toggle('error-state', hasErr);
            el.classList.toggle('success-state', !hasErr && el.value.length > 0);
        }

        function clearAllErrors() {
            ['name', 'email', 'password', 'password_confirmation'].forEach(id => {
                inputErr(id, false);
                fieldErr('err-' + (id === 'password_confirmation' ? 'confirm' : id), '');
            });
            document.getElementById('error-alert').classList.remove('visible');
        }

        ['name', 'email', 'password', 'password_confirmation'].forEach(id => {
            document.getElementById(id).addEventListener('input', function() {
                inputErr(id, false);
                fieldErr('err-' + (id === 'password_confirmation' ? 'confirm' : id), '');
                document.getElementById('error-alert').classList.remove('visible');
            });
        });

        /* ─── Global error alert ─── */
        function showGlobalError(msg) {
            const alert = document.getElementById('error-alert');
            const span = document.getElementById('error-msg');
            alert.classList.remove('visible');
            void alert.offsetWidth;
            span.textContent = msg;
            alert.classList.add('visible');
        }

        /* ─── Loading state ─── */
        function setLoading(on) {
            const spinner = document.getElementById('spinner');
            const text = document.getElementById('btn-text');
            submitBtn.disabled = on;
            submitBtn.classList.toggle('loading', on);
            spinner.style.display = on ? 'block' : 'none';
            text.textContent = on ? 'Membuat akun...' : 'Buat Akun Member';
        }

        /* ─── Client-side validation ─── */
        function validateForm() {
            let valid = true;
            const name = document.getElementById('name').value.trim();
            const email = document.getElementById('email').value.trim();
            const pw = document.getElementById('password').value;
            const cf = document.getElementById('password_confirmation').value;

            if (!name) {
                fieldErr('err-name', 'Nama lengkap tidak boleh kosong.');
                inputErr('name', true);
                valid = false;
            }
            if (!email) {
                fieldErr('err-email', 'Email tidak boleh kosong.');
                inputErr('email', true);
                valid = false;
            } else if (!email.includes('@') || !email.includes('.')) {
                fieldErr('err-email', 'Format email tidak valid.');
                inputErr('email', true);
                valid = false;
            }
            if (!pw) {
                fieldErr('err-password', 'Password tidak boleh kosong.');
                inputErr('password', true);
                valid = false;
            } else if (pw.length < 8) {
                fieldErr('err-password', 'Password minimal 8 karakter.');
                inputErr('password', true);
                valid = false;
            }
            if (!cf) {
                fieldErr('err-confirm', 'Konfirmasi password tidak boleh kosong.');
                inputErr('password_confirmation', true);
                valid = false;
            } else if (pw !== cf) {
                fieldErr('err-confirm', 'Password dan konfirmasi tidak cocok.');
                inputErr('password_confirmation', true);
                valid = false;
            }
            return valid;
        }

        /* ─── AJAX Submit ─── */
        document.getElementById('register-form').addEventListener('submit', async function(e) {
            e.preventDefault();
            clearAllErrors();

            if (!validateForm()) return;

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
                    // Tampilkan success overlay
                    document.getElementById('success-overlay').classList.add('visible');
                    setTimeout(() => {
                        window.location.href = result.redirect || '/';
                    }, 1200);
                } else {
                    setLoading(false);

                    if (result.errors) {
                        // Map error Laravel ke field masing-masing
                        if (result.errors.name) {
                            fieldErr('err-name', result.errors.name[0]);
                            inputErr('name', true);
                        }
                        if (result.errors.email) {
                            fieldErr('err-email', result.errors.email[0]);
                            inputErr('email', true);
                        }
                        if (result.errors.password) {
                            fieldErr('err-password', result.errors.password[0]);
                            inputErr('password', true);
                        }
                        if (result.errors.password_confirmation) {
                            fieldErr('err-confirm', result.errors.password_confirmation[0]);
                            inputErr('password_confirmation', true);
                        }
                        // Tampilkan juga global error untuk first error
                        const firstKey = Object.keys(result.errors)[0];
                        showGlobalError(result.errors[firstKey][0]);
                    } else {
                        showGlobalError(result.message || 'Terjadi kesalahan. Silakan coba lagi.');
                    }
                }
            } catch (err) {
                setLoading(false);
                if (err.message === 'Failed to fetch') {
                    showGlobalError('Koneksi bermasalah. Periksa internet Anda dan coba lagi.');
                } else {
                    showGlobalError(err.message || 'Terjadi kesalahan. Silakan coba lagi.');
                }
            }
        });

    })();
    </script>

</body>

</html>