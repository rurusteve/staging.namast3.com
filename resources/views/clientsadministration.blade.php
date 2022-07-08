@extends('layouts.app')
@section('title', 'Clients Administration')
@section('content')
    <script src="https://code.jquery.com/jquery-3.3.1.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/js/bootstrap.min.js"></script>

    <script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.2.3/js/dataTables.responsive.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.2.3/js/responsive.bootstrap4.min.js"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.css">
    <link href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css">
    <link href="https://cdn.datatables.net/responsive/2.2.3/css/responsive.bootstrap4.min.css">
    <style>
        td:first-child {
            font-weight: bold;
            text-align: left;
            border-radius: 0;
        }


        th {
            font-weight: bold;
        }
        tr:hover{
            background-color: whitesmoke;
        }
        tr:hover > td:first-child{
            /*background-color: whitesmoke;*/
        }

        td:first-child:hover {
            /*background-color: #59cbd9;*/
            background-color: blueviolet;
            color: whitesmoke;
            cursor: pointer;
            /*border-radius: 30px;*/
        }
    </style>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card">
                    <div class="card-header card-header-info card-header-icon">
                        <div class="card-icon">
                            <i class="fas fa-city"></i>
                        </div>
                        <h3 class="card-title">MSId Client List</h3>
                    </div>
                    <div class="card-header" style="background-color: rgba(178,174,179,0.14); color: white;">
                        <a style="float:left;" href="{{ url('/administration/timereport/clients/msid') }}"><i class="fas fa-arrow-circle-left"></i> MSId</a>
                        <a style="float:right;" href="{{ url('/administration/timereport/clients/solis') }}">Solis <i class="fas fa-arrow-circle-right"></i></a>
                    </div>

                    <style>
                        .btn:hover {
                            background-color: white;
                        }
                    </style>
                    <div class="card-body">
                        <table style=" display: inline-table; width: 100%; overflow-x: auto;font-size: 12px;"
                               class="table responsive table-responsive-md display hover"
                               id="example">
                            <p style="font-style: italic; color: darkgrey;">Note: Click table's title to sort the data,
                                click the number to view detail</p>

                            <thead>
                            <tr>
                                <th>No.</th>
                                <th>Name</th>
                                <th>Type</th>
                                <th>Period</th>
                                <th>Code</th>
                                <th>Opt.</th>

                            </tr>

                            </thead>
                            <tbody>
                            <div style="display: none">{{ $index = 0 }}</div>
                            @foreach($clients as $index => $client)
                                <tr>
                                    <td>{{ $index + 1 }}</td>
                                    <td>{{ $client -> clientname }}</td>
                                    <td>{{ $client -> engagementtype }}</td>
                                  
                                    <td>{{ date('d M Y', strtotime($client -> engagementperiod))  }}</td>
                                    <td>{{ $client -> clientcode }}</td>
                                    <td>

                                        <a href="{{ url('/administration/timereport/'.$client->id.'/deleteclient') }}">
                                            <button onclick="return confirm('Are you sure?')"
                                                    class='btn btn-xs btn-danger'
                                                    style="padding: 15px; border-radius: 5px"
                                                    type='submit'
                                                    data-toggle="tooltip" data-placement="top"
                                                    title="Batalkan permintaan cuti"
                                                    data-target="#confirmDelete" data-title="Delete User"
                                                    data-message='Are you sure you want to delete this user ?'>
                                                <i class="fas fa-trash-alt"></i>
                                            </button>
                                        </a>
                                        <a href="{{ url('/administration/timereport/'.$client->id.'/detail') }}">
                                            <button class='btn btn-xs btn-info'
                                                    style="padding: 15px; border-radius: 5px"
                                                    type='submit' data-toggle="modal"
                                                    data-toggle="tooltip" data-placement="top"
                                                    title="Lihat detail ajuan cuti"
                                                    data-target="#confirmDelete" data-title="Delete User"
                                                    data-message='Are you sure you want to delete this user ?'>
                                                <i class="fas fa-search-plus"></i>
                                            </button>
                                        </a>

                                    </td>


                                </tr>
                            @endforeach
                            </tbody>
                            <tfoot>
                            <tr>
                                <th>No</th>
                                <th>Code</th>
                                <th>Period</th>
                                <th>Type</th>
                                <th>Name</th>
                                <th>Opt</th>
                            </tr>
                            </tfoot>
                        </table>

                        <a class="btn btn-outline-primary" style="margin-right: 5px;" href="{{ URL::to('/home') }}">
                            <i class="fas fa-home"></i> Back to Home
                        </a>
                        <a class="btn btn-success" style="margin-right: 5px;"
                           href="{{ URL::to('/administration/timereport/addclient') }}">
                            <i class="fas fa-briefcase"></i> New Client
                        </a>
                        <a class="btn btn-success" style="margin-right: 5px; color: white;" data-toggle="modal"
                           data-target="#exampleModalCenter3">
                            <i class="fas fa-file-alt"></i> Bulk Import
                        </a>

                        <div class="modal fade" id="exampleModalCenter3" tabindex="-1" role="dialog"
                             aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered" role="document">
                                <div class="modal-content">
                                    <div class="card">
                                        <div class="card-body">
                                            <h5 class="card-title">
                                                Hi, {{ucwords(strtolower(Auth::user()->name))}}</h5>

                                            <div style="border-bottom: 2px solid #e0e0e0;"></div>
                                            <form method="POST" action="{{ route('importclient') }}"
                                                  enctype="multipart/form-data">
                                                {{ csrf_field() }}
                                                <br>
                                                <div class="form-group">
                                                    <label for="file">Upload Template</label>
                                                    <input type="file" class="form-control-file" name="file"
                                                           id="file"
                                                           placeholder="">
                                                </div>
                                                <button type="submit" class="btn btn-success"><i
                                                            class="fas fa-cloud-upload-alt"></i> Submit
                                                </button>
                                            </form>
                                        </div>
                                    </div>
                                    {{--<div class="modal-footer">--}}
                                    {{--<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>--}}
                                    {{--<button type="button" class="btn btn-primary">Save changes</button>--}}
                                    {{--</div>--}}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
    <script>
        $(document).ready(function () {

            $('#example').DataTable({
                stateSave: true,
                columnDefs: [
                    { responsivePriority: 2, targets: 0 },
                ],
                responsive: {
                    details: {
                        display: $.fn.dataTable.Responsive.display.modal({
                            header: function (row) {
                                var data = row.data();
                                return 'Details for ' + data[1] + ' on ' + data[0];
                            }
                        }),
                        renderer: $.fn.dataTable.Responsive.renderer.tableAll({
                            tableClass: 'table'
                        })
                    }
                },
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



