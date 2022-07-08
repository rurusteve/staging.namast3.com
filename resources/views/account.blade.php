@extends('layouts.app')
@section('title', 'Account')

<style>
    input[type=number]::-webkit-inner-spin-button,
    input[type=number]::-webkit-outer-spin-button {
        -webkit-appearance: none;
        margin: 0;
    }
    .form-control:disabled, .form-control[readonly] {
        background-color: #fafafa !important;
    }
</style>
@section('content')
    <div class="container">
        <h3>Account</h3>

        <div class="row">

            <div class="col-md-6">

                <div class="card">
                    <div class="card-header" style="background-color: rgba(0, 188, 212, 0.52);" >Employee Data</div>

                    <div class="card-body">
                        <form method="POST" action="{{ url('register') }}">
                            @csrf

                            <div class="form-group row">
                                <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Name') }}</label>

                                <div class="col-md-6">
                                    <input disabled id="name" type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" value="{{ $users->name }}" required autofocus>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="positionid" class="col-md-4 col-form-label text-md-right">{{ __('Position') }}</label>
                                <div class="col-md-6">
                                    <input disabled class="form-control" name="positionid"
                                            @if ($users->positionid == 1)
                                                value="Manager"
                                            @elseif ($users->positionid == 2)
                                           value="Supervisor"
                                            @elseif ($users->positionid == 3)
                                           value="Assistant Spv"
                                            @elseif ($users->positionid == 4)
                                                    value="Senior"
                                            @elseif ($users->positionid == 5)
                                           value="Semi Senior"
                                            @elseif ($users->positionid == 6)
                                                    value="Junior"
                                            @else
                                                value="Contract"
                                            @endif >
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="joindate" class="col-md-4 col-form-label text-md-right">{{ __('Join Date') }}</label>

                                <div class="col-md-6">
                                    <input disabled id="joindate" type="date" class="form-control{{ $errors->has('joindate') ? ' is-invalid' : '' }}" name="joindate" value="{{ $users->joindate }}" required>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="institution" class="col-md-4 col-form-label text-md-right">{{ __('Institution') }}</label>

                                <div class="col-md-6">
                                    <input disabled id="institution" type="text" class="form-control{{ $errors->has('institution') ? ' is-invalid' : '' }}" name="institution" value="{{ $users->institution }}" required>
                                </div>

                            </div>


                            <div class="form-group row">
                                <label for="city" class="col-md-4 col-form-label text-md-right">{{ __('City') }}</label>
                                <div class="col-md-6">
                                    <input disabled class="form-control" name="city" value="{{ $users->city }}">

                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="status" class="col-md-4 col-form-label text-md-right">{{ __('Status') }}</label>
                                <div class="col-md-6">
                                    <input disabled class="form-control" name="status" value="{{ $users->status }}" required>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="grade" class="col-md-4 col-form-label text-md-right">{{ __('Grade') }}</label>

                                <div class="col-md-6">
                                    <input disabled id="grade" type="text" class="form-control" name="grade" value="{{$users->grade }}" required>
                                </div>

                            </div>
                        </form>
                    </div>

                </div><br>
                <div class="card">
                    <div class="card-header" style="background-color: rgba(255, 235, 59, 0.64);">Personal Data</div>

                    <div class="card-body">
                        <form method="POST" action="{{ url('register') }}">
                            @csrf

                            <div class="form-group row">
                                <label for="birthday" class="col-md-4 col-form-label text-md-right">{{ __('Birthday') }}</label>

                                <div class="col-md-6">
                                    <input disabled id="birthday" type="text" class="form-control" name="birthday" value="">
                                </div>

                            </div>
                            <div class="form-group row">
                                <label for="birthplace" class="col-md-4 col-form-label text-md-right">{{ __('Birthplace') }}</label>

                                <div class="col-md-6">
                                    <input disabled id="birthplace" type="text" class="form-control" name="birthplace" value="">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="address" class="col-md-4 col-form-label text-md-right">{{ __('Address') }}</label>

                                <div class="col-md-6">
                                    <input disabled id="address" type="text" class="form-control" name="address" value="">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                                <div class="col-md-6">
                                    <input disabled id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ $users->email }}" required>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="phonenumber" class="col-md-4 col-form-label text-md-right">{{ __('Phone Number') }}</label>

                                <div class="col-md-6">
                                    <input disabled id="phonenumber" type="text" class="form-control" name="phonenumber" value="">
                                </div>
                            </div>

                        </form>
                    </div>

                </div>
            </div>
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header" style="background-color: rgba(139, 195, 74, 0.52);" >Pay</div>

                    <div class="card-body">
                        <form method="POST" action="{{ url('register') }}">
                            @csrf

                            <div class="form-group row">
                                <label for="salary" class="col-md-4 col-form-label text-md-right">{{ __('Salary') }}</label>

                                <div class="col-md-6">
                                    <input disabled id="salary" type="number" min="0" class="form-control" name="salary" value="{{ $users->salary }}" required>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="positionallowance" class="col-md-4 col-form-label text-md-right">{{ __('Position Allowance') }}</label>

                                <div class="col-md-6">
                                    <input disabled id="positionallowance" type="number" min="0" class="form-control" value="{{ $users->positionallowance }}" name="positionallowance" >
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="healthallowance" class="col-md-4 col-form-label text-md-right">{{ __('Health Allowance') }}</label>

                                <div class="col-md-6">
                                    <input disabled id="healthallowance" type="number" min="0" class="form-control" value="{{ $users->healthallowance }}" name="healthallowance" >
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="additionalallowance" class="col-md-4 col-form-label text-md-right">{{ __('Additional Allowance') }}</label>

                                <div class="col-md-6">
                                    <input disabled id="additionalallowance" type="number" min="0" class="form-control" value="{{$users->additionalallowance }}" name="additionalallowance" >
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="transportfee" class="col-md-4 col-form-label text-md-right">{{ __('Transportation Fee') }}</label>
                                <div class="col-md-6">
                                    <input disabled class="form-control" name="transportfee" value="{{ $users->transportfee }}">

                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="overtimefee" class="col-md-4 col-form-label text-md-right">{{ __('Overtime Fee') }}</label>
                                <div class="col-md-6">
                                    <input disabled class="form-control" name="overtimefee" value="{{$users->overtimefee }}">

                                </div>
                            </div>

                        </form>
                    </div>

                </div><br>
                <div class="card">
                    <div class="card-header" style="background-color: rgba(244, 67, 54, 0.49);">Bank</div>

                    <div class="card-body">
                        <form method="POST" action="{{ url('register') }}">
                            @csrf

                            <div class="form-group row">
                                <label for="bankaccount" class="col-md-4 col-form-label text-md-right">{{ __('Bank Account') }}</label>

                                <div class="col-md-6">
                                    <input disabled id="bankaccount" type="text" class="form-control" name="bankaccount" value="{{$users->bankaccount }}">
                                </div>

                            </div>
                            <div class="form-group row">
                                <label for="bankname" class="col-md-4 col-form-label text-md-right">{{ __('Bank Name') }}</label>

                                <div class="col-md-6">
                                    <input disabled id="bankname" type="text" class="form-control" name="bankname" value="">
                                </div>

                            </div>
                            <div class="form-group row">
                                <label for="bankaccountname" class="col-md-4 col-form-label text-md-right">{{ __('Account Name') }}</label>

                                <div class="col-md-6">
                                    <input disabled id="bankaccountname" type="text" class="form-control" name="bankaccountname" value="">
                                </div>

                            </div>
                            <div class="form-group row">
                                <label for="npwp" class="col-md-4 col-form-label text-md-right">{{ __('NPWP') }}</label>

                                <div class="col-md-6">
                                    <input disabled id="npwp" type="text" class="form-control" name="npwp" value="{{$users->npwp }}">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="ptkp" class="col-md-4 col-form-label text-md-right">{{ __('PTKP') }}</label>

                                <div class="col-md-6">
                                    <input disabled id="ptkp" type="text" class="form-control" name="ptkp" value="{{$users->ptkp }}">
                                </div>
                            </div>

                        </form>
                    </div>

                </div>
            </div>
            
        </div>

    </div>
@endsection
