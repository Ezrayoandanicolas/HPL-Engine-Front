@if (Auth::check())

    <div class="navbar navbar-fixed-top">
        <div class="topbar-container">
            <div class="container">
                <div class="row">
                    <div class="col-sm-12 topbar-inner-container">
                        <a href="/" class="logo">
                            <picture>
                        <img alt="Logo"
                            loading="lazy"
                            src="{{ storageUrl($setting->logo) }}"
                            style="transform:translateY(-8px);">
                    </picture>
                        </a>
                        <div class="topbar-inner-group">
                            <div class="topbar-sub-section">
                                <div class="topbar-item language-selector-container"
                                    style="--image-src: url(//d33egg70nrp50s.cloudfront.net/Images/v-zelma-v2-beta/dark-brown/desktop/layout/flags.png?v=20240708-4);">
                                    <div id="language_selector_trigger" data-toggle="dropdown"
                                        class="language-selector-trigger" data-language="id">
                                        <i data-language="id"></i>
                                        BHS INDONESIA
                                    </div>
                                    <ul class="dropdown-menu language-selector">
                                        <li class="language_selector" data-language="en">
                                            <i data-language="en"></i>
                                            <div class="language-name">
                                                <div>ENGLISH</div>
                                                <div>ENGLISH</div>
                                            </div>
                                        </li>
                                        <li class="language_selector" data-language="id">
                                            <i data-language="id"></i>
                                            <div class="language-name">
                                                <div>BHS INDONESIA</div>
                                                <div>INDONESIAN</div>
                                            </div>
                                        </li>
                                        <li class="language_selector" data-language="kr">
                                            <i data-language="kr"></i>
                                            <div class="language-name">
                                                <div>한국어</div>
                                                <div>KOREAN</div>
                                            </div>
                                        </li>
                                        <li class="language_selector" data-language="cn">
                                            <i data-language="cn"></i>
                                            <div class="language-name">
                                                <div>中文</div>
                                                <div>CHINESE</div>
                                            </div>
                                        </li>
                                        <li class="language_selector" data-language="jp">
                                            <i data-language="jp"></i>
                                            <div class="language-name">
                                                <div>日本語</div>
                                                <div>JAPANESE</div>
                                            </div>
                                        </li>
                                        <li class="language_selector" data-language="th">
                                            <i data-language="th"></i>
                                            <div class="language-name">
                                                <div>ไทย</div>
                                                <div>THAI</div>
                                            </div>
                                        </li>
                                        <li class="language_selector" data-language="my">
                                            <i data-language="my"></i>
                                            <div class="language-name">
                                                <div>မြန်မာစာ</div>
                                                <div>BURMESE</div>
                                            </div>
                                        </li>
                                        <li class="language_selector" data-language="kh">
                                            <i data-language="kh"></i>
                                            <div class="language-name">
                                                <div>ខេមរភាសា</div>
                                                <div>KHMER</div>
                                            </div>
                                        </li>
                                        <li class="language_selector" data-language="hi">
                                            <i data-language="hi"></i>
                                            <div class="language-name">
                                                <div>हिन्दी</div>
                                                <div>HINDI</div>
                                            </div>
                                        </li>
                                        <li class="language_selector" data-language="ta">
                                            <i data-language="ta"></i>
                                            <div class="language-name">
                                                <div>தமிழ்</div>
                                                <div>TAMIL</div>
                                            </div>
                                        </li>
                                        <li class="language_selector" data-language="te">
                                            <i data-language="te"></i>
                                            <div class="language-name">
                                                <div>తెలుగు</div>
                                                <div>TELUGU</div>
                                            </div>
                                        </li>
                                        <li class="language_selector" data-language="vi">
                                            <i data-language="vi"></i>
                                            <div class="language-name">
                                                <div>Tiếng Việt</div>
                                                <div>VIETNAMESE</div>
                                            </div>
                                        </li>
                                        <li class="language_selector" data-language="bn">
                                            <i data-language="bn"></i>
                                            <div class="language-name">
                                                <div>বাংলাদেশী</div>
                                                <div>BENGALI</div>
                                            </div>
                                        </li>
                                        <li class="language_selector" data-language="pt">
                                            <i data-language="pt"></i>
                                            <div class="language-name">
                                                <div>Português</div>
                                                <div>PORTUGESE</div>
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                                <div class="topbar-item">
                                    <a href="{{ $setting->livechat }}">
                                        <span class="js_live_chat_link live-chat">
                                            <i data-icon="live-chat"
                                                style="--image-src: url(//d33egg70nrp50s.cloudfront.net/Images/v-zelma-v2-beta/dark-brown/desktop/layout/live-chat.svg?v=20240708-4);"></i>
                                            Live Chat
                                        </span>
                                    </a>
                                </div>
                                <div class="topbar-item">
                                    <a href="/versi-mobile" rel="nofollow">
                                        <i data-icon="mobile"
                                            style="--image-src: url(//d33egg70nrp50s.cloudfront.net/Images/v-zelma-v2-beta/dark-brown/desktop/layout/mobile.svg?v=20240708-4);"></i>
                                        Versi Mobile
                                    </a>
                                </div>
                            </div>

                            <div class="user-info">
                                <div class="user-info-item" id="loyalty_level_container">
                                    <div class="user-info-loyalty-xp">
                                        <a href="#">
                                            <img id="loyalty_level" loading="lazy"
                                                src="//d33egg70nrp50s.cloudfront.net/Images/v-zelma-v2-beta/dark-brown/desktop/loyalty/badge/bronze.svg">
                                            <input type="hidden" id="loyalty_level_img_path"
                                                value="//d33egg70nrp50s.cloudfront.net/Images/v-zelma-v2-beta/dark-brown/desktop/loyalty/badge/">
                                        </a>
                                        <div class="username-container">
                                            <span>{{ Auth()->user()->username }}</span>
                                            <div class="loyalty-xp-progress" id="loyalty_experience">
                                                <div class="progress" id="loyalty_experience_progress"
                                                    style="width: 0%">
                                                </div>
                                            </div>
                                            <div class="loyalty-xp-detail">
                                                <span id="loyalty_xp">{{ Auth()->user()->point_player }}</span> / <span
                                                    id="loyalty_next_level_xp">{{ Auth()->user()->exp_player }}</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <script>
                                    $(document).ready(function() {
                                        // Fetch player progress data when the page is loaded
                                        fetchPlayerProgress();

                                        function fetchPlayerProgress() {
                                            $.ajax({
                                                type: "GET",
                                                url: "/player-progress",
                                                data: {
                                                    _token: "{{ csrf_token() }}"
                                                },
                                                success: function(response) {
                                                    updateProgress(response);
                                                },
                                                error: function(error) {
                                                    console.error("Error fetching player progress:", error);
                                                }
                                            });
                                        }

                                        function updateProgress(data) {
                                            if (data.success) {
                                                // Get the user's current points and experience using Blade templating
                                                var pointPlayer = {{ Auth::user()->point_player }};
                                                var expPlayer = {{ Auth::user()->exp_player }};

                                                // Update the progress percentage text
                                                $("#loyalty_experience_percentage").text(
                                                    pointPlayer + " / " + expPlayer + " XP (" + data.progress.toFixed(2) + "%)"
                                                );

                                                // Update the progress bar directly
                                                $("#loyalty_experience_progress").css({
                                                    "background-color": "#20B2AA", // Teal color
                                                    "width": data.progress + "%" // Dynamic width based on progress
                                                });

                                                // Check if progress is 100% and update the badge image and exp_player value
                                                if (data.progress >= 100) {
                                                    var newExpPlayer = expPlayer < 100000 ? 100000 : expPlayer +
                                                        100000; // Increment to next level

                                                    // Update the user's exp_player value if needed
                                                    $.ajax({
                                                        type: "POST",
                                                        url: "/update-exp-player",
                                                        data: {
                                                            _token: "{{ csrf_token() }}",
                                                            exp_player: newExpPlayer
                                                        },
                                                        success: function(response) {
                                                            if (response.success) {
                                                                console.log("exp_player updated to " + newExpPlayer);

                                                                // Update the badge based on the new exp_player value
                                                                updateBadge(response.badge_level);

                                                                // Reset the progress bar to 0%
                                                                $("#loyalty_experience_progress").css({
                                                                    "width": "0%"
                                                                });

                                                                // Update the progress percentage text
                                                                $("#loyalty_experience_percentage").text(
                                                                    pointPlayer + " / " + newExpPlayer + " XP (0%)"
                                                                );

                                                            } else {
                                                                console.error("Failed to update exp_player");
                                                            }
                                                        },
                                                        error: function(error) {
                                                            console.error("Error updating exp_player:", error);
                                                        }
                                                    });
                                                } else {
                                                    // No need to update exp_player, check badge directly
                                                    updateBadgeBasedOnExp(expPlayer);
                                                }
                                            } else {
                                                console.error("Failed to fetch progress data");
                                            }
                                        }

                                        function updateBadge(badgeLevel) {
                                            var badgePath = $("#loyalty_level_img_path").val();
                                            var badgeImage = '';

                                            switch (badgeLevel) {
                                                case 'platinum':
                                                    badgeImage = "diamond.svg";
                                                    break;
                                                case 'gold':
                                                    badgeImage = "gold.svg";
                                                    break;
                                                case 'silver':
                                                    badgeImage = "silver.svg";
                                                    break;
                                                default:
                                                    badgeImage = "bronze.svg";
                                            }

                                            $("#loyalty_level").attr("src", badgePath + badgeImage);
                                        }

                                        function updateBadgeBasedOnExp(expPlayer) {
                                            var badgePath = $("#loyalty_level_img_path").val();
                                            var badgeImage = '';

                                            if (expPlayer >= 1000000) {
                                                badgeImage = "diamond.svg";
                                            } else if (expPlayer >= 500000) {
                                                badgeImage = "gold.svg";
                                            } else if (expPlayer >= 100000) {
                                                badgeImage = "silver.svg";
                                            } else {
                                                badgeImage = "bronze.svg";
                                            }

                                            $("#loyalty_level").attr("src", badgePath + badgeImage);
                                        }
                                    });
                                </script>
                                <div class="user-info-item">
                                    @if (Auth()->user()->reward == 1)
                                        <button type="button" id="after">
                                            <i class="daily-reward daily_reward_button" data-icon="daily-reward"
                                                data-platform="Desktop" data-daily-reward-available="false"
                                                style="--chest-claimed-background: url(//d33egg70nrp50s.cloudfront.net/Images/v-zelma-v2-beta/dark-brown/desktop/loyalty/chest-claimed.webp?v=20240708-4);
                                            --chest-available-background: url(//d33egg70nrp50s.cloudfront.net/Images/v-zelma-v2-beta/dark-brown/desktop/loyalty/chest-available.webp?v=20240708-4);"></i>
                                        </button>
                                    @else
                                        <button type="button" id="rewardButton">
                                            <i class="daily-reward daily_reward_button" data-icon="daily-reward"
                                                data-platform="Desktop" data-daily-reward-available="true"
                                                style="--chest-claimed-background: url(//d33egg70nrp50s.cloudfront.net/Images/v-zelma-v2-beta/dark-brown/desktop/loyalty/chest-claimed.webp?v=20240708-4);
                                            --chest-available-background: url(//d33egg70nrp50s.cloudfront.net/Images/v-zelma-v2-beta/dark-brown/desktop/loyalty/chest-available.webp?v=20240708-4);"></i>
                                        </button>
                                    @endif
                                </div>
                                <div class="user-info-item" id="loyalty_point_info">
                                    <a href="#" class="user-info-loyalty-point">
                                        <div class="lp-label">LP</div>
                                        <span id="loyalty_point">{{ Auth()->user()->point_player }}</span>
                                    </a>
                                </div>
                                <div class="user-info-item">
                                    <button title="Refresh" id="refresh_balance" data-loading="false">
                                        <picture>
                                            <source
                                                srcset="//d33egg70nrp50s.cloudfront.net/Images/v-zelma-v2-beta/dark-brown/desktop/layout/refresh-v2.svg?v=606181553?v=20240708-4"
                                                type="image/webp">
                                            <source
                                                srcset="//d33egg70nrp50s.cloudfront.net/Images/v-zelma-v2-beta/dark-brown/desktop/layout/refresh-v2.svg?v=606181553?v=20240708-4"
                                                type="image/png"><img loading="lazy"
                                                src="//d33egg70nrp50s.cloudfront.net/Images/v-zelma-v2-beta/dark-brown/desktop/layout/refresh-v2.svg?v=606181553?v=20240708-4">
                                        </picture>
                                    </button>
                                </div>
                               <div class="user-info-item wallet-container">

    <div class="balance dropdown">

        <a href="#"
           class="wallet-dropdown"
           data-toggle="dropdown"
           aria-expanded="false">

            <span class="wallet-currency">IDR</span>

            <span class="balance total_balance" id="nav_main_balance">
                Rp {{ number_format($mainBalance,0,',','.') }}
            </span>

        </a>

        <div class="dropdown-menu dropdown-menu-right vendor-balances-container">

            <div class="vendor-balances-header">

                <h5 class="mb-1">
                    SALDO WALLET
                </h5>

                <div class="balance total_balance" id="nav_main_balance_header">
                    Rp {{ number_format($mainBalance,0,',','.') }}
                </div>

            </div>

            <div class="vendor-balances-content">

                <div class="wallet-item">

                    <span>💳 Main Wallet</span>

                    <strong id="nav_wallet_main">
                        Rp {{ number_format($mainBalance,0,',','.') }}
                    </strong>

                </div>

                <div class="wallet-item">

                    <span>🎰 Slot Wallet</span>

                    <strong id="nav_wallet_slot">
                        Rp {{ number_format($slotBalance,0,',','.') }}
                    </strong>

                </div>

                <div class="wallet-item">

                    <span>🎮 Game Wallet</span>

                    <strong id="nav_wallet_game">
                        Rp {{ number_format($gameBalance,0,',','.') }}
                    </strong>

                </div>

                <hr>

                <a href="{{ route('transfer') }}"
                   class="btn btn-success btn-sm w-100">

                    🔄 Transfer Wallet

                </a>

            </div>

        </div>

    </div>

</div>
                                <div class="user-info-item">
                                    <a href="/deposit">
                                        <picture>
                                            <source
                                                srcset="//d33egg70nrp50s.cloudfront.net/Images/v-zelma-v2-beta/dark-brown/desktop/layout/wallet.webp?v=20240708-4"
                                                type="image/webp">
                                            <source
                                                srcset="//d33egg70nrp50s.cloudfront.net/Images/v-zelma-v2-beta/dark-brown/desktop/layout/wallet.png?v=20240708-4"
                                                type="image/png"><img loading="lazy"
                                                src="//d33egg70nrp50s.cloudfront.net/Images/v-zelma-v2-beta/dark-brown/desktop/layout/wallet.png?v=20240708-4">
                                        </picture>
                                    </a>
                                </div>
                                <div class="user-info-item">
                                    <a href="/message">
                                        <picture>
                                            <source
                                                srcset="//d33egg70nrp50s.cloudfront.net/Images/v-zelma-v2-beta/dark-brown/desktop/layout/inbox.webp?v=20240708-4"
                                                type="image/webp">
                                            <source
                                                srcset="//d33egg70nrp50s.cloudfront.net/Images/v-zelma-v2-beta/dark-brown/desktop/layout/inbox.png?v=20240708-4"
                                                type="image/png"><img loading="lazy"
                                                src="//d33egg70nrp50s.cloudfront.net/Images/v-zelma-v2-beta/dark-brown/desktop/layout/inbox.png?v=20240708-4">
                                        </picture>
                                    </a>
                                </div>
                                {{-- Unduh Apk --}}
                                <div class="user-info-item">
                                    <a href="#">
                                        <picture>
                                            <source
                                                srcset="//d33egg70nrp50s.cloudfront.net/Images/v-zelma-v2-beta/dark-brown/desktop/layout/download.webp?v=20240708-4"
                                                type="image/webp">
                                            <source
                                                srcset="//d33egg70nrp50s.cloudfront.net/Images/v-zelma-v2-beta/dark-brown/desktop/layout/download.png?v=20240708-4"
                                                type="image/png"><img loading="lazy"
                                                src="//d33egg70nrp50s.cloudfront.net/Images/v-zelma-v2-beta/dark-brown/desktop/layout/download.png?v=20240708-4">
                                        </picture>
                                    </a>
                                </div>
                                <div class="user-info-item">
                                    <a href="/profile">
                                        <picture>
                                            <source
                                                srcset="//d33egg70nrp50s.cloudfront.net/Images/v-zelma-v2-beta/dark-brown/desktop/layout/profile.webp?v=20240708-4"
                                                type="image/webp">
                                            <source
                                                srcset="//d33egg70nrp50s.cloudfront.net/Images/v-zelma-v2-beta/dark-brown/desktop/layout/profile.png?v=20240708-4"
                                                type="image/png"><img loading="lazy"
                                                src="//d33egg70nrp50s.cloudfront.net/Images/v-zelma-v2-beta/dark-brown/desktop/layout/profile.png?v=20240708-4">
                                        </picture>
                                    </a>
                                </div>
                                <div class="user-info-item" id="redemption_store_link">
                                    <a href="/loyalitas" target="_blank">
                                        <picture>
                                            <source
                                                srcset="//d33egg70nrp50s.cloudfront.net/Images/v-zelma-v2-beta/dark-brown/desktop/layout/redemption-store.webp?v=20240708-4"
                                                type="image/webp">
                                            <source
                                                srcset="//d33egg70nrp50s.cloudfront.net/Images/v-zelma-v2-beta/dark-brown/desktop/layout/redemption-store.png?v=20240708-4"
                                                type="image/png"><img loading="lazy"
                                                src="//d33egg70nrp50s.cloudfront.net/Images/v-zelma-v2-beta/dark-brown/desktop/layout/redemption-store.png?v=20240708-4">
                                        </picture>
                                    </a>
                                </div>
                                <div class="user-info-item" style="margin-right: 10px">
                                    <a href="#" data-new-announcement="true" data-announcement-count="0"
                                        id="unread_announcements">
                                        <img loading="lazy"
                                            src="//d33egg70nrp50s.cloudfront.net/Images/v-zelma-v2-beta/dark-brown/desktop/layout/bell.svg?v=20240708-4"
                                            alt="Announcements">
                                    </a>

                                </div>
                                <div id="notification_popup" class="modal popup-modal concise-transaction-popup"
                                    role="dialog" data-title="" aria-label="Popup Modal" aria-hidden="false">
                                    <div class="modal-dialog">
                                        <div class="modal-content"
                                            style="--desktop-popup-alert-src: url(//d33egg70nrp50s.cloudfront.net/Images/v-zelma-v2-beta/dark-brown/desktop/layout/popup/alert.png?v=20240708-4); --desktop-popup-notification-src: url(//d33egg70nrp50s.cloudfront.net/Images/v-zelma-v2-beta/dark-brown/desktop/layout/popup/notification.png?v=20240708-4); --mobile-popup-alert-src: url(//d33egg70nrp50s.cloudfront.net/Images/v-zelma-v2-beta/dark-brown/mobile/layout/popup/alert.png?v=20240708-4); --mobile-popup-notification-src: url(//d33egg70nrp50s.cloudfront.net/Images/v-zelma-v2-beta/dark-brown/mobile/layout/popup/notification.png?v=20240708-4); --event-giveaway-popper-src: url(//d33egg70nrp50s.cloudfront.net/Images/v-zelma-v2-beta/dark-brown/images/giveaway/popper.png?v=20240708-4);">
                                            <div class="modal-header">
                                                <button type="button" class="close" aria-label="Close">
                                                    <span aria-hidden="true">×</span>
                                                </button>
                                                <h4 class="modal-title" id="popup_modal_title">Notifikasi</h4>
                                            </div>
                                            <div class="modal-body" id="popup_modal_body">
                                                <div class="notification-popup-body" id="notification_popup_body">
                                                    <h1 class="notification-popup-title">Notifikasi</h1>

                                                    <div class="notification-tabs">
                                                        <div class="notification-tab-item" data-tab="transaction"
                                                            data-active="true" data-count="1">
                                                            Transaksi <span id="announcement_count">(0)</span>
                                                        </div>
                                                        <div class="notification-tab-item" data-tab="promo"
                                                            data-active="false" data-count="0">
                                                            Promo <span>(0)</span>
                                                        </div>
                                                        <div class="notification-tab-item" data-tab="info"
                                                            data-active="false" data-count="0">
                                                            Info <span>(0)</span>
                                                        </div>
                                                    </div>
                                                    <div class="notification-content">
                                                        <div class="notification-list" id="notification_list">
                                                            <div class="notif-loading">Memuat notifikasi...</div>
                                                            <input id="request_verification_token" type="hidden"
                                                                value="k7bXnOXjNeISS20SF7R-iiR56yXxEZwSDkjMw0kRPnWZF6jeVajxWeYoUlz8s72vhHeeLIektFk56dSoD-aFPYME0va--xn1NGql4mwRuL01">
                                                        </div>
                                                        <div class="empty-notification-container"
                                                            id="empty_notification_container" style="display: none;">
                                                            <div class="empty-notification-image">
                                                                <picture>
                                                                    <source
                                                                        srcset="//d33egg70nrp50s.cloudfront.net/Images/announcement/empty.webp?v=20240708-4"
                                                                        type="image/webp">
                                                                    <source
                                                                        srcset="//d33egg70nrp50s.cloudfront.net/Images/announcement/empty.png?v=20240708-4"
                                                                        type="image/png"><img loading="lazy"
                                                                        src="//d33egg70nrp50s.cloudfront.net/Images/announcement/empty.png?v=20240708-4">
                                                                </picture>
                                                            </div>
                                                            <div class="empty-notification-content">
                                                                <h3>Belum Ada Notifikasi</h3>
                                                                <p>Saat Anda mendapatkan notifikasi, mereka akan muncul
                                                                    di sini</p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="notification-footer">
                                                        <a href="#" id="read_all_announcements_button">Tandai
                                                            Semua Dibaca</a>
                                                        <a href="/message" id="view_more_button">Lihat
                                                            Selengkapnya</a>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-primary" data-dismiss="modal"
                                                    id="popup_modal_dismiss_button">OK</button>
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal"
                                                    id="popup_modal_cancel_button"
                                                    style="display: none">Batal</button>
                                                <button type="button" class="btn btn-primary"
                                                    id="popup_modal_confirm_button" style="display: none">OK</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.4/moment.min.js"></script>
                                <script>
                                    document.getElementById('unread_announcements').addEventListener('click', function(event) {
                                        event.preventDefault();
                                        document.getElementById('notification_popup').style.display = 'block';
                                    });


                                    document.querySelector('.close').addEventListener('click', function() {
                                        document.getElementById('notification_popup').style.display = 'none';
                                    });

                                    document.getElementById('popup_modal_dismiss_button').addEventListener('click', function() {
                                        document.getElementById('notification_popup').style.display = 'none';
                                    });

                                    function generateRandomTicketNumber() {
                                        const characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
                                        let ticketNumber = '';
                                        for (let i = 0; i < 6; i++) {
                                            const randomIndex = Math.floor(Math.random() * characters.length);
                                            ticketNumber += characters[randomIndex];
                                        }
                                        return ticketNumber;
                                    }

                                    function updateAnnouncementCount() {
                                        $.ajax({
                                            url: '/getUnreadTransactionsCount',
                                            type: 'GET',
                                            dataType: 'json',
                                            success: function(response) {
                                                var unreadCount = response.unreadCount || 0;
                                                $('#unread_announcements').attr('data-announcement-count', unreadCount);
                                                $('#announcement_count').text('(' + unreadCount + ')');
                                                $('#incoming-message').text('[' + unreadCount + ']');
                                                $('#transaksi-masuk').text('[' + unreadCount + ']');
                                            },
                                            error: function(xhr, status, error) {
                                                console.error('Error fetching unread transactions count:', error);
                                            }
                                        });

                                        $.ajax({
                                            url: '/getAllTransaksi',
                                            type: 'GET',
                                             dataType: 'json',
                                             success: function(response) {
                                                 var $notificationList = $('#notification_list');
                                                 $notificationList.empty();

                                                 if (!response || !response.length) {
                                                     $('#empty_notification_container').show();
                                                 } else {
                                                     $('#empty_notification_container').hide();
                                                     response.forEach(function(tx) {
                                                         var date = new Date(tx.created_at);
                                                         var timeAgo = moment(date).fromNow();
                                                         var amount = new Intl.NumberFormat('id-ID').format(tx.amount || 0);

                                                         var typeLabel = parseInt(tx.type) === 1 ? 'Deposit' : 'Withdraw';
                                                         var typeIcon = parseInt(tx.type) === 1 ? 'deposit' : 'withdraw';

                                                         var statusClass, statusLabel, statusIcon;
                                                         switch (tx.status_id) {
                                                             case 1: statusClass='pending'; statusLabel='Menunggu'; statusIcon='⏳'; break;
                                                             case 2: statusClass='approved'; statusLabel='Disetujui'; statusIcon='✓'; break;
                                                             case 3: statusClass='rejected'; statusLabel='Ditolak'; statusIcon='✕'; break;
                                                             default: statusClass='unknown'; statusLabel='-'; statusIcon='?'; break;
                                                         }

                                                         var isUnread = tx.notes !== 'read';
                                                         var seenAttr = isUnread ? 'false' : 'true';
                                                         var unreadClass = isUnread ? ' notif-unread' : '';

                                                         var ticket = generateRandomTicketNumber();

                                                         var html = '<a href="/message" class="notif-link">' +
                                                             '<div class="notif-card' + unreadClass + '" data-seen="' + seenAttr + '" data-rec-id="' + tx.id + '">' +
                                                                 '<div class="notif-icon ' + typeIcon + '">' +
                                                                     '<svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">' +
                                                                         (parseInt(tx.type) === 1
                                                                             ? '<polyline points="23 6 13.5 15.5 8.5 10.5 1 18"/><polyline points="17 6 23 6 23 12"/>'
                                                                             : '<polyline points="17 1 21 5 17 9"/><path d="M3 11V9a4 4 0 0 1 4-4h14"/><path d="M7 21H3v-4"/><path d="M21 13v2a4 4 0 0 1-4 4H3"/>') +
                                                                     '</svg>' +
                                                                 '</div>' +
                                                                 '<div class="notif-body">' +
                                                                     '<div class="notif-top">' +
                                                                         '<span class="notif-type">' + typeLabel + '</span>' +
                                                                         '<span class="notif-badge ' + statusClass + '">' + statusIcon + ' ' + statusLabel + '</span>' +
                                                                     '</div>' +
                                                                     '<div class="notif-amount">Rp ' + amount + '</div>' +
                                                                     '<div class="notif-time">' + timeAgo + ' &middot; Tiket #' + ticket + '</div>' +
                                                                 '</div>' +
                                                             '</div></a>';
                                                         $notificationList.append(html);
                                                     });
                                                 }
                                             },
                                            error: function(xhr, status, error) {
                                                console.error('Error fetching notifications:', error);
                                            }
                                        });
                                    }

                                    $(document).ready(function() {
                                        updateAnnouncementCount();

                                        $('.notification-tab-item').on('click', function() {
                                            $('.notification-tab-item').attr('data-active', 'false');
                                            $(this).attr('data-active', 'true');

                                            var tab = $(this).data('tab');
                                            if (tab === 'transaction') {
                                                updateAnnouncementCount();
                                            } else {
                                                $('#notification_list').html('<div class="notif-loading">Belum ada notifikasi</div>');
                                            }
                                        });
                                    });
                                </script>
                                <script>
                                    $(document).ready(function() {
                                        updateAnnouncementCount();

                                        $('#read_all_announcements_button').on('click', function() {
                                            $.ajax({
                                                url: '/markAllTransactionsAsRead',
                                                type: 'POST',
                                                dataType: 'json',
                                                data: {
                                                    _token: '{{ csrf_token() }}'
                                                },
                                                success: function(response) {
                                                    updateAnnouncementCount();
                                                },
                                                error: function(xhr, status, error) {
                                                    console.error('Error marking transactions as read:', error);
                                                }
                                            });
                                        });
                                    });
                                </script>
                                <style>
                                    #notification_popup .modal-content { background: #111827; border: none; border-radius: 18px; overflow: hidden; }
                                    #notification_popup .modal-header { border-bottom: none; padding: 22px 28px 0; }
                                    #notification_popup .modal-title { color: #f1f5f9; font-size: 18px; font-weight: 700; }
                                    #notification_popup .modal-header .close { color: #475569; opacity: .6; text-shadow: none; font-size: 22px; margin-top: -2px; }
                                    #notification_popup .modal-header .close:hover { color: #f1f5f9; opacity: 1; }
                                    #notification_popup .modal-body { padding: 0; background: #111827; }
                                    #notification_popup .modal-footer { border-top: none; padding: 16px 28px 22px; background: #111827; }
                                    #notification_popup_body { padding: 0; background: #111827; }
                                    .notification-popup-title { display: none; }
                                    .notification-tabs {
                                        display: flex; gap: 2px; background: transparent;
                                    }
                                    .notification-tab-item {
                                        padding: 8px 18px; font-size: 13px; font-weight: 500; cursor: pointer;
                                        color: #64748b; border-radius: 8px; transition: all .15s; margin-right: 2px;
                                    }
                                    .notification-tab-item[data-active="true"] { color: #e2e8f0; background: #1e293b; }
                                    .notification-tab-item:hover:not([data-active="true"]) { color: #cbd5e1; background: rgba(255,255,255,.04); }
                                    .notification-tab-item span { font-size: 11px; margin-left: 4px; }
                                    .notification-tab-item[data-active="true"] span { color: #ef4444; font-weight: 700; }
                                    .notification-content { border-radius: 14px; overflow: hidden; padding-bottom: 8px; }
                                    .notification-footer {
                                        display: flex; justify-content: space-between; padding: 12px 28px 20px;
                                        background: #111827;
                                    }
                                    .notification-footer a { font-size: 13px; color: #e2e8f0; text-decoration: none; font-weight: 500; }
                                    .notification-footer a:hover { color: #fff; opacity: .8; }
                                    .empty-notification-container { text-align: center; padding: 52px 20px; background: #1e293b; }
                                    .empty-notification-container h3 { color: #cbd5e1; font-size: 15px; font-weight: 600; margin-top: 16px; }
                                    .empty-notification-container p { color: #64748b; font-size: 13px; }
                                    #notification_list { max-height: 420px; overflow-y: auto; padding: 0; margin-top: 0; background: #1e293b; }
                                    .notif-loading { text-align: center; padding: 44px 16px; color: #475569; font-size: 13px; }
                                    .notif-link { text-decoration: none !important; display: block; padding: 0 16px; }
                                    .notif-link:first-child .notif-card { padding-top: 18px; }
                                    .notif-link:last-child .notif-card { border-bottom: none; padding-bottom: 10px; }
                                    .notif-card {
                                        display: flex; align-items: flex-start; gap: 14px;
                                        padding: 12px 0; border-bottom: 1px solid rgba(255,255,255,.04);
                                        transition: all .2s ease; position: relative;
                                    }
                                    .notif-link:hover .notif-card .notif-amount { color: #a5b4fc; }
                                    .notif-card.notif-unread { background: transparent; }
                                    .notif-icon {
                                        flex-shrink: 0; width: 40px; height: 40px; border-radius: 12px;
                                        display: flex; align-items: center; justify-content: center; margin-top: 1px;
                                        font-size: 18px;
                                    }
                                    .notif-icon.deposit { background: rgba(34,197,94,.1); color: #22c55e; }
                                    .notif-icon.withdraw { background: rgba(234,179,8,.1); color: #eab308; }
                                    .notif-body { flex: 1; min-width: 0; }
                                    .notif-top { display: flex; align-items: center; justify-content: space-between; margin-bottom: 5px; }
                                    .notif-type { font-size: 14px; font-weight: 600; color: #e2e8f0; }
                                    .notif-badge {
                                        font-size: 11px; font-weight: 500; padding: 3px 10px; border-radius: 6px;
                                        white-space: nowrap; letter-spacing: .2px;
                                    }
                                    .notif-badge.pending { background: rgba(234,179,8,.12); color: #eab308; }
                                    .notif-badge.approved { background: rgba(34,197,94,.12); color: #22c55e; }
                                    .notif-badge.rejected { background: rgba(239,68,68,.12); color: #ef4444; }
                                    .notif-badge.unknown { background: rgba(100,116,139,.1); color: #94a3b8; }
                                    .notif-amount { font-size: 13px; font-weight: 500; color: #94a3b8; transition: color .2s; }
                                    .notif-time { font-size: 12px; color: #475569; margin-top: 2px; }
                                    .notif-card.notif-unread .notif-type { font-weight: 700; }
                                    .notif-card.notif-unread .notif-amount { color: #cbd5e1; }
                                    .notif-card.notif-unread:before {
                                        content: ''; position: absolute; left: -16px; top: 12px; bottom: 12px;
                                        width: 3px; border-radius: 0 3px 3px 0; background: #6366f1;
                                    }
                                    #popup_modal_dismiss_button {
                                        background: #1e293b !important; border: 1px solid rgba(255,255,255,.06) !important;
                                        border-radius: 10px !important; padding: 8px 32px !important;
                                        font-weight: 500 !important; font-size: 14px !important; color: #cbd5e1 !important;
                                        transition: all .15s !important;
                                    }
                                    #popup_modal_dismiss_button:hover { background: #334155 !important; color: #f1f5f9 !important; }
                                </style>
                                <div class="user-info-item">
                                    <a href="#"
                                        onclick="window.closeWindows(); document.querySelector('#logout-form').submit()">
                                        <form action="/logout" id="logout-form" method="post">
                                            @csrf
                                            <picture>
                                                <source
                                                    srcset="//d33egg70nrp50s.cloudfront.net/Images/v-zelma-v2-beta/dark-brown/desktop/layout/logout.webp?v=20240708-4"
                                                    type="image/webp">
                                                <source
                                                    srcset="//d33egg70nrp50s.cloudfront.net/Images/v-zelma-v2-beta/dark-brown/desktop/layout/logout.png?v=20240708-4"
                                                    type="image/png"><img loading="lazy"
                                                    src="//d33egg70nrp50s.cloudfront.net/Images/v-zelma-v2-beta/dark-brown/desktop/layout/logout.png?v=20240708-4">
                                            </picture>
                                        </form>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @include('layout.desktop.site-header')
    </div>
@else
    <div class="navbar navbar-fixed-top">
        <div class="topbar-container">
            <div class="container">
                <div class="row">
                    <div class="col-sm-12 topbar-inner-container">
                        <a href="/" class="logo">
                            <picture>
                        <img alt="Logo"
                            loading="lazy"
                            src="{{ storageUrl($setting->logo) }}"
                            style="transform:translateY(-8px);">
                    </picture>
                        </a>
                        <div class="topbar-inner-group">
                            <div class="topbar-sub-section">
                                <div class="topbar-item language-selector-container"
                                    style="--image-src: url(https://d33egg70nrp50s.cloudfront.net/Images/v-zelma-v2-beta/dark-brown/desktop/layout/flags.png?v=20240708-4);">
                                    <div id="language_selector_trigger" data-toggle="dropdown"
                                        class="language-selector-trigger" data-language="id">
                                        <i data-language="id"></i>
                                        BHS INDONESIA
                                    </div>
                                    <ul class="dropdown-menu language-selector">
                                        <li class="language_selector" data-language="en">
                                            <i data-language="en"></i>
                                            <div class="language-name">
                                                <div>ENGLISH</div>
                                                <div>ENGLISH</div>
                                            </div>
                                        </li>
                                        <li class="language_selector" data-language="id">
                                            <i data-language="id"></i>
                                            <div class="language-name">
                                                <div>BHS INDONESIA</div>
                                                <div>INDONESIAN</div>
                                            </div>
                                        </li>
                                        <li class="language_selector" data-language="kr">
                                            <i data-language="kr"></i>
                                            <div class="language-name">
                                                <div>한국어</div>
                                                <div>KOREAN</div>
                                            </div>
                                        </li>
                                        <li class="language_selector" data-language="cn">
                                            <i data-language="cn"></i>
                                            <div class="language-name">
                                                <div>中文</div>
                                                <div>CHINESE</div>
                                            </div>
                                        </li>
                                        <li class="language_selector" data-language="jp">
                                            <i data-language="jp"></i>
                                            <div class="language-name">
                                                <div>日本語</div>
                                                <div>JAPANESE</div>
                                            </div>
                                        </li>
                                        <li class="language_selector" data-language="th">
                                            <i data-language="th"></i>
                                            <div class="language-name">
                                                <div>ไทย</div>
                                                <div>THAI</div>
                                            </div>
                                        </li>
                                        <li class="language_selector" data-language="my">
                                            <i data-language="my"></i>
                                            <div class="language-name">
                                                <div>မြန်မာစာ</div>
                                                <div>BURMESE</div>
                                            </div>
                                        </li>
                                        <li class="language_selector" data-language="kh">
                                            <i data-language="kh"></i>
                                            <div class="language-name">
                                                <div>ខេមរភាសា</div>
                                                <div>KHMER</div>
                                            </div>
                                        </li>
                                        <li class="language_selector" data-language="hi">
                                            <i data-language="hi"></i>
                                            <div class="language-name">
                                                <div>हिन्दी</div>
                                                <div>HINDI</div>
                                            </div>
                                        </li>
                                        <li class="language_selector" data-language="ta">
                                            <i data-language="ta"></i>
                                            <div class="language-name">
                                                <div>தமிழ்</div>
                                                <div>TAMIL</div>
                                            </div>
                                        </li>
                                        <li class="language_selector" data-language="te">
                                            <i data-language="te"></i>
                                            <div class="language-name">
                                                <div>తెలుగు</div>
                                                <div>TELUGU</div>
                                            </div>
                                        </li>
                                        <li class="language_selector" data-language="vi">
                                            <i data-language="vi"></i>
                                            <div class="language-name">
                                                <div>Tiếng Việt</div>
                                                <div>VIETNAMESE</div>
                                            </div>
                                        </li>
                                        <li class="language_selector" data-language="bn">
                                            <i data-language="bn"></i>
                                            <div class="language-name">
                                                <div>বাংলাদেশী</div>
                                                <div>BENGALI</div>
                                            </div>
                                        </li>
                                        <li class="language_selector" data-language="pt">
                                            <i data-language="pt"></i>
                                            <div class="language-name">
                                                <div>Portugu&#234;s</div>
                                                <div>PORTUGESE</div>
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                                <div class="topbar-item">
                                    <a href="{{ $setting->livechat }}">
                                        <span class="js_live_chat_link live-chat">
                                            <i data-icon="live-chat"
                                                style="--image-src: url(https://d33egg70nrp50s.cloudfront.net/Images/v-zelma-v2-beta/dark-brown/desktop/layout/live-chat.svg?v=20240708-4);"></i>
                                            Live Chat
                                        </span>
                                    </a>
                                </div>
                                <div class="topbar-item">
                                    <a href="/versi-mobile" rel="nofollow">
                                        <i data-icon="mobile"
                                            style="--image-src: url(https://d33egg70nrp50s.cloudfront.net/Images/v-zelma-v2-beta/dark-brown/desktop/layout/mobile.svg?v=20240708-4);"></i>
                                        Versi Mobile
                                    </a>
                                </div>
                            </div>


                            <div class="login-panel">
                                <div class="login-panel-item">
                                    <a href="#" class="login-button" data-toggle="modal" data-target="#login_modal">
                                        Masuk
                                    </a>
                                </div>
                                <div class="login-panel-item">
                                    <a href="#" class="register-button" data-toggle="modal"
                                        data-target="#register_modal">
                                        Daftar
                                    </a>
                                </div>
                                <a href="/lupa-sandi" class="forgot-password-link" data-toggle="modal"
                                    data-target="#forgot_password_modal">
                                        Lupa Kata Sandi
                                    </a>
                                </div>
                            </form>

                            <script>
                                window.addEventListener('DOMContentLoaded', () => {
                                    const passwordInputTrigger = document.querySelector(
                                        '#password_toggle');
                                    const passwordInput = document.querySelector('#password_input');

                                    passwordInputTrigger.onclick = () => {
                                        if (passwordInput.type === 'password') {
                                            passwordInput.type = 'text';
                                            passwordInputTrigger.classList.remove('fa-eye-slash');
                                            passwordInputTrigger.classList.add('fa-eye');
                                        } else {
                                            passwordInput.type = 'password';
                                            passwordInputTrigger.classList.remove('fa-eye');
                                            passwordInputTrigger.classList.add('fa-eye-slash');
                                        }
                                    };
                                });
                            </script>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @include('layout.desktop.site-header')
    </div>
@endif
<script>
$(function() {
    function refreshBalance() {
        $.get('/balance', function(res) {
            var fmt = function(n) { return 'Rp ' + Number(n || 0).toLocaleString('id-ID'); };
            if (res.main != null) {
                $('#nav_main_balance').text(fmt(res.main));
                $('#nav_main_balance_header').text(fmt(res.main));
                $('#nav_wallet_main').text(fmt(res.main));
            }
            if (res.slot != null) $('#nav_wallet_slot').text(fmt(res.slot));
            if (res.game != null) $('#nav_wallet_game').text(fmt(res.game));
        });
    }
    refreshBalance();
    setInterval(refreshBalance, 5000);
});
</script>
