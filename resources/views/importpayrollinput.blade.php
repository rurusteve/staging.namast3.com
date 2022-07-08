@extends('layouts.app')
@section('title', 'Import Payroll Data')

<style>
    input[type=file]::-webkit-file-upload-button {
        color: black;
        background-color: whitesmoke;
        border-radius: 5px;
        outline: none;
        padding: 5px 10px;
    }
    .form-group input[type=file] {
        opacity: 1 !important;
        position: initial !important;
    }

</style>
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Masukkan Data Input</div>

                    <div class="card-body">
                        <form class="form-horizontal" method="POST" action="{{ route('importdatapayrollinput') }}"
                              enctype="multipart/form-data">
                            {{ csrf_field() }}

                            <div class="form-group{{ $errors->has('templatepayrollinput') ? ' has-error' : '' }}">
                                <input id="templatepayrollinput" type="file" class="button" name="templatepayrollinput" required>
                                @if ($errors->has('templatepayrollinput'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('templatepayrollinput') }}</strong>
                                    </span>
                                @endif
                                <div class="invalid-feedback">Example invalid custom file feedback</div>
                            </div>

                            {{--<div class="checkbox">--}}
                                {{--<label>--}}
                                    {{--<input type="checkbox" name="header" checked> File contains header row?--}}
                                {{--</label>--}}
                            {{--</div>--}}

                            <button type="submit" class="btn btn-primary">
                                Masukkan Data
                            </button>
                            <a href="{{ url()->previous() }}">
                                    <button type="button" class="btn btn-outline-secondary">Batal</button>
                                </a>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
