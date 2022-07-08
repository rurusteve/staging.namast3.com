@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Congratulations!</div>

                    <div class="panel-body">
                        Payroll data imported successfully.
                        <a href="{{ url('/employeebiodata') }}">
                            <button type="button" class="btn btn-outline-secondary">Back</button>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
