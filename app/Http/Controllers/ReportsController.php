<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Input;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Mail;
use Illuminate\Database;



class ReportsController extends Controller{

    public function advancedreport(){
        if (Auth::user()->division === 'HRD' || Auth::user()->division === 'PARTNER' && Auth::user()->admin >= 0) {
            $month = Carbon::now()->month;
            if (\request()->has('kota')) {
                $totals = DB::table('payrollhistory')
                    ->join('masteremployee', 'payrollhistory.nip', '=', 'masteremployee.nip')
                    ->where('periode', '=', $month)
                    ->where('kota', '=', \request('kota'))
                    ->select(DB::raw('sum(takehomepay) as totaltakehomepay'),
                        (DB::raw('sum(penghasilanbruto) as totalpenghasilanbruto')),
                        (DB::raw('sum(penghasilanbrutodisetahunkan) as totalpenghasilanbrutodisetahunkan')),
                        (DB::raw('sum(jumlahklaimakumulasi) as totalklaimakumulasi')),
                        (DB::raw('sum(jumlahpenghasilanrutin) as totalpenghasilanrutin')))
//                'clientid', DB::raw('sum(overtimes - ineffectivehours) as nets'),
//                'clientid', DB::raw('sum(normalhours + overtimes - ineffectivehours) as totals'),
//                'clientid', DB::raw('sum(ineffectivehours) as totalineffectivehours')))
                    ->get();
                $totalitas = DB::table('payrollinput')
                    ->join('masteremployee', 'payrollinput.nip', '=', 'masteremployee.nip')
                    ->where('kota', '=', \request('kota'))
                    ->select(DB::raw('sum(pphpasal21) as totalpph21'))
                    ->get();
            } elseif (\request()->has('institusi')) {
                $totals = DB::table('payrollhistory')
                    ->join('masteremployee', 'payrollhistory.nip', '=', 'masteremployee.nip')
                    ->where('periode', '=', $month)
                    ->where('institusi', '=', \request('institusi'))
                    ->select(DB::raw('sum(takehomepay) as totaltakehomepay'),
                        (DB::raw('sum(penghasilanbruto) as totalpenghasilanbruto')),
                        (DB::raw('sum(penghasilanbrutodisetahunkan) as totalpenghasilanbrutodisetahunkan')),
                        (DB::raw('sum(jumlahklaimakumulasi) as totalklaimakumulasi')),
                        (DB::raw('sum(jumlahpenghasilanrutin) as totalpenghasilanrutin')))
//                'clientid', DB::raw('sum(overtimes - ineffectivehours) as nets'),
//                'clientid', DB::raw('sum(normalhours + overtimes - ineffectivehours) as totals'),
//                'clientid', DB::raw('sum(ineffectivehours) as totalineffectivehours')))
                    ->get();
                $totalitas = DB::table('payrollinput')
                    ->join('masteremployee', 'payrollinput.nip', '=', 'masteremployee.nip')
                    ->where('periode', '=', $month)
                    ->where('institusi', '=', \request('institusi'))
                    ->select(DB::raw('sum(pphpasal21) as totalpph21'))
                    ->get();
            } elseif (\request()->has('periode')) {
                $totals = DB::table('payrollhistory')
                    ->join('masteremployee', 'payrollhistory.nip', '=', 'masteremployee.nip')
                    ->where('periode', '=', \request('periode'))
                    ->select(DB::raw('sum(takehomepay) as totaltakehomepay'),
                        (DB::raw('sum(penghasilanbruto) as totalpenghasilanbruto')),
                        (DB::raw('sum(penghasilanbrutodisetahunkan) as totalpenghasilanbrutodisetahunkan')),
                        (DB::raw('sum(jumlahklaimakumulasi) as totalklaimakumulasi')),
                        (DB::raw('sum(jumlahpenghasilanrutin) as totalpenghasilanrutin')))
//                'clientid', DB::raw('sum(overtimes - ineffectivehours) as nets'),
//                'clientid', DB::raw('sum(normalhours + overtimes - ineffectivehours) as totals'),
//                'clientid', DB::raw('sum(ineffectivehours) as totalineffectivehours')))
                    ->get();
                $totalitas = DB::table('payrollinput')
                    ->join('masteremployee', 'payrollinput.nip', '=', 'masteremployee.nip')
                    ->where('periode', '=', \request('periode'))
                    ->select(DB::raw('sum(pphpasal21) as totalpph21'))
                    ->get();
            } elseif (\request()->has('institusi') && \request()->has('city') && \request()->has('periode')) {
                $totals = DB::table('payrollhistory')
                    ->join('masteremployee', 'payrollhistory.nip', '=', 'masteremployee.nip')
                    ->where('periode', '=', \request('periode'))
                    ->where('kota', '=', \request('kota'))
                    ->where('institusi', '=', \request('institusi'))
                    ->select(DB::raw('sum(takehomepay) as totaltakehomepay'),
                        (DB::raw('sum(penghasilanbruto) as totalpenghasilanbruto')),
                        (DB::raw('sum(penghasilanbrutodisetahunkan) as totalpenghasilanbrutodisetahunkan')),
                        (DB::raw('sum(jumlahklaimakumulasi) as totalklaimakumulasi')),
                        (DB::raw('sum(jumlahpenghasilanrutin) as totalpenghasilanrutin')))
//                'clientid', DB::raw('sum(overtimes - ineffectivehours) as nets'),
//                'clientid', DB::raw('sum(normalhours + overtimes - ineffectivehours) as totals'),
//                'clientid', DB::raw('sum(ineffectivehours) as totalineffectivehours')))
                    ->get();
                $totalitas = DB::table('payrollinput')
                    ->join('masteremployee', 'payrollinput.nip', '=', 'masteremployee.nip')
                    ->where('periode', '=', \request('periode'))
                    ->where('kota', '=', \request('kota'))
                    ->where('institusi', '=', \request('institusi'))
                    ->select(DB::raw('sum(pphpasal21) as totalpph21'))
                    ->get();
            } elseif (\request()->has('solisbatam')) {
                $totals = DB::table('payrollhistory')
                    ->join('masteremployee', 'payrollhistory.nip', '=', 'masteremployee.nip')
                    ->where('periode', '=', $month)
                    ->where('kota', '=', 'batam')
                    ->where('institusi', '=', 'solis')
                    ->select(DB::raw('sum(takehomepay) as totaltakehomepay'),
                        (DB::raw('sum(penghasilanbruto) as totalpenghasilanbruto')),
                        (DB::raw('sum(penghasilanbrutodisetahunkan) as totalpenghasilanbrutodisetahunkan')),
                        (DB::raw('sum(jumlahklaimakumulasi) as totalklaimakumulasi')),
                        (DB::raw('sum(jumlahpenghasilanrutin) as totalpenghasilanrutin')))
//                'clientid', DB::raw('sum(overtimes - ineffectivehours) as nets'),
//                'clientid', DB::raw('sum(normalhours + overtimes - ineffectivehours) as totals'),
//                'clientid', DB::raw('sum(ineffectivehours) as totalineffectivehours')))
                    ->get();
                $totalitas = DB::table('payrollinput')
                    ->join('masteremployee', 'payrollinput.nip', '=', 'masteremployee.nip')
                    ->where('periode', '=', $month)
                    ->where('kota', '=', 'batam')
                    ->where('institusi', '=', 'solis')
                    ->select(DB::raw('sum(pphpasal21) as totalpph21'))
                    ->get();

            } elseif (\request()->has('msidbatam')) {
                $totals = DB::table('payrollhistory')
                    ->join('masteremployee', 'payrollhistory.nip', '=', 'masteremployee.nip')
                    ->where('periode', '=', $month)
                    ->where('kota', '=', 'batam')
                    ->where('institusi', '=', 'msid')
                    ->select(DB::raw('sum(takehomepay) as totaltakehomepay'),
                        (DB::raw('sum(penghasilanbruto) as totalpenghasilanbruto')),
                        (DB::raw('sum(penghasilanbrutodisetahunkan) as totalpenghasilanbrutodisetahunkan')),
                        (DB::raw('sum(jumlahklaimakumulasi) as totalklaimakumulasi')),
                        (DB::raw('sum(jumlahpenghasilanrutin) as totalpenghasilanrutin')))
//                'clientid', DB::raw('sum(overtimes - ineffectivehours) as nets'),
//                'clientid', DB::raw('sum(normalhours + overtimes - ineffectivehours) as totals'),
//                'clientid', DB::raw('sum(ineffectivehours) as totalineffectivehours')))
                    ->get();
                $totalitas = DB::table('payrollinput')
                    ->join('masteremployee', 'payrollinput.nip', '=', 'masteremployee.nip')
                    ->where('periode', '=', $month)
                    ->where('kota', '=', 'batam')
                    ->where('institusi', '=', 'msid')
                    ->select(DB::raw('sum(pphpasal21) as totalpph21'))
                    ->get();

            } elseif (\request()->has('solisjakarta')) {
                $totals = DB::table('payrollhistory')
                    ->join('masteremployee', 'payrollhistory.nip', '=', 'masteremployee.nip')
                    ->where('periode', '=', $month)
                    ->where('kota', '=', 'jakarta')
                    ->where('institusi', '=', 'solis')
                    ->select(DB::raw('sum(takehomepay) as totaltakehomepay'),
                        (DB::raw('sum(penghasilanbruto) as totalpenghasilanbruto')),
                        (DB::raw('sum(penghasilanbrutodisetahunkan) as totalpenghasilanbrutodisetahunkan')),
                        (DB::raw('sum(jumlahklaimakumulasi) as totalklaimakumulasi')),
                        (DB::raw('sum(jumlahpenghasilanrutin) as totalpenghasilanrutin')))
//                'clientid', DB::raw('sum(overtimes - ineffectivehours) as nets'),
//                'clientid', DB::raw('sum(normalhours + overtimes - ineffectivehours) as totals'),
//                'clientid', DB::raw('sum(ineffectivehours) as totalineffectivehours')))
                    ->get();
                $totalitas = DB::table('payrollinput')
                    ->join('masteremployee', 'payrollinput.nip', '=', 'masteremployee.nip')
                    ->where('periode', '=', $month)
                    ->where('kota', '=', 'jakarta')
                    ->where('institusi', '=', 'solis')
                    ->select(DB::raw('sum(pphpasal21) as totalpph21'))
                    ->get();

            } elseif (\request()->has('msidjakarta')) {
                $totals = DB::table('payrollhistory')
                    ->join('masteremployee', 'payrollhistory.nip', '=', 'masteremployee.nip')
                    ->where('periode', '=', $month)
                    ->where('kota', '=', 'jakarta')
                    ->where('institusi', '=', 'msid')
                    ->select(DB::raw('sum(takehomepay) as totaltakehomepay'),
                        (DB::raw('sum(penghasilanbruto) as totalpenghasilanbruto')),
                        (DB::raw('sum(penghasilanbrutodisetahunkan) as totalpenghasilanbrutodisetahunkan')),
                        (DB::raw('sum(jumlahklaimakumulasi) as totalklaimakumulasi')),
                        (DB::raw('sum(jumlahpenghasilanrutin) as totalpenghasilanrutin')))
//                'clientid', DB::raw('sum(overtimes - ineffectivehours) as nets'),
//                'clientid', DB::raw('sum(normalhours + overtimes - ineffectivehours) as totals'),
//                'clientid', DB::raw('sum(ineffectivehours) as totalineffectivehours')))
                    ->get();
                $totalitas = DB::table('payrollinput')
                    ->join('masteremployee', 'payrollinput.nip', '=', 'masteremployee.nip')
                    ->where('periode', '=', $month)
                    ->where('kota', '=', 'jakarta')
                    ->where('institusi', '=', 'msid')
                    ->select(DB::raw('sum(pphpasal21) as totalpph21'))
                    ->get();

            } else {
                $totals = DB::table('payrollhistory')
                    ->where('periode', '=', $month)
                    ->select(DB::raw('sum(takehomepay) as totaltakehomepay'),
                        (DB::raw('sum(penghasilanbruto) as totalpenghasilanbruto')),
                        (DB::raw('sum(penghasilanbrutodisetahunkan) as totalpenghasilanbrutodisetahunkan')),
                        (DB::raw('sum(jumlahklaimakumulasi) as totalklaimakumulasi')),
                        (DB::raw('sum(jumlahpenghasilanrutin) as totalpenghasilanrutin')))
//                'clientid', DB::raw('sum(overtimes - ineffectivehours) as nets'),
//                'clientid', DB::raw('sum(normalhours + overtimes - ineffectivehours) as totals'),
//                'clientid', DB::raw('sum(ineffectivehours) as totalineffectivehours')))
                    ->get();
                $totalitas = DB::table('payrollinput')
                    ->join('masteremployee', 'payrollinput.nip', '=', 'masteremployee.nip')
                    ->where('periode', '=', $month)
                    ->select(DB::raw('sum(pphpasal21) as totalpph21'))
                    ->get();
            }
            $payrolls = DB::table('payrollhistory')->get();


            return view('reports.advancedreporting', ['payrolls' => $payrolls], ['totals' => $totals])
                ->with('totalitas', $totalitas);
        } else {
            return redirect('home');
        }
    }

    public function advancedreporting(){
        if (Auth::user()->division === 'HRD' || Auth::user()->division === 'PARTNER' && Auth::user()->admin >= 0) {


            $sumoverbudgethour = DB::table('mastertimereports')
                ->join('masteremployee', 'mastertimereports.nip', '=', 'masteremployee.nip');
            if (\request()->has('kota')) {
                $sumoverbudgethour->where('kota', '=', \request('kota'));
            }
            if (\request()->has('institusi')) {
                $sumoverbudgethour->where('institusi', '=', \request('institusi'));
            }

            if (\request()->has('periode')) {
                $sumoverbudgethour->where('mastertimereports.period', '=', \request('periode'));
            }
            $sumoverbudgethours = $sumoverbudgethour -> sum('editineffective');


            $sumineffectivehour = DB::table('mastertimereports')
                ->join('masteremployee', 'mastertimereports.nip', '=', 'masteremployee.nip');
            if (\request()->has('kota')) {
                $sumineffectivehour->where('kota', '=', \request('kota'));
            }
            if (\request()->has('institusi')) {
                $sumineffectivehour->where('institusi', '=', \request('institusi'));
            }
            if (\request()->has('periode')) {
                $sumineffectivehour->where('mastertimereports.period', '=', \request('periode'));
            }
            $sumineffectivehours = $sumineffectivehour -> sum('ineffectiverules');

            $sumovertimehour = DB::table('mastertimereports')
                ->join('masteremployee', 'mastertimereports.nip', '=', 'masteremployee.nip');
            if (\request()->has('kota')) {
                $sumovertimehour->where('kota', '=', \request('kota'));
            }
            if (\request()->has('institusi')) {
                $sumovertimehour->where('institusi', '=', \request('institusi'));
            }
            if (\request()->has('periode')) {
                $sumovertimehour->where('mastertimereports.period', '=', \request('periode'));
            }
            $sumovertimehours = $sumovertimehour -> sum('overtimes');

            $sumregularhour = DB::table('mastertimereports')
                ->join('masteremployee', 'mastertimereports.nip', '=', 'masteremployee.nip');
            if (\request()->has('kota')) {
                $sumregularhour->where('kota', '=', \request('kota'));
            }
            if (\request()->has('institusi')) {
                $sumregularhour->where('institusi', '=', \request('institusi'));
            }
            if (\request()->has('periode')) {
                $sumregularhour->where('mastertimereports.period', '=', \request('periode'));
            }
            $sumregularhours = $sumregularhour -> sum('normalhours');
            $professionals = DB::table('mastertimereports')
                ->join('masteremployee', 'mastertimereports.nip', '=', 'masteremployee.nip')
                ->select(
//                    DB::raw('sum(mastertimereporthead.total_hour) as totalhour'),
                    DB::raw('cast(SUM(normalhours) + SUM(overtimes) - SUM(ineffectiverules) as decimal(10,2)) as totalhour'),
                    DB::raw('cast(sum(mastertimereports.overtimes) - sum(mastertimereports.ineffectiverules) as decimal(10,2)) as overtimetotals'),
                    DB::raw('cast(sum(mastertimereports.normalhours) as decimal(10,2)) as regulartotals'),
                    'masteremployee.nip', 'masteremployee.nama as nama')
                ->groupBy('mastertimereports.nip')
                ->orderBy('totalhour', 'desc');
            if (\request()->has('kota')) {
                $professionals->where('kota', '=', \request('kota'));
            }
            if (\request()->has('institusi')) {
                $professionals->where('institusi', '=', \request('institusi'));
            }
            if (\request()->has('periode')) {
                $professionals->where('period', '=', \request('periode'));
            }
            $totalprofessionals = $professionals
                ->get();

            $totals = DB::table('mastertimereports')
                ->leftjoin('masteremployee', 'mastertimereports.nip', '=', 'masteremployee.nip')
                ->leftjoin('masterclients', 'mastertimereports.clientid', '=', 'masterclients.id')
                ->select('masterclients.clientname as clientid','masterclients.clientcode as clientcode', 'masterclients.id as id',
                    DB::raw('cast(SUM(normalhours) + SUM(overtimes) - SUM(ineffectiverules) as decimal(10,2)) as totals'),
                    DB::raw('cast(SUM(normalhours) as decimal(10,2)) as regulartotals'),
                    DB::raw('cast(SUM(overtimes) - SUM(ineffectiverules) as decimal(10,2)) as overtimetotals'),'mastertimereports.period as period', 'masterclients.*')
                ->orderBy('totals', 'desc')
                ->groupBy('mastertimereports.clientid');

            if (\request()->has('kota')) {
                $totals->where('kota', '=', \request('kota'));
            }
            if (\request()->has('institusi')) {
                $totals->where('institusi', '=', \request('institusi'));
            }
            if (\request()->has('periode')) {
                $totals->where('mastertimereports.period', '=', \request('periode'));
            }
            $totalworkhours = $totals
                    ->get();

            $results = DB::table('payrollhistory')
                ->join('masteremployee', 'payrollhistory.nip', '=', 'masteremployee.nip')
                ->select('payrollhistory.*', DB::raw('sum(takehomepay) as totaltakehomepay'),
                    (DB::raw('sum(penghasilanbruto) as totalpenghasilanbruto')),
                    (DB::raw('sum(penghasilanbrutodisetahunkan) as totalpenghasilanbrutodisetahunkan')),
                    (DB::raw('sum(jumlahklaimakumulasi) as totalklaimakumulasi')),
                    (DB::raw('sum(PPHbulanberkaitan) as totalPPHbulanberkaitan')),
                    (DB::raw('sum(kurangbayar) as totalkurangbayar')),
                    (DB::raw('sum(telahdibayarsebelumnya) as totaltelahdibayarsebelumnya')),
                    (DB::raw('sum(penghasilanbruto) as totalpenghasilanbruto')),

                    (DB::raw('sum(jumlahpenghasilanrutin) as totalpenghasilanrutin')));

            if (\request()->has('kota')) {
                $results->where('kota', '=', \request('kota'));
            }
            if (\request()->has('institusi')) {
                $results->where('institusi', '=', \request('institusi'));
            }
            if (\request()->has('periode')) {
                $results->where('periode', '=', \request('periode'));
            }

            $collections = $results
                ->get();

            $totalitas = DB::table('payrollinput')
//            ->where('periode', '=', $month)
                ->select(DB::raw('sum(pphpasal21) as totalpph21'))
                ->get();



            $payrolls = DB::table('payrollhistory')->get();

            $charts = DB::table('payrollhistory')
                ->join('masteremployee', 'payrollhistory.nip', '=', 'masteremployee.nip')
                ->select('payrollhistory.*', DB::raw('sum(takehomepay) as totaltakehomepay'), DB::raw('sum(penghasilanbruto) as totalpenghasilanbruto'))
                ->groupBy('periode')
                ->get();
            foreach ($charts as $chart){
                $periods[] = $chart->periode;
                $takehomepays[] = $chart->totaltakehomepay;
                $grosspays[] = $chart->totalpenghasilanbruto;
            }

            return view('reports.advancedreporting', compact('sumoverbudgethours','sumregularhours','sumovertimehours','sumineffectivehours','collections', 'payrolls', 'periods', 'takehomepays', 'grosspays', 'totalprofessionals', 'totalworkhours', 'totalitas'));
        } else {
            return redirect('home');
        }
    }
    public function payrolldata(){
        if (Auth::user()->division === 'HRD' || Auth::user()->division === 'PARTNER' && Auth::user()->admin >= 0) {
            $biopayaudits = DB::table('masteremployee')->select(DB::raw("DATEDIFF(NOW(),tanggalbergabung) AS datediff"),
                'masteremployee.*')->where('nip', 'like', 'AUD%')->get();
            $biopaytaxs = DB::table('masteremployee')->select(DB::raw("DATEDIFF(NOW(),tanggalbergabung) AS datediff"),
                'masteremployee.*')->where('nip', 'like', 'TAX%')->get();
            $biopayaccs = DB::table('masteremployee')->select(DB::raw("DATEDIFF(NOW(),tanggalbergabung) AS datediff"),
                'masteremployee.*')->where('nip', 'like', 'ACC%')->get();
            $biopayadms = DB::table('masteremployee')->select(DB::raw("DATEDIFF(NOW(),tanggalbergabung) AS datediff"),
                'masteremployee.*')->where('nip', 'like', 'ADM%')->get();
            $institusis = DB::table('masteremployee')
                ->groupBy('institusi')
                ->get();
            $kotas = DB::table('masteremployee')
                ->groupBy('kota')
                ->get();
            $statuses = DB::table('masteremployee')
                ->groupBy('status')
                ->get();
            $posisis = DB::table('masteremployee')
                ->groupBy('positionid')
                ->get();
            $grades = DB::table('masteremployee')
                ->groupBy('grade')
                ->get();
            $grups = DB::table('masteremployee')
                ->groupBy('grup')
                ->get();
            return view('reports.reporting', compact(
                'institusis', 'kotas', 'statuses', 'posisis', 'grades', 'grups','biopayaudits', 'biopaytaxs', 'biopayaccs', 'biopayadms'));
        } else {
            return redirect('home');
        }
    }
    public function payrollhistory(int $year){
        if (Auth::user()->division === 'HRD' || Auth::user()->division === 'PARTNER' && Auth::user()->admin >= 0) {
            $audpayrolls = DB::table('payrollhistory')
                ->join('payrollinput', function ($join) {
                    $join->on('payrollinput.nip', '=', 'payrollhistory.nip')->on('payrollinput.periode', '=', 'payrollhistory.periode');
                })
                ->leftJoin('masteremployee','payrollhistory.nip','=', 'masteremployee.nip')
                ->where('masteremployee.nip', 'like', '%AUD%')
                ->orderBy('masteremployee.nama', 'asc')
                ->orderBy('payrollhistory.periode', 'desc')
                ->get();
            $taxpayrolls = DB::table('payrollhistory')
                ->join('payrollinput', function ($join) {
                    $join->on('payrollinput.nip', '=', 'payrollhistory.nip')->on('payrollinput.periode', '=', 'payrollhistory.periode');
                })
                ->leftJoin('masteremployee','payrollhistory.nip','=', 'masteremployee.nip')
                ->where('masteremployee.nip', 'like', '%TAX%')
                ->orderBy('masteremployee.nama', 'asc')
                ->orderBy('payrollhistory.periode', 'desc')
                ->get();
            $accpayrolls = DB::table('payrollhistory')
                ->join('payrollinput', function ($join) {
                    $join->on('payrollinput.nip', '=', 'payrollhistory.nip')->on('payrollinput.periode', '=', 'payrollhistory.periode');
                })
                ->leftJoin('masteremployee','payrollhistory.nip','=', 'masteremployee.nip')
                ->where('masteremployee.nip', 'like', '%ACC%')
                ->orderBy('masteremployee.nama', 'asc')
                ->orderBy('payrollhistory.periode', 'desc')
                ->get();
            $admpayrolls = DB::table('payrollhistory')
                ->join('payrollinput', function ($join) {
                    $join->on('payrollinput.nip', '=', 'payrollhistory.nip')->on('payrollinput.periode', '=', 'payrollhistory.periode');
                })
                ->leftJoin('masteremployee','payrollhistory.nip','=', 'masteremployee.nip')
                ->where('masteremployee.nip', 'like', '%ADM%')
                ->orderBy('masteremployee.nama', 'asc')
                ->orderBy('payrollhistory.periode', 'desc')
                ->get();
            $institusis = DB::table('masteremployee')
                ->groupBy('institusi')
                ->get();
            $kotas = DB::table('masteremployee')
                ->groupBy('kota')
                ->get();
            $statuses = DB::table('masteremployee')
                ->groupBy('status')
                ->get();
            $posisis = DB::table('masteremployee')
                ->groupBy('positionid')
                ->get();
            $grades = DB::table('masteremployee')
                ->groupBy('grade')
                ->get();
            $grups = DB::table('masteremployee')
                ->groupBy('grup')
                ->get();
            $periodes = DB::table('payrollhistory')
                ->groupBy('periode')
                ->get();

            return view('reports.payrolldatareport', compact('institusis', 'kotas', 'statuses', 'posisis', 'grades', 'grups', 'periodes', 'audpayrolls', 'taxpayrolls', 'accpayrolls', 'admpayrolls'));
        } else {
            return redirect('home');
        }
    }
    public function greenformula(){
        if (Auth::user()->division === 'HRD' || Auth::user()->division === 'PARTNER' && Auth::user()->admin >= 0) {
            $audpayrolls = DB::table('payrollhistory')
                ->join('payrollinput', function ($join) {
                    $join->on('payrollinput.nip', '=', 'payrollhistory.nip')->on('payrollinput.periode', '=', 'payrollhistory.periode');
                })
                ->leftJoin('masteremployee','payrollhistory.nip','=', 'masteremployee.nip')
                ->where('masteremployee.nip', 'like', '%AUD%')
                ->orderBy('masteremployee.nama', 'asc')
                ->orderBy('payrollhistory.periode', 'desc')
                ->orderBy('payrollhistory.created_at', 'desc')
                ->groupBy('payrollhistory.nip')
                ->select('masteremployee.*', 'payrollhistory.*', 'payrollinput.*',
                (DB::raw('sum(payrollhistory.jumlahupahtetapaktual) as akumulasigajipokok')),
                (DB::raw('sum(payrollhistory.jumlahpenghasilantidaktetap) as akumulasitunjangan')),
                (DB::raw('sum(payrollhistory.BPJSketenagakerjaan054) as akumulasibpjsketenaga')),
                (DB::raw('sum(payrollhistory.BPJSkesehatan) as akumulasibpjskesehatan')),
                (DB::raw('sum(payrollhistory.penghasilantidakrutin) as akumulasipenghasilantidakrutin')),
                (DB::raw('sum(payrollinput.bpjspensiun) as akumulasibpjspensiun')),
                (DB::raw('sum(payrollinput.bpjsketenagakerjaan) as akumulasibpjs')),
                (DB::raw('sum(payrollhistory.PPHbulanberkaitan) as akumulasipph')))

                ->get();
            $taxpayrolls = DB::table('payrollhistory')
                ->join('payrollinput', function ($join) {
                    $join->on('payrollinput.nip', '=', 'payrollhistory.nip')->on('payrollinput.periode', '=', 'payrollhistory.periode');
                })
                ->leftJoin('masteremployee','payrollhistory.nip','=', 'masteremployee.nip')
                ->where('masteremployee.nip', 'like', '%TAX%')
                ->orderBy('masteremployee.nama', 'asc')
                ->orderBy('payrollhistory.periode', 'desc')
                ->orderBy('payrollhistory.created_at', 'desc')
                ->groupBy('payrollhistory.nip')
                ->select('masteremployee.*', 'payrollhistory.*', 'payrollinput.*',
                (DB::raw('sum(payrollhistory.jumlahupahtetapaktual) as akumulasigajipokok')),
                (DB::raw('sum(payrollhistory.jumlahpenghasilantidaktetap) as akumulasitunjangan')),
                (DB::raw('sum(payrollhistory.BPJSketenagakerjaan054) as akumulasibpjsketenaga')),
                (DB::raw('sum(payrollhistory.BPJSkesehatan) as akumulasibpjskesehatan')),
                (DB::raw('sum(payrollhistory.penghasilantidakrutin) as akumulasipenghasilantidakrutin')),
                (DB::raw('sum(payrollinput.bpjspensiun) as akumulasibpjspensiun')),
                (DB::raw('sum(payrollinput.bpjsketenagakerjaan) as akumulasibpjs')),
                (DB::raw('sum(payrollhistory.PPHbulanberkaitan) as akumulasipph')))
                ->groupBy('payrollhistory.nip')
                ->get();
            $accpayrolls = DB::table('payrollhistory')
                ->join('payrollinput', function ($join) {
                    $join->on('payrollinput.nip', '=', 'payrollhistory.nip')->on('payrollinput.periode', '=', 'payrollhistory.periode');
                })
                ->leftJoin('masteremployee','payrollhistory.nip','=', 'masteremployee.nip')
                ->where('masteremployee.nip', 'like', '%ACC%')
                ->orderBy('masteremployee.nama', 'asc')
                ->orderBy('payrollhistory.periode', 'desc')
                ->orderBy('payrollhistory.created_at', 'desc')
                ->groupBy('payrollhistory.nip')
                 ->select('masteremployee.*', 'payrollhistory.*', 'payrollinput.*',
                (DB::raw('sum(payrollhistory.jumlahupahtetapaktual) as akumulasigajipokok')),
                (DB::raw('sum(payrollhistory.jumlahpenghasilantidaktetap) as akumulasitunjangan')),
                (DB::raw('sum(payrollhistory.BPJSketenagakerjaan054) as akumulasibpjsketenaga')),
                (DB::raw('sum(payrollhistory.BPJSkesehatan) as akumulasibpjskesehatan')),
                (DB::raw('sum(payrollhistory.penghasilantidakrutin) as akumulasipenghasilantidakrutin')),
                (DB::raw('sum(payrollinput.bpjspensiun) as akumulasibpjspensiun')),
                (DB::raw('sum(payrollinput.bpjsketenagakerjaan) as akumulasibpjs')),
                (DB::raw('sum(payrollhistory.PPHbulanberkaitan) as akumulasipph')))
                ->groupBy('payrollhistory.nip')
                ->get();
            $admpayrolls = DB::table('payrollhistory')
                ->join('payrollinput', function ($join) {
                    $join->on('payrollinput.nip', '=', 'payrollhistory.nip')->on('payrollinput.periode', '=', 'payrollhistory.periode');
                })
                ->leftJoin('masteremployee','payrollhistory.nip','=', 'masteremployee.nip')
                ->where('masteremployee.nip', 'like', '%ADM%')
                ->orderBy('masteremployee.nama', 'asc')
                ->orderBy('payrollhistory.periode', 'desc')
                ->orderBy('payrollhistory.created_at', 'desc')
                ->groupBy('payrollhistory.nip')
                 ->select('masteremployee.*', 'payrollhistory.*', 'payrollinput.*',
                (DB::raw('sum(payrollhistory.jumlahupahtetapaktual) as akumulasigajipokok')),
                (DB::raw('sum(payrollhistory.jumlahpenghasilantidaktetap) as akumulasitunjangan')),
                (DB::raw('sum(payrollhistory.BPJSketenagakerjaan054) as akumulasibpjsketenaga')),
                (DB::raw('sum(payrollhistory.BPJSkesehatan) as akumulasibpjskesehatan')),
                (DB::raw('sum(payrollhistory.penghasilantidakrutin) as akumulasipenghasilantidakrutin')),
                (DB::raw('sum(payrollinput.bpjspensiun) as akumulasibpjspensiun')),
                (DB::raw('sum(payrollinput.bpjsketenagakerjaan) as akumulasibpjs')),
                (DB::raw('sum(payrollhistory.PPHbulanberkaitan) as akumulasipph')))
                ->groupBy('payrollhistory.nip')
                ->get();
                $allpayrolls = DB::table('payrollhistory')
                ->join('payrollinput', function ($join) {
                    $join->on('payrollinput.nip', '=', 'payrollhistory.nip')->on('payrollinput.periode', '=', 'payrollhistory.periode');
                })
                ->leftJoin('masteremployee','payrollhistory.nip','=', 'masteremployee.nip')
                ->orderBy('masteremployee.nama', 'asc')
                ->orderBy('payrollhistory.periode', 'desc')
                ->orderBy('payrollhistory.created_at', 'desc')
                ->groupBy('payrollhistory.nip')
                 ->select('masteremployee.*', 'payrollhistory.*', 'payrollinput.*',
                (DB::raw('sum(payrollhistory.jumlahupahtetapaktual) as akumulasigajipokok')),
                (DB::raw('sum(payrollhistory.jumlahpenghasilantidaktetap) as akumulasitunjangan')),
                (DB::raw('sum(payrollhistory.BPJSketenagakerjaan054) as akumulasibpjsketenaga')),
                (DB::raw('sum(payrollhistory.BPJSkesehatan) as akumulasibpjskesehatan')),
                (DB::raw('sum(payrollhistory.penghasilantidakrutin) as akumulasipenghasilantidakrutin')),
                (DB::raw('sum(payrollinput.bpjspensiun) as akumulasibpjspensiun')),
                (DB::raw('sum(payrollinput.bpjsketenagakerjaan) as akumulasibpjs')),
                (DB::raw('sum(payrollhistory.PPHbulanberkaitan) as akumulasipph')))
                ->groupBy('payrollhistory.nip')
                ->get();
            $institusis = DB::table('masteremployee')
                ->groupBy('institusi')
                ->get();
            $kotas = DB::table('masteremployee')
                ->groupBy('kota')
                ->get();
            $statuses = DB::table('masteremployee')
                ->groupBy('status')
                ->get();
            $posisis = DB::table('masteremployee')
                ->groupBy('positionid')
                ->get();
            $grades = DB::table('masteremployee')
                ->groupBy('grade')
                ->get();
            $grups = DB::table('masteremployee')
                ->groupBy('grup')
                ->get();
            $periodes = DB::table('payrollhistory')
                ->groupBy('periode')
                ->get();

            return view('reports.greenformula', compact('institusis', 'kotas', 'statuses', 'posisis', 'grades', 'grups', 'periodes', 'audpayrolls', 'taxpayrolls', 'accpayrolls', 'admpayrolls', 'allpayrolls'));
        } else {
            return redirect('home');
        }
    }
    public function biodata(){

            $empbios = DB::table('masterbiodata')
                ->leftJoin('masteremployee', 'masterbiodata.nip', '=', 'masteremployee.nip')
                ->select('masteremployee.*', 'masterbiodata.*', 'masteremployee.nip as nip', 'masteremployee.id as id')
                ->get();

            return view('reports.employeebiodatareport', ['empbios' => $empbios]);
    }

    public function timereport(){
        if (Auth::user()->division === 'HRD' || Auth::user()->division === 'PARTNER' && Auth::user()->admin >= 0) {
            $thisyear = Carbon::now()->year;
            $timereports = DB::table('mastertimereports')
                    ->leftJoin('masterclients', 'mastertimereports.clientid', '=', 'masterclients.id')
                    ->leftJoin('masteremployee', 'mastertimereports.nip', '=', 'masteremployee.nip')
                    ->selectRaw('SUM(mastertimereports.normalhours) as normalhours, SUM(mastertimereports.overtimes) as overtimes
            ,SUM(mastertimereports.ineffectivehours) as ineffectivehours,  SUM(mastertimereports.editineffective) as editineffective , SUM(mastertimereports.overtimemeal) as overtimemeal
            ,SUM(mastertimereports.overtimetransportation) as overtimetransportation, masteremployee.nama as nama, mastertimereports.date as date
            ,masteremployee.institusi as institusi, masteremployee.kota as kota, masteremployee.grup as grup, masteremployee.positionid as position
            ,masteremployee.nip as nip');
            
            if (\request()->has('week') && \request()->has('month')) {
                $timereports = $timereports->whereMonth('mastertimereports.date', \request('month'));
            } if (\request()->has('week') && \request()->has('week')) {
                $timereports = $timereports->where('mastertimereports.week', '=', \request('week'));
            } 
            if (\request()->has('startdate') && \request()->has('enddate')) {
                $timereports = $timereports->whereBetween('date', [\request('startdate'), \request('enddate')]);
            } 
                
            $timereports = $timereports->orderBy('mastertimereports.created_at', 'desc')
            ->groupBy('mastertimereports.nip')
            ->get();
    
            $institusis = DB::table('masteremployee')
                ->groupBy('institusi')
                ->get();
            $kotas = DB::table('masteremployee')
                ->groupBy('kota')
                ->get();
            $statuses = DB::table('masteremployee')
                ->groupBy('status')
                ->get();
            $posisis = DB::table('masteremployee')
                ->groupBy('positionid')
                ->get();
            $grades = DB::table('masteremployee')
                ->groupBy('grade')
                ->get();
            $grups = DB::table('masteremployee')
                ->groupBy('grup')
                ->get();
            $periods = DB::table('mastertimereports')
                ->groupBy('period')
                ->get();

                if (\request()->has('period')) {
                    $month = \request('period');
                }else{
                    $month = Carbon::now()->format('m');
                }

            return view('reports.timereportreporting', compact('periods', 'institusis', 'kotas', 'statuses', 'posisis', 'grades', 'grups', 'month'), ['timereports' => $timereports]);
        } else {

            echo "<div style=\"display: flex;
                           flex-direction: column;
                           justify-content: center;
                           align-self: center\">";
            echo "<div style=\"padding: 20px;
                           border-radius: 10px;
                           background-color: royalblue;
                           color: white;
                           text-align: center;
                           \">";
            echo "You're not allowed to see this page. Please contact developer";
            echo "</div>";
            echo "</div>";
            sleep(2);
            return redirect('home');
        }
    }

}
