<?php

namespace App\Http\Controllers;

use App\Events\NewLeaveRequest;
use App\Exports\TimeReportExport;
use App\Exports\IndTimeReportExport;
use App\Exports\GreenFormulaExport;

use App\Exports\PayrollDataExport;
use App\Exports\PayrollHistoryExport;

use App\File;
use App\LeaveRequest;
use App\Mail\Notifications;
use App\MasterClient;
use App\MasterEmployee;
use App\MasterManualInput;
use App\MasterTask;
use App\TimeReport;
use App\TimeReportHead;
use App\DeletedTimeReport;
use App\MasterPayrollHistory;

use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Support\Facades\Input;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Mail;
use Illuminate\Database;
use Maatwebsite\Excel\Facades\Excel;


class ExportController extends Controller
{
    

    public function downloadgreenformula(Request $request)
    {
        return (new GreenFormulaExport())->sendPara($request)->download('greenformula.xlsx');
    }
    
    public function downloadtimereport(Request $request)
    {
        switch ($request->input('action')) {
            case 'xls':

                if ($request->nip == null) {
                    return (new TimeReportExport())->sendPara($request)->download('timereport-' . Carbon::now() .
                        ' Week' . $request->week .
                        ' Period' . $request->period .
                        ' ' . $request->institusion .
                        ' ' . $request->city .
                        ' ' . $request->status .
                        ' ' . $request->positionid .
                        ' ' . $request->grade .
                        ' ' . $request->group .
                        '.xlsx');
                } else {
                    $user = MasterEmployee::where('nip', $request->nip)->first();
                    return (new TimeReportExport())->sendPara($request)->download('timereport-' . $user->nama . '-' . Carbon::now() . '.xls');
                }
                break;

            case 'print':

                $thisyear = Carbon::now()->year;
                $week = $request->week;
                $month = $request->month;
                $startdate = $request->startdate;
                $enddate = $request->enddate;


                if ($request->has('nip')) {

                    $results = TimeReport::query()
                        ->leftJoin('masterclients', 'mastertimereports.clientid', '=', 'masterclients.id')
                        ->leftJoin('masteremployee', 'mastertimereports.nip', '=', 'masteremployee.nip')
                        ->leftJoin('mastertasks', 'mastertimereports.task', '=', 'mastertasks.id')
                        ->select('mastertimereports.date', 'mastertimereports.normalhours',
                            DB::raw('(mastertimereports.overtimes - ineffectiverules) as overtimes'), 'mastertimereports.editineffective',
                            'mastertimereports.overtimemeal',
                            'mastertimereports.overtimetransportation',
                            'mastertimereports.period', 'mastertimereports.description', 'mastertasks.taskname',
                            'masterclients.clientname', 'masterclients.clientcode');

                } else {
                    $results = TimeReport::query()
                        ->leftJoin('masterclients', 'mastertimereports.clientid', '=', 'masterclients.id')
                        ->leftJoin('masteremployee', 'mastertimereports.nip', '=', 'masteremployee.nip')
                        ->leftJoin('mastertasks', 'mastertimereports.task', '=', 'mastertasks.id')
                        ->select('masteremployee.nip', 'masteremployee.nama', 'masteremployee.institusi',
                            'masteremployee.kota', 'masteremployee.positionid', 'masteremployee.grup',
                            'mastertimereports.date', 'mastertimereports.normalhours',
                            DB::raw('(mastertimereports.overtimes - ineffectiverules) as overtimes'), 'mastertimereports.editineffective',
                            'mastertimereports.overtimemeal',
                            'mastertimereports.overtimetransportation',
                            'mastertimereports.period', 'mastertimereports.description', 'mastertasks.taskname',
                            'masterclients.clientname', 'masterclients.clientcode');
                }
                if ($request->has('nip')) {
                    $results->where('mastertimereports.nip', '=', $request->nip);
                }
                if ($request->has('week')) {
                    $results->where('mastertimereports.week', '=', $request->week);
                }
                if ($request->has('period')) {
                    $results->where('mastertimereports.period', '=', $request->period);
                }
                if ($request->has('month')) {
                    $results->whereMonth('date', '=', $request->month);
                }
                if ($request->has('startdate') && $request->has('enddate')) {
                    $results->whereBetween('date', [$startdate, $enddate]);
                }
                if ($request->has('institusi')) {
                    $results->where('masteremployee.institusi', '=', $request->institusi);
                }
                if ($request->has('kota')) {
                    $results->where('masteremployee.kota', '=', $request->kota);
                }
                if ($request->has('status')) {
                    $results->where('masteremployee.status', '=', $request->status);
                }
                if ($request->has('positionid')) {
                    $results->where('masteremployee.positionid', '=', $request->positionid);
                }
                if ($request->has('grade')) {
                    $results->where('masteremployee.grade', '=', $request->grade);
                }
                if ($request->has('group')) {
                    $results->where('grup', '=', $request->group);
                }
                if ($request->has('period')) {

                    $results->where('period', '=', $request->period);
                }
                $timereports = $results
                    ->orderBy('mastertimereports.date', 'asc')
                    ->get();
                $user = MasterEmployee::where('nip', $request->nip)->first();

                return view('print.indtimereport', compact('timereports', 'request', 'user'));
                break;

        }
        return redirect('home');

    }

    public function downloadpayrolldata(Request $request)
    {

        switch ($request->input('action')) {
            case 'xls':
                return (new PayrollDataExport())->sendPara($request)->download();
                break;
            case 'print':
                $results = MasterEmployee::select(
                    'nip',
                    'nama',
                    'institusi',
                    'kota',
                    'tanggalbergabung',
                    'status',
                    'positionid',
                    'lembur',
                    'grade',
                    'grup',
                    'norek',
                    'npwp',
                    'statusptkp',
                    'gajipokok',
                    'tunjanganjabatan',
                    'tunjangankesehatan',
                    'tunjanganlain',
                    'tarifthhari',
                    'tariftransportasi',
                    'tarifmakanlembur',
                    'persenbpjskesehatan'
                );
                if ($request->has('institusi')) {
                    $results->where('institusi', '=', $request->institusi);
                }
                if ($request->has('kota')) {
                    $results->where('kota', '=', $request->kota);
                }
                if ($request->has('status')) {
                    $results->where('status', '=', $request->status);
                }
                if ($request->has('positionid')) {
                    $results->where('positionid', '=', $request->positionid);
                }
                if ($request->has('grade')) {
                    $results->where('grade', '=', $request->grade);
                }
                if ($request->has('group')) {
                    $results->where('grup', '=', $request->group);
                }
                $collections = $results->get();

                return view('print.payrolldata', compact('collections', 'request'));
                break;
        }
    }

    public function downloadpayrollhistory(Request $request)
    {
        switch ($request->input('action')) {
            case 'xls':
                return (new PayrollHistoryExport())->sendPara($request)->download();
                break;
            case 'print':
                $results = MasterPayrollHistory::query()
                    ->join('masteremployee', 'payrollhistory.nip', '=', 'masteremployee.nip')
                    ->join('payrollinput', 'payrollhistory.nip', '=', 'payrollinput.nip');

                if ($request->has('institusi')) {
                    $results->where('institusi', '=', $request->institusi);
                }
                if ($request->has('kota')) {
                    $results->where('kota', '=', $request->kota);
                }
                if ($request->has('status')) {
                    $results->where('status', '=', $request->status);
                }
                if ($request->has('positionid')) {
                    $results->where('positionid', '=', $request->positionid);
                }
                if ($request->has('grade')) {
                    $results->where('grade', '=', $request->grade);
                }
                if ($request->has('group')) {
                    $results->where('grup', '=', $request->group);
                }
                if ($request->has('period')) {

                    $results->where('payrollhistory.periode', '=', $request->period);
                }
                if ($request->has('nip')) {

                    $results->where('payrollhistory.nip', '=', $request->nip);
                }
                $collections = $results->get();

                return view('print.payrolldata', compact('collections', 'request'));
                break;
        }
    }

}
