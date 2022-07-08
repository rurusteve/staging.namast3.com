@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header card-header-success">
                        <h4 class="card-title">Success</h4>
                    </div>
                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif
                        Data added successfully!<br>
                            <a href="/user/payrollandlogin/form"><button type="button" class="btn btn-primary">Insert another employee</button></a>
                            <a href="/payroll/data"><button type="button" class="btn btn-primary">User list</button></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
