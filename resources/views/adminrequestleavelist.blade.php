@extends('layouts.app')
@section('title', 'On Leaves List')

@section('content')

    <style>
        .btn{
            padding: 12px 15px;
        }
    </style>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-auto">

                @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                @endif

            </div>
        </div>
        {{--<div class="modal-header">--}}
            {{--<h3>{{ucwords(strtolower(Auth::user()->name))}}, here is the list of the newest leave request for you</h3><br>--}}
        {{--</div>--}}
        {{--<br>--}}
        <div class="container">
            <div class="row justify-content-center">

                <div style="margin-bottom: 20px;" class="col-md-8">
                    <div class="card">
                        <div class="card-header card-header-danger card-header-icon">
                            <div class="card-icon">
                                <i style="font-size: 1.5em;" class="fas fa-hiking"></i>
                            </div>
                            <h3 class="card-title">Leave Request</h3>
                        </div>
                        <div style="display: none">{{$no = 1}}</div>
                        <div class="card-body">
                            <table class="table table-hover">
                                <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Name</th>
                                    <th>Date</th>
                                    <th>Req. Date</th>
                                    <th>Detail</th>
                                </tr>
                                </thead>
                                <tbody>
                                @if(Auth::user()->admin == 2 && Auth::user()->division === 'HRD')
                                    @foreach($type6s as $type6)
                                        <tr>
                                            <td>{{$no++}}</td>
                                            <td>{{ ucwords(strtolower($type6->nama)) }}</td>
                                            <td>{{ date('d M', strtotime($type6->tanggalmulaicuti)) }} -
                                                {{ date('d M', strtotime($type6->tanggalakhircuti)) }}
                                            </td>
                                            <td>{{ date('d M', strtotime($type6->created_at)) }}</td>
                                            <td>
                                                <a href="{{ url('/detailcuti/'.$type6->id) }}">
                                                    <button class='btn btn-xs btn-outline-primary'
                                                            style="border-radius: 50%"
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
                                @else
                                    @if ($inchargestatus == 1)
                                        @foreach($type1s as $type1)
                                            <tr>
                                                <td>{{$no++}}</td>
                                                <td>{{ ucwords(strtolower($type1->nama)) }}</td>
                                                <td>{{ date('d M', strtotime($type1->tanggalmulaicuti)) }} -
                                                    {{ date('d M', strtotime($type1->tanggalakhircuti)) }}
                                                </td>
                                                <td>{{ date('d M', strtotime($type1->created_at)) }}</td>
                                                <td>
                                                    <a href="{{ url('/detailcuti/'.$type1->id) }}">
                                                        <button class='btn btn-xs btn-outline-primary'
                                                                style="border-radius: 50%"
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
                                        @foreach($type3s as $type3)
                                            <tr>
                                                <td>{{$no++}}</td>
                                                <td>{{ ucwords(strtolower($type3->nama)) }}</td>
                                                <td>{{ date('d M', strtotime($type3->tanggalmulaicuti)) }} -
                                                    {{ date('d M', strtotime($type3->tanggalakhircuti)) }}
                                                </td>
                                                <td>{{ date('d M', strtotime($type3->created_at)) }}</td>
                                                <td>
                                                    <a href="{{ url('/detailcuti/'.$type3->id) }}">
                                                        <button class='btn btn-xs btn-outline-primary'
                                                                style="border-radius: 50%"
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
                                    @elseif ($inchargestatus == 2)
                                        @foreach($type2s as $type2)
                                            <tr>
                                                <td>{{$no++}}</td>
                                                <td>{{ ucwords(strtolower($type2->nama)) }}</td>
                                                <td>{{ date('d M', strtotime($type2->tanggalmulaicuti)) }} -
                                                    {{ date('d M', strtotime($type2->tanggalakhircuti)) }}
                                                </td>
                                                <td>{{ date('d M', strtotime($type2->created_at)) }}</td>
                                                <td>
                                                    <a href="{{ url('/detailcuti/'.$type2->id) }}">
                                                        <button class='btn btn-xs btn-outline-primary'
                                                                style="border-radius: 50%"
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
                                        @foreach($type4s as $type4)
                                            <tr>
                                                <td>{{$no++}}</td>
                                                <td>{{ ucwords(strtolower($type4->nama)) }}</td>
                                                <td>{{ date('d M', strtotime($type4->tanggalmulaicuti)) }} -
                                                    {{ date('d M', strtotime($type4->tanggalakhircuti)) }}
                                                </td>
                                                <td>{{ date('d M', strtotime($type4->created_at)) }}</td>
                                                <td>
                                                    <a href="{{ url('/detailcuti/'.$type4->id) }}">
                                                        <button class='btn btn-xs btn-outline-primary'
                                                                style="border-radius: 50%"
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
                                        @foreach($type5s as $type5)
                                            <tr>
                                                <td>{{$no++}}</td>
                                                <td>{{ ucwords(strtolower($type5->nama)) }}</td>
                                                <td>{{ date('d M', strtotime($type5->tanggalmulaicuti)) }} -
                                                    {{ date('d M', strtotime($type5->tanggalakhircuti)) }}
                                                </td>
                                                <td>{{ date('d M', strtotime($type5->created_at)) }}</td>
                                                <td>
                                                    <a href="{{ url('/detailcuti/'.$type5->id) }}">
                                                        <button class='btn btn-xs btn-outline-primary'
                                                                style="border-radius: 50%"
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
                                    @endif
                                @endif
                                </tbody>
                            </table>
                            <a href="{{ url('/home') }}" class="btn btn-outline-secondary"><i class="fas fa-home"></i> Back to Home </a>

                            {{--<div class="alert alert-danger" role="alert">--}}
                            {{--Dear {{ Auth::user()->name }}, sisa cuti anda tersisa  {{ $availableleavethree }}--}}
                            {{--</div>--}}
                        </div>
                    </div>
                    <br>
                </div>
            </div>
        </div>
        <script>
            var msg = '{{Session::get('alert')}}';
            var exist = '{{Session::has('alert')}}';
            if (exist) {
                alert(msg);
            }
        </script>


    </div>
@endsection