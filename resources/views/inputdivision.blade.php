@extends('layouts.app')
@section('title', 'Time Report')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        Input Division
                    </div>
                    <div class="card-body">
                        <form action="{{ URL::to('/administration/timereport/insertdivision') }}" method="POST">
                            {{ csrf_field() }}

                            <div class="form-group row">
                                <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Division Name') }}</label>

                                <div class="col-md-6">
                                    <input id="name" type="text"
                                           class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}"
                                           name="name" value="{{ old('name') }}" required autofocus>

                                    @if ($errors->has('name'))
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="code" class="col-md-4 col-form-label text-md-right">{{ __('Division Code') }}</label>

                                <div class="col-md-6">
                                    <input id="code" type="text"
                                           class="form-control{{ $errors->has('code') ? ' is-invalid' : '' }}"
                                           name="code" value="{{ old('code') }}" required>

                                    @if ($errors->has('code'))
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('code') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="branch" class="col-md-4 col-form-label text-md-right">{{ __('Branch') }}</label>

                                <div class="col-md-6">
                                    <select class="form-control" name="branch" value="{{ old('branch') }}" required>
                                        <option value="" {{ old('branch') }} selected disabled>Choose Branch</option>
                                        <option value="1" {{ old('branch') }}>Jakarta</option>
                                        <option value="2" {{ old('branch') }}>Batam</option>
                                    </select>

                                    @if ($errors->has('branch'))
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('branch') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group row mb-0" style="display: flex; justify-content: center;">

                                <a href="{{url()->previous()}}">
                                    <button type="button" class="btn btn-outline-secondary">Cancel</button>
                                </a>
                                <button type="submit" class="btn btn-primary">
                                    Submit<!--{{ __('Submit') }}-->
                                </button>
                            </div>


                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
