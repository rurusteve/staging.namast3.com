 @extends('layouts.app')
@section('title', 'Home')

@section('content')
    <style>
        .table-striped tbody tr:nth-of-type(odd) {
            background-color: rgba(0, 188, 212, 0.12);
        }

        .table-striped tbody tr:nth-of-type(even) {
            background-color: rgba(0, 188, 212, 0.07);
        }
        .modal-header {
            justify-content: center;
        }

        html {

            animation: moveFocus 5s ease infinite alternate;
        }
        @keyframes moveFocus {
            0%   { background-position: 0% 100% }
            100% { background-position: 100% 0% }
        }
        main {
            padding: 4%;
            display: flex;
            flex-direction: row;
        }
        .example-elements {
            flex-grow: 1;
            display: flex;
            flex-direction: column;
            align-items: center;
            align-content: center;
            justify-content: center;
            text-align: center;
            padding-right: 4%;
        }

        .example-elements p {
            padding: 6px;
            display: inline-block;
            margin-bottom: 5%;
        }
        .example-elements p:hover {
            border-left: 1px solid lightgrey;
            border-right: 1px solid lightgrey;
            padding-left: 5px;
            padding-right: 5px;
        }

        .example-elements a {
            margin-left: 6px;
            margin-bottom: calc(5% + 10px);
            color: #76daff;
            text-decoration: none;
        }
        .example-elements a:hover {
            margin-bottom: calc(5% + 9px);
            border-bottom: 1px solid #76daff;
        }

        .example-elements button {
            margin-bottom: 20px;
        }

        .info-wrapper {
            flex-grow: 8;
            display: flex;
            flex-direction: column;
            justify-content: center;
            text-align: justify;
            padding-left: 6%;
            border-left: 3px solid #35ea95;
        }

        .info-wrapper p {
            color: rgba(255, 255, 255, 0.69);
        }
        .info-wrapper p {
            max-width: 600px;
            text-align: justify;
        }

        .info-wrapper .title-question {
            display: block;
            color: #fff;
            font-size: 1.36em;
            font-weight: 500;
            padding-bottom: 24px;
        }


        /* Thumbnail settings */
        @media (max-width: 800px) {

            main {
                font-size: 1.1em;
                padding: 6%;
            }
            .info-wrapper p:before,
            .info-wrapper p:after {
                display: none;
            }
            .example-elements {
                max-width: 150px;
                font-size: 22px;
            }
            .example-elements p:before,
            .example-elements p:after {
                visibility: visible;
                opacity: 1;
            }
            .example-elements p:before {
                content: "Tooltip";
                font-size: 20px;
                transform: translate(-50%, -5px) scale(1);
            }
            .example-elements p:after {
                transform: translate(-50%, -1px) scaleY(1);
            }
        }
        .modal-header i{
            font-size: 0.9em;
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
        <div style="justify-content: flex-start;" class="modal-header">
            <h3><span style="color: darkgrey">{{$greetings}}</span> <b><span style="font-weight: bolder">{{ucwords(strtolower(Auth::user()->name)) }}</span></b>
                <br><b style="font-weight: bolder">Welcome to your dashboard, {{$emotionalgreetings}}</b>
                {{--@if($emoticoncode == 1)--}}
                    {{--<i class="fas fa-grin-wink"></i>--}}
                {{--@elseif($emoticoncode == 2)--}}
                    {{--<i class="fas fa-kiss-wink-heart"></i>--}}
                {{--@elseif($emoticoncode == 3)--}}
                    {{--<i class="fas fa-grin-stars"></i>--}}
                {{--@elseif($emoticoncode == 4)--}}
                    {{--<i class="fas fa-grin-tongue"></i>--}}
                {{--@endif--}}
            </h3>
        </div>
    </div>


        <div class="container">


            @if($inchargestatus == 1 && Auth::user()->logintype !== 'nonprofessional')
                {{--<div class="row justify-content-left">--}}
                    {{--<div class="col-md-12">--}}
                        {{--<div class="alert alert-warning" role="alert">--}}
                            {{--<button type="button" class="close" data-dismiss="alert" aria-label="Close">--}}
                                {{--<i class="material-icons">close</i>--}}
                            {{--</button>--}}
                            {{--[System, July 24] Sistem sunting waktu lembur non-efektif telah diaktifkan kembali, uang lembur akan disesuaikan total lembur setelah disunting.--}}
                        {{--</div>--}}
                    {{--</div>--}}
                {{--</div>--}}
                @else
                @endif
                {{--<div class="row justify-content-left">--}}
                    {{--<div class="col-md-12">--}}
                        {{--<div class="alert alert-info" role="alert">--}}
                            {{--<button type="button" class="close" data-dismiss="alert" aria-label="Close">--}}
                                {{--<i class="material-icons">close</i>--}}
                            {{--</button>--}}
                            {{--<b>[System, July 24] Sistem sunting waktu lembur non-efektif telah diaktifkan kembali, uang lembur akan disesuaikan dengan total waktu lembur setelah disunting.--}}
                                {{--Uang lembur yang didapat bisa dilihat melalui menu time sheets anda.</b>--}}
                        {{--</div>--}}
                    {{--</div>--}}
                {{--</div>--}}
                {{--<div class="row justify-content-left">--}}
                    {{--<div class="col-md-12">--}}
                        {{--<div class="alert alert-info" role="alert">--}}
                            {{--<button type="button" class="close" data-dismiss="alert" aria-label="Close">--}}
                                {{--<i class="material-icons">close</i>--}}
                            {{--</button>--}}
                            {{--[System] July 5, Data cuti anda tidak sesuai? Silahkan email ke <a href="mailto:admin@rurusteve.com"><b>admin@rurusteve.com</b></a>--}}
                             {{--untuk konfirmasi data cuti anda.--}}
                        {{--</div>--}}
                    {{--</div>--}}
                {{--</div>--}}
            <div class="row justify-content-left">


                <div style="margin-bottom: 20px;" class="col-md-6">
                    <div class="card">
                        <div class="card-header">
                            <i class="fas fa-calendar-day"></i> Status Cuti
                        </div>

                        <div class="card-body">
                            <table class="table table-hover">
                                <thead>
                                <tr>
                                    <th>Status</th>
                                    <th>Jumlah</th>
                                </tr>
                                </thead>
                                <tbody>

                                <!-- <tr>
                                    <td>Cuti bersama</td>
                                    <td></td>
                                </tr> -->

                                <tr>
                                    <td>Jatah cuti <i class="fas fa-info-circle" data-toggle="tooltip"
                                                           data-placement="right"
                                                           title="Harap hubungi tim HRD untuk info mengenai cuti"></i>
                                    </td>
                                    <td>{{ $jatahcutiawal }}</td>
                                </tr>
                                <tr>
                                    <td>Penambahan <i class="fas fa-info-circle" data-toggle="tooltip" data-placement="right" title="Harap hubungi tim HRD untuk info mengenai cuti"></i></span></td>
                                    <td>{{ number_format($manualinputcutiplus,2) }}</td>
                                </tr>
                                <tr>
                                    <td >Pengurangan <i class="fas fa-info-circle" data-toggle="tooltip" data-placement="right" title="Harap hubungi tim HRD untuk info mengenai cuti"></i></span></td>
                                    <td>{{ number_format($manualinputcutiminus,2) }}</td>
                                </tr>
                                <tr>
                                    <td>Cuti yang sudah diambil</td>
                                    <td>{{ number_format($approvedrequest,2) }}</td>
                                </tr>

                                <tr>
                                    <td>Cuti tersedia</td>
                                    <td>{{ number_format($availableleave,2) }}</td>
                                </tr>

                                </tbody>
                            </table>
                            <a href="{{ url('cuti/home') }}">
                                <button type="button" class="btn btn-primary"><i class="fas fa-calendar-day"></i> Detail & Pengajuan Cuti</button>
                            </a>


                        </div>
                    </div>

                    @if($division == 'HRD')

                        @if($division == 'SEKRETARIS')
                            <div class="card">
                                <div class="card-header">
                                    <i class="fas fa-user-clock"></i> Time Report Administration
                                </div>
                                <div class="card-body">
                                    <a href="/administration/timereport/clients/msid">
                                        <button type="submit" class="btn btn-primary"><i class="fas fa-users-cog"></i> Clients</button>
                                    </a>
                                </div>
                            </div>
                        @elseif($division == 'HRD')
                            {{--<div class="card">--}}
                                {{--<div class="card-header">--}}
                                    {{--<i class="fas fa-user-clock"></i> Administration--}}
                                {{--</div>--}}
                                {{--<div class="card-body">--}}

                                    {{--<a href="/administration/timereport/tasks">--}}
                                        {{--<button style="margin: 5px 5px 5px 0" type="submit" class="btn btn-warning"><i class="fas fa-stream"></i> Tasks</button>--}}
                                    {{--</a>--}}
                                    {{--<a href="/approveddeclinedlist">--}}
                                        {{--<button style="margin: 5px 5px 5px 0" type="submit" class="btn btn-success"><i class="fas fa-vote-yea"></i> Approved List</button>--}}
                                    {{--</a>--}}
                                    {{--<a href="/manualinput">--}}
                                        {{--<button style="margin: 5px 5px 5px 0" type="submit" class="btn btn-primary"><i class="fas fa-pencil-alt"></i> On Leave Editor</button>--}}
                                    {{--</a>--}}
                                    {{--<a href="/teammanagement">--}}
                                        {{--<button style="margin: 5px 5px 5px 0" type="submit" class="btn btn-info"><i class="fas fa-user-friends"></i> Team Management</button>--}}
                                    {{--</a>--}}
                                {{--</div>--}}
                            {{--</div>--}}
                        @else
                        @endif
                    @else
                        {{--@elseif($division !== 'hrd' && $division !== 'sekretaris')--}}
                    @endif
                    @if ($inchargestatus == 1)
                        <div class="card">
                            <div class="card-header">
                                Ajuan Cuti
                            </div>
                            <div class="card-body">
                                @foreach($type1s as $type1)
                                    <div class="alert alert-warning" role="alert">
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                            <i class="material-icons">close</i>
                                        </button>
                                        On leave request by {{ ucwords(strtolower($type1->nama)) }}
                                    </div>
                                @endforeach
                                <a href="/adminrequestleavelist">[ <i class="fas fa-list-ul"></i> See list ]</a>
                            </div>
                        </div>
                        <div class="card">
                            <div class="card-header">
                                Ajuan Cuti > 5 hari
                            </div>
                            <div class="card-body">
                                @foreach($type3s as $type3)
                                    <div class="alert alert-warning" role="alert">
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                            <i class="material-icons">close</i>
                                        </button>
                                        On leave request by {{ ucwords(strtolower($type3->nama)) }}
                                    </div>
                                @endforeach
                                <a href="/adminrequestleavelist">[ <i class="fas fa-list-ul"></i> See list]</a>
                            </div>
                        </div>
                        @if($division == 'HRD')
                            {{--<div class="card">--}}
                                {{--<div class="card-header">--}}
                                    {{--<i class="fas fa-user-clock"></i> Administration--}}
                                {{--</div>--}}
                                {{--<div class="card-body">--}}
                                    {{--<a href="/administration/timereport/tasks">--}}
                                        {{--<button type="submit" class="btn btn-primary"><i class="fas fa-stream"></i>Tasks</button>--}}
                                    {{--</a>--}}
                                {{--</div>--}}
                                {{--<div class="card-body">--}}
                                    {{--<a href="/approvedlist">--}}
                                        {{--<button type="submit" class="btn btn-primary"><i class="fas fa-vote-yea"></i> Approved List</button>--}}
                                    {{--</a>--}}
                                {{--</div>--}}
                                {{--<div class="card-body">--}}
                                    {{--<a href="/manualinput">--}}
                                        {{--<button type="submit" class="btn btn-primary"><i class="fas fa-vote-yea"></i> On Leave Manual Input</button>--}}
                                    {{--</a>--}}
                                {{--</div>--}}
                            {{--</div>--}}
                        @elseif($division == 'SEKRETARIS')
                            <div class="card">
                                <div class="card-header">
                                    <i class="fas fa-user-clock"></i> Time Report Administration
                                </div>
                                <div class="card-body">
                                    <a href="/administration/timereport/clients/msid">
                                        <button type="submit" class="btn btn-primary"><i class="fas fa-users-cog"></i> Clients</button>
                                    </a>
                                </div>
                            </div>
                        @else
                        @endif
                    @elseif ($inchargestatus == 2)
                        <div class="card">
                            <div class="card-header">
                                Ajuan Cuti
                            </div>
                            <div class="card-body">
                                @foreach($type2s as $type2)

                                    <div class="alert alert-warning" role="alert">
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                            <i class="material-icons">close</i>
                                        </button>
                                        On leave request by {{ ucwords(strtolower($type2->nama)) }}
                                    </div>
                                @endforeach
                                <a href="/adminrequestleavelist">[ <i class="fas fa-list-ul"></i> See list]</a>

                            </div>
                        </div>
                        <div class="card">
                            <div class="card-header">
                                Ajuan Cuti > 5 hari
                            </div>
                            <div class="card-body">
                                @foreach($type4s as $type4)
                                    <div class="alert alert-warning" role="alert">
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                            <i class="material-icons">close</i>
                                        </button>
                                        On leave request by {{ ucwords(strtolower($type4->nama)) }}
                                    </div>
                                @endforeach
                                <a href="/adminrequestleavelist">[ <i class="fas fa-list-ul"></i> See list]</a>

                            </div>
                        </div>
                    @else
                    @endif

                </div>
                <div style="margin-bottom: 20px;" class="col-md-6">
                    {{--<div class="card">--}}
                        {{--<div class="card-header">--}}
                            {{--<i class="fas fa-chart-pie"></i> Persentasi Cuti--}}
                        {{--</div>--}}

                        {{--<div class="card-body">--}}
                            {{--<div id="piechart"></div>--}}
                            {{--<div id="approval"></div>--}}
                        {{--</div>--}}
                    {{--</div>--}}

                    @if(Auth::user()->logintype !== "nonprofessional")
                        <div class="card">
                            <div class="card-header">
                                <i class="fas fa-user-clock"></i> Time Reports
                            </div>



                            <div class="card-body">
                                @foreach($minusregularhours as $minusregularhour)

                                    @if($minusregularhour->NH < 8.00)
                                        <div class="alert alert-danger" role="alert">
                                            Regular Hour(s) on {{date("F d, Y", strtotime($minusregularhour->date))}} is less than 8.
                                        </div>
                                    @else
                                    @endif

                                @endforeach

                                @if (session('status'))
                                    <div class="alert alert-success" role="alert">
                                        {{ session('status') }}
                                    </div>
                                @endif

                                <a href="{{ url('/timesheets/main') }}">
                                    <button type="button" class="btn btn-success"><i
                                                class="fas fa-user-clock"></i> Time Sheets
                                    </button>
                                </a>
                                <a href="{{ url('/input/timereport') }}">
                                    <button type="button" class="btn btn-warning"><i
                                                class="fas fa-file-import"></i> Input Time Report
                                    </button>
                                </a>


                                <!-- Modal -->
                            </div>
                        </div>

                    @else
                    @endif


                    <div class="card">
                        <div class="card-header">
                            <i class="fas fa-money-check-alt"></i> Slip Gaji
                        </div>


                        <!-- Modal -->
                        <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered" role="document">
                                <div class="modal-content">

                                    <div class="modal-header">
                                        <h5>Masukkan password anda</h5>

                                    </div>

                                    <div style="display: none">{{ $crypt = str_random(10)}}
                                    </div>
                                    <div class="modal-body">
                                        <form action="{{ url('/home/encryptslip/'.$crypt) }}">

                                            <div style="display: none;" class="form-group row">
                                                <label for="email" class="col-sm-4 col-form-label text-md-right">{{ __('Username') }}</label>

                                                <div class="col-md-6">
                                                    <input id="userid" type="text" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="userid" value="{{ Auth::user()->nip }}" required >

                                                    @if ($errors->has('email'))
                                                        <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $errors->first('email') }}</strong>
                                                </span>
                                                    @endif
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label for="password" class="col-md-4 col-form-label text-md-right"><i class="fas fa-lock"></i> Password</label>

                                                <div class="col-md-6">
                                                    <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required >

                                                    @if ($errors->has('password'))
                                                        <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $errors->first('password') }}</strong>
                                                </span>
                                                    @endif
                                                </div>
                                            </div>

                                            <div class="form-group row mb-0">
                                                <div class="col-md-8 offset-md-4">
                                                    <button type="submit" class="btn btn-success">
                                                        Buka
                                                    </button>
                                                    <button type="button" class="btn btn-outline-secondary" data-dismiss="modal">Batalkan</button>

                                                </div>
                                            </div>
                                        </form>

                                    </div>

                                </div>
                            </div>


                        </div>



                        <div class="card-body">
                            @if($periode == $month)
                                <div class="alert alert-success" role="alert">
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <i class="material-icons">close</i>
                                    </button>
                                    Slip gaji anda untuk bulan ini sudah tersedia <i class="fas fa-smile-wink"></i>.
                                    Silahkan klik
                                    <a href="" class="link" data-toggle="modal" data-target="#exampleModalCenter">
                                        <b>disini</b>
                                    </a>
                                    , atau dengan mengakses menu Payslips.

                                </div>

                            @elseif($periode !== $month)
                                <div style="margin: 0;" class="alert alert-light" role="alert">
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <i class="material-icons">close</i>
                                    </button>
                                    Slip gaji anda untuk bulan ini belum tersedia <i class="far fa-grin-beam-sweat"></i>
                                </div>
                            @endif
                        <!--    <div style="margin: 0 auto;" class="card">-->
                        <!--        <div class="card-body">-->
                        <!--            <div class="dropdown">-->
                        <!--                <a href="" class="link" data-toggle="modal" data-target="#exampleModalCenter2">-->
                        <!--                    <button class="btn btn-info">-->
                        <!--                        <i class="far fa-calendar-alt"></i> Akses gaji berdasarkan periode-->
                        <!--                    </button>-->
                        <!--                </a>-->


                        <!--            </div>-->
                        <!--        </div>-->



                        <!--        <div class="modal fade" id="exampleModalCenter2" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle2" aria-hidden="true">-->
                        <!--            <div class="modal-dialog modal-dialog-centered" role="document">-->
                        <!--                <div class="modal-content">-->

                        <!--                    <div class="modal-header">-->
                        <!--                        <h5>Akses slip gaji berdasarkan periode-->
                        <!--                        </h5>-->

                        <!--                    </div>-->

                        <!--                    <div style="display: none">-->
                        <!--                        {{ $crypt = str_random(10)}}-->
                        <!--                    </div>-->
                        <!--                    <div class="modal-body">-->
                        <!--                        <form action="{{ url('/home/encryptslipperiod/'.$crypt) }}">-->

                        <!--                            <div style="display: none;" class="form-group row">-->
                        <!--                                <label for="email" class="col-sm-4 col-form-label text-md-right">{{ __('Username') }}</label>-->

                        <!--                                <div class="col-md-6">-->
                        <!--                                    <input id="userid" type="text" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="userid" value="{{ Auth::user()->nip }}" required >-->

                        <!--                                    @if ($errors->has('email'))-->
                        <!--                                        <span class="invalid-feedback" role="alert">-->
                        <!--                                <strong>{{ $errors->first('email') }}</strong>-->
                        <!--                            </span>-->
                        <!--                                    @endif-->
                        <!--                                </div>-->
                        <!--                            </div>-->
                        <!--                            <div class="form-group row">-->
                        <!--                                <label for="periode" class="col-md-12 col-form-label text-md-left"><i class="far fa-calendar-alt"></i> Periode</label>-->

                        <!--                                <div class="col-md-12">-->
                        <!--                                    <select name="periode" id="periode" class="form-control{{ $errors->has('periode') ? ' is-invalid' : '' }}">-->
                        <!--                                        <option value="" disabled>Klik, Pilih Periode</option>-->

                        <!--                                        @foreach($listbyperiodes as $listbyperiode)-->

                        <!--                                            @if($listbyperiode->periode === "1")-->
                        <!--                                                <option value="1">Januari</option>-->
                        <!--                                            @elseif($listbyperiode->periode === "2")-->
                        <!--                                                <option value="2">Februari</option>-->
                        <!--                                            @elseif($listbyperiode->periode === "3")-->
                        <!--                                                <option value="3">Maret</option>-->
                        <!--                                            @elseif($listbyperiode->periode === "4")-->
                        <!--                                                <option value="4">April</option>-->
                        <!--                                            @elseif($listbyperiode->periode === "5")-->
                        <!--                                                <option value="5">Mei</option>-->
                        <!--                                            @elseif($listbyperiode->periode === "6")-->
                        <!--                                                <option value="6">Juni</option>-->
                        <!--                                            @elseif($listbyperiode->periode === "7")-->
                        <!--                                                <option value="7">Juli</option>-->
                        <!--                                            @elseif($listbyperiode->periode === "8")-->
                        <!--                                                <option value="8">Agustus</option>-->
                        <!--                                            @elseif($listbyperiode->periode === "9")-->
                        <!--                                                <option value="9">September</option>-->
                        <!--                                            @elseif($listbyperiode->periode === "10")-->
                        <!--                                                <option value="10">Oktober</option>-->
                        <!--                                            @elseif($listbyperiode->periode === "11")-->
                        <!--                                                <option value="11">November</option>-->
                        <!--                                            @elseif($listbyperiode->periode === "12")-->
                        <!--                                                <option value="12">Desember</option>-->

                        <!--                                            @endif-->

                        <!--                                        @endforeach-->
                        <!--                                    </select>-->

                        <!--                                    @if ($errors->has('password'))-->
                        <!--                                        <span class="invalid-feedback" role="alert">-->
                        <!--                                <strong>{{ $errors->first('password') }}</strong>-->
                        <!--                            </span>-->
                        <!--                                    @endif-->
                        <!--                                </div>-->
                        <!--                            </div>-->
                        <!--                            <div class="form-group row">-->
                        <!--                                <label for="password" class="col-md-12 col-form-label text-md-left"><i class="fas fa-lock"></i> Password</label>-->

                        <!--                                <div class="col-md-12">-->
                        <!--                                    <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required >-->

                        <!--                                    @if ($errors->has('password'))-->
                        <!--                                        <span class="invalid-feedback" role="alert">-->
                        <!--                                <strong>{{ $errors->first('password') }}</strong>-->
                        <!--                            </span>-->
                        <!--                                    @endif-->
                        <!--                                </div>-->
                        <!--                            </div>-->

                        <!--                            <div class="form-group row mb-0">-->
                        <!--                                <div class="col-md-8 offset-md-4">-->
                        <!--                                    <button type="submit" class="btn btn-success">-->
                        <!--                                        Buka-->
                        <!--                                    </button>-->
                        <!--                                    <button type="button" class="btn btn-outline-secondary" data-dismiss="modal">Batalkan</button>-->

                        <!--                                </div>-->
                        <!--                            </div>-->
                        <!--                        </form>-->

                        <!--                    </div>-->

                        <!--                </div>-->
                        <!--            </div>-->
                        <!--        </div>-->
                        <!--        @if($type !== 'nonprofessional')-->
                        <!--            {{--<div style="margin-bottom: 20px;" class="col-md-6">--}}-->

                        <!--    </div>-->
                        <!--</div>-->
                        <!--@else @endif-->
                    </div>


                </div>
            </div>
        </div>
        <div style="display: none;">
            {{$cuti = $availableleave + $manualinputcutiminus + $manualinputcutiplus}}
        </div>
        <script>
            var msg = '{{\Illuminate\Support\Facades\Session::get('alert')}}';
            var exist = '{{\Illuminate\Support\Facades\Session::has('alert')}}';
            if (exist) {
                alert(msg);
            }
        </script>
        <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
        <script type="text/javascript">
            // Load google charts
            google.charts.load('current', {'packages': ['corechart']});
            google.charts.setOnLoadCallback(drawChart);
            // Draw the chart and set the chart values
            function drawChart() {
                var data = google.visualization.arrayToDataTable([
                    ['Task', 'Hours per Day'],
                    ['Sisa cuti', {{$availableleave}}],
                    ['Cuti diambil', {{$approvedrequest}}],

                ]);

                var options = {'title': 'Status Cuti:', 'width': 400, 'height': 250};

                var chart = new google.visualization.PieChart(document.getElementById('piechart'));
                chart.draw(data, options);
            }
        </script>
        <script type="text/javascript">
            // Load google charts
            $(document).ready(function(){
                $('[data-toggle="tooltip"]').tooltip();
            });
            google.charts.load('current', {'packages': ['corechart']});
            google.charts.setOnLoadCallback(drawChart);

            // Draw the chart and set the chart values
            function drawChart() {
                var data = google.visualization.arrayToDataTable([
                    ['Task', 'Hours per Day'],
                    ['Approved', {{$approvedrequest}}],
                    ['Waiting', {{$waitingforapproval}}],
                ]);

                // Optional; add a title and set the width and height of the chart
                var options = {'title': 'Status Cuti:', 'width': 400, 'height': 250};

                // Display the chart inside the <div> element with id="piechart"
                var chart = new google.visualization.PieChart(document.getElementById('approval'));
                chart.draw(data, options);
            }

        </script>
    </div>
@endsection
