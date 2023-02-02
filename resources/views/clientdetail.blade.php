@extends('layouts.app')
@section('title', 'Client Detail')

@section('content')
<style>
.table-hover tbody tr:hover {
    background-color: rgba(255, 235, 59, 0.94);
}
.table td:first-child:hover{
    background-color: rgba(255, 235, 59, 0.94);
}
.table td:first-child{
    background-color: #fbfbfb;
}

.clients td:first-child{
    font-weight: bold;
}
</style>
    <div class="container">
        <div class="row justify-content-center">
            <div style="margin-bottom: 15px;" class="col-md-10">

                <div class="card">

                    <div class="card-header card-header-warning card-header-icon">
                        <div class="card-icon">
                            <i class="fas fa-building"></i>
                        </div>
                        <h3 class="card-title">Client Data</h3>
                    </div>
                    <div class="card-body">
                        <table class="table clients table-hover">
                            <thead>
                            <th colspan="2">Data</th>
                            </thead>
                            <tbody>
                            <tr>
                                <td>Name</td>
                                <td>{{ $clients -> clientname }}</td>
                            </tr>
                            <tr>
                                <td>Code</td>
                                <td>{{ $clients -> clientcode }}</td>
                            </tr>
                            <tr>
                                <td>Institution</td>
                                <td>{{ $clients -> institusi }}</td>
                            </tr>
                            <tr>
                                <td>Branch</td>
                                <td>{{ ucwords(strtolower($clients -> branch)) }}</td>
                            </tr>
                            <tr>
                                <td>Start Period</td>
                                @if($clients -> engagementperiodstart === '0000-00-00')
                                    <td></td>
                                @elseif($clients -> engagementperiodstart === '0001-01-01')
                                    <td></td>
                                @else
                                    <td>{{ date('d M Y', strtotime($clients -> engagementperiodstart)) }}</td>
                                @endif
                            </tr>
                            <tr>
                                <td>End Period</td>
                                <td>{{ date('d M Y', strtotime($clients -> engagementperiod)) }}</td>
                            </tr>
                            <tr>
                                <td>Type</td>
                                <td>{{ $clients -> engagementtype }}</td>
                            </tr>
                            <tr>
                                <td>Notes (Others)</td>
                                <td>{{ $clients -> keterangan }}</td>
                            </tr>
                            <tr>
                                <td>Location</td>
                                <td>{{ $clients -> location }}</td>
                            </tr>
                            <tr>
                                <td>Fee</td>
                                <td>Rp. {{ number_format($clients -> fee,0,",",".") }}</td>
                            </tr>
                            <tr>
                                <td>Fee (Non-rupiah)</td>
                                <td>{{ $clients -> feenonrupiah }}</td>
                            </tr>
                            @if($client_groups)
                            <tr>
                                <td>Group</td>
                                <td>
                                @foreach($client_groups as $client_group)
                                @foreach($groups as $group)
                                @if($client_group == $group->id)
                                {{ $group -> name }},
                                @endif
                                @endforeach
                                @endforeach
                                </td>
                            </tr>
                            @endif

                            </tbody>
                        </table>
                        <div style="float: right">
                            <a class="btn btn-outline-primary" style="margin-right: 5px;" href="{{ url()->previous() }}">
                                <i class="fas fa-backward"></i> Back
                            </a>
                            <a href="{{ url('/administration/timereport/'.$clients->id.'/deleteclient') }}">
                            <button class="btn btn-outline-danger" onclick="return confirm('Are you sure?')"
                                                    type='submit'
                                                    data-toggle="tooltip" data-placement="top"
                                                    title="Batalkan permintaan cuti"
                                                    data-target="#confirmDelete" data-title="Delete User"
                                                    data-message='Are you sure you want to delete this user ?'>
                                                <i class="fas fa-trash-alt"></i> Delete
                                            </button>
                            
                        </a>
                            <a class="btn btn-success" style="margin-right: 5px;" href="{{ URL::to('/administration/timereport/'.$clients->id.'/editclient') }}">
                                <i class="fas fa-user-edit"></i> Edit
                            </a>
                        </div>
                    </div>
                </div>
            </div><br>
            <!--<div class="col-md-6">-->

            <!--    <div style="color: #969696" class="card">-->
            <!--        <div class="card-header">-->
            <!--            Engagement Type-->
            <!--        </div>-->

            <!--        <div class="card-body">-->
            <!--            <table class="table table-hover">-->
            <!--                <thead>-->
            <!--                <tr>-->
            <!--                    <th>Code</th>-->
            <!--                    <th>Name</th>-->
            <!--                </tr>-->
            <!--                </thead>-->
            <!--                <tbody>-->
            <!--                <tr>-->
            <!--                    <td>A-001</td>-->
            <!--                    <td>Accounting Services - Monthly</td>-->
            <!--                </tr>-->
            <!--                <tr>-->

            <!--                    <td>A-002</td>-->
            <!--                    <td>Accounting Services - Project</td>-->
            <!--                </tr>-->
            <!--                <tr>-->
            <!--                    <td>A-003</td>-->
            <!--                    <td>Accounting Services - Review</td>-->
            <!--                </tr>-->
            <!--                <tr>-->
            <!--                    <td>T-001</td>-->
            <!--                    <td>Tax Services - Monthly</td>-->
            <!--                </tr>-->
            <!--                <tr>-->
            <!--                    <td>T-002</td>-->
            <!--                    <td>Tax Services - Yearly</td>-->
            <!--                </tr>-->
            <!--                <tr>-->
            <!--                    <td>T-003</td>-->
            <!--                    <td>Tax Services - Personal Tax</td>-->
            <!--                </tr>-->
            <!--                <tr>-->
            <!--                    <td>T-004</td>-->
            <!--                    <td>Tax Services - TP Documentation</td>-->
            <!--                </tr>-->
            <!--                <tr>-->
            <!--                    <td>T-005</td>-->
            <!--                    <td>Tax Services - Tax Audit</td>-->
            <!--                </tr>-->
            <!--                <tr>-->
            <!--                    <td>T-006</td>-->
            <!--                    <td>Tax Services - Tax Consultation</td>-->
            <!--                </tr>-->
            <!--                <tr>-->
            <!--                    <td>T-099</td>-->
            <!--                    <td>Tax Servixes - Others</td>-->
            <!--                </tr>-->
            <!--                <tr>-->
            <!--                    <td>L-001</td>-->
            <!--                    <td>Legal Services</td>-->
            <!--                </tr>-->
            <!--                <tr>-->
            <!--                    <td>O-001</td>-->
            <!--                    <td>Other Services</td>-->
            <!--                </tr>-->
            <!--                <tr>-->
            <!--                    <td>P-001</td>-->
            <!--                    <td>Packages</td>-->
            <!--                </tr>-->
            <!--                <tr>-->
            <!--                    <td>M-001</td>-->
            <!--                    <td>General Audit</td>-->
            <!--                </tr>-->
            <!--                <tr>-->
            <!--                    <td>M-002</td>-->
            <!--                    <td>Special Audit</td>-->
            <!--                </tr>-->
            <!--                <tr>-->
            <!--                    <td>M-099</td>-->
            <!--                    <td>Others</td>-->
            <!--                </tr>-->
            <!--                </tbody>-->
            <!--            </table>-->
            <!--        </div>-->
            <!--    </div>-->
            <!--</div>-->
        </div>
    </div>
@endsection

