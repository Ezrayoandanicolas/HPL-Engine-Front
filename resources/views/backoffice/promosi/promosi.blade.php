@extends('backoffice.layouts.main')
@section('content')
<div class="container-fluid">
    @php
        $total = count($promotions);
        $active = collect($promotions)->filter(fn($p) => ($p->status ?? 0) == 1)->count();
        $totalBonus = collect($promotions)->sum('bonus');
    @endphp
    <div class="row mt-3">
        <div class="col-lg-4 col-6">
            <div class="small-box bg-info">
                <div class="inner">
                    <h3>{{ $total }}</h3>
                    <p>Total Promosi</p>
                </div>
                <div class="icon"><i class="fas fa-bullhorn"></i></div>
            </div>
        </div>
        <div class="col-lg-4 col-6">
            <div class="small-box bg-success">
                <div class="inner">
                    <h3>{{ $active }}</h3>
                    <p>Aktif</p>
                </div>
                <div class="icon"><i class="fas fa-check-circle"></i></div>
            </div>
        </div>
        <div class="col-lg-4 col-6">
            <div class="small-box bg-warning">
                <div class="inner">
                    <h3>{{ $total }}</h3>
                    <p>Periode Aktif</p>
                </div>
                <div class="icon"><i class="fas fa-calendar"></i></div>
            </div>
        </div>
    </div>
    <div class="card">
        <div class="card-header">
            <h4 class="card-title">Data Promosi</h4>
            <div class="card-tools">
                <button data-toggle="modal" data-target="#tambah" type="button" class="btn btn-primary btn-sm"><i class="fas fa-plus"></i> Buat Promosi Baru</button>
            </div>
        </div>
        <div class="card-body p-0">
            <div class="table-responsive">
                <table id="promotion-table" class="table table-hover table-striped mb-0">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Title</th>
                            <th>Bonus</th>
                            <th>Jenis Pemberian</th>
                            <th>Jenis Promosi</th>
                            <th>Min Deposit</th>
                            <th>Max Deposit</th>
                            <th>Status</th>
                            <th class="text-right">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($promotions as $p)
                        <tr data-promotion-id="{{ $p->id }}">
                            <td>{{ $loop->iteration }}</td>
                            <td><strong>{{ $p->title }}</strong></td>
                            <td>{{ $p->bonus }}</td>
                            <td>{{ $p->jenis_pemberian }}</td>
                            <td><span class="badge badge-info">{{ $p->jenis_promosi }}</span></td>
                            <td>Rp {{ number_format($p->min_deposite ?? 0, 0, ',', '.') }}</td>
                            <td>Rp {{ number_format($p->max_deposite ?? 0, 0, ',', '.') }}</td>
                            <td>
                                @if(($p->status ?? 1) == 1)
                                <span class="badge badge-success">Aktif</span>
                                @else
                                <span class="badge badge-danger">Nonaktif</span>
                                @endif
                            </td>
                            <td class="text-right">
                                <button class="btn btn-warning btn-sm btn-edit" data-toggle="modal" data-target="#editModal" title="Edit"><i class="fas fa-pen"></i></button>
                                <button type="button" data-toggle="modal" data-target="#confirmationModal" class="btn btn-danger btn-sm btn-delete" title="Hapus"><i class="fas fa-trash"></i></button>
                            </td>
                        </tr>
                        @empty
                        <tr><td colspan="9" class="text-center text-muted py-3">Belum ada promosi</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<!-- Create Modal -->
<div class="modal fade" id="tambah" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <form action="/Admin/Dashboard/Promotion" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title">Buat Promosi Baru</h5>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Judul <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" name="title" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Keterangan <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" name="keterangan" required>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Bonus <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" name="bonus" required>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Turnover <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" name="turnover" required>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Jenis Pemberian <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" name="jenis_pemberian" required>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Jenis Promosi <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" name="jenis_promosi" required>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Min Deposit <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" name="min_deposite" required>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Max Deposit <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" name="max_deposite" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Tanggal Mulai <span class="text-danger">*</span></label>
                                <input type="date" class="form-control" name="tanggal_mulai" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Tanggal Akhir <span class="text-danger">*</span></label>
                                <input type="date" class="form-control" name="tanggal_akhir" required>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-group">
                                <label>Gambar Promosi</label>
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input" id="imgCreate" name="img" accept=".jpg,.jpeg,.png,.webp">
                                    <label class="custom-file-label" for="imgCreate">Pilih file</label>
                                </div>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-group">
                                <label>Deskripsi <span class="text-danger">*</span></label>
                                <input id="bodyCreate" type="hidden" name="body">
                                <trix-editor input="bodyCreate"></trix-editor>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Edit Modal -->
<div class="modal fade" id="editModal" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit Promosi</h5>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <form id="editPromotionForm" action="" method="POST" enctype="multipart/form-data">
                    @csrf @method('PUT')
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Judul <span class="text-danger">*</span></label>
                                <input id="edit-title" type="text" class="form-control" name="title" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Keterangan <span class="text-danger">*</span></label>
                                <input id="edit-keterangan" type="text" class="form-control" name="keterangan" required>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Bonus <span class="text-danger">*</span></label>
                                <input id="edit-bonus" type="text" class="form-control" name="bonus" required>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Turnover <span class="text-danger">*</span></label>
                                <input id="edit-turnover" type="text" class="form-control" name="turnover" required>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Jenis Pemberian <span class="text-danger">*</span></label>
                                <input id="edit-jenis_pemberian" type="text" class="form-control" name="jenis_pemberian" required>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Jenis Promosi <span class="text-danger">*</span></label>
                                <input id="edit-jenis_promosi" type="text" class="form-control" name="jenis_promosi" required>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Min Deposit <span class="text-danger">*</span></label>
                                <input id="edit-min_deposite" type="text" class="form-control" name="min_deposite" required>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Max Deposit <span class="text-danger">*</span></label>
                                <input id="edit-max_deposite" type="text" class="form-control" name="max_deposite" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Tanggal Mulai <span class="text-danger">*</span></label>
                                <input id="edit-tanggal_mulai" type="date" class="form-control" name="tanggal_mulai" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Tanggal Akhir <span class="text-danger">*</span></label>
                                <input id="edit-tanggal_akhir" type="date" class="form-control" name="tanggal_akhir" required>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-group">
                                <label>Gambar Promosi</label>
                                <div id="edit-image-preview" class="mb-2"></div>
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input" id="edit-image" name="img" accept=".jpg,.jpeg,.png,.webp">
                                    <label class="custom-file-label" for="edit-image">Pilih file</label>
                                </div>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-group">
                                <label>Deskripsi <span class="text-danger">*</span></label>
                                <input id="edit-body" type="hidden" name="body">
                                <trix-editor input="edit-body"></trix-editor>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer px-0 pb-0">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-warning">Simpan Perubahan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Delete Modal -->
<div class="modal fade" id="confirmationModal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Konfirmasi Hapus</h5>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <p>Apakah Anda yakin ingin menghapus promosi ini?</p>
                <p class="text-danger mb-0"><small>Tindakan ini tidak dapat dibatalkan.</small></p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                <form id="deletePromotionForm" action="" method="POST">
                    @csrf @method('DELETE')
                    <button type="submit" class="btn btn-danger">Hapus</button>
                </form>
            </div>
        </div>
    </div>
</div>

<link rel="stylesheet" type="text/css" href="/css/trix.css">
<script type="text/javascript" src="/js/trix.js"></script>
<style>
    trix-toolbar [data-trix-button-group="file-tools"] { display: none; }
</style>
<script>
document.addEventListener('trix-file-accept', function(e) { e.preventDefault(); });

$(function() {
    $('#promotion-table').DataTable({
        paging: true, lengthChange: false, searching: true, ordering: true, info: false, autoWidth: false, responsive: true
    });

    $(document).on('click', '.btn-edit', function() {
        var id = $(this).closest('tr').data('promotion-id');
        $.get('/Admin/Dashboard/Promotion/' + id, function(res) {
            var p = res.promotion;
            $('#editPromotionForm').attr('action', '/Admin/Dashboard/Promotion/' + p.id);
            $('#edit-title').val(p.title);
            $('#edit-keterangan').val(p.keterangan);
            $('#edit-bonus').val(p.bonus);
            $('#edit-turnover').val(p.turnover);
            $('#edit-jenis_pemberian').val(p.jenis_pemberian);
            $('#edit-jenis_promosi').val(p.jenis_promosi);
            $('#edit-min_deposite').val(p.min_deposite);
            $('#edit-max_deposite').val(p.max_deposite);
            $('#edit-tanggal_mulai').val(p.tanggal_mulai);
            $('#edit-tanggal_akhir').val(p.tanggal_akhir);
            $('#edit-body').val(p.body);
            if (p.img) {
                $('#edit-image-preview').html('<img src="{{ storageBaseUrl() }}' + p.img + '" class="img-thumbnail" style="max-height:80px">');
            } else {
                $('#edit-image-preview').html('<span class="text-muted">Belum ada gambar</span>');
            }
        });
    });

    $(document).on('click', '.btn-delete', function() {
        var id = $(this).closest('tr').data('promotion-id');
        $('#deletePromotionForm').attr('action', '/Admin/Dashboard/Promotion/' + id);
    });
});
</script>
@endsection