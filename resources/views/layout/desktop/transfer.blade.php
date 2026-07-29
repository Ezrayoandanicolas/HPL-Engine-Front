@extends('layout.desktop.main')

@section('content')

<div class="container mt-5">

    <h3 class="mb-3">
        <i class="fa fa-exchange-alt"></i>
        TRANSFER WALLET
    </h3>

    <hr>

    @if(session('warning'))
        <div class="alert alert-warning">
            <strong>Perhatian!</strong><br>
            {{ session('warning') }}
        </div>
    @endif

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif

    {{-- INFORMASI WALLET --}}
    <div class="alert alert-info">

        <h5><i class="fa fa-info-circle"></i> Informasi Wallet</h5>

        <ul class="mb-0">
            <li><b>Main Wallet</b> digunakan untuk Deposit & Withdraw.</li>
            <li><b>Slot Wallet</b> digunakan khusus permainan Slot.</li>
            <li><b>Game Wallet</b> digunakan untuk Casino, Sports, Arcade, Fishing</li>
        </ul>

    </div>

    {{-- CARA TRANSFER --}}
    <div class="alert alert-warning">

        <h5><i class="fa fa-lightbulb"></i> Cara Transfer</h5>

        <ul class="mb-0">
            <li>🎰 Bermain Slot → Pilih <b>Main Wallet ➜ Slot Wallet</b></li>
            <li>🎮 Bermain Casino / Sports → Pilih <b>Main Wallet ➜ Game Wallet</b></li>
            <li>💳 Setelah selesai bermain, pindahkan kembali saldo ke <b>Main Wallet</b>.</li>
        </ul>

    </div>

    <div class="row mb-4">

        <div class="col-md-4">
            <div class="card text-center shadow-sm p-3">
                <h5>💳 Main Wallet</h5>

                <h2 class="text-success">
                    Rp {{ number_format($mainBalance,0,',','.') }}
                </h2>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card text-center shadow-sm p-3">
                <h5>🎰 Slot Wallet</h5>

                <h2 class="text-warning">
                    Rp {{ number_format($slotBalance,0,',','.') }}
                </h2>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card text-center shadow-sm p-3">
                <h5>🎮 Game Wallet</h5>

                <h2 class="text-info">
                    Rp {{ number_format($gameBalance,0,',','.') }}
                </h2>
            </div>
        </div>

    </div>

    <div class="card shadow-sm p-4">

        <h4 class="mb-4">
            🔄 Transfer Saldo
        </h4>

        <form action="{{ route('wallet.transfer') }}" method="POST">

            @csrf

            <div class="form-group mb-3">

                <label><strong>Dari Wallet</strong></label>

                <select name="from" class="form-control" required>

                    <option value="">-- Pilih Wallet --</option>

                    <option value="main" {{ request('from')=='main' ? 'selected' : '' }}>
                        💳 Main Wallet
                    </option>

                    <option value="slot" {{ request('from')=='slot' ? 'selected' : '' }}>
                        🎰 Slot Wallet
                    </option>

                    <option value="game" {{ request('from')=='game' ? 'selected' : '' }}>
                        🎮 Game Wallet
                    </option>

                </select>

            </div>

            <div class="form-group mb-3">

                <label><strong>Ke Wallet</strong></label>

                <select name="to" class="form-control" required>

                    <option value="">-- Pilih Wallet --</option>

                    <option value="main" {{ request('to')=='main' ? 'selected' : '' }}>
                        💳 Main Wallet
                    </option>

                    <option value="slot" {{ request('to')=='slot' ? 'selected' : '' }}>
                        🎰 Slot Wallet
                    </option>

                    <option value="game" {{ request('to')=='game' ? 'selected' : '' }}>
                        🎮 Game Wallet
                    </option>

                </select>

            </div>

            <div class="form-group mb-4">

                <label><strong>Nominal Transfer</strong></label>

                <input
                    type="number"
                    name="amount"
                    class="form-control"
                    placeholder="Masukkan nominal transfer"
                    required>

                <small class="text-muted">
                    Minimal transfer Rp 1.000.
                </small>

            </div>

            <button class="btn btn-primary btn-lg w-100">
                🔄 TRANSFER SEKARANG
            </button>

        </form>

    </div>

</div>

@endsection