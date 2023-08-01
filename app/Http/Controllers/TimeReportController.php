<?php

namespace App\Http\Controllers;

use App\Events\NewLeaveRequest;
use App\Exports\TimeReportExport;
use App\Exports\IndTimeReportExport;
use App\Exports\TimeReportBulkTemplateExport;
use App\Exports\PayrollDataExport;
use App\Exports\PayrollHistoryExport;

use App\File;
use App\LeaveRequest;
use App\Mail\Notifications;
use App\User;
use App\MasterClient;
use App\MasterEmployee;
use App\MasterManualInput;
use App\MasterTask;
use App\TimeReport;
use App\TimeReportHead;
use App\DeletedTimeReport;
use App\Exports\TimeReportBulkEditExport;
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
use App\Imports\OverbudgetImport;
use App\Imports\TimeReportImport;
use App\Statuses;
use Illuminate\Support\Facades\Mail;
use Illuminate\Database;
use Maatwebsite\Excel\Facades\Excel;

use function App\getDateByWeeks;
use function App\getEndPeriod;
use function App\getPeriod;
use function App\getStartPeriod;
use function App\isReportLocked;

class TimeReportController extends Controller
{
    public function create()
    {
        $thismonthshow = Carbon::now();
        $thismonth = Carbon::now()->month;

        $id = Auth::id();
        $employee = MasterEmployee::where('nip', Auth::user()->nip)->first();

        // if (Auth::user()->logintype === 'professionalaudit') {
        //     $clients = MasterClient::orderBy('clientcode')->where('institusi', 'MSId')->get();
        // } elseif (Auth::user()->logintype === 'professionalaccounting' || Auth::user()->logintype === 'professionaltax') {
        //     $clients = MasterClient::orderBy('clientcode')->where('institusi', 'solis')->get();
        // } else {
        //     $clients = MasterClient::orderBy('clientcode')->where('institusi', 'MSId')->get();
        //     // $clients = null;
        // }
        $clients = MasterClient::join('client_delegations', 'masterclients.id', '=', 'client_delegations.client_id')
            ->join('groups', 'groups.id', '=', 'client_delegations.group_id')
            ->where('groups.id', $employee->divisi)
            ->get();

        if (Auth::user()->logintype === 'professionalaudit') {
            $tasks = MasterTask::where('division', 'aud');
        } elseif (Auth::user()->logintype === 'professionalaccounting') {
            $tasks = MasterTask::where('division', 'acc');
        } elseif (Auth::user()->logintype === 'professionaltax') {
            $tasks = MasterTask::where('division', 'tax');
        } elseif (Auth::user()->logintype === 'nonprofessional') {
            $tasks = MasterTask::where('division', 'adm')->where('group_id', $employee->divisi);
        }
        
        
        $statuses = Statuses::where('nip', Auth::user()->nip);

        $tasks = $tasks->get();

        return view('inputtimereport', ['tasks' => $tasks, 'employee' => $employee, 'statuses' => $statuses])
            ->with('id', $id)
            ->with('clients', $clients)
            ->with('thismonth', $thismonth)
            ->with('thismonthshow', $thismonthshow);
    }

    public function reportdetail($id)
    {

        $user = DB::table('mastertimereports')
            ->leftJoin('masterclients', 'mastertimereports.clientid', '=', 'masterclients.id')
            ->leftJoin('masteremployee', 'mastertimereports.nip', '=', 'masteremployee.nip')
            ->where('mastertimereports.nip', '=', $id)
            ->groupBy('mastertimereports.clientid')
            ->first();
        $reportdetails = DB::table('mastertimereports')
            ->join('masterclients', 'mastertimereports.clientid', '=', 'masterclients.id')
            ->join('masteremployee', 'mastertimereports.nip', '=', 'masteremployee.nip')
            ->select('mastertimereports.*', 'masteremployee.*', 'masterclients.*', 'masterclients.clientcode as clientcode', 'mastertimereports.id as id')
            ->where('mastertimereports.nip', '=', $id);
        if (\request()->has('period')) {
            $reportdetails = $reportdetails->where('period', \request('period'));
        }
        $reportdetails = $reportdetails->get();
        $periods = DB::table('mastertimereports')
            ->groupBy('period')
            ->get();
        if (\request()->has('period')) {
            $month = \request('period');
        } else {
            $month = Carbon::now()->format('m');
        }

        return view('timereportdetail', compact('reportdetails', 'user', 'periods', 'month'))
            ->with('id', $id);
    }


    public function editoverbudget(Request $request, $id, $timereportid)
    {
        $timereport = DB::table('mastertimereports')->where('id', '=', $timereportid)->first();
        $timereporthead = DB::table('mastertimereporthead')->where('report_date', '=', $timereport->date)->first();
        $day_of_week = date('l', strtotime($timereport->date));
        $day = date('N', strtotime($day_of_week));
        $employeedata = MasterEmployee::where('nip', '=', $id)->first();
        $regularaccumulation = DB::table('mastertimereports')
            ->where('nip', '=', $id)
            ->where('date', '=', $timereport->date)
            ->sum('normalhours');
        $overtimeaccumulation = DB::table('mastertimereports')
            ->where('nip', '=', $id)
            ->where('date', '=', $timereport->date)
            ->sum('overtimes');
        $overbudgetaccumulation = DB::table('mastertimereports')
            ->where('nip', '=', $id)
            ->where('date', '=', $timereport->date)
            ->sum('ineffectivehours');
        $checkovertime = $overtimeaccumulation - $overbudgetaccumulation - $request->editineffective;

        if ($day < 6) {
            if ($checkovertime >= 2.5 && $checkovertime < 3.5) {
                $overtimemeal = $employeedata->tarifmakanlembur;
                $overtimetransportation = 0;
            } elseif ($checkovertime >= 3.5) {
                $overtimemeal = $employeedata->tarifmakanlembur;
                $overtimetransportation = $employeedata->tariftransportasi;
            } elseif ($checkovertime < 2.5) {
                $overtimemeal = 0;
                $overtimetransportation = 0;
            }
        } elseif ($day > 5) {
            if ($checkovertime >= 2.25 && $checkovertime < 12.25) {
                $overtimemeal = $employeedata->tarifmakanlembur;
                $overtimetransportation = 0;
            } elseif ($checkovertime >= 12.25) {
                $overtimemeal = $employeedata->tarifmakanlembur;
                $overtimetransportation = $employeedata->tariftransportasi;
            } elseif ($checkovertime < 2.25) {
                $overtimemeal = 0;
                $overtimetransportation = 0;
            }
        }
        $seeovertime = DB::table('mastertimereports')->where('date', '=', Carbon::parse($timereport->date))
            ->where('nip', '=', $id)->sum('overtimes');

        if ($timereport->overtimes == null) {
            $overtime = 0;
            $ineffectiverules = 0;
        } else {
            if ($seeovertime >= 2) {
                if ($day >= 6 && $timereport->overtimes >= 0) {
                    $ineffectiverules = 0.75;
                } elseif ($day < 6 && $timereport->overtimes >= 0) {
                    $ineffectiverules = 0.50;
                }
            } else {
                if ($day >= 6 && $timereport->overtimes >= 0) {
                    $ineffectiverules = 0;
                } elseif ($day < 6 && $timereport->overtimes >= 0) {
                    $ineffectiverules = 0;
                }
            }
        }

        $inputtimereport = DB::table('mastertimereports')
            ->where('id', $timereportid)
            ->update([
                'editineffective' => $request->editineffective,
                'overtimemeal' => $overtimemeal,
                'overtimetransportation' => $overtimetransportation,
                'ineffectivehours' => $ineffectiverules,
                'editedby' => Auth::user()->nip
            ]);

        $timereportheadid = $timereporthead->id;
        $inputtimereporthead = TimeReportHead::find($timereportheadid);
        $inputtimereporthead->total_hour = $timereporthead->total_hour + $request->editineffective - $timereport->editineffective + $timereport->ineffectiverules;
        $inputtimereporthead->overtimemeal = $overtimemeal;
        $inputtimereporthead->overtimetransportation = $overtimetransportation;
        $inputtimereporthead->save();


        if (Auth::user()->division === "PARTNER" || Auth::user()->division === "HRD") {
            return redirect('/partner/reporting/timereport/detail/' . $id);
        } else {
            return redirect('/timesheets/detail/');
        }
    }

    public function timesheetdetail($date = null, $year = null)
    {
        $usernip = Auth::user()->nip;
        $masteremployees = DB::table('masteremployee')->where('nip', '=', $usernip)->first();
        $inchargestatus = $masteremployees->inchargestatus;
        $divisi = $masteremployees->divisi;
        $downloadtimereports = DB::table('mastertimereports')
            ->join('mastertimereporthead', 'mastertimereports.timereportheadid', '=', 'mastertimereporthead.id')
            ->join('mastertasks', 'mastertimereports.task', '=', 'mastertasks.id')
            ->join('masterclients', 'mastertimereports.clientid', '=', 'masterclients.id')
            ->join('masteremployee', 'mastertimereports.nip', '=', 'masteremployee.nip')
            ->select(
                DB::raw('MONTH(mastertimereports.date) as monthly'),
                DB::raw('mastertimereports.week as week'),
                DB::raw('masteremployee.nama as nama'),
                DB::raw('mastertimereports.nip as nip')
            )
            ->groupBy('nip')
            ->orderBy('mastertimereports.date', 'desc')
            ->where('masteremployee.divisi', $divisi)
            ->get();

        if ($inchargestatus == 0) {
            $timereports = DB::table('mastertimereports')
                ->where('nip', '=', $usernip)->orderBy('mastertimereports.date', 'desc')
                ->select(
                    'mastertimereports.*',
                    DB::raw('(ineffectiverules + editineffective) as ineffective')
                )
                ->orderBy('mastertimereports.date', 'desc');
            $timereports = $timereports->get();
        } elseif ($inchargestatus == 1) {
            $timereports = DB::table('mastertimereports')
                ->join('masteremployee', 'mastertimereports.nip', '=', 'masteremployee.nip')
                ->where('masteremployee.divisi', '=', $divisi)->orderBy('mastertimereports.date', 'desc')
                ->select(
                    'masteremployee.*',
                    'mastertimereports.id as id',
                    'mastertimereports.*',
                    DB::raw('(ineffectiverules + editineffective) as ineffective')
                )
                ->orderBy('mastertimereports.date', 'desc');
            $timereports = $timereports->get();
        }

        $members = MasterEmployee::where('divisi', $divisi)->get();

        return view('timesheetsmenudetail', compact('timereports', 'inchargestatus', 'downloadtimereports', 'members'));
    }

    public function timesheetmain()
    {
        $usernip = Auth::user()->nip;
        $masteremployees = DB::table('masteremployee')->where('nip', '=', $usernip)->first();
        $inchargestatus = $masteremployees->inchargestatus;
        $divisi = $masteremployees->divisi;
        $downloadtimereports = DB::table('mastertimereports')
            ->join('mastertimereporthead', 'mastertimereports.timereportheadid', '=', 'mastertimereporthead.id')
            ->join('mastertasks', 'mastertimereports.task', '=', 'mastertasks.id')
            ->join('masterclients', 'mastertimereports.clientid', '=', 'masterclients.id')
            ->join('masteremployee', 'mastertimereports.nip', '=', 'masteremployee.nip')
            ->select(
                DB::raw('MONTH(mastertimereports.date) as monthly'),
                DB::raw('mastertimereports.week as week'),
                DB::raw('masteremployee.nama as nama'),
                DB::raw('mastertimereports.nip as nip')
            )
            ->groupBy('nip')
            ->where('masteremployee.divisi', $divisi)
            ->get();

        if ($inchargestatus == 0) {
            $timereports = DB::table('mastertimereporthead')
                ->join('mastertimereports', 'mastertimereporthead.id', '=', 'mastertimereports.timereportheadid')
                ->select(
                    DB::raw('SUM(normalhours) as normalhours'),
                    DB::raw('SUM(ineffectivehours) as ineffectivehours'),
                    DB::raw('SUM(overtimes) as overtimes'),
                    DB::raw('(SUM(ineffectiverules) + SUM(editineffective)) as ineffective'),
                    DB::raw('mastertimereports.date as date'),
                    DB::raw('mastertimereports.week as week'),
                    DB::raw('MONTH(mastertimereports.date) as monthly'),
                    DB::raw('SUM(mastertimereporthead.overtimemeal) as overtimemeal'),
                    DB::raw('SUM(mastertimereporthead.overtimetransportation) as overtimetransportation'),
                    DB::raw('mastertimereports.id as timereportid'),
                    DB::raw('mastertimereports.task as task')
                )
                //                ->groupBy('mastertimereports.timereportheadid', 'mastertimereports.week', 'monthly')
                ->groupBy('mastertimereports.date')
                ->orderBy('mastertimereports.date', 'desc')
                ->where('mastertimereports.nip', '=', Auth::user()->nip)->get();
        } elseif ($inchargestatus == 1) {
            $timereports =
                DB::table('mastertimereporthead')
                ->join('mastertimereports', 'mastertimereporthead.id', '=', 'mastertimereports.timereportheadid')
                ->join('masteremployee', 'mastertimereports.nip', '=', 'masteremployee.nip')
                ->select(
                    DB::raw('SUM(normalhours) as normalhours'),
                    DB::raw('SUM(ineffectivehours) as ineffectivehours'),
                    DB::raw('(SUM(ineffectiverules) + SUM(editineffective)) as ineffective'),
                    DB::raw('SUM(overtimes) as overtimes'),
                    DB::raw('mastertimereports.date as date'),
                    DB::raw('MONTH(mastertimereports.date) as monthly'),
                    DB::raw('mastertimereports.week as week'),
                    DB::raw('SUM(mastertimereporthead.overtimemeal) as overtimemeal'),
                    DB::raw('SUM(mastertimereporthead.overtimetransportation) as overtimetransportation'),
                    DB::raw('masteremployee.nama as nama'),
                    DB::raw('mastertimereports.id as timereportid'),
                    DB::raw('mastertimereports.task as task')
                )
                ->groupBy('mastertimereporthead.user_nip', 'mastertimereports.date')
                ->orderBy('mastertimereports.date', 'desc')
                ->where('masteremployee.divisi', '=', $divisi)->orderBy('date', 'asc')->get();
        }
        $members = MasterEmployee::where('divisi', $divisi)->get();

        return view('timesheetsmenumain', compact('timereports', 'inchargestatus', 'divisi', 'masteremployees', 'downloadtimereports', 'members'));
    }

    public function setAsUnlocked($id)
    {
        $statuses = Statuses::find($id);
        $statuses->setAsUnlocked();
        return redirect()->back();
    }

    public function setAsLocked($id)
    {
        $statuses = Statuses::find($id);
        $statuses->setAsLocked();
        return redirect()->back();
    }

    public function approveByPeriod($period, $nip)
    {
        $timereport = new TimeReport();
        $timereport->approveByPeriod($period, $nip);

        if (Auth::user()->division === "PARTNER" || Auth::user()->division === "HRD") {
            return redirect('/partner/reporting/timereport/detail/' . $nip);
        } else {
            return redirect('/timesheets/detail/');
        }
    }
    public function approveAllByPeriod(int $period)
    {
        if (\request()->has('periode')) {
            if (\request('periode') == 0) {
            } else {
                $period = \request()->has('periode');
            }
        }
        $timereport = new TimeReport();
        $timereport->approveAllByPeriod($period);

        if (Auth::user()->division === "PARTNER" || Auth::user()->division === "HRD") {
            return redirect('/partner/reporting/timereport/');
        } else {
            return redirect('/timesheets/detail/');
        }
    }

    public function inchargeApproval($id)
    {
        $timereport = TimeReport::find($id);
        $timereport->approvedByIncharge($id);

        return redirect('/timesheets/detail');
    }

    public function hrApproval($id)
    {
        $timereport = TimeReport::find($id);
        $timereport->approvedByHR($id);

        return redirect()->back();
    }

    public function partnerApproval($id)
    {
        $timereport = TimeReport::find($id);
        $timereport->approvedByPartner($id);

        return redirect()->back();
    }

    public function deletetimereport($id)
    {
        $olddata = DB::table('mastertimereports')->where('id', $id)->first();

        $timereports = new DeletedTimeReport();

        $timereports->date = $olddata->date;
        $timereports->day = $olddata->day;
        $timereports->week = $olddata->week;

        $timereports->clientid = $olddata->clientid;
        $timereports->normalhours = $olddata->normalhours;
        $timereports->description = $olddata->description;
        $timereports->period = $olddata->period;
        $timereports->overtimemeal = $olddata->overtimemeal;
        $timereports->overtimetransportation = $olddata->overtimetransportation;
        //        $start = Carbon::parse($timereports->starttask);
        //        $end = Carbon::parse($timereports->endtask);
        //        $duration = $end->diff($start)->format('%H:%I:%S');
        //        $duration = ($end->diffInMinutes($start)) / 60;
        //        =((HOUR(AC15-AA15)*60)+MINUTE(AC15-AA15)+(SECOND(AC15-AA15)/60))/60
        $timereports->ineffectivehours = $olddata->ineffectivehours;
        $timereports->ineffectiverules = $olddata->ineffectiverules;
        $timereports->overtimes = $olddata->overtimes;
        $timereports->nip = $olddata->nip;
        $timereports->timereportid = $olddata->id;
        $timereports->timereportheadid = $olddata->timereportheadid;
        $timereports->save();


        $day_of_week = date('l', strtotime($olddata->date));
        $day = date('N', strtotime($day_of_week));


        $timereportheaddata = TimeReportHead::where('id', $olddata->timereportheadid)->first();
        $countgetdatedata = DB::table('mastertimereports')->where('date', '=', Carbon::parse($olddata->date))
            ->where('nip', '=', Auth::user()->nip)->count();
        $sumovertimes = DB::table('mastertimereports')->where('date', '=', Carbon::parse($olddata->date))
            ->where('nip', '=', Auth::user()->nip)->sum('overtimes');
        if ($countgetdatedata == 1) {
            $head = TimeReportHead::where('id', $olddata->timereportheadid)->first();
            $head->delete();
        } elseif ($countgetdatedata >= 1) {
            $newtotalhours = $timereportheaddata->total_hour - $olddata->normalhours - $olddata->overtimes - $olddata->ineffectivehours;
            $timereporthead = TimeReportHead::where('id', $olddata->timereportheadid)->update([
                'total_hour' => $newtotalhours,
            ]);

            if ($day < 6) {
                if ($sumovertimes >= 2.5 && $sumovertimes <= 3.5) {
                    $timereporthead = TimeReportHead::where('id', $olddata->timereportheadid)->update([
                        'overtimetransportation' => 0
                    ]);
                } elseif ($sumovertimes <= 3.5) {
                } elseif ($sumovertimes < 2.5) {
                    $timereporthead = TimeReportHead::where('id', $olddata->timereportheadid)->update([
                        'overtimemeal' => 0, 'overtimetransportation' => 0
                    ]);
                }
            } elseif ($day > 5) {
                if ($sumovertimes >= 2.25 && $sumovertimes < 12.25) {
                    $timereporthead = TimeReportHead::where('id', $olddata->timereportheadid)->update([
                        'overtimetransportation' => 0
                    ]);
                } elseif ($sumovertimes >= 12.25) {
                } elseif ($sumovertimes < 2.25) {
                    $timereporthead = TimeReportHead::where('id', $olddata->timereportheadid)->update([
                        'overtimemeal' => 0, 'overtimetransportation' => 0
                    ]);
                }
            }
            $report = TimeReport::where('id', $id)->first();
            $report->delete();
        }

        return redirect('/timesheets/detail');
    }

    public function edittimereport($id)
    {
        return redirect('/timesheets/main');
    }

    public function deleterequest($id)
    {
        $leaverequest = LeaveRequest::where('id', $id)->first();
        $leaverequest->delete();
        return redirect('cuti/home');
    }

    public function detailstatuscuti($id)
    {
        $leaverequests = LeaveRequest::where('id', $id)->first();
        return view('statuscutidetail', ['leaverequests' => $leaverequests]);
    }

    public function showfile($id, $data)
    {
        $leaverequests = LeaveRequest::where('id', $id)->first();
        return view('statuscutidetail', ['leaverequests' => $leaverequests]);
    }

    public function cuti()
    {
        $usernip = Auth::user()->nip;
        $manualinputcuti = DB::table('manualinput')->where('nip', '=', $usernip)->sum('modifyleave');
        $countrequest = DB::table('leaverequest')->where('nip', '=', $usernip)->count();
        $leaverequests = DB::table('leaverequest')->where('nip', '=', $usernip)->paginate(10);
        $approvedrequest = DB::table('leaverequest')
            ->where('nip', '=', $usernip)
            ->where('statuscuti', '=', 'approved')
            ->sum('jumlahhari');
        $manualinputcutiplus = DB::table('manualinput')->where('nip', '=', $usernip)->where('modifyleave', '>', 0)->sum('modifyleave');
        $manualinputcutiminus = DB::table('manualinput')->where('nip', '=', $usernip)->where('modifyleave', '<', 0)->sum('modifyleave');
        $availableleave = 0 - $approvedrequest + $manualinputcuti;

        $jatahcutiawal = DB::table('manualinput')->where('modifyleave', '>', 0)->where('modifystatus', '=', 1)->where('nip', '=', $usernip)->sum('modifyleave');
        $manualinputcutiplus = DB::table('manualinput')->where('modifyleave', '>', 0)->where('modifystatus', '=', 2)->where('nip', '=', $usernip)->sum('modifyleave');
        $manualinputcutiminus = DB::table('manualinput')->whereRaw('modifyleave < 0')->where('nip', '=', $usernip)->sum('modifyleave');


        return view('leavehome', ['leaverequests' => $leaverequests], ['approvedrequest' => $approvedrequest])->with('availableleave', $availableleave)
            ->with('countrequest', $countrequest)
            ->with('manualinputcuti', $manualinputcuti)
            ->with('manualinputcutiplus', $manualinputcutiplus)
            ->with('manualinputcutiminus', $manualinputcutiminus)
            ->with('jatahcutiawal', $jatahcutiawal);
    }

    public function createleave()
    {
        return view('leaverequest');
    }

    public function clienttotal($clientid)
    {

        $client = DB::table('masterclients')->where('id', '=', $clientid)->first();

        $gettimereports = DB::table('mastertimereports')
            ->leftJoin('masterclients', 'mastertimereports.clientid', '=', 'masterclients.id')
            ->leftJoin('masteremployee', 'mastertimereports.nip', '=', 'masteremployee.nip')
            ->selectRaw('SUM(mastertimereports.normalhours) as normalhours, SUM(mastertimereports.overtimes) as overtimes
            ,SUM(mastertimereports.ineffectivehours) as ineffectivehours, mastertimereports.ineffectiverules as ineffectiverules, SUM(mastertimereports.overtimemeal) as overtimemeal
            ,SUM(mastertimereports.overtimetransportation) as overtimetransportation, masteremployee.nama as nama, mastertimereports.date as date
            ,masteremployee.institusi as institusi, masteremployee.kota as kota, masteremployee.grup as grup, masteremployee.positionid as position
            ,masteremployee.nip as nip, masterclients.clientname as clientname, mastertimereports.period as periode')
            ->where('clientid', '=', $clientid);

        if (\request()->has('periode')) {
            if (\request('periode') == 0) {
            } else {
                $gettimereports->where('mastertimereports.period', '=', \request('periode'));
            }
        }

        $timereports = $gettimereports->orderBy('mastertimereports.date', 'asc')
            ->groupBy('mastertimereports.period')
            ->groupBy('mastertimereports.clientid')
            ->groupBy('mastertimereports.nip')
            ->get();

        return view('reports.clienttotal', compact('timereports', 'client'));
    }

    public function downloadindtimereport(Request $request)
    {
        switch ($request->input('action')) {
            case 'xls':
                return (new IndTimeReportExport($request->month, $request))->sendPara($request)->download('timereport-' . Carbon::now() . '-.xlsx');
                break;

                // case 'print':

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
                        ->select(
                            'mastertimereports.date',
                            'mastertimereports.normalhours',
                            DB::raw('(mastertimereports.overtimes - ineffectiverules) as overtimes'),
                            'mastertimereports.editineffective',
                            'mastertimereports.overtimemeal',
                            'mastertimereports.overtimetransportation',
                            'mastertimereports.period',
                            'mastertimereports.description',
                            'mastertasks.taskname',
                            'masterclients.clientname',
                            'masterclients.clientcode'
                        );
                } else {
                    $results = TimeReport::query()
                        ->leftJoin('masterclients', 'mastertimereports.clientid', '=', 'masterclients.id')
                        ->leftJoin('masteremployee', 'mastertimereports.nip', '=', 'masteremployee.nip')
                        ->leftJoin('mastertasks', 'mastertimereports.task', '=', 'mastertasks.id')
                        ->select(
                            'masteremployee.nip',
                            'masteremployee.nama',
                            'masteremployee.institusi',
                            'masteremployee.kota',
                            'masteremployee.positionid',
                            'masteremployee.grup',
                            'mastertimereports.date',
                            'mastertimereports.normalhours',
                            DB::raw('(mastertimereports.overtimes - ineffectiverules) as overtimes'),
                            'mastertimereports.editineffective',
                            'mastertimereports.overtimemeal',
                            'mastertimereports.overtimetransportation',
                            'mastertimereports.period',
                            'mastertimereports.description',
                            'mastertasks.taskname',
                            'masterclients.clientname',
                            'masterclients.clientcode'
                        );
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
                        ->select(
                            'mastertimereports.date',
                            'mastertimereports.normalhours',
                            DB::raw('(mastertimereports.overtimes - ineffectiverules) as overtimes'),
                            'mastertimereports.editineffective',
                            'mastertimereports.overtimemeal',
                            'mastertimereports.overtimetransportation',
                            'mastertimereports.period',
                            'mastertimereports.description',
                            'mastertasks.taskname',
                            'masterclients.clientname',
                            'masterclients.clientcode'
                        );
                } else {
                    $results = TimeReport::query()
                        ->leftJoin('masterclients', 'mastertimereports.clientid', '=', 'masterclients.id')
                        ->leftJoin('masteremployee', 'mastertimereports.nip', '=', 'masteremployee.nip')
                        ->leftJoin('mastertasks', 'mastertimereports.task', '=', 'mastertasks.id')
                        ->select(
                            'masteremployee.nip',
                            'masteremployee.nama',
                            'masteremployee.institusi',
                            'masteremployee.kota',
                            'masteremployee.positionid',
                            'masteremployee.grup',
                            'mastertimereports.date',
                            'mastertimereports.normalhours',
                            DB::raw('(mastertimereports.overtimes - ineffectiverules) as overtimes'),
                            'mastertimereports.editineffective',
                            'mastertimereports.overtimemeal',
                            'mastertimereports.overtimetransportation',
                            'mastertimereports.period',
                            'mastertimereports.description',
                            'mastertasks.taskname',
                            'masterclients.clientname',
                            'masterclients.clientcode'
                        );
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

    public function requestleave(Request $request)
    {
        //        $usernip = Auth::user()->nip;
        //        $getuserdata = MasterEmployee::where('nip', '=', $usernip)->first();
        //
        //        $getinchargedata = DB::table('masteremployees')->groupBy('divisi')->where('divisi', $getuserdata->divisi)->where('inchargestatus', '1')->first();
        //        $inchargemail = DB::table('users2')->where('nip', $getinchargedata->nip)->first();
        //
        //        $manualinputcuti = DB::table('manualinput')->where('nip', '=', $usernip)->sum('modifyleave');
        //        $manualinputcutiplus = DB::table('manualinput')->where('modifyleave', '>', 0)->where('nip', '=', $usernip)->sum('modifyleave');
        //        $manualinputcutiminus = DB::table('manualinput')->where('modifyleave', '<', 0)->where('nip', '=', $usernip)->sum('modifyleave');
        //        $approvedrequest = LeaveRequest::where('statuscuti', '=', 'approved')->sum('jumlahhari');
        //        $availableleave = 0 - $approvedrequest + $manualinputcuti;
        //        $position = $getuserdata->positionid;
        //        $divisi = $getuserdata->divisi;
        //        $inchargestatus = $getuserdata->inchargestatus;
        //        $leaverequest = new LeaveRequest();
        //
        $usernip = Auth::user()->nip;
        //        $inchargemail = MasterEmployee::wher
        $manualinputcuti = DB::table('manualinput')->where('nip', '=', $usernip)->sum('modifyleave');
        $manualinputcutiplus = DB::table('manualinput')->where('modifyleave', '>', 0)->where('nip', '=', $usernip)->sum('modifyleave');
        $manualinputcutiminus = DB::table('manualinput')->where('modifyleave', '<', 0)->where('nip', '=', $usernip)->sum('modifyleave');
        $approvedrequest = LeaveRequest::where('statuscuti', '=', 'approved')->sum('jumlahhari');
        $getuserdata = MasterEmployee::where('nip', '=', $usernip)->first();
        $availableleave = 0 - $approvedrequest + $manualinputcuti;
        $position = $getuserdata->positionid;
        $divisi = $getuserdata->divisi;
        $inchargestatus = $getuserdata->inchargestatus;
        $leaverequest = new LeaveRequest();

        $this->validate($request, [
            'jumlahhari' => '',
            'tanggalmulaicuti' => '',
            'tanggalakhircuti' => '',
            'keterangan' => '',
            'jeniscuti' => '',
        ]);
        $leaverequest->nip = Auth::user()->nip;
        $leaverequest->nama = $getuserdata->nama;
        $leaverequest->tanggalmulaicuti = Carbon::parse($request->from);
        $leaverequest->tanggalakhircuti = Carbon::parse($request->to);
        $leaverequest->keterangan = $request->keterangan;
        $leaverequest->divisi = $divisi;
        $leaverequest->created_at = Carbon::now();
        $leaverequest->updated_at = Carbon::now();

        $start = Carbon::parse($leaverequest->tanggalmulaicuti);
        $end = Carbon::parse($leaverequest->tanggalakhircuti);
        $end->modify('+1 day');

        $duration = $end->diffInDays($start);

        $now = Carbon::now()->diffInDays();
        $requestdiff = $start->diffInDays($now);
        $bataspengajuan = $requestdiff + 2;
        $duration = $end->diffInDays($start);


        $period = new \DatePeriod($start, new \DateInterval('P1D'), $end);
        $holidays = array('2019-12-24');

        foreach ($period as $dt) {
            $curr = $dt->format('D');

            // substract if Saturday or Sunday
            if ($curr == 'Sat' || $curr == 'Sun') {
                $duration--;
            } // (optional) for the updated question
            elseif (in_array($dt->format('Y-m-d'), $holidays)) {
                $duration--;
            }
        }
        $leaverequest->jumlahhari = $duration;

        if ($inchargestatus == 0 && $leaverequest->jumlahhari < 5) {
            $leaverequest->leaverequesttype = 1;
        } elseif ($inchargestatus == 0 && $duration >= 5) {
            $leaverequest->leaverequesttype = 3;
        } elseif ($inchargestatus == 1 || $inchargestatus == 2) {
            $leaverequest->leaverequesttype = 2;
        }

        $this->validate($request, [
            //            'title' => 'nullable|max:100',
            'file' => 'file|max:3000',
            'penugasan' => 'file|max:3000'
        ]);
        $leaverequest->jeniscuti = $request->jeniscuti;

        if ($request->file !== null) {
            $uploadedFile = $request->file('file');
            $path = $uploadedFile->store('public/files');
            $leaverequest->filename = $path;
        } else {
            $leaverequest->filename = null;
        }
        if ($request->penugasan !== null) {
            $uploadedFilelampiranpenugasan = $request->file('penugasan');
            $pathlampiranpenugasan = $uploadedFilelampiranpenugasan->store('public/lampiranpenugasan');
            $leaverequest->lampiranpenugasan = $pathlampiranpenugasan;
        } else {
            $leaverequest->lampiranpenugasan = null;
        }
        if ($inchargestatus == 0) {
            $incharge = DB::table('masteremployee')->where('divisi', $divisi)->where('inchargestatus', 1)->first();
        } elseif ($inchargestatus == 1) {
            $incharge = DB::table('masteremployee')->where('inchargestatus', 2)->first();
        }

        $inchargebiodata = DB::table('masterbiodata')->where('nip', $incharge->nip)->first();
        if ($inchargebiodata === 'null' || $inchargebiodata === null) {
            $inchargemail = null;
        } else {
            $inchargemail = $inchargebiodata->emailpribadi;
        }


        Mail::to('hrd1@solis.co.id')->send(new Notifications($leaverequest));
        event(new NewLeaveRequest($usernip));

        Mail::to('hrd@solis.co.id')->send(new Notifications($leaverequest));
        event(new NewLeaveRequest($usernip));

        Mail::to('recruitment@solis.co.id')->send(new Notifications($leaverequest));
        event(new NewLeaveRequest($usernip));

        if ($leaverequest->leaverequesttype == 2) {
            Mail::to('sudiharto.suwowo@solis.co.id')->send(new Notifications($leaverequest));
            event(new NewLeaveRequest($usernip));

            Mail::to('ijono@moorestephens.co.id')->send(new Notifications($leaverequest));
            event(new NewLeaveRequest($usernip));
        }

        if ($inchargemail !== null) {
            Mail::to($inchargemail)->send(new Notifications($leaverequest));
            event(new NewLeaveRequest($usernip));
        }

        if ($bataspengajuan <= 14) {

            $leaverequest->save();
            return redirect()->route('cutihome')
                ->with('alert', 'Pengajuan cuti kurang dari 2 minggu, harap hubungi HRD langsung untuk persetujuan cuti');
        } elseif ($bataspengajuan >= 15) {
            $leaverequest->save();
            return redirect()->route('cutihome', ['approvedrequest' => $approvedrequest])->with('availableleave', $availableleave)
                ->with('successalert', 'Pengajuan cuti anda berhasil disimpan');
        }
    }

    public function processinputtimereport(Request $request)
    {
        if (isset($request->clientselect)) {
            $clients = MasterClient::where('id', '=', $request->clientselect)->first();
            $clientname = $clients->clientname;
        } else {
            $clients = null;
            $clientname = null;
        }
        $employeedata = MasterEmployee::where('nip', '=', Auth::user()->nip)->first();
        $day_of_week = date('l', strtotime($request->date));
        $day = date('N', strtotime($day_of_week));


        $thedate = DB::table('mastertimereporthead')->where('report_date', '=', Carbon::parse($request->date))
            ->where('user_nip', '=', Auth::user()->nip)->first();
        $getdatedata = DB::table('mastertimereports')->where('date', '=', Carbon::parse($request->date))
            ->where('nip', '=', Auth::user()->nip)->first();
        $getregulardata = DB::table('mastertimereports')->where('date', '=', Carbon::parse($request->date))
            ->where('nip', '=', Auth::user()->nip)->sum('normalhours');
        $getovertimesdata = DB::table('mastertimereports')->where('date', '=', Carbon::parse($request->date))
            ->where('nip', '=', Auth::user()->nip)->sum('overtimes');


        $duration = round(((Carbon::parse($request->finishTime)->diffInMinutes(Carbon::parse($request->startTime))) / 60), 2);
        $decrease = 0;
        if (Carbon::parse($request->startTime)->lt(Carbon::parse('13:00')) && Carbon::parse($request->finishTime)->gt(Carbon::parse('12:00'))) {
            if (Carbon::parse($request->startTime)->gt(Carbon::parse('12:00'))) {
                $break = round(Carbon::parse($request->startTime)->diffInMinutes(Carbon::parse('13:00')) / 60, 2);
                if ($decrease == 0) {
                    $decrease = $decrease + $break;
                }
            }
            if (Carbon::parse($request->finishTime)->lt(Carbon::parse('13:00'))) {
                $break = round(Carbon::parse($request->finishTime)->diffInMinutes(Carbon::parse('12:00')) / 60, 2);
                if ($decrease == 0) {
                    $decrease = $decrease + $break;
                }
            }
            if ($decrease == 0) {
                $decrease = $decrease + 1;
            }
        }

        if (Carbon::parse($request->finishTime)->lt(Carbon::parse('13:01')) && Carbon::parse($request->finishTime)->gt(Carbon::parse('12:00'))) {
            $break = round(Carbon::parse($request->finishTime)->diffInMinutes(Carbon::parse('12:00')) / 60, 2);
            if ($decrease == 0) {
                $decrease = $decrease + $break;
            }
        }

        if (Carbon::parse($request->startTime)->gt(Carbon::parse('11:59')) && !Carbon::parse($request->startTime)->gt(Carbon::parse('13:00'))) {
            $break = round(Carbon::parse($request->startTime)->diffInMinutes(Carbon::parse('13:00')) / 60, 2);
            if ($decrease == 0) {
                $decrease = $decrease + $break;
            }
        }

        $duration = $duration - $decrease;

        if (Carbon::parse($request->finishTime)->lt(Carbon::parse($request->startTime))) {
            $duration = 0;
        }

        switch ($request->timeType) {
            case 'REGULAR_HOUR':
                $request->overtime = 0;
                $request->regular = $duration;
                break;
            case 'OVERTIME_HOUR':
                $request->overtime = $duration;
                $request->regular = 0;
                break;

            default:
                $request->overtime = 0;
                $request->regular = 0;
                break;
        }
        
        $request->is_business_trip = $request->isBusinessTrip;

        if ($getdatedata === null) {
            if ($request->overtime == 0 || $request->overtime == null) {
                $ineffectiverules = 0;
            } else {
                if ($day >= 6 && $request->overtime >= 0) {
                    $ineffectiverules = 0.75;
                } elseif ($day < 6 && $request->overtime >= 0) {
                    $ineffectiverules = 0.50;
                }
            }
            $request->overtime = $request->overtime;
            $request->regularaccumulation = $request->regular;
            $overbudgetaccumulation = $request->overbudget;
            $request->overtimeaccumulation = $request->overtime;
            $checkovertime = $request->overtimeaccumulation - $overbudgetaccumulation;
            $totalhours = $request->regular + $request->overtime - $request->overbudget - $ineffectiverules;

            if ($day < 6) {
                if ($totalhours >= 10.5 && $totalhours < 11.5) {
                    $request->overtimemeal = $employeedata->tarifmakanlembur;
                    $request->overtimetransportation = 0;
                } elseif ($totalhours >= 11.5) {
                    $request->overtimemeal = $employeedata->tarifmakanlembur;
                    $request->overtimetransportation = $employeedata->tariftransportasi;
                } elseif ($totalhours < 10.5) {
                    $request->overtimemeal = 0;
                    $request->overtimetransportation = 0;
                }
            } elseif ($day > 5) {
                if ($checkovertime >= 2.25 && $checkovertime < 12.25) {
                    $request->overtimemeal = $employeedata->tarifmakanlembur;
                    $request->overtimetransportation = 0;
                } elseif ($checkovertime >= 12.25) {
                    $request->overtimemeal = $employeedata->tarifmakanlembur;
                    $request->overtimetransportation = $employeedata->tariftransportasi;
                } elseif ($checkovertime < 2.25) {
                    $request->overtimemeal = 0;
                    $request->overtimetransportation = 0;
                }
            }
        } else {
            $seeovertime = DB::table('mastertimereports')->where('date', '=', Carbon::parse($request->date))
                ->where('nip', '=', Auth::user()->nip)->sum('overtimes');
            $getineffectiverules = DB::table('mastertimereports')->where('date', '=', Carbon::parse($request->date))
                ->where('nip', '=', Auth::user()->nip)->orderBy('ineffectiverules')->get();

            if ($request->overtime == null) {
                $request->overtime = 0;
                $ineffectiverules = 0;
            } else {
                if ($seeovertime >= 2) {
                    if ($day >= 6 && $request->overtime >= 0) {
                        $ineffectiverules = 0.75;
                    } elseif ($day < 6 && $request->overtime >= 0) {
                        $ineffectiverules = 0.50;
                    }
                } else {
                    if ($day >= 6 && $request->overtime >= 0) {
                        $ineffectiverules = 0;
                    } elseif ($day < 6 && $request->overtime >= 0) {
                        $ineffectiverules = 0;
                    }
                }
            }
            $request->overtime = $request->overtime;
            $sumregular = DB::table('mastertimereports')->where('date', '=', Carbon::parse($request->date))
                ->where('nip', '=', Auth::user()->nip)->sum('normalhours');
            $request->regularaccumulation = $request->regular + $sumregular;
            $sumoverbudget = TimeReport::where('date', '=', Carbon::parse($request->date))
                ->where('nip', '=', Auth::user()->nip)->sum('ineffectivehours');
            $overbudgetaccumulation = $request->overbudget + $sumoverbudget;

            if ($getdatedata == null) {
                $request->overtimeaccumulation = $request->overtime - $ineffectiverules;
            } else {
                $request->overtimeaccumulation = $request->overtime + $getovertimesdata - $ineffectiverules;
            }
            if ($thedate == null) {
                $totalhours = $request->regular + $request->overtime - $request->overbudget - $ineffectiverules;
            } else {
                $totalhours = $thedate->total_hour + $request->regular + $request->overtime - $request->overbudget;
            }

            if ($day < 6) {
                if ($request->overtimeaccumulation >= 2.5 && $request->overtimeaccumulation < 3.5) {
                    $request->overtimemeal = $employeedata->tarifmakanlembur;
                    $request->overtimetransportation = 0;
                } elseif ($request->overtimeaccumulation >= 3.5) {
                    $request->overtimemeal = $employeedata->tarifmakanlembur;
                    $request->overtimetransportation = $employeedata->tariftransportasi;
                } elseif ($request->overtimeaccumulation < 2.5) {
                    $request->overtimemeal = 0;
                    $request->overtimetransportation = 0;
                }
            } elseif ($day > 5) {
                if ($request->overtimeaccumulation >= 2.25 && $request->overtimeaccumulation < 12.25) {
                    $request->overtimemeal = $employeedata->tarifmakanlembur;
                    $request->overtimetransportation = 0;
                } elseif ($request->overtimeaccumulation >= 12.25) {
                    $request->overtimemeal = $employeedata->tarifmakanlembur;
                    $request->overtimetransportation = $employeedata->tariftransportasi;
                } elseif ($request->overtimeaccumulation < 12.25) {
                    $request->overtimemeal = 0;
                    $request->overtimetransportation = 0;
                }
            }
        }

        $filepath = null;

        if ($request->lampiran !== null) {
            $uploadedFilelampiran = $request->file('lampiran');
            $pathlampiran = $uploadedFilelampiran->store('public/lampiran');
            $filepath = $pathlampiran;
        }

        $lateovertimeaccumulation = $request->lateovertime;

        $task = MasterTask::where('id', $request->task)->first();

        $firstOfMonth = strtotime(date("Y-m-01", strtotime($request->date)));
        //Apply above formula.
        $week = intval(date("W", strtotime($request->date))) - intval(date("W", $firstOfMonth)) + 1;

        return view('processinputtimereport', compact('clients', 'employeedata', 'request'))
            ->with('filepath', $filepath)
            ->with('clientname', $clientname)
            ->with('day', $day)
            ->with('overtimemeal', $request->overtimemeal)
            ->with('overtimetransportation', $request->overtimetransportation)
            ->with('totalhours', $totalhours)
            ->with('regularaccumulation', $request->regularaccumulation)
            ->with('overbudgetaccumulation', $overbudgetaccumulation)
            ->with('overtimeaccumulation', $request->overtimeaccumulation)
            ->with('lateovertimeaccumulation', $lateovertimeaccumulation)
            ->with('week', $week)
            ->with('task', $task)
            ->with('duration', $duration);
    }


    public function inputtimereport(Request $request)
    {
        $now = Carbon::now();
        $date = Carbon::parse($request->date);

        $start_period_this_month = getStartPeriod($now->format('m'));
        $end_period_this_month = getEndPeriod($now->format('m'));

        $start_period = getStartPeriod($date->format('m'));
        $end_period = getEndPeriod($date->format('m'));

        // if ($date < $start_period_this_month) {
        //     $status = isReportLocked(Auth::user()->nip, $date->format('m'));
        //     if ($status) {
        //         return redirect('/input/timereport')->with('fail-alert', 'Sudah tidak bisa memasukkan laporan dari periode sebelumnya, harap hubungi HRD apabila terjadi kesalahan input');
        //     }
        // }

        // // Restrict user to input date greater than the day
        // if (($date > $end_period_this_month)) {
        //     return redirect('/input/timereport')->with('fail-alert', 'Tidak diperbolehkan memasukkan laporan diatas tanggal periode ' . $now->format('F'));
        // }

        $thedate = DB::table('mastertimereporthead')->where('report_date', '=', Carbon::parse($request->date))
            ->where('user_nip', '=', Auth::user()->nip)->first();

        $seeovertime = DB::table('mastertimereports')->where('date', '=', Carbon::parse($request->date))
            ->where('nip', '=', Auth::user()->nip)->sum('overtimes');
        if ($seeovertime == 0) {
            $overtime = $request->overtime;
        } else {
            $overtime = $request->inputovertime;
        }
        if ($thedate == null) {
            $timereportheads = new TimeReportHead();
            $timereportheads->user_nip = Auth::user()->nip;
            $timereportheads->report_date = Carbon::parse($request->date);
            $timereportheads->total_hour = $request->totalhour;
            $timereportheads->overtimemeal = $request->overtimemeal;
            $timereportheads->overtimetransportation = $request->overtimetransportation;
            $timereportheads->save();
        } else {
            $id = $thedate->id;
            TimeReportHead::find($id)->update([
                'total_hour' => $thedate->total_hour + $request->inputregular + $overtime - $request->inputoverbudget,
                'overtimemeal' => $request->overtimemeal,
                'overtimetransportation' => $request->overtimetransportation
            ]);
        }
        $newdate = DB::table('mastertimereporthead')->where('report_date', '=', Carbon::parse($request->date))
            ->where('user_nip', '=', Auth::user()->nip)->first();

        $day_of_week = date('l', strtotime($request->date));
        $day = date('N', strtotime($day_of_week));

        $getdatedata = DB::table('mastertimereports')->where('date', '=', Carbon::parse($request->date))->first();

        if ($getdatedata === null) {
            if ($request->overtime == 0 || $request->overtime == null) {
                $overtime = 0;
                $ineffectiverules = 0;
            } else {
                if ($day >= 6 && $request->overtime >= 0) {
                    $ineffectiverules = 0.75;
                } elseif ($day < 6 && $request->overtime >= 0) {
                    $ineffectiverules = 0.50;
                }
            }
        } else {

            if ($request->overtime == 0 || $request->overtime == null) {
                $overtime = 0;
                $ineffectiverules = 0;
            } else {
                if ($seeovertime >= 0) {
                    if ($day >= 6 && $request->overtime >= 0) {
                        //                      $overtime = $request->inputovertime - 0.75;
                        $ineffectiverules = 0.75;
                    } elseif ($day < 6 && $request->overtime >= 0) {
                        //                        $overtime = $request->inputovertime - 0.5;
                        $ineffectiverules = 0.50;
                    }
                } else {
                    if ($day >= 6 && $request->overtime >= 0) {
                        $ineffectiverules = 0;
                    } elseif ($day < 6 && $request->overtime >= 0) {
                        $ineffectiverules = 0;
                    }
                }
            }
        }

        $overtime = $request->inputovertime;

        $firstOfMonth = strtotime(date("Y-m-01", strtotime($request->date)));
        //Apply above formula.
        $week = intval(date("W", strtotime($request->date))) - intval(date("W", $firstOfMonth)) + 1;
        $tasks = DB::table('mastertasks')->where('id', $request->task)->first();

        $timereports = new TimeReport();

        $timereports->date = Carbon::parse($request->date);
        $timereports->day = $request->day;
        $timereports->week = $week;

        $timereports->clientid = $request->id;
        $timereports->normalhours = $request->inputregular;
        $timereports->description = $request->description;
        $timereports->period = getPeriod(Carbon::parse($request->date));
        $timereports->overtimemeal = $request->overtimemeal;
        $timereports->overtimetransportation = $request->overtimetransportation;
        $timereports->starttime = $request->startTime;
        $timereports->finishtime = $request->finishTime;
        //        $start = Carbon::parse($timereports->starttask);
        //        $end = Carbon::parse($timereports->endtask);
        //        $duration = $end->diff($start)->format('%H:%I:%S');
        //        $duration = ($end->diffInMinutes($start)) / 60;
        //        =((HOUR(AC15-AA15)*60)+MINUTE(AC15-AA15)+(SECOND(AC15-AA15)/60))/60
        $timereports->ineffectivehours = $request->inputoverbudget;
        $timereports->ineffectiverules = $ineffectiverules;
        $timereports->overtimes = $overtime;
        $timereports->is_business_trip = $request->isBusinessTrip;
        $timereports->lampiran = $request->lampiran;
        $timereports->latitude = $request->latitude;
        $timereports->longitude = $request->longitude;
        $timereports->ip = $request->ip;

        $timereports->task = $tasks->id;
        // $timereports->activities = $tasks->activities;
        $timereports->nip = Auth::user()->nip;
        $timereports->editineffective = 0;

        if ($thedate == null) {
            $timereports->timereportheadid = $newdate->id;
        } else {
            $timereports->timereportheadid = $thedate->id;
        }

        $timereports->save();
        $client = MasterClient::where('id', $request->id)->first();
        $successmessage = "Time report on " . $request->date . " has been recorded";

        return redirect('/input/timereport')->with('success-alert', $successmessage);
    }

    public function index()
    {

        if (\request()->has('clientid')) {
            $timereports = TimeReport::where('clientid', \request('clientid'))->paginate(5);
        } elseif (\request()->has('sortduration')) {
            $timereports = TimeReport::orderBy('duration', 'asc', \request('sortduration'))->paginate(5);
        } elseif (\request()->has('sortday')) {
            $timereports = TimeReport::orderBy('day', 'desc', \request('sortday'))->paginate(5);
        } elseif (\request()->has('sortdatedesc')) {
            $timereports = TimeReport::orderBy('date', 'desc', \request('sortdatedesc'))->paginate(5);
        } elseif (\request()->has('sortdateasc')) {
            $timereports = TimeReport::orderBy('date', 'asc', \request('sortdateasc'))->paginate(5);
        } else {
            $timereports = DB::table('mastertimereports')->paginate(10);
        }
        return view('timereportlist', ['timereports' => $timereports]);
    }

    public function import(Request $request)
    {
        $period = $request->period;
        $file = $request->file('file');

        $nama_file = rand() . '-' . $file->getClientOriginalName();
        $file->move(storage_path('app'), $nama_file);

        if (File::exists(storage_path('/app/' . $nama_file))) {

            $import = new TimeReportImport($period);
            Excel::import($import, $nama_file);
            $error = $import->returnError();
        }

        if (!empty($error)) {
            $alert = __('import.error.time-report.daily-hour-max', ['row' => implode(", ", $error)]);
            $type = 'error-alert';
        } else {
            $alert = __('import.success.time-report', ['row' => implode(", ", $error)]);
            $type = 'success-alert';
        }
        return redirect()->route('inputtimereport')->with($type, $alert);
    }

    public function bulkEditOverbudget(Request $request)
    {
        $period = $request->period;
        $file = $request->file('file');

        $nama_file = rand() . '-' . $file->getClientOriginalName();
        $file->move(storage_path('app'), $nama_file);

        if (File::exists(storage_path('/app/' . $nama_file))) {

            $import = new OverbudgetImport();
            Excel::import($import, $nama_file);
            $error = $import->returnError();
        }

        if (!empty($error)) {
            $alert = __('import.error.time-report.overbudget-bulk-edit', ['row' => implode(", ", $error)]);
        } else {
            $alert = __('import.success.overbudget-bulk-edit', ['row' => implode(", ", $error)]);
        }

        return redirect()->back()->with('success-alert', $alert);
    }

    public function bulkIndex()
    {
        return view('time-report.bulk-edit');
    }

    public function bulkExport(Request $request)
    {
        return (new TimeReportBulkEditExport($request->period))->download('timereport-' . Carbon::now() . '-.xlsx');
    }

    public function bulkTemplateExport()
    {
        return (new TimeReportBulkTemplateExport())->download('timereport-' . Carbon::now() . '-.xlsx');
    }

    public function bulkApprove(Request $request)
    {
        $now = Carbon::now()->format('m');
        $startPeriod = getStartPeriod($now);

        switch ($request->week) {
            case 1:
                $week = Carbon::parse($startPeriod);
                break;
            case 2:
                $week = Carbon::parse($startPeriod)->addWeeks(1);
                break;
            case 3:
                $week = Carbon::parse($startPeriod)->addWeeks(2);
                break;
            case 4:
                $week = Carbon::parse($startPeriod)->addWeeks(3);
                break;
            case 5:
                $week = Carbon::parse($startPeriod)->addWeeks(4);
                break;
            default:
                $week = Carbon::parse($startPeriod);
                break;
        }

        $timereports = TimeReport::whereBetween('date', [$week, Carbon::parse($week)->addWeek()])->where('nip', $request->employee);
        $timereports->update(['approved_by_incharge' => true]);

        $employee = MasterEmployee::where('nip', $request->employee)->first();

        $successmessage = 'All time reports of ' . $employee->nama . ' on week ' . $request->week . ' has been approved';

        return redirect()->back()->with('success-alert', $successmessage);
    }

    public function summary($id, $period)
    {
        $name = DB::table('masteremployee')->where('nip', '=', $id)->first();
        $nama = $name->nama;
        $timereports = DB::table('mastertimereports')->where('period', '=', '1')->get();
        $sumNMH = DB::table('mastertimereports')
            ->where('nip', '=', $id)
            // ->where('activities', '=', 1)
            ->select(DB::raw('sum((normalhours)) as tnh'))
            ->get()->implode('tnh');
        if ($sumNMH == null) {
            $sumNMH = 0;
        }
        $sumOVT = DB::table('mastertimereports')
            ->where('nip', '=', $id)
            // ->where('activities', '=', 1)
            ->select(DB::raw('sum((overtimes)) as ovt'))
            ->get()->implode('ovt');
        if ($sumOVT == null) {
            $sumOVT = 0;
        }
        $sumIEH = DB::table('mastertimereports')
            ->where('nip', '=', $id)
            // ->where('activities', '=', 1)
            ->select(DB::raw('sum((ineffectivehours)) as ieh'))
            ->get()->implode('ieh');
        if ($sumIEH == null) {
            $sumIEH = 0;
        }
        $sumNET = $sumOVT - $sumIEH;
        if ($sumOVT == null && $sumIEH == null) {
            $sumNET = 0;
        } elseif ($sumOVT !== null && $sumIEH == null) {
            $sumNET = $sumOVT;
        }
        if ($sumOVT == null && $sumIEH !== null) {
            $sumNET = $sumIEH;
        }
        $sumactprfs = DB::table('mastertimereports')
            ->where('nip', '=', $id)
            // ->where('activities', '=', 1)
            ->select(array(
                'clientid', DB::raw('sum(normalhours) as totalnormalhours'),
                'clientid', DB::raw('sum(overtimes) as totalovertimes'),
                'clientid', DB::raw('sum(overtimes - ineffectivehours) as nets'),
                'clientid', DB::raw('sum(normalhours + overtimes - ineffectivehours) as totals'),
                'clientid', DB::raw('sum(ineffectivehours) as totalineffectivehours')
            ))
            ->groupBy('clientid')
            ->get();
        if ($sumactprfs == null) {
            $sumactprfs = 0;
        }
        $sumactprftotals = DB::table('mastertimereports')
            ->where('nip', '=', $id)
            // ->where('activities', '=', 1)
            ->select(DB::raw('sum((normalhours + overtimes - ineffectivehours)) as total'))
            ->get()->implode('total', ', ');
        if ($sumactprftotals == null) {
            $sumactprftotals = 0;
        }
        $sumactadms = DB::table('mastertimereports')
            ->where('nip', '=', $id)
            // ->where('activities', '=', 2)
            ->select(array(
                'clientid', DB::raw('sum(normalhours) as totalnormalhours'),
                'clientid', DB::raw('sum(overtimes) as totalovertimes'),
                'clientid', DB::raw('sum(overtimes - ineffectivehours) as nets'),
                'clientid', DB::raw('sum(normalhours + overtimes - ineffectivehours) as totals'),
                'clientid', DB::raw('sum(ineffectivehours) as totalineffectivehours')
            ))
            ->groupBy('clientid')
            ->get();
        if ($sumactadms == null) {
            $sumactadms = 0;
        }
        $sumactadmtotals = DB::table('mastertimereports')
            ->where('nip', '=', $id)
            // ->where('activities', '=', 2)
            ->select(DB::raw('sum((normalhours + overtimes - ineffectivehours)) as total'))
            ->get()->implode('total', ', ');
        if ($sumactadmtotals == null) {
            $sumactadmtotals = 0;
        }
        $sumNMHadm = DB::table('mastertimereports')
            ->where('nip', '=', $id)
            // ->where('activities', '=', 2)
            ->select(DB::raw('sum((normalhours)) as tnh'))
            ->get()->implode('tnh');
        if ($sumNMHadm == null) {
            $sumNMHadm = 0;
        }
        $sumOVTadm = DB::table('mastertimereports')
            ->where('nip', '=', $id)
            // ->where('activities', '=', 2)
            ->select(DB::raw('sum((overtimes)) as ovt'))
            ->get()->implode('ovt');
        if ($sumOVTadm == null) {
            $sumOVTadm = 0;
        }
        $sumIEHadm = DB::table('mastertimereports')
            ->where('nip', '=', $id)
            // ->where('activities', '=', 2)
            ->select(DB::raw('sum((ineffectivehours)) as ieh'))
            ->get()->implode('ieh');
        if ($sumIEHadm == null) {
            $sumIEHadm = 0;
        }

        if (is_numeric($sumOVTadm) && is_numeric($sumIEHadm)) {
            $sumNETadm = $sumOVTadm - $sumIEHadm;
        } elseif ($sumOVTadm == null && is_numeric($sumIEHadm)) {
            $sumNETadm = $sumIEHadm;
        } elseif (is_numeric($sumOVTadm) && $sumIEHadm == null) {
            $sumNETadm = $sumOVTadm;
        } elseif ($sumOVTadm == null && $sumIEHadm == null) {
            $sumNETadm = 0;
        }

        $NMH = DB::table('mastertimereports')
            ->where('nip', '=', $id)
            ->select(DB::raw('sum((normalhours)) as tnh'))
            ->get()->implode('tnh');
        if ($NMH == null) {
            $NMH = 0;
        }
        $OVT = DB::table('mastertimereports')
            ->where('nip', '=', $id)
            ->select(DB::raw('sum((overtimes)) as ovt'))
            ->get()->implode('ovt');
        if ($OVT == null) {
            $OVT = 0;
        }
        $IEH = DB::table('mastertimereports')
            ->where('nip', '=', $id)
            ->select(DB::raw('sum((ineffectivehours)) as ieh'))
            ->get()->implode('ieh');
        if ($IEH == null) {
            $IEH = 0;
        }
        if (is_numeric($sumNET) && is_numeric($sumNETadm)) {
            $NET = $sumNET + $sumNETadm;
        } elseif ($sumNET == null && is_numeric($sumNETadm)) {
            $NET = $sumNETadm;
        } elseif (is_numeric($sumNET) && $sumNETadm == null) {
            $NET = $sumNET;
        } elseif ($sumNET == null && $sumNETadm == null) {
            $NET = 0;
        }
        $sumtotals = DB::table('mastertimereports')
            ->where('nip', '=', $id)
            ->select(DB::raw('sum((normalhours + overtimes - ineffectivehours)) as total'))
            ->get()->implode('total', ', ');
        if ($sumtotals == null) {
            $sumtotals = 0;
        }
        $sumactboths = DB::table('mastertimereports')
            ->where('nip', '=', $id)
            ->select(DB::raw('sum(normalhours) as total'))
            ->get();
        if ($sumactboths == null) {
            $sumactboths = 0;
        }
        $totalactivityones = DB::table('mastertimereports')
            ->where('nip', '=', $id)
            ->select(DB::raw('sum(normalhours) as total'))
            ->get();
        if ($totalactivityones == null) {
            $totalactivityones = 0;
        }
        //        $sumactadmtotal->implode('activities', ', ');
        return view('timereportsummary', ['timereports' => $timereports])
            ->with('sumactprfs', $sumactprfs)
            ->with('sumactadms', $sumactadms)
            ->with('sumactboths', $sumactboths)
            ->with('sumactprftotals', $sumactprftotals)
            ->with('sumactadmtotals', $sumactadmtotals)
            ->with('totalactivityones', $totalactivityones)
            ->with('sumNMH', $sumNMH)
            ->with('sumOVT', $sumOVT)
            ->with('sumIEH', $sumIEH)
            ->with('sumNET', $sumNET)
            ->with('sumNMHadm', $sumNMHadm)
            ->with('sumOVTadm', $sumOVTadm)
            ->with('sumIEHadm', $sumIEHadm)
            ->with('sumNETadm', $sumNETadm)
            ->with('NMH', $NMH)
            ->with('OVT', $OVT)
            ->with('IEH', $IEH)
            ->with('NET', $NET)
            ->with('sumtotals', $sumtotals)
            ->with('sumactadms', $sumactadms)
            ->with('sumactadmtotals', $sumactadmtotals)
            ->with('totalactivityones', $totalactivityones)
            ->with('nama', $nama);
    }
}
