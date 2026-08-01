@extends('layout.mobile.main')
@section('mobile')
    <link rel="stylesheet" href="../../../assets/css/mobile/profile.css">
    <div class="profile-container">
        <div class="standard-form-container">
            <div class="container">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="standard-form-title">
                            UBAH KATA SANDI
                        </div>
                        <div class="standard-form-note">
                            <span>Catatan:</span><br>*Kata Sandi harus terdiri dari 8-20 karakter.<br>*Kata Sandi harus
                            mengandung huruf dan angka. <br>*Kata Sandi tidak boleh mengandung username.
                        </div>
                        <form action="/change-password/user" method="post">
                            @csrf
                            <div class="form-group">
                                <label for="OldPassword">Kata Sandi Saat Ini</label>
                                <input maxlength="20" class="form-control" data-val="true"
                                    data-val-required="The OldPassword field is required." id="OldPassword"
                                    name="OldPassword" placeholder="Kata Sandi Saat Ini" type="password">
                                <span class="standard-required-message">Kata sandi harus diisi.</span>
                            </div>
                            <div class="form-group standard-password-field">
                                <label for="NewPassword">Kata Sandi Baru</label>
                                <input maxlength="20" class="form-control" data-val="true"
                                    data-val-regex="The field NewPassword must match the regular expression '^(?=.{8,20}$)(?=.*?[a-z])(?=.*?[0-9]).*$'."
                                    data-val-regex-pattern="^(?=.{8,20}$)(?=.*?[a-z])(?=.*?[0-9]).*$"
                                    data-val-required="The NewPassword field is required." id="new_password_input"
                                    name="password" placeholder="Kata Sandi Baru" type="password">
                                <span class="standard-required-message">Kata Sandi harus terdiri dari 8-20 karakter
                                    <br> Dan harus mengandung huruf dan angka</span>
                                <i class="fas fa-eye" id="new_password_input_trigger"></i>
                            </div>
                            <div class="form-group standard-password-field">
                                <label for="ConfirmPassword">Ulangi Kata Sandi</label>
                                <input maxlength="20" class="form-control" data-val="true"
                                    data-val-equalto="'ConfirmPassword' and 'NewPassword' do not match."
                                    data-val-equalto-other="*.NewPassword"
                                    data-val-required="The ConfirmPassword field is required."
                                    id="confirm_password_input" name="password_confirmation"
                                    placeholder="Ulangi Kata Sandi" type="password">
                                <span class="standard-required-message">Kata sandi tidak cocok.</span>
                                <i class="fas fa-eye" id="confirm_password_input_trigger"></i>
                            </div>
                            <div class="form-group">
                                <label for="VerificationCode">Kode Verifikasi</label>
                                <div data-section="input" class="captcha-input">
                                    <input autocomplete="off" class="form-control" data-val="true"
                                        data-val-required="The VerificationCode field is required."
                                        id="VerificationCode" name="VerificationCode" placeholder="Kode Verifikasi"
                                        type="text" value="">
                                    <span class="standard-required-message">CAPTCHA salah.</span>
                                    <div class="captcha-container">
                                        <img src="{{ captcha_src('mini') }}"
                                            onclick="this.src='/captcha/mini?'+Math.random()" id="captchaCode"
                                            alt="" class="captcha">
                                        <a rel="nofollow" href="javascript:;"
                                            onclick="document.getElementById('captchaCode').src='captcha/mini?'+Math.random()"
                                            class="refresh btn btn-sm btn-info">
                                            <i class="fa-sharp fa-solid fa-arrows-rotate"></i>
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <div class="standard-button-group">
                                <button class="standard-secondary-button" type="submit">Ubah Kata Sandi</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const togglePasswordVisibility = (inputId, iconId) => {
                const passwordInput = document.getElementById(inputId);
                const passwordIcon = document.getElementById(iconId);
                passwordIcon.addEventListener('click', () => {
                    const type = passwordInput.type === 'password' ? 'text' : 'password';
                    passwordInput.type = type;
                    passwordIcon.classList.toggle('fa-eye');
                    passwordIcon.classList.toggle('fa-eye-slash');
                });
            };
            togglePasswordVisibility('new_password_input', 'new_password_input_trigger');
            togglePasswordVisibility('confirm_password_input', 'confirm_password_input_trigger');
        });
    </script>
@endsection
