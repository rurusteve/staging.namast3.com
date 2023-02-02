@extends('layouts.app')
@section('title', 'Groups')
<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<link rel="stylesheet" href="/resources/demos/style.css">
<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/chosen/1.5.1/chosen.min.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/chosen/1.5.1/chosen.jquery.min.js"></script>
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        Add Group
                    </div>
                    <div class="card-body">
                        <form action="{{ URL::to('/team/groups/') }}" method="POST">
                            {{ csrf_field() }}

                            <div class="form-group row">
                                <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Group Name') }}</label>

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
                                <label for="code" class="col-md-4 col-form-label text-md-right">{{ __('Group Code') }}</label>

                                <div class="col-md-6">
                                    <input id="code" type="text"
                                           class="form-control{{ $errors->has('code') ? ' is-invalid' : '' }}"
                                           name="code" value="{{ old('code') }}" required autofocus>

                                    @if ($errors->has('code'))
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('code') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="divisions" class="col-md-4 col-form-label text-md-right">{{ __('Divisions') }}</label>

                                <div class="col-md-6">
                                    <select class="form-control" name="divisions" value="{{ old('divisions') }}" required>
                                        @foreach($divisions as $division)
                                        <option value="{{$division->id}}" {{ old('divisions') }}>{{$division->name}}</option>
                                        @endforeach
                                    </select>

                                    @if ($errors->has('divisions'))
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('divisions') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <script type="text/javascript">
                                $(".chosen").chosen();
                            </script>

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

    <script>
            $('#clientselect').on('change', function () {
                $('#period')
                    .val(
                        $(this).find(':selected').data('period')
                    );
                $('#type')
                    .val(
                        $(this).find(':selected').data('type')
                    );
                $('#location')
                    .val(
                        $(this).find(':selected').data('location')
                    );
            });


    </script>
@endsection
