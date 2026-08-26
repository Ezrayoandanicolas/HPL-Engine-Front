@extends('backoffice.layouts.main')
@section('content')
<div class="container-fluid">
    <div class="row mt-3">
        <div class="col-12">
            <div class="card card-outline" style="border-top: 3px solid #6f42c1;">
                <div class="card-header d-flex align-items-center justify-content-between">
                    <h4 class="card-title mb-0"><i class="fas fa-sliders-h text-purple mr-2"></i> Pengaturan Website</h4>
                    <small class="text-muted">Kelola tampilan dan informasi website</small>
                </div>
                <form action="/Setting" method="POST" enctype="multipart/form-data">
                    @method('POST')
                    @csrf
                    <div class="card-body">
                        <div class="d-flex align-items-center mb-4">
                            <div class="d-flex align-items-center justify-content-center rounded-circle bg-purple text-white" style="width:38px;height:38px;font-size:16px;"><i class="fas fa-info"></i></div>
                            <h5 class="mb-0 ml-3">Informasi Website</h5>
                        </div>
                        <div class="row g-3">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="small font-weight-medium text-muted text-uppercase tracking-wider">Nama Website</label>
                                    <input name="web" type="text" class="form-control form-control-lg shadow-sm" placeholder="cth: NexEngine" value="{{ $setting['web'] ?? '' }}">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="small font-weight-medium text-muted text-uppercase tracking-wider">No Telepon</label>
                                    <input name="telp" type="text" class="form-control form-control-lg shadow-sm" placeholder="+62xxx" value="{{ $setting['telp'] ?? '' }}">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="small font-weight-medium text-muted text-uppercase tracking-wider">No Whatsapp</label>
                                    <input name="whatsapp" type="text" class="form-control form-control-lg shadow-sm" placeholder="+62xxx" value="{{ $setting['whatsapp'] ?? '' }}">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="small font-weight-medium text-muted text-uppercase tracking-wider">Telegram</label>
                                    <input name="telegram" type="text" class="form-control form-control-lg shadow-sm" placeholder="+62xxx" value="{{ $setting['telegram'] ?? '' }}">
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group">
                                    <label class="small font-weight-medium text-muted text-uppercase tracking-wider">Running Text</label>
                                    <input name="running_text" type="text" class="form-control form-control-lg shadow-sm" placeholder="Text berjalan di halaman utama" value="{{ $setting['running_text'] ?? '' }}">
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group">
                                    <label class="small font-weight-medium text-muted text-uppercase tracking-wider">Announcement (Pesan Berita)</label>
                                    <textarea name="announcement_text" class="form-control form-control-lg shadow-sm" rows="4" placeholder="Pisahkan setiap pesan dengan tanda | (pipe). Contoh: Pesan 1|Pesan 2|Pesan 3">{{ $setting['announcement_text'] ?? '' }}</textarea>
                                    <small class="form-text text-muted">Pisahkan dengan <code>|</code> untuk beberapa pesan. Pesan akan ditampilkan bergantian di halaman utama.</small>
                                </div>
                            </div>
                        </div>

                        <hr class="my-4">

                        <div class="d-flex align-items-center mb-4">
                            <div class="d-flex align-items-center justify-content-center rounded-circle bg-success text-white" style="width:38px;height:38px;font-size:16px;"><i class="fas fa-images"></i></div>
                            <h5 class="mb-0 ml-3">Logo & Icon</h5>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="small font-weight-medium text-muted text-uppercase tracking-wider">Logo Web</label>
                                    <div class="border rounded p-4 text-center bg-light mb-2" style="min-height:150px;display:flex;align-items:center;justify-content:center;">
                                        @if(!empty($setting['logo']))
                                        <img class="img-fluid" src="{{ storageUrl($setting['logo']) }}" style="max-height:120px">
                                        @else
                                        <span class="text-muted"><i class="fas fa-image fa-2x d-block mb-2"></i>Belum ada logo</span>
                                        @endif
                                    </div>
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input" id="logo" name="logo" accept=".jpg,.jpeg,.png,.webp,.gif">
                                        <label class="custom-file-label" for="logo">Ganti logo</label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="small font-weight-medium text-muted text-uppercase tracking-wider">Icon Web</label>
                                    <div class="border rounded p-4 text-center bg-light mb-2" style="min-height:150px;display:flex;align-items:center;justify-content:center;">
                                        @if(!empty($setting['icon']))
                                        <img class="img-fluid" src="{{ storageUrl($setting['icon']) }}" style="max-height:120px">
                                        @else
                                        <span class="text-muted"><i class="fas fa-image fa-2x d-block mb-2"></i>Belum ada icon</span>
                                        @endif
                                    </div>
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input" id="icon" name="icon" accept=".jpg,.jpeg,.png,.webp">
                                        <label class="custom-file-label" for="icon">Ganti icon</label>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <hr class="my-4">

                        <div class="d-flex align-items-center mb-4">
                            <div class="d-flex align-items-center justify-content-center rounded-circle bg-warning text-white" style="width:38px;height:38px;font-size:16px;"><i class="fas fa-puzzle-piece"></i></div>
                            <h5 class="mb-0 ml-3">Pengaturan Lainnya</h5>
                        </div>
                        <div class="row">
                            <div class="col-12">
                                <div class="form-group">
                                    <label class="small font-weight-medium text-muted text-uppercase tracking-wider">Live Chat</label>
                                    <textarea name="livechat" class="form-control shadow-sm" rows="3" placeholder="Embed script live chat">{{ $setting['livechat'] ?? '' }}</textarea>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="small font-weight-medium text-muted text-uppercase tracking-wider">Theme</label>
                                    <select name="theme" class="form-control form-control-lg shadow-sm">
                                        <option value="Mpo_black" {{ ($setting['theme'] ?? '') == 'Mpo_black' ? 'selected' : '' }}>⚫ Mpo - Theme 1 (Black)</option>
                                        <option value="Mpo_blue" {{ ($setting['theme'] ?? '') == 'Mpo_blue' ? 'selected' : '' }}>🔵 Mpo - Theme 2 (Blue)</option>
                                        <option value="Mpo_red" {{ ($setting['theme'] ?? '') == 'Mpo_red' ? 'selected' : '' }}>🔴 Mpo - Theme 3 (Red)</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group">
                                    <label class="small font-weight-medium text-muted text-uppercase tracking-wider">SEO Metadata</label>
                                    <textarea name="seo" class="form-control shadow-sm" rows="8" spellcheck="false" placeholder="Meta tags, Google Analytics, dll">{{ $setting['seo'] ?? '' }}</textarea>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group">
                                    <label class="small font-weight-medium text-muted text-uppercase tracking-wider">Footer SEO Content</label>
                                    <textarea name="footer_seo" class="form-control shadow-sm" rows="12" spellcheck="false" placeholder="Konten SEO di footer website">{{ $setting['footer_seo'] ?? '' }}</textarea>
                                    <small class="form-text text-muted">Konten SEO yang ditampilkan di bagian footer website. Gunakan HTML jika diperlukan.</small>
                                </div>
                            </div>
                        </div>
                        <hr class="my-4">

                        <div class="d-flex align-items-center mb-4">
                            <div class="d-flex align-items-center justify-content-center rounded-circle bg-secondary text-white" style="width:38px;height:38px;font-size:16px;"><i class="fas fa-building"></i></div>
                            <h5 class="mb-0 ml-3">Bank Config</h5>
                        </div>
                        <div class="row g-3">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="small font-weight-medium text-muted text-uppercase tracking-wider">Nama Bank</label>
                                    <input type="text" name="bank_name" class="form-control form-control-lg shadow-sm" value="{{ $setting['bank_name'] ?? '' }}" placeholder="BCA">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="small font-weight-medium text-muted text-uppercase tracking-wider">No Rekening</label>
                                    <input type="text" name="bank_account" class="form-control form-control-lg shadow-sm" value="{{ $setting['bank_account'] ?? '' }}" placeholder="1234567890">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="small font-weight-medium text-muted text-uppercase tracking-wider">Atas Nama</label>
                                    <input type="text" name="bank_holder" class="form-control form-control-lg shadow-sm" value="{{ $setting['bank_holder'] ?? '' }}" placeholder="PT. Contoh">
                                </div>
                            </div>
                        </div>

                        <hr class="my-4">

                        <div class="d-flex align-items-center mb-4">
                            <div class="d-flex align-items-center justify-content-center rounded-circle bg-primary text-white" style="width:38px;height:38px;font-size:16px;"><i class="fas fa-share-alt"></i></div>
                            <h5 class="mb-0 ml-3">Link VIP / Sosmed</h5>
                        </div>
                        <p class="text-muted small">Kelola link yang tampil di widget "Klik Saya!" (floating button). Tambah, ubah, atau hapus item sesuai kebutuhan.</p>
                        @php
                            $sosmedLinks = $setting['sosmed_links'] ?? [];
                            if (is_string($sosmedLinks)) { $sosmedLinks = json_decode($sosmedLinks, true) ?: []; }
                            $sosmedLinks = is_array($sosmedLinks) ? $sosmedLinks : [];
                        @endphp
                        <div id="sosmed-container">
                            @forelse ($sosmedLinks as $i => $link)
                            <div class="row g-2 sosmed-row align-items-end">
                                <div class="col-md-3">
                                    <div class="form-group mb-0">
                                        <label class="small font-weight-medium text-muted text-uppercase tracking-wider">Label</label>
                                        <input type="text" name="sosmed_label[]" class="form-control form-control-lg shadow-sm" placeholder="Link Vip 1" value="{{ $link['label'] ?? '' }}">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group mb-0">
                                        <label class="small font-weight-medium text-muted text-uppercase tracking-wider">URL</label>
                                        <input type="text" name="sosmed_url[]" class="form-control form-control-lg shadow-sm" placeholder="https://example.com" value="{{ $link['url'] ?? '' }}">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group mb-0">
                                        <label class="small font-weight-medium text-muted text-uppercase tracking-wider">Gambar (URL)</label>
                                        <input type="text" name="sosmed_image[]" class="form-control form-control-lg shadow-sm" placeholder="https://...gif" value="{{ $link['image'] ?? '' }}">
                                    </div>
                                </div>
                                <div class="col-md-1">
                                    <button type="button" class="btn btn-sm btn-danger remove-sosmed-row"><i class="fas fa-times"></i></button>
                                </div>
                            </div>
                            @empty
                            <div class="row g-2 sosmed-row align-items-end">
                                <div class="col-md-3">
                                    <div class="form-group mb-0">
                                        <label class="small font-weight-medium text-muted text-uppercase tracking-wider">Label</label>
                                        <input type="text" name="sosmed_label[]" class="form-control form-control-lg shadow-sm" placeholder="Link Vip 1">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group mb-0">
                                        <label class="small font-weight-medium text-muted text-uppercase tracking-wider">URL</label>
                                        <input type="text" name="sosmed_url[]" class="form-control form-control-lg shadow-sm" placeholder="https://example.com">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group mb-0">
                                        <label class="small font-weight-medium text-muted text-uppercase tracking-wider">Gambar (URL)</label>
                                        <input type="text" name="sosmed_image[]" class="form-control form-control-lg shadow-sm" placeholder="https://...gif">
                                    </div>
                                </div>
                                <div class="col-md-1">
                                    <button type="button" class="btn btn-sm btn-danger remove-sosmed-row"><i class="fas fa-times"></i></button>
                                </div>
                            </div>
                            @endforelse
                        </div>
                        <button type="button" class="btn btn-outline-primary btn-sm mt-2" id="add-sosmed-row"><i class="fas fa-plus"></i> Tambah Link</button>

                        <hr class="my-4">

                        <div class="d-flex align-items-center mb-4">
                            <div class="d-flex align-items-center justify-content-center rounded-circle bg-info text-white" style="width:38px;height:38px;font-size:16px;"><i class="fas fa-coins"></i></div>
                            <h5 class="mb-0 ml-3">Fee & Limit</h5>
                        </div>
                        <div class="row g-3">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label class="small font-weight-medium text-muted text-uppercase tracking-wider">Fee Deposit (%)</label>
                                    <input type="number" step="0.01" name="fee_deposit" class="form-control form-control-lg shadow-sm" value="{{ $setting['fee_deposit'] ?? 0 }}">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label class="small font-weight-medium text-muted text-uppercase tracking-wider">Fee Withdraw (%)</label>
                                    <input type="number" step="0.01" name="fee_withdraw" class="form-control form-control-lg shadow-sm" value="{{ $setting['fee_withdraw'] ?? 0 }}">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label class="small font-weight-medium text-muted text-uppercase tracking-wider">Min Deposit</label>
                                    <input type="number" name="min_deposit" class="form-control form-control-lg shadow-sm" value="{{ $setting['min_deposit'] ?? 25000 }}">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label class="small font-weight-medium text-muted text-uppercase tracking-wider">Max Deposit</label>
                                    <input type="number" name="max_deposit" class="form-control form-control-lg shadow-sm" value="{{ $setting['max_deposit'] ?? 10000000 }}">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label class="small font-weight-medium text-muted text-uppercase tracking-wider">Min Withdraw</label>
                                    <input type="number" name="min_withdraw" class="form-control form-control-lg shadow-sm" value="{{ $setting['min_withdraw'] ?? 50000 }}">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label class="small font-weight-medium text-muted text-uppercase tracking-wider">Max Withdraw</label>
                                    <input type="number" name="max_withdraw" class="form-control form-control-lg shadow-sm" value="{{ $setting['max_withdraw'] ?? 5000000 }}">
                                </div>
                            </div>
                        </div>

                        <hr class="my-4">

                        <div class="d-flex align-items-center mb-4">
                            <div class="d-flex align-items-center justify-content-center rounded-circle bg-danger text-white" style="width:38px;height:38px;font-size:16px;"><i class="fas fa-shield-alt"></i></div>
                            <h5 class="mb-0 ml-3">Maintenance Mode</h5>
                        </div>
                        <div class="row g-3">
                            <div class="col-12">
                                <div class="form-group">
                                    <div class="custom-control custom-switch">
                                        <input type="checkbox" class="custom-control-input" id="maintenance" name="maintenance" value="1" {{ ($setting['maintenance'] ?? 0) ? 'checked' : '' }}>
                                        <label class="custom-control-label" for="maintenance">Aktifkan Maintenance Mode</label>
                                    </div>
                                    <small class="text-muted">Jika aktif, member tidak bisa mengakses website. Admin tetap bisa login.</small>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group">
                                    <div class="custom-control custom-switch">
                                        <input type="checkbox" class="custom-control-input" id="auto_reject" name="auto_reject" value="1" {{ ($setting['auto_reject'] ?? 0) ? 'checked' : '' }}>
                                        <label class="custom-control-label" for="auto_reject">Auto Reject Deposit & Withdraw (>10 menit)</label>
                                    </div>
                                    <small class="text-muted">Jika aktif, deposit & withdraw yang pending lebih dari 10 menit akan otomatis ditolak.</small>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer bg-white d-flex justify-content-end">
                        <button type="submit" class="btn px-4 text-white" style="background:#6f42c1;border:none;border-radius:8px;">
                            <i class="fas fa-save mr-1"></i> Simpan Perubahan
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<style>
.tracking-wider { letter-spacing: 0.05em; }
.bg-purple { background-color: #6f42c1; }
.form-control-lg.shadow-sm:focus {
    box-shadow: 0 0 0 3px rgba(111,66,193,0.15) !important;
    border-color: #6f42c1;
}
.custom-file-input:focus ~ .custom-file-label {
    box-shadow: 0 0 0 3px rgba(111,66,193,0.15) !important;
    border-color: #6f42c1;
}
</style>
<script>
$(document).ready(function() {
    function sosmedRowHtml() {
        return '<div class="row g-2 sosmed-row align-items-end">' +
            '<div class="col-md-3"><div class="form-group mb-0">' +
            '<label class="small font-weight-medium text-muted text-uppercase tracking-wider">Label</label>' +
            '<input type="text" name="sosmed_label[]" class="form-control form-control-lg shadow-sm" placeholder="Link Vip 1"></div></div>' +
            '<div class="col-md-4"><div class="form-group mb-0">' +
            '<label class="small font-weight-medium text-muted text-uppercase tracking-wider">URL</label>' +
            '<input type="text" name="sosmed_url[]" class="form-control form-control-lg shadow-sm" placeholder="https://example.com"></div></div>' +
            '<div class="col-md-4"><div class="form-group mb-0">' +
            '<label class="small font-weight-medium text-muted text-uppercase tracking-wider">Gambar (URL)</label>' +
            '<input type="text" name="sosmed_image[]" class="form-control form-control-lg shadow-sm" placeholder="https://...gif"></div></div>' +
            '<div class="col-md-1"><button type="button" class="btn btn-sm btn-danger remove-sosmed-row"><i class="fas fa-times"></i></button></div>' +
            '</div>';
    }

    $('#add-sosmed-row').on('click', function() {
        $('#sosmed-container').append(sosmedRowHtml());
    });

    $(document).on('click', '.remove-sosmed-row', function() {
        if ($('.sosmed-row').length > 1) {
            $(this).closest('.sosmed-row').remove();
        } else {
            $(this).closest('.sosmed-row').find('input').val('');
        }
    });
});
</script>
@endsection