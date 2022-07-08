@extends('layouts.reports')
@section('contentreporthead')
    {{--<li class="nav-item">--}}
    {{--<a class="nav-link" data-toggle="collapse"--}}
    {{--data-target="#collapseOne" aria-expanded="false"--}}
    {{--aria-controls="collapseOne" id="accordionExample">--}}
    {{--<i class="fas fa-caret-down"></i>--}}
    {{--<p>Main Attributes</p>--}}
    {{--</a>--}}
    {{--<div id="collapseOne" class="collapse show" aria-labelledby="headingOne"--}}
    {{--data-parent="#accordionExample">--}}
    {{--<div class="card-body">--}}
    {{--<div class="filterlist">--}}
    {{--<button data-column="14" type="button"--}}
    {{--class="btn btn-sm btn-toggle toggle-vis"--}}
    {{--data-toggle="button" aria-pressed="false" autocomplete="off">--}}
    {{--<div class="handle"></div>--}}
    {{--</button>--}}
    {{--NIK--}}
    {{--<br>--}}
    {{--<button data-column="1" type="button"--}}
    {{--class="btn btn-sm btn-toggle toggle-vis"--}}
    {{--data-toggle="button" aria-pressed="false" autocomplete="off">--}}
    {{--<div class="handle"></div>--}}
    {{--</button>--}}
    {{--Name--}}
    {{--<br>--}}
    {{--<button data-column="2" type="button"--}}
    {{--class="btn btn-sm btn-toggle toggle-vis"--}}
    {{--data-toggle="button" aria-pressed="false" autocomplete="off">--}}
    {{--<div class="handle"></div>--}}
    {{--</button>--}}
    {{--Institution--}}
    {{--<br>--}}
    {{--<button data-column="3" type="button"--}}
    {{--class="btn btn-sm btn-toggle toggle-vis"--}}
    {{--data-toggle="button" aria-pressed="false" autocomplete="off">--}}
    {{--<div class="handle"></div>--}}
    {{--</button>--}}
    {{--Status--}}
    {{--<br>--}}
    {{--<button data-column="4" type="button"--}}
    {{--class="btn btn-sm btn-toggle toggle-vis"--}}
    {{--data-toggle="button" aria-pressed="false" autocomplete="off">--}}
    {{--<div class="handle"></div>--}}
    {{--</button>--}}
    {{--Position--}}
    {{--<br>--}}
    {{--<button data-column="5" type="button"--}}
    {{--class="btn btn-sm btn-toggle toggle-vis"--}}
    {{--data-toggle="button" aria-pressed="false" autocomplete="off">--}}
    {{--<div class="handle"></div>--}}
    {{--</button>--}}
    {{--Group--}}
    {{--<br>--}}
    {{--<button data-column="6" type="button"--}}
    {{--class="btn btn-sm btn-toggle toggle-vis"--}}
    {{--data-toggle="button" aria-pressed="false" autocomplete="off">--}}
    {{--<div class="handle"></div>--}}
    {{--</button>--}}
    {{--Place of Birth--}}
    {{--<br>--}}
    {{--<button data-column="7" type="button"--}}
    {{--class="btn btn-sm btn-toggle toggle-vis"--}}
    {{--data-toggle="button" aria-pressed="false" autocomplete="off">--}}
    {{--<div class="handle"></div>--}}
    {{--</button>--}}
    {{--Birthday--}}
    {{--<br>--}}
    {{--<button data-column="27" type="button"--}}
    {{--class="btn btn-sm btn-toggle toggle-vis"--}}
    {{--data-toggle="button" aria-pressed="false" autocomplete="off">--}}
    {{--<div class="handle"></div>--}}
    {{--</button>--}}

    {{--Gender<br>--}}
    {{--<button data-column="8" type="button"--}}
    {{--class="btn btn-sm btn-toggle toggle-vis"--}}
    {{--data-toggle="button" aria-pressed="false" autocomplete="off">--}}
    {{--<div class="handle"></div>--}}
    {{--</button>--}}

    {{--Phone Number--}}
    {{--<br>--}}
    {{--<button data-column="11" type="button"--}}
    {{--class="btn btn-sm btn-toggle toggle-vis"--}}
    {{--data-toggle="button" aria-pressed="false" autocomplete="off">--}}
    {{--<div class="handle"></div>--}}
    {{--</button>--}}
    {{--Email--}}

    {{--</div>--}}
    {{--</div>--}}
    {{--</div>--}}

    {{--</li>--}}
    {{--<li class="nav-item">--}}
    {{--<a class="nav-link" data-toggle="collapse"--}}
    {{--data-target="#collapseTwo" aria-expanded="false"--}}
    {{--aria-controls="collapseTwo">--}}
    {{--<i class="fas fa-caret-down"></i>--}}
    {{--<p>Civil Attributes</p>--}}
    {{--</a>--}}
    {{--<div id="collapseTwo" class="collapse" aria-labelledby="headingTwo"--}}
    {{--data-parent="#accordionExample">--}}
    {{--<div class="card-body">--}}
    {{--<div class="filterlist">--}}
    {{--<button data-column="12" type="button"--}}
    {{--class="btn btn-sm btn-toggle toggle-vis"--}}
    {{--data-toggle="button" aria-pressed="false" autocomplete="off">--}}
    {{--<div class="handle"></div>--}}
    {{--</button>--}}
    {{--Domicile--}}
    {{--<br>--}}
    {{--<button data-column="13" type="button"--}}
    {{--class="btn btn-sm btn-toggle toggle-vis"--}}
    {{--data-toggle="button" aria-pressed="false" autocomplete="off">--}}
    {{--<div class="handle"></div>--}}
    {{--</button>--}}
    {{--Postal Code--}}
    {{--<br>--}}

    {{--<button data-column="15" type="button"--}}
    {{--class="btn btn-sm btn-toggle toggle-vis"--}}
    {{--data-toggle="button" aria-pressed="false" autocomplete="off">--}}
    {{--<div class="handle"></div>--}}
    {{--</button>--}}
    {{--Religion--}}
    {{--<br>--}}
    {{--<button data-column="16" type="button"--}}
    {{--class="btn btn-sm btn-toggle toggle-vis"--}}
    {{--data-toggle="button" aria-pressed="false" autocomplete="off">--}}
    {{--<div class="handle"></div>--}}
    {{--</button>--}}

    {{--Civil Status--}}
    {{--<br>--}}
    {{--<button data-column="9" type="button"--}}
    {{--class="btn btn-sm btn-toggle toggle-vis"--}}
    {{--data-toggle="button" aria-pressed="false" autocomplete="off">--}}
    {{--<div class="handle"></div>--}}
    {{--</button>--}}
    {{--[Name] Emergency Contact--}}
    {{--<br>--}}
    {{--<button data-column="10" type="button"--}}
    {{--class="btn btn-sm btn-toggle toggle-vis"--}}
    {{--data-toggle="button" aria-pressed="false" autocomplete="off">--}}
    {{--<div class="handle"></div>--}}
    {{--</button>--}}
    {{--[Number] Emergency Contact--}}
    {{--<br>--}}
    {{--<button data-column="17" type="button"--}}
    {{--class="btn btn-sm btn-toggle toggle-vis"--}}
    {{--data-toggle="button" aria-pressed="false" autocomplete="off">--}}
    {{--<div class="handle"></div>--}}
    {{--</button>--}}
    {{--Partner's Name--}}
    {{--<br>--}}
    {{--<button data-column="18" type="button"--}}
    {{--class="btn btn-sm btn-toggle toggle-vis"--}}
    {{--data-toggle="button" aria-pressed="false" autocomplete="off">--}}
    {{--<div class="handle"></div>--}}
    {{--</button>--}}
    {{--Partner's Birthday--}}
    {{--<br>--}}
    {{--<button data-column="19" type="button"--}}
    {{--class="btn btn-sm btn-toggle toggle-vis"--}}
    {{--data-toggle="button" aria-pressed="false" autocomplete="off">--}}
    {{--<div class="handle"></div>--}}
    {{--</button>--}}

    {{--Number of Children--}}
    {{--<br>--}}
    {{--<button data-column="20" type="button"--}}
    {{--class="btn btn-sm btn-toggle toggle-vis"--}}
    {{--data-toggle="button" aria-pressed="false" autocomplete="off">--}}
    {{--<div class="handle"></div>--}}
    {{--</button>--}}

    {{--Last Education--}}
    {{--<br>--}}
    {{--<button data-column="21" type="button"--}}
    {{--class="btn btn-sm btn-toggle toggle-vis"--}}
    {{--data-toggle="button" aria-pressed="false" autocomplete="off">--}}
    {{--<div class="handle"></div>--}}
    {{--</button>--}}

    {{--University--}}
    {{--<br>--}}

    {{--</div>--}}
    {{--</div>--}}
    {{--</div>--}}

    {{--</li>--}}
    {{--<li class="nav-item">--}}
    {{--<a class="nav-link" data-toggle="collapse"--}}
    {{--data-target="#collapseThree" aria-expanded="false"--}}
    {{--aria-controls="collapseThree">--}}
    {{--<i class="fas fa-caret-down"></i>--}}
    {{--<p>Insurances</p>--}}
    {{--</a>--}}
    {{--<div id="collapseThree" class="collapse" aria-labelledby="headingThree"--}}
    {{--data-parent="#accordionExample">--}}
    {{--<div class="card-body">--}}
    {{--<div class="filterlist">--}}

    {{--<button data-column="22" type="button"--}}
    {{--class="btn btn-sm btn-toggle toggle-vis"--}}
    {{--data-toggle="button" aria-pressed="false" autocomplete="off">--}}
    {{--<div class="handle"></div>--}}
    {{--</button>--}}

    {{--Health BPJS--}}
    {{--<br>--}}
    {{--<button data-column="23" type="button"--}}
    {{--class="btn btn-sm btn-toggle toggle-vis"--}}
    {{--data-toggle="button" aria-pressed="false" autocomplete="off">--}}
    {{--<div class="handle"></div>--}}
    {{--</button>--}}

    {{--Health BPJS ID--}}
    {{--<br>--}}
    {{--<button data-column="24" type="button"--}}
    {{--class="btn btn-sm btn-toggle toggle-vis"--}}
    {{--data-toggle="button" aria-pressed="false" autocomplete="off">--}}
    {{--<div class="handle"></div>--}}
    {{--</button>--}}

    {{--Employment BPJS--}}
    {{--<br>--}}
    {{--<button data-column="25" type="button"--}}
    {{--class="btn btn-sm btn-toggle toggle-vis"--}}
    {{--data-toggle="button" aria-pressed="false" autocomplete="off">--}}
    {{--<div class="handle"></div>--}}
    {{--</button>--}}

    {{--Employment BPJS ID--}}
    {{--<br>--}}
    {{--<button data-column="26" type="button"--}}
    {{--class="btn btn-sm btn-toggle toggle-vis"--}}
    {{--data-toggle="button" aria-pressed="false" autocomplete="off">--}}
    {{--<div class="handle"></div>--}}
    {{--</button>--}}

    {{--Insurance--}}
    {{--<br>--}}

    {{--</div>--}}
    {{--</div>--}}
    {{--</div>--}}

    {{--</li>--}}

@endsection
@section('reportcontent')
    <div class="col-md-12">
        <div class="card">
            <div class="card-header card-header-primary" style="background-color: #e04352; color: white;">
                <h4 class="card-title"><b>Biodata - Report Table</b></h4>
                <p class="card-category">List of employee's biodata</p>
            </div>
            <div class="card-body">
                <table style=" display: block; width: 100%; overflow-x: auto;font-size: 12px;"
                       class="table table-responsive-md table-striped display"
                       id="example">
                    <thead>
                    <tr>

                        <th>Name</th>
                        <th>NIP</th>
                        <th>Institution</th>
                        <th>Status</th>
                        <th>Position</th>
                        <th>Group</th>
                        <th>Place of<br>Birth</th>
                        <th>Birthday</th>
                        <th>Phone Number</th>
                        <th>[Name]<br>Emergency Contact</th>
                        <th>[Number]<br>Emergency Contact</th>
                        <th>Email</th>
                        <th>Domicile</th>
                        <th>Postal Code</th>
                        <th>NIK</th>
                        <th>Religion</th>
                        <th>Civil Status</th>
                        <th>Partner's Name</th>
                        <th>Partner's Birthday</th>
                        <th>Number of<br>Children</th>
                        <th>Last Education</th>
                        <th>University</th>
                        <th>Health BPJS</th>
                        <th>Health BPJS ID</th>
                        <th>Employment BPJS</th>
                        <th>Employment BPJS ID</th>
                        <th>Insurance</th>
                        <th>Gender</th>

                    </tr>
                    </thead>
                    <tbody>
                    @foreach($empbios as $empbio)
                        @if($empbio == null)
                            <tr>

                            </tr>
                        @else
                            <tr>
                                <td>{{$empbio->nama}}</td>
                                <td><a href="{{ url('/account/'.$empbio->id.'/detail') }}">{{$empbio->nip}}</a></td>
                                <td>{{$empbio->institusi}}</td>
                                <td>{{$empbio->status}}</td>
                                <td>{{$empbio->positionid}}</td>
                                <td>{{$empbio->grup}}</td>
                                <td>{{$empbio->tempatlahir}}</td>
                                <td>{{$empbio->tanggallahir}}</td>
                                <td>{{$empbio->nohp}}</td>
                                <td>{{$empbio->nomorkontakdarurat}}</td>
                                <td>{{$empbio->namakontakdarurat}}</td>
                                <td>{{$empbio->emailpribadi}}</td>
                                <td>{{$empbio->domisili}}</td>
                                <td>{{$empbio->kodepos}}</td>
                                <td>{{$empbio->nik}}</td>
                                <td>{{$empbio->agama}}</td>
                                <td>{{$empbio->statussipil}}</td>
                                <td>{{$empbio->namapasangan}}</td>
                                <td>{{$empbio->tanggallahirpasangan}}</td>
                                <td>{{$empbio->jumlahanak}}</td>
                                <td>{{$empbio->pendidikanterakhir}}</td>
                                <td>{{$empbio->universitas}}</td>
                                <td>{{$empbio->bpjskes}}</td>
                                <td>{{$empbio->kodebpjskes}}</td>
                                <td>{{$empbio->bpjstk}}</td>
                                <td>{{$empbio->kodebpjstk}}</td>
                                <td>{{$empbio->asuransi}}</td>
                                <td>{{$empbio->jeniskelamin}}</td>
                            </tr>
                        @endif
                    @endforeach
                    </tbody>
                    <tfoot>
                    <tr>
                        <th style="opacity: 0; z-index: 0" nowrap>Name</th>
                        <th style="opacity: 0; z-index: 0">NIP</th>
                        <th>Institution</th>
                        <th>Status</th>
                        <th>Position</th>
                        <th>Group</th>
                        <th>Place of Birth</th>
                        <th style="opacity: 0; z-index: 0" >Birthday</th>
                        <th style="opacity: 0; z-index: 0" >Phone Number</th>
                        <th style="opacity: 0; z-index: 0" >[Name]<br>Emergency Contact</th>
                        <th style="opacity: 0; z-index: 0" >[Number]<br>Emergency Contact</th>
                        <th style="opacity: 0; z-index: 0" >Email</th>
                        <th style="opacity: 0; z-index: 0" >Domicile</th>
                        <th style="opacity: 0; z-index: 0" >Postal Code</th>
                        <th style="opacity: 0; z-index: 0" >NIK</th>
                        <th >Religion</th>
                        <th>Civil Status</th>
                        <th style="opacity: 0; z-index: 0" >Partner's Name</th>
                        <th style="opacity: 0; z-index: 0" >Partner's Birthday</th>
                        <th>Number of Children</th>
                        <th>Last Education</th>
                        <th>University</th>
                        <th style="opacity: 0; z-index: 0" >Health BPJS</th>
                        <th style="opacity: 0; z-index: 0" >Health BPJS ID</th>
                        <th style="opacity: 0; z-index: 0" >Employment BPJS</th>
                        <th style="opacity: 0; z-index: 0" >Employment BPJS ID</th>
                        <th style="opacity: 0; z-index: 0" >Insurance</th>
                        <th>Gender</th>
                    </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
    <style>
        .table > tbody > tr > td:first-child {
            position: absolute;
            width: 125px;
        }

        .table > thead:first-child > tr:first-child > th:nth-child(2) {
            padding-left: 160px;
        }

        .table > tbody > tr > td:nth-child(2) {
            padding-left: 160px !important;
        }
        thead th{
            text-transform: uppercase;
        }

    </style>
@endsection