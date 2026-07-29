@extends('layout.desktop.main')

@section('content')

<style>
    .casino-provider-card{
        background:#1a1a1a;
        border-radius:16px;
        overflow:hidden;
        transition:.3s;
        border:1px solid #333;
        height:100%;
    }

    .casino-provider-card:hover{
        transform:translateY(-8px);
        border-color:#d4af37;
        box-shadow:0 10px 25px rgba(0,0,0,.5);
    }

    .casino-provider-card img{
        width:100%;
        height:200px;
        object-fit:cover;
    }

    .provider-info{
        padding:18px;
        text-align:center;
    }

    .provider-name{
        color:#fff;
        font-size:18px;
        font-weight:700;
    }

    .game-count{
        color:#bfbfbf;
        font-size:13px;
        margin-top:6px;
    }

    .live-badge{
        display:inline-block;
        padding:2px 8px;
        border-radius:20px;
        background:#d60000;
        color:#fff;
        font-size:10px;
        margin-left:6px;
    }
</style>

<div class="container mt-4">

    <div class="text-center mb-5">
        <h2 class="text-white fw-bold">LIVE CASINO</h2>
        <p class="text-light">Pilih Provider Live Casino</p>
    </div>

    <div class="row g-4">

        @foreach($providers as $provider)

        <div class="col-6 col-md-4 col-lg-3">

            <a href="{{ route('casino.provider', strtolower($provider->provider_code)) }}"
               class="text-decoration-none">

                <div class="casino-provider-card">

                    <img src="{{ $provider->image_url }}"
                         alt="{{ $provider->provider_name }}">

                    <div class="provider-info">

                        <div class="provider-name">

                            {{ ucwords(strtolower(str_replace('_',' ',$provider->provider_name))) }}

                            <span class="live-badge">LIVE</span>

                        </div>

                        <div class="game-count">

                            {{ $provider->total_game }} Permainan

                        </div>

                    </div>

                </div>

            </a>

        </div>

        @endforeach

    </div>

</div>

@endsection