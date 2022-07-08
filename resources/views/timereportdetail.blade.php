 @extends('layouts.app')
@section('title', 'Detail Time Report')

@section('content')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/5.0.0/normalize.min.css">
    <link rel='stylesheet' href='https://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/css/bootstrap.min.css'>
    {{--<link rel='stylesheet'--}}
    <link rel='stylesheet'
          href='https://cdn.datatables.net/plug-ins/f2c75b7247b/integration/bootstrap/3/dataTables.bootstrap.css'>
    <link rel='stylesheet' href='https://cdn.datatables.net/responsive/1.0.4/css/dataTables.responsive.css'>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/meyer-reset/2.0/reset.min.css">
    <link rel='stylesheet'
          href='https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.0.0-alpha.6/css/bootstrap.min.css'>

    <style>
        .paginate_button{
            padding: 0 !important;
        }
        .biodata {
            padding: 5px 0;
        }
        body{
            background-color: #eee !important;
        }
        .btn{
            font-family: 'Roboto';
            font-size: 0.8em;
        }
    </style>
    <div class="container">

        <div class="row justify-content-center">
            <div class="col-md-10">

                <div class="card">
                    <div class="card-header">
                        <h4>Time Report by {{ucwords(strtolower($user->nama))}}</h4>

                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-sm-3">
                                <div style="margin-bottom: 15px;" class="col-xs-12 col-sm-12">
                                    <img style="border-radius: 10px;" width="100px;" src="{{ asset('avatar.jpg') }}">
                                </div>

                            </div>
                            <div class="col-sm-9">


                                <div class="col-xs-6 col-sm-6">

                                    <div class="biodata">Name: {{ucwords(strtolower($user->nama))}}</div>
                                    <div class="biodata">NIP: {{$id}}</div>
                                    <div class="biodata">Institution: {{$user->institusi}}</div>
                                    <div class="biodata">City: {{ucwords(strtolower($user->kota))}}</div>
                                    <div class="biodata">Position: {{ucwords(strtolower($user->positionid))}}</div>


                                </div>
                                <div class="col-xs-6 col-sm-6">
                                    <div class="biodata">Group: {{ucwords(strtolower($user->grup))}}</div>
                                    <div class="biodata">Division: {{$user->divisi}}</div>
                                    <div class="biodata">Incharge: {{$user->inchargestatus}}</div>
                                    <div class="biodata">Status: {{ucwords(strtolower($user->status))}}</div>
                                    <div class="biodata">Grade: {{$user->grade}}</div>


                                </div>
                            </div>

                        </div>
                        <br>

                        <div class="dropdown show">
                            <a class="btn btn-outline-secondary dropdown-toggle" href="#" role="button"
                               id="period" data-toggle="dropdown" aria-haspopup="true"
                               aria-expanded="false">
                                Periode:
                                @if( app('request')->input('period') == '1')
                                    Januari
                                @elseif( app('request')->input('period') == '2')
                                    Februari
                                @elseif( app('request')->input('period') == '3')
                                    Maret
                                @elseif( app('request')->input('period') == '4')
                                    April
                                @elseif( app('request')->input('period') == '5')
                                    Mei
                                @elseif( app('request')->input('period') == '6')
                                    Juni
                                @elseif( app('request')->input('period') == '7')
                                    Juli
                                @elseif( app('request')->input('period') == '8')
                                    Agustus
                                @elseif( app('request')->input('period') == '9')
                                    September
                                @elseif( app('request')->input('period') == '10')
                                    Oktober
                                @elseif( app('request')->input('period') == '11')
                                    November
                                @elseif( app('request')->input('period') == '12')
                                    Desember
                                @else
                                    Bulan ini
                                @endif
                            </a>
                            <div class="dropdown-menu" aria-labelledby="period" style="top: 60px">
                                <a class="dropdown-item" style="border-radius: 0;" href="?period=1">Januari</a>
                                <a class="dropdown-item" style="border-radius: 0;" href="?period=2">Februari</a>
                                <a class="dropdown-item" style="border-radius: 0;" href="?period=3">Maret</a>
                                <a class="dropdown-item" style="border-radius: 0;" href="?period=4">April</a>
                                <a class="dropdown-item" style="border-radius: 0;" href="?period=5">Mei</a>
                                <a class="dropdown-item" style="border-radius: 0;" href="?period=6">Juni</a>
                                <a class="dropdown-item" style="border-radius: 0;" href="?period=7">Juli</a>
                                <a class="dropdown-item" style="border-radius: 0;"
                                   href="?period=8">Agustus</a>
                                <a class="dropdown-item" style="border-radius: 0;" href="?period=9">September</a>
                                <a class="dropdown-item" style="border-radius: 0;" href="?period=10">Oktober</a>
                                <a class="dropdown-item" style="border-radius: 0;"
                                   href="?period=11">November</a>
                                <a class="dropdown-item" style="border-radius: 0;"
                                   href="?period=12">Desember</a>
                            </div>
                        </div>

                        <table style=" display: block; width: 100%; overflow-x: auto;font-size: 12px;"
                               class="table table-responsive-md table-striped display"
                               id="example">
                            <thead>
                            <tr>
                                <th>Date</th>

                                <th>Client</th>
                                {{--<th>NIP</th>--}}
                                {{--<th>Institution</th>--}}
                                {{--<th>City</th>--}}
                                {{--<th>Group</th>--}}
                                {{--<th>Position</th>--}}
                                {{--<th>Client</th>--}}
                                {{--<th>Week</th>--}}
                                {{--<th>Day</th>--}}
                                {{--<th>Month</th>--}}
                                <th>Engagement Period</th>
                                <th>Engagement Type</th>
                                <th>Regular Hour(s)</th>
                                <th>Overtime Hour(s)</th>
                                <th>Ineffective Hour(s)</th>
                                {{--<th>Description</th>--}}
                                <th>Overtime Meal</th>
                                <th>Overtime Transportation</th>
                                <th>Period</th>

                                <th>Description</th>

                                {{--<th>Location</th>--}}
                                {{--<th>Institusi</th>--}}
                                {{--<th>Branch</th>--}}
                                <th>Manual Approval</th>
                                <th>(Edit) Overbudget Hour(s)</th>
                                <th>Approval</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($reportdetails as $reportdetail)
                                <tr>
                                    <td>{{date('d F, Y', strtotime($reportdetail->date))}}</td>

                                    <td>{{ $reportdetail->clientcode }} - {{$reportdetail->clientname}}</td>
                                    {{--                                    <td>{{$reportdetail->nip}}</td>--}}
                                    {{--<td>{{$reportdetail->institusi}}</td>--}}
                                    {{--<td>{{$reportdetail->kota}}</td>--}}
                                    {{--<td>{{$reportdetail->grup}}</td>--}}
                                    {{--<td>{{$reportdetail->positionid}}</td>--}}
                                    {{--<td>{{$reportdetail->clientname}}</td>--}}
                                    {{--<td>--}}
                                    {{--@if($reportdetail->week == 1)--}}
                                    {{--1st Week--}}
                                    {{--@elseif($reportdetail->week == 2)--}}
                                    {{--2nd Week--}}
                                    {{--@elseif($reportdetail->week == 3)--}}
                                    {{--3rd Week--}}
                                    {{--@elseif($reportdetail->week == 4)--}}
                                    {{--4th Week--}}
                                    {{--@elseif($reportdetail->week == 5)--}}
                                    {{--5th Week--}}
                                    {{--@endif--}}
                                    {{--</td>--}}
                                    {{--<td>{{$reportdetail->day}}</td>--}}
                                    {{--<td>{{date('F', strtotime($reportdetail->date))}}</td>--}}
                                    <td>{{$reportdetail->engagementperiod}}</td>
                                    <td>{{$reportdetail->engagementtype}}</td>
                                    <td>{{$reportdetail->normalhours}}</td>
                                    <td>{{$reportdetail->overtimes}}</td>
                                    <td>{{$reportdetail->editineffective}}</td>
                                    {{--                            <td>{{$reportdetail->description}}</td>--}}
                                    <td>{{$reportdetail->overtimemeal}}</td>
                                    <td>{{$reportdetail->overtimetransportation}}</td>
                                    <td>{{$reportdetail->period}}</td>
                                    <td>{{$reportdetail->description}}</td>

                                    {{--<td>{{$reportdetail->location}}</td>--}}
                                    {{--<td>{{$reportdetail->institusi}}</td>--}}
                                    {{--<td>{{$reportdetail->branch}}</td>--}}
                                    <td></td>
                                    <td>
                                        <form method="POST" action="{{ url('/partner/reporting/timereport/detail/'.$reportdetail->nip.'/'.$reportdetail->id) }}" >
                                            @csrf
                                            <input name="editineffective" class="" type="number" step="0.01"  value="{{ $reportdetail->editineffective }}">
                                            <button>Submit</button>
                                        </form>
                                    </td>
                                    <td>
                                        @if(Auth::user()->division == 'PARTNER')
                                            @if($reportdetail->approved_by_partner)
                                                Approved
                                            @else
                                                <a class='btn btn-xs btn-outline-success' onclick="return confirm('Do you want to approve the record?')"
                                                type='submit' data-placement="top"
                                                data-target="#confirmDelete" data-title="Delete User"
                                                data-message='Are you sure you want to delete this user ?' href="{{ url('/timesheets/approval/partner/'.$reportdetail->id) }}">
                                                    <i class="fas fa-trash-alt"></i> Approve
                                                </a>
                                            @endif
                                       @elseif(Auth::user()->division == 'HRD')
                                            @if($reportdetail->approved_by_hr)
                                                Approved
                                            @else
                                                <a class='btn btn-xs btn-outline-success' onclick="return confirm('Do you want to approve the record?')"
                                                type='submit' data-placement="top"
                                                data-target="#confirmDelete" data-title="Delete User"
                                                data-message='Are you sure you want to delete this user ?' href="{{ url('/timesheets/approval/hr/'.$reportdetail->id) }}">
                                                        <i class="fas fa-trash-alt"></i> Approve
                                                </a>
                                            @endif
                                        @else
                                        @if($reportdetail->approved_by_incharge)
                                                Approved
                                            @else
                                                <a class='btn btn-xs btn-outline-success' onclick="return confirm('Do you want to approve the record?')"
                                                type='submit' data-placement="top"
                                                data-target="#confirmDelete" data-title="Delete User"
                                                data-message='Are you sure you want to delete this user ?' href="{{ url('/timesheets/approval/incharge/'.$reportdetail->id) }}">
                                                        <i class="fas fa-trash-alt"></i> Approve
                                                </a>
                                            @endif
                                       @endif

                                    </td>


                                </tr>
                            @endforeach
                            </tbody>
                            <tfoot>
                            <tr>

                                <th nowrap style="background-color: white; position: absolute; width: 125px;">
                                    clientname
                                </th>
                                {{--<th>NIP</th>--}}
                                {{--<th>Institution</th>--}}
                                {{--<th>City</th>--}}
                                {{--<th>Group</th>--}}
                                {{--<th>Position</th>--}}
                                <th></th>
                                <th>engagementperiod</th>
                                <th>engagementtype</th>
                                <th style="opacity: 0;">normalhours</th>
                                <th style="opacity: 0;">overtimes</th>
                                <th style="opacity: 0;">ineffectivehours</th>
                                {{--<th>description</th>--}}
                                <th>overtimemeal</th>
                                <th>overtimetransportation</th>
                                <th>period</th>

                                <th style="opacity: 0;">description</th>
                                {{--<th>location</th>--}}
                                {{--<th>institusi</th>--}}
                                {{--<th>branch</th>--}}
                                <th style="opacity: 0;"></th>
                                <th style="opacity: 0;"></th>


                            </tr>
                            </tfoot>
                        </table>
                        <a href="{{ url('/partner/reporting/timereport/') }}">
                            <button type="button" class="btn btn-primary">
                               Back to Time Report
                            </button>
                        </a>
                        <a class='btn btn-xs btn-success' onclick="return confirm('Do you want to approve the record?')"
                        type='submit' data-placement="top"
                        data-target="#confirmDelete" data-title="Delete User"
                        data-message={{'Are you sure you want to approve this month`s report of'.ucwords(strtolower($user->nama)).' ?'}} href="{{ url('/timesheets/approval/period/'.$month.'/'.$reportdetail->nip) }}">
                                <i class="fas fa-trash-alt"></i> Approve This Month Report
                        </a>

                    </div>


                </div>
                <div class="card">
                    <div class="card-header">
                        <h5>Download {{$user->nama}}'s Time Report</h5>
                    </div>
                    <div class="card-body">
                        <form action="{{ url('/partner/reporting/timereport/download') }}" method="GET" target="_blank">
                            @csrf
                            <div class="form-row">
                                <div class="col">
                                    <label for="week">Week</label>
                                    <select id="week" name="week" class="form-control">
                                        <option disabled selected>
                                            All Week
                                        </option>
                                        <option value="1">Week: 1</option>
                                        <option value="2">Week: 2</option>
                                        <option value="3">Week: 3</option>
                                        <option value="4">Week: 4</option>
                                        <option value="5">Week: 5</option>
                                    </select>
                                </div>
                                <div class="col">
                                    <label for="period">Period</label>
                                    <select id="period" name="period" class="form-control">
                                        <option disabled selected>
                                            All Period
                                        </option>
                                        @foreach($periods as $period)
                                            <option value="{{ (int)date('m', mktime(0, 0, 0, $period->period, 10)) }}">
                                                {{ date('F', mktime(0, 0, 0, $period->period, 10)) }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <input id="nip" name="nip" hidden value="{{$id}}">

                            </div><br>

                            <input class="btn btn-outline-danger" type="reset" value="Reset">
                            <button class="btn btn-success" name="action" value="xls" type="submit">Download Time Report</button>
                            {{-- <button class="btn btn-info" name="action" value="print" type="submit">Print</button> --}}

                        </form>
                    </div>
                </div>
                <div class="card">
                    <div class="card-header">
                        <h5>Bulk Edit {{$user->nama}}'s Overbudget</h5>
                    </div>

                <div class="card-body smaller-font">
                    <form action="{{ route('time-report.bulk-edit.bulkEditOverbudget') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('post')
                        
                        <div class="form-group" style="max-width: 500px; ">
                            <div class="custom-file text-left">
                                <input type="file" name="file" class="custom-file-input" id="customFile" onchange="updateFile()">
                                <label class="custom-file-label" for="customFile">
                                    <div style="font-size: 0.7em" id='timeReportFile'></div>
                                </label>
                            </div>
                        </div>
                        <script>
                            updateFile = function() {
                                var input = document.getElementById('customFile');
                                var output = document.getElementById('timeReportFile');

                                for (var i = 0; i < input.files.length; ++i) {
                                    output.innerHTML = input.files.item(i).name;
                                }
                            }
                        </script>
                        <button class="btn btn-primary">Import</button>
                    </form>
                </div>
              
                </div>


            </div>
        </div>
        <script src="https://static.codepen.io/assets/common/stopExecutionOnTimeout-de7e2ef6bfefd24b79a3f68b414b87b8db5b08439cac3f1012092b2290c719cd.js"></script>
        <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
        <script src="https://cdn.datatables.net/plug-ins/f2c75b7247b/integration/bootstrap/3/dataTables.bootstrap.js"></script>
        <script src="https://cdn.datatables.net/responsive/1.0.4/js/dataTables.responsive.js"></script>
        <script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
        {{--<script src='https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.0.0-alpha.6/js/bootstrap.min.js'></script>--}}
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

            }

            .table > tbody > tr > td:nth-child(2) {
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
                padding: 9px 10px 9px 32px;
                width: 55px;

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
            .navbar-nav{
                float: right;
            }
            input[type=search]{
                padding: 5px 0px 5px 20px !important;
            }
            .form-control:focus{
                transition-duration: 0.2s;
                background-size: 0;
            }
        </style>

        <script>
            $('.toggle-vis').on('click', function (e) {
                e.preventDefault();

                // Get the column API object
                var column = $('#example').DataTable().column($(this).attr('data-column'));

                // Toggle the visibility
                column.visible(!column.visible());
            })
        </script>
        <script>
            $(document).ready(function () {

                $('#example').DataTable({
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
        <style>
            .caret {
                display: none !important;
            }

        </style>
        <script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
        <script type="text/javascript"
                src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
        <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css"/>
@endsection
