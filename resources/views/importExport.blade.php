@extends('layouts.app')

@section('content')

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css"
          integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    {{--<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"--}}
    {{--integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo"--}}
    {{--crossorigin="anonymous"></script>--}}
    {{--<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"--}}
    {{--integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy"--}}
    {{--crossorigin="anonymous"></script>--}}
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8 col-md-offset-2">
                <div class="card">
                    <div class="card-header">Bulk Time Report</div>

                    <div class="card-body">

                        <div class="card" style="width: 18rem;">
                            <div class="card-body">
                                <h5 class="card-title">Hi, {{ ucwords(strtolower($nama)) }}</h5>
                                <h6 class="card-subtitle mb-2 text-muted"><a href="" class="card-link"><i class="fas fa-file-download"></i> Download Template</a>
                                </h6>
                                <p class="card-text">Untuk menghindari terjadinya <i>error</i> saat <i>upload</i>, mohon
                                    kolom kosong yang terdapat dalam <i>table</i> di<span style="color: #ed7259;"><b><i
                                                    class="fas fa-eraser"></i>clear</span></b> terlebih dahulu.</p>
                                <form method="POST" enctype="multipart/form-data">
                                    {{ csrf_field() }}
                                    <div class="form-group">
                                        <label for="file">Upload file</label>
                                        <input type="file" class="form-control-file" name="file" id="file"
                                               placeholder="">
                                    </div>
                                    <button type="submit" class="btn btn-primary"><i
                                                class="fas fa-cloud-upload-alt"></i> Submit
                                    </button>
                                </form>
                            </div>
                        </div>


                    </div>

                </div>
            </div>
        </div>
    </div>

@endsection
