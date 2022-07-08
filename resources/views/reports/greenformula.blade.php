@extends('layouts.reports')
@section('contentfilter')


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
            <h4 class="card-title"><b>Green Formula P-1 | AUD</b></h4>
            <p class="card-category">Accumulated green formula based on latest payroll history.</p>
        </div>
        <div class="card-body">
            <table style=" display: block; width: 100%; overflow-x: auto;font-size: 12px;"
            class="table table-responsive-md table-striped display"
            id="example">
            <thead>
                <tr>
                    <th>EMPLOYEE NAME</th>
                    <th>NIP</th>
                    <th>JOINING DATE</th>
                    <th>START M.</th>
                    <th>END M.</th>
                    <th>TOTAL M.</th>
                    <th>SALARY (YEARLY)</th>
                    <th>PPH21 ALLOWANCE</th>
                    <th>ALLOWANCE (YEARLY)</th>
                    <th>HONORARIUM (YEARLY)</th>
                    <th>ASTEK (YEARLY)</th>
                    <th>TOTAL ROUTINE INCOME</th>
                    <th>HOLIDAY ALLOWANCE & BONUS (YEARLY)</th>
                    <th>GROSS INCOME</th>
                    <th>BIJAB AT. PENG. RUTIN</th>
                    <th>BIJAB AT. PENG. NON-RUTIN</th>
                    <th>ASTEK 2% (YEARLY)</th>
                    <th>DEDUCTIONS</th>
                    <th>TOTAL NET INCOME</th>
                    <th>PTKP</th>
                    <th>PKP</th>
                    <th>ROUND</th>
                    <th>LAPIS</th>
                    <th>INCOME TAX</th>
                    <th>20% HIGHER TAX</th>
                    <th>INCOME TAX</th>
                    <th>BEEN PAID</th>
                    <th>LESS PAID</th>

                </tr>
            </thead>
            <tbody>
                @foreach($audpayrolls as $audpayroll)
                <tr>

                    @if(strlen($audpayroll->nama) <= 25)
                    <td>{{substr($audpayroll->nama,0,25)}}</td>
                    @else
                    <td>{{substr($audpayroll->nama,0,25)}}..</td>
                    @endif
                    <td>{{$audpayroll->nip}}</td>
                    <td>{{$audpayroll->tanggalbergabung}}</td>
                    <div style="display: none">
                        @if($audpayroll->tanggalresign == '0000-00-00' || $audpayroll->tanggalresign == 'NULL' || $audpayroll->tanggalresign == NULL)
                        {{$periodeakhir = 12}}
                        @else
                        @if(date('Y', strtotime($audpayroll->tanggalresign)) == date('Y'))
                        {{$periodeakhir = date('m', strtotime($audpayroll->tanggalresign))}}
                        @else
                        0
                        @endif
                        @endif
                        @if(date('Y', strtotime($audpayroll->tanggalbergabung)) == date('Y'))
                        {{$periodeawal = date('m', strtotime($audpayroll->tanggalbergabung))}}
                        @else
                        {{$periodeawal = 1}}
                        @endif
                    </div>
                    <td>{{(int)$periodeawal}}</td>
                    <td>{{(int)$periodeakhir}}</td>
                    <!--<td>{{$totalperiode = 1}}</td>-->
                    <td>{{$totalperiode = $periodeakhir - $periodeawal + 1}}</td>
                    <td>{{number_format($audpayroll->akumulasigajipokok, 2,",",".")}}</td>
                    <td></td>
                    <td>{{number_format($audpayroll->akumulasitunjangan, 2,",",".")}}</td>
                    <!--<td>{{date('F d,Y',strtotime($audpayroll->tanggalbergabung))}} - {{$audpayroll->tanggalresign}}</td>-->
                    <td></td>
                    <td>{{number_format($audpayroll->akumulasibpjsketenaga + $audpayroll->akumulasibpjskesehatan, 2,",",".")}}</td>
                    <td>{{number_format($audpayroll->akumulasigajipokok + $audpayroll->akumulasitunjangan + $audpayroll->akumulasibpjsketenaga + $audpayroll->akumulasibpjskesehatan, 2,",",".")}}</td>
                    <td>{{number_format($audpayroll->akumulasipenghasilantidakrutin, 2,",",".")}}</td>
                    <td>{{number_format($audpayroll->akumulasigajipokok + $audpayroll->akumulasitunjangan + $audpayroll->akumulasibpjsketenaga + $audpayroll->akumulasibpjskesehatan + $audpayroll->akumulasipenghasilantidakrutin, 2,",",".")}}</td>
                    @if(($audpayroll->akumulasigajipokok + $audpayroll->akumulasitunjangan + $audpayroll->akumulasibpjsketenaga + $audpayroll->akumulasibpjskesehatan)*(5/100)/$totalperiode > 500000)
                    <td>{{number_format($bijab = $totalperiode*500000, 2,",",".")}}</td>
                    @else
                    <td>{{number_format($bijab = ($audpayroll->akumulasigajipokok + $audpayroll->akumulasitunjangan + $audpayroll->akumulasibpjsketenaga + $audpayroll->akumulasibpjskesehatan)*(5/100), 2,",",".")}}</td>
                    @endif
                    @if($bijab == $totalperiode*500000)
                    <td>{{$bijabnon = 0}}</td>
                    @else
                    @if(($bijab + $audpayroll->akumulasipenghasilantidakrutin*(5/100))/$totalperiode > 500000)
                    <td>{{$bijabnon = 500000*$totalperiode-$bijab}}</td>
                    @else
                    <td>{{number_format($bijabnon = $audpayroll->akumulasipenghasilantidakrutin * (5/100), 2,",",".")}}</td>
                    @endif
                    @endif
                    <td>{{number_format($audpayroll->akumulasibpjspensiun + $audpayroll->akumulasibpjs, 2,",",".")}}</td>
                    <td>{{number_format($bijab + $bijabnon + ($audpayroll->akumulasibpjspensiun + $audpayroll->akumulasibpjs), 2,",",".")}}</td>
                    <td>{{number_format($netto = ($audpayroll->akumulasigajipokok + $audpayroll->akumulasitunjangan + 
                        $audpayroll->akumulasibpjsketenaga + $audpayroll->akumulasibpjskesehatan + 
                        $audpayroll->akumulasipenghasilantidakrutin) - ($bijab + $bijabnon + ($audpayroll->akumulasibpjspensiun + $audpayroll->akumulasibpjs)), 2,",",".")}}</td>
                        <td>
                            @if ($audpayroll->statusptkp === 'K/IL0') {{$ptkp =  
                            112500000}}
                            @elseif ($audpayroll->statusptkp === 'K/IL1') {{$ptkp =  
                            117000000}}
                            @elseif ($audpayroll->statusptkp === 'K/IL2') {{$ptkp =  
                            121500000}}
                            @elseif ($audpayroll->statusptkp === 'K/IL3') {{$ptkp =  
                            126000000}}
                            @elseif ($audpayroll->statusptkp === 'KL0') {{$ptkp =  
                            58500000}}
                            @elseif ($audpayroll->statusptkp === 'KL1') {{$ptkp =  
                            63000000}}
                            @elseif ($audpayroll->statusptkp === 'KL2') {{$ptkp =  
                            67500000}}
                            @elseif ($audpayroll->statusptkp === 'KL3') {{$ptkp =  
                            72000000}}
                            @elseif ($audpayroll->statusptkp === 'KP0') {{$ptkp =  
                            54000000}}
                            @elseif ($audpayroll->statusptkp === 'KP1') {{$ptkp =  
                            54000000}}
                            @elseif ($audpayroll->statusptkp === 'KP2') {{$ptkp =  
                            54000000}}
                            @elseif ($audpayroll->statusptkp === 'KP3') {{$ptkp =  
                            54000000}}
                            @elseif ($audpayroll->statusptkp === 'TL0') {{$ptkp =  
                            54000000}}
                            @elseif ($audpayroll->statusptkp === 'TL1') {{$ptkp =  
                            58500000}}
                            @elseif ($audpayroll->statusptkp === 'TL2') {{$ptkp =  
                            63000000}}
                            @elseif ($audpayroll->statusptkp === 'TL3') {{$ptkp =  
                            67500000}}
                            @elseif ($audpayroll->statusptkp === 'TP0') {{$ptkp =  
                            54000000}}
                            @elseif ($audpayroll->statusptkp === 'TP1') {{$ptkp =  
                            58500000}}
                            @elseif ($audpayroll->statusptkp === 'TP2') {{$ptkp =  
                            63000000}}
                            @elseif ($audpayroll->statusptkp === 'TP3') {{$ptkp =  
                            67500000}}

                            @endif
                        </td>
                        <td>
                            @if($netto - $ptkp >= 0)
                            {{number_format($pkp = $netto - $ptkp, 2,",",".")}}
                            @else
                            {{$pkp = 0}}
                            @endif
                        </td>
                        <td>{{$roundpkp = floor($pkp / 1000) * 1000}}</td>
                        @if ($roundpkp <= 50000000) 
                        <td>{{$lapis = 1}} </td>@elseif ($roundpkp >= 50000001) <td>
                            {{$lapis = 2}} 
                        </td>@elseif ($roundpkp >= 250000001) <td>
                            {{$lapis = 3}}
                        </td> @elseif ($roundpkp >= 500000001) <td>
                            {{$lapis = 4}} 
                        </td>@endif

                        <td>
                            @if ($lapis === 1) {{$pajakpenghasilan = ($roundpkp * (5 / 100))}} 
                            @elseif ($lapis === 2) {{$pajakpenghasilan = (2500000 + ($roundpkp - 50000000) * (15 / 100))}} 
                            @elseif ($lapis === 3) {{$pajakpenghasilan = (32500000 + ($roundpkp - 250000000) * (25 / 100))}} 
                            @elseif ($lapis === 4) {{$pajakpenghasilan = (95000000 + ($roundpkp - 500000000) * (30 / 100))}}
                            @endif
                        </td>
                        <td>
                            {{(120/100)*$pajakpenghasilan}}
                        </td>
                        <td>
                            @if($audpayroll->npwp == 0 || $audpayroll->npwp == null)
                            {{number_format($pajak = (120/100)*$pajakpenghasilan, 2,",",".")}}
                            @else
                            {{number_format($pajak = $pajakpenghasilan, 2,",",".")}}
                            @endif
                        </td>
                        <td>
                            {{number_format($audpayroll->akumulasipph, 2,",",".")}}
                        </td>
                        <td>
                            {{number_format(floor($pajak - $audpayroll->akumulasipph), 2,",",".")}}
                        </td>

                    </tr>
                    @endforeach
                </tbody>
                <tfoot>
                    <tr>
                        <th style="opacity: 0">EMPLOYEE NAME</th>
                        <th style="opacity: 0">NIP</th>
                        <th style="opacity: 0">JOINING DATE</th>
                        <th style="opacity: 0">START M.</th>
                        <th style="opacity: 0">END M.</th>
                        <th style="opacity: 0">TOTAL M.</th>
                        <th style="opacity: 0">SALARY (YEARLY)</th>
                        <th style="opacity: 0">PPH21 ALLOWANCE</th>
                        <th style="opacity: 0">ALLOWANCE (YEARLY)</th>
                        <th style="opacity: 0">HONORARIUM (YEARLY)</th>
                        <th style="opacity: 0">ASTEK (YEARLY)</th>
                        <th style="opacity: 0">TOTAL ROUTINE INCOME</th>
                        <th style="opacity: 0">HOLIDAY ALLOWANCE & BONUS (YEARLY)</th>
                        <th style="opacity: 0">GROSS INCOME</th>
                        <th style="opacity: 0">BIJAB AT. PENG. RUTIN</th>
                        <th style="opacity: 0">BIJAB AT. PENG. NON-RUTIN</th>
                        <th style="opacity: 0">ASTEK 2% (YEARLY)</th>
                        <th style="opacity: 0">DEDUCTIONS</th>
                        <th style="opacity: 0">TOTAL NET INCOME</th>
                        <th style="opacity: 0">PTKP</th>
                        <th style="opacity: 0">PKP</th>
                        <th style="opacity: 0">ROUND</th>
                        <th style="opacity: 0">LAPIS</th>
                        <th style="opacity: 0">INCOME TAX</th>
                        <th style="opacity: 0">20% HIGHER TAX</th>
                        <th style="opacity: 0">INCOME TAX</th>
                        <th style="opacity: 0">BEEN PAID</th>
                        <th style="opacity: 0">LESS PAID</th>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div><br>
    <div class="card">

        <div  class="card-header card-header-primary" style="background-color: #149fd5; color: white;">
            <h4 class="card-title"><b>Green Formula P-1 | TAX</b></h4>
            <p class="card-category">Accumulated green formula based on latest payroll history.</p>
        </div>
        
        <div class="card-body">
            <table style=" display: block; width: 100%; overflow-x: auto;font-size: 12px;"
            class="table table-responsive-md table-striped display"
            id="examplefour">
            <thead>
                <tr>
                    <th>EMPLOYEE NAME</th>
                    <th>NIP</th>
                    <th>JOINING DATE</th>
                    <th>START M.</th>
                    <th>END M.</th>
                    <th>TOTAL M.</th>
                    <th>SALARY (YEARLY)</th>
                    <th>PPH21 ALLOWANCE</th>
                    <th>ALLOWANCE (YEARLY)</th>
                    <th>HONORARIUM (YEARLY)</th>
                    <th>ASTEK (YEARLY)</th>
                    <th>TOTAL ROUTINE INCOME</th>
                    <th>HOLIDAY ALLOWANCE & BONUS (YEARLY)</th>
                    <th>GROSS INCOME</th>
                    <th>BIJAB AT. PENG. RUTIN</th>
                    <th>BIJAB AT. PENG. NON-RUTIN</th>
                    <th>ASTEK 2% (YEARLY)</th>
                    <th>DEDUCTIONS</th>
                    <th>TOTAL NET INCOME</th>
                    <th>PTKP</th>
                    <th>PKP</th>
                    <th>ROUND</th>
                    <th>LAPIS</th>
                    <th>INCOME TAX</th>
                    <th>20% HIGHER TAX</th>
                    <th>INCOME TAX</th>
                    <th>BEEN PAID</th>
                    <th>LESS PAID</th>

                </tr>
            </thead>
            <tbody>
                @foreach($taxpayrolls as $taxpayroll)
                <tr>

                    @if(strlen($taxpayroll->nama) <= 25)
                    <td>{{substr($taxpayroll->nama,0,25)}}</td>
                    @else
                    <td>{{substr($taxpayroll->nama,0,25)}}..</td>
                    @endif
                    <td>{{$taxpayroll->nip}}</td>
                    <td>{{$taxpayroll->tanggalbergabung}}</td>
                    <div style="display: none">
                        @if($taxpayroll->tanggalresign == '0000-00-00' || $taxpayroll->tanggalresign == 'NULL' || $taxpayroll->tanggalresign == NULL)
                        {{$periodeakhir = 12}}
                        @else
                        @if(date('Y', strtotime($taxpayroll->tanggalresign)) == date('Y'))
                        {{$periodeakhir = date('m', strtotime($taxpayroll->tanggalresign))}}
                        @else
                        0
                        @endif
                        @endif
                        @if(date('Y', strtotime($taxpayroll->tanggalbergabung)) == date('Y'))
                        {{$periodeawal = date('m', strtotime($taxpayroll->tanggalbergabung))}}
                        @else
                        {{$periodeawal = 1}}
                        @endif
                    </div>
                    <td>{{(int)$periodeawal}}</td>
                    <td>{{(int)$periodeakhir}}</td>
                    <!--<td>{{$totalperiode = 1}}</td>-->
                    <td>{{$totalperiode = $periodeakhir - $periodeawal + 1}}</td>
                    <td>{{number_format($taxpayroll->akumulasigajipokok, 2,",",".")}}</td>
                    <td></td>
                    <td>{{number_format($taxpayroll->akumulasitunjangan, 2,",",".")}}</td>
                    <!--<td>{{date('F d,Y',strtotime($taxpayroll->tanggalbergabung))}} - {{$taxpayroll->tanggalresign}}</td>-->
                    <td></td>
                    <td>{{number_format($taxpayroll->akumulasibpjsketenaga + $taxpayroll->akumulasibpjskesehatan, 2,",",".")}}</td>
                    <td>{{number_format($taxpayroll->akumulasigajipokok + $taxpayroll->akumulasitunjangan + $taxpayroll->akumulasibpjsketenaga + $taxpayroll->akumulasibpjskesehatan, 2,",",".")}}</td>
                    <td>{{number_format($taxpayroll->akumulasipenghasilantidakrutin, 2,",",".")}}</td>
                    <td>{{number_format($taxpayroll->akumulasigajipokok + $taxpayroll->akumulasitunjangan + $taxpayroll->akumulasibpjsketenaga + $taxpayroll->akumulasibpjskesehatan + $taxpayroll->akumulasipenghasilantidakrutin, 2,",",".")}}</td>
                    @if(($taxpayroll->akumulasigajipokok + $taxpayroll->akumulasitunjangan + $taxpayroll->akumulasibpjsketenaga + $taxpayroll->akumulasibpjskesehatan)*(5/100)/$totalperiode > 500000)
                    <td>{{number_format($bijab = $totalperiode*500000, 2,",",".")}}</td>
                    @else
                    <td>{{number_format($bijab = ($taxpayroll->akumulasigajipokok + $taxpayroll->akumulasitunjangan + $taxpayroll->akumulasibpjsketenaga + $taxpayroll->akumulasibpjskesehatan)*(5/100), 2,",",".")}}</td>
                    @endif
                    @if($bijab == $totalperiode*500000)
                    <td>{{$bijabnon = 0}}</td>
                    @else
                    @if(($bijab + $taxpayroll->akumulasipenghasilantidakrutin*(5/100))/$totalperiode > 500000)
                    <td>{{$bijabnon = 500000*$totalperiode-$bijab}}</td>
                    @else
                    <td>{{number_format($bijabnon = $taxpayroll->akumulasipenghasilantidakrutin * (5/100), 2,",",".")}}</td>
                    @endif
                    @endif
                    <td>{{number_format($taxpayroll->akumulasibpjspensiun + $taxpayroll->akumulasibpjs, 2,",",".")}}</td>
                    <td>{{number_format($bijab + $bijabnon + ($taxpayroll->akumulasibpjspensiun + $taxpayroll->akumulasibpjs), 2,",",".")}}</td>
                    <td>{{number_format($netto = ($taxpayroll->akumulasigajipokok + $taxpayroll->akumulasitunjangan + 
                        $taxpayroll->akumulasibpjsketenaga + $taxpayroll->akumulasibpjskesehatan + 
                        $taxpayroll->akumulasipenghasilantidakrutin) - ($bijab + $bijabnon + ($taxpayroll->akumulasibpjspensiun + $taxpayroll->akumulasibpjs)), 2,",",".")}}</td>
                        <td>
                            @if ($taxpayroll->statusptkp === 'K/IL0') {{$ptkp =  
                            112500000}}
                            @elseif ($taxpayroll->statusptkp === 'K/IL1') {{$ptkp =  
                            117000000}}
                            @elseif ($taxpayroll->statusptkp === 'K/IL2') {{$ptkp =  
                            121500000}}
                            @elseif ($taxpayroll->statusptkp === 'K/IL3') {{$ptkp =  
                            126000000}}
                            @elseif ($taxpayroll->statusptkp === 'KL0') {{$ptkp =  
                            58500000}}
                            @elseif ($taxpayroll->statusptkp === 'KL1') {{$ptkp =  
                            63000000}}
                            @elseif ($taxpayroll->statusptkp === 'KL2') {{$ptkp =  
                            67500000}}
                            @elseif ($taxpayroll->statusptkp === 'KL3') {{$ptkp =  
                            72000000}}
                            @elseif ($taxpayroll->statusptkp === 'KP0') {{$ptkp =  
                            54000000}}
                            @elseif ($taxpayroll->statusptkp === 'KP1') {{$ptkp =  
                            54000000}}
                            @elseif ($taxpayroll->statusptkp === 'KP2') {{$ptkp =  
                            54000000}}
                            @elseif ($taxpayroll->statusptkp === 'KP3') {{$ptkp =  
                            54000000}}
                            @elseif ($taxpayroll->statusptkp === 'TL0') {{$ptkp =  
                            54000000}}
                            @elseif ($taxpayroll->statusptkp === 'TL1') {{$ptkp =  
                            58500000}}
                            @elseif ($taxpayroll->statusptkp === 'TL2') {{$ptkp =  
                            63000000}}
                            @elseif ($taxpayroll->statusptkp === 'TL3') {{$ptkp =  
                            67500000}}
                            @elseif ($taxpayroll->statusptkp === 'TP0') {{$ptkp =  
                            54000000}}
                            @elseif ($taxpayroll->statusptkp === 'TP1') {{$ptkp =  
                            58500000}}
                            @elseif ($taxpayroll->statusptkp === 'TP2') {{$ptkp =  
                            63000000}}
                            @elseif ($taxpayroll->statusptkp === 'TP3') {{$ptkp =  
                            67500000}}

                            @endif
                        </td>
                        <td>
                            @if($netto - $ptkp >= 0)
                            {{number_format($pkp = $netto - $ptkp, 2,",",".")}}
                            @else
                            {{$pkp = 0}}
                            @endif
                        </td>
                        <td>{{$roundpkp = floor($pkp / 1000) * 1000}}</td>
                        @if ($roundpkp <= 50000000) 
                        <td>{{$lapis = 1}} </td>@elseif ($roundpkp >= 50000001) <td>
                            {{$lapis = 2}} 
                        </td>@elseif ($roundpkp >= 250000001) <td>
                            {{$lapis = 3}}
                        </td> @elseif ($roundpkp >= 500000001) <td>
                            {{$lapis = 4}} 
                        </td>@endif

                        <td>
                            @if ($lapis === 1) {{$pajakpenghasilan = ($roundpkp * (5 / 100))}} 
                            @elseif ($lapis === 2) {{$pajakpenghasilan = (2500000 + ($roundpkp - 50000000) * (15 / 100))}} 
                            @elseif ($lapis === 3) {{$pajakpenghasilan = (32500000 + ($roundpkp - 250000000) * (25 / 100))}} 
                            @elseif ($lapis === 4) {{$pajakpenghasilan = (95000000 + ($roundpkp - 500000000) * (30 / 100))}}
                            @endif
                        </td>
                        <td>
                            {{(120/100)*$pajakpenghasilan}}
                        </td>
                        <td>
                            @if($taxpayroll->npwp == 0 || $taxpayroll->npwp == null)
                            {{number_format($pajak = (120/100)*$pajakpenghasilan, 2,",",".")}}
                            @else
                            {{number_format($pajak = $pajakpenghasilan, 2,",",".")}}
                            @endif
                        </td>
                        <td>
                            {{number_format($taxpayroll->akumulasipph, 2,",",".")}}
                        </td>
                        <td>
                            {{number_format(floor($pajak - $taxpayroll->akumulasipph), 2,",",".")}}
                        </td>

                    </tr>
                    @endforeach
                </tbody>
                <tfoot>
                    <tr>
                        <th style="opacity: 0">EMPLOYEE NAME</th>
                        <th style="opacity: 0">NIP</th>
                        <th style="opacity: 0">JOINING DATE</th>
                        <th style="opacity: 0">START M.</th>
                        <th style="opacity: 0">END M.</th>
                        <th style="opacity: 0">TOTAL M.</th>
                        <th style="opacity: 0">SALARY (YEARLY)</th>
                        <th style="opacity: 0">PPH21 ALLOWANCE</th>
                        <th style="opacity: 0">ALLOWANCE (YEARLY)</th>
                        <th style="opacity: 0">HONORARIUM (YEARLY)</th>
                        <th style="opacity: 0">ASTEK (YEARLY)</th>
                        <th style="opacity: 0">TOTAL ROUTINE INCOME</th>
                        <th style="opacity: 0">HOLIDAY ALLOWANCE & BONUS (YEARLY)</th>
                        <th style="opacity: 0">GROSS INCOME</th>
                        <th style="opacity: 0">BIJAB AT. PENG. RUTIN</th>
                        <th style="opacity: 0">BIJAB AT. PENG. NON-RUTIN</th>
                        <th style="opacity: 0">ASTEK 2% (YEARLY)</th>
                        <th style="opacity: 0">DEDUCTIONS</th>
                        <th style="opacity: 0">TOTAL NET INCOME</th>
                        <th style="opacity: 0">PTKP</th>
                        <th style="opacity: 0">PKP</th>
                        <th style="opacity: 0">ROUND</th>
                        <th style="opacity: 0">LAPIS</th>
                        <th style="opacity: 0">INCOME TAX</th>
                        <th style="opacity: 0">20% HIGHER TAX</th>
                        <th style="opacity: 0">INCOME TAX</th>
                        <th style="opacity: 0">BEEN PAID</th>
                        <th style="opacity: 0">LESS PAID</th>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div><br>
    <div class="card">

        <div  class="card-header card-header-warning" style="background-color: #149fd5; color: white;">
            <h4 class="card-title"><b>Green Formula P-1 | ACC</b></h4>
            <p class="card-category">Accumulated green formula based on latest payroll history.</p>
        </div>
        
        <div class="card-body">
            <table style=" display: block; width: 100%; overflow-x: auto;font-size: 12px;"
            class="table table-responsive-md table-striped display"
            id="exampletwo">
            <thead>
                <tr>
                    <th>EMPLOYEE NAME</th>
                    <th>NIP</th>
                    <th>JOINING DATE</th>
                    <th>START M.</th>
                    <th>END M.</th>
                    <th>TOTAL M.</th>
                    <th>SALARY (YEARLY)</th>
                    <th>PPH21 ALLOWANCE</th>
                    <th>ALLOWANCE (YEARLY)</th>
                    <th>HONORARIUM (YEARLY)</th>
                    <th>ASTEK (YEARLY)</th>
                    <th>TOTAL ROUTINE INCOME</th>
                    <th>HOLIDAY ALLOWANCE & BONUS (YEARLY)</th>
                    <th>GROSS INCOME</th>
                    <th>BIJAB AT. PENG. RUTIN</th>
                    <th>BIJAB AT. PENG. NON-RUTIN</th>
                    <th>ASTEK 2% (YEARLY)</th>
                    <th>DEDUCTIONS</th>
                    <th>TOTAL NET INCOME</th>
                    <th>PTKP</th>
                    <th>PKP</th>
                    <th>ROUND</th>
                    <th>LAPIS</th>
                    <th>INCOME TAX</th>
                    <th>20% HIGHER TAX</th>
                    <th>INCOME TAX</th>
                    <th>BEEN PAID</th>
                    <th>LESS PAID</th>

                </tr>
            </thead>
            <tbody>
                @foreach($accpayrolls as $accpayroll)
                <tr>

                    @if(strlen($accpayroll->nama) <= 25)
                    <td>{{substr($accpayroll->nama,0,25)}}</td>
                    @else
                    <td>{{substr($accpayroll->nama,0,25)}}..</td>
                    @endif
                    <td>{{$accpayroll->nip}}</td>
                    <td>{{$accpayroll->tanggalbergabung}}</td>
                    <div style="display: none">
                        @if($accpayroll->tanggalresign == '0000-00-00' || $accpayroll->tanggalresign == 'NULL' || $accpayroll->tanggalresign == NULL)
                        {{$periodeakhir = 12}}
                        @else
                        @if(date('Y', strtotime($accpayroll->tanggalresign)) == date('Y'))
                        {{$periodeakhir = date('m', strtotime($accpayroll->tanggalresign))}}
                        @else
                        0
                        @endif
                        @endif
                        @if(date('Y', strtotime($accpayroll->tanggalbergabung)) == date('Y'))
                        {{$periodeawal = date('m', strtotime($accpayroll->tanggalbergabung))}}
                        @else
                        {{$periodeawal = 1}}
                        @endif
                    </div>
                    <td>{{(int)$periodeawal}}</td>
                    <td>{{(int)$periodeakhir}}</td>
                    <!--<td>{{$totalperiode = 1}}</td>-->
                    <td>{{$totalperiode = $periodeakhir - $periodeawal + 1}}</td>
                    <td>{{number_format($accpayroll->akumulasigajipokok, 2,",",".")}}</td>
                    <td></td>
                    <td>{{number_format($accpayroll->akumulasitunjangan, 2,",",".")}}</td>
                    <!--<td>{{date('F d,Y',strtotime($accpayroll->tanggalbergabung))}} - {{$accpayroll->tanggalresign}}</td>-->
                    <td></td>
                    <td>{{number_format($accpayroll->akumulasibpjsketenaga + $accpayroll->akumulasibpjskesehatan, 2,",",".")}}</td>
                    <td>{{number_format($accpayroll->akumulasigajipokok + $accpayroll->akumulasitunjangan + $accpayroll->akumulasibpjsketenaga + $accpayroll->akumulasibpjskesehatan, 2,",",".")}}</td>
                    <td>{{number_format($accpayroll->akumulasipenghasilantidakrutin, 2,",",".")}}</td>
                    <td>{{number_format($accpayroll->akumulasigajipokok + $accpayroll->akumulasitunjangan + $accpayroll->akumulasibpjsketenaga + $accpayroll->akumulasibpjskesehatan + $accpayroll->akumulasipenghasilantidakrutin, 2,",",".")}}</td>
                    @if(($accpayroll->akumulasigajipokok + $accpayroll->akumulasitunjangan + $accpayroll->akumulasibpjsketenaga + $accpayroll->akumulasibpjskesehatan)*(5/100)/$totalperiode > 500000)
                    <td>{{number_format($bijab = $totalperiode*500000, 2,",",".")}}</td>
                    @else
                    <td>{{number_format($bijab = ($accpayroll->akumulasigajipokok + $accpayroll->akumulasitunjangan + $accpayroll->akumulasibpjsketenaga + $accpayroll->akumulasibpjskesehatan)*(5/100), 2,",",".")}}</td>
                    @endif
                    @if($bijab == $totalperiode*500000)
                    <td>{{$bijabnon = 0}}</td>
                    @else
                    @if(($bijab + $accpayroll->akumulasipenghasilantidakrutin*(5/100))/$totalperiode > 500000)
                    <td>{{$bijabnon = 500000*$totalperiode-$bijab}}</td>
                    @else
                    <td>{{number_format($bijabnon = $accpayroll->akumulasipenghasilantidakrutin * (5/100), 2,",",".")}}</td>
                    @endif
                    @endif
                    <td>{{number_format($accpayroll->akumulasibpjspensiun + $accpayroll->akumulasibpjs, 2,",",".")}}</td>
                    <td>{{number_format($bijab + $bijabnon + ($accpayroll->akumulasibpjspensiun + $accpayroll->akumulasibpjs), 2,",",".")}}</td>
                    <td>{{number_format($netto = ($accpayroll->akumulasigajipokok + $accpayroll->akumulasitunjangan + 
                        $accpayroll->akumulasibpjsketenaga + $accpayroll->akumulasibpjskesehatan + 
                        $accpayroll->akumulasipenghasilantidakrutin) - ($bijab + $bijabnon + ($accpayroll->akumulasibpjspensiun + $accpayroll->akumulasibpjs)), 2,",",".")}}</td>
                        <td>
                            @if ($accpayroll->statusptkp === 'K/IL0') {{$ptkp =  
                            112500000}}
                            @elseif ($accpayroll->statusptkp === 'K/IL1') {{$ptkp =  
                            117000000}}
                            @elseif ($accpayroll->statusptkp === 'K/IL2') {{$ptkp =  
                            121500000}}
                            @elseif ($accpayroll->statusptkp === 'K/IL3') {{$ptkp =  
                            126000000}}
                            @elseif ($accpayroll->statusptkp === 'KL0') {{$ptkp =  
                            58500000}}
                            @elseif ($accpayroll->statusptkp === 'KL1') {{$ptkp =  
                            63000000}}
                            @elseif ($accpayroll->statusptkp === 'KL2') {{$ptkp =  
                            67500000}}
                            @elseif ($accpayroll->statusptkp === 'KL3') {{$ptkp =  
                            72000000}}
                            @elseif ($accpayroll->statusptkp === 'KP0') {{$ptkp =  
                            54000000}}
                            @elseif ($accpayroll->statusptkp === 'KP1') {{$ptkp =  
                            54000000}}
                            @elseif ($accpayroll->statusptkp === 'KP2') {{$ptkp =  
                            54000000}}
                            @elseif ($accpayroll->statusptkp === 'KP3') {{$ptkp =  
                            54000000}}
                            @elseif ($accpayroll->statusptkp === 'TL0') {{$ptkp =  
                            54000000}}
                            @elseif ($accpayroll->statusptkp === 'TL1') {{$ptkp =  
                            58500000}}
                            @elseif ($accpayroll->statusptkp === 'TL2') {{$ptkp =  
                            63000000}}
                            @elseif ($accpayroll->statusptkp === 'TL3') {{$ptkp =  
                            67500000}}
                            @elseif ($accpayroll->statusptkp === 'TP0') {{$ptkp =  
                            54000000}}
                            @elseif ($accpayroll->statusptkp === 'TP1') {{$ptkp =  
                            58500000}}
                            @elseif ($accpayroll->statusptkp === 'TP2') {{$ptkp =  
                            63000000}}
                            @elseif ($accpayroll->statusptkp === 'TP3') {{$ptkp =  
                            67500000}}

                            @endif
                        </td>
                        <td>
                            @if($netto - $ptkp >= 0)
                            {{number_format($pkp = $netto - $ptkp, 2,",",".")}}
                            @else
                            {{$pkp = 0}}
                            @endif
                        </td>
                        <td>{{$roundpkp = floor($pkp / 1000) * 1000}}</td>
                        @if ($roundpkp <= 50000000) 
                        <td>{{$lapis = 1}} </td>@elseif ($roundpkp >= 50000001) <td>
                            {{$lapis = 2}} 
                        </td>@elseif ($roundpkp >= 250000001) <td>
                            {{$lapis = 3}}
                        </td> @elseif ($roundpkp >= 500000001) <td>
                            {{$lapis = 4}} 
                        </td>@endif

                        <td>
                            @if ($lapis === 1) {{$pajakpenghasilan = ($roundpkp * (5 / 100))}} 
                            @elseif ($lapis === 2) {{$pajakpenghasilan = (2500000 + ($roundpkp - 50000000) * (15 / 100))}} 
                            @elseif ($lapis === 3) {{$pajakpenghasilan = (32500000 + ($roundpkp - 250000000) * (25 / 100))}} 
                            @elseif ($lapis === 4) {{$pajakpenghasilan = (95000000 + ($roundpkp - 500000000) * (30 / 100))}}
                            @endif
                        </td>
                        <td>
                            {{(120/100)*$pajakpenghasilan}}
                        </td>
                        <td>
                            @if($accpayroll->npwp == 0 || $accpayroll->npwp == null)
                            {{number_format($pajak = (120/100)*$pajakpenghasilan, 2,",",".")}}
                            @else
                            {{number_format($pajak = $pajakpenghasilan, 2,",",".")}}
                            @endif
                        </td>
                        <td>
                            {{number_format($accpayroll->akumulasipph, 2,",",".")}}
                        </td>
                        <td>
                            {{number_format(floor($pajak - $accpayroll->akumulasipph), 2,",",".")}}
                        </td>

                    </tr>
                    @endforeach
                </tbody>
                <tfoot>
                    <tr>
                        <th style="opacity: 0">EMPLOYEE NAME</th>
                        <th style="opacity: 0">NIP</th>
                        <th style="opacity: 0">JOINING DATE</th>
                        <th style="opacity: 0">START M.</th>
                        <th style="opacity: 0">END M.</th>
                        <th style="opacity: 0">TOTAL M.</th>
                        <th style="opacity: 0">SALARY (YEARLY)</th>
                        <th style="opacity: 0">PPH21 ALLOWANCE</th>
                        <th style="opacity: 0">ALLOWANCE (YEARLY)</th>
                        <th style="opacity: 0">HONORARIUM (YEARLY)</th>
                        <th style="opacity: 0">ASTEK (YEARLY)</th>
                        <th style="opacity: 0">TOTAL ROUTINE INCOME</th>
                        <th style="opacity: 0">HOLIDAY ALLOWANCE & BONUS (YEARLY)</th>
                        <th style="opacity: 0">GROSS INCOME</th>
                        <th style="opacity: 0">BIJAB AT. PENG. RUTIN</th>
                        <th style="opacity: 0">BIJAB AT. PENG. NON-RUTIN</th>
                        <th style="opacity: 0">ASTEK 2% (YEARLY)</th>
                        <th style="opacity: 0">DEDUCTIONS</th>
                        <th style="opacity: 0">TOTAL NET INCOME</th>
                        <th style="opacity: 0">PTKP</th>
                        <th style="opacity: 0">PKP</th>
                        <th style="opacity: 0">ROUND</th>
                        <th style="opacity: 0">LAPIS</th>
                        <th style="opacity: 0">INCOME TAX</th>
                        <th style="opacity: 0">20% HIGHER TAX</th>
                        <th style="opacity: 0">INCOME TAX</th>
                        <th style="opacity: 0">BEEN PAID</th>
                        <th style="opacity: 0">LESS PAID</th>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div><br>
    <div class="card">

        <div  class="card-header card-header-danger" style="background-color: #149fd5; color: white;">
            <h4 class="card-title"><b>Green Formula P-1 | ADM</b></h4>
            <p class="card-category">Accumulated green formula based on latest payroll history.</p>
        </div>
        
        <div class="card-body">
            <table style=" display: block; width: 100%; overflow-x: auto;font-size: 12px;"
            class="table table-responsive-md table-striped display"
            id="examplethree">
            <thead>
                <tr>
                    <th>EMPLOYEE NAME</th>
                    <th>NIP</th>
                    <th>JOINING DATE</th>
                    <th>START M.</th>
                    <th>END M.</th>
                    <th>TOTAL M.</th>
                    <th>SALARY (YEARLY)</th>
                    <th>PPH21 ALLOWANCE</th>
                    <th>ALLOWANCE (YEARLY)</th>
                    <th>HONORARIUM (YEARLY)</th>
                    <th>ASTEK (YEARLY)</th>
                    <th>TOTAL ROUTINE INCOME</th>
                    <th>HOLIDAY ALLOWANCE & BONUS (YEARLY)</th>
                    <th>GROSS INCOME</th>
                    <th>BIJAB AT. PENG. RUTIN</th>
                    <th>BIJAB AT. PENG. NON-RUTIN</th>
                    <th>ASTEK 2% (YEARLY)</th>
                    <th>DEDUCTIONS</th>
                    <th>TOTAL NET INCOME</th>
                    <th>PTKP</th>
                    <th>PKP</th>
                    <th>ROUND</th>
                    <th>LAPIS</th>
                    <th>INCOME TAX</th>
                    <th>20% HIGHER TAX</th>
                    <th>INCOME TAX</th>
                    <th>BEEN PAID</th>
                    <th>LESS PAID</th>

                </tr>
            </thead>
            <tbody>
                @foreach($admpayrolls as $admpayroll)
                <tr>

                    @if(strlen($admpayroll->nama) <= 25)
                    <td>{{substr($admpayroll->nama,0,25)}}</td>
                    @else
                    <td>{{substr($admpayroll->nama,0,25)}}..</td>
                    @endif
                    <td>{{$admpayroll->nip}}</td>
                    <td>{{$admpayroll->tanggalbergabung}}</td>
                    <div style="display: none">
                        @if($admpayroll->tanggalresign == '0000-00-00' || $admpayroll->tanggalresign == 'NULL' || $admpayroll->tanggalresign == NULL)
                        {{$periodeakhir = 12}}
                        @else
                        @if(date('Y', strtotime($admpayroll->tanggalresign)) == date('Y'))
                        {{$periodeakhir = date('m', strtotime($admpayroll->tanggalresign))}}
                        @else
                        0
                        @endif
                        @endif
                        @if(date('Y', strtotime($admpayroll->tanggalbergabung)) == date('Y'))
                        {{$periodeawal = date('m', strtotime($admpayroll->tanggalbergabung))}}
                        @else
                        {{$periodeawal = 1}}
                        @endif
                    </div>
                    <td>{{(int)$periodeawal}}</td>
                    <td>{{(int)$periodeakhir}}</td>
                    <!--<td>{{$totalperiode = 1}}</td>-->
                    <td>{{$totalperiode = $periodeakhir - $periodeawal + 1}}</td>
                    <td>{{number_format($admpayroll->akumulasigajipokok, 2,",",".")}}</td>
                    <td></td>
                    <td>{{number_format($admpayroll->akumulasitunjangan, 2,",",".")}}</td>
                    <!--<td>{{date('F d,Y',strtotime($admpayroll->tanggalbergabung))}} - {{$admpayroll->tanggalresign}}</td>-->
                    <td></td>
                    <td>{{number_format($admpayroll->akumulasibpjsketenaga + $admpayroll->akumulasibpjskesehatan, 2,",",".")}}</td>
                    <td>{{number_format($admpayroll->akumulasigajipokok + $admpayroll->akumulasitunjangan + $admpayroll->akumulasibpjsketenaga + $admpayroll->akumulasibpjskesehatan, 2,",",".")}}</td>
                    <td>{{number_format($admpayroll->akumulasipenghasilantidakrutin, 2,",",".")}}</td>
                    <td>{{number_format($admpayroll->akumulasigajipokok + $admpayroll->akumulasitunjangan + $admpayroll->akumulasibpjsketenaga + $admpayroll->akumulasibpjskesehatan + $admpayroll->akumulasipenghasilantidakrutin, 2,",",".")}}</td>
                    @if(($admpayroll->akumulasigajipokok + $admpayroll->akumulasitunjangan + $admpayroll->akumulasibpjsketenaga + $admpayroll->akumulasibpjskesehatan)*(5/100)/$totalperiode > 500000)
                    <td>{{number_format($bijab = $totalperiode*500000, 2,",",".")}}</td>
                    @else
                    <td>{{number_format($bijab = ($admpayroll->akumulasigajipokok + $admpayroll->akumulasitunjangan + $admpayroll->akumulasibpjsketenaga + $admpayroll->akumulasibpjskesehatan)*(5/100), 2,",",".")}}</td>
                    @endif
                    @if($bijab == $totalperiode*500000)
                    <td>{{$bijabnon = 0}}</td>
                    @else
                    @if(($bijab + $admpayroll->akumulasipenghasilantidakrutin*(5/100))/$totalperiode > 500000)
                    <td>{{$bijabnon = 500000*$totalperiode-$bijab}}</td>
                    @else
                    <td>{{number_format($bijabnon = $admpayroll->akumulasipenghasilantidakrutin * (5/100), 2,",",".")}}</td>
                    @endif
                    @endif
                    <td>{{number_format($admpayroll->akumulasibpjspensiun + $admpayroll->akumulasibpjs, 2,",",".")}}</td>
                    <td>{{number_format($bijab + $bijabnon + ($admpayroll->akumulasibpjspensiun + $admpayroll->akumulasibpjs), 2,",",".")}}</td>
                    <td>{{number_format($netto = ($admpayroll->akumulasigajipokok + $admpayroll->akumulasitunjangan + 
                        $admpayroll->akumulasibpjsketenaga + $admpayroll->akumulasibpjskesehatan + 
                        $admpayroll->akumulasipenghasilantidakrutin) - ($bijab + $bijabnon + ($admpayroll->akumulasibpjspensiun + $admpayroll->akumulasibpjs)), 2,",",".")}}</td>
                        <td>
                            @if ($admpayroll->statusptkp === 'K/IL0') {{$ptkp =  
                            112500000}}
                            @elseif ($admpayroll->statusptkp === 'K/IL1') {{$ptkp =  
                            117000000}}
                            @elseif ($admpayroll->statusptkp === 'K/IL2') {{$ptkp =  
                            121500000}}
                            @elseif ($admpayroll->statusptkp === 'K/IL3') {{$ptkp =  
                            126000000}}
                            @elseif ($admpayroll->statusptkp === 'KL0') {{$ptkp =  
                            58500000}}
                            @elseif ($admpayroll->statusptkp === 'KL1') {{$ptkp =  
                            63000000}}
                            @elseif ($admpayroll->statusptkp === 'KL2') {{$ptkp =  
                            67500000}}
                            @elseif ($admpayroll->statusptkp === 'KL3') {{$ptkp =  
                            72000000}}
                            @elseif ($admpayroll->statusptkp === 'KP0') {{$ptkp =  
                            54000000}}
                            @elseif ($admpayroll->statusptkp === 'KP1') {{$ptkp =  
                            54000000}}
                            @elseif ($admpayroll->statusptkp === 'KP2') {{$ptkp =  
                            54000000}}
                            @elseif ($admpayroll->statusptkp === 'KP3') {{$ptkp =  
                            54000000}}
                            @elseif ($admpayroll->statusptkp === 'TL0') {{$ptkp =  
                            54000000}}
                            @elseif ($admpayroll->statusptkp === 'TL1') {{$ptkp =  
                            58500000}}
                            @elseif ($admpayroll->statusptkp === 'TL2') {{$ptkp =  
                            63000000}}
                            @elseif ($admpayroll->statusptkp === 'TL3') {{$ptkp =  
                            67500000}}
                            @elseif ($admpayroll->statusptkp === 'TP0') {{$ptkp =  
                            54000000}}
                            @elseif ($admpayroll->statusptkp === 'TP1') {{$ptkp =  
                            58500000}}
                            @elseif ($admpayroll->statusptkp === 'TP2') {{$ptkp =  
                            63000000}}
                            @elseif ($admpayroll->statusptkp === 'TP3') {{$ptkp =  
                            67500000}}

                            @endif
                        </td>
                        <td>
                            @if($netto - $ptkp >= 0)
                            {{number_format($pkp = $netto - $ptkp, 2,",",".")}}
                            @else
                            {{$pkp = 0}}
                            @endif
                        </td>
                        <td>{{$roundpkp = floor($pkp / 1000) * 1000}}</td>
                        @if ($roundpkp <= 50000000) 
                        <td>{{$lapis = 1}} </td>@elseif ($roundpkp >= 50000001) <td>
                            {{$lapis = 2}} 
                        </td>@elseif ($roundpkp >= 250000001) <td>
                            {{$lapis = 3}}
                        </td> @elseif ($roundpkp >= 500000001) <td>
                            {{$lapis = 4}} 
                        </td>@endif

                        <td>
                            @if ($lapis === 1) {{$pajakpenghasilan = ($roundpkp * (5 / 100))}} 
                            @elseif ($lapis === 2) {{$pajakpenghasilan = (2500000 + ($roundpkp - 50000000) * (15 / 100))}} 
                            @elseif ($lapis === 3) {{$pajakpenghasilan = (32500000 + ($roundpkp - 250000000) * (25 / 100))}} 
                            @elseif ($lapis === 4) {{$pajakpenghasilan = (95000000 + ($roundpkp - 500000000) * (30 / 100))}}
                            @endif
                        </td>
                        <td>
                            {{(120/100)*$pajakpenghasilan}}
                        </td>
                        <td>
                            @if($admpayroll->npwp == 0 || $admpayroll->npwp == null)
                            {{number_format($pajak = (120/100)*$pajakpenghasilan, 2,",",".")}}
                            @else
                            {{number_format($pajak = $pajakpenghasilan, 2,",",".")}}
                            @endif
                        </td>
                        <td>
                            {{number_format($admpayroll->akumulasipph, 2,",",".")}}
                        </td>
                        <td>
                            {{number_format(floor($pajak - $admpayroll->akumulasipph), 2,",",".")}}
                        </td>

                    </tr>
                    @endforeach
                </tbody>
                <tfoot>
                    <tr>
                        <th style="opacity: 0">EMPLOYEE NAME</th>
                        <th style="opacity: 0">NIP</th>
                        <th style="opacity: 0">JOINING DATE</th>
                        <th style="opacity: 0">START M.</th>
                        <th style="opacity: 0">END M.</th>
                        <th style="opacity: 0">TOTAL M.</th>
                        <th style="opacity: 0">SALARY (YEARLY)</th>
                        <th style="opacity: 0">PPH21 ALLOWANCE</th>
                        <th style="opacity: 0">ALLOWANCE (YEARLY)</th>
                        <th style="opacity: 0">HONORARIUM (YEARLY)</th>
                        <th style="opacity: 0">ASTEK (YEARLY)</th>
                        <th style="opacity: 0">TOTAL ROUTINE INCOME</th>
                        <th style="opacity: 0">HOLIDAY ALLOWANCE & BONUS (YEARLY)</th>
                        <th style="opacity: 0">GROSS INCOME</th>
                        <th style="opacity: 0">BIJAB AT. PENG. RUTIN</th>
                        <th style="opacity: 0">BIJAB AT. PENG. NON-RUTIN</th>
                        <th style="opacity: 0">ASTEK 2% (YEARLY)</th>
                        <th style="opacity: 0">DEDUCTIONS</th>
                        <th style="opacity: 0">TOTAL NET INCOME</th>
                        <th style="opacity: 0">PTKP</th>
                        <th style="opacity: 0">PKP</th>
                        <th style="opacity: 0">ROUND</th>
                        <th style="opacity: 0">LAPIS</th>
                        <th style="opacity: 0">INCOME TAX</th>
                        <th style="opacity: 0">20% HIGHER TAX</th>
                        <th style="opacity: 0">INCOME TAX</th>
                        <th style="opacity: 0">BEEN PAID</th>
                        <th style="opacity: 0">LESS PAID</th>
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
            <form action="{{ url('/partner/reporting/greenformula/download') }}" method="GET">
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
                </div><br>
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
                    <div class="col">
                        <label for="period">Period</label>
                        <select id="period" name="period" class="form-control">
                            <option disabled selected>
                                All Time
                            </option>
                            @foreach($periodes as $periode)
                            <option>
                                {{ $periode -> periode }}
                            </option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <br>
                <input class="btn btn-danger" type="reset" value="Reset">
                <button class="btn btn-success" name="action" value="xls" type="submit">Download Green Formula P-1</button>
                <!--<button class="btn btn-info" name="action" value="print" type="submit">Print</button>-->
            </form>
        </div>
    </div>

</div>
<style type="text/css">
    .table > thead:first-child > tr:first-child > th:first-child {
        width: 215px !important;
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