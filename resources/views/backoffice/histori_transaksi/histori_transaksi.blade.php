@extends('backoffice.layouts.main')
@section('content')
<div class="container-fluid">
    @php
        $totalDeposit = $deposits->count();
        $totalWithdraw = $withdraws->count();
        $totalDepositAmount = $deposits->sum('amount');
        $totalWithdrawAmount = $withdraws->sum('amount');
    @endphp
    <div class="row mt-3">
        <div class="col-lg-3 col-6">
            <div class="small-box bg-info">
                <div class="inner">
                    <h3>{{ $totalDeposit }}</h3>
                    <p>Total Deposit</p>
                </div>
                <div class="icon"><i class="fas fa-arrow-down"></i></div>
            </div>
        </div>
        <div class="col-lg-3 col-6">
            <div class="small-box bg-success">
                <div class="inner">
                    <h3>Rp {{ number_format($totalDepositAmount, 0, ',', '.') }}</h3>
                    <p>Jumlah Deposit</p>
                </div>
                <div class="icon"><i class="fas fa-wallet"></i></div>
            </div>
        </div>
        <div class="col-lg-3 col-6">
            <div class="small-box bg-warning">
                <div class="inner">
                    <h3>{{ $totalWithdraw }}</h3>
                    <p>Total Withdraw</p>
                </div>
                <div class="icon"><i class="fas fa-arrow-up"></i></div>
            </div>
        </div>
        <div class="col-lg-3 col-6">
            <div class="small-box bg-danger">
                <div class="inner">
                    <h3>Rp {{ number_format($totalWithdrawAmount, 0, ',', '.') }}</h3>
                    <p>Jumlah Withdraw</p>
                </div>
                <div class="icon"><i class="fas fa-coins"></i></div>
            </div>
        </div>
    </div>
    <div class="card">
        <div class="card-header">
            <ul class="nav nav-tabs card-header-tabs" id="transactionTabs">
                <li class="nav-item">
                    <a class="nav-link active" id="nav-deposit-tab" data-toggle="tab" href="#nav-deposit">
                        <i class="fas fa-wallet"></i> History Deposit
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="nav-withdraw-tab" data-toggle="tab" href="#nav-withdraw">
                        <i class="fas fa-coins"></i> History Withdraw
                    </a>
                </li>
            </ul>
        </div>
        <div class="card-body p-0">
            <div class="tab-content">
                <div class="tab-pane fade show active" id="nav-deposit">
                    <div class="table-responsive">
                        <table id="deposit-table" class="table table-hover table-striped mb-0">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Tanggal</th>
                                    <th>Username</th>
                                    <th>Nama Pengirim</th>
                                    <th>Bank Pengirim</th>
                                    <th>Nominal</th>
                                    <th>Bank Penerima</th>
                                    <th>Nama Penerima</th>
                                    <th>Rekening Penerima</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($deposits as $d)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ \Carbon\Carbon::parse($d->created_at)->diffForHumans() }}</td>
                                    <td><strong>{{ $d->user->username ?? '-' }}</strong></td>
                                    <td>{{ $d->accName ?? '-' }}</td>
                                    <td>{{ $d->bankMember ?? '-' }}</td>
                                    <td>Rp {{ number_format($d->amount ?? 0, 0, ',', '.') }}</td>
                                    <td>{{ $d->bank_penerima ?? '-' }}</td>
                                    <td>{{ $d->nama_penerima ?? '-' }}</td>
                                    <td>{{ $d->nomer_penerima ?? '-' }}</td>
                                    <td>
                                        @if($d->status_id == 2)
                                            <span class="badge badge-success">Success</span>
                                        @elseif($d->status_id == 3)
                                            <span class="badge badge-danger">Rejected</span>
                                        @else
                                            <span class="badge badge-warning">Pending</span>
                                        @endif
                                    </td>
                                </tr>
                                @empty
                                <tr><td colspan="10" class="text-center text-muted py-3">Tidak ada data deposit</td></tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="tab-pane fade" id="nav-withdraw">
                    <div class="table-responsive">
                        <table id="withdraw-table" class="table table-hover table-striped mb-0">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Tanggal</th>
                                    <th>Username</th>
                                    <th>Nama Rekening</th>
                                    <th>Bank</th>
                                    <th>Nominal</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($withdraws as $w)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ \Carbon\Carbon::parse($w->created_at)->diffForHumans() }}</td>
                                    <td><strong>{{ $w->user->username ?? '-' }}</strong></td>
                                    <td>{{ $w->accName ?? '-' }}</td>
                                    <td>{{ $w->bankMember ?? '-' }}</td>
                                    <td>Rp {{ number_format($w->amount ?? 0, 0, ',', '.') }}</td>
                                    <td>
                                        @if($w->status_id == 2)
                                            <span class="badge badge-success">Success</span>
                                        @elseif($w->status_id == 3)
                                            <span class="badge badge-danger">Rejected</span>
                                        @else
                                            <span class="badge badge-warning">Pending</span>
                                        @endif
                                    </td>
                                </tr>
                                @empty
                                <tr><td colspan="7" class="text-center text-muted py-3">Tidak ada data withdraw</td></tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
$(document).ready(function() {
    $('#deposit-table').DataTable({
        paging: true, lengthChange: false, searching: true, ordering: true, info: false, autoWidth: false, responsive: true
    });
    $('#withdraw-table').DataTable({
        paging: true, lengthChange: false, searching: true, ordering: true, info: false, autoWidth: false, responsive: true
    });
});
</script>
@endsection