@extends('layouts.app')
<style>
    input[type=file]::-webkit-file-upload-button {
        color: black;
        background-color: whitesmoke;
        border-radius: 5px;
        outline: none;
        padding: 5px 10px;
    }

</style>
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Main</div>

                    <div class="card-body">
                        <form class="form-horizontal" method="POST" action="{{ route('importdataemployeebiodata') }}"
                              enctype="multipart/form-data">
                            {{ csrf_field() }}

                            <div class="form-group{{ $errors->has('templateemployeebiodata') ? ' has-error' : '' }}">
                                <input id="templateemployeebiodata" type="file" class="button" name="templateemployeebiodata" required>
                                @if ($errors->has('csv_file'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('templateemployeebiodata') }}</strong>
                                    </span>
                                @endif
                                <div class="invalid-feedback">Example invalid custom file feedback</div>
                            </div>

                            <div class="checkbox">
                                <label>
                                    <input type="checkbox" name="header" checked> File contains header row?
                                </label>
                            </div>

                            <button type="submit" class="btn btn-primary">
                                Parse CSV
                            </button>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
