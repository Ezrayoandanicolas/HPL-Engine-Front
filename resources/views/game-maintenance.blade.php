@extends(view()->shared('device') == 'mobile' ? 'layout.mobile.main' : 'layout.desktop.main')
@section(view()->shared('device') == 'mobile' ? 'mobile' : 'content')
<div class="container" style="padding:60px 20px;text-align:center">
    <i class="fas fa-tools" style="font-size:64px;color:#6c757d;margin-bottom:20px"></i>
    <h4>Game Sedang Dalam Perbaikan</h4>
    <p class="text-muted">{{ $game->game_name ?? 'Game ini' }} sedang dalam maintenance. Silakan coba lagi nanti.</p>
    @if (isset($errorMsg))
    <p class="text-danger">{{ $errorMsg }}</p>
    @endif
    <a href="/" class="btn btn-primary mt-3">Kembali ke Beranda</a>
</div>
@endsection