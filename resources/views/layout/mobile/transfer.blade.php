@extends('layout.mobile.main')

@section('mobile')
<style>
.wallet-card{
    background:#1b1b1b;
    border:1px solid #353535;
    border-radius:12px;
    color:#fff;
    margin-bottom:15px;
}

.wallet-card .card-body{
    padding:15px;
}

.wallet-card strong{
    font-size:18px;
}

.wallet-title{
    color:#fff;
    font-weight:600;
}

.wallet-main{
    color:#3ddc84;
}

.wallet-slot{
    color:#ffc107;
}

.wallet-game{
    color:#00d4ff;
}

.transfer-card{
    background:#1b1b1b;
    border:1px solid #353535;
    border-radius:12px;
    color:#fff;
}

.transfer-card label{
    color:#fff;
    font-weight:600;
    margin-bottom:6px;
}

.transfer-card .form-control{
    background:#2a2a2a;
    border:1px solid #444;
    color:#fff;
}

.transfer-card .form-control:focus{
    background:#2a2a2a;
    color:#fff;
    border-color:#ffc107;
    box-shadow:none;
}

.transfer-card option{
    color:#000;
}

.btn-transfer{
    background:linear-gradient(90deg,#ffb300,#ff6f00);
    border:none;
    color:#fff;
    font-weight:bold;
    border-radius:10px;
    padding:12px;
}

.btn-transfer:hover{
    background:linear-gradient(90deg,#ff9800,#ff5722);
    color:#fff;
}

.alert-info-custom{
    background:#0d3b66;
    color:#fff;
    border:none;
    border-radius:10px;
}

.alert-warning-custom{
    background:#6d4c00;
    color:#fff;
    border:none;
    border-radius:10px;
}

.page-title{
    color:#fff;
    font-weight:bold;
    text-align:center;
    margin-bottom:20px;
}

.text-note{
    color:#cfcfcf;
    font-size:13px;
}
</style>
<div class="container py-3">

    <h4 class="text-center mb-3">
        🔄 TRANSFER WALLET
    </h4>

    {{-- INFORMASI --}}
    <div class="alert alert-info">

        <strong>📌 Informasi Wallet</strong>

        <ul class="mb-0 mt-2">
            <li>Main Wallet digunakan untuk Deposit & Withdraw.</li>
            <li>Slot Wallet digunakan khusus permainan Slot.</li>
            <li>Game Wallet digunakan untuk Sports, Casino, Arcade dan Fishing.</li>
        </ul>

    </div>

    {{-- CARA TRANSFER --}}
    <div class="alert alert-warning">

        <strong>💡 Cara Transfer</strong>

        <ul class="mb-0 mt-2">
            <li>🎰 Bermain Slot → Main Wallet ➜ Slot Wallet</li>
            <li>🎮 Bermain Sports / Casino → Main Wallet ➜ Game Wallet</li>
            <li>💳 Setelah selesai bermain, transfer kembali ke Main Wallet.</li>
        </ul>

    </div>

    {{-- SALDO --}}
    <div class="card mb-3">
        <div class="card-body d-flex justify-content-between">
            <span>💳 Main Wallet</span>
            <strong class="text-success">
                Rp {{ number_format($mainBalance,0,',','.') }}
            </strong>
        </div>
    </div>

    <div class="card mb-3">
        <div class="card-body d-flex justify-content-between">
            <span>🎰 Slot Wallet</span>
            <strong class="text-warning">
                Rp {{ number_format($slotBalance,0,',','.') }}
            </strong>
        </div>
    </div>

    <div class="card mb-4">
        <div class="card-body d-flex justify-content-between">
            <span>🎮 Game Wallet</span>
            <strong class="text-info">
                Rp {{ number_format($gameBalance,0,',','.') }}
            </strong>
        </div>
    </div>

    {{-- FORM --}}
    <div class="card">

        <div class="card-body">

            <h5 class="mb-3">
                🔄 Transfer Saldo
            </h5>

            <form action="{{ route('wallet.transfer') }}" method="POST">

                @csrf

                <div class="mb-3">

                    <label>
                        <strong>Dari Wallet</strong>
                    </label>

                    <select name="from" class="form-control" required>

                        <option value="">-- Pilih Wallet --</option>

                        <option value="main"
                            {{ request('from')=='main' ? 'selected' : '' }}>
                            💳 Main Wallet
                        </option>

                        <option value="slot"
                            {{ request('from')=='slot' ? 'selected' : '' }}>
                            🎰 Slot Wallet
                        </option>

                        <option value="game"
                            {{ request('from')=='game' ? 'selected' : '' }}>
                            🎮 Game Wallet
                        </option>

                    </select>

                </div>

                <div class="mb-3">

                    <label>
                        <strong>Ke Wallet</strong>
                    </label>

                    <select name="to" class="form-control" required>

                        <option value="">-- Pilih Wallet --</option>

                        <option value="main"
                            {{ request('to')=='main' ? 'selected' : '' }}>
                            💳 Main Wallet
                        </option>

                        <option value="slot"
                            {{ request('to')=='slot' ? 'selected' : '' }}>
                            🎰 Slot Wallet
                        </option>

                        <option value="game"
                            {{ request('to')=='game' ? 'selected' : '' }}>
                            🎮 Game Wallet
                        </option>

                    </select>

                </div>

                <div class="mb-3">

                    <label>
                        <strong>Nominal Transfer</strong>
                    </label>

                    <input
                        type="number"
                        name="amount"
                        class="form-control"
                        placeholder="Masukkan Nominal"
                        required>

                    <small class="text-muted">
                        Minimal transfer Rp 1.000
                    </small>

                </div>

                <button class="btn btn-primary w-100">

                    🔄 TRANSFER SEKARANG

                </button>

            </form>

        </div>

    </div>

</div>

@endsection