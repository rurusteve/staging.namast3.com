@extends('layouts.app')
@section('title', 'Edit Employee')
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

                @if (session('passwordsuccess'))
                    <div class="alert alert-success">
                        {{ session('passwordsuccess') }}
                    </div>
                @endif
                    @if (session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif

                <div class="card">
                    <div class="card-header card-header-primary">
                        <h4 class="card-title">Main Payroll Data</h4>
                        <p class="card-category"></p>
                    </div>

                    <div class="card-body">

                        <form method="POST" action="{{ url('/payroll/data/'.$employees->id) }}">
                            {{ csrf_field() }}
                            <div class="form-group row">
                                <label for="nip" class="col-md-4 col-form-label text-md-right">{{ __('NIP') }}</label>

                                <div class="col-md-6">
                                    <input id="nip" type="text"
                                           class="form-control{{ $errors->has('nip') ? ' is-invalid' : '' }}" name="nip"
                                           value="{{ $employees->nip }}" autofocus>

                                    @if ($errors->has('nip'))
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('nip') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="nama"
                                       class="col-md-4 col-form-label text-md-right">Name</label>

                                <div class="col-md-6">
                                    <input id="nama" type="text"
                                           class="form-control{{ $errors->has('nama') ? ' is-invalid' : '' }}"
                                           name="nama" value="{{ $employees->nama }}">

                                    @if ($errors->has('nama'))
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('nama') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="institusi"
                                       class="col-md-4 col-form-label text-md-right">{{ __('Institusi') }}</label>

                                <div class="col-md-6">
                                    <select class="form-control" name="institusi">
                                        <option value="{{$employees->institusi}}" selected>
                                            @if($employees->institusi == 'MSId')
                                                KAP Mirawati Sensi Idris
                                            @elseif($employees->institusi == 'SOLIS')
                                                Solusitama Integritas Primandiri
                                            @endif
                                        </option>
                                        <option value="MSId" {{ old('institusi') }}>KAP Mirawati Sensi Idris</option>
                                        <option value="SOLIS" {{ old('institusi') }}>Solusitama Integritas Mandiri
                                        </option>

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
                                    <select class="form-control" name="kota">
                                        <option value="{{ $employees->kota }}"
                                                selected>{{ucwords(strtolower($employees->kota))}}</option>
                                        <option value="JAKARTA" {{ old('kota') }}>Jakarta</option>
                                        <option value="BATAM" {{ old('kota') }}>Batam</option>
                                    </select>
                                    @if ($errors->has('kota'))
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('kota') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="tanggalbergabung"
                                       class="col-md-4 col-form-label text-md-right">{{ __('Tanggal Bergabung') }}</label>

                                <div class="col-md-6">
                                    <input id="tanggalbergabung" type="date"
                                           class="form-control{{ $errors->has('tanggalbergabung') ? ' is-invalid' : '' }}"
                                           name="tanggalbergabung" value="{{ $employees->tanggalbergabung }}">

                                    @if ($errors->has('tanggalbergabung'))
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('tanggalbergabung') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="status"
                                       class="col-md-4 col-form-label text-md-right">{{ __('Status') }}</label>
                                <div class="col-md-6">
                                    <select class="form-control" name="status">

                                        <option value="{{ $employees->status }}"
                                                selected>{{ $employees->status }}</option>
                                        <option value="KONTRAK 6 BULAN" {{ old('status') }}>Kontrak 6</option>
                                        <option value="KONTRAK 9 BULAN" {{ old('status') }}>Kontrak 9</option>
                                        <option value="PERMANENT" {{ old('status') }}>Permanent</option>
                                    </select>
                                    @if ($errors->has('status'))
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('status') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            @if($employees->tanggalresign !== null)
                                <div class="form-group row">
                                    <label for="resigndate"
                                           class="col-md-4 col-form-label text-md-right">{{ __('Resign Date') }}</label>
                                    <div class="col-md-6">
                                        <input class="form-control" name="resigndate" id="resigndate" disabled
                                               value="{{ $employees->tanggalresign }}">
                                    </div>
                                </div>
                            @else
                            @endif


                            <div class="form-group row">
                                <label for="positionid"
                                       class="col-md-4 col-form-label text-md-right">{{ __('Position') }}</label>
                                <div class="col-md-6">
                                    <select class="form-control" name="positionid">

                                        @foreach($positions as $position)
                                        @if($employees->positionid == $position->id)
                                        <option value="{{$position->id}}" selected disabled>{{$position->name}}</option>
                                        @else
                                        <option value="{{$position->id}}" >{{$position->name}}</option>
                                        @endif
                                        @endforeach
                                    </select>
                                    @if ($errors->has('positionid'))
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('positionid') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="lembur"
                                       class="col-md-4 col-form-label text-md-right">{{ __('Lembur') }}</label>
                                <div class="col-md-6">
                                        <input type="radio" id="ya" name="lembur" value="Y" @if ($employees->lembur == 'Y') checked @endif>
                                        <label for="ya">Ya</label><br>
                                        <input type="radio" id="tidak" name="lembur" value="T" @if ($employees->lembur == 'T') checked @endif>
                                        <label for="tidak">Tidak</label><br>

                                    @if ($errors->has('lembur'))
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('lembur') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="grade"
                                       class="col-md-4 col-form-label text-md-right">{{ __('Grade') }}</label>

                                <div class="col-md-6">
                                    <input id="grade" type="text"
                                           class="form-control{{ $errors->has('grade') ? ' is-invalid' : '' }}"
                                           name="grade" value="{{ $employees->grade }}">

                                    @if ($errors->has('grade'))
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('grade') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="divisi"
                                       class="col-md-4 col-form-label text-md-right">{{ __('Group') }}</label>

                                <div class="col-md-6">
                                    <select class="form-control" name="divisi">

                                        <option value="" {{ old('divisi') }} disabled>Pilih divisi</option>
                                        @foreach($groups as $group)
                                            @if($employees->divisi == $group->id)
                                          <option value="{{ $group->id }}" selected disabled>{{$group->name}}</option>
                                          @else
                                          <option value="{{ $group->id }}">{{$group->name}}</option>
                                          @endif
                                          @endforeach
                                    </select>
                                    @if ($errors->has('divisi'))
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('divisi') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="norek"
                                       class="col-md-4 col-form-label text-md-right">{{ __('Nomor Rekening') }}</label>

                                <div class="col-md-6">
                                    <input id="norek" type="text"
                                           class="form-control{{ $errors->has('norek') ? ' is-invalid' : '' }}"
                                           name="norek" value="{{ $employees->norek }}">

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
                                    <input id="npwp" type="text"
                                           class="form-control{{ $errors->has('npwp') ? ' is-invalid' : '' }}"
                                           name="npwp" value="{{ $employees->npwp }}">

                                    @if ($errors->has('npwp'))
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('npwp') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="statusptkp"
                                       class="col-md-4 col-form-label text-md-right">{{ __('Status PTKP') }}</label>
                                <div class="col-md-6">
                                    <input id="statusptkp" type="text"
                                           class="form-control{{ $errors->has('statusptkp') ? ' is-invalid' : '' }}"
                                           name="statusptkp" value="{{ $employees->statusptkp }}">

                                    @if ($errors->has('statusptkp'))
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('statusptkp') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            {{--<div class="form-group row">--}}
                            {{--<label for="gajipokok"--}}
                            {{--class="col-md-4 col-form-label text-md-right">{{ __('Gaji Pokok') }}</label>--}}

                            {{--<div class="col-md-6">--}}
                            {{--<input id="gajipokok" type="number"--}}
                            {{--class="form-control{{ $errors->has('gajipokok') ? ' is-invalid' : '' }}"--}}
                            {{--name="gajipokok" value="{{ $employees->gajipokok }}">--}}

                            {{--@if ($errors->has('gajipokok'))--}}
                            {{--<span class="invalid-feedback" role="alert">--}}
                            {{--<strong>{{ $errors->first('gajipokok') }}</strong>--}}
                            {{--</span>--}}
                            {{--@endif--}}
                            {{--</div>--}}
                            {{--</div>--}}
                            {{--<div class="form-group row">--}}
                            {{--<label for="tunjanganjabatan"--}}
                            {{--class="col-md-4 col-form-label text-md-right">{{ __('Tunjangan Jabatan') }}</label>--}}

                            {{--<div class="col-md-6">--}}
                            {{--<input id="tunjanganjabatan" type="number"--}}
                            {{--class="form-control{{ $errors->has('tunjanganjabatan') ? ' is-invalid' : '' }}"--}}
                            {{--name="tunjanganjabatan" value="{{ $employees->tunjanganjabatan }}">--}}

                            {{--@if ($errors->has('tunjanganjabatan'))--}}
                            {{--<span class="invalid-feedback" role="alert">--}}
                            {{--<strong>{{ $errors->first('tunjanganjabatan') }}</strong>--}}
                            {{--</span>--}}
                            {{--@endif--}}
                            {{--</div>--}}
                            {{--</div>--}}
                            {{--<div class="form-group row">--}}
                            {{--<label for="tunjangankesehatan"--}}
                            {{--class="col-md-4 col-form-label text-md-right">{{ __('Tunjangan Kesehatan') }}</label>--}}

                            {{--<div class="col-md-6">--}}
                            {{--<input id="tunjangankesehatan" type="number"--}}
                            {{--class="form-control{{ $errors->has('tunjangankesehatan') ? ' is-invalid' : '' }}"--}}
                            {{--name="tunjangankesehatan" value="{{ $employees->tunjangankesehatan }}">--}}

                            {{--@if ($errors->has('tunjangankesehatan'))--}}
                            {{--<span class="invalid-feedback" role="alert">--}}
                            {{--<strong>{{ $errors->first('tunjangankesehatan') }}</strong>--}}
                            {{--</span>--}}
                            {{--@endif--}}
                            {{--</div>--}}
                            {{--</div>--}}
                            {{--<div class="form-group row">--}}
                            {{--<label for="tunjanganlain"--}}
                            {{--class="col-md-4 col-form-label text-md-right">{{ __('Tunjangan Lain') }}</label>--}}

                            {{--<div class="col-md-6">--}}
                            {{--<input id="tunjanganlain" type="number"--}}
                            {{--class="form-control{{ $errors->has('tunjanganlain') ? ' is-invalid' : '' }}"--}}
                            {{--name="tunjanganlain" value="{{ $employees->tunjanganlain }}">--}}

                            {{--@if ($errors->has('tunjanganlain'))--}}
                            {{--<span class="invalid-feedback" role="alert">--}}
                            {{--<strong>{{ $errors->first('tunjanganlain') }}</strong>--}}
                            {{--</span>--}}
                            {{--@endif--}}
                            {{--</div>--}}
                            {{--</div>--}}
                            {{--<div class="form-group row">--}}
                            {{--<label for="tarifthhari"--}}
                            {{--class="col-md-4 col-form-label text-md-right">{{ __('Tarif TH per Hari') }}</label>--}}

                            {{--<div class="col-md-6">--}}
                            {{--<input id="tarifthhari" type="number"--}}
                            {{--class="form-control{{ $errors->has('tarifthhari') ? ' is-invalid' : '' }}"--}}
                            {{--name="tarifthhari" value="{{ $employees->tarifthhari }}">--}}

                            {{--@if ($errors->has('tarifthhari'))--}}
                            {{--<span class="invalid-feedback" role="alert">--}}
                            {{--<strong>{{ $errors->first('tarifthhari') }}</strong>--}}
                            {{--</span>--}}
                            {{--@endif--}}
                            {{--</div>--}}
                            {{--</div>--}}
                            {{--<div class="form-group row">--}}
                            {{--<label for="tariftransportasi"--}}
                            {{--class="col-md-4 col-form-label text-md-right">{{ __('Tarif Transportasi') }}</label>--}}

                            {{--<div class="col-md-6">--}}
                            {{--<input id="tariftransportasi" type="number"--}}
                            {{--class="form-control{{ $errors->has('tariftransportasi') ? ' is-invalid' : '' }}"--}}
                            {{--name="tariftransportasi" value="{{ $employees->tariftransportasi }}">--}}

                            {{--@if ($errors->has('tariftransportasi'))--}}
                            {{--<span class="invalid-feedback" role="alert">--}}
                            {{--<strong>{{ $errors->first('tariftransportasi') }}</strong>--}}
                            {{--</span>--}}
                            {{--@endif--}}
                            {{--</div>--}}
                            {{--</div>--}}
                            {{--<div class="form-group row">--}}
                            {{--<label for="tarifmakanlembur"--}}
                            {{--class="col-md-4 col-form-label text-md-right">{{ __('Tarif Makan Lembur') }}</label>--}}

                            {{--<div class="col-md-6">--}}
                            {{--<input id="tarifmakanlembur" type="number"--}}
                            {{--class="form-control{{ $errors->has('tarifmakanlembur') ? ' is-invalid' : '' }}"--}}
                            {{--name="tarifmakanlembur" value="{{ $employees->tarifmakanlembur }}">--}}

                            {{--@if ($errors->has('tarifmakanlembur'))--}}
                            {{--<span class="invalid-feedback" role="alert">--}}
                            {{--<strong>{{ $errors->first('tarifmakanlembur') }}</strong>--}}
                            {{--</span>--}}
                            {{--@endif--}}
                            {{--</div>--}}
                            {{--</div>--}}
                            {{--<div class="form-group row">--}}
                            {{--<label for="persenbpjskesehatan"--}}
                            {{--class="col-md-4 col-form-label text-md-right">{{ __('% Reimburse') }}</label>--}}

                            {{--<div class="col-md-6">--}}
                            {{--<input id="persenbpjskesehatan" type="number"--}}
                            {{--class="form-control{{ $errors->has('persenbpjskesehatan') ? ' is-invalid' : '' }}"--}}
                            {{--name="persenbpjskesehatan" value="{{ $employees->persenbpjskesehatan }}">--}}

                            {{--@if ($errors->has('persenbpjskesehatan'))--}}
                            {{--<span class="invalid-feedback" role="alert">--}}
                            {{--<strong>{{ $errors->first('persenbpjskesehatan') }}</strong>--}}
                            {{--</span>--}}
                            {{--@endif--}}
                            {{--</div>--}}
                            {{--</div>--}}
                            @if ($errors->any())
                                <div class="alert alert-danger">
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif

                            <div class="form-group row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" class="btn btn-success">
                                        Edit
                                    </button>
                                    <a href="{{url()->previous()}}" class="btn btn-default">Cancel</a>

                                </div>
                            </div>

                        </form>
                    </div>
                </div>
                <hr>
                <div class="card">
                    <div class="card-header card-header-info">
                        <h4 class="card-title">Change Group</h4>
                        <p class="card-category"></p>
                    </div>

                    <div class="card-body">
                        <form method="POST" action="{{ url('/payroll/data/'.$employees->id.'/changegroup') }}">
                            {{ csrf_field() }}
                            <div class="form-group row">
                                <label for="tanggalresign"
                                       class="col-md-4 col-form-label text-md-right">{{ __('Group') }}</label>

                                <div class="col-md-6">
                                    <select name="changegroup">
                                        <option selected disabled>
                                            @if($user->logintype === 'nonprofessional')
                                                Non-P.
                                            @elseif($user->logintype === 'professionalaccounting')
                                                Accounting
                                            @elseif($user->logintype === 'professionaltax')
                                                Tax
                                            @elseif($user->logintype === 'professionalaudit')
                                                Audit
                                            @endif
                                        </option>
                                        <option value="nonprofessional">Non-P.</option>
                                        <option value="professionalaccounting">Accounting</option>
                                        <option value="professionaltax">Tax</option>
                                        <option value="professionalaudit">Audit</option>
                                    </select>

                                    @if ($errors->has('changegroup'))
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('changegroup') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" class="btn btn-success">
                                        Change
                                    </button>
                                    <a href="{{url()->previous()}}" class="btn btn-default">Cancel</a>

                                </div>
                            </div>

                        </form>
                    </div>
                </div>
                <hr>
                <div class="card">
                    <div class="card-header card-header-danger">
                        <h4 class="card-title">Set Resign</h4>
                        <p class="card-category"></p>
                    </div>

                    <div class="card-body">
                        <form method="POST" action="{{ url('/payroll/data/'.$employees->id.'/resign') }}">
                            {{ csrf_field() }}
                            <div class="form-group row">
                                <label for="tanggalresign"
                                       class="col-md-4 col-form-label text-md-right">{{ __('Resign Date') }}</label>

                                <div class="col-md-6">
                                    <input id="tanggalresign" type="date"
                                           class="form-control{{ $errors->has('tanggalresign') ? ' is-invalid' : '' }}"
                                           name="tanggalresign">

                                    @if ($errors->has('tanggalresign'))
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('tanggalresign') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" class="btn btn-danger">
                                        Set
                                    </button>
                                    <a href="{{url()->previous()}}" class="btn btn-default">Cancel</a>

                                </div>
                            </div>

                        </form>
                    </div>
                </div>
                <hr>
                <div class="card">
                    <div class="card-header card-header-warning">
                        <h4 class="card-title">Change Password</h4>
                        <p class="card-category"></p>
                    </div>

                    <div class="card-body">
                        <form method="POST" action="{{ route('updateemployeepassword', $employees->id) }}">
                            @csrf
                            <input hidden name="nip" id="nip" type="text" value="{{$employees->nip}}">

                            <div class="form-group row">
                                <label for="newpassword" class="col-md-4 col-form-label text-md-right">{{ __('New Password') }}</label>

                                <div class="col-md-6">
                                    <input id="newpassword" type="password" class="form-control{{ $errors->has('newpassword') ? ' is-invalid' : '' }}" name="newpassword" required>

                                    @if ($errors->has('newpassword'))
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('newpassword') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="newpassword-confirm" class="col-md-4 col-form-label text-md-right">{{ __('Confirm Password') }}</label>

                                <div class="col-md-6">
                                    <input id="newpassword-confirm" type="password" class="form-control" name="newpassword_confirmation" required>
                                </div>
                            </div>


                            <div class="form-group row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" class="btn btn-warning">
                                        {{ __('Reset Password') }}
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
