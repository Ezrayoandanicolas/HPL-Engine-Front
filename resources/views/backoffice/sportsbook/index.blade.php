@extends('backoffice.layouts.main')
@section('content')
<div class="container-fluid">
    <div class="row mt-3">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title"><i class="fas fa-futbol mr-2"></i> Sportsbook</h4>
                    <div class="card-tools">
                        <a href="https://api.nexusggr.com/app/agent" target="_blank" class="btn btn-primary btn-sm"><i class="fas fa-external-link-alt mr-1"></i> Buka GGR Back Office</a>
                    </div>
                </div>
                <div class="card-body">
                    <p class="text-muted">Sportsbook dikonfigurasi melalui GGR Back Office. Berikut ringkasan pengaturannya:</p>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="card card-outline card-info">
                                <div class="card-header"><h5 class="card-title">Informasi Integrasi</h5></div>
                                <div class="card-body">
                                    <table class="table table-sm">
                                        <tr><td>Provider Code</td><td><code>SPORTSBOOK</code></td></tr>
                                        <tr><td>Game Code</td><td><code>""</code> (kosong)</td></tr>
                                        <tr><td>Endpoint</td><td><code>game_launch</code></td></tr>
                                        <tr><td>API Server</td><td><code>https://api.nexusggr.com</code></td></tr>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="card card-outline card-warning">
                                <div class="card-header"><h5 class="card-title">Pengaturan (via GGR Back Office)</h5></div>
                                <div class="card-body">
                                    <ul class="mb-0">
                                        <li><strong>Theme</strong> — Tampilan sportsbook (sesuaikan dengan brand)</li>
                                        <li><strong>Cashout RTP</strong> — Persentase RTP untuk cashout sebelum event selesai</li>
                                        <li><strong>Login URL</strong> — Redirect ke halaman login website</li>
                                        <li><strong>Deposit URL</strong> — Redirect ke halaman deposit saat saldo tidak cukup</li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                    <hr>
                    <h5>Cara Meluncurkan Sportsbook</h5>
                    <p>Gunakan API <code>game_launch</code> dengan parameter:</p>
                    <pre class="bg-dark text-white p-3 rounded"><code>{
    "method": "game_launch",
    "agent_code": "tokengames",
    "agent_token": "af9395d2c665e2812e76e8a123edbffa",
    "user_code": "username",
    "provider_code": "SPORTSBOOK",
    "game_code": ""
}</code></pre>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection