@extends('backoffice.layouts.main')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <a href="{{ URL::to('Admin/Dashboard/Fiver') }}" class="btn btn-secondary mb-3">Kembali</a>

            <div class="card">
                <div class="card-header"><h5>Detail Transaksi Provider</h5></div>
                <div class="card-body">
                    <table class="table table-bordered">
                        <tr><th style="width:200px">ID</th><td>{{ $tx->id }}</td></tr>
                        <tr><th>Agent Sign</th><td><code>{{ $tx->agent_sign }}</code></td></tr>
                        <tr><th>Username</th><td>{{ $tx->username }}</td></tr>
                        <tr><th>Tipe</th><td>{{ $tx->type }}</td></tr>
                        <tr><th>Jumlah</th><td>Rp {{ number_format($tx->amount, 2, ',', '.') }}</td></tr>
                        <tr>
                            <th>Status</th>
                            <td>
                                @if($tx->status == 'success')
                                    <span class="badge badge-success">Sukses</span>
                                @elseif($tx->status == 'failed')
                                    <span class="badge badge-danger">Gagal</span>
                                @else
                                    <span class="badge badge-warning">Pending</span>
                                @endif
                            </td>
                        </tr>
                        <tr><th>Pesan</th><td>{{ $tx->message ?? '-' }}</td></tr>
                        <tr><th>Dibuat</th><td>{{ $tx->created_at }}</td></tr>
                    </table>

                    @if($tx->response_raw)
                    <div class="mt-3">
                        <h6>Response Raw</h6>
                        <pre style="max-height:400px;overflow:auto;background:#1e1e1e;color:#d4d4d4;padding:15px;border-radius:5px;">{{ json_encode(json_decode($tx->response_raw), JSON_PRETTY_PRINT) }}</pre>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
