@extends('backoffice.layouts.main')
@section('content')
<div class="container-fluid">
    <div class="row mt-3">
        <div class="col-12">
            <div class="card card-outline" style="border-top: 3px solid #6f42c1;">
                <div class="card-header d-flex align-items-center justify-content-between">
                    <h4 class="card-title mb-0"><i class="fas fa-exchange-alt text-purple mr-2"></i> Pengaturan Game Provider</h4>
                    <small class="text-muted">Pilih API yang dipakai untuk slot & live casino</small>
                </div>
                <div class="card-body">
                    {{-- STATUS AKTIF --}}
                    @php $isDc = $current === 'dc'; $isXapi = $current === 'xapi'; @endphp
                    <div class="alert d-flex align-items-center justify-content-between flex-wrap"
                         style="background:{{ ($isDc || $isXapi) ? 'linear-gradient(135deg,#7c3aed,#a855f7)' : 'linear-gradient(135deg,#0ea5e9,#06b6d4)' }};border:none;border-radius:12px;color:#fff;">
                        <div>
                            <div class="text-uppercase" style="font-size:11px;letter-spacing:1px;opacity:.85;">Provider Aktif Sekarang</div>
                            <div class="font-weight-bold" style="font-size:22px;">
                                <i class="fas {{ ($isDc || $isXapi) ? 'fa-crown' : 'fa-server' }} mr-2"></i>{{ $label }}
                            </div>
                        </div>
                        <div class="text-right">
                            <div style="font-size:11px;text-transform:uppercase;letter-spacing:1px;opacity:.85;">Saldo Agent</div>
                            <div class="font-weight-bold" style="font-size:20px;">
                                Rp {{ number_format(($isDc ? ($balances['dcBalance'] ?? 0) : ($isXapi ? ($balances['xapiBalance'] ?? 0) : ($balances['agentBalance'] ?? 0))), 0, ',', '.') }}
                            </div>
                        </div>
                    </div>

                    {{-- PILIH PROVIDER --}}
                    <h6 class="mt-4 mb-3 font-weight-bold text-uppercase" style="letter-spacing:.5px;">
                        <i class="fas fa-random mr-1"></i> Pilih API
                    </h6>
                    <div class="row">
                        {{-- FIVER --}}
                        <div class="col-md-6 mb-3">
                            <div class="card h-100 {{ $current === 'fiver' ? 'border-primary shadow' : '' }}" style="border-radius:12px;">
                                <div class="card-body">
                                    <div class="d-flex align-items-center justify-content-between mb-2">
                                        <h5 class="mb-0"><i class="fas fa-server text-info mr-2"></i>Fiver</h5>
                                        @if($current === 'fiver')
                                            <span class="badge badge-success px-3 py-2">AKTIF</span>
                                        @endif
                                    </div>
                                    <p class="text-muted mb-3" style="font-size:13px;">Provider lama (NexusGGR / fiver).</p>
                                    <div class="d-flex justify-content-between align-items-center">
                                        <div>
                                            <div class="text-muted" style="font-size:11px;">SALDO AGENT</div>
                                            <div class="font-weight-bold" style="font-size:18px;">Rp {{ number_format($balances['agentBalance'] ?? 0, 0, ',', '.') }}</div>
                                        </div>
                                        @if($current !== 'fiver')
                                            <form action="{{ URL::to('Admin/Dashboard/GameProvider/switch') }}" method="POST">
                                                @csrf
                                                <input type="hidden" name="provider" value="fiver">
                                                <button type="submit" class="btn btn-outline-primary btn-sm">Gunakan Fiver</button>
                                            </form>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>

                        {{-- DIGITAL CREATIVE --}}
                        <div class="col-md-6 mb-3">
                            <div class="card h-100 {{ $current === 'dc' ? 'border-primary shadow' : '' }}" style="border-radius:12px;">
                                <div class="card-body">
                                    <div class="d-flex align-items-center justify-content-between mb-2">
                                        <h5 class="mb-0"><i class="fas fa-crown text-purple mr-2"></i>Digital Creative</h5>
                                        @if($current === 'dc')
                                            <span class="badge badge-success px-3 py-2">AKTIF</span>
                                        @endif
                                    </div>
                                    <p class="text-muted mb-3" style="font-size:13px;">Provider baru (digital-creative.cloud).</p>
                                    <div class="d-flex justify-content-between align-items-center">
                                        <div>
                                            <div class="text-muted" style="font-size:11px;">SALDO AGENT</div>
                                            <div class="font-weight-bold" style="font-size:18px;">Rp {{ number_format($balances['dcBalance'] ?? 0, 0, ',', '.') }}</div>
                                        </div>
                                        @if($current !== 'dc')
                                            <form action="{{ URL::to('Admin/Dashboard/GameProvider/switch') }}" method="POST">
                                                @csrf
                                                <input type="hidden" name="provider" value="dc">
                                                <button type="submit" class="btn btn-outline-success btn-sm" onclick="return confirm('Ganti provider game ke Digital Creative?')">Gunakan Digital Creative</button>
                                            </form>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>

                        {{-- X-API --}}
                        <div class="col-md-6 mb-3">
                            <div class="card h-100 {{ $current === 'xapi' ? 'border-primary shadow' : '' }}" style="border-radius:12px;">
                                <div class="card-body">
                                    <div class="d-flex align-items-center justify-content-between mb-2">
                                        <h5 class="mb-0"><i class="fas fa-bolt text-warning mr-2"></i>X-API</h5>
                                        @if($current === 'xapi')
                                            <span class="badge badge-success px-3 py-2">AKTIF</span>
                                        @endif
                                    </div>
                                    <p class="text-muted mb-3" style="font-size:13px;">Clone DC (x-api.asia), cara kerja sama.</p>
                                    <div class="d-flex justify-content-between align-items-center">
                                        <div>
                                            <div class="text-muted" style="font-size:11px;">SALDO AGENT</div>
                                            <div class="font-weight-bold" style="font-size:18px;">Rp {{ number_format($balances['xapiBalance'] ?? 0, 0, ',', '.') }}</div>
                                        </div>
                                        @if($current !== 'xapi')
                                            <form action="{{ URL::to('Admin/Dashboard/GameProvider/switch') }}" method="POST">
                                                @csrf
                                                <input type="hidden" name="provider" value="xapi">
                                                <button type="submit" class="btn btn-outline-warning btn-sm" onclick="return confirm('Ganti provider game ke X-API?')">Gunakan X-API</button>
                                            </form>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- SYNC DIGITAL CREATIVE --}}
                    <h6 class="mt-4 mb-3 font-weight-bold text-uppercase" style="letter-spacing:.5px;">
                        <i class="fas fa-sync mr-1"></i> Sinkronisasi Digital Creative
                    </h6>
                    <div class="row">
                        <div class="col-md-4 mb-3">
                            <div class="card" style="border-radius:12px;">
                                <div class="card-body">
                                    <h6 class="mb-1"><i class="fas fa-layer-group text-warning mr-1"></i> Sync Providers</h6>
                                    <p class="text-muted mb-3" style="font-size:13px;">Tarik daftar provider DC & buat menu navigasi.</p>
                                    <form action="{{ URL::to('Admin/Dashboard/GameProvider/sync-providers') }}" method="POST">
                                        @csrf
                                        <button type="submit" class="btn btn-warning btn-sm btn-block">Sync Providers</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4 mb-3">
                            <div class="card" style="border-radius:12px;">
                                <div class="card-body">
                                    <h6 class="mb-1"><i class="fas fa-gamepad text-success mr-1"></i> Sync Games</h6>
                                    <p class="text-muted mb-3" style="font-size:13px;">Sync games untuk satu provider tertentu.</p>
                                    <form action="{{ URL::to('Admin/Dashboard/GameProvider/sync-games') }}" method="POST">
                                        @csrf
                                        <div class="input-group input-group-sm mb-2">
                                            <input type="text" name="provider_code" class="form-control" placeholder="Contoh: PRAGMATIC" required>
                                            <div class="input-group-append">
                                                <button type="submit" class="btn btn-success">Sync</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4 mb-3">
                            <div class="card" style="border-radius:12px;">
                                <div class="card-body">
                                    <h6 class="mb-1"><i class="fas fa-database text-danger mr-1"></i> Sync All Games</h6>
                                    <p class="text-muted mb-3" style="font-size:13px;">Tarik semua games dari semua provider DC aktif.</p>
                                    <form action="{{ URL::to('Admin/Dashboard/GameProvider/sync-all-games') }}" method="POST">
                                        @csrf
                                        <button type="submit" class="btn btn-danger btn-sm btn-block" onclick="return confirm('Sync SEMUA games dari semua provider DC? Ini bisa lama.')">Sync All Games</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection