<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Cq9Controller;
use App\Http\Controllers\KycController;
use Illuminate\Support\Facades\Artisan;
use App\Http\Controllers\BankController;
use App\Http\Controllers\FileController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PlayController;
use App\Http\Controllers\SlotController;
use App\Http\Controllers\BonusController;
use App\Http\Controllers\JokerController;
use App\Http\Controllers\AdminLoginController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\PokerController;
use App\Http\Controllers\ArcadeController;
use App\Http\Controllers\BannerController;
use App\Http\Controllers\BoongoController;
use App\Http\Controllers\CasinoController;
use App\Http\Controllers\InjectController;
use App\Http\Controllers\PgsoftController;
use App\Http\Controllers\TambahController;
use App\Http\Controllers\DepositController;
use App\Http\Controllers\GenesisController;
use App\Http\Controllers\LaporanController;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\PlayngoController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\HabaneroController;
use App\Http\Controllers\LanguageController;
use App\Http\Controllers\PasswordController;
use App\Http\Controllers\PlaystarController;
use App\Http\Controllers\RefferalController;
use App\Http\Controllers\RekeningController;
use App\Http\Controllers\ToptrendController;
use App\Http\Controllers\TurnoverController;
use App\Http\Controllers\WithdrawController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DreamtechController;
use App\Http\Controllers\HacksawController;
use App\Http\Controllers\LoyalitasController;
use App\Http\Controllers\PromotionController;
use App\Http\Controllers\NotificationController;use App\Http\Controllers\AdvantplayController;
use App\Http\Controllers\SettingWebController;
use App\Http\Controllers\SportsController;
use App\Http\Controllers\AdminLogoutController;
use App\Http\Controllers\HistoryPlayController;
use App\Http\Controllers\MicrogamingController;
use App\Http\Controllers\RegisterasiController;
use App\Http\Controllers\SpadegamingController;
use App\Http\Controllers\AdminProfileController;
use App\Http\Controllers\DashboardUserController;
use App\Http\Controllers\PragmaticplayController;
use App\Http\Controllers\DashboardWarnaController;
use App\Http\Controllers\HistoryDepositController;
use App\Http\Controllers\DashboardKurangController;
use App\Http\Controllers\DashboardStatusController;
use App\Http\Controllers\DashboardSettingController;
use App\Http\Controllers\DashboardVoucherController;
use App\Http\Controllers\HistoryTransaksiController;
use App\Http\Controllers\DashboardDepositeController;
use App\Http\Controllers\DashboardPasswordController;
use App\Http\Controllers\DashboardWithdrawController;
use App\Http\Controllers\DashboardPromotionController;
use App\Http\Controllers\EvoplayController;
use App\Http\Controllers\SportsPlayController;
use App\Http\Controllers\SyncController;
use App\Http\Controllers\WalletController;
use App\Http\Controllers\TransferController;
use App\Http\Controllers\CasinoPlayController;
use App\Http\Controllers\SlotsController;
use App\Http\Controllers\DashboardLiveChatController;
use App\Http\Controllers\ChatSseController;
use App\Http\Controllers\DashboardNavigationMenuController;
use App\Http\Controllers\DashboardFiverController;
use App\Http\Controllers\DashboardCallController;
use App\Http\Controllers\DashboardBonusController;
use App\Http\Controllers\DashboardStatisticController;
use App\Http\Controllers\DashboardSportsbookController;
use App\Http\Controllers\DashboardMessageController;
use App\Http\Controllers\DashboardGgrController;
use App\Http\Controllers\DashboardActivityController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

Route::get('/clear-cache', function () {
    $exitCode = Artisan::call('cache:clear');
    $exitCode = Artisan::call('config:cache');
    return 'DONE'; 
});

Route::get('/tarik', [LoyalitasController::class, 'tarik']);

// Chat SSE (served by Nginx/PHP-FPM, multi-threaded)
Route::get('/chat-sse/{token}', [ChatSseController::class, 'sse']);

Route::middleware(['check.web'])->group(function () {

    Route::get('/promotion', [PromotionController::class, 'index']);
    Route::get('/promotion-list', [NotificationController::class, 'promos']);
    Route::get('/message-list', [NotificationController::class, 'messages']);
    Route::post('/ubah-bahasa', [LanguageController::class, 'ubahBahasa'])->name('change.language');
    Route::get('/', [HomeController::class, 'index']);
    Route::get('/home', [HomeController::class, 'index']);
    Route::get('/balance', function () {
        if (!Auth::check()) return response()->json(['main' => 0, 'slot' => 0, 'game' => 0]);
        $api = app(\App\Services\ApiService::class);
        $response = $api->get('wallet/balance', ['user_id' => Auth::id()]);
        return response()->json([
            'main' => (float) ($response['main'] ?? 0),
            'slot' => (float) ($response['slot'] ?? 0),
            'game' => (float) ($response['game'] ?? 0),
        ]);
    });
    Route::get('/login', [LoginController::class, 'index'])->name('login');
    Route::post('/login', [LoginController::class, 'auth']);
    Route::post('/logout', [LoginController::class, 'logout']);
    Route::get('/Admin/Login', [AdminLoginController::class, 'index']);
    Route::post('/Admin/Login', [AdminLoginController::class, 'auth']);
    Route::get('/registerasi', [RegisterasiController::class, 'index']);
    Route::get('/referral-register', [RegisterasiController::class, 'loadReferral']);
    Route::post('/registerasi', [RegisterasiController::class, 'registerasi']);
    Route::post('/forgot-password', [PasswordController::class, 'ubahPassword'])->name('password.update');
    Route::get('/download/{filename}', [FileController::class, 'download'])->name('download');

    Route::get('/casino', [CasinoController::class, 'index'])
    ->name('casino');

    Route::get('/casino/{provider}', [CasinoController::class, 'provider'])
    ->name('casino.provider');
    Route::get('/casino', [CasinoController::class, 'index']);
    Route::get('/sports', [SportsController::class, 'index']);
    Route::get('/arcade', [ArcadeController::class, 'index']);
    Route::get('/poker', [PokerController::class, 'index']);

    Route::get('/slots', [SlotController::class, 'index']);
    Route::get('/slots/pragmatic', [PragmaticplayController::class, 'index']);
    Route::get('/slots/pgsoft', [PgsoftController::class, 'index']);
    Route::get('/slots/habanero', [HabaneroController::class, 'index']);
    Route::get('/slots/spadegaming', [SpadegamingController::class, 'index']);
    Route::get('/slots/genesis', [GenesisController::class, 'index']);
    Route::get('/slots/dreamtech', [DreamtechController::class, 'index']);
    Route::get('/slots/evoplay', [EvoplayController::class, 'index']);
    Route::get('/slots/cq9', [Cq9Controller::class, 'index']);
    Route::get('/slots/booongo', [BoongoController::class, 'index']);
    Route::get('/slots/toptrend', [ToptrendController::class, 'index']);
    Route::get('/slots/joker', [JokerController::class, 'index']);
    Route::get('/slots/playngo', [PlayngoController::class, 'index']);
    Route::get('/slots/hacksaw', [HacksawController::class, 'index']);
    
    Route::get('/slots/{provider}', [SlotsController::class, 'provider'])->where('provider', '[a-z-]+');
    
    Route::get('/faq', function () {
        $api = app(\App\Services\ApiService::class);
        $pageResp = $api->get('page/home');
        $pageData = $pageResp['data'] ?? [];
        $settingData = $pageData['setting'] ?? [];
        $setting = (object) $settingData;
        $balance = $pageData['balance'] ?? null;
        return view('faq', compact('setting', 'balance'));
    });

    Route::get('/versi-mobile', function () {
        $api = app(\App\Services\ApiService::class);
        $pageResp = $api->get('page/home');
        $pageData = $pageResp['data'] ?? [];
        $rawBanner = $pageData['banner'] ?? [];
        $banner = array_map(function ($b) {
            return (object) [
                'id' => $b['id'] ?? null,
                'title' => $b['Judul'] ?? '',
                'img' => $b['img'] ?? '',
                'link' => $b['link'] ?? '',
            ];
        }, $rawBanner);
        $settingData = $pageData['setting'] ?? [];
        $setting = (object) $settingData;
        $balance = $pageData['balance'] ?? null;
        return view('layout.mobile.index', compact('banner', 'setting', 'balance'));
    });

    Route::get('/contact', function () {
        $api = app(\App\Services\ApiService::class);
        $pageResp = $api->get('page/home');
        $pageData = $pageResp['data'] ?? [];
        $settingData = $pageData['setting'] ?? [];
        $setting = (object) $settingData;
        $balance = $pageData['balance'] ?? null;
        return view('layout.mobile.contact', compact('setting', 'balance'));
    });

    Route::middleware(['auth'])->group(function () {

        Route::get('/missions', function () {
            $api = app(\App\Services\ApiService::class);
            $pageResp = $api->get('page/home');
            $pageData = $pageResp['data'] ?? [];
            $settingData = $pageData['setting'] ?? [];
            $setting = (object) $settingData;
            $balance = $pageData['balance'] ?? null;
            return view('layout.mobile.misi', compact('setting', 'balance'));
        });

        Route::get('/penukaran', function () {
            $api = app(\App\Services\ApiService::class);
            $pageResp = $api->get('page/home');
            $pageData = $pageResp['data'] ?? [];
            $settingData = $pageData['setting'] ?? [];
            $setting = (object) $settingData;
            $balance = $pageData['balance'] ?? null;

            $voucherResp = $api->get('admin/vouchers');
            $voucherData = $voucherResp['data']['vouchers'] ?? [];
            $voucher = collect($voucherData);

            return view('layout.mobile.penukaran', compact('setting', 'balance', 'voucher'));
        });

        Route::post('/claim-voucher/{voucherId}', [LoyalitasController::class, 'claimVoucher'])->name('claim.voucher');
        Route::get('/user-badge', [HomeController::class, 'getUserBadge']);
        Route::post('/update-exp-player', [HomeController::class, 'updateExpPlayer']);
        Route::get('/player-progress', [HomeController::class, 'getPlayerProgress']);
        Route::post('/update-reward', [HomeController::class, 'updateReward']);
        
        // Rute PlayController yang sudah dibenahi
        Route::get('/gameplay/{id}/show', [PlayController::class, 'show']);
        Route::get('/sports/play/{game_uid}', [SportsPlayController::class, 'play'])
        ->middleware('auth')
        ->name('sports.play');
        Route::get('/casino/play/{game_uid}', [CasinoPlayController::class, 'play'])
        ->middleware('auth')
        ->name('casino.play');
        
        Route::post('/claim-daily-reward', [HomeController::class, 'claimDailyReward'])->name('claim.daily.reward');
        Route::post('/update-daily-reward', [HomeController::class, 'resetReward']);
        Route::get('/deposit', [DepositController::class, 'index']);
        Route::post('/deposit', [DepositController::class, 'store']);
        Route::get('/history', [HistoryDepositController::class, 'index']);
       
        Route::POST('/transaction/getDepositHistory', [HistoryDepositController::class, 'getDepositHistory']);
        Route::GET('/getTodayDeposit', [HistoryDepositController::class, 'getTodayDeposit']);
        Route::GET('/getAllTransaksi', [HistoryDepositController::class, 'getAllTransaksi']);
        Route::get('/getUnreadTransactionsCount', [HistoryDepositController::class, 'getUnreadTransactionsCount']);
        Route::post('/markAllTransactionsAsRead', [HistoryDepositController::class, 'markAllTransactionsAsRead']);
        Route::get('/withdraw', [WithdrawController::class, 'index']);
        Route::post('/withdraw', [WithdrawController::class, 'store']);
        Route::POST('/transaction/getWithdrawHistory', [WithdrawController::class, 'getWithdrawHistory']);
        Route::GET('/getTodayWithdraw', [WithdrawController::class, 'getTodayWithdraw']);
        Route::get('/bank-member/account', [RekeningController::class, 'index']);
        Route::post('/add-bank', [RekeningController::class, 'store']);
        Route::get('/turnover', [TurnoverController::class, 'turnOver']);
        Route::get('/bonus', [BonusController::class, 'index']);
        Route::get('/history/bonus', [BonusController::class, 'historyKlaim']);
        Route::get('/history/bonuses', [BonusController::class, 'historyKlaims']);
        Route::post('/bonus/{id}/claim', [BonusController::class, 'update'])->name('promotion.claim');
        Route::get('/profile', [ProfileController::class, 'index']);
        Route::get('/ubah/profile', [ProfileController::class, 'ubahProfile']);
        Route::post('/update-profile', [ProfileController::class, 'update']);
        Route::get('/lupa-password', [ProfileController::class, 'changePassword']);
        Route::post('/change-password', [ProfileController::class, 'passwordBerubah']);
        Route::post('/change-password/user', [ProfileController::class, 'passwordHasChange']);
        Route::get('/loyalitas', [LoyalitasController::class, 'index']);
        Route::get('/message', [MessageController::class, 'index']);
        Route::get('/transaksi/{id}', [MessageController::class, 'show']);
        Route::post('/laporan', [LaporanController::class, 'store']);
        Route::get('/refferal', [RefferalController::class, 'index']);
        Route::get('/transfer', [TransferController::class, 'index'])->name('transfer');
        Route::post('/wallet/transfer', [TransferController::class, 'transfer'])->name('wallet.transfer');
        Route::get('/referral/verification', [RefferalController::class, 'reffVerif']);
        Route::post('/referral/submit-verification', [RefferalController::class, 'submitReferralVerification']);
        Route::get('/referral-data', [RefferalController::class, 'getReferralData']);
        Route::get('/referral-details', [RefferalController::class, 'getReferralDetails']);
    });
});

    Route::middleware(['admin'])->group(function () {
    Route::resource('/inject-saldo', InjectController::class);
    Route::put('/saldo/update/{id}', [InjectController::class, 'update'])->name('saldo.update');
    Route::get('/deposits/today', [DashboardController::class, 'getDeposit']);
    Route::get('/withdraw/today', [DashboardController::class, 'getWithdawDashboard']);
    Route::get('/Admin/Dashboard/notifications/unread', [DashboardController::class, 'unreadNotifications'])->middleware('admin');
    Route::post('/Admin/Dashboard/Deposit/Approve/{id}', [DashboardController::class, 'approveDeposit'])->name('admin.deposit.approve');
    Route::post('/Admin/Dashboard/Withdraw/Approve/{id}', [DashboardController::class, 'approveWithdraw'])->name('admin.withdraw.approve');
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/users/search', [TambahController::class, 'index'])->name('users.search')->middleware('admin');
    Route::get('/users/searchs', [DashboardKurangController::class, 'index'])->name('search')->middleware('admin');
    Route::get('/users/searches', [DashboardUserController::class, 'index'])->name('searchs')->middleware('admin');
    Route::get('/users/searchus', [DashboardPasswordController::class, 'index'])->name('searchus')->middleware('admin');
    Route::get('/users/searchsss', [DashboardController::class, 'index'])->name('searchis')->middleware('admin');
    Route::resource('/game_setting', HistoryPlayController::class);
    Route::POST('/fetch-game-history', [HistoryPlayController::class, 'getGameHistory']);
    Route::get('/history-play/user', [HistoryPlayController::class, 'showForm']);
    Route::post('/call-list', [HistoryPlayController::class, 'callList']);
    Route::post('/call-apply', [HistoryPlayController::class, 'callApply']);
    
    // ==== INI JUGA GUE BENERIN TYPO-NYA BIAR GAK ERROR CLASS NOT FOUND ====
    Route::GET('/games/searchByProvider', [DashboardSettingController::class, 'searchByProvider']);
    // ========================================================================
    
    Route::resource('/Admin/Dashboard/Voucher', DashboardVoucherController::class);
    Route::PUT('/Admin/Dashboard/Withdraw/{id}/update', [DashboardWithdrawController::class, 'update']);
    Route::get('/Admin/Dashboard/Withdraw/new-withdraws', [DashboardWithdrawController::class, 'newWithdraws'])->middleware('admin');
    Route::PUT('/Admin/Dashboard/Tranksaksi/{id}/update', [DashboardDepositeController::class, 'update']);
    Route::get('/Admin/Dashboard/Tranksaksi/new-deposits', [DashboardDepositeController::class, 'newDeposits'])->middleware('admin');
    Route::get('/Admin/Dashboard', [DashboardController::class, 'index'])->middleware('admin');
    Route::resource('/Admin/Dashboard/User', DashboardUserController::class);
    Route::put('/Admin/Dashboard/User/{id}', [DashboardUserController::class, 'updateUser']);
    Route::resource('/Admin/Dashboard/Tranksaksi', DashboardDepositeController::class)->Middleware('admin');
    Route::resource('/Admin/Dashboard/Withdraw', DashboardWithdrawController::class)->Middleware('admin');
    Route::resource('/Admin/Dashboard/Promotion', DashboardPromotionController::class)->middleware('admin');
    Route::resource('/Admin/Dashboard/Banner', BannerController::class)->middleware('admin');
    Route::resource('/Admin/Dashboard/Password', DashboardPasswordController::class)->middleware('admin');
    Route::resource('/Admin/Dashboard/Status', DashboardStatusController::class)->middleware('admin');
    Route::resource('/Admin/Dashboard/Game-setting', DashboardSettingController::class)->Middleware('admin');
    Route::resource('/Admin/Dashboard/Warna', DashboardWarnaController::class)->middleware('admin');
    Route::get('/history/transaksi', [HistoryTransaksiController::class, 'index']);
    Route::get('/Admin/Profile', [AdminProfileController::class, 'index']);
    Route::get('/getDepositHistory', [HistoryTransaksiController::class, 'getDepositHistory'])->name('deposit.history');
    Route::get('/get-promotions', [DashboardPromotionController::class, 'getPromotions'])->name('get.promotions');
    Route::get('/getWithdrawHistory', [HistoryTransaksiController::class, 'getWithdrawHistory'])->name('withdraw.history');
    Route::get('/get-bank-name', [HistoryTransaksiController::class, 'getBankName']);
    Route::GET('/Setting', [SettingWebController::class, 'index'])->middleware('admin');
    Route::POST('/Setting', [SettingWebController::class, 'store'])->middleware('admin');
    Route::resource('/Admin/Dashboard/Manage-Bank', BankController::class)->middleware('admin');
    Route::post('/Logout', [AdminLogoutController::class, 'Logout'])->name('Logout');
    Route::POST('/Admin/Logout', [AdminLogoutController::class, 'AdminLogout'])->name('Logouts')->middleware('admin');
    Route::put('/Admin/Dashboard/User/{id}', [DashboardUserController::class, 'update'])->name('user.update');
    Route::get('/Admin/Dashboard/Kyc', [KycController::class, 'index'])->middleware('admin');
    Route::get('/Admin/Dashboard/Kyc/new-verifications', [KycController::class, 'newVerifications'])->middleware('admin');
    Route::put('/Admin/Dashboard/Kyc/{id}', [KycController::class, 'updateStatus'])->name('kyc.updateStatus');
    Route::get('/Admin/Dashboard/Livechat', [DashboardLiveChatController::class, 'index'])->middleware('admin');
    Route::get('/Admin/Dashboard/Livechat/unread-count', [DashboardLiveChatController::class, 'unreadCount'])->middleware('admin');
    Route::get('/Admin/Dashboard/Navigation-Menu', [DashboardNavigationMenuController::class, 'index'])->middleware('admin');
    Route::post('/Admin/Dashboard/Navigation-Menu', [DashboardNavigationMenuController::class, 'store'])->middleware('admin');
    Route::put('/Admin/Dashboard/Navigation-Menu/{id}', [DashboardNavigationMenuController::class, 'update'])->middleware('admin');
    Route::delete('/Admin/Dashboard/Navigation-Menu/{id}', [DashboardNavigationMenuController::class, 'destroy'])->middleware('admin');
    Route::post('/Admin/Dashboard/Navigation-Menu/sync-ggr', [DashboardNavigationMenuController::class, 'syncGGR'])->middleware('admin');
    Route::post('/Admin/Dashboard/Navigation-Menu/sync-games', [DashboardNavigationMenuController::class, 'syncGames'])->middleware('admin');

    Route::get('/Admin/Dashboard/Bonus', [DashboardBonusController::class, 'index'])->middleware('admin');
    Route::post('/Admin/Dashboard/Bonus', [DashboardBonusController::class, 'store'])->middleware('admin');
    Route::get('/Admin/Dashboard/Bonus/{id}', [DashboardBonusController::class, 'show'])->middleware('admin');
    Route::post('/Admin/Dashboard/Bonus/{id}', [DashboardBonusController::class, 'update'])->middleware('admin');
    Route::delete('/Admin/Dashboard/Bonus/{id}', [DashboardBonusController::class, 'destroy'])->middleware('admin');
    Route::post('/Admin/Dashboard/Bonus/{id}/toggle-status', [DashboardBonusController::class, 'toggleStatus'])->middleware('admin');
    Route::get('/admin-chat-sse/{id}', [ChatSseController::class, 'adminSse'])->middleware('admin');
    Route::get('/admin-chat-sessions-sse', [ChatSseController::class, 'sessionsSse'])->middleware('admin');
    
    // Fiver / NEXUS Tools
    Route::get('/Admin/Dashboard/Fiver', [DashboardFiverController::class, 'index'])->middleware('admin');
    Route::post('/Admin/Dashboard/Fiver/reset-user', [DashboardFiverController::class, 'resetUser'])->middleware('admin');
    Route::post('/Admin/Dashboard/Fiver/reset-all', [DashboardFiverController::class, 'resetAll'])->middleware('admin');
    Route::post('/Admin/Dashboard/Fiver/check-status', [DashboardFiverController::class, 'checkStatus'])->middleware('admin');
    Route::get('/Admin/Dashboard/Fiver/transaction/{id}', [DashboardFiverController::class, 'detailTransaction'])->middleware('admin');
    
    // Call Management
    Route::get('/Admin/Dashboard/Call', [DashboardCallController::class, 'index'])->middleware('admin');
    Route::get('/Admin/Dashboard/Call/players', [DashboardCallController::class, 'players'])->middleware('admin');
    Route::post('/Admin/Dashboard/Call/apply', [DashboardCallController::class, 'apply'])->middleware('admin');
    Route::post('/Admin/Dashboard/Call/call-list', [DashboardCallController::class, 'callList'])->middleware('admin');
    Route::post('/Admin/Dashboard/Call/cancel', [DashboardCallController::class, 'cancel'])->middleware('admin');
    Route::get('/Admin/Dashboard/Call/history', [DashboardCallController::class, 'history'])->middleware('admin');
    Route::post('/Admin/Dashboard/Call/control-rtp', [DashboardCallController::class, 'controlRtp'])->middleware('admin');
    Route::post('/Admin/Dashboard/Call/control-users-rtp', [DashboardCallController::class, 'controlUsersRtp'])->middleware('admin');
    Route::post('/Admin/Dashboard/Call/game-log', [DashboardCallController::class, 'gameLog'])->middleware('admin');
    Route::post('/Admin/Dashboard/Call/game-history', [DashboardCallController::class, 'gameHistory'])->middleware('admin');
    
    Route::get('/Admin/Dashboard/Statistic', [DashboardStatisticController::class, 'index'])->middleware('admin');
    Route::get('/Admin/Dashboard/Sportsbook', [DashboardSportsbookController::class, 'index'])->middleware('admin');
    Route::get('/Admin/Dashboard/Message', [DashboardMessageController::class, 'index'])->middleware('admin');
    Route::post('/Admin/Dashboard/Message', [DashboardMessageController::class, 'store'])->middleware('admin');
    Route::delete('/Admin/Dashboard/Message/{id}', [DashboardMessageController::class, 'destroy'])->middleware('admin');
    Route::get('/Admin/Dashboard/GgrBalance', [DashboardGgrController::class, 'balance'])->middleware('admin');
    Route::get('/Admin/Dashboard/Activity', [DashboardActivityController::class, 'index'])->middleware('admin');
    
});
Route::post('/session/online', function () {

    if (Auth::check()) {

        Auth::user()->update([
            'last_seen_at' => now()
        ]);

    }

    return response()->json([
        'status' => true
    ]);

})->middleware('auth');

    
Route::get('/test-providers', function () {

    $exa = new \App\Http\API\Exa();

    dd($exa->getProviders());

});

