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
                    <div class="card-header">Data Karyawan Baru</div>

                    <div class="card-body">
                        <form method="POST" action="{{ url('/savekoreksi/'.$employees->nip) }}">
                            {{ csrf_field() }}


                            <form>
                                <div class="row">
                                    <div class="col">
                                        <input type="text" class="form-control"
                                               value="{{ $employees->nip }}">
                                    </div>
                                    <div class="col">
                                        <input type="text" class="form-control" placeholder="Last name"
                                               value="{{ $employees->nip }}">
                                    </div>
                                    <div class="col">
                                        <input type="text" class="form-control" placeholder="Last name">
                                    </div>
                                </div>
                            </form>

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
