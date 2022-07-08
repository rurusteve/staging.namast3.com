@extends('layouts.app')
@section('title', 'Team Management')

@section('content')
    <style>
        tbody td:nth-child(1):hover{
            cursor: pointer;
        }

    </style>
    <div class="container">

        <div class="row justify-content-center align-self-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header card-header-success card-header-icon">
                        <div class="card-icon">
                            <i style="font-size: 1.2em" class="fas fa-street-view"></i>
                        </div>
                        <h3 class="card-title">Member</h3>
                    </div>
                    <div class="card-body">
                        <p><i>Please click the number to expand menu</i></p>
                        <table class="table table-responsive table-striped table-bordered" id="example">
                            <thead>
                            <tr style="color: white; font-weight: bold;" class="bg-success">
                                <td>No.</td>
                                <td>NIP</td>
                                <td>Name</td>
                                <td>Team</td>
                                <td>Branch</td>
                                <td>Status</td>
                                <td>IC</td>
                                <td>Move group</td>
                                <td>Change IC</td>
                            </tr>
                            </thead>
                            <tbody>

                            <div style="display: none">{{$no = 1}}</div>
                            @foreach($employees as $employee)
                                <tr>
                                    <td>{{$no++}}</td>
                                    <td>{{$employee->nip}}</td>
                                    <td>
                                        @if(strlen($employee->nama) <= 25)
                                        {{$employee->nama}}
                                        @else
                                        {{substr($employee->nama,0,25)}}..
                                        @endif
                                    </td>
                                    <td>{{$employee->groupName}}</td>
                                    <td>{{$employee->kota}}</td>
                                    <td>{{$employee->status}}</td>
                                    <td>
                                        @if($employee->inchargestatus == 1)
                                            <i style="color: green" class="fas fa-check-circle"></i>
                                        @elseif ($employee->inchargestatus == 0)
                                            <i style="color: red" class="fas fa-times-circle"></i>
                                        @else
                                        @endif
                                    </td>
                                    <td>
                                        <form action="{{ url('/teammanagement/move/'.$employee->nip) }}" style=" display: flex; justify-content: center;" method="post">
                                            @csrf
                                               <div style="min-width: 400px; justify-content:center;" class="row">
                                                    <select style="width: 60%;" name="divisi" id="divisi" class="form-control">
                                                <option disabled selected>{{$employee->group->name}}</option>
                                                @foreach($groups as $group)
                                                    @if($group->group->id != $employee->group->id)
                                                    <option value="{{$group->divisi}}">{{$group->group->name}}</option>
                                                    @endif
                                                @endforeach
                                            </select>
                                            <button class="btn btn-warning" type="submit">Move</button>
                                               </div>
                                        </form>
                                    </td>
                                    <td >
                                        <form action="{{ url('/teammanagement/changeincharge/'.$employee->nip) }}" style="display: flex; justify-content: center;" method="post" >
                                            @csrf
                                           <div style="min-width: 400px; justify-content:center;" class="row">
                                                <select style="width: 60%;" name="inchargestatus" id="inchargestatus" class="form-control">
                                                <option disabled selected>
                                                    @if($employee->inchargestatus == 0)
                                                        Non-incharge
                                                        @elseif($employee->inchargestatus == 1)
                                                    Incharge
                                                        @else
                                                    Unknown
                                                        @endif
                                                </option>
                                                <option value="1">Incharge</option>
                                                <option value="0">Non-incharge</option>

                                            </select>
                                            <button class="btn btn-success" type="submit">Change</button>
                                           </div>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                            <tfoot>
                            <tr>
                                <td>No.</td>
                                <td>NIP</td>
                                <td>Name</td>
                                <td>Team</td>
                                <td>Branch</td>
                                <td>Status</td>
                                <td>IC</td>
                                <td>Move group</td>
                                <td>Change IC</td>
                            </tr>
                            </tfoot>
                            <tbody>
                        </table>
                    </div>
                </div>
            </div>

            <div class="col-md-12">
                <div class="card">
                    <div class="card-header card-header-info card-header-icon">
                        <div class="card-icon">
                            <i style="font-size: 1.2em" class="fas fa-users"></i>
                        </div>
                        <h3 class="card-title">Groups</h3>
                    </div>
                    <div class="card-body">
                        <table class="table table-striped table-bordered">

                            <thead>
                            <tr style="color: white; font-weight: bold;" class="bg-primary">
                                <td>Name</td>
                                <td>Member</td>
                                <td>Incharge</td>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($groups as $group)
                                <tr>
                                    <td>{{$group->group->name}}</td>
                                    <td>{{$group->countmember}}</td>
                                    <td>{{$group->countincharge}}</td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>

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
                // responsive: {
                //     details: {
                //         display: $.fn.dataTable.Responsive.display.modal({
                //             header: function (row) {
                //                 var data = row.data();
                //                 return 'Details for ' + data[1] + ' on ' + data[0];
                //             }
                //         }),
                //         renderer: $.fn.dataTable.Responsive.renderer.tableAll({
                //             tableClass: 'table'
                //         })
                //     }
                // },
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
