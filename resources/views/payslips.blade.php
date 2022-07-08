@extends('layouts.app')
@section('title', 'Payslips')
<script src="https://code.jquery.com/jquery-3.3.1.js"></script>
<script src="https://cdn.datatables.net/responsive/2.2.3/js/dataTables.responsive.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.2.3/js/responsive.bootstrap4.min.js"></script>
<style>
    .btn{
        padding: 12px !important;
    }
</style>
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">

                    <div class="card-header card-header-primary card-header-icon">
                        <div class="card-icon">
                            <i style="font-size: 1.5em;" class="fas fa-scroll"></i>
                        </div>
                        <h3 class="card-title">Slip Gaji {{$year}}</h3>
                    </div>
                    <div style="display: none">{{ $crypt = str_random(10)}}</div>
                    <div class="card-body">
                        <table class="table responsive table-responsive-lg table-striped display" id="example">
                            <thead>
                            <tr>
                             
                            </tr>

                            </thead>
                            <tbody>
                                <form action="{{ url('/home/encryptslipperiod/'.$year.'/'.$crypt) }}">

                                                    <div style="display: none;" class="form-group row">
                                                        <label for="email" class="col-sm-4 col-form-label text-md-right">{{ __('Username') }}</label>

                                                        <div class="col-md-6">
                                                            <input id="userid" type="text" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="userid" value="{{ Auth::user()->nip }}" required >

                                                            @if ($errors->has('email'))
                                                                <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $errors->first('email') }}</strong>
                                                    </span>
                                                            @endif
                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <label for="periode" class="col-md-12 col-form-label text-md-left"><i class="far fa-calendar-alt"></i> Periode</label>

                                                        <div class="col-md-12">
                                                            <select name="periode" id="periode" class="form-control{{ $errors->has('periode') ? ' is-invalid' : '' }}">
                                                               @if($listbyperiodes == null)
                                                                <option value="" disabled>Choose period</option>
                                                               @else
                                                                <option value="" disabled>Payslips is not available</option>
                                                               @endif

                                                                @foreach($listbyperiodes as $listbyperiode)
                                                                <option value="$listbyperiode->periode">{{date("F", mktime(0, 0, 0, $listbyperiode->periode, 10))}}</option>

                                                                @endforeach
                                                            </select>

                                                            @if ($errors->has('password'))
                                                                <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $errors->first('password') }}</strong>
                                                    </span>
                                                            @endif
                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <label for="password" class="col-md-12 col-form-label text-md-left"><i class="fas fa-lock"></i> Kata Sandi</label>

                                                        <div class="col-md-12">
                                                            <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required >

                                                            @if ($errors->has('password'))
                                                                <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $errors->first('password') }}</strong>
                                                    </span>
                                                            @endif
                                                        </div>
                                                    </div>

                                                    <div class="form-group row mb-0">
                                                        <div class="col-md-8 offset-md-4">
                                                            <button type="submit" class="btn btn-success">
                                                                Buka
                                                            </button>
                                                            <a href="{{ url()->previous() }}" class="btn btn-outline-secondary" data-dismiss="modal">Kembali</a>

                                                        </div>
                                                    </div>
                                                </form>
                            </tbody>
                            
                        </table>
                        <!--<a class="btn btn-success" style="margin-right: 5px;"-->
                        <!--   href="{{ URL::to('/administration/timereport/addtask') }}">-->
                        <!--    <i class="fas fa-thumbtack"></i> New Task-->
                        <!--</a>-->
                        <!--<a class="btn btn-outline-primary" style="margin-right: 5px;" href="{{ URL::to('/home') }}">-->
                        <!--    <i class="fas fa-home"></i> Back to Home-->
                        <!--</a>-->

                    </div>
                </div>

            </div>
        </div>
    </div>
    <script>
        $(document).ready(function () {

            $('#example').DataTable({
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
            // var table = $('#example').DataTable( {
            //     "scrollY": "200px",
            // } );


        });
    </script>

@endsection
