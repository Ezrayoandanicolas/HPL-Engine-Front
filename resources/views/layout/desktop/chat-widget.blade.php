<div id="lcw">
    <button id="lcw-btn" onclick="lcwToggle()" aria-label="Buka Live Chat">
        <span id="lcw-badge">0</span>
        <svg id="lcw-ico-chat" viewBox="0 0 24 24" fill="none" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" width="26" height="26"><path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"/></svg>
        <svg id="lcw-ico-close" viewBox="0 0 24 24" fill="none" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" width="26" height="26" style="display:none"><line x1="18" y1="6" x2="6" y2="18"/><line x1="6" y1="6" x2="18" y2="18"/></svg>
    </button>
    <div id="lcw-dialog">
        <div id="lcw-head">
            <div id="lcw-head-left">
                <div id="lcw-head-avatar"><svg viewBox="0 0 24 24" fill="none" stroke="white" stroke-width="1.5" width="22" height="22"><path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"/></svg></div>
                <div><div id="lcw-head-title">Live Chat</div><div id="lcw-head-status"><span class="lcw-dot"></span> Online</div></div>
            </div>
            <div id="lcw-head-right">
                <button onclick="lcwToggleSound()" id="lcw-sound-btn" title="Notifikasi suara">&#128264;</button>
                <button onclick="lcwToggle()" id="lcw-head-min">&minus;</button>
            </div>
        </div>
        <div id="lcw-body">
            <div id="lcw-form">
                <div id="lcw-form-illustration"><svg viewBox="0 0 80 80" fill="none" width="80" height="80"><circle cx="40" cy="40" r="38" stroke="#e0e7ff" stroke-width="2" fill="#f0f4ff"/><path d="M28 32h24M28 40h16M28 48h20" stroke="#4f46e5" stroke-width="2.5" stroke-linecap="round"/><circle cx="54" cy="54" r="10" fill="#4f46e5"/><path d="M51 54h6M54 51v6" stroke="white" stroke-width="2" stroke-linecap="round"/></svg></div>
                <div id="lcw-form-title">Ada yang bisa kami bantu?</div>
                <div id="lcw-form-desc">Isi nama Anda untuk memulai chat dengan tim CS kami.</div>
                <div id="lcw-form-group">
                    <input type="text" id="lcw-name" placeholder="Nama Anda" class="lcw-inp" maxlength="100" autocomplete="off">
                    <input type="email" id="lcw-email" placeholder="Email (opsional)" class="lcw-inp" maxlength="100" autocomplete="off">
                    <button onclick="lcwStart()" id="lcw-start-btn">Mulai Percakapan</button>
                    <div id="lcw-form-err"></div>
                </div>
            </div>
            <div id="lcw-conv" style="display:none">
                <div id="lcw-msgs"></div>
                <div id="lcw-typing" style="display:none"><span class="lcw-dot-1"></span><span class="lcw-dot-2"></span><span class="lcw-dot-3"></span></div>
                <div id="lcw-bar">
                    <button onclick="lcwEmoji()" id="lcw-emoji-btn" title="Emoji" type="button">&#128512;</button>
                    <input type="text" id="lcw-inp" placeholder="Ketik pesan..." autocomplete="off">
                    <button onclick="lcwAttach()" id="lcw-attach-btn" title="Lampirkan file" type="button"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" width="20" height="20"><path d="M21.44 11.05l-9.19 9.19a6 6 0 0 1-8.49-8.49l9.19-9.19a4 4 0 0 1 5.66 5.66l-9.2 9.19a2 2 0 0 1-2.83-2.83l8.49-8.48"/></svg></button>
                    <button onclick="lcwSend()" id="lcw-send-btn" title="Kirim" type="button"><svg viewBox="0 0 24 24" fill="none" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" width="18" height="18"><line x1="22" y1="2" x2="11" y2="13"/><polygon points="22 2 15 22 11 13 2 9 22 2"/></svg></button>
                </div>
                <div id="lcw-emoji-picker" style="display:none"></div>
                <input type="file" id="lcw-file-input" accept="image/*,.pdf,.doc,.docx,.xls,.xlsx" style="display:none">
            </div>
            <div id="lcw-offline" style="display:none">
                <div id="lcw-offline-icon">&#128554;</div>
                <div id="lcw-offline-title">Sedang offline</div>
                <div id="lcw-offline-desc">Saat ini tidak ada CS yang online. Silakan tinggalkan pesan dan kami akan membalas melalui email.</div>
                <textarea id="lcw-offline-msg" placeholder="Tulis pesan Anda..." class="lcw-inp" style="resize:none;min-height:80px;font-family:inherit"></textarea>
                <button onclick="lcwSendOffline()" id="lcw-offline-btn">Kirim Pesan</button>
                <div id="lcw-offline-err"></div>
            </div>
            <div id="lcw-rating" style="display:none">
                <div id="lcw-rating-title">Chat ditutup</div>
                <div id="lcw-rating-stars"><span onclick="lcwRate(1)">&#9734;</span><span onclick="lcwRate(2)">&#9734;</span><span onclick="lcwRate(3)">&#9734;</span><span onclick="lcwRate(4)">&#9734;</span><span onclick="lcwRate(5)">&#9734;</span></div>
                <div id="lcw-rating-note">Beri penilaian untuk chat ini</div>
                <button onclick="lcwStartNew()" id="lcw-new-chat-btn">Mulai Chat Baru</button>
            </div>
        </div>
    </div>
</div>

<style>
#lcw { font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, 'Helvetica Neue', Arial, sans-serif; z-index: 99999; }
#lcw * { box-sizing: border-box; }
#lcw-btn {
    position: fixed; bottom: 24px; right: 24px; z-index: 99999;
    width: 58px; height: 58px; border-radius: 50%;
    background: linear-gradient(135deg, #4f46e5, #7c3aed); border: none; cursor: pointer;
    display: flex; align-items: center; justify-content: center;
    box-shadow: 0 6px 24px rgba(79,70,229,0.45);
    transition: transform 0.25s cubic-bezier(0.34,1.56,0.64,1), box-shadow 0.25s;
}
#lcw-btn:hover { transform: scale(1.1); box-shadow: 0 8px 32px rgba(79,70,229,0.55); }
#lcw-btn:active { transform: scale(0.95); }
#lcw-btn.lcw-pulse { animation: lcwPulse 1.5s ease-in-out infinite; }
@keyframes lcwPulse { 0%{box-shadow:0 6px 24px rgba(79,70,229,0.45)}50%{box-shadow:0 6px 32px rgba(79,70,229,0.7),0 0 0 8px rgba(79,70,229,0.15)}100%{box-shadow:0 6px 24px rgba(79,70,229,0.45)} }
#lcw-badge { position:absolute;top:-4px;right:-4px;min-width:20px;height:20px;border-radius:10px;background:#ef4444;color:#fff;font-size:.65rem;font-weight:700;display:none;align-items:center;justify-content:center;padding:0 6px;border:2px solid #4f46e5; }
#lcw-dialog {
    position:fixed;bottom:96px;right:24px;z-index:99999;width:380px;height:560px;
    background:var(--lcw-bg,#fff);border-radius:18px;display:none;flex-direction:column;overflow:hidden;
    box-shadow:0 16px 64px rgba(0,0,0,0.18);
    opacity:0;transform:translateY(24px) scale(0.96);
    transition:opacity 0.3s ease, transform 0.3s cubic-bezier(0.34,1.56,0.64,1);
}
#lcw-dialog.lcw-open { opacity:1;transform:translateY(0) scale(1); }
#lcw-head { padding:20px 20px 16px; background:linear-gradient(135deg,#4f46e5,#7c3aed);color:#fff;display:flex;justify-content:space-between;align-items:center;flex-shrink:0; }
#lcw-head-left { display:flex;align-items:center;gap:12px; }
#lcw-head-right { display:flex;align-items:center;gap:6px; }
#lcw-head-avatar { width:40px;height:40px;border-radius:12px;background:rgba(255,255,255,0.18);display:flex;align-items:center;justify-content:center;backdrop-filter:blur(4px); }
#lcw-head-title { font-weight:700;font-size:1rem;letter-spacing:-0.01em; }
#lcw-head-status { font-size:0.75rem;opacity:0.85;display:flex;align-items:center;gap:5px;margin-top:1px; }
.lcw-dot { width:7px;height:7px;border-radius:50%;background:#4ade80;display:inline-block; }
#lcw-head-right button { background:rgba(255,255,255,0.15);border:none;color:#fff;min-width:32px;height:32px;border-radius:10px;cursor:pointer;font-size:1rem;display:flex;align-items:center;justify-content:center;transition:background 0.2s;backdrop-filter:blur(4px);padding:0 6px;line-height:1; }
#lcw-head-right button:hover { background:rgba(255,255,255,0.25); }
#lcw-body { flex:1;display:flex;flex-direction:column;background:var(--lcw-body-bg,#f8fafc);overflow:hidden;position:relative; }
#lcw-form { flex:1;display:flex;flex-direction:column;align-items:center;justify-content:center;padding:32px 28px;text-align:center; }
#lcw-form-illustration { margin-bottom:12px;filter:drop-shadow(0 4px 12px rgba(79,70,229,0.12)); }
#lcw-form-title { font-size:1.1rem;font-weight:700;color:var(--lcw-text,#0f172a);margin-bottom:6px; }
#lcw-form-desc { font-size:0.85rem;color:var(--lcw-muted,#64748b);line-height:1.5;margin-bottom:24px;max-width:280px; }
#lcw-form-group { width:100%;max-width:300px; }
.lcw-inp { width:100%;padding:13px 16px;margin-bottom:10px;border-radius:12px;border:1.5px solid var(--lcw-border,#e2e8f0);background:var(--lcw-input-bg,#fff);color:var(--lcw-text,#0f172a);outline:none;font-size:0.9rem;font-family:inherit;transition:border-color 0.2s,box-shadow 0.2s; }
.lcw-inp:focus { border-color:#4f46e5;box-shadow:0 0 0 4px rgba(79,70,229,0.1); }
.lcw-inp::placeholder { color:#94a3b8; }
#lcw-start-btn,#lcw-offline-btn { width:100%;padding:13px;border:none;border-radius:12px;background:linear-gradient(135deg,#4f46e5,#7c3aed);color:#fff;font-weight:600;font-size:0.9rem;font-family:inherit;cursor:pointer;transition:transform 0.15s,box-shadow 0.2s;box-shadow:0 4px 14px rgba(79,70,229,0.3); }
#lcw-start-btn:hover,#lcw-offline-btn:hover { transform:translateY(-1px);box-shadow:0 6px 20px rgba(79,70,229,0.4); }
#lcw-start-btn:active,#lcw-offline-btn:active { transform:scale(0.97); }
#lcw-start-btn:disabled,#lcw-offline-btn:disabled { opacity:0.6;cursor:not-allowed;transform:none; }
#lcw-form-err,#lcw-offline-err { color:#ef4444;font-size:0.8rem;margin-top:10px;min-height:20px; }
#lcw-conv { display:none;flex-direction:column;height:100%; }
#lcw-msgs { flex:1;overflow-y:auto;padding:16px 16px 8px;display:flex;flex-direction:column;gap:4px;scroll-behavior:smooth;background:var(--lcw-msgs-bg,transparent); }
#lcw-msgs::-webkit-scrollbar { width:4px; }
#lcw-msgs::-webkit-scrollbar-track { background:transparent; }
#lcw-msgs::-webkit-scrollbar-thumb { background:#cbd5e1;border-radius:4px; }
.lcw-bubble { max-width:82%;padding:10px 14px;border-radius:16px;line-height:1.5;font-size:0.88rem;word-wrap:break-word;position:relative;animation:lcwFadeIn 0.25s ease-out; }
.lcw-bubble a { color:inherit;text-decoration:underline; }
@keyframes lcwFadeIn { from{opacity:0;transform:translateY(8px)}to{opacity:1;transform:translateY(0)} }
.lcw-bubble.user { align-self:flex-end;background:linear-gradient(135deg,#4f46e5,#7c3aed);color:#fff;border-bottom-right-radius:4px; }
.lcw-bubble.admin { align-self:flex-start;background:var(--lcw-admin-bg,#fff);color:var(--lcw-text,#0f172a);border:1px solid var(--lcw-border,#e2e8f0);border-bottom-left-radius:4px; }
.lcw-bubble .lcw-ts { font-size:0.6rem;margin-top:5px;display:block;letter-spacing:0.02em; }
.lcw-bubble.user .lcw-ts { text-align:right;opacity:0.65; }
.lcw-bubble.admin .lcw-ts { color:var(--lcw-muted,#94a3b8); }
.lcw-bubble .lcw-name-label { font-size:0.65rem;font-weight:600;text-transform:uppercase;letter-spacing:0.04em;margin-bottom:2px;display:block;color:#4f46e5; }
.lcw-bubble .lcw-attachment { display:block;margin-top:6px; }
.lcw-bubble .lcw-attachment img { max-width:100%;border-radius:8px;cursor:pointer; }
#lcw-typing { padding:6px 16px;display:flex;align-items:center;gap:4px;background:var(--lcw-body-bg,#f8fafc); }
#lcw-typing span { width:7px;height:7px;border-radius:50%;background:#94a3b8;display:inline-block;animation:lcwTyping 1.2s ease-in-out infinite; }
#lcw-typing .lcw-dot-2 { animation-delay:0.16s; }
#lcw-typing .lcw-dot-3 { animation-delay:0.32s; }
@keyframes lcwTyping { 0%,60%,100%{transform:translateY(0);opacity:0.4}30%{transform:translateY(-6px);opacity:1} }
#lcw-bar { display:flex;gap:6px;padding:10px 12px 12px;border-top:1px solid var(--lcw-border,#e2e8f0);background:var(--lcw-bar-bg,#fff);align-items:center; }
#lcw-bar input { flex:1;padding:10px 14px;border-radius:24px;border:1.5px solid var(--lcw-border,#e2e8f0);background:var(--lcw-input-bg,#f1f5f9);color:var(--lcw-text,#0f172a);outline:none;font-size:0.88rem;font-family:inherit;transition:border-color 0.2s,background 0.2s; }
#lcw-bar input:focus { border-color:#4f46e5;background:var(--lcw-input-bg,#fff); }
#lcw-bar input::placeholder { color:#94a3b8; }
#lcw-bar button { width:38px;height:38px;border-radius:50%;border:none;cursor:pointer;display:flex;align-items:center;justify-content:center;flex-shrink:0;background:transparent;color:var(--lcw-muted,#64748b);transition:background 0.2s; }
#lcw-bar button:hover { background:var(--lcw-hover,#f1f5f9); }
#lcw-send-btn { background:linear-gradient(135deg,#4f46e5,#7c3aed)!important;color:#fff!important;box-shadow:0 3px 10px rgba(79,70,229,0.3);transition:transform 0.15s,box-shadow 0.2s!important; }
#lcw-send-btn:hover { transform:scale(1.05);box-shadow:0 5px 16px rgba(79,70,229,0.4)!important; }
#lcw-send-btn:active,#lcw-send-btn:disabled { transform:scale(0.92);opacity:0.4;cursor:not-allowed; }
#lcw-emoji-picker { position:absolute;bottom:62px;left:12px;z-index:10;width:260px;height:200px;overflow-y:auto;background:var(--lcw-bg,#fff);border-radius:12px;box-shadow:0 8px 32px rgba(0,0,0,0.12);padding:8px;display:grid;grid-template-columns:repeat(7,1fr);gap:2px;border:1px solid var(--lcw-border,#e2e8f0); }
#lcw-emoji-picker span { text-align:center;padding:4px;cursor:pointer;border-radius:6px;font-size:1.2rem;transition:background 0.15s; }
#lcw-emoji-picker span:hover { background:var(--lcw-hover,#f1f5f9); }
#lcw-offline { flex:1;display:none;flex-direction:column;align-items:center;justify-content:center;padding:32px 28px;text-align:center; }
#lcw-offline-icon { font-size:3rem;margin-bottom:8px; }
#lcw-offline-title { font-size:1.1rem;font-weight:700;color:var(--lcw-text,#0f172a);margin-bottom:6px; }
#lcw-offline-desc { font-size:0.82rem;color:var(--lcw-muted,#64748b);line-height:1.5;margin-bottom:20px;max-width:280px; }
#lcw-rating { flex:1;display:none;flex-direction:column;align-items:center;justify-content:center;padding:32px 28px;text-align:center;animation:lcwFadeIn 0.3s ease-out; }
#lcw-rating-title { font-size:1.1rem;font-weight:700;color:var(--lcw-text,#0f172a);margin-bottom:16px; }
#lcw-rating-stars span { font-size:2.2rem;cursor:pointer;color:#d1d5db;transition:color 0.2s,transform 0.15s;display:inline-block; }
#lcw-rating-stars span:hover,#lcw-rating-stars span.lcw-star-active { color:#f59e0b;transform:scale(1.15); }
#lcw-rating-note { font-size:0.82rem;color:var(--lcw-muted,#64748b);margin-top:12px; }
#lcw-new-chat-btn { margin-top:16px;padding:11px 28px;border:none;border-radius:12px;background:linear-gradient(135deg,#4f46e5,#7c3aed);color:#fff;font-weight:600;font-size:0.88rem;cursor:pointer;transition:transform 0.15s; }
#lcw-new-chat-btn:hover { transform:scale(1.03); }
@media(max-width:480px){ #lcw-dialog{width:calc(100vw-24px);right:12px;height:65vh;bottom:84px;border-radius:14px} #lcw-btn{bottom:16px;right:16px;width:52px;height:52px} }

/* Dark mode */
.lcw-dark #lcw-dialog { --lcw-bg:#1e293b; --lcw-body-bg:#0f172a; --lcw-text:#e2e8f0; --lcw-muted:#94a3b8; --lcw-border:#334155; --lcw-input-bg:#1e293b; --lcw-bar-bg:#1e293b; --lcw-admin-bg:#1e293b; --lcw-msgs-bg:transparent; --lcw-hover:#334155; }
</style>

<script>
var lcwApi = '{{ config('app.api_base_url') }}';
var lcwSse = window.location.origin + '/chat-sse';
var lcwUnread = 0, lcwLastMsgId = 0, lcwSessionActive = false;
var lcwSSE = null, lcwTypingTimer = null, lcwTabHidden = false, lcwSoundOn = localStorage.getItem('lcw_sound') !== 'off';
var lcwEmojis = ['😀','😃','😄','😁','😅','😂','🤣','😊','😇','🙂','😉','😌','😍','🥰','😘','😗','😋','😛','😜','🤪','😝','🤑','🤗','🤭','🫡','🤐','😐','😑','😶','😏','😒','🙄','😬','😮','😯','😲','😳','🥺','😢','😭','😤','😡','🤬','😈','👿','💀','☠️','💩','🤡','👋','✋','🖐️','👌','🤌','🤏','✌️','🤞','👍','👎','👊','✊','🤛','🤜','👏','🙌','🤲','🤝','🙏','💪','🦵','🦶','👂','👃','🧠','🫀','👀','👅','👄','💋','❤️','🧡','💛','💚','💙','💜','🖤','🤍','🤎','💔','❤️‍🔥','💖','💗','💝','💘','💟','✨','🌟','⭐','🔥','💯','🎉','🎊','🎈','🎁','🎀','🪄','💎','👑','🏆','🥇','🥈','🥉'];

// Dark mode detection
(function(){ try {
    var bg = getComputedStyle(document.body).backgroundColor;
    var rgb = bg.match(/\d+/g);
    if (rgb && rgb.length >= 3) {
        var brightness = (parseInt(rgb[0])*299 + parseInt(rgb[1])*587 + parseInt(rgb[2])*114) / 1000;
        if (brightness < 100) document.getElementById('lcw').classList.add('lcw-dark');
    }
} catch(e){} })();

function lcwToggle() {
    var d = document.getElementById('lcw-dialog');
    var isOpen = d.classList.contains('lcw-open');
    if (isOpen) { d.classList.remove('lcw-open'); setTimeout(function(){ d.style.display='none'; },300); }
    else { d.style.display='flex'; lcwUnread=0; lcwUpdateBadge(); requestAnimationFrame(function(){ d.classList.add('lcw-open'); }); document.getElementById('lcw-btn').classList.remove('lcw-pulse'); }
    document.getElementById('lcw-ico-chat').style.display = isOpen ? '' : 'none';
    document.getElementById('lcw-ico-close').style.display = isOpen ? 'none' : '';
    if (!isOpen) { var t = localStorage.getItem('lcw_token'); if(t) lcwOpenConv(t); }
}

function lcwStart() {
    var name = document.getElementById('lcw-name').value.trim();
    if (!name) { document.getElementById('lcw-form-err').textContent = 'Nama harus diisi'; return; }
    document.getElementById('lcw-form-err').textContent = '';
    var email = document.getElementById('lcw-email').value.trim();
    var btn = document.getElementById('lcw-start-btn');
    btn.disabled = true; btn.textContent = 'Memproses...';
    var body = 'name=' + encodeURIComponent(name);
    if (email) body += '&email=' + encodeURIComponent(email);
    fetch(lcwApi + '/chat/create', { method:'POST', headers:{'Content-Type':'application/x-www-form-urlencoded','Accept':'application/json'}, body:body })
    .then(function(r){ return r.json(); }).then(function(resp) {
        btn.disabled = false; btn.textContent = 'Mulai Percakapan';
        if (resp.success) {
            localStorage.setItem('lcw_token', resp.data.session.session_token);
            localStorage.setItem('lcw_name', name);
            lcwLastMsgId = 0;
            document.getElementById('lcw-form').style.display = 'none';
            document.getElementById('lcw-offline').style.display = 'none';
            lcwOpenConv(resp.data.session.session_token);
        } else { document.getElementById('lcw-form-err').textContent = resp.message || 'Gagal'; }
    }).catch(function(){ btn.disabled = false; btn.textContent = 'Mulai Percakapan'; document.getElementById('lcw-form-err').textContent = 'Gagal terhubung'; });
}

function lcwCheckOffline() {
    // Show offline form if no CS online (simulated by API check)
    var token = localStorage.getItem('lcw_token');
    if (!token) {
        document.getElementById('lcw-form').style.display = 'none';
        document.getElementById('lcw-offline').style.display = 'flex';
    }
}

function lcwSendOffline() {
    var msg = document.getElementById('lcw-offline-msg').value.trim();
    if (!msg) { document.getElementById('lcw-offline-err').textContent = 'Pesan harus diisi'; return; }
    var name = localStorage.getItem('lcw_name') || 'Guest';
    var email = localStorage.getItem('lcw_email') || '';
    document.getElementById('lcw-offline-err').textContent = '';
    var btn = document.getElementById('lcw-offline-btn');
    btn.disabled = true; btn.textContent = 'Mengirim...';
    fetch(lcwApi + '/chat/create', { method:'POST', headers:{'Content-Type':'application/x-www-form-urlencoded','Accept':'application/json'}, body:'name='+encodeURIComponent(name)+'&email='+encodeURIComponent(email)+'&is_offline=1' })
    .then(function(r){ return r.json(); }).then(function(resp){
        btn.disabled = false; btn.textContent = 'Kirim Pesan';
        if (resp.success) {
            var token = resp.data.session.session_token;
            fetch(lcwApi + '/chat/send', { method:'POST', headers:{'Content-Type':'application/x-www-form-urlencoded','Accept':'application/json'}, body:'session_token='+encodeURIComponent(token)+'&message='+encodeURIComponent(msg) });
            document.getElementById('lcw-offline').innerHTML = '<div style="flex:1;display:flex;flex-direction:column;align-items:center;justify-content:center"><div style="font-size:3rem;margin-bottom:8px">&#9989;</div><div style="font-size:1.1rem;font-weight:700;color:var(--lcw-text,#0f172a);margin-bottom:6px">Pesan terkirim</div><div style="font-size:0.82rem;color:var(--lcw-muted,#64748b);line-height:1.5;max-width:280px">Kami akan membalas pesan Anda melalui email. Terima kasih!</div></div>';
        }
    }).catch(function(){ btn.disabled=false; btn.textContent='Kirim Pesan'; });
}

function lcwOpenConv(token) {
    lcwSessionActive = true;
    document.getElementById('lcw-conv').style.display = 'flex';
    document.getElementById('lcw-rating').style.display = 'none';
    lcwLoadMsgs(token); lcwConnectSSE(token);
}

function lcwLoadMsgs(token) {
    fetch(lcwApi + '/chat/messages/' + encodeURIComponent(token), { headers:{'Accept':'application/json'} })
    .then(function(r){ return r.json(); }).then(function(resp) {
        if (resp.success) {
            var c = document.getElementById('lcw-msgs');
            c.innerHTML = '';
            (resp.data || []).forEach(function(m){ lcwAppend(m.message,m.sender_type,m.created_at,m.attachment,m.attachment_type); if(m.id>lcwLastMsgId) lcwLastMsgId=m.id; });
            lcwScroll();
        } else {
            localStorage.removeItem('lcw_token');
            document.getElementById('lcw-conv').style.display = 'none';
            document.getElementById('lcw-form').style.display = 'flex';
            if (lcwSSE) lcwSSE.close();
        }
    });
}

function lcwConnectSSE(token) {
    if (lcwSSE) lcwSSE.close();
    lcwSSE = new EventSource(lcwSse + '/' + encodeURIComponent(token));
    lcwSSE.addEventListener('message', function(e) {
        var m = JSON.parse(e.data);
        if (m.sender_type === 'admin') {
            lcwAppend(m.message, 'admin', m.created_at, m.attachment, m.attachment_type);
            if (m.id > lcwLastMsgId) {
                lcwLastMsgId = m.id;
                var d = document.getElementById('lcw-dialog');
                if (!d.classList.contains('lcw-open')) {
                    lcwUnread++; lcwUpdateBadge();
                    document.getElementById('lcw-btn').classList.add('lcw-pulse');
                    if (lcwSoundOn) lcwPlaySound();
                    if (lcwTabHidden) { lcwFlashTitle(); lcwNotify('Pesan baru dari CS', m.message); }
                }
            }
        }
    });
    lcwSSE.addEventListener('typing', function(e) {
        document.getElementById('lcw-typing').style.display = JSON.parse(e.data).typing ? 'flex' : 'none';
    });
    lcwSSE.onerror = function() { setTimeout(function(){ var t = localStorage.getItem('lcw_token'); if(t) lcwConnectSSE(t); },3000); };
}

function lcwAppend(text, type, time, attachment, attType) {
    var c = document.getElementById('lcw-msgs');
    var d = document.createElement('div');
    d.className = 'lcw-bubble ' + type;
    if (type === 'admin') { var lbl = document.createElement('span'); lbl.className = 'lcw-name-label'; lbl.textContent = 'CS'; d.appendChild(lbl); }
    var txt = document.createElement('span');
    txt.innerHTML = lcwLinkify(text || '');
    d.appendChild(txt);
    if (attachment) {
        var a = document.createElement('div'); a.className = 'lcw-attachment';
        if (attType && attType.startsWith('image/')) { var img = document.createElement('img'); img.src = attachment; img.loading = 'lazy'; img.onclick = function(){ window.open(attachment); }; a.appendChild(img); }
        else { var lnk = document.createElement('a'); lnk.href = attachment; lnk.target = '_blank'; lnk.textContent = '\uD83D\uDCCE ' + (attachment.split('/').pop() || 'File'); a.appendChild(lnk); }
        d.appendChild(a);
    }
    var ts = document.createElement('span'); ts.className = 'lcw-ts'; ts.textContent = time ? lcwRelTime(time) : '';
    d.appendChild(ts); c.appendChild(d); lcwScroll();
}

function lcwLinkify(text) {
    if (!text) return '';
    return text.replace(/(https?:\/\/[^\s<]+)/g, '<a href="$1" target="_blank" rel="noopener">$1</a>')
               .replace(/(^|[^@\w])@(\w{1,15})\b/g, '$1@$2');
}

function lcwRelTime(d) { if(!d)return''; var diff=(new Date()-new Date(d))/1000; if(diff<60)return'baru saja'; if(diff<3600)return Math.floor(diff/60)+'m'; if(diff<86400)return Math.floor(diff/3600)+'j'; if(diff<172800)return'kemarin '+new Date(d).toLocaleTimeString([],{hour:'2-digit',minute:'2-digit'}); return new Date(d).toLocaleDateString()+' '+new Date(d).toLocaleTimeString([],{hour:'2-digit',minute:'2-digit'}); }
function lcwScroll() { var c=document.getElementById('lcw-msgs'); requestAnimationFrame(function(){ c.scrollTop=c.scrollHeight; }); }
function lcwUpdateBadge() { var b=document.getElementById('lcw-badge'); if(lcwUnread>0){b.textContent=lcwUnread;b.style.display='flex'}else{b.style.display='none'} }

function lcwPlaySound() {
    try { var ctx=new(window.AudioContext||window.webkitAudioContext)(); var osc=ctx.createOscillator(); var gain=ctx.createGain(); osc.connect(gain); gain.connect(ctx.destination); osc.frequency.value=520; osc.type='sine'; gain.gain.setValueAtTime(0.3,ctx.currentTime); gain.gain.exponentialRampToValueAtTime(0.01,ctx.currentTime+0.15); osc.start(ctx.currentTime); osc.stop(ctx.currentTime+0.15); } catch(e){}
}

function lcwNotify(title, body) {
    if (!('Notification' in window) || Notification.permission === 'denied') return;
    if (Notification.permission === 'granted') { new Notification(title, { body: body, icon: '/favicon.ico' }); }
    else { Notification.requestPermission(); }
}

function lcwFlashTitle() {
    var orig=document.title; var flash=true;
    var int=setInterval(function(){ document.title=flash?'[Pesan Baru] '+orig:orig; flash=!flash; },1000);
    setTimeout(function(){ clearInterval(int); document.title=orig; },6000);
}

function lcwToggleSound() {
    lcwSoundOn = !lcwSoundOn;
    localStorage.setItem('lcw_sound', lcwSoundOn ? 'on' : 'off');
    document.getElementById('lcw-sound-btn').textContent = lcwSoundOn ? '\uD83D\uDD08' : '\uD83D\uDD07';
}

document.addEventListener('visibilitychange', function(){ lcwTabHidden = document.hidden; });
if ('Notification' in window && Notification.permission === 'default') Notification.requestPermission();

function lcwSend() {
    var input = document.getElementById('lcw-inp');
    var msg = input.value.trim();
    if (!msg) return;
    var token = localStorage.getItem('lcw_token');
    if (!token) return;
    var btn = document.getElementById('lcw-send-btn');
    btn.disabled = true;
    fetch(lcwApi + '/chat/send', { method:'POST', headers:{'Content-Type':'application/x-www-form-urlencoded','Accept':'application/json'}, body:'session_token='+encodeURIComponent(token)+'&message='+encodeURIComponent(msg) })
    .then(function(r) {
        if (r.status === 410) { lcwStartFresh(token, msg); btn.disabled = false; return null; }
        return r.json();
    }).then(function(resp) {
        btn.disabled = false;
        if (resp && resp.success) { input.value = ''; lcwAppend(msg, 'user', new Date().toISOString(), null, null); }
        else if (resp && resp.message === 'Session not found or closed') { lcwStartFresh(token, msg); }
    }).catch(function(e){ console.error('Send error:', e); btn.disabled = false; });
}

function lcwStartFresh(oldToken, pendingMsg) {
    if (lcwSSE) lcwSSE.close(); localStorage.removeItem('lcw_token');
    var name = localStorage.getItem('lcw_name') || 'Guest';
    fetch(lcwApi + '/chat/create', { method:'POST', headers:{'Content-Type':'application/x-www-form-urlencoded','Accept':'application/json'}, body:'name='+encodeURIComponent(name) })
    .then(function(r){ return r.json(); }).then(function(resp) {
        if (resp.success) {
            var t = resp.data.session.session_token;
            localStorage.setItem('lcw_token', t); lcwConnectSSE(t);
            document.getElementById('lcw-msgs').innerHTML = '';
            if (pendingMsg) {
                fetch(lcwApi + '/chat/send', { method:'POST', headers:{'Content-Type':'application/x-www-form-urlencoded','Accept':'application/json'}, body:'session_token='+encodeURIComponent(t)+'&message='+encodeURIComponent(pendingMsg) })
                .then(function(r){ return r.json(); }).then(function(r2){ if(r2.success) lcwAppend(pendingMsg,'user',new Date().toISOString(),null,null); });
            }
        }
    });
}

function lcwEmoji() {
    var p = document.getElementById('lcw-emoji-picker');
    if (p.style.display === 'grid') { p.style.display = 'none'; return; }
    if (!p.hasChildNodes()) { lcwEmojis.forEach(function(e){ var s=document.createElement('span'); s.textContent=e; s.onclick=function(){ document.getElementById('lcw-inp').value+=e; document.getElementById('lcw-inp').focus(); p.style.display='none'; }; p.appendChild(s); }); }
    p.style.display = 'grid';
}

function lcwAttach() { document.getElementById('lcw-file-input').click(); }
document.getElementById('lcw-file-input').addEventListener('change', function() {
    var file = this.files[0]; if (!file) return;
    var token = localStorage.getItem('lcw_token'); if (!token) return;
    var form = new FormData(); form.append('file', file); form.append('session_token', token);
    fetch(lcwApi + '/chat/upload', { method:'POST', headers:{'Accept':'application/json'}, body:form })
    .then(function(r){ return r.json(); }).then(function(resp){ if (resp.success) lcwAppend(resp.data.message||'', 'user', new Date().toISOString(), resp.data.url, file.type); });
    this.value = '';
});

function lcwRate(star) {
    document.querySelectorAll('#lcw-rating-stars span').forEach(function(s,i){ s.className=i<star?'lcw-star-active':''; s.textContent=i<star?'\u2605':'\u2606'; });
    document.getElementById('lcw-rating-note').textContent = 'Terima kasih!';
    var token = localStorage.getItem('lcw_token');
    if (token) fetch(lcwApi + '/chat/rating', { method:'POST', headers:{'Content-Type':'application/x-www-form-urlencoded','Accept':'application/json'}, body:'session_token='+encodeURIComponent(token)+'&rating='+star });
}

function lcwStartNew() {
    localStorage.removeItem('lcw_token'); localStorage.removeItem('lcw_name');
    if (lcwSSE) lcwSSE.close(); lcwSessionActive = false;
    ['lcw-conv','lcw-rating','lcw-offline'].forEach(function(id){ document.getElementById(id).style.display='none'; });
    document.getElementById('lcw-form').style.display = 'flex';
    document.getElementById('lcw-name').value = ''; document.getElementById('lcw-email').value = '';
    document.getElementById('lcw-msgs').innerHTML = '';
}

document.addEventListener('DOMContentLoaded', function() {
    document.getElementById('lcw-inp').addEventListener('keydown', function(e) { if(e.key==='Enter'){e.preventDefault();lcwSend();} });
    document.getElementById('lcw-inp').addEventListener('input', function() {
        clearTimeout(lcwTypingTimer);
        var token = localStorage.getItem('lcw_token'); if (!token) return;
        fetch(lcwApi + '/chat/typing', { method:'POST', headers:{'Content-Type':'application/x-www-form-urlencoded','Accept':'application/json'}, body:'session_token='+encodeURIComponent(token)+'&text='+encodeURIComponent(this.value) });
        lcwTypingTimer = setTimeout(function(){ fetch(lcwApi + '/chat/typing', { method:'POST', headers:{'Content-Type':'application/x-www-form-urlencoded','Accept':'application/json'}, body:'session_token='+encodeURIComponent(token)+'&text=' }); }, 3000);
    });
    // Sound btn initial state
    document.getElementById('lcw-sound-btn').textContent = lcwSoundOn ? '\uD83D\uDD08' : '\uD83D\uDD07';
});
</script>
