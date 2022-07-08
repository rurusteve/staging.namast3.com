@extends('layouts.app')
@section('title', 'Input Manual')

@section('content')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/5.0.0/normalize.min.css">
    <link rel='stylesheet' href='https://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/css/bootstrap.min.css'>
    {{--<link rel='stylesheet'--}}
    <link rel='stylesheet'
          href='https://cdn.datatables.net/plug-ins/f2c75b7247b/integration/bootstrap/3/dataTables.bootstrap.css'>
    <link rel='stylesheet' href='https://cdn.datatables.net/responsive/1.0.4/css/dataTables.responsive.css'>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/meyer-reset/2.0/reset.min.css">

    <link rel='stylesheet' href='https://fonts.googleapis.com/css?family=Montserrat:200,300,400,600,700'>
    <link rel='stylesheet'
          href='https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.0.0-alpha.6/css/bootstrap.min.css'>

    <style>
        .biodata {
            padding: 5px 0;
        }
        body{
            background-color: #eee !important;
        }
    </style>
    <div class="container">

        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header card-header-primary">
                        <h4 class="card-title">Work Time Summary</h4>
                        <p class="card-category">Formulir pengajuan cuti</p>
                    </div>
                    <div class="card-body">
                        <div class="row">

                            <div class="col-sm-12">


                                <div class="col-xs-6 col-sm-6">

                                    <div class="biodata">Name: {{ucwords(strtolower($client -> clientname))}}</div>
                                    <div class="biodata">Engg. Period: {{$client -> engagementperiod}}</div>
                                    <div class="biodata">Engg. Type: {{$client -> engagementtype}}</div>
                                    <div class="biodata">Other : {{$client -> keterangan}}</div>


                                </div>
                                <div class="col-xs-6 col-sm-6">
                                    <div class="biodata">Code: {{$client -> clientcode}}</div>
                                    <div class="biodata">Location: {{$client->location}}</div>
                                    <div class="biodata">Institution: {{$client->institusi}}</div>
                                    <div class="biodata">Branch: {{$client->branch}}</div>


                                </div>
                            </div>

                        </div>
                        <br>

<form action="{{ url('/partner/reporting/advanced/client/'.$client->id) }}" method="GET">
                            <label>Filter by period:</label>
                            <select style="width: 50%" class="form-control" name="periode" onchange="this.form.submit()">
                                <option disabled selected>
                                    @if(\request()->has('periode'))
                                        @if(\request('periode') == 0)
                                        Entire Year
                                        @else
                                        {{ date('F', mktime(0, 0, 0, \request('periode'), 10))}}
                                        @endif
                                    @else
                                        Entire Year
                                    @endif
                                </option>
                                <option value="0">Entire Year</option>
                                <option value="1">January</option>
                                <option value="2">February</option>
                                <option value="3">March</option>
                                <option value="4">April</option>
                                <option value="5">May</option>
                                <option value="6">June</option>
                                <option value="7">July</option>
                                <option value="8">August</option>
                                <option value="9">September</option>
                                <option value="10">October</option>
                                <option value="11">November</option>
                                <option value="12">December</option>
                            </select>
                          
                        </form>
                        <br>
                        <table style="display: block; overflow-x: auto; font-size: 12px;"
                               class="table table-responsive-md table-striped display"
                               id="example">
                            
                    
                        
                            <thead>
                            <tr>

                                <th>Name</th>
                                <th>NIP</th>
                                <th>Period</th>

                                <th>Institution</th>
                                <th>City</th>
                                <th>Group</th>
                                <th>Position</th>
                                <th>Regular Hour(s)</th>
                                <th>Overtime Hour(s)</th>
                                <th>Ineffective Hour(s)</th>
                                <th>Incentive</th>
                                <th>Total Hour(s)</th>
                                <th>Overtime Meal</th>
                                <th>Overtime Transportation</th>


                            </tr>
                            </thead>
                            <tfoot>
                            <tr style="background-color: #ffc107; font-weight: bold;">

                                <td>Total:</td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                            </tr>
                            </tfoot>
                            <tbody>
                            @foreach($timereports as $timereport)
                                <tr>
                                    <td>{{ucwords(strtolower($timereport->nama))}}</td>
                                    <td>{{$timereport->nip}}</td>
                                    <td>{{$timereport->periode }}</td>
                                    <td>{{$timereport->institusi}}</td>
                                    <td>{{ucwords(strtolower($timereport->kota))}}</td>
                                    <td>{{ucwords(strtolower($timereport->grup))}}</td>
                                    <td>{{ucwords(strtolower($timereport->position))}}</td>
                                    <td>{{$a = $timereport->normalhours}}</td>
                                    <td>{{$b = $timereport->overtimes}}</td>
                                    <td>{{$c = $timereport->ineffectivehours}}</td>
                                    <td>{{$d = $timereport->ineffectiverules}}</td>
                                    <td>{{$a + $b - $c - $d}}</td>
                                    <td>{{$timereport->overtimemeal}}</td>
                                    <td>{{$timereport->overtimetransportation}}</td>



                                </tr>
                            @endforeach
                            </tbody>
                            {{--<tfoot>--}}
                            {{--<tr>--}}
                                {{--<th>Name</th>--}}
                                {{--<th>NIP</th>--}}
                                {{--<th>Institution</th>--}}
                                {{--<th>City</th>--}}
                                {{--<th>Group</th>--}}
                                {{--<th>Position</th>--}}
                                {{--<th>Regular Hour(s)</th>--}}
                                {{--<th>Overtime Hour(s)</th>--}}
                                {{--<th>Ineffective Hour(s)</th>--}}
                                {{--<th>Incentive</th>--}}
                                {{--<th>Total Hour(s)</th>--}}
                            {{--</tr>--}}
                            {{--</tfoot>--}}

                        </table>
                        <a href="{{ url('/partner/reporting/timereport/') }}">
                            <button style="font-size: .75rem" type="button" class="btn btn-primary">
                                Back to Time Report
                            </button>
                        </a>

                    </div>


                </div>
            </div>
        </div>
    </div>
    <script src="https://static.codepen.io/assets/common/stopExecutionOnTimeout-de7e2ef6bfefd24b79a3f68b414b87b8db5b08439cac3f1012092b2290c719cd.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
    <script src="https://cdn.datatables.net/plug-ins/f2c75b7247b/integration/bootstrap/3/dataTables.bootstrap.js"></script>
    <script src="https://cdn.datatables.net/responsive/1.0.4/js/dataTables.responsive.js"></script>
    <script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
    {{--<script src='https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.0.0-alpha.6/js/bootstrap.min.js'></script>--}}
    <style>
        table.dataTable thead .sorting:after, table.dataTable thead .sorting_asc:after, table.dataTable thead .sorting_desc:after {
            bottom: 8px !important;
            top: auto !important;
        }

        table {
            transition: .3s cubic-bezier(.25, .8, .5, 1);
            user-select: none;
            white-space: nowrap;
        }

        .paginate_button:hover, .ellipsis:hover {
            background-color: #eceeec;
            cursor: pointer;
            color: #3490dc;
        }

        #example_previous {
            border-radius: 5px 0 0 5px;
        }

        #example_next {
            border-radius: 0 5px 5px 0;
        }

        div.dataTables_info {
            font-size: 0.8em;
            display: flex;
            justify-content: start;
            margin-bottom: 0;
        }

        .dataTables_filter {
            font-size: 0.8em;
        }

        @media screen and (max-width: 767px) {
            div.dataTables_info {
                justify-content: center;
                margin-bottom: 20px;
            }
        }

        @media screen and (max-width: 767px) {
            div.dataTables_length, div.dataTables_filter, div.dataTables_info, div.dataTables_paginate {
                text-align: left;
            }
        }
        input {
            outline: none;
        }

        input[type=search] {
            -webkit-appearance: textfield;
            -webkit-box-sizing: content-box;
            font-family: inherit;
            font-size: 100%;
        }

        input::-webkit-search-decoration,
        input::-webkit-search-cancel-button {
            display: none;
        }

        input[type=search] {
            font-size: 1em;
            background: #ededed url(http://rurusteve.com/search-solid.svg) no-repeat 9px center;
            background-size: 1em;

            border: solid 1px #ccc;
            padding: 2px 10px 2px 20px;
            width: 55px;

            -webkit-border-radius: 10em;
            -moz-border-radius: 10em;
            border-radius: 10em;

            -webkit-transition: all .2s;
            -moz-transition: all .2s;
            transition: all .2s;
        }
        .form-control, .is-focused .form-control {
            background-image: linear-gradient(to top, #ffffff 2px, rgba(156, 39, 176, 0) 2px), linear-gradient(to top, #d2d2d2 1px, rgba(210, 210, 210, 0) 1px);
        }
        .form-control:read-only {
             background-image: none;
            font-size: .75rem;
        }
        input[type=search]:focus {
            width: 130px;
            background-color: #fff;
            border-color: #fec834;

            -webkit-box-shadow: 0 0 5px rgba(254, 200, 52, 0.5);
            -moz-box-shadow: 0 0 5px rgba(254, 200, 52, 0.5);
            box-shadow: 0 0 5px rgba(254, 200, 52, 0.5);
        }

        input:-moz-placeholder {
            color: #999;
        }

        input::-webkit-input-placeholder {
            color: #999;
        }

        .dataTables_length {
            font-size: 0.8em;
        }

        .collapse {
            visibility: unset;
        }

        .btn.active.focus, .btn.active:focus, .btn.focus, .btn:active.focus, .btn:active:focus, .btn:focus {
            outline: none;
        }

        .btn-link:focus, .btn-link:hover {
            text-decoration: none;
            background-color: transparent;
        }

        .btn-link:hover {
            color: #5dbf41;
        }

        .caret {
            display: none;
        }

        .navbar-nav {
            float: right;
        }
    </style>

    <script>
        $('.toggle-vis').on('click', function (e) {
            e.preventDefault();

            // Get the column API object
            var column = $('#example').DataTable().column($(this).attr('data-column'));

            // Toggle the visibility
            column.visible(!column.visible());
        })
    </script>
    <script>
        $(document).ready(function() {
            // DataTable initialisation
            $('#exx').DataTable(
                {
                    "paging": false,
                    "autoWidth": true,
                    "footerCallback": function ( row, data, start, end, display ) {
                        var api = this.api();
                        nb_cols = api.columns().nodes().length;
                        var j = 3;
                        while(j < nb_cols){
                            var pageTotal = api
                                .column( j, { page: 'current'} )
                                .data()
                                .reduce( function (a, b) {
                                    return Number(a) + Number(b);
                                }, 0 );
                            // Update footer
                            $( api.column( j ).footer() ).html(pageTotal);
                            j++;
                        }
                    }
                }
            );
        });
    </script>
    <script>
        $(document).ready(function () {

            $('#example').DataTable({

                oLanguage: {
                    oPaginate: {
                        sNext: '<span class="pagination-default"></span><span class="pagination-fa"><i class="fa fa-chevron-right" ></i></span>',
                        sPrevious: '<span class="pagination-default"></span><span class="pagination-fa"><i class="fa fa-chevron-left" ></i></span>'
                    }
                },
                footerCallback: function ( row, data, start, end, display ) {
                    var api = this.api();
                    nb_cols = api.columns().nodes().length;
                    var j = 3;
                    while(j < nb_cols){
                        var pageTotal = api
                            .column( j, { page: 'current'} )
                            .data()
                            .reduce( function (a, b) {
                                return Number(a) + Number(b);
                            }, 0 );
                        // Update footer
                        $( api.column( j ).footer() ).html(pageTotal);
                        j++;
                    }
                },
                // initComplete: function () {
                //     this.api().columns().every(function () {
                //         var column = this;
                //         var select = $('<select><option value=""></option></select>')
                //             .appendTo($(column.footer()).empty())
                //             .on('change', function () {
                //                 var val = $.fn.dataTable.util.escapeRegex(
                //                     $(this).val()
                //                 );
                //
                //                 column
                //                     .search(val ? '^' + val + '$' : '', true, false)
                //                     .draw();
                //             });
                //
                //         column.data().unique().sort().each(function (d, j) {
                //             select.append('<option value="' + d + '">' + d + '</option>')
                //         });
                //     });
                // }

            });
            // var table = $('#example').DataTable( {
            //     "scrollY": "200px",
            // } );


        });
    </script>
    <style>
        .caret {
            display: none !important;
        }

    </style>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
    <script type="text/javascript"
            src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css"/>
@endsection
