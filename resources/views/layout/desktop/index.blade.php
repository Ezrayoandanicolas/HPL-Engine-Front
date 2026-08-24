@extends('layout.desktop.main')
@section('content')
 
    @if (Auth::check())
         <div class="banner" style="margin-bottom: 2rem;">
            <div id="banner_carousel" class="banner-carousel">
                @foreach ($banner as $banner)
                    <div class="">
                        <a href="/promotion" target="_blank">
                            <img alt="{{ $setting->web }}" height="600" loading="lazy"
                                src="{{ storageUrl($banner->img) }}" title="{{ $setting->web }}" width="1920" />
                        </a>
                    </div>
                @endforeach
            </div>
        </div>
        <script type="text/javascript">
            $(document).ready(function() {
                $('#banner_carousel').slick({
                    autoplay: true,
                    autoplaySpeed: 3000,
                    dots: true,
                    arrows: true,
                    infinite: true,
                    speed: 500,
                    fade: true,
                    cssEase: 'linear'
                });
            });
        </script>
        <div class="container mt-4 mb-3">
            <div class="row wallet-stats-row">
                <div class="col-md-3 col-6">
                    <div class="wallet-stat-card">
                        <div class="wallet-stat-icon" style="background: linear-gradient(135deg,#22c1c3,#2e86de);box-shadow:0 6px 16px rgba(34,193,195,.35);"><i class="fas fa-wallet"></i></div>
                        <div class="wallet-stat-info">
                            <p class="wallet-stat-label">Saldo Utama</p>
                            <h3 class="wallet-stat-value">Rp {{ number_format($user->saldo ?? 0, 0, ',', '.') }}</h3>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 col-6">
                    <div class="wallet-stat-card">
                        <div class="wallet-stat-icon" style="background: linear-gradient(135deg,#43e97b,#38f9d7);box-shadow:0 6px 16px rgba(67,233,123,.35);"><i class="fas fa-arrow-down"></i></div>
                        <div class="wallet-stat-info">
                            <p class="wallet-stat-label">Total Deposit</p>
                            <h3 class="wallet-stat-value">Rp {{ number_format($total_deposit ?? 0, 0, ',', '.') }}</h3>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 col-6">
                    <div class="wallet-stat-card">
                        <div class="wallet-stat-icon" style="background: linear-gradient(135deg,#f7971e,#ffd200);box-shadow:0 6px 16px rgba(247,151,30,.35);"><i class="fas fa-arrow-up"></i></div>
                        <div class="wallet-stat-info">
                            <p class="wallet-stat-label">Total Withdraw</p>
                            <h3 class="wallet-stat-value">Rp {{ number_format($total_withdraw ?? 0, 0, ',', '.') }}</h3>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 col-6">
                    <div class="wallet-stat-card">
                        <div class="wallet-stat-icon" style="background: linear-gradient(135deg,#ff512f,#f09819);box-shadow:0 6px 16px rgba(255,81,47,.35);"><i class="fas fa-star"></i></div>
                        <div class="wallet-stat-info">
                            <p class="wallet-stat-label">Poin</p>
                            <h3 class="wallet-stat-value">{{ $user->point_player ?? 0 }}</h3>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <style>
            .wallet-stats-row > div { margin-bottom: 16px; }
            .wallet-stat-card {
                display: flex; align-items: center; gap: 14px;
                background: linear-gradient(145deg, #1c1f2e 0%, #262b3d 100%);
                border: 1px solid rgba(255,255,255,.06);
                border-radius: 16px; padding: 18px 20px; height: 100%;
                transition: transform .25s ease, box-shadow .25s ease, border-color .25s ease;
            }
            .wallet-stat-card:hover {
                transform: translateY(-4px);
                border-color: rgba(255,255,255,.16);
                box-shadow: 0 14px 30px rgba(0,0,0,.45);
            }
            .wallet-stat-icon {
                flex-shrink: 0; width: 52px; height: 52px; border-radius: 14px;
                display: flex; align-items: center; justify-content: center;
                color: #fff; font-size: 20px;
            }
            .wallet-stat-info { min-width: 0; }
            .wallet-stat-label {
                margin: 0; font-size: 12px; letter-spacing: .4px; text-transform: uppercase;
                color: #9aa0b5; font-weight: 600;
            }
            .wallet-stat-value {
                margin: 3px 0 0; font-size: 20px; font-weight: 700; color: #fff; line-height: 1.15;
                white-space: nowrap; overflow: hidden; text-overflow: ellipsis;
            }
            @media (max-width: 575.98px) {
                .wallet-stat-card { padding: 14px 14px; }
                .wallet-stat-icon { width: 44px; height: 44px; font-size: 16px; border-radius: 12px; }
                .wallet-stat-value { font-size: 16px; }
            }
        </style>
        <div class="announcement-outer-container">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div class="announcement-container">
                            <i data-icon="news"
                                style="--image-src: url(//d33egg70nrp50s.cloudfront.net/Images/v-zelma-v2-beta/dark-brown/desktop/home/news.png?v=20240708-4);"></i>
                            <div data-section="announcements">
                                <ul class="announcement-list" id="announcement_list">
                                    @foreach(explode('|', $setting->announcement_text ?? '') as $item)
                                        @if(trim($item))
                                            <li>{{ trim($item) }}</li>
                                        @endif
                                    @endforeach
                                </ul>
                            </div>
                            <div data-section="date">
                                {{ \Carbon\Carbon::now('Asia/Jakarta')->format('d/m/Y (D) H.i (GMT+7)') }}
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
        <div data-container-background="home"
            style="background-image: url(//d33egg70nrp50s.cloudfront.net/Images/v-zelma-v2-beta/dark-brown/desktop/backgrounds/home.jpg?v=20240708-4);">
            <div class="container home-outer-container">
                <div class="row">
                    <div class="col-md-12">
                        <div class="home-inner-container">
                            <a href="/desktop/slots/pragmatic?PromotionCategory=Jackpot+Play+Games">
                                <div class="home-progressive-jackpot"
                                    style="--image-src: url(//d33egg70nrp50s.cloudfront.net/Images/v-zelma-v2-beta/dark-brown/desktop/home/jackpot.png?v=20240708-4);">
                                    <div class="jackpot-container"
                                        style="--image-src: url(//d33egg70nrp50s.cloudfront.net/Images/v-zelma-v2-beta/dark-brown/desktop/home/jackpot-amount-bg.png?v=20240708-4);">
                                        <span class="jackpot-currency jackpot_currency"></span>
                                        <span id="progressive_jackpot"
                                            data-progressive-jackpot-url="https://jp-api.zoomwlb.com"></span>
                                    </div>
                                </div>
                            </a>
                            <div class="popular-slots-outer-container">



                                                                <div class="popular-game-title-container">
                                    <div class="title">
                                        <i data-icon="popular-games"
                                            style="--image-src: url(//d33egg70nrp50s.cloudfront.net/Images/v-zelma-v2-beta/dark-brown/desktop/home/popular-games.png?v=20240708-4);"></i>
                                        Game Populer
                                    </div>
                                    <i></i>
                                </div>
                                <div class="game-list-container">
                                    <div class="game-list" id="popular-games-container">
                                        <div class="games-group">
                                            <div class="game-item">
                                                <div class="wrapper-container" style="text-align:center;padding:40px;color:#666">Memuat game...</div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="popular-game-title-container">
                                    <div class="title">
                                        <i data-icon="new-games"
                                            style="--image-src: url(//d33egg70nrp50s.cloudfront.net/Images/zoom-v2-beta/dark-turquoise/desktop/home/new-games.png?v=20240708-4);"></i>
                                        New Games
                                    </div>
                                    <i></i>
                                </div>
                                <div class="game-list-container">
                                    <div class="game-list" id="new-games-container">
                                        <div class="games-group">
                                            <div class="game-item">
                                                <div class="wrapper-container" style="text-align:center;padding:40px;color:#666">Memuat game...</div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="popular-game-title-container">
                                    <div class="title">
                                        <i data-icon="jackpot-games"
                                            style="--image-src: url(//d33egg70nrp50s.cloudfront.net/Images/zoom-v2-beta/dark-turquoise/desktop/home/jackpot-games.png?v=20240708-4);"></i>
                                        Jackpot Games
                                    </div>
                                    <i></i>
                                </div>
                                <div class="game-list-container">
                                    <div class="game-list" id="jackpot-games-container">
                                        <div class="games-group">
                                            <div class="game-item">
                                                <div class="wrapper-container" style="text-align:center;padding:40px;color:#666">Memuat game...</div>
                                            </div>
                                        </div>
                                    </div>
                                </div></div>
                            </div>

                        </div>
                        <div class="site-contacts">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <ul class="contact-list">
                            <li>
                                <a href="https://wa.me/{{ $setting->whatsapp }}" target="_blank" rel="noopener nofollow">
                                    <i>
                                        <img alt="Contact" height="18" loading="lazy"
                                            src="//d33egg70nrp50s.cloudfront.net/Images/communications/whatsapp.svg?v=20240708-4"
                                            width="18" />
                                    </i>
                                    -
                                </a>
                            </li>
                            <li>
                                <a href="https://t.me/{{ $setting->telegram }}" target="_blank" rel="noopener nofollow">
                                    <i>
                                        <img alt="Contact" height="18" loading="lazy"
                                            src="//d33egg70nrp50s.cloudfront.net/Images/communications/telegram.svg?v=20240708-4"
                                            width="18" />
                                    </i>
                                    {{ $setting->web }}
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
            <div class="download-apk-container container">
                <div class="row">
                    <div class="col-md-12">
                        <div class="download-apk" id="download_apk"
                            style="--image-src: url(//d33egg70nrp50s.cloudfront.net/Images/v-zelma-v2-beta/dark-brown/desktop/home/download-apk-background.webp?v=20240708-4);">
                            <div>
                                <div class="h2">
                                    Unduh Gratis
                                    <span>{{ $setting->web }} App</span>
                                </div>
                                <div class="h3">
                                    Nikmati performa terbaik dari Aplikasi kami <br />
                                    Tersedia dalam Android!
                                </div>
                                <div class="download-apk-info">
                                    <div class="download-apk-section">
                                        <div class="download-apk-qr-code">
                                            <a href="{{ route('download', ['filename' => 'one-heart.apk']) }}">
                                                <picture>
                                                    <source
                                                        srcset="//d33egg70nrp50s.cloudfront.net/Images/apk-qrcodes/AJP.webp?v=20240708-4"
                                                        type="image/webp" />
                                                    <source
                                                        srcset="//d33egg70nrp50s.cloudfront.net/Images/apk-qrcodes/AJP.webp?v=20240708-4"
                                                        type="image/jpeg" /><img alt="Unduh APK Permainan" height="94"
                                                        loading="lazy"
                                                        src="//d33egg70nrp50s.cloudfront.net/Images/apk-qrcodes/AJP.webp?v=20240708-4"
                                                        width="94" />
                                                </picture>
                                            </a>
                                        </div>
                                        <div class="download-apk-detail">
                                            <div>{{ $setting->web }} App</div>
                                            <a href="{{ route('download', ['filename' => 'one-heart.apk']) }}" data-toggle="modal" data-target="#apk_install_guide_modal">
                                                <picture>
                                                    <source
                                                        srcset="//d33egg70nrp50s.cloudfront.net/Images/v-zelma-v2-beta/dark-brown/desktop/home/download-android-button.webp?v=20240708-4"
                                                        type="image/webp" />
                                                    <source
                                                        srcset="//d33egg70nrp50s.cloudfront.net/Images/v-zelma-v2-beta/dark-brown/desktop/home/download-android-button.png?v=20240708-4"
                                                        type="image/png" /><img alt="Download APK" class="img-responsive"
                                                        height="35" loading="lazy"
                                                        src="//d33egg70nrp50s.cloudfront.net/Images/v-zelma-v2-beta/dark-brown/desktop/home/download-android-button.png?v=20240708-4"
                                                        width="146" />
                                                </picture>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                                <span>*Pindai kode QR untuk Unduh <i>Android APK</i></span>
                            </div>
                            <div>
                                <picture>
                                    <source
                                        srcset="//d33egg70nrp50s.cloudfront.net/Images/v-zelma-v2-beta/dark-brown/desktop/home/download-apk-phone.webp?v=20240708-4"
                                        type="image/webp" />
                                    <source
                                        srcset="//d33egg70nrp50s.cloudfront.net/Images/v-zelma-v2-beta/dark-brown/desktop/home/download-apk-phone.png?v=20240708-4"
                                        type="image/png" /><img alt="Download APK" class="img-responsive" height="345"
                                        loading="lazy"
                                        src="//d33egg70nrp50s.cloudfront.net/Images/v-zelma-v2-beta/dark-brown/desktop/home/download-apk-phone.png?v=20240708-4"
                                        width="490" />
                                </picture>
                            </div>
                        </div>
                    </div>
                </div>
                <div id="apk_install_guide_modal" class="modal download-popup-modal" role="dialog"
                    data-title="Panduan Instalasi" aria-hidden="false">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">×</span>
                                </button>
                                <div class="modal-title" id="apk_install_guide_modal_title">
                                    Panduan Instalasi
                                </div>
                            </div>
                            <div class="modal-body" id="apk_install_guide_modal_body">
                                <span><img alt="Android" height="20" loading="lazy"
                                        src="//d33egg70nrp50s.cloudfront.net/Images/icons/android-logo.svg?v=20240708-4"
                                        width="20" /> Instalasi Android</span>
                                <ol>
                                    <li>
                                        Pindai kode QR untuk Android
                                    </li>
                                    <li>
                                        Pilih buka situs web
                                    </li>
                                    <li>
                                        Pilih "UNDUH" untuk mengunduh {{ $setting->web }} App
                                    </li>
                                    <li>
                                        Pilih "PENGATURAN"
                                    </li>
                                    <li>
                                        Pilih "Mengizinkan" dari sumber kami
                                    </li>
                                    <li>
                                        Pilih "Terima"
                                    </li>
                                    <li>
                                        Pilih "INSTAL"
                                    </li>
                                </ol>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    @else
        <div class="banner">
            <div id="banner_carousel" class="banner-carousel">
                @foreach ($banner as $banner)
                    <div class="">
                        <a href="/promotion" target="_blank">
                            <img alt="{{ $setting->web }}" height="600" loading="lazy"
                                src="{{ storageUrl($banner->img) }}" title="{{ $setting->web }}" width="1920" />
                        </a>
                    </div>
                @endforeach
            </div>
        </div>
        <script type="text/javascript">
            $(document).ready(function() {
                $('#banner_carousel').slick({
                    autoplay: true,
                    autoplaySpeed: 3000,
                    dots: true,
                    arrows: true,
                    infinite: true,
                    speed: 500,
                    fade: true,
                    cssEase: 'linear'
                });
            });
        </script>
        <div class="announcement-outer-container">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div class="announcement-container">
                            <i data-icon="news"
                                style="--image-src: url(https://d33egg70nrp50s.cloudfront.net/Images/zoom-v2-beta/dark-turquoise/desktop/home/news.png?v=20240708-4);"></i>
                            <div data-section="announcements">
                                <ul class="announcement-list" id="announcement_list">
                                    @foreach(explode('|', $setting->announcement_text ?? '') as $item)
                                        @if(trim($item))
                                            <li>{{ trim($item) }}</li>
                                        @endif
                                    @endforeach
                                </ul>
                            </div>
                            <div data-section="date">
                                {{ \Carbon\Carbon::now('Asia/Jakarta')->format('d/m/Y (D) H.i (GMT+7)') }}
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
        <div data-container-background="home"
            style="background-image: url(//d33egg70nrp50s.cloudfront.net/Images/v-zelma-v2-beta/dark-brown/desktop/backgrounds/home.jpg?v=20240708-4);">
            <div class="container home-outer-container">
                <div class="row">
                    <div class="col-md-12">
                        <div class="home-inner-container">
                            <a href="/desktop/slots/pragmatic?PromotionCategory=Jackpot+Play+Games">
                                <div class="home-progressive-jackpot"
                                    style="--image-src: url(//d33egg70nrp50s.cloudfront.net/Images/v-zelma-v2-beta/dark-brown/desktop/home/jackpot.png?v=20240708-4);">
                                    <div class="jackpot-container"
                                        style="--image-src: url(//d33egg70nrp50s.cloudfront.net/Images/v-zelma-v2-beta/dark-brown/desktop/home/jackpot-amount-bg.png?v=20240708-4);">
                                        <span class="jackpot-currency jackpot_currency"></span>
                                        <span id="progressive_jackpot_2"
                                            data-progressive-jackpot-url="https://jp-api.zoomwlb.com"></span>
                                    </div>
                                </div>
                            </a>
                            <div class="popular-slots-outer-container">
                                <div class="popular-game-title-container">
                                    <div class="title">
                                        <i data-icon="popular-games"
                                            style="--image-src: url(//d33egg70nrp50s.cloudfront.net/Images/zoom-v2-beta/dark-turquoise/desktop/home/popular-games.png?v=20240708-4);"></i>
                                        Game Populer
                                    </div>
                                    <i></i>
                                </div>
                                <div class="game-list-container">
                                    <div class="game-list" id="popular-games-container-2">
                                        <div class="games-group">
                                            <div class="game-item">
                                                <div class="wrapper-container" style="text-align:center;padding:40px;color:#666">Memuat game...</div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="popular-game-title-container">
                                    <div class="title">
                                        <i data-icon="new-games"
                                            style="--image-src: url(//d33egg70nrp50s.cloudfront.net/Images/zoom-v2-beta/dark-turquoise/desktop/home/new-games.png?v=20240708-4);"></i>
                                        New Games
                                    </div>
                                    <i></i>
                                </div>
                                <div class="game-list-container">
                                    <div class="game-list" id="new-games-container-2">
                                        <div class="games-group">
                                            <div class="game-item">
                                                <div class="wrapper-container" style="text-align:center;padding:40px;color:#666">Memuat game...</div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="popular-game-title-container">
                                    <div class="title">
                                        <i data-icon="jackpot-games"
                                            style="--image-src: url(//d33egg70nrp50s.cloudfront.net/Images/zoom-v2-beta/dark-turquoise/desktop/home/jackpot-games.png?v=20240708-4);"></i>
                                        Jackpot Games
                                    </div>
                                    <i></i>
                                </div>
                                <div class="game-list-container">
                                    <div class="game-list" id="jackpot-games-container-2">
                                        <div class="games-group">
                                            <div class="game-item">
                                                <div class="wrapper-container" style="text-align:center;padding:40px;color:#666">Memuat game...</div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="download-apk-container container"><div class="download-apk-container container">
                <div class="row">
                    <div class="col-md-12">
                        <div class="download-apk" id="download_apk"
                            style="--image-src: url(//d33egg70nrp50s.cloudfront.net/Images/v-zelma-v2-beta/dark-brown/desktop/home/download-apk-background.webp?v=20240708-4);">
                            <div>
                                <div class="h2">
                                    Unduh Gratis
                                    <span>{{ $setting->web }} App</span>
                                </div>
                                <div class="h3">
                                    Nikmati performa terbaik dari Aplikasi kami <br />
                                    Tersedia dalam Android!
                                </div>
                                <div class="download-apk-info">
                                    <div class="download-apk-section">
                                        <div class="download-apk-qr-code">
                                            <a href="{{ route('download', ['filename' => 'one-heart.apk']) }}">
                                                <picture>
                                                    <source
                                                        srcset="//d33egg70nrp50s.cloudfront.net/Images/apk-qrcodes/AJP.webp?v=20240708-4"
                                                        type="image/webp" />
                                                    <source
                                                        srcset="//d33egg70nrp50s.cloudfront.net/Images/apk-qrcodes/AJP.webp?v=20240708-4"
                                                        type="image/jpeg" /><img alt="Unduh APK Permainan" height="94"
                                                        loading="lazy"
                                                        src="//d33egg70nrp50s.cloudfront.net/Images/apk-qrcodes/AJP.webp?v=20240708-4"
                                                        width="94" />
                                                </picture>
                                            </a>
                                        </div>
                                        <div class="download-apk-detail">
                                            <div>{{ $setting->web }} App</div>
                                            <a href="{{ route('download', ['filename' => 'one-heart.apk']) }}" data-toggle="modal" data-target="#apk_install_guide_modal">
                                                <picture>
                                                    <source
                                                        srcset="//d33egg70nrp50s.cloudfront.net/Images/v-zelma-v2-beta/dark-brown/desktop/home/download-android-button.webp?v=20240708-4"
                                                        type="image/webp" />
                                                    <source
                                                        srcset="//d33egg70nrp50s.cloudfront.net/Images/v-zelma-v2-beta/dark-brown/desktop/home/download-android-button.png?v=20240708-4"
                                                        type="image/png" /><img alt="Download APK" class="img-responsive"
                                                        height="35" loading="lazy"
                                                        src="//d33egg70nrp50s.cloudfront.net/Images/v-zelma-v2-beta/dark-brown/desktop/home/download-android-button.png?v=20240708-4"
                                                        width="146" />
                                                </picture>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                                <span>*Pindai kode QR untuk Unduh <i>Android APK</i></span>
                            </div>
                            <div>
                                <picture>
                                    <source
                                        srcset="//d33egg70nrp50s.cloudfront.net/Images/v-zelma-v2-beta/dark-brown/desktop/home/download-apk-phone.webp?v=20240708-4"
                                        type="image/webp" />
                                    <source
                                        srcset="//d33egg70nrp50s.cloudfront.net/Images/v-zelma-v2-beta/dark-brown/desktop/home/download-apk-phone.png?v=20240708-4"
                                        type="image/png" /><img alt="Download APK" class="img-responsive" height="345"
                                        loading="lazy"
                                        src="//d33egg70nrp50s.cloudfront.net/Images/v-zelma-v2-beta/dark-brown/desktop/home/download-apk-phone.png?v=20240708-4"
                                        width="490" />
                                </picture>
                            </div>
                        </div>
                    </div>
                </div>
                <div id="apk_install_guide_modal" class="modal download-popup-modal" role="dialog"
                    data-title="Panduan Instalasi" aria-hidden="false">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">×</span>
                                </button>
                                <div class="modal-title" id="apk_install_guide_modal_title">
                                    Panduan Instalasi
                                </div>
                            </div>
                            <div class="modal-body" id="apk_install_guide_modal_body">
                                <span><img alt="Android" height="20" loading="lazy"
                                        src="//d33egg70nrp50s.cloudfront.net/Images/icons/android-logo.svg?v=20240708-4"
                                        width="20" /> Instalasi Android</span>
                                <ol>
                                    <li>
                                        Pindai kode QR untuk Android
                                    </li>
                                    <li>
                                        Pilih buka situs web
                                    </li>
                                    <li>
                                        Pilih "UNDUH" untuk mengunduh {{ $setting->web }} App
                                    </li>
                                    <li>
                                        Pilih "PENGATURAN"
                                    </li>
                                    <li>
                                        Pilih "Mengizinkan" dari sumber kami
                                    </li>
                                    <li>
                                        Pilih "Terima"
                                    </li>
                                    <li>
                                        Pilih "INSTAL"
                                    </li>
                                </ol>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
        <div class="site-contacts">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <ul class="contact-list">
                            <li>
                                <a href="https://wa.me/{{ $setting->whatsapp }}" target="_blank" rel="noopener nofollow">
                                    <i>
                                        <img alt="Contact" height="18" loading="lazy"
                                            src="//d33egg70nrp50s.cloudfront.net/Images/communications/whatsapp.svg?v=20240708-4"
                                            width="18" />
                                    </i>
                                    -
                                </a>
                            </li>
                            <li>
                                <a href="https://t.me/{{ $setting->telegram }}" target="_blank" rel="noopener nofollow">
                                    <i>
                                        <img alt="Contact" height="18" loading="lazy"
                                            src="//d33egg70nrp50s.cloudfront.net/Images/communications/telegram.svg?v=20240708-4"
                                            width="18" />
                                    </i>
                                    {{ $setting->web }}
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    @endif

<script>
(function() {
    var baseUrl = '{{ config('app.api_base_url') }}';
    var loggedIn = {{ Auth::check() ? 'true' : 'false' }};

    function gameCard(game) {
        var img = game.image || '';
        var imgHtml = img ? '<picture><source srcset="' + img + '" type="image/webp" /><img alt="' + escHtml(game.game_name) + '" height="150" loading="lazy" src="' + img + '" width="150" /></picture>' : '<div style="width:150px;height:150px;background:#1a1a2e;display:flex;align-items:center;justify-content:center;color:#666;border-radius:8px">' + escHtml(game.game_name) + '</div>';
        var playUrl = loggedIn
            ? '/gameplay/' + game.id + '/show'
            : '/login';
        return '<div class="game-item" data-game="' + escHtml(game.game_name) + '">' +
            '<div class="wrapper-container">' + imgHtml +
            '<div class="link-container"><a href="' + playUrl + '" class="play-now" data-game="' + escHtml(game.game_name) + '">MAIN</a></div>' +
            '</div><div class="game-name">' + escHtml(game.game_name) + '</div></div>';
    }

    function renderGames(containerId, url) {
        var container = document.getElementById(containerId);
        if (!container) return;
        fetch(url, { headers: { 'Accept': 'application/json' } })
        .then(function(r){ return r.json(); })
        .then(function(resp) {
            if (!resp.success || !resp.data || !resp.data.length) {
                container.innerHTML = '<div class="game-item"><div class="wrapper-container" style="text-align:center;padding:40px;color:#666">Tidak ada game.</div></div>';
                return;
            }
            var html = '';
            resp.data.forEach(function(game, i) {
                if (i % 2 === 0) html += '<div class="games-group">';
                html += gameCard(game);
                if (i % 2 === 1 || i === resp.data.length - 1) html += '</div>';
            });
            container.innerHTML = html;
        })
        .catch(function(e){ console.error('Games load error:', e); });
    }

    renderGames('popular-games-container', baseUrl + '/public-games?limit=20');
    renderGames('new-games-container', baseUrl + '/public-games?limit=12&order=latest');
    renderGames('jackpot-games-container', baseUrl + '/public-games?limit=6&order=latest');
    renderGames('popular-games-container-2', baseUrl + '/public-games?limit=20');
    renderGames('new-games-container-2', baseUrl + '/public-games?limit=12&order=latest');
    renderGames('jackpot-games-container-2', baseUrl + '/public-games?limit=6&order=latest');

    function escHtml(s) {
        if (!s) return '';
        return s.replace(/&/g,'&amp;').replace(/</g,'&lt;').replace(/>/g,'&gt;').replace(/"/g,'&quot;');
    }
})();
</script>


@endsection
