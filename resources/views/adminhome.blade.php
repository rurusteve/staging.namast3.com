@extends('layouts.app')
@section('title', 'Namaste')

@section('content')
    <style>
        .databox {
            text-align: left;
            border: 1px solid #ddd;
            padding: 20px;
            margin-bottom: 20px;
        }

        .row {
            padding: 10px 0;
        }

        .input-sm {
            margin: 0 10px;
        !important;
        }

        .jumbotron {
            background: #6b7381;
            color: #bdc1c8;
        }

        .jumbotron h1 {
            color: #fff;
        }

        .example {
            margin: 4rem auto;
        }

        .example > .row {
            margin-top: 2rem;
            height: 5rem;
            vertical-align: middle;
            text-align: center;
            border: 1px solid rgba(189, 193, 200, 0.5);
        }

        .example > .row:first-of-type {
            border: none;
            height: auto;
            text-align: left;
        }

        .example h3 {
            font-weight: 400;
        }

        .example h3 > small {
            font-weight: 200;
            font-size: 0.75em;
            color: #939aa5;
        }

        .example h6 {
            font-weight: 700;
            font-size: 0.65rem;
            letter-spacing: 3.32px;
            text-transform: uppercase;
            color: #bdc1c8;
            margin: 0;
            line-height: 5rem;
        }

        .example .btn-toggle {
            top: 50%;
            transform: translateY(-50%);
        }

        .btn-toggle {
            margin: 0 4rem;
            padding: 0;
            position: relative;
            border: none;
            height: 1.5rem;
            width: 3rem;
            border-radius: 1.5rem;
            color: #6b7381;
            background: #bdc1c8;
        }

        .btn-toggle:focus,
        .btn-toggle.focus,
        .btn-toggle:focus.active,
        .btn-toggle.focus.active {
            outline: none;
        }

        .btn-toggle:before,
        .btn-toggle:after {
            line-height: 1.5rem;
            width: 4rem;
            text-align: center;
            font-weight: 600;
            font-size: 0.75rem;
            text-transform: uppercase;
            letter-spacing: 2px;
            position: absolute;
            bottom: 0;
            transition: opacity 0.25s;
        }

        .btn-toggle:before {
            content: 'Off';
            left: -4rem;
        }

        .btn-toggle:after {
            content: 'On';
            right: -4rem;
            opacity: 0.5;
        }

        .btn-toggle > .handle {
            position: absolute;
            top: 0.1875rem;
            left: 0.1875rem;
            width: 1.125rem;
            height: 1.125rem;
            border-radius: 1.125rem;
            background: #fff;
            transition: left 0.25s;
        }

        .btn-outline-info {
            color: #00bcd4 !important;
        }

        .btn-outline-info:hover {
            color: white !important;
        }

        .btn-toggle.active {
            transition: background-color 0.25s;
        }

        .btn-toggle.active > .handle {
            left: 1.6875rem;
            transition: left 0.25s;
        }

        .btn-toggle.active:before {
            opacity: 0.5;
        }

        .btn-toggle.active:after {
            opacity: 1;
        }

        .btn-toggle.btn-sm:before,
        .btn-toggle.btn-sm:after {
            line-height: -0.5rem;
            color: #fff;
            letter-spacing: 0.75px;
            left: 0.4125rem;
            width: 2.325rem;
        }

        .btn-toggle.btn-sm:before {
            text-align: right;
        }

        .btn-toggle.btn-sm:after {
            text-align: left;
            opacity: 0;
        }

        .btn-toggle.btn-sm.active:before {
            opacity: 0;
        }

        .btn-toggle.btn-sm.active:after {
            opacity: 1;
        }

        .btn-toggle.btn-xs:before,
        .btn-toggle.btn-xs:after {
            display: none;
        }

        .btn-toggle:before,
        .btn-toggle:after {
            color: #6b7381;
        }

        .btn-toggle.active {
            background-color: #29b5a8;
        }

        .btn-toggle.btn-lg {
            margin: 0 5rem;
            padding: 0;
            position: relative;
            border: none;
            height: 2.5rem;
            width: 5rem;
            border-radius: 2.5rem;
        }

        .btn-toggle.btn-lg:focus,
        .btn-toggle.btn-lg.focus,
        .btn-toggle.btn-lg:focus.active,
        .btn-toggle.btn-lg.focus.active {
            outline: none;
        }

        .btn-toggle.btn-lg:before,
        .btn-toggle.btn-lg:after {
            line-height: 2.5rem;
            width: 5rem;
            text-align: center;
            font-weight: 600;
            font-size: 1rem;
            text-transform: uppercase;
            letter-spacing: 2px;
            position: absolute;
            bottom: 0;
            transition: opacity 0.25s;
        }

        .btn-toggle.btn-lg:before {
            content: 'Off';
            left: -5rem;
        }

        .btn-toggle.btn-lg:after {
            content: 'On';
            right: -5rem;
            opacity: 0.5;
        }

        .btn-toggle.btn-lg > .handle {
            position: absolute;
            top: 0.3125rem;
            left: 0.3125rem;
            width: 1.875rem;
            height: 1.875rem;
            border-radius: 1.875rem;
            background: #fff;
            transition: left 0.25s;
        }

        .btn-toggle.btn-lg.active {
            transition: background-color 0.25s;
        }

        .btn-toggle.btn-lg.active > .handle {
            left: 2.8125rem;
            transition: left 0.25s;
        }

        .btn-toggle.btn-lg.active:before {
            opacity: 0.5;
        }

        .btn-toggle.btn-lg.active:after {
            opacity: 1;
        }

        .btn-toggle.btn-lg.btn-sm:before,
        .btn-toggle.btn-lg.btn-sm:after {
            line-height: 0.5rem;
            color: #fff;
            letter-spacing: 0.75px;
            left: 0.6875rem;
            width: 3.875rem;
        }

        .btn-toggle.btn-lg.btn-sm:before {
            text-align: right;
        }

        .btn-toggle.btn-lg.btn-sm:after {
            text-align: left;
            opacity: 0;
        }

        .btn-toggle.btn-lg.btn-sm.active:before {
            opacity: 0;
        }

        .btn-toggle.btn-lg.btn-sm.active:after {
            opacity: 1;
        }

        .btn-toggle.btn-lg.btn-xs:before,
        .btn-toggle.btn-lg.btn-xs:after {
            display: none;
        }

        .btn-toggle.btn-sm {
            margin: 0 0.5rem;
            padding: 0;
            position: relative;
            border: none;
            height: 1.2rem;
            width: 2.4rem;
            border-radius: 1.5rem;
        }

        .btn-toggle.btn-sm:focus,
        .btn-toggle.btn-sm.focus,
        .btn-toggle.btn-sm:focus.active,
        .btn-toggle.btn-sm.focus.active {
            outline: none;
        }

        .btn-toggle.btn-sm:before,
        .btn-toggle.btn-sm:after {
            line-height: 1.3rem;
            width: 0.5rem;
            text-align: center;
            font-weight: 600;
            font-size: 0.55rem;
            text-transform: uppercase;
            letter-spacing: 2px;
            position: absolute;
            bottom: 0;
            transition: opacity 0.25s;
        }

        .btn-toggle.btn-sm:before {
            content: '';
            left: -0.5rem;
        }

        .btn-toggle.btn-sm:after {
            content: '';
            right: -0.5rem;
            opacity: 0.5;
        }

        .btn-toggle.btn-sm > .handle {
            position: absolute;
            top: 0.1875rem;
            left: 0.1875rem;
            width: 0.8rem;
            height: 0.8rem;
            border-radius: 1.125rem;
            background: #fff;
            transition: left 0.25s;
        }

        .btn-toggle.btn-sm.active {
            transition: background-color 0.25s;
        }

        .btn-toggle.btn-sm.active > .handle {
            left: 1.3875rem;
            transition: left 0.25s;
        }

        .btn-toggle.btn-sm.active:before {
            opacity: 0.5;
        }

        .btn-toggle.btn-sm.active:after {
            opacity: 1;
        }

        .btn-toggle.btn-sm.btn-sm:before,
        .btn-toggle.btn-sm.btn-sm:after {
            line-height: -0.5rem;
            color: #fff;
            letter-spacing: 0.75px;
            left: 0.4125rem;
            width: 2.325rem;
        }

        .btn-toggle.btn-sm.btn-sm:before {
            text-align: right;
        }

        .btn-toggle.btn-sm.btn-sm:after {
            text-align: left;
            opacity: 0;
        }

        .btn-toggle.btn-sm.btn-sm.active:before {
            opacity: 0;
        }

        .btn-toggle.btn-sm.btn-sm.active:after {
            opacity: 1;
        }

        .btn-toggle.btn-sm.btn-xs:before,
        .btn-toggle.btn-sm.btn-xs:after {
            display: none;
        }

        .btn-toggle.btn-xs {
            margin: 0 0;
            padding: 0;
            position: relative;
            border: none;
            height: 1rem;
            width: 2rem;
            border-radius: 1rem;
        }

        .btn-toggle.btn-xs:focus,
        .btn-toggle.btn-xs.focus,
        .btn-toggle.btn-xs:focus.active,
        .btn-toggle.btn-xs.focus.active {
            outline: none;
        }

        .btn-toggle.btn-xs:before,
        .btn-toggle.btn-xs:after {
            line-height: 1rem;
            width: 0;
            text-align: center;
            font-weight: 600;
            font-size: 0.75rem;
            text-transform: uppercase;
            letter-spacing: 2px;
            position: absolute;
            bottom: 0;
            transition: opacity 0.25s;
        }

        .btn-toggle.btn-xs:before {
            content: 'Off';
            left: 0;
        }

        .btn-toggle.btn-xs:after {
            content: 'On';
            right: 0;
            opacity: 0.5;
        }

        .btn-toggle.btn-xs > .handle {
            position: absolute;
            top: 0.125rem;
            left: 0.125rem;
            width: 0.75rem;
            height: 0.75rem;
            border-radius: 0.75rem;
            background: #fff;
            transition: left 0.25s;
        }

        .btn-toggle.btn-xs.active {
            transition: background-color 0.25s;
        }

        .btn-toggle.btn-xs.active > .handle {
            left: 1.125rem;
            transition: left 0.25s;
        }

        .btn-toggle.btn-xs.active:before {
            opacity: 0.5;
        }

        .btn-toggle.btn-xs.active:after {
            opacity: 1;
        }

        .btn-toggle.btn-xs.btn-sm:before,
        .btn-toggle.btn-xs.btn-sm:after {
            line-height: -1rem;
            color: #fff;
            letter-spacing: 0.75px;
            left: 0.275rem;
            width: 1.55rem;
        }

        .btn-toggle.btn-xs.btn-sm:before {
            text-align: right;
        }

        .btn-toggle.btn-xs.btn-sm:after {
            text-align: left;
            opacity: 0;
        }

        .btn-toggle.btn-xs.btn-sm.active:before {
            opacity: 0;
        }

        .btn-toggle.btn-xs.btn-sm.active:after {
            opacity: 1;
        }

        .btn-toggle.btn-xs.btn-xs:before,
        .btn-toggle.btn-xs.btn-xs:after {
            display: none;
        }

        .btn-toggle.btn-secondary {
            color: #6b7381;
            background: #bdc1c8;
        }

        .btn-toggle.btn-secondary:before,
        .btn-toggle.btn-secondary:after {
            color: #6b7381;
        }

        .btn-toggle.btn-secondary.active {
            background-color: #ff8300;
        }

        .filterlist {
            font-size: 0.8em;
        }

        .btn-toggle.btn-sm {
            margin: 5px 0;
        }

        .accordion .card-header {
            padding: 0;
            font-size: 0.6em !important;
            border-left: 0.6px solid #eceeee;
            -webkit-border-radius: 0;
            -moz-border-radius: 0;
            border-radius: 0;
        }

        .filterlink {
            display: inline-block;
            font-weight: 400;
            color: #212529;
            text-align: center;
            vertical-align: middle;
            -webkit-user-select: none;
            -moz-user-select: none;
            -ms-user-select: none;
            user-select: none;
            background-color: transparent;
            border-left: 0.6px solid #eceeee;
            padding: 0.375rem 0.75rem;
            font-size: 0.9rem;
            line-height: 1.5;
            -webkit-transition: color 0.15s ease-in-out, background-color 0.15s ease-in-out, border-color 0.15s ease-in-out, -webkit-box-shadow 0.15s ease-in-out;
            transition: color 0.15s ease-in-out, background-color 0.15s ease-in-out, border-color 0.15s ease-in-out, -webkit-box-shadow 0.15s ease-in-out;
            transition: color 0.15s ease-in-out, background-color 0.15s ease-in-out, border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out;
            transition: color 0.15s ease-in-out, background-color 0.15s ease-in-out, border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out, -webkit-box-shadow 0.15s ease-in-out;

        }

        .app-pages-Dashboard-__style___1_XpS {
            font-size: 21px;
            color: #666;
        }

        .databox > .title-center {
            color: #999;
            text-transform: uppercase;
            position: relative;
            font-size: 12px;
        }

        .modal-header i {
            font-size: 0.9em;
        }

        @media only screen and (min-device-width: 468px) {
            .goflex {
                display: block;
            }
        }

        @media only screen and (min-device-width: 768px) {
            .goflex {
                display: flex;
            }
        }

        .card-title {
            margin: 15px;
        }

    </style>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-auto">

                @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                @endif

            </div>
        </div>
        <div style="justify-content: flex-start;" class="modal-header">
            <h3><span style="color: darkgrey">{{$greetings}}</span> <b><span style="font-weight: bolder">{{ucwords(strtolower(Auth::user()->name))}}</span></b>
                <br> <b><span style="color: #f2bf2e;">Welcome to your dashboard and {{$emotionalgreetings}}</span></b>
                @if($emoticoncode == 1)
                    <i style="color: #f2bf2e" class="fas fa-grin-wink"></i>
                @elseif($emoticoncode == 2)
                    <i style="color: #f2bf2e" class="fas fa-kiss-wink-heart"></i>
                @elseif($emoticoncode == 3)
                    <i style="color: #f2bf2e" class="fas fa-grin-stars"></i>
                @elseif($emoticoncode == 4)
                    <i style="color: #f2bf2e" class="fas fa-grin-tongue"></i>
                @endif
            </h3>
        </div>

        @if($division === 'PARTNER' && Auth::user()->logintype === 'nonprofessional')
            <div class="container">
                @else
                    <div class="container goflex">
                        @endif
                        @if($division === 'PARTNER' && Auth::user()->logintype === 'nonprofessional')
                            <div style="display: contents;" class="row justify-content-left">
                                <div class="row container-fluid">
                                    <div class="container goflex" style="justify-content: flex-end;">
                                        <div style="padding-right: 15px; padding-top: 10px;">
                                            <span style="color: darkgrey">Month:</span> <b>{{ date('F', mktime(0, 0, 0, $maxperiod, 10)) }}</b></div>
                                    </div>
                                    <div class="container goflex">
                                        @foreach($collections as $collection)
                                            <div class="col-lg-4 col-md-4 col-sm-12">
                                                <div class="card card-stats">
                                                    <div class="card-header card-header-primary card-header-icon">
                                                        <div class="card-icon">
                                                            <img src="{{ asset('svg/bank.png') }}">
                                                        </div>
                                                        <p class="card-category">Gross Pay</p><br><br>
                                                        <h3 style=" font-size: 1.3em; font-weight: bold"
                                                            class="card-title">
                                                            Rp {{ number_format($collection -> totalpenghasilanbruto, 0, ',', '.') }}</h3>
                                                    </div>
                                                    <div class="card-footer">
                                                        {{--<i>Gaji Kotor</i>--}}
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-4 col-md-4 col-sm-12">
                                                <div class="card card-stats">
                                                    <div class="card-header card-header-primary card-header-icon">
                                                        <div class="card-icon">
                                                            <img src="{{ asset('svg/salary.png') }}">
                                                        </div>
                                                        <p class="card-category">Take Home Pay</p><br><br>
                                                        <h3 style=" font-size: 1.3em; font-weight: bold"
                                                            class="card-title">
                                                            Rp {{ number_format($collection -> totaltakehomepay, 0, ',', '.') }}</h3>
                                                    </div>
                                                    <div class="card-footer">
                                                        {{--<i>Gaji Bersih</i>--}}
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-4 col-md-4 col-sm-12">
                                                <div class="card card-stats">
                                                    <div class="card-header card-header-primary card-header-icon">
                                                        <div class="card-icon">
                                                            <img src="{{ asset('svg/tax.png') }}">
                                                        </div>
                                                        <p class="card-category">Income Tax</p><br><br>
                                                        <h3 style=" font-size: 1.3em; font-weight: bold"
                                                            class="card-title">
                                                            Rp {{ number_format($collection -> totalPPHbulanberkaitan, 0, ',', '.') }}</h3>
                                                    </div>
                                                    <div class="card-footer">
                                                        {{--<i>PPH Bulan Berkaitan</i>--}}
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        @else
                        @endif
                        <div style="display: contents" class="row justify-content-left">
                            <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog"
                                 aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered" role="document">
                                    <div class="modal-content">

                                        <div class="modal-header">
                                            <h5>Masukkan password anda</h5>

                                        </div>

                                        <div style="display: none">                            {{ $crypt = str_random(10)}}
                                        </div>
                                        <div class="modal-body">
                                            <form action="{{ url('/home/encryptslip/'.$crypt) }}">

                                                <div style="display: none;" class="form-group row">
                                                    <label for="email"
                                                           class="col-sm-4 col-form-label text-md-right">{{ __('Username') }}</label>

                                                    <div class="col-md-6">
                                                        <input id="userid" type="text"
                                                               class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}"
                                                               name="userid" value="{{ Auth::user()->nip }}" required>

                                                        @if ($errors->has('email'))
                                                            <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('email') }}</strong>
                                        </span>
                                                        @endif
                                                    </div>
                                                </div>

                                                <div class="form-group row">
                                                    <label for="password" class="col-md-4 col-form-label text-md-right"><i
                                                                class="fas fa-lock"></i> Password</label>

                                                    <div class="col-md-6">
                                                        <input id="password" type="password"
                                                               class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}"
                                                               name="password" required autofocus>

                                                        @if ($errors->has('password'))
                                                            <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('password') }}</strong>
                                        </span>
                                                        @endif
                                                    </div>
                                                </div>

                                                <div class="form-group row mb-0">
                                                    <div class="col-md-8 offset-md-4">
                                                        <button type="submit" class="btn btn-success">
                                                            {{ __('Buka') }}
                                                        </button>
                                                        <button type="button" class="btn btn-secondary"
                                                                data-dismiss="modal">
                                                            Batalkan
                                                        </button>

                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!--<div class="modal fade" id="exampleModalCenter2" tabindex="-1" role="dialog"-->
                            <!--     aria-labelledby="exampleModalCenterTitle2" aria-hidden="true">-->
                            <!--    <div class="modal-dialog modal-dialog-centered" role="document">-->
                            <!--        <div class="modal-content">-->

                            <!--            <div class="modal-header">-->
                            <!--                <h5>Akses slip gaji berdasarkan periode-->
                            <!--                </h5>-->

                            <!--            </div>-->

                            <!--            <div style="display: none">-->
                            <!--                {{ $crypt = str_random(10)}}-->
                            <!--            </div>-->
                            <!--            <div class="modal-body">-->
                            <!--                <form action="{{ url('/home/encryptslipperiod/'.$crypt) }}">-->

                            <!--                    <div style="display: none;" class="form-group row">-->
                            <!--                        <label for="email"-->
                            <!--                               class="col-sm-4 col-form-label text-md-right">{{ __('Username') }}</label>-->

                            <!--                        <div class="col-md-6">-->
                            <!--                            <input id="userid" type="text"-->
                            <!--                                   class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}"-->
                            <!--                                   name="userid" value="{{ Auth::user()->nip }}" required>-->

                            <!--                            @if ($errors->has('email'))-->
                            <!--                                <span class="invalid-feedback" role="alert">-->
                            <!--                <strong>{{ $errors->first('email') }}</strong>-->
                            <!--            </span>-->
                            <!--                            @endif-->
                            <!--                        </div>-->
                            <!--                    </div>-->
                            <!--                    <div class="form-group row">-->
                            <!--                        <label for="periode"-->
                            <!--                               class="col-md-4 col-form-label text-md-right"><i-->
                            <!--                                    class="far fa-calendar-alt"></i> Periode</label>-->

                            <!--                        <div class="col-md-6">-->
                            <!--                            <select name="periode" id="periode"-->
                            <!--                                    class="form-control{{ $errors->has('periode') ? ' is-invalid' : '' }}">-->
                            <!--                                @foreach($listbyperiodes as $listbyperiode)-->

                            <!--                                    @if($listbyperiode->periode === "1")-->
                            <!--                                        <option value="1">Januari</option>-->
                            <!--                                    @elseif($listbyperiode->periode === "2")-->
                            <!--                                        <option value="2">Februari</option>-->
                            <!--                                    @elseif($listbyperiode->periode === "3")-->
                            <!--                                        <option value="3">Maret</option>-->
                            <!--                                    @elseif($listbyperiode->periode === "4")-->
                            <!--                                        <option value="4">April</option>-->
                            <!--                                    @elseif($listbyperiode->periode === "5")-->
                            <!--                                        <option value="5">Mei</option>-->
                            <!--                                    @elseif($listbyperiode->periode === "6")-->
                            <!--                                        <option value="6">Juni</option>-->
                            <!--                                    @elseif($listbyperiode->periode === "7")-->
                            <!--                                        <option value="7">Juli</option>-->
                            <!--                                    @elseif($listbyperiode->periode === "8")-->
                            <!--                                        <option value="8">Agustus</option>-->
                            <!--                                    @elseif($listbyperiode->periode === "9")-->
                            <!--                                        <option value="9">September</option>-->
                            <!--                                    @elseif($listbyperiode->periode === "10")-->
                            <!--                                        <option value="10">Oktober</option>-->
                            <!--                                    @elseif($listbyperiode->periode === "11")-->
                            <!--                                        <option value="11">November</option>-->
                            <!--                                    @elseif($listbyperiode->periode === "12")-->
                            <!--                                        <option value="12">Desember</option>-->

                            <!--                                    @endif-->

                            <!--                                @endforeach-->
                            <!--                            </select>-->

                            <!--                            @if ($errors->has('password'))-->
                            <!--                                <span class="invalid-feedback" role="alert">-->
                            <!--                <strong>{{ $errors->first('password') }}</strong>-->
                            <!--            </span>-->
                            <!--                            @endif-->
                            <!--                        </div>-->
                            <!--                    </div>-->
                            <!--                    <div class="form-group row">-->
                            <!--                        <label for="password" class="col-md-4 col-form-label text-md-right"><i-->
                            <!--                                    class="fas fa-lock"></i> Password</label>-->

                            <!--                        <div class="col-md-6">-->
                            <!--                            <input id="password" type="password"-->
                            <!--                                   class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}"-->
                            <!--                                   name="password" required autofocus>-->

                            <!--                            @if ($errors->has('password'))-->
                            <!--                                <span class="invalid-feedback" role="alert">-->
                            <!--                <strong>{{ $errors->first('password') }}</strong>-->
                            <!--            </span>-->
                            <!--                            @endif-->
                            <!--                        </div>-->
                            <!--                    </div>-->

                            <!--                    <div class="form-group row mb-0">-->
                            <!--                        <div class="col-md-8 offset-md-4">-->
                            <!--                            <button type="submit" class="btn btn-success">-->
                            <!--                                {{ __('Buka') }}-->
                            <!--                            </button>-->
                            <!--                            <button type="button" class="btn btn-secondary"-->
                            <!--                                    data-dismiss="modal">-->
                            <!--                                Batalkan-->
                            <!--                            </button>-->

                            <!--                        </div>-->
                            <!--                    </div>-->
                            <!--                </form>-->

                            <!--            </div>-->

                            <!--        </div>-->
                            <!--    </div>-->
                            <!--</div>-->


                            @if($division === 'PARTNER' && Auth::user()->logintype === 'nonprofessional')
                                <div style="margin-bottom: 20px; display: flex" class="row container-fluid">
                                    <div class="col-lg-6 col-md-6">
                                        {{--<div class="card" style="margin-bottom: 50px;">--}}
                                        {{--<div class="card-header card-header-info">--}}
                                        {{--<h4 class="card-title"><i class="fas fa-chart-line"></i> <b>Total--}}
                                        {{--approved OT</b></h4>--}}
                                        {{--<p class="card-category"></p>--}}
                                        {{--</div>--}}
                                        {{--<div class="card-body">--}}
                                        {{--<script type="text/javascript"--}}
                                        {{--src="https://www.gstatic.com/charts/loader.js"></script>--}}
                                        {{--<script type="text/javascript">--}}
                                        {{--var otarray = overtimearrays--}}

                                        {{--google.charts.load('current', {'packages': ['corechart']});--}}
                                        {{--google.charts.setOnLoadCallback(drawChart);--}}

                                        {{--function drawChart() {--}}
                                        {{--var data = google.visualization.arrayToDataTable(otarray);--}}

                                        {{--var options = {--}}
                                        {{--curveType: 'function',--}}
                                        {{--legend: {position: 'bottom'}--}}
                                        {{--};--}}

                                        {{--var chart = new google.visualization.LineChart(document.getElementById('curve_chart'));--}}

                                        {{--chart.draw(data, options);--}}
                                        {{--}--}}
                                        {{--</script>--}}
                                        {{--<div id="curve_chart" class="chart"></div>--}}
                                        {{--</div>--}}
                                        {{--</div>--}}
                                        <div class="card" style="margin-bottom: 50px;">
                                            <div class="card-header card-header-warning">
                                                <h4 class="card-title"><i class="fas fa-medal"></i> <b>Top 5
                                                        | Overtime | Professional</b></h4>
                                                <p class="card-category">Top 5 professional with the highest amount of overtime </p>
                                                {{--in {{date('F', mktime(0, 0, 0, $lastmonth, 10))}}--}}
                                            </div>
                                            <div class="card-body">
                                                <table class="table-striped table table-hover">
                                                    <thead>
                                                    <tr>
                                                        <td>#</td>
                                                        <td>Name</td>
                                                        <td>Total Overtime(s)</td>
                                                    </tr>
                                                    </thead>
                                                    <tbody>
                                                    <div style="display: none;">{{$number = 1}}</div>
                                                    @foreach ($topthrees as $topthree)
                                                        <tr>
                                                            <td>{{$number++}}</td>
                                                            <td>
                                                                <b>{{ucwords(strtolower($topthree->nama))}}</b></td>
                                                            <td>{{number_format((float)$topthree->totalhour, 2, '.', '')}}</td>
                                                        </tr>
                                                    @endforeach
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                        <div class="card" style="margin-bottom: 50px;">
                                            <div class="card-header card-header-info">
                                                <h4 class="card-title"><i class="fas fa-medal"></i> <b>Top 5 |
                                                        Companies</b></h4>
                                                <p class="card-category">Top 5 companies with the highest amount of overtime</p>
                                                {{--in {{date('F', mktime(0, 0, 0, $lastmonth, 10))}}--}}
                                            </div>
                                            <div class="card-body">
                                                <table class="table-striped table table-hover">
                                                    <thead>
                                                    <tr>
                                                        <td>#</td>
                                                        <td>Company Name</td>
                                                        <td>Total Ovetime(s)</td>
                                                    </tr>
                                                    </thead>
                                                    <tbody>
                                                    <div style="display: none;">{{$number = 1}}</div>
                                                    @foreach ($topfivecompanies as $topfivecompany)
                                                        <tr>
                                                            <td>{{$number++}}</td>
                                                            <td>
                                                                <b>{{$topfivecompany->nama}}</b>
                                                            </td>
                                                            <td>{{number_format((float)$topfivecompany->totalhour, 2, '.', '')}}</td>
                                                        </tr>
                                                    @endforeach
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                        {{--<div class="card">--}}
                                        {{--<div class="card-header card-header-danger">--}}
                                        {{--<h4 class="card-title"><i class="fas fa-exclamation-circle"></i> <b>Bottom--}}
                                        {{--5 Professionals</b></h4>--}}
                                        {{--<p class="card-category"></p>--}}
                                        {{--</div>--}}
                                        {{--<div class="card-body">--}}
                                        {{--<table class="table-striped table table-hover">--}}
                                        {{--<thead>--}}
                                        {{--<tr>--}}
                                        {{--<td>--}}
                                        {{--#--}}
                                        {{--</td>--}}
                                        {{--<td>--}}
                                        {{--Name--}}
                                        {{--</td>--}}
                                        {{--<td>--}}
                                        {{--Total Work Hour--}}
                                        {{--</td>--}}
                                        {{--</tr>--}}
                                        {{--</thead>--}}
                                        {{--<tbody>--}}
                                        {{--<div style="display: none;">{{$num = 1}}</div>--}}
                                        {{--@foreach ($bottomthrees as $bottomthree)--}}
                                        {{--<tr>--}}
                                        {{--<td>{{$num++}}</td>--}}
                                        {{--<td><i class="far fa-star-half"></i>--}}
                                        {{--<b>{{ucwords(strtolower($bottomthree->nama))}}</b></td>--}}
                                        {{--<td><i class="fas fa-clock"></i> {{$bottomthree->totalhour}}--}}
                                        {{--</td>--}}
                                        {{--</tr>--}}
                                        {{--@endforeach--}}
                                        {{--</tbody>--}}
                                        {{--</table>--}}
                                        {{--</div>--}}
                                        {{--</div>--}}
                                    </div>
                                    <div style="margin-bottom: 20px;" class="col-lg-6 col-md-6">
                                        @if ($inchargestatus == 1 || ($inchargestatus == 0 && $division == 'HRD'))
                                            <div class="card">
                                                <div class="card-header">
                                                    <h4><i class="fas fa-calendar-day"></i> Status Cuti</h4>
                                                </div>

                                                <div class="card-body">
                                                    <table class="table table-hover">
                                                        <thead>
                                                        <tr>
                                                            <th>Status</th>
                                                            <th>Jumlah</th>
                                                        </tr>
                                                        </thead>
                                                        <tbody>

                                                        <!-- <tr>
                                                            <td>Cuti bersama</td>
                                                            <td></td>
                                                        </tr> -->
                                                        <tr>
                                                            <td>Jatah cuti <i class="fas fa-info-circle"
                                                                              data-toggle="tooltip"
                                                                              data-placement="right"
                                                                              title="Harap hubungi tim HRD untuk info penambahan cuti"></i>
                                                            </td>

                                                            <td>{{ $jatahcutiawal }}</td>
                                                        </tr>
                                                        <tr>
                                                            <td>Penambahan <i class="fas fa-info-circle"
                                                                              data-toggle="tooltip"
                                                                              data-placement="right"
                                                                              title="Harap hubungi tim HRD untuk info penambahan cuti"></i>
                                                            </td>

                                                            <td>{{ $manualinputcutiplus }}</td>
                                                        </tr>
                                                        <tr>
                                                            <td>Pengurangan <i class="fas fa-info-circle"
                                                                               data-toggle="tooltip"
                                                                               data-placement="right"
                                                                               title="Harap hubungi tim HRD untuk info pengurangan cuti"></i>
                                                            </td>
                                                            <td>{{ $manualinputcutiminus }}</td>
                                                        </tr>
                                                        <tr>
                                                            <td>Cuti yang sudah diambil</td>
                                                            <td>{{ $approvedrequest }}</td>
                                                        </tr>
                                                        <tr>
                                                            <td>Cuti tersedia</td>
                                                            <td>{{ $availableleave }}</td>
                                                        </tr>

                                                        </tbody>
                                                    </table>
                                                    <a href="{{ url('cuti/home') }}">
                                                        <button type="button" class="btn btn-primary"><i
                                                                    class="fas fa-calendar-day"></i> Detail &
                                                            Pengajuan
                                                            Cuti
                                                        </button>
                                                    </a>


                                                </div>
                                            </div>

                                            <div class="card">
                                                <div class="card-header">
                                                    Leave Request
                                                </div>
                                                <div class="card-body">
                                                    @foreach($type6s as $type6)
                                                        <div class="alert alert-danger" role="alert">
                                                            <button type="button" class="close"
                                                                    data-dismiss="alert"
                                                                    aria-label="Close">
                                                                <i class="material-icons">close</i>
                                                            </button>
                                                            On leave request
                                                            by {{ ucwords(strtolower($type6->nama)) }}
                                                        </div>
                                                    @endforeach
                                                    <a href="/adminrequestleavelist">[ <i
                                                                class="fas fa-list-ul"></i>
                                                        See list]</a>

                                                </div>
                                            </div>

                                            @if($division == 'HRD')

                                            @elseif($division == 'SEKRETARIS')
                                                <div class="card">
                                                    <div class="card-header">
                                                        <i class="fas fa-user-clock"></i> Time Report
                                                        Administration
                                                    </div>
                                                    <div class="card-body">
                                                        <a href="/administration/timereport/clients">
                                                            <button type="submit" class="btn btn-primary">
                                                                Clients
                                                            </button>
                                                        </a>
                                                    </div>
                                                </div>
                                            @else
                                            @endif
                                            {{--@if($division == 'SEKRETARIS')--}}
                                            {{--<div class="card">--}}
                                            {{--<div class="card-header">--}}
                                            {{--Time Report Administration--}}
                                            {{--</div>--}}
                                            {{--<div class="card-body">--}}
                                            {{--<a href="/administration/timereport/clients">--}}
                                            {{--<button type="submit" class="btn btn-primary">Client and Tasks</button>--}}
                                            {{--</a>--}}
                                            {{--</div>--}}
                                            {{--</div>--}}
                                            {{--@else--}}
                                            {{--@endif--}}
                                        @elseif ($inchargestatus == 2)
                                            <div class="card">
                                                <div class="card-header">
                                                    Leave Request
                                                </div>
                                                <div class="card-body">
                                                    @foreach($type2s as $type2)
                                                        <div class="alert alert-danger" role="alert">
                                                            <button type="button" class="close"
                                                                    data-dismiss="alert"
                                                                    aria-label="Close">
                                                                <i class="material-icons">close</i>
                                                            </button>
                                                            On leave request
                                                            by {{ ucwords(strtolower($type2->nama)) }}
                                                        </div>
                                                    @endforeach
                                                    <a href="/adminrequestleavelist">[ <i
                                                                class="fas fa-list-ul"></i>
                                                        See list]</a>

                                                </div>
                                            </div>
                                            <div class="card">
                                                <div class="card-header">
                                                    Leave Request > 5 days
                                                </div>
                                                <div class="card-body">
                                                    @foreach($type4s as $type4)
                                                        <div class="alert alert-danger" role="alert">
                                                            <button type="button" class="close"
                                                                    data-dismiss="alert"
                                                                    aria-label="Close">
                                                                <i class="material-icons">close</i>
                                                            </button>
                                                            On leave request
                                                            by {{ ucwords(strtolower($type4->nama)) }}
                                                        </div>
                                                    @endforeach
                                                    <a href="/adminrequestleavelist">[ <i
                                                                class="fas fa-list-ul"></i>
                                                        See list]</a>

                                                </div>
                                            </div>
                                        @else
                                        @endif

                                    </div>
                                    @elseif($division !== 'PARTNER' && Auth::user()->logintype !== 'nonprofessional')
                                        <div class="card">
                                            <div class="card-header">
                                                Time Reports
                                            </div>
                                            <div class="card-body">


                                                <a href="{{ url('/timesheets/main') }}">
                                                    <button type="button" class="btn btn-success"><i
                                                                class="fas fa-user-clock"></i> Time Sheets
                                                    </button>
                                                </a>
                                                <a href="{{ url('/input/timereport') }}">
                                                    <button type="button" class="btn btn-warning"><i
                                                                class="fas fa-file-import"></i> Input Time Report
                                                    </button>
                                                </a>
                                            </div>
                                        </div>
                                    @endif

                                    <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog"
                                         aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLongTitle">Modal title</h5>
                                                    <button type="button" class="close" data-dismiss="modal"
                                                            aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    ...
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary"
                                                            data-dismiss="modal">Close
                                                    </button>
                                                    <button type="button" class="btn btn-primary">Save changes</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    @if($inchargestatus == 1 || $inchargestatus == 0)
                                        <div style="margin-bottom: 20px;" class="col-lg-6 col-md-6">

                                            <div class="card">
                                                <div class="card-header">
                                                    <h4><i class="fas fa-money-check-alt"></i> Slip Gaji</h4>
                                                </div>

                                                <div class="card-body">
                                                    @if($periode == $month)
                                                        <div class="alert alert-success" role="alert">
                                                            <button type="button" class="close" data-dismiss="alert"
                                                                    aria-label="Close">
                                                                <i class="material-icons">close</i>
                                                            </button>
                                                            Slip gaji anda untuk bulan ini sudah tersedia <i
                                                                    class="fas fa-smile-wink"></i>.
                                                            Silahkan klik
                                                            <a href="" class="link" data-toggle="modal"
                                                               data-target="#exampleModalCenter">
                                                                <b>disini</b>
                                                            </a>
                                                            , atau dengan mengakses menu Payslips.

                                                        </div>
                                                    @elseif($periode !== $month)
                                                        <div style="margin: 0;" class="alert alert-light" role="alert">
                                                            <button type="button" class="close" data-dismiss="alert"
                                                                    aria-label="Close">
                                                                <i class="material-icons">close</i>
                                                            </button>
                                                            Slip gaji anda untuk bulan ini belum tersedia <i
                                                                    class="far fa-grin-beam-sweat"></i>
                                                        </div>
                                                    @endif
                                                    <!--<div class="card">-->
                                                    <!--    <div class="card-body">-->
                                                    <!--        <div class="dropdown">-->
                                                    <!--            <a href="" class="link" data-toggle="modal"-->
                                                    <!--               data-target="#exampleModalCenter2">-->
                                                    <!--                <button class="btn btn-info">-->
                                                    <!--                    <i class="far fa-calendar-alt"></i> Akses gaji-->
                                                    <!--                    berdasarkan-->
                                                    <!--                    periode-->
                                                    <!--                </button>-->
                                                    <!--            </a>-->
                                                    <!--        </div>-->
                                                    <!--    </div>-->
                                                    <!--</div>-->
                                                </div>
                                            </div>

                                            @else
                                            @endif

                                        </div>


                                        <div style="margin-bottom: 20px;" class="col-lg-6 col-md-6">
                                            @if ($inchargestatus == 1 || ($inchargestatus == 0 && $division == 'HRD'))
                                                <div class="card">
                                                    <div class="card-header">
                                                        <h4><i class="fas fa-calendar-day"></i> Status Cuti</h4>
                                                    </div>

                                                    <div class="card-body">
                                                        <table class="table table-hover">
                                                            <thead>
                                                            <tr>
                                                                <th>Status</th>
                                                                <th>Jumlah</th>
                                                            </tr>
                                                            </thead>
                                                            <tbody>

                                                            <!-- <tr>
                                                                <td>Cuti bersama</td>
                                                                <td></td>
                                                            </tr> -->
                                                            <tr>
                                                                <td>Jatah cuti <i class="fas fa-info-circle"
                                                                                  data-toggle="tooltip"
                                                                                  data-placement="right"
                                                                                  title="Harap hubungi tim HRD untuk info penambahan cuti"></i>
                                                                </td>

                                                                <td>{{ $jatahcutiawal }}</td>
                                                            </tr>
                                                            <tr>
                                                                <td>Penambahan <i class="fas fa-info-circle"
                                                                                  data-toggle="tooltip"
                                                                                  data-placement="right"
                                                                                  title="Harap hubungi tim HRD untuk info penambahan cuti"></i>
                                                                </td>

                                                                <td>{{ $manualinputcutiplus }}</td>
                                                            </tr>
                                                            <tr>
                                                                <td>Pengurangan <i class="fas fa-info-circle"
                                                                                   data-toggle="tooltip"
                                                                                   data-placement="right"
                                                                                   title="Harap hubungi tim HRD untuk info pengurangan cuti"></i>
                                                                </td>
                                                                <td>{{ $manualinputcutiminus }}</td>
                                                            </tr>
                                                            <tr>
                                                                <td>Cuti yang sudah diambil</td>
                                                                <td>{{ $approvedrequest }}</td>
                                                            </tr>
                                                            <tr>
                                                                <td>Cuti tersedia</td>
                                                                <td>{{ $availableleave }}</td>
                                                            </tr>

                                                            </tbody>
                                                        </table>
                                                        <a href="{{ url('cuti/home') }}">
                                                            <button type="button" class="btn btn-primary"><i
                                                                        class="fas fa-calendar-day"></i> Detail &
                                                                Pengajuan
                                                                Cuti
                                                            </button>
                                                        </a>


                                                    </div>
                                                </div>

                                                <div class="card">
                                                    <div class="card-header">
                                                        Leave Request
                                                    </div>
                                                    <div class="card-body">
                                                        @foreach($type6s as $type6)
                                                            <div class="alert alert-danger" role="alert">
                                                                <button type="button" class="close"
                                                                        data-dismiss="alert"
                                                                        aria-label="Close">
                                                                    <i class="material-icons">close</i>
                                                                </button>
                                                                On leave request
                                                                by {{ ucwords(strtolower($type6->nama)) }}
                                                            </div>
                                                        @endforeach
                                                        <a href="/adminrequestleavelist">[ <i
                                                                    class="fas fa-list-ul"></i>
                                                            See list]</a>

                                                    </div>
                                                </div>

                                                @if($division == 'HRD')

                                                @elseif($division == 'SEKRETARIS')
                                                    <div class="card">
                                                        <div class="card-header">
                                                            <i class="fas fa-user-clock"></i> Time Report
                                                            Administration
                                                        </div>
                                                        <div class="card-body">
                                                            <a href="/administration/timereport/clients">
                                                                <button type="submit" class="btn btn-primary">
                                                                    Clients
                                                                </button>
                                                            </a>
                                                        </div>
                                                    </div>
                                                @else
                                                @endif
                                            @elseif ($inchargestatus == 2)

                                            @else
                                            @endif

                                        </div>
                                </div>
                        </div>
                    </div>
            </div>

            <script type="text/javascript"
                    src="https://www.gstatic.com/charts/loader.js"></script>
            <script type="text/javascript">
                // Load google charts
                google.charts.load('current', {'packages': ['corechart']});
                google.charts.setOnLoadCallback(drawChart);

                // Draw the chart and set the chart values
                function drawChart() {
                    var data = google.visualization.arrayToDataTable([
                        ['Task', 'Hours per Day'],
                        ['Sisa cuti', {{$availableleave}}],
                        ['Cuti diambil', {{$approvedrequest}}],

                    ]);

                    // Optional; add a title and set the width and height of the chart
                    var options = {'title': 'Status Cuti:', 'width': 400, 'height': 250};

                    // Display the chart inside the <div> element with id="piechart"
                    var chart = new google.visualization.PieChart(document.getElementById('piechart'));
                    chart.draw(data, options);
                }

                $(document).ready(function () {
                    $('[data-toggle="tooltip"]').tooltip();
                });
            </script>

@endsection