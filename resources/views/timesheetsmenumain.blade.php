@extends('layouts.app')

@section('title', 'Time Report Home')

@section('content')
    <script src="https://code.jquery.com/jquery-3.3.1.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/js/bootstrap.min.js"></script>

    <script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.2.3/js/dataTables.responsive.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.2.3/js/responsive.bootstrap4.min.js"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.css">
    <link href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css">
    <link href="https://cdn.datatables.net/responsive/2.2.3/css/responsive.bootstrap4.min.css">
    <style>
        .table-striped tbody tr:nth-of-type(odd) {
        }

        .table thead th {
            vertical-align: middle;
        }
    </style>

    <style>
        .col-sm-6 {
            padding-left: 0;
        !important;
        }
    </style>
    <style>
        .row {
            padding: 10px 0;
        }

        .input-sm {
            margin: 0 10px;
        !important;
        }

        .jumbotron {
            background: #6b7381;
            color: #bdc1c8;
        }

        .jumbotron h1 {
            color: #fff;
        }

        .example {
            margin: 4rem auto;
        }

        .example > .row {
            margin-top: 2rem;
            height: 5rem;
            vertical-align: middle;
            text-align: center;
            border: 1px solid rgba(189, 193, 200, 0.5);
        }

        .example > .row:first-of-type {
            border: none;
            height: auto;
            text-align: left;
        }

        .example h3 {
            font-weight: 400;
        }

        .example h3 > small {
            font-weight: 200;
            font-size: 0.75em;
            color: #939aa5;
        }

        .example h6 {
            font-weight: 700;
            font-size: 0.65rem;
            letter-spacing: 3.32px;
            text-transform: uppercase;
            color: #bdc1c8;
            margin: 0;
            line-height: 5rem;
        }

        .example .btn-toggle {
            top: 50%;
            transform: translateY(-50%);
        }

        .btn-toggle {
            margin: 0 4rem;
            padding: 0;
            position: relative;
            border: none;
            height: 1.5rem;
            width: 3rem;
            border-radius: 1.5rem;
            color: #6b7381;
            background: #bdc1c8;
        }

        .btn-toggle:focus,
        .btn-toggle.focus,
        .btn-toggle:focus.active,
        .btn-toggle.focus.active {
            outline: none;
        }

        .btn-toggle:before,
        .btn-toggle:after {
            line-height: 1.5rem;
            width: 4rem;
            text-align: center;
            font-weight: 600;
            font-size: 0.75rem;
            text-transform: uppercase;
            letter-spacing: 2px;
            position: absolute;
            bottom: 0;
            transition: opacity 0.25s;
        }

        .btn-toggle:before {
            content: 'Off';
            left: -4rem;
        }

        .btn-toggle:after {
            content: 'On';
            right: -4rem;
            opacity: 0.5;
        }

        .btn-toggle > .handle {
            position: absolute;
            top: 0.1875rem;
            left: 0.1875rem;
            width: 1.125rem;
            height: 1.125rem;
            border-radius: 1.125rem;
            background: #fff;
            transition: left 0.25s;
        }

        .btn-toggle.active {
            transition: background-color 0.25s;
        }

        .btn-toggle.active > .handle {
            left: 1.6875rem;
            transition: left 0.25s;
        }

        .btn-toggle.active:before {
            opacity: 0.5;
        }

        .btn-toggle.active:after {
            opacity: 1;
        }

        .btn-toggle.btn-sm:before,
        .btn-toggle.btn-sm:after {
            line-height: -0.5rem;
            color: #fff;
            letter-spacing: 0.75px;
            left: 0.4125rem;
            width: 2.325rem;
        }

        .btn-toggle.btn-sm:before {
            text-align: right;
        }

        .btn-toggle.btn-sm:after {
            text-align: left;
            opacity: 0;
        }

        .btn-toggle.btn-sm.active:before {
            opacity: 0;
        }

        .btn-toggle.btn-sm.active:after {
            opacity: 1;
        }

        .btn-toggle.btn-xs:before,
        .btn-toggle.btn-xs:after {
            display: none;
        }

        .btn-toggle:before,
        .btn-toggle:after {
            color: #6b7381;
        }

        .btn-toggle.active {
            background-color: #29b5a8;
        }

        .btn-toggle.btn-lg {
            margin: 0 5rem;
            padding: 0;
            position: relative;
            border: none;
            height: 2.5rem;
            width: 5rem;
            border-radius: 2.5rem;
        }

        .btn-toggle.btn-lg:focus,
        .btn-toggle.btn-lg.focus,
        .btn-toggle.btn-lg:focus.active,
        .btn-toggle.btn-lg.focus.active {
            outline: none;
        }

        .btn-toggle.btn-lg:before,
        .btn-toggle.btn-lg:after {
            line-height: 2.5rem;
            width: 5rem;
            text-align: center;
            font-weight: 600;
            font-size: 1rem;
            text-transform: uppercase;
            letter-spacing: 2px;
            position: absolute;
            bottom: 0;
            transition: opacity 0.25s;
        }

        .btn-toggle.btn-lg:before {
            content: 'Off';
            left: -5rem;
        }

        .btn-toggle.btn-lg:after {
            content: 'On';
            right: -5rem;
            opacity: 0.5;
        }

        .btn-toggle.btn-lg > .handle {
            position: absolute;
            top: 0.3125rem;
            left: 0.3125rem;
            width: 1.875rem;
            height: 1.875rem;
            border-radius: 1.875rem;
            background: #fff;
            transition: left 0.25s;
        }

        .btn-toggle.btn-lg.active {
            transition: background-color 0.25s;
        }

        .btn-toggle.btn-lg.active > .handle {
            left: 2.8125rem;
            transition: left 0.25s;
        }

        .btn-toggle.btn-lg.active:before {
            opacity: 0.5;
        }

        .btn-toggle.btn-lg.active:after {
            opacity: 1;
        }

        .btn-toggle.btn-lg.btn-sm:before,
        .btn-toggle.btn-lg.btn-sm:after {
            line-height: 0.5rem;
            color: #fff;
            letter-spacing: 0.75px;
            left: 0.6875rem;
            width: 3.875rem;
        }

        .btn-toggle.btn-lg.btn-sm:before {
            text-align: right;
        }

        .btn-toggle.btn-lg.btn-sm:after {
            text-align: left;
            opacity: 0;
        }

        .btn-toggle.btn-lg.btn-sm.active:before {
            opacity: 0;
        }

        .btn-toggle.btn-lg.btn-sm.active:after {
            opacity: 1;
        }

        .btn-toggle.btn-lg.btn-xs:before,
        .btn-toggle.btn-lg.btn-xs:after {
            display: none;
        }

        .btn-toggle.btn-sm {
            margin: 0 0.5rem;
            padding: 0;
            position: relative;
            border: none;
            height: 1.2rem;
            width: 2.4rem;
            border-radius: 1.5rem;
        }

        .btn-toggle.btn-sm:focus,
        .btn-toggle.btn-sm.focus,
        .btn-toggle.btn-sm:focus.active,
        .btn-toggle.btn-sm.focus.active {
            outline: none;
        }

        .btn-toggle.btn-sm:before,
        .btn-toggle.btn-sm:after {
            line-height: 1.3rem;
            width: 0.5rem;
            text-align: center;
            font-weight: 600;
            font-size: 0.55rem;
            text-transform: uppercase;
            letter-spacing: 2px;
            position: absolute;
            bottom: 0;
            transition: opacity 0.25s;
        }

        .btn-toggle.btn-sm:before {
            content: '';
            left: -0.5rem;
        }

        .btn-toggle.btn-sm:after {
            content: '';
            right: -0.5rem;
            opacity: 0.5;
        }

        .btn-toggle.btn-sm > .handle {
            position: absolute;
            top: 0.1875rem;
            left: 0.1875rem;
            width: 0.8rem;
            height: 0.8rem;
            border-radius: 1.125rem;
            background: #fff;
            transition: left 0.25s;
        }

        .btn-toggle.btn-sm.active {
            transition: background-color 0.25s;
        }

        .btn-toggle.btn-sm.active > .handle {
            left: 1.3875rem;
            transition: left 0.25s;
        }

        .btn-toggle.btn-sm.active:before {
            opacity: 0.5;
        }

        .btn-toggle.btn-sm.active:after {
            opacity: 1;
        }

        .btn-toggle.btn-sm.btn-sm:before,
        .btn-toggle.btn-sm.btn-sm:after {
            line-height: -0.5rem;
            color: #fff;
            letter-spacing: 0.75px;
            left: 0.4125rem;
            width: 2.325rem;
        }

        .btn-toggle.btn-sm.btn-sm:before {
            text-align: right;
        }

        .btn-toggle.btn-sm.btn-sm:after {
            text-align: left;
            opacity: 0;
        }

        .btn-toggle.btn-sm.btn-sm.active:before {
            opacity: 0;
        }

        .btn-toggle.btn-sm.btn-sm.active:after {
            opacity: 1;
        }

        .btn-toggle.btn-sm.btn-xs:before,
        .btn-toggle.btn-sm.btn-xs:after {
            display: none;
        }

        .btn-toggle.btn-xs {
            margin: 0 0;
            padding: 0;
            position: relative;
            border: none;
            height: 1rem;
            width: 2rem;
            border-radius: 1rem;
        }

        .btn-toggle.btn-xs:focus,
        .btn-toggle.btn-xs.focus,
        .btn-toggle.btn-xs:focus.active,
        .btn-toggle.btn-xs.focus.active {
            outline: none;
        }

        .btn-toggle.btn-xs:before,
        .btn-toggle.btn-xs:after {
            line-height: 1rem;
            width: 0;
            text-align: center;
            font-weight: 600;
            font-size: 0.75rem;
            text-transform: uppercase;
            letter-spacing: 2px;
            position: absolute;
            bottom: 0;
            transition: opacity 0.25s;
        }

        .btn-toggle.btn-xs:before {
            content: 'Off';
            left: 0;
        }

        .btn-toggle.btn-xs:after {
            content: 'On';
            right: 0;
            opacity: 0.5;
        }

        .btn-toggle.btn-xs > .handle {
            position: absolute;
            top: 0.125rem;
            left: 0.125rem;
            width: 0.75rem;
            height: 0.75rem;
            border-radius: 0.75rem;
            background: #fff;
            transition: left 0.25s;
        }

        .btn-toggle.btn-xs.active {
            transition: background-color 0.25s;
        }

        .btn-toggle.btn-xs.active > .handle {
            left: 1.125rem;
            transition: left 0.25s;
        }

        .btn-toggle.btn-xs.active:before {
            opacity: 0.5;
        }

        .btn-toggle.btn-xs.active:after {
            opacity: 1;
        }

        .btn-toggle.btn-xs.btn-sm:before,
        .btn-toggle.btn-xs.btn-sm:after {
            line-height: -1rem;
            color: #fff;
            letter-spacing: 0.75px;
            left: 0.275rem;
            width: 1.55rem;
        }

        .btn-toggle.btn-xs.btn-sm:before {
            text-align: right;
        }

        .btn-toggle.btn-xs.btn-sm:after {
            text-align: left;
            opacity: 0;
        }

        .btn-toggle.btn-xs.btn-sm.active:before {
            opacity: 0;
        }

        .btn-toggle.btn-xs.btn-sm.active:after {
            opacity: 1;
        }

        .btn-toggle.btn-xs.btn-xs:before,
        .btn-toggle.btn-xs.btn-xs:after {
            display: none;
        }

        .btn-toggle.btn-secondary {
            color: #6b7381;
            background: #bdc1c8;
        }

        .btn-toggle.btn-secondary:before,
        .btn-toggle.btn-secondary:after {
            color: #6b7381;
        }

        .btn-toggle.btn-secondary.active {
            background-color: #ff8300;
        }

        .table > thead:first-child > tr:first-child > th:first-child {
            /*position: absolute;*/
            /*display: inline-block;*/
            /*width: auto;*/
            /*height: calc(1em + 8px);*/
            /*padding-top: 0;*/
            /*border-bottom: 2px solid #ddd;*/
            /*background-color: white;*/
            /*z-index: 10;*/
        }

        .table > tbody > tr > td:first-child {
            /*position: absolute;*/
            /*background-color: rgb(236, 238, 238);*/
            /*width: auto;*/
            /*height: calc(1em + 8px);*/
        }

        .filterlist {
            font-size: 0.8em;
        }

        .btn-toggle.btn-sm {
            margin: 5px 0;
        }

        .accordion .card-header {
            padding: 0;
            font-size: 0.6em !important;
            border-left: 0.6px solid #eceeee;
            -webkit-border-radius: 0;
            -moz-border-radius: 0;
            border-radius: 0;
        }

        .filterlink {
            display: inline-block;
            font-weight: 400;
            color: #212529;
            text-align: center;
            vertical-align: middle;
            -webkit-user-select: none;
            -moz-user-select: none;
            -ms-user-select: none;
            user-select: none;
            background-color: transparent;
            border-left: 0.6px solid #eceeee;
            padding: 0.375rem 0.75rem;
            font-size: 0.9rem;
            line-height: 1.5;
            -webkit-transition: color 0.15s ease-in-out, background-color 0.15s ease-in-out, border-color 0.15s ease-in-out, -webkit-box-shadow 0.15s ease-in-out;
            transition: color 0.15s ease-in-out, background-color 0.15s ease-in-out, border-color 0.15s ease-in-out, -webkit-box-shadow 0.15s ease-in-out;
            transition: color 0.15s ease-in-out, background-color 0.15s ease-in-out, border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out;
            transition: color 0.15s ease-in-out, background-color 0.15s ease-in-out, border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out, -webkit-box-shadow 0.15s ease-in-out;

        }
    </style>
    <div class="container">
        <div class="row justify-content-center">


            <script src="https://static.codepen.io/assets/common/stopExecutionOnTimeout-de7e2ef6bfefd24b79a3f68b414b87b8db5b08439cac3f1012092b2290c719cd.js"></script>
            <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
            <script src="https://cdn.datatables.net/plug-ins/f2c75b7247b/integration/bootstrap/3/dataTables.bootstrap.js"></script>
            <script src="https://cdn.datatables.net/responsive/1.0.4/js/dataTables.responsive.js"></script>
            <script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
            <div class="col-md-12">
                <div class="col-md-auto">

                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                </div>
                <div class="card">
                    <div class="card-header card-header-info card-header-icon">
                        <div class="card-icon">
                            <i style="font-size: 1.5em;" class="fas fa-info"></i>
                        </div>
                        <h3 class="card-title">Main</h3>
                    </div>
                    <div class="card-header" style="background-color: rgba(178,174,179,0.14); color: white;">
                        <a style="float:left;" href="{{ url('/timesheets/main') }}"><i class="fas fa-arrow-circle-left"></i> Main</a>
                        <a style="float:right;" href="{{ url('/timesheets/detail') }}">Detail <i class="fas fa-arrow-circle-right"></i></a>
                    </div>

                    @if (session('successalert'))
                        <div class="alert alert-success">
                            {{ session('successalert') }}
                        </div>
                    @endif

                    <div class="card-body">
                        <p style="color: darkgrey;">
                            <i>
                                The table columns are responsive, in order to tidy the table, the column will fit the size of the data.
                                Click the name to view the detail of each row.
                            </i>
                        </p>
                        <table style=" display: inline-table; width: 100%; overflow-x: auto; font-size: 14px;"
                               class="table responsive table-responsive-md table-striped display"
                               id="example">
                            <thead>
                            <tr>
                                {{--<th><i class="fas fa-search"></i> Date</th>--}}
                                @if($inchargestatus == 1)
                                    <th>Name</th>
                                @else
                                @endif
                                {{-- <th>Week</th> --}}
                                <th>Date</th>

                                <th>Regular <br>Hour(s)</th>
                                @if($masteremployees->lembur == 'Y')
                                <th>Overtime <br>Hour(s)</th>
                                @endif
                                <th>Ineffective <br>Hour(s)</th>
                                <th>Net</th>
                                {{-- <th>Overtime <br>Meal</th>
                                <th>Overtime <br>Transportation</th> --}}
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($timereports as $timereport)
                                <tr>
{{--                                    <td>{{date('d F, Y', strtotime($timereport->date))}}</td>--}}
                                    @if($inchargestatus == 1)
                                        <td>{{ucwords(strtolower($timereport->nama))}}</td>
                                    @else
                                    @endif

                                    {{-- <td>
                                        Week {{$timereport->week}}
                                    </td> --}}
                                    <td><a href="{{ route('timesheetsdetail', ['date' => date('Y-m-d', strtotime($timereport->date))]) }}">{{ date('d F', strtotime($timereport->date)) }}</a></td>

                                    <td>{{$timereport->normalhours}}</td>
                                    @if($masteremployees->lembur == 'Y')
                                    <td>{{$timereport->overtimes}}</td>
                                    @endif
                                    <td>{{$timereport->ineffective}}</td>
                                    <td>{{$timereport->normalhours + $timereport->overtimes - $timereport->ineffective}}</td>
                                    {{-- <td>{{number_format($timereport->overtimemeal,2,",",".")}}</td>
                                    <td>{{number_format($timereport->overtimetransportation,2,",",".")}}</td> --}}
                                </tr>
                            @endforeach
                            </tbody>
                            <tfoot>
                            <tr>
                                @if($inchargestatus == 1)
                                    <th>Name</th>
                                @else
                                @endif
                                <th>date</th>
                                <th>normalhours</th>
                                @if($masteremployees->lembur == 'Y')
                                <th>overtimes</th>
                                @endif
                                <th>ineffective</th>
                                <th>net</th>
                            </tr>
                            </tfoot>
                            <div class="card-body">
                       
                    </div>
                        </table>
                        <div>
                            @include('layouts.buttons.home')
                            <a href="{{ url('/input/timereport') }}" class="btn btn-info">
                                <i class="fas fa-file-upload"></i> Input Time Report
                            </a>
                            {{--<a href="" class="disabled btn btn-primary-info" data-toggle="modal" data-target="#exampleModalCenter3">--}}
                                {{--<i class="fas fa-file-csv"></i> Mass Time Report--}}
                            {{--</a>--}}
                            <div class="modal fade" id="exampleModalCenter3" tabindex="-1" role="dialog"
                                 aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered" role="document">
                                    <div class="modal-content">
                                        <div class="card">
                                            <div class="card-body">
                                                <h5 class="card-title">
                                                    Hi, {{ucwords(strtolower(Auth::user()->name))}}</h5>
                                                <h6 class="card-subtitle mb-2 text-muted">
                                                </h6>
                                                <p class="card-text"><i style="color: orangered;"
                                                                        class="fas fa-exclamation-triangle"></i>
                                                    Untuk menghindari terjadinya <i>error</i>
                                                    saat <i>upload</i>, mohon
                                                    kolom kosong yang terdapat dalam <i>table</i> di<span
                                                            style="color: rgba(5,2,2,0.85);">
                                                        <i class="fas fa-eraser"></i><b>clear</b></span>
                                                    terlebih dahulu.</p>
                                                <a style="font-size: 0.9em;" href="https://my.namast3.com/laravel/public/myreport.xlsx"
                                                   class="card-link"><i
                                                            class="fas fa-file-download"></i> Download
                                                    Template</a>
                                                <a style="font-size: 0.9em;" href=""
                                                   class="card-link"><i
                                                            class="fas fa-file-download"></i> Download
                                                    List Kode Klien</a>
                                                <div style="border-bottom: 2px solid #e0e0e0;"></div>
                                                <form method="POST" action="{{ route('importtimereport') }}" enctype="multipart/form-data">
                                                    {{ csrf_field() }}

                                                    <div class="form-group">
                                                        <label for="file">Upload Template</label>
                                                        <input type="file" class="form-control-file" name="file"
                                                               id="file"
                                                               placeholder="">
                                                    </div>
                                                    <button type="submit" class="btn btn-success"><i
                                                                class="fas fa-cloud-upload-alt"></i> Submit
                                                    </button>
                                                </form>
                                            </div>
                                        </div>
                                        {{--<div class="modal-footer">--}}
                                        {{--<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>--}}
                                        {{--<button type="button" class="btn btn-primary">Save changes</button>--}}
                                        {{--</div>--}}
                                    </div>
                                </div>
                            </div>
                            <div class="modal fade" id="exampleModalCenter3" tabindex="-1" role="dialog"
                                 aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered" role="document">
                                    <div class="modal-content">
                                        <div class="card">
                                            <div class="card-body">
                                                <h5 class="card-title">
                                                    Hi, {{ucwords(strtolower(Auth::user()->name))}}</h5>
                                                <h6 class="card-subtitle mb-2 text-muted">
                                                </h6>
                                                <p class="card-text"><i style="color: orangered;"
                                                                        class="fas fa-exclamation-triangle"></i>
                                                    Untuk menghindari terjadinya <i>error</i>
                                                    saat <i>upload</i>, mohon
                                                    kolom kosong yang terdapat dalam <i>table</i> di<span
                                                            style="color: rgba(5,2,2,0.85);">
                                                        <i class="fas fa-eraser"></i><b>clear</b></span>
                                                    terlebih dahulu.</p>
                                                <a style="font-size: 0.9em;" href="https://my.namast3.com/laravel/public/myreport.xlsx"
                                                   class="card-link"><i
                                                            class="fas fa-file-download"></i> Download
                                                    Template</a>
                                                <a style="font-size: 0.9em;" href=""
                                                   class="card-link"><i
                                                            class="fas fa-file-download"></i> Download
                                                    List Kode Klien</a>
                                                <div style="border-bottom: 2px solid #e0e0e0;"></div>
                                                <form method="POST" action="{{ route('importtimereport') }}" enctype="multipart/form-data">
                                                    {{ csrf_field() }}

                                                    <div class="form-group">
                                                        <label for="file">Upload Template</label>
                                                        <input type="file" class="form-control-file" name="file"
                                                               id="file"
                                                               placeholder="">
                                                    </div>
                                                    <button type="submit" class="btn btn-success"><i
                                                                class="fas fa-cloud-upload-alt"></i> Submit
                                                    </button>
                                                </form>
                                            </div>
                                        </div>
                                        {{--<div class="modal-footer">--}}
                                        {{--<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>--}}
                                        {{--<button type="button" class="btn btn-primary">Save changes</button>--}}
                                        {{--</div>--}}
                                    </div>
                                </div>
                            </div>

                        </div>

                    </div>

                </div>
               
                         
            <div class="row">
                  <div class="col-auto">
                    <div class="card">
                    <div class="card-header ">
                        <h3 class="card-title">Export Time Report</h3>
                    </div>

                    <div class="card-body">
                        <form action="{{ url('/timesheets/download') }}" method="GET">
                            @csrf
                            <div class="form-row">
                                <div class="col">
                                    <label for="month">Month</label>
                                    <select id="month" name="month" class="form-control">
                                        <option selected disabled>
                                            Select Period
                                        </option>
                                        <option value="01">January</option>
                                        <option value="02">February</option>
                                        <option value="03">March</option>
                                        <option value="04">April</option>
                                        <option value="05">May</option>
                                        <option value="06">June</option>
                                        <option value="07">July</option>
                                        <option value="08">August</option>
                                        <option value="09">September</option>
                                        <option value="10">October</option>
                                        <option value="11">November</option>
                                        <option value="12">December</option>
                                    </select>
                                </div>
                                {{-- <div class="col">
                                    <label for="week">Week</label>
                                    <select id="week" name="week" class="form-control">
                                        <option value="1">Week 1</option>
                                        <option value="2">Week 2</option>
                                        <option value="3">Week 3</option>
                                        <option value="4">Week 4</option>
                                        <option value="5">Week 5</option>

                                    </select>
                                </div> --}}
                                @if($inchargestatus ==1)
                                    <div class="col">
                                        <label for="employee">Employee</label>
                                        <select id="employee" name="employee" class="form-control">
                                            <option selected disabled>
                                                Select Person 
                                            </option>
                                            @foreach($downloadtimereports as $downloadtimereport)
                                                <option value="{{$downloadtimereport->nip}}">
                                                    {{ ucwords(strtolower($downloadtimereport -> nama))  }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                @else
                                @endif
                            </div>
                            <br>
                            <button class="btn" name="action" value="xls" type="submit"><i class="fas fa-file-download"></i> Download</button>
                            <button class="btn" name="action" value="print" type="submit"><i class="fas fa-print"></i> Print</button>
                        </form>
                    </div>
                    
                </div>
              </div>
            </div>
            </div>

            <script>
                var msg = '{{Session::get('alert')}}';
                var exist = '{{Session::has('alert')}}';
                if (exist) {
                    alert(msg);
                }
            </script>
        </div>

    </div>
    <script type="text/javascript">

    </script>
    <script>
        $(document).ready(function () {

            $('#example').DataTable({
                "aaSorting": [],
                responsive: {
                    details: {
                        display: $.fn.dataTable.Responsive.display.modal( {
                            header: function ( row ) {
                                var data = row.data();
                                return 'Details for '+data[1]+' on '+data[0];
                            }
                        } ),
                        renderer: $.fn.dataTable.Responsive.renderer.tableAll( {
                            tableClass: 'table'
                        } )
                    }
                },
                oLanguage: {
                    oPaginate: {
                        sNext: '<span class="pagination-default"></span><span class="pagination-fa"><i class="fa fa-chevron-right" ></i></span>',
                        sPrevious: '<span class="pagination-default"></span><span class="pagination-fa"><i class="fa fa-chevron-left" ></i></span>'
                    }
                },
                initComplete: function () {
                    this.api().columns().every(function () {
                        var column = this;
                        var select = $('<select><option value=""></option></select>')
                            .appendTo($(column.footer()).empty())
                            .on('change', function () {
                                var val = $.fn.dataTable.util.escapeRegex(
                                    $(this).val()
                                );

                                column
                                    .search(val ? '^' + val + '$' : '', true, false)
                                    .draw();
                            });

                        column.data().unique().sort().each(function (d, j) {
                            select.append('<option value="' + d + '">' + d + '</option>')
                        });
                    });
                }

            });
            // var table = $('#example').DataTable( {
            //     "scrollY": "200px",
            // } );


        });
    </script>
    <script src="https://code.jquery.com/jquery-3.3.1.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js|https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/js/bootstrap.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.2.3/js/dataTables.responsive.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.2.3/js/responsive.bootstrap4.min.js"></script>
    <style>
        table.dataTable thead .sorting:after, table.dataTable thead .sorting_asc:after, table.dataTable thead .sorting_desc:after {
            bottom: 8px !important;
            top: auto !important;
        }

        table {
            transition: .3s cubic-bezier(.25, .8, .5, 1);
            user-select: none;
            white-space: nowrap;
        }

        .paginate_button, .ellipsis {
            font-size: 0.8em;
            position: relative;
            padding: .3rem .75rem;
            margin-left: -1px;
            line-height: 1.25;
            color: #3490dc;
            background-color: #fff;
            border: 1px solid #dee2e6;
        }

        .paginate_button:hover, .ellipsis:hover {
            background-color: #eceeec;
            cursor: pointer;
            color: #3490dc;
        }

        #example_previous {
            border-radius: 5px 0 0 5px;
        }

        #example_next {
            border-radius: 0 5px 5px 0;
        }

        div.dataTables_info {
            font-size: 0.8em;
            display: flex;
            justify-content: start;
            margin-bottom: 0;
        }

        .dataTables_filter {
            font-size: 0.8em;
        }

        @media screen and (max-width: 767px) {
            div.dataTables_info {
                justify-content: center;
                margin-bottom: 20px;
            }
        }

        div.dataTables_paginate {

        }

        .table > thead:first-child > tr:first-child > th:nth-child(2) {
            /*padding-left: 50px;*/
        }

        .table > tbody > tr > td:nth-child(2) {
            /*padding-left: 50px !important;*/
        }

        input {
            outline: none;
        }

        input[type=search] {
            -webkit-appearance: textfield;
            -webkit-box-sizing: content-box;
            font-family: inherit;
            font-size: 100%;
        }

        input::-webkit-search-decoration,
        input::-webkit-search-cancel-button {
            display: none;
        }

        input[type=search] {
            font-size: 1em;
            background: #ededed url(http://rurusteve.com/search-solid.svg) no-repeat 9px center;
            background-size: 1em;

            border: solid 1px #ccc;
            padding: 2px 0px 2px 32px;
            width: 70px;
            margin: 0 10px;

            -webkit-border-radius: 10em;
            -moz-border-radius: 10em;
            border-radius: 10em;

            -webkit-transition: all .2s;
            -moz-transition: all .2s;
            transition: all .2s;
        }

        input[type=search]:focus {
            width: 130px;
            background-color: #fff;
            border-color: #fec834;

            -webkit-box-shadow: 0 0 5px rgba(254, 200, 52, 0.5);
            -moz-box-shadow: 0 0 5px rgba(254, 200, 52, 0.5);
            box-shadow: 0 0 5px rgba(254, 200, 52, 0.5);
        }

        input:-moz-placeholder {
            color: #999;
        }

        input::-webkit-input-placeholder {
            color: #999;
        }

        .dataTables_length {
            font-size: 0.8em;
        }

        .collapse {
            visibility: unset;
        }

        .btn.active.focus, .btn.active:focus, .btn.focus, .btn:active.focus, .btn:active:focus, .btn:focus {
            outline: none;
        }

        .btn-link:focus, .btn-link:hover {
            text-decoration: none;
            background-color: transparent;
        }

        .btn-link:hover {
            color: #5dbf41;
        }

        .caret {
            display: none;
        }
        #example_length label{
            display: flex;
            align-items: center;
        }
        #example_length label select{
            max-width: 80px;
        }
        #example_filter{
            float: right;

        }
        #example_filter label{
            display: flex;
            align-items: center;
        }
        /*.table > tbody > tr > td:first-child:hover{*/
            /*background-color: #77cd44;*/
            /*color: white;*/
            /*transition: 0.3s;*/
            /*cursor: pointer;*/
        /*}*/
        /*.table > tbody > tr > td:first-child{*/
            /*color: blue;*/
        /*}*/
        .paginate_button, .ellipsis {
            font-size: 0.8em;
            position: relative;
            padding: 0;
            margin-left: -1px;
            background-color: transparent;
            border: 0;
        }

        i{
            min-width: 0;
        }
        #example_paginate{
            display: flex;
            justify-content: flex-end;
        }
        #example_length .custom-select {
            margin: 0 10px;
        }
        @media screen and (max-width: 767px) {
            #example_filter{
                margin-top: 10px;
                float: left;

            }
            #example_paginate{
                display: flex;
                justify-content: center;
            }

        }
    </style>

@endsection
