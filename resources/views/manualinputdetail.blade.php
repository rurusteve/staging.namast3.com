@extends('layouts.app')
@section('title', 'Input Manual')

@section('content')
    <style>
        .table-striped tbody tr:nth-of-type(odd) {
            background-color: rgba(0, 188, 212, 0.12);
        }

        .table-striped tbody tr:nth-of-type(even) {
            background-color: rgba(0, 188, 212, 0.07);
        }
    </style>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-auto">

                @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                @endif

            </div>
        </div>

        <div class="container">
            <div class="row justify-content-center">

                <div style="margin-bottom: 20px;" class="col-md-6">
                    <div class="card">
                        <div class="card-header card-header-primary card-header-icon">
                            <div class="card-icon">
                                <i style="font-size: 1.5em;" class="fas fa-file-download"></i>
                            </div>
                            <h3 class="card-title">Detailed Leave Status of <span style="color: dodgerblue">{{ucwords(strtolower($employees->nama))}}</span></h3>
                        </div>
                        <div class="card-body">
                            <table class="table table-hover">
                                <thead>
                                <tr>
                                    <th>Status</th>
                                    <th>Jumlah</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr>
                                    <td>National leave</td>
                                    <td></td>
                                </tr>
                                <tr>
                                <tr>
                                    <td>Leave quota</td>
                                    <td>{{ $modifyleave }}</td>
                                </tr>
                                <tr>
                                <td>Approved</td>
                                <td>{{ $approvedrequest }}</td>
                                </tr>
                                <tr>
                                    <td>Remaining quota</td>
                                    <td>{{ $availableleave }}</td>
                                </tr>

                                </tbody>
                            </table>
                            <a href="{{ url('/manualinput') }}">
                                <button type="button" class="btn btn-outline-primary">Back</button>
                            </a>
                            {{--<div class="alert alert-danger" role="alert">--}}
                            {{--Dear {{ Auth::user()->name }}, sisa cuti anda tersisa  {{ $availableleavethree }}--}}
                            {{--</div>--}}
                            <br>

                        </div>
                    </div><br>

                </div>
            </div>
        </div>

    </div>
@endsection