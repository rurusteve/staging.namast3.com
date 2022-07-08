@extends('layouts.app')
@section('title', 'Time Report')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif

                        <div class="container">
                            <h2>Employee Time Report</h2>
                            <div class="dropdown show">
                                <a class="btn btn-secondary dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    Filter by client:
                                </a>

                                <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">

                                    <a class="dropdown-item" href="?clientid=CL02">CL02</a>
                                    <a class="dropdown-item" href="?clientid=CL03">CL03</a>
                                    <a class="dropdown-item" href="?sortduration">Sort Client</a>
                                    <a class="dropdown-item" href="?sortday">Sort Day</a>
                                    <a class="dropdown-item" href="?sortdatedesc">Sort Date - Newest</a>
                                    <a class="dropdown-item" href="?sortdateasc">Sort Date - Oldest</a>
                                </div>
                            </div><br>

                            <table class="table table-striped">
                                <thead>
                                <tr>
                                    <th>Date</th>
                                    <th>Day</th>
                                    <th>Client</th>
                                    <th>Task</th>
                                    <th>Description</th>
                                    <th>Start Task</th>
                                    <th>End Task</th>
                                    <th>Duration</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($timereports as $timereport)
                                    <tr>
                                        <td>{{$timereport->date}}</td>
                                        <td>{{$timereport->day}}</td>
                                        <td>{{$timereport->clientid}}</td>
                                        <td>{{$timereport->task}}</td>
                                        <td>{{$timereport->description}}</td>
                                        <td>{{$timereport->starttask}}</td>
                                        <td>{{$timereport->endtask}}</td>
                                        <td>{{$timereport->duration}}</td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                            <a href="{{ url('/') }}"><button type="button" class="btn btn-outline-secondary">Back to home</button></a>
                        </div>

                    <!-- Time report per nama dan per PT-->
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
