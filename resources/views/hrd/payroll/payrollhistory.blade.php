@extends('layouts.app')
@section('title', 'Payroll History')
<style>
    input[type=number]::-webkit-inner-spin-button,
    input[type=number]::-webkit-outer-spin-button {
        -webkit-appearance: none;
        margin: 0;
    }

    .dropdown {
        padding-right: 10px;
    }

    .card-body {
        -webkit-box-flex: 1;
        -ms-flex: 1 1 auto;
        flex: 1 1 auto;
        padding: 1.25rem;
        display: flex;
    }

    .table > thead > tr > th, .table > tbody > tr > th, .table > tfoot > tr > th, .table > thead > tr > td, .table > tbody > tr > td, .table > tfoot > tr > td {
        padding: 12px 8px !important;
    }
</style>
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header card-header-warning">
                        <h3 class="card-title"><b>Payroll History</b></h3>
                    </div>
                    <div class="card-body">
                        <div class="container">
                            <div class="row">
                                {{--<div class="flex-container" style="margin-right: 30px;">--}}
                                {{--<div class="row">--}}
                                {{--<div class="dropdown-header flex-item">Filter:</div>--}}
                                {{--<form style="margin-bottom: 0;" class="flex-item" method="GET"--}}
                                {{--action="{{ URL::to('/searchmanualpayrollhistory') }}">--}}
                                {{--<label style="display: none;" for="searchname"></label>--}}
                                {{--<input placeholder="Find by name" type="text" name="searchname"--}}
                                {{--id="searchname">--}}
                                {{--<button class="btn btn-light" type="submit">Find</button>--}}
                                {{--</form>--}}
                                {{--</div>--}}
                                {{--</div>--}}
                                <div class="dropdown show">
                                    <a class="btn btn-outline dropdown-toggle" href="#" role="button"
                                       id="period" data-toggle="dropdown" aria-haspopup="true"
                                       aria-expanded="false">
                                        Periode:
                                        @if( app('request')->input('period') == '1')
                                            Januari
                                        @elseif( app('request')->input('period') == '2')
                                            Februari
                                        @elseif( app('request')->input('period') == '3')
                                            Maret
                                        @elseif( app('request')->input('period') == '4')
                                            April
                                        @elseif( app('request')->input('period') == '5')
                                            Mei
                                        @elseif( app('request')->input('period') == '6')
                                            Juni
                                        @elseif( app('request')->input('period') == '7')
                                            Juli
                                        @elseif( app('request')->input('period') == '8')
                                            Agustus
                                        @elseif( app('request')->input('period') == '9')
                                            September
                                        @elseif( app('request')->input('period') == '10')
                                            Oktober
                                        @elseif( app('request')->input('period') == '11')
                                            November
                                        @elseif( app('request')->input('period') == '12')
                                            Desember
                                        @else
                                            Bulan ini
                                        @endif
                                    </a>
                                    <div class="dropdown-menu" aria-labelledby="period" style="top: 60px">
                                        <a class="dropdown-item" style="border-radius: 0;" href="?period=1">Januari</a>
                                        <a class="dropdown-item" style="border-radius: 0;" href="?period=2">Februariy</a>
                                        <a class="dropdown-item" style="border-radius: 0;" href="?period=3">Maret</a>
                                        <a class="dropdown-item" style="border-radius: 0;" href="?period=4">April</a>
                                        <a class="dropdown-item" style="border-radius: 0;" href="?period=5">Mei</a>
                                        <a class="dropdown-item" style="border-radius: 0;" href="?period=6">Juni</a>
                                        <a class="dropdown-item" style="border-radius: 0;" href="?period=7">Juli</a>
                                        <a class="dropdown-item" style="border-radius: 0;"
                                           href="?period=8">Agustus</a>
                                        <a class="dropdown-item" style="border-radius: 0;" href="?period=9">September</a>
                                        <a class="dropdown-item" style="border-radius: 0;" href="?period=10">Oktober</a>
                                        <a class="dropdown-item" style="border-radius: 0;"
                                           href="?period=11">November</a>
                                        <a class="dropdown-item" style="border-radius: 0;"
                                           href="?period=12">Desember</a>
                                    </div>
                                </div>
                                <div style="float: right;" class="dropdown show">
                                    <a class="btn btn-outline dropdown-toggle" href="#" role="button"
                                       id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true"
                                       aria-expanded="false">
                                        Hapus History (
                                        @if( app('request')->input('period') == '1')
                                            Januari
                                        @elseif( app('request')->input('period') == '2')
                                            Februari
                                        @elseif( app('request')->input('period') == '3')
                                            Maret
                                        @elseif( app('request')->input('period') == '4')
                                            April
                                        @elseif( app('request')->input('period') == '5')
                                            Mei
                                        @elseif( app('request')->input('period') == '6')
                                            Juni
                                        @elseif( app('request')->input('period') == '7')
                                            Juli
                                        @elseif( app('request')->input('period') == '8')
                                            Agustus
                                        @elseif( app('request')->input('period') == '9')
                                            September
                                        @elseif( app('request')->input('period') == '10')
                                            Oktober
                                        @elseif( app('request')->input('period') == '11')
                                            November
                                        @elseif( app('request')->input('period') == '12')
                                            Desember
                                        @else
                                            Pilih periode dahulu
                                        @endif
                                        )
                                    
                                    </a>

                                    <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                        <a class="dropdown-item"
                                           href="{{ url('/deletepayrollhistorythismonth/'.request()->period)}}">All </a>
                                        <a class="dropdown-item" href="{{ url('/deletepayrollhistorythismonthsmj/'.request()->period)}}">Solis
                                            Jakarta</a>
                                        <a class="dropdown-item" href="{{ url('/deletepayrollhistorythismonthmsj/'.request()->period)}}">MSId
                                            Jakarta</a>
                                        <a class="dropdown-item" href="{{ url('/deletepayrollhistorythismonthsmb/'.request()->period)}}">Solis
                                            Batam</a>
                                        <a class="dropdown-item" href="{{ url('/deletepayrollhistorythismonthmsb/'.request()->period)}}">MSId
                                            Batam</a>
                                    </div>
                                </div>
                            </div>
                            <br>
                            @if (session('alert'))
                                <div class="alert alert-success alert-dismissible fade show" role="alert">
                                    {{ session('alert') }}
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>

                            @endif
                            <br>
                            <table class="table table-hover table-responsive-md" id="example">
                                <thead>
                                <tr>
                                    <th>No</th>
                                    <th>NIP</th>
                                    <th>Name</th>
                                    <th>Period</th>
                                    <!--<th>Salary Slip</th>-->
                                    <!--<th></th>-->

                                </tr>
                                </thead>
                                <div style="display: none">{{$no = 0}}</div>
                                <tbody>

                                @foreach($employees as $employee)
                                    <tr>
                                        <td>{{$no++}}</td>
                                        <td>{{ucwords($employee->nip)}}</td>
                                        <td>{{ucwords(strtolower($employee -> nama))}}</td>
                                        <td>{{date('F', mktime(0, 0, 0, $employee->periode, 10))}}</td>
                                        <!--<td>-->
                                        <!--    @if(empty($employee))-->

                                        <!--    @else-->
                                        <!--        <a href="{{ route('pdfview',['download'=>'pdf','historyid' => $employee->id, 'id' => $employee->nip, 'periode' => app('request')->input('period')]) }}">-->
                                        <!--            <button class="btn btn-success">-->
                                        <!--                <i class="fas fa-eye"></i>-->
                                        <!--            </button>-->
                                        <!--        </a>-->

                                        <!--    @endif-->

                                        <!--    {{-- {{ucwords(strtok(strtolower($employee -> nama),""))}}--}}-->
                                        <!--    {{--{{ url('/employeebiodata/'.$employee->id.'/edit') }}--}}-->
                                        <!--</td>-->
                                        <!--<td>-->
                                        <!--    @if(empty($employee))-->

                                        <!--    @else-->

                                        <!--        <a href="{{ url('/delete/payrollhistory/'.$employee->id) }}"-->
                                        <!--           onclick="confirmdeletefile()">-->
                                        <!--            <button class="btn btn-danger">-->
                                        <!--                <i class="fas fa-trash-alt"></i>-->
                                        <!--            </button>-->
                                        <!--        </a>-->
                                        <!--    @endif-->

                                        <!--    {{-- {{ucwords(strtok(strtolower($employee -> nama),""))}}--}}-->
                                        <!--    {{--{{ url('/employeebiodata/'.$employee->id.'/edit') }}--}}-->
                                        <!--</td>-->
                                    </tr>
                                @endforeach
                                </tbody>
                                <tfoot>
                                <tr>
                                    <th>No</th>
                                    <th>NIP</th>
                                    <th>Name</th>
                                    <th>Period</th>
                                    <!--<th>Salary Slip</th>-->
                                    <!--<th></th>-->

                                </tr>
                                </tfoot>
                            </table>



                            {{--<a href="{{ url('/downloaddata') }}">--}}
                                {{--<button type="button" class="btn btn-success"><i class="fas fa-file-download"></i>--}}
                                    {{--Summary of This Month--}}
                                {{--</button>--}}
                            {{--</a>--}}
                            {{--<a href="{{ url('/downloadsummary') }}">--}}
                                {{--<button type="button" class="btn btn-success"><i class="fas fa-file-download"></i>--}}
                                    {{--Summary of All Times--}}
                                {{--</button>--}}
                            {{--</a>--}}

                        </div>


                    </div>

                </div>
                <!--<div class="card">-->
                <!--    <div class="card-header">-->
                <!--        <h3>Download with Filter</h3>-->
                <!--    </div>-->
                <!--    <div class="card-body">-->
                <!--        <form action="{{ url('/downloaddata') }}" method="GET">-->
                <!--            @csrf-->
                <!--            <div class="form-row">-->
                <!--                <div class="col">-->
                <!--                    <label for="periode">Period</label>-->
                <!--                    <select id="periode" name="periode" class="form-control">-->
                <!--                        <option disabled selected>-->
                <!--                            All Time-->
                <!--                        </option>-->
                <!--                        @foreach($periodes as $periode)-->
                <!--                            <option value="{{$periode -> periode}}">-->
                <!--                                {{ date('F', mktime(0, 0, 0, $periode -> periode, 10)) }}-->
                <!--                            </option>-->
                <!--                        @endforeach-->
                <!--                    </select>-->
                <!--                </div>-->
                <!--            </div>-->
                <!--            <br>-->
                <!--            <input class="btn btn-danger" type="reset" value="Reset">-->
                <!--            <button class="btn btn-success" name="action" value="xls" type="submit"><i class="fas fa-file-download"></i> Download Payroll History</button>-->
                <!--            <a href="{{ url()->previous() }}">-->
                <!--                <button type="button" class="btn btn-outline-secondary">Back</button>-->
                <!--            </a>-->
                <!--            {{--<button class="btn btn-info" name="action" value="print" type="submit">Print</button>--}}-->
                <!--        </form>-->
                <!--    </div>-->
                <!--</div>-->
            </div>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.3.1.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/plug-ins/f2c75b7247b/integration/bootstrap/3/dataTables.bootstrap.js"></script>
    <script src="https://cdn.datatables.net/responsive/1.0.4/js/dataTables.responsive.js"></script>
    <style>
        .dropdown-menu{
            top: 100px;
        }
    </style>

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
    <script>
        function confirmdeletefile() {
            confirm("Press a button!");
        }
    </script>
@endsection
