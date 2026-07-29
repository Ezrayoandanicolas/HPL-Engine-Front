@if(view()->shared('device') == 'mobile')
    @include('layout.mobile.transfer')
@else
    @include('layout.desktop.transfer')
@endif