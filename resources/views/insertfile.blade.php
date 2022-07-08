@extends('layouts.app')
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
                    <div class="card-header">Biodata Karyawan</div>

                    <div class="card-body">
                        <form method="POST"
                              action="{{ \Illuminate\Support\Facades\URL::to('/uploadfile/process') }}">
                            {{ csrf_field() }}
                            <div class="form-group row">
                                <label for="fileketerangan"
                                       class="col-md-4 col-form-label text-md-right">{{ __('File Keterangan') }}</label>

                                <div class="col-md-6">
                                    <input type="file" name="fileketerangan" id="fileketerangan">
                                    @if ($errors->has('fileketerangan'))
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('fileketerangan') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="nip"
                                       class="col-md-4 col-form-label text-md-right">{{ __('NIP') }}</label>

                                <div class="col-md-6">
                                    <input id="nip" type="text"
                                           class="form-control{{ $errors->has('nip') ? ' is-invalid' : '' }}"
                                           name="nip" value="{{ old('nip') }}" required autofocus>

                                    @if ($errors->has('nip'))
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('nip') }}</strong>
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
