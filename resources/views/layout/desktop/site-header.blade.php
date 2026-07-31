<div class="site-header">
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <div class="site-header-inner-container">
                    <div class="menu-slide" id="menu_slides">
                        <i class="fas fa-chevron-left left_trigger menu-slide-arrow"></i>
                        <div class="top-menu-wrap">
                            <ul class="top-menu" id="top-menu-container"></ul>
                        </div>
                        <i class="fas fa-chevron-right right_trigger menu-slide-arrow"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
.menu-slide { display: flex; align-items: stretch; height:58px; }
.site-header { position: relative; z-index: 15; }
.menu-slide .top-menu-wrap { overflow: hidden; flex: 1; height: 100%; }
.menu-slide .top-menu { display: flex; gap: 0; white-space: nowrap; height: 100%; }
.menu-slide .top-menu li { flex-shrink: 0; list-style:none; height: 100%; display: flex; align-items: center; }
.menu-slide-arrow { cursor: pointer; padding: 0 12px; font-size: 12px; color: #aaa; user-select: none; transition: all 0.2s; z-index: 2; display:flex;align-items:center;height:100%; }
.menu-slide-arrow:hover { color: #fff; }
.menu-slide-arrow.disabled { opacity: 0.3; cursor: default; pointer-events:none; }
/* Mega dropdown full width */
.site-header-inner-container {  }
.top-menu .game-list-container { position: absolute; top: 100%; left: 0; right: 0; width: 100vw; z-index: 16; }
/* Bridge to keep hover when moving from menu item to dropdown */
.top-menu > li:hover .game-list-container { display: block; }
.top-menu > li:not(:hover) .game-list-container { display: none; }
.top-menu .game-list-container::before { content: ''; position: absolute; top: -58px; left: 0; right: 0; height: 58px; }
.top-menu .games-container { max-width: 1700px; margin: 0 auto; justify-content: center; display: flex; flex-wrap: wrap; }
.top-menu .games-container > li { flex: 0 0 calc(20% - 10px); max-width: 327px; margin: 5px; }
</style>

<script>
(function() {
    var apiUrl = '{{ config('app.api_base_url') }}/navigation-menu';
    var container = document.getElementById('top-menu-container');
    if (!container) return;

    fetch(apiUrl, { headers: { 'Accept': 'application/json' } })
    .then(function(r) { return r.json(); })
    .then(function(resp) {
        if (!resp.success || !resp.data) return;
        var categories = resp.data;
        var html = '';
        var catOrder = ['Hot Games', 'Slots', 'Live Casino', 'Sports', 'Arcade', 'Poker', 'Sabung Ayam'];

        catOrder.forEach(function(cat) {
            var items = categories[cat];
            if (!items || !items.length) return;
            html += '<li data-active="false">';
            html += '<a href="' + items[0].url + '">' + cat + (items.length > 0 ? ' <i class="fas fa-chevron-down"></i>' : '') + '</a>';
            html += '<div class="game-list-container"><div class="container"><div class="row"><div class="col-md-12">';
            html += '<ul class="games-container" style="--maintenance-text: \'Pemeliharaan\'">';
            items.forEach(function(item) {
                var img = item.image || '';
                var imgHtml = img
                    ? '<span><picture><source srcset="' + img + '" type="image/webp" /><img alt="' + escHtml(item.title) + '" height="150" loading="lazy" src="' + img + '" width="150" /></picture></span>'
                    : '<span>' + escHtml(item.title) + '</span>';
                html += '<li><a href="' + item.url + '" data-vendor-name="' + escHtml(item.title) + '" data-maintenance-status="false">' + imgHtml + '</a></li>';
            });
            html += '</ul></div></div></div></div></li>';
        });

        container.innerHTML = html;
    })
    .catch(function(e) { console.error('Nav load error:', e); });

    function escHtml(s) {
        if (!s) return '';
        return s.replace(/&/g,'&amp;').replace(/</g,'&lt;').replace(/>/g,'&gt;').replace(/"/g,'&quot;');
    }

    // Menu slide
    (function() {
        var slide = document.getElementById('menu_slides');
        if (!slide) return;
        var wrap = slide.querySelector('.top-menu-wrap');
        var left = slide.querySelector('.left_trigger');
        var right = slide.querySelector('.right_trigger');
        if (!wrap || !left || !right) return;

        function updateArrows() {
            left.classList.toggle('disabled', wrap.scrollLeft <= 0);
            right.classList.toggle('disabled', wrap.scrollLeft + wrap.clientWidth >= wrap.scrollWidth - 1);
        }

        left.onclick = function() { wrap.scrollLeft -= 200; setTimeout(updateArrows, 50); };
        right.onclick = function() { wrap.scrollLeft += 200; setTimeout(updateArrows, 50); };
        wrap.addEventListener('scroll', updateArrows);
        setTimeout(updateArrows, 500);
    })();
})();
</script>
