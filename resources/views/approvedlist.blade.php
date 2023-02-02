@extends('layouts.app')

@section('title', 'Approved List')

@section('heads')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css">
    <script src="https://static.codepen.io/assets/common/stopExecutionOnTimeout-de7e2ef6bfefd24b79a3f68b414b87b8db5b08439cac3f1012092b2290c719cd.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
    <script src="https://cdn.datatables.net/plug-ins/f2c75b7247b/integration/bootstrap/3/dataTables.bootstrap.js"></script>
    <script src="https://cdn.datatables.net/responsive/1.0.4/js/dataTables.responsive.js"></script>
    <script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
@endsection

@section('content')
    <style>
        .btn {
            font-size: .75rem !important;
        }

        .box {
            padding: 10px;
            border: 1px solid grey;
            margin-bottom: 4%;
        }

        .bold {
            font-weight: bold;
            text-align: right;
        }
        ul{
            list-style: none;
            padding-inline-start: 0px;
        }
        li span:nth-child(1){
            width: 30%;
            font-weight: bold;
        }
        .dtr-details li{
            display: flex;
            border-bottom: 0.5px solid lightgrey;
            line-height: 2em;
        }
        td:nth-child(1):hover{
            cursor: pointer;
        }

    </style>
    <div class="container">
        <div class="row justify-content-center">


            <div class="col-md-8">

                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                <div class="card">
                    <div class="card-header card-header-primary">
                        <h6 class="card-title">Leave List</h6>
                        <p class="card-category">Approved & Rejected On-Leave List</p>
                    </div>

                    <div class="card-body">
                        <form method="GET" action="{{ url('/cuti/list') }}">
                            @csrf
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="alert alert-danger print-error-msg" style="display:none">
                                        <ul></ul>
                                    </div>


                                    <div class="alert alert-success print-success-msg" style="display:none">
                                        <ul></ul>
                                    </div>
                                    <div>
                                        <table role="table" width="100%"
                                               class="table table-responsive-md table-bordered"
                                               id="dynamic_field">

                                            <thead role="rowgroup">

                                            </thead>

                                            <tbody role="rowgroup">
                                            <script type="text/javascript"
                                                    src="//cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
                                            <link rel="stylesheet" type="text/css"
                                                  href="//cdn.jsdelivr.net/bootstrap/latest/css/bootstrap.css"/>

                                            <!-- Include Date Range Picker -->
                                            <script type="text/javascript"
                                                    src="//cdn.jsdelivr.net/bootstrap.daterangepicker/2/daterangepicker.js"></script>
                                            <link rel="stylesheet" type="text/css"
                                                  href="//cdn.jsdelivr.net/bootstrap.daterangepicker/2/daterangepicker.css"/>

                                            </tbody>

                                        </table>


                                    </div>
                                </div>

                            </div>

                        </form>


                        <table style=" display: block; width: 100%; overflow-x: auto;font-size: 12px;"
                               class="table table-responsive-md table-striped display"
                               id="example">
                            @if (session('success'))
                                <div class="alert alert-success">
                                    {{ session('success') }}
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <i class="material-icons">close</i>
                                    </button>
                                </div>
                            @endif
                            <p>Click the number to expand data</p>
                            <thead>
                            <tr>

                                <th data-priority="0">#</th>
                                <th data-priority="1">Name</th>
                                <th>Qty.</th>
                                <th data-priority="2">Status</th>
                                <th data-priority="3">Date</th>
                                <th data-priority="7">Req. Date</th>
                                <th data-priority="8">Month</th>
                                <th data-priority="9">Leave Days</th>
                                <th>Group</th>
                                <th data-priority="10">Institution</th>
                                <th data-priority="11">City</th>
                                {{--<th data-priority="6">Incharge</th>--}}
                                {{--<th>Division</th>--}}
                                <th style="padding-right: 170px !important;">Type</th>
                                <th style="padding-right: 150px !important;">Note</th>
                                <th >Ket. Manager / Incharge</th>
                                <th >Ket. HRD</th>
                                <th >Ket. Partner</th>
                                @if(Auth::user()->admin == 2 && Auth::user()->division == 'HRD')
                                <th data-priority="5">Det.</th>
                                @else
                                    @endif
                                <th data-priority="4">Del.</th>
                                @if(Auth::user()->division == 'HRD' || Auth::user()->division == 'PARTNER')
                                    <th>Opt.</th>
                                    @endif
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($approvedlists as $approvedlist)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ucwords(strtolower($approvedlist->nama))}}</td>
                                    <td>
                                        <a href="{{ url('/cuti/list/'.$approvedlist->nip) }}"><i
                                                    class="fas fa-search-plus"></i></a></td>
                                    @if($approvedlist->statuscuti == "approved")
                                        <td style="color: green;">Approved</td>
                                    @elseif($approvedlist->statuscuti == "declined")
                                        <td style="color: red;">Declined</td>
                                        @else
                                        <td style="color: blue;">Waiting</td>
                                    @endif

                                    <td>{{ date('d M', strtotime($approvedlist->tanggalmulaicuti)) }} -
                                        {{ date('d M', strtotime($approvedlist->tanggalakhircuti)) }}</td>
                                    <td>{{ date('d M', strtotime($approvedlist->created_at)) }}</td>
                                    <td>{{date("F", strtotime($approvedlist->tanggalmulaicuti)) }}</td>
                                    <td>{{$approvedlist->jumlahhari}}</td>
                                    <td>{{ucwords(strtolower($approvedlist->grup))}}</td>
                                    <td>{{$approvedlist->institusi}}</td>
                                    <td>{{ucwords(strtolower($approvedlist->kota))}}</td>
                                    {{--<td>--}}
                                        {{--@if($approvedlist->inchargestatus == 1)--}}
                                            {{--<i style="color: green;" class="fas fa-check-circle"></i>--}}
                                        {{--@else--}}
                                            {{--<i style="color: red;" class="fas fa-times-circle"></i>--}}
                                        {{--@endif--}}
                                    {{--</td>--}}
                                    {{--                                    <td>{{ucwords(strtoupper($approvedlist->divisi))}}</td>--}}
                                    @if($approvedlist->jeniscuti == 1)
                                        <div style="display:none">{{$jeniscuti = "CUTI TAHUNAN DAN WISATA"}}</div>
                                    @elseif($approvedlist->jeniscuti == 2)
                                        <div style="display:none">{{$jeniscuti = "CUTI PERKAWINAN, KELAHIRAN DAN MENIKAHKAN ANAK**"}}</div>
                                    @elseif($approvedlist->jeniscuti == 3)
                                        <div style="display:none">{{$jeniscuti = "CUTI KEGUGURAN DAN KEMATIAN**"}}</div>
                                    @elseif($approvedlist->jeniscuti == 4)
                                        <div style="display:none">{{$jeniscuti = "CUTI FORCE MAJEUR"}}</div>
                                    @elseif($approvedlist->jeniscuti == 5)
                                        <div style="display:none">{{$jeniscuti = "IJIN RESMI (KTP, SIM, STNK, PASPOR, DAN SURAT NIKAH)**"}}</div>
                                    @elseif($approvedlist->jeniscuti == 6)
                                        <div style="display:none">{{$jeniscuti = "IJIN SAKIT"}}</div>
                                    @elseif($approvedlist->jeniscuti == 7)
                                        <div style="display:none">{{$jeniscuti = "IJIN SAKIT DENGAN SURAT DOKTER*"}}</div>
                                    @elseif($approvedlist->jeniscuti == 8)
                                        <div style="display:none">{{$jeniscuti = "CUTI TIDAK DIBAYAR (MANGKIR/TIDAK ADA JATAH)"}}</div>
                                    @elseif($approvedlist->jeniscuti == 99)
                                        <div style="display:none; color: saddlebrown;">{{$jeniscuti = "CUTI NASIONAL"}}</div>
                                    @else
                                        <div style="display:none; color: saddlebrown;">{{$jeniscuti = "TIDAK DIKETAHUI"}}</div>
                                    @endif
                                    <td>{{$jeniscuti}}</td>
                                    <td>{{ucwords(strtoupper($approvedlist->keterangan))}}</td>
                                    <td>{{$approvedlist->ketbymanager}}
                                        @if($approvedlist->bymanager == 1 && $approvedlist->statuscuti === 'approved') <i style="color: green;" class="fas fa-check-circle"></i>
                                        {{ date('d M', strtotime($approvedlist->managerapprovaldate)) }}
                                        @elseif($approvedlist->bymanager == 1 && $approvedlist->statuscuti === 'declined') <i style="color: red;" class="fas fa-times-circle"></i>
                                        {{ date('d M', strtotime($approvedlist->managerapprovaldate)) }}
                                        @else
                                        @endif</td>
                                    <td>{{$approvedlist->ketbyhrd}}
                                        @if($approvedlist->byhrd == 1 && $approvedlist->statuscuti === 'approved') <i style="color: green;" class="fas fa-check-circle"></i>
                                        {{ date('d M', strtotime($approvedlist->hrdapprovaldate)) }}
                                        @elseif($approvedlist->byhrd == 1 && $approvedlist->statuscuti === 'declined') <i style="color: red;" class="fas fa-times-circle"></i>
                                        {{ date('d M', strtotime($approvedlist->hrdapprovaldate)) }}
                                        @else
                                        @endif</td>
                                    <td>{{$approvedlist->ketbypartner}}
                                        @if($approvedlist->bypartner == 1 && $approvedlist->statuscuti === 'approved') <i style="color: green;" class="fas fa-check-circle"></i>
                                        {{ date('d M', strtotime($approvedlist->partnerapprovaldate)) }}
                                        @elseif($approvedlist->bypartner == 1 && $approvedlist->statuscuti === 'declined') <i style="color: red;" class="fas fa-times-circle"></i>
                                        {{ date('d M', strtotime($approvedlist->partnerapprovaldate)) }}
                                        @else
                                        @endif</td>
                                    @if(Auth::user()->admin == 2 && Auth::user()->division == 'HRD')
                                        <td>
                                            <a href="{{ url('/detailcuti/'.$approvedlist->id) }}">Detail <i class="fas fa-envelope-open-text"></i></a>
                                        </td>
                                        @else
                                        @endif
                                    <td>
                                        <a style="color: red;" href="{{ url('cuti/list/delete/'.$approvedlist->id) }}" onclick="return confirm('Are you sure?')">Delete <i class="fa fa-trash-alt"></i></a>
                                    </td>
                                    @if(Auth::user()->division == 'HRD' || Auth::user()->division == 'PARTNER')
                                    @if($approvedlist->ketbyhrd == null || $approvedlist->ketbyhrd == '')
                                        <td>
                                            <a style="color: green;" href="{{ url('/addnote/'.$approvedlist->nip.'/'.$approvedlist->id) }}">Add Note <i class="fas fa-sticky-note"></i></a>
                                        </td>
                                    @else
                                    <td></td>
                                    @endif
                                        
                                        @else
                                        @if($approvedlist->ketbyhrd == null || $approvedlist->ketbyhrd == '')
                                        <td>
                                            <span style="color: grey;">Add Note <i class="fas fa-sticky-note"></i></span>
                                        </td>
                                    @else
                                    <td></td>
                                    @endif
                                    @endif
                                    

                                </tr>
                            @endforeach
                            </tbody>
                            <tfoot>
                            <tr>
                                <th>#</th>
                                <th>Name</th>
                                <th></th>
                                <th>Status</th>
                                <th>Date</th>
                                <th>Req. Date</th>
                                <th>Month</th>
                                <th>Leave Days</th>
                                <th>Group</th>
                                <th>Institution</th>
                                <th>City</th>
                                {{--<th>Incharge</th>--}}
                                {{--<th>Division</th>--}}
                                <th style="padding-right: 170px !important;">Type</th>
                                <th style="padding-right: 150px !important;">Note</th>
                                <th style="padding-right: 150px !important;">Ket. Manager</th>
                                <th style="padding-right: 150px !important;">Ket. HRD</th>
                                <th style="padding-right: 150px !important;">Ket. Partner</th>
                                @if(Auth::user()->admin == 2 && Auth::user()->division == 'HRD')
                                <th></th>
                                @else @endif
                                <th></th>
                                @if(Auth::user()->division == 'HRD' || Auth::user()->division == 'PARTNER')
                                    <th></th>
                                    @endif

                            </tr>
                            </tfoot>
                        </table>
                        <a style="float: right;" href="{{ url('/home') }}" class="btn --grey">
                            <i class="fas fa-home"></i> Back to Home
                        </a>
                        @if($employees == null)

                        @elseif ($employees !== null || $employees !== 'null')
                        <a style="float: right;" href="{{ url('/cuti/list') }}" class="btn btn-info">
                            <i class="far fa-eye"></i> View all data
                        </a>
                            @endif
                    </div>

                </div>
            </div>
            @if($employees == null)

            @elseif ($employees !== null || $employees !== 'null')
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-header card-header-primary">
                            <h6 class="card-title"><span>{{ucwords(strtolower($employees->nama))}}'s leave quota</span></h6>
                        </div>
                        <div class="card-body">
                            <table class="table table-hover table-striped">

                                <thead>
                                <tr>
                                    <th>Status</th>
                                    <th class="bold">Total</th>
                                </tr>
                                </thead>
                                <tbody>
                                {{--<tr>--}}
                                {{--<td>National on-leave</td>--}}
                                {{--<td></td>--}}
                                {{--</tr>--}}

                                <tr>
                                    <td style="color: royalblue;">Leave quota</td>
                                    <td style="color: royalblue;" class="bold">{{ $jatahcutiawal }}</td>
                                </tr>
                                <tr>
                                    <td style="color: royalblue;">Additional</td>
                                    <td style="color: royalblue;" class="bold">{{ $manualinputcutiplus }}</td>
                                </tr>
                                {{--<tr>--}}
                                {{--<td>Note</td>--}}
                                {{--<td class="bold">+{{ $keteranganinputcutiplus }}</td>--}}
                                {{--</tr>--}}
                                <tr>
                                    <td style="color: orangered;">Reduction</td>
                                    <td style="color: orangered;" class="bold">{{ $manualinputcutiminus }}</td>
                                </tr>
                                {{--<tr>--}}
                                {{--<td>Note</td>--}}
                                {{--<td class="bold">{{ $keteranganinputcutiminus }}</td>--}}
                                {{--</tr>--}}
                                <tr>
                                    <td style="color: orangered;">Approved</td>
                                    <td style="color: orangered;" class="bold">{{ $approvedrequest }}</td>
                                </tr>

                                <tr>
                                    <td style="color: mediumseagreen;">Remaining quota</td>
                                    <td style="color: mediumseagreen;" class="bold">{{ $availableleave }}</td>
                                </tr>

                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-header card-header-primary">
                            <h6 class="card-title"><span>Additional / Reduction Notes</span></h6>
                        </div>
                        <div class="card-body">
                            <table class="table table-hover table-striped">

                                <thead>
                                <tr>
                                    <th>Total</th>
                                    <th>Month</th>
                                    <th>Note</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($manualinputs as $manualinput)
                                    <tr>
                                        <td>{{$manualinput->modifyleave}}</td>
                                        <td>{{date('F', strtotime($manualinput->created_at))}}</td>
                                        <td>{{$manualinput->keteranganpenambahancuti}}</td>
                                    </tr>

                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            @endif
            <script>
                var msg = '{{Session::get('alert')}}';
                var exist = '{{Session::has('alert')}}';
                if (exist) {
                    alert(msg);
                }
            </script>
        </div>

    </div>
    <script>
        $(document).ready(function () {

            $('#example').DataTable({
                responsive: true,
                columnDefs: [
                    { responsivePriority: 0, targets: 1 },
                    { responsivePriority: 1, targets: 2 },
                    { responsivePriority: 2, targets: 3 },
                    { responsivePriority: 3, targets: 4 },
                    { responsivePriority: 4, targets: 5 },
                    { responsivePriority: 5, targets: 6 },
                    { responsivePriority: 6, targets: 7 },
                    { responsivePriority: 7, targets: 8 },
                    { responsivePriority: 8, targets: 9 },
                    { responsivePriority: 9, targets: 10 },
                    { responsivePriority: 10, targets: 11 },
                    { responsivePriority: 11, targets: 12 }

                ],
                oLanguage: {
                    oPaginate: {
                        sNext: '<span class="pagination-default"></span><span class="pagination-fa"><i class="fa fa-chevron-right" ></i></span>',
                        sPrevious: '<span class="pagination-default"></span><span class="pagination-fa"><i class="fa fa-chevron-left" ></i></span>'
                    }
                },
                initComplete: function () {
                    this.api().columns().every(function () {
                        var column = this;
                        var select = $('<select><option value=""></option></select>')
                            .appendTo($(column.footer()).empty())
                            .on('change', function () {
                                var val = $.fn.dataTable.util.escapeRegex(
                                    $(this).val()
                                );

                                column
                                    .search(val ? '^' + val + '$' : '', true, false)
                                    .draw();
                            });

                        column.data().unique().sort().each(function (d, j) {
                            select.append('<option value="' + d + '">' + d + '</option>')
                        });
                    });
                }

            });
        });
    </script>
    <script>
        var dateToday = new Date();
        var dates = $("#from, #to").datepicker({
            defaultDate: "+1w",
            changeMonth: true,
            numberOfMonths: 2,
            minDate: dateToday,
            onSelect: function (selectedDate) {
                var option = this.id === "from" ? "minDate" : "maxDate",
                    instance = $(this).data("datepicker"),
                    date = $.datepicker.parseDate(instance.settings.dateFormat || $.datepicker._defaults.dateFormat, selectedDate, instance.settings);
                dates.not(this).datepicker("option", option, date);
            }
        });
    </script>
    <script>
        var autoupdate = false;

        function date1() {
            $('.date-picker').daterangepicker({
                singleDatePicker: true,
                showDropdowns: true,
                minDate: 'today',
                autoApply: true,
                autoUpdateInput: autoupdate,

            }, function (chosen_date) {
                $('.date-picker').val(chosen_date.format('MM/DD/YYYY'));
            });
        };
        date1();

        $('.date-picker-2').daterangepicker({
            singleDatePicker: true,
            showDropdowns: true,
            minDate: 'today',
            autoApply: true,
            autoUpdateInput: false,

        }, function (chosen_date) {
            $('.date-picker-2').val(chosen_date.format('MM/DD/YYYY'));
        });

        $('.date-picker').on('apply.daterangepicker', function (ev, picker) {
            if ($('.date-picker').val().length == 0) {
                autoupdate = true;
                console.log('true');
                date1();
            }
            ;
            var departpicker = $('.date-picker').val();
            $('.date-picker-2').daterangepicker({
                minDate: departpicker,
                singleDatePicker: true,
                showDropdowns: true,
                autoApply: true,

            });

            var drp = $('.date-picker-2').data('daterangepicker');
            drp.setStartDate(departpicker);
            drp.setEndDate(departpicker);
        });


        $('#clear').click(function () {
            $('input.form-control').val('');
        });

    </script>
    <style>
        .daterangepicker td.start-date.end-date {
            border-radius: 30px;
        }

        .daterangepicker td.active, .daterangepicker td.active:hover {
            background-color: powderblue !important;
            border-color: transparent;
            color: black;
        }

        .daterangepicker .calendar {
            max-width: none;
        }

        .daterangepicker .calendar th, .daterangepicker .calendar td {
            padding: .3em .7em;
        }

        .daterangepicker td.available:hover, .daterangepicker th.available:hover {
            background-color: #eee;
            border-color: transparent;
            color: inherit;
            border-radius: 30px;
        }

        .dropdown {
            display: inline-block;
            position: relative;
        }

        .dd-button {
            display: inline-block;
            border: 1px solid gray;
            border-radius: 4px;
            padding: 10px 30px 10px 20px;
            background-color: #ffffff;
            cursor: pointer;
            white-space: nowrap;
        }

        .dd-button:after {
            content: '';
            position: absolute;
            top: 50%;
            right: 15px;
            transform: translateY(-50%);
            width: 0;
            height: 0;
            border-left: 5px solid transparent;
            border-right: 5px solid transparent;
            border-top: 5px solid black;
        }

        .dd-button:hover {
            background-color: #eeeeee;
        }

        .dd-input {
            display: none;
        }

        .dd-menu {
            position: absolute;
            top: 100%;
            border: 1px solid #ccc;
            border-radius: 4px;
            padding: 0;
            margin: 2px 0 0 0;
            box-shadow: 0 0 6px 0 rgba(0, 0, 0, 0.1);
            background-color: #ffffff;
            list-style-type: none;
        }

        .dd-input + .dd-menu {
            display: none;
        }

        .dd-input:checked + .dd-menu {
            display: block;
        }

        .dd-menu li {
            padding: 10px 20px;
            cursor: pointer;
            white-space: nowrap;
        }

        .dd-menu li:hover {
            background-color: #f6f6f6;
        }

        .dd-menu li a {
            display: block;
            margin: -10px -20px;
            padding: 10px 20px;
        }

        .dd-menu li.divider {
            padding: 0;
            border-bottom: 1px solid #cccccc;
        }

        .form-group select, .form-group button, .form-group input {
            font-size: 12px;
        }

        select.form-control:not([size]):not([multiple]), .form-control {
            height: calc(1.9rem + 2px);
        }

        .dataTables_wrapper .dataTables_paginate .paginate_button {
            box-sizing: border-box;
            display: inline-block;
            min-width: 0;
            padding: 0;
            margin-left: 0;
            text-align: center;
            text-decoration: none !important;
            cursor: pointer;
            *cursor: hand;
            color: #333 !important;
            /* border: 1px solid transparent; */
            border-radius: 2px;
        }

        .dataTables_wrapper .dataTables_paginate .paginate_button:hover {
            border: 0;
            margin: 0;
            padding: 0;
            background-color: transparent;
            background: transparent;
        }
    </style>
    <script>
        ;(function($){

            /**
             * Store scroll position for and set it after reload
             *
             * @return {boolean} [loacalStorage is available]
             */
            $.fn.scrollPosReaload = function(){
                if (localStorage) {
                    var posReader = localStorage["posStorage"];
                    if (posReader) {
                        $(window).scrollTop(posReader);
                        localStorage.removeItem("posStorage");
                    }
                    $(this).click(function(e) {
                        localStorage["posStorage"] = $(window).scrollTop();
                    });

                    return true;
                }

                return false;
            }

            /* ================================================== */

            $(document).ready(function() {
                // Feel free to set it for any element who trigger the reload
                $('td').scrollPosReaload();
                $('button').scrollPosReaload();
                $('a').scrollPosReaload();
            });

        }(jQuery));
    </script>
@endsection