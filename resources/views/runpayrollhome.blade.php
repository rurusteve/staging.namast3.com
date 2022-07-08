@extends('layouts.app')
@section('title', 'Run Payroll')

<style>
    input[type=number]::-webkit-inner-spin-button,
    input[type=number]::-webkit-outer-spin-button {
        -webkit-appearance: none;
        margin: 0;
    }

    .dropdown {
        padding-right: 10px;
    }
    input[type=file]::-webkit-file-upload-button {
        color: black;
        background-color: whitesmoke;
        border-radius: 5px;
        outline: none;
        padding: 5px 10px;
    }
    .form-group input[type=file] {
        opacity: 1 !important;
        position: initial !important;
    }



</style>
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">

                <div class="card">
                    <div class="card-header card-header-success">
                        <h3 class="card-title"><b>Run Payroll</b></h3>
                    </div>
                    <div class="card-body">
                        <div class="container">
                            <div style="display: flex; flex-wrap: wrap;">

                                {{--<div class="flex-container" style="margin-right: 30px;">--}}
                                    {{--<div class="row">--}}
                                        {{--<div class="dropdown-header flex-item">Filter:</div>--}}
                                        {{--<form class="flex-item" method="GET"--}}
                                              {{--action="{{ URL::to('/payroll/run/search/') }}">--}}
                                            {{--<label style="display: none;" for="searchname"></label>--}}
                                            {{--<input placeholder="Find by name" type="text" name="searchname"--}}
                                                   {{--id="searchname">--}}
                                            {{--<button class="btn btn-light" type="submit">Find</button>--}}
                                        {{--</form>--}}
                                    {{--</div>--}}
                                {{--</div> <br>--}}
                                {{--<div class="dropdown show">--}}
                                    {{--<a class="btn btn-secondary dropdown-toggle" href="#" role="button"--}}
                                       {{--id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true"--}}
                                       {{--aria-expanded="false">--}}
                                        {{--Filter by:--}}
                                    {{--</a>--}}

                                    {{--<div class="dropdown-menu" aria-labelledby="dropdownMenuLink">--}}
                                        {{--<a style="text-decoration: underline" class="dropdown-item"--}}
                                           {{--href=""><b>Institusi</b></a>--}}
                                        {{--<a class="dropdown-item" href="?institusi=solis">SOLIS</a>--}}
                                        {{--<a class="dropdown-item" href="?institusi=msid">MSId</a>--}}

                                    {{--</div>--}}
                                {{--</div>--}}
                                {{--<div class="dropdown show">--}}
                                    {{--<a class="btn btn-secondary dropdown-toggle" href="#" role="button"--}}
                                       {{--id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true"--}}
                                       {{--aria-expanded="false">--}}
                                        {{--Sort by:--}}
                                    {{--</a>--}}

                                    {{--<div class="dropdown-menu" aria-labelledby="dropdownMenuLink">--}}
                                        {{--<a class="dropdown-item" href="?nip">NIP</a>--}}
                                        {{--<a class="dropdown-item" href="?nama">Nama</a>--}}
                                    {{--</div>--}}
                                {{--</div>--}}
                                <div class="dropdown show">
                                    <a class="btn btn-outline-secondary dropdown-toggle" href="#" role="button"
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
                                        <a class="dropdown-item" style="border-radius: 0;" href="?period=2">Februari</a>
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
                                <div class="dropdown show">
                                    <a class="btn btn-outline-secondary dropdown-toggle" href="#" role="button"
                                       id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true"
                                       aria-expanded="false">
                                        Hapus data input (
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
                                        @endif )
                                    </a>

                                    <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                        <a class="dropdown-item" href="{{ url('/deletepayrollinputthismonth/'.request()->period)}}">Semua </a>
                                        <a class="dropdown-item" href="{{ url('/deletepayrollinputthismonthsmj/'.request()->period)}}">Solis Jakarta</a>
                                        <a class="dropdown-item" href="{{ url('/deletepayrollinputthismonthmsj/'.request()->period)}}">MSId Jakarta</a>
                                        <a class="dropdown-item" href="{{ url('/deletepayrollinputthismonthsmb/'.request()->period)}}">Solis Batam</a>
                                        <a class="dropdown-item" href="{{ url('/deletepayrollinputthismonthmsb/'.request()->period)}}">MSId Batam</a>
                                    </div>
                                </div>
                                <div class="dropdown show">
                                    <a class="btn btn-outline-secondary dropdown-toggle" href="#" role="button"
                                       id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true"
                                       aria-expanded="false">
                                        @if(request()->has('sudahdiproses'))
                                        Tampilkan: Sudah dirpsoes
                                        @elseif(request()->has('belumdiproses'))
                                        Tampilkan: Belum diproses
                                        @else
                                        Tampilkan: Semua
                                        @endif
                                    </a>

                                    <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                        <a class="dropdown-item" href="?sudahdiproses">Sudah Diproses</a>
                                        <a class="dropdown-item" href="?belumdiproses">Belum Diproses</a>
                                        <a class="dropdown-item" href="{{ url('/payroll/run') }}">Semua</a>
                                    </div>
                                </div>
                                <br>

                                <br><br>
                            </div>
                            <br>
                            @if (session('success'))
                                <div class="alert alert-success alert-dismissible fade show" role="alert">
                                    {{ session('success') }}
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>

                            @endif
                            @if (session('failure'))
                                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                    {{ session('failure') }}
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>

                            @endif
                            <br>
                            <table class="table table-responsive table-striped display"
                                   id="example">
                                <thead>
                                <tr>
                                    <th>No</th>
                                    <th>NIP</th>
                                    <!--<th></th>-->
                                    <th>Kota</th>
                                    <th>Institusi</th>
                                    <th>Nama</th>
                                    <!--<th>Opt</th>-->
                                    <th>Time Report Status</th>
                                    <th>Payroll Status</th>


                                </tr>
                                </thead>
                                <tbody>
                                <div style="display: none">{{$no = 1}}</div>
                                @if($hitung == 0)
                                    <td style="text-align: center" colspan="6">Please input data</td>

                                @elseif($hitung >= 1)
                                    @foreach($employees as $employee)
                                        <tr>

                                            <td>{{$no++}}</td>
                                            {{--<td>{{ (($employees->currentPage() - 1 ) * $employees->perPage() ) + $loop->iteration }}</td>--}}
                                            <td>
                                                {{ucwords($employee->nip)}}
                                            </td>

                                            <!--<td>-->
                                            <!--    <a href="{{url('/account/'.$employee->id.'/detail')}}"><i class="fas fa-search-plus"></i></a>-->
                                            <!--</td>-->
                                            <td>{{ucwords(strtolower($employee -> kota))}}</td>
                                            <td>
                                                @if($employee->institusi == 'SOLIS' || $employee->institusi == 'solusitama ')
                                                    Solis
                                                @elseif($employee->institusi == 'MSId' || $employee->institusi == 'kapmirawati')
                                                    MSId
                                                @else
                                                    Unknown
                                                @endif
                                            </td>
                                            <td>{{ucwords(strtolower($employee -> nama))}}</td>
                                            {{--<td>--}}
                                                {{--@if($employee -> payrollcheck == null)--}}
                                                    {{--<a class="btn btn-success"--}}
                                                       {{--href="{{ url('/payroll/run/payrolling/'.$employee->nip.'/'.$thismonth.'/'.$employee->nama) }}">Process--}}
                                                    {{--</a>--}}
                                                    {{--@elseif($employee -> payrollcheck == 'done')--}}
                                                    {{--<p style="color: grey;">Payroll Done</p>--}}
                                                    {{--@endif--}}
                                                {{-- {{ucwords(strtok(strtolower($employee -> nama),""))}}--}}
                                                {{--{{ url('/employeebiodata/'.$employee->id.'/edit') }}--}}
                                            {{--</td>--}}
                                            <!--<td>-->
                                            <!--        <a onclick="return confirm('Are you sure you want to delete this item?');" class="btn btn-outline-danger"-->
                                            <!--           href="{{ url('/payroll/run/payrolling/delete/'.$employee->inputid) }}"><i class="fas fa-trash-alt"></i>-->
                                            <!--        </a>-->

                                            <!--</td>-->
                                            <td>
                                                @if($employee->is_report_locked)
                                                <form id="unlock-time-report-form" action="{{route('unlockTimeReport', ['id' => $employee->statusid])}}" method="POST">
                                                    <a href="javascript: unlockTimeReport();"><i class="fas fa-lock text-success"></i></a>                                                </a>
                                                    <script>
                                                        function unlockTimeReport(){
                                                            $('#unlock-time-report-form').submit();
                                                        }
                                                        </script>
                                                    @csrf
                                                </form>
                                                @else
                                                <form id="lock-time-report-form" action="{{route('lockTimeReport', ['id' => $employee->statusid])}}" method="POST">
                                                    <a href="javascript: lockTimeReport();"><i class="fas fa-unlock text-secondary"></i></a>                                                </a>
                                                    <script>
                                                        function lockTimeReport(){
                                                            $('#lock-time-report-form').submit();
                                                        }
                                                        </script>
                                                    @csrf
                                                </form>
                                                @endif
                                            </td>
                                            <td>
                                                {{-- @if($employee -> payrollcheck == null) --}}

                                                    <!--<a class="btn btn-success"-->
                                                    <!--   href="{{ url('/payroll/run/payrolling/'.$employee->nip.'/1/'.$employee->nama) }}">Process-->
                                                    <!--</a>-->
                                                @if($employee -> payrollcheck == 'done')
                                                <i class="fa fa-check-circle text-success" aria-hidden="true"></i>
                                                @else
                                                <i class="fa fa-check-circle text-secondary" aria-hidden="true"></i>
                                                @endif
                                                {{-- {{ucwords(strtok(strtolower($employee -> nama),""))}}--}}
                                                {{--{{ url('/employeebiodata/'.$employee->id.'/edit') }}--}}
                                            </td>
                                        </tr>
                                    @endforeach
                                @endif
                                </tbody>
                                <tfoot>
                                <tr>
                                    <th style="opacity: 0;">No</th>
                                    <th style="opacity: 0;">NIP</th>
                                    <!--<th style="opacity: 0;"></th>-->
                                    <th>Kota</th>
                                    <th>Institusi</th>
                                    <th style="opacity: 0;">Nama</th>
                                    <!--<th>Opt</th>-->
                                    <th style="opacity: 0;">Time Report Status</th>
                                    <th style="opacity: 0;">Payroll Status</th>
                                </tr>
                                </tfoot>
                            </table>


                            <td>
                                <!--<a href="{{ url('/importpayrollinput') }}">-->
                                <!--    <button type="button" class="btn btn-primary"><i class="far fa-file-alt"></i> Masukkan Data Input-->
                                <!--    </button>-->
                                <!--</a>-->
                                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal"><i class="fa fa-file-excel-o" aria-hidden="true"></i>
                                    Input Data</button>
                                <a class="btn btn-warning"
                                                       href="{{ url('/payroll/run/payrolling/simulation/'.request()->period) }}"><i class="fa fa-calculator" aria-hidden="true"></i>
                                                        Kalkulasi Payroll
                                                    </a>
                                <a href="{{  url()->previous()  }}">
                                <a class="btn btn-success"
                                                       href="{{ url('/payroll/run/payrolling/all/'.request()->period) }}"><i class="fa fa-bolt" aria-hidden="true"></i>
                                                       Proses Semua
                                                    </a>
                                <a href="{{  url()->previous()  }}">
                                    <button type="button" class="btn btn-outline-secondary">Kembali</button>
                                </a>

                            </td>
                        </div>
                        <!-- Trigger the modal with a button -->


<!-- Modal -->
<div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Masukkan Data Input</h4>
      </div>
      <div class="modal-body">
        <form class="form-horizontal" method="POST" action="{{ route('importdatapayrollinput') }}"
                              enctype="multipart/form-data">
                            {{ csrf_field() }}

                            <div class="form-group{{ $errors->has('templatepayrollinput') ? ' has-error' : '' }}">
                                <input id="templatepayrollinput" type="file" class="button" name="templatepayrollinput" required>
                                @if ($errors->has('templatepayrollinput'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('templatepayrollinput') }}</strong>
                                    </span>
                                @endif
                                <div class="invalid-feedback">Example invalid custom file feedback</div>
                            </div>


                            <button type="submit" class="btn btn-primary">
                                Masukkan Data
                            </button>
                            <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
                            <!--<a href="{{ url()->previous() }}">-->
                            <!--        <button type="button" class="btn btn-outline-secondary">Batal</button>-->
                            <!--    </a>-->

                        </form>
      </div>
    </div>

  </div>
</div>

                    </div>

                </div>
            </div>
        </div>
    </div>
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
    <script src="https://cdn.datatables.net/plug-ins/f2c75b7247b/integration/bootstrap/3/dataTables.bootstrap.js"></script>
    <script src="https://cdn.datatables.net/responsive/1.0.4/js/dataTables.responsive.js"></script>
    <script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
    <script>
        $(document).ready(function () {

            if( /Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent) ) {
                $('#example').DataTable({
                    // scrollY:300,
                    // scrollX:true,
                    // scrollCollapse: true,
                    // paging:false,
                    // fixedColumns: true,
                    // fixedHeader: true,
                    rowReorder: {
                        selector: 'td:nth-child(2)'
                    },
                    responsive: true,

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
            }
            else{
                $('#example').DataTable({
                    // fixedColumns: {
                    //     leftColumns: 2
                    // },
                    // scrollY:        400,
                    // scrollX:        true,
                    // fixedColumns:   true,
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
            }
        });
    </script>
@endsection
