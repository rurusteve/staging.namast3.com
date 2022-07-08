@extends('layouts.app')
@section('title', 'divisions')
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
                            <i style="font-size: 1.5em;" class="fas fa-list-ul"></i>
                        </div>
                        <h3 class="card-title">Division List</h3>
                    </div>
                    <div class="card-body">
                        <table class="table responsive table-responsive-lg table-striped display" id="example">
                            <thead>
                            <tr>
                                <th>No</th>
                                <th>Name</th>
                                <th>Code</th>
                                <!--<th>Branch</th>-->
                                <th>Option</th>
                            </tr>

                            </thead>
                            <tbody>
                            <div style="display: none">{{ $index = 0 }}</div>
                            @foreach($divisions as $index => $division)
                                <tr>
                                    <td>{{ $index + 1 }}</td>
                                    <td>{{ ucwords(strtolower($division->name)) }}</td>
                                    <td>{{ ucwords($division->code) }}</td>
                                    <!--@if($division->branch_id == 1)-->
                                    <!--<td>Jakarta</td>-->
                                    <!--@elseif($division->branch_id == 2)-->
                                    <!--<td>Batam</td>-->
                                    <!--@endif-->
                                    <td>

                                        <a href="{{ url('/administration/timereport/'.$division->id.'/deletedivision') }}">
                                            <button onclick="return confirm('Are you sure?')"
                                                    class='btn btn-xs btn-outline-danger' style="border-radius: 50%"
                                                    type='submit'
                                                    data-toggle="tooltip" data-placement="top"
                                                    title="Batalkan permintaan cuti"
                                                    data-target="#confirmDelete" data-title="Delete User"
                                                    data-message='Are you sure you want to delete this user ?'>
                                                <i class="fas fa-trash-alt"></i>
                                            </button>
                                        </a>
                                        <!--<button class='btn btn-xs btn-outline-primary' style="border-radius: 50%"-->
                                        <!--        type='submit' data-toggle="modal"-->
                                        <!--        data-toggle="tooltip" data-placement="top"-->
                                        <!--        title="Lihat detail ajuan cuti"-->
                                        <!--        data-target="#confirmDelete" data-title="Delete User"-->
                                        <!--        data-message='Are you sure you want to delete this user ?'>-->
                                        <!--    <i class="fas fa-search-plus"></i>-->
                                        <!--</button>-->
                                        @include('deleteconfirm')
                                    </td>

                                </tr>
                            @endforeach
                            {{--@endforeach--}}
                            </tbody>
                        </table>
                        <a class="btn btn-success" style="margin-right: 5px;"
                           href="{{ URL::to('/administration/timereport/adddivision') }}">
                            <i class="fas fa-thumbtack"></i> New division
                        </a>
                        <a class="btn btn-outline-primary" style="margin-right: 5px;" href="{{ URL::to('/home') }}">
                            <i class="fas fa-home"></i> Back to Home
                        </a>

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
