@extends('layouts.app')
@section('title', 'Input Time Report - Summary')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>

@section('content')
    <style>
        label {
            font-size: 0.8em;
        }
        .nav-tabs .nav-item .nav-link{
            color: black; !important;
            margin: 1px;
        }
        .nav-tabs .nav-item .nav-link:active{
            color: black; !important;
            border: 1px solid #e8e8e8; !important;

        }
        .nav-tabs .nav-item .nav-link:hover{
            color: black; !important;
            border: 1px solid #e8e8e8; !important;
            border-bottom: 0; !important;
            margin: 0;
        }
        .nav-tabs .nav-item .nav-link:active{
            border: 1px solid #e8e8e8; !important;
            border-bottom: 0; !important;
            margin: 0;
        }
        .nav-tabs .nav-item .nav-link:focus{
            border: 1px solid #e8e8e8; !important;
            border-bottom: 0; !important;
            margin: 0;
        }
        .nav-tabs .nav-item:hover{
            color: black; !important;
        }
        .nav-tabs .nav-item .nav-link:focus{
            color: black; !important;
        }
        .nav-tabs .nav-item:active{
            color: black; !important;
        }

        .form-control:disabled, .form-control[readonly] {
            background-color: var(--light) !important;
            opacity: 1;
            border-radius: 5px;
            border: none;
        }

        form .card {
            border-width: 0 1px 1px 1px;
            border-radius: 0 0 5px 5px;
        }

        /*.maingroup{*/
        /*border: 0.5px solid #77cd44;*/
        /*}*/
        /*.clientgroup{*/
        /*border: 0.5px solid #43bacf;*/
        /*}*/
        /*.timegroup{*/
        /*border: 0.5px solid #eba121;*/
        /*}*/

        .overviewgroup label {
            border-bottom: 2px solid #f75b3f;
        }

        .maingroup label {
            border-bottom: 2px solid #77cd44;
        }

        .clientgroup label {
            border-bottom: 2px solid #43bacf;
        }

        .timegroup label {
            border-bottom: 2px solid #eba121;
        }

        .nav-link {
            color: black;
        }
        option:hover {
            cursor: pointer;
        }
        .smaller-font table td{
            font-size: 0.8em;
        }
        .smaller-font table th{
            font-size: 0.8em;
        }


    </style>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">

                    <div class="card-header card-header-success card-header-icon">
                        <div class="card-icon">
                            <i class="material-icons">store</i>
                        </div>
                        <h3 class="card-title">Summary</h3>
                    </div>
                    <div class="card-body">
                        <form action="{{ \Illuminate\Support\Facades\URL::to('/inserttimereport/') }}" method="POST">
                            {{ csrf_field() }}
                            @csrf

                            <ul style="font-size: 0.8em;" class="nav nav-tabs" id="myTab" role="tablist">
                                <li style="color: black; !important;" class="nav-item">
                                    <a class="overviewlink nav-link active" id="overview-tab" data-toggle="tab"
                                       href="#overview" role="tab" aria-controls="overview" aria-selected="true">Overview</a>
                                </li>
                                <li style="color: black; !important;" class="nav-item">
                                    <a class="mainlink nav-link" id="home-tab" data-toggle="tab" href="#home" role="tab"
                                       aria-controls="home" aria-selected="false">Main</a>
                                </li>
                                @if(isset($clients))
                                    <li style="color: black; !important;" class="nav-item">
                                        <a class="clientlink nav-link" id="profile-tab" data-toggle="tab" href="#profile"
                                           role="tab" aria-controls="profile" aria-selected="false">Client</a>
                                    </li>
                                @endif
                                <li style="color: black; !important;" class="nav-item">
                                    <a class="itemlink nav-link" id="contact-tab" data-toggle="tab" href="#contact"
                                       role="tab" aria-controls="contact" aria-selected="false">Time</a>
                                </li>
                            </ul>
                            <div class="tab-content" id="myTabContent">
                                <div class="tab-pane fade show active" id="overview" role="tabpanel"
                                     aria-labelledby="overview-tab">
                                    <div class="card overviewgroup" style="margin-top: 0;">

                                        <div class="card-body">
                                            <div class="form-row">
                                                <div class="form-group col-md-6">
                                                    <label for="name">{{ __('Name') }}</label>
                                                    <input type="text" disabled name="name" id="name"
                                                           class="form-control{{ $errors->has('date') ? ' is-invalid' : '' }}"
                                                           value="{{ \Illuminate\Support\Facades\Auth::user()->name }}">
                                                </div>
                                                <div class="form-group col-md-6">
                                                    <label for="task">{{ __('Task') }}</label>
                                                    <input type="text" disabled
                                                           class="form-control{{ $errors->has('task') ? ' is-invalid' : '' }}"
                                                           value="{{ ucwords(strtolower($task->taskname)) }}">
                                                    <input type="text" hidden name="task" id="task"
                                                            value="{{ $task->id }}">

                                                </div>
                                            </div>
                                            <div class="form-row">
                                                <div class="form-group col-md-6">
                                                    <label for="week">{{ __('Week') }}</label>
                                                    <input type="text" disabled
                                                           class="form-control"
                                                           value="Week {{ $week }}">
                                                    <input type="text" hidden id="week" name="week"
                                                           class="form-control"
                                                           value="{{ $week }}">
                                                </div>

                                                <div class="form-group col-md-6">
                                                    <label for="date">{{ __('Date') }}</label>
                                                    <input type="text" disabled
                                                           class="form-control"
                                                           value="{{ date('F d, Y', strtotime($request->date)) }}">
                                                    <input type="text" name="date" id="date" hidden
                                                           value="{{ date('F d, Y', strtotime($request->date)) }}">

                                                </div>

                                            </div>
                                            @if (isset($clients))
                                            <div class="form-row">
                                                <div class="form-group col-md-6">
                                                    <label for="client">{{ __('Client') }}</label>
                                                    <input type="text" disabled
                                                           class="form-control"
                                                           value="{{ $clientname }}">
                                                    <input type="text" hidden id="id" name="id"
                                                           class="form-control"
                                                           value="{{ $clients->id }}">

                                                </div>
                                                <div class="form-group col-md-6">
                                                    <label for="total">{{ __('Total Hour(s)') }}</label>
                                                    <input type="text" disabled
                                                           class="form-control" value="{{ $totalhours }}">
                                                </div>
                                            </div>
                                            @endif


                                        </div>
                                    </div>
                                </div>
                                <div class="tab-pane fade" id="home" role="tabpanel" aria-labelledby="home-tab">
                                    <div class="card maingroup" style="margin-top: 0;">

                                        <div class="card-body">
                                            <div class="form-row">
                                                <div class="form-group col-md-6">
                                                    <label for="week">{{ __('Week') }}</label>
                                                    <input id="week" type="text" disabled
                                                           class="form-control"
                                                           name="week" value="Week {{ $request->week }}">
                                                    <input id="week" type="text" hidden
                                                           class="form-control"
                                                           name="week" value="{{ $request->week }}">
                                                </div>

                                            </div>
                                            <div class="form-row">
                                                <div class="form-group col-md-6">
                                                    <label for="date">{{ __('Date') }}</label>
                                                    <input type="text" disabled
                                                           class="form-control"
                                                           value="{{ date('d F, Y', strtotime($request->date)) }}">
                                                    <input hidden id="date" type="text" disabled
                                                           name="date"
                                                           value="{{ $request->date }}">

                                                </div>
                                                <div class="form-group col-md-6">
                                                    <label for="day">{{ __('Day') }}</label>
                                                    <input type="text"
                                                           value="{{ date('l', strtotime($request->date)) }}"
                                                           class="form-control"
                                                           disabled>
                                                    <input hidden id="day" type="text"
                                                           value="{{ date('l', strtotime($request->date)) }}"
                                                           name="day">
                                                </div>

                                            </div>
                                            <div class="form-row">
                                                <div class="form-group col-md-12">
                                                    <label for="description">{{ __('Description') }}</label>
                                                    <textarea id="description" disabled
                                                              class="form-control"
                                                              name="description">{{ $request->description }}
                                                    </textarea>
                                                    <textarea id="description" hidden
                                                              class="form-control"
                                                              name="description">{{ $request->description }}
                                                    </textarea>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @if (isset($clients))
                                <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                                    <div class="card clientgroup" style="margin-top: 0;">
                                        <div class="card-body">
                                            <div class="form-row">
                                                <div class="form-group col-md-6">
                                                    <label for="client">{{ __('Client') }}</label>
                                                    <input id="client" type="text" disabled
                                                           class="form-control"
                                                           name="client" value="{{ $clientname }}">
                                                    <input id="client" type="text" hidden
                                                           class="form-control"
                                                           name="client" value="{{ $clientname }}">

                                                </div>
                                            </div>
                                            <div class="form-row">
                                                <div class="form-group col-md-4">
                                                    <label for="period">{{ __('Engagement Period') }}</label>
                                                    <input type="text" disabled
                                                           class="form-control"
                                                           value="{{ date('Y', strtotime($clients->engagementperiod)) }}">
                                                    <input hidden id="period" type="text"
                                                           name="period"
                                                           value="{{ $clients->engagementperiod }}">
                                                </div>
                                                <div class="form-group col-md-4">
                                                    <label for="type">{{ __('Type') }}</label>
                                                    <input id="type" type="text" disabled
                                                           class="form-control"
                                                           name="type" value="{{ $clients->engagementtype }}">
                                                    <input id="type" type="text" hidden
                                                           class="form-control"
                                                           name="type" value="{{ $clients->engagementtype }}">
                                                </div>
                                                <div class="form-group col-md-4">
                                                    <label for="location">{{ __('Location') }}</label>
                                                    <input id="location" type="text" disabled
                                                           class="form-control"
                                                           name="location" value="{{ $clients->location }}">
                                                    <input id="location" type="text" hidden
                                                           class="form-control"
                                                           name="location" value="{{ $clients->location }}">
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                                @endif
                                <div class="tab-pane fade" id="contact" role="tabpanel" aria-labelledby="contact-tab">
                                    <div class="card timegroup" style="margin-top: 0;">
                                        <div class="card-body">
                                            <div class="form-row">
                                                <div class="form-group col-md-6">
                                                    <label for="regular">{{ __('Regular Hours') }}</label>

                                                    <input @if($regularaccumulation <= 8) @else style="color:red; font-weight: bold;" @endif id="regular" type="text" disabled
                                                           class="form-control"
                                                           name="regular" value="{{ $regularaccumulation }}">
                                                    <input id="regular" type="text" hidden
                                                           class="form-control"
                                                           name="regular" value="{{ $request->regular }}">
                                                    <input id="overtime" type="text" hidden
                                                           class="form-control"
                                                           name="inputregular" value="{{ $request->regular }}">
                                                </div>
                                                <div class="form-group col-md-6">
                                                    <label for="overtime">{{ __('Overtime Hours') }}</label>
                                                    <input id="overtime" type="text" disabled
                                                           class="form-control"
                                                           name="overtime" value="{{ $overtimeaccumulation }}">
                                                    <input id="overtime" type="text" hidden
                                                           class="form-control"
                                                           name="overtime" value="{{ $overtimeaccumulation }}">
                                                    <input id="overtime" type="text" hidden
                                                           class="form-control"
                                                           name="inputovertime" value="{{ $request->overtime }}">
                                                </div>

                                                {{--<div class="form-group col-md-4">--}}
                                                    {{--<label for="overbudget">{{ __('Overbudget H*') }}</label>--}}
                                                    {{--<input id="overbudget" type="text" disabled--}}
                                                           {{--class="form-control"--}}
                                                           {{--name="overbudget" value="{{ $overbudgetaccumulation }}">--}}
                                                    {{--<input id="overbudget" type="text" hidden--}}
                                                           {{--class="form-control"--}}
                                                           {{--name="overbudget" value="{{ $request->overbudget }}">--}}
                                                    {{--<input id="overtime" type="text" hidden--}}
                                                           {{--class="form-control"--}}
                                                           {{--name="inputoverbudget" value="{{ $request->overbudget }}">--}}
                                                {{--</div>--}}


                                            </div>
                                            <div style="display:none" class="form-row">
                                                <div class="form-group col-md-6">
                                                    <label for="startTime">{{ __('Start Time') }}</label>
                                                    <input id="startTime" type="text" hidden
                                                           class="form-control"
                                                           name="startTime" value="{{ $request->startTime }}">
                                                </div>
                                                <div class="form-group col-md-6">
                                                    <label for="finishTime">{{ __('Finish Time') }}</label>
                                                    <input id="finishTime" type="text" hidden
                                                           class="form-control"
                                                           name="finishTime" value="{{ $request->finishTime }}">
                                                </div>

                                            </div>
                                            <div class="form-row">
                                                
                                                <div class="form-group col-md-6">
                                                    <label for="totalhour">{{ __('Total Hour(s)') }}</label>
                                                    <input type="text" disabled
                                                           class="form-control"
                                                           value="{{ $totalhours }}">
                                                    <input id="totalhour" type="text" hidden
                                                           class="form-control"
                                                           name="totalhour" value="{{ $totalhours }}">
                                                    <input id="lampiran" type="text" hidden
                                                           class="form-control"
                                                           name="lampiran" value="{{ $filepath }}">
                                                </div>
                                            </div>
                                            <div class="form-row">
                                                <div class="form-group col-md-6">
                                                    <label for="overtimemeal">{{ __('Overtime Meal') }}</label>
                                                    <input type="text" disabled
                                                           class="form-control"
                                                           value="Rp. {{ $overtimemeal }}">
                                                    <input hidden id="overtimemeal" type="text"
                                                           name="overtimemeal" value="{{ $overtimemeal }}">

                                                </div>
                                                <div class="form-group col-md-6">
                                                    <label for="overtimetransportation">{{ __('Overtime Transportation') }}</label>
                                                    <input type="text" disabled class="form-control"
                                                           value="Rp. {{ $overtimetransportation }}">

                                                    <input type="text" hidden name="overtimetransportation" id="overtimetransportation" class="form-control"
                                                           value="{{ $overtimetransportation }}">

                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @if($regularaccumulation <= 8) @else
                                <div class="alert alert-danger" role="alert">
                                        <strong>Jam kerja reguler sudah melebihi 8 jam</strong>
                                </div>
                            @endif
                            @if($duration > 0) @else
                                <div class="alert alert-danger" role="alert">
                                        <strong>Durasi tidak boleh kosong, jam mulai harus lebih kecil dibanding jam selesai</strong>
                                </div>
                            @endif
                            <div style="float: right;">
                                <a href="{{ URL('/input/timereport') }}" class="btn btn-outline-secondary"><i class="fas fa-angle-double-left"></i>
                                    Back </a>
                                @if($regularaccumulation <= 8 && $duration > 0)
                                    <button type="submit" class="btn btn-success"><i class="fas fa-file-upload"></i> Submit</button>@else
                                    @endif
                            </div>
                    <script>
                    $.getJSON('https://geolocation-db.com/json/')
         .done (function(location) {
            $('#latitude').val(location.latitude);
            $('#longitude').val(location.longitude);
            $('#ip').val(location.IPv4);
         });
                    
                    </script>
                
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-md-3">

                <div class="card">
                    <div class="card-header">
                        Engagement Type
                    </div>

                    <div class="card-body smaller-font">
                        <table class="table table-hover">
                            <thead>
                            <tr>
                                <th>Code</th>
                                <th>Name</th>
                            </tr>
                            </thead>
                            <tbody>
                            @if(Auth::user()->logintype === 'professionalaccounting')
                                <tr>
                                    <td>A-001</td>
                                    <td>Accounting Services - Monthly</td>
                                </tr>
                                <tr>

                                    <td>A-002</td>
                                    <td>Accounting Services - Project</td>
                                </tr>
                                <tr>
                                    <td>A-003</td>
                                    <td>Accounting Services - Review</td>
                                </tr>
                            @else
                            @endif
                            @if(Auth::user()->logintype === 'professionaltax')
                                <tr>
                                    <td>T-001</td>
                                    <td>Tax Services - Monthly</td>
                                </tr>
                                <tr>
                                    <td>T-002</td>
                                    <td>Tax Services - Yearly</td>
                                </tr>
                                <tr>
                                    <td>T-003</td>
                                    <td>Tax Services - Personal Tax</td>
                                </tr>
                                <tr>
                                    <td>T-004</td>
                                    <td>Tax Services - TP Documentation</td>
                                </tr>
                                <tr>
                                    <td>T-005</td>
                                    <td>Tax Services - Tax Audit</td>
                                </tr>
                                <tr>
                                    <td>T-006</td>
                                    <td>Tax Services - Tax Consultation</td>
                                </tr>
                                <tr>
                                    <td>T-099</td>
                                    <td>Tax Servixes - Others</td>
                                </tr>
                                <tr>
                                    <td>L-001</td>
                                    <td>Legal Services</td>
                                </tr>
                                <tr>
                                    <td>O-001</td>
                                    <td>Other Services</td>
                                </tr>
                            @else
                            @endif
                            @if(Auth::user()->logintype === 'professionalaudit')
                                <tr>
                                    <td>M-001</td>
                                    <td>General Audit</td>
                                </tr>
                                <tr>
                                    <td>M-002</td>
                                    <td>Special Audit</td>
                                </tr>
                                <tr>
                                    <td>M-099</td>
                                    <td>Others</td>
                                </tr>
                            @else
                            @endif

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

        </div>
    </div>
    <script>
        $('#clientselect').on('change', function () {
            $('#period')
                .val(
                    $(this).find(':selected').data('period')
                );
            $('#type')
                .val(
                    $(this).find(':selected').data('type')
                );
            $('#location')
                .val(
                    $(this).find(':selected').data('location')
                );
        });


        $(function updatetotal() {
            $('#regular, #overtime, #overbudget').keyup(function update() {
                var regular = parseFloat($('#regular').val()) || 0;
                var overtime = parseFloat($('#overtime').val()) || 0;
                var overbudget = parseFloat($('#overbudget').val()) || 0;

                $('#total').val(regular + overtime - overbudget);
            });
        });

    </script>
@endsection
