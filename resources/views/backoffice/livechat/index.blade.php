@extends('backoffice.layouts.main')

@section('content')
<style>
#lc { display: flex; gap: 0; height: calc(100vh - 200px); background: #fff; border-radius: 8px; overflow: hidden; box-shadow: 0 1px 3px rgba(0,0,0,0.08); }
#lc .lc-sidebar { width: 340px; flex-shrink: 0; border-right: 1px solid #e9ecef; display: flex; flex-direction: column; background: #f8f9fa; }
#lc .lc-sidebar-header { padding: 16px 16px 12px; border-bottom: 1px solid #e9ecef; }
#lc .lc-sidebar-header h6 { margin: 0; font-weight: 700; color: #1a202c; font-size: 0.95rem; }
#lc .lc-sidebar-header small { color: #6c757d; font-size: 0.8rem; }
#lc .lc-tabs { display: flex; gap: 4px; padding: 10px 16px; border-bottom: 1px solid #e9ecef; }
#lc .lc-tabs button { padding: 5px 14px; border-radius: 20px; border: 1px solid #dee2e6; background: #fff; color: #6c757d; cursor: pointer; font-size: 0.8rem; font-weight: 500; transition: all 0.2s; }
#lc .lc-tabs button:hover { border-color: #adb5bd; }
#lc .lc-tabs button.active { background: #007bff; color: #fff; border-color: #007bff; }
#lc .lc-contacts { flex: 1; overflow-y: auto; padding: 8px; }
#lc .lc-contact { display: flex; align-items: center; gap: 12px; padding: 12px; border-radius: 8px; cursor: pointer; transition: all 0.15s; margin-bottom: 2px; }
#lc .lc-contact:hover { background: #e9ecef; }
#lc .lc-contact.active { background: #007bff; }
#lc .lc-contact.active .lc-contact-name,
#lc .lc-contact.active .lc-contact-preview,
#lc .lc-contact.active .lc-contact-time { color: #fff; }
#lc .lc-contact.active .lc-badge { background: rgba(255,255,255,0.3); color: #fff; }
#lc .lc-avatar { width: 42px; height: 42px; border-radius: 50%; display: flex; align-items: center; justify-content: center; font-weight: 700; font-size: 0.9rem; flex-shrink: 0; }
#lc .lc-contact-info { flex: 1; min-width: 0; }
#lc .lc-contact-top { display: flex; justify-content: space-between; align-items: center; }
#lc .lc-contact-name { font-weight: 600; font-size: 0.85rem; color: #1a202c; }
#lc .lc-contact-time { font-size: 0.7rem; color: #adb5bd; }
#lc .lc-contact-preview { font-size: 0.78rem; color: #6c757d; white-space: nowrap; overflow: hidden; text-overflow: ellipsis; margin-top: 2px; }
#lc .lc-contact-meta { display: flex; align-items: center; gap: 6px; }
#lc .lc-badge { font-size: 0.65rem; padding: 2px 8px; border-radius: 10px; font-weight: 600; }
#lc .lc-badge-open { background: #d4edda; color: #155724; }
#lc .lc-badge-closed { background: #e9ecef; color: #6c757d; }

#lc .lc-main { flex: 1; display: flex; flex-direction: column; background: #fff; }
#lc .lc-main-header { padding: 14px 20px; border-bottom: 1px solid #e9ecef; display: flex; justify-content: space-between; align-items: center; background: #fff; }
#lc .lc-main-header h6 { margin: 0; font-weight: 700; color: #1a202c; font-size: 0.95rem; }
#lc .lc-main-header small { color: #6c757d; font-size: 0.78rem; }
#lc .lc-msgs { flex: 1; overflow-y: auto; padding: 20px; display: flex; flex-direction: column; gap: 12px; background: #f8f9fa; }
#lc .lc-msg { max-width: 70%; padding: 10px 16px; border-radius: 16px; line-height: 1.45; font-size: 0.88rem; position: relative; word-wrap: break-word; }
#lc .lc-msg.user { align-self: flex-start; background: #fff; color: #1a202c; border: 1px solid #e9ecef; border-bottom-left-radius: 4px; }
#lc .lc-msg.admin { align-self: flex-end; background: #007bff; color: #fff; border-bottom-right-radius: 4px; }
#lc .lc-msg .lc-msg-time { font-size: 0.65rem; margin-top: 6px; display: block; opacity: 0.6; }
#lc .lc-msg.admin .lc-msg-time { text-align: right; }
#lc .lc-empty-msgs { display: flex; align-items: center; justify-content: center; flex: 1; color: #adb5bd; font-size: 0.9rem; flex-direction: column; gap: 8px; }
#lc .lc-input-area { padding: 14px 20px; border-top: 1px solid #e9ecef; display: flex; gap: 8px; background: #fff; }
#lc .lc-input-area input { flex: 1; padding: 10px 16px; border-radius: 24px; border: 1px solid #dee2e6; background: #f8f9fa; color: #1a202c; outline: none; font-size: 0.88rem; }
#lc .lc-input-area input:focus { border-color: #007bff; background: #fff; }
#lc .lc-input-area button { padding: 8px 20px; border-radius: 24px; border: none; background: #007bff; color: #fff; cursor: pointer; font-weight: 600; font-size: 0.85rem; transition: background 0.2s; }
#lc .lc-input-area button:hover { background: #0056b3; }
#lc .lc-input-area button:disabled { opacity: 0.5; cursor: not-allowed; }
#lc .lc-canned-wrap { position: relative; }
#lc .lc-canned-btn { width: 38px !important; height: 38px !important; border-radius: 50% !important; padding: 0 !important; display: flex; align-items: center; justify-content: center; font-size: 1rem !important; }
#lc .lc-canned-menu { position: absolute; bottom: 48px; left: 0; width: 280px; max-height: 260px; overflow-y: auto; background: #fff; border-radius: 8px; box-shadow: 0 4px 20px rgba(0,0,0,0.15); border: 1px solid #e9ecef; z-index: 10; }
#lc .lc-canned-item { padding: 10px 14px; cursor: pointer; font-size: 0.82rem; color: #1a202c; border-bottom: 1px solid #f1f3f5; transition: background 0.15s; }
#lc .lc-canned-item:hover { background: #f8f9fa; }
#lc .lc-canned-item:last-child { border-bottom: none; }
#lc .lc-canned-item small { color: #6c757d; display: block; margin-top: 2px; font-size: 0.75rem; }
#lc .lc-no-session { display: flex; align-items: center; justify-content: center; flex: 1; color: #adb5bd; font-size: 0.95rem; flex-direction: column; gap: 12px; }
#lc .lc-no-session i { font-size: 3rem; color: #dee2e6; }
#lc ::-webkit-scrollbar { width: 5px; }
#lc ::-webkit-scrollbar-track { background: transparent; }
#lc ::-webkit-scrollbar-thumb { background: #dee2e6; border-radius: 10px; }
</style>

<div class="card mt-3">
    <div class="card-header d-flex justify-content-between align-items-center py-2">
        <span><i class="fas fa-comment-dots mr-2"></i> Live Chat</span>
        <div>
            <span class="text-muted small mr-3" id="session_count">0 session</span>
            <button class="btn btn-sm btn-outline-secondary" onclick="toggleAutoScroll()" id="autoscroll_btn">
                <i class="fas fa-arrows-alt-v mr-1"></i> Auto Scroll
            </button>
        </div>
    </div>
    <div class="card-body p-0" id="lc">
        <div class="lc-sidebar">
            <div class="lc-sidebar-header">
                <h6>Percakapan</h6>
                <small>Daftar session chat</small>
                <input type="text" id="lc_search_input" placeholder="Cari nama..." style="width:100%;margin-top:8px;padding:6px 10px;border-radius:6px;border:1px solid #dee2e6;font-size:0.8rem;outline:none;box-sizing:border-box">
            </div>
            <div class="lc-tabs" id="lc_tabs">
                <button class="active" data-filter="open">Aktif</button>
                <button data-filter="closed">Ditutup</button>
                <button data-filter="">Semua</button>
            </div>
            <div class="lc-contacts" id="lc_contacts"></div>
        </div>
        <div class="lc-main">
            <div class="lc-no-session" id="lc_no_session">
                <i class="far fa-comment-dots"></i>
                <span>Pilih percakapan untuk mulai</span>
            </div>
            <div class="lc-main-header" id="lc_main_header" style="display:none">
                <div>
                    <h6 id="lc_header_name"></h6>
                    <small id="lc_header_status"></small>
                </div>
                <div>
                    <button class="btn btn-sm btn-outline-danger" onclick="closeSession()">
                        <i class="fas fa-times mr-1"></i> Tutup
                    </button>
                </div>
            </div>
            <div class="lc-msgs" id="lc_msgs" style="display:none"></div>
            <div id="lc_typing" style="display:none;padding:6px 20px;font-size:0.8rem;color:#6c757d;font-style:italic;background:#f8f9fa;border-top:1px solid #e9ecef"></div>
             <div class="lc-input-area" id="lc_input_area" style="display:none">
                 <div class="lc-canned-wrap">
                     <button class="lc-canned-btn" onclick="toggleCanned()" title="Template balasan">
                         <i class="fas fa-folder-open"></i>
                     </button>
                     <div class="lc-canned-menu" id="lc_canned_menu" style="display:none"></div>
                 </div>
                 <button class="lc-canned-btn" onclick="document.getElementById('lc_file_input').click()" title="Lampirkan file" style="font-size:1rem">
                     <i class="fas fa-paperclip"></i>
                 </button>
                 <input type="text" id="lc_reply_input" placeholder="Ketik pesan..." autocomplete="off">
                 <input type="file" id="lc_file_input" accept="image/*,.pdf,.doc,.docx" style="display:none">
                 <button onclick="sendReply()" id="lc_send_btn">Kirim</button>
             </div>
        </div>
    </div>
</div>

<script>
const API_BASE = '{{ $apiBaseUrl }}';
const API_KEY = '{{ $apiKey }}';
const SSE_BASE = window.location.origin;

let sessions = [], currentId = null, sse = null, autoScroll = true, incomingSound = null, sseRetryDelay = 2000;

function toggleAutoScroll() {
    autoScroll = !autoScroll;
    document.getElementById('autoscroll_btn').innerHTML = '<i class="fas fa-arrows-alt-v mr-1"></i> Auto ' + (autoScroll ? 'ON' : 'OFF');
}

function apiUrl(p) { return API_BASE + '/' + p.replace(/^\//, ''); }

async function apiFetch(url, opts = {}) {
    const h = { 'Accept': 'application/json', 'X-API-Key': API_KEY };
    if (opts.body && !(opts.body instanceof FormData)) h['Content-Type'] = 'application/x-www-form-urlencoded';
    const r = await fetch(url, { ...opts, headers: h });
    return r.json();
}

function closeSSE() { if (sse) { sse.close(); sse = null; } }

function connectAdminSSE(id) {
    closeSSE();
    const url = SSE_BASE + '/admin-chat-sse/' + id;
    sse = new EventSource(url);
    sse.addEventListener('message', function(e) {
        sseRetryDelay = 2000;
        const m = JSON.parse(e.data);
        if (m.sender_type === 'user' && currentId === m.session_id) {
            if (m.id > lastMsgId) {
                lastMsgId = m.id;
                appendMessage(m, 'user');
                playNotifSound();
                flashTitle('Pesan baru dari ' + currentName);
            }
        } else if (m.sender_type === 'admin') {
            if (m.id > lastMsgId) {
                lastMsgId = m.id;
            }
        }
    });
    sse.addEventListener('typing', function(e) {
        const d = JSON.parse(e.data);
        const el = document.getElementById('lc_typing');
        if (d.typing && d.text) {
            el.innerHTML = '<em>' + escHtml(d.text) + '</em>';
            el.style.display = 'block';
        } else if (d.typing && !d.text) {
            el.innerHTML = '<em>Sedang mengetik...</em>';
            el.style.display = 'block';
        } else {
            el.style.display = 'none';
        }
    });
    sse.onerror = function() {
        sse.close();
        setTimeout(function() { if (currentId) connectAdminSSE(currentId); }, sseRetryDelay);
        sseRetryDelay = Math.min(sseRetryDelay * 1.5, 30000);
    };
}

function loadSessions(filter) {
    if (!filter) {
        const activeTab = document.querySelector('#lc_tabs .active');
        filter = activeTab ? activeTab.dataset.filter : 'open';
    }
    let url = apiUrl('admin/chat/sessions');
    if (filter) url += '?status=' + filter;
    apiFetch(url).then(r => {
        if (!r.success) return;
        sessions = r.data || [];
        renderSessions();
        document.getElementById('session_count').textContent = sessions.length + ' session';
    });
}

const AVATAR_COLORS = ['#007bff','#e83e8c','#dc3545','#fd7e14','#ffc107','#28a745','#17a2b8','#6f42c1'];

function getInitialColor(name) {
    let hash = 0;
    for (let i = 0; i < (name||'').length; i++) hash = name.charCodeAt(i) + ((hash << 5) - hash);
    return AVATAR_COLORS[Math.abs(hash) % AVATAR_COLORS.length];
}

function getInitials(name) {
    if (!name) return '?';
    const parts = name.trim().split(/\s+/);
    return parts.length > 1 ? (parts[0][0] + parts[1][0]).toUpperCase() : parts[0].substring(0, 2).toUpperCase();
}

function timeAgo(dateStr) {
    if (!dateStr) return '';
    const diff = Date.now() - new Date(dateStr).getTime();
    const mins = Math.floor(diff / 60000);
    if (mins < 1) return 'baru saja';
    if (mins < 60) return mins + 'm';
    const hrs = Math.floor(mins / 60);
    if (hrs < 24) return hrs + 'j';
    const days = Math.floor(hrs / 24);
    return days + 'h';
}

function renderSessions() {
    const container = document.getElementById('lc_contacts');
    const activeTab = document.querySelector('#lc_tabs .active');
    const filter = activeTab ? activeTab.dataset.filter : 'open';
    const filtered = filter ? sessions.filter(s => s.status === filter) : sessions;
    container.innerHTML = '';
    if (filtered.length === 0) {
        container.innerHTML = '<div style="padding:2rem;text-align:center;color:#adb5bd;font-size:0.85rem;">Belum ada percakapan</div>';
        return;
    }
    filtered.forEach(s => {
        const div = document.createElement('div');
        div.className = 'lc-contact' + (s.id === currentId ? ' active' : '');
        div.innerHTML =
            '<div class="lc-avatar" style="background:' + getInitialColor(s.name) + ';color:#fff">' + getInitials(s.name) + '</div>' +
            '<div class="lc-contact-info">' +
                '<div class="lc-contact-top">' +
                    '<span class="lc-contact-name">' + escHtml(s.name) + '</span>' +
                    '<div class="lc-contact-meta">' +
                        '<span class="lc-badge ' + (s.status === 'open' ? 'lc-badge-open' : 'lc-badge-closed') + '">' + s.status + '</span>' +
                        '<span class="lc-contact-time">' + timeAgo(s.last_activity) + '</span>' +
                    '</div>' +
                '</div>' +
                '<div class="lc-contact-preview">' + escHtml(s.last_message || 'Belum ada pesan') + (s.rating ? ' \u2B50' + s.rating : '') + '</div>' +
            '</div>';
        div.onclick = function() { selectSession(s.id); };
        container.appendChild(div);
    });
}

document.getElementById('lc_tabs').addEventListener('click', function(e) {
    const btn = e.target.closest('button');
    if (!btn) return;
    this.querySelectorAll('button').forEach(b => b.classList.remove('active'));
    btn.classList.add('active');
    loadSessions(btn.dataset.filter);
});

    document.getElementById('lc_reply_input').addEventListener('keydown', function(e) {
        if (e.key === 'Enter') sendReply();
    });

    let adminTypingTimer = null;
    document.getElementById('lc_reply_input').addEventListener('input', function() {
        clearTimeout(adminTypingTimer);
        if (!currentId) return;
        apiFetch(apiUrl('admin/chat/typing/' + currentId), { method: 'POST', body: '' });
        adminTypingTimer = setTimeout(function() {
            // typing expires naturally via SSE (3s timeout)
        }, 3000);
    });

let lastMsgId = 0;

function selectSession(id) {
    const s = sessions.find(x => x.id === id);
    if (!s) return;
    currentId = id;
    lastMsgId = 0;
    renderSessions();
    document.getElementById('lc_no_session').style.display = 'none';
    document.getElementById('lc_main_header').style.display = 'flex';
    document.getElementById('lc_msgs').style.display = 'flex';
    document.getElementById('lc_input_area').style.display = s.status === 'open' ? 'flex' : 'none';
    document.getElementById('lc_header_name').textContent = s.name;
    document.getElementById('lc_header_status').textContent = (s.email ? s.email + ' \u00b7 ' : '') + (s.messages_count || 0) + ' pesan' + (s.status === 'closed' ? ' \u00b7 Ditutup' : '');
    document.getElementById('lc_msgs').innerHTML = '';
    closeSSE();
    loadMessages(id).then(function() {
        if (s.status === 'open') connectAdminSSE(id);
    });
    document.getElementById('lc_reply_input').focus();
}

function loadMessages(id) {
    return apiFetch(apiUrl('admin/chat/messages/' + id)).then(r => {
        if (!r.success) return;
        const msgs = r.data.messages || [];
        const container = document.getElementById('lc_msgs');
        container.innerHTML = '';
        msgs.forEach(m => {
            appendMessage(m, m.sender_type);
            if (m.id > lastMsgId) lastMsgId = m.id;
        });
        if (autoScroll) scrollBottom();
    });
}

function appendMessage(m, type) {
    const container = document.getElementById('lc_msgs');
    const d = document.createElement('div');
    d.className = 'lc-msg ' + type;
    const text = document.createElement('span');
    text.innerHTML = linkify(m.message || '');
    d.appendChild(text);
    if (m.attachment) {
        const a = document.createElement('div');
        a.style.marginTop = '6px';
        if (m.attachment_type && m.attachment_type.startsWith('image/')) {
            const img = document.createElement('img');
            img.src = m.attachment; img.style.maxWidth = '100%'; img.style.borderRadius = '8px'; img.style.cursor = 'pointer';
            img.onclick = function() { window.open(m.attachment); };
            a.appendChild(img);
        } else {
            const lnk = document.createElement('a');
            lnk.href = m.attachment; lnk.target = '_blank'; lnk.textContent = '\uD83D\uDCCE ' + (m.attachment.split('/').pop() || 'File');
            a.appendChild(lnk);
        }
        d.appendChild(a);
    }
    const t = document.createElement('span');
    t.className = 'lc-msg-time';
    t.textContent = m.created_at ? formatTime(m.created_at) : '';
    d.appendChild(t);
    container.appendChild(d);
    if (autoScroll) scrollBottom();
}

function formatTime(dateStr) {
    const d = new Date(dateStr);
    return d.toLocaleDateString() + ' ' + d.toLocaleTimeString([], { hour: '2-digit', minute: '2-digit' });
}

function linkify(text) {
    if (!text) return '';
    return text.replace(/(https?:\/\/[^\s<]+)/g, '<a href="$1" target="_blank" rel="noopener" style="color:inherit;text-decoration:underline">$1</a>');
}

function scrollBottom() {
    const c = document.getElementById('lc_msgs');
    requestAnimationFrame(function() { c.scrollTop = c.scrollHeight; });
}

function sendReply() {
    const input = document.getElementById('lc_reply_input');
    const msg = input.value.trim();
    const fileInput = document.getElementById('lc_file_input');
    const file = fileInput.files[0];
    if ((!msg || !msg.trim()) && !file) return;
    if (!currentId) return;
    const btn = document.getElementById('lc_send_btn');
    btn.disabled = true;

    if (file) {
        const form = new FormData();
        form.append('file', file);
        apiFetch(apiUrl('admin/chat/upload/' + currentId), { method: 'POST', body: form })
            .then(r => {
                btn.disabled = false;
                if (r.success) {
                    fileInput.value = '';
                    appendMessage({ message: r.data.message || '', sender_type: 'admin', created_at: new Date().toISOString(), attachment: r.data.url, attachment_type: file.type }, 'admin');
                }
            });
        return;
    }

    apiFetch(apiUrl('admin/chat/reply/' + currentId), { method: 'POST', body: 'message=' + encodeURIComponent(msg) })
        .then(r => {
            btn.disabled = false;
            if (r.success) {
                input.value = '';
                appendMessage({ message: msg, sender_type: 'admin', created_at: new Date().toISOString() }, 'admin');
            } else {
                alert('Gagal: ' + (r.message || 'unknown'));
            }
        }).catch(function() { btn.disabled = false; });
}

function closeSession() {
    if (!currentId || !confirm('Tutup percakapan ini?')) return;
    apiFetch(apiUrl('admin/chat/close/' + currentId), { method: 'POST' }).then(r => {
        if (r.success) {
            closeSSE(); currentId = null;
            document.getElementById('lc_no_session').style.display = 'flex';
            document.getElementById('lc_main_header').style.display = 'none';
            document.getElementById('lc_msgs').style.display = 'none';
            document.getElementById('lc_input_area').style.display = 'none';
            loadSessions();
        }
    });
}

const CANNED = [
    { title: 'Salam pembuka', text: 'Halo, ada yang bisa kami bantu?' },
    { title: 'Mohon tunggu', text: 'Mohon tunggu sebentar ya, akan kami cek terlebih dahulu.' },
    { title: 'Terima kasih', text: 'Terima kasih telah menghubungi kami. Ada lagi yang bisa dibantu?' },
    { title: 'Info deposit', text: 'Untuk deposit, silakan transfer ke rekening yang tertera di halaman deposit. Konfirmasi setelah transfer.' },
    { title: 'Info withdraw', text: 'Penarikan dana diproses maksimal 1x24 jam. Silakan cek status di halaman withdraw.' },
    { title: 'Kendala login', text: 'Coba clear cache browser atau gunakan link alternatif. Jika masih terkendala, reset password di halaman lupa sandi.' },
    { title: 'Tutup chat', text: 'Baik, jika tidak ada pertanyaan lagi chat akan kami tutup. Terima kasih!' },
];

function toggleCanned() {
    const menu = document.getElementById('lc_canned_menu');
    if (menu.style.display === 'block') { menu.style.display = 'none'; return; }
    if (!menu.hasChildNodes()) {
        CANNED.forEach(function(c) {
            const div = document.createElement('div');
            div.className = 'lc-canned-item';
            div.innerHTML = c.text + '<small>' + c.title + '</small>';
            div.onclick = function() {
                document.getElementById('lc_reply_input').value = c.text;
                document.getElementById('lc_reply_input').focus();
                menu.style.display = 'none';
            };
            menu.appendChild(div);
        });
    }
    menu.style.display = 'block';
}

document.addEventListener('click', function(e) {
    if (!e.target.closest('.lc-canned-wrap')) {
        document.getElementById('lc_canned_menu').style.display = 'none';
    }
});

function playNotifSound() {
    try {
        const ctx = new (window.AudioContext || window.webkitAudioContext)();
        const osc = ctx.createOscillator();
        const gain = ctx.createGain();
        osc.connect(gain); gain.connect(ctx.destination);
        osc.frequency.value = 660; osc.type = 'sine';
        gain.gain.setValueAtTime(0.25, ctx.currentTime);
        gain.gain.exponentialRampToValueAtTime(0.01, ctx.currentTime + 0.12);
        osc.start(ctx.currentTime); osc.stop(ctx.currentTime + 0.12);
    } catch(e) {}
}

let lcTitleTimer = null;
function flashTitle(msg) {
    const orig = document.title;
    clearTimeout(lcTitleTimer);
    let flash = true;
    lcTitleTimer = setInterval(function() {
        document.title = flash ? msg + ' | ' + orig : orig;
        flash = !flash;
    }, 1000);
    setTimeout(function() { clearInterval(lcTitleTimer); document.title = orig; }, 5000);
}

function escHtml(s) {
    if (!s) return '';
    return s.replace(/&/g,'&amp;').replace(/</g,'&lt;').replace(/>/g,'&gt;').replace(/"/g,'&quot;');
}

loadSessions('open');
setInterval(function() { loadSessions(); }, 10000);

// File input for admin
document.getElementById('lc_file_input').addEventListener('change', function() {
    if (this.files[0]) sendReply();
});

// Search sessions
let searchTimer = null;
document.getElementById('lc_search_input').addEventListener('input', function() {
    clearTimeout(searchTimer);
    const q = this.value.toLowerCase();
    searchTimer = setTimeout(function() {
        document.querySelectorAll('.lc-contact').forEach(function(el) {
            const name = (el.querySelector('.lc-contact-name') || {}).textContent || '';
            el.style.display = name.toLowerCase().includes(q) ? 'flex' : 'none';
        });
    }, 200);
});

window.addEventListener('beforeunload', function() { closeSSE(); });
</script>
@endsection
