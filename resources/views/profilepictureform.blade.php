@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-4">
                <div class="card">
                    <div class="card-header">Upload New File</div>
                    <div class="card-body">
                        @if(session('success'))
                            <div class="alert alert-success">
                                {{ session('success') }}
                            </div>
                        @endif
                        <form action="{{ url('/profilepicture/upload/'.$employees->nip.'/process') }}" method="post" enctype="multipart/form-data">
                            {{ csrf_field() }}
                            {{ method_field('post') }}

                            <div class="form-group {{ !$errors->has('picture') ?: 'has-error' }}">
                                <label>Picture</label>

                                <div class="file-upload">
                                    <div class="file-select">

                                        <input type="file" name="picture" id="picture">
                                        <span class="help-block text-danger">{{ $errors->first('picture') }}</span>
                                    </div>
                                </div>
                            </div>
                            <div class="form-actions">
                                <button type="submit" class="btn btn-primary">Upload</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection