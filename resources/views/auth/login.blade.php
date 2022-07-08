@extends('layouts.appother')
@section('title', 'Login')

@section('content')
    <style>
        html, body {
            background-color: #e7e7e8;
            background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 1600 900'%3E%3Cpolygon fill='%23ed9600' points='957 450 539 900 1396 900'/%3E%3Cpolygon fill='%23c76e02' points='957 450 872.9 900 1396 900'/%3E%3Cpolygon fill='%23eb9400' points='-60 900 398 662 816 900'/%3E%3Cpolygon fill='%23c56e02' points='337 900 398 662 816 900'/%3E%3Cpolygon fill='%23e99200' points='1203 546 1552 900 876 900'/%3E%3Cpolygon fill='%23c36e02' points='1203 546 1552 900 1162 900'/%3E%3Cpolygon fill='%23e79000' points='641 695 886 900 367 900'/%3E%3Cpolygon fill='%23c16d02' points='587 900 641 695 886 900'/%3E%3Cpolygon fill='%23e58e00' points='1710 900 1401 632 1096 900'/%3E%3Cpolygon fill='%23bf6d02' points='1710 900 1401 632 1365 900'/%3E%3Cpolygon fill='%23e38c00' points='1210 900 971 687 725 900'/%3E%3Cpolygon fill='%23bd6d02' points='943 900 1210 900 971 687'/%3E%3C/svg%3E");
            background-attachment: fixed;
            background-size: cover;

            /*background-color: #330055;*/
            /*background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 100 1000'%3E%3Cg %3E%3Ccircle fill='%23330055' cx='50' cy='0' r='50'/%3E%3Cg fill='%23330f61' %3E%3Ccircle cx='0' cy='50' r='50'/%3E%3Ccircle cx='100' cy='50' r='50'/%3E%3C/g%3E%3Ccircle fill='%23321c6c' cx='50' cy='100' r='50'/%3E%3Cg fill='%23302777' %3E%3Ccircle cx='0' cy='150' r='50'/%3E%3Ccircle cx='100' cy='150' r='50'/%3E%3C/g%3E%3Ccircle fill='%232d3282' cx='50' cy='200' r='50'/%3E%3Cg fill='%23283c8d' %3E%3Ccircle cx='0' cy='250' r='50'/%3E%3Ccircle cx='100' cy='250' r='50'/%3E%3C/g%3E%3Ccircle fill='%23214697' cx='50' cy='300' r='50'/%3E%3Cg fill='%231850a1' %3E%3Ccircle cx='0' cy='350' r='50'/%3E%3Ccircle cx='100' cy='350' r='50'/%3E%3C/g%3E%3Ccircle fill='%23085aab' cx='50' cy='400' r='50'/%3E%3Cg fill='%230064b4' %3E%3Ccircle cx='0' cy='450' r='50'/%3E%3Ccircle cx='100' cy='450' r='50'/%3E%3C/g%3E%3Ccircle fill='%23006ebc' cx='50' cy='500' r='50'/%3E%3Cg fill='%230078c5' %3E%3Ccircle cx='0' cy='550' r='50'/%3E%3Ccircle cx='100' cy='550' r='50'/%3E%3C/g%3E%3Ccircle fill='%230082cd' cx='50' cy='600' r='50'/%3E%3Cg fill='%23008cd4' %3E%3Ccircle cx='0' cy='650' r='50'/%3E%3Ccircle cx='100' cy='650' r='50'/%3E%3C/g%3E%3Ccircle fill='%230096db' cx='50' cy='700' r='50'/%3E%3Cg fill='%2300a0e2' %3E%3Ccircle cx='0' cy='750' r='50'/%3E%3Ccircle cx='100' cy='750' r='50'/%3E%3C/g%3E%3Ccircle fill='%2300aae9' cx='50' cy='800' r='50'/%3E%3Cg fill='%2300b5ef' %3E%3Ccircle cx='0' cy='850' r='50'/%3E%3Ccircle cx='100' cy='850' r='50'/%3E%3C/g%3E%3Ccircle fill='%2300bff4' cx='50' cy='900' r='50'/%3E%3Cg fill='%2300c9fa' %3E%3Ccircle cx='0' cy='950' r='50'/%3E%3Ccircle cx='100' cy='950' r='50'/%3E%3C/g%3E%3Ccircle fill='%2305d3ff' cx='50' cy='1000' r='50'/%3E%3C/g%3E%3C/svg%3E");*/
            /*background-attachment: fixed;*/
            /*background-size: contain;*/

            /*background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 1600 900'%3E%3Cpolygon fill='%23cc1414' points='957 450 539 900 1396 900'/%3E%3Cpolygon fill='%23aa0000' points='957 450 872.9 900 1396 900'/%3E%3Cpolygon fill='%23d40034' points='-60 900 398 662 816 900'/%3E%3Cpolygon fill='%23b10022' points='337 900 398 662 816 900'/%3E%3Cpolygon fill='%23d60051' points='1203 546 1552 900 876 900'/%3E%3Cpolygon fill='%23b2003d' points='1203 546 1552 900 1162 900'/%3E%3Cpolygon fill='%23d1006f' points='641 695 886 900 367 900'/%3E%3Cpolygon fill='%23ac0057' points='587 900 641 695 886 900'/%3E%3Cpolygon fill='%23c2008d' points='1710 900 1401 632 1096 900'/%3E%3Cpolygon fill='%239e0071' points='1710 900 1401 632 1365 900'/%3E%3Cpolygon fill='%23aa00aa' points='1210 900 971 687 725 900'/%3E%3Cpolygon fill='%23880088' points='943 900 1210 900 971 687'/%3E%3C/svg%3E");*/
            /*background-image: url('/svg/flat-mountain-1.svg');*/
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
    </style>

    <div class="container">

        <div class="row justify-content-center align-self-center">
            <div style="position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%);" class="col-md-4">
                    <div style="display: flex; justify-content: space-between; align-items: center;">
                        {{--<img height="25px" src="https://my.namast3.com/msid.png">--}}
                        <!--<img height="25px" src="https://my.namast3.com/logo.png">-->
                    </div>
                <div class="card">


                    <div class="card-header card-header-info">
                        <h4 class="card-title mt-0"> Login</h4>
                        {{--<p class="card-category"> Here is a subtitle for this table</p>--}}
                    </div>

                    <div class="card-body">
                        <form method="POST" action="{{ route('login') }}">
                            @csrf


                            <div class="form-group row">
                                <label for="nip" style="width: 70%; margin: 0 15%;"
                                       class=" col-form-label">{{ __('NIP') }}</label>

                                <div style="width: 70%; margin: 0 15%;" class="">
                                    <input id="nip" type="text"
                                           class="form-control{{ $errors->has('nip') ? ' is-invalid' : '' }}"
                                           name="nip" value="{{ old('nip') }}" required autofocus>
                                    @if ($errors->has('email'))
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('nip') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="password" style="width: 70%; margin: 0 15%;"
                                       class=" col-form-label">{{ __('Password') }}</label>

                                <div style="width: 70%; margin: 0 15%;" class="">
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


                            <div class="form-group row mb-0">
                                <div style="width: 70%; margin: 0 15%;" class="">
                                    <button type="submit" class="btn btn-info">
                                        {{ __('Login') }}
                                    </button>
                                </div>
                            </div>
                            {{--<div class="form-group row mb-0">--}}
                                {{--<div style="width: 70%; margin: 3% 15%;" class="">--}}
                                    {{--<a href="{{url('/register')}}" style="font-size: 0.9em; color: darkgrey;" class="btn-link">Don't have--}}
                                        {{--an account? Register.</a>--}}
                                {{--</div>--}}
                            {{--</div>--}}
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
