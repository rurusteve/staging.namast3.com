@extends('layouts.app')
@section('title', 'Registered User')
<style>
    input[type=number]::-webkit-inner-spin-button,
    input[type=number]::-webkit-outer-spin-button {
        -webkit-appearance: none;
        margin: 0;
    }

    .dropdown {
        padding-right: 10px;
    }
</style>
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header card-header-primary">
                        <h3 class="card-title"><b>Registered User</b></h3>
                        <p class="card-category">List of registered user in the web</p>
                    </div>
                    <div class="card-body">
                        <div class="container">

                            <table class="table table-striped table-responsive" id="example">
                                <thead>
                                <tr>
                                    <th>No</th>
                                    <th>NIP</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Contact</th>
                                    <th>Login Type</th>
                                </tr>
                                </thead>
                                <tbody>
                                <div style="display: none">{{$no = 1}}</div>
                                @foreach($users as $user)
                                    <tr>
                                        <td>{{$no++}}</td>
                                        <td>{{$user->nip}}</td>
                                        <td>{{ucwords(strtolower($user->name))}}</td>
                                        <td>{{$user->email}}</td>
                                        <td>{{$user->contact}}</td>
                                        <td>
                                            @if($user->logintype === 'nonprofessional')
                                                Non-P.
                                            @elseif($user->logintype === 'professionalaccounting')
                                                P. Accounting
                                            @elseif($user->logintype === 'professionalaudit')
                                                P. Audit
                                            @elseif($user->logintype === 'professionaltax')
                                                P. Tax
                                                @else
                                                Unknown
                                            @endif
                                        </td>


                                    </tr>
                                @endforeach
                                </tbody>
                            </table>


                            <td>
                                <a href="{{ url('/user/add') }}">
                                    <button type="button" class="btn btn-primary">+ Add New User</button>
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
