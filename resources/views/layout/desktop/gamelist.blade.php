@extends('layout.desktop.main')
@section('content')
    <link rel="stylesheet" href="../../../assets/css/desktop/gamelist.css">
    
    <style>
        /* === TAMBAHAN CSS JACKPOT BIAR SAMA PERSIS === */
        .jackpot-container {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            background: #000;
            border: 7px solid #b77636;
            border-radius: 50px;
            padding: 20px 30px;
            margin: 20px auto;
            box-shadow: 0 0 15px rgba(183, 118, 54, 0.3);
        }

        .jackpot-currency {
            font-size: 30px;
            font-weight: bold;
            color: #b77636;
            margin-right: 15px;
            font-family: sans-serif;
        }

        .counter-container {
            display: flex;
            align-items: center;
            gap: 2px;
        }

        .counter-container span {
            font-family: 'Courier New', Courier, monospace;
            font-size: 32px;
            font-weight: bold;
            color: #fff;
            display: inline-block;
            min-width: 18px;
            text-align: center;
        }

        .jackpot-comma {
            margin: 0 5px;
            color: #fff;
        }

        /* === CSS BAWAAN === */
        .game-item {
            opacity: 0;
            transform: translateY(20px);
            transition: opacity 0.5s ease-in-out, transform 0.5s ease-in-out;
            display: none;
        }

        .game-item[data-match="true"] {
            display: block;
            opacity: 1;
            transform: translateY(0);
        }

        .search-container {
            display: flex;
            align-items: center;
            border: none;
            border-radius: 4px;
            padding: 5px;
            max-width: 300px;
        }

        #filter_input {
            border: none;
            outline: none;
            flex-grow: 1;
            padding: 5px;
        }

        .fa-magnifying-glass {
            color: #aaa;
            padding: 5px;
        }
    </style>

    <div data-container-background="slots"
        style="background-image: url(//d33egg70nrp50s.cloudfront.net/Images/v-zelma-v2-beta/dark-brown/desktop/backgrounds/slots.jpg?v=20240708-4);">
        
        <div class="slots-banner-container">
            <picture>
                <source srcset="//d33egg70nrp50s.cloudfront.net/Images/v-zelma-v2-beta/dark-brown/desktop/providers/banners/slots/banner.webp?v=20240708-4" type="image/webp">
                <source srcset="//d33egg70nrp50s.cloudfront.net/Images/v-zelma-v2-beta/dark-brown/desktop/providers/banners/slots/banner.png?v=20240708-4" type="image/png">
                <img loading="lazy" src="//d33egg70nrp50s.cloudfront.net/Images/v-zelma-v2-beta/dark-brown/desktop/providers/banners/slots/banner.png?v=20240708-4">
            </picture>
            <picture>
                <source srcset="//d33egg70nrp50s.cloudfront.net/Images/v-zelma-v2-beta/dark-brown/desktop/decorations/coins/coin-4.webp?v=20240708-4" type="image/webp">
                <source srcset="//d33egg70nrp50s.cloudfront.net/Images/v-zelma-v2-beta/dark-brown/desktop/decorations/coins/coin-4.png?v=20240708-4" type="image/png">
                <img class="slots-coin-1 float-effect-1s" loading="lazy" src="//d33egg70nrp50s.cloudfront.net/Images/v-zelma-v2-beta/dark-brown/desktop/decorations/coins/coin-4.png?v=20240708-4">
            </picture>
            <picture>
                <source srcset="//d33egg70nrp50s.cloudfront.net/Images/v-zelma-v2-beta/dark-brown/desktop/decorations/coins/coin-5.webp?v=20240708-4" type="image/webp">
                <source srcset="//d33egg70nrp50s.cloudfront.net/Images/v-zelma-v2-beta/dark-brown/desktop/decorations/coins/coin-5.png?v=20240708-4" type="image/png">
                <img class="slots-coin-2 float-effect-1s" loading="lazy" src="//d33egg70nrp50s.cloudfront.net/Images/v-zelma-v2-beta/dark-brown/desktop/decorations/coins/coin-5.png?v=20240708-4">
            </picture>
            <picture>
                <source srcset="//d33egg70nrp50s.cloudfront.net/Images/v-zelma-v2-beta/dark-brown/desktop/decorations/coins/coin-6.webp?v=20240708-4" type="image/webp">
                <source srcset="//d33egg70nrp50s.cloudfront.net/Images/v-zelma-v2-beta/dark-brown/desktop/decorations/coins/coin-6.png?v=20240708-4" type="image/png">
                <img class="slots-coin-3 float-effect-2s-d" loading="lazy" src="//d33egg70nrp50s.cloudfront.net/Images/v-zelma-v2-beta/dark-brown/desktop/decorations/coins/coin-6.png?v=20240708-4">
            </picture>
        </div>

        <div class="container slots-container">
            <div class="row">
                <div class="col-md-12">
                    
                    <div class="progressive-jackpot">
                        <span id="progressive_jackpot" data-progressive-jackpot-url="https://dhro5khzpwdga.cloudfront.net"></span>
                        <a href="/slots" style="text-decoration: none;">
                            <div class="jackpot-container">
                                <span class="jackpot-currency jackpot_currency">IDR</span>
                                <span class="counter-container" id="progressive_jackpot_counter"></span>
                            </div>
                        </a>
                    </div>

                    <div class="games-list-container">
                        <div class="provider-outer-container">
                            @include('layout.desktop.provider')

                            <div class="vendor-name">
                                {{ $title }}
                            </div>
                            <div class="filter-section">
                                <div class="category-filter" id="filter_categories">
                                    <div class="category-filter-link active" data-category="">Semua permainan</div>
                                    <div class="category-filter-link" data-category="Top">Top</div>
                                    <div class="category-filter-link" data-category="Classic">Classic</div>
                                    <div class="category-filter-link" data-category="Bonus Buy">Bonus Buy</div>
                                    <div class="category-filter-link" data-category="Video Slots">Video Slots</div>
                                </div>
                                <div class="search-container">
                                    <input type="text" id="filter_input" placeholder="Cari Permainan">
                                    <i class="fa-solid fa-magnifying-glass"></i>
                                </div>
                            </div>
                        </div>

                        <div class="game-list" style="--star-on-icon: ur[](https://d33egg70nrp50s.cloudfront.net/Images/icons/star-on.svg?v=20240708-4); --star-off-icon: ur[](https://d33egg70nrp50s.cloudfront.net/Images/icons/star-off.svg?v=20240708-4);">
                            
                            {{-- ==================== PERBAIKAN DI SINI ==================== --}}
                @foreach ($gamelist as $game)
                <div class="game-item" data-game="{{ $game->game_name }}" data-match="true">

                    <div class="wrapper-container">

                       <img
                    src="{{ $game->image_url ?? $game->game_image ?? asset('assets/images/default-game.png') }}"
                    alt="{{ $game->game_name }}"
                    onerror="this.onerror=null;this.src='{{ asset('assets/images/default-game.png') }}';">

                        <div class="link-container">

                            @auth

                                @if(request()->is('casino/*'))

                                    <button
                                        type="button"
                                        class="casino-play-btn"
                                        style="background:#00c853;color:#fff;border:none;padding:10px 25px;border-radius:6px;font-weight:bold;cursor:pointer;"
                                        onclick="window.location.href='{{ route('casino.play', $game->game_uid) }}';">
                                        MAIN
                                    </button>

                                @else

                                    <button
                                        type="button"
                                        class="casino-play-btn"
                                        style="background:#00c853;color:#fff;border:none;padding:10px 25px;border-radius:6px;font-weight:bold;cursor:pointer;"
                                        onclick="window.location.href='{{ route('sports.play', $game->game_uid) }}';">
                                        MAIN
                                    </button>

                                @endif

                            @else

                                <button
                                    type="button"
                                    style="background:#00c853;color:#fff;border:none;padding:10px 25px;border-radius:6px;font-weight:bold;cursor:pointer;"
                                    onclick="registerPopup({content:'Silahkan login terlebih dahulu.'});">
                                    MAIN
                                </button>

                            @endauth

                        </div>

                    </div>

                    <div class="game-name">
                        {{ $game->game_name }}
                    </div>

                </div>
                @endforeach
                            {{-- ==================== SELESAI PERBAIKAN ==================== --}}

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        // SCRIPT FILTER GAME
        document.getElementById('filter_input').addEventListener('input', function() {
            var filterValue = this.value.toLowerCase();
            var gameItems = document.querySelectorAll('.game-item');

            gameItems.forEach(function(item) {
                var gameName = item.getAttribute('data-game').toLowerCase();
                if (gameName.includes(filterValue)) {
                    item.setAttribute('data-match', 'true');
                } else {
                    item.setAttribute('data-match', 'false');
                }
            });
        });

        // SCRIPT PROGRESSIVE JACKPOT AUTO-INCREMENT
        (function() {
            var jackpotDataElement = document.getElementById('progressive_jackpot');
            var counterContainer = document.getElementById('progressive_jackpot_counter');
            
            var startValueStr = jackpotDataElement.innerText.replace(/[^0-9]/g, '');
            var currentJackpot = parseInt(startValueStr, 10) || 124071600;

            function renderJackpot(value) {
                var formattedStr = value.toLocaleString('en-US'); 
                jackpotDataElement.innerText = formattedStr; 
                
                counterContainer.innerHTML = '';
                
                for (var i = 0; i < formattedStr.length; i++) {
                    var char = formattedStr[i];
                    var span = document.createElement('span');
                    
                    if (char === ',') {
                        span.innerText = ',';
                        span.className = 'jackpot-comma'; 
                    } else {
                        span.setAttribute('data-digit', char);
                        span.innerText = char; 
                        span.className = 'animate';
                    }
                    counterContainer.appendChild(span);
                }
            }

            renderJackpot(currentJackpot);

            setInterval(function() {
                var randomIncrement = Math.floor(Math.random() * 9000) + 1000;
                currentJackpot += randomIncrement;
                renderJackpot(currentJackpot);
            }, 2500); 
        })();
    </script>
@endsection