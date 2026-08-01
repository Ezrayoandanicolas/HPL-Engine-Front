<style>
    .wallet-dropdown-menu{
    width:320px;
    padding:15px;
    border-radius:12px;
    background:#232323;
}

.wallet-row{
    display:flex;
    justify-content:space-between;
    align-items:center;
    padding:10px 0;
    border-bottom:1px solid rgba(255,255,255,.08);
    color:#fff;
}

.wallet-row:last-child{
    border-bottom:none;
}

.wallet-row strong{
    font-size:15px;
}
</style>
<link rel="stylesheet" href="../../../assets/css/desktop/message.css">
<header class="site-header">
    <a href="/" class="logo">
       <picture>
    <img alt="Logo"
         loading="lazy"
         src="{{ storageUrl($setting->logo) }}"
         style="transform:translateY(-8px);">
</picture>
    </a>

    <div class="header-info">
        <div class="user-balance">
            <button title="Refresh" class="refresh_balance" data-loading="true">
                <i data-icon="refresh"
                    style="--image-src: url(//d33egg70nrp50s.cloudfront.net/Images/v-zelma-v2-beta/dark-brown/desktop/layout/refresh-v2.svg?v=20240708-4);"></i>
            </button>
            <span class="balance">
                <a href="#" data-toggle="dropdown">
                    IDR
                    <span class="balance total_balance" id="mob_nav_main">{{ auth()->check() ? number_format((auth()->user()->saldo ?? 0),0,',','.') : 0 }}</span>
                    <span class="locked-balance locked_balance_container" hidden="">
                        <i class="glyphicon glyphicon-lock"></i>
                       <span class="balance total_balance" id="mob_nav_main_locked">{{ auth()->check() ? number_format((auth()->user()->saldo ?? 0),0,',','.') : 0 }}</span>
                    </span>
                </a>
                <div class="dropdown-menu vendor-balances-container wallet-dropdown-menu">

    <div class="vendor-balances-header">

        <h5 class="mb-2">
            💳 SALDO WALLET
        </h5>

        <div class="balance total_balance" id="mob_main_header">
            Rp {{ number_format($mainBalance,0,',','.') }}
        </div>

    </div>

    <div class="vendor-balances-content">

        <div class="wallet-row">
            <span>💳 Main Wallet</span>
            <strong class="text-success" id="mob_wallet_main">
                Rp {{ number_format($mainBalance,0,',','.') }}
            </strong>
        </div>

        <div class="wallet-row">
            <span>🎰 Slot Wallet</span>
            <strong class="text-warning" id="mob_wallet_slot">
                Rp {{ number_format($slotBalance,0,',','.') }}
            </strong>
        </div>

        <div class="wallet-row">
            <span>🎮 Game Wallet</span>
            <strong class="text-info" id="mob_wallet_game">
                Rp {{ number_format($gameBalance,0,',','.') }}
            </strong>
        </div>

        <hr>

        <a href="{{ route('transfer') }}"
           class="btn btn-success btn-block">

            🔄 Transfer Wallet

        </a>

    </div>

</div>
            </span>
        </div>
        <div class="unread-announcements-button" data-announcement-count="0" id="mobile_unread_announcements">
            <a href="/message">
                <img loading="lazy"
                    src="//d33egg70nrp50s.cloudfront.net/Images/v-zelma-v2-beta/dark-brown/desktop/layout/bell.svg?v=20240708-4">
            </a>
        </div>
    </div>

    <label class="site-menu-trigger" for="site_menu_trigger_input" data-new-notification="false">
        <i data-icon="menu"></i>
    </label>
</header>
<div id="mobile_notification_popup" class="modal popup-modal concise-transaction-popup" role="dialog"
    data-title="" aria-label="Popup Modal" aria-hidden="false">
    <div class="modal-dialog">
        <div class="modal-content"
            style="--desktop-popup-alert-src: url(//d33egg70nrp50s.cloudfront.net/Images/v-zelma-v2-beta/dark-brown/desktop/layout/popup/notification.png?v=20240708-4); --desktop-popup-notification-src: url(//d33egg70nrp50s.cloudfront.net/Images/v-zelma-v2-beta/dark-brown/mobile/layout/popup/notification.png?v=20240708-4); --mobile-popup-alert-src: url(//d33egg70nrp50s.cloudfront.net/Images/v-zelma-v2-beta/dark-brown/mobile/layout/popup/alert.png?v=20240708-4); --mobile-popup-notification-src: url(//d33egg70nrp50s.cloudfront.net/Images/v-zelma-v2-beta/dark-brown/mobile/layout/popup/notification.png?v=20240708-4); --event-giveaway-popper-src: url(//d33egg70nrp50s.cloudfront.net/Images/giveaway/popper.png?v=20240708-4);">
            <div class="modal-header">
                <button type="button" class="close" aria-label="Close" id="mobile_modal_close_button">
                    <span aria-hidden="true">×</span>
                </button>
                <h4 class="modal-title" id="mobile_popup_modal_title">Notifikasi</h4>
            </div>
            <div class="modal-body" id="mobile_popup_modal_body">
                <div class="notification-popup-body" id="mobile_notification_popup_body"
                    style="background-color: #0c0b0b">
                    <h1 class="notification-popup-title">Notifikasi</h1>

                    <div class="notification-tabs">
                        <div class="notification-tab-item" data-tab="transaction" data-active="true" data-count="1">
                            Transaksi <span id="mobile_announcement_count">(0)</span>
                        </div>
                        <div class="notification-tab-item" data-tab="promo" data-active="false" data-count="0">
                            Promo <span>(0)</span>
                        </div>
                        <div class="notification-tab-item" data-tab="info" data-active="false" data-count="0">
                            Info <span>(0)</span>
                        </div>
                    </div>
                    <div class="notification-content">
                        <div class="notification-list" id="mobile_notification_list">
                            <!-- Daftar notifikasi akan diisi oleh JavaScript -->
                            <input id="mobile_request_verification_token" type="hidden"
                                value="k7bXnOXjNeISS20SF7R-iiR56yXxEZwSDkjMw0kRPnWZF6jeVajxWeYoUlz8s72vhHeeLIektFk56dSoD-aFPYME0va--xn1NGql4mwRuL01">
                        </div>
                        <div class="empty-notification-container" id="mobile_empty_notification_container"
                            style="display: none;">
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
                    <div class="notification-footer" style="background-color: #0c0b0b">
                        <a href="#" id="mobile_read_all_announcements_button">Tandai
                            Semua Dibaca</a>
                        <a href="/message" id="mobile_view_more_button">Lihat Selengkapnya</a>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" data-dismiss="modal"
                    id="mobile_popup_modal_dismiss_button">OK</button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal"
                    id="mobile_popup_modal_cancel_button" style="display: none">Batal</button>
                <button type="button" class="btn btn-primary" id="mobile_popup_modal_confirm_button"
                    style="display: none">OK</button>
            </div>
        </div>
    </div>
</div>

<script>
    // Penanganan klik untuk membuka modal notifikasi
    document.getElementById('mobile_unread_announcements').addEventListener('click', function(event) {
        event.preventDefault();
        document.getElementById('mobile_notification_popup').style.display = 'block';
    });

    // Penanganan klik untuk menutup modal notifikasi
    document.getElementById('mobile_modal_close_button').addEventListener('click', function() {
        document.getElementById('mobile_notification_popup').style.display = 'none';
    });

    document.getElementById('mobile_popup_modal_dismiss_button').addEventListener('click', function() {
        document.getElementById('mobile_notification_popup').style.display = 'none';
    });

    // Fungsi untuk menghasilkan nomor tiket acak
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
                $('#mobile_unread_announcements').attr('data-announcement-count', unreadCount);
                $('#mobile_announcement_count').text('(' + unreadCount + ')');
                $('#transaction_in').text('(' + unreadCount + ')');
                $('a[data-target="#announcement-container"]').attr('data-count', unreadCount);
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
                var $notificationList = $('#mobile_notification_list');
                $notificationList.empty();

                response.forEach(function(deposit) {
                    var formattedDate = new Date(deposit.created_at).toLocaleString();
                    var ticketNumber = generateRandomTicketNumber();

                    var statusText = '';
                    var statusMessage = '';
                    switch (deposit.status_id) {
                        case 1:
                            statusText = 'Menunggu';
                            statusMessage = 'NEW';
                            break;
                        case 2:
                            statusText = 'Disetujui';
                            statusMessage = 'ACC';
                            break;
                        case 3:
                            statusText = 'Ditolak';
                            statusMessage = 'REJ';
                            break;
                        default:
                            statusText = 'Tidak Diketahui';
                            statusMessage = 'UNKNOWN';
                    }

                    var displayView = deposit.notes === 'read' ? 'true' : 'false';
                    var typeText = deposit.type === '1' ? 'Deposit' : 'Withdraw';

                    var notificationHtml = `
                    <a href="/message" style="display: block;">
                        <div class="notification-item" data-seen="${displayView}" data-notification-type="${deposit.type}" data-rec-id="${deposit.id}" data-message-sub-category="Deposit">
                            <div class="notification-image" data-message-category="Transaction" data-message-subcategory="Deposit" data-transaction-status="${statusMessage}">
                                <img loading="lazy" src="//d33egg70nrp50s.cloudfront.net/Images/announcement/Deposit.svg?v=20240708-4">
                            </div>
                            <div class="notification-content">
                                <div class="notification-header">
                                    <span>${typeText}</span>
                                    <span>${formattedDate}</span>
                                </div>
                                <h3 class="notification-title">${typeText} : ${statusText}</h3>
                                <p>Permintaan deposit IDR ${deposit.amount} anda telah ${statusText}. Nomor Tiket : ${ticketNumber}</p>
                            </div>
                        </div>
                    </a>`;

                    $notificationList.append(notificationHtml);
                });

                if (response.length === 0) {
                    $('#mobile_empty_notification_container').show();
                } else {
                    $('#mobile_empty_notification_container').hide();
                }
            },
            error: function(xhr, status, error) {
                console.error('Error fetching transactions:', error);
            }
        });
    }
    $(document).ready(function() {
        updateAnnouncementCount();

        function loadPromoTab() {
            var $list = $('#mobile_notification_list');
            $list.empty();
            $list.append('<div class="notification-item" style="text-align:center;padding:20px;"><p>Memuat promo...</p></div>');
            $.get('/promotion-list', function(response) {
                $list.empty();
                var items = Array.isArray(response) ? response : (response.data || []);
                if (!items.length) {
                    $('#mobile_empty_notification_container').show();
                    return;
                }
                $('#mobile_empty_notification_container').hide();
                items.forEach(function(p) {
                    var title = p.title || 'Promo';
                    var bonus = p.bonus;
                    var date = new Date(p.created_at).toLocaleString();
                    var message = bonus ? 'Anda berhasil klaim promo ' + title + ' dengan bonus ' + bonus : 'Anda berhasil klaim promo ' + title;
                    var html = '<div class="notification-item" data-notification-type="promo">' +
                        '<div class="notification-image" data-message-category="Promo">' +
                        '<img loading="lazy" src="//d33egg70nrp50s.cloudfront.net/Images/announcement/Promotion.svg?v=20240708-4">' +
                        '</div>' +
                        '<div class="notification-content">' +
                        '<div class="notification-header"><span>Promo</span><span>' + date + '</span></div>' +
                        '<h3 class="notification-title">' + title + '</h3>' +
                        '<p>' + message + '</p></div></div>';
                    $list.append(html);
                });
            }).fail(function() {
                $list.empty();
                $('#mobile_empty_notification_container').show();
            });
        }

        function loadInfoTab() {
            var $list = $('#mobile_notification_list');
            $list.empty();
            $list.append('<div class="notification-item" style="text-align:center;padding:20px;"><p>Memuat pesan...</p></div>');
            $.get('/message-list', function(response) {
                $list.empty();
                var items = Array.isArray(response) ? response : (response.data || []);
                if (!items.length) {
                    $('#mobile_empty_notification_container').show();
                    return;
                }
                $('#mobile_empty_notification_container').hide();
                items.forEach(function(m) {
                    var title = m.title || 'Informasi';
                    var body = m.body || '';
                    var html = '<div class="notification-item" data-notification-type="info">' +
                        '<div class="notification-content"><div class="notification-header"><span>Info</span></div>' +
                        '<h3 class="notification-title">' + title + '</h3>' +
                        '<p class="notification-message">' + body + '</p></div></div>';
                    $list.append(html);
                });
            }).fail(function() {
                $list.empty();
                $('#mobile_empty_notification_container').show();
            });
        }

        $('.notification-tab-item').on('click', function() {
            var tab = $(this).data('tab');
            $('.notification-tab-item').attr('data-active', 'false');
            $(this).attr('data-active', 'true');
            $('#mobile_empty_notification_container').hide();
            if (tab === 'promo') {
                loadPromoTab();
            } else if (tab === 'info') {
                loadInfoTab();
            } else {
                updateAnnouncementCount();
            }
        });
    });
</script>
<script>
$(function() {
    function refreshMobileBalance() {
        $.get('/balance', function(res) {
            var fmt = function(n) { return Number(n || 0).toLocaleString('id-ID'); };
            var fmtRp = function(n) { return 'Rp ' + Number(n || 0).toLocaleString('id-ID'); };
            if (res.main != null) {
                $('#mob_nav_main').text(fmt(res.main));
                $('#mob_nav_main_locked').text(fmt(res.main));
                $('#mob_main_header').text(fmtRp(res.main));
                $('#mob_wallet_main').text(fmtRp(res.main));
            }
            if (res.slot != null) $('#mob_wallet_slot').text(fmtRp(res.slot));
            if (res.game != null) $('#mob_wallet_game').text(fmtRp(res.game));
        });
    }
    refreshMobileBalance();
    setInterval(refreshMobileBalance, 5000);
});
</script>
