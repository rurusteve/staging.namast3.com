@extends('layouts.reports')
@section('contentreporthead')

    <style>
        tbody tr td:nth-child(n+15) {
            text-align: right;
        }
        thead th{
            text-transform: uppercase;
        }
    </style>
    {{--<li class="nav-item">--}}
    {{--<a class="nav-link" data-toggle="collapse"--}}
    {{--data-target="#collapseOne" aria-expanded="false"--}}
    {{--aria-controls="collapseOne" id="accordionExample">--}}
    {{--<i class="fas fa-caret-down"></i>--}}
    {{--<p>Payroll Bio</p>--}}
    {{--</a>--}}
    {{--<div id="collapseOne" class="collapse show" aria-labelledby="headingOne"--}}
    {{--data-parent="#accordionExample">--}}
    {{--<div class="card-body">--}}
    {{--<div class="filterlist">--}}
    {{--<button data-column="1" type="button"--}}
    {{--class="btn btn-sm btn-toggle toggle-vis"--}}
    {{--data-toggle="button" aria-pressed="false" autocomplete="off">--}}
    {{--<div class="handle"></div>--}}
    {{--</button>--}}
    {{--NIP<br>--}}
    {{--<button data-column="2" type="button"--}}
    {{--class="btn btn-sm btn-toggle toggle-vis"--}}
    {{--data-toggle="button" aria-pressed="false" autocomplete="off">--}}
    {{--<div class="handle"></div>--}}
    {{--</button>--}}
    {{--Institution<br>--}}
    {{--<button data-column="3" type="button"--}}
    {{--class="btn btn-sm btn-toggle toggle-vis"--}}
    {{--data-toggle="button" aria-pressed="false" autocomplete="off">--}}
    {{--<div class="handle"></div>--}}
    {{--</button>--}}
    {{--City<br>--}}
    {{--<button data-column="4" type="button"--}}
    {{--class="btn btn-sm btn-toggle toggle-vis"--}}
    {{--data-toggle="button" aria-pressed="false" autocomplete="off">--}}
    {{--<div class="handle"></div>--}}
    {{--</button>--}}
    {{--Join<br>--}}
    {{--<button data-column="5" type="button"--}}
    {{--class="btn btn-sm btn-toggle toggle-vis"--}}
    {{--data-toggle="button" aria-pressed="false" autocomplete="off">--}}
    {{--<div class="handle"></div>--}}
    {{--</button>--}}
    {{--Status<br>--}}
    {{--<button data-column="6" type="button"--}}
    {{--class="btn btn-sm btn-toggle toggle-vis"--}}
    {{--data-toggle="button" aria-pressed="false" autocomplete="off">--}}
    {{--<div class="handle"></div>--}}
    {{--</button>--}}
    {{--Position<br></div>--}}
    {{--</div>--}}
    {{--</div>--}}
    {{--</li>--}}

    {{--<li class="nav-item">--}}
    {{--<a class="nav-link" data-toggle="collapse" data-target="#collapseTwo"--}}
    {{--aria-expanded="false" aria-controls="collapseTwo">--}}
    {{--<i class="fas fa-caret-down"></i>--}}
    {{--<p>Main Payroll</p>--}}
    {{--</a>--}}
    {{--<div id="collapseTwo" class="collapse" aria-labelledby="headingTwo"--}}
    {{--data-parent="#accordionExample">--}}
    {{--<div class="card-body">--}}
    {{--<div class="filterlist">--}}
    {{--<button data-column="7" type="button"--}}
    {{--class="btn btn-sm btn-toggle toggle-vis"--}}
    {{--data-toggle="button" aria-pressed="false" autocomplete="off">--}}
    {{--<div class="handle"></div>--}}
    {{--</button>--}}
    {{--Overtime<br>--}}
    {{--<button data-column="8" type="button"--}}
    {{--class="btn btn-sm btn-toggle toggle-vis"--}}
    {{--data-toggle="button" aria-pressed="false" autocomplete="off">--}}
    {{--<div class="handle"></div>--}}
    {{--</button>--}}
    {{--Grade<br>--}}
    {{--<button data-column="9" type="button"--}}
    {{--class="btn btn-sm btn-toggle toggle-vis"--}}
    {{--data-toggle="button" aria-pressed="false" autocomplete="off">--}}
    {{--<div class="handle"></div>--}}
    {{--</button>--}}
    {{--Group<br>--}}
    {{--<button data-column="10" type="button"--}}
    {{--class="btn btn-sm btn-toggle toggle-vis"--}}
    {{--data-toggle="button" aria-pressed="false" autocomplete="off">--}}
    {{--<div class="handle"></div>--}}
    {{--</button>--}}
    {{--Division<br>--}}
    {{--<button data-column="11" type="button"--}}
    {{--class="btn btn-sm btn-toggle toggle-vis"--}}
    {{--data-toggle="button" aria-pressed="false" autocomplete="off">--}}
    {{--<div class="handle"></div>--}}
    {{--</button>--}}
    {{--Bank<br>--}}
    {{--<button data-column="12" type="button"--}}
    {{--class="btn btn-sm btn-toggle toggle-vis"--}}
    {{--data-toggle="button" aria-pressed="false" autocomplete="off">--}}
    {{--<div class="handle"></div>--}}
    {{--</button>--}}
    {{--NPWP<br>--}}
    {{--<button data-column="13" type="button"--}}
    {{--class="btn btn-sm btn-toggle toggle-vis"--}}
    {{--data-toggle="button" aria-pressed="false" autocomplete="off">--}}
    {{--<div class="handle"></div>--}}
    {{--</button>--}}
    {{--PTKP<br>--}}
    {{--</div>--}}
    {{--</div>--}}
    {{--</div>--}}
    {{--</li>--}}

    {{--<li class="nav-item">--}}
    {{--<a class="nav-link" data-toggle="collapse" data-target="#collapseThree"--}}
    {{--aria-expanded="false" aria-controls="collapseThree">--}}
    {{--<i class="fas fa-caret-down"></i>--}}
    {{--<p>Payroll Attributes</p>--}}
    {{--</a>--}}
    {{--<div id="collapseThree" class="collapse" aria-labelledby="headingThree"--}}
    {{--data-parent="#accordionExample">--}}
    {{--<div class="card-body">--}}
    {{--<div class="filterlist">--}}
    {{--<button data-column="14" type="button"--}}
    {{--class="btn btn-sm btn-toggle toggle-vis"--}}
    {{--data-toggle="button" aria-pressed="false" autocomplete="off">--}}
    {{--<div class="handle"></div>--}}
    {{--</button>--}}
    {{--Salary<br>--}}
    {{--<button data-column="15" type="button"--}}
    {{--class="btn btn-sm btn-toggle toggle-vis"--}}
    {{--data-toggle="button" aria-pressed="false" autocomplete="off">--}}
    {{--<div class="handle"></div>--}}
    {{--</button>--}}
    {{--Position Allowance<br>--}}
    {{--<button data-column="16" type="button"--}}
    {{--class="btn btn-sm btn-toggle toggle-vis"--}}
    {{--data-toggle="button" aria-pressed="false" autocomplete="off">--}}
    {{--<div class="handle"></div>--}}
    {{--</button>--}}
    {{--Health Allowance<br>--}}
    {{--<button data-column="17" type="button"--}}
    {{--class="btn btn-sm btn-toggle toggle-vis"--}}
    {{--data-toggle="button" aria-pressed="false" autocomplete="off">--}}
    {{--<div class="handle"></div>--}}
    {{--</button>--}}
    {{--Other Allowance<br>--}}
    {{--<button data-column="18" type="button"--}}
    {{--class="btn btn-sm btn-toggle toggle-vis"--}}
    {{--data-toggle="button" aria-pressed="false" autocomplete="off">--}}
    {{--<div class="handle"></div>--}}
    {{--</button>--}}
    {{--Daily Allowance<br>--}}
    {{--<button data-column="19" type="button"--}}
    {{--class="btn btn-sm btn-toggle toggle-vis"--}}
    {{--data-toggle="button" aria-pressed="false" autocomplete="off">--}}
    {{--<div class="handle"></div>--}}
    {{--</button>--}}
    {{--Transportation<br>--}}
    {{--<button data-column="20" type="button"--}}
    {{--class="btn btn-sm btn-toggle toggle-vis"--}}
    {{--data-toggle="button" aria-pressed="false" autocomplete="off">--}}
    {{--<div class="handle"></div>--}}
    {{--</button>--}}
    {{--Overtime's Food<br>--}}
    {{--<button data-column="21" type="button"--}}
    {{--class="btn btn-sm btn-toggle toggle-vis"--}}
    {{--data-toggle="button" aria-pressed="false" autocomplete="off">--}}
    {{--<div class="handle"></div>--}}
    {{--</button>--}}
    {{--% BPJS<br>--}}
    {{--</div>--}}
    {{--</div>--}}
    {{--</div>--}}
    {{--</li>--}}

@endsection
@section('reportcontent')
    <div class="col-md-12">
        <div class="card">
            <div class="card-header card-header-primary" style="background-color: #ff9361; color: white;">
                <h4 class="card-title"><b>Payroll Data - Report Table | AUD</b></h4>
                <p class="card-category">List of employee's main data for payroll</p>
            </div>
            <div class="card-body">
                <table style=" display: block; width: 100%; overflow-x: auto;font-size: 12px;"
                       class="table table-striped display"
                       id="example">
                    <thead>
                    <tr>
                        <th nowrap>Name</th>
                        <th nowrap>NIP</th>
                        <th nowrap>Join</th>
                        <th nowrap>Join Period</th>
                        <th nowrap>Resign</th>
                        <th nowrap>Status</th>
                        <th nowrap>Position</th>
                        <th nowrap>Overtime</th>
                        <th nowrap>Grade</th>
                        <th nowrap>Group</th>
                        <th nowrap>Bank</th>
                        <th nowrap>NPWP</th>
                        <th nowrap>PTKP</th>
                        <th nowrap>Salary</th>
                        <th nowrap>Position Allowance</th>
                        <th nowrap>Health Allowance</th>
                        <th nowrap>Other Allowance</th>
                        <th nowrap>Daily Allowance</th>
                        <th nowrap>Transportation</th>
                        <th nowrap>Overtime's Food</th>
                        <th nowrap>Reimbursement</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($biopayaudits as $biopayaudit)
                        <tr>
                            <td>
                                @if(strlen($biopayaudit->nama) <= 25)
                                {{$biopayaudit->nama}}
                                @else
                                {{substr($biopayaudit->nama,0,25)}}..
                                @endif
                            </td>
                            <td><a href="{{ url('/account/'.$biopayaudit->id.'/detail') }}">{{$biopayaudit->nip}}</a></td>
                            <td>{{date('d/m/y', strtotime($biopayaudit->tanggalbergabung))}}</td>
                            <td>
                            {{number_format((float)$biopayaudit->datediff / 12, 2, '.', '')}}                                {{--@if(floor($biopaytax->datediff / 365) <= 0) <span--}}
                                {{--@if(floor($biopayaudit->datediff / 365) <= 0) <span--}}
                                        {{--style="display: none">{{$year = floor($biopayaudit->datediff / 365)}}</span> @else {{$year = floor($biopayaudit->datediff / 365)}}y @endif--}}
                                {{--@if(floor(($biopayaudit->datediff - ($year * 365)) / 30) <= 0) <span--}}
                                        {{--style="display: none">{{$month = floor(($biopayaudit->datediff - ($year * 365)) / 30)}}</span> @else {{$month = floor(($biopayaudit->datediff - ($year * 365)) / 30)}}m @endif--}}
                                {{--@if(((($biopayaudit->datediff - ($year * 365)) / 30) - $month) * 30 <= 0) <span--}}
                                        {{--style="display: none">{{$days = ((($biopayaudit->datediff - ($year * 365)) / 30) - $month) * 30}}</span> @else {{$days = ((($biopayaudit->datediff - ($year * 365)) / 30) - $month) * 30}}d @endif</td>--}}
                            <td>
                                @if($biopayaudit->tanggalresign == 'null' || $biopayaudit->tanggalresign == null)
                                @else
                                    {{date('d/m/y', strtotime($biopayaudit->tanggalresign))}}
                                @endif
                            </td>
                            <td>{{$biopayaudit->status}}</td>
                            <td>{{$biopayaudit->positionid}}</td>
                            <td>{{$biopayaudit->lembur}}</td>
                            <td>{{$biopayaudit->grade}}</td>
                            <td>{{$biopayaudit->grup}}</td>
                            <td>{{$biopayaudit->norek}}</td>
                            <td>{{$biopayaudit->npwp}}</td>
                            <td>{{$biopayaudit->statusptkp}}</td>
                            <td>{{number_format($biopayaudit->gajipokok,0,",",".")}}</td>
                            <td>{{number_format($biopayaudit->tunjanganjabatan,0,",",".")}}</td>
                            <td>{{number_format($biopayaudit->tunjangankesehatan,0,",",".")}}</td>
                            <td>{{number_format($biopayaudit->tunjanganlain,0,",",".")}}</td>
                            <td>{{number_format($biopayaudit->tarifthhari,0,",",".")}}</td>
                            <td>{{number_format($biopayaudit->tariftransportasi,0,",",".")}}</td>
                            <td>{{number_format($biopayaudit->tarifmakanlembur,0,",",".")}}</td>
                            <td>{{$biopayaudit->persenbpjskesehatan}}%</td>
                        </tr>
                    @endforeach
                    </tbody>
                    <tfoot>
                    <tr>
                        <th style="opacity: 0" nowrap>Name</th>
                        <th style="opacity: 0" nowrap>NIP
                        </th>
                        <th style="opacity: 0" nowrap>Join</th>
                        <th style="opacity: 0"></th>
                        <th style="opacity: 0"></th>
                        <th nowrap>Status</th>
                        <th nowrap>Position</th>
                        <th nowrap>Overtime</th>
                        <th nowrap>Grade</th>
                        <th nowrap>Group</th>
                        <th style="opacity: 0" nowrap>Bank</th>
                        <th nowrap>NPWP</th>
                        <th nowrap>PTKP</th>
                        <th style="opacity: 0" nowrap>Salary</th>
                        <th style="opacity: 0" nowrap>Position Allowance</th>
                        <th style="opacity: 0" nowrap>Health Allowance</th>
                        <th style="opacity: 0" nowrap>Other Allowance</th>
                        <th style="opacity: 0" nowrap>Daily Allowance</th>
                        <th style="opacity: 0" nowrap>Transportation</th>
                        <th style="opacity: 0" nowrap>Overtime's Food</th>
                        <th style="opacity: 0" nowrap>% BPJS</th>
                    </tr>
                    </tfoot>
                </table>
            </div>
        </div>
        <br>

        <div class="card">
            <div class="card-header card-header-info" style="background-color: #ff9361; color: white;">
                <h4 class="card-title"><b>Payroll Data - Report Table | TAX</b></h4>
                <p class="card-category">List of employee's main data for payroll</p>
            </div>
            <div class="card-body">
                <table style=" display: block; width: 100%; overflow-x: auto;font-size: 12px;"
                       class="table table-responsive-md table-striped display"
                       id="exampletwo">
                    <thead>
                    <tr>
                        <th nowrap>Name</th>
                        <th nowrap>NIP</th>
                        <th nowrap>Join</th>
                        <th nowrap>Join Period</th>
                        <th>Resign</th>
                        <th nowrap>Status</th>
                        <th nowrap>Position</th>
                        <th nowrap>Overtime</th>
                        <th nowrap>Grade</th>
                        <th nowrap>Group</th>
                        <th nowrap>Bank</th>
                        <th nowrap>NPWP</th>
                        <th nowrap>PTKP</th>
                        <th nowrap>Salary</th>
                        <th nowrap>Position Allowance</th>
                        <th nowrap>Health Allowance</th>
                        <th nowrap>Other Allowance</th>
                        <th nowrap>Daily Allowance</th>
                        <th nowrap>Transportation</th>
                        <th nowrap>Overtime's Food</th>
                        <th nowrap>Reimbursement</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($biopaytaxs as $biopaytax)
                        <tr>
                            <td>
                                @if(strlen($biopaytax->nama) <= 25)
                                {{$biopaytax->nama}}
                                @else
                                {{substr($biopaytax->nama,0,25)}}..
                                @endif
                            </td>
                            <td><a href="{{ url('/account/'.$biopaytax->id.'/detail') }}">{{$biopaytax->nip}}</a></td>
                            <td>{{date('d/m/y', strtotime($biopaytax->tanggalbergabung))}}</td>
                            {{--                            <td>{{$biopaytax->tanggalbergabung->diff(Carbon::now);}}</td>--}}

                            <td>
                            {{number_format((float)$biopaytax->datediff / 12, 2, '.', '')}}                                {{--@if(floor($biopaytax->datediff / 365) <= 0) <span--}}
                                        {{--style="display: none">{{$year = floor($biopaytax->datediff / 365)}}</span> @else {{$year = floor($biopaytax->datediff / 365)}}y @endif--}}
                                {{--@if(floor(($biopaytax->datediff - ($year * 365)) / 30) <= 0) <span--}}
                                        {{--style="display: none">{{$month = floor(($biopaytax->datediff - ($year * 365)) / 30)}}</span> @else {{$month = floor(($biopaytax->datediff - ($year * 365)) / 30)}}m @endif--}}
                                {{--@if(((($biopaytax->datediff - ($year * 365)) / 30) - $month) * 30 <= 0) <span--}}
                                        {{--style="display: none">{{$days = ((($biopaytax->datediff - ($year * 365)) / 30) - $month) * 30}}</span> @else {{$days = ((($biopaytax->datediff - ($year * 365)) / 30) - $month) * 30}}d @endif</td>--}}
                            <td>
                                @if($biopaytax->tanggalresign == 'null' || $biopaytax->tanggalresign == null)
                                @else
                                    {{date('d/m/y', strtotime($biopaytax->tanggalresign))}}
                                @endif
                            </td>
                            <td>{{$biopaytax->status}}</td>
                            <td>{{$biopaytax->positionid}}</td>
                            <td>{{$biopaytax->lembur}}</td>
                            <td>{{$biopaytax->grade}}</td>
                            <td>{{$biopaytax->grup}}</td>
                            <td>{{$biopaytax->norek}}</td>
                            <td>{{$biopaytax->npwp}}</td>
                            <td>{{$biopaytax->statusptkp}}</td>
                            <td>{{number_format($biopaytax->gajipokok,0,",",".")}}</td>
                            <td>{{number_format($biopaytax->tunjanganjabatan,0,",",".")}}</td>
                            <td>{{number_format($biopaytax->tunjangankesehatan,0,",",".")}}</td>
                            <td>{{number_format($biopaytax->tunjanganlain,0,",",".")}}</td>
                            <td>{{number_format($biopaytax->tarifthhari,0,",",".")}}</td>
                            <td>{{number_format($biopaytax->tariftransportasi,0,",",".")}}</td>
                            <td>{{number_format($biopaytax->tarifmakanlembur,0,",",".")}}</td>
                            <td>{{$biopaytax->persenbpjskesehatan}}%</td>
                        </tr>
                    @endforeach
                    </tbody>
                    <tfoot>
                    <tr>
                        <th style="opacity: 0" nowrap>Name</th>
                        <th style="opacity: 0" nowrap>NIP</th>

                        <th style="opacity: 0" nowrap>Join</th>
                        <th style="opacity: 0"></th>
                        <th style="opacity: 0"></th>
                        <th nowrap>Status</th>
                        <th nowrap>Position</th>
                        <th nowrap>Overtime</th>
                        <th nowrap>Grade</th>
                        <th nowrap>Group</th>
                        <th style="opacity: 0" nowrap>Bank</th>
                        <th nowrap>NPWP</th>
                        <th nowrap>PTKP</th>
                        <th style="opacity: 0" nowrap>Salary</th>
                        <th style="opacity: 0" nowrap>Position Allowance</th>
                        <th style="opacity: 0" nowrap>Health Allowance</th>
                        <th style="opacity: 0" nowrap>Other Allowance</th>
                        <th style="opacity: 0" nowrap>Daily Allowance</th>
                        <th style="opacity: 0" nowrap>Transportation</th>
                        <th style="opacity: 0" nowrap>Overtime's Food</th>
                        <th style="opacity: 0" nowrap>% BPJS</th>
                    </tr>
                    </tfoot>
                </table>
            </div>
        </div>
        <br>

        <div class="card">
            <div class="card-header card-header-danger" style="background-color: #ff9361; color: white;">
                <h4 class="card-title"><b>Payroll Data - Report Table | ACC</b></h4>
                <p class="card-category">List of employee's main data for payroll</p>
            </div>
            <div class="card-body">
                <table style=" display: block; width: 100%; overflow-x: auto;font-size: 12px;"
                       class="table table-responsive-md table-striped display"
                       id="examplethree">
                    <thead>
                    <tr>
                        <th nowrap>Name</th>
                        <th nowrap>NIP</th>
                        <th nowrap>Join</th>
                        <th nowrap>Join Period</th>
                        <th>Resign</th>
                        <th nowrap>Status</th>
                        <th nowrap>Position</th>
                        <th nowrap>Overtime</th>
                        <th nowrap>Grade</th>
                        <th nowrap>Group</th>
                        <th nowrap>Bank</th>
                        <th nowrap>NPWP</th>
                        <th nowrap>PTKP</th>
                        <th nowrap>Salary</th>
                        <th nowrap>Position Allowance</th>
                        <th nowrap>Health Allowance</th>
                        <th nowrap>Other Allowance</th>
                        <th nowrap>Daily Allowance</th>
                        <th nowrap>Transportation</th>
                        <th nowrap>Overtime's Food</th>
                        <th nowrap>Reimbursement</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($biopayaccs as $biopayacc)
                        <tr>
                            <td>
                                @if(strlen($biopayacc->nama) <= 25)
                                {{$biopayacc->nama}}
                                @else
                                {{substr($biopayacc->nama,0,25)}}..
                                @endif
                            </td>
                            <td><a href="{{ url('/account/'.$biopayacc->id.'/detail') }}">{{$biopayacc->nip}}</a></td>
                            <td>{{date('d/m/y', strtotime($biopayacc->tanggalbergabung))}}</td>
                            <td>
                            {{number_format((float)$biopayacc->datediff / 12, 2, '.', '')}}                                {{--@if(floor($biopayacc->datediff / 365) <= 0) <span--}}
                                        {{--style="display: none">{{$year = floor($biopayacc->datediff / 365)}}</span> @else {{$year = floor($biopayacc->datediff / 365)}}y @endif--}}
                                {{--@if(floor(($biopayacc->datediff - ($year * 365)) / 30) <= 0) <span--}}
                                        {{--style="display: none">{{$month = floor(($biopayacc->datediff - ($year * 365)) / 30)}}</span> @else {{$month = floor(($biopayacc->datediff - ($year * 365)) / 30)}}m @endif--}}
                                {{--@if(((($biopayacc->datediff - ($year * 365)) / 30) - $month) * 30 <= 0) <span--}}
                                        {{--style="display: none">{{$days = ((($biopayacc->datediff - ($year * 365)) / 30) - $month) * 30}}</span> @else {{$days = ((($biopayacc->datediff - ($year * 365)) / 30) - $month) * 30}}d @endif</td>--}}

                            <td>
                                @if($biopayacc->tanggalresign == 'null' || $biopayacc->tanggalresign == null)
                                @else
                                    {{date('d/m/y', strtotime($biopayacc->tanggalresign))}}
                                @endif
                            </td>
                            {{--                            <td>{{$biopayacc->tanggalbergabung->diff(Carbon::now);}}</td>--}}
                            <td>{{$biopayacc->status}}</td>
                            <td>{{$biopayacc->positionid}}</td>
                            <td>{{$biopayacc->lembur}}</td>
                            <td>{{$biopayacc->grade}}</td>
                            <td>{{$biopayacc->grup}}</td>
                            <td>{{$biopayacc->norek}}</td>
                            <td>{{$biopayacc->npwp}}</td>
                            <td>{{$biopayacc->statusptkp}}</td>
                            <td>{{number_format($biopayacc->gajipokok,0,",",".")}}</td>
                            <td>{{number_format($biopayacc->tunjanganjabatan,0,",",".")}}</td>
                            <td>{{number_format($biopayacc->tunjangankesehatan,0,",",".")}}</td>
                            <td>{{number_format($biopayacc->tunjanganlain,0,",",".")}}</td>
                            <td>{{number_format($biopayacc->tarifthhari,0,",",".")}}</td>
                            <td>{{number_format($biopayacc->tariftransportasi,0,",",".")}}</td>
                            <td>{{number_format($biopayacc->tarifmakanlembur,0,",",".")}}</td>
                            <td>{{$biopayacc->persenbpjskesehatan}}%</td>
                        </tr>
                    @endforeach
                    </tbody>
                    <tfoot>
                    <tr>
                        <th style="opacity: 0" nowrap>Name</th>
                        <th style="opacity: 0" nowrap>NIP
                        </th>
                        <th style="opacity: 0" nowrap>Join</th>
                        <th style="opacity: 0"></th>
                        <th style="opacity: 0"></th>
                        <th nowrap>Status</th>
                        <th nowrap>Position</th>
                        <th nowrap>Overtime</th>
                        <th nowrap>Grade</th>
                        <th nowrap>Group</th>
                        <th style="opacity: 0" nowrap>Bank</th>
                        <th nowrap>NPWP</th>
                        <th nowrap>PTKP</th>
                        <th style="opacity: 0" nowrap>Salary</th>
                        <th style="opacity: 0" nowrap>Position Allowance</th>
                        <th style="opacity: 0" nowrap>Health Allowance</th>
                        <th style="opacity: 0" nowrap>Other Allowance</th>
                        <th style="opacity: 0" nowrap>Daily Allowance</th>
                        <th style="opacity: 0" nowrap>Transportation</th>
                        <th style="opacity: 0" nowrap>Overtime's Food</th>
                        <th style="opacity: 0" nowrap>% BPJS</th>
                    </tr>
                    </tfoot>
                </table>
            </div>
        </div>
        <br>

        <div class="card">
            <div class="card-header card-header-warning" style="background-color: #ff9361; color: white;">
                <h4 class="card-title"><b>Payroll Data - Report Table | ADM</b></h4>
                <p class="card-category">List of employee's main data for payroll</p>
            </div>
            <div class="card-body">
                <table style=" display: block; width: 100%; overflow-x: auto;font-size: 12px;"
                       class="table table-responsive-md table-striped display"
                       id="examplefour">
                    <thead>
                    <tr>
                        <th nowrap>Name</th>
                        <th nowrap>NIP</th>
                        <th nowrap>Join</th>
                        <th nowrap>Join Period</th>
                        <th>Resign</th>
                        <th nowrap>Status</th>
                        <th nowrap>Position</th>
                        <th nowrap>Overtime</th>
                        <th nowrap>Grade</th>
                        <th nowrap>Group</th>
                        <th nowrap>Bank</th>
                        <th nowrap>NPWP</th>
                        <th nowrap>PTKP</th>
                        <th nowrap>Salary</th>
                        <th nowrap>Position Allowance</th>
                        <th nowrap>Health Allowance</th>
                        <th nowrap>Other Allowance</th>
                        <th nowrap>Daily Allowance</th>
                        <th nowrap>Transportation</th>
                        <th nowrap>Overtime's Food</th>
                        <th nowrap>Reimbursement</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($biopayadms as $biopayadm)
                        <tr>
                            <td>
                                @if(strlen($biopayadm->nama) <= 25)
                                {{$biopayadm->nama}}
                                @else
                                {{substr($biopayadm->nama,0,25)}}..
                                @endif
                            </td>
                            <td><a href="{{ url('/account/'.$biopayadm->id.'/detail') }}">{{$biopayadm->nip}}</a></td>
                            <td>{{date('d/m/y', strtotime($biopayadm->tanggalbergabung))}}</td>
                            <td>
                                {{number_format((float)$biopayadm->datediff / 12, 2, '.', '')}}
                                {{--@if(floor($biopayadm->datediff / 365) <= 0) <span--}}
                                        {{--style="display: none">{{$year = floor($biopayadm->datediff / 365)}}</span> @else {{$year = floor($biopayadm->datediff / 365)}}y @endif--}}
                                {{--@if(floor(($biopayadm->datediff - ($year * 365)) / 30) <= 0) <span--}}
                                        {{--style="display: none">{{$month = floor(($biopayadm->datediff - ($year * 365)) / 30)}}</span> @else {{$month = floor(($biopayadm->datediff - ($year * 365)) / 30)}}m @endif--}}
                                {{--@if(((($biopayadm->datediff - ($year * 365)) / 30) - $month) * 30 <= 0) <span--}}
                                        {{--style="display: none">{{$days = ((($biopayadm->datediff - ($year * 365)) / 30) - $month) * 30}}</span> @else {{$days = ((($biopayadm->datediff - ($year * 365)) / 30) - $month) * 30}}d @endif</td>--}}

                            <td>
                                @if($biopayadm->tanggalresign == 'null' || $biopayadm->tanggalresign == null)
                                @else
                                    {{date('d/m/y', strtotime($biopayadm->tanggalresign))}}
                                @endif
                            </td>
                            {{--                            <td>{{$biopayadm->tanggalbergabung->diff(Carbon::now);}}</td>--}}
                            <td>{{$biopayadm->status}}</td>
                            <td>{{$biopayadm->positionid}}</td>
                            <td>{{$biopayadm->lembur}}</td>
                            <td>{{$biopayadm->grade}}</td>
                            <td>{{$biopayadm->grup}}</td>
                            <td>{{$biopayadm->norek}}</td>
                            <td>{{$biopayadm->npwp}}</td>
                            <td>{{$biopayadm->statusptkp}}</td>
                            <td>{{number_format($biopayadm->gajipokok,0,",",".")}}</td>
                            <td>{{number_format($biopayadm->tunjanganjabatan,0,",",".")}}</td>
                            <td>{{number_format($biopayadm->tunjangankesehatan,0,",",".")}}</td>
                            <td>{{number_format($biopayadm->tunjanganlain,0,",",".")}}</td>
                            <td>{{number_format($biopayadm->tarifthhari,0,",",".")}}</td>
                            <td>{{number_format($biopayadm->tariftransportasi,0,",",".")}}</td>
                            <td>{{number_format($biopayadm->tarifmakanlembur,0,",",".")}}</td>
                            <td>{{$biopayadm->persenbpjskesehatan}}%</td>
                        </tr>
                    @endforeach
                    </tbody>
                    <tfoot>
                    <tr>
                        <th style="opacity: 0" nowrap>Name</th>
                        <th style="opacity: 0" nowrap>NIP
                        </th>
                        <th style="opacity: 0" nowrap>Join</th>
                        <th style="opacity: 0"></th>
                        <th style="opacity: 0"></th>
                        <th nowrap>Status</th>
                        <th nowrap>Position</th>
                        <th nowrap>Overtime</th>
                        <th nowrap>Grade</th>
                        <th nowrap>Group</th>
                        <th style="opacity: 0" nowrap>Bank</th>
                        <th nowrap>NPWP</th>
                        <th nowrap>PTKP</th>
                        <th style="opacity: 0" nowrap>Salary</th>
                        <th style="opacity: 0" nowrap>Position Allowance</th>
                        <th style="opacity: 0" nowrap>Health Allowance</th>
                        <th style="opacity: 0" nowrap>Other Allowance</th>
                        <th style="opacity: 0" nowrap>Daily Allowance</th>
                        <th style="opacity: 0" nowrap>Transportation</th>
                        <th style="opacity: 0" nowrap>Overtime's Food</th>
                        <th style="opacity: 0" nowrap>% BPJS</th>
                    </tr>
                    </tfoot>
                </table>
            </div>
        </div>
        
        <div class="card">
            <div class="card-header">
                <h3>Download with Filter</h3>
            </div>
            <div class="card-body">
                <form action="{{ url('/partner/reporting/payrolldata/download') }}" method="GET">
                    @csrf
                    <div class="form-row">
                        <div class="col">
                            <label for="institusi">Institution</label>
                            <select id="institusi" name="institusi" class="form-control">
                                <option disabled selected>
                                    All Institution
                                </option>
                                @foreach($institusis as $institusi)
                                    <option>
                                        {{ $institusi -> institusi }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col">
                            <label for="kota">City</label>
                            <select id="kota" name="kota" class="form-control">
                                <option disabled selected>
                                    All City
                                </option>
                                @foreach($kotas as $kota)
                                    <option>
                                        {{ $kota -> kota }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col">
                            <label for="status">Status</label>
                            <select id="status" name="status" class="form-control">
                                <option disabled selected>
                                    All Status
                                </option>
                                @foreach($statuses as $status)
                                    <option>
                                        {{ $status -> status }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="col">
                            <label for="positionid">Position</label>
                            <select id="positionid" name="positionid" class="form-control">
                                <option disabled selected>
                                    All Position
                                </option>
                                @foreach($posisis as $posisi)
                                    <option>
                                        {{ $posisi -> positionid }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col">
                            <label for="grade">Grade</label>
                            <select id="grade" name="grade" class="form-control">
                                <option disabled selected>
                                    All Grade
                                </option>
                                @foreach($grades as $grade)
                                    <option>
                                        {{ $grade -> grade }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col">
                            <label for="group">Group</label>
                            <select id="group" name="group" class="form-control">
                                <option disabled selected>
                                    All Group
                                </option>
                                @foreach($grups as $grup)
                                    <option>
                                        {{ $grup -> grup }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <br>
                    <input class="btn btn-danger" type="reset" value="Reset">
                    <button class="btn btn-success" type="submit">Download Payroll Data</button>
                </form>
            </div>
        </div>

    </div>
    <style type="text/css">
        .table > thead:first-child > tr:first-child > th:first-child {
            width: 200px !important;
        }

        .caret {
            display: none !important;
        }
        @media screen and (min-width: 800px) {
            .table > thead:first-child > tr:first-child > th:first-child {
                padding-top: 8px !important;
            }
        }
    </style>

@endsection