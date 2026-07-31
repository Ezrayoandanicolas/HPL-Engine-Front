@extends('backoffice.layouts.main')
@section('content')
<div class="container-fluid">
    @php
        $total = count($menus);
        $categories = collect($menus)->groupBy('category')->map(fn($g) => $g->count());
    @endphp
    <div class="row mt-3">
        <div class="col-lg-3 col-6">
            <div class="small-box bg-info">
                <div class="inner">
                    <h3>{{ $total }}</h3>
                    <p>Total Menu</p>
                </div>
                <div class="icon"><i class="fas fa-list"></i></div>
            </div>
        </div>
        @foreach($categories as $cat => $count)
        <div class="col-lg-3 col-6">
            <div class="small-box" style="background:{{ ['#6f42c1','#fd7e14','#20c997','#e83e8c','#17a2b8','#ffc107','#dc3545'][$loop->index % 7] }};">
                <div class="inner">
                    <h3>{{ $count }}</h3>
                    <p>{{ $cat }}</p>
                </div>
                <div class="icon"><i class="fas fa-folder"></i></div>
            </div>
        </div>
        @endforeach
    </div>
    <div class="card">
        <div class="card-header">
            <h4 class="card-title"><i class="fas fa-bars mr-2"></i> Menu Navigasi</h4>
            <div class="card-tools">
                <form method="GET" class="form-inline" style="display:inline-flex;gap:4px">
                    <input type="text" name="search" class="form-control form-control-sm" placeholder="Cari..." value="{{ request('search') }}">
                    <select name="category" class="form-control form-control-sm">
                        <option value="">Semua Kategori</option>
                        <option value="Hot Games" {{ request('category')=='Hot Games' ? 'selected' : '' }}>Hot Games</option>
                        <option value="Slots" {{ request('category')=='Slots' ? 'selected' : '' }}>Slots</option>
                        <option value="Live Casino" {{ request('category')=='Live Casino' ? 'selected' : '' }}>Live Casino</option>
                        <option value="Sports" {{ request('category')=='Sports' ? 'selected' : '' }}>Sports</option>
                        <option value="Arcade" {{ request('category')=='Arcade' ? 'selected' : '' }}>Arcade</option>
                        <option value="Poker" {{ request('category')=='Poker' ? 'selected' : '' }}>Poker</option>
                        <option value="Sabung Ayam" {{ request('category')=='Sabung Ayam' ? 'selected' : '' }}>Sabung Ayam</option>
                    </select>
                    <button class="btn btn-primary btn-sm" type="submit"><i class="fas fa-search"></i></button>
                </form>
                <button class="btn btn-success btn-sm mr-1" onclick="syncGGR(event)"><i class="fas fa-sync mr-1"></i> Sync Provider</button>
                <button class="btn btn-warning btn-sm mr-1" onclick="syncGames(event)"><i class="fas fa-database mr-1"></i> Sync Games</button>
                <button class="btn btn-primary btn-sm" data-toggle="modal" data-target="#addModal"><i class="fas fa-plus"></i> Tambah Item</button>
            </div>
        </div>
        <div class="card-body p-0">
            <div class="table-responsive">
                <table id="menu-table" class="table table-hover table-striped mb-0">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Kategori</th>
                            <th>Judul</th>
                            <th>URL</th>
                            <th>Gambar</th>
                            <th>Aktif</th>
                            <th class="text-right">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($menus as $m)
                        @php $m = (object) $m; @endphp
                        <tr data-id="{{ $m->id }}">
                            <td>{{ $loop->iteration }}</td>
                            <td><span class="badge badge-info">{{ $m->category }}</span></td>
                            <td><strong>{{ $m->title }}</strong></td>
                            <td><code>{{ $m->url }}</code></td>
                            <td>
                                @if($m->image)
                                <img src="{{ $m->image }}" style="max-height:36px;border-radius:4px">
                                @else
                                <span class="text-muted">-</span>
                                @endif
                            </td>
                            <td>
                                <span class="badge badge-{{ $m->is_active ? 'success' : 'secondary' }}">{{ $m->is_active ? 'Ya' : 'Tidak' }}</span>
                            </td>
                            <td class="text-right">
                                <button class="btn btn-warning btn-sm btn-edit" title="Edit"><i class="fas fa-pen"></i></button>
                                <form action="/Admin/Dashboard/Navigation-Menu/{{ $m->id }}" method="POST" style="display:inline" onsubmit="return confirm('Hapus menu ini?')">
                                    @csrf @method('DELETE')
                                    <button class="btn btn-danger btn-sm" title="Hapus"><i class="fas fa-trash"></i></button>
                                </form>
                            </td>
                        </tr>
                        @empty
                        <tr><td colspan="7" class="text-center text-muted py-3">Belum ada menu</td></tr>
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
            <form action="/Admin/Dashboard/Navigation-Menu" method="POST">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title">Tambah Item Menu</h5>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label>Kategori</label>
                        <select name="category" class="form-control" required>
                            <option value="Hot Games">Hot Games</option>
                            <option value="Slots">Slots</option>
                            <option value="Live Casino">Live Casino</option>
                            <option value="Sports">Sports</option>
                            <option value="Arcade">Arcade</option>
                            <option value="Poker">Poker</option>
                            <option value="Sabung Ayam">Sabung Ayam</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Judul</label>
                        <input type="text" name="title" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label>URL</label>
                        <input type="text" name="url" class="form-control" required value="/slots">
                    </div>
                    <div class="form-group">
                        <label>Gambar (URL)</label>
                        <input type="text" name="image" class="form-control" placeholder="https://...">
                    </div>
                    <div class="form-group">
                        <label>Aktif</label>
                        <select name="is_active" class="form-control">
                            <option value="1">Ya</option>
                            <option value="0">Tidak</option>
                        </select>
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
<div class="modal fade" id="editModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <form id="editForm" method="POST">
                @csrf @method('PUT')
                <div class="modal-header">
                    <h5 class="modal-title">Edit Item Menu</h5>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label>Kategori</label>
                        <select name="category" id="edit_category" class="form-control" required>
                            <option value="Hot Games">Hot Games</option>
                            <option value="Slots">Slots</option>
                            <option value="Live Casino">Live Casino</option>
                            <option value="Sports">Sports</option>
                            <option value="Arcade">Arcade</option>
                            <option value="Poker">Poker</option>
                            <option value="Sabung Ayam">Sabung Ayam</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Judul</label>
                        <input type="text" name="title" id="edit_title" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label>URL</label>
                        <input type="text" name="url" id="edit_url" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label>Gambar (URL)</label>
                        <input type="text" name="image" id="edit_image" class="form-control" placeholder="https://...">
                    </div>
                    <div class="form-group">
                        <label>Aktif</label>
                        <select name="is_active" id="edit_is_active" class="form-control">
                            <option value="1">Ya</option>
                            <option value="0">Tidak</option>
                        </select>
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
function syncGGR(e) {
    if (!confirm('Sync provider dari GGR? Data akan ditambahkan/diupdate.')) return;
    var btn = e.target.closest('button');
    btn.disabled = true; btn.innerHTML = '<i class="fas fa-spinner fa-spin mr-1"></i> Sync...';
    fetch('/Admin/Dashboard/Navigation-Menu/sync-ggr', { method: 'POST', headers: { 'X-CSRF-TOKEN': '{{ csrf_token() }}' } })
    .then(function(r){ return r.json(); }).then(function(d){
        btn.disabled = false; btn.innerHTML = '<i class="fas fa-sync mr-1"></i> Sync Provider';
        if (d.success) alert('Sync selesai! ' + (d.data?.synced || 0) + ' provider baru.');
        else alert('Gagal: ' + (d.message || 'unknown'));
        location.reload();
    }).catch(function(){ btn.disabled = false; btn.innerHTML = '<i class="fas fa-sync mr-1"></i> Sync Provider'; });
}

function syncGames(e) {
    if (!confirm('Sync ALL games dari GGR? Proses bisa memakan waktu.')) return;
    var btn = e.target.closest('button');
    btn.disabled = true; btn.innerHTML = '<i class="fas fa-spinner fa-spin mr-1"></i> Sync Games...';
    fetch('/Admin/Dashboard/Navigation-Menu/sync-games', { method: 'POST', headers: { 'X-CSRF-TOKEN': '{{ csrf_token() }}' } })
    .then(function(r){ return r.json(); }).then(function(d){
        btn.disabled = false; btn.innerHTML = '<i class="fas fa-database mr-1"></i> Sync Games';
        if (d.success) alert('Sync selesai! ' + (d.data?.total_games || 0) + ' game dari ' + (d.data?.providers_synced || 0) + ' provider.');
        else alert('Gagal: ' + (d.message || 'unknown'));
        location.reload();
    }).catch(function(){ btn.disabled = false; btn.innerHTML = '<i class="fas fa-database mr-1"></i> Sync Games'; });
}

$(function() {
    $('#menu-table').DataTable({
        paging: true, lengthChange: false, searching: true, ordering: true, info: false, autoWidth: false, responsive: true
    });

    $(document).on('click', '.btn-edit', function() {
        var row = $(this).closest('tr');
        var id = row.data('id');
        var category = row.find('td:eq(1)').text().trim();
        var title = row.find('td:eq(2)').text().trim();
        var url = row.find('td:eq(3) code').text().trim();
        var img = row.find('td:eq(4) img').attr('src') || '';
        var active = row.find('td:eq(5) .badge').text().trim() === 'Ya' ? '1' : '0';

        $('#edit_category').val(category);
        $('#edit_title').val(title);
        $('#edit_url').val(url);
        $('#edit_image').val(img);
        $('#edit_is_active').val(active);
        $('#editForm').attr('action', '/Admin/Dashboard/Navigation-Menu/' + id);
        $('#editModal').modal('show');
    });
});
</script>
@endsection