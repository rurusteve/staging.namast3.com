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
                    <div class="card-header">Data Karyawan Baru</div>

                    <div class="card-body">
                        <form method="POST" action="{{ \Illuminate\Support\Facades\URL::to('/insertemployee/inserting') }}">
                            {{ csrf_field() }}

                            <div class="form-group row">
                                <label for="nip" class="col-md-4 col-form-label text-md-right">{{ __('NIP') }}</label>

                                <div class="col-md-6">
                                    <input id="nip" type="text" class="form-control{{ $errors->has('nip') ? ' is-invalid' : '' }}" name="nip" value="{{ old('nip') }}" required autofocus>

                                    @if ($errors->has('nip'))
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('nip') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="nama" class="col-md-4 col-form-label text-md-right">{{ __('Nama Karyawan') }}</label>

                                <div class="col-md-6">
                                    <input id="nama" type="text" class="form-control{{ $errors->has('nama') ? ' is-invalid' : '' }}" name="nama" value="{{ old('nama') }}" required>

                                    @if ($errors->has('nama'))
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('nama') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="institusi" class="col-md-4 col-form-label text-md-right">{{ __('Institusi') }}</label>

                                <div class="col-md-6">
                                    <select class="form-control" name="institusi" required>
                                        <option value="00" {{ old('institusi') }} selected disabled>Pilih Institusi</option>
                                        <option value="kapmirawati" {{ old('institusi') }}>KAP Mirawati Sensi Idris</option>
                                        <option value="solusitama" {{ old('institusi') }}>Solusitama Integritas Primandiri</option>
                                    </select>

                                    @if ($errors->has('institusi'))
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('institusi') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="kota" class="col-md-4 col-form-label text-md-right">{{ __('Kota') }}</label>
                                <div class="col-md-6">
                                    <select class="form-control" name="kota" required>
                                        <option value="" {{ old('kota') }} selected disabled>Pilih Kota</option>
                                        <option value="jakarta" {{ old('kota') }}>Jakarta</option>
                                        <option value="batam" {{ old('kota') }}>Batam</option>
                                    </select>
                                    @if ($errors->has('kota'))
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('kota') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="tanggalbergabung" class="col-md-4 col-form-label text-md-right">{{ __('Tanggal Bergabung') }}</label>

                                <div class="col-md-6">
                                    <input id="tanggalbergabung" type="date" class="form-control{{ $errors->has('tanggalbergabung') ? ' is-invalid' : '' }}" name="tanggalbergabung" value="{{ old('tanggalbergabung') }}" required>

                                    @if ($errors->has('tanggalbergabung'))
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('tanggalbergabung') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="status" class="col-md-4 col-form-label text-md-right">{{ __('Status') }}</label>
                                <div class="col-md-6">
                                    <select class="form-control" name="status" value="{{ old('status') }}" required>
                                        <option value="" {{ old('status') }} selected disabled>Status</option>
                                        <option value="kontrak6" {{ old('status') }}>Kontrak 6</option>
                                        <option value="kontrak9" {{ old('status') }}>Konrak 9</option>
                                        <option value="permanent" {{ old('status') }}>Permanent</option>
                                        <option value="resign" {{ old('status') }}>Resign</option>
                                    </select>
                                    @if ($errors->has('status'))
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('status') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="positionid" class="col-md-4 col-form-label text-md-right">{{ __('Position') }}</label>
                                <div class="col-md-6">
                                    <select class="form-control" name="positionid" value="{{ old('positionid') }}" required>
                                        <option value="" selected disabled>Pilih Posisi Karyawan</option>
                                        <option disabled>Professional</option>
                                        <option value="1">Junior 1A</option>
                                        <option value="2">Junior 1B</option>
                                        <option value="3">Semi Senior</option>
                                        <option value="4">Semi Senior (EXP)</option>
                                        <option value="5">Senior</option>
                                        <option value="6">Senior (EXP)</option>
                                        <option value="7">Ass. Supervisor</option>
                                        <option value="8">Supervisor</option>
                                        <option value="9">Junior Manager</option>
                                        <option value="10">Manager</option>
                                        <option value="11">Senior Manager</option>
                                        <option value="12">Junior Partner</option>
                                        <option value="13">Client Svs. Partner</option>
                                        <option value="14">Signing Partner</option>
                                        <option value="15">Senior Partner</option>
                                        <option style="font-weight: bold;" disabled>Administration</option>
                                        <option value="16">Entree</option>
                                        <option value="17">Junior Administrator</option>
                                        <option value="18">Administrator</option>
                                        <option value="19">Senior Administrator</option>
                                        <option value="20">Ass. Supervisor</option>
                                        <option value="21">Supervisor</option>
                                        <option value="22">Ass. Manager</option>
                                        <option value="23">Manager</option>
                                        <option value="24">General Manager</option>
                                    </select>
                                    @if ($errors->has('positionid'))
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('positionid') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="lembur" class="col-md-4 col-form-label text-md-right">{{ __('Lembur') }}</label>
                                <div class="col-md-6">
                                    <select class="form-control" name="lembur" value="{{ old('lembur') }}" required>
                                        <option value="" {{ old('lembur') }} selected disabled>Lembur</option>
                                        <option value="yes" {{ old('lembur') }}>Ada</option>
                                        <option value="no" {{ old('lembur') }}>Tidak ada</option>
                                    </select>
                                    @if ($errors->has('lembur'))
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('lembur') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="grade" class="col-md-4 col-form-label text-md-right">{{ __('Grade') }}</label>

                                <div class="col-md-6">
                                    <input id="grade" type="text" class="form-control{{ $errors->has('grade') ? ' is-invalid' : '' }}" name="grade" value="{{ old('grade') }}" required>

                                    @if ($errors->has('grade'))
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('grade') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="grup" class="col-md-4 col-form-label text-md-right">{{ __('Grup') }}</label>

                                <div class="col-md-6">
                                    <input id="grup" type="text" class="form-control{{ $errors->has('grup') ? ' is-invalid' : '' }}" name="grup" value="{{ old('grup') }}" required>

                                    @if ($errors->has('grup'))
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('grup') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="norek" class="col-md-4 col-form-label text-md-right">{{ __('Nomor Rekening') }}</label>

                                <div class="col-md-6">
                                    <input id="norek" type="text" class="form-control{{ $errors->has('norek') ? ' is-invalid' : '' }}" name="norek" value="{{ old('norek') }}" required>

                                    @if ($errors->has('norek'))
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('norek') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="npwp" class="col-md-4 col-form-label text-md-right">{{ __('NPWP') }}</label>

                                <div class="col-md-6">
                                    <input id="npwp" type="text" class="form-control{{ $errors->has('npwp') ? ' is-invalid' : '' }}" name="npwp" value="{{ old('npwp') }}" required>

                                    @if ($errors->has('npwp'))
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('npwp') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="jeniskelamin" class="col-md-4 col-form-label text-md-right">{{ __('Jenis Kelamin') }}</label>

                                <div class="col-md-6 {{ $errors->has('jeniskelamin') ? ' is-invalid' : '' }}">
                                    <div><input id="jeniskelamin" type="radio" name="jeniskelamin" value="pria" required> Pria</div>
                                    <div><input id="jeniskelamin" type="radio" name="jeniskelamin" value="wanita" required> Wanita</div>
                                    @if ($errors->has('jeniskelamin'))
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('jeniskelamin') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="statuspernikahan" class="col-md-4 col-form-label text-md-right">{{ __('Status Pernikahan') }}</label>

                                <div class="col-md-6 {{ $errors->has('statuspernikahan') ? ' is-invalid' : '' }}">
                                    <div><input id="statuspernikahan" type="radio" name="statuspernikahan" value="menikah" required> Menikah</div>
                                    <div><input id="statuspernikahan" type="radio" name="statuspernikahan" value="belummenikah" required> Belum Menikah</div>
                                    @if ($errors->has('statuspernikahan'))
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('statuspernikahan') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="jumlahanak" class="col-md-4 col-form-label text-md-right">{{ __('Jumlah Anak') }}</label>
                                <div class="col-md-6">
                                    <select class="form-control" name="jumlahanak" value="{{ old('jumlahanak') }}" required>
                                        <option value="" {{ old('jumlahanak') }} selected disabled>Status</option>
                                        <option value="0" {{ old('jumlahanak') }}>Tidak Ada</option>
                                        <option value="1" {{ old('jumlahanak') }}>Anak 1</option>
                                        <option value="2" {{ old('jumlahanak') }}>Anak 2</option>
                                        <option value="3" {{ old('jumlahanak') }}>Anak 3</option>
                                    </select>
                                    @if ($errors->has('jumlahanak'))
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('status') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>


                            <div class="form-group row">
                                <label for="statusptkp" class="col-md-4 col-form-label text-md-right">{{ __('Status PTKP') }}</label>
                                <div class="col-md-6">
                                    <input id="statusptkp" type="text" class="form-control{{ $errors->has('statusptkp') ? ' is-invalid' : '' }}" name="statusptkp" value="{{ old('statusptkp') }}" required>

                                    @if ($errors->has('statusptkp'))
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('statusptkp') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="gajipokok" class="col-md-4 col-form-label text-md-right">{{ __('Gaji Pokok') }}</label>

                                <div class="col-md-6">
                                    <input id="gajipokok" type="number" class="form-control{{ $errors->has('gajipokok') ? ' is-invalid' : '' }}" name="gajipokok" value="{{ old('gajipokok') }}" required>

                                    @if ($errors->has('gajipokok'))
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('gajipokok') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="tunjanganjabatan" class="col-md-4 col-form-label text-md-right">{{ __('Tunjangan Jabatan') }}</label>

                                <div class="col-md-6">
                                    <input id="tunjanganjabatan" type="number" class="form-control{{ $errors->has('tunjanganjabatan') ? ' is-invalid' : '' }}" name="tunjanganjabatan" value="{{ old('tunjanganjabatan') }}" required>

                                    @if ($errors->has('tunjanganjabatan'))
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('tunjanganjabatan') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="tunjangankesehatan" class="col-md-4 col-form-label text-md-right">{{ __('Tunjangan Kesehatan') }}</label>

                                <div class="col-md-6">
                                    <input id="tunjangankesehatan" type="number" class="form-control{{ $errors->has('tunjangankesehatan') ? ' is-invalid' : '' }}" name="tunjangankesehatan" value="{{ old('tunjangankesehatan') }}" required>

                                    @if ($errors->has('tunjangankesehatan'))
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('tunjangankesehatan') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="tunjanganlain" class="col-md-4 col-form-label text-md-right">{{ __('Tunjangan Lain') }}</label>

                                <div class="col-md-6">
                                    <input id="tunjanganlain" type="number" class="form-control{{ $errors->has('tunjanganlain') ? ' is-invalid' : '' }}" name="tunjanganlain" value="{{ old('tunjanganlain') }}" required>

                                    @if ($errors->has('tunjanganlain'))
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('tunjanganlain') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="tarifthhari" class="col-md-4 col-form-label text-md-right">{{ __('Tarif TH per Hari') }}</label>

                                <div class="col-md-6">
                                    <input id="tarifthhari" type="number" class="form-control{{ $errors->has('tarifthhari') ? ' is-invalid' : '' }}" name="tarifthhari" value="{{ old('tarifthhari') }}" required>

                                    @if ($errors->has('tarifthhari'))
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('tarifthhari') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="tariftransportasi" class="col-md-4 col-form-label text-md-right">{{ __('Tarif Transportasi') }}</label>

                                <div class="col-md-6">
                                    <input id="tariftransportasi" type="number" class="form-control{{ $errors->has('tariftransportasi') ? ' is-invalid' : '' }}" name="tariftransportasi" value="{{ old('tariftransportasi') }}" required>

                                    @if ($errors->has('tariftransportasi'))
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('tariftransportasi') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="tarifmakanlembur" class="col-md-4 col-form-label text-md-right">{{ __('Tarif Makan Lembur') }}</label>

                                <div class="col-md-6">
                                    <input id="tarifmakanlembur" type="number" class="form-control{{ $errors->has('tarifmakanlembur') ? ' is-invalid' : '' }}" name="tarifmakanlembur" value="{{ old('tarifmakanlembur') }}" required>

                                    @if ($errors->has('tarifmakanlembur'))
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('tarifmakanlembur') }}</strong>
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
