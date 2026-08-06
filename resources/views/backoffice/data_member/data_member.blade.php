@extends('backoffice.layouts.main')
@section('content')
<div class="container-fluid">
    @php
        $totalMember = count($users);
        $totalSaldo = collect($users)->sum('saldo');
        $totalSlot = collect($users)->sum('saldo_slot');
        $totalGame = collect($users)->sum('saldo_game');
        $totalMemberRole = collect($users)->filter(fn($u) => ($u->role ?? '') == 'member')->count();
        $totalAdmin = collect($users)->filter(fn($u) => ($u->role ?? '') == 'admin')->count();
    @endphp
    <div class="row mt-3">
        <div class="col-lg-2 col-6">
            <div class="small-box bg-info">
                <div class="inner">
                    <h3>{{ $totalMember }}</h3>
                    <p>Total Member</p>
                </div>
                <div class="icon"><i class="fas fa-users"></i></div>
            </div>
        </div>
        <div class="col-lg-2 col-6">
            <div class="small-box bg-success">
                <div class="inner">
                    <h3>Rp {{ number_format($totalSaldo, 0, ',', '.') }}</h3>
                    <p>Total Saldo</p>
                </div>
                <div class="icon"><i class="fas fa-wallet"></i></div>
            </div>
        </div>
        <div class="col-lg-2 col-6">
            <div class="small-box bg-warning">
                <div class="inner">
                    <h3>Rp {{ number_format($totalSlot, 0, ',', '.') }}</h3>
                    <p>Saldo Slot</p>
                </div>
                <div class="icon"><i class="fas fa-dice"></i></div>
            </div>
        </div>
        <div class="col-lg-2 col-6">
            <div class="small-box bg-primary">
                <div class="inner">
                    <h3>Rp {{ number_format($totalGame, 0, ',', '.') }}</h3>
                    <p>Saldo Game</p>
                </div>
                <div class="icon"><i class="fas fa-gamepad"></i></div>
            </div>
        </div>
        <div class="col-lg-2 col-6">
            <div class="small-box bg-info">
                <div class="inner">
                    <h3>{{ $totalMemberRole }}</h3>
                    <p>Member</p>
                </div>
                <div class="icon"><i class="fas fa-user"></i></div>
            </div>
        </div>
        <div class="col-lg-2 col-6">
            <div class="small-box bg-danger">
                <div class="inner">
                    <h3>{{ $totalAdmin }}</h3>
                    <p>Admin</p>
                </div>
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
                    <button type="submit" class="btn btn-primary btn-sm mr-1"><i class="fa fa-search"></i></button>
                    <button data-toggle="modal" data-target="#tambah" type="button" class="btn btn-success btn-sm"><i class="fa fa-plus"></i> Member Baru</button>
                </form>
            </div>
        </div>
        <div class="card-body p-0">
            <div class="table-responsive">
                <table id="user-table" class="table table-hover table-striped mb-0">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Tanggal</th>
                            <th>Username</th>
                            <th>Ref</th>
                            <th>Saldo</th>
                            <th>Saldo Slot</th>
                            <th>Saldo Game</th>
                            <th>Email</th>
                            <th>No WA</th>
                            <th>Bank</th>
                            <th>Nama Rekening</th>
                            <th>No Rekening</th>
                            <th>Role</th>
                            <th class="text-right">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($users as $item)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ \Carbon\Carbon::parse($item->created_at)->format('d M Y') }}</td>
                            <td><strong>{{ $item->username }}</strong></td>
                            <td>{{ $item->ref ?? '-' }}</td>
                            <td>Rp {{ number_format($item->saldo ?? 0, 0, ',', '.') }}</td>
                            <td>Rp {{ number_format($item->saldo_slot ?? 0, 0, ',', '.') }}</td>
                            <td>Rp {{ number_format($item->saldo_game ?? 0, 0, ',', '.') }}</td>
                            <td>{{ $item->email }}</td>
                            <td>{{ $item->phone ?? $item->whatsapp ?? '-' }}</td>
                            <td>{{ $item->bank ?? '-' }}</td>
                            <td>{{ $item->accName }}</td>
                            <td>{{ $item->accNumber }}</td>
                            <td><span class="badge badge-{{ ($item->role ?? 'member') == 'admin' ? 'danger' : 'info' }}">{{ $item->role ?? $item->level ?? 'member' }}</span></td>
                            <td class="text-right">
                                <button data-toggle="modal" data-target="#editUserModal{{ $item->id }}" type="button" class="btn btn-warning btn-sm"><i class="fas fa-edit"></i></button>
                            </td>
                        </tr>

                        <!-- Edit Modal -->
                        <div class="modal fade" id="editUserModal{{ $item->id }}" tabindex="-1" role="dialog">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <form action="{{ route('user.update', $item->id) }}" method="POST" enctype="multipart/form-data">
                                        @csrf @method('PUT')
                                        <div class="modal-header">
                                            <h5 class="modal-title">Ubah Data User</h5>
                                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                                        </div>
                                        <div class="modal-body">
                                            <input type="hidden" name="id" value="{{ $item->id }}">
                                            <div class="form-group">
                                                <label>Username</label>
                                                <input type="text" class="form-control" name="username" value="{{ $item->username }}" required>
                                            </div>
                                            <div class="form-group">
                                                <label>Password <small class="text-muted">(kosongkan jika tidak diubah)</small></label>
                                                <input type="password" class="form-control" name="password">
                                            </div>
                                            <div class="form-group">
                                                <label>Password Confirmation</label>
                                                <input type="password" class="form-control" name="password_confirmation">
                                            </div>
                                            <div class="form-group">
                                                <label>Email</label>
                                                <input type="email" class="form-control" name="email" value="{{ $item->email }}" required>
                                            </div>
                                            <div class="form-group">
                                                <label>Phone</label>
                                                <input type="text" class="form-control" name="phone" value="{{ $item->phone }}" required>
                                            </div>
                                            <div class="form-group">
                                                <label>Reff Code</label>
                                                <input type="text" class="form-control" name="ref" value="{{ $item->ref }}">
                                            </div>
                                            <div class="form-group">
                                                <label>Role</label>
                                                <select class="form-control" name="role">
                                                    <option value="member" {{ ($item->role ?? '') == 'member' ? 'selected' : '' }}>Member</option>
                                                    <option value="admin" {{ ($item->role ?? '') == 'admin' ? 'selected' : '' }}>Admin</option>
                                                    <option value="cashier" {{ ($item->role ?? '') == 'cashier' ? 'selected' : '' }}>Cashier</option>
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <label>Nama Rek</label>
                                                <input type="text" class="form-control" name="accName" value="{{ $item->accName }}" required>
                                            </div>
                                            <div class="form-group">
                                                <label>Bank</label>
                                                <input type="text" class="form-control" name="bank" value="{{ $item->bank }}" required>
                                            </div>
                                            <div class="form-group">
                                                <label>No Rek</label>
                                                <input type="text" class="form-control" name="accNumber" value="{{ $item->accNumber }}" required>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                            <button type="submit" class="btn btn-primary">Save changes</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        @empty
                        <tr><td colspan="14" class="text-center text-muted py-3">Tidak ada data member</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<!-- Create Modal -->
<div class="modal fade" id="tambah" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form action="/Admin/Dashboard/User" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title">Tambah Member Baru</h5>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label>Username</label>
                        <input type="text" class="form-control" name="username" required>
                    </div>
                    <div class="form-group">
                        <label>Password</label>
                        <input type="password" class="form-control" name="password" required>
                    </div>
                    <div class="form-group">
                        <label>Password Confirmation</label>
                        <input type="password" class="form-control" name="password_confirmation" required>
                    </div>
                    <div class="form-group">
                        <label>Email</label>
                        <input type="email" class="form-control" name="email" required>
                    </div>
                    <div class="form-group">
                        <label>WA</label>
                        <input type="text" class="form-control" name="phone">
                    </div>
                    <div class="form-group">
                        <label>Reff Code</label>
                        <input type="text" class="form-control" name="ref">
                    </div>
                    <div class="form-group">
                        <label>Nama Rek</label>
                        <input type="text" class="form-control" name="accName">
                    </div>
                    <div class="form-group">
                        <label>Bank</label>
                        <select name="bank" class="form-control">
                            @foreach ($rekening as $item)
                                <option value="{{ $item->nama_bank }}">{{ $item->nama_bank }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label>No Rek</label>
                        <input type="text" class="form-control" name="accNumber">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection