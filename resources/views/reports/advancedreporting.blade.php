@extends('layouts.reports')
@section('title', 'Reports')

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/5.0.0/normalize.min.css">
<link rel='stylesheet' href='https://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/css/bootstrap.min.css'>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/meyer-reset/2.0/reset.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css">

<link rel='stylesheet'
      href='https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.0.0-alpha.6/css/bootstrap.min.css'>
<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
<script>
    var names = [@foreach($periods as $period)
        '{{ $period }}',
        @endforeach ];
    var ctx = document.getElementById('myChart').getContext('2d');

    var myChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: names,
            datasets: [{
                label: 'Terjual',
                data: {{ json_encode($takehomepays) }},
                borderWidth: 1
            }]
        },
        options: {
            responsive: true,
            title: {
                display: true,
                text: 'Bar chart penjualan produk'
            },
            scales: {
                yAxes: [{
                    ticks: {
                        beginAtZero: true
                    }
                }]
            }
        }
    });
</script>
<script type="text/javascript">
    google.charts.load('current', {'packages':['corechart']});
    google.charts.setOnLoadCallback(drawVisualization);

    function drawVisualization() {
        // Some raw data (not necessarily accurate)
        var data = google.visualization.arrayToDataTable([
            ['Month', 'Bolivia', 'Ecuador', 'Madagascar', 'Papua New Guinea', 'Rwanda', 'Average'],
            ['2004/05',  165,      938,         522,             998,           450,      614.6],
            ['2005/06',  135,      1120,        599,             1268,          288,      682],
            ['2006/07',  157,      1167,        587,             807,           397,      623],
            ['2007/08',  139,      1110,        615,             968,           215,      609.4],
            ['2008/09',  136,      691,         629,             1026,          366,      569.6]
        ]);

        var options = {
            title : 'Monthly Coffee Production by Country',
            vAxis: {title: 'Cups'},
            hAxis: {title: 'Month'},
            seriesType: 'bars',
            series: {5: {type: 'line'}}
        };

        var chart = new google.visualization.ComboChart(document.getElementById('chart_div'));
        chart.draw(data, options);
    }
</script>
<style>
    .collapse {
        visibility: unset;
    }

    .nav-item .card-body {
        margin: 0 15px;
        padding: 0 1.125rem;
    }
</style>
@section('reports')

    {{--<li class="nav-item">--}}
        {{--<a class="nav-link"--}}
           {{--data-toggle="collapse"--}}
           {{--data-target="#collapseLinks" aria-expanded="true"--}}
           {{--aria-controls="collapseLinks" id="accordionExampleLinks">--}}
            {{--<p><i class="fas fa-bars"></i> Menu </p>--}}
        {{--</a>--}}
        {{--<div id="collapseLinks" class="collapse show" aria-labelledby="headingLinks"--}}
             {{--data-parent="#accordionExampleLinks">--}}
            {{--<div class="card-body">--}}
                {{--<div class="filterlist">--}}
                    {{--<a class="filterlink" href="{{ url('partner/reporting/payrolldata') }}">Database Payroll</a><br>--}}
                    {{--<a class="filterlink" href="{{ url('partner/reporting/payrollhistory') }}">Payroll--}}
                        {{--History</a><br>--}}
                    {{--<a style="display: none;" href="">{{ $monthss =  \Carbon\Carbon::now()->month }}</a>--}}
                    {{--<a class="filterlink" href="{{ url('partner/reporting/biodata') }}">Biodata</a><br>--}}
                    {{--<a class="filterlink" href="{{ url('partner/reporting/timereport') }}">Time Report</a><br>--}}
                    {{--<a class="filterlink"--}}
                       {{--href="{{ url('partner/reporting/advanced/') }}">Totals</a><br><br>--}}

                {{--</div>--}}
            {{--</div>--}}
        {{--</div>--}}
    {{--</li>--}}

    @yield('contentfilter')
    @yield('contentreporthead')

@endsection
@section('reportcontent')
    <style>

        .caret {
            display: none !important;
        }

        .col-sm-6 {
            padding-left: 0 !important;
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
            text-align: left;
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
    <style type="text/css">
        .caret {
            display: none !important;
        }

        .form-control {
            border: 1px solid lightgrey !important;
            padding: 5px 10px !important;
            width: auto !important;
            display: inline-block;
        }
        .form-control:hover{
            cursor: pointer;
        }

    </style>

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header card-header-warning">
                        <h4 class="card-title"><b>Advanced Report - Totals</b></h4>
                        {{--<p class="card-category">New employees on 15th September, 2016</p>--}}
                    </div>
                    {{--<div class="card-header" style="background-color: #8f44d2; color: white;">--}}
                    {{--Advanced Report - Totals--}}
                    {{--</div>--}}
                    <div class="card-body">
                        <form action="{{ url('partner/reporting/advanced/') }}" method="GET">
                            <label>Filter:</label>
                            <select class="form-control" name="periode">
                                <option value="" disabled selected>
                                    @if(\request()->has('periode'))
                                        {{ date('F', mktime(0, 0, 0, \request('periode'), 10))}}
                                    @else
                                        Entire Year
                                    @endif
                                </option>
                                <option value="1">January</option>
                                <option value="2">February</option>
                                <option value="3">March</option>
                                <option value="4">April</option>
                                <option value="5">May</option>
                                <option value="6">June</option>
                                <option value="7">July</option>
                                <option value="8">August</option>
                                <option value="9">September</option>
                                <option value="10">October</option>
                                <option value="11">November</option>
                                <option value="12">December</option>
                            </select>
                            <select class="form-control" name="kota">
                                <option value="" disabled selected>
                                    @if(\request()->has('kota'))
                                        {{ ucwords(strtolower(\request('kota'))) }}
                                    @else
                                        All City
                                    @endif
                                </option>
                                <option value="jakarta">Jakarta</option>
                                <option value="batam">Batam</option>
                            </select>
                            <select class="form-control" name="institution">
                                <option value="" disabled selected>
                                    @if(\request()->has('institution'))
                                        {{ ucwords(strtolower(\request('institution'))) }}
                                    @else
                                        All Institution
                                        @endif
                                        </option>
                                <option value="msid">MSId</option>
                                <option value="solis">SOLIS</option>
                            </select>
                            <button class="btn btn-primary" type="submit">Show</button>
                            <button class="btn btn-danger" type="reset">Reset</button>

                        </form><br>
                        <div class="row">
                            <div class="container">
                                @foreach($collections as $collection)
                                    <div class="col-lg-4 col-md-6 col-sm-6">
                                        <div class="card card-stats">
                                            <div class="card-header card-header-white card-header-icon">
                                                <div class="card-icon">
                                                    <img src="{{ asset('svg/bank.png') }}">
                                                </div>
                                                <p class="card-category">Gross Pay</p><br><br>
                                                <h4 class="card-title">
                                                    Rp. {{ number_format($collection -> totalpenghasilanbruto, 0, ',', '.') }}</h4>
                                            </div>
                                            <div class="card-footer">

                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-lg-4 col-md-6 col-sm-6">
                                        <div class="card card-stats">
                                            <div class="card-header card-header-white card-header-icon">
                                                <div class="card-icon">
                                                    <img src="{{ asset('svg/salary.png') }}">
                                                </div>
                                                <p class="card-category">Take Home Pay</p><br><br>
                                                <h4 class="card-title">
                                                    Rp. {{ number_format($collection -> totaltakehomepay, 0, ',', '.') }}</h4>
                                            </div>
                                            <div class="card-footer">

                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-lg-4 col-md-6 col-sm-6">
                                        <div class="card card-stats">
                                            <div class="card-header card-header-white card-header-icon">
                                                <div class="card-icon">
                                                    <img src="{{ asset('svg/tax.png') }}">
                                                </div>
                                                <p class="card-category">PPH Bulan Berkaitan</p><br><br>
                                                <h4 class="card-title">
                                                    Rp. {{ number_format($collection -> totalPPHbulanberkaitan, 0, ',', '.') }}</h4>
                                            </div>
                                            <div class="card-footer">

                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-lg-4 col-md-6 col-sm-6">
                                        <div class="card card-stats">
                                            <div class="card-header card-header-white card-header-icon">
                                                <div class="card-icon">
                                                    <img src="{{ asset('svg/overtime.png') }}">
                                                </div>
                                                <p class="card-category">Overtime Hours</p><br><br>
                                                <h4 class="card-title">
                                                    {{$sumovertimehours - $sumineffectivehours}} Hour(s)</h4>
                                            </div>
                                            <div class="card-footer">

                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-lg-4 col-md-6 col-sm-6">
                                        <div class="card card-stats">
                                            <div class="card-header card-header-white card-header-icon">
                                                <div class="card-icon">
                                                    <img src="{{ asset('svg/work.png') }}">
                                                </div>
                                                <p class="card-category">Regular Hours</p><br><br>
                                                <h4 class="card-title">
                                                    {{$sumregularhours}} Hour(s)</h4>
                                            </div>
                                            <div class="card-footer">

                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-lg-4 col-md-6 col-sm-6">
                                        <div class="card card-stats">
                                            <div class="card-header card-header-white card-header-icon">
                                                <div class="card-icon">
                                                    <img src="{{ asset('svg/clipboard.png') }}">
                                                </div>
                                                <p class="card-category">Ineffective Hours</p><br><br>
                                                <h4 class="card-title">
                                                    {{$sumineffectivehours}} Hour(s)</h4>
                                            </div>
                                            <div class="card-footer">

                                            </div>
                                        </div>
                                    </div>

                                @endforeach

                            </div>
                            {{--<div class="row">--}}
                                {{--<div class="col-md-8 stretch-card grid-margin">--}}
                                    {{--<div class="chart-container" style="position: relative; height:40vh; width:80vw">--}}
                                        {{--<canvas class="my-4 chartjs-render-monitor" id="myChart"></canvas>--}}
                                    {{--</div>--}}
                                {{--</div>--}}
                                {{----}}
                            {{--</div>--}}
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header card-header-info">
                        <h4 class="card-title"><i class="fas fa-user"></i> <b>Time Report | Professionals</b></h4>
                        {{--<p class="card-category">New employees on 15th September, 2016</p>--}}
                    </div>

                    <div class="card-body">

                        <table class="table table-responsive table-striped display" id="example">
                            <thead>
                            <tr>
                                <td>No</td>
                                <td>Nama</td>
                                {{--<td> </td>--}}
                                <td>OT.</td>
                                <td>RH.</td>
                                <td>Total</td>
                            </tr>
                            </thead>
                            <tbody>
                            <div style="display: none;">{{$no = 1}}</div>
                            @foreach($totalprofessionals as $totalprofessional)

                                <tr>
                                    <td>{{$no++}}</td>
                                    <td>

                                        {{ ucwords(strtolower($totalprofessional->nama)) }}

                                    </td>
                                    {{--<td><a href="{{ url('partner/reporting/advanced/client/'.$totalprofessionals->id) }}"><i class="fas fa-search-plus"></i></a></td>--}}
                                    <td>{{ $totalprofessional->overtimetotals }}</td>
                                    <td>{{ $totalprofessional->regulartotals }}</td>
                                    <td>{{ $totalprofessional->totalhour }}</td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header card-header-info">
                        <h4 class="card-title"><i class="fas fa-building"></i> <b>Time Report | Companies</b></h4>
                        {{--<p class="card-category">New employees on 15th September, 2016</p>--}}
                    </div>

                    <div class="card-body">

                        <table class="table table-responsive table-striped display" id="exampletwo">
                            <thead>
                            <tr>
                                <td>No</td>
                                <td>Client</td>
                                <td> </td>
                                <td>Code</td>
                                <td>Eng. Type</td>
                                <td>Eng. Period</td>
                                <td>OT.</td>
                                <th>RH.</th>
                                <td>Total</td>
                            </tr>
                            </thead>
                            <tbody>
                            <div style="display: none;">{{$no = 1}}</div>
                            @foreach($totalworkhours as $totalworkhour)

                                <tr>
                                    <td>{{$no++}}</td>
                                    <td>
                                        {{ $totalworkhour->clientid }}
                                    </td>
                                    <td><a href="{{ url('partner/reporting/advanced/client/'.$totalworkhour->id) }}"><i class="fas fa-search-plus"></i></a></td>

                                    <td>
                                        {{ $totalworkhour->clientcode }}
                                    </td>
                                    <td>
                                        {{ $totalworkhour->engagementtype }}
                                    </td>
                                    <td>
                                        {{ $totalworkhour->engagementperiod }}
                                    </td>
                                    <td>{{ $totalworkhour->overtimetotals }}</td>
                                    <td>{{ $totalworkhour->regulartotals }}</td>
                                    <td>{{ $totalworkhour->totals }}</td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <style type="text/css">
        .caret {
            display: none !important;
        }

        .form-control {
            border: 1px solid lightgrey !important;
            padding: 5px 10px !important;
            width: auto !important;
            display: inline-block;
        }
        .form-control:hover{
            cursor: pointer;
        }
        .table > tbody > tr > td:first-child {
            position: absolute;
            width: 40px !important;
            background-color: white;
        }
        .table > thead:first-child > tr:first-child > th:first-child {
            width: 40px !important;
            position: absolute;
            background-color: white;
            top: 0;
            z-index: 5;

        }
        .dataTables_wrapper .dataTables_paginate .paginate_button {
            font-size: 0.8em;
            position: relative;
            padding: 0;
            margin-left: -1px;
            background-color: transparent;
            border: 0;
        }
        .dataTables_wrapper .dataTables_paginate .paginate_button:hover{
            background: none;
            border: none;
        }
        .table > tbody > tr > td:nth-child(2) {
            padding-left: 10px !important;
        }
    </style>
@endsection
