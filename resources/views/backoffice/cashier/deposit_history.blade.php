@extends('backoffice.layouts.main')
@section('content')
<div class="container-fluid">
    @php
        $totalDeposit = $deposits->count();
        $totalPending = $deposits->filter(fn($d) => ($d->status_id ?? 0) == 1)->count();
        $totalSuccess = $deposits->filter(fn($d) => ($d->status_id ?? 0) == 2)->count();
        $totalRejected = $deposits->filter(fn($d) => ($d->status_id ?? 0) == 3)->count();
        $totalPendingAmount = $deposits->filter(fn($d) => ($d->status_id ?? 0) == 1)->sum('amount');
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
                    <h3>Rp {{ number_format($totalPendingAmount, 0, ',', '.') }}</h3>
                    <p>Jumlah Pending</p>
                </div>
                <div class="icon"><i class="fas fa-wallet"></i></div>
            </div>
        </div>
        <div class="col-lg-3 col-6">
            <div class="small-box bg-danger">
                <div class="inner">
                    <h3>{{ $totalRejected }}</h3>
                    <p>Ditolak</p>
                </div>
                <div class="icon"><i class="fas fa-times"></i></div>
            </div>
        </div>
    </div>

    <div class="card">
        <div class="card-header">
            <h4 class="card-title">Riwayat Deposit</h4>
            <div class="card-tools">
                <form method="GET" class="form-inline">
                    <input type="date" name="date_from" class="form-control form-control-sm mr-1" value="{{ request('date_from') }}">
                    <input type="date" name="date_to" class="form-control form-control-sm mr-1" value="{{ request('date_to') }}">
                    <select name="status_id" class="form-control form-control-sm mr-1">
                        <option value="">Semua</option>
                        <option value="1" {{ request('status_id') == '1' ? 'selected' : '' }}>Pending</option>
                        <option value="2" {{ request('status_id') == '2' ? 'selected' : '' }}>Sukses</option>
                        <option value="3" {{ request('status_id') == '3' ? 'selected' : '' }}>Ditolak</option>
                    </select>
                    <input type="text" name="search" class="form-control form-control-sm mr-1" placeholder="Cari username..." value="{{ request('search') }}">
                    <button type="submit" class="btn btn-primary btn-sm"><i class="fa fa-search"></i></button>
                    <a href="{{ url('cashier/deposit-history') }}" class="btn btn-secondary btn-sm"><i class="fa fa-undo"></i></a>
                </form>
            </div>
        </div>
        <div class="card-body p-0">
            <div class="table-responsive">
                <table id="deposit-history-table" class="table table-hover table-striped mb-0">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Tanggal</th>
                            <th>Username</th>
                            <th>Nama Pengirim</th>
                            <th>Bank Pengirim</th>
                            <th>No. Rekening</th>
                            <th>Nominal</th>
                            <th>Status</th>
                            <th>Bukti</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($deposits as $d)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ \Carbon\Carbon::parse($d->created_at ?? now())->diffForHumans() }}</td>
                            <td><strong>{{ $d->user->username ?? '-' }}</strong></td>
                            <td>{{ $d->accName ?? '-' }}</td>
                            <td>{{ $d->bankMember ?? '-' }}</td>
                            <td>{{ $d->user->accNumber ?? '-' }}</td>
                            <td>Rp {{ number_format($d->amount ?? 0, 0, ',', '.') }}</td>
                            <td>
                                @php $s = $d->status_id ?? 0; @endphp
                                @if($s == 1)
                                    <span class="badge badge-warning">Pending</span>
                                @elseif($s == 2)
                                    <span class="badge badge-success">Sukses</span>
                                @elseif($s == 3)
                                    <span class="badge badge-danger">Ditolak</span>
                                @else
                                    <span class="badge badge-secondary">Unknown</span>
                                @endif
                            </td>
                            <td>
                                @if (!empty($d->img))
                                <a href="javascript:void(0)" onclick="previewHistoryImage('{{ storageUrl($d->img) }}')">
                                    <img src="{{ storageUrl($d->img) }}" alt="Bukti" class="img-thumbnail" style="max-height:50px">
                                </a>
                                @else
                                <span class="text-muted">-</span>
                                @endif
                            </td>
                        </tr>
                        @empty
                        <tr><td colspan="9" class="text-center text-muted py-3">Tidak ada data deposit</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="imageModal" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-md" role="document">
        <div class="modal-content">
            <div class="modal-body p-0">
                <img id="imagePreview" src="" class="img-fluid">
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
            </div>
        </div>
    </div>
</div>
<script>
function previewHistoryImage(src) {
    $('#imagePreview').attr('src', src);
    $('#imageModal').modal('show');
}
$(document).ready(function() {
    $('#deposit-history-table').DataTable({
        paging: true, lengthChange: false, searching: true, ordering: true, info: false, autoWidth: false, responsive: true
    });
});
</script>
@endsection