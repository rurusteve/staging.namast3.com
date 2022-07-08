@extends('layouts.app')
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
        <h2>Welcome to your dashboard {{ Auth::user()->name }} </h2>
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">Daftar Karyawan</div>
                    <div class="card-body">
                        <div class="container">
                            <h2>Employees</h2>

                            <table class="table table-striped table-responsive-md">
                                <thead>
                                <tr>
                                    <th>NIP</th>
                                    <th>Nama</th>
                                    <th>Process Date</th>
                                    <th>Opsi</th>

                                </tr>
                                </thead>
                                <tbody>
                                @foreach($employees as $employee)
                                    <tr>
                                        <td>
                                            {{ucwords($employee->nip)}}
                                        </td>
                                        <td>{{ucwords(strtolower($employee->nama))}}</td>
                                        <td>{{ $employee->created_at }}</td>
                                        <td>
                                            <a class="btn btn-success"
                                               href="{{ url('/koreksiinput/'.$employee->id.'/edit') }}">Edit</a>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                            {{ $employees->links() }}


                            <td>
                                <a href="{{ url('/payrollhome') }}">
                                    <button type="button" class="btn btn-outline-secondary">Back</button>
                                </a>

                            </td>
                        </div>


                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection
