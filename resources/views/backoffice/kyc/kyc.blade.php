@extends('backoffice.layouts.main')
@section('content')
<script>
function previewImage(src) {
    $('#imagePreview').attr('src', src);
    $('#imageModal').modal('show');
}
function kycRow(v, idx) {
    var badge = v.status === 'menunggu' ? 'badge-warning' : (v.status === 'verifikasi' ? 'badge-success' : 'badge-danger');
    var label = v.status === 'menunggu' ? 'Menunggu' : (v.status === 'verifikasi' ? 'Terverifikasi' : 'Ditolak');
    var imgHtml = v.img ? '<a href="javascript:void(0)" onclick="previewImage(\'/storage/' + v.img + '\')"><img src="/storage/' + v.img + '" class="img-thumbnail" style="max-height:50px"></a>' : '<span class="text-muted">-</span>';
    var csrf = $('meta[name="csrf-token"]').attr('content');
    var u = v.user || {};
    var aksi = '';
    if (v.status === 'menunggu') {
        aksi = '<form action="/Admin/Dashboard/Kyc/' + v.id + '" method="POST" style="display:inline">' +
               '<input type="hidden" name="_token" value="' + csrf + '">' +
               '<input type="hidden" name="_method" value="PUT">' +
               '<input type="hidden" name="action" value="acc">' +
               '<button type="submit" class="badge bg-success border-0 mx-1">ACCEPT</button></form>' +
               '<form action="/Admin/Dashboard/Kyc/' + v.id + '" method="POST" style="display:inline">' +
               '<input type="hidden" name="_token" value="' + csrf + '">' +
               '<input type="hidden" name="_method" value="PUT">' +
               '<input type="hidden" name="action" value="tolak">' +
               '<button class="badge bg-danger border-0" onclick="return confirm(\'Are you sure?\')">Tolak</button></form>';
    } else {
        aksi = '<span class="badge ' + badge + '">' + label + '</span>';
    }
    return '<tr>' +
        '<td>' + idx + '</td>' +
        '<td>' + moment(v.created_at).fromNow() + '</td>' +
        '<td><strong>' + (u.username || '-') + '</strong></td>' +
        '<td>' + (v.fullName || '-') + '</td>' +
        '<td>' + imgHtml + '</td>' +
        '<td><span class="badge ' + badge + '">' + label + '</span></td>' +
        '<td class="text-right">' + aksi + '</td>' +
        '</tr>';
}
$(function() {
    var lastId = {{ collect($verifikasi)->max('id') ?? 0 }};
    var rowCount = {{ count($verifikasi) }};
    function checkNew() {
        $.get('/Admin/Dashboard/Kyc/new-verifications', { since_id: lastId, status: '{{ request('status', 'menunggu') }}' }, function(res) {
            if (res.verifications && res.verifications.length) {
                res.verifications.forEach(function(v) {
                    rowCount++;
                    $('#kyc-table tbody').append(kycRow(v, rowCount));
                });
                lastId = res.verifications[res.verifications.length - 1].id;
            }
        });
    }
    setInterval(checkNew, 10000);
});
</script>
<div class="container-fluid">
    @php
        $totalAll = count($verifikasi);
        $totalMenunggu = collect($verifikasi)->filter(fn($v) => ($v['status'] ?? '') == 'menunggu')->count();
        $totalVerif = collect($verifikasi)->filter(fn($v) => ($v['status'] ?? '') == 'verifikasi')->count();
        $totalTolak = collect($verifikasi)->filter(fn($v) => ($v['status'] ?? '') == 'ditolak')->count();
    @endphp
    <div class="row mt-3">
        <div class="col-lg-3 col-6">
            <div class="small-box bg-info">
                <div class="inner">
                    <h3>{{ $totalAll }}</h3>
                    <p>Total KYC</p>
                </div>
                <div class="icon"><i class="fas fa-id-card"></i></div>
            </div>
        </div>
        <div class="col-lg-3 col-6">
            <div class="small-box bg-warning">
                <div class="inner">
                    <h3>{{ $totalMenunggu }}</h3>
                    <p>Menunggu</p>
                </div>
                <div class="icon"><i class="fas fa-clock"></i></div>
            </div>
        </div>
        <div class="col-lg-3 col-6">
            <div class="small-box bg-success">
                <div class="inner">
                    <h3>{{ $totalVerif }}</h3>
                    <p>Terverifikasi</p>
                </div>
                <div class="icon"><i class="fas fa-check-circle"></i></div>
            </div>
        </div>
        <div class="col-lg-3 col-6">
            <div class="small-box bg-danger">
                <div class="inner">
                    <h3>{{ $totalTolak }}</h3>
                    <p>Ditolak</p>
                </div>
                <div class="icon"><i class="fas fa-times"></i></div>
            </div>
        </div>
    </div>
    <div class="card">
        <div class="card-header">
            <h4 class="card-title">Verifikasi KYC</h4>
            <div class="card-tools">
                <form method="GET" class="form-inline">
                    <select name="status" class="form-control form-control-sm mr-1">
                        <option value="menunggu" {{ request('status', 'menunggu') == 'menunggu' ? 'selected' : '' }}>Menunggu</option>
                        <option value="verifikasi" {{ request('status') == 'verifikasi' ? 'selected' : '' }}>Terverifikasi</option>
                        <option value="ditolak" {{ request('status') == 'ditolak' ? 'selected' : '' }}>Ditolak</option>
                        <option value="">Semua</option>
                    </select>
                    <input type="text" name="search" class="form-control form-control-sm mr-1" placeholder="Cari username..." value="{{ request('search') }}">
                    <button type="submit" class="btn btn-primary btn-sm"><i class="fa fa-search"></i></button>
                </form>
            </div>
        </div>
        <div class="card-body p-0">
            <div class="table-responsive">
                <table id="kyc-table" class="table table-hover table-striped mb-0">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Tanggal</th>
                            <th>Username</th>
                            <th>Full Name</th>
                            <th>Berkas</th>
                            <th>Status</th>
                            <th class="text-right">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($verifikasi as $v)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ \Carbon\Carbon::parse($v['created_at'] ?? '')->diffForHumans() }}</td>
                            <td><strong>{{ $v['user']['username'] ?? '-' }}</strong></td>
                            <td>{{ $v['fullName'] ?? '-' }}</td>
                            <td>
                                @if (!empty($v['img']))
                                <a href="javascript:void(0)" onclick="previewImage('{{ asset('storage/' . $v['img']) }}')">
                                    <img src="{{ asset('storage/' . $v['img']) }}" alt="KYC" class="img-thumbnail" style="max-height:50px">
                                </a>
                                @else
                                <span class="text-muted">-</span>
                                @endif
                            </td>
                            <td>
                                @php $s = $v['status'] ?? ''; @endphp
                                @if($s == 'menunggu')
                                    <span class="badge badge-warning">Menunggu</span>
                                @elseif($s == 'verifikasi')
                                    <span class="badge badge-success">Terverifikasi</span>
                                @elseif($s == 'ditolak')
                                    <span class="badge badge-danger">Ditolak</span>
                                @else
                                    <span class="badge badge-secondary">{{ $s }}</span>
                                @endif
                            </td>
                            <td class="text-right">
                                @if($s == 'menunggu')
                                <form action="/Admin/Dashboard/Kyc/{{ $v['id'] }}" method="POST" style="display:inline">
                                    @csrf @method('PUT')
                                    <input type="hidden" name="action" value="acc">
                                    <button type="submit" class="badge bg-success border-0 mx-1">ACCEPT</button>
                                </form>
                                <form action="/Admin/Dashboard/Kyc/{{ $v['id'] }}" method="POST" style="display:inline">
                                    @csrf @method('PUT')
                                    <input type="hidden" name="action" value="tolak">
                                    <button class="badge bg-danger border-0" onclick="return confirm('Are you sure?')">Tolak</button>
                                </form>
                                @else
                                <span class="badge badge-secondary">Selesai</span>
                                @endif
                            </td>
                        </tr>
                        @empty
                        <tr><td colspan="7" class="text-center text-muted py-3">Tidak ada data KYC</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
</div>

<div class="modal fade" id="imageModal" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-md" role="document">
        <div class="modal-content">
            <div class="modal-body p-0">
                <img id="imagePreview" src="" class="img-fluid">
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
            </div>
        </div>
    </div>
</div>
@endsection