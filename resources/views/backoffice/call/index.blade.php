@extends('backoffice.layouts.main')

@section('content')
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<style>
.modal-body { max-height: 80vh; overflow-y: auto; }
.call-tab { cursor: pointer; }
.call-table th { white-space: nowrap; }
.badge-status-0 { background:#ffc107; } /* waiting */
.badge-status-1 { background:#007bff; } /* processing */
.badge-status-2 { background:#28a745; } /* finished */
.badge-status-3 { background:#dc3545; } /* rejected */
.badge-status-4 { background:#6c757d; } /* canceled */
</style>

<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title"><i class="fas fa-phone mr-2"></i> Call Management</h4>
                    <div class="card-tools">
                        <button class="btn btn-sm btn-info mr-1" onclick="refreshPlayers()"><i class="fas fa-sync mr-1"></i> Refresh Players</button>
                        <button class="btn btn-sm btn-secondary" onclick="refreshHistory()"><i class="fas fa-sync mr-1"></i> Refresh History</button>
                    </div>
                </div>
                <div class="card-body">
                    <ul class="nav nav-tabs" id="callTabs" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" id="players-tab" data-toggle="tab" href="#players" role="tab">Current Players</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="history-tab" data-toggle="tab" href="#history" role="tab">Call History</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="rtp-tab" data-toggle="tab" href="#rtp" role="tab">RTP Control</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="gamelog-tab" data-toggle="tab" href="#gamelog" role="tab">Game Log</a>
                        </li>
                    </ul>

                    <div class="tab-content mt-3">
                        {{-- TAB 1: CURRENT PLAYERS --}}
                        <div class="tab-pane fade show active" id="players" role="tabpanel">
                            <div class="table-responsive">
                                <table class="table table-bordered table-hover" id="playersTable">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Username</th>
                                            <th>Provider</th>
                                            <th>Game Code</th>
                                            <th>Bet</th>
                                            <th>Balance</th>
                                            <th>Total Debit</th>
                                            <th>Total Credit</th>
                                            <th>Target RTP</th>
                                            <th>Real RTP</th>
                                            <th class="text-right">Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse($players as $p)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td><strong>{{ $p['user_code'] ?? '-' }}</strong></td>
                                            <td>{{ $p['provider_code'] ?? '-' }}</td>
                                            <td>{{ $p['game_code'] ?? '-' }}</td>
                                            <td>{{ number_format($p['bet'] ?? 0, 2) }}</td>
                                            <td>{{ number_format($p['balance'] ?? 0, 2) }}</td>
                                            <td>{{ number_format($p['total_debit'] ?? 0, 2) }}</td>
                                            <td>{{ number_format($p['total_credit'] ?? 0, 2) }}</td>
                                            <td>{{ $p['target_rtp'] ?? '-' }}</td>
                                            <td>{{ $p['real_rtp'] ?? '-' }}</td>
                                            <td class="text-right">
                                                <button class="btn btn-success btn-sm set-call-btn"
                                                        data-provider="{{ $p['provider_code'] }}"
                                                        data-gamecode="{{ $p['game_code'] }}"
                                                        data-username="{{ $p['user_code'] }}"
                                                        data-bet="{{ $p['bet'] ?? 0 }}">
                                                    Set Call
                                                </button>
                                            </td>
                                        </tr>
                                        @empty
                                        <tr><td colspan="11" class="text-center text-muted">Tidak ada player aktif</td></tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div>

                        {{-- TAB 2: CALL HISTORY --}}
                        <div class="tab-pane fade" id="history" role="tabpanel">
                            <div class="table-responsive">
                                <table class="table table-bordered table-hover" id="historyTable">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>User</th>
                                            <th>Provider</th>
                                            <th>Game</th>
                                            <th>Bet</th>
                                            <th>Expect</th>
                                            <th>Real</th>
                                            <th>Missed</th>
                                            <th>RTP</th>
                                            <th>Type</th>
                                            <th>Status</th>
                                            <th>Waktu</th>
                                            <th class="text-right">Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse($callHistory as $h)
                                        <tr>
                                            <td>{{ $h['id'] ?? '-' }}</td>
                                            <td>{{ $h['user_code'] ?? '-' }}</td>
                                            <td>{{ $h['provider_code'] ?? '-' }}</td>
                                            <td>{{ $h['game_code'] ?? '-' }}</td>
                                            <td>{{ number_format($h['bet'] ?? 0, 2) }}</td>
                                            <td>{{ number_format($h['expect'] ?? 0, 2) }}</td>
                                            <td>{{ number_format($h['real'] ?? 0, 2) }}</td>
                                            <td>{{ number_format($h['missed'] ?? 0, 2) }}</td>
                                            <td>{{ $h['rtp'] ?? '-' }}</td>
                                            <td>{{ $h['type'] ?? '-' }}</td>
                                            <td>
                                                @php $s = $h['status'] ?? -1; @endphp
                                                <span class="badge badge-status-{{ $s }}">
                                                    @switch($s)
                                                        @case(0) Waiting @break
                                                        @case(1) Processing @break
                                                        @case(2) Finished @break
                                                        @case(3) Rejected @break
                                                        @case(4) Canceled @break
                                                        @default Unknown
                                                    @endswitch
                                                </span>
                                            </td>
                                            <td>{{ $h['created_at'] ?? '-' }}</td>
                                            <td class="text-right">
                                                @if(($h['status'] ?? -1) === 0)
                                                <button class="btn btn-danger btn-sm cancel-call-btn" data-call-id="{{ $h['id'] }}">Cancel</button>
                                                @else
                                                <span class="text-muted">-</span>
                                                @endif
                                            </td>
                                        </tr>
                                        @empty
                                        <tr><td colspan="13" class="text-center text-muted">Belum ada history</td></tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                            <div class="mt-2">
                                <button class="btn btn-sm btn-outline-primary" onclick="loadMoreHistory()">Load More</button>
                                <span class="text-muted ml-2" id="historyOffset" data-offset="50">Menampilkan 50 terakhir</span>
                            </div>
                        </div>

                        {{-- TAB 3: RTP CONTROL --}}
                        <div class="tab-pane fade" id="rtp" role="tabpanel">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="card card-primary">
                                        <div class="card-header"><h5>Control RTP - Single User</h5></div>
                                        <div class="card-body">
                                            <div class="form-group">
                                                <label>Provider</label>
                                                <select class="form-control" id="rtpProvider">
                                                    <option value="">-- Pilih Provider --</option>
                                                    @foreach($providers as $pr)
                                                    <option value="{{ $pr['provider_code'] ?? $pr }}">
                                                        {{ $pr['provider_name'] ?? $pr['provider_code'] ?? $pr }}
                                                    </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <label>Username</label>
                                                <input type="text" class="form-control" id="rtpUsername" placeholder="Username">
                                            </div>
                                            <div class="form-group">
                                                <label>Target RTP (0 - 999)</label>
                                                <input type="number" class="form-control" id="rtpValue" placeholder="Contoh: 92" min="0" max="999">
                                            </div>
                                            <button class="btn btn-primary btn-block" onclick="applySingleRtp()">Apply RTP</button>
                                            <div id="rtpSingleResult" class="mt-2"></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="card card-warning">
                                        <div class="card-header"><h5>Control RTP - Bulk Users</h5></div>
                                        <div class="card-body">
                                            <div class="form-group">
                                                <label>Usernames (pisahkan dengan koma)</label>
                                                <textarea class="form-control" id="rtpBulkUsernames" rows="3" placeholder="user1,user2,user3"></textarea>
                                            </div>
                                            <div class="form-group">
                                                <label>Target RTP (0 - 999)</label>
                                                <input type="number" class="form-control" id="rtpBulkValue" placeholder="Contoh: 92" min="0" max="999">
                                            </div>
                                            <button class="btn btn-warning btn-block" onclick="applyBulkRtp()">Apply RTP to All</button>
                                            <div id="rtpBulkResult" class="mt-2"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        {{-- TAB 4: GAME LOG --}}
                        <div class="tab-pane fade" id="gamelog" role="tabpanel">
                            <div class="row mb-3 align-items-end">
                                <div class="col-md-2">
                                    <label>Tanggal Mulai</label>
                                    <input type="date" class="form-control form-control-sm" id="logDateStart" value="{{ date('Y-m-d') }}">
                                </div>
                                <div class="col-md-2">
                                    <label>Tanggal Akhir</label>
                                    <input type="date" class="form-control form-control-sm" id="logDateEnd" value="{{ date('Y-m-d') }}">
                                </div>
                                <div class="col-md-3">
                                    <label>User</label>
                                    <select class="form-control form-control-sm" id="logUser">
                                        <option value="">Semua User</option>
                                        @foreach($users as $u)
                                        @php $uObj = is_object($u) ? $u : (object) $u; @endphp
                                        <option value="{{ $uObj->username }}">{{ $uObj->username }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-auto">
                                    <button class="btn btn-success btn-sm" onclick="searchGameLog()"><i class="fa fa-search"></i> Cari</button>
                                </div>
                            </div>
                            <div id="gameLogResult">
                                <p class="text-muted">Pilih user & tanggal lalu klik Cari.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- MODAL CALL APPLY --}}
<div class="modal fade" id="callApplyModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header bg-dark text-white">
                <h5 class="modal-title">Call Apply</h5>
                <button type="button" class="close text-white" data-dismiss="modal"><span>&times;</span></button>
            </div>
            <div class="modal-body">
                <input type="hidden" id="caProvider">
                <input type="hidden" id="caGameCode">
                <input type="hidden" id="caUsername">
                <div class="alert alert-info py-2">
                    <strong>Player:</strong> <span id="caDisplayUser"></span><br>
                    <strong>Current Bet:</strong> <span id="caDisplayBet"></span>
                </div>
                <div class="form-group">
                    <label>Win Amount (Target)</label>
                    <input type="number" class="form-control" id="caWinAmount" placeholder="Klik badge Available Calls" step="0.01" required>
                    <small class="text-warning">Gunakan nilai dari tombol "Available Calls" — isi manual di luar daftar akan ditolak.</small>
                </div>
                <div class="form-group">
                    <label>Call Type</label>
                    <select class="form-control" id="caCallType">
                        <option value="normal">Normal Call (1)</option>
                        <option value="buy">Buy Call (2)</option>
                    </select>
                </div>
                <div class="mb-2">
                    <button type="button" class="btn btn-info btn-sm" onclick="fetchCallList()">📋 Available Calls</button>
                    <div id="caCallListResult" class="mt-2"></div>
                </div>
                <div id="caResult"></div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                <button type="button" class="btn btn-success px-4" id="caApplyBtn" onclick="doCallApply()">Apply Call</button>
            </div>
        </div>
    </div>
</div>

 <script>
const CSRF = '{{ csrf_token() }}';
$.ajaxSetup({ headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') } });

function errMsg(jqXHR) {
    let detail = 'HTTP ' + (jqXHR.status || '?');
    if (jqXHR.responseJSON && jqXHR.responseJSON.message) detail += ': ' + jqXHR.responseJSON.message;
    else if (jqXHR.responseText) {
        try {
            const j = JSON.parse(jqXHR.responseText);
            if (j && j.message) detail += ': ' + j.message;
        } catch (e) {
            const t = jqXHR.responseText.replace(/<[^>]*>/g, ' ').replace(/\s+/g, ' ').trim();
            if (t && t.length < 300) detail += ': ' + t;
        }
    }
    return detail;
}

// ======== SET CALL (OPEN MODAL) ========
$(document).on('click', '.set-call-btn', function() {
    $('#caProvider').val($(this).data('provider'));
    $('#caGameCode').val($(this).data('gamecode'));
    $('#caUsername').val($(this).data('username'));
    $('#caDisplayUser').text($(this).data('username'));
    $('#caDisplayBet').text($(this).data('bet'));
    $('#caWinAmount').val('');
    $('#caCallType').val('normal');
    $('#caResult').html('');
    $('#caCallListResult').html('');
    $('#callApplyModal').modal('show');
    fetchCallList();
});

// ======== CALL APPLY ========
function doCallApply() {
    const data = {
        _token: CSRF,
        provider: $('#caProvider').val(),
        game_code: $('#caGameCode').val(),
        username: $('#caUsername').val(),
        win_amount: $('#caWinAmount').val(),
        call_type: $('#caCallType').val(),
    };

    if (!data.win_amount || parseFloat(data.win_amount) <= 0) {
        alert('Pilih nilai dari tombol Available Calls!'); return;
    }

    const $btn = $('#caApplyBtn');
    $btn.prop('disabled', true).html('<i class="fas fa-spinner fa-spin"></i> Processing...');

    $.post('{{ URL::to("Admin/Dashboard/Call/apply") }}', data, function(res) {
        if (res.status === 'success') {
            let msg = '✅ Call berhasil!';
            if (res.data && res.data.called_money) msg += '\nCalled Money: ' + res.data.called_money;
            $('#caResult').html('<div class="alert alert-success">' + msg + '</div>');
            setTimeout(function() {
                $('#callApplyModal').modal('hide');
                refreshPlayers();
                refreshHistory();
            }, 1500);
        } else {
            $('#caResult').html('<div class="alert alert-danger">❌ ' + (res.msg || 'Gagal') + '</div>');
        }
    }).fail(function(jqXHR) {
        $('#caResult').html('<div class="alert alert-danger">❌ ' + errMsg(jqXHR) + '</div>');
    }).always(function() {
        $btn.prop('disabled', false).html('Apply Call');
    });
}

// ======== CALL LIST ========
function fetchCallList() {
    const provider = $('#caProvider').val();
    const gameCode = $('#caGameCode').val();

    if (!provider || !gameCode) { alert('Data provider/game tidak lengkap.'); return; }

    $.post('{{ URL::to("Admin/Dashboard/Call/call-list") }}', {
        _token: CSRF,
        provider: provider,
        game_code: gameCode,
    }, function(res) {
        if (res.status === 'success' && res.data && res.data.calls) {
            const calls = res.data.calls;
            const hasBuy = calls.some(function(c) {
                return String(c.call_type || '').toLowerCase().indexOf('buy') !== -1;
            });

            const $buyOpt = $('#caCallType option[value="buy"]');
            if (hasBuy) {
                $buyOpt.prop('disabled', false).text('Buy Call (2)');
            } else {
                $buyOpt.prop('disabled', true).text('Buy Call (2) - game tidak punya fitur Buy');
            }

            let html = '<div class="card card-body p-2 bg-dark text-white"><small><strong>Available Calls:</strong><br>';
            calls.forEach(function(c, i) {
                html += `<span class="badge badge-info mr-1 mb-1 call-option" style="cursor:pointer" data-rtp="${c.rtp}">${c.call_type}: ${c.rtp}</span>`;
            });
            html += '</small></div>';
            $('#caCallListResult').html(html);
        } else {
            $('#caCallListResult').html('<div class="alert alert-warning py-1 px-2 mb-0"><small>Tidak ada call tersedia.</small></div>');
        }
    }).fail(function(jqXHR) {
        $('#caCallListResult').html('<div class="alert alert-danger py-1 px-2 mb-0"><small>❌ ' + errMsg(jqXHR) + '</small></div>');
    });
}

$(document).on('click', '.call-option', function() {
    $('#caWinAmount').val($(this).data('rtp'));
});

// ======== CANCEL CALL ========
$(document).on('click', '.cancel-call-btn', function() {
    if (!confirm('Yakin cancel call ID ' + $(this).data('call-id') + '?')) return;

    const $btn = $(this);
    $btn.prop('disabled', true).html('<i class="fas fa-spinner fa-spin"></i>');

    $.post('{{ URL::to("Admin/Dashboard/Call/cancel") }}', {
        _token: CSRF,
        call_id: $btn.data('call-id'),
    }, function(res) {
        if (res.status === 'success') {
            alert('✅ Call canceled!');
            refreshHistory();
        } else {
            alert('❌ ' + (res.msg || 'Gagal'));
            $btn.prop('disabled', false).html('Cancel');
        }
    }).fail(function(jqXHR) {
        alert('❌ ' + errMsg(jqXHR));
        $btn.prop('disabled', false).html('Cancel');
    });
});

// ======== REFRESH PLAYERS ========
function refreshPlayers() {
    $.get('{{ URL::to("Admin/Dashboard/Call/players") }}', function(res) {
        if (res.status === 'success' && res.data && res.data.data) {
            const tbody = $('#playersTable tbody');
            tbody.empty();
            (res.data.data || []).forEach(function(p, i) {
                tbody.append(`
                    <tr>
                        <td>${i+1}</td>
                        <td><strong>${p.user_code || '-'}</strong></td>
                        <td>${p.provider_code || '-'}</td>
                        <td>${p.game_code || '-'}</td>
                        <td>${(p.bet || 0).toLocaleString()}</td>
                        <td>${(p.balance || 0).toLocaleString()}</td>
                        <td>${(p.total_debit || 0).toLocaleString()}</td>
                        <td>${(p.total_credit || 0).toLocaleString()}</td>
                        <td>${p.target_rtp ?? '-'}</td>
                        <td>${p.real_rtp ?? '-'}</td>
                        <td class="text-right">
                            <button class="btn btn-success btn-sm set-call-btn"
                                data-provider="${p.provider_code}"
                                data-gamecode="${p.game_code}"
                                data-username="${p.user_code}"
                                data-bet="${p.bet || 0}">Set Call</button>
                        </td>
                    </tr>
                `);
            });
            if (!res.data.data || !res.data.data.length) {
                tbody.html('<tr><td colspan="11" class="text-center text-muted">Tidak ada player aktif</td></tr>');
            }
        }
    }).fail(function(jqXHR) {
        $('#playersTable tbody').html('<tr><td colspan="11" class="text-center text-danger">Error: ' + errMsg(jqXHR) + '</td></tr>');
    });
}

// ======== REFRESH HISTORY ========
function refreshHistory() {
    $.get('{{ URL::to("Admin/Dashboard/Call/history") }}', { offset: 0, limit: 50 }, function(res) {
        if (res.status === 'success' && res.data && res.data.data) {
            renderHistory(res.data.data);
            $('#historyOffset').data('offset', 50).text('Menampilkan 50 terakhir');
        }
    }).fail(function(jqXHR) {
        $('#historyTable tbody').html('<tr><td colspan="13" class="text-center text-danger">Error: ' + errMsg(jqXHR) + '</td></tr>');
    });
}

function loadMoreHistory() {
    const offset = $('#historyOffset').data('offset');
    $.get('{{ URL::to("Admin/Dashboard/Call/history") }}', { offset: offset, limit: 50 }, function(res) {
        if (res.status === 'success' && res.data && res.data.data && res.data.data.length) {
            const tbody = $('#historyTable tbody');
            (res.data.data).forEach(function(h) {
                tbody.append(historyRow(h));
            });
            $('#historyOffset').data('offset', offset + 50).text('Menampilkan ' + (offset + 50) + ' terakhir');
        } else {
            alert('Tidak ada data lagi.');
        }
    });
}

function renderHistory(data) {
    const tbody = $('#historyTable tbody');
    tbody.empty();
    data.forEach(function(h) { tbody.append(historyRow(h)); });
}

function historyRow(h) {
    const s = h.status ?? -1;
    let badge = 'Unknown';
    if (s === 0) badge = 'Waiting';
    else if (s === 1) badge = 'Processing';
    else if (s === 2) badge = 'Finished';
    else if (s === 3) badge = 'Rejected';
    else if (s === 4) badge = 'Canceled';

    let cancelBtn = '<span class="text-muted">-</span>';
    if (s === 0) cancelBtn = `<button class="btn btn-danger btn-sm cancel-call-btn" data-call-id="${h.id}">Cancel</button>`;

    return `<tr>
        <td>${h.id || '-'}</td>
        <td>${h.user_code || '-'}</td>
        <td>${h.provider_code || '-'}</td>
        <td>${h.game_code || '-'}</td>
        <td>${(h.bet || 0).toLocaleString()}</td>
        <td>${(h.expect || 0).toLocaleString()}</td>
        <td>${(h.real || 0).toLocaleString()}</td>
        <td>${(h.missed || 0).toLocaleString()}</td>
        <td>${h.rtp ?? '-'}</td>
        <td>${h.type ?? '-'}</td>
        <td><span class="badge badge-status-${s}">${badge}</span></td>
        <td>${h.created_at || '-'}</td>
        <td class="text-right">${cancelBtn}</td>
    </tr>`;
}

// ======== RTP SINGLE ========
function applySingleRtp() {
    const provider = $('#rtpProvider').val();
    const username = $('#rtpUsername').val();
    const rtp = $('#rtpValue').val();

    if (!provider || !username || !rtp) { alert('Semua field harus diisi!'); return; }

    $.post('{{ URL::to("Admin/Dashboard/Call/control-rtp") }}', {
        _token: CSRF, provider: provider, username: username, rtp: rtp,
    }, function(res) {
        if (res.status === 'success') {
            $('#rtpSingleResult').html('<div class="alert alert-success">✅ RTP berhasil diubah menjadi ' + rtp + '</div>');
        } else {
            $('#rtpSingleResult').html('<div class="alert alert-danger">❌ ' + (res.msg || 'Gagal') + '</div>');
        }
    }).fail(function(jqXHR) {
        $('#rtpSingleResult').html('<div class="alert alert-danger">❌ ' + errMsg(jqXHR) + '</div>');
    });
}

// ======== RTP BULK ========
function applyBulkRtp() {
    const usernames = $('#rtpBulkUsernames').val();
    const rtp = $('#rtpBulkValue').val();

    if (!usernames || !rtp) { alert('Semua field harus diisi!'); return; }

    $.post('{{ URL::to("Admin/Dashboard/Call/control-users-rtp") }}', {
        _token: CSRF, usernames: usernames, rtp: rtp,
    }, function(res) {
        if (res.status === 'success') {
            $('#rtpBulkResult').html('<div class="alert alert-success">✅ RTP bulk berhasil diubah menjadi ' + rtp + '</div>');
        } else {
            $('#rtpBulkResult').html('<div class="alert alert-danger">❌ ' + (res.msg || 'Gagal') + '</div>');
        }
    }).fail(function(jqXHR) {
        $('#rtpBulkResult').html('<div class="alert alert-danger">❌ ' + errMsg(jqXHR) + '</div>');
    });
}
</script>
<script>
// ======== GAME LOG ========
function searchGameLog() {
    var user = $('#logUser').val();
    if (!user) { alert('Pilih user'); return; }

    $('#gameLogResult').html('<p class="text-muted"><i class="fas fa-spinner fa-spin"></i> Loading...</p>');

    $.post('{{ URL::to("Admin/Dashboard/Call/game-log") }}', {
        _token: CSRF,
        date_start: $('#logDateStart').val(),
        date_end: $('#logDateEnd').val(),
        extplayer: user,
    }, function(res) {
        var rows = res.data || [];
        if (rows.length) {
            var html = '<div class="table-responsive"><table class="table table-bordered table-hover" id="gameLogTable"><thead><tr><th>Game</th><th>Provider</th><th>Bet</th><th>Win</th><th>User</th><th>Txn ID</th><th>Waktu</th><th>Aksi</th></tr></thead><tbody>';
            rows.forEach(function(d) {
                html += '<tr><td>' + (d.game_code||'-') + '</td><td>' + (d.provider_code||'-') + '</td><td>' + Number(d.bet_money||0).toLocaleString() + '</td><td>' + Number(d.win_money||0).toLocaleString() + '</td><td>' + (d.user_code||'-') + '</td><td>' + (d.txn_id||'-') + '</td><td>' + (d.created_at||'-') + '</td><td><button class="btn btn-sm btn-info" onclick="viewGameHistory(\'' + (d.user_code||'') + '\',\'' + (d.provider_code||'') + '\',\'' + (d.game_code||'') + '\')"><i class="fas fa-history"></i></button></td></tr>';
            });
            html += '</tbody></table></div>';
            $('#gameLogResult').html(html);
            if ($.fn.DataTable) $('#gameLogTable').DataTable({ paging: true, ordering: true });
        } else {
            $('#gameLogResult').html('<div class="alert alert-info">Tidak ada data</div>');
        }
    }).fail(function(jqXHR) {
        $('#gameLogResult').html('<div class="alert alert-danger">Gagal: ' + errMsg(jqXHR) + '</div>');
    });
}

function viewGameHistory(user, provider, gameCode) {
    $.post('{{ URL::to("Admin/Dashboard/Call/game-history") }}', {
        _token: CSRF, user_code: user, provider_code: provider, game_code: gameCode,
    }, function(res) {
        if (res.url) {
            window.open(res.url, '_blank');
        } else {
            alert(res.msg || 'History tidak tersedia');
        }
    }).fail(function(jqXHR) { alert('Gagal: ' + errMsg(jqXHR)); });
}
</script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script>
$(function() {
    $('#logUser').select2({ width: '100%', placeholder: '-- Cari User --', allowClear: true });
});
</script>
@endsection
