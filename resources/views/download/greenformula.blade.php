<table style=" display: block; width: 100%; overflow-x: auto;font-size: 12px;"
       class="table table-responsive-md table-striped display"
       id="example">
    <thead>
    <tr>

                    <th>NO.</th>
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
                    <th>HOLIDAY ALLOWANCE AND BONUS (YEARLY)</th>
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
                    <th>PERIOD</th>


    </tr>
    </thead>
    <tbody>
    <div style="display:none">{{$no = 1}}</div>
    @foreach($employeepayrolls as $employeepayroll)
                <tr>

                    <td>{{$no++}}</td>
                    @if(strlen($employeepayroll->nama) <= 25)
                    <td>{{substr($employeepayroll->nama,0,25)}}</td>
                    @else
                    <td>{{substr($employeepayroll->nama,0,25)}}..</td>
                    @endif
                    <td>{{$employeepayroll->nip}}</td>
                    <td>{{$employeepayroll->tanggalbergabung}}</td>
                    <div style="display: none">
                        @if($employeepayroll->tanggalresign == '0000-00-00' || $employeepayroll->tanggalresign == 'NULL' || $employeepayroll->tanggalresign == NULL)
                        {{$periodeakhir = date('m')}}
                        @else
                            @if(date('Y', strtotime($employeepayroll->tanggalresign)) == date('Y'))
                            {{$periodeakhir = date('m', strtotime($employeepayroll->tanggalresign))}}
                            @else
                            0
                            @endif
                        @endif
                        @if(date('Y', strtotime($employeepayroll->tanggalbergabung)) == date('Y'))
                        {{$periodeawal = date('m', strtotime($employeepayroll->tanggalbergabung))}}
                        @else
                        {{$periodeawal = 1}}
                        @endif
                    </div>
                    <td>{{(int)$periodeawal}}</td>
                    <td>{{(int)$periodeakhir}}</td>
                    <td>{{$totalperiode = 1}}</td>
                    <!--<td>{{$totalperiode = $periodeakhir - $periodeawal + 1}}</td>-->
                    <td>{{$employeepayroll->akumulasigajipokok}}</td>
                    <td></td>
                    <td>{{$employeepayroll->akumulasitunjangan}}</td>
                    <!--<td>{{date('F d,Y',strtotime($employeepayroll->tanggalbergabung))}} - {{$employeepayroll->tanggalresign}}</td>-->
                    <td></td>
                    <td>{{$employeepayroll->akumulasibpjsketenaga + $employeepayroll->akumulasibpjskesehatan}}</td>
                    <td>{{$employeepayroll->akumulasigajipokok + $employeepayroll->akumulasitunjangan + $employeepayroll->akumulasibpjsketenaga + $employeepayroll->akumulasibpjskesehatan}}</td>
                    <td>{{$employeepayroll->akumulasipenghasilantidakrutin}}</td>
                    <td>{{$employeepayroll->akumulasigajipokok + $employeepayroll->akumulasitunjangan + $employeepayroll->akumulasibpjsketenaga + $employeepayroll->akumulasibpjskesehatan + $employeepayroll->akumulasipenghasilantidakrutin}}</td>
                    @if(($employeepayroll->akumulasigajipokok + $employeepayroll->akumulasitunjangan + $employeepayroll->akumulasibpjsketenaga + $employeepayroll->akumulasibpjskesehatan)*(5/100)/$totalperiode > 500000)
                    <td>{{$bijab = $totalperiode*500000}}</td>
                    @else
                    <td>{{$bijab = ($employeepayroll->akumulasigajipokok + $employeepayroll->akumulasitunjangan + $employeepayroll->akumulasibpjsketenaga + $employeepayroll->akumulasibpjskesehatan)*(5/100)}}</td>
                    @endif
                    @if($bijab == $totalperiode*500000)
                    <td>{{$bijabnon = 0}}</td>
                    @else
                    @if(($bijab + $employeepayroll->akumulasipenghasilantidakrutin*(5/100))/$totalperiode > 500000)
                    <td>{{$bijabnon = 500000*$totalperiode-$bijab}}</td>
                    @else
                    <td>{{$bijabnon = $employeepayroll->akumulasipenghasilantidakrutin * (5/100)}}</td>
                    @endif
                    @endif
                    <td>{{$employeepayroll->akumulasibpjspensiun + $employeepayroll->akumulasibpjs}}</td>
                    <td>{{$bijab + $bijabnon + ($employeepayroll->akumulasibpjspensiun + $employeepayroll->akumulasibpjs)}}</td>
                    <td>{{$netto = ($employeepayroll->akumulasigajipokok + $employeepayroll->akumulasitunjangan + 
                        $employeepayroll->akumulasibpjsketenaga + $employeepayroll->akumulasibpjskesehatan + 
                        $employeepayroll->akumulasipenghasilantidakrutin) - ($bijab + $bijabnon + ($employeepayroll->akumulasibpjspensiun + $employeepayroll->akumulasibpjs))}}</td>
                        <td>
                            @if ($employeepayroll->statusptkp === 'K/IL0') {{$ptkp =  
                            112500000}}
                            @elseif ($employeepayroll->statusptkp === 'K/IL1') {{$ptkp =  
                            117000000}}
                            @elseif ($employeepayroll->statusptkp === 'K/IL2') {{$ptkp =  
                            121500000}}
                            @elseif ($employeepayroll->statusptkp === 'K/IL3') {{$ptkp =  
                            126000000}}
                            @elseif ($employeepayroll->statusptkp === 'KL0') {{$ptkp =  
                            58500000}}
                            @elseif ($employeepayroll->statusptkp === 'KL1') {{$ptkp =  
                            63000000}}
                            @elseif ($employeepayroll->statusptkp === 'KL2') {{$ptkp =  
                            67500000}}
                            @elseif ($employeepayroll->statusptkp === 'KL3') {{$ptkp =  
                            72000000}}
                            @elseif ($employeepayroll->statusptkp === 'KP0') {{$ptkp =  
                            54000000}}
                            @elseif ($employeepayroll->statusptkp === 'KP1') {{$ptkp =  
                            54000000}}
                            @elseif ($employeepayroll->statusptkp === 'KP2') {{$ptkp =  
                            54000000}}
                            @elseif ($employeepayroll->statusptkp === 'KP3') {{$ptkp =  
                            54000000}}
                            @elseif ($employeepayroll->statusptkp === 'TL0') {{$ptkp =  
                            54000000}}
                            @elseif ($employeepayroll->statusptkp === 'TL1') {{$ptkp =  
                            58500000}}
                            @elseif ($employeepayroll->statusptkp === 'TL2') {{$ptkp =  
                            63000000}}
                            @elseif ($employeepayroll->statusptkp === 'TL3') {{$ptkp =  
                            67500000}}
                            @elseif ($employeepayroll->statusptkp === 'TP0') {{$ptkp =  
                            54000000}}
                            @elseif ($employeepayroll->statusptkp === 'TP1') {{$ptkp =  
                            58500000}}
                            @elseif ($employeepayroll->statusptkp === 'TP2') {{$ptkp =  
                            63000000}}
                            @elseif ($employeepayroll->statusptkp === 'TP3') {{$ptkp =  
                            67500000}}

                            @endif
                        </td>
                        <td>
                            @if($netto - $ptkp >= 0)
                            {{$pkp = $netto - $ptkp}}
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
                            @if($employeepayroll->npwp == 0 || $employeepayroll->npwp == null)
                            {{$pajak = (120/100)*$pajakpenghasilan}}
                            @else
                            {{$pajak = $pajakpenghasilan}}
                            @endif
                        </td>
                        <td>
                            {{$employeepayroll->akumulasipph}}
                        </td>
                        <td>
                            {{number_format($pajak - $employeepayroll->akumulasipph, 2,",",".")}}
                        </td>
                        <td>{{$employeepayroll->periode}}</td>

                    </tr>
                    @endforeach
    </tbody>
</table>
