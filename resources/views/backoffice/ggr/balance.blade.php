@extends('backoffice.layouts.main')
@section('content')
<div class="container-fluid">
    @php
        $total = count($users);
        $totalBalance = collect($users)->sum('balance');
    @endphp
    <div class="row mt-3">
        <div class="col-lg-6 col-6">
            <div class="small-box bg-info"><div class="inner"><h3>{{ $total }}</h3><p>Total Member</p></div><div class="icon"><i class="fas fa-users"></i></div></div>
        </div>
        <div class="col-lg-6 col-6">
            <div class="small-box bg-success"><div class="inner"><h3>Rp {{ number_format($totalBalance, 0, ',', '.') }}</h3><p>Total Saldo GGR</p></div><div class="icon"><i class="fas fa-coins"></i></div></div>
        </div>
    </div>
    <div class="card">
        <div class="card-header">
            <h4 class="card-title"><i class="fas fa-wallet mr-2"></i> Saldo Member di GGR</h4>
            <div class="card-tools">
                <button class="btn btn-primary btn-sm" onclick="location.reload()"><i class="fas fa-sync mr-1"></i> Refresh</button>
            </div>
        </div>
        <div class="card-body p-0">
            <div class="table-responsive">
                <table id="ggr-table" class="table table-hover table-striped mb-0">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Username</th>
                            <th>Saldo GGR</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($users as $u)
                        @php $u = (object) $u; @endphp
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td><strong>{{ $u->user_code ?? '-' }}</strong></td>
                            <td>Rp {{ number_format($u->balance ?? 0, 2, ',', '.') }}</td>
                        </tr>
                        @empty
                        <tr><td colspan="3" class="text-center text-muted py-3">Tidak ada data</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<script>
$(function() {
    $('#ggr-table').DataTable({
        paging: true, lengthChange: false, searching: true, ordering: true, info: false, autoWidth: false, responsive: true,
        order: [[2, 'desc']]
    });
});
</script>
@endsection