<table style=" display: block; width: 100%; overflow-x: auto;font-size: 12px;"
       class="table table-responsive-md table-striped display"
       id="example">
    <thead>
    <tr>

        <th>Name</th>
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
        <th>Overbudget Hour(s)</th>
        {{--<th>Description</th>--}}
        <th>Overtime Meal</th>
        <th>Overtime Transportation</th>


    </tr>
    </thead>
    <tbody>
    @foreach($timereports as $timereport)
        <tr>
            <td>
                <a href="{{ url('/partner/reporting/timereport/detail/'.$timereport->nip) }}">{{$timereport->nama}}</a>
            </td>
            <td>{{$timereport->nip}}</td>
            <td>{{$timereport->institusi}}</td>
            <td>{{$timereport->kota}}</td>
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
            {{--                            <td>{{$timereport->description}}</td>--}}
            <td>{{$timereport->overtimemeal}}</td>
            <td>{{$timereport->overtimetransportation}}</td>
        </tr>
    @endforeach
    </tbody>
</table>
