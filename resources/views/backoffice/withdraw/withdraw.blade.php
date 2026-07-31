@extends('backoffice.layouts.main')
@section('content')
<script>
function withdrawRow(t, idx) {
    var u = t.user || {};
    var csrf = $('meta[name="csrf-token"]').attr('content');
    return '<tr>' +
        '<td>' + idx + '</td>' +
        '<td>' + moment(t.created_at).fromNow() + '</td>' +
        '<td><strong>' + (u.username || '-') + '</strong></td>' +
        '<td>' + (u.accName || '-') + '</td>' +
        '<td>' + (u.bank || '-') + '</td>' +
        '<td>' + (u.accNumber || '-') + '</td>' +
        '<td>Rp ' + new Intl.NumberFormat('id-ID').format(t.amount || 0) + '</td>' +
        '<td class="text-right">' +
        '<form action="/Admin/Dashboard/Withdraw/' + t.id + '/update" method="POST" style="display:inline">' +
        '<input type="hidden" name="_token" value="' + csrf + '">' +
        '<input type="hidden" name="_method" value="PUT">' +
        '<input type="hidden" name="action" value="acc">' +
        '<button type="submit" class="badge bg-success mx-1 border-0">ACCEPT</button></form>' +
        '<form action="/Admin/Dashboard/Withdraw/' + t.id + '/update" method="POST" style="display:inline">' +
        '<input type="hidden" name="_token" value="' + csrf + '">' +
        '<input type="hidden" name="_method" value="PUT">' +
        '<input type="hidden" name="action" value="tolak">' +
        '<button class="badge bg-danger border-0" onclick="return confirm(\'Are you sure?\')">Tolak</button></form>' +
        '</td>' +
        '</tr>';
}
$(function() {
    var lastId = {{ collect($Tranksaksi)->max('id') ?? 0 }};
    var rowCount = {{ count($Tranksaksi) }};
    function checkNew() {
        $.get('/Admin/Dashboard/Withdraw/new-withdraws', { since_id: lastId, status_id: {{ request('status_id', 1) }} }, function(res) {
            if (res.transactions && res.transactions.length) {
                res.transactions.forEach(function(t) {
                    rowCount++;
                    $('#withdraw-table tbody').append(withdrawRow(t, rowCount));
                });
                lastId = res.transactions[res.transactions.length - 1].id;
            }
        });
    }
    setInterval(checkNew, 10000);
});
</script>
<div class="container-fluid">
    @php
        $totalPending = collect($Tranksaksi)->filter(fn($t) => ($t['status_id'] ?? 0) == 1)->count();
        $totalAmount = collect($Tranksaksi)->filter(fn($t) => ($t['status_id'] ?? 0) == 1)->sum('amount');
    @endphp
    <div class="row mt-3">
        <div class="col-lg-3 col-6">
            <div class="small-box bg-info">
                <div class="inner">
                    <h3>{{ count($Tranksaksi) }}</h3>
                    <p>Total Withdraw</p>
                </div>
                <div class="icon"><i class="fas fa-arrow-up"></i></div>
            </div>
        </div>
        <div class="col-lg-3 col-6">
            <div class="small-box bg-warning">
                <div class="inner">
                    <h3>{{ $totalPending }}</h3>
                    <p>Pending</p>
                </div>
                <div class="icon"><i class="fas fa-clock"></i></div>
            </div>
        </div>
        <div class="col-lg-3 col-6">
            <div class="small-box bg-success">
                <div class="inner">
                    <h3>Rp {{ number_format($totalAmount, 0, ',', '.') }}</h3>
                    <p>Jumlah Pending</p>
                </div>
                <div class="icon"><i class="fas fa-wallet"></i></div>
            </div>
        </div>
        <div class="col-lg-3 col-6">
            <div class="small-box bg-danger">
                <div class="inner">
                    <h3>{{ collect($Tranksaksi)->filter(fn($t) => ($t['status_id'] ?? 0) == 3)->count() }}</h3>
                    <p>Ditolak</p>
                </div>
                <div class="icon"><i class="fas fa-times"></i></div>
            </div>
        </div>
    </div>
    <div class="card">
        <div class="card-header">
            <h4 class="card-title">Tabel Withdraw</h4>
            <div class="card-tools">
                <form method="GET" class="form-inline" id="filterForm">
                    <input type="date" name="date_from" class="form-control form-control-sm mr-1" value="{{ request('date_from') }}">
                    <input type="date" name="date_to" class="form-control form-control-sm mr-1" value="{{ request('date_to') }}">
                    <select name="status_id" class="form-control form-control-sm mr-1">
                        <option value="1" {{ request('status_id', 1) == 1 ? 'selected' : '' }}>Pending</option>
                        <option value="2" {{ request('status_id') == 2 ? 'selected' : '' }}>Sukses</option>
                        <option value="3" {{ request('status_id') == 3 ? 'selected' : '' }}>Ditolak</option>
                        <option value="">Semua</option>
                    </select>
                    <input type="text" name="search" class="form-control form-control-sm mr-1" placeholder="Cari username..." value="{{ request('search') }}">
                    <button type="submit" class="btn btn-primary btn-sm"><i class="fa fa-search"></i></button>
                </form>
            </div>
        </div>
        <div class="card-body p-0">
            <div class="table-responsive">
                <table id="withdraw-table" class="table table-hover table-striped mb-0">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Waktu Withdraw</th>
                            <th>Username</th>
                            <th>Pemilik Bank</th>
                            <th>Bank</th>
                            <th>No. Rekening</th>
                            <th>Amount</th>
                            <th class="text-right">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($Tranksaksi as $t)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ \Carbon\Carbon::parse($t['created_at'])->diffForHumans() }}</td>
                            <td><strong>{{ $t['user']['username'] ?? '-' }}</strong></td>
                            <td>{{ $t['user']['accName'] ?? '-' }}</td>
                            <td>{{ $t['user']['bank'] ?? '-' }}</td>
                            <td>{{ $t['user']['accNumber'] ?? '-' }}</td>
                            <td>Rp {{ number_format($t['amount'] ?? 0, 0, ',', '.') }}</td>
                            <td class="text-right">
                                <form action="/Admin/Dashboard/Withdraw/{{ $t['id'] }}/update" method="POST" style="display:inline">
                                    @csrf @method('PUT')
                                    <input type="hidden" name="action" value="acc">
                                    <button type="submit" class="badge bg-success mx-1 border-0">ACCEPT</button>
                                </form>
                                <form action="/Admin/Dashboard/Withdraw/{{ $t['id'] }}/update" method="POST" style="display:inline">
                                    @csrf @method('PUT')
                                    <input type="hidden" name="action" value="tolak">
                                    <button class="badge bg-danger border-0" onclick="return confirm('Are you sure?')">Tolak</button>
                                </form>
                            </td>
                        </tr>
                        @empty
                        <tr><td colspan="8" class="text-center text-muted py-3">Tidak ada data withdraw</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection