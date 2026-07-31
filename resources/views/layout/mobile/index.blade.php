 @extends('layout.mobile.main')
 @section('mobile')
     @if (Auth::check())
         @include('layout.mobile.index_auth')
     @else
         <div class="announcement-container">
             <div data-section="date">
                 <i data-icon="news"
                     style="--image-src: url(//d33egg70nrp50s.cloudfront.net/Images/v-zelma-v2-beta/dark-brown/mobile/home/news.svg?v=20240708-4);"></i>
             </div>
             <div data-section="announcements">
                 <div id="ER_1720862066402">
                     <div class="tickercontainer">
                         <div class="mask">
                             <ul class="announcement-list newsticker" id="announcement_list"
                                 style="width: 4125px; left: -1250.58px;">
                                 <li class="tick-clones">Pemeliharaan Terjadwal: Crowd Play pada 2026-11-30 dari 7.00 AM
                                     sampai
                                     2025-06-02 6.30 PM (GMT + 7). Selama waktu ini, Crowd Play permainan tidak akan
                                     tersedia.
                                     Kami memohon maaf atas ketidaknyamanan yang mungkin ditimbulkan.</li>
                                 <li>Selamat Datang di {{ $setting->web }} - Situs Judi Online Terbesar &amp; Terpercaya
                                     Indonesia.</li>
                                 <li>Link anti NAWALA ( Internet Sehat ) https://bit.ly/{{ $setting->web }}</li>
                                 <li>Pemeliharaan Terjadwal: Crowd Play pada 2026-11-30 dari 7.00 AM sampai 2025-06-02 6.30
                                     PM
                                     (GMT + 7). Selama waktu ini, Crowd Play permainan tidak akan tersedia. Kami memohon
                                     maaf
                                     atas ketidaknyamanan yang mungkin ditimbulkan.</li>
                                 <li class="tick-clones">Selamat Datang di {{ $setting->web }} - Situs Judi Online Terbesar
                                     &amp; Terpercaya
                                     Indonesia.</li>
                                 <li class="tick-clones">Link anti NAWALA ( Internet Sehat )
                                     https://bit.ly/{{ $setting->web }}
                                 </li>
                             </ul>
                         </div>
                     </div>
                 </div>
             </div>
         </div>

         <div class="banner">
             <div id="banner_carousel" class="banner-carousel">
                 @foreach ($banner as $banners)
                     <div class="">
                         <a href="/promotion" target="_blank">
                             <img alt="AMSGROUP" height="600" loading="lazy"
                                 src="{{ storageUrl($banners->img) }}" title="{{ $banners->title }}"
                                 width="1920" />
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
    
         <script>
             let jackpotValue = localStorage.getItem('jackpotValue');

             if (!jackpotValue) {
                 jackpotValue = 9378170590;
             } else {
                 jackpotValue = parseInt(jackpotValue);
             }

             function updateJackpotDisplay() {
                 const formattedJackpotValue = jackpotValue.toLocaleString('en-US');
                 document.getElementById('progressive_jackpot_mobile').textContent = formattedJackpotValue;
             }
             updateJackpotDisplay();
             setInterval(() => {
                 const increment = 10;
                 jackpotValue += increment;

                 localStorage.setItem('jackpotValue', jackpotValue);

                 updateJackpotDisplay();
             }, 1000);
         </script>
         <div class="main-menu-outer-container" id="main_menu_outer_container">
             <i class="fas fa-chevron-left left_trigger"></i>
             <main>
                 <a href="/slots">
                     <img alt="Hot Games" height="25" loading="lazy"
                         src="//d33egg70nrp50s.cloudfront.net/Images/v-zelma-v2-beta/dark-brown/mobile/menu/hot-games.svg?v=20240708-4"
                         style="--image-src: url(//d33egg70nrp50s.cloudfront.net/Images/v-zelma-v2-beta/dark-brown/mobile/menu/hot-games-active.svg?v=20240708-4);"
                         width="25" />
                     Hot Games
                 </a>
                 <a href="/slots">
                     <img alt="Slots" height="25" loading="lazy"
                         src="//d33egg70nrp50s.cloudfront.net/Images/v-zelma-v2-beta/dark-brown/mobile/menu/slots.svg?v=20240708-4"
                         style="--image-src: url(//d33egg70nrp50s.cloudfront.net/Images/v-zelma-v2-beta/dark-brown/mobile/menu/slots-active.svg?v=20240708-4);"
                         width="25" />
                     Slots
                 </a>
                 <a href="/casino">
                     <img alt="Live Casino" height="25" loading="lazy"
                         src="//d33egg70nrp50s.cloudfront.net/Images/v-zelma-v2-beta/dark-brown/mobile/menu/casino.svg?v=20240708-4"
                         style="--image-src: url(//d33egg70nrp50s.cloudfront.net/Images/v-zelma-v2-beta/dark-brown/mobile/menu/casino-active.svg?v=20240708-4);"
                         width="25" />
                     Live Casino
                 </a>
                 <a href="/sports">
                     <img alt="Olahraga" height="25" loading="lazy"
                         src="//d33egg70nrp50s.cloudfront.net/Images/v-zelma-v2-beta/dark-brown/mobile/menu/sports.svg?v=20240708-4"
                         style="--image-src: url(//d33egg70nrp50s.cloudfront.net/Images/v-zelma-v2-beta/dark-brown/mobile/menu/sports-active.svg?v=20240708-4);"
                         width="25" />
                     Olahraga
                 </a>
                 <a href="/arcade">
                     <img alt="Arcade" height="25" loading="lazy"
                         src="//d33egg70nrp50s.cloudfront.net/Images/v-zelma-v2-beta/dark-brown/mobile/menu/arcade.svg?v=20240708-4"
                         style="--image-src: url(//d33egg70nrp50s.cloudfront.net/Images/v-zelma-v2-beta/dark-brown/mobile/menu/arcade-active.svg?v=20240708-4);"
                         width="25" />
                     Arcade
                 </a>
                 <a href="/poker">
                     <img alt="Poker" height="25" loading="lazy"
                         src="//d33egg70nrp50s.cloudfront.net/Images/v-zelma-v2-beta/dark-brown/mobile/menu/poker.svg?v=20240708-4"
                         style="--image-src: url(//d33egg70nrp50s.cloudfront.net/Images/v-zelma-v2-beta/dark-brown/mobile/menu/poker-active.svg?v=20240708-4);"
                         width="25" />
                     Poker
                 </a>
                 <a href="/cockfight">
                     <img alt="Sabung Ayam" height="25" loading="lazy"
                         src="//d33egg70nrp50s.cloudfront.net/Images/v-zelma-v2-beta/dark-brown/mobile/menu/cockfight.svg?v=20240708-4"
                         style="--image-src: url(//d33egg70nrp50s.cloudfront.net/Images/v-zelma-v2-beta/dark-brown/mobile/menu/cockfight-active.svg?v=20240708-4);"
                         width="25" />
                     Sabung Ayam
                 </a>
             </main>
             <i class="fas fa-chevron-right right_trigger"></i>
         </div>

         <div id="menu_preview_container" class="menu-preview-container">
             <div class="game-list-container" data-game-category="Unknown">
                 <div class="game-list"></div>
             </div>
             <div class="game-list-container" data-game-category="Slots">
                 <div class="game-list"></div>
             </div>
             <div class="game-list-container" data-game-category="Casino">
                 <div class="game-list"></div>
             </div>
             <div class="game-list-container" data-game-category="Sports">
                 <div class="game-list"></div>
             </div>
             <div class="game-list-container" data-game-category="CrashGame">
                 <div class="game-list"></div>
             </div>
             <div class="game-list-container" data-game-category="Arcade">
                 <div class="game-list"></div>
             </div>
             <div class="game-list-container" data-game-category="Poker">
                 <div class="game-list"></div>
             </div>
             <div class="game-list-container" data-game-category="Cockfight">
                 <div class="game-list"></div>
             </div>
         </div>

         <div class="popular-game-title-container">
             <div class="title">
                 <i data-icon="popular-games"
                     style="--image-src: url(//d33egg70nrp50s.cloudfront.net/Images/zoom-v2-beta/dark-turquoise/mobile/layout/popular-games.png?v=20240708-4);"></i>
                 Game Populer
             </div>
         </div>
         <div class="scrollable-game-list" id="popular_game_container">
             <i class="left-chevron left_trigger"
                 style="--image-src: url(//d33egg70nrp50s.cloudfront.net/Images/icons/chevron-down.svg?v=20240708-4);"></i>
             <main class="game_list game-list">
                 <div class="games-group">
                     <div class="game-item game_item" data-game="Sweet Bonanza 1000™">
                         <label class="inner-game-item">
                             <input type="radio" name="game-list-radio-button">
                             <span class="wrapper-container">
                                 <picture>
                                     <source
                                         srcset="https://d33egg70nrp50s.cloudfront.net/Images/providers/PP/vs20fruitswx.webp?v=20240708-4"
                                         type="image/webp" />
                                     <source
                                         srcset="https://d33egg70nrp50s.cloudfront.net/Images/providers/PP/vs20fruitswx.jpg?v=20240708-4"
                                         type="image/jpeg" /><img alt="Sweet Bonanza 1000™" height="100"
                                         loading="lazy"
                                         src="https://d33egg70nrp50s.cloudfront.net/Images/providers/PP/vs20fruitswx.jpg?v=20240708-4"
                                         width="100" />
                                 </picture>
                                 <span class="link-container">
                                     <a href="/slots" class="play-now" data-game="Sweet Bonanza 1000™">
                                         MAIN
                                     </a>
                                 </span>
                             </span>
                             <span class="game-name">Sweet Bonanza 1000™</span>
                         </label>
                     </div>
                     <div class="game-item game_item" data-game="Mahjong Ways">
                         <label class="inner-game-item">
                             <input type="radio" name="game-list-radio-button">
                             <span class="wrapper-container">
                                 <picture>
                                     <source
                                         srcset="https://d33egg70nrp50s.cloudfront.net/Images/providers/PGSOFT/mahjong-ways.webp?v=20240708-4"
                                         type="image/webp" />
                                     <source
                                         srcset="https://d33egg70nrp50s.cloudfront.net/Images/providers/PGSOFT/mahjong-ways.jpg?v=20240708-4"
                                         type="image/jpeg" /><img alt="Mahjong Ways" height="100" loading="lazy"
                                         src="https://d33egg70nrp50s.cloudfront.net/Images/providers/PGSOFT/mahjong-ways.jpg?v=20240708-4"
                                         width="100" />
                                 </picture>
                                 <span class="link-container">
                                     <a href="/slots" class="play-now" data-game="Mahjong Ways">
                                         MAIN
                                     </a>
                                 </span>
                             </span>
                             <span class="game-name">Mahjong Ways</span>
                         </label>
                     </div>
                 </div>
                 <div class="games-group">
                     <div class="game-item game_item" data-game="Mahjong Wins 2">
                         <label class="inner-game-item">
                             <input type="radio" name="game-list-radio-button">
                             <span class="wrapper-container">
                                 <picture>
                                     <source
                                         srcset="https://d33egg70nrp50s.cloudfront.net/Images/providers/PP/vswaysmahwin2.webp?v=20240708-4"
                                         type="image/webp" />
                                     <source
                                         srcset="https://d33egg70nrp50s.cloudfront.net/Images/providers/PP/vswaysmahwin2.jpg?v=20240708-4"
                                         type="image/jpeg" /><img alt="Mahjong Wins 2" height="100" loading="lazy"
                                         src="https://d33egg70nrp50s.cloudfront.net/Images/providers/PP/vswaysmahwin2.jpg?v=20240708-4"
                                         width="100" />
                                 </picture>
                                 <span class="link-container">
                                     <a href="/slots" class="play-now" data-game="Mahjong Wins 2">
                                         MAIN
                                     </a>
                                 </span>
                             </span>
                             <span class="game-name">Mahjong Wins 2</span>
                         </label>
                     </div>
                     <div class="game-item game_item" data-game="Jajanan Pasar">
                         <label class="inner-game-item">
                             <input type="radio" name="game-list-radio-button">
                             <span class="wrapper-container">
                                 <picture>
                                     <source
                                         srcset="https://d33egg70nrp50s.cloudfront.net/Images/providers/PP/vs20fruitjpas.webp?v=20240708-4"
                                         type="image/webp" />
                                     <source
                                         srcset="https://d33egg70nrp50s.cloudfront.net/Images/providers/PP/vs20fruitjpas.jpg?v=20240708-4"
                                         type="image/jpeg" /><img alt="Jajanan Pasar" height="100" loading="lazy"
                                         src="https://d33egg70nrp50s.cloudfront.net/Images/providers/PP/vs20fruitjpas.jpg?v=20240708-4"
                                         width="100" />
                                 </picture>
                                 <span class="link-container">
                                     <a href="/slots" class="play-now" data-game="Jajanan Pasar">
                                         MAIN
                                     </a>
                                 </span>
                             </span>
                             <span class="game-name">Jajanan Pasar</span>
                         </label>
                     </div>
                 </div>
                 <div class="games-group">
                     <div class="game-item game_item" data-game="SixSixSix">
                         <label class="inner-game-item">
                             <input type="radio" name="game-list-radio-button">
                             <span class="wrapper-container">
                                 <picture>
                                     <source
                                         srcset="https://d33egg70nrp50s.cloudfront.net/Images/providers/HACKSAW/HACKSAW_1534.webp?v=20240708-4"
                                         type="image/webp" />
                                     <source
                                         srcset="https://d33egg70nrp50s.cloudfront.net/Images/providers/HACKSAW/HACKSAW_1534.jpg?v=20240708-4"
                                         type="image/jpeg" /><img alt="SixSixSix" height="100" loading="lazy"
                                         src="https://d33egg70nrp50s.cloudfront.net/Images/providers/HACKSAW/HACKSAW_1534.jpg?v=20240708-4"
                                         width="100" />
                                 </picture>
                                 <span class="link-container">
                                     <a href="/slots" class="play-now" data-game="SixSixSix">
                                         MAIN
                                     </a>
                                 </span>
                             </span>
                             <span class="game-name">SixSixSix</span>
                         </label>
                     </div>
                     <div class="game-item game_item" data-game="Gates of Olympus 1000™">
                         <label class="inner-game-item">
                             <input type="radio" name="game-list-radio-button">
                             <span class="wrapper-container">
                                 <picture>
                                     <source
                                         srcset="https://d33egg70nrp50s.cloudfront.net/Images/providers/PP/vs20olympx.webp?v=20240708-4"
                                         type="image/webp" />
                                     <source
                                         srcset="https://d33egg70nrp50s.cloudfront.net/Images/providers/PP/vs20olympx.jpg?v=20240708-4"
                                         type="image/jpeg" /><img alt="Gates of Olympus 1000™" height="100"
                                         loading="lazy"
                                         src="https://d33egg70nrp50s.cloudfront.net/Images/providers/PP/vs20olympx.jpg?v=20240708-4"
                                         width="100" />
                                 </picture>
                                 <span class="link-container">
                                     <a href="/slots" class="play-now" data-game="Gates of Olympus 1000™">
                                         MAIN
                                     </a>
                                 </span>
                             </span>
                             <span class="game-name">Gates of Olympus 1000™</span>
                         </label>
                     </div>
                 </div>
                 <div class="games-group">
                     <div class="game-item game_item" data-game="Ze Zeus">
                         <label class="inner-game-item">
                             <input type="radio" name="game-list-radio-button">
                             <span class="wrapper-container">
                                 <picture>
                                     <source
                                         srcset="https://d33egg70nrp50s.cloudfront.net/Images/providers/HACKSAW/HACKSAW_1508.webp?v=20240708-4"
                                         type="image/webp" />
                                     <source
                                         srcset="https://d33egg70nrp50s.cloudfront.net/Images/providers/HACKSAW/HACKSAW_1508.jpg?v=20240708-4"
                                         type="image/jpeg" /><img alt="Ze Zeus" height="100" loading="lazy"
                                         src="https://d33egg70nrp50s.cloudfront.net/Images/providers/HACKSAW/HACKSAW_1508.jpg?v=20240708-4"
                                         width="100" />
                                 </picture>
                                 <span class="link-container">
                                     <a href="/slots" class="play-now" data-game="Ze Zeus">
                                         MAIN
                                     </a>
                                 </span>
                             </span>
                             <span class="game-name">Ze Zeus</span>
                         </label>
                     </div>
                     <div class="game-item game_item" data-game="Way of Ninja">
                         <label class="inner-game-item">
                             <input type="radio" name="game-list-radio-button">
                             <span class="wrapper-container">
                                 <picture>
                                     <source
                                         srcset="https://d33egg70nrp50s.cloudfront.net/Images/providers/PP/vs20olympnin.webp?v=20240708-4"
                                         type="image/webp" />
                                     <source
                                         srcset="https://d33egg70nrp50s.cloudfront.net/Images/providers/PP/vs20olympnin.jpg?v=20240708-4"
                                         type="image/jpeg" /><img alt="Way of Ninja" height="100" loading="lazy"
                                         src="https://d33egg70nrp50s.cloudfront.net/Images/providers/PP/vs20olympnin.jpg?v=20240708-4"
                                         width="100" />
                                 </picture>
                                 <span class="link-container">
                                     <a href="/slots" class="play-now" data-game="Way of Ninja">
                                         MAIN
                                     </a>
                                 </span>
                             </span>
                             <span class="game-name">Way of Ninja</span>
                         </label>
                     </div>
                 </div>
                 <div class="games-group">
                     <div class="game-item game_item" data-game="Starlight Princess™">
                         <label class="inner-game-item">
                             <input type="radio" name="game-list-radio-button">
                             <span class="wrapper-container">
                                 <picture>
                                     <source
                                         srcset="https://d33egg70nrp50s.cloudfront.net/Images/providers/PP/vs20starlight.webp?v=20240708-4"
                                         type="image/webp" />
                                     <source
                                         srcset="https://d33egg70nrp50s.cloudfront.net/Images/providers/PP/vs20starlight.jpg?v=20240708-4"
                                         type="image/jpeg" /><img alt="Starlight Princess™" height="100"
                                         loading="lazy"
                                         src="https://d33egg70nrp50s.cloudfront.net/Images/providers/PP/vs20starlight.jpg?v=20240708-4"
                                         width="100" />
                                 </picture>
                                 <span class="link-container">
                                     <a href="/slots" class="play-now" data-game="Starlight Princess™">
                                         MAIN
                                     </a>
                                 </span>
                             </span>
                             <span class="game-name">Starlight Princess™</span>
                         </label>
                     </div>
                     <div class="game-item game_item" data-game="Mahjong Ways 2">
                         <label class="inner-game-item">
                             <input type="radio" name="game-list-radio-button">
                             <span class="wrapper-container">
                                 <picture>
                                     <source
                                         srcset="https://d33egg70nrp50s.cloudfront.net/Images/providers/PGSOFT/mahjong-ways2.webp?v=20240708-4"
                                         type="image/webp" />
                                     <source
                                         srcset="https://d33egg70nrp50s.cloudfront.net/Images/providers/PGSOFT/mahjong-ways2.jpg?v=20240708-4"
                                         type="image/jpeg" /><img alt="Mahjong Ways 2" height="100" loading="lazy"
                                         src="https://d33egg70nrp50s.cloudfront.net/Images/providers/PGSOFT/mahjong-ways2.jpg?v=20240708-4"
                                         width="100" />
                                 </picture>
                                 <span class="link-container">
                                     <a href="/slots" class="play-now" data-game="Mahjong Ways 2">
                                         MAIN
                                     </a>
                                 </span>
                             </span>
                             <span class="game-name">Mahjong Ways 2</span>
                         </label>
                     </div>
                 </div>
                 <div class="games-group">
                     <div class="game-item game_item" data-game="Nexus Gates of Olympus™">
                         <label class="inner-game-item">
                             <input type="radio" name="game-list-radio-button">
                             <span class="wrapper-container">
                                 <picture>
                                     <source
                                         srcset="https://d33egg70nrp50s.cloudfront.net/Images/providers/PP/vs20nexusgates.webp?v=20240708-4"
                                         type="image/webp" />
                                     <source
                                         srcset="https://d33egg70nrp50s.cloudfront.net/Images/providers/PP/vs20nexusgates.jpg?v=20240708-4"
                                         type="image/jpeg" /><img alt="Nexus Gates of Olympus™" height="100"
                                         loading="lazy"
                                         src="https://d33egg70nrp50s.cloudfront.net/Images/providers/PP/vs20nexusgates.jpg?v=20240708-4"
                                         width="100" />
                                 </picture>
                                 <span class="link-container">
                                     <a href="/slots" class="play-now" data-game="Nexus Gates of Olympus™">
                                         MAIN
                                     </a>
                                 </span>
                             </span>
                             <span class="game-name">Nexus Gates of Olympus™</span>
                         </label>
                     </div>
                     <div class="game-item game_item" data-game="Wild Bounty Showdown">
                         <label class="inner-game-item">
                             <input type="radio" name="game-list-radio-button">
                             <span class="wrapper-container">
                                 <picture>
                                     <source
                                         srcset="https://d33egg70nrp50s.cloudfront.net/Images/providers/PGSOFT/PGSOFT_135.webp?v=20240708-4"
                                         type="image/webp" />
                                     <source
                                         srcset="https://d33egg70nrp50s.cloudfront.net/Images/providers/PGSOFT/PGSOFT_135.jpg?v=20240708-4"
                                         type="image/jpeg" /><img alt="Wild Bounty Showdown" height="100"
                                         loading="lazy"
                                         src="https://d33egg70nrp50s.cloudfront.net/Images/providers/PGSOFT/PGSOFT_135.jpg?v=20240708-4"
                                         width="100" />
                                 </picture>
                                 <span class="link-container">
                                     <a href="/slots" class="play-now" data-game="Wild Bounty Showdown">
                                         MAIN
                                     </a>
                                 </span>
                             </span>
                             <span class="game-name">Wild Bounty Showdown</span>
                         </label>
                     </div>
                 </div>
                 <div class="games-group">
                     <div class="game-item game_item" data-game="Lucky Twins Nexus">
                         <label class="inner-game-item">
                             <input type="radio" name="game-list-radio-button">
                             <span class="wrapper-container">
                                 <picture>
                                     <source
                                         srcset="https://d33egg70nrp50s.cloudfront.net/Images/providers/MICROGAMING/SMG_luckyTwinsNexus.webp?v=20240708-4"
                                         type="image/webp" />
                                     <source
                                         srcset="https://d33egg70nrp50s.cloudfront.net/Images/providers/MICROGAMING/SMG_luckyTwinsNexus.jpg?v=20240708-4"
                                         type="image/jpeg" /><img alt="Lucky Twins Nexus" height="100" loading="lazy"
                                         src="https://d33egg70nrp50s.cloudfront.net/Images/providers/MICROGAMING/SMG_luckyTwinsNexus.jpg?v=20240708-4"
                                         width="100" />
                                 </picture>
                                 <span class="link-container">
                                     <a href="/slots" class="play-now" data-game="Lucky Twins Nexus">
                                         MAIN
                                     </a>
                                 </span>
                             </span>
                             <span class="game-name">Lucky Twins Nexus</span>
                         </label>
                     </div>
                     <div class="game-item game_item" data-game="Nexus Knockout Football Rush">
                         <label class="inner-game-item">
                             <input type="radio" name="game-list-radio-button">
                             <span class="wrapper-container">
                                 <picture>
                                     <source
                                         srcset="https://d33egg70nrp50s.cloudfront.net/Images/providers/HABANERO/SGKnockoutFootballRushNexus.webp?v=20240708-4"
                                         type="image/webp" />
                                     <source
                                         srcset="https://d33egg70nrp50s.cloudfront.net/Images/providers/HABANERO/SGKnockoutFootballRushNexus.jpg?v=20240708-4"
                                         type="image/jpeg" /><img alt="Nexus Knockout Football Rush" height="100"
                                         loading="lazy"
                                         src="https://d33egg70nrp50s.cloudfront.net/Images/providers/HABANERO/SGKnockoutFootballRushNexus.jpg?v=20240708-4"
                                         width="100" />
                                 </picture>
                                 <span class="link-container">
                                     <a href="/slots" class="play-now" data-game="Nexus Knockout Football Rush">
                                         MAIN
                                     </a>
                                 </span>
                             </span>
                             <span class="game-name">Nexus Knockout Football Rush</span>
                         </label>
                     </div>
                 </div>
                 <div class="games-group">
                     <div class="game-item game_item" data-game="The Crypt">
                         <label class="inner-game-item">
                             <input type="radio" name="game-list-radio-button">
                             <span class="wrapper-container">
                                 <picture>
                                     <source
                                         srcset="https://d33egg70nrp50s.cloudfront.net/Images/providers/NOLIMITCITY/thecrypt00000000.webp?v=20240708-4"
                                         type="image/webp" />
                                     <source
                                         srcset="https://d33egg70nrp50s.cloudfront.net/Images/providers/NOLIMITCITY/thecrypt00000000.jpg?v=20240708-4"
                                         type="image/jpeg" /><img alt="The Crypt" height="100" loading="lazy"
                                         src="https://d33egg70nrp50s.cloudfront.net/Images/providers/NOLIMITCITY/thecrypt00000000.jpg?v=20240708-4"
                                         width="100" />
                                 </picture>
                                 <span class="link-container">
                                     <a href="/slots" class="play-now" data-game="The Crypt">
                                         MAIN
                                     </a>
                                 </span>
                             </span>
                             <span class="game-name">The Crypt</span>
                         </label>
                     </div>
                     <div class="game-item game_item" data-game="Lucky Twins Wilds">
                         <label class="inner-game-item">
                             <input type="radio" name="game-list-radio-button">
                             <span class="wrapper-container">
                                 <picture>
                                     <source
                                         srcset="https://d33egg70nrp50s.cloudfront.net/Images/providers/MICROGAMING/SMG_luckyTwinsWilds.webp?v=20240708-4"
                                         type="image/webp" />
                                     <source
                                         srcset="https://d33egg70nrp50s.cloudfront.net/Images/providers/MICROGAMING/SMG_luckyTwinsWilds.jpg?v=20240708-4"
                                         type="image/jpeg" /><img alt="Lucky Twins Wilds" height="100" loading="lazy"
                                         src="https://d33egg70nrp50s.cloudfront.net/Images/providers/MICROGAMING/SMG_luckyTwinsWilds.jpg?v=20240708-4"
                                         width="100" />
                                 </picture>
                                 <span class="link-container">
                                     <a href="/slots" class="play-now" data-game="Lucky Twins Wilds">
                                         MAIN
                                     </a>
                                 </span>
                             </span>
                             <span class="game-name">Lucky Twins Wilds</span>
                         </label>
                     </div>
                 </div>
                 <div class="games-group">
                     <div class="game-item game_item" data-game="Mental">
                         <label class="inner-game-item">
                             <input type="radio" name="game-list-radio-button">
                             <span class="wrapper-container">
                                 <picture>
                                     <source
                                         srcset="https://d33egg70nrp50s.cloudfront.net/Images/providers/NOLIMITCITY/mental0000000000.webp?v=20240708-4"
                                         type="image/webp" />
                                     <source
                                         srcset="https://d33egg70nrp50s.cloudfront.net/Images/providers/NOLIMITCITY/mental0000000000.jpg?v=20240708-4"
                                         type="image/jpeg" /><img alt="Mental" height="100" loading="lazy"
                                         src="https://d33egg70nrp50s.cloudfront.net/Images/providers/NOLIMITCITY/mental0000000000.jpg?v=20240708-4"
                                         width="100" />
                                 </picture>
                                 <span class="link-container">
                                     <a href="/slots" class="play-now" data-game="Mental">
                                         MAIN
                                     </a>
                                 </span>
                             </span>
                             <span class="game-name">Mental</span>
                         </label>
                     </div>
                     <div class="game-item game_item" data-game="Fortune Gems 2">
                         <label class="inner-game-item">
                             <input type="radio" name="game-list-radio-button">
                             <span class="wrapper-container">
                                 <picture>
                                     <source
                                         srcset="https://d33egg70nrp50s.cloudfront.net/Images/providers/JILI/JILI_223.webp?v=20240708-4"
                                         type="image/webp" />
                                     <source
                                         srcset="https://d33egg70nrp50s.cloudfront.net/Images/providers/JILI/JILI_223.jpg?v=20240708-4"
                                         type="image/jpeg" /><img alt="Fortune Gems 2" height="100" loading="lazy"
                                         src="https://d33egg70nrp50s.cloudfront.net/Images/providers/JILI/JILI_223.jpg?v=20240708-4"
                                         width="100" />
                                 </picture>
                                 <span class="link-container">
                                     <a href="/slots" class="play-now" data-game="Fortune Gems 2">
                                         MAIN
                                     </a>
                                 </span>
                             </span>
                             <span class="game-name">Fortune Gems 2</span>
                         </label>
                     </div>
                 </div>
                 <div class="games-group">
                     <div class="game-item game_item" data-game="Hot Hot Fruit">
                         <label class="inner-game-item">
                             <input type="radio" name="game-list-radio-button">
                             <span class="wrapper-container">
                                 <picture>
                                     <source
                                         srcset="https://d33egg70nrp50s.cloudfront.net/Images/providers/HABANERO/HB0160.webp?v=20240708-4"
                                         type="image/webp" />
                                     <source
                                         srcset="https://d33egg70nrp50s.cloudfront.net/Images/providers/HABANERO/HB0160.jpg?v=20240708-4"
                                         type="image/jpeg" /><img alt="Hot Hot Fruit" height="100" loading="lazy"
                                         src="https://d33egg70nrp50s.cloudfront.net/Images/providers/HABANERO/HB0160.jpg?v=20240708-4"
                                         width="100" />
                                 </picture>
                                 <span class="link-container">
                                     <a href="/slots" class="play-now" data-game="Hot Hot Fruit">
                                         MAIN
                                     </a>
                                 </span>
                             </span>
                             <span class="game-name">Hot Hot Fruit</span>
                         </label>
                     </div>
                     <div class="game-item game_item" data-game="Fortune Gems">
                         <label class="inner-game-item">
                             <input type="radio" name="game-list-radio-button">
                             <span class="wrapper-container">
                                 <picture>
                                     <source
                                         srcset="https://d33egg70nrp50s.cloudfront.net/Images/providers/JILI/JILI_109.webp?v=20240708-4"
                                         type="image/webp" />
                                     <source
                                         srcset="https://d33egg70nrp50s.cloudfront.net/Images/providers/JILI/JILI_109.jpg?v=20240708-4"
                                         type="image/jpeg" /><img alt="Fortune Gems" height="100" loading="lazy"
                                         src="https://d33egg70nrp50s.cloudfront.net/Images/providers/JILI/JILI_109.jpg?v=20240708-4"
                                         width="100" />
                                 </picture>
                                 <span class="link-container">
                                     <a href="/slots" class="play-now" data-game="Fortune Gems">
                                         MAIN
                                     </a>
                                 </span>
                             </span>
                             <span class="game-name">Fortune Gems</span>
                         </label>
                     </div>
                 </div>
             </main>
             <i class="right-chevron right_trigger"
                 style="--image-src: url(//d33egg70nrp50s.cloudfront.net/Images/v-zelma-v2-beta/dark-brown/mobile/home/download-apk-background.webp?v=20240708-4);"></i>
         </div>

         <div class="download-apk-container" id="download_apk"
             style="--image-src: url(//d33egg70nrp50s.cloudfront.net/Images/v-zelma-v2-beta/dark-brown/mobile/home/download-apk-background.webp?v=20240708-4);">
             <div>
                 <div class="h2">
                     <span>Unduh Gratis</span><br />
                     {{ $setting->web }} App
                 </div>
                 <div class="h3">
                     Tersedia dalam Android!
                 </div>
                 <div class="download-apk-info">
                     <div class="download-apk-section">
                         <a href="{{ route('download', ['filename' => 'one-heart.apk']) }}">
                             <picture>
                                 <source
                                     srcset="//d33egg70nrp50s.cloudfront.net/Images/v-zelma-v2-beta/dark-brown/mobile/home/download-android-button.webp?v=20240708-4"
                                     type="image/webp" />
                                 <source
                                     srcset="//d33egg70nrp50s.cloudfront.net/Images/v-zelma-v2-beta/dark-brown/mobile/home/download-android-button.png?v=20240708-4"
                                     type="image/png" /><img alt="Download APK" class="img-responsive" height="125"
                                     loading="lazy"
                                     src="//d33egg70nrp50s.cloudfront.net/Images/v-zelma-v2-beta/dark-brown/mobile/home/download-android-button.png?v=20240708-4"
                                     width="125" />
                             </picture>
                         </a>
                     </div>
                 </div>
                 <div>
                     <a class="download-apk-guide" href="{{ route('download', ['filename' => 'one-heart.apk']) }}"
                         data-toggle="modal" data-target="#apk_install_guide_modal">Panduan instalasi</a>
                 </div>
             </div>
             <div>
                 <picture>
                     <source
                         srcset="//d33egg70nrp50s.cloudfront.net/Images/v-zelma-v2-beta/dark-brown/mobile/home/download-apk-phone.webp?v=20240708-4"
                         type="image/webp" />
                     <source
                         srcset="//d33egg70nrp50s.cloudfront.net/Images/v-zelma-v2-beta/dark-brown/mobile/home/download-apk-phone.png?v=20240708-4"
                         type="image/png" /><img alt="Download APK" class="img-responsive" height="151"
                         loading="lazy"
                         src="//d33egg70nrp50s.cloudfront.net/Images/v-zelma-v2-beta/dark-brown/mobile/home/download-apk-phone.png?v=20240708-4"
                         width="215" />
                 </picture>
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

         <div class="site-contacts">
             <div class="container">
                 <div class="row">
                     <div class="col-md-12">
                         <ul class="contact-list">
                            
                                     
                                 </a>
                             </li>
                         </ul>
                     </div>
                 </div>
             </div>
         </div>

         <div class="container">
             <div class="row">
                 <div class="col-md-12">
                     <ul class="social-media-list">
                         <li>
                             <a href="{{ $setting->livechat }}" target="_blank" rel="nofollow">
                                 <img src="https://api2-aj8.imgzm.com/images/aj8/Whatsapp_983f81b4-f547-4b83-b424-ccd0a64bcf00_1632410383380.png"
                                     alt="Social Media" width="32" height="32" loading="lazy" />
                             </a>
                         </li>
                         <li>
                             <a href="https://t.me/{{ $setting->telegram }}" target="_blank" rel="nofollow">
                                 <img src="https://api2-aj8.imgzm.com/images/aj8/TELE_48148997-82fe-4ce1-bc1e-2bc556b08bbe_1632410369453.png"
                                     alt="Social Media" width="32" height="32" loading="lazy" />
                             </a>
                         </li>
                     </ul>
                     <ul class="bank-list">
                         <li>
                             <div data-online="true">
                                 <img src="https://api2-ajp.imgzm.com/images//rpv8gxkq6i/bca_e1bab23f-dda6-4835-b3ce-d5039f28546c_1777518002260.png"
                                     width="80" height="40" alt="Bank" loading="lazy" />
                             </div>
                         </li>
                         <li>
                             <div data-online="true">
                                 <img src="https://api2-ajp.imgzm.com/images//rpv8gxkq6i/bni_3d30334c-d871-46fb-80b3-0fcb12f99b87_1754425018600.png"
                                     width="80" height="40" alt="Bank" loading="lazy" />
                             </div>
                         </li>
                         <li>
                             <div data-online="true">
                                 <img src="https://api2-ajp.imgzm.com/images//rpv8gxkq6i/bri_a458ab91-91a3-49ac-98b3-1bfc5d1966bd_1754425004610.png"
                                     width="80" height="40" alt="Bank" loading="lazy" />
                             </div>
                         </li>
                         <li>
                             <div data-online="true">
                                 <img src="https://api2-ajp.imgzm.com/images//rpv8gxkq6i/mandiri_ec4427ff-2e6e-4657-a2fe-b3702bc15e7c_1777518002260.png"
                                     width="80" height="40" alt="Bank" loading="lazy" />
                             </div>
                         </li>
                     </ul>
                 </div>
              </div>
          </div>
       @endif

 @endsection
