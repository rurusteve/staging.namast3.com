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
                            <p>Total: {{ $count }} Employee</p>
                            <div style="display: flex;">
                                <div class="flex-container" style="margin-right: 30px;">
                                    <div class="row">
                                        <div class="dropdown-header flex-item">Filter:</div>
                                        <form class="flex-item" method="GET"
                                              action="{{ URL::to('/searchmanualinput') }}">
                                            <label style="display: none;" for="searchname"></label>
                                            <input placeholder="Find by name" type="text" name="searchname"
                                                   id="searchname">
                                            <button class="btn btn-light" type="submit">Find</button>
                                        </form>
                                    </div>
                                </div>
                                <div class="dropdown show">
                                    <a class="btn btn-secondary dropdown-toggle" href="#" role="button"
                                       id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true"
                                       aria-expanded="false">
                                        Filter by:
                                    </a>

                                    <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                        <a style="text-decoration: underline" class="dropdown-item"
                                           href=""><b>Institusi</b></a>
                                        <a class="dropdown-item" href="?institusi=solis">SOLIS</a>
                                        <a class="dropdown-item" href="?institusi=msid">MSId</a>
                                        <a style="text-decoration: underline" class="dropdown-item" href=""><b>Kota</b></a>
                                        <a class="dropdown-item" href="?kota=jakarta">Jakarta</a>
                                        <a class="dropdown-item" href="?kota=batam">Batam</a>
                                        <a style="text-decoration: underline" class="dropdown-item" href=""><b>Status</b></a>
                                        <a class="dropdown-item" href="?status=resign">Resign</a>
                                        <a class="dropdown-item" href="?status=permanent">Permanent</a>

                                    </div>
                                </div>
                                <div class="dropdown show">
                                    <a class="btn btn-secondary dropdown-toggle" href="#" role="button"
                                       id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true"
                                       aria-expanded="false">
                                        Sort by:
                                    </a>

                                    <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                        <a class="dropdown-item" href="?nama">NIP</a>
                                        <a class="dropdown-item" href="?nama">Nama</a>
                                        <a class="dropdown-item" href="?tanggalbergabung">Lama Bergabung</a>
                                        <a class="dropdown-item" href="?positionid">Posisi</a>
                                        <a class="dropdown-item" href="?orderstatus">Status</a>

                                    
                                    </div>
                                </div>
                                <br><br>
                            </div>
                            <table class="table table-striped table-responsive-md">
                                <thead>
                                <tr>
                                    <th style="width: 3%">No</th>
                                    <th style="width: 16%">NIP</th>
                                    <th style="width: 27%">Nama</th>
                                    <th style="width: 10%">Institusi</th>
                                    <th style="width: 9%">Kota</th>
                                    <th style="width: 17%">Lama Bergabung</th>
                                    {{--<th>Posisi</th>--}}
                                    <th style="width: 18%">Opsi</th>

                                </tr>
                                </thead>
                                <tbody>
                                @foreach($employees as $employee)
                                    <tr>
                                        <td>{{ (($employees->currentPage() - 1 ) * $employees->perPage() ) + $loop->iteration }}</td>
                                        <td>
                                            <a href="{{ url('/account/'.$employee->id.'/detail') }}">{{ucwords($employee->nip)}}</a>
                                        </td>
                                        <td>{{ucwords(strtolower($employee->nama))}}</td>
                                        <td>
                                            @if($employee->institusi == 'SOLIS')
                                                Solis
                                            @elseif($employee->institusi == 'MSId')
                                                MSId
                                            @else
                                                Unknown
                                            @endif
                                        </td>
                                        <td>{{ucwords(strtolower($employee->kota))}}</td>
                                        <td>{{Carbon\Carbon::parse($employee->tanggalbergabung)->diffInMonths(now(), false)}}
                                            bln, {{Carbon\Carbon::parse($employee->tanggalbergabung)->diffInYears(now(), false)}}
                                            thn
                                        </td>
                                        {{--<td>{{ucwords(strtolower($employee->positionid))}}--}}
                                        {{--@if ($employee->positionid == 1)--}}
                                        {{--Manager--}}
                                        {{--@elseif ($employee->positionid == 2)--}}
                                        {{--Supervisor--}}
                                        {{--@elseif ($employee->positionid == 3)--}}
                                        {{--Assistant Spv--}}
                                        {{--@elseif ($employee->positionid == 4)--}}
                                        {{--Senior--}}
                                        {{--@elseif ($employee->positionid == 5)--}}
                                        {{--Semi Senior--}}
                                        {{--@elseif ($employee->positionid == 6)--}}
                                        {{--Junior--}}
                                        {{--@elseif ($employee->positionid == 7)--}}
                                        {{--Contract--}}
                                        {{--@elseif ($employee->positionid == 8)--}}
                                        {{--Junior Exp--}}
                                        {{--@elseif ($employee->positionid == 9)--}}
                                        {{--Senior Exp--}}
                                        {{--@elseif ($employee->positionid == 10)--}}
                                        {{--Associate Manager--}}
                                        {{--@elseif ($employee->positionid == 11)--}}
                                        {{--Associate Spv--}}
                                        {{--@elseif ($employee->positionid == 12)--}}
                                        {{--Senior Administrator--}}
                                        {{--@elseif ($employee->positionid == 13)--}}
                                        {{--Administrator--}}
                                        {{--@elseif ($employee->positionid == 14)--}}
                                        {{--Junior Administrator--}}
                                        {{--@elseif ($employee->positionid == 15)--}}
                                        {{--Entree--}}
                                        {{--@else--}}
                                        {{--Unknown--}}
                                        {{--@endif--}}

                                        {{--@if ($employee->positionid == 1)--}}
                                        {{--Junior 1A--}}
                                        {{--@elseif ($employee->positionid == 2)--}}
                                        {{--Junior 1B--}}
                                        {{--@elseif ($employee->positionid == 3)--}}
                                        {{--Semi Senior--}}
                                        {{--@elseif ($employee->positionid == 4)--}}
                                        {{--Semi Senior (EXP)--}}
                                        {{--@elseif ($employee->positionid == 5)--}}
                                        {{--Senior--}}
                                        {{--@elseif ($employee->positionid == 6)--}}
                                        {{--Senior (EXP)--}}
                                        {{--@elseif ($employee->positionid == 7)--}}
                                        {{--Ass. Supervisor--}}
                                        {{--@elseif ($employee->positionid == 8)--}}
                                        {{--Supervisor--}}
                                        {{--@elseif ($employee->positionid == 9)--}}
                                        {{--Junior Manager--}}
                                        {{--@elseif ($employee->positionid == 10)--}}
                                        {{--Manager--}}
                                        {{--@elseif ($employee->positionid == 11)--}}
                                        {{--Senior Manager--}}
                                        {{--@elseif ($employee->positionid == 12)--}}
                                        {{--Junior Partner--}}
                                        {{--@elseif ($employee->positionid == 13)--}}
                                        {{--Client Svs. Partner--}}
                                        {{--@elseif ($employee->positionid == 14)--}}
                                        {{--Signing Partner--}}
                                        {{--@elseif ($employee->positionid == 15)--}}
                                        {{--Senior Partner--}}
                                        {{--@elseif ($employee->positionid == 16)--}}
                                        {{--Admin--}}
                                        {{--Entree--}}
                                        {{--@elseif ($employee->positionid == 17)--}}
                                        {{--Junior Administrator--}}
                                        {{--@elseif ($employee->positionid == 18)--}}
                                        {{--Administrator--}}
                                        {{--@elseif ($employee->positionid == 19)--}}
                                        {{--Senior Administrator--}}
                                        {{--@elseif ($employee->positionid == 20)--}}
                                        {{--Ass. Supervisor--}}
                                        {{--@elseif ($employee->positionid == 21)--}}
                                        {{--Supervisor--}}
                                        {{--@elseif ($employee->positionid == 22)--}}
                                        {{--Ass. Manage r--}}
                                        {{--@elseif ($employee->positionid == 23)--}}
                                        {{--Manager--}}
                                        {{--@elseif ($employee->positionid == 24)--}}
                                        {{--General Manager--}}
                                        {{--@else--}}
                                        {{--Unknown--}}
                                        {{--@endif--}}
                                        {{--</td>--}}
                                        <td>
                                            <a class="btn btn-success"
                                               href="{{ url('/employeedatabase/'.$employee->id.'/edit') }}">Edit</a>
                                            @if($role == 1)
                                                <button class='btn btn-xs btn-danger' type='submit' data-toggle="modal"
                                                        data-target="#confirmDelete" data-title="Delete User"
                                                        data-message='Are you sure you want to delete this user ?'>
                                                    <i class='glyphicon glyphicon-trash'></i> Delete
                                                </button>
                                                @include('deleteconfirm')
                                            @else
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                            {{ $employees->links() }}


                            <td>
                                <a href="{{ url('/user/payrollandlogin/form') }}">
                                    <button type="button" class="btn btn-primary">New Employee</button>
                                </a>
                                <a href="{{ url('/importemployee') }}">
                                    <button type="button" class="btn btn-primary"><i class="far fa-file-alt"></i> Import
                                        CSV
                                    </button>
                                </a>
                                <a href="{{url()->previous()}}">
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
