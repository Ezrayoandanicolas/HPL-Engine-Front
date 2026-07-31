@extends('backoffice.layouts.main')

@section('content')
<div class="container-fluid">
    <div class="row mb-3">
        <div class="col-12">
            <h4 class="mb-3">Transfer Provider</h4>


            @if(session('result_data'))
                <div class="card card-success">
                    <div class="card-header"><h5>Response</h5></div>
                    <div class="card-body">
                        <pre style="max-height:300px;overflow:auto;">{{ json_encode(session('result_data'), JSON_PRETTY_PRINT) }}</pre>
                    </div>
                </div>
            @endif

            {{-- STATS ROW --}}
            <div class="row">
                <div class="col-md-3">
                    <div class="card card-info">
                        <div class="card-header"><h5>Balance Agent</h5></div>
                        <div class="card-body text-center">
                            @if($agentBalance !== null)
                                <h4>Rp {{ number_format($agentBalance, 2, ',', '.') }}</h4>
                            @else
                                <p class="text-muted">Gagal mengambil</p>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card card-success">
                        <div class="card-header"><h5>Sukses</h5></div>
                        <div class="card-body text-center">
                            <h4>{{ $totalSuccess }}</h4>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card card-danger">
                        <div class="card-header"><h5>Gagal</h5></div>
                        <div class="card-body text-center">
                            <h4>{{ $totalFailed }}</h4>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card card-warning">
                        <div class="card-header"><h5>Total Transaksi</h5></div>
                        <div class="card-body text-center">
                            <h4>{{ $totalSuccess + $totalFailed }}</h4>
                        </div>
                    </div>
                </div>
            </div>

            {{-- ACTION CARDS --}}
            <div class="row">
                <div class="col-md-4">
                    <div class="card card-warning">
                        <div class="card-header"><h5>Reset User Balance</h5></div>
                        <div class="card-body">
                            <form action="{{ URL::to('Admin/Dashboard/Fiver/reset-user') }}" method="POST">
                                @csrf
                                <div class="form-group">
                                    <label>Username</label>
                                    <input type="text" name="username" class="form-control" placeholder="Masukkan username" required>
                                </div>
                                <button type="submit" class="btn btn-warning btn-block" onclick="return confirm('Reset balance user ini di provider?')">
                                    Reset User
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card card-danger">
                        <div class="card-header"><h5>Reset All Users</h5></div>
                        <div class="card-body">
                            <form action="{{ URL::to('Admin/Dashboard/Fiver/reset-all') }}" method="POST">
                                @csrf
                                <p class="text-muted">Tarik semua saldo user dari provider kembali ke agen.</p>
                                <button type="submit" class="btn btn-danger btn-block" onclick="return confirm('Yakin reset SEMUA user di provider?')">
                                    Reset All
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card card-primary">
                        <div class="card-header"><h5>Cek Transfer Status</h5></div>
                        <div class="card-body">
                            <form action="{{ URL::to('Admin/Dashboard/Fiver/check-status') }}" method="POST">
                                @csrf
                                <div class="form-group">
                                    <label>Username</label>
                                    <input type="text" name="username" class="form-control" placeholder="Username" required>
                                </div>
                                <div class="form-group">
                                    <label>Agent Sign (Unique ID)</label>
                                    <input type="text" name="agent_sign" class="form-control" placeholder="Masukkan agent_sign" required>
                                </div>
                                <button type="submit" class="btn btn-primary btn-block">Cek Status</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            {{-- TRANSACTION HISTORY --}}
            <div class="card">
                <div class="card-header">
                    <h5>Riwayat Transaksi Provider</h5>
                    <div class="card-tools">
                        <form method="GET" action="{{ URL::to('Admin/Dashboard/Fiver') }}" class="form-inline">
                            <input type="text" name="search" class="form-control form-control-sm" placeholder="Cari username/agent_sign" value="{{ request('search') }}">
                            <select name="status" class="form-control form-control-sm ml-1">
                                <option value="">Semua Status</option>
                                <option value="success" {{ request('status')=='success' ? 'selected' : '' }}>Sukses</option>
                                <option value="failed" {{ request('status')=='failed' ? 'selected' : '' }}>Gagal</option>
                            </select>
                            <button type="submit" class="btn btn-sm btn-primary ml-1">Cari</button>
                        </form>
                    </div>
                </div>
                <div class="card-body p-0">
                    <table class="table table-bordered table-striped mb-0">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Agent Sign</th>
                                <th>Username</th>
                                <th>Tipe</th>
                                <th>Jumlah</th>
                                <th>Status</th>
                                <th>Pesan</th>
                                <th>Waktu</th>
                                <th class="text-right">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($transactions as $tx)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td><code>{{ $tx->agent_sign }}</code></td>
                                <td>{{ $tx->username }}</td>
                                <td>{{ $tx->type }}</td>
                                <td>Rp {{ number_format($tx->amount, 2, ',', '.') }}</td>
                                <td>
                                    @if($tx->status == 'success')
                                        <span class="badge badge-success">Sukses</span>
                                    @elseif($tx->status == 'failed')
                                        <span class="badge badge-danger">Gagal</span>
                                    @else
                                        <span class="badge badge-warning">Pending</span>
                                    @endif
                                </td>
                                <td>{{ Str::limit($tx->message, 30) }}</td>
                                <td>{{ $tx->created_at }}</td>
                                <td class="text-right">
                                    <a href="{{ URL::to('Admin/Dashboard/Fiver/transaction/' . $tx->id) }}" class="btn btn-sm btn-info">Detail</a>
                                </td>
                            </tr>
                            @empty
                            <tr><td colspan="9" class="text-center">Belum ada transaksi</td></tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                <div class="card-footer">
                    {{ $transactions->appends(request()->query())->links() }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
