<html moznomarginboxes mozdisallowselectionprint>
<head>
    <title>Print Payroll</title>
    <link rel="icon" href="https://my.namast3.com/laravel/public/faviconsolis.ico">
    <link rel='stylesheet'
          href='https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.0.0-alpha.6/css/bootstrap.min.css'>
    <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no'
          name='viewport'/>
    <!--     Fonts and icons     -->
    <link rel="stylesheet" type="text/css"
          href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700|Roboto+Slab:400,700|Material+Icons"/>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css"
          integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/"
          crossorigin="anonymous">
    <link href="https://cdn.datatables.net/responsive/2.2.3/css/responsive.bootstrap4.min.css">
    <link href="{{ asset('css/datetimepicker.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css"
          integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous">


</head>
<body onload="myFunction()">

<style type="text/css" media="print">

    header,footer{
        display: none;
    }
    @page {
        size: auto;   /* auto is the initial value */
        margin: 20mm 15mm 20mm 15mm;  /* this affects the margin in the printer settings */
        background-color: green;

    }


    html {
        background-color: #FFFFFF;
        /*margin: 1.5cm .5cm; !* this affects the margin on the html before sending to printer *!*/
    }

    body {
        /*margin: 10mm 15mm 10mm 15mm; !* margin you want for the content *!*/

    }
    @media print {
        header,footer {
            display: none;
        }
    }

    .container{
        page-break-after: always;
    }
</style>
<div class="container">

    <div class="row justify-content-center">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-body">
                    <table style="font-size: 12px;" class="table table-sm table-bordered table-stripped">
                        <thead>
                        <tr>

                            <th>Name</th>
                            <th>NIP</th>
                            <th>Cek NPWP</th>
                            <th>% Kehadiran</th>
                            <th>Fixed Pay Amount</th>
                            <th>FPA Actual</th>
                            <th>% Upah</th>
                            <th>Cek % Upah</th>
                            <th>Attendances in Days</th>
                            <th>Daily Pay Amount (TH)</th>
                            <th>Overtime Fare</th>
                            <th>Overtime Amount in Hour</th>
                            <th>Overtime Amount</th>

                        </tr>
                        </thead>
                        <tbody>
                        @foreach($collections as $collection)
                            <tr>
                                <td>{{$collection->nama}}</td>
                                <td>{{$collection->nip}}</td>
                                <td>{{$collection->crossceknpwp}}</td>
                                <td>{{$collection->persenkehadiran}}</td>
                                <td>{{$collection->jumlahupahtetap}}</td>
                                <td>{{$collection->jumlahupahtetapaktual}}</td>
                                <td>{{$collection->persenupah}}</td>
                                <td>{{$collection->cekpersenupah}}</td>
                                <td>{{$collection->jumlahkehadirandalamhari}}</td>
                                <td>{{$collection->jumlahthaktual}}</td>
                                <td>{{$collection->tariflembur}}</td>
                                <td>{{$collection->jumlahjamlembur}}</td>
                                <td>{{$collection->jumlahlembur}}</td>

                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="container">

    <div class="row justify-content-center">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-body">
                    <table style="font-size: 12px;" class="table table-sm table-bordered table-stripped">
                        <thead>
                        <tr>

                            <th>Transportations</th>
                            <th>Overtime Foods</th>
                            <th>OPE Amount</th>
                            <th>Paid Claim</th>
                            <th>Claim Accumulation</th>
                            <th>% Claim</th>
                            <th>Non-Fixed Income Amount</th>
                            <th>Loan and Deposit Amount</th>
                            <th>BPJS Amount</th>
                            <th>Montly Income</th>
                            <th>Employment BPJS 0.54%</th>
                            <th>Health BPJS</th>
                            <th>Regular Income Amount</th>

                        </tr>
                        </thead>
                        <tbody>
                        @foreach($collections as $collection)
                            <tr>
                                <td>{{$collection->jumlahtransportasi}}</td>
                                <td>{{$collection->jumlahuangmakanlembur}}</td>
                                <td>{{$collection->jumlahope}}</td>
                                <td>{{$collection->jumlahklaimdibayarkan}}</td>
                                <td>{{$collection->jumlahklaimakumulasi}}</td>
                                <td>{{$collection->persenklaim}}</td>
                                <td>{{$collection->jumlahpenghasilantidaktetap}}</td>
                                <td>{{$collection->jumlahpinjamandandeposit}}</td>
                                <td>{{$collection->jumlahbpjs}}</td>
                                <td>{{$collection->penghasilanbulanan}}</td>
                                <td>{{$collection->BPJSketenagakerjaan054}}</td>
                                <td>{{$collection->BPJSkesehatan}}</td>
                                <td>{{$collection->jumlahpenghasilanrutin}}</td>

                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="container">

    <div class="row justify-content-center">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-body">
                    <table style="font-size: 12px;" class="table table-sm table-bordered table-stripped">
                        <thead>
                        <tr>


                            <th>Non-Regular Income</th>
                            <th>Non-Regular Income Amount</th>
                            <th>Non-Regular Income <br> Amount (Yearly)</th>
                            <th>Gross Income</th>
                            <th>Gross Income <br> (Yearly)</th>
                            <th>Position Allowance</th>
                            <th>Employment BPJS 2%</th>
                            <th>Retirement BPJS 1%</th>
                            <th>Cutting Amount</th>
                            <th>Cutting <br> Amount (Yearly)</th>
                            <th>PKP</th>


                        </tr>
                        </thead>
                        <tbody>
                        @foreach($collections as $collection)
                            <tr>


                                <td>{{$collection->penghasilantidakrutin}}</td>
                                <td>{{$collection->jumlahpenghasilantidakrutin}}</td>
                                <td>{{$collection->jumlahpenghasilanrutindisetahunkan}}</td>
                                <td>{{$collection->penghasilanbruto}}</td>
                                <td>{{$collection->penghasilanbrutodisetahunkan}}</td>
                                <td>{{$collection->biayajabatan}}</td>
                                <td>{{$collection->BPJSketenagakerjaan2}}</td>
                                <td>{{$collection->BPJSpensiun1}}</td>
                                <td>{{$collection->jumlahpemotongan}}</td>
                                <td>{{$collection->jumlahpemotongandisetahunkan}}</td>
                                <td>{{$collection->PKP}}</td>


                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="container">

    <div class="row justify-content-center">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-body">
                    <table style="font-size: 12px;" class="table table-sm table-bordered table-stripped">
                        <thead>
                        <tr>
                            <th>PTKP</th>
                            <th>PKP Cutted</th>
                            <th>Rounddown PKP</th>
                            {{--<th>Layer</th>--}}
                            <th>Income Tax</th>
                            <th>Been Paid Before</th>
                            <th>Insufficient Payment</th>
                            <th>Related month's PPH</th>
                            <th>Earning Total</th>
                            <th>Deduction Total</th>
                            <th>Take Home Pay</th>
                            <th>Total</th>
                            <th>Period</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($collections as $collection)
                            <tr>
                                <td>{{$collection->PTKP}}</td>
                                <td>{{$collection->PKPpotong}}</td>
                                <td>{{$collection->PKPpembulatan}}</td>
                                {{--<td>{{$collection->lapis}}</td>--}}
                                <td>{{$collection->pajakpenghasilan}}</td>
                                <td>{{$collection->telahdibayarsebelumnya}}</td>
                                <td>{{$collection->kurangbayar}}</td>
                                <td>{{$collection->PPHbulanberkaitan}}</td>
                                <td>{{$collection->earningtotal}}</td>
                                <td>{{$collection->deductiontotal}}</td>
                                <td>{{$collection->takehomepay}}</td>
                                <td>{{$collection->total}}</td>
                                <td>{{$collection->periode}}</td>

                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    function myFunction() {
        window.print()
    }
</script>
</body>

</html>