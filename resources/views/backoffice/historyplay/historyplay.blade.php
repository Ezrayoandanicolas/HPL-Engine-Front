@extends('backoffice.layouts.main')
@section('content')
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<div class="container-fluid">
    <div class="card mt-3">
        <div class="card-header">
            <h4 class="card-title"><i class="fas fa-history mr-2"></i> Riwayat Permainan</h4>
        </div>
        <div class="card-body">
            <form id="searchForm" class="form-inline mb-3" style="gap:8px">
                <input type="date" name="date_start" class="form-control form-control-sm" id="date_start" value="{{ date('Y-m-d') }}">
                <input type="date" name="date_end" class="form-control form-control-sm" id="date_end" value="{{ date('Y-m-d') }}">
                <select name="extplayer" class="form-control form-control-sm" id="extplayer">
                    <option value="">Semua User</option>
                    @foreach ($users as $user)
                    <option value="{{ $user->username }}">{{ $user->username }}</option>
                    @endforeach
                </select>
                <select name="game_type" class="form-control form-control-sm" id="game_type">
                    <option value="SLOT">Slot</option>
                    <option value="LIVE">Live Casino</option>
                    <option value="SPORTS">Sportsbook</option>
                </select>
                <button type="button" id="btn_search" class="btn btn-success btn-sm"><i class="fa fa-search mr-1"></i> Cari</button>
            </form>
            <div id="results">
                <div class="table-responsive">
                    <table id="history-table" class="table table-hover table-striped mb-0">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Game</th>
                                <th>Tipe</th>
                                <th>Bet</th>
                                <th>Win</th>
                                <th>User</th>
                                <th>Txn ID</th>
                                <th>Waktu</th>
                            </tr>
                        </thead>
                        <tbody></tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
$(function() {
    var table = $('#history-table').DataTable({
        paging: true, lengthChange: false, searching: false, ordering: true, info: false, autoWidth: false, responsive: true,
        data: [],
        columns: [
            { data: 'no' },
            { data: 'game_code' },
            { data: 'type' },
            { data: 'bet_money', render: function(d) { return Number(d||0).toLocaleString(); } },
            { data: 'win_money', render: function(d) { return Number(d||0).toLocaleString(); } },
            { data: 'user_code' },
            { data: 'txn_id' },
            { data: 'created_at' },
        ]
    });
    $('#btn_search').on('click', function() {
        $.ajax({
            url: '/fetch-game-history',
            type: 'POST',
            data: {
                date_start: $('#date_start').val(),
                date_end: $('#date_end').val(),
                extplayer: $('#extplayer').val(),
                game_type: $('#game_type').val(),
                _token: '{{ csrf_token() }}'
            },
            success: function(res) {
                var data = (res.data || []);
                if (!Array.isArray(data)) data = [data];
                var rows = data.map(function(d, i) { d.no = i+1; return d; });
                table.clear().rows.add(rows).draw();
            },
            error: function() { alert('Gagal memuat data'); }
        });
    });
    $('#btn_search').click();
});
</script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script>
$(function() { $('#extplayer').select2({ width: '100%', placeholder: 'Cari User...', allowClear: true }); });
</script>
@endsection
