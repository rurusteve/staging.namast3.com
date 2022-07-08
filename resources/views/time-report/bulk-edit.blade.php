@extends('layouts.app')
@section('title', 'Input Time Report - Form')

<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/chosen/1.5.1/chosen.min.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/chosen/1.5.1/chosen.jquery.min.js"></script>
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

    .ui-datepicker-next, .ui-datepicker-prev {
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
    .smaller-font table td{
        font-size: 0.8em;
    }
    .smaller-font table th{
        font-size: 0.8em;
    }
    .ui-datepicker-week-end a {
        color: red !important;
    }
</style>
@section('content')
    <div class="container">
        <div class="row justify-content-center">

            <div class="col-md-6">
                <div style="color: #969696;" class="card">

                    <div class="card-header card-header-warning card-header-icon">
                        <div class="card-icon">
                            <i style="font-size: 1.5em;" class="fas fa-file-alt"></i>
                        </div>
                        <h3 class="card-title">Export Time Report</h3>
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
                            <button class="btn btn-primary">Export Report</button>

                        </form>

                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div style="color: #969696;" class="card">

                    <div class="card-header card-header-warning card-header-icon">
                        <div class="card-icon">
                            <i style="font-size: 1.5em;" class="fas fa-file-alt"></i>
                        </div>
                        <h3 class="card-title">Upload Time Report</h3>
                    </div>

                    <div class="card-body smaller-font">
                         <form action="{{ route('time-report-import') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group mb-4" style="max-width: 500px; margin: 0 auto;">
                                <div class="custom-file text-left">
                                    <input type="file" name="file" class="custom-file-input" id="customFile">
                                    <label class="custom-file-label" for="customFile">Choose file</label>
                                </div>
                            </div>
                            <button class="btn btn-primary">Import data</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="row justify-content-center">

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
                var overbudget = parseFloat($('#overbudget').val()) || 0;

                $('#total').val(regular + overtime - overbudget);
            });
        });
        $(function () {
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
