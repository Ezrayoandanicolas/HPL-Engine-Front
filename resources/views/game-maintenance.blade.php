@extends(view()->shared('device') == 'mobile' ? 'layout.mobile.main' : 'layout.desktop.main')
@section(view()->shared('device') == 'mobile' ? 'mobile' : 'content')
<style>
    .maintenance-page {
        min-height: 60vh;
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        padding: 40px 20px;
    }
    .maintenance-card {
        background: linear-gradient(145deg, #1c1f2e 0%, #262b3d 100%);
        border: 1px solid rgba(255,255,255,.08);
        border-radius: 20px;
        padding: 40px;
        max-width: 520px;
        width: 100%;
        text-align: center;
        box-shadow: 0 20px 60px rgba(0,0,0,.5);
    }
    .maintenance-icon {
        width: 80px; height: 80px;
        background: linear-gradient(135deg, #ff6b6b, #ee5a24);
        border-radius: 50%;
        display: flex; align-items: center; justify-content: center;
        margin: 0 auto 24px;
        animation: pulse 2s ease-in-out infinite;
    }
    .maintenance-icon i { font-size: 36px; color: #fff; }
    @keyframes pulse {
        0%, 100% { transform: scale(1); box-shadow: 0 0 0 0 rgba(238,90,36,.4); }
        50% { transform: scale(1.05); box-shadow: 0 0 0 20px rgba(238,90,36,0); }
    }
    .maintenance-title {
        color: #fff; font-size: 22px; font-weight: 700; margin-bottom: 8px;
    }
    .maintenance-subtitle {
        color: #9aa0b5; font-size: 14px; margin-bottom: 6px;
    }
    .maintenance-game-name {
        color: #40E0D0; font-weight: 600;
    }
    .maintenance-error {
        background: rgba(255,107,107,.1);
        border: 1px solid rgba(255,107,107,.2);
        border-radius: 10px;
        padding: 10px 16px;
        color: #ff6b6b;
        font-size: 13px;
        margin: 16px 0;
    }
    .btn-back {
        background: linear-gradient(135deg, #40E0D0, #20b2aa);
        border: none; color: #fff; font-weight: 600;
        padding: 12px 32px; border-radius: 12px;
        font-size: 15px; transition: all .3s;
        text-decoration: none; display: inline-block;
    }
    .btn-back:hover { transform: translateY(-2px); box-shadow: 0 8px 25px rgba(64,224,208,.3); color: #fff; text-decoration: none; }

    .alt-games-section {
        max-width: 900px; width: 100%; margin-top: 40px;
    }
    .alt-games-title {
        color: #fff; font-size: 18px; font-weight: 600; text-align: center; margin-bottom: 6px;
    }
    .alt-games-subtitle {
        color: #9aa0b5; font-size: 13px; text-align: center; margin-bottom: 20px;
    }
    .alt-games-grid {
        display: grid;
        grid-template-columns: repeat(4, 1fr);
        gap: 16px;
    }
    @media (max-width: 767px) {
        .alt-games-grid { grid-template-columns: repeat(2, 1fr); }
    }
    .alt-game-card {
        background: linear-gradient(145deg, #1c1f2e 0%, #262b3d 100%);
        border: 1px solid rgba(255,255,255,.06);
        border-radius: 14px;
        overflow: hidden;
        transition: all .3s;
        text-decoration: none;
    }
    .alt-game-card:hover {
        transform: translateY(-4px);
        border-color: rgba(64,224,208,.3);
        box-shadow: 0 12px 30px rgba(0,0,0,.4);
        text-decoration: none;
    }
    .alt-game-img {
        width: 100%; aspect-ratio: 1; object-fit: cover;
        background: #1a1a2e;
    }
    .alt-game-name {
        padding: 10px 12px;
        color: #fff; font-size: 12px; font-weight: 600;
        white-space: nowrap; overflow: hidden; text-overflow: ellipsis;
        text-align: center;
    }
</style>

<div class="maintenance-page">
    <div class="maintenance-card">
        <div class="maintenance-icon">
            <i class="fas fa-wrench"></i>
        </div>
        <div class="maintenance-title">Game Sedang Maintenance</div>
        <div class="maintenance-subtitle">
            <span class="maintenance-game-name">{{ $game->game_name ?? 'Game ini' }}</span> sedang dalam perbaikan
        </div>
        <div class="maintenance-subtitle">Silakan pilih game lain di bawah ini</div>

        @if (isset($errorMsg) && $errorMsg)
        <div class="maintenance-error">
            <i class="fas fa-info-circle"></i> {{ $errorMsg }}
        </div>
        @endif

        <a href="/" class="btn-back">
            <i class="fas fa-home"></i> Kembali ke Beranda
        </a>
    </div>

    @if (!empty($altGames))
    <div class="alt-games-section">
        <div class="alt-games-title">Mainkan Game Lainnya</div>
        <div class="alt-games-subtitle">Pilih game favorit kamu</div>
        <div class="alt-games-grid">
            @foreach ($altGames as $alt)
            <a href="{{ Auth::check() ? '/gameplay/'.$alt->id.'/show' : '/login' }}" class="alt-game-card">
                @if (!empty($alt->image))
                <img class="alt-game-img" src="{{ $alt->image }}" alt="{{ $alt->game_name }}" loading="lazy">
                @else
                <div class="alt-game-img" style="display:flex;align-items:center;justify-content:center;color:#666;font-size:12px">{{ $alt->game_name }}</div>
                @endif
                <div class="alt-game-name">{{ $alt->game_name }}</div>
            </a>
            @endforeach
        </div>
    </div>
    @endif
</div>
@endsection
