<div id="summaryCards" class="row mt-3">
    <div class="col-lg-3 col-6">
        <div class="small-box bg-info">
            <div class="inner">
                <h3>{{ count($userrefDeposite) }}</h3>
                <p>Total Deposit</p>
            </div>
            <div class="icon"><i class="fas fa-arrow-down"></i></div>
        </div>
    </div>
</div>
<div class="card">
    <div class="card-header">
        <h4 class="card-title">Tabel Deposit (Promotor)</h4>
        <div class="card-tools">
            <form method="GET" class="form-inline" id="filterForm">
                <input type="date" name="date_from" class="form-control form-control-sm mr-1" value="{{ request('date_from') }}">
                <input type="date" name="date_to" class="form-control form-control-sm mr-1" value="{{ request('date_to') }}">
                <input type="text" name="search" class="form-control form-control-sm mr-1" placeholder="Cari..." value="{{ request('search') }}">
                <button type="submit" class="btn btn-primary btn-sm"><i class="fa fa-search"></i></button>
            </form>
        </div>
    </div>
    <div class="card-body p-0">
        <div class="table-responsive">
            <table id="deposit-table2" class="table table-hover table-striped mb-0">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Tanggal</th>
                        <th>Parent Ref</th>
                        <th>Username</th>
                        <th>Bank</th>
                        <th>No. Rekening</th>
                        <th>Amount</th>
                        <th>Status</th>
                        <th>Bukti</th>
                        <th class="text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($userrefDeposite as $t)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ \Carbon\Carbon::parse($t['created_at'] ?? $t->created_at)->diffForHumans() }}</td>
                        <td>{{ $t['ref'] ?? $t->ref ?? '-' }}</td>
                        <td><strong>{{ $t['user']['username'] ?? $t->User->username ?? '-' }}</strong></td>
                        <td>{{ $t['user']['bank'] ?? $t->User->bank ?? '-' }}</td>
                        <td>{{ $t['user']['accNumber'] ?? $t->User->accNumber ?? '-' }}</td>
                        <td>Rp {{ number_format($t['amount'] ?? $t->amount ?? 0, 0, ',', '.') }}</td>
                        <td>
                            @php $s = $t['status_id'] ?? $t->status_id ?? 0; @endphp
                            @if($s == 1)
                                <span class="badge badge-warning">Pending</span>
                            @elseif($s == 2)
                                <span class="badge badge-success">Sukses</span>
                            @elseif($s == 3)
                                <span class="badge badge-danger">Ditolak</span>
                            @else
                                <span class="badge badge-secondary">{{ $t['status'] ?? $t->Status->name ?? 'Unknown' }}</span>
                            @endif
                        </td>
                        <td>
                            @php $img = $t['img'] ?? $t->img ?? ''; @endphp
                            @if($img)
                            <a href="javascript:void(0)" onclick="previewImage('{{ storageUrl($img) }}')">
                                <img src="{{ storageUrl($img) }}" alt="Bukti" class="img-thumbnail" style="max-height:50px">
                            </a>
                            @else
                            <span class="text-muted">-</span>
                            @endif
                        </td>
                        <td class="text-right">
                            @php $s = $t['status_id'] ?? $t->status_id ?? 0; @endphp
                            @if($s == 1)
                            <form action="/Admin/Dashboard/Tranksaksi/{{ $t['id'] ?? $t->id }}" method="POST" style="display:inline">
                                @csrf @method('PUT')
                                <input type="hidden" name="action" value="acc">
                                <button type="submit" class="btn btn-success btn-sm"><i class="fas fa-check"></i> Acc</button>
                            </form>
                            <form action="/Admin/Dashboard/Tranksaksi/{{ $t['id'] ?? $t->id }}" method="POST" style="display:inline" onsubmit="return confirm('Tolak deposit ini?')">
                                @csrf @method('PUT')
                                <input type="hidden" name="action" value="tolak">
                                <button type="submit" class="btn btn-danger btn-sm"><i class="fas fa-times"></i> Tolak</button>
                            </form>
                            @elseif($s == 2)
                            <span class="badge badge-success">Sudah di ACC</span>
                            @else
                            <span class="badge badge-danger">Sudah ditolak</span>
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
</div>
