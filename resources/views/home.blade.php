@extends('layouts.main')

@section('content')

{{-- ================= STYLE & ANIMASI TAMBAHAN ================= --}}
<style>
:root {
    --rassa-green: #4A5D23;
    --rassa-green-dark: #3b4b1c;
    --rassa-green-light: #6b8034;
    --rassa-cream: #FAF9F5;
}

html {
    scroll-behavior: smooth;
}

body {
    overflow-x: hidden;
}

/* Fade & slide-up animasi saat elemen masuk viewport */
[data-reveal] {
    opacity: 0;
    transform: translateY(24px);
    transition: opacity 0.7s ease, transform 0.7s ease;
}

[data-reveal].is-visible {
    opacity: 1;
    transform: translateY(0);
}

[data-reveal-delay="1"] {
    transition-delay: .1s;
}

[data-reveal-delay="2"] {
    transition-delay: .2s;
}

[data-reveal-delay="3"] {
    transition-delay: .3s;
}

[data-reveal-delay="4"] {
    transition-delay: .4s;
}

[data-reveal-delay="5"] {
    transition-delay: .5s;
}

/* ===== Hero background beranimasi ===== */
.rassa-hero {
    position: relative;
    overflow: hidden;
    background: #ffffff;
    isolation: isolate;
}

.rassa-hero::before {
    content: "";
    position: absolute;
    inset: 0;
    background-image: radial-gradient(rgba(74, 93, 35, 0.09) 1.5px, transparent 1.5px);
    background-size: 24px 24px;
    mask-image: radial-gradient(circle at 50% 30%, black, transparent 75%);
    opacity: .6;
    pointer-events: none;
    z-index: 1;
}

.rassa-hero-content {
    position: relative;
    z-index: 2;
}

/* Blob gradient bergerak pelan, memberi kesan "hidup" tapi tetap elegan */
.rassa-blob {
    position: absolute;
    border-radius: 50%;
    filter: blur(60px);
    z-index: 0;
    pointer-events: none;
    will-change: transform;
    transition: transform .6s cubic-bezier(.22, .61, .36, 1);
}

.rassa-blob-1 {
    width: 420px;
    height: 420px;
    top: -160px;
    left: -120px;
    background: radial-gradient(circle, rgba(74, 93, 35, 0.20), transparent 70%);
    animation: rassa-blob-move-1 16s ease-in-out infinite;
}

.rassa-blob-2 {
    width: 360px;
    height: 360px;
    top: -80px;
    right: -140px;
    background: radial-gradient(circle, rgba(107, 128, 52, 0.18), transparent 70%);
    animation: rassa-blob-move-2 20s ease-in-out infinite;
}

.rassa-blob-3 {
    width: 300px;
    height: 300px;
    bottom: -140px;
    left: 35%;
    background: radial-gradient(circle, rgba(74, 93, 35, 0.14), transparent 70%);
    animation: rassa-blob-move-3 18s ease-in-out infinite;
}

@keyframes rassa-blob-move-1 {

    0%,
    100% {
        transform: translate(0, 0) scale(1);
    }

    50% {
        transform: translate(40px, 50px) scale(1.12);
    }
}

@keyframes rassa-blob-move-2 {

    0%,
    100% {
        transform: translate(0, 0) scale(1);
    }

    50% {
        transform: translate(-50px, 40px) scale(1.08);
    }
}

@keyframes rassa-blob-move-3 {

    0%,
    100% {
        transform: translate(-50%, 0) scale(1);
    }

    50% {
        transform: translate(-50%, -30px) scale(1.15);
    }
}

@media (prefers-reduced-motion: reduce) {
    .rassa-blob {
        animation: none;
    }

    [data-reveal] {
        transition: none;
        opacity: 1;
        transform: none;
    }
}

/* Bean/partikel kecil melayang (opsional, halus) */
.rassa-particle {
    position: absolute;
    border-radius: 50%;
    background: var(--rassa-green);
    opacity: 0.18;
    z-index: 1;
    animation: rassa-particle-float 9s ease-in-out infinite;
}

@keyframes rassa-particle-float {

    0%,
    100% {
        transform: translateY(0) translateX(0);
        opacity: 0.12;
    }

    50% {
        transform: translateY(-22px) translateX(10px);
        opacity: 0.3;
    }
}

.rassa-badge {
    display: inline-flex;
    align-items: center;
    gap: .4rem;
    padding: .4rem .9rem;
    border-radius: 999px;
    background: rgba(74, 93, 35, 0.08);
    color: var(--rassa-green);
    font-size: .7rem;
    font-weight: 700;
    letter-spacing: .06em;
    text-transform: uppercase;
    margin-bottom: 1.5rem;
    animation: rassa-float 3.5s ease-in-out infinite;
}

@keyframes rassa-float {

    0%,
    100% {
        transform: translateY(0);
    }

    50% {
        transform: translateY(-4px);
    }
}

/* ===== Tombol: disamakan tinggi & ukurannya, konsisten di semua breakpoint ===== */
.rassa-btn-group {
    display: flex;
    flex-direction: column;
    align-items: stretch;
    justify-content: center;
    gap: .9rem;
    max-width: 360px;
    margin: 0 auto;
}

@media (min-width: 480px) {
    .rassa-btn-group {
        flex-direction: row;
        align-items: center;
        max-width: none;
        gap: 1rem;
    }
}

.rassa-btn {
    position: relative;
    overflow: hidden;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    text-align: center;
    white-space: nowrap;
    padding: 0.9rem 1.75rem;
    border-radius: 0.75rem;
    font-weight: 600;
    font-size: 0.95rem;
    line-height: 1.2;
    border: 1.5px solid transparent;
    transition: transform .25s ease, box-shadow .25s ease, background-color .25s ease, border-color .25s ease, color .25s ease;
}

@media (min-width: 480px) {
    .rassa-btn {
        width: auto;
    }
}

.rassa-btn-primary {
    background-color: var(--rassa-green);
    color: #fff;
    box-shadow: 0 6px 16px -8px rgba(74, 93, 35, 0.55);
}

.rassa-btn-primary:hover {
    background-color: var(--rassa-green-dark);
    transform: translateY(-2px);
    box-shadow: 0 12px 26px -8px rgba(74, 93, 35, 0.6);
}

.rassa-btn-primary::after {
    content: "";
    position: absolute;
    top: 0;
    left: -75%;
    width: 50%;
    height: 100%;
    background: linear-gradient(120deg, transparent, rgba(255, 255, 255, 0.35), transparent);
    transform: skewX(-20deg);
    transition: left .6s ease;
}

.rassa-btn-primary:hover::after {
    left: 130%;
}

.rassa-btn-outline {
    background-color: #ffffff;
    border-color: #e5e7eb;
    color: #374151;
}

.rassa-btn-outline:hover {
    transform: translateY(-2px);
    border-color: var(--rassa-green);
    color: var(--rassa-green);
    box-shadow: 0 10px 22px -12px rgba(0, 0, 0, 0.18);
}

/* Kartu menu */
.rassa-menu-card {
    transition: transform .35s ease, box-shadow .35s ease, border-color .35s ease;
    transform-style: preserve-3d;
    will-change: transform;
}

.rassa-menu-card:hover {
    box-shadow: 0 20px 40px -18px rgba(74, 93, 35, 0.35);
    border-color: rgba(74, 93, 35, 0.25);
}

.rassa-menu-card img {
    transition: transform .6s ease;
}

.rassa-menu-card:hover img {
    transform: scale(1.08);
}

.rassa-price {
    position: relative;
    display: inline-block;
}

.rassa-price::after {
    content: "";
    position: absolute;
    left: 0;
    bottom: -2px;
    width: 0%;
    height: 2px;
    background: var(--rassa-green);
    transition: width .35s ease;
}

.rassa-menu-card:hover .rassa-price::after {
    width: 100%;
}

/* Kartu artikel */
.rassa-article-card {
    transition: transform .35s ease, box-shadow .35s ease, border-color .35s ease;
    transform-style: preserve-3d;
    will-change: transform;
}

.rassa-article-card:hover {
    box-shadow: 0 18px 36px -18px rgba(0, 0, 0, 0.18);
    border-color: rgba(74, 93, 35, 0.2);
}

.rassa-article-card img {
    transition: transform .6s ease, filter .4s ease;
}

.rassa-article-card:hover img {
    transform: scale(1.06);
}

.rassa-article-card a.rassa-readmore svg {
    transition: transform .25s ease;
}

.rassa-article-card a.rassa-readmore:hover svg {
    transform: translateX(4px);
}

/* Kontak - ikon */
.rassa-icon-circle {
    transition: transform .3s ease, background-color .3s ease;
}

.rassa-contact-row:hover .rassa-icon-circle {
    transform: scale(1.1) rotate(-4deg);
    background-color: var(--rassa-green);
    color: #fff !important;
}

.rassa-input {
    transition: border-color .25s ease, box-shadow .25s ease, transform .15s ease;
}

.rassa-input:focus {
    transform: translateY(-1px);
}

.rassa-heading-accent {
    position: relative;
    display: inline-block;
}

.rassa-heading-accent::after {
    content: "";
    position: absolute;
    left: 0;
    bottom: -8px;
    width: 46px;
    height: 3px;
    border-radius: 999px;
    background: linear-gradient(90deg, var(--rassa-green), var(--rassa-green-light));
}

.rassa-alert-success {
    animation: rassa-alert-in .4s ease;
}

@keyframes rassa-alert-in {
    from {
        opacity: 0;
        transform: translateY(-8px);
    }

    to {
        opacity: 1;
        transform: translateY(0);
    }
}

/* ================= TAMBAHAN: Background dekoratif per section ================= */
.rassa-section-bg {
    position: absolute;
    inset: 0;
    z-index: 0;
    pointer-events: none;
    overflow: hidden;
}

#menu,
#berita,
#kontak {
    position: relative;
}

.rassa-bg-dot-pattern {
    position: absolute;
    inset: 0;
    background-image: radial-gradient(rgba(74, 93, 35, 0.10) 1.5px, transparent 1.5px);
    background-size: 26px 26px;
    mask-image: linear-gradient(to bottom, transparent, black 12%, black 88%, transparent);
    opacity: .9;
}

.rassa-bg-blob {
    position: absolute;
    border-radius: 50%;
    filter: blur(70px);
    opacity: .65;
    will-change: transform;
}

.rassa-bg-blob.a {
    width: 380px;
    height: 380px;
    top: -60px;
    right: -100px;
    background: radial-gradient(circle, rgba(74, 93, 35, 0.17), transparent 70%);
    animation: rassa-blob-move-2 22s ease-in-out infinite;
}

.rassa-bg-blob.b {
    width: 340px;
    height: 340px;
    bottom: -80px;
    left: -80px;
    background: radial-gradient(circle, rgba(107, 128, 52, 0.16), transparent 70%);
    animation: rassa-blob-move-1 19s ease-in-out infinite;
}

.rassa-bg-blob.c {
    width: 300px;
    height: 300px;
    top: 15%;
    left: 45%;
    background: radial-gradient(circle, rgba(74, 93, 35, 0.14), transparent 70%);
    animation: rassa-blob-move-3 24s ease-in-out infinite;
}

.rassa-bg-blob.d {
    width: 260px;
    height: 260px;
    top: 40%;
    right: 8%;
    background: radial-gradient(circle, rgba(107, 128, 52, 0.13), transparent 70%);
    animation: rassa-blob-move-1 26s ease-in-out infinite;
}

#menu>*,
#berita>*,
#kontak>* {
    position: relative;
    z-index: 1;
}

/* Full-bleed wash agar background section terasa penuh selebar layar, bukan cuma di dalam container */
#menu,
#berita,
#kontak {
    isolation: isolate;
}

.rassa-section-bleed {
    position: absolute;
    top: 0;
    bottom: 0;
    left: 50%;
    width: 100vw;
    transform: translateX(-50%);
    z-index: -1;
    pointer-events: none;
}

.rassa-bleed-menu {
    background: linear-gradient(180deg, #ffffff 0%, #FBFAF6 45%, #ffffff 100%);
}

.rassa-bleed-berita {
    background: linear-gradient(180deg, #ffffff 0%, rgba(74, 93, 35, 0.045) 45%, #ffffff 100%);
}

.rassa-bleed-kontak {
    background: linear-gradient(180deg, #ffffff 0%, #FAF9F5 40%, rgba(74, 93, 35, 0.06) 100%);
}

/* Aksen tematik halus khas kopi, murni dekorasi latar */
.rassa-theme-accent {
    position: absolute;
    z-index: 0;
    pointer-events: none;
    opacity: .55;
}

.rassa-theme-accent.steam {
    top: 6%;
    right: 6%;
    width: 130px;
    height: 220px;
}

.rassa-theme-accent.rings {
    bottom: -40px;
    right: -30px;
    width: 260px;
    height: 260px;
}

.rassa-theme-accent.quote {
    top: 4%;
    left: 2%;
    width: 120px;
    height: 120px;
}

@media (max-width: 640px) {
    .rassa-theme-accent {
        display: none;
    }
}

/* ================= TAMBAHAN: Scroll progress indicator ================= */
.rassa-scroll-progress {
    position: fixed;
    right: 16px;
    top: 50%;
    transform: translateY(-50%);
    z-index: 60;
    display: flex;
    flex-direction: column;
    align-items: center;
    gap: .85rem;
}

.rassa-scroll-track {
    width: 4px;
    height: 150px;
    border-radius: 999px;
    background: rgba(0, 0, 0, 0.08);
    position: relative;
    overflow: hidden;
}

.rassa-scroll-fill {
    position: absolute;
    bottom: 0;
    left: 0;
    width: 100%;
    height: 0%;
    border-radius: 999px;
    background: linear-gradient(180deg, var(--rassa-green-light), var(--rassa-green));
    transition: height .12s linear;
}

.rassa-scroll-arrow {
    width: 34px;
    height: 34px;
    border-radius: 50%;
    background: #fff;
    border: 1.5px solid #e5e7eb;
    color: #6b7280;
    display: flex;
    align-items: center;
    justify-content: center;
    cursor: pointer;
    box-shadow: 0 8px 18px -10px rgba(0, 0, 0, 0.25);
    transition: transform .3s ease, background-color .3s ease, border-color .3s ease, color .3s ease;
    animation: rassa-arrow-bounce 2.2s ease-in-out infinite;
}

.rassa-scroll-arrow svg {
    transition: transform .35s ease;
}

.rassa-scroll-arrow:hover {
    background: var(--rassa-green);
    border-color: var(--rassa-green);
    color: #fff;
}

.rassa-scroll-arrow.is-top svg {
    transform: rotate(180deg);
}

@keyframes rassa-arrow-bounce {

    0%,
    100% {
        transform: translateY(0);
    }

    50% {
        transform: translateY(4px);
    }
}

@media (max-width: 767px) {
    .rassa-scroll-progress {
        display: none;
    }
}

@media (prefers-reduced-motion: reduce) {
    .rassa-scroll-arrow {
        animation: none;
    }
}

/* ================= TAMBAHAN: Nav aktif (scrollspy) ================= */
/* Class ini otomatis ditambahkan lewat JS ke <a href="#menu">, <a href="#berita">, <a href="#kontak">
       pada navbar (di layouts.main) saat section terkait sedang aktif di viewport. */
a.rassa-nav-active {
    color: var(--rassa-green) !important;
    font-weight: 700;
}

nav a.rassa-nav-active,
header a.rassa-nav-active {
    position: relative;
}

nav a.rassa-nav-active::after,
header a.rassa-nav-active::after {
    content: "";
    position: absolute;
    left: 0;
    right: 0;
    bottom: -4px;
    height: 2px;
    border-radius: 999px;
    background: linear-gradient(90deg, var(--rassa-green), var(--rassa-green-light));
}
</style>

{{-- ================= Scroll Progress Indicator (dekoratif, tidak mengubah struktur konten) ================= --}}
<div class="rassa-scroll-progress" aria-hidden="true">
    <div class="rassa-scroll-track">
        <div id="rassaScrollFill" class="rassa-scroll-fill"></div>
    </div>
    <button type="button" id="rassaScrollArrow" class="rassa-scroll-arrow" aria-label="Gulir ke bawah">
        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M19 9l-7 7-7-7"></path>
        </svg>
    </button>
</div>

<!-- ================= Hero Section ================= -->
<section class="rassa-hero px-4 sm:px-6 pt-14 sm:pt-20 pb-16 sm:pb-24 text-center">
    <!-- Animated blobs & particles (dekorasi, tidak mengganggu konten) -->
    <div class="rassa-blob rassa-blob-1" data-parallax="1"></div>
    <div class="rassa-blob rassa-blob-2" data-parallax="-1"></div>
    <div class="rassa-blob rassa-blob-3" data-parallax="1.5"></div>
    <div class="rassa-particle hidden sm:block" style="width:10px;height:10px;top:22%;left:12%;"></div>
    <div class="rassa-particle hidden sm:block" style="width:14px;height:14px;top:65%;left:20%;animation-delay:2s;">
    </div>
    <div class="rassa-particle hidden sm:block" style="width:8px;height:8px;top:30%;right:15%;animation-delay:4s;">
    </div>
    <div class="rassa-particle hidden sm:block" style="width:12px;height:12px;top:70%;right:22%;animation-delay:1s;">
    </div>

    <div class="max-w-6xl mx-auto rassa-hero-content" data-reveal>
        <span class="rassa-badge">
            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
            </svg>
            Rassa Coffee &amp; Story
        </span>
        <h1
            class="text-4xl sm:text-5xl md:text-6xl xl:text-7xl font-bold tracking-tight text-gray-900 mb-5 sm:mb-6 leading-[1.15] sm:leading-[1.1]">
            {{ $setting->hero_title ?? 'Menikmati Kopi, Merajut Cerita.' }}
        </h1>
        <p
            class="text-gray-500 max-w-xl mx-auto text-sm sm:text-base md:text-lg mb-8 font-medium whitespace-pre-wrap px-2">
            {{ $setting->hero_text ?? 'Selamat datang di Rassa...' }}
        </p>
        <div class="rassa-btn-group">
            <a href="#menu" class="rassa-btn rassa-btn-primary">Lihat Menu</a>
            <a href="#berita" class="rassa-btn rassa-btn-outline">Baca Berita</a>
        </div>
    </div>
</section>

<!-- ================= Menu Kafe Section ================= -->
<section id="menu" class="max-w-6xl mx-auto px-4 sm:px-6 py-12 sm:py-16 overflow-hidden">
    <div class="rassa-section-bleed rassa-bleed-menu"></div>
    <div class="rassa-section-bg">
        <div class="rassa-bg-dot-pattern"></div>
        <div class="rassa-bg-blob a"></div>
        <div class="rassa-bg-blob d"></div>
    </div>
    <!-- Aksen tematik: uap kopi mengalun halus di pojok -->
    <svg class="rassa-theme-accent steam" viewBox="0 0 130 220" fill="none" xmlns="http://www.w3.org/2000/svg"
        aria-hidden="true">
        <path d="M35 200c-14-18 14-30 0-48s14-30 0-48s14-30 0-48" stroke="#4A5D23" stroke-width="3"
            stroke-linecap="round" opacity="0.18" />
        <path d="M75 200c-14-18 14-30 0-48s14-30 0-48s14-30 0-48" stroke="#6b8034" stroke-width="3"
            stroke-linecap="round" opacity="0.14" />
    </svg>

    <div class="mb-10 sm:mb-12" data-reveal>
        <h2 class="text-2xl sm:text-3xl font-bold tracking-tight text-gray-900 rassa-heading-accent">Menu Pilihan Kami
        </h2>
        <p class="text-sm text-gray-500 mt-4 font-medium">Nikmati racikan kopi premium dan hidangan spesial dari dapur
            Rassa.</p>
    </div>

    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 sm:gap-8 w-full">
        @forelse($menus as $menu)
        <div class="rassa-menu-card bg-white rounded-2xl border border-gray-100 shadow-[0_2px_10px_rgb(0,0,0,0.02)] overflow-hidden flex flex-col w-full max-w-sm mx-auto"
            data-reveal data-reveal-delay="{{ $loop->iteration % 3 + 1 }}">

            <!-- Foto Menu -->
            <div class="w-full aspect-video bg-gray-100 relative overflow-hidden">
                @if($menu->image)
                <img src="{{ asset('storage/' . $menu->image) }}" alt="{{ $menu->name }}"
                    class="w-full h-full object-cover">
                @else
                <div class="w-full h-full flex items-center justify-center text-gray-300">
                    <svg class="w-12 h-12" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                            d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z">
                        </path>
                    </svg>
                </div>
                @endif
                <div class="absolute top-4 right-4">
                    <span
                        class="px-3 py-1 bg-white/90 backdrop-blur-sm text-[10px] font-bold uppercase tracking-widest text-gray-800 rounded-full shadow-sm">
                        {{ $menu->category }}
                    </span>
                </div>
            </div>

            <!-- Detail Info -->
            <div class="p-5 sm:p-6 flex flex-col flex-grow">
                <h3 class="text-lg font-bold text-gray-900 mb-2">{{ $menu->name }}</h3>
                <p class="text-sm text-gray-500 font-medium line-clamp-2 mb-4 flex-grow">
                    {{ $menu->description ?? 'Tidak ada deskripsi singkat.' }}
                </p>
                <div class="text-lg font-bold text-[#4A5D23] rassa-price">
                    Rp {{ number_format($menu->price, 0, ',', '.') }}
                </div>
            </div>
        </div>
        @empty
        <p class="col-span-full text-center py-12 text-gray-400">Belum ada menu tersedia.</p>
        @endforelse
    </div>
</section>

<!-- ================= Berita / Artikel Section ================= -->
<section id="berita" class="max-w-6xl mx-auto px-4 sm:px-6 py-12 sm:py-16 border-t border-gray-100 overflow-hidden">
    <div class="rassa-section-bleed rassa-bleed-berita"></div>
    <div class="rassa-section-bg">
        <div class="rassa-bg-dot-pattern"></div>
        <div class="rassa-bg-blob b"></div>
        <div class="rassa-bg-blob c"></div>
    </div>
    <!-- Aksen tematik: tanda kutip besar, merepresentasikan "cerita" -->
    <svg class="rassa-theme-accent quote" viewBox="0 0 120 120" fill="none" xmlns="http://www.w3.org/2000/svg"
        aria-hidden="true">
        <text x="0" y="95" font-family="Georgia, serif" font-size="140" fill="#4A5D23" opacity="0.08">&#8220;</text>
    </svg>

    <div class="mb-10 sm:mb-12" data-reveal>
        <h2 class="text-2xl sm:text-3xl font-bold tracking-tight text-gray-900 rassa-heading-accent">Cerita &amp; Berita
            Rassa</h2>
        <p class="text-sm text-gray-500 mt-4 font-medium">Ikuti kabar terbaru, promo menarik, dan cerita seru dari balik
            meja barista.</p>
    </div>

    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 sm:gap-8">
        @forelse($articles as $article)
        <div class="rassa-article-card bg-white rounded-2xl border border-gray-100 overflow-hidden shadow-[0_2px_10px_rgb(0,0,0,0.01)] flex flex-col"
            data-reveal data-reveal-delay="{{ $loop->iteration % 3 + 1 }}">
            <!-- Foto Berita -->
            <div class="h-44 bg-gray-50 overflow-hidden">
                @if($article->image)
                <img src="{{ asset('storage/' . $article->image) }}" alt="{{ $article->title }}"
                    class="w-full h-full object-cover">
                @else
                <div class="w-full h-full flex items-center justify-center text-gray-300">
                    <svg class="w-12 h-12" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                            d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z">
                        </path>
                    </svg>
                </div>
                @endif
            </div>

            <!-- Isi Cuplikan -->
            <div class="p-5 sm:p-6 flex-1 flex flex-col justify-between">
                <div>
                    <span class="text-xs font-semibold text-gray-400 block mb-2">
                        {{ $article->created_at->translatedFormat('d F Y') }}
                    </span>
                    <h3 class="text-base font-bold text-gray-900 mb-2 line-clamp-2 hover:text-[#4A5D23] transition">
                        {{ $article->title }}
                    </h3>
                    <p class="text-xs text-gray-500 font-medium line-clamp-3 mb-4">
                        {{ Str::limit(strip_tags($article->content), 100) }}
                    </p>
                </div>
                <a href="{{ route('article.show', $article->id) }}"
                    class="rassa-readmore text-xs font-bold text-[#4A5D23] hover:underline flex items-center mt-auto">
                    Baca Selengkapnya
                    <svg class="w-3 h-3 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                    </svg>
                </a>
            </div>
        </div>
        @empty
        <div class="col-span-full text-center py-12 text-gray-400">
            <p class="font-medium">Belum ada berita yang diterbitkan.</p>
        </div>
        @endforelse
    </div>
</section>

<!-- ================= Kontak / Hubungi Kami Section ================= -->
<section id="kontak"
    class="max-w-6xl mx-auto px-4 sm:px-6 py-12 sm:py-16 border-t border-gray-100 mb-10 overflow-hidden">
    <div class="rassa-section-bleed rassa-bleed-kontak"></div>
    <div class="rassa-section-bg">
        <div class="rassa-bg-dot-pattern"></div>
        <div class="rassa-bg-blob c"></div>
        <div class="rassa-bg-blob a"></div>
    </div>
    <!-- Aksen tematik: dua lingkaran menyerupai bekas cangkir kopi -->
    <svg class="rassa-theme-accent rings" viewBox="0 0 260 260" fill="none" xmlns="http://www.w3.org/2000/svg"
        aria-hidden="true">
        <circle cx="130" cy="130" r="120" stroke="#4A5D23" stroke-width="2" opacity="0.10" />
        <circle cx="130" cy="130" r="85" stroke="#6b8034" stroke-width="2" opacity="0.12" />
    </svg>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-10 md:gap-12 lg:gap-16 items-start">

        <!-- Teks & Info -->
        <div data-reveal>
            <h2 class="text-2xl sm:text-3xl font-bold tracking-tight text-gray-900 mb-4 rassa-heading-accent">Sapa Kami
            </h2>
            <p class="text-gray-500 font-medium mb-8 mt-4 text-sm sm:text-base">Punya pertanyaan seputar menu, ingin
                reservasi tempat untuk acara, atau sekadar ingin menyapa? Jangan ragu untuk mengirimkan pesan kepada
                kami.</p>

            <div class="space-y-4">
                <div class="rassa-contact-row flex items-center text-gray-600">
                    <div
                        class="rassa-icon-circle w-10 h-10 rounded-full bg-[#4A5D23]/10 flex items-center justify-center text-[#4A5D23] mr-4 flex-shrink-0">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z">
                            </path>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                        </svg>
                    </div>
                    <span class="font-medium text-sm">{{ $setting->address ?? 'Alamat belum diatur' }}</span>
                </div>
                <div class="rassa-contact-row flex items-center text-gray-600">
                    <div
                        class="rassa-icon-circle w-10 h-10 rounded-full bg-[#4A5D23]/10 flex items-center justify-center text-[#4A5D23] mr-4 flex-shrink-0">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z">
                            </path>
                        </svg>
                    </div>
                    <span class="font-medium text-sm break-all">{{ $setting->email ?? 'Email belum diatur' }}</span>
                </div>

                @if($setting->phone)
                <div class="rassa-contact-row flex items-center text-gray-600">
                    <div
                        class="rassa-icon-circle w-10 h-10 rounded-full bg-[#4A5D23]/10 flex items-center justify-center text-[#4A5D23] mr-4 flex-shrink-0">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z">
                            </path>
                        </svg>
                    </div>
                    <span class="font-medium text-sm">{{ $setting->phone }}</span>
                </div>
                @endif
            </div>
        </div>

        <!-- Form -->
        <div class="bg-white p-5 sm:p-8 rounded-2xl border border-gray-100 shadow-[0_2px_10px_rgb(0,0,0,0.02)]"
            data-reveal data-reveal-delay="1">

            @if(session('success'))
            <div
                class="rassa-alert-success mb-6 p-4 bg-green-50 border border-green-200 text-green-700 rounded-xl text-sm font-bold flex items-center shadow-sm">
                <svg class="w-5 h-5 mr-3 text-green-500 flex-shrink-0" fill="none" stroke="currentColor"
                    viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
                {{ session('success') }}
            </div>
            @endif

            <form action="{{ route('message.store') }}" method="POST">
                @csrf

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 mb-4">
                    <div>
                        <label for="name"
                            class="block text-xs font-bold text-gray-700 mb-2 uppercase tracking-wide">Nama Anda</label>
                        <input type="text" name="name" id="name" required placeholder="Budi Santoso"
                            class="rassa-input w-full px-4 py-3 rounded-xl border border-gray-200 focus:border-[#4A5D23] focus:ring focus:ring-[#4A5D23]/20 outline-none text-sm font-medium">
                    </div>
                    <div>
                        <label for="email"
                            class="block text-xs font-bold text-gray-700 mb-2 uppercase tracking-wide">Email</label>
                        <input type="email" name="email" id="email" required placeholder="budi@email.com"
                            class="rassa-input w-full px-4 py-3 rounded-xl border border-gray-200 focus:border-[#4A5D23] focus:ring focus:ring-[#4A5D23]/20 outline-none text-sm font-medium">
                    </div>
                </div>

                <div class="mb-4">
                    <label for="subject"
                        class="block text-xs font-bold text-gray-700 mb-2 uppercase tracking-wide">Subjek
                        (Opsional)</label>
                    <input type="text" name="subject" id="subject" placeholder="Misal: Reservasi Tempat"
                        class="rassa-input w-full px-4 py-3 rounded-xl border border-gray-200 focus:border-[#4A5D23] focus:ring focus:ring-[#4A5D23]/20 outline-none text-sm font-medium">
                </div>

                <div class="mb-6">
                    <label for="content"
                        class="block text-xs font-bold text-gray-700 mb-2 uppercase tracking-wide">Pesan Anda</label>
                    <textarea name="content" id="content" rows="4" required placeholder="Tuliskan pesan Anda di sini..."
                        class="rassa-input w-full px-4 py-3 rounded-xl border border-gray-200 focus:border-[#4A5D23] focus:ring focus:ring-[#4A5D23]/20 outline-none text-sm font-medium"></textarea>
                </div>

                <button type="submit" class="rassa-btn rassa-btn-primary w-full">
                    Kirim Pesan
                </button>
            </form>
        </div>

    </div>
</section>

{{-- ================= SCRIPT: Reveal, parallax, tilt, scrollspy & scroll-progress (vanilla JS) ================= --}}
<script>
document.addEventListener('DOMContentLoaded', function() {

    /* ---------- 1. Reveal-on-scroll (sudah ada sebelumnya) ---------- */
    var revealEls = document.querySelectorAll('[data-reveal]');
    var revealObserver = new IntersectionObserver(function(entries) {
        entries.forEach(function(entry) {
            if (entry.isIntersecting) {
                entry.target.classList.add('is-visible');
                revealObserver.unobserve(entry.target);
            }
        });
    }, {
        threshold: 0.12
    });
    revealEls.forEach(function(el) {
        revealObserver.observe(el);
    });

    /* ---------- 2. Parallax blob di hero mengikuti gerakan mouse ---------- */
    var heroSection = document.querySelector('.rassa-hero');
    var parallaxEls = document.querySelectorAll('[data-parallax]');
    if (heroSection && parallaxEls.length && window.matchMedia('(min-width: 768px)').matches) {
        heroSection.addEventListener('mousemove', function(e) {
            var rect = heroSection.getBoundingClientRect();
            var relX = (e.clientX - rect.left) / rect.width - 0.5;
            var relY = (e.clientY - rect.top) / rect.height - 0.5;
            parallaxEls.forEach(function(el) {
                var speed = parseFloat(el.getAttribute('data-parallax')) || 1;
                var moveX = relX * 22 * speed;
                var moveY = relY * 22 * speed;
                el.style.transform = 'translate(' + moveX + 'px, ' + moveY + 'px)';
            });
        });
        heroSection.addEventListener('mouseleave', function() {
            parallaxEls.forEach(function(el) {
                el.style.transform = 'translate(0, 0)';
            });
        });
    }

    /* ---------- 3. Tilt halus untuk kartu menu & artikel saat hover (desktop) ---------- */
    var tiltCards = document.querySelectorAll('.rassa-menu-card, .rassa-article-card');
    if (window.matchMedia('(min-width: 768px)').matches) {
        tiltCards.forEach(function(card) {
            card.addEventListener('mousemove', function(e) {
                var rect = card.getBoundingClientRect();
                var relX = (e.clientX - rect.left) / rect.width - 0.5;
                var relY = (e.clientY - rect.top) / rect.height - 0.5;
                var rotateX = (relY * -4).toFixed(2);
                var rotateY = (relX * 4).toFixed(2);
                card.style.transform = 'translateY(-6px) rotateX(' + rotateX + 'deg) rotateY(' +
                    rotateY + 'deg)';
            });
            card.addEventListener('mouseleave', function() {
                card.style.transform = '';
            });
        });
    }

    /* ---------- 4. Nav aktif (scrollspy) untuk #menu, #berita, #kontak ---------- */
    var spySectionIds = ['menu', 'berita', 'kontak'];
    var spySections = spySectionIds
        .map(function(id) {
            return document.getElementById(id);
        })
        .filter(Boolean);
    var navLinks = document.querySelectorAll('a[href="#menu"], a[href="#berita"], a[href="#kontak"]');

    function updateActiveNav() {
        var scrollPos = window.scrollY + window.innerHeight * 0.35;
        var currentId = null;
        spySections.forEach(function(sec) {
            if (sec.offsetTop <= scrollPos) {
                currentId = sec.id;
            }
        });
        navLinks.forEach(function(link) {
            var href = link.getAttribute('href').substring(1);
            link.classList.toggle('rassa-nav-active', href === currentId);
        });
    }

    /* ---------- 5. Scroll progress indicator ---------- */
    var scrollFill = document.getElementById('rassaScrollFill');
    var scrollArrow = document.getElementById('rassaScrollArrow');

    function updateScrollProgress() {
        var docEl = document.documentElement;
        var scrollTop = docEl.scrollTop || document.body.scrollTop;
        var scrollHeight = docEl.scrollHeight - docEl.clientHeight;
        var pct = scrollHeight > 0 ? (scrollTop / scrollHeight) * 100 : 0;

        if (scrollFill) {
            scrollFill.style.height = pct + '%';
        }

        if (scrollArrow) {
            if (pct > 90) {
                scrollArrow.classList.add('is-top');
                scrollArrow.setAttribute('aria-label', 'Kembali ke atas');
            } else {
                scrollArrow.classList.remove('is-top');
                scrollArrow.setAttribute('aria-label', 'Gulir ke bawah');
            }
        }
    }

    function onScroll() {
        updateActiveNav();
        updateScrollProgress();
    }

    window.addEventListener('scroll', onScroll, {
        passive: true
    });
    onScroll();

    if (scrollArrow) {
        scrollArrow.addEventListener('click', function() {
            if (scrollArrow.classList.contains('is-top')) {
                window.scrollTo({
                    top: 0,
                    behavior: 'smooth'
                });
            } else {
                window.scrollBy({
                    top: window.innerHeight * 0.9,
                    behavior: 'smooth'
                });
            }
        });
    }
});
</script>

@endsection