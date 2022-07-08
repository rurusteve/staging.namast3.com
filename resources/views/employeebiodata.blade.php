@extends('layouts.app')
@section('title', 'Employee Biodata')
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
    .dataTables_wrapper .dataTables_paginate .paginate_button {
        font-size: 0.8em;
        position: relative;
        padding: 0;
        margin-left: -1px;
        background-color: transparent;
        border: 0;
    }
    .dataTables_wrapper .dataTables_paginate .paginate_button:hover{
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
                        <h3 class="card-title"><b>Employee Biodata</b></h3>
                        <p class="card-category">List of employee's biodata</p>
                    </div>
                    <div class="card-body">
                        <div class="container">
                            {{--<div style="display: flex;">--}}
                                {{--<div class="dropdown show">--}}
                                    {{--<a class="btn btn-secondary dropdown-toggle" href="#" role="button"--}}
                                       {{--id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true"--}}
                                       {{--aria-expanded="false">--}}
                                        {{--Filter by:--}}
                                    {{--</a>--}}

                                    {{--<div class="dropdown-menu" aria-labelledby="dropdownMenuLink">--}}

                                    {{--</div>--}}
                                {{--</div>--}}
                                {{--<div class="dropdown show">--}}
                                    {{--<a class="btn btn-secondary dropdown-toggle" href="#" role="button"--}}
                                       {{--id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true"--}}
                                       {{--aria-expanded="false">--}}
                                        {{--Sort by:--}}
                                    {{--</a>--}}

                                    {{--<div class="dropdown-menu" aria-labelledby="dropdownMenuLink">--}}

                                    {{--</div>--}}
                                {{--</div>--}}
                                {{--<br><br>--}}
                            {{--</div>--}}
                            <table style="font-size: 1em;" class="table table-striped table-responsive-md" id="example">
                                <thead>
                                <tr>
                                    <th style="width: 3%">No</th>
                                    <th style="width: 16%">NIP</th>
                                    <th style="width: 25%">Nama</th>
                                    <th style="width: 12%">Tanggal Lahir</th>
                                    <th style="width: 16%">Alamat</th>
                                    <th style="width: 10%">Agama</th>
                                    <th style="width: 18%">Opsi</th>

                                </tr>
                                </thead>
                                <tbody>
                                <div style="display: none">{{$no = 1}}</div>
                                @foreach($biodatas as $biodata)
                                    <tr>

                                        <td>{{ $no++ }}</td>
                                        <td><a href="{{ url('/account/'.$biodata->id.'/detail') }}">{{ucwords($biodata->nip)}}</a></td>
                                        <td>{{ ucwords(strtolower($biodata -> nama)) }}</td>
                                        <td>{{Carbon\Carbon::parse($biodata->tanggallahir)->format('d/m/Y')}}
                                            </td>
                                        <td>{{ $biodata -> domisili }}</td>
                                        <td>{{ ucwords(strtolower($biodata -> agama)) }}</td>
                                        <td>
                                            <a
                                               href="{{ url('/biodata/'.$biodata->id.'/edit') }}"><i style="color: green;" class="fas fa-pencil-alt"></i></a>
                                            @if($role == 1)
                                            <button class='btn btn-xs btn-danger' type='submit' data-toggle="modal"
                                                    data-target="#confirmDelete" data-title="Delete User"
                                                    data-message='Are you sure you want to delete this user ?'>
                                                <i class='glyphicon glyphicon-trash'></i> Delete
                                            </button>
                                            @include('deleteconfirmbiodata')
                                                @else
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>

                            </table>
                            <td>
                                <a href="{{ url('/user/biodata/form') }}">
                                    <button type="button" class="btn btn-primary">+ Add New Employee Biodata</button>
                                </a>
                                <a href="{{ url('/importbiodata') }}">
                                    <button type="button" class="btn btn-primary"><i class="far fa-file-alt"></i> Import CSV</button>
                                </a>
                                <a href="{{ url('/biodata/home') }}">
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
