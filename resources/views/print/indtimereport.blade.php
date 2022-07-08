<html moznomarginboxes mozdisallowselectionprint>
<head>
    <title>Print Time Report</title>
    <link rel="icon" href="https://my.namast3.com/laravel/public/faviconsolis.ico">
    <link rel='stylesheet'
          href='https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.0.0-alpha.6/css/bootstrap.min.css'>
    <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no'
          name='viewport'/>
    <!--     Fonts and icons     -->
    <link rel="stylesheet" type="text/css"
          href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700|Roboto+Slab:400,700|Material+Icons"/>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css"
          integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/"
          crossorigin="anonymous">
    <link href="https://cdn.datatables.net/responsive/2.2.3/css/responsive.bootstrap4.min.css">
    <link href="{{ asset('css/datetimepicker.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css"
          integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous">


</head>
<body onload="myFunction()">

<style type="text/css" media="print">

    header,footer{
        display: none;
    }
    @page {
        size: landscape;   /* auto is the initial value */
        margin: 20mm 15mm 20mm 15mm;  /* this affects the margin in the printer settings */
        background-color: green;

    }


    html {
        background-color: #FFFFFF;
        /*margin: 1.5cm .5cm; !* this affects the margin on the html before sending to printer *!*/
    }

    body {
        /*margin: 10mm 15mm 10mm 15mm; !* margin you want for the content *!*/

    }
    @media print {
        header,footer {
            display: none;
        }
    }
    .page-break{
        page-break-after: always;
    }
</style>

<div class="container">

    <div class="row justify-content-center">
        <div class="col-sm-12">
           @if($request-> nip === "null")

                <div class="card">
                    <div class="card-header">
                        <h4>Time Report by {{ucwords(strtolower($user -> nama))}}
                            @if($request->week !== null)
                                - Week {{$request->week}}
                            @endif
                            @if($request->period !== null)
                                - {{$request->period}}
                            @endif
                            , {{\Carbon\Carbon::now()->year}}
                        </h4>

                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-sm-3">
                                <div style="margin-bottom: 15px;" class="col-xs-12 col-sm-12">
                                    <img style="border-radius: 10px;" width="100px;" src="{{ asset('avatar.jpg') }}">
                                </div>

                            </div>
                            <div class="col-sm-9" style="display: flex; justify-content: flex-start">


                                <div class="col-xs-6 col-sm-6">

                                    <div class="biodata">Name: {{ucwords(strtolower($user -> nama))}}</div>
                                    <div class="biodata">NIP: {{$request->nip}}</div>
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
                    </div>


                </div>
                <div class="card">
                    <div class="card-body">
                        <table class="table table-sm table-bordered table-stripped">


                            <thead style="font-size: 12px;">
                            <tr>

                                <th>Date</th>
                                <th>Regular Hour(s)</th>
                                <th>Overtime Hour(s)</th>
                                <th>Overbudget Hour(s)</th>
                                <th>Overtime Meal</th>
                                <th>Overtime Transportation</th>
                                <th>Periode</th>
                                <th>Description</th>
                                <th>Task</th>
                                <th>Client</th>
                                <th>Client Code</th>


                            </tr>
                            </thead>
                            <tbody style="font-size: 12px;">
                            @foreach($timereports as $timereport)
                                <tr>

                                    <td>{{date("d F Y",strtotime($timereport->date))}}</td>
                                    <td>{{number_format($timereport->normalhours,2,",",".")}}</td>
                                    <td>{{number_format($timereport->overtimes,2,",",".")}}</td>
                                    <td>{{number_format($timereport->editineffective,2,",",".")}}</td>
                                    <td>{{number_format($timereport->overtimemeal,2,",",".")}}</td>
                                    <td>{{number_format($timereport->overtimetransportation,2,",",".")}}</td>
                                    <td>{{date('F', mktime(0, 0, 0, $timereport->period, 10))}}</td>
                                    <td>{{$timereport->description}}</td>
                                    <td>{{ucwords(strtolower($timereport->taskname))}}</td>
                                    <td>{{$timereport->clientname}}</td>
                                    <td>{{$timereport->clientcode}}</td>
                                    {{--@elseif($timereports === null)--}}
                                    {{--<td colspan="11"> No data</td>--}}

                                    {{--@endif--}}
                                </tr>
                            @endforeach

                            </tbody>
                        </table>
                    </div>
                </div>

            @else
                <div class="card page-break">
                    <div class="card-body">
                        <table class="table table-sm table-bordered table-stripped">


                            <thead style="font-size: 12px;">
                            <tr>
                                <th>NIP	</th>
                                <th>Name	</th>
                                <th>Institution	</th>
                                {{--<th>City	</th>--}}
                                <th>Position</th>
                                {{--<th>Group</th>--}}
                                <th>Client </th>
                                <th>Date</th>
                                <th>RH</th>
                                <th>OTH</th>
                                <th>OBH</th>
                                <th>OT. Meal</th>
                                <th>OT. Transport</th>
                                {{--<th>Period</th>--}}
                                <th>Desc.</th>
                                <th>Task</th>


                            </tr>
                            </thead>
                            <tbody style="font-size: 12px;">
                            @foreach($timereports as $timereport)
                                <tr>
                                    {{--                                @if($timereports !== null)--}}
                                    <td>{{ucwords(strtolower($timereport->nip))}}</td>
                                    <td>{{ucwords(strtolower($timereport->nama))}}</td>
                                    <td>{{ucwords(strtolower($timereport->institusi))}}</td>
{{--                                    <td>{{ucwords(strtolower($timereport->kota))}}</td>--}}
                                    <td>{{ucwords(strtolower($timereport->positionid))}}</td>
{{--                                    <td>{{ucwords(strtolower($timereport->grup))}}</td>--}}
{{--                                    <td>{{$timereport->clientname}}</td>--}}
                                    <td>{{$timereport->clientcode}}</td>
                                    <td>{{date("d F Y",strtotime($timereport->date))}}</td>
                                    <td>{{number_format($timereport->normalhours,2,",",".")}}</td>
                                    <td>{{number_format($timereport->overtimes,2,",",".")}}</td>
                                    <td>{{number_format($timereport->editineffective,2,",",".")}}</td>
                                    <td>{{number_format($timereport->overtimemeal,2,",",".")}}</td>
                                    <td>{{number_format($timereport->overtimetransportation,2,",",".")}}</td>
{{--                                    <td>{{date('F', mktime(0, 0, 0, $timereport->period, 10))}}</td>--}}
                                    <td>{{$timereport->description}}</td>
                                    <td>{{ucwords(strtolower($timereport->taskname))}}</td>

                                    {{--@elseif($timereports === null)--}}
                                    {{--<td colspan="11"> No data</td>--}}

                                    {{--@endif--}}
                                </tr>
                            @endforeach


                            </tbody>
                            <tfoot style="border: 0;">
                            <tr style="font-size: 11px; border: 0;">
                                <td colspan="13">
                                    <b>RH </b>= Regular Hour(s),
                                    <b>OTH </b>= Overtime Hour(s),
                                    <b>OBH </b>= Overbudget Hour(s),
                                    <b>OT. </b>= Overtime
                                </td>
                            </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
                {{--<div class="card page-break">--}}
                    {{--<div class="card-body">--}}
                        {{--<table class="table table-sm table-bordered table-stripped">--}}


                            {{--<thead style="font-size: 12px;">--}}
                            {{--<tr>--}}

                                {{--<th>Date</th>--}}
                                {{--<th>Regular Hour(s)</th>--}}
                                {{--<th>Overtime Hour(s)</th>--}}
                                {{--<th>Overbudget Hour(s)</th>--}}
                                {{--<th>Overtime Meal</th>--}}
                                {{--<th>Overtime Transportation</th>--}}
                                {{--<th>Periode</th>--}}
                                {{--<th>Description</th>--}}
                                {{--<th>Task</th>--}}



                            {{--</tr>--}}
                            {{--</thead>--}}
                            {{--<tbody style="font-size: 12px;">--}}
                            {{--@foreach($timereports as $timereport)--}}
                                {{--<tr>--}}

                                    {{--<td>{{date("d F Y",strtotime($timereport->date))}}</td>--}}
                                    {{--<td>{{number_format($timereport->normalhours,2,",",".")}}</td>--}}
                                    {{--<td>{{number_format($timereport->overtimes,2,",",".")}}</td>--}}
                                    {{--<td>{{number_format($timereport->editineffective,2,",",".")}}</td>--}}
                                    {{--<td>{{number_format($timereport->overtimemeal,2,",",".")}}</td>--}}
                                    {{--<td>{{number_format($timereport->overtimetransportation,2,",",".")}}</td>--}}
                                    {{--<td>{{date('F', mktime(0, 0, 0, $timereport->period, 10))}}</td>--}}
                                    {{--<td>{{$timereport->description}}</td>--}}
                                    {{--<td>{{ucwords(strtolower($timereport->taskname))}}</td>--}}

                                    {{--@elseif($timereports === null)--}}
                                    {{--<td colspan="11"> No data</td>--}}

                                    {{--@endif--}}
                                {{--</tr>--}}
                            {{--@endforeach--}}


                            {{--</tbody>--}}
                        {{--</table>--}}
                    {{--</div>--}}
                {{--</div>--}}
            @endif

        </div>
    </div>
</div>

<script>
    function myFunction() {
        window.print()
    }
</script>
</body>

</html>