@extends('layouts.app')
@section('title', 'Edit Account')

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
                    <div class="card-header">Edit Account</div>

                    <div class="card-body">
                        <form method="POST" action="{{ url('/userlist/'.$users->id) }}">
                            {{ csrf_field() }}
                            {{ method_field('PUT') }}

                            <div class="form-group row">
                                <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Name') }}</label>

                                <div class="col-md-6">
                                    <input id="name" type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" value="{{ $users->name }}" required autofocus>

                                    @if ($errors->has('name'))
                                        <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('name') }}</strong>
                                </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                                <div class="col-md-6">
                                    <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ $users->email }}" required>

                                    @if ($errors->has('email'))
                                        <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('email') }}</strong>
                                </span>
                                    @endif
                                </div>
                            </div>



                            <div class="form-group row">
                                <label for="positionid" class="col-md-4 col-form-label text-md-right">{{ __('Position') }}</label>
                                <div class="col-md-6">
                                    <select class="form-control" name="positionid" value="{{ $users->positionid }}" required>
                                        <option value="1">
                                            @if($users->positionid == 2)
                                                Manager
                                            @elseif($users->positionid == 3)
                                                Supervisor
                                            @elseif($users->positionid == 4)
                                                Assistant Spv
                                            @elseif($users->positionid == 5)
                                                Senior
                                            @elseif($users->positionid == 6)
                                                Semi Senior
                                            @elseif($users->positionid == 7)
                                                Junior
                                            @elseif($users->positionid == 8)
                                                Contract
                                                @endif
                                        </option>
                                        <option value="2">Manager</option>
                                        <option value="3">Supervisor</option>
                                        <option value="4">Assistant Spv</option>
                                        <option value="5">Senior</option>
                                        <option value="6">Semi Senior</option>
                                        <option value="7">Junior</option>
                                        <option value="8">Contract</option>
                                    </select>
                                    @if ($errors->has('positionid'))
                                        <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('positionid') }}</strong>
                                </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="joindate" class="col-md-4 col-form-label text-md-right">{{ __('Join Date') }}</label>

                                <div class="col-md-6">
                                    <input id="joindate" type="date" class="form-control{{ $errors->has('joindate') ? ' is-invalid' : '' }}" name="joindate" value="{{ $users->joindate }}" required>
                                </div>
                                @if ($errors->has('joindate'))
                                    <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('joindate') }}</strong>
                            </span>
                                @endif
                            </div>

                            <div class="form-group row">
                                <label for="institution" class="col-md-4 col-form-label text-md-right">{{ __('Institution') }}</label>

                                <div class="col-md-6">
                                    <input id="institution" type="text" class="form-control{{ $errors->has('institution') ? ' is-invalid' : '' }}" name="institution" value="{{ $users->institution }}" required>
                                </div>
                                @if ($errors->has('institution'))
                                    <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('institution') }}</strong>
                            </span>
                                @endif
                            </div>


                            <div class="form-group row">
                                <label for="city" class="col-md-4 col-form-label text-md-right">{{ __('City') }}</label>
                                <div class="col-md-6">
                                    <select class="form-control" name="city" value="{{$users->city}}" required>
                                        <option value="00" {{ old('city') }} disabled>Pilih Asal Regional</option>
                                        <option value="01" {{ old('city') }}>Jakarta</option>
                                        <option value="02" {{ old('city') }}>Batam</option>
                                    </select>
                                    @if ($errors->has('city'))
                                        <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('city') }}</strong>
                                </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="status" class="col-md-4 col-form-label text-md-right">{{ __('Status') }}</label>
                                <div class="col-md-6">
                                    <select class="form-control" name="status" value="{{ $users->status }}" required>
                                        <option value="" {{ old('status') }} disabled>Status</option>
                                        <option value="ES01" {{ old('status') }}>Permanent</option>
                                        <option value="ES02" {{ old('status') }}>Temporary</option>
                                    </select>
                                    @if ($errors->has('status'))
                                        <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('status') }}</strong>
                                </span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="salary" class="col-md-4 col-form-label text-md-right">{{ __('Salary') }}</label>

                                <div class="col-md-6">
                                    <input id="salary" type="number" min="0" class="form-control" name="salary" value="{{$users->salary }}" required>
                                </div>
                                @if ($errors->has('salary'))
                                    <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('salary') }}</strong>
                            </span>
                                @endif
                            </div>
                            <div class="form-group row">
                                <label for="positionallowance" class="col-md-4 col-form-label text-md-right">{{ __('Position Allowance') }}</label>

                                <div class="col-md-6">
                                    <input id="positionallowance" type="number" min="0" class="form-control" value="{{ $users->positionallowance }}" name="positionallowance" >
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="healthallowance" class="col-md-4 col-form-label text-md-right">{{ __('Health Allowance') }}</label>

                                <div class="col-md-6">
                                    <input id="healthallowance" type="number" min="0" class="form-control" value="{{ $users->healthallowance }}" name="healthallowance" >
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="additionalallowance" class="col-md-4 col-form-label text-md-right">{{ __('Additional Allowance') }}</label>

                                <div class="col-md-6">
                                    <input id="additionalallowance" type="number" min="0" class="form-control" value="{{ $users->additionalallowance }}" name="additionalallowance" >
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="transportfee" class="col-md-4 col-form-label text-md-right">{{ __('Transportation Fee') }}</label>
                                <div class="col-md-6">
                                    <select class="form-control" name="transportfee" value="{{ $users->transportfee }}">
                                        <option value="" {{ old('transportfee') }}>No transport</option>
                                        <option value="01" {{ old('transportfee') }}>25000</option>
                                        <option value="02" {{ old('transportfee') }}>30000</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="overtimefee" class="col-md-4 col-form-label text-md-right">{{ __('Overtime Fee') }}</label>
                                <div class="col-md-6">
                                    <select class="form-control" name="overtimefee" value="{{ $users->overtimefee }}">
                                        <option value="" {{ old('overtimefee') }}>No overtime</option>
                                        <option value="01" {{ old('overtimefee') }}>15000</option>
                                        <option value="02" {{ old('overtimefee') }}>50000</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="grade" class="col-md-4 col-form-label text-md-right">{{ __('Grade') }}</label>

                                <div class="col-md-6">
                                    <input id="grade" type="text" class="form-control" name="grade" value="{{ $users->grade }}" required>
                                </div>
                                @if ($errors->has('grade'))
                                    <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('grade') }}</strong>
                            </span>
                                @endif
                            </div>
                            <div class="form-group row">
                                <label for="bankaccount" class="col-md-4 col-form-label text-md-right">{{ __('Bank Account') }}</label>

                                <div class="col-md-6">
                                    <input id="bankaccount" type="text" class="form-control" name="bankaccount" value="{{ $users->bankaccount }}" required>
                                </div>
                                @if ($errors->has('bankaccount'))
                                    <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('bankaccount') }}</strong>
                            </span>
                                @endif
                            </div>
                            <div class="form-group row">
                                <label for="npwp" class="col-md-4 col-form-label text-md-right">{{ __('NPWP') }}</label>

                                <div class="col-md-6">
                                    <input id="npwp" type="text" class="form-control" name="npwp" value="{{$users->npwp}}">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="ptkp" class="col-md-4 col-form-label text-md-right">{{ __('PTKP') }}</label>

                                <div class="col-md-6">
                                    <input id="ptkp" type="text" class="form-control" name="ptkp" value="{{$users->ptkp}}">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="admin" class="col-md-4 col-form-label text-md-right">{{ __('User Type') }}</label>
                                <div class="col-md-6">
                                    <select class="form-control" name="admin" value="{{ $users->admin }}" required>
                                        <option value="" {{ old('admin') }} disabled>Pilih tipe akun</option>
                                        <option value="1" {{ old('admin') }} >Manager</option>
                                        <option value="2" {{ old('admin') }} >Supervisor</option>
                                        <option value="0" {{ old('admin') }} >Assistant Spv</option>
                                        <option value="0" {{ old('admin') }} >Senior</option>
                                        <option value="0" {{ old('admin') }} >Semi Senior</option>
                                        <option value="0" {{ old('admin') }} >Junior</option>
                                        <option value="0" {{ old('admin') }} >Contract</option>
                                    </select>
                                    @if ($errors->has('admin'))
                                        <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('admin') }}</strong>
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

