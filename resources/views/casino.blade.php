@if (view()->shared('device') == 'mobile')
    @include('layout.mobile.casino')
@else
    @include('layout.desktop.casino')
@endif
