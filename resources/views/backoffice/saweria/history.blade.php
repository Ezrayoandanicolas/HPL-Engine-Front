@extends('backoffice.layouts.main')
@section('content')
<div class="container-fluid">
    <div class="card mt-3">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h4 class="card-title mb-0"><i class="fas fa-money-bill-wave mr-2"></i> Riwayat Donasi Saweria</h4>
            <div>
                <span class="badge badge-success font-weight-bold mr-2" id="saweriaBalance">Balance: -</span>
                <button class="btn btn-sm btn-outline-primary" onclick="loadBalance()"><i class="fa fa-sync"></i> Refresh</button>
            </div>
        </div>
        <div class="card-body">
            <div id="saweriaResult">
                <p class="text-muted"><i class="fas fa-spinner fa-spin"></i> Memuat data...</p>
            </div>
        </div>
    </div>
</div>

<script>
var CSRF = '{{ csrf_token() }}';

function loadBalance() {
    $.get('{{ URL::to("Admin/Dashboard/Saweria/balance") }}', { _token: CSRF }, function(res) {
        if (res.success && res.data && res.data.balance !== null) {
            $('#saweriaBalance').text('Balance: Rp ' + Number(res.data.balance).toLocaleString('id-ID'));
        } else {
            $('#saweriaBalance').text('Balance: -');
        }
    }).fail(function() {
        $('#saweriaBalance').text('Balance: Error');
    });
}

function loadTransactions(page) {
    page = page || 1;
    $('#saweriaResult').html('<p class="text-muted"><i class="fas fa-spinner fa-spin"></i> Memuat data...</p>');

    $.get('{{ URL::to("Admin/Dashboard/Saweria/transactions") }}', {
        _token: CSRF,
        page: page,
        page_size: 50
    }, function(res) {
        if (!res.success) {
            $('#saweriaResult').html('<div class="alert alert-warning">' + (res.message || 'Gagal memuat data') + '</div>');
            return;
        }

        var txns = (res.data && res.data.transactions) || [];
        if (txns.length === 0) {
            $('#saweriaResult').html('<div class="alert alert-info">Tidak ada transaksi ditemukan.</div>');
            return;
        }

        var total = res.data.total || txns.length;
        var html = '<div class="table-responsive"><table class="table table-bordered table-hover table-sm">';
        html += '<thead class="thead-dark"><tr>';
        html += '<th>#</th><th>ID</th><th>Amount</th><th>Status</th><th>Message</th><th>Payment</th><th>Waktu</th>';
        html += '</tr></thead><tbody>';

        txns.forEach(function(t, i) {
            var status = (t.status || '').toLowerCase();
            var badge = 'secondary';
            if (status === 'paid' || status === 'completed') badge = 'success';
            else if (status === 'pending') badge = 'warning';
            else if (status === 'expired' || status === 'failed') badge = 'danger';

            var amount = Number(t.amount_raw || t.amount || 0).toLocaleString('id-ID');
            var date = t.created_at ? new Date(t.created_at).toLocaleString('id-ID') : '-';

            html += '<tr>';
            html += '<td>' + ((page - 1) * 50 + i + 1) + '</td>';
            html += '<td><small>' + (t.id || '-') + '</small></td>';
            html += '<td class="font-weight-bold">Rp ' + amount + '</td>';
            html += '<td><span class="badge badge-' + badge + '">' + (t.status || '-') + '</span></td>';
            html += '<td>' + (t.message || '-') + '</td>';
            html += '<td>' + (t.payment_type || '-') + '</td>';
            html += '<td><small>' + date + '</small></td>';
            html += '</tr>';
        });

        html += '</tbody></table></div>';

        var totalPages = Math.ceil(total / 50);
        if (totalPages > 1) {
            html += '<nav><ul class="pagination pagination-sm justify-content-center">';
            for (var p = 1; p <= totalPages; p++) {
                html += '<li class="page-item ' + (p === page ? 'active' : '') + '">';
                html += '<a class="page-link" href="#" onclick="loadTransactions(' + p + '); return false;">' + p + '</a></li>';
            }
            html += '</ul></nav>';
        }

        html += '<p class="text-muted text-right mt-2"><small>Total: ' + total + ' transaksi</small></p>';

        $('#saweriaResult').html(html);
    }).fail(function(jqXHR) {
        $('#saweriaResult').html('<div class="alert alert-danger">Gagal memuat data transaksi.</div>');
    });
}

$(function() {
    loadBalance();
    loadTransactions(1);
});
</script>
@endsection
