@extends('backoffice.layouts.main')

@section('content')
    <div class="row">
        <div class="col-lg-3 col-6">
            <div class="small-box bg-info">
                <div class="inner">
                    <h3>{{ number_format($pendingDeposite) }}</h3>
                    <p>Deposit Pending</p>
                </div>
                <div class="icon">
                    <i class="fas fa-rocket"></i>
                </div>
                <a href="/Admin/Dashboard/Tranksaksi" class="small-box-footer">Cek Deposit <i class="fas fa-arrow-circle-right"></i></a>
            </div>
        </div>
        <div class="col-lg-3 col-6">
            <div class="small-box bg-warning">
                <div class="inner">
                    <h3>{{ number_format($pendingWithdraw) }}</h3>
                    <p>Withdraw Pending</p>
                </div>
                <div class="icon">
                    <i class="fas fa-money-bill-wave"></i>
                </div>
                <a href="/Admin/Dashboard/Withdraw" class="small-box-footer">Cek Withdraw <i class="fas fa-arrow-circle-right"></i></a>
            </div>
        </div>
        <div class="col-lg-3 col-6">
            <div class="small-box bg-success">
                <div class="inner">
                    <h3>IDR {{ number_format($totalDeposite) }}</h3>
                    <p>Total Deposit</p>
                </div>
                <div class="icon">
                    <i class="fas fa-donate"></i>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-6">
            <div class="small-box bg-danger">
                <div class="inner">
                    <h3>IDR {{ number_format($totalWithdraw) }}</h3>
                    <p>Total Withdraw</p>
                </div>
                <div class="icon">
                    <i class="fas fa-arrow-up"></i>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-3 col-6">
            <div class="small-box bg-primary">
                <div class="inner">
                    <h3>{{ number_format($totalUser) }}</h3>
                    <p>Total Member</p>
                </div>
                <div class="icon">
                    <i class="fas fa-users"></i>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-6">
            <div class="small-box bg-secondary">
                <div class="inner">
                    <h3>IDR {{ number_format($totalPendapatan) }}</h3>
                    <p>Total Pendapatan</p>
                </div>
                <div class="icon">
                    <i class="fas fa-chart-line"></i>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-6">
            <div class="small-box bg-dark">
                <div class="inner">
                    <h3>{{ $Game }}</h3>
                    <p>Total Game</p>
                </div>
                <div class="icon">
                    <i class="fas fa-gamepad"></i>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title">Deposit Pending Terbaru</h5>
                    <a href="/Admin/Dashboard/Tranksaksi" class="float-right btn btn-sm btn-primary">Lihat Semua</a>
                </div>
                <div class="card-body p-0">
                    <table class="table table-hover table-striped mb-0">
                        <thead>
                            <tr>
                                <th>User</th>
                                <th>Amount</th>
                                <th>Waktu</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($pendingDeposits as $d)
                                <tr>
                                    <td>{{ $d['user']['username'] ?? '-' }}</td>
                                    <td>Rp {{ number_format($d['amount'] ?? 0) }}</td>
                                    <td>{{ \Carbon\Carbon::parse($d['created_at'] ?? now())->diffForHumans() }}</td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="3" class="text-center text-muted">Tidak ada deposit pending</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title">Withdraw Pending Terbaru</h5>
                    <a href="/Admin/Dashboard/Withdraw" class="float-right btn btn-sm btn-primary">Lihat Semua</a>
                </div>
                <div class="card-body p-0">
                    <table class="table table-hover table-striped mb-0">
                        <thead>
                            <tr>
                                <th>User</th>
                                <th>Amount</th>
                                <th>Waktu</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($pendingWithdraws as $w)
                                <tr>
                                    <td>{{ $w['user']['username'] ?? '-' }}</td>
                                    <td>Rp {{ number_format($w['amount'] ?? 0) }}</td>
                                    <td>{{ \Carbon\Carbon::parse($w['created_at'] ?? now())->diffForHumans() }}</td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="3" class="text-center text-muted">Tidak ada withdraw pending</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
