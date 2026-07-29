@extends('layout.desktop.main')

@section('content')
<style>
    /* 1. FORCE BREAKOUT CONTAINER (Memaksa banner melebar penuh 100% layar) */
    .gacor-hero-wrapper {
        position: relative !important;
        width: 100vw !important;
        left: 50% !important;
        right: 50% !important;
        margin-left: -50vw !important;
        margin-right: -50vw !important;
        height: 520px !important; /* Tinggi disesuaikan pas dengan proporsi target */
        background: url('https://d33egg70nrp50s.cloudfront.net/Images/v-zelma-v2-beta/dark-brown/desktop/providers/banners/slots/banner.webp?v=606181553') no-repeat top center !important;
        background-size: cover !important;
        background-color: #0d0d0d !important; 
        overflow: hidden !important;
        box-sizing: border-box !important;
    }

    /* 2. AREA COUNTER JACKPOT (Tengah Presisi di Atas Bar Hitam) */
    .jackpot-counter-box {
        position: absolute !important;
        bottom: 95px !important; /* Jarak pas di atas bar provider hitam */
        left: 50% !important;
        transform: translateX(-50%) !important;
        background: #000000 !important;
        border: 3px solid #7c5a1c !important; /* Ketebalan dan warna border disesuaikan target */
        border-radius: 35px !important;
        padding: 5px 45px !important;
        box-shadow: inset 0px 0px 12px rgba(0,0,0,1), 0px 8px 20px rgba(0,0,0,0.8) !important;
        display: flex !important;
        align-items: center !important;
        justify-content: center !important;
        gap: 12px !important;
        z-index: 99 !important;
        min-width: 420px !important;
    }

    .jackpot-counter-box span {
        color: #aa7c11 !important; /* Teks IDR keemasan gelap dulled */
        font-size: 24px !important;
        font-family: 'Impact', 'Arial Black', sans-serif !important;
        font-weight: 900 !important;
    }

    .jackpot-counter-box h3 {
        margin: 0 !important;
        padding: 0 !important;
        color: #ffffff !important;
        font-family: 'Courier New', Courier, monospace !important; /* Karakter font digital kokoh */
        font-size: 36px !important;
        font-weight: 900 !important;
        letter-spacing: 2px !important;
    }

    /* 3. BAR PROVIDER (Ramping, Kokoh, Horizontal Scrollable Tanpa Rusak) */
    .provider-strip-bar {
        position: absolute !important;
        bottom: 0 !important;
        left: 50% !important;
        transform: translateX(-50%) !important;
        width: 100% !important;
        max-width: 960px !important; /* Lebar pas proporsional di tengah banner */
        background: #0a0a0a !important; /* Warna hitam pekat base */
        height: 55px !important;
        display: flex !important;
        align-items: center !important;
        justify-content: space-between !important;
        z-index: 100 !important;
        border: 1px solid #222 !important;
        border-radius: 4px !important;
        padding: 0px !important;
    }

    /* Tombol Navigasi Panah */
    .provider-nav-arrow {
        color: #888888 !important;
        font-size: 16px !important;
        cursor: pointer !important;
        padding: 0 15px !important;
        height: 100% !important;
        display: flex !important;
        align-items: center !important;
        background: #111111 !important;
        user-select: none !important;
        transition: color 0.2s, background 0.2s !important;
    }
    .provider-nav-arrow:hover {
        color: #ffffff !important;
        background: #1a1a1a !important;
    }

    /* Pembungkus Geser */
    .provider-scroll-wrapper {
        display: flex !important;
        align-items: center !important;
        width: calc(100% - 80px) !important;
        overflow-x: auto !important; /* Izinkan geser menyamping */
        white-space: nowrap !important;
        scroll-behavior: smooth !important;
    }
    /* Sembunyikan scrollbar bawaan browser agar tetap rapi */
    .provider-scroll-wrapper::-webkit-scrollbar {
        display: none !important;
    }

    /* List Item Gabung Menyamping */
    .provider-list-items {
        display: flex !important;
        flex-direction: row !important;
        flex-wrap: nowrap !important; /* Blokir total penumpukan ke bawah */
        align-items: center !important;
        gap: 35px !important; /* Jarak antar-logo pas */
        list-style: none !important;
        margin: 0 !important;
        padding: 0 20px !important;
    }

    .provider-list-items li {
        flex: 0 0 auto !important; /* Kunci logo agar tidak menyusut atau gepeng */
        cursor: pointer !important;
        display: flex !important;
        align-items: center !important;
    }

    .provider-list-items li img {
        height: 24px !important; /* Tinggi disamakan rata seperti contoh */
        width: auto !important;
        filter: none !important; /* Bebaskan warna asli gambar */
        opacity: 0.85 !important;
        transition: opacity 0.2s ease, transform 0.2s ease !important;
    }

    .provider-list-items li:hover img {
        opacity: 1 !important;
        transform: scale(1.05) !important;
    }

    /* FORCE DISABLE BAWAAN TEMPLATE DI DALAM HERO BANNER */
    .gacor-hero-wrapper .container, 
    .gacor-hero-wrapper .col-md-12, 
    .gacor-hero-wrapper .link-container, 
    .gacor-hero-wrapper .section-heading { 
        display: none !important; 
    }
</style>

<!-- HEADER HERO BANNER FULLWIDTH -->
<div class="gacor-hero-wrapper">
    
    <!-- KOTAK JACKPOT UTAMA -->
    <div class="jackpot-counter-box">
        <span>IDR</span>
        <h3 id="jackpot-counter">12,387,820,365</h3>
    </div>

    <!-- STRIP BAR PROVIDER SEJAJAR HORIZONTAL -->
    <div class="provider-strip-bar">
        <div class="provider-nav-arrow" onclick="slideProvider(-180)">&#10094;</div>

        <div class="provider-scroll-wrapper" id="gacorProviderNav">
            <ul class="provider-list-items">
                <li onclick="window.location.href='/slots/pragmatic'"><img src="//d33egg70nrp50s.cloudfront.net/Images/v-zelma-v2-beta/menu/desktop/provider-menu-3/game-code-7-active.webp" alt="Pragmatic"></li>
                <li onclick="window.location.href='/slots/pgsoft'"><img src="//d33egg70nrp50s.cloudfront.net/Images/v-zelma-v2-beta/menu/desktop/provider-menu-3/game-code-9-active.webp" alt="PG Soft"></li>
                <li onclick="window.location.href='/slots/habanero'"><img src="//d33egg70nrp50s.cloudfront.net/Images/v-zelma-v2-beta/menu/desktop/provider-menu-3/game-code-16-active.webp" alt="Habanero"></li>
                <li onclick="window.location.href='/slots/joker'"><img src="//d33egg70nrp50s.cloudfront.net/Images/v-zelma-v2-beta/menu/desktop/provider-menu-3/game-code-6-active.webp" alt="Joker"></li>
                <li onclick="window.location.href='/slots/microgaming'"><img src="https://d33egg70nrp50s.cloudfront.net/Images/v-zelma-v2-beta/menu/desktop/provider-menu-3/game-code-17-active.webp" alt="Microgaming"></li>
                <li onclick="window.location.href='/slots/spadegaming'"><img src="//d33egg70nrp50s.cloudfront.net/Images/v-zelma-v2-beta/menu/desktop/provider-menu-3/game-code-29-active.webp" alt="Spadegaming"></li>
                <li onclick="window.location.href='/slots/hacksaw'"><img src="https://www.gamingsoft.com/Content/images/common/fun-gaming-logo.png" alt="Fungaming"></li>
                <li onclick="window.location.href='/slots/dreamtech'"><img src="{{ asset('dreamtech/Dream-Tech.jpg') }}" alt="Dreamtech" onerror="this.style.display='none'"></li>
                <li onclick="window.location.href='/slots/playstar'"><img src="https://d33egg70nrp50s.cloudfront.net/Images/v-zelma-v2-beta/menu/desktop/provider-menu-3/game-code-65-active.webp" alt="Playstar"></li>
                <li onclick="window.location.href='/slots/evoplay'"><img src="//d33egg70nrp50s.cloudfront.net/Images/v-zelma-v2-beta/dark-brown/desktop/layout/providers/game-code-38.png" alt="Evoplay"></li>
                <li onclick="window.location.href='/slots/booongo'"><img src="{{ asset('booongo/images.png') }}" alt="Booongo" onerror="this.style.display='none'"></li>
                <li onclick="window.location.href='/slots/playngo'"><img src="{{ asset('playngo/playngo.png') }}" alt="Playngo" onerror="this.style.display='none'"></li>
                <li onclick="window.location.href='/slots/genesis'"><img src="{{ asset('genesis/genesis.png') }}" alt="Genesis" onerror="this.style.display='none'"></li>
                <li onclick="window.location.href='/slots/toptrend'"><img src="{{ asset('toptrend/toptrendgaming.png') }}" alt="Toptrend" onerror="this.style.display='none'"></li>
            </ul>
        </div>

        <div class="provider-nav-arrow" onclick="slideProvider(180)">&#10095;</div>
    </div>
</div>

<!-- TEXT SEO / DESKRIPSI BAWAH (Tetap berada di dalam pembungkus konten standar) -->
<div class="container mt-4">
    <!-- Jaga teks bawaan halaman slots lu di bawah sini agar tidak ikut tergeser breakout -->
</div>

<script>
    // FUNGSI GESER MANUAL LOGO MENGGUNAKAN TOMBOL PANAH
    function slideProvider(offsetValue) {
        const slider = document.getElementById('gacorProviderNav');
        if (slider) {
            slider.scrollLeft += offsetValue;
        }
    }

    // ANIMASI TICKER JACKPOT OTOMATIS BERJALAN GACOR
    document.addEventListener('DOMContentLoaded', function() {
        let currentJackpotAmount = 12387820365; 
        const jackpotDisplay = document.getElementById('jackpot-counter');
        
        if(jackpotDisplay) {
            setInterval(() => {
                // Nilai acak bertambah konstan
                currentJackpotAmount += Math.floor(Math.random() * 14000) + 1000;
                jackpotDisplay.innerText = currentJackpotAmount.toLocaleString('en-US');
            }, 1000); 
        }
    });
</script>
@endsection