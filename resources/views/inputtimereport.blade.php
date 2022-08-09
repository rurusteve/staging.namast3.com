@extends('layouts.app')
@section('title', 'Input Time Report - Form')

<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/chosen/1.5.1/chosen.min.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/chosen/1.5.1/chosen.jquery.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>

<style>
    label {
        font-size: 0.8em;
    }

    .ui-datepicker-calendar {
        display: inline-table;
    }

    .ui-datepicker-month {
        display: inline-flex;
    }

    .ui-datepicker-year {
        display: none;
    }

    .ui-datepicker-next,
    .ui-datepicker-prev {
        /*display: none;*/
    }

    .chosen-container-single .chosen-single {
        background: none;
    }

    #task:hover {
        cursor: pointer;
    }

    option:hover {
        cursor: pointer;
    }

    .smaller-font table td {
        font-size: 0.8em;
    }

    .smaller-font table th {
        font-size: 0.8em;
    }

    .ui-datepicker-week-end a {
        color: red !important;
    }
</style>
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">


                <div class="card-header card-header-warning card-header-icon">
                    <div class="card-icon">
                        <i style="font-size: 1.5em;" class="fas fa-file-alt"></i>
                    </div>
                    <h3 class="card-title">Input Time Report</h3>
                </div>
                <div class="card-body">
                    @if (session('success-alert'))
                    <div class="alert alert-success">
                        {{ session('success-alert') }}
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <i class="material-icons">close</i>
                        </button>
                    </div>
                    @endif
                    @if (session('error-alert'))
                    <div class="alert alert-danger">
                        {{ session('error-alert') }}
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <i class="material-icons">close</i>
                        </button>
                    </div>
                    @endif
                    <form enctype="multipart/form-data" action="{{ \Illuminate\Support\Facades\URL::to('/inputtimereport/process') }}" method="POST">
                        {{ csrf_field() }}
                        @csrf

                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="name">{{ __('Name') }}</label>
                                <input id="name" type="text" disabled class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" value="{{ \Illuminate\Support\Facades\Auth::user()->name }}" required>

                                @if ($errors->has('name'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('name') }}</strong>
                                </span>
                                @endif
                            </div>
                            {{--<div class="form-group col-md-4">--}}
                            {{--<label for="month">{{ __('Month') }}</label>--}}
                            {{--<input type="text"--}}
                            {{--class="form-control"--}}
                            {{--value="{{ date('F', strtotime($thismonthshow)) }}" disabled="">--}}
                            {{--<input id="month" type="text"--}}
                            {{--class="form-control"--}}
                            {{--name="month" value="{{ $thismonth }}" hidden="">--}}
                            {{--</div>--}}
                            <div class="form-group col-md-6">
                                <label for="task">{{ __('Task') }}</label>
                                <select style="background: none; height: calc(2.25rem + 2px); width: 100%; font-size: 1rem" id="task" required class="custom-select" name="task">
                                    <option value="{{ old('task') }}" selected disabled>Choose task
                                    </option>

                                    @foreach($tasks as $task)
                                    <option value="{{$task->id}}">{{ucwords(strtolower($task->taskname))}}</option>

                                    @endforeach

                                </select>
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-group col-md-8">
                                <label for="clientselect">{{ __('Client') }}
                                    {{--<span style="color: red;"> [Required]</span>--}}
                                </label>
                                <select style="background: none; height: calc(2.25rem + 2px); width: 100%; font-size: 1rem" id="clientselect" class="chosen form-control{{ $errors->has('clientselect') ? ' is-invalid' : '' }}" name="clientselect">
                                    <option value="{{ old('clientselect') }}" selected disabled>Which Client?
                                    </option>
                                    <option value="999">
                                        Others
                                    </option>
                                    @foreach($clients as $client)
                                    <option data-location="{{ $client->location }}" data-type="{{ $client->engagementtype }}" data-period="{{ Carbon\Carbon::parse($client->engagementperiod)->format('Y') }}" value="{{$client->id}}">ID:{{$client->id}} {{$client->clientname}}
                                        , {{$client->clientcode}}
                                        @if($client -> engagementperiodstart === '0001-01-01' || $client -> engagementperiodstart === '0000-00-00' || $client -> engagementperiodstart === 'null')
                                        @else
                                        , &#126; {{ date('d M Y', strtotime($client -> engagementperiodstart)) }}
                                        @endif
                                        , {{ date('d M Y', strtotime($client -> engagementperiod)) }}
                                        , {{ $client -> engagementtype }}
                                        @if($client -> keterangan !== null)
                                        # {{ $client -> keterangan }}
                                        @else
                                        @endif
                                    </option>
                                    @endforeach
                                </select>
                                @if ($errors->has('clientselect'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('clientselect') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>
                        <script type="text/javascript">
                            $(".chosen").chosen();
                        </script>
                    
                        <div class="form-row">
                        
                            <div class="form-group col-md-6">
                                <label for="date">{{ __('Date') }}</label>
                                <input id="datepicker" type="text" value="{{ old('date') }}" class="form-control{{ $errors->has('date') ? ' is-invalid' : '' }}" name="date" placeholder="format: mm/dd/yyyy" required>


                                @if ($errors->has('date'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('date') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>
                        <label>Type</label>
                        <div class="form-row">
                        <div class="form-check form-check-radio">
                                <label class="form-check-label">
                                    <input class="form-check-input" type="radio" name="timeType" id="timeTypeRegular" value="REGULAR_HOUR" checked>
                                    Regular Hour
                                    <span class="circle">
                                        <span class="check"></span>
                                    </span>
                                </label>
                            </div>
                            @if($employee->lembur == 'Y')
                            <div class="form-check form-check-radio">
                                <label class="form-check-label">
                                    <input onclick="setOvertimeLimit()" class="form-check-input" type="radio" name="timeType" id="timeTypeOvertime" value="OVERTIME_HOUR">
                                    Overtime Hour
                                    <span class="circle">
                                        <span class="check"></span>
                                    </span>
                                </label>
                            </div>
                            @else
                            @endif
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="startTime">{{ __('Start Time') }}</label>
                                <input id="startTime" type="text" class="datetimepicker form-control{{ $errors->has('startTime') ? ' is-invalid' : '' }}" name="startTime" value="{{ old('startTime') }}" placeholder="--:--" required>

                                @if ($errors->has('regular'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('regular') }}</strong>
                                </span>
                                @endif
                            </div>

                            <div class="form-group col-md-6">
                                <label for="finishTime">{{ __('End Time') }}</label>
                                <input id="finishTime" type="text" class="datetimepicker form-control{{ $errors->has('finishTime') ? ' is-invalid' : '' }}" name="finishTime" value="{{ old('finishTime') }}" placeholder="--:--" required>
                                @if ($errors->has('regular'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('regular') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-group col-md-12">
                                <label for="description">{{ __('Description') }}</label>
                                <textarea id="description" class="form-control{{ $errors->has('description') ? ' is-invalid' : '' }}" name="description" placeholder="Your description.."></textarea>
                                @if ($errors->has('description'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('description') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>
                         <div class="form-row">
                            <div class="form-group" style="margin-left: 5px;">
                            <label for="lampiran">{{ __('Lampiran') }}</label>
                            <div class="custom-file text-left">
                                <input type="file" name="lampiran" style="position: relative" class="form-control{{ $errors->has('lampiran') ? ' is-invalid' : '' }} custom-file-input" id="lampiran"  onchange="updateLampiran()">
                                <label class="custom-file-label" for="lampiran">
                                    <div style="font-size: 0.7em" id='labelLampiran'></div>
                                </label>
                            </div>
                        </div>
                   

                        <script>
                            updateLampiran = function() {
                                var input = document.getElementById('lampiran');
                                var output = document.getElementById('labelLampiran');

                                for (var i = 0; i < input.files.length; ++i) {
                                    output.innerHTML = input.files.item(i).name;
                                }
                            }
                        </script>
                        </div>
                        
                        <input hidden id="userid" type="text" class="form-control{{ $errors->has('userid') ? ' is-invalid' : '' }}" name="userid" value="{{ Auth::id() }}">

                        <div style="float: right;">
                            <a href="{{ url('/timesheets/main') }}" class="btn btn-outline-secondary"><i class="fas fa-user-clock"></i> Time Sheets </a>
                            <button type="submit" class="btn btn-success"><i class="fas fa-forward"></i> Process
                            </button>
                        </div>

                    </form>
                </div>
            </div>
        </div>
        <div class="col-md-4">


            <div style="color: #969696;" class="card">

                <div class="card-header card-header-warning card-header-icon">
                    <div class="card-icon">
                        <i style="font-size: 1.5em;" class="fas fa-file-alt"></i>
                    </div>
                    <h5 class="card-title">Export Time Report</h5>
                    <form method="post" action="{{ route('time-report.bulk-edit.templateExport') }}">
                        @csrf
                        @method('post')
                        <button type="submit" style=" margin: 0;
  padding: 0;
  border: none;
  color: blue;
  background-color: transparent;
  text-decoration: underline;
  cursor: pointer;">Download Template</button>
                    </form>
                </div>

                <div class="card-body smaller-font">

                    <form action="{{ route('time-report.bulk-edit.export') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <select name="period" id="period" class="form-control{{ $errors->has('periode') ? ' is-invalid' : '' }}">
                            {{$now = Carbon\Carbon::now()}}
                            {{$i=0}}

                            @while($i < $now->month )
                                {{$i++}}
                                <option value="{{$i}}">{{date('F', mktime(0, 0, 0, $i, 10))}}</option>
                                @endwhile

                        </select>
                        <button class="btn btn-primary">Export</button>

                    </form>

                </div>
            </div>
            <div style="color: #969696;" class="card">

                <div class="card-header card-header-warning card-header-icon">
                    <div class="card-icon">
                        <i style="font-size: 1.5em;" class="fas fa-file-alt"></i>
                    </div>
                    <h5 class="card-title">Upload Time Report</h5>
                </div>

                <div class="card-body smaller-font">
                    <form action="{{ route('time-report-import') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <select name="period" id="period" class="form-control{{ $errors->has('periode') ? ' is-invalid' : '' }}">
                            {{$now = Carbon\Carbon::now()}}
                            {{$i=0}}

                            @while($i < $now->month )
                                {{$i++}}
                                <option value="{{$i}}" @foreach ($statuses as $status) @if ($status->period == $i && $status->is_report_locked)
                                    disabled
                                    @endif
                                    @endforeach>{{date('F', mktime(0, 0, 0, $i, 10))}}

                                </option>
                                @endwhile

                        </select>
                        <div class="form-group" style="max-width: 500px; margin: 0 auto;">
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
            <div style="color: #969696;" class="card">
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
                            <tr>
                                <td colspan="2">Empty</td>
                            </tr>
                            @endif

                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </div>
    <div class="row justify-content-center">

        <div class="col-md-4">

        </div>
        <div class="col-md-4">

        </div>

    </div>


</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-datetimepicker/2.5.20/jquery.datetimepicker.full.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-datetimepicker/2.5.20/jquery.datetimepicker.css" />
<script>
    var logic = function( currentDateTime ){
    // 'this' is jquery object datetimepicker
   
        var radio = $('input[name="timeType"]:checked').val();
        if(radio === 'REGULAR_HOUR'){
        }
        if(radio === 'OVERTIME_HOUR'){
        }
    };

    $('.datetimepicker').datetimepicker({
        step: 15,
        datepicker: false,
        format: 'H:i',
        mask: true,
        onChangeDateTime:logic,
        onShow:logic
    });

    $('#clientselect').on('change', function() {
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
            var overbudget = parseFloat($('#overbudget').val()) || 0;

            $('#total').val(regular + overtime - overbudget);
        });
    });
    $(function() {
        $('#datepicker').datepicker({
            showButtonPanel: false,
            dateFormat: 'mm/dd/yy',
            todayBtn: "linked",
            todayHighlight: true,
            orientation: "left",
            autoclose: true,

        });
        // $(".date-picker-year").focus(function () {
        //     $(".ui-datepicker-month").hide();
        // });
    });
</script>
<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<link rel="stylesheet" href="/resources/demos/style.css">
<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

<style type="text/css">
    .chosen-container-active.chosen-with-drop .chosen-single {
        background: none !important;
    }

    .chosen-single {
        background-color: white;
        background-image: none;
        background: none;
    }
</style>
@endsection
@section('ending')
<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<link rel="stylesheet" href="/resources/demos/style.css">
<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/chosen/1.5.1/chosen.min.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/chosen/1.5.1/chosen.jquery.min.js"></script>
@endsection