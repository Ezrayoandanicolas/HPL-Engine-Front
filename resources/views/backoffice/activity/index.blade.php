@extends('backoffice.layouts.main')
@section('content')
<div class="container-fluid">
    @php
        $items = $logs['data'] ?? $logs;
        $total = is_array($items) ? count($items) : 0;
    @endphp
    <div class="row mt-3">
        <div class="col-lg-3 col-6">
            <div class="small-box bg-info"><div class="inner"><h3>{{ $total }}</h3><p>Total Log</p></div><div class="icon"><i class="fas fa-history"></i></div></div>
        </div>
    </div>
    <div class="card">
        <div class="card-header">
            <h4 class="card-title"><i class="fas fa-clipboard-list mr-2"></i> Activity Log</h4>
            <div class="card-tools">
                <form method="GET" class="form-inline" style="display:inline-flex;gap:4px">
                    <input type="date" name="date_from" class="form-control form-control-sm" value="{{ request('date_from') }}">
                    <input type="date" name="date_to" class="form-control form-control-sm" value="{{ request('date_to') }}">
                    <select name="action" class="form-control form-control-sm">
                        <option value="">Semua Aksi</option>
                        <option value="deposit_approve" {{ request('action')=='deposit_approve' ? 'selected' : '' }}>Approve Deposit</option>
                        <option value="deposit_reject" {{ request('action')=='deposit_reject' ? 'selected' : '' }}>Tolak Deposit</option>
                        <option value="withdraw_approve" {{ request('action')=='withdraw_approve' ? 'selected' : '' }}>Approve Withdraw</option>
                        <option value="withdraw_reject" {{ request('action')=='withdraw_reject' ? 'selected' : '' }}>Tolak Withdraw</option>
                        <option value="send_message" {{ request('action')=='send_message' ? 'selected' : '' }}>Kirim Pesan</option>
                        <option value="update_setting" {{ request('action')=='update_setting' ? 'selected' : '' }}>Ubah Setting</option>
                    </select>
                    <button class="btn btn-primary btn-sm"><i class="fas fa-search"></i></button>
                </form>
            </div>
        </div>
        <div class="card-body p-0">
            <div class="table-responsive">
                <table id="log-table" class="table table-hover table-striped mb-0">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Admin</th>
                            <th>Aksi</th>
                            <th>Deskripsi</th>
                            <th>Target</th>
                            <th>IP</th>
                            <th>Waktu</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($items as $log)
                        @php $log = (object) $log; @endphp
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $log->admin_name ?? 'Admin#' . $log->admin_id }}</td>
                            <td><span class="badge badge-info">{{ str_replace('_', ' ', $log->action) }}</span></td>
                            <td>{{ $log->description }}</td>
                            <td><small>{{ $log->target_type }} #{{ $log->target_id }}</small></td>
                            <td><code>{{ $log->ip }}</code></td>
                            <td><small>{{ \Carbon\Carbon::parse($log->created_at)->format('d M H:i') }}</small></td>
                        </tr>
                        @empty
                        <tr><td colspan="7" class="text-center text-muted py-3">Belum ada log</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<script>
$(function() {
    $('#log-table').DataTable({
        paging: true, lengthChange: false, searching: true, ordering: true, info: false, autoWidth: false, responsive: true
    });
});
</script>
@endsection