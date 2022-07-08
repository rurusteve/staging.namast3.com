@extends('layouts.app')
<style>
    .btn-outline-primary{
        margin: 5px; !important;
    }
</style>
@section('content')
    <div class="container">
        <h2>Welcome to your dashboard {{ Auth::user()->name }} </h2>
        <div class="row justify-content-center">
            @include('layouts.menu')
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Payroll</div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif

                            <a href="/runpayrollhome"><button type="button" style="border-radius: 50%; width: 100px; height: 100px;" class="btn btn-outline-primary"><i style="font-size: 30px;" class="fas fa-rocket"></i><br>Run</button></a>
                            <a href="/employeedatabase"><button type="button" style="border-radius: 50%; width: 100px; height: 100px;" class="btn btn-outline-primary"><i style="font-size: 30px;" class="fas fa-database"></i><br>Data</button></a>
                            <a href="/payrollhistory"><button type="button" style="border-radius: 50%; width: 100px; height: 100px;" class="btn btn-outline-primary"><i style="font-size: 30px;" class="fas fa-history"></i><br>History</button></a>
                            <!-- <a href="/koreksiinput"><button type="button" style="border-radius: 50%; width: 100px; height: 100px;"class="btn btn-outline-primary"><i style="font-size: 30px;" class="fas fa-check-double"></i><br>Correction</button></a> -->

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
