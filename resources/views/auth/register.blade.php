@extends('layouts.appother')
@section('title', 'Register')

@section('content')
    <style>
        html, body {
            background-color: #e7e7e8;
            background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 1600 900'%3E%3Cpolygon fill='%23ed9600' points='957 450 539 900 1396 900'/%3E%3Cpolygon fill='%23c76e02' points='957 450 872.9 900 1396 900'/%3E%3Cpolygon fill='%23eb9400' points='-60 900 398 662 816 900'/%3E%3Cpolygon fill='%23c56e02' points='337 900 398 662 816 900'/%3E%3Cpolygon fill='%23e99200' points='1203 546 1552 900 876 900'/%3E%3Cpolygon fill='%23c36e02' points='1203 546 1552 900 1162 900'/%3E%3Cpolygon fill='%23e79000' points='641 695 886 900 367 900'/%3E%3Cpolygon fill='%23c16d02' points='587 900 641 695 886 900'/%3E%3Cpolygon fill='%23e58e00' points='1710 900 1401 632 1096 900'/%3E%3Cpolygon fill='%23bf6d02' points='1710 900 1401 632 1365 900'/%3E%3Cpolygon fill='%23e38c00' points='1210 900 971 687 725 900'/%3E%3Cpolygon fill='%23bd6d02' points='943 900 1210 900 971 687'/%3E%3C/svg%3E");
            background-attachment: fixed;
            background-size: cover;
            /*background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 1600 900'%3E%3Cpolygon fill='%23cc1414' points='957 450 539 900 1396 900'/%3E%3Cpolygon fill='%23aa0000' points='957 450 872.9 900 1396 900'/%3E%3Cpolygon fill='%23d40034' points='-60 900 398 662 816 900'/%3E%3Cpolygon fill='%23b10022' points='337 900 398 662 816 900'/%3E%3Cpolygon fill='%23d60051' points='1203 546 1552 900 876 900'/%3E%3Cpolygon fill='%23b2003d' points='1203 546 1552 900 1162 900'/%3E%3Cpolygon fill='%23d1006f' points='641 695 886 900 367 900'/%3E%3Cpolygon fill='%23ac0057' points='587 900 641 695 886 900'/%3E%3Cpolygon fill='%23c2008d' points='1710 900 1401 632 1096 900'/%3E%3Cpolygon fill='%239e0071' points='1710 900 1401 632 1365 900'/%3E%3Cpolygon fill='%23aa00aa' points='1210 900 971 687 725 900'/%3E%3Cpolygon fill='%23880088' points='943 900 1210 900 971 687'/%3E%3C/svg%3E");*/
            color: #636b6f;
            font-family: 'Nunito', sans-serif;
            font-weight: 600;
            margin: 0;
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

        .align-self-center {
            min-height: 100vh;
            align-content: center;
        }

        select:hover {
            cursor: pointer;
        }


    </style>
    <div class="container">

        <div class="row justify-content-center align-self-center">
            <div class="col-md-8">
                <div style="display: flex; justify-content: space-between; align-items: center;">
                    {{--<img height="25px" src="https://hr.namast3.com/msid.png">--}}
                    <img height="25px" src="http://hr.namast3.com/logo.png">
                </div>
                <div class="card">
                    <div class="card-header card-header-info">
                        <h4 class="card-title mt-0"> Register</h4>
                        {{--<p class="card-category"> Here is a subtitle for this table</p>--}}
                    </div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('register') }}">
                            @csrf
                            <div class="form-group row">
                                <label for="nip"
                                       class="col-md-4 col-form-label text-md-right">NIP</label>

                                <div class="col-md-6">
                                    <input id="nip" type="nip"
                                           class="form-control{{ $errors->has('nip') ? ' is-invalid' : '' }}" name="nip"
                                           value="{{ old('nip') }}" required autofocus>

                                    @if ($errors->has('nip'))
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('nip') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="email"
                                       class="col-md-4 col-form-label text-md-right">Email</label>

                                <div class="col-md-6">
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

                            <!--                            <div class="form-group row">-->
                            <!--<label for="email" class="col-md-4 col-form-label text-md-right">Email</label>-->
                            <!--<div class="col-md-6">-->
                            <!--<input id="email" type="email"-->
                        <!--class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}"-->
                        <!--name="email" value="{{ old('email') }}" required>-->
                        <!--@if ($errors->has('email'))-->
                            <!--<span class="invalid-feedback" role="alert">-->
                        <!--<strong>{{ $errors->first('email') }}</strong>-->
                            <!--</span>-->
                            <!--@endif-->
                            <!--</div>-->
                            <!--</div>-->

                            <div class="form-group row">
                                <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Name') }}</label>

                                <div class="col-md-6">
                                    <input id="name" type="text"
                                           class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}"
                                           name="name" value="{{ old('name') }}" required>

                                    @if ($errors->has('name'))
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>


                            <div class="form-group row">
                                <label for="logintype"
                                       class="col-md-4 col-form-label text-md-right">{{ __('Division') }}</label>

                                <div class="col-md-6">
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
                            </div>

                            <div class="form-group row">
                                <label for="admin"
                                       class="col-md-4 col-form-label text-md-right">{{ __('Role') }}</label>

                                <div class="col-md-6">
                                    <select id="admin"
                                            class="form-control{{ $errors->has('admin') ? ' is-invalid' : '' }}"
                                            name="admin">
                                        <option value="" disabled>Choose Role</option>
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



                            <div class="form-group row">
                                <label for="password"
                                       class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>

                                <div class="col-md-6">
                                    <input id="password" type="password"
                                           class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}"
                                           name="password" required>
                                    <span toggle="#password" class="fa fa-fw fa-eye field-icon toggle-password"></span>
                                    @if ($errors->has('password'))
                                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('password') }}</strong>
                            </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="password-confirm"
                                       class="col-md-4 col-form-label text-md-right">{{ __('Confirm Password') }}</label>

                                <div class="col-md-6">
                                    <input id="password-confirm" type="password" class="form-control"
                                           name="password_confirmation" required>
                                </div>
                            </div>

                            <div class="form-group row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" class="btn btn-info">
                                        {{ __('Register') }}
                                    </button>
                                </div>
                            </div>
                            <div class="form-group row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <a href="{{url('/login')}}" style="font-size: 0.9em; color: darkgrey"
                                       class="btn-link">Have an account? Click here to login.</a>
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
