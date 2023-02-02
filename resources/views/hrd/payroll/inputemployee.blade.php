@extends('layouts.app')
@section('title', 'New Employee')

<style>
    input[type=number]::-webkit-inner-spin-button,
    input[type=number]::-webkit-outer-spin-button {
        -webkit-appearance: none;
        margin: 0 !important;

    }

    input[type=radio] {
        opacity: 1 !important;
        z-index: 1 !important;
        min-width: 1em;
        min-height: 1em;
    }

    .form-check .form-check-label {
        padding-left: 10px !important;
    }

    .field-icon {
        float: right;
        padding-right: 10%;
        margin-left: -25px;
        margin-top: -25px;
        position: relative;
        z-index: 2;
        cursor: pointer;
        opacity: 0.8;
    }

    .field-icon:hover {
        cursor: pointer;
        opacity: 1;
    }

</style>
@section('content')

    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header card-header-primary">
                        <h4 class="card-title">New Employee</h4>
                    </div>
                    <div class="card-body">

                        <form method="POST"
                              action="{{ \Illuminate\Support\Facades\URL::to('/user/payrollandlogin/add') }}">
                            {{ csrf_field() }}

                            <h5>Main Data</h5>
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="nip" class="col-form-label text-md-right">{{ __('NIP') }}</label>

                                    <input id="nip" type="text"
                                           class="form-control{{ $errors->has('nip') ? ' is-invalid' : '' }}" name="nip"
                                           value="{{ old('nip') }}" required autofocus>

                                    @if ($errors->has('nip'))
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('nip') }}</strong>
                                    </span>
                                    @endif
                                </div>

                                <div class="form-group col-md-6">
                                    <label for="nama"
                                           class="col-form-label text-md-right">{{ __('Name') }}</label>

                                    <input id="nama" type="text"
                                           class="form-control{{ $errors->has('nama') ? ' is-invalid' : '' }}"
                                           name="nama" value="{{ old('nama') }}" required>

                                    @if ($errors->has('nama'))
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('nama') }}</strong>
                                    </span>
                                    @endif
                                </div>


                            </div>

                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="tanggalbergabung"
                                           class="col-form-label text-md-right">{{ __('Join Date') }}</label>

                                    <input id="tanggalbergabung" type="date"
                                           class="form-control{{ $errors->has('tanggalbergabung') ? ' is-invalid' : '' }}"
                                           name="tanggalbergabung" value="{{ old('tanggalbergabung') }}" required>

                                    @if ($errors->has('tanggalbergabung'))
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('tanggalbergabung') }}</strong>
                                    </span>
                                    @endif
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="status" class="col-form-label text-md-right">{{ __('Status') }}</label>
                                    <select class="form-control" name="status" value="{{ old('status') }}" required>
                                        <option value="" {{ old('status') }} selected disabled>Status</option>
                                        <option value="KONTRAK 6 BULAN" {{ old('status') }}>Kontrak 6</option>
                                        <option value="KONTRAK 9 BULAN" {{ old('status') }}>Kontrak 9</option>
                                        <option value="PERMANENT" {{ old('status') }}>Permanent</option>
                                        {{--<option value="RESIGN" {{ old('status') }}>Resign</option>--}}
                                    </select>
                                    @if ($errors->has('status'))
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('status') }}</strong>
                                    </span>
                                    @endif
                                </div>

                            </div>
                            <div class="form-row">

                                <div class="form-group col-md-6">
                                    <label for="institusi"
                                           class="col-form-label text-md-right">{{ __('Institution') }}</label>

                                    <div class="">
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="institusi"
                                                   id="institusi1" value="MSId" checked>
                                            <label class="form-check-label" for="institusi1">
                                                MSId
                                            </label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="institusi"
                                                   id="institusi2" value="SOLIS">
                                            <label class="form-check-label" for="institusi2">
                                                SOLIS
                                            </label>
                                        </div>
                                    </div>
                                    @if ($errors->has('institusi'))
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('institusi') }}</strong>
                                    </span>
                                    @endif
                                </div>

                                <div class="form-group col-md-6">
                                    <label for="kota" class="col-form-label text-md-right">{{ __('Branch') }}</label>

                                    <div class="">
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="kota" id="kota1"
                                                   value="Jakarta" checked>
                                            <label class="form-check-label" for="kota1">
                                                Jakarta
                                            </label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="kota" id="kota2"
                                                   value="Batam">
                                            <label class="form-check-label" for="kota2">
                                                Batam
                                            </label>
                                        </div>
                                    </div>
                                    @if ($errors->has('kota'))
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('kota') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="positionid"
                                           class="col-form-label text-md-right">{{ __('Position') }}</label>
                                    <select class="form-control" name="positionid" value="{{ old('positionid') }}"
                                            required>
                                        <option value="" selected disabled>Choose Position</option>
                                        @foreach ($positions as $position)
                                            <option value="{{$position->id}}">{{$position->name}}</option>
                                        @endforeach
                                    </select>
                                    @if ($errors->has('positionid'))
                                        <span class="invalid-feedback"
                                              role="alert"><strong>{{ $errors->first('positionid') }}</strong></span>
                                    @endif
                                </div>


                                <div class="form-group col-md-4">
                                    <label for="grade"
                                           class=" col-form-label text-md-right">{{ __('Grade') }}</label>

                                    <input id="grade" type="text"
                                           class="form-control{{ $errors->has('grade') ? ' is-invalid' : '' }}"
                                           name="grade" value="{{ old('grade') }}" required>

                                    @if ($errors->has('grade'))
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('grade') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="grup" class=" col-form-label text-md-right">{{ __('Group') }}</label>

                                    <select class="form-control" name="divisi" value="{{ old('divisi') }}" required>
                                        <option value="" selected disabled>Choose Group</option>                                        
                                        @foreach ($groups as $group)
                                            <option value="{{$group->id}}">{{$group->name}}</option>
                                        @endforeach
                                    </select>

                                    @if ($errors->has('grup'))
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('grup') }}</strong>
                                    </span>
                                    @endif
                                </div>


                                <div class="form-group col-md-6">
                                    <label for="divisi"
                                           class=" col-form-label text-md-right">{{ ('Division') }}</label>

                                    <select class="form-control" name="divisi" value="{{ old('divisi') }}" required>
                                        <option value="" selected disabled>Choose Division</option>                                        
                                        @foreach ($divisions as $division)
                                            <option value="{{$division->id}}">{{$division->name}}</option>
                                        @endforeach
                                    </select>

                                    @if ($errors->has('divisi'))
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('divisi') }}</strong>
                                    </span>
                                    @endif
                                </div>


                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="lembur"
                                           class="col-form-label text-md-right">{{ __('Overtime') }}</label>

                                    <div class="">
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="lembur" id="lembur1"
                                                   value="Y" checked>
                                            <label class="form-check-label" for="lembur1">
                                                Yes
                                            </label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="lembur" id="lembur2"
                                                   value="T">
                                            <label class="form-check-label" for="lembur2">
                                                No
                                            </label>
                                        </div>
                                    </div>
                                    @if ($errors->has('lembur'))
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('lembur') }}</strong>
                                    </span>
                                    @endif
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="inchargestatus"
                                           class="col-form-label text-md-right">{{ __('Incharge Status') }}</label>

                                    <div class="">
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="inchargestatus"
                                                   id="inchargestatus1" value="1" checked>
                                            <label class="form-check-label" for="inchargestatus1">
                                                Incharge
                                            </label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="inchargestatus"
                                                   id="inchargestatus2" value="0">
                                            <label class="form-check-label" for="inchargestatus2">
                                                Non-Incharge
                                            </label>
                                        </div>
                                    </div>
                                    @if ($errors->has('inchargestatus'))
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('inchargestatus') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <hr>
                            <h5>Payroll Data</h5>
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="norek"
                                           class=" col-form-label text-md-right">{{ __('Bank Account') }}</label>

                                    <input id="norek" type="text"
                                           class="form-control{{ $errors->has('norek') ? ' is-invalid' : '' }}"
                                           name="norek" value="{{ old('norek') }}" required>

                                    @if ($errors->has('norek'))
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('norek') }}</strong>
                                    </span>
                                    @endif
                                </div>

                                <div class="form-group col-md-6">
                                    <label for="npwp" class=" col-form-label text-md-right">{{ __('NPWP') }}</label>

                                    <input id="npwp" type="text"
                                           class="form-control{{ $errors->has('npwp') ? ' is-invalid' : '' }}"
                                           name="npwp" value="{{ old('npwp') }}" required>

                                    @if ($errors->has('npwp'))
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('npwp') }}</strong>
                                    </span>
                                    @endif
                                </div>

                            </div>


                            <div class="form-row">
                                <div class="form-group col-md-8">
                                    <label for="gajipokok"
                                           class="col-form-label text-md-right">{{ __('Main Salary') }}</label>

                                    <input id="gajipokok" type="number"
                                           class="form-control{{ $errors->has('gajipokok') ? ' is-invalid' : '' }}"
                                           name="gajipokok" value="{{ old('gajipokok') }}" required>

                                    @if ($errors->has('gajipokok'))
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('gajipokok') }}</strong>
                                    </span>
                                    @endif
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="statusptkp"
                                           class=" col-form-label text-md-right">{{ __('PTKP Status') }}</label>
                                    <input id="statusptkp" type="text"
                                           class="form-control{{ $errors->has('statusptkp') ? ' is-invalid' : '' }}"
                                           name="statusptkp" value="{{ old('statusptkp') }}" required>

                                    @if ($errors->has('statusptkp'))
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('statusptkp') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-4">
                                    <label for="tunjanganjabatan"
                                           class="col-form-label text-md-right">{{ __('Positional Allowance') }}</label>

                                    <input id="tunjanganjabatan" type="number"
                                           class="form-control{{ $errors->has('tunjanganjabatan') ? ' is-invalid' : '' }}"
                                           name="tunjanganjabatan" value="{{ old('tunjanganjabatan') }}" required>

                                    @if ($errors->has('tunjanganjabatan'))
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('tunjanganjabatan') }}</strong>
                                    </span>
                                    @endif
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="tunjangankesehatan"
                                           class=" col-form-label text-md-right">{{ __('Trans. & Meal Allowance') }}</label>

                                    <input id="tunjangankesehatan" type="number"
                                           class="form-control{{ $errors->has('tunjangankesehatan') ? ' is-invalid' : '' }}"
                                           name="tunjangankesehatan" value="{{ old('tunjangankesehatan') }}"
                                           required>

                                    @if ($errors->has('tunjangankesehatan'))
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('tunjangankesehatan') }}</strong>
                                    </span>
                                    @endif
                                </div>

                                <div class="form-group col-md-4">
                                    <label for="tunjanganlain"
                                           class=" col-form-label text-md-right">{{ __('Other Allowance') }}</label>

                                    <input id="tunjanganlain" type="number"
                                           class="form-control{{ $errors->has('tunjanganlain') ? ' is-invalid' : '' }}"
                                           name="tunjanganlain" value="{{ old('tunjanganlain') }}" required>

                                    @if ($errors->has('tunjanganlain'))
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('tunjanganlain') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>


                            <div class="form-row  ">
                                <div class="form-group col-md-4">
                                    <label for="tarifthhari"
                                           class="col-form-label text-md-right">{{ __('TH/day Fare') }}</label>

                                    <input id="tarifthhari" type="number"
                                           class="form-control{{ $errors->has('tarifthhari') ? ' is-invalid' : '' }}"
                                           name="tarifthhari" value="{{ old('tarifthhari') }}" required>

                                    @if ($errors->has('tarifthhari'))
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('tarifthhari') }}</strong>
                                    </span>
                                    @endif
                                </div>

                                <div class="form-group col-md-4">
                                    <label for="tariftransportasi"
                                           class=" col-form-label text-md-right">{{ __('OT. Transport Fare') }}</label>

                                    <input id="tariftransportasi" type="number"
                                           class="form-control{{ $errors->has('tariftransportasi') ? ' is-invalid' : '' }}"
                                           name="tariftransportasi" value="{{ old('tariftransportasi') }}" required>

                                    @if ($errors->has('tariftransportasi'))
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('tariftransportasi') }}</strong>
                                    </span>
                                    @endif
                                </div>

                                <div class="form-group col-md-4">
                                    <label for="tarifmakanlembur"
                                           class=" col-form-label text-md-right">{{ __('OT. Meal Fare') }}</label>

                                    <input id="tarifmakanlembur" type="number"
                                           class="form-control{{ $errors->has('tarifmakanlembur') ? ' is-invalid' : '' }}"
                                           name="tarifmakanlembur" value="{{ old('tarifmakanlembur') }}" required>

                                    @if ($errors->has('tarifmakanlembur'))
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('tarifmakanlembur') }}</strong>
                                    </span>
                                    @endif
                                </div>

                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-4">
                                    <label for="persenbpjskesehatan"
                                           class="col-form-label text-md-right">{{ __('Reimbursement Percentage') }}</label>

                                    <input id="persenbpjskesehatan" type="number"
                                           class="form-control{{ $errors->has('persenbpjskesehatan') ? ' is-invalid' : '' }}"
                                           name="persenbpjskesehatan" value="{{ old('persenbpjskesehatan') }}"
                                           required>

                                    @if ($errors->has('persenbpjskesehatan'))
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('persenbpjskesehatan') }}</strong>
                                    </span>
                                    @endif
                                </div>
                                <div class="form-group col-md-8">
                                    <label for="persenbpjskesehatan"
                                           class="col-form-label text-md-right">{{ __('') }}</label>
                                    <div class="alert alert-light">Please make sure the data is inputted correctly for
                                        each column
                                    </div>
                                </div>
                            </div>

                            <hr>
                            <h5>Login Data</h5>
                            <div class="form-row">
                                <div class="form-group col-md-7">
                                    <label for="email"
                                           class=" col-form-label text-md-right">Email</label>

                                    <input id="email" type="email"
                                           class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}"
                                           name="email"
                                           value="{{ old('email') }}" required autofocus>

                                    @if ($errors->has('email'))
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('nip') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="logintype"
                                           class="col-md-4 col-form-label text-md-right">{{ __('Division') }}</label>

                                    <select id="logintype"
                                            class="form-control{{ $errors->has('logintype') ? ' is-invalid' : '' }}"
                                            name="logintype">
                                        <option value="" selected disabled>Click and choose division</option>
                                        <option value="nonprofessional">Admin</option>
                                        <option value="professionalaccounting">Accounting</option>
                                        <option value="professionaltax">Tax</option>
                                        <option value="professionalaudit">Audit</option>
                                    </select>
                                    @if ($errors->has('logintype'))
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('logintype') }}</strong>
                                    </span>
                                    @endif
                                </div>

                                <div class="form-group col-md-6">
                                    <label for="admin"
                                           class=" col-form-label text-md-right">{{ __('Role') }}</label>

                                    <select id="admin"
                                            class="form-control{{ $errors->has('admin') ? ' is-invalid' : '' }}"
                                            name="admin">
                                        <option value="" selected disabled>Choose Role</option>
                                        <option value="0">Employee</option>
                                        <option value="1">Manager, Incharge</option>
                                        <option value="2">Partner, HRD</option>
                                    </select>
                                    @if ($errors->has('admin'))
                                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('admin') }}</strong>
                            </span>
                                    @endif
                                </div>
                            </div>


                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="password"
                                           class="col-form-label text-md-right">{{ __('Password') }}</label>

                                    <input id="password" type="password"
                                           class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}"
                                           name="password" required>
                                    <span toggle="#password"
                                          class="fa fa-fw fa-eye field-icon toggle-password"></span>
                                    @if ($errors->has('password'))
                                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('password') }}</strong>
                            </span>
                                    @endif
                                </div>

                                <div class="form-group col-md-6">
                                    <label for="password-confirm"
                                           class=" col-form-label text-md-right">{{ __('Confirm Password') }}</label>

                                    <input id="password-confirm" type="password" class="form-control"
                                           name="password_confirmation" required>
                                </div>
                            </div>

                            {{--<div class="form-group mb-0">--}}
                            {{--<div class="col-md-6 offset-md-4">--}}
                            {{--<button type="submit" class="btn btn-info">--}}
                            {{--{{ __('Register') }}--}}
                            {{--</button>--}}
                            {{--<a href="{{url('/user/list')}}" class="btn btn-outline-primary">--}}
                            {{--User List--}}
                            {{--</a>--}}
                            {{--</div>--}}
                            {{--</div>--}}

                            <div class="form-row">
                                <div class="form-group mb-0">


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
    <script>
        $(".toggle-password").click(function () {

            $(this).toggleClass("fa-eye fa-eye-slash");
            var input = $($(this).attr("toggle"));
            if (input.attr("type") == "password") {
                input.attr("type", "text");
            } else {
                input.attr("type", "password");
            }
        });
    </script>
@endsection
