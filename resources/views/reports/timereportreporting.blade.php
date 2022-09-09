@extends('layouts.reports')
@section('contentfilter')
    {{--<li class="nav-item">--}}
        {{--<a class="nav-link" data-toggle="collapse"--}}
           {{--data-target="#collapseTwo" aria-expanded="true"--}}
           {{--aria-controls="collapseTwo">--}}
            {{--<p><i class="fa fa-calendar"></i> Filter Date</p>--}}
        {{--</a>--}}
        {{--<div id="collapseTwo" class="collapse show" aria-labelledby="headingTwo"--}}
             {{--data-parent="#accordionExampleTwo">--}}
            {{--<div class="card-body">--}}
                {{--<div class="filterlist">--}}
                    {{--<a class="">--}}
                        {{--<form style="margin-bottom: 10px;" class="form-row" method="GET"--}}
                              {{--action="{{ url('/partner/reporting/timereport') }}">--}}
                            {{--<label style="margin-bottom: 0"> By Week & Month</label>--}}
                            {{--<div class="form-row align-items-center">--}}
                                {{--<div class="col-auto">--}}
                                    {{--<label for="week" class="sr-only"></label>--}}
                                    {{--<select name="week" id="week" class="form-control">--}}
                                        {{--<option disabled selected>Week:--}}
                                            {{--@if(\request('week') === null)--}}
                                                {{--All Week--}}
                                            {{--@else {{ \request('week') }}--}}
                                            {{--@endif</option>--}}
                                        {{--<option value="1">1st Week</option>--}}
                                        {{--<option value="2">2nd Week</option>--}}
                                        {{--<option value="3">3rd Week</option>--}}
                                        {{--<option value="4">4th Week</option>--}}
                                        {{--<option value="5">5th Week</option>--}}
                                    {{--</select>--}}
                                {{--</div>--}}
                                {{--<div class="col-auto">--}}
                                    {{--<label for="month" class="sr-only"></label>--}}
                                    {{--<select name="month" id="month" class="form-control">--}}
                                        {{--<option disabled selected>Month:--}}
                                            {{--@if(\request('month') === null)--}}
                                                {{--Entire Year--}}
                                            {{--@else--}}
                                                {{--{{ date('F', \request('month')) }}--}}
                                            {{--@endif</option>--}}
                                        {{--<option value="1">January</option>--}}
                                        {{--<option value="2">February</option>--}}
                                        {{--<option value="3">March</option>--}}
                                        {{--<option value="4">April</option>--}}
                                        {{--<option value="5">May</option>--}}
                                        {{--<option value="6">June</option>--}}
                                        {{--<option value="7">July</option>--}}
                                        {{--<option value="8">August</option>--}}
                                        {{--<option value="9">September</option>--}}
                                        {{--<option value="10">October</option>--}}
                                        {{--<option value="11">November</option>--}}
                                        {{--<option value="12">December</option>--}}
                                    {{--</select>--}}
                                {{--</div>--}}

                                {{--<div class="col-auto">--}}
                                    {{--<button style="font-size: 0.8rem;" type="submit" class="btn btn-success"> Search--}}
                                    {{--</button>--}}
                                {{--</div>--}}
                            {{--</div>--}}
                        {{--</form>--}}
                    {{--</a>--}}
                    {{--<a class="">--}}
                        {{--<form style="margin-bottom: 10px;" class="form-row" method="GET"--}}
                              {{--action="{{ url('/partner/reporting/timereport') }}">--}}
                            {{--<label style="margin-bottom: 0"> By Date Range</label>--}}
                            {{--<div class="form-row align-items-center">--}}
                                {{--<div class="col-auto">--}}
                                    {{--<div id="reportrange"--}}
                                         {{--style="background: #fff; cursor: pointer; padding: 5px 10px; border: 1px solid #ccc; width: 100%">--}}
                                        {{--<span></span>--}}
                                    {{--</div>--}}
                                {{--</div>--}}
                                {{--<div class="col-auto">--}}
                                    {{--<input hidden type="text" id="startdate" name="startdate" value="">--}}
                                    {{--<input hidden type="text" id="enddate" name="enddate" value="">--}}
                                    {{--<button style="font-size: 0.8rem;" type="submit" class="btn btn-primary"> Search--}}
                                    {{--</button>--}}
                                {{--</div>--}}

                                {{--<script type="text/javascript" src="https://cdn.jsdelivr.net/jquery/latest/jquery.min.js"></script>--}}
                                {{--<script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>--}}
                                {{--<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>--}}
                                {{--<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />--}}

                            {{--</div>--}}
                        {{--</form>--}}
                    {{--</a>--}}
                {{--</div>--}}
            {{--</div>--}}
        {{--</div>--}}
    {{--</li>--}}
    {{--<li class="nav-item">--}}
        {{--<a class="nav-link"--}}
           {{--data-toggle="collapse"--}}
           {{--data-target="#collapseOne" aria-expanded="true"--}}
           {{--aria-controls="collapseOne">--}}
            {{--<p><i class="fas fa-caret-down"></i> Attributes </p>--}}
        {{--</a>--}}
        {{--<div id="collapseOne" class="collapse" aria-labelledby="headingOne"--}}
             {{--data-parent="#accordionExample">--}}
            {{--<div class="card-body">--}}
                {{--<div class="filterlist">--}}
                    {{--<button data-column="1" type="button"--}}
                            {{--class="btn btn-sm btn-toggle toggle-vis"--}}
                            {{--data-toggle="button" aria-pressed="false" autocomplete="off">--}}
                        {{--<div class="handle"></div>--}}
                    {{--</button>--}}
                    {{--Regular Hour(s)<br>--}}
                    {{--<button data-column="2" type="button"--}}
                            {{--class="btn btn-sm btn-toggle toggle-vis"--}}
                            {{--data-toggle="button" aria-pressed="false" autocomplete="off">--}}
                        {{--<div class="handle"></div>--}}
                    {{--</button>--}}
                    {{--Overtime Hour(s)<br>--}}
                    {{--<button data-column="3" type="button"--}}
                            {{--class="btn btn-sm btn-toggle toggle-vis"--}}
                            {{--data-toggle="button" aria-pressed="false" autocomplete="off">--}}
                        {{--<div class="handle"></div>--}}
                    {{--</button>--}}
                    {{--Overbudget Hour(s)<br>--}}
                    {{--<button data-column="4" type="button"--}}
                            {{--class="btn btn-sm btn-toggle toggle-vis"--}}
                            {{--data-toggle="button" aria-pressed="false" autocomplete="off">--}}
                        {{--<div class="handle"></div>--}}
                    {{--</button>--}}
                    {{--Overtime Meal<br>--}}
                    {{--<button data-column="5" type="button"--}}
                            {{--class="btn btn-sm btn-toggle toggle-vis"--}}
                            {{--data-toggle="button" aria-pressed="false" autocomplete="off">--}}
                        {{--<div class="handle"></div>--}}
                    {{--</button>--}}
                    {{--Overtime Transport<br>--}}

                {{--</div>--}}

            {{--</div>--}}
        {{--</div>--}}
    {{--</li>--}}

    {{--<div style="background-color: transparent; border-left: 1px solid rgb(236, 238, 238);; padding: 0;  "--}}
    {{--class="card-header" id="headingTwo">--}}
    {{--<button style="font-size: 0.6em;" class="btn btn-link" type="button"--}}
    {{--data-toggle="collapse"--}}
    {{--data-target="#collapseTwo" aria-expanded="true"--}}
    {{--aria-controls="collapseTwo">--}}
    {{--Attributes <i class="fas fa-caret-down"></i>--}}
    {{--</button>--}}
    {{--</div>--}}
    {{--<div id="collapseTwo" class="collapse show" aria-labelledby="headingTwo"--}}
    {{--data-parent="#accordionExample">--}}
    {{--<div class="card-body">--}}
    {{--<div class="filterlist">--}}

    {{--</div>--}}
    {{--</div>--}}

    {{--</div>--}}
@endsection
@section('contentreporthead')
    <style>
        .form-control {
            font-size: 0.8rem;
        }

        .form-control:hover {
            cursor: pointer;
        }

        #reportrange {
            display: block;
            width: 100%;
            padding: .375rem .75rem;
            font-size: 0.8rem;
            font-weight: 400;
            line-height: 1.5;
            color: #495057;
            background-color: #fff;
            background-clip: padding-box;
            border: 1px solid #ced4da;
            border-radius: .25rem;
            transition: border-color .15s ease-in-out, box-shadow .15s ease-in-out;
        }
    </style>
@endsection
@section('reportcontent')
    <div class="col-md-12">
        <div class="card">

            <div class="card-header" style="background-color: #4fca63; color: white;">
                Time Report - Report Table
            </div>
            <div class="card-body">

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

                        <th>Name</th>
                        <th>Detail</th>

                        <th>NIP</th>
                        <th>Institution</th>
                        <th>City</th>
                        <th>Group</th>
                        <th>Position</th>
                        {{--<th>Date</th>--}}
                        {{--<th>Client</th>--}}
                        {{--<th>Week</th>--}}
                        {{--<th>Day</th>--}}
                        {{--<th>Month</th>--}}
                        <th>Regular Hour(s)</th>
                        <th>Overtime Hour(s)</th>
                        <th>Cut Overtime</th>
                        <th>Ineffective Hour(s)</th>
                        <th>Net</th>
                        {{--<th>Description</th>--}}
                        <th>Overtime Meal</th>
                        <th>Overtime Transportation</th>


                    </tr>
                    </thead>
                    <tbody>
                    @foreach($timereports as $timereport)
                        <tr>
                            <td>
                                @if(strlen($timereport->nama) <= 25)
                                {{$timereport->nama}}
                                @else
                                {{substr($timereport->nama, 0, 25)}}..
                                @endif
                            </td>
                            <td><a href="{{ url('/partner/reporting/timereport/detail/'.$timereport->nip) }}"><i class="fas fa-search-plus"></i></a></td>

                            <td>{{$timereport->nip}}</td>
                            <td>{{$timereport->institusi}}</td>
                            <td>{{ucwords(strtolower($timereport->kota))}}</td>
                            <td>{{$timereport->grup}}</td>
                            <td>{{$timereport->position}}</td>
                            {{--<td>{{date('d F, Y', strtotime($timereport->date))}}</td>--}}
                            {{--<td>{{$timereport->clientname}}</td>--}}
                            {{--<td>--}}
                            {{--@if($timereport->week == 1)--}}
                            {{--1st Week--}}
                            {{--@elseif($timereport->week == 2)--}}
                            {{--2nd Week--}}
                            {{--@elseif($timereport->week == 3)--}}
                            {{--3rd Week--}}
                            {{--@elseif($timereport->week == 4)--}}
                            {{--4th Week--}}
                            {{--@elseif($timereport->week == 5)--}}
                            {{--5th Week--}}
                            {{--@endif--}}
                            {{--</td>--}}
                            {{--<td>{{$timereport->day}}</td>--}}
                            {{--<td>{{date('F', strtotime($timereport->date))}}</td>--}}
                            <td>{{$timereport->normalhours}}</td>
                            <td>{{$timereport->overtimes}}</td>
                            <td>{{$timereport->ineffectivehours}}</td>
                            <td>{{$timereport->editineffective}}</td>
                            <td>{{$timereport->normalhours + $timereport->overtimes - $timereport->ineffectivehours - $timereport->editineffective}}</td>
                            {{--                            <td>{{$timereport->description}}</td>--}}
                            <td>{{number_format($timereport->overtimemeal,0,",",".")}}</td>
                            <td>{{number_format($timereport->overtimetransportation,0,",",".")}}</td>
                        </tr>
                    @endforeach
                    </tbody>
                    <tfoot>
                    <tr>
                        <th style="opacity: 0;">nama</th>
                        <th style="opacity: 0;">no</th>

                        <th style="opacity: 0;">NIP</th>
                        <th>Institution</th>
                        <th>City</th>
                        <th>Group</th>
                        <th>Position</th>
                        <th style="opacity: 0;">normalhours</th>
                        <th style="opacity: 0;">overtimes</th>
                        <th style="opacity: 0;"></th>
                        <th style="opacity: 0;">ineffectivehours</th>
                        <th style="opacity: 0;"></th>
                        {{--<th>description</th>--}}
                        <th style="opacity: 0;">overtimemeal</th>
                        <th style="opacity: 0;">overtimetransportation</th>

                    </tr>
                    </tfoot>

                </table>
                <a class='btn btn-xs btn-success' onclick="return confirm('Do you want to approve the record?')"
                type='submit' data-placement="top"
                data-target="#confirmDelete" data-title="Delete User"
                data-message={{'Are you sure you want to approve all this month`s reports?'}} href="{{ url('/timesheets/approval/period/all/'.(int)$month) }}">
                        Approve All This Month Report
                </a>
                <form action="{{ url('/partner/reporting/timereport/download') }}" method="GET">
                    <input hidden name="week" id="week" value="{{ \request('week') }}">
                    <input hidden name="month" id="month" value="{{ \request('month') }}">
                    <input hidden name="startdate" id="startdate" value="{{ \request('startdate') }}">
                    <input hidden name="enddate" id="enddate" value="{{ \request('enddate') }}">
                    {{--<button class="btn btn-success">Download Time Report</button>--}}
                </form>
            </div>
        </div>
        <div class="card">
            <div class="card-header">
                <h3>Download with Filter</h3>
            </div>
            <div class="card-body">
                <form action="{{ url('/partner/reporting/timereport/download') }}" method="GET">
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
                        {{--<div class="col">--}}
                            {{--<label for="week">Date Range</label>--}}
                            {{--<div id="reportrange2"--}}
                                 {{--style="background: #fff; cursor: pointer; padding: 5px 10px; border: 1px solid #ccc; width: 100%">--}}
                                {{--<span></span>--}}
                            {{--</div>--}}
                            {{--<script type="text/javascript">--}}
                                {{--$(function () {--}}

                                    {{--var start = moment().subtract(29, 'days');--}}
                                    {{--var end = moment();--}}

                                    {{--function cb(start, end) {--}}
                                        {{--$('#reportrange2 span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'));--}}
                                        {{--$('#reportrange2 #getdate').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'));--}}
                                        {{--$('#startdate').val(start.format('YYYY-MM-DD'));--}}
                                        {{--$('#enddate').val(end.format('YYYY-MM-DD'));--}}
                                    {{--}--}}

                                    {{--$('#reportrange2').daterangepicker({--}}
                                        {{--autoUpdateInput: false,--}}
                                        {{--locale: {--}}
                                            {{--cancelLabel: 'Clear'--}}
                                        {{--}--}}
                                    {{--});--}}
                                    {{--$('#reportrange2').daterangepicker({--}}
                                        {{--startDate: start,--}}
                                        {{--endDate: end,--}}
                                        {{--autoUpdateInput: false,--}}
                                        {{--locale: {--}}
                                            {{--format: 'YYYY-MM-DD'--}}
                                        {{--},--}}
                                        {{--ranges: {--}}
                                            {{--'Today': [moment(), moment()],--}}
                                            {{--'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],--}}
                                            {{--'Last 7 Days': [moment().subtract(6, 'days'), moment()],--}}
                                            {{--'Last 30 Days': [moment().subtract(29, 'days'), moment()],--}}
                                            {{--'This Month': [moment().startOf('month'), moment().endOf('month')],--}}
                                            {{--'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]--}}
                                        {{--}--}}
                                    {{--}, cb);--}}

                                    {{--cb(start, end);--}}

                                {{--});--}}
                                {{--$(function () {--}}
                                    {{--$('#datepicker2').datepicker({--}}
                                        {{--showButtonPanel: false,--}}
                                        {{--dateFormat: 'mm/dd/yy',--}}
                                        {{--todayBtn: "linked",--}}
                                        {{--todayHighlight: true,--}}
                                        {{--orientation: "left",--}}
                                        {{--autoclose: true,--}}

                                    {{--});--}}
                                    {{--$(".date-picker-year").focus(function () {--}}
                                        {{--$(".ui-datepicker-month").hide();--}}
                                    {{--});--}}
                                {{--});--}}

                                {{--function updatedate() {--}}
                                    {{--$('#reportrange2').datepicker('setDate', null);--}}

                                {{--}--}}

                            {{--</script>--}}

                        {{--</div>--}}
                    </div><br>
                    <div class="form-row">
                        <div class="col">
                            <label for="institusi">Institution</label>
                            <select id="institusi" name="institusi" class="form-control">
                                <option disabled selected>
                                    All Institution
                                </option>
                                @foreach($institusis as $institusi)
                                    <option>
                                        {{ $institusi -> institusi }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col">
                            <label for="kota">City</label>
                            <select id="kota" name="kota" class="form-control">
                                <option disabled selected>
                                    All City
                                </option>
                                @foreach($kotas as $kota)
                                    <option>
                                        {{ $kota -> kota }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col">
                            <label for="status">Status</label>
                            <select id="status" name="status" class="form-control">
                                <option disabled selected>
                                    All Status
                                </option>
                                @foreach($statuses as $status)
                                    <option>
                                        {{ $status -> status }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div><br>
                    <div class="form-row">
                        <div class="col">
                            <label for="positionid">Position</label>
                            <select id="positionid" name="positionid" class="form-control">
                                <option disabled selected>
                                    All Position
                                </option>
                                @foreach($posisis as $posisi)
                                    <option>
                                        {{ $posisi -> positionid }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col">
                            <label for="grade">Grade</label>
                            <select id="grade" name="grade" class="form-control">
                                <option disabled selected>
                                    All Grade
                                </option>
                                @foreach($grades as $grade)
                                    <option>
                                        {{ $grade -> grade }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col">
                            <label for="group">Group</label>
                            <select id="group" name="group" class="form-control">
                                <option disabled selected>
                                    All Group
                                </option>
                                @foreach($grups as $grup)
                                    <option>
                                        {{ $grup -> grup }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <br>
                    <input class="btn btn-danger" type="reset" value="Reset">
                    <button class="btn btn-success" name="action" value="xls" type="submit">Download Time Report</button>
                    <button class="btn btn-info" name="action" value="print"type="submit">Print</button>
                </form>
            </div>
        </div>

    </div>
    <style>
        .caret {
            display: none !important;
        }


    </style>
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
            padding: .375rem .75rem;
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

        #example_length label {
            display: flex;
            align-items: center;
        }

        #example_length label select {
            max-width: 80px;
        }

        #example_filter {
            float: right;
            display: inline-block;

        }

        #example_filter label {
            display: flex;
            align-items: center;

        }

        .paginate_button, .ellipsis {
            font-size: 0.8em;
            position: relative;
            padding: 0;
            margin-left: -1px;
            background-color: transparent;
            border: 0;
        }

        i {
            min-width: 0;
        }

        #example_paginate {
            display: flex;
            justify-content: flex-end;
            align-items: center;
        }

        #example_length .custom-select {
            margin: 0 10px;

        }

        #example_length {
            display: inline-block;

        }

        @media screen and (max-width: 767px) {
            #example_filter {
                margin-top: 10px;
                float: left;
                display: block;
            }

            #example_length {
                display: block;
            }

            #example_paginate {
                display: flex;
                justify-content: center;
            }

        }

        .table > thead:first-child > tr:first-child > th:first-child {
            display: inline-block;
            width: 100px;
            height: auto;
            padding-top: 8px;
            border-bottom: 2px solid #ddd;
            background-color: white;
            z-index: 10;
        }

        div.dataTables_filter input {
            font-weight: 400;
            line-height: 1.5;
            color: #495057;
            background-color: #fff;
            background-clip: padding-box;
            border: 1px solid #ced4da;
            border-radius: .25rem;
            float: left;
        }

        #example_length select {
            font-weight: 400;
            line-height: 1.5;
            color: #495057;
            background-color: #fff;
            background-clip: padding-box;
            border: 1px solid #ced4da;
            float: left;
            height: calc(2.25rem + 2px);
            padding: .375rem .75rem;
            margin: 0 5px;
        }

        .col-auto button, .col-auto select, #reportrange {
            margin: 5px 0;
        }
        #reportrange i{
            font-size: 20px;
            float: left;
            margin: 0;
            line-height: 30px;
            min-width: 5px;
            text-align: center;
            color: #a9afbb;
        }
        .table > thead:first-child > tr:first-child > th:first-child {
            top: 1.5% !important;
        }
        @media screen and (min-width: 800px) {
            .table > thead:first-child > tr:first-child > th:first-child {
                padding-top: 2px !important;

            }
        }
        thead th{
            text-transform: uppercase;
        }
    </style>


@endsection
