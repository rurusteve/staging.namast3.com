<html>
<head><meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <title>Pay Slip</title>
    
    <link rel="icon" href="https://my.namast3.com/laravel/public/faviconsolis.ico">

    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="{{ asset('css/jqueryui.css') }}" rel="stylesheet">
    <link href="{{ asset('css/fontawesome.css') }}" rel="stylesheet">
    <link rel="icon" type="image/png" href="http://www.solis.co.id/favicon.ico">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

{{--<title>{{ config('app.name', 'Solis Time Report') }}</title>--}}

<!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
    <script src="{{ asset('js/datetimepicker.js') }}"></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet" type="text/css">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/datetimepicker.css') }}" rel="stylesheet">
    <link href="{{ asset('css/additional.css') }}" rel="stylesheet">

    <style>
        button {
            margin: 5px 5px 5px 0;
        }

        body {
            background-color: whitesmoke;
        }

        a:hover {
            text-decoration: none;
        }
    </style>

    <style>
        * {
            font-family: Arial, Helvetica, sans-serif;
            font-size: 9px;
        }

        .payrollslipcontainer {
            max-width: 500px;
            position: absolute;
            height: 500px;
        }

        #watermark {
            max-width: 500px;
            width: 100%;
            height: 500px;
            justify-content: center;
            align-items: center;
            top: 0;
            display: flex;
            flex-direction: row;
            position: absolute;
        }
        #watermarktext{
            color: #e8e8e8;
            font-size: 65px;
            transform: rotate(320deg);
            -webkit-transform: rotate(320deg);
        }

        .sliphead {
            border-bottom: 2px black solid;
        }

        .sliphead, .slipsubhead {
            display: flex;
            flex-direction: row;
            justify-content: space-between;
            font-weight: bold;
            padding: 2px 0;
        }

        .slipsubhead {
            margin-bottom: 5px;
        }

        .subtitle {
            border-top: 1px solid black;
            border-bottom: 1px solid black;
            padding: 3px 0;
            margin: 10px 0;
            font-weight: bold;
        }

        .line {
            width: 100%;
            display: flex;
            flex-direction: row;
            justify-content: space-between;
        }

        .item {
            width: 46%;
            display: flex;
            justify-content: space-between;
            padding: 0 2%;
        }
        .colon{
            display: flex;
        }
        .colon > div{
            text-align: right;
        }
        .colon > span {
            display: inline-block;
            min-width: 130px;
        }
        .rightalign{
            text-align: right;
            min-width: 60px; !important;
        }
    </style>
</head>
<body>
<div style="display: none;">{{$crypted = session('crypt')}}</div>
<div class="card-body">
    <div id="watermark">
        <div id="watermarktext">
            CONFIDENTIAL
        </div>
    </div>

    @if (session('status'))
        <div class="alert alert-success" role="alert">
            {{ session('status') }}
        </div>
    @endif

    <style type="text/css">
        table td, table th {
            border: 1px solid black;
        }
    </style>

    <div class="payrollslipcontainer">
        <div class="sliphead">
            <div>
                @if($employees->institusi == "SOLIS" || $employees->institusi == "solusitama")
                    Solis {{ ucwords(strtolower($employees->kota)) }}
                @elseif($employees->institusi == "MSId" || $employees->institusi == "kapmirawati")
                    MSId {{ ucwords(strtolower($employees->kota)) }}
                @endif
            </div>
            <div>
                ELECTRONIC PAY SLIP
            </div>
        </div>
        <div class="slipsubhead">
            <div>
                PRIVATE AND CONFIDENTIAL
            </div>
            <div>

                {{date("F", mktime(0, 0, 0, $periode, 10))}} {{date("Y", strtotime($payrollhistory->created_at))}}
            </div>
        </div>
        <div class="line">
            <div class="item" style="width: 60%;">
                <div class="title colon">
                    <span style="min-width: 80px;">Employee Name</span>
                    <div class="rightalign">: {{ $employees -> nama }}</div>
                </div>
            </div>
            <div class="item" style="width: 60%;">
                <div class="title colon">
                    <span style="min-width: 80px;">Join Date</span>
                    : {{ $employees -> tanggalbergabung }}
                </div>
            </div>
        </div>
        <div class="line">
            <div class="item" style="width: 60%;">
                <div class="title colon">
                    <span style="min-width: 80px;">Bank Account</span>
                    : {{ $employees -> norek }}
                </div>
            </div>
            <div class="item" style="width: 60%;">
                <div class="title colon">
                    <span style="min-width: 80px;">Position</span>
                    : {{ ucwords(strtolower($employees->positionid))}}
                </div>
            </div>
        </div>
        <div class="line">
            <div class="item" style="width: 60%;">
                <div class="title colon" >
                    <span style="min-width: 80px;"> Tax Identity </span>
                    : {{ $employees -> npwp }}
                </div>
            </div>
            <div class="item" style="width: 60%;">
                <div class="title colon">
                    <span style="min-width: 80px;">Grade</span>
                    : {{ $employees -> grade }}
                </div>
            </div>
        </div>
        <div style="border-bottom: 1px solid black; border-top: 1px solid black;" class="line subtitle">
            <div class="item">
                E A R N I N G S
            </div>
            <div class="item">
                D E D U C T I O N S
            </div>
        </div>
        <div class="line">
            <div style="width: 48%; margin: 0 1%;">
                <div class="colon">&nbsp;&nbsp;1. <span>Basic</span>:
                    <div class="rightalign"> {{ number_format($payrollhistory->gajipokok               , 0, ',', '.')}} <br></div></div>
                <div class="colon">&nbsp;&nbsp;2. <span>Positional allowances</span>:
                    <div class="rightalign"> {{ number_format($payrollhistory -> tunjanganjabatan           , 0, ',', '.')}} <br></div></div>
                <div class="colon">&nbsp;&nbsp;3. <span>Meal&Transp. allowances</span>:
                    <div class="rightalign"> {{ number_format($payrollhistory -> tunjanganmakandantransport         , 0, ',', '.')}} <br></div></div>
                <div class="colon">&nbsp;&nbsp;4. <span>Other allowances</span>:
                    <div class="rightalign"> {{ number_format($payrollhistory -> tunjanganlain              , 0, ',', '.')}} <br></div></div>
                <div class="colon">&nbsp;&nbsp;5. <span>Sub-total</span>:
                    <div class="rightalign"> {{ number_format($payrollhistory -> jumlahupahtetap       , 0, ',', '.')}} <br></div></div>
                <div class="colon">&nbsp;&nbsp;6. <span>Percentage</span>:
                    <div class="rightalign"> {{ number_format($payrollhistory -> persenkehadiran       , 2, ',', '.')}}% <br></div></div>
                <div class="colon">&nbsp;&nbsp;7. <span>Actual fixed salaries</span>:
                    <div class="rightalign"> {{ number_format($payrollhistory -> jumlahupahtetapaktual , 0, ',', '.')}} <br></div></div>
                <div class="colon">&nbsp;&nbsp;8. <span>Presence allowance</span>:
                    <div class="rightalign"> {{ number_format($payrollhistory -> jumlahthaktual        , 0, ',', '.')}} <br></div></div>
                <div class="colon">&nbsp;&nbsp;9. <span>Overtime</span>:
                    <div class="rightalign"> {{ number_format($payrollhistory -> jumlahlembur           , 0, ',', '.')}} <br></div></div>
                <div class="colon">10. <span>Transportation for overtime</span>:
                    <div class="rightalign"> {{ number_format($payrollhistory -> jumlahtransportasi    , 0, ',', '.')}} <br></div></div>
                <div class="colon">11. <span>Meal allowance for overtime</span>:
                    <div class="rightalign"> {{ number_format($payrollhistory -> jumlahuangmakanlembur , 0, ',', '.')}} <br></div></div>
                <div class="colon">12. <span>Out of pocket</span>:
                    <div class="rightalign"> {{ number_format($payrollhistory -> jumlahope             , 0, ',', '.')}} <br></div></div>
                <div class="colon">13. <span>Medical reimbursement</span>:
                    <div class="rightalign"> {{ number_format($payrollinput -> jumlahklaimpengobatan , 0, ',', '.')}} <br></div></div>
                <div class="colon">14. <span>Tunjangan Hari Raya</span>:
                    <div class="rightalign"> {{ number_format($payrollinput -> tunjanganhariraya       , 0, ',', '.')}} <br></div></div>
                <div class="colon">15. <span>Insentive</span>:
                    <div class="rightalign"> {{ number_format($payrollinput -> insentif                , 0, ',', '.')}} <br></div></div>
                <div class="colon">16. <span>Bonus</span>:
                    <div class="rightalign"> {{ number_format($payrollinput -> bonus                   , 0, ',', '.')}} <br></div></div>
                {{--<div class="colon">17. <span>Reward</span>:--}}
                    {{--<div class="rightalign"> {{ number_format($payrollinput -> insentifpenghargaan     , 0, ',', '.')}} <br></div></div>--}}
                <div class="colon">17. <span>Correction</span>:
                    <div class="rightalign"> {{ number_format($payrollinput -> koreksipenambahan       , 0, ',', '.')}} <br></div></div>
            </div>
            <div style="width: 48%; margin: 0 1%;">
                <div class="colon">1. &nbsp;<span>Loan Installment</span>:
                    <div class="rightalign"> {{ number_format($payrollinput -> pembayaranpinjaman                 , 0, ',', '.')}} <br></div></div>
                <div class="colon">2. &nbsp;<span>Advance payment</span>:
                    <div class="rightalign"> {{ number_format($payrollinput -> pembayaranterlebihdahulu     , 0, ',', '.')}} <br></div></div>
                <div class="colon">3. &nbsp;<span>BPJS Ketenagakerjaan</span>:
                    <div class="rightalign"> {{ number_format($payrollhistory -> BPJSketenagakerjaan2         , 0, ',', '.')}} <br></div></div>
                <div class="colon">4. &nbsp;<span>BPJS Pensiun</span>:
                    <div class="rightalign"> {{ number_format($payrollhistory -> BPJSpensiun1                 , 0, ',', '.')}} <br></div></div>
                <div class="colon">5. &nbsp;<span>BPJS Kesehatan</span>:
                    <div class="rightalign"> {{ number_format($payrollinput -> bpjskesehatan                , 0, ',', '.')}} <br></div></div>
                <div class="colon">6. &nbsp;<span>Estimated income tax</span>:
                    <div class="rightalign"> {{ number_format($payrollinput -> pphpasal21                   , 0, ',', '.')}} <br></div></div>
                <div class="colon">7.  &nbsp;<span>Correction</span>:
                    <div class="rightalign"> {{ number_format($payrollinput -> koreksipengurangan           , 0, ',', '.')}} <br></div></div>
            </div>
        </div>
        <div class="line subtitle">
            <div style="width: 48%; margin: 0 1%;">
                <div class="colon">18.&nbsp;<span>TOTAL (7-17)</span>:
                    <div class="rightalign">{{ number_format($earningtotal, 0, ',', '.')}} <br></div>
                </div>
            </div>
            <div style="width: 48%; margin: 0 1%;">
                <div class="colon">8.&nbsp;<span>TOTAL (1-9)</span>:
                    <div class="rightalign">{{ number_format($deductiontotal, 0, ',', '.')}} <br></div>
                </div>

            </div>
        </div>
        <div class="line">
            <div style="width: 48%; margin: 0 1%;">
                <b>IMPORTANT:</b><br>
                If there is no objection within 7 days after the slip is received,
                the pay slip is considered as valid and correct.
            </div>
            <div style="width: 48%; margin: 0 1%;">
                <div class="colon"><span>TAKE HOME PAY</span> : {{ number_format($takehomepay, 0, ',', '.')}}
                    <br></div>
                <div class="colon"><span>LOAN DISBURSEMENT</span>
                    : {{ number_format($payrollinput -> pencairanpinjaman           , 0, ',', '.')}} <br></div>
                <div class="colon"><span>DEPOSIT REPAID</span>
                    : {{ number_format($payrollinput -> pengembaliandeposit           , 0, ',', '.')}} <br></div>
                <div class="colon"><span><b>T O T A L</b></span> : {{ number_format($total           , 0, ',', '.')}}
                </div>
            </div>
        </div>
        <div class="line" style="width: 98%; margin: 0 1%;">
            <br>Fasilitas yang diterima:
            @if($payrollinput->bpjsketenagakerjaan == null || $payrollinput->bpjsketenagakerjaan == 0)
                BPJS Ketenagakerjaan |
            @else
                &#10004; BPJS Ketenagakerjaan |
            @endif
            @if($payrollinput->bpjspensiun == null || $payrollinput->bpjspensiun == 0)
                BPJS Pensiun |
            @else
                &#10004; BPJS Pensiun |
            @endif
            @if($payrollinput->bpjskesehatan == null || $payrollinput->bpjskesehatan == 0)
                BPJS Pensiun |
            @else
                &#10004; BPJS Kesehatan
            @endif
        </div>
    </div>

</div>
<a style="position: fixed; bottom: 5px; left: 15px;" href="{{url()->previous() }}"><button class="btn btn-info">Back</button></a>
<script>
    setTimeout(function(){
        window.location.reload(1);
    }, 120000);
</script>
</body>
</html>