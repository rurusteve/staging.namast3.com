<table style=" display: block; width: 100%; overflow-x: auto;font-size: 12px;"
       class="table table-responsive-md table-striped display"
       id="example">
    <thead>
    <tr>


        @if($inchargestatus == 1)
            <th>Name</th>
            @else
            @endif
        {{-- <th>Date</th> --}}
        <th>Client</th>
        <th>Task</th>
        {{-- <th>Month</th> --}}
        <th>Week</th>
        <th>Regular Hour(s)</th>
        <th>Overtime Hour(s)</th>
        <th>Ineffective Rule(s)</th>
        <th>Overtime Meal</th>
        <th>Overtime Transportation</th>
        <th>Description</th>
        <th>Input Date</th>


    </tr>
    </thead>
    <tbody>
    @foreach($collections as $collection)
        <tr>

            @if($inchargestatus == 1)
                <td>
                    {{ ucwords(strtolower($collection->nama)) }}
                </td>
            @else
            @endif
            {{-- <td>{{ $collection->date }}</td> --}}
            <td>{{ $collection->clientname }}</td>
            <td>{{ ucwords(strtolower($collection->taskname)) }}</td>
            {{-- <td>{{ date('F', strtotime($collection->date)) }}</td> --}}
            <td>{{ $collection->week }}</td>
            <td>{{ $collection->normalhours }}</td>
            <td>{{ $collection->overtimes }}</td>
            <td>{{ $collection->ineffectiverules }}</td>
            <td>{{ $collection->overtimemeal }}</td>
            <td>{{ $collection->overtimetransportation }}</td>
            <td>{{ $collection->description }}</td>
            <td>{{ $collection->created_at }}</td>

        </tr>
    @endforeach
    </tbody>
</table>
