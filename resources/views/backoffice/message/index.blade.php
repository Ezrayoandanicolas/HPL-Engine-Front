@extends('backoffice.layouts.main')
@section('content')
<div class="container-fluid">
    @php
        $total = count($messages);
        $broadcast = collect($messages)->where('type', 'broadcast')->count();
        $private = collect($messages)->where('type', 'private')->count();
    @endphp
    <div class="row mt-3">
        <div class="col-lg-4 col-6">
            <div class="small-box bg-info"><div class="inner"><h3>{{ $total }}</h3><p>Total Pesan</p></div><div class="icon"><i class="fas fa-envelope"></i></div></div>
        </div>
        <div class="col-lg-4 col-6">
            <div class="small-box bg-primary"><div class="inner"><h3>{{ $broadcast }}</h3><p>Broadcast</p></div><div class="icon"><i class="fas fa-bullhorn"></i></div></div>
        </div>
        <div class="col-lg-4 col-6">
            <div class="small-box bg-warning"><div class="inner"><h3>{{ $private }}</h3><p>Private</p></div><div class="icon"><i class="fas fa-user"></i></div></div>
        </div>
    </div>
    <div class="card">
        <div class="card-header">
            <h4 class="card-title"><i class="fas fa-envelope mr-2"></i> Pesan ke Member</h4>
            <div class="card-tools">
                <button class="btn btn-success btn-sm" data-toggle="modal" data-target="#addModal"><i class="fas fa-plus mr-1"></i> Kirim Pesan</button>
            </div>
        </div>
        <div class="card-body p-0">
            <div class="table-responsive">
                <table id="message-table" class="table table-hover table-striped mb-0">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Tipe</th>
                            <th>Judul</th>
                            <th>Pesan</th>
                            <th>Kepada</th>
                            <th>Status</th>
                            <th>Waktu</th>
                            <th class="text-right">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($messages as $m)
                        @php $m = (object) $m; @endphp
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td><span class="badge badge-{{ $m->type == 'broadcast' ? 'info' : 'warning' }}">{{ $m->type == 'broadcast' ? 'Broadcast' : 'Private' }}</span></td>
                            <td><strong>{{ $m->title }}</strong></td>
                            <td style="max-width:250px;overflow:hidden;text-overflow:ellipsis;white-space:nowrap">{{ strip_tags($m->body) }}</td>
                            <td>{{ $m->type == 'broadcast' ? 'Semua Member' : ($m->recipient_id ?? '-') }}</td>
                            <td>
                                @if($m->type == 'broadcast')
                                <span class="text-muted">-</span>
                                @else
                                <span class="badge badge-{{ $m->is_read ? 'success' : 'secondary' }}">{{ $m->is_read ? 'Dibaca' : 'Belum' }}</span>
                                @endif
                            </td>
                            <td><small>{{ \Carbon\Carbon::parse($m->created_at)->format('d M H:i') }}</small></td>
                            <td class="text-right">
                                <form action="/Admin/Dashboard/Message/{{ $m->id }}" method="POST" style="display:inline" onsubmit="return confirm('Hapus pesan ini?')">
                                    @csrf @method('DELETE')
                                    <button class="btn btn-danger btn-sm"><i class="fas fa-trash"></i></button>
                                </form>
                            </td>
                        </tr>
                        @empty
                        <tr><td colspan="8" class="text-center text-muted py-3">Belum ada pesan</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<!-- Add Modal -->
<div class="modal fade" id="addModal" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <form method="POST">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title">Kirim Pesan</h5>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Tipe</label>
                                <select name="type" class="form-control" id="msgType" onchange="toggleRecipient()">
                                    <option value="broadcast">Broadcast (Semua Member)</option>
                                    <option value="private">Private (Member Tertentu)</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6" id="recipientField" style="display:none">
                            <div class="form-group">
                                <label>Pilih Member</label>
                                <select name="recipient_id" class="form-control">
                                    <option value="">-- Pilih --</option>
                                    @foreach($users as $u)
                                    @php $u = (object) $u; @endphp
                                    <option value="{{ $u->id }}">{{ $u->username }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Judul</label>
                        <input type="text" name="title" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label>Isi Pesan</label>
                        <textarea name="body" class="form-control" rows="5" required></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-success">Kirim</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
function toggleRecipient() {
    $('#recipientField').toggle($('#msgType').val() === 'private');
}
$(function() {
    $('#message-table').DataTable({
        paging: true, lengthChange: false, searching: true, ordering: true, info: false, autoWidth: false, responsive: true
    });
});
</script>
@endsection