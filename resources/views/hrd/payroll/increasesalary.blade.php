@extends('layouts.app')
@section('title', 'Salary Attributes')

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
                    <div class="card-header card-header-danger card-header-icon">
                        <div class="card-icon">
                            <i style="font-size: 1.5em;" class="fas fa-funnel-dollar"></i>
                        </div>
                        <h3 class="card-title">Edit Salary Attributes</h3>
                    </div>
                    <div class="card-body">

                        <form method="POST"
                              action="{{ route('increaseprocess', ['id'=>$employees->id])  }}">
                            {{ csrf_field() }}

                            <h5><span style="color: grey; font-weight: 400">Salary attributes of</span> {{ucwords(strtolower($employees->nama))}}, {{$employees->nip}}</h5>

                            <div class="form-row">
                                <div class="form-group col-md-8">
                                    <label for="gajipokok"
                                           class="col-form-label text-md-right">{{ __('Main Salary') }}</label>

                                    <input id="gajipokok" type="number"
                                           class="form-control{{ $errors->has('gajipokok') ? ' is-invalid' : '' }}"
                                           name="gajipokok" value="{{ $employees->gajipokok }}" required>

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
                                           name="statusptkp" value="{{ $employees->statusptkp }}" required>

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
                                           name="tunjanganjabatan" value="{{ $employees->tunjanganjabatan }}" required>

                                    @if ($errors->has('tunjanganjabatan'))
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('tunjanganjabatan') }}</strong>
                                    </span>
                                    @endif
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="tunjangankesehatan"
                                           class=" col-form-label text-md-right">{{ __('Meal & Transp. Allowance') }}</label>

                                    <input id="tunjangankesehatan" type="number"
                                           class="form-control{{ $errors->has('tunjangankesehatan') ? ' is-invalid' : '' }}"
                                           name="tunjangankesehatan" value="{{ $employees->tunjangankesehatan }}"
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
                                           name="tunjanganlain" value="{{ $employees->tunjanganlain }}" required>

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
                                           name="tarifthhari" value="{{ $employees->tarifthhari}}" required>

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
                                           name="tariftransportasi" value="{{ $employees->tariftransportasi }}" required>

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
                                           name="tarifmakanlembur" value="{{ $employees->tarifmakanlembur }}" required>

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
                                           name="persenbpjskesehatan" value="{{ $employees->persenbpjskesehatan }}"
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

                            <div class="form-row">
                                <div class="form-group mb-0">


                                    <button type="submit" class="btn btn-success">
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
