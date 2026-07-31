@if (view()->shared('device') == 'mobile')
    @include('layout.mobile.index')
@else
    @include('layout.desktop.index')
@endif
<script>
(function() {
    var key = 'introShown_v2';
    if (localStorage.getItem(key)) return;
    window.addEventListener('DOMContentLoaded', function() {
        if (typeof initializeIntro !== 'function') return;
        initializeIntro({
            username: 'sapri0808',
            loyaltyLevelTitle: 'Sistem Loyalitas',
            loyaltyLevelSubtitle: 'Sambut perjalanan penuh hadiah',
            loyaltyLevelContent: 'Klik disini untuk membuka halaman loyalty dan jelajahi beragam keuntungan yang bisa Anda dapatkan.',
            loyaltyPointTitle: 'Loyalty Point',
            loyaltyPointSubtitle: 'Dirancang untuk pelanggan setia',
            loyaltyPointContent: 'Dapatkan LP dari setiap turnover yang Anda buat dan tukarkan dengan berbagai barang yang Anda impikan.',
            loyaltyExperienceTitle: 'Experience Point',
            loyaltyExperienceSubtitle: 'Kumpulkan XP sebanyak mungkin',
            loyaltyExperienceContent: 'Kumpulkan lebih banyak XP untuk naik ke level yang lebih tinggi dan dapatkan lebih banyak keuntungan.',
        });
        localStorage.setItem(key, 'true');
    });
})();
</script>