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
        select:hover{
            cursor: pointer;
        }
    </style>
    <div class="container">
        <div class="row justify-content-center">
            <div style="margin-bottom: 15px;" class="col-md-10">

                <div class="card">
                    <div class="card-header card-header-info card-header-icon">
                        <div class="card-icon">
                            <i class="fas fa-shapes"></i>
                        </div>
                        <h3 class="card-title">Editing Client Data</h3>
                    </div>


                    <div class="card-body">
                        <form action="{{ url('administration/timereport/'.$clients->id.'/updateclient') }}" method="POST">
                            @csrf
                        <table class="table clients table-hover">
                            <thead>
                            <th colspan="2">Data</th>
                            </thead>
                            <tbody>
                            <tr>
                                <td>Name</td>
                                <td><input class="form-control" name="clientname" type="text" value="{{ $clients -> clientname }}"></td>
                            </tr>
                            <tr>
                                <td>Code</td>
                                <td><input class="form-control" name="clientcode" type="text" value="{{ $clients -> clientcode }}"></td>
                            </tr>
                            <tr>
                                <td>Institution</td>
                                <td><input class="form-control" name="institusi" type="text" value="{{ $clients -> institusi }}"></td>
                            </tr>
                            <tr>
                                <td>Branch</td>
                                <td><input class="form-control" name="branch" type="text" value="{{ ucwords(strtolower($clients -> branch)) }}"></td>
                            </tr>
                            <tr>
                                <td>Start Period</td>
                                <td><input class="form-control" name="engagementperiodstart" type="date" value="{{ $clients -> engagementperiodstart }}"></td>
                            </tr>
                            <tr>
                                <td>End Period</td>
                                <td><input class="form-control" name="engagementperiod" type="date" value="{{ $clients -> engagementperiod }}"></td>
                            </tr>
                            <tr>
                                <td>Type</td>
                                <td>
                                    <select class="form-control" name="engagementtype">
                                        <option value="{{ $clients -> engagementtype }}" selected>{{ $clients -> engagementtype }}</option>
                                        <option value="" disabled>Solis</option>
                                        <option value="A-001">Accounting Services - Monthly</option>
                                        <option value="A-002">Accounting Services - Project</option>
                                        <option value="A-003">Accounting Services - Review</option>
                                        <option value="T-001">Tax Services - Monthly</option>
                                        <option value="T-002">Tax Services - Yearly</option>
                                        <option value="T-003">Tax Services - Personal Tax</option>
                                        <option value="T-004">Tax Services - TP Documentation</option>
                                        <option value="T-005">Tax Services - Tax Audit</option>
                                        <option value="T-006">Tax Services - Tax Consultation</option>
                                        <option value="T-099">Tax Services - Others</option>
                                        <option value="L-001">Legal Services</option>
                                        <option value="O-001">Other Services</option>
                                        <option value="P-001">Packages</option>
                                        <option value="" disabled>MSId</option>
                                        <option value="M-001">General Audit</option>
                                        <option value="M-002">Special Audit</option>
                                        <option value="M-099">Others</option>
                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <td>Notes (Others)</td>
                                <td><input class="form-control" name="keterangan" type="text" value="{{ $clients -> keterangan }}"></td>
                            </tr>
                            <tr>
                                <td>Location</td>
                                <td><input class="form-control" name="location" type="text" value="{{ ucwords(strtolower($clients -> location)) }}"></td>
                            </tr>
                            <tr>
                                <td>Fee</td>
                                <td><input class="form-control" name="fee" type="text" value="{{ $clients -> fee }}"></td>
                            </tr>
                            <tr>
                                <td>Fee (Non-rupiah)</td>
                                <td><input class="form-control" name="feenonrupiah" type="text" value="{{ $clients -> feenonrupiah }}"></td>
                            </tr>
                            
                            <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
                            <script src="https://cdn.rawgit.com/harvesthq/chosen/gh-pages/chosen.jquery.min.js"></script>
                            <link href="https://cdn.rawgit.com/harvesthq/chosen/gh-pages/chosen.min.css" rel="stylesheet"/>
                            <script>
                                $(".chosen-select").chosen({
                                  no_results_text: "Oops, nothing found!"
                                })
                            </script>
                            <tr>
                                <td>Group</td>
                                 <td><select name="groups[]" id="groups" class="form-control chosen-select" multiple>
                                        @foreach ($groups as $group)
                                        @if(in_array($group->id, $client_groups))
                                            <option value="{{$group->id}}" selected>{{$group->name}}</option>
                                            @else
                                            <option value="{{$group->id}}">{{$group->name}}</option>
                                            @endif
                                        @endforeach
                                        </select>
                                </td>
                            </tr>
                            </tbody>

                        </table>
                        
                        <a class="btn btn-outline-primary" style="margin-right: 5px;" href="{{ url()->previous() }}">
                            
                            <i class="fas fa-backward"></i> Back
                        </a>
                        
                        <button type="submit" class="btn btn-primary" style="margin-right: 5px;" href="{{ URL::to('/administration/timereport/'.$clients->id.'/editclient') }}">
                            <i class="fas fa-user-edit"></i> Update
                        </button>
                        </form>
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

