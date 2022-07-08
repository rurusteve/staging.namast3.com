@extends('layouts.app')
<style>
    input[type=number]::-webkit-inner-spin-button,
    input[type=number]::-webkit-outer-spin-button {
        -webkit-appearance: none;
        margin: 0;
    }
</style>
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header card-header-primary">
                        <h4 class="card-title">New Biodata</h4>
                    </div>

                    <div class="card-body">
                        <form method="POST"
                              action="{{ \Illuminate\Support\Facades\URL::to('/user/biodata/add') }}">
                            {{ csrf_field() }}
                            <div class="form-group row">
                                <label for="nip"
                                       class="col-md-4 col-form-label text-md-right">{{ __('NIP') }}</label>

                                <div class="col-md-6">
                                    <input id="nip" type="text"
                                           class="form-control{{ $errors->has('nip') ? ' is-invalid' : '' }}"
                                           name="nip" value="{{ old('nip') }}" required autofocus>

                                    @if ($errors->has('nip'))
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('nip') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="jeniskelamin"
                                       class="col-md-4 col-form-label text-md-right">{{ __('Jenis Kelamin') }}</label>

                                <div class="col-md-6">
                                    <input id="jeniskelamin" type="text"
                                           class="form-control{{ $errors->has('jeniskelamin') ? ' is-invalid' : '' }}"
                                           name="jeniskelamin" value="{{ old('jeniskelamin') }}" required autofocus>

                                    @if ($errors->has('jeniskelamin'))
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('jeniskelamin') }}</strong>
                                    </span>
                                    @endif
                                </div>
                                </div>

                                <div class="form-group row">
                                    <label for="tempatlahir"
                                           class="col-md-4 col-form-label text-md-right">{{ __('Tempat Lahir') }}</label>

                                    <div class="col-md-6">
                                        <input id="tempatlahir" type="text"
                                               class="form-control{{ $errors->has('tempatlahir') ? ' is-invalid' : '' }}"
                                               name="tempatlahir" value="{{ old('tempatlahir') }}" required autofocus>

                                        @if ($errors->has('tempatlahir'))
                                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('tempatlahir') }}</strong>
                                    </span>
                                        @endif
                                    </div>
                                </div>


                                <div class="form-group row">
                                    <label for="tanggallahir"
                                           class="col-md-4 col-form-label text-md-right">{{ __('Tanggal Lahir') }}</label>

                                    <div class="col-md-6">
                                        <input id="tanggallahir" type="date"
                                               class="form-control{{ $errors->has('tanggallahir') ? ' is-invalid' : '' }}"
                                               name="tanggallahir" value="{{ old('tanggallahir') }}" required>

                                        @if ($errors->has('tanggallahir'))
                                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('tanggallahir') }}</strong>
                                    </span>
                                        @endif
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="nohp"
                                           class="col-md-4 col-form-label text-md-right">{{ __('No HP') }}</label>

                                    <div class="col-md-6">
                                        <input id="nohp" type="text"
                                               class="form-control{{ $errors->has('nohp') ? ' is-invalid' : '' }}"
                                               name="nohp" value="{{ old('nohp') }}" required>

                                        @if ($errors->has('nohp'))
                                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('nohp') }}</strong>
                                    </span>
                                        @endif
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="nomorkontakdarurat"
                                           class="col-md-4 col-form-label text-md-right">{{ __('Nomor Kontak Darurat') }}</label>

                                    <div class="col-md-6">
                                        <input id="nomorkontakdarurat" type="text"
                                               class="form-control{{ $errors->has('nomorkontakdarurat') ? ' is-invalid' : '' }}"
                                               name="nomorkontakdarurat" value="{{ old('nomorkontakdarurat') }}"
                                               required>

                                        @if ($errors->has('nomorkontakdarurat'))
                                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('nomorkontakdarurat') }}</strong>
                                    </span>
                                        @endif
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="namakontakdarurat"
                                           class="col-md-4 col-form-label text-md-right">{{ __('Nama Kontak Darurat') }}</label>

                                    <div class="col-md-6">
                                        <input id="namakontakdarurat" type="text"
                                               class="form-control{{ $errors->has('namakontakdarurat') ? ' is-invalid' : '' }}"
                                               name="namakontakdarurat" value="{{ old('namakontakdarurat') }}" required>

                                        @if ($errors->has('namakontakdarurat'))
                                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('namakontakdarurat') }}</strong>
                                    </span>
                                        @endif
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="emailpribadi"
                                           class="col-md-4 col-form-label text-md-right">{{ __('Email') }}</label>

                                    <div class="col-md-6">
                                        <input id="emailpribadi" type="text"
                                               class="form-control{{ $errors->has('emailpribadi') ? ' is-invalid' : '' }}"
                                               name="emailpribadi" value="{{ old('emailpribadi') }}" required>

                                        @if ($errors->has('emailpribadi'))
                                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('emailpribadi') }}</strong>
                                    </span>
                                        @endif
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="domisili"
                                           class="col-md-4 col-form-label text-md-right">{{ __('Domisili') }}</label>

                                    <div class="col-md-6">
                                        <input id="domisili" type="text"
                                               class="form-control{{ $errors->has('domisili') ? ' is-invalid' : '' }}"
                                               name="domisili" value="{{ old('domisili') }}" required>

                                        @if ($errors->has('domisili'))
                                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('domisili') }}</strong>
                                    </span>
                                        @endif
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="kodepos"
                                           class="col-md-4 col-form-label text-md-right">{{ __('Kode Pos') }}</label>

                                    <div class="col-md-6">
                                        <input id="kodepos" type="text"
                                               class="form-control{{ $errors->has('kodepos') ? ' is-invalid' : '' }}"
                                               name="kodepos" value="{{ old('kodepos') }}" required>

                                        @if ($errors->has('kodepos'))
                                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('kodepos') }}</strong>
                                    </span>
                                        @endif
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="nik"
                                           class="col-md-4 col-form-label text-md-right">{{ __('NIK') }}</label>

                                    <div class="col-md-6">
                                        <input id="nik" type="text"
                                               class="form-control{{ $errors->has('nik') ? ' is-invalid' : '' }}"
                                               name="nik" value="{{ old('nik') }}" required>

                                        @if ($errors->has('nik'))
                                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('nik') }}</strong>
                                    </span>
                                        @endif
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="agama"
                                           class="col-md-4 col-form-label text-md-right">{{ __('Agama') }}</label>

                                    <div class="col-md-6">
                                        <input id="agama" type="text"
                                               class="form-control{{ $errors->has('agama') ? ' is-invalid' : '' }}"
                                               name="agama" value="{{ old('agama') }}" required>

                                        @if ($errors->has('agama'))
                                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('agama') }}</strong>
                                    </span>
                                        @endif
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="statussipil"
                                           class="col-md-4 col-form-label text-md-right">{{ __('Status Sipil') }}</label>

                                    <div class="col-md-6">
                                        <input id="statussipil" type="text"
                                               class="form-control{{ $errors->has('statussipil') ? ' is-invalid' : '' }}"
                                               name="statussipil" value="{{ old('statussipil') }}" required>

                                        @if ($errors->has('statussipil'))
                                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('statussipil') }}</strong>
                                    </span>
                                        @endif
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="namapasangan"
                                           class="col-md-4 col-form-label text-md-right">{{ __('Nama Pasangan') }}</label>

                                    <div class="col-md-6">
                                        <input id="namapasangan" type="text"
                                               class="form-control{{ $errors->has('namapasangan') ? ' is-invalid' : '' }}"
                                               name="namapasangan" value="{{ old('namapasangan') }}" required>

                                        @if ($errors->has('namapasangan'))
                                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('namapasangan') }}</strong>
                                    </span>
                                        @endif
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="tanggallahirpasangan"
                                           class="col-md-4 col-form-label text-md-right">{{ __('Tanggal Lahir Pasangan') }}</label>

                                    <div class="col-md-6">
                                        <input id="tanggallahirpasangan" type="date"
                                               class="form-control{{ $errors->has('tanggallahirpasangan') ? ' is-invalid' : '' }}"
                                               name="tanggallahirpasangan" value="{{ old('tanggallahirpasangan') }}"
                                               required>

                                        @if ($errors->has('tanggallahirpasangan'))
                                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('tanggallahirpasangan') }}</strong>
                                    </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="jumlahanak"
                                           class="col-md-4 col-form-label text-md-right">{{ __('Jumlah Anak') }}</label>

                                    <div class="col-md-6">
                                        <input id="jumlahanak" type="text"
                                               class="form-control{{ $errors->has('jumlahanak') ? ' is-invalid' : '' }}"
                                               name="jumlahanak" value="{{ old('jumlahanak') }}" required>

                                        @if ($errors->has('jumlahanak'))
                                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('jumlahanak') }}</strong>
                                    </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="pendidikanterakhir"
                                           class="col-md-4 col-form-label text-md-right">{{ __('Pendidikan Terakhir') }}</label>

                                    <div class="col-md-6">
                                        <input id="pendidikanterakhir" type="text"
                                               class="form-control{{ $errors->has('pendidikanterakhir') ? ' is-invalid' : '' }}"
                                               name="pendidikanterakhir" value="{{ old('pendidikanterakhir') }}"
                                               required>

                                        @if ($errors->has('pendidikanterakhir'))
                                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('pendidikanterakhir') }}</strong>
                                    </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="universitas"
                                           class="col-md-4 col-form-label text-md-right">{{ __('Universitas') }}</label>

                                    <div class="col-md-6">
                                        <input id="universitas" type="text"
                                               class="form-control{{ $errors->has('universitas') ? ' is-invalid' : '' }}"
                                               name="universitas" value="{{ old('universitas') }}" required>

                                        @if ($errors->has('universitas'))
                                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('universitas') }}</strong>
                                    </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="asuransi"
                                           class="col-md-4 col-form-label text-md-right">{{ __('Status Asuransi') }}</label>

                                    <div class="col-md-6">
                                        <input id="asuransi" type="text"
                                               class="form-control{{ $errors->has('asuransi') ? ' is-invalid' : '' }}"
                                               name="asuransi" value="{{ old('asuransi') }}" required>

                                        @if ($errors->has('asuransi'))
                                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('asuransi') }}</strong>
                                    </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="bpjskes"
                                           class="col-md-4 col-form-label text-md-right">{{ __('BPJS KES') }}</label>

                                    <div class="col-md-6">
                                        <input id="bpjskes" type="text"
                                               class="form-control{{ $errors->has('bpjskes') ? ' is-invalid' : '' }}"
                                               name="bpjskes" value="{{ old('bpjskes') }}" required>

                                        @if ($errors->has('bpjskes'))
                                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('bpjskes') }}</strong>
                                    </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="kodebpjskes"
                                           class="col-md-4 col-form-label text-md-right">{{ __('Kode BPJS KES') }}</label>

                                    <div class="col-md-6">
                                        <input id="kodebpjskes" type="text"
                                               class="form-control{{ $errors->has('kodebpjskes') ? ' is-invalid' : '' }}"
                                               name="kodebpjskes" value="{{ old('kodebpjskes') }}" required>

                                        @if ($errors->has('kodebpjskes'))
                                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('kodebpjskes') }}</strong>
                                    </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="bpjstk"
                                           class="col-md-4 col-form-label text-md-right">{{ __('BPJS TK') }}</label>

                                    <div class="col-md-6">
                                        <input id="bpjstk" type="text"
                                               class="form-control{{ $errors->has('bpjstk') ? ' is-invalid' : '' }}"
                                               name="bpjstk" value="{{ old('bpjstk') }}" required>

                                        @if ($errors->has('bpjstk'))
                                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('bpjstk') }}</strong>
                                    </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="kodebpjstk"
                                           class="col-md-4 col-form-label text-md-right">{{ __('Kode BPJS TK') }}</label>

                                    <div class="col-md-6">
                                        <input id="kodebpjstk" type="text"
                                               class="form-control{{ $errors->has('kodebpjstk') ? ' is-invalid' : '' }}"
                                               name="kodebpjstk" value="{{ old('kodebpjstk') }}" required>

                                        @if ($errors->has('kodebpjstk'))
                                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('kodebpjstk') }}</strong>
                                    </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="riwayatpenyakit"
                                           class="col-md-4 col-form-label text-md-right">{{ __('Riwayat Penyakit') }}</label>

                                    <div class="col-md-6">
                                        <input id="riwayatpenyakit" type="text"
                                               class="form-control{{ $errors->has('riwayatpenyakit') ? ' is-invalid' : '' }}"
                                               name="riwayatpenyakit" value="{{ old('riwayatpenyakit') }}" required>

                                        @if ($errors->has('riwayatpenyakit'))
                                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('riwayatpenyakit') }}</strong>
                                    </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="noijazah"
                                           class="col-md-4 col-form-label text-md-right">{{ __('No Ijazah') }}</label>

                                    <div class="col-md-6">
                                        <input id="noijazah" type="text"
                                               class="form-control{{ $errors->has('noijazah') ? ' is-invalid' : '' }}"
                                               name="noijazah" value="{{ old('noijazah') }}" required>

                                        @if ($errors->has('noijazah'))
                                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('noijazah') }}</strong>
                                    </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="form-group row mb-0">
                                    <div class="col-md-6 offset-md-4">
                                        <button type="submit" class="btn btn-primary">
                                            Submit<!--{{ __('Submit') }}-->
                                        </button>
                                        <a href="{{url()->previous()}}" class="btn btn-default">Cancel</a>

                                    </div>
                                </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
