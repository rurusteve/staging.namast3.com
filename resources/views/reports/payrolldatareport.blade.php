@extends('layouts.reports')
@section('contentfilter')

    {{--<li class="nav-item">--}}
        {{--<a class="nav-link" data-toggle="collapse"--}}
           {{--data-target="#collapseOne" aria-expanded="false"--}}
           {{--aria-controls="collapseOne" id="accordionExample">--}}
            {{--<i class="fas fa-caret-down"></i>--}}
            {{--<p>Attributes</p>--}}
        {{--</a>--}}
        {{--<div id="collapseOne" class="collapse" aria-labelledby="headingOne"--}}
             {{--data-parent="#accordionExample">--}}
            {{--<div class="card-body">--}}
                {{--<div class="filterlist">--}}
                    {{--<button data-column="1" type="button"--}}
                            {{--class="btn btn-sm btn-toggle toggle-vis"--}}
                            {{--data-toggle="button" aria-pressed="false" autocomplete="off">--}}
                        {{--<div class="handle"></div>--}}
                    {{--</button>--}}
                    {{--NIP--}}
                    {{--<br>--}}
                    {{--<button data-column="2" type="button"--}}
                            {{--class="btn btn-sm btn-toggle toggle-vis"--}}
                            {{--data-toggle="button" aria-pressed="false" autocomplete="off">--}}
                        {{--<div class="handle"></div>--}}
                    {{--</button>--}}
                    {{--Cek NPWP--}}
                    {{--<br>--}}
                    {{--<button data-column="3" type="button"--}}
                            {{--class="btn btn-sm btn-toggle toggle-vis"--}}
                            {{--data-toggle="button" aria-pressed="false" autocomplete="off">--}}
                        {{--<div class="handle"></div>--}}
                    {{--</button>--}}
                    {{--% Kehadiran--}}
                    {{--<br>--}}
                    {{--<button data-column="4" type="button"--}}
                            {{--class="btn btn-sm btn-toggle toggle-vis"--}}
                            {{--data-toggle="button" aria-pressed="false" autocomplete="off">--}}
                        {{--<div class="handle"></div>--}}
                    {{--</button>--}}
                    {{--Fixed Pay Amount--}}
                    {{--<br>--}}
                    {{--<button data-column="5" type="button"--}}
                            {{--class="btn btn-sm btn-toggle toggle-vis"--}}
                            {{--data-toggle="button" aria-pressed="false" autocomplete="off">--}}
                        {{--<div class="handle"></div>--}}
                    {{--</button>--}}
                    {{--FPA Actual--}}
                    {{--<br>--}}
                    {{--<button data-column="6" type="button"--}}
                            {{--class="btn btn-sm btn-toggle toggle-vis"--}}
                            {{--data-toggle="button" aria-pressed="false" autocomplete="off">--}}
                        {{--<div class="handle"></div>--}}
                    {{--</button>--}}
                    {{--% Upah--}}
                    {{--<br>--}}
                    {{--<button data-column="7" type="button"--}}
                            {{--class="btn btn-sm btn-toggle toggle-vis"--}}
                            {{--data-toggle="button" aria-pressed="false" autocomplete="off">--}}
                        {{--<div class="handle"></div>--}}
                    {{--</button>--}}
                    {{--Cek % Upah--}}
                    {{--<br>--}}
                    {{--<button data-column="8" type="button"--}}
                            {{--class="btn btn-sm btn-toggle toggle-vis"--}}
                            {{--data-toggle="button" aria-pressed="false" autocomplete="off">--}}
                        {{--<div class="handle"></div>--}}
                    {{--</button>--}}
                    {{--Attendances in Days--}}
                    {{--<br>--}}
                    {{--<button data-column="9" type="button"--}}
                            {{--class="btn btn-sm btn-toggle toggle-vis"--}}
                            {{--data-toggle="button" aria-pressed="false" autocomplete="off">--}}
                        {{--<div class="handle"></div>--}}
                    {{--</button>--}}
                    {{--Daily Pay Amount (TH)--}}
                    {{--<br>--}}
                    {{--<button data-column="10" type="button"--}}
                            {{--class="btn btn-sm btn-toggle toggle-vis"--}}
                            {{--data-toggle="button" aria-pressed="false" autocomplete="off">--}}
                        {{--<div class="handle"></div>--}}
                    {{--</button>--}}
                    {{--Overtime Fare--}}
                    {{--<br>--}}
                    {{--<button data-column="11" type="button"--}}
                            {{--class="btn btn-sm btn-toggle toggle-vis"--}}
                            {{--data-toggle="button" aria-pressed="false" autocomplete="off">--}}
                        {{--<div class="handle"></div>--}}
                    {{--</button>--}}
                    {{--Overtime Amount in Hour--}}
                    {{--<br>--}}
                    {{--<button data-column="12" type="button"--}}
                            {{--class="btn btn-sm btn-toggle toggle-vis"--}}
                            {{--data-toggle="button" aria-pressed="false" autocomplete="off">--}}
                        {{--<div class="handle"></div>--}}
                    {{--</button>--}}
                    {{--Overtime Amount--}}
                    {{--<br>--}}
                    {{--<button data-column="13" type="button"--}}
                            {{--class="btn btn-sm btn-toggle toggle-vis"--}}
                            {{--data-toggle="button" aria-pressed="false" autocomplete="off">--}}
                        {{--<div class="handle"></div>--}}
                    {{--</button>--}}
                    {{--Transportations--}}
                    {{--<br>--}}
                    {{--<button data-column="14" type="button"--}}
                            {{--class="btn btn-sm btn-toggle toggle-vis"--}}
                            {{--data-toggle="button" aria-pressed="false" autocomplete="off">--}}
                        {{--<div class="handle"></div>--}}
                    {{--</button>--}}
                    {{--Overtime Foods--}}
                    {{--<br>--}}
                    {{--<button data-column="15" type="button"--}}
                            {{--class="btn btn-sm btn-toggle toggle-vis"--}}
                            {{--data-toggle="button" aria-pressed="false" autocomplete="off">--}}
                        {{--<div class="handle"></div>--}}
                    {{--</button>--}}
                    {{--OPE Amount--}}
                    {{--<br>--}}
                    {{--<button data-column="16" type="button"--}}
                            {{--class="btn btn-sm btn-toggle toggle-vis"--}}
                            {{--data-toggle="button" aria-pressed="false" autocomplete="off">--}}
                        {{--<div class="handle"></div>--}}
                    {{--</button>--}}
                    {{--Paid Claim--}}
                    {{--<br>--}}
                    {{--<button data-column="17" type="button"--}}
                            {{--class="btn btn-sm btn-toggle toggle-vis"--}}
                            {{--data-toggle="button" aria-pressed="false" autocomplete="off">--}}
                        {{--<div class="handle"></div>--}}
                    {{--</button>--}}
                    {{--Claim Accumulation--}}
                    {{--<br>--}}
                    {{--<button data-column="18" type="button"--}}
                            {{--class="btn btn-sm btn-toggle toggle-vis"--}}
                            {{--data-toggle="button" aria-pressed="false" autocomplete="off">--}}
                        {{--<div class="handle"></div>--}}
                    {{--</button>--}}
                    {{--% Claim--}}
                    {{--<br>--}}
                    {{--<button data-column="19" type="button"--}}
                            {{--class="btn btn-sm btn-toggle toggle-vis"--}}
                            {{--data-toggle="button" aria-pressed="false" autocomplete="off">--}}
                        {{--<div class="handle"></div>--}}
                    {{--</button>--}}
                    {{--Non-Fixed Income Amount--}}
                    {{--<br>--}}
                    {{--<button data-column="21" type="button"--}}
                            {{--class="btn btn-sm btn-toggle toggle-vis"--}}
                            {{--data-toggle="button" aria-pressed="false" autocomplete="off">--}}
                        {{--<div class="handle"></div>--}}
                    {{--</button>--}}
                    {{--Loan and Deposit Amount--}}
                    {{--<br>--}}
                    {{--<button data-column="23" type="button"--}}
                            {{--class="btn btn-sm btn-toggle toggle-vis"--}}
                            {{--data-toggle="button" aria-pressed="false" autocomplete="off">--}}
                        {{--<div class="handle"></div>--}}
                    {{--</button>--}}
                    {{--Take Home Pay--}}
                    {{--<br>--}}
                    {{--<button data-column="24" type="button"--}}
                            {{--class="btn btn-sm btn-toggle toggle-vis"--}}
                            {{--data-toggle="button" aria-pressed="false" autocomplete="off">--}}
                        {{--<div class="handle"></div>--}}
                    {{--</button>--}}
                    {{--Montly Income--}}
                    {{--<br>--}}
                    {{--<button data-column="27" type="button"--}}
                            {{--class="btn btn-sm btn-toggle toggle-vis"--}}
                            {{--data-toggle="button" aria-pressed="false" autocomplete="off">--}}
                        {{--<div class="handle"></div>--}}
                    {{--</button>--}}
                    {{--Regular Income Amount--}}
                    {{--<br>--}}
                    {{--<button data-column="30" type="button"--}}
                            {{--class="btn btn-sm btn-toggle toggle-vis"--}}
                            {{--data-toggle="button" aria-pressed="false" autocomplete="off">--}}
                        {{--<div class="handle"></div>--}}
                    {{--</button>--}}
                    {{--Gross Income--}}
                    {{--<br>--}}
                    {{--<button data-column="31" type="button"--}}
                            {{--class="btn btn-sm btn-toggle toggle-vis"--}}
                            {{--data-toggle="button" aria-pressed="false" autocomplete="off">--}}
                        {{--<div class="handle"></div>--}}
                    {{--</button>--}}
                    {{--Gross Income (Yearly)--}}
                    {{--<br>--}}
                    {{--<button data-column="32" type="button"--}}
                            {{--class="btn btn-sm btn-toggle toggle-vis"--}}
                            {{--data-toggle="button" aria-pressed="false" autocomplete="off">--}}
                        {{--<div class="handle"></div>--}}
                    {{--</button>--}}
                    {{--Position Allowance--}}
                    {{--<br>--}}
                    {{--<button data-column="35" type="button"--}}
                            {{--class="btn btn-sm btn-toggle toggle-vis"--}}
                            {{--data-toggle="button" aria-pressed="false" autocomplete="off">--}}
                        {{--<div class="handle"></div>--}}
                    {{--</button>--}}
                    {{--Cutting Amount--}}
                    {{--<br>--}}
                    {{--<button data-column="36" type="button"--}}
                            {{--class="btn btn-sm btn-toggle toggle-vis"--}}
                            {{--data-toggle="button" aria-pressed="false" autocomplete="off">--}}
                        {{--<div class="handle"></div>--}}
                    {{--</button>--}}
                    {{--Cutting Amount (Yearly)--}}
                    {{--<br>--}}
                    {{--<button data-column="43" type="button"--}}
                            {{--class="btn btn-sm btn-toggle toggle-vis"--}}
                            {{--data-toggle="button" aria-pressed="false" autocomplete="off">--}}
                        {{--<div class="handle"></div>--}}
                    {{--</button>--}}
                    {{--Been Paid Before--}}
                    {{--<br>--}}
                    {{--<button data-column="44" type="button"--}}
                            {{--class="btn btn-sm btn-toggle toggle-vis"--}}
                            {{--data-toggle="button" aria-pressed="false" autocomplete="off">--}}
                        {{--<div class="handle"></div>--}}
                    {{--</button>--}}
                    {{--Insufficient Payment--}}


                {{--</div>--}}
            {{--</div>--}}
        {{--</div>--}}

    {{--</li>--}}
    {{--<li class="nav-item">--}}
        {{--<a class="nav-link" data-toggle="collapse" data-target="#collapseTwo"--}}
           {{--aria-expanded="false" aria-controls="collapseTwo">--}}
            {{--<i class="fas fa-caret-down"></i>--}}
            {{--<p>Non-Regular Income</p>--}}
        {{--</a>--}}
        {{--<div id="collapseTwo" class="collapse" aria-labelledby="headingTwo"--}}
             {{--data-parent="#accordionExample">--}}
            {{--<div class="card-body">--}}
                {{--<div class="filterlist">--}}
                    {{--<button data-column="29" type="button"--}}
                            {{--class="btn btn-sm btn-toggle toggle-vis"--}}
                            {{--data-toggle="button" aria-pressed="false" autocomplete="off">--}}
                        {{--<div class="handle"></div>--}}
                    {{--</button>--}}
                    {{--Non-Regular Income--}}
                    {{--<br>--}}
                    {{--<button data-column="20" type="button"--}}
                            {{--class="btn btn-sm btn-toggle toggle-vis"--}}
                            {{--data-toggle="button" aria-pressed="false" autocomplete="off">--}}
                        {{--<div class="handle"></div>--}}
                    {{--</button>--}}
                    {{--Non-Regular Income Amount--}}
                    {{--<br>--}}
                    {{--<button data-column="28" type="button"--}}
                            {{--class="btn btn-sm btn-toggle toggle-vis"--}}
                            {{--data-toggle="button" aria-pressed="false" autocomplete="off">--}}
                        {{--<div class="handle"></div>--}}
                    {{--</button>--}}
                    {{--Non-Regular Income Amount (Yearly)--}}
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
            {{--<p>BPJS</p>--}}
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
                    {{--BPJS Amount--}}
                    {{--<br>--}}
                    {{--<button data-column="25" type="button"--}}
                            {{--class="btn btn-sm btn-toggle toggle-vis"--}}
                            {{--data-toggle="button" aria-pressed="false" autocomplete="off">--}}
                        {{--<div class="handle"></div>--}}
                    {{--</button>--}}
                    {{--Employment BPJS 0.54%--}}
                    {{--<br>--}}
                    {{--<button data-column="26" type="button"--}}
                            {{--class="btn btn-sm btn-toggle toggle-vis"--}}
                            {{--data-toggle="button" aria-pressed="false" autocomplete="off">--}}
                        {{--<div class="handle"></div>--}}
                    {{--</button>--}}
                    {{--Health BPJS--}}
                    {{--<br>--}}
                    {{--<button data-column="33" type="button"--}}
                            {{--class="btn btn-sm btn-toggle toggle-vis"--}}
                            {{--data-toggle="button" aria-pressed="false" autocomplete="off">--}}
                        {{--<div class="handle"></div>--}}
                    {{--</button>--}}
                    {{--Employment BPJS 2%--}}
                    {{--<br>--}}
                    {{--<button data-column="34" type="button"--}}
                            {{--class="btn btn-sm btn-toggle toggle-vis"--}}
                            {{--data-toggle="button" aria-pressed="false" autocomplete="off">--}}
                        {{--<div class="handle"></div>--}}
                    {{--</button>--}}
                    {{--Retirement BPJS 1%--}}
                    {{--<br>--}}
                {{--</div>--}}
            {{--</div>--}}
        {{--</div>--}}
    {{--</li>--}}
    {{--<li class="nav-item">--}}
        {{--<a class="nav-link" data-toggle="collapse"--}}
           {{--data-target="#collapseFour" aria-expanded="false"--}}
           {{--aria-controls="collapseFour">--}}
            {{--<i class="fas fa-caret-down"></i>--}}
            {{--<p>Tax</p>--}}
        {{--</a>--}}
        {{--<div id="collapseFour" class="collapse" aria-labelledby="headingFour"--}}
             {{--data-parent="#accordionExample">--}}
            {{--<div class="card-body">--}}
                {{--<div class="filterlist">--}}
                    {{--<button data-column="37" type="button"--}}
                            {{--class="btn btn-sm btn-toggle toggle-vis"--}}
                            {{--data-toggle="button" aria-pressed="false" autocomplete="off">--}}
                        {{--<div class="handle"></div>--}}
                    {{--</button>--}}
                    {{--PKP--}}
                    {{--<br>--}}
                    {{--<button data-column="38" type="button"--}}
                            {{--class="btn btn-sm btn-toggle toggle-vis"--}}
                            {{--data-toggle="button" aria-pressed="false" autocomplete="off">--}}
                        {{--<div class="handle"></div>--}}
                    {{--</button>--}}
                    {{--PTKP--}}
                    {{--<br>--}}
                    {{--<button data-column="39" type="button"--}}
                            {{--class="btn btn-sm btn-toggle toggle-vis"--}}
                            {{--data-toggle="button" aria-pressed="false" autocomplete="off">--}}
                        {{--<div class="handle"></div>--}}
                    {{--</button>--}}
                    {{--PKP Cutted--}}
                    {{--<br>--}}
                    {{--<button data-column="40" type="button"--}}
                            {{--class="btn btn-sm btn-toggle toggle-vis"--}}
                            {{--data-toggle="button" aria-pressed="false" autocomplete="off">--}}
                        {{--<div class="handle"></div>--}}
                    {{--</button>--}}
                    {{--Rounddown PKP--}}
                    {{--<br>--}}
                    {{--<button data-column="41" type="button"--}}
                            {{--class="btn btn-sm btn-toggle toggle-vis"--}}
                            {{--data-toggle="button" aria-pressed="false" autocomplete="off">--}}
                        {{--<div class="handle"></div>--}}
                    {{--</button>--}}
                    {{--Layer--}}
                    {{--<br>--}}
                    {{--<button data-column="42" type="button"--}}
                            {{--class="btn btn-sm btn-toggle toggle-vis"--}}
                            {{--data-toggle="button" aria-pressed="false" autocomplete="off">--}}
                        {{--<div class="handle"></div>--}}
                    {{--</button>--}}
                    {{--Income Tax--}}
                    {{--<br>--}}
                    {{--<button data-column="45" type="button"--}}
                            {{--class="btn btn-sm btn-toggle toggle-vis"--}}
                            {{--data-toggle="button" aria-pressed="false" autocomplete="off">--}}
                        {{--<div class="handle"></div>--}}
                    {{--</button>--}}
                    {{--Related month's PPH--}}
                    {{--<br>--}}
                {{--</div>--}}
            {{--</div>--}}
        {{--</div>--}}
    {{--</li>--}}
    {{--<li class="nav-item">--}}
        {{--<a class="nav-link" data-toggle="collapse"--}}
           {{--data-target="#collapseFive" aria-expanded="true"--}}
           {{--aria-controls="collapseFive">--}}
            {{--<i class="fas fa-caret-down"></i>--}}
            {{--<p>Payroll Totals</p>--}}
        {{--</a>--}}
        {{--<div id="collapseFive" class="collapse show" aria-labelledby="headingFive"--}}
             {{--data-parent="#accordionExample">--}}
            {{--<div class="card-body">--}}
                {{--<div class="filterlist">--}}
                    {{--<button data-column="46" type="button"--}}
                            {{--class="btn btn-sm btn-toggle toggle-vis"--}}
                            {{--data-toggle="button" aria-pressed="false" autocomplete="off">--}}
                        {{--<div class="handle"></div>--}}
                    {{--</button>--}}
                    {{--Earning Total--}}
                    {{--<br>--}}
                    {{--<button data-column="47" type="button"--}}
                            {{--class="btn btn-sm btn-toggle toggle-vis"--}}
                            {{--data-toggle="button" aria-pressed="false" autocomplete="off">--}}
                        {{--<div class="handle"></div>--}}
                    {{--</button>--}}
                    {{--Deduction Total--}}
                    {{--<br>--}}
                    {{--<button data-column="48" type="button"--}}
                            {{--class="btn btn-sm btn-toggle toggle-vis"--}}
                            {{--data-toggle="button" aria-pressed="false" autocomplete="off">--}}
                        {{--<div class="handle"></div>--}}
                    {{--</button>--}}
                    {{--Total--}}
                    {{--<br>--}}
                    {{--<button data-column="49" type="button"--}}
                            {{--class="btn btn-sm btn-toggle toggle-vis"--}}
                            {{--data-toggle="button" aria-pressed="false" autocomplete="off">--}}
                        {{--<div class="handle"></div>--}}
                    {{--</button>--}}
                    {{--Period--}}

                {{--</div>--}}
            {{--</div>--}}
        {{--</div>--}}

    {{--</li>--}}
@endsection
@section('contentreporthead')
    <style>
        .table > tbody > tr > td:nth-child(2) {
            padding-left: 0 !important;
        }

        tbody td:nth-child(n+9) {
            text-align: right;
        }
    </style>
@endsection
@section('reportcontent')
    <div class="col-md-12">
        <div class="card">

            <div  class="card-header card-header-info" style="background-color: #149fd5; color: white;">
                <h4 class="card-title"><b>Payroll History | AUD</b></h4>
                <p class="card-category">List for calculated payroll each month</p>
            </div>
            <div class="card-body">
                <table style="display: block; width: 100%; overflow-x: auto;font-size: 12px;"
                       class="table table-responsive-md table-striped display"
                       id="example">
                    <thead>
                    <tr>

                        <th>EMPLOYEE NAME</th>
                        <th>NIP</th>
                        <th>SLIP</th>
                        <th>PERIOD</th>
                        <th>JOINING DATE</th>
                        <th>POSITION</th>
                        <th>TAX ID</th>
                        <th>STATUS</th>
                        <th>ATTENDANCE RATE</th>
                        <th>BASIC SALARY</th>
                        <th>OCCUPATION ALLW</th>
                        <th>MEAL & TRANSP ALLW</th>
                        <th>OTHER ALLW</th>
                        <th>TOTAL FIX SALARIES</th>
                        <th>TOTAL ATTENDANCE ALLW</th>
                        <th>TOTAL OVERTIME</th>
                        <th>TOTAL OT TRANSP</th>
                        <th>TOTAL OT MEAL</th>
                        <th>TOTAL OPE</th>
                        <th>TOTAL MEDICAL REIMB</th>
                        <th>THR</th>
                        <th>INSENTIVE</th>
                        <th>BONUS</th>
                        <th>CORRECTION</th>
                        <th>GROSS INCOME</th>
                        <!--<th>LOAN DISBURSEMENT</th>-->
                        <!--<th>REPAID OF DEPOSIT</th>-->
                        <th>TOTAL GROSS INCOME</th>
                        <!--<th>LOAN PAYTMENT</th>-->
                        <th>ADVANCE PAYMENT</th>
                        <th>TOTAL BPJS</th>
                        <th>TAX ARTICLE 21</th>
                        <th>CORRECTION</th>
                        <th>TOTAL DEDUCTION</th>
                        <th>TAKE HOME PAY</th>

                        {{--<th>Name</th>--}}
                        {{--<th>NIP</th>--}}
                        {{--<th></th>--}}
                        {{--<th>Period</th>--}}
                        {{--<th>Attendance Rate</th>--}}
                        {{--<th>Fixed Pay Amount</th>--}}
                        {{--<th>FPA Actual</th>--}}
                        {{--<th>% Upah</th>--}}
                        {{--<th>Cek % Upah</th>--}}
                        {{--<th>Attendances in Days</th>--}}
                        {{--<th>Daily Pay Amount (TH)</th>--}}
                        {{--<th>Overtime Fare</th>--}}
                        {{--<th>Overtime Amount in Hour</th>--}}
                        {{--<th>Overtime Amount</th>--}}
                        {{--<th>Transportations</th>--}}
                        {{--<th>Overtime Foods</th>--}}
                        {{--<th>OPE Amount</th>--}}
                        {{--<th>Paid Claim</th>--}}
                        {{--<th>Claim Accumulation</th>--}}
                        {{--<th>% Claim</th>--}}
                        {{--<th>Non-Fixed Income Amount</th>--}}
                        {{--<th>Loan and Deposit Amount</th>--}}
                        {{--<th>BPJS Amount</th>--}}
                        {{--<th>Montly Income</th>--}}
                        {{--<th>Employment BPJS 0.54%</th>--}}
                        {{--<th>Health BPJS</th>--}}
                        {{--<th>Regular Income Amount</th>--}}
                        {{--<th>Non-Regular Income</th>--}}
                        {{--<th>Non-Regular Income Amount</th>--}}
                        {{--<th>Non-Regular Income <br> Amount (Yearly)</th>--}}
                        {{--<th>Gross Income</th>--}}
                        {{--<th>Gross Income <br> (Yearly)</th>--}}
                        {{--<th>Position Allowance</th>--}}
                        {{--<th>Employment BPJS 2%</th>--}}
                        {{--<th>Retirement BPJS 1%</th>--}}
                        {{--<th>Cutting Amount</th>--}}
                        {{--<th>Cutting <br> Amount (Yearly)</th>--}}
                        {{--<th>PKP</th>--}}
                        {{--<th>PTKP</th>--}}
                        {{--<th>PKP Cutted</th>--}}
                        {{--<th>Rounddown PKP</th>--}}
                        {{--<th>Layer</th>--}}
                        {{--<th>Income Tax</th>--}}
                        {{--<th>Been Paid Before</th>--}}
                        {{--<th>Insufficient Payment</th>--}}
                        {{--<th>Related month's PPH</th>--}}
                        {{--<th>Earning Total</th>--}}
                        {{--<th>Deduction Total</th>--}}
                        {{--<th>Take Home Pay</th>--}}
                        {{--<th>Total</th>--}}

                    </tr>
                    </thead>
                    <tbody>
                    @foreach($audpayrolls as $audpayroll)
                        <tr>

                            <td>
                                @if(strlen($audpayroll->nama) <= 25)
                                {{$audpayroll->nama}}
                                @else
                                {{substr($audpayroll->nama,0,25)}}..
                                @endif
                            </td>
                            <td>{{$audpayroll->nip}}</td>
                            <td><a href="{{ url('partner/reporting/payrollhistory/'.$audpayroll->nip.'/'.$audpayroll->periode) }}"><i class="fas fa-search-plus"></i></a></td>
                            <td>{{$audpayroll->periode}}</td>
                            <td>{{$audpayroll->tanggalbergabung}}</td>
                            <td>{{$audpayroll->positionid}}</td>
                            <td>{{$audpayroll->npwp}}</td>
                            <td>{{$audpayroll->statusptkp}}</td>

                            {{--<td>@if($audpayroll->crossceknpwp == 1) Y @elseif($audpayroll->crossceknpwp == 0) N @endif</td>--}}
                            <td>{{$audpayroll->persenkehadiran}}%</td>
                            <td>{{number_format($audpayroll->gajipokok,0,",",".")}}</td>
                            <td>{{number_format($audpayroll->tunjanganjabatan,0,",",".")}}</td>
                            <td>{{number_format($audpayroll->tunjangankesehatan,0,",",".")}}</td>
                            <td>{{number_format($audpayroll->tunjanganlain,0,",",".")}}</td>
                            {{--                            <td>{{number_format($audpayroll->jumlahupahtetap,0,",",".")}}</td>--}}
                            <td>{{number_format($audpayroll->jumlahupahtetapaktual,0,",",".")}}</td>
                            {{--<td>{{$audpayroll->persenupah}}%</td>--}}
                            {{--<td>{{$audpayroll->cekpersenupah}}%</td>--}}
                            {{--<td>{{$audpayroll->jumlahkehadirandalamhari}}</td>--}}
                            <td>{{number_format($audpayroll->jumlahthaktual,0,",",".")}}</td>
                            {{--                            <td>{{number_format($audpayroll->tariflembur,0,",",".")}}</td>--}}
                            {{--                            <td>{{$audpayroll->jumlahjamlembur}}</td>--}}
                            <td>{{number_format($audpayroll->jumlahlembur,0,",",".")}}</td>
                            <td>{{number_format($audpayroll->jumlahtransportasi,0,",",".")}}</td>
                            <td>{{number_format($audpayroll->jumlahuangmakanlembur,0,",",".")}}</td>
                            <td>{{number_format($audpayroll->jumlahope,0,",",".")}}</td>
                            {{--                            <td>{{number_format($audpayroll->jumlahklaimdibayarkan,0,",",".")}}</td>--}}
                            <td>{{number_format($audpayroll->jumlahklaimakumulasi,0,",",".")}}</td>
                            {{--<td>{{$audpayroll->persenklaim}}%</td>--}}
                            <td>{{number_format($audpayroll->tunjanganhariraya,0,",",".")}}</td>
                            <td>{{number_format($audpayroll->insentif,0,",",".")}}</td>
                            <td>{{number_format($audpayroll->bonus,0,",",".")}}</td>
                            <td>{{number_format($audpayroll->koreksipenambahan,0,",",".")}}</td>
                            {{--                            <td>{{number_format($audpayroll->jumlahpenghasilantidaktetap,0,",",".")}}</td>--}}
                            {{--                            <td>{{number_format($audpayroll->penghasilanbrutodisetahunkan,0,",",".")}}</td>--}}
                            <td>{{number_format($audpayroll->penghasilanbruto,0,",",".")}}</td>
                            {{--<td>{{number_format($audpayroll->pencairanpinjaman,0,",",".")}}</td>--}}
                            {{--<td>{{number_format($audpayroll->pengembaliandeposit,0,",",".")}}</td>--}}
                            <td>{{number_format($audpayroll->penghasilanbulanan,0,",",".")}}</td>
                            {{--<td>{{number_format($audpayroll->pembayaranpinjaman,0,",",".")}}</td>--}}
                            <td>{{number_format($audpayroll->pembayaranterlebihdahulu,0,",",".")}}</td>
                            {{--                            <td>{{number_format($audpayroll->jumlahpinjamandandeposit,0,",",".")}}</td>--}}
                            <td>{{number_format($audpayroll->jumlahbpjs,0,",",".")}}</td>
                            <td>{{number_format($audpayroll->pphpasal21,0,",",".")}}</td>
                            <td>{{number_format($audpayroll->koreksipengurangan,0,",",".")}}</td>
                            {{--<td>{{number_format($audpayroll->BPJSketenagakerjaan054,0,",",".")}}</td>--}}
                            {{--<td>{{number_format($audpayroll->BPJSkesehatan,0,",",".")}}</td>--}}
                            {{--                            <td>{{number_format($audpayroll->jumlahpenghasilanrutin,0,",",".")}}</td>--}}
                            {{--                            <td>{{number_format($audpayroll->penghasilantidakrutin,0,",",".")}}</td>--}}
                            {{--                            <td>{{number_format($audpayroll->jumlahpenghasilantidakrutin,0,",",".")}}</td>--}}
                            {{--                            <td>{{number_format($audpayroll->jumlahpenghasilanrutindisetahunkan,0,",",".")}}</td>--}}
                            {{--<td>{{number_format($audpayroll->penghasilanbruto,0,",",".")}}</td>--}}
                            {{--                            <td>{{number_format($audpayroll->biayajabatan,0,",",".")}}</td>--}}
                            {{--<td>{{number_format($audpayroll->BPJSketenagakerjaan2,0,",",".")}}</td>--}}
                            {{--<td>{{number_format($audpayroll->BPJSpensiun1,0,",",".")}}</td>--}}
                            <td>{{number_format($audpayroll->jumlahpemotongan,0,",",".")}}</td>
                            {{--                            <td>{{number_format($audpayroll->jumlahpemotongandisetahunkan,0,",",".")}}</td>--}}
                            {{--<td>{{number_format($audpayroll->PKP,0,",",".")}}</td>--}}
                            {{--<td>{{number_format($audpayroll->PTKP,0,",",".")}}</td>--}}
                            {{--<td>{{number_format($audpayroll->PKPpotong,0,",",".")}}</td>--}}
                            {{--<td>{{number_format($audpayroll->PKPpembulatan,0,",",".")}}</td>--}}
                            {{--<td>{{$audpayroll->lapis}}</td>--}}
                            {{--<td>{{number_format($audpayroll->pajakpenghasilan,0,",",".")}}</td>--}}
                            {{--<td>{{number_format($audpayroll->telahdibayarsebelumnya,0,",",".")}}</td>--}}
                            {{--<td>{{number_format($audpayroll->kurangbayar,0,",",".")}}</td>--}}
                            {{--<td>{{number_format($audpayroll->PPHbulanberkaitan,0,",",".")}}</td>--}}
                            {{--<td>{{number_format($audpayroll->earningtotal,0,",",".")}}</td>--}}
                            {{--<td>{{number_format($audpayroll->deductiontotal,0,",",".")}}</td>--}}
                            <td>{{number_format($audpayroll->takehomepay,0,",",".")}}</td>
                            {{--                            <td>{{number_format($audpayroll->total,0,",",".")}}</td>--}}

                        </tr>
                    @endforeach
                    </tbody>
                    <tfoot>
                    <tr>
                        <th style="opacity: 0">EMPLOYEE NAME</th>
                        <th style="opacity: 0">NIP</th>
                        <th style="opacity: 0">DET.</th>
                        <th>PERIOD</th>
                        <th style="opacity: 0">JOINING DATE</th>
                        <th>POSITION</th>
                        <th style="opacity: 0">TAX ID</th>
                        <th>STATUS</th>
                        <th style="opacity: 0">ATTENDANCE RATE</th>
                        <th style="opacity: 0">BASIC SALARY</th>
                        <th style="opacity: 0">OCCUPATION ALLW</th>
                        <th style="opacity: 0">MEAL & TRANSP ALLW</th>
                        <th style="opacity: 0">OTHER ALLW</th>
                        <th style="opacity: 0">TOTAL FIX SALARIES</th>
                        <th style="opacity: 0">TOTAL ATTENDANCE ALLW</th>
                        <th style="opacity: 0">TOTAL OVERTIME</th>
                        <th style="opacity: 0">TOTAL OT TRANSP</th>
                        <th style="opacity: 0">TOTAL OT MEAL</th>
                        <th style="opacity: 0">TOTAL OPE</th>
                        <th style="opacity: 0">TOTAL MEDICAL REIMB</th>
                        <th style="opacity: 0">THR</th>
                        <th style="opacity: 0">INSENTIVE</th>
                        <th style="opacity: 0">BONUS</th>
                        <th style="opacity: 0">CORRECTION</th>
                        <th style="opacity: 0">GROSS INCOME</th>
                        <!--<th style="opacity: 0">LOAN DISBURSEMENT</th>-->
                        <!--<th style="opacity: 0">REPAID OF DEPOSIT</th>-->
                        <th style="opacity: 0">TOTAL GROSS INCOME</th>
                        <!--<th style="opacity: 0">LOAN PAYTMENT</th>-->
                        <th style="opacity: 0">ADVANCE PAYMENT</th>
                        <th style="opacity: 0">TOTAL BPJS</th>
                        <th style="opacity: 0">TAX ARTICLE 21</th>
                        <th style="opacity: 0">CORRECTION</th>
                        <th style="opacity: 0">TOTAL DEDUCTION</th>
                        <th style="opacity: 0">TAKE HOME PAY</th>
                    </tr>
                    </tfoot>
                </table>
            </div>
        </div><br>
        <div class="card">

            <div  class="card-header card-header-warning" style="background-color: #149fd5; color: white;">
                <h4 class="card-title"><b>Payroll History | TAX</b></h4>
                <p class="card-category">List for calculated payroll each month</p>
            </div>
            <div class="card-body">
                <table style=" display: block; width: 100%; overflow-x: auto;font-size: 12px;"
                       class="table table-responsive-md table-striped display"
                       id="exampletwo">
                    <thead>
                    <tr>

                        <th>EMPLOYEE NAME</th>
                        <th>NIP</th>
                        <th>SLIP</th>
                        <th>PERIOD</th>
                        <th>JOINING DATE</th>
                        <th>POSITION</th>
                        <th>TAX ID</th>
                        <th>STATUS</th>
                        <th>ATTENDANCE RATE</th>
                        <th>BASIC SALARY</th>
                        <th>OCCUPATION ALLW</th>
                        <th>MEAL & TRANSP ALLW</th>
                        <th>OTHER ALLW</th>
                        <th>TOTAL FIX SALARIES</th>
                        <th>TOTAL ATTENDANCE ALLW</th>
                        <th>TOTAL OVERTIME</th>
                        <th>TOTAL OT TRANSP</th>
                        <th>TOTAL OT MEAL</th>
                        <th>TOTAL OPE</th>
                        <th>TOTAL MEDICAL REIMB</th>
                        <th>THR</th>
                        <th>INSENTIVE</th>
                        <th>BONUS</th>
                        <th>CORRECTION</th>
                        <th>GROSS INCOME</th>
                        <!--<th>LOAN DISBURSEMENT</th>-->
                        <!--<th>REPAID OF DEPOSIT</th>-->
                        <th>TOTAL GROSS INCOME</th>
                        <!--<th>LOAN PAYTMENT</th>-->
                        <th>ADVANCE PAYMENT</th>
                        <th>TOTAL BPJS</th>
                        <th>TAX ARTICLE 21</th>
                        <th>CORRECTION</th>
                        <th>TOTAL DEDUCTION</th>
                        <th>TAKE HOME PAY</th>

                        {{--<th>Name</th>--}}
                        {{--<th>NIP</th>--}}
                        {{--<th></th>--}}
                        {{--<th>Period</th>--}}
                        {{--<th>Attendance Rate</th>--}}
                        {{--<th>Fixed Pay Amount</th>--}}
                        {{--<th>FPA Actual</th>--}}
                        {{--<th>% Upah</th>--}}
                        {{--<th>Cek % Upah</th>--}}
                        {{--<th>Attendances in Days</th>--}}
                        {{--<th>Daily Pay Amount (TH)</th>--}}
                        {{--<th>Overtime Fare</th>--}}
                        {{--<th>Overtime Amount in Hour</th>--}}
                        {{--<th>Overtime Amount</th>--}}
                        {{--<th>Transportations</th>--}}
                        {{--<th>Overtime Foods</th>--}}
                        {{--<th>OPE Amount</th>--}}
                        {{--<th>Paid Claim</th>--}}
                        {{--<th>Claim Accumulation</th>--}}
                        {{--<th>% Claim</th>--}}
                        {{--<th>Non-Fixed Income Amount</th>--}}
                        {{--<th>Loan and Deposit Amount</th>--}}
                        {{--<th>BPJS Amount</th>--}}
                        {{--<th>Montly Income</th>--}}
                        {{--<th>Employment BPJS 0.54%</th>--}}
                        {{--<th>Health BPJS</th>--}}
                        {{--<th>Regular Income Amount</th>--}}
                        {{--<th>Non-Regular Income</th>--}}
                        {{--<th>Non-Regular Income Amount</th>--}}
                        {{--<th>Non-Regular Income <br> Amount (Yearly)</th>--}}
                        {{--<th>Gross Income</th>--}}
                        {{--<th>Gross Income <br> (Yearly)</th>--}}
                        {{--<th>Position Allowance</th>--}}
                        {{--<th>Employment BPJS 2%</th>--}}
                        {{--<th>Retirement BPJS 1%</th>--}}
                        {{--<th>Cutting Amount</th>--}}
                        {{--<th>Cutting <br> Amount (Yearly)</th>--}}
                        {{--<th>PKP</th>--}}
                        {{--<th>PTKP</th>--}}
                        {{--<th>PKP Cutted</th>--}}
                        {{--<th>Rounddown PKP</th>--}}
                        {{--<th>Layer</th>--}}
                        {{--<th>Income Tax</th>--}}
                        {{--<th>Been Paid Before</th>--}}
                        {{--<th>Insufficient Payment</th>--}}
                        {{--<th>Related month's PPH</th>--}}
                        {{--<th>Earning Total</th>--}}
                        {{--<th>Deduction Total</th>--}}
                        {{--<th>Take Home Pay</th>--}}
                        {{--<th>Total</th>--}}

                    </tr>
                    </thead>
                    <tbody>
                    @foreach($taxpayrolls as $taxpayroll)
                        <tr>

                            <td>
                                @if(strlen($taxpayroll->nama) <= 25)
                                {{$taxpayroll->nama}}
                                @else
                                {{substr($taxpayroll->nama,0,25)}}..
                                @endif
                            </td>
                            <td>{{$taxpayroll->nip}}</td>
                            <td><a href="{{ url('partner/reporting/payrollhistory/'.$taxpayroll->nip.'/'.$taxpayroll->periode) }}"><i class="fas fa-search-plus"></i></a></td>
                            <td>{{$taxpayroll->periode}}</td>
                            <td>{{$taxpayroll->tanggalbergabung}}</td>
                            <td>{{$taxpayroll->positionid}}</td>
                            <td>{{$taxpayroll->npwp}}</td>
                            <td>{{$taxpayroll->statusptkp}}</td>

                            {{--<td>@if($taxpayroll->crossceknpwp == 1) Y @elseif($taxpayroll->crossceknpwp == 0) N @endif</td>--}}
                            <td>{{$taxpayroll->persenkehadiran}}%</td>
                            <td>{{number_format($taxpayroll->gajipokok,0,",",".")}}</td>
                            <td>{{number_format($taxpayroll->tunjanganjabatan,0,",",".")}}</td>
                            <td>{{number_format($taxpayroll->tunjangankesehatan,0,",",".")}}</td>
                            <td>{{number_format($taxpayroll->tunjanganlain,0,",",".")}}</td>
                            {{--                            <td>{{number_format($taxpayroll->jumlahupahtetap,0,",",".")}}</td>--}}
                            <td>{{number_format($taxpayroll->jumlahupahtetapaktual,0,",",".")}}</td>
                            {{--<td>{{$taxpayroll->persenupah}}%</td>--}}
                            {{--<td>{{$taxpayroll->cekpersenupah}}%</td>--}}
                            {{--<td>{{$taxpayroll->jumlahkehadirandalamhari}}</td>--}}
                            <td>{{number_format($taxpayroll->jumlahthaktual,0,",",".")}}</td>
                            {{--                            <td>{{number_format($taxpayroll->tariflembur,0,",",".")}}</td>--}}
                            {{--                            <td>{{$taxpayroll->jumlahjamlembur}}</td>--}}
                            <td>{{number_format($taxpayroll->jumlahlembur,0,",",".")}}</td>
                            <td>{{number_format($taxpayroll->jumlahtransportasi,0,",",".")}}</td>
                            <td>{{number_format($taxpayroll->jumlahuangmakanlembur,0,",",".")}}</td>
                            <td>{{number_format($taxpayroll->jumlahope,0,",",".")}}</td>
                            {{--                            <td>{{number_format($taxpayroll->jumlahklaimdibayarkan,0,",",".")}}</td>--}}
                            <td>{{number_format($taxpayroll->jumlahklaimakumulasi,0,",",".")}}</td>
                            {{--<td>{{$taxpayroll->persenklaim}}%</td>--}}
                            <td>{{number_format($taxpayroll->tunjanganhariraya,0,",",".")}}</td>
                            <td>{{number_format($taxpayroll->insentif,0,",",".")}}</td>
                            <td>{{number_format($taxpayroll->bonus,0,",",".")}}</td>
                            <td>{{number_format($taxpayroll->koreksipenambahan,0,",",".")}}</td>
                            {{--                            <td>{{number_format($taxpayroll->jumlahpenghasilantidaktetap,0,",",".")}}</td>--}}
                            {{--                            <td>{{number_format($taxpayroll->penghasilanbrutodisetahunkan,0,",",".")}}</td>--}}
                            <td>{{number_format($taxpayroll->penghasilanbruto,0,",",".")}}</td>
                            {{--<td>{{number_format($taxpayroll->pencairanpinjaman,0,",",".")}}</td>--}}
                            {{--<td>{{number_format($taxpayroll->pengembaliandeposit,0,",",".")}}</td>--}}
                            <td>{{number_format($taxpayroll->penghasilanbulanan,0,",",".")}}</td>
                            {{--<td>{{number_format($taxpayroll->pembayaranpinjaman,0,",",".")}}</td>--}}
                            <td>{{number_format($taxpayroll->pembayaranterlebihdahulu,0,",",".")}}</td>
                            {{--                            <td>{{number_format($taxpayroll->jumlahpinjamandandeposit,0,",",".")}}</td>--}}
                            <td>{{number_format($taxpayroll->jumlahbpjs,0,",",".")}}</td>
                            <td>{{number_format($taxpayroll->pphpasal21,0,",",".")}}</td>
                            <td>{{number_format($taxpayroll->koreksipengurangan,0,",",".")}}</td>
                            {{--<td>{{number_format($taxpayroll->BPJSketenagakerjaan054,0,",",".")}}</td>--}}
                            {{--<td>{{number_format($taxpayroll->BPJSkesehatan,0,",",".")}}</td>--}}
                            {{--                            <td>{{number_format($taxpayroll->jumlahpenghasilanrutin,0,",",".")}}</td>--}}
                            {{--                            <td>{{number_format($taxpayroll->penghasilantidakrutin,0,",",".")}}</td>--}}
                            {{--                            <td>{{number_format($taxpayroll->jumlahpenghasilantidakrutin,0,",",".")}}</td>--}}
                            {{--                            <td>{{number_format($taxpayroll->jumlahpenghasilanrutindisetahunkan,0,",",".")}}</td>--}}
                            {{--<td>{{number_format($taxpayroll->penghasilanbruto,0,",",".")}}</td>--}}
                            {{--                            <td>{{number_format($taxpayroll->biayajabatan,0,",",".")}}</td>--}}
                            {{--<td>{{number_format($taxpayroll->BPJSketenagakerjaan2,0,",",".")}}</td>--}}
                            {{--<td>{{number_format($taxpayroll->BPJSpensiun1,0,",",".")}}</td>--}}
                            <td>{{number_format($taxpayroll->jumlahpemotongan,0,",",".")}}</td>
                            {{--                            <td>{{number_format($taxpayroll->jumlahpemotongandisetahunkan,0,",",".")}}</td>--}}
                            {{--<td>{{number_format($taxpayroll->PKP,0,",",".")}}</td>--}}
                            {{--<td>{{number_format($taxpayroll->PTKP,0,",",".")}}</td>--}}
                            {{--<td>{{number_format($taxpayroll->PKPpotong,0,",",".")}}</td>--}}
                            {{--<td>{{number_format($taxpayroll->PKPpembulatan,0,",",".")}}</td>--}}
                            {{--<td>{{$taxpayroll->lapis}}</td>--}}
                            {{--<td>{{number_format($taxpayroll->pajakpenghasilan,0,",",".")}}</td>--}}
                            {{--<td>{{number_format($taxpayroll->telahdibayarsebelumnya,0,",",".")}}</td>--}}
                            {{--<td>{{number_format($taxpayroll->kurangbayar,0,",",".")}}</td>--}}
                            {{--<td>{{number_format($taxpayroll->PPHbulanberkaitan,0,",",".")}}</td>--}}
                            {{--<td>{{number_format($taxpayroll->earningtotal,0,",",".")}}</td>--}}
                            {{--<td>{{number_format($taxpayroll->deductiontotal,0,",",".")}}</td>--}}
                            <td>{{number_format($taxpayroll->takehomepay,0,",",".")}}</td>
                            {{--                            <td>{{number_format($taxpayroll->total,0,",",".")}}</td>--}}

                        </tr>
                    @endforeach
                    </tbody>
                    <tfoot>
                    <tr>
                        <th style="opacity: 0">EMPLOYEE NAME</th>
                        <th style="opacity: 0">NIP</th>
                        <th style="opacity: 0">DET.</th>
                        <th>PERIOD</th>
                        <th style="opacity: 0">JOINING DATE</th>
                        <th>POSITION</th>
                        <th style="opacity: 0">TAX ID</th>
                        <th>STATUS</th>
                        <th style="opacity: 0">ATTENDANCE RATE</th>
                        <th style="opacity: 0">BASIC SALARY</th>
                        <th style="opacity: 0">OCCUPATION ALLW</th>
                        <th style="opacity: 0">MEAL & TRANSP ALLW</th>
                        <th style="opacity: 0">OTHER ALLW</th>
                        <th style="opacity: 0">TOTAL FIX SALARIES</th>
                        <th style="opacity: 0">TOTAL ATTENDANCE ALLW</th>
                        <th style="opacity: 0">TOTAL OVERTIME</th>
                        <th style="opacity: 0">TOTAL OT TRANSP</th>
                        <th style="opacity: 0">TOTAL OT MEAL</th>
                        <th style="opacity: 0">TOTAL OPE</th>
                        <th style="opacity: 0">TOTAL MEDICAL REIMB</th>
                        <th style="opacity: 0">THR</th>
                        <th style="opacity: 0">INSENTIVE</th>
                        <th style="opacity: 0">BONUS</th>
                        <th style="opacity: 0">CORRECTION</th>
                        <th style="opacity: 0">GROSS INCOME</th>
                        <!--<th style="opacity: 0">LOAN DISBURSEMENT</th>-->
                        <!--<th style="opacity: 0">REPAID OF DEPOSIT</th>-->
                        <th style="opacity: 0">TOTAL GROSS INCOME</th>
                        <!--<th style="opacity: 0">LOAN PAYTMENT</th>-->
                        <th style="opacity: 0">ADVANCE PAYMENT</th>
                        <th style="opacity: 0">TOTAL BPJS</th>
                        <th style="opacity: 0">TAX ARTICLE 21</th>
                        <th style="opacity: 0">CORRECTION</th>
                        <th style="opacity: 0">TOTAL DEDUCTION</th>
                        <th style="opacity: 0">TAKE HOME PAY</th>
                    </tr>
                    </tfoot>
                </table>
            </div>
        </div><br>
        <div class="card">

            <div  class="card-header card-header-danger" style="background-color: #149fd5; color: white;">
                <h4 class="card-title"><b>Payroll History | ACC</b></h4>
                <p class="card-category">List for calculated payroll each month</p>
            </div>
            <div class="card-body">
                <table style=" display: block; width: 100%; overflow-x: auto;font-size: 12px;"
                       class="table table-responsive-md table-striped display"
                       id="examplethree">
                    <thead>
                    <tr>

                        <th>EMPLOYEE NAME</th>
                        <th>NIP</th>
                        <th>SLIP</th>
                        <th>PERIOD</th>
                        <th>JOINING DATE</th>
                        <th>POSITION</th>
                        <th>TAX ID</th>
                        <th>STATUS</th>
                        <th>ATTENDANCE RATE</th>
                        <th>BASIC SALARY</th>
                        <th>OCCUPATION ALLW</th>
                        <th>MEAL & TRANSP ALLW</th>
                        <th>OTHER ALLW</th>
                        <th>TOTAL FIX SALARIES</th>
                        <th>TOTAL ATTENDANCE ALLW</th>
                        <th>TOTAL OVERTIME</th>
                        <th>TOTAL OT TRANSP</th>
                        <th>TOTAL OT MEAL</th>
                        <th>TOTAL OPE</th>
                        <th>TOTAL MEDICAL REIMB</th>
                        <th>THR</th>
                        <th>INSENTIVE</th>
                        <th>BONUS</th>
                        <th>CORRECTION</th>
                        <th>GROSS INCOME</th>
                        <!--<th>LOAN DISBURSEMENT</th>-->
                        <!--<th>REPAID OF DEPOSIT</th>-->
                        <th>TOTAL GROSS INCOME</th>
                        <!--<th>LOAN PAYTMENT</th>-->
                        <th>ADVANCE PAYMENT</th>
                        <th>TOTAL BPJS</th>
                        <th>TAX ARTICLE 21</th>
                        <th>CORRECTION</th>
                        <th>TOTAL DEDUCTION</th>
                        <th>TAKE HOME PAY</th>

                        {{--<th>Name</th>--}}
                        {{--<th>NIP</th>--}}
                        {{--<th></th>--}}
                        {{--<th>Period</th>--}}
                        {{--<th>Attendance Rate</th>--}}
                        {{--<th>Fixed Pay Amount</th>--}}
                        {{--<th>FPA Actual</th>--}}
                        {{--<th>% Upah</th>--}}
                        {{--<th>Cek % Upah</th>--}}
                        {{--<th>Attendances in Days</th>--}}
                        {{--<th>Daily Pay Amount (TH)</th>--}}
                        {{--<th>Overtime Fare</th>--}}
                        {{--<th>Overtime Amount in Hour</th>--}}
                        {{--<th>Overtime Amount</th>--}}
                        {{--<th>Transportations</th>--}}
                        {{--<th>Overtime Foods</th>--}}
                        {{--<th>OPE Amount</th>--}}
                        {{--<th>Paid Claim</th>--}}
                        {{--<th>Claim Accumulation</th>--}}
                        {{--<th>% Claim</th>--}}
                        {{--<th>Non-Fixed Income Amount</th>--}}
                        {{--<th>Loan and Deposit Amount</th>--}}
                        {{--<th>BPJS Amount</th>--}}
                        {{--<th>Montly Income</th>--}}
                        {{--<th>Employment BPJS 0.54%</th>--}}
                        {{--<th>Health BPJS</th>--}}
                        {{--<th>Regular Income Amount</th>--}}
                        {{--<th>Non-Regular Income</th>--}}
                        {{--<th>Non-Regular Income Amount</th>--}}
                        {{--<th>Non-Regular Income <br> Amount (Yearly)</th>--}}
                        {{--<th>Gross Income</th>--}}
                        {{--<th>Gross Income <br> (Yearly)</th>--}}
                        {{--<th>Position Allowance</th>--}}
                        {{--<th>Employment BPJS 2%</th>--}}
                        {{--<th>Retirement BPJS 1%</th>--}}
                        {{--<th>Cutting Amount</th>--}}
                        {{--<th>Cutting <br> Amount (Yearly)</th>--}}
                        {{--<th>PKP</th>--}}
                        {{--<th>PTKP</th>--}}
                        {{--<th>PKP Cutted</th>--}}
                        {{--<th>Rounddown PKP</th>--}}
                        {{--<th>Layer</th>--}}
                        {{--<th>Income Tax</th>--}}
                        {{--<th>Been Paid Before</th>--}}
                        {{--<th>Insufficient Payment</th>--}}
                        {{--<th>Related month's PPH</th>--}}
                        {{--<th>Earning Total</th>--}}
                        {{--<th>Deduction Total</th>--}}
                        {{--<th>Take Home Pay</th>--}}
                        {{--<th>Total</th>--}}

                    </tr>
                    </thead>
                    <tbody>
                    @foreach($accpayrolls as $accpayroll)
                        <tr>

                            <td>
                                @if(strlen($accpayroll->nama) <= 25)
                                {{$accpayroll->nama}}
                                @else
                                {{substr($accpayroll->nama,0,25)}}..
                                @endif
                            </td>
                            <td>{{$accpayroll->nip}}</td>
                            <td><a href="{{ url('partner/reporting/payrollhistory/'.$accpayroll->nip.'/'.$accpayroll->periode) }}"><i class="fas fa-search-plus"></i></a></td>
                            <td>{{$accpayroll->periode}}</td>
                            <td>{{$accpayroll->tanggalbergabung}}</td>
                            <td>{{$accpayroll->positionid}}</td>
                            <td>{{$accpayroll->npwp}}</td>
                            <td>{{$accpayroll->statusptkp}}</td>

                            {{--<td>@if($accpayroll->crossceknpwp == 1) Y @elseif($accpayroll->crossceknpwp == 0) N @endif</td>--}}
                            <td>{{$accpayroll->persenkehadiran}}%</td>
                            <td>{{number_format($accpayroll->gajipokok,0,",",".")}}</td>
                            <td>{{number_format($accpayroll->tunjanganjabatan,0,",",".")}}</td>
                            <td>{{number_format($accpayroll->tunjangankesehatan,0,",",".")}}</td>
                            <td>{{number_format($accpayroll->tunjanganlain,0,",",".")}}</td>
                            {{--                            <td>{{number_format($accpayroll->jumlahupahtetap,0,",",".")}}</td>--}}
                            <td>{{number_format($accpayroll->jumlahupahtetapaktual,0,",",".")}}</td>
                            {{--<td>{{$accpayroll->persenupah}}%</td>--}}
                            {{--<td>{{$accpayroll->cekpersenupah}}%</td>--}}
                            {{--<td>{{$accpayroll->jumlahkehadirandalamhari}}</td>--}}
                            <td>{{number_format($accpayroll->jumlahthaktual,0,",",".")}}</td>
                            {{--                            <td>{{number_format($accpayroll->tariflembur,0,",",".")}}</td>--}}
                            {{--                            <td>{{$accpayroll->jumlahjamlembur}}</td>--}}
                            <td>{{number_format($accpayroll->jumlahlembur,0,",",".")}}</td>
                            <td>{{number_format($accpayroll->jumlahtransportasi,0,",",".")}}</td>
                            <td>{{number_format($accpayroll->jumlahuangmakanlembur,0,",",".")}}</td>
                            <td>{{number_format($accpayroll->jumlahope,0,",",".")}}</td>
                            {{--                            <td>{{number_format($accpayroll->jumlahklaimdibayarkan,0,",",".")}}</td>--}}
                            <td>{{number_format($accpayroll->jumlahklaimakumulasi,0,",",".")}}</td>
                            {{--<td>{{$accpayroll->persenklaim}}%</td>--}}
                            <td>{{number_format($accpayroll->tunjanganhariraya,0,",",".")}}</td>
                            <td>{{number_format($accpayroll->insentif,0,",",".")}}</td>
                            <td>{{number_format($accpayroll->bonus,0,",",".")}}</td>
                            <td>{{number_format($accpayroll->koreksipenambahan,0,",",".")}}</td>
                            {{--                            <td>{{number_format($accpayroll->jumlahpenghasilantidaktetap,0,",",".")}}</td>--}}
                            {{--                            <td>{{number_format($accpayroll->penghasilanbrutodisetahunkan,0,",",".")}}</td>--}}
                            <td>{{number_format($accpayroll->penghasilanbruto,0,",",".")}}</td>
                            {{--<td>{{number_format($accpayroll->pencairanpinjaman,0,",",".")}}</td>--}}
                            {{--<td>{{number_format($accpayroll->pengembaliandeposit,0,",",".")}}</td>--}}
                            <td>{{number_format($accpayroll->penghasilanbulanan,0,",",".")}}</td>
                            {{--<td>{{number_format($accpayroll->pembayaranpinjaman,0,",",".")}}</td>--}}
                            <td>{{number_format($accpayroll->pembayaranterlebihdahulu,0,",",".")}}</td>
                            {{--                            <td>{{number_format($accpayroll->jumlahpinjamandandeposit,0,",",".")}}</td>--}}
                            <td>{{number_format($accpayroll->jumlahbpjs,0,",",".")}}</td>
                            <td>{{number_format($accpayroll->pphpasal21,0,",",".")}}</td>
                            <td>{{number_format($accpayroll->koreksipengurangan,0,",",".")}}</td>
                            {{--<td>{{number_format($accpayroll->BPJSketenagakerjaan054,0,",",".")}}</td>--}}
                            {{--<td>{{number_format($accpayroll->BPJSkesehatan,0,",",".")}}</td>--}}
                            {{--                            <td>{{number_format($accpayroll->jumlahpenghasilanrutin,0,",",".")}}</td>--}}
                            {{--                            <td>{{number_format($accpayroll->penghasilantidakrutin,0,",",".")}}</td>--}}
                            {{--                            <td>{{number_format($accpayroll->jumlahpenghasilantidakrutin,0,",",".")}}</td>--}}
                            {{--                            <td>{{number_format($accpayroll->jumlahpenghasilanrutindisetahunkan,0,",",".")}}</td>--}}
                            {{--<td>{{number_format($accpayroll->penghasilanbruto,0,",",".")}}</td>--}}
                            {{--                            <td>{{number_format($accpayroll->biayajabatan,0,",",".")}}</td>--}}
                            {{--<td>{{number_format($accpayroll->BPJSketenagakerjaan2,0,",",".")}}</td>--}}
                            {{--<td>{{number_format($accpayroll->BPJSpensiun1,0,",",".")}}</td>--}}
                            <td>{{number_format($accpayroll->jumlahpemotongan,0,",",".")}}</td>
                            {{--                            <td>{{number_format($accpayroll->jumlahpemotongandisetahunkan,0,",",".")}}</td>--}}
                            {{--<td>{{number_format($accpayroll->PKP,0,",",".")}}</td>--}}
                            {{--<td>{{number_format($accpayroll->PTKP,0,",",".")}}</td>--}}
                            {{--<td>{{number_format($accpayroll->PKPpotong,0,",",".")}}</td>--}}
                            {{--<td>{{number_format($accpayroll->PKPpembulatan,0,",",".")}}</td>--}}
                            {{--<td>{{$accpayroll->lapis}}</td>--}}
                            {{--<td>{{number_format($accpayroll->pajakpenghasilan,0,",",".")}}</td>--}}
                            {{--<td>{{number_format($accpayroll->telahdibayarsebelumnya,0,",",".")}}</td>--}}
                            {{--<td>{{number_format($accpayroll->kurangbayar,0,",",".")}}</td>--}}
                            {{--<td>{{number_format($accpayroll->PPHbulanberkaitan,0,",",".")}}</td>--}}
                            {{--<td>{{number_format($accpayroll->earningtotal,0,",",".")}}</td>--}}
                            {{--<td>{{number_format($accpayroll->deductiontotal,0,",",".")}}</td>--}}
                            <td>{{number_format($accpayroll->takehomepay,0,",",".")}}</td>
                            {{--                            <td>{{number_format($accpayroll->total,0,",",".")}}</td>--}}

                        </tr>
                    @endforeach
                    </tbody>
                    <tfoot>
                    <tr>
                        <th style="opacity: 0">EMPLOYEE NAME</th>
                        <th style="opacity: 0">NIP</th>
                        <th style="opacity: 0">DET.</th>
                        <th>PERIOD</th>
                        <th style="opacity: 0">JOINING DATE</th>
                        <th>POSITION</th>
                        <th style="opacity: 0">TAX ID</th>
                        <th>STATUS</th>
                        <th style="opacity: 0">ATTENDANCE RATE</th>
                        <th style="opacity: 0">BASIC SALARY</th>
                        <th style="opacity: 0">OCCUPATION ALLW</th>
                        <th style="opacity: 0">MEAL & TRANSP ALLW</th>
                        <th style="opacity: 0">OTHER ALLW</th>
                        <th style="opacity: 0">TOTAL FIX SALARIES</th>
                        <th style="opacity: 0">TOTAL ATTENDANCE ALLW</th>
                        <th style="opacity: 0">TOTAL OVERTIME</th>
                        <th style="opacity: 0">TOTAL OT TRANSP</th>
                        <th style="opacity: 0">TOTAL OT MEAL</th>
                        <th style="opacity: 0">TOTAL OPE</th>
                        <th style="opacity: 0">TOTAL MEDICAL REIMB</th>
                        <th style="opacity: 0">THR</th>
                        <th style="opacity: 0">INSENTIVE</th>
                        <th style="opacity: 0">BONUS</th>
                        <th style="opacity: 0">CORRECTION</th>
                        <th style="opacity: 0">GROSS INCOME</th>
                        <!--<th style="opacity: 0">LOAN DISBURSEMENT</th>-->
                        <!--<th style="opacity: 0">REPAID OF DEPOSIT</th>-->
                        <th style="opacity: 0">TOTAL GROSS INCOME</th>
                        <!--<th style="opacity: 0">LOAN PAYTMENT</th>-->
                        <th style="opacity: 0">ADVANCE PAYMENT</th>
                        <th style="opacity: 0">TOTAL BPJS</th>
                        <th style="opacity: 0">TAX ARTICLE 21</th>
                        <th style="opacity: 0">CORRECTION</th>
                        <th style="opacity: 0">TOTAL DEDUCTION</th>
                        <th style="opacity: 0">TAKE HOME PAY</th>
                    </tr>
                    </tfoot>
                </table>
            </div>
        </div><br>
        <div class="card">

            <div  class="card-header card-header-primary" style="background-color: #149fd5; color: white;">
                <h4 class="card-title"><b>Payroll History | ADM</b></h4>
                <p class="card-category">List for calculated payroll each month</p>
            </div>
            <div class="card-body">
                <table style=" display: block; width: 100%; overflow-x: auto;font-size: 12px;"
                       class="table table-responsive-md table-striped display"
                       id="examplefour">
                    <thead>
                    <tr>

                        <th>EMPLOYEE NAME</th>
                        <th>NIP</th>
                        <th>SLIP</th>
                        <th>PERIOD</th>
                        <th>JOINING DATE</th>
                        <th>POSITION</th>
                        <th>TAX ID</th>
                        <th>STATUS</th>
                        <th>ATTENDANCE RATE</th>
                        <th>BASIC SALARY</th>
                        <th>OCCUPATION ALLW</th>
                        <th>MEAL & TRANSP ALLW</th>
                        <th>OTHER ALLW</th>
                        <th>TOTAL FIX SALARIES</th>
                        <th>TOTAL ATTENDANCE ALLW</th>
                        <th>TOTAL OVERTIME</th>
                        <th>TOTAL OT TRANSP</th>
                        <th>TOTAL OT MEAL</th>
                        <th>TOTAL OPE</th>
                        <th>TOTAL MEDICAL REIMB</th>
                        <th>THR</th>
                        <th>INSENTIVE</th>
                        <th>BONUS</th>
                        <th>CORRECTION</th>
                        <th>GROSS INCOME</th>
                        <!--<th>LOAN DISBURSEMENT</th>-->
                        <!--<th>REPAID OF DEPOSIT</th>-->
                        <th>TOTAL GROSS INCOME</th>
                        <!--<th>LOAN PAYTMENT</th>-->
                        <th>ADVANCE PAYMENT</th>
                        <th>TOTAL BPJS</th>
                        <th>TAX ARTICLE 21</th>
                        <th>CORRECTION</th>
                        <th>TOTAL DEDUCTION</th>
                        <th>TAKE HOME PAY</th>

                        {{--<th>Name</th>--}}
                        {{--<th>NIP</th>--}}
                        {{--<th></th>--}}
                        {{--<th>Period</th>--}}
                        {{--<th>Attendance Rate</th>--}}
                        {{--<th>Fixed Pay Amount</th>--}}
                        {{--<th>FPA Actual</th>--}}
                        {{--<th>% Upah</th>--}}
                        {{--<th>Cek % Upah</th>--}}
                        {{--<th>Attendances in Days</th>--}}
                        {{--<th>Daily Pay Amount (TH)</th>--}}
                        {{--<th>Overtime Fare</th>--}}
                        {{--<th>Overtime Amount in Hour</th>--}}
                        {{--<th>Overtime Amount</th>--}}
                        {{--<th>Transportations</th>--}}
                        {{--<th>Overtime Foods</th>--}}
                        {{--<th>OPE Amount</th>--}}
                        {{--<th>Paid Claim</th>--}}
                        {{--<th>Claim Accumulation</th>--}}
                        {{--<th>% Claim</th>--}}
                        {{--<th>Non-Fixed Income Amount</th>--}}
                        {{--<th>Loan and Deposit Amount</th>--}}
                        {{--<th>BPJS Amount</th>--}}
                        {{--<th>Montly Income</th>--}}
                        {{--<th>Employment BPJS 0.54%</th>--}}
                        {{--<th>Health BPJS</th>--}}
                        {{--<th>Regular Income Amount</th>--}}
                        {{--<th>Non-Regular Income</th>--}}
                        {{--<th>Non-Regular Income Amount</th>--}}
                        {{--<th>Non-Regular Income <br> Amount (Yearly)</th>--}}
                        {{--<th>Gross Income</th>--}}
                        {{--<th>Gross Income <br> (Yearly)</th>--}}
                        {{--<th>Position Allowance</th>--}}
                        {{--<th>Employment BPJS 2%</th>--}}
                        {{--<th>Retirement BPJS 1%</th>--}}
                        {{--<th>Cutting Amount</th>--}}
                        {{--<th>Cutting <br> Amount (Yearly)</th>--}}
                        {{--<th>PKP</th>--}}
                        {{--<th>PTKP</th>--}}
                        {{--<th>PKP Cutted</th>--}}
                        {{--<th>Rounddown PKP</th>--}}
                        {{--<th>Layer</th>--}}
                        {{--<th>Income Tax</th>--}}
                        {{--<th>Been Paid Before</th>--}}
                        {{--<th>Insufficient Payment</th>--}}
                        {{--<th>Related month's PPH</th>--}}
                        {{--<th>Earning Total</th>--}}
                        {{--<th>Deduction Total</th>--}}
                        {{--<th>Take Home Pay</th>--}}
                        {{--<th>Total</th>--}}

                    </tr>
                    </thead>
                    <tbody>
                    @foreach($admpayrolls as $admpayroll)
                        <tr>

                            <td>
                                @if(strlen($admpayroll->nama) <= 25)
                                {{$admpayroll->nama}}
                                @else
                                {{substr($admpayroll->nama,0,25)}}..
                                @endif
                            </td>
                            <td>{{$admpayroll->nip}}</td>
                            <td><a href="{{ url('partner/reporting/payrollhistory/'.$admpayroll->nip.'/'.$admpayroll->periode) }}"><i class="fas fa-search-plus"></i></a></td>
                            <td>{{$admpayroll->periode}}</td>
                            <td>{{$admpayroll->tanggalbergabung}}</td>
                            <td>{{$admpayroll->positionid}}</td>
                            <td>{{$admpayroll->npwp}}</td>
                            <td>{{$admpayroll->statusptkp}}</td>

                            {{--<td>@if($admpayroll->crossceknpwp == 1) Y @elseif($admpayroll->crossceknpwp == 0) N @endif</td>--}}
                            <td>{{$admpayroll->persenkehadiran}}%</td>
                            <td>{{number_format($admpayroll->gajipokok,0,",",".")}}</td>
                            <td>{{number_format($admpayroll->tunjanganjabatan,0,",",".")}}</td>
                            <td>{{number_format($admpayroll->tunjangankesehatan,0,",",".")}}</td>
                            <td>{{number_format($admpayroll->tunjanganlain,0,",",".")}}</td>
                            {{--                            <td>{{number_format($admpayroll->jumlahupahtetap,0,",",".")}}</td>--}}
                            <td>{{number_format($admpayroll->jumlahupahtetapaktual,0,",",".")}}</td>
                            {{--<td>{{$admpayroll->persenupah}}%</td>--}}
                            {{--<td>{{$admpayroll->cekpersenupah}}%</td>--}}
                            {{--<td>{{$admpayroll->jumlahkehadirandalamhari}}</td>--}}
                            <td>{{number_format($admpayroll->jumlahthaktual,0,",",".")}}</td>
                            {{--                            <td>{{number_format($admpayroll->tariflembur,0,",",".")}}</td>--}}
                            {{--                            <td>{{$admpayroll->jumlahjamlembur}}</td>--}}
                            <td>{{number_format($admpayroll->jumlahlembur,0,",",".")}}</td>
                            <td>{{number_format($admpayroll->jumlahtransportasi,0,",",".")}}</td>
                            <td>{{number_format($admpayroll->jumlahuangmakanlembur,0,",",".")}}</td>
                            <td>{{number_format($admpayroll->jumlahope,0,",",".")}}</td>
                            {{--                            <td>{{number_format($admpayroll->jumlahklaimdibayarkan,0,",",".")}}</td>--}}
                            <td>{{number_format($admpayroll->jumlahklaimakumulasi,0,",",".")}}</td>
                            {{--<td>{{$admpayroll->persenklaim}}%</td>--}}
                            <td>{{number_format($admpayroll->tunjanganhariraya,0,",",".")}}</td>
                            <td>{{number_format($admpayroll->insentif,0,",",".")}}</td>
                            <td>{{number_format($admpayroll->bonus,0,",",".")}}</td>
                            <td>{{number_format($admpayroll->koreksipenambahan,0,",",".")}}</td>
                            {{--                            <td>{{number_format($admpayroll->jumlahpenghasilantidaktetap,0,",",".")}}</td>--}}
                            {{--                            <td>{{number_format($admpayroll->penghasilanbrutodisetahunkan,0,",",".")}}</td>--}}
                            <td>{{number_format($admpayroll->penghasilanbruto,0,",",".")}}</td>
                            {{--<td>{{number_format($admpayroll->pencairanpinjaman,0,",",".")}}</td>--}}
                            {{--<td>{{number_format($admpayroll->pengembaliandeposit,0,",",".")}}</td>--}}
                            <td>{{number_format($admpayroll->penghasilanbulanan,0,",",".")}}</td>
                            {{--<td>{{number_format($admpayroll->pembayaranpinjaman,0,",",".")}}</td>--}}
                            <td>{{number_format($admpayroll->pembayaranterlebihdahulu,0,",",".")}}</td>
                            {{--                            <td>{{number_format($admpayroll->jumlahpinjamandandeposit,0,",",".")}}</td>--}}
                            <td>{{number_format($admpayroll->jumlahbpjs,0,",",".")}}</td>
                            <td>{{number_format($admpayroll->pphpasal21,0,",",".")}}</td>
                            <td>{{number_format($admpayroll->koreksipengurangan,0,",",".")}}</td>
                            {{--<td>{{number_format($admpayroll->BPJSketenagakerjaan054,0,",",".")}}</td>--}}
                            {{--<td>{{number_format($admpayroll->BPJSkesehatan,0,",",".")}}</td>--}}
                            {{--                            <td>{{number_format($admpayroll->jumlahpenghasilanrutin,0,",",".")}}</td>--}}
                            {{--                            <td>{{number_format($admpayroll->penghasilantidakrutin,0,",",".")}}</td>--}}
                            {{--                            <td>{{number_format($admpayroll->jumlahpenghasilantidakrutin,0,",",".")}}</td>--}}
                            {{--                            <td>{{number_format($admpayroll->jumlahpenghasilanrutindisetahunkan,0,",",".")}}</td>--}}
                            {{--<td>{{number_format($admpayroll->penghasilanbruto,0,",",".")}}</td>--}}
                            {{--                            <td>{{number_format($admpayroll->biayajabatan,0,",",".")}}</td>--}}
                            {{--<td>{{number_format($admpayroll->BPJSketenagakerjaan2,0,",",".")}}</td>--}}
                            {{--<td>{{number_format($admpayroll->BPJSpensiun1,0,",",".")}}</td>--}}
                            <td>{{number_format($admpayroll->jumlahpemotongan,0,",",".")}}</td>
                            {{--                            <td>{{number_format($admpayroll->jumlahpemotongandisetahunkan,0,",",".")}}</td>--}}
                            {{--<td>{{number_format($admpayroll->PKP,0,",",".")}}</td>--}}
                            {{--<td>{{number_format($admpayroll->PTKP,0,",",".")}}</td>--}}
                            {{--<td>{{number_format($admpayroll->PKPpotong,0,",",".")}}</td>--}}
                            {{--<td>{{number_format($admpayroll->PKPpembulatan,0,",",".")}}</td>--}}
                            {{--<td>{{$admpayroll->lapis}}</td>--}}
                            {{--<td>{{number_format($admpayroll->pajakpenghasilan,0,",",".")}}</td>--}}
                            {{--<td>{{number_format($admpayroll->telahdibayarsebelumnya,0,",",".")}}</td>--}}
                            {{--<td>{{number_format($admpayroll->kurangbayar,0,",",".")}}</td>--}}
                            {{--<td>{{number_format($admpayroll->PPHbulanberkaitan,0,",",".")}}</td>--}}
                            {{--<td>{{number_format($admpayroll->earningtotal,0,",",".")}}</td>--}}
                            {{--<td>{{number_format($admpayroll->deductiontotal,0,",",".")}}</td>--}}
                            <td>{{number_format($admpayroll->takehomepay,0,",",".")}}</td>
                            {{--                            <td>{{number_format($admpayroll->total,0,",",".")}}</td>--}}

                        </tr>
                    @endforeach
                    </tbody>
                    <tfoot>
                    <tr>
                        <th style="opacity: 0">EMPLOYEE NAME</th>
                        <th style="opacity: 0">NIP</th>
                        <th style="opacity: 0">DET.</th>
                        <th>PERIOD</th>
                        <th style="opacity: 0">JOINING DATE</th>
                        <th>POSITION</th>
                        <th style="opacity: 0">TAX ID</th>
                        <th>STATUS</th>
                        <th style="opacity: 0">ATTENDANCE RATE</th>
                        <th style="opacity: 0">BASIC SALARY</th>
                        <th style="opacity: 0">OCCUPATION ALLW</th>
                        <th style="opacity: 0">MEAL & TRANSP ALLW</th>
                        <th style="opacity: 0">OTHER ALLW</th>
                        <th style="opacity: 0">TOTAL FIX SALARIES</th>
                        <th style="opacity: 0">TOTAL ATTENDANCE ALLW</th>
                        <th style="opacity: 0">TOTAL OVERTIME</th>
                        <th style="opacity: 0">TOTAL OT TRANSP</th>
                        <th style="opacity: 0">TOTAL OT MEAL</th>
                        <th style="opacity: 0">TOTAL OPE</th>
                        <th style="opacity: 0">TOTAL MEDICAL REIMB</th>
                        <th style="opacity: 0">THR</th>
                        <th style="opacity: 0">INSENTIVE</th>
                        <th style="opacity: 0">BONUS</th>
                        <th style="opacity: 0">CORRECTION</th>
                        <th style="opacity: 0">GROSS INCOME</th>
                        <!--<th style="opacity: 0">LOAN DISBURSEMENT</th>-->
                        <!--<th style="opacity: 0">REPAID OF DEPOSIT</th>-->
                        <th style="opacity: 0">TOTAL GROSS INCOME</th>
                        <!--<th style="opacity: 0">LOAN PAYTMENT</th>-->
                        <th style="opacity: 0">ADVANCE PAYMENT</th>
                        <th style="opacity: 0">TOTAL BPJS</th>
                        <th style="opacity: 0">TAX ARTICLE 21</th>
                        <th style="opacity: 0">CORRECTION</th>
                        <th style="opacity: 0">TOTAL DEDUCTION</th>
                        <th style="opacity: 0">TAKE HOME PAY</th>
                    </tr>
                    </tfoot>
                </table>
            </div>
        </div><br>
        <div class="card">
            <div class="card-header">
                <h3>Download with Filter</h3>
            </div>
        <div class="card-body">
                <form action="{{ url('/partner/reporting/payrollhistory/download/') }}" method="GET">
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
                    <div class="form-row">
                        <div class="col">
                            <label for="periode">Period</label>
                            <select id="periode" name="periode" class="form-control">
                                <option disabled selected>
                                    All Period
                                </option>
                                @foreach($periodes as $periode)
                                    <option>
                                        {{ $periode -> periode }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col">
                            <label for="nip">NIP</label>
                            <input id="nip" name="nip" class="form-control" type="text">
                            
                        </div>
                        
                        <!--<div class="col">-->
                        <!--    <label for="nip">NIP</label>-->
                        <!--    <input id="nip" name="nip" class="form-control" type="text">-->
                        <!--</div>-->
                    </div>
                    <br>
                    <input class="btn btn-danger" type="reset" value="Reset">
                    <button class="btn btn-success" name="action" value="xls" type="submit">Download Payroll History</button>
                    <button class="btn btn-info" name="action" value="print"type="submit">Print</button>
                </form>
            </div>
    </div>
    </div>
    <style>
        .table > thead:first-child > tr:first-child > th:first-child {
    width: 210px !important;
    position: absolute;
    background-color: white;
     padding-top: 8px !important; 
    z-index: 5;
}
    </style>
    
    
    
    @endsection

      