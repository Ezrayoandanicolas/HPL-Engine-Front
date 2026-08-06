@extends('backoffice.layouts.main')

@section('content')
    <style>
        .account-row .form-control-sm {
            height: auto;
            min-height: 31px;
        }
    </style>
    <div class="card mt-3">
        <div class="card-header">
            Konfigurasi Deposit QRIS (Saweria & Bayar.gg)
        </div>
        <div class="card-body">
            @if (session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif
            @if (session('error'))
                <div class="alert alert-danger">{{ session('error') }}</div>
            @endif

            <form action="/Admin/Dashboard/Qris-Setting" method="POST">
                @csrf

                <div class="row mb-3">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Status QRIS</label>
                            <select name="qris_enabled" class="form-control">
                                <option value="1" {{ (($settings->qris_enabled ?? '0') == '1') ? 'selected' : '' }}>Aktif</option>
                                <option value="0" {{ (($settings->qris_enabled ?? '0') != '1') ? 'selected' : '' }}>Nonaktif</option>
                            </select>
                            <small class="form-text text-muted">Jika nonaktif, member tidak bisa deposit QRIS.</small>
                        </div>
                    </div>
                </div>

                <h5 class="mt-3">Daftar Akun QRIS <small class="text-muted">(rotasi otomatis antar akun aktif)</small></h5>
                <hr>
                <div id="qris-accounts">
                    @forelse ($accounts as $idx => $acc)
                        @include('backoffice.qris_setting._account_row', [
                            'acc' => $acc,
                            'idx' => $idx,
                        ])
                    @empty
                        @include('backoffice.qris_setting._account_row', [
                            'acc' => null,
                            'idx' => 0,
                        ])
                    @endforelse
                </div>
                <button type="button" class="btn btn-secondary btn-sm" id="btn-add-account"><i class="fa fa-plus"></i> Tambah Akun</button>

                <div class="row mt-4">
                    <div class="col-md-12">
                        <button type="submit" class="btn btn-primary">Simpan Pengaturan</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <script>
    function rowHtml(rand) {
        return `<div class="account-row border rounded p-3 mb-2" data-row="${rand}">
            <div class="row g-2 align-items-end">
                <div class="col-md-3">
                    <label class="small text-muted">Gateway</label>
                    <select name="accounts[${rand}][gateway]" class="form-control form-control-sm acc-gateway" onchange="onGatewayChange(this)">
                        <option value="saweria">Saweria</option>
                        <option value="bayar">Bayar.gg</option>
                    </select>
                </div>
                <div class="col-md-3">
                    <label class="small text-muted">Nama Akun</label>
                    <input type="text" name="accounts[${rand}][name]" class="form-control form-control-sm" placeholder="Nama akun">
                </div>
                <div class="col-md-2">
                    <label class="small text-muted">Aktif</label>
                    <select name="accounts[${rand}][enabled]" class="form-control form-control-sm">
                        <option value="1">Ya</option>
                        <option value="0">Tidak</option>
                    </select>
                </div>
                <div class="col-md-2">
                    <label class="small text-muted">Urutan</label>
                    <input type="text" name="accounts[${rand}][sort_order]" class="form-control form-control-sm" value="0">
                </div>
                <div class="col-md-2 text-right">
                    <button type="button" class="btn btn-danger btn-sm" onclick="this.closest('.account-row').remove()"><i class="fa fa-trash"></i> Hapus</button>
                </div>
            </div>
            <div class="row g-2 mt-2">
                <div class="col-md-12">
                    <label class="small text-muted">Kredensial / Konfigurasi</label>
                    <div class="acc-config acc-config-saweria">
                        <div class="row">
                            <div class="col-md-4"><input type="text" name="accounts[${rand}][config][username]" class="form-control form-control-sm mb-1" placeholder="Username Saweria"></div>
                            <div class="col-md-4"><input type="text" name="accounts[${rand}][config][email]" class="form-control form-control-sm mb-1" placeholder="Email login"></div>
                            <div class="col-md-4"><input type="text" name="accounts[${rand}][config][jwt]" class="form-control form-control-sm" placeholder="JWT token (Authorization)"></div>
                        </div>
                    </div>
                    <div class="acc-config acc-config-bayar" style="display:none">
                        <div class="row">
                            <div class="col-md-4"><input type="text" name="accounts[${rand}][config][api_key]" class="form-control form-control-sm mb-1" placeholder="API Key"></div>
                            <div class="col-md-4"><input type="text" name="accounts[${rand}][config][secret_key]" class="form-control form-control-sm mb-1" placeholder="Secret Key"></div>
                            <div class="col-md-4"><input type="text" name="accounts[${rand}][config][callback_url]" class="form-control form-control-sm mb-1" placeholder="Callback URL (webhook)"></div>
                            <div class="col-md-4"><select name="accounts[${rand}][config][use_qris_converter]" class="form-control form-control-sm mb-1">
                                <option value="1">Gunakan QRIS Converter</option>
                                <option value="0">QRIS String Pribadi</option>
                            </select></div>
                            <div class="col-md-4"><input type="text" name="accounts[${rand}][config][qris_string]" class="form-control form-control-sm" placeholder="QRIS string pribadi (opsional)"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>`;
    }

    function onGatewayChange(select) {
        var box = select.closest('.account-row');
        box.querySelector('.acc-config-saweria').style.display = select.value === 'saweria' ? '' : 'none';
        box.querySelector('.acc-config-bayar').style.display = select.value === 'bayar' ? '' : 'none';
    }

    document.addEventListener('DOMContentLoaded', function() {
        var container = document.getElementById('qris-accounts');
        var btnAdd = document.getElementById('btn-add-account');

        btnAdd.addEventListener('click', function() {
            var max = 0;
            container.querySelectorAll('.account-row').forEach(function(r) {
                var n = parseInt(r.getAttribute('data-row'));
                if (!isNaN(n) && n > max) max = n;
            });
            var rand = max + 1;
            container.insertAdjacentHTML('beforeend', rowHtml(rand));
            var lastRow = container.lastElementChild;
            var sel = lastRow.querySelector('.acc-gateway');
            if (sel) onGatewayChange(sel);
        });

        container.querySelectorAll('.acc-gateway').forEach(function(sel) { onGatewayChange(sel); });
    });
    </script>
@endsection
