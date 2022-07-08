@extends('layouts.app')
@section('title', 'Detail Cuti')

@section('content')
    <style>
        .table-striped tbody tr:nth-of-type(odd) {
            background-color: rgba(0, 188, 212, 0.12);
        }

        .table-striped tbody tr:nth-of-type(even) {
            background-color: rgba(0, 188, 212, 0.07);
        }

        .read-more-show {
            cursor: pointer;
            color: blue;
        }

        .read-more-hide {
            cursor: pointer;
            color: blue;
        }

        .hide_content {
            display: none;
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
        <br>

        <div class="container">
            <div class="row justify-content-center">

                <div style="margin-bottom: 20px;" class="col-md-8">
                    <div class="card">
                       
                        <div class="card-header card-header-info">
                        <h4 class="card-title mt-0"> Leaves Detail</h4>
                        {{--<p class="card-category"> Detailed Leave Request of {{ucwords(strtolower($leaverequests->nama))}}</p>--}}
                    </div>


                        <div class="card-body">
                            <table class="table table-responsive-lg">
                                <thead>
                                <tr>
                                    <th></th>
                                    <th></th>
                                    
                                </tr>
                                </thead>
                                <tbody>
                             
                                    <tr><td style="font-weight: bold;">NIP</td><td>{{$leaverequests->nip}}</td></tr>
                                    <tr><td style="font-weight: bold;">Name</td><td>{{$leaverequests->nama}}</td></tr>
                                    <tr><td style="font-weight: bold;">Period</td><td>{{ date('d/m/y', strtotime($leaverequests->tanggalmulaicuti)) }} -
                                        {{ date('d/m/y', strtotime($leaverequests->tanggalakhircuti)) }}</td></tr>
                                    <tr><td style="font-weight: bold;">Total</td><td>{{$leaverequests->jumlahhari}}hari</td></tr>
                                    <tr><td style="font-weight: bold;">Cause</td><td>
                                            {{$leaverequests->keterangan}}
                                       </td></tr>
                                        <tr><td style="font-weight: bold;">Note from Incharge</td><td>
                                       
                                            {{$leaverequests->ketbymanager}}
                                        </td></tr>
                                        <tr><td style="font-weight: bold;">Note from HRD</td><td>
                                            
                                            {{$leaverequests->ketbyhrd}}
                                        </td></tr>
                                        <tr><td style="font-weight: bold;">Note from Partner</td><td>
                                            
                                            {{$leaverequests->ketbypartner}}
                                        </td></tr>
                                    <tr><td style="font-weight: bold;">Lampiran</td><td><a href="{{ url('/laravel/storage/app/'.$leaverequests->filename) }}">Lain</a></td></tr>
                                    
                                    <tr></tr><td></td><td><a href="{{ url('/laravel/storage/app/'.$leaverequests->lampiranpenugasan) }}">Penugasan</a></td></tr>
                                
                                </tbody>
                            </table>
                            @if($leaverequests->byhrd == 1 || $leaverequests->bypartner == 1)
                            
                            @else
                            <a href="{{ url('/adminrequestleavelist/approve/'.$leaverequests->nip.'/'.$leaverequests->id) }}">
                                <button type="button" class="btn btn-success">Approve</button>
                            </a>
                            <a href="{{ url('/adminrequestleavelist/decline/'.$leaverequests->nip.'/'.$leaverequests->id) }}">
                                <button type="button" class="btn btn-danger">Decline</button>
                            </a>
                            @endif
                            <a href="{{ url()->previous() }}">
                                <button type="button" class="btn btn-outline-secondary">Back</button>
                            </a>
                        
                            {{--<div class="alert alert-danger" role="alert">--}}
                            {{--Dear {{ Auth::user()->name }}, sisa cuti anda tersisa  {{ $availableleavethree }}--}}
                            {{--</div>--}}
                            <br>

                        </div>
                    </div>
                    <br>

                </div>
            </div>
        </div>

    </div>
    <script src="https://code.jquery.com/jquery-1.10.2.js"></script>
    <script type="text/javascript">
        // Hide the extra content initially, using JS so that if JS is disabled, no problemo:
        $('.read-more-content').addClass('hide_content')
        $('.read-more-show, .read-more-hide').removeClass('hide_content')

        // Set up the toggle effect:
        $('.read-more-show').on('click', function (e) {
            $(this).next('.read-more-content').removeClass('hide_content');
            $(this).addClass('hide_content');
            e.preventDefault();
        });

        // Changes contributed by @diego-rzg
        $('.read-more-hide').on('click', function (e) {
            var p = $(this).parent('.read-more-content');
            p.addClass('hide_content');
            p.prev('.read-more-show').removeClass('hide_content'); // Hide only the preceding "Read More"
            e.preventDefault();
        });
    </script>
@endsection