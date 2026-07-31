@extends('backoffice.layouts.main')
@section('content')
<script>
function previewImage(src) {
    $('#imagePreview').attr('src', src);
    $('#imageModal').modal('show');
}
function depositRow(t, idx) {
    var status = parseInt(t.status_id);
    var badge = status === 1 ? 'badge-warning' : (status === 2 ? 'badge-success' : 'badge-danger');
    var label = status === 1 ? 'Pending' : (status === 2 ? 'Sukses' : 'Ditolak');
    var img = t.img ? '<a href="javascript:void(0)" onclick="previewImage(\'{{ storageBaseUrl() }}' + t.img + '\')"><img src="{{ storageBaseUrl() }}' + t.img + '" class="img-thumbnail" style="max-height:50px"></a>' : '<span class="text-muted">-</span>';
    var u = t.user || {};
    var csrf = $('meta[name="csrf-token"]').attr('content');
    var aksi = '';
    if (status === 1) {
        aksi = '<form action="/Admin/Dashboard/Tranksaksi/' + t.id + '/update" method="POST" style="display:inline">' +
               '<input type="hidden" name="_token" value="' + csrf + '">' +
               '<input type="hidden" name="_method" value="PUT">' +
               '<input type="hidden" name="action" value="acc">' +
               '<button type="submit" class="btn btn-success btn-sm"><i class="fas fa-check"></i> Acc</button></form>' +
               '<form action="/Admin/Dashboard/Tranksaksi/' + t.id + '/update" method="POST" style="display:inline" onsubmit="return confirm(\'Tolak deposit ini?\')">' +
               '<input type="hidden" name="_token" value="' + csrf + '">' +
               '<input type="hidden" name="_method" value="PUT">' +
               '<input type="hidden" name="action" value="tolak">' +
               '<button type="submit" class="btn btn-danger btn-sm"><i class="fas fa-times"></i> Tolak</button></form>';
    } else if (status === 2) {
        aksi = '<span class="badge badge-success">Sudah di ACC</span>';
    } else {
        aksi = '<span class="badge badge-danger">Sudah ditolak</span>';
    }
    return '<tr>' +
        '<td>' + idx + '</td>' +
        '<td>' + moment(t.created_at).fromNow() + '</td>' +
        '<td><strong>' + (u.username || '-') + '</strong></td>' +
        '<td>' + (u.accName || '-') + '</td>' +
        '<td>' + (u.bank || '-') + '</td>' +
        '<td>' + (u.accNumber || '-') + '</td>' +
        '<td>Rp ' + new Intl.NumberFormat('id-ID').format(t.amount || 0) + '</td>' +
        '<td><span class="badge ' + badge + '">' + label + '</span></td>' +
        '<td>' + img + '</td>' +
        '<td class="text-right">' + aksi + '</td>' +
        '</tr>';
}
$(function() {
    var lastId = {{ collect($Tranksaksi)->max('id') ?? 0 }};
    var rowCount = {{ count($Tranksaksi) }};
    function checkNew() {
        $.get('/Admin/Dashboard/Tranksaksi/new-deposits', { since_id: lastId, status_id: 1 }, function(res) {
            if (res.transactions && res.transactions.length) {
                var tbody = $('#deposit-table1 tbody');
                res.transactions.forEach(function(t) {
                    rowCount++;
                    tbody.append(depositRow(t, rowCount));
                });
                lastId = res.transactions[res.transactions.length - 1].id;
            }
        });
    }
    setInterval(checkNew, 10000);
});
</script>
<div id="depositContent" class="container-fluid">
    @if (Auth()->User()->role == 'admin')
        @include('backoffice.deposit.partials._admin_table', ['Tranksaksi' => $Tranksaksi])
    @elseif(Auth()->User()->role == 'promotor')
        @include('backoffice.deposit.partials._promotor_table', ['userrefDeposite' => $userrefDeposite])
    @endif
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
