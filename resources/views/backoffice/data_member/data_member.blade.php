@extends('backoffice.layouts.main')
@section('content')
<div class="container-fluid">
    @php
        $totalMember = $stats['total_member'] ?? $total ?? count($users);
        $totalSaldo = $stats['total_saldo'] ?? 0;
        $totalSlot = $stats['total_slot'] ?? 0;
        $totalGame = $stats['total_game'] ?? 0;
        $totalMemberRole = $stats['total_member_role'] ?? 0;
        $totalAdmin = $stats['total_admin'] ?? 0;
    @endphp
    <div class="row mt-3">
        <div class="col-lg-2 col-6">
            <div class="small-box bg-info">
                <div class="inner"><h3>{{ $totalMember }}</h3><p>Total Member</p></div>
                <div class="icon"><i class="fas fa-users"></i></div>
            </div>
        </div>
        <div class="col-lg-2 col-6">
            <div class="small-box bg-success">
                <div class="inner"><h3>Rp {{ number_format($totalSaldo, 0, ',', '.') }}</h3><p>Total Saldo</p></div>
                <div class="icon"><i class="fas fa-wallet"></i></div>
            </div>
        </div>
        <div class="col-lg-2 col-6">
            <div class="small-box bg-warning">
                <div class="inner"><h3>Rp {{ number_format($totalSlot, 0, ',', '.') }}</h3><p>Saldo Slot</p></div>
                <div class="icon"><i class="fas fa-dice"></i></div>
            </div>
        </div>
        <div class="col-lg-2 col-6">
            <div class="small-box bg-primary">
                <div class="inner"><h3>Rp {{ number_format($totalGame, 0, ',', '.') }}</h3><p>Saldo Game</p></div>
                <div class="icon"><i class="fas fa-gamepad"></i></div>
            </div>
        </div>
        <div class="col-lg-2 col-6">
            <div class="small-box bg-info">
                <div class="inner"><h3>{{ $totalMemberRole }}</h3><p>Member</p></div>
                <div class="icon"><i class="fas fa-user"></i></div>
            </div>
        </div>
        <div class="col-lg-2 col-6">
            <div class="small-box bg-danger">
                <div class="inner"><h3>{{ $totalAdmin }}</h3><p>Admin</p></div>
                <div class="icon"><i class="fas fa-shield-alt"></i></div>
            </div>
        </div>
    </div>

    <div class="card">
        <div class="card-header">
            <h4 class="card-title">Data Member</h4>
            <div class="card-tools">
                <form method="GET" class="form-inline">
                    <input type="text" name="search" class="form-control form-control-sm mr-1" placeholder="Cari username..." value="{{ $searchTerm ?? '' }}">
                    <select name="role" class="form-control form-control-sm mr-1">
                        <option value="">Semua Role</option>
                        <option value="member" {{ ($selectedRole ?? '') == 'member' ? 'selected' : '' }}>Member</option>
                        <option value="admin" {{ ($selectedRole ?? '') == 'admin' ? 'selected' : '' }}>Admin</option>
                        <option value="cashier" {{ ($selectedRole ?? '') == 'cashier' ? 'selected' : '' }}>Cashier</option>
                    </select>
                    <select name="per_page" class="form-control form-control-sm mr-1">
                        @foreach([10,20,50,100,500] as $n)
                            <option value="{{ $n }}" {{ ($perPage ?? 20) == $n ? 'selected' : '' }}>{{ $n }}</option>
                        @endforeach
                    </select>
                    <button type="submit" class="btn btn-primary btn-sm mr-1"><i class="fa fa-search"></i></button>
                    <button data-toggle="modal" data-target="#tambah" type="button" class="btn btn-success btn-sm"><i class="fa fa-plus"></i> Baru</button>
                </form>
            </div>
        </div>
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover table-striped mb-0">
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
                            <th>Nama Rek</th>
                            <th>No Rek</th>
                            <th>Role</th>
                            <th class="text-right">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($users as $item)
                        <tr>
                            <td>{{ ($currentPage - 1) * $perPage + $loop->iteration }}</td>
                            <td>{{ \Carbon\Carbon::parse($item->created_at)->format('d M Y') }}</td>
                            <td><strong>{{ $item->username }}</strong></td>
                            <td>{{ $item->ref ?? '-' }}</td>
                            <td>Rp {{ number_format($item->saldo ?? 0, 0, ',', '.') }}</td>
                            <td>{{ $item->email }}</td>
                            <td>{{ $item->phone ?? $item->whatsapp ?? '-' }}</td>
                            <td>{{ $item->bank ?? '-' }}</td>
                            <td>{{ $item->accName }}</td>
                            <td>{{ $item->accNumber }}</td>
                            <td><span class="badge badge-{{ ($item->role ?? 'member') == 'admin' ? 'danger' : 'info' }}">{{ $item->role ?? 'member' }}</span></td>
                            <td class="text-right">
                                <button onclick="viewTransactions({{ $item->id }}, '{{ $item->username }}')" class="btn btn-info btn-sm" title="Transaksi"><i class="fas fa-history"></i></button>
                                <button data-toggle="modal" data-target="#editUserModal{{ $item->id }}" class="btn btn-warning btn-sm" title="Edit"><i class="fas fa-edit"></i></button>
                            </td>
                        </tr>

                        <!-- Edit Modal -->
                        <div class="modal fade" id="editUserModal{{ $item->id }}" tabindex="-1" role="dialog">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <form action="{{ route('user.update', $item->id) }}" method="POST">
                                        @csrf @method('PUT')
                                        <div class="modal-header">
                                            <h5 class="modal-title">Edit {{ $item->username }}</h5>
                                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="form-group"><label>Username</label><input type="text" class="form-control" name="username" value="{{ $item->username }}" required></div>
                                            <div class="form-group"><label>Password <small class="text-muted">(kosongkan jika tidak diubah)</small></label><input type="password" class="form-control" name="password"></div>
                                            <div class="form-group"><label>Email</label><input type="email" class="form-control" name="email" value="{{ $item->email }}"></div>
                                            <div class="form-group"><label>Phone</label><input type="text" class="form-control" name="phone" value="{{ $item->phone }}"></div>
                                            <div class="form-group"><label>Role</label><select class="form-control" name="role"><option value="member" {{ ($item->role ?? '') == 'member' ? 'selected' : '' }}>Member</option><option value="admin" {{ ($item->role ?? '') == 'admin' ? 'selected' : '' }}>Admin</option><option value="cashier" {{ ($item->role ?? '') == 'cashier' ? 'selected' : '' }}>Cashier</option></select></div>
                                            <div class="form-group"><label>Nama Rek</label><input type="text" class="form-control" name="accName" value="{{ $item->accName }}"></div>
                                            <div class="form-group"><label>Bank</label><input type="text" class="form-control" name="bank" value="{{ $item->bank }}"></div>
                                            <div class="form-group"><label>No Rek</label><input type="text" class="form-control" name="accNumber" value="{{ $item->accNumber }}"></div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                            <button type="submit" class="btn btn-primary">Simpan</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        @empty
                        <tr><td colspan="12" class="text-center py-4 text-muted">Tidak ada data member</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Pagination -->
        <div class="card-footer bg-white d-flex justify-content-between align-items-center">
            <span class="text-muted small">
                Menampilkan {{ ($currentPage - 1) * $perPage + 1 }}-{{ min($currentPage * $perPage, $total) }} dari {{ $total }} member
            </span>
            <nav>
                <ul class="pagination pagination-sm mb-0">
                    @if($currentPage > 1)
                        <li class="page-item"><a class="page-link" href="?page=1&per_page={{ $perPage }}&search={{ $searchTerm }}&role={{ $selectedRole }}">«</a></li>
                        <li class="page-item"><a class="page-link" href="?page={{ $currentPage-1 }}&per_page={{ $perPage }}&search={{ $searchTerm }}&role={{ $selectedRole }}">‹</a></li>
                    @endif
                    @for($i = max(1, $currentPage-2); $i <= min($lastPage, $currentPage+2); $i++)
                        <li class="page-item {{ $i == $currentPage ? 'active' : '' }}">
                            <a class="page-link" href="?page={{ $i }}&per_page={{ $perPage }}&search={{ $searchTerm }}&role={{ $selectedRole }}">{{ $i }}</a>
                        </li>
                    @endfor
                    @if($currentPage < $lastPage)
                        <li class="page-item"><a class="page-link" href="?page={{ $currentPage+1 }}&per_page={{ $perPage }}&search={{ $searchTerm }}&role={{ $selectedRole }}">›</a></li>
                        <li class="page-item"><a class="page-link" href="?page={{ $lastPage }}&per_page={{ $perPage }}&search={{ $searchTerm }}&role={{ $selectedRole }}">»</a></li>
                    @endif
                </ul>
            </nav>
        </div>
    </div>
</div>

<!-- Modal Tambah Member Baru -->
<div class="modal fade" id="tambah" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form action="/Admin/Dashboard/User" method="POST">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title">Tambah Member Baru</h5>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    <div class="form-group"><label>Username</label><input type="text" class="form-control" name="username" required></div>
                    <div class="form-group"><label>Password</label><input type="password" class="form-control" name="password" required></div>
                    <div class="form-group"><label>Email</label><input type="email" class="form-control" name="email" required></div>
                    <div class="form-group"><label>Phone</label><input type="text" class="form-control" name="phone"></div>
                    <div class="form-group"><label>WA</label><input type="text" class="form-control" name="phone"></div>
                    <div class="form-group"><label>Reff Code</label><input type="text" class="form-control" name="ref"></div>
                    <div class="form-group"><label>Nama Rek</label><input type="text" class="form-control" name="accName"></div>
                    <div class="form-group"><label>Bank</label><select name="bank" class="form-control">@foreach ($rekening as $item)<option value="{{ $item->nama_bank }}">{{ $item->nama_bank }}</option>@endforeach</select></div>
                    <div class="form-group"><label>No Rek</label><input type="text" class="form-control" name="accNumber"></div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal Transaksi Member -->
<div class="modal fade" id="trxModal" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Riwayat Transaksi - <span id="trxUsername"></span></h5>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <div class="table-responsive">
                    <table class="table table-sm table-striped">
                        <thead><tr><th>Tanggal</th><th>Tipe</th><th>Nominal</th><th>Status</th><th>Metode</th></tr></thead>
                        <tbody id="trxBody">
                            <tr><td colspan="5" class="text-center text-muted">Memuat...</td></tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
function viewTransactions(userId, username) {
    $('#trxUsername').text(username);
    $('#trxModal').modal('show');
    $('#trxBody').html('<tr><td colspan="5" class="text-center text-muted">Memuat...</td></tr>');

    var baseUrl = '{{ config("app.api_base_url") }}';

    Promise.all([
        fetch(baseUrl + '/admin/deposits?user_id=' + userId + '&per_page=200').then(function(r){return r.json();}).catch(function(){return {data:{transactions:{data:[]}}};}),
        fetch(baseUrl + '/admin/withdraws?user_id=' + userId + '&per_page=200').then(function(r){return r.json();}).catch(function(){return {data:{transactions:{data:[]}}};}),
    ]).then(function(results) {
        var all = [];
        results.forEach(function(r) {
            var txs = (r.data && r.data.transactions) ? r.data.transactions.data || [] : [];
            txs.forEach(function(t) {
                var type = t.type == 1 ? 'Deposit' : 'Withdraw';
                all.push({ date: t.created_at, type: type, amount: t.amount, status: t.status_id, method: t.payment_method || t.description || '-' });
            });
        });
        all.sort(function(a,b) { return new Date(b.date) - new Date(a.date); });

        if (all.length === 0) {
            $('#trxBody').html('<tr><td colspan="5" class="text-center text-muted">Tidak ada transaksi</td></tr>');
            return;
        }
        var html = '';
        all.forEach(function(t) {
            var statusText = t.status == 2 ? '<span class="badge badge-success">Berhasil</span>' : t.status == 3 ? '<span class="badge badge-danger">Ditolak</span>' : '<span class="badge badge-warning">Pending</span>';
            html += '<tr><td>' + new Date(t.date).toLocaleDateString('id-ID') + '</td><td>' + t.type + '</td><td>Rp ' + Number(t.amount).toLocaleString('id-ID') + '</td><td>' + statusText + '</td><td>' + t.method + '</td></tr>';
        });
        $('#trxBody').html(html);
    }).catch(function() {
        $('#trxBody').html('<tr><td colspan="5" class="text-center text-danger">Gagal memuat data</td></tr>');
    });
}
</script>
@endsection
