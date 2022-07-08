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
                            <h2>Biodata</h2>
                            
                            <div style="display: flex;">
                                <div class="dropdown show">
                                    <a class="btn btn-secondary dropdown-toggle" href="#" role="button"
                                       id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true"
                                       aria-expanded="false">
                                        Filter by:
                                    </a>

                                    <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">

                                    </div>
                                </div>
                                <div class="dropdown show">
                                    <a class="btn btn-secondary dropdown-toggle" href="#" role="button"
                                       id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true"
                                       aria-expanded="false">
                                        Sort by:
                                    </a>

                                    <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">

                                    </div>
                                </div>
                                <br><br>
                            </div>
                            <table class="table table-striped table-responsive-md">
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
                                @foreach($biodatas as $biodata)
                                    <tr>

                                        <td>{{ (($biodatas->currentPage() - 1 ) * $biodatas->perPage() ) + $loop->iteration }}</td>
                                        <td><a href="{{ url('/biodata/'.$biodata->id.'/detail') }}">{{ucwords($biodata->nip)}}</a></td>
                                        <td>{{ ucwords(strtolower($biodata -> nama)) }}</td>
                                        <td>{{Carbon\Carbon::parse($biodata->tanggallahir)->format('d/m/Y')}}
                                            </td>
                                        <td>{{ $biodata -> domisili }}</td>
                                        <td>{{ $biodata -> agama }}</td>
                                        <td>
                                            <a class="btn btn-success"
                                               href="{{ url('/employeebiodata/'.$biodata->id.'/edit') }}">Edit</a>
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
                            {{ $biodatas->links() }}
                            <td>
                                <a href="{{ url('/user/biodata/form') }}">
                                    <button type="button" class="btn btn-primary">New Biodata</button>
                                </a>
                                <a href="{{ url('/importbiodata') }}">
                                    <button type="button" class="btn btn-primary"><i class="far fa-file-alt"></i> Import CSV</button>
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
