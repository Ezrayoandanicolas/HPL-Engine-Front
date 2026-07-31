@extends('backoffice.layouts.main')
@section('content')
<div class="container-fluid">
    @php
        $total = count($Game);
        $providers = collect($Game)->groupBy('game_provider');
    @endphp
    <div class="row mt-3">
        <div class="col-lg-3 col-6">
            <div class="small-box bg-info">
                <div class="inner"><h3>{{ $total }}</h3><p>Total Game</p></div>
                <div class="icon"><i class="fas fa-gamepad"></i></div>
            </div>
        </div>
        @foreach($providers as $prov => $glist)
        <div class="col-lg-3 col-6">
            <div class="small-box" style="background:{{ ['#6f42c1','#fd7e14','#20c997','#e83e8c','#17a2b8','#ffc107','#dc3545','#28a745','#007bff','#6c757d'][$loop->index % 10] }};">
                <div class="inner"><h3>{{ count($glist) }}</h3><p>{{ $prov }}</p></div>
                <div class="icon"><i class="fas fa-folder"></i></div>
            </div>
        </div>
        @endforeach
    </div>
    <div class="card">
        <div class="card-header">
            <h4 class="card-title"><i class="fas fa-cog mr-2"></i> Game Settings</h4>
            <div class="card-tools">
                <form method="GET" class="form-inline" style="display:inline-flex;gap:4px">
                    <select name="provider" class="form-control form-control-sm" onchange="this.form.submit()">
                        <option value="">Semua Provider</option>
                        @foreach($provider as $pr)
                        @php $pr = (object) $pr; @endphp
                        <option value="{{ $pr->provider_code }}" {{ request('provider', 'PRAGMATIC') == $pr->provider_code ? 'selected' : '' }}>{{ $pr->provider_name }}</option>
                        @endforeach
                    </select>
                </form>
            </div>
        </div>
        <div class="card-body p-0">
            <div class="table-responsive">
                <table id="game-table" class="table table-hover table-striped mb-0">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Game</th>
                            <th>Kode</th>
                            <th>Provider</th>
                            <th>Gambar</th>
                            <th>Status</th>
                            <th class="text-right">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($Game as $g)
                        @php $g = (object) $g; @endphp
                        <tr data-id="{{ $g->id }}">
                            <td>{{ $loop->iteration }}</td>
                            <td><strong>{{ $g->game_name }}</strong></td>
                            <td><code>{{ $g->game_code }}</code></td>
                            <td>{{ $g->game_provider }}</td>
                            <td>
                                @if($g->image_url ?? $g->game_image ?? false)
                                <img src="{{ $g->image_url ?? $g->game_image }}" style="max-height:32px;border-radius:4px">
                                @else
                                <span class="text-muted">-</span>
                                @endif
                            </td>
                            <td>
                                <span class="badge badge-{{ $g->status == 1 ? 'success' : 'secondary' }}">{{ $g->status == 1 ? 'Aktif' : 'Nonaktif' }}</span>
                            </td>
                            <td class="text-right">
                                <button class="btn btn-warning btn-sm btn-edit" title="Edit"><i class="fas fa-pen"></i></button>
                            </td>
                        </tr>
                        @empty
                        <tr><td colspan="7" class="text-center text-muted py-3">Tidak ada game</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<!-- Edit Modal -->
<div class="modal fade" id="editModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <form id="editForm" method="POST" enctype="multipart/form-data">
                @csrf @method('PUT')
                <div class="modal-header">
                    <h5 class="modal-title">Edit Game</h5>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label>Nama Game</label>
                        <input type="text" name="game_name" id="edit_name" class="form-control" readonly>
                    </div>
                    <div class="form-group">
                        <label>Kode Game</label>
                        <input type="text" name="game_code" id="edit_code" class="form-control" readonly>
                    </div>
                    <div class="form-group">
                        <label>Provider</label>
                        <input type="text" name="game_provider" id="edit_provider" class="form-control" readonly>
                    </div>
                    <div class="form-group">
                        <label>Ganti Gambar</label>
                        <div class="custom-file">
                            <input type="file" class="custom-file-input" name="img" id="edit_img" accept=".jpg,.jpeg,.png,.webp">
                            <label class="custom-file-label" for="edit_img">Pilih file</label>
                        </div>
                        <div id="edit_img_preview" class="mt-2"></div>
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
    $('#game-table').DataTable({
        paging: true, lengthChange: false, searching: true, ordering: true, info: false, autoWidth: false, responsive: true
    });

    $(document).on('click', '.btn-edit', function() {
        var id = $(this).closest('tr').data('id');
        $.get('/Admin/Dashboard/Game-setting/' + id, function(res) {
            var g = res.game;
            $('#edit_name').val(g.game_name);
            $('#edit_code').val(g.game_code);
            $('#edit_provider').val(g.game_provider);
            $('#edit_img_preview').html('');
            if (g.image) {
                $('#edit_img_preview').html('<img src="' + g.image + '" style="max-height:80px;border-radius:4px">');
            }
            $('#editForm').attr('action', '/Admin/Dashboard/Game-setting/' + g.id);
            $('#editModal').modal('show');
        });
    });

    $('.custom-file-input').on('change', function() {
        var name = $(this).val().split('\\').pop();
        $(this).next('.custom-file-label').html(name);
    });
});
</script>
@endsection