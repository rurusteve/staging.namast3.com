@extends('layouts.app')
@section('title', 'Add Note')

@section('content')
    <style>
        @media (min-width: 768px) {
            .col-md-6 {
                -webkit-box-flex: 0;
                -ms-flex: 0 0 50%;
                flex: 0 0 100%;
                max-width: 100%;
                justify-content: center;
            }
        }
    </style>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        Leave Note for {{ucwords(strtolower($employees->nama))}}
                        , {{ date('d M y', strtotime($leaverequestdetails->tanggalmulaicuti)) }} -
                        {{ date('d M y', strtotime($leaverequestdetails->tanggalakhircuti)) }}
                    </div>
                    <div class="card-body">
                        <form action="{{ URL::to('/submitnote/'.$nip.'/'.$id) }}" method="POST">
                            {{ csrf_field() }}

                            <div class="">
                                <label style="display: none;" for="keteranganapproval"
                                       class="col-md-4 col-form-label text-md-right">{{ __('Note') }}</label>

                                <div class="col-md-6">
                                    <div class="alert-heading">Note</div>
                                    <textarea id="keteranganapproval" type="text" class="form-control{{ $errors->has('keteranganapproval') ? ' is-invalid' : '' }}" name="keteranganapproval" rows="3"></textarea>

                                    @if ($errors->has('keteranganapproval'))
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('keteranganapproval') }}</strong>
                                    </span>
                                    @endif
                                    <br>
                                    <div class="form-group row mb-0" style="display: flex; justify-content: center;">
                                        <a href="{{ url()->previous() }}">
                                            <button type="button" class="btn btn-outline-secondary">Cancel</button>
                                        </a>
                                        <button type="submit" class="btn btn-primary">
                                            Submit<!--{{ __('Submit') }}-->
                                        </button>
                                    </div>
                                </div>



                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
