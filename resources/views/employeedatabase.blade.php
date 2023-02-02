@extends('layouts.app')
@section('title', 'Employee Payroll Data')
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css">

<style>
    input[type=number]::-webkit-inner-spin-button,
    input[type=number]::-webkit-outer-spin-button {
        -webkit-appearance: none;
        margin: 0;
    }

    .dropdown {
        padding-right: 10px;
    }

    .not-active {
        pointer-events: none;
        cursor: no-drop;
        color: black;
    }

    .not-active:hover {
        cursor: not-allowed;
        color: grey;
    }

    .dataTables_wrapper .dataTables_paginate .paginate_button {
        font-size: 0.8em;
        position: relative;
        padding: 0;
        margin-left: -1px;
        background-color: transparent;
        border: 0;
    }

    .dataTables_wrapper .dataTables_paginate .paginate_button:hover {
        background: none;
        border: none;
    }
</style>
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header card-header-primary">
                        <h3 class="card-title"><b>Employee Payroll Data</b></h3>
                        <p class="card-category">List of employee's payroll data</p>
                    </div>
                    <div class="card-body">
                        <div class="container">
                            <div style="display: flex;">
                                <div class="">
                                    <a class="btn btn-secondary dropdown-toggle" href="#" role="button"
                                       id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true"
                                       aria-expanded="false">
                                        Filter by: {{\request('data')}}
                                    </a>

                                    <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                        <a style="text-decoration: underline" class="dropdown-item"
                                           href=""><b>Institusi</b></a>
                                        <a class="dropdown-item" href="?institusi=solis">SOLIS</a>
                                        <a class="dropdown-item" href="?institusi=msid">MSId</a>
                                        <a style="text-decoration: underline" class="dropdown-item" href=""><b>Kota</b></a>
                                        <a class="dropdown-item" href="?kota=jakarta">Jakarta</a>
                                        <a class="dropdown-item" href="?kota=batam">Batam</a>
                                        <a style="text-decoration: underline" class="dropdown-item"
                                           href=""><b>Status</b></a>
                                        @foreach($statuses as $status)
                                            <a class="dropdown-item"
                                               href="?status={{$status->status}}">{{$status->status}}</a>
                                        @endforeach

                                    </div>
                                </div>
                                <div>
                                    <a class="btn btn-danger" href="{{ url('/payroll/data') }}">NO FILTER</a>
                                </div>
                                {{--<div class="dropdown show">--}}
                                {{--<a class="btn btn-secondary dropdown-toggle" href="#" role="button"--}}
                                {{--id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true"--}}
                                {{--aria-expanded="false">--}}
                                {{--Sort by:--}}
                                {{--</a>--}}

                                {{--<div class="dropdown-menu" aria-labelledby="dropdownMenuLink">--}}
                                {{--<a class="dropdown-item" href="?nama">NIP</a>--}}
                                {{--<a class="dropdown-item" href="?nama">Nama</a>--}}
                                {{--<a class="dropdown-item" href="?tanggalbergabung">Lama Bergabung</a>--}}
                                {{--<a class="dropdown-item" href="?positionid">Posisi</a>--}}
                                {{--<a class="dropdown-item" href="?orderstatus">Status</a>--}}
                                {{--</div>--}}
                                {{--</div>--}}
                                <br><br>
                            </div>
                            <table style="font-size: 1em" class="table table-striped table-responsive" id="example">
                                <thead>
                                <tr>
                                    <th>No</th>
                                    <th>NIP</th>
                                    <th></th>
                                    <th>Nama</th>
                                    <th>Tanggal Bergabung</th>
                                    <th>Lama Bergabung</th>
                                    <th>Status</th>
                                    {{--<th>Posisi</th>--}}
                                    <th style="min-width: 50px">Data</th>
                                    <th style="min-width: 60px">Digits</th>
                                    @if(Auth::user()->admin == 2)
                                        <th style="min-width: 50px">Del.</th>
                                    @else
                                    @endif
                                </tr>
                                </thead>
                                <tbody>
                                <div style="display: none">{{$no = 1}}</div>
                                @foreach($employees as $employee)
                                    @if($employee->status == 'resign' || $employee->status == 'Resign' || $employee->status == 'RESIGN')
                                        <tr style="color: lightgrey">
                                            <td>{{$no++}}</td>
                                            <td>
                                                {{ucwords($employee->nip)}}
                                            </td>
                                            <td>
                                                <a href="{{ url('/account/'.$employee->id.'/detail') }}"><i style="color: grey;" class="fas fa-user"></i></a>
                                            </td>
                                            <td>{{ucwords(strtolower($employee->nama))}}</td>
                                            <td>
                                                {{$employee->tanggalbergabung}}
                                            </td>

                                            <td>
                                                @if(floor($employee->datediff / 365) <= 0) <span
                                                        style="display: none">{{$year = floor($employee->datediff / 365)}}</span> @else {{$year = floor($employee->datediff / 365)}}
                                                y @endif
                                                @if(floor(($employee->datediff - ($year * 365)) / 30) <= 0) <span
                                                        style="display: none">{{$month = floor(($employee->datediff - ($year * 365)) / 30)}}</span> @else {{$month = floor(($employee->datediff - ($year * 365)) / 30)}}
                                                m @endif
                                                @if(((($employee->datediff - ($year * 365)) / 30) - $month) * 30 <= 0)
                                                    <span
                                                            style="display: none">{{$days = ((($employee->datediff - ($year * 365)) / 30) - $month) * 30}}</span> @else {{$days = ((($employee->datediff - ($year * 365)) / 30) - $month) * 30}}
                                                d @endif
                                            </td>
                                            <td>
                                                @if($employee->status == 'NULL' || $employee->status == '' || $employee->status == NULL || $employee->status == ' ')
                                                    EMPTY
                                                    @else
                                                    {{$employee->status}}
                                                    @endif
                                            </td>
                                            <td>
                                                <a
                                                   href="{{ url('/payroll/data/'.$employee->id.'/edit') }}">
                                                    <i class="fas fa-pencil-alt"></i></a>
                                            </td>
                                            <td>
                                                <a href="{{ url('/payroll/data/'.$employee->id.'/edit') }}"><i
                                                            class="fas fa-chart-line"></i></a>
                                            </td>


                                                @if(Auth::user()->admin == 2)
                                                <td>
                                                    <a class="not-active"
                                                       style="cursor: not-allowed; background-color: lightgrey; padding: 5px 8px; color: white; border-radius: 50%;"
                                                       href="{{url('/payroll/data/'.$employee->id.'/delete')}}"
                                                       onclick="return confirm('Are you sure?')">
                                                        <i class="far fa-trash-alt"></i>
                                                    </a>
                                                </td>
                                                @else
                                                @endif

                                        </tr>
                                    @else
                                        <tr>
                                            <td>{{$no++}}</td>
                                            <td>
                                                {{ucwords($employee->nip)}}
                                            </td>
                                            <td>
                                                <a href="{{ url('/account/'.$employee->id.'/detail') }}"><i class="fas fa-user"></i></a>
                                            </td>
                                            <td>{{ucwords(strtolower($employee->nama))}}</td>
                                            <td>
                                                {{$employee->tanggalbergabung}}
                                            </td>

                                            <td>
                                                @if(floor($employee->datediff / 365) <= 0) <span
                                                        style="display: none">{{$year = floor($employee->datediff / 365)}}</span> @else {{$year = floor($employee->datediff / 365)}}
                                                y @endif
                                                @if(floor(($employee->datediff - ($year * 365)) / 30) <= 0) <span
                                                        style="display: none">{{$month = floor(($employee->datediff - ($year * 365)) / 30)}}</span> @else {{$month = floor(($employee->datediff - ($year * 365)) / 30)}}
                                                m @endif
                                                @if(((($employee->datediff - ($year * 365)) / 30) - $month) * 30 <= 0)
                                                    <span
                                                            style="display: none">{{$days = ((($employee->datediff - ($year * 365)) / 30) - $month) * 30}}</span> @else {{$days = ((($employee->datediff - ($year * 365)) / 30) - $month) * 30}}
                                                d @endif
                                            </td>
                                            <td>
                                                {{$employee->status}}
                                            </td>
                                            <td>
                                                <a style="background-color: #30cf30; padding: 5px 7px; color: white; border-radius: 50%;"
                                                   href="{{ url('/payroll/data/'.$employee->id.'/edit') }}">
                                                    <i class="fas fa-pencil-alt"></i></a>
                                            </td>
                                            <td>
                                                <a style="background-color: #06c0f0; padding: 5px 7px; color: white; border-radius: 50%;"
                                                   href="{{ url('/payroll/data/'.$employee->id.'/increase/form') }}"><i
                                                            class="fas fa-chart-line"></i></a>
                                            </td>


                                                @if(Auth::user()->admin == 2)
                                                <td>
                                                    <a style="background-color: #f03624; padding: 5px 8px; color: white; border-radius: 50%;"
                                                       href="{{url('/payroll/data/'.$employee->id.'/delete')}}"
                                                       onclick="return confirm('Are you sure?')" class=''>
                                                        <i class="far fa-trash-alt"></i>
                                                    </a>
                                                </td>
                                                @else
                                                @endif

                                        </tr>
                                    @endif
                                @endforeach
                                </tbody>
                                <tfoot>
                                <tr>
                                    <th style="opacity: 0;">No</th>
                                    <th style="opacity: 0;">NIP</th>
                                    <th style="opacity: 0;"></th>
                                    <th style="opacity: 0;">Nama</th>
                                    <th style="opacity: 0;">Tanggal Bergabung</th>
                                    <th style="opacity: 0;">Lama Bergabung</th>
                                    <th>Status</th>
                                    {{--<th>Posisi</th>--}}
                                    <th style="min-width: 50px;opacity: 0;">Edit</th>
                                    <th style="min-width: 60px;opacity: 0;">Incr.</th>
                                    @if(Auth::user()->admin == 2)
                                        <th style="min-width: 50px;opacity: 0;">Del.</th>
                                    @else
                                    @endif
                                </tr>
                                </tfoot>
                            </table>


                            <td>
                                <a href="{{ url('/user/registration/form') }}">
                                    <button type="button" class="btn btn-primary">+ Add New Employee</button>
                                </a>
                                {{--<a href="{{ url('/importemployee') }}">--}}
                                    {{--<button type="button" class="btn btn-disabled"><i class="far fa-file-alt"></i>--}}
                                        {{--Import--}}
                                        {{--CSV--}}
                                    {{--</button>--}}
                                {{--</a>--}}
                                <a href="{{url()->previous()}}">
                                    <button type="button" class="btn btn-outline-secondary">Back</button>
                                </a>

                            </td>
                        </div>


                    </div>

                </div>
            </div>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.3.1.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/plug-ins/f2c75b7247b/integration/bootstrap/3/dataTables.bootstrap.js"></script>
    <script src="https://cdn.datatables.net/responsive/1.0.4/js/dataTables.responsive.js"></script>

    <script>
        $(document).ready(function () {

            $('#example').DataTable({
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
                },
                oLanguage: {
                    oPaginate: {
                        sNext: '<span class="pagination-default"></span><span class="pagination-fa"><i class="fa fa-chevron-right" ></i></span>',
                        sPrevious: '<span class="pagination-default"></span><span class="pagination-fa"><i class="fa fa-chevron-left" ></i></span>'
                    }
                },


            });
            // var table = $('#example').DataTable( {
            //     "scrollY": "200px",
            // } );


        });
    </script>
@endsection
