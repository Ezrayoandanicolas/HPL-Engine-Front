@extends('backoffice.layouts.main')
@section('content')
<div class="container-fluid">
    @php
        $total = count($bonus);
        $aktif = collect($bonus)->where('status', 1)->count();
        $nonaktif = collect($bonus)->where('status', '!=', 1)->count();
    @endphp
    <div class="row mt-3">
        <div class="col-lg-4 col-6">
            <div class="small-box bg-info">
                <div class="inner">
                    <h3>{{ $total }}</h3>
                    <p>Total Bonus</p>
                </div>
                <div class="icon"><i class="fas fa-gift"></i></div>
            </div>
        </div>
        <div class="col-lg-4 col-6">
            <div class="small-box bg-success">
                <div class="inner">
                    <h3>{{ $aktif }}</h3>
                    <p>Aktif</p>
                </div>
                <div class="icon"><i class="fas fa-check-circle"></i></div>
            </div>
        </div>
        <div class="col-lg-4 col-6">
            <div class="small-box bg-danger">
                <div class="inner">
                    <h3>{{ $nonaktif }}</h3>
                    <p>Nonaktif</p>
                </div>
                <div class="icon"><i class="fas fa-times-circle"></i></div>
            </div>
        </div>
    </div>
    <div class="card">
        <div class="card-header">
            <h4 class="card-title"><i class="fas fa-gift mr-2"></i> Data Bonus</h4>
            <div class="card-tools">
                <form method="GET" class="form-inline" style="display:inline-flex;gap:4px">
                    <input type="text" name="search" class="form-control form-control-sm" placeholder="Cari judul/keterangan..." value="{{ request('search') }}">
                    <button class="btn btn-primary btn-sm" type="submit"><i class="fas fa-search"></i></button>
                </form>
                <button class="btn btn-success btn-sm ml-1" data-toggle="modal" data-target="#addModal"><i class="fas fa-plus mr-1"></i> Bonus Baru</button>
            </div>
        </div>
        <div class="card-body p-0">
            <div class="table-responsive">
                <table id="bonus-table" class="table table-hover table-striped mb-0">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Judul</th>
                            <th>Keterangan</th>
                            <th>Nominal</th>
                            <th>Status</th>
                            <th class="text-right">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($bonus as $item)
                        @php $item = (object) $item; @endphp
                        <tr data-id="{{ $item->id }}">
                            <td>{{ $loop->iteration }}</td>
                            <td><strong>{{ $item->title }}</strong></td>
                            <td>{{ $item->keterangan }}</td>
                            <td>{{ $item->bonus }}%</td>
                            <td>
                                <span class="badge badge-{{ $item->status == 1 ? 'success' : 'secondary' }}">
                                    {{ $item->status == 1 ? 'Aktif' : 'Off' }}
                                </span>
                            </td>
                            <td class="text-right">
                                <button class="btn btn-warning btn-sm btn-edit" title="Edit"><i class="fas fa-pen"></i></button>
                                <form action="/Admin/Dashboard/Bonus/{{ $item->id }}/toggle-status" method="POST" style="display:inline">
                                    @csrf
                                    <button class="btn btn-{{ $item->status == 1 ? 'danger' : 'primary' }} btn-sm" title="{{ $item->status == 1 ? 'Nonaktifkan' : 'Aktifkan' }}">
                                        <i class="fas fa-{{ $item->status == 1 ? 'times' : 'check' }}"></i>
                                    </button>
                                </form>
                                <form action="/Admin/Dashboard/Bonus/{{ $item->id }}" method="POST" style="display:inline" onsubmit="return confirm('Hapus bonus ini?')">
                                    @csrf @method('DELETE')
                                    <button class="btn btn-danger btn-sm" title="Hapus"><i class="fas fa-trash"></i></button>
                                </form>
                            </td>
                        </tr>
                        @empty
                        <tr><td colspan="6" class="text-center text-muted py-3">Belum ada bonus</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<!-- Add Modal -->
<div class="modal fade" id="addModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="/Admin/Dashboard/Bonus" method="POST">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title">Tambah Bonus</h5>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label>Judul</label>
                        <input type="text" name="judul" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label>Keterangan</label>
                        <input type="text" name="keterangan" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label>Nominal (%)</label>
                        <input type="number" name="nominal" class="form-control" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-success">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Edit Modal -->
<div class="modal fade" id="editModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <form id="editForm" method="POST">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title">Edit Bonus</h5>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label>Judul</label>
                        <input type="text" name="judul" id="edit_judul" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label>Keterangan</label>
                        <input type="text" name="keterangan" id="edit_keterangan" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label>Nominal (%)</label>
                        <input type="number" name="nominal" id="edit_nominal" class="form-control" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-warning">Simpan Perubahan</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
$(function() {
    $('#bonus-table').DataTable({
        paging: true, lengthChange: false, searching: false, ordering: true, info: false, autoWidth: false, responsive: true
    });

    $(document).on('click', '.btn-edit', function() {
        var id = $(this).closest('tr').data('id');
        $.get('/Admin/Dashboard/Bonus/' + id, function(res) {
            var p = res.bonus;
            $('#edit_judul').val(p.title);
            $('#edit_keterangan').val(p.keterangan);
            $('#edit_nominal').val(p.bonus);
            $('#editForm').attr('action', '/Admin/Dashboard/Bonus/' + p.id);
            $('#editModal').modal('show');
        });
    });
});
</script>
@endsection