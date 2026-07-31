@extends('backoffice.layouts.main')
@section('content')
<div class="container-fluid">
    @php
        $totalBanner = count($Banner);
        $totalAktif = collect($Banner)->filter(fn($b) => ($b->status ?? 0) == 1)->count();
        $totalNonaktif = collect($Banner)->filter(fn($b) => ($b->status ?? 0) != 1)->count();
    @endphp
    <div class="row mt-3">
        <div class="col-lg-4 col-6">
            <div class="small-box bg-info">
                <div class="inner">
                    <h3>{{ $totalBanner }}</h3>
                    <p>Total Banner</p>
                </div>
                <div class="icon"><i class="fas fa-images"></i></div>
            </div>
        </div>
        <div class="col-lg-4 col-6">
            <div class="small-box bg-success">
                <div class="inner">
                    <h3>{{ $totalAktif }}</h3>
                    <p>Aktif</p>
                </div>
                <div class="icon"><i class="fas fa-check-circle"></i></div>
            </div>
        </div>
        <div class="col-lg-4 col-6">
            <div class="small-box bg-danger">
                <div class="inner">
                    <h3>{{ $totalNonaktif }}</h3>
                    <p>Nonaktif</p>
                </div>
                <div class="icon"><i class="fas fa-times-circle"></i></div>
            </div>
        </div>
    </div>
    <div class="card">
        <div class="card-header">
            <h4 class="card-title">Banner Halaman Utama</h4>
            <div class="card-tools">
                <button data-toggle="modal" data-target="#tambah_banner" type="button" class="btn btn-primary btn-sm"><i class="fas fa-plus"></i> Tambah Banner</button>
            </div>
        </div>
        <div class="card-body p-0">
            <div class="table-responsive">
                <table id="banner-table" class="table table-hover table-striped mb-0">
                    <thead>
                        <tr>
                            <th style="width:5%">No</th>
                            <th style="width:25%">Judul</th>
                            <th style="width:35%">Gambar</th>
                            <th style="width:10%">Status</th>
                            <th style="width:25%" class="text-right">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($Banner as $item)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td><strong>{{ $item->Judul }}</strong></td>
                            <td>
                                <a href="javascript:void(0)" onclick="previewBanner('{{ asset('storage/' . $item->img) }}')">
                                    <img src="{{ asset('storage/' . $item->img) }}" class="img-thumbnail" style="max-height:60px">
                                </a>
                            </td>
                            <td>
                                @if ($item->status == 1)
                                    <span class="badge badge-success">Aktif</span>
                                @else
                                    <span class="badge badge-danger">Off</span>
                                @endif
                            </td>
                            <td class="text-right">
                                @if ($item->status == 1)
                                <button data-toggle="modal" data-target="#non{{ $item->id }}" type="button" class="btn btn-dark btn-sm" title="Nonaktifkan"><i class="fas fa-eye-slash"></i></button>
                                @else
                                <button data-toggle="modal" data-target="#aktif{{ $item->id }}" type="button" class="btn btn-success btn-sm" title="Aktifkan"><i class="fas fa-eye"></i></button>
                                @endif
                                <button data-toggle="modal" data-target="#ubah_banner{{ $item->id }}" type="button" class="btn btn-warning btn-sm" title="Ubah"><i class="fas fa-pen"></i></button>
                                <button data-toggle="modal" data-target="#hapus_banner{{ $item->id }}" type="button" class="btn btn-danger btn-sm" title="Hapus"><i class="fas fa-trash"></i></button>
                            </td>
                        </tr>
                        @empty
                        <tr><td colspan="5" class="text-center text-muted py-3">Belum ada banner</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<!-- Create Modal -->
<div class="modal fade" id="tambah_banner" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form action="/Admin/Dashboard/Banner" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title">Tambah Banner</h5>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label>Judul Banner</label>
                        <input name="Judul" type="text" class="form-control" placeholder="Judul Banner" required>
                    </div>
                    <div class="form-group">
                        <label>Gambar</label>
                        <div class="custom-file">
                            <input type="file" class="custom-file-input" id="imgCreate" name="img" accept="image/png,image/jpg,image/jpeg,image/webp" required>
                            <label class="custom-file-label" for="imgCreate">Pilih file gambar</label>
                        </div>
                        <small class="text-muted">Format: PNG, JPG, JPEG, WEBP. Maks 4MB</small>
                    </div>
                    <input type="hidden" name="status" value="1">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>

@foreach ($Banner as $item)
<!-- Nonaktifkan Modal -->
<div class="modal fade" id="non{{ $item->id }}" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form action="/Admin/Dashboard/Banner/{{ $item->id }}" method="POST">
                @csrf @method('PUT')
                <div class="modal-header">
                    <h5 class="modal-title">Nonaktifkan Banner</h5>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    <p>Apakah anda yakin akan menonaktifkan banner <strong>{{ $item->Judul }}</strong>?</p>
                </div>
                <input type="hidden" name="status" value="2">
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-dark">Nonaktifkan</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Aktifkan Modal -->
<div class="modal fade" id="aktif{{ $item->id }}" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form action="/Admin/Dashboard/Banner/{{ $item->id }}" method="POST">
                @csrf @method('PUT')
                <div class="modal-header">
                    <h5 class="modal-title">Aktifkan Banner</h5>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    <p>Apakah anda yakin akan mengaktifkan banner <strong>{{ $item->Judul }}</strong>?</p>
                </div>
                <input type="hidden" name="status" value="1">
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-success">Aktifkan</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Hapus Modal -->
<div class="modal fade" id="hapus_banner{{ $item->id }}" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form action="/Admin/Dashboard/Banner/{{ $item->id }}" method="POST">
                @csrf @method('DELETE')
                <div class="modal-header">
                    <h5 class="modal-title">Hapus Banner</h5>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    <p>Apakah anda yakin akan menghapus banner <strong>{{ $item->Judul }}</strong>?</p>
                    <p class="text-danger mb-0"><small>Tindakan ini tidak dapat dibatalkan.</small></p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-danger">Hapus</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Edit Modal -->
<div class="modal fade" id="ubah_banner{{ $item->id }}" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form action="/Admin/Dashboard/Banner/{{ $item->id }}" method="POST" enctype="multipart/form-data">
                @csrf @method('PUT')
                <div class="modal-header">
                    <h5 class="modal-title">Ubah Banner</h5>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label>Judul</label>
                        <input type="text" class="form-control" name="Judul" value="{{ $item->Judul }}">
                    </div>
                    <div class="form-group">
                        <label>Gambar Saat Ini</label>
                        <div><img src="{{ asset('storage/' . $item->img) }}" class="img-thumbnail" style="max-height:80px"></div>
                    </div>
                    <div class="form-group">
                        <label>Ganti Gambar <small class="text-muted">(kosongkan jika tidak diubah)</small></label>
                        <div class="custom-file">
                            <input type="file" class="custom-file-input" id="imgEdit{{ $item->id }}" name="img" accept="image/png,image/jpg,image/jpeg,image/webp">
                            <label class="custom-file-label" for="imgEdit{{ $item->id }}">Pilih file</label>
                        </div>
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
@endforeach

<!-- Preview Modal -->
<div class="modal fade" id="previewModal" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Preview Banner</h5>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body p-0">
                <img id="previewImg" src="" class="img-fluid w-100">
            </div>
        </div>
    </div>
</div>

<script>
function previewBanner(src) {
    $('#previewImg').attr('src', src);
    $('#previewModal').modal('show');
}
$(function() {
    $('#banner-table').DataTable({
        paging: true, lengthChange: false, searching: true, ordering: true, info: false, autoWidth: false, responsive: true,
        columnDefs: [
            { width: '5%', targets: 0 },
            { width: '25%', targets: 1 },
            { width: '35%', targets: 2 },
            { width: '10%', targets: 3 },
            { width: '25%', targets: 4 }
        ]
    });
});
</script>
@endsection