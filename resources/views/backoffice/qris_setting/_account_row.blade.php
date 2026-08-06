@php
    $cfg = $acc['config'] ?? [];
    $gateway = $acc['gateway'] ?? 'saweria';
    $enabled = $acc['enabled'] ?? true;
    $order = $acc['sort_order'] ?? 0;
@endphp
<div class="account-row border rounded p-3 mb-2" data-row="{{ $idx }}">
    <div class="row g-2 align-items-end">
        <div class="col-md-3">
            <label class="small text-muted">Gateway</label>
            <select name="accounts[{{ $idx }}][gateway]" class="form-control form-control-sm acc-gateway" onchange="onGatewayChange(this)">
                <option value="saweria" {{ $gateway == 'saweria' ? 'selected' : '' }}>Saweria</option>
                <option value="bayar" {{ $gateway == 'bayar' ? 'selected' : '' }}>Bayar.gg</option>
            </select>
        </div>
        <div class="col-md-3">
            <label class="small text-muted">Nama Akun</label>
            <input type="text" name="accounts[{{ $idx }}][name]" class="form-control form-control-sm"
                value="{{ $acc['name'] ?? '' }}" placeholder="Nama akun">
        </div>
        <div class="col-md-2">
            <label class="small text-muted">Aktif</label>
            <select name="accounts[{{ $idx }}][enabled]" class="form-control form-control-sm">
                <option value="1" {{ ($enabled == 1 || $enabled === true) ? 'selected' : '' }}>Ya</option>
                <option value="0" {{ ($enabled != 1 && $enabled !== true) ? 'selected' : '' }}>Tidak</option>
            </select>
        </div>
        <div class="col-md-2">
            <label class="small text-muted">Urutan</label>
            <input type="text" name="accounts[{{ $idx }}][sort_order]" class="form-control form-control-sm" value="{{ $order }}">
        </div>
        <div class="col-md-2 text-right">
            <button type="button" class="btn btn-danger btn-sm" onclick="this.closest('.account-row').remove()"><i class="fa fa-trash"></i> Hapus</button>
        </div>
    </div>
    <div class="row g-2 mt-2">
        <div class="col-md-12">
            <label class="small text-muted">Kredensial / Konfigurasi</label>
            <div class="acc-config acc-config-saweria" {{ $gateway == 'saweria' ? '' : 'style=display:none' }}>
                <div class="row">
                    <div class="col-md-4">
                        <input type="text" name="accounts[{{ $idx }}][config][username]" class="form-control form-control-sm mb-1"
                            value="{{ $cfg['username'] ?? '' }}" placeholder="Username Saweria">
                    </div>
                    <div class="col-md-4">
                        <input type="text" name="accounts[{{ $idx }}][config][email]" class="form-control form-control-sm mb-1"
                            value="{{ $cfg['email'] ?? '' }}" placeholder="Email login">
                    </div>
                    <div class="col-md-4">
                        <input type="text" name="accounts[{{ $idx }}][config][jwt]" class="form-control form-control-sm"
                            value="{{ $cfg['jwt'] ?? '' }}" placeholder="JWT token (Authorization)">
                    </div>
                </div>
            </div>
            <div class="acc-config acc-config-bayar" {{ $gateway == 'bayar' ? '' : 'style=display:none' }}>
                <div class="row">
                    <div class="col-md-4">
                        <input type="text" name="accounts[{{ $idx }}][config][api_key]" class="form-control form-control-sm mb-1"
                            value="{{ $cfg['api_key'] ?? '' }}" placeholder="API Key">
                    </div>
                    <div class="col-md-4">
                        <input type="text" name="accounts[{{ $idx }}][config][secret_key]" class="form-control form-control-sm mb-1"
                            value="{{ $cfg['secret_key'] ?? '' }}" placeholder="Secret Key">
                    </div>
                    <div class="col-md-4">
                        <input type="text" name="accounts[{{ $idx }}][config][callback_url]" class="form-control form-control-sm mb-1"
                            value="{{ $cfg['callback_url'] ?? '' }}" placeholder="Callback URL (webhook)">
                    </div>
                    <div class="col-md-4">
                        <select name="accounts[{{ $idx }}][config][use_qris_converter]" class="form-control form-control-sm mb-1">
                            <option value="1" {{ ($cfg['use_qris_converter'] ?? '1') == '1' ? 'selected' : '' }}>Gunakan QRIS Converter</option>
                            <option value="0" {{ ($cfg['use_qris_converter'] ?? '1') != '1' ? 'selected' : '' }}>QRIS String Pribadi</option>
                        </select>
                    </div>
                    <div class="col-md-4">
                        <input type="text" name="accounts[{{ $idx }}][config][qris_string]" class="form-control form-control-sm"
                            value="{{ $cfg['qris_string'] ?? '' }}" placeholder="QRIS string pribadi (opsional)">
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
