@extends('layouts.app')
@section('title', 'Detail Status Cuti')

@section('content')
    <style>
        td:first-child {
            font-weight: bold !important;
        }
    </style>
    <div class="container">

        <div class="container">
            <div class="row justify-content-center">

                <div style="margin-bottom: 20px;" class="col-md-8">
                    <div class="card">
                        <div class="card-header card-header-info">
                            <h4 class="card-title"><b>Detail Status Cuti</b></h4>
                        </div>

                        <div class="card-body">
                            <table class="table table-md table-striped table-hover">
                                <thead>
                                <tr>

                                </tr>
                                </thead>
                                <tbody>
                                <tr>
                                    <td>Nama</td>
                                    <td>: {{ucwords(strtolower($leaverequests->nama))}}</td>
                                </tr>
                                <tr>
                                    <td>Tanggal Cuti</td>
                                    <td>: {{ date('d M', strtotime($leaverequests->tanggalmulaicuti)) }} -
                                        {{ date('d M', strtotime($leaverequests->tanggalakhircuti)) }}</td>
                                </tr>
                                <tr>
                                    <td>Jumlah Hari</td>
                                    <td>: {{$leaverequests->jumlahhari}}</td>
                                </tr>
                                <tr>
                                    <td>Keterangan</td>
                                    <td>:
                                        @if($leaverequests->keterangan === null)
                                            Tidak ada
                                        @elseif(strlen($leaverequests->keterangan) > 30)
                                            {{substr($leaverequests->keterangan,0,100)}}
                                            <span class="read-more-show hide_content">...</span>
                                            <span class="read-more-content"> {{substr($leaverequests->keterangan,100,strlen($leaverequests->keterangan))}}
                                                <span class="read-more-hide hide_content"><i
                                                            class="fa fa-angle-left"></i></span> </span>
                                        @else
                                            {{$leaverequests->keterangan}}</td>
                                    @endif
                                </tr>
                                <tr>
                                    <td>Status Cuti</td>@if($leaverequests->statuscuti == 'approved')
                                        <td style="color: green">
                                            : {{ucwords(strtolower($leaverequests->statuscuti))}}</td>
                                    @elseif($leaverequests->statuscuti == 'declined')
                                        <td style="color: red">
                                            : {{ucwords(strtolower($leaverequests->statuscuti))}}</td>
                                    @else
                                        <td style="color: grey">
                                            : Menunggu
                                        </td>
                                    @endif

                                </tr>
                                <tr>
                                    <td>Pesan Manager</td>
                                    <td>:
                                        @if($leaverequests->ketbymanager === null)
                                            Tidak ada
                                        @elseif(strlen($leaverequests->ketbymanager) > 30)
                                            {{substr($leaverequests->ketbymanager,0,100)}}
                                            <span class="read-more-show hide_content">...</span>
                                            <span class="read-more-content"> {{substr($leaverequests->ketbymanager,100,strlen($leaverequests->ketbymanager))}}
                                                <span class="read-more-hide hide_content"><i
                                                            class="fa fa-angle-left"></i></span> </span>
                                        @else
                                            {{$leaverequests->ketbymanager}}</td>
                                    @endif
                                </tr>
                                <tr>
                                    <td>Pesan HRD</td>
                                    <td>:
                                        @if($leaverequests->ketbyhrd === null)
                                            Tidak ada
                                        @elseif(strlen($leaverequests->ketbyhrd) > 30)
                                            {{substr($leaverequests->ketbyhrd,0,100)}}
                                            <span class="read-more-show hide_content">...</span>
                                            <span class="read-more-content"> {{substr($leaverequests->ketbypartner,100,strlen($leaverequests->ketbyhrd))}}
                                                <span class="read-more-hide hide_content"><i
                                                            class="fa fa-angle-left"></i></span> </span>
                                        @else
                                            {{$leaverequests->ketbypartner}}</td>
                                    @endif
                                </tr>
                                <tr>
                                    <td>Pesan Partner</td>
                                    <td>:
                                        @if($leaverequests->ketbypartner === null)
                                            Tidak ada
                                        @elseif(strlen($leaverequests->ketbypartner) > 30)
                                            {{substr($leaverequests->ketbypartner,0,100)}}
                                            <span class="read-more-show hide_content">...</span>
                                            <span class="read-more-content"> {{substr($leaverequests->ketbypartner,100,strlen($leaverequests->ketbypartner))}}
                                                <span class="read-more-hide hide_content"><i
                                                            class="fa fa-angle-left"></i></span> </span>
                                        @else
                                            {{$leaverequests->ketbypartner}}</td>
                                    @endif
                                </tr>
                                <tr>
                                    <td>Lampiran</td>
                                    @if($leaverequests->filename === null)

                                        <td>: Kosong</td>
                                    @else
                                        <td>
                                            <a style="color: yellowgreen" class="page-link"
                                               href="{{ url('/storage/app/'.$leaverequests->filename) }}">
                                                <i class="fas fa-file-download"></i> Lain
                                            </a>
                                        </td>
                                    @endif
                                </tr>
                                <tr>
                                    <td></td>
                                    @if($leaverequests->lampiranpenugasan === null)
                                        <td>: Kosong</td>
                                    @else
                                        <td>
                                            <a style="color: cadetblue" class="page-link"
                                               href="{{ url('/laravel/storage/app/'.$leaverequests->lampiranpenugasan) }}">
                                                <i class="fas fa-file-download"></i> Penugasan
                                            </a>
                                        </td>

                                    @endif
                                </tr>
                                </tbody>
                            </table>
                            {{--<div class="alert alert-danger" role="alert">--}}
                            {{--Dear {{ Auth::user()->name }}, sisa cuti anda tersisa  {{ $availableleavethree }}--}}
                            {{--</div>--}}

                            <a href="{{ url('/input/cuti/home') }}">
                                <button type="button" class="btn btn-outline-primary"><i
                                            class="fas fa-caret-square-left"></i> Back
                                </button>
                            </a>
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