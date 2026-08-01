@extends('layout.mobile.main')
@section('mobile')
    <link rel="stylesheet" href="../../../assets/css/mobile/profile.css">
    <div class="profile-container">
        <div class="standard-form-container">
            <div class="container">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="standard-form-title">
                            PROFIL SAYA
                        </div>
                        <form action="/update-profile" method="POST">
                            @csrf
                            <div class="standard-sub-section">
                                <div class="standard-form-title">
                                    Informasi Pribadi
                                </div>
                                <div class="standard-form-content form_subcategory">
                                    <div class="form-group">
                                        <label for="FullName">Nama Lengkap</label>
                                        <input class="form-control" data-val="true"
                                            data-val-regex="The field FullName must match the regular expression '^[0-9a-zA-Z ]*$'."
                                            data-val-regex-pattern="^[0-9a-zA-Z ]*$"
                                            data-val-required="The FullName field is required."
                                            id="FullName" name="FullName" placeholder="Nama Lengkap"
                                            type="text" value="{{ Auth()->user()->name ?: Auth()->user()->accName }}">
                                        <span class="standard-required-message">Nama lengkap hanya
                                            boleh berisi karakter alfanumerik.</span>
                                    </div>
                                    <div class="form-group">
                                        <label for="Gender">Jenis Kelamin</label>
                                        <select class="form-control" id="Gender" name="Gender">
                                            <option value="">-- Pilih Jenis Kelamin --</option>
                                            <option value="M">Laki-laki</option>
                                            <option value="F">Perempuan</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="Country">Negara</label>
                                        <select class="form-control" data-val="true"
                                            data-val-required="The Country field is required."
                                            id="Country" name="Country">
                                            <option value="">-- Pilih Negara --</option>
                                            <option @if(Auth()->user()->country == 'Indonesia') selected="selected" @endif
                                                value="25513164-f84c-4674-8218-8d731c387d17">Indonesia
                                            </option>
                                        </select>
                                        <span class="standard-required-message">Silahkan pilih
                                            negara!</span>
                                    </div>
                                </div>
                            </div>
                            <div class="standard-sub-section">
                                <div class="standard-form-title">
                                    Informasi Kontak
                                </div>
                                <div class="standard-form-content form_subcategory">
                                    <div class="form-group">
                                        <label for="ContactNo">No. Kontak.</label>
                                        <div data-section="input" class="copy-input-button-field">
                                            <input maxlength="13" class="form-control"
                                                data-val="true"
                                                data-val-length="The field ContactNo must be a string with a minimum length of 10 and a maximum length of 13."
                                                data-val-length-max="13" data-val-length-min="10"
                                                data-val-regex="The field ContactNo must match the regular expression '^[0-9]+$'."
                                                data-val-regex-pattern="^[0-9]+$"
                                                data-val-required="The ContactNo field is required."
                                                id="ContactNo" name="ContactNo" type="text"
                                                value="{{ Auth()->user()->phone }}">
                                            <span class="standard-required-message">Harap masukkan
                                                nomor
                                                kontak yang valid!</span>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="Email">Email</label>
                                        <input autocomplete="off" class="form-control"
                                            data-val="true"
                                            data-val-email="The Email field is not a valid e-mail address."
                                            id="Email" name="Email" placeholder="Email"
                                            type="text" value="{{ Auth()->user()->email }}">
                                        <span class="standard-required-message">Harap masukkan email
                                            yang
                                            valid!</span>
                                    </div>
                                    <div class="form-group">
                                        <label for="WhatsApp">WhatsApp</label>
                                        <input class="form-control" data-val="true"
                                            data-val-regex="The field WhatsApp must match the regular expression '^[0-9]+$'."
                                            data-val-regex-pattern="^[0-9]+$" id="WhatsApp"
                                            name="WhatsApp" placeholder="Nomor WhatsApp"
                                            type="text" value="{{ Auth()->user()->whatsapp }}">
                                        <span class="standard-required-message">Harap masukkan numerik
                                            saja</span>
                                    </div>
                                </div>
                            </div>
                            <div class="standard-button-group">
                                <input type="submit" class="standard-secondary-button"
                                    value="Simpan Data Profil Saya">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
