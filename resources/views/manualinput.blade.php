@extends('layouts.app')
@section('title', 'Input Manual')

@section('content')
    <style>
        .form-control {
            /*margin: .375rem 0;*/
            padding: 0 .55rem;
            max-width: 70px;
            min-width: 60px;
            border-radius: 10px 0 0 10px;
        }

        .btn-primary {
            border-radius: 0 10px 10px 0;
        }

        .flex-item {
            align-self: center;
        }

        input::-webkit-input-placeholder {
            font-size: .8rem;
            align-items: center;
        }
        .btn{
            padding: .46875rem 1rem !important;
        }
    </style>
    <script src="https://static.codepen.io/assets/common/stopExecutionOnTimeout-de7e2ef6bfefd24b79a3f68b414b87b8db5b08439cac3f1012092b2290c719cd.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
    <script src="https://cdn.datatables.net/plug-ins/f2c75b7247b/integration/bootstrap/3/dataTables.bootstrap.js"></script>
    <script src="https://cdn.datatables.net/responsive/1.0.4/js/dataTables.responsive.js"></script>
    <script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
    <script src='https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.0.0-alpha.6/js/bootstrap.min.js'></script>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card">
                    <div class="card-header card-header-primary">
                        <h4 class="card-title"><b>Cuti Bersama</b></h4>
                        <p class="card-category">Pengurangan jatah cuti untuk seluruh karyawan</p>
                    </div>

                    <div class="card-body">

                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif


                        <div class="container">
                            <div class="flex-container">
                            </div>
                            <form style=""
                                  action="{{ \Illuminate\Support\Facades\URL::to('/manualinput/bulkmodify/') }}"
                                  method="POST">
                                {{ csrf_field() }}

                                @if (session('success'))
                                    <div class="alert alert-success">
                                        {{ session('success') }}
                                    </div>
                                @endif

                                <div style="display: flex">
                                    <div class="row">
                                        <div class="col">
                                            <label for="keteranganpenambahancuti">Keterangan</label>
                                            <br>
                                            <input style="max-width: 200px; min-width: 80px;"
                                                   id="keteranganpenambahancuti" type="text"
                                                   class=""
                                                   name="keteranganpenambahancuti" placeholder="Keterangan"
                                                   value="{{ old('keteranganpenambahancuti') }}"
                                                   required>
                                            <br>

                                            <label for="modifyleave">Jumlah Hari Cuti</label>
                                            <br>
                                            <input style="-webkit-border-radius: 0;-moz-border-radius: 0;border-radius: 0;"
                                                   id="modifyleave" type="number"
                                                   class=""
                                                   name="modifyleave" placeholder="Jumlah"
                                                   value="{{ old('modifyleave') }}"
                                                   required>

                                        </div>
                                        <div class="col">
                                            <label for="tanggalmulaicuti">Tanggal Mulai Cuti</label>
                                            <br>
                                            <input style="-webkit-border-radius: 0;-moz-border-radius: 0;border-radius: 0;"
                                                   id="tanggalmulaicuti" type="date"
                                                   class=""
                                                   name="tanggalmulaicuti"
                                                   required>
                                            <br>
                                            <label for="tanggalakhircuti">Tanggal Akhir Cuti</label>
                                            <br>
                                            <input style="-webkit-border-radius: 0;-moz-border-radius: 0;border-radius: 0;"
                                                   id="tanggalakhircuti" type="date"
                                                   class=""
                                                   name="tanggalakhircuti"
                                                   required>
                                            <br>
                                        </div>
                                    </div>
                                </div>
                                <div>
                                    <button type="submit" class="btn btn-success">
                                        Bulk<!--{{ __('Submit') }}-->
                                    </button>
                                </div>
                            </form>

                            <!-- Time report per nama dan per PT-->
                        </div>
                    </div>


                </div><br>
                
                <div class="card">
                    <div class="card-header card-header-primary">
                        <h4 class="card-title"><b>Jatah Cuti</b></h4>
                        <p class="card-category">Penambahan jatah cuti untuk seluruh karyawan</p>
                    </div>

                    <div class="card-body">

                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif


                        <div class="container">
                            <div class="flex-container">
                            </div>
                            <form style=""
                                  action="{{ \Illuminate\Support\Facades\URL::to('/manualinput/bulkmodify/plus') }}"
                                  method="POST">
                                {{ csrf_field() }}

                                @if (session('success'))
                                    <div class="alert alert-success">
                                        {{ session('success') }}
                                    </div>
                                @endif

                                <div style="display: flex">
                                    <div class="row">
                                        <div class="col">
                                            <label for="keteranganpenambahancuti">Keterangan</label>
                                            <br>
                                            <input style="max-width: 200px; min-width: 80px;"
                                                   id="keteranganpenambahancuti" type="text"
                                                   class=""
                                                   name="keteranganpenambahancuti" placeholder="Keterangan"
                                                   value="{{ old('keteranganpenambahancuti') }}"
                                                   required>
                                            <br>

                                            <label for="modifyleave">Jumlah Hari Cuti</label>
                                            <br>
                                            <input style="-webkit-border-radius: 0;-moz-border-radius: 0;border-radius: 0;"
                                                   id="modifyleave" type="number"
                                                   class=""
                                                   name="modifyleave" placeholder="Jumlah"
                                                   value="{{ old('modifyleave') }}"
                                                   required>

                                        </div>
                                    </div>
                                </div>
                                <div>
                                    <button type="submit" class="btn btn-success">
                                        Bulk<!--{{ __('Submit') }}-->
                                    </button>
                                </div>
                            </form>

                            

                            <!-- Time report per nama dan per PT-->
                        </div>
                    </div>


                </div><br>
                
                <div class="card">
                    <div style="padding: 0;" class="card-header">
                        <div class="card-header card-header-primary">
                            <h4 class="card-title"><b>Cuti Manual</b></h4>
                            <p class="card-category">Penambahan cuti secara manual. 1 = Jatah Cuti, 2 = Penambahan</p>
                        </div>

                    </div>
                    <div class="card-body">

                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif


                        <div class="container">
                            <table class="table table-striped table-responsive-md display" id="example">
                                <p>Click the number to expand options</p>
                                <thead>
                                <tr>
                                    <th>No</th>
                                    <th>NIP</th>
                                    <th></th>
                                    <th>Nama</th>

                                    <th>Penambahan</th>
                                </tr>
                                </thead>
                                <tbody>
                                <div style="display: none">{{$no = 1}}</div>
                                @foreach($employees as $employee)
                                    <tr>
                                        <td>{{ $no++ }}</td>
                                        <td>{{ $employee->nip }}
                                        </td>

                                        <td>
                                            <a href="{{ url('/manualinput/checkdetail/'.$employee->nip) }}"><i class="fas fa-search-plus"></i></a>
                                        </td>
                                        <td>{{ucwords(strtolower($employee->nama))}}</td>
                                        <td style="display: flex;">
                                            <form style="display: flex; "
                                                  action="{{ URL::to('/manualinput/modify/'.$employee->nip) }}"
                                                  method="POST">
                                                {{ csrf_field() }}
                                                <input style="-webkit-border-radius: 0;-moz-border-radius: 0;border-radius: 0;"
                                                       id="penambahancuti" step=0.01 type="number"
                                                       class="form-control{{ $errors->has('penambahancuti') ? ' is-invalid' : '' }}"
                                                       name="penambahancuti" placeholder="Jumlah"
                                                       value="{{ old('penambahancuti') }}"
                                                       required>
                                                

                                        <div style="padding: 5px;">
                                            <input
                                                       id="modifystatus" step=0.01 type="radio"
                                                       class=""
                                                       name="modifystatus"
                                                       value="1"
                                                       >
                                                       <label for="1">1</label>
                                        </div>
                                                       


                                        <div style="padding: 5px;">
                                            <input 
                                                       id="modifystatus" step=0.01 type="radio"
                                                       class=""
                                                       name="modifystatus" 
                                                       value="2"
                                                       >
                                                                                                              <label for="2">2</label>
                                        </div>

                                                       
                                                       
                                                <input 
                                                       id="keteranganpenambahancuti" step=0.01 type="text"
                                                       class="form-control{{ $errors->has('keteranganpenambahancuti') ? ' is-invalid' : '' }}"
                                                       name="keteranganpenambahancuti" placeholder="Keterangan"
                                                       value="{{ old('keteranganpenambahancuti') }}"
                                                       required>

                                                       
                                                       

                                                
                                                <button type="submit" class="btn btn-primary">
                                                    Submit
                                                </button>

                                            </form>


                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>

                            </table>
                            <a href="{{ url('/') }}">
                                <button type="button" class="btn btn-outline-primary"><i class="fas fa-home"></i> Back to home</button>
                            </a>
                        </div>
                        <script>
                            var msg = '{{Session::get('alert')}}';
                            var exist = '{{Session::has('alert')}}';
                            if (exist) {
                                alert(msg);
                            }
                        </script>
                            <script>
                                $(document).ready(function () {

                                    $('#example').DataTable({
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

                                });
                            </script>

                        <!-- Time report per nama dan per PT-->
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
