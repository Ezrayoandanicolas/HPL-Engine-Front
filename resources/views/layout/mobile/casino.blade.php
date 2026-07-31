@extends('layout.mobile.main')
@section('mobile')
    <div class="standard-form-container">
        <div class="page-title-container">
            <h1 class="page-title">LIVE CASINO</h1>
            <p class="page-subtitle">Pilih Provider Live Casino</p>
        </div>
        <div class="casino-provider-list">
            @foreach ($providers as $provider)
                <a href="{{ route('casino.provider', strtolower($provider->provider_code)) }}"
                    class="casino-provider-item">
                    <div class="casino-provider-card">
                        <img src="{{ $provider->image_url }}" alt="{{ $provider->provider_name }}">
                        <div class="provider-info">
                            <div class="provider-name">
                                {{ ucwords(strtolower(str_replace('_', ' ', $provider->provider_name))) }}
                                <span class="live-badge">LIVE</span>
                            </div>
                            <div class="game-count">{{ $provider->total_game }} Permainan</div>
                        </div>
                    </div>
                </a>
            @endforeach
        </div>
    </div>
    <style>
        .page-title-container {
            padding: 20px 16px 0;
            text-align: center;
        }
        .page-title {
            color: #fff;
            font-size: 22px;
            font-weight: 700;
            margin: 0;
        }
        .page-subtitle {
            color: #bfbfbf;
            font-size: 13px;
            margin: 6px 0 0;
        }
        .casino-provider-list {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 12px;
            padding: 16px;
        }
        .casino-provider-card {
            background: #1a1a1a;
            border-radius: 16px;
            overflow: hidden;
            border: 1px solid #333;
            height: 100%;
        }
        .casino-provider-card img {
            width: 100%;
            height: 120px;
            object-fit: cover;
            display: block;
        }
        .provider-info {
            padding: 12px;
            text-align: center;
        }
        .provider-name {
            color: #fff;
            font-size: 14px;
            font-weight: 700;
        }
        .game-count {
            color: #bfbfbf;
            font-size: 12px;
            margin-top: 4px;
        }
        .live-badge {
            display: inline-block;
            padding: 2px 8px;
            border-radius: 20px;
            background: #d60000;
            color: #fff;
            font-size: 9px;
            margin-left: 4px;
            vertical-align: middle;
        }
    </style>
@endsection
