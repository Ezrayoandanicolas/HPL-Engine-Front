@extends('backoffice.layouts.main')
@section('content')
<div class="container-fluid">
    @php
        $s = $stats;
        $users = $s['users'] ?? [];
        $deposits = $s['deposits'] ?? [];
        $withdraws = $s['withdraws'] ?? [];
        $daily = collect($s['daily'] ?? []);
    @endphp
    <div class="row mt-3">
        <div class="col-lg-3 col-6">
            <div class="small-box bg-info"><div class="inner"><h3>{{ number_format($users['total'] ?? 0) }}</h3><p>Total User</p></div><div class="icon"><i class="fas fa-users"></i></div></div>
        </div>
        <div class="col-lg-3 col-6">
            <div class="small-box bg-success"><div class="inner"><h3>{{ number_format($deposits['total_count'] ?? 0) }}</h3><p>Total Deposit</p></div><div class="icon"><i class="fas fa-arrow-down"></i></div></div>
        </div>
        <div class="col-lg-3 col-6">
            <div class="small-box bg-warning"><div class="inner"><h3>{{ number_format($withdraws['total_count'] ?? 0) }}</h3><p>Total Withdraw</p></div><div class="icon"><i class="fas fa-arrow-up"></i></div></div>
        </div>
        <div class="col-lg-3 col-6">
            <div class="small-box bg-danger"><div class="inner"><h3>Rp {{ number_format(($deposits['total_amount'] ?? 0) - ($withdraws['total_amount'] ?? 0), 0, ',', '.') }}</h3><p>Net Profit</p></div><div class="icon"><i class="fas fa-chart-line"></i></div></div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-4 col-6">
            <div class="small-box bg-primary"><div class="inner"><h6 class="mb-0">Hari Ini</h6><h3>Rp {{ number_format($deposits['today'] ?? 0, 0, ',', '.') }}</h3><p>Deposit Hari Ini</p></div><div class="icon"><i class="fas fa-coins"></i></div></div>
        </div>
        <div class="col-lg-4 col-6">
            <div class="small-box bg-secondary"><div class="inner"><h6 class="mb-0">Hari Ini</h6><h3>Rp {{ number_format($withdraws['today'] ?? 0, 0, ',', '.') }}</h3><p>Withdraw Hari Ini</p></div><div class="icon"><i class="fas fa-money-bill-wave"></i></div></div>
        </div>
        <div class="col-lg-4 col-6">
            <div class="small-box bg-info"><div class="inner"><h6 class="mb-0">Bulan Ini</h6><h3>Rp {{ number_format($deposits['month'] ?? 0, 0, ',', '.') }}</h3><p>Deposit Bulan Ini</p></div><div class="icon"><i class="fas fa-calendar"></i></div></div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
            <div class="card"><div class="card-header"><h4 class="card-title">Deposit 30 Hari</h4></div><div class="card-body"><canvas id="depositChart" height="200"></canvas></div></div>
        </div>
        <div class="col-md-6">
            <div class="card"><div class="card-header"><h4 class="card-title">Withdraw 30 Hari</h4></div><div class="card-body"><canvas id="withdrawChart" height="200"></canvas></div></div>
        </div>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
var daily = @json($daily);
var labels = [], depData = [], wdData = [];
var map = {};
daily.forEach(function(d) {
    if (!map[d.date]) map[d.date] = { dep: 0, wd: 0 };
    if (d.type == 1) map[d.date].dep = Number(d.total);
    else map[d.date].wd = Number(d.total);
});
Object.keys(map).sort().forEach(function(date) {
    labels.push(date);
    depData.push(map[date].dep);
    wdData.push(map[date].wd);
});
new Chart(document.getElementById('depositChart'), {
    type: 'bar', data: { labels: labels, datasets: [{ label: 'Deposit', data: depData, backgroundColor: '#28a745' }] },
    options: { responsive: true, plugins: { legend: { display: false } } }
});
new Chart(document.getElementById('withdrawChart'), {
    type: 'bar', data: { labels: labels, datasets: [{ label: 'Withdraw', data: wdData, backgroundColor: '#dc3545' }] },
    options: { responsive: true, plugins: { legend: { display: false } } }
});
</script>
@endsection