@extends('backoffice.layouts.main')

@section('content')
<style>
    .modal-body { max-height: 80vh; overflow-y: auto; }
    .modal { z-index: 1050 !important; }
    .modal-backdrop { z-index: 1040 !important; }
</style>

<div class="card mt-3">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h4 class="mb-0">Games List - Active Players</h4>
    </div>
    <div class="card-body">

        <div class="table-responsive">
            <table id="example2" class="table table-bordered table-hover">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Username</th>
                        <th>Provider</th>
                        <th>Game Code</th>
                        <th class="text-center">Bet</th>
                        <th class="text-center">Balance</th>
                        <th class="text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse (($x ?? []) as $data)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td><strong>{{ $data['user_code'] }}</strong></td>
                            <td>{{ $data['provider_code'] }}</td>
                            <td>{{ $data['game_code'] }}</td>
                            <td class="text-center">{{ $data['bet'] }}</td>
                            <td class="text-center">{{ number_format($data['balance'], 2) }}</td>
                            <td class="text-center">
                                <button class="btn btn-primary btn-sm submit-data"
                                        data-provider="{{ $data['provider_code'] }}"
                                        data-gamecode="{{ $data['game_code'] }}"
                                        data-username="{{ $data['user_code'] }}"
                                        data-bet="{{ $data['bet'] }}">
                                    Set Call
                                </button>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="text-center text-muted">Tidak ada player aktif</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- ==================== MODAL CALL APPLY ==================== -->
<div class="modal fade" id="newModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header bg-dark text-white">
                <h5 class="modal-title">Call Apply</h5>
                <button type="button" class="close text-white" onclick="closeManualModal()">
                    <span>&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <input type="hidden" id="activeProvider">
                <input type="hidden" id="activeGameCode">
                <input type="hidden" id="activeUser">

                <div class="alert alert-info py-2">
                    <strong>Player:</strong> <span id="modalUsername"></span><br>
                    <strong>Current Bet:</strong> <span id="modalCurrentBet"></span>
                </div>

                <div class="form-group">
                    <label><strong>Win Amount (Target)</strong></label>
                    <input type="number" class="form-control" id="winAmountInput" placeholder="Contoh: 5000" step="0.01" required>
                </div>

                <div class="form-group">
                    <label><strong>Call Type</strong></label>
                    <select class="form-control" id="callTypeSelect">
                        <option value="normal">Normal Call (1)</option>
                        <option value="buy">Buy Call (2)</option>
                    </select>
                </div>

                <div class="form-group">
                    <label><strong>Bet Multiplier</strong> (Opsional)</label>
                    <select class="form-control" id="betMultiplierSelect">
                        <option value="">-- Tidak digunakan --</option>
                        <option value="1">1x</option>
                        <option value="2">2x</option>
                        <option value="3">3x</option>
                        <option value="4.05">4.05x</option>
                        <option value="5">5x</option>
                        <option value="10">10x</option>
                    </select>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" onclick="closeManualModal()">Batal</button>
                <button type="button" class="btn btn-success px-4 apply-data">
                    <i class="fas fa-paper-plane mr-1"></i> Apply Call
                </button>
            </div>
        </div>
    </div>
</div>

<script>
$(document).ready(function() {
    if (typeof $.fn.DataTable !== 'undefined') {
        $('#example2').DataTable();
    }

    // Buka Modal
    $(document).on('click', '.submit-data', function(e) {
        e.preventDefault();

        const provider = $(this).data('provider');
        const gamecode = $(this).data('gamecode');
        const username = $(this).data('username');
        const currentBet = $(this).data('bet');

        $('#activeProvider').val(provider);
        $('#activeGameCode').val(gamecode);
        $('#activeUser').val(username);

        $('#modalUsername').text(username);
        $('#modalCurrentBet').text(currentBet);

        $('#winAmountInput').val('');
        $('#callTypeSelect').val('normal');
        $('#betMultiplierSelect').val('');

        showManualModal();
    });

    // Tombol Apply
    $(document).on('click', '.apply-data', function(e) {
        e.preventDefault();

        if (!confirm('Yakin ingin apply call ini?')) return;

        const provider      = $('#activeProvider').val();
        const gamecode      = $('#activeGameCode').val();
        const username      = $('#activeUser').val();
        const winAmount     = $('#winAmountInput').val();
        const callType      = $('#callTypeSelect').val();
        const betMultiplier = $('#betMultiplierSelect').val();

        if (!winAmount || parseFloat(winAmount) <= 0) {
            alert('Win Amount harus diisi!');
            return;
        }

        const $btn = $(this);
        const originalText = $btn.html();
        $btn.prop('disabled', true).html('<i class="fas fa-spinner fa-spin"></i> Processing...');

        $.ajax({
            url: '/call-apply',
            type: 'POST',
            data: {
                _token: '{{ csrf_token() }}',
                provider: provider,
                game_code: gamecode,
                username: username,
                win_amount: winAmount,
                call_type: callType,
                bet_multiplier: betMultiplier || null
            },
            success: function(response) {
                if (response.status === 'success') {
                    let msg = '✅ Call berhasil dikirim!\n\n';
                    if (response.data && response.data.called_money) {
                        msg += `Called Money: ${response.data.called_money}`;
                    }
                    alert(msg);
                    closeManualModal();
                } else {
                    alert('❌ Gagal: ' + (response.msg || 'Unknown error'));
                }
            },
            error: function(xhr) {
                alert('❌ Terjadi kesalahan server');
                console.error(xhr.responseJSON);
            },
            complete: function() {
                $btn.prop('disabled', false).html(originalText);
            }
        });
    });
});

function showManualModal() {
    const modal = document.getElementById('newModal');
    modal.style.display = 'block';
    modal.classList.add('show');
    document.body.classList.add('modal-open');

    let backdrop = document.getElementById('manual-backdrop');
    if (!backdrop) {
        backdrop = document.createElement('div');
        backdrop.id = 'manual-backdrop';
        backdrop.className = 'modal-backdrop fade show';
        document.body.appendChild(backdrop);
        backdrop.onclick = closeManualModal;
    }
}

function closeManualModal() {
    const modal = document.getElementById('newModal');
    const backdrop = document.getElementById('manual-backdrop');

    if (modal) {
        modal.style.display = 'none';
        modal.classList.remove('show');
    }
    if (backdrop) backdrop.remove();
    document.body.classList.remove('modal-open');
}
</script>
@endsection