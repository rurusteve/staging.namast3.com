
@extends('layouts.app')

@section('content')
    <style>
        .table > thead:first-child > tr:first-child > th:first-child {
            position: absolute;
            display: inline-block;
            width: 95px;
        }

        .table > thead:first-child > tr:first-child > th:nth-child(odd) {
            background-color: white;
        }

        .table > tbody > tr > td:first-child {
            position: absolute;
            display: inline-block;
            width: 95px;
            background-color: #ffe2e0;

        }

        .table > thead:first-child > tr:first-child > th:nth-child(2) {
            padding-left: 100px;
        }

        .table > tbody > tr > td:nth-child(2) {
            padding-left: 100px !important;
        }

        .table thead th {
            border-bottom: none;
        }

        thead tr, tbody td {
            text-align: right;
        }

        tbody td:first-child {
            text-align: left;
        }

        /*.table-striped tbody tr:nth-of-type(odd) {*/
        /*background-color: white;*/
        /*}*/
    </style>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col col-md-12">
                <div class="card">
                    <div class="card-header">
                        {{ ucwords(strtolower($nama)) }} - Time Report Summary
                    </div>
                    <div class="card-body">
                        {{--<table>--}}
                        {{--<thead>--}}
                        {{--<tr>--}}
                        {{--<th>Client</th>--}}

                        {{--</tr>--}}
                        {{--</thead>--}}
                        {{--@foreach($timereports as $timereport)--}}
                        {{--<tr>--}}
                        {{--<td>{{$timereport->activities}}</td>--}}
                        {{--</tr>--}}
                        {{--@endforeach--}}
                        {{--</table>--}}
                        <div>
                            <table class="table table-responsive-md table-hover table-striped">

                                <thead>

                                <tr>
                                    <th style="width: auto; text-align: left">Client<br>ID</th>
                                    <th style="width: 14.3%;">Normal Hours</th>
                                    <th style="width: 14.3%;">Overtime Hours</th>
                                    <th style="width: 14.3%;">Ineffective Hours</th>
                                    <th style="width: 13.3%;">Overbudget Hours</th>
=                                    <th style="width: 13.3%;">Net</th>
                                    <th style="width: 14.3%;">Total Hours</th>
                                    <th style="width: 16.3%;">%</th>
                                </tr>
                                <tr style="font-size: .70em" class="table-success">

                                    <td colspan="3"></td>
                                    <td colspan="5">PROFESSIONAL ACTIVITIES RELATING TO ENGAGEMENTS</td>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($sumactprfs as $sumactprf)
                                    <tr>
                                        <td> {{ $sumactprf->clientid }}</td>
                                        <td> {{ $sumactprf->totalnormalhours }}</td>
                                        {{--@foreach($sumactprfovertimes as $sumactprfovertime)--}}
                                        {{--<td>{{date('h:i', strtotime($sumactprf->totalovertimes))}}</td>--}}
                                        <td>{{str_replace(".00", "", (string)number_format ($sumactprf->totalovertimes, 2, ".", ""))}}</td>
                                        <td>{{$sumactprf->totalineffectivehours}}</td>
                                        <td> 0</td>
                                        <td>{{number_format($sumactprf->nets)}}</td>
                                        <td>{{number_format($sumactprf->totals,0)}}</td>
                                        <td>{{number_format((float)round($sumactprf->totals / $sumactprftotals * 100), 0, '.', '')}}%</td>
                                    </tr>
                                    {{--@endforeach--}}
                                @endforeach
                                <tr style="color: black;">
                                    <td colspan="1" style="color: black;">Total</td>
                                    <td> {{ $sumNMH }} </td>
                                    <td> {{ str_replace(".00", "", (string)number_format ($sumOVT, 2, ".", "")) }} </td>
                                    <td> {{ $sumIEH }} </td>
                                    <td> 0</td>
                                    <td> {{ $sumNET }} </td>
                                    <td> {{ str_replace(".00", "", (string)number_format ($sumactprftotals, 2, ".", "")) }} </td>
                                    <td style="display: none;">{{$sumtotalone = $sumactprftotals / ($sumactprftotals + $sumactadmtotals)}}</td>
                                    <td>{{number_format((float)round($sumtotalone * 100), 0, '.', '')}}%</td>

                                </tr>
                                <tr style="font-size: .70em" class="table-warning">
                                    <td style="background-color: transparent"></td>
                                    <td colspan="3"></td>
                                    <td colspan="4">ADMINISTRATION ACTIVITIES AND UN</td>
                                </tr>
                                @foreach($sumactadms as $sumactadm)
                                    <tr>
                                        <td> {{ $sumactadm->clientid }}</td>
                                        <td> {{ $sumactadm->totalnormalhours }}</td>
                                        {{--@foreach($sumactprfovertimes as $sumactprfovertime)--}}
                                        {{--<td>{{date('h:i', strtotime($sumactprf->totalovertimes))}}</td>--}}
                                        <td>{{str_replace(".00", "", (string)number_format ($sumactadm->totalovertimes, 2, ".", ""))}}</td>
                                        <td>{{$sumactadm->totalineffectivehours}}</td>
                                        <td> 0</td>
                                        <td>{{number_format($sumactadm->nets)}}</td>
                                        <td>{{number_format($sumactadm->totals,0)}}</td>
                                        <td>{{number_format((float)round($sumactadm->totals / $sumactadmtotals * 100), 0, '.', '')}}
                                            %
                                        </td>
                                    </tr>
                                    {{--@endforeach--}}
                                @endforeach

                                <tr style="color: black;">
                                    <td colspan="1" style="color: black;">Total</td>
                                    <td> {{ $sumNMHadm }} </td>
                                    <td> {{ str_replace(".00", "", (string)number_format ($sumOVTadm, 2, ".", "")) }} </td>
                                    <td> {{ $sumIEHadm }} </td>
                                    <td> 0</td>
                                    <td> {{ $sumNETadm }} </td>
                                    <td> {{ str_replace(".00", "", (string)number_format ($sumactadmtotals, 2, ".", "")) }} </td>
                                    <td style="display: none;">{{$sumtotaltwo = $sumactadmtotals / ($sumactprftotals + $sumactadmtotals)}}</td>
                                    <td>{{number_format((float)round($sumtotaltwo * 100), 0, '.', '')}}%</td>
                                </tr>
                                <tr style="color: black;">
                                    <td colspan="1" style="color: black;">Grand Total</td>
                                    <td><br> {{ $NMH }} </td>
                                    <td><br> {{ str_replace(".00", "", (string)number_format ($OVT, 2, ".", "")) }}
                                    </td>
                                    <td><br> {{ $IEH }} </td>
                                    <td><br> 0</td>
                                    <td><br> {{ $NET }} </td>
                                    <td>
                                        <br> {{ str_replace(".00", "", (string)number_format ($sumtotals, 2, ".", "")) }}
                                    </td>
                                    <td>
                                        <br>{{number_format((float)round(($sumtotalone + $sumtotaltwo) * 100), 0, '.', '')}}%
                                    </td>
                                </tr>

                                </tbody>
                            </table>
                            <a href="{{ url('/partner/reporting/timereport') }}">
                                <button type="button" class="btn btn-success"><i class="fas fa-undo"></i> Back to Reporting</button>
                            </a>
                            <a href="{{ url('/home') }}">
                                <button type="button" class="btn btn-primary"><i class="fas fa-home"></i> Home</button>
                            </a>
                            {{--{{ $sumactprfs }}<br>--}}
                            {{--{{ $sumactadms }}<br>--}}
                            {{--{{ $sumactadmtotals }}<br>--}}
                            {{--{{ $sumactboths }}<br>--}}
                            {{--{{ $totalactivityones }}--}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
