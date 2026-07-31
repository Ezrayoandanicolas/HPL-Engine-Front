@extends('backoffice.layouts.main')
@section('content')
<div class="container-fluid">
    @php
        $totalMember = count($user);
        $totalSaldo = collect($user)->sum('saldo');
        $totalPendingSaldo = collect($user)->filter(fn($u) => ($u['saldo'] ?? 0) > 0)->sum('saldo');
    @endphp
    <div class="row mt-3">
        <div class="col-lg-3 col-6">
            <div class="small-box bg-info">
                <div class="inner">
                    <h3>{{ $totalMember }}</h3>
                    <p>Total Member</p>
                </div>
                <div class="icon"><i class="fas fa-users"></i></div>
            </div>
        </div>
        <div class="col-lg-3 col-6">
            <div class="small-box bg-success">
                <div class="inner">
                    <h3>Rp {{ number_format($totalSaldo, 0, ',', '.') }}</h3>
                    <p>Total Saldo</p>
                </div>
                <div class="icon"><i class="fas fa-wallet"></i></div>
            </div>
        </div>
        <div class="col-lg-3 col-6">
            <div class="small-box bg-warning">
                <div class="inner">
                    <h3>{{ number_format($totalPendingSaldo, 0, ',', '.') }}</h3>
                    <p>Saldo Aktif</p>
                </div>
                <div class="icon"><i class="fas fa-coins"></i></div>
            </div>
        </div>
        <div class="col-lg-3 col-6">
            <div class="small-box bg-danger">
                <div class="inner">
                    <h3>{{ collect($user)->filter(fn($u) => ($u['saldo'] ?? 0) == 0)->count() }}</h3>
                    <p>Saldo 0</p>
                </div>
                <div class="icon"><i class="fas fa-empty-set"></i></div>
            </div>
        </div>
    </div>
    <div class="card">
        <div class="card-header">
            <h4 class="card-title">Data Member</h4>
            <div class="card-tools">
                <form method="GET" class="form-inline">
                    <input type="text" name="search" class="form-control form-control-sm mr-1" placeholder="Cari username..." value="{{ request('search') }}">
                    <button type="submit" class="btn btn-primary btn-sm"><i class="fa fa-search"></i></button>
                </form>
            </div>
        </div>
        <div class="card-body p-0">
            <div class="table-responsive">
                <table id="inject-table" class="table table-hover table-striped mb-0">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Tanggal</th>
                            <th>Username</th>
                            <th>Ref</th>
                            <th>Saldo</th>
                            <th>Email</th>
                            <th>No WA</th>
                            <th>Bank</th>
                            <th>Nama Rekening</th>
                            <th>No Rekening</th>
                            <th class="text-right">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($user as $member)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ \Carbon\Carbon::parse($member['created_at'] ?? '')->format('d M Y') }}</td>
                            <td><strong>{{ $member['username'] ?? '-' }}</strong></td>
                            <td>{{ $member['ref'] ?? '-' }}</td>
                            <td>Rp {{ number_format($member['saldo'] ?? 0, 0, ',', '.') }}</td>
                            <td>{{ $member['email'] ?? '-' }}</td>
                            <td>{{ $member['whatsapp'] ?? $member['phone'] ?? '-' }}</td>
                            <td>{{ $member['bank'] ?? '-' }}</td>
                            <td>{{ $member['accName'] ?? '-' }}</td>
                            <td>{{ $member['accNumber'] ?? '-' }}</td>
                            <td class="text-right">
                                <button class="btn btn-warning btn-sm" data-toggle="modal" data-target="#modal{{ $member['id'] }}">
                                    <i class="fas fa-coins"></i> Inject
                                </button>
                            </td>
                        </tr>
                        @empty
                        <tr><td colspan="11" class="text-center text-muted py-3">Tidak ada data member</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

@foreach ($user as $member)
<div class="modal fade" id="modal{{ $member['id'] }}">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="{{ route('saldo.update', $member['id']) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="modal-header">
                    <h5 class="modal-title">Inject Saldo</h5>
                    <button class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label>Username</label>
                        <input type="text" class="form-control" value="{{ $member['username'] }}" readonly>
                    </div>
                    <div class="form-group">
                        <label>Saldo Saat Ini</label>
                        <input type="text" class="form-control" value="Rp {{ number_format($member['saldo'] ?? 0, 0, ',', '.') }}" readonly>
                    </div>
                    <div class="form-group">
                        <label>Jumlah</label>
                        <input type="number" class="form-control" name="saldo" min="0" required>
                    </div>
                    <div class="form-group">
                        <label>Aksi</label>
                        <select class="form-control" name="action" required>
                            <option value="add">Tambah Saldo</option>
                            <option value="subtract">Tarik Saldo</option>
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endforeach
@endsection