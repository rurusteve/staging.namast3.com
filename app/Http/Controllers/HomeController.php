<?php

namespace App\Http\Controllers;

use App\DatabaseAnak;
use App\File;
use App\MasterBiodata;
use App\ProfilePicture;
use App\User;
use Illuminate\Http\Request;
use App\LeaveApproval;
use App\LeaveRequest;
use App\MasterEmployee;
use App\MasterManualInput;
use App\MasterPayrollHistory;
use App\MasterPayrollInput;
use App\MasterPayrollHistory2019;
use App\MasterPayrollInput2019;
use App\MasterPayrollHistory2020;
use App\MasterPayrollInput2020;
use App\MasterPayrollHistory2021;
use App\MasterPayrollInput2021;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;


class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function account($id)
    {


        $employees = MasterEmployee::where('id', '=', $id)->first();
        $nip = $employees->nip;
        $oldsalaries = DB::table('oldsalaries')->where('nip', $nip)->get();
        $leaves = DB::table('leaverequest')->where('nip', $nip)->get();
        $biodatas = MasterBiodata::where('nip', '=', $nip)->first();
        $countbiodatas = MasterBiodata::where('nip', '=', $nip)->count();
        $files = File::where('nip', '=', $nip)->orderBy('created_at', 'DESC')
            ->paginate(30);
        $childs = DatabaseAnak::where('nip', '=', $nip)->get();
        $jumlahanak = DatabaseAnak::where('nip', '=', $nip)->count();
        $profiles = ProfilePicture::where('nip', '=', $nip)->orderBy('created_at', 'DESC')->first();
        $checkprofilepicture = ProfilePicture::where('nip', '=', $nip)->count();
        return view('biodatadetail', compact('employees', 'files', 'biodatas', 'oldsalaries', 'leaves'), ['profiles', $profiles])
            ->with('profiles', $profiles)
            ->with('biodatas', $biodatas)
            ->with('checkprofilepicture', $checkprofilepicture)
            ->with('childs', $childs)
            ->with('jumlahanak', $jumlahanak)
            ->with('countbiodatas', $countbiodatas);
    }

    public function index()
    {
        return view('home');
    }


    public function pdfviewbyperiod(Request $request, $id, $periode, $year)
    {

        $period = $periode;
        $crypt = Session::get('crypt');
        $crypted = json_encode($crypt);
        $route = url()->current();
        $routecheck = 'https://my.namast3.com/pdfviewbyperiod/' . Auth::user()->nip . '/' . $periode . '/' . $year . '/' . $crypt;
        $periodeinput = DB::table('payrollinput')->where('nip', '=', $id)->where('periode', '=', $period);
        $periodehistory = DB::table('payrollhistory')->where('nip', '=', $id)->where('periode', '=', $period);
//        if ($periodeinput !== $month && $periodehistory !== $month) {
//            return redirect('home')->with('alert', 'Slip gaji anda siap.');
//        } else {
        if (Auth::user()->nip == $id && $routecheck == $route) {
            $employees = MasterEmployee::where('nip', '=', $id)->first();

            if($year == '2022'){
                $payrollhistory = MasterPayrollHistory::where('nip', '=', $id)->where('periode', '=', $period)->first();
            $payrollinput = MasterPayrollInput::where('nip', '=', $id)->where('periode', '=', $period)->first();
            }elseif($year == '2021'){
                $payrollhistory = MasterPayrollHistory2021::where('nip', '=', $id)->where('periode', '=', $period)->first();
            $payrollinput = MasterPayrollInput2021::where('nip', '=', $id)->where('periode', '=', $period)->first();
            }elseif($year == '2020'){
                $payrollhistory = MasterPayrollHistory2020::where('nip', '=', $id)->where('periode', '=', $period)->first();
            $payrollinput = MasterPayrollInput2020::where('nip', '=', $id)->where('periode', '=', $period)->first();
            }elseif($year == '2019'){
                $payrollhistory = MasterPayrollHistory2019::where('nip', '=', $id)->where('periode', '=', $period)->first();
            $payrollinput = MasterPayrollInput2019::where('nip', '=', $id)->where('periode', '=', $period)->first();
            }
            view()->share('employees', $employees);
            view()->share('payrollhistory', $payrollhistory);
            view()->share('payrollinput', $payrollinput);
            view()->share('id', $id);

            $earningtotal =
                $payrollhistory->jumlahupahtetapaktual +
                $payrollhistory->jumlahthaktual +
                $payrollhistory->jumlahlembur +
                $payrollhistory->jumlahtransportasi +
                $payrollhistory->jumlahuangmakanlembur +
                $payrollhistory->jumlahope +
                $payrollhistory->jumlahklaimdibayarkan +
                $payrollinput->jumlahklaimpengobatan +
                $payrollinput->tunjanganhariraya +
                $payrollinput->insentif +
                $payrollinput->bonus +
                $payrollinput->insentifpenghargaan +
                $payrollinput->koreksipenambahan;
            $deductiontotal =
                $payrollinput->pembayaranterlebihdahulu +
                $payrollinput->bpjsketenagakerjaan +
                $payrollinput->bpjspensiun +
                $payrollinput->bpjskesehatan +
                $payrollinput->pphpasal21 +
                $payrollinput->pembayaranpinjaman +
                $payrollinput->koreksipengurangan;
            $payrollhistory->takehomepay = $earningtotal - $deductiontotal;
            $takehomepay = $payrollhistory->takehomepay;
            $total =
                $takehomepay +
                $payrollinput->pencairanpinjaman +
                $payrollinput->pengembaliandeposit;
//        $id = $request->only(['id']);
            return view('pdfview', compact('periode', 'year'), ['id' => $id])->with('id', $id)
                ->with('earningtotal', $earningtotal)
                ->with('periode', $periode)
                ->with('deductiontotal', $deductiontotal)
                ->with('takehomepay', $takehomepay)
                ->with('total', $total);
//        $id = $request->only(['id']);

        } else {

            return redirect('home')->with('alert', 'Harap masukkan password anda kembali untuk mengakses slip gaji');
        }
//        }
    }

    public function encryptslip(Request $request, $crypt)
    {
        $nip = Auth::user()->nip;
        $listbyperiodes = DB::table('payrollhistory')->where('nip', '=', $nip)->get();
        $id = $request->nip;
        $pass = $request->password;
        if (Hash::check($pass, Auth::user()->password)) {
            return redirect('/pdfview/' . $nip . '/' . $crypt)->with('crypt', $crypt);
        } else {
            return redirect('/home')->with('alert', 'Incorrect password');
        }
    }

    public function encryptslipperiod(Request $request, $year, $crypt)
    {
        $period = $request->periode;
        $id = $request->nip;
        $pass = $request->password;
        $nip = Auth::user()->nip;
        if (Hash::check($pass, Auth::user()->password)) {
            return redirect('/pdfviewbyperiod/' . $nip . '/' . $period . '/' . $year . '/' .  $crypt)->with('crypt', $crypt);
        } else {
            return redirect('/home')->with('alert', 'Password yang anda masukkan salah');
        }
    }

    public function pdfview(Request $request, $id)
    {

        $crypt = Session::get('crypt');
        $crypted = json_encode($crypt);
        $route = url()->current();
        $routecheck = 'https://my.namast3.com/pdfview/' . Auth::user()->nip . '/' . $crypt;
        $month = Carbon::now()->month;
        $periodeinput = DB::table('payrollinput')->where('nip', '=', $id)->orderBy('periode', 'desc')->pluck('periode')->implode('periode');
        $periodehistory = DB::table('payrollhistory')->where('nip', '=', $id)->orderBy('periode', 'desc')->pluck('periode')->implode('periode');
//        if ($periodeinput !== $month && $periodehistory !== $month) {
//            return redirect('home')->with('alert', 'Slip gaji anda siap.');
//        } else {
        if (Auth::user()->nip == $id && $routecheck == $route) {
            $employees = MasterEmployee::where('nip', '=', $id)->first();
            $payrollhistory = MasterPayrollHistory::where('nip', '=', $id)->where('periode', '=', $month)->first();
            $payrollinput = MasterPayrollInput::where('nip', '=', $id)->where('periode', '=', $month)->first();
            view()->share('employees', $employees);
            view()->share('payrollhistory', $payrollhistory);
            view()->share('payrollinput', $payrollinput);
            view()->share('id', $id);
            $earningtotal =
                $payrollhistory->jumlahupahtetapaktual +
                $payrollhistory->jumlahthaktual +
                $payrollhistory->jumlahlembur +
                $payrollhistory->jumlahtransportasi +
                $payrollhistory->jumlahuangmakanlembur +
                $payrollhistory->jumlahope +
                $payrollhistory->jumlahklaimdibayarkan +
                $payrollinput->tunjanganhariraya +
                $payrollinput->insentif +
                $payrollinput->bonus +
                $payrollinput->insentifpenghargaan +
                $payrollinput->koreksipenambahan;
            $deductiontotal =
                $payrollinput->pembayaranterlebihdahulu +
                $payrollinput->bpjsketenagakerjaan +
                $payrollinput->bpjspensiun +
                $payrollinput->bpjskesehatan +
                $payrollinput->pphpasal21 +
                $payrollinput->pembayaranpinjaman +
                $payrollinput->koreksipengurangan;
            $payrollhistory->takehomepay = $earningtotal - $deductiontotal;
            $takehomepay = $payrollhistory->takehomepay;
            $total =
                $takehomepay +
                $payrollinput->pencairanpinjaman +
                $payrollinput->pengembaliandeposit;
//        $id = $request->only(['id']);
            return view('pdfview', ['id' => $id])->with('id', $id)
                ->with('earningtotal', $earningtotal)
                ->with('periode', $periode)
                ->with('deductiontotal', $deductiontotal)
                ->with('takehomepay', $takehomepay)
                ->with('total', $total);
        } else {

            return redirect('home')->with('alert', 'Harap masukkan password anda kembali untuk mengakses slip gaji');
        }
//        }
    }


    public function viewslipfromreport(Request $request, $id, $periode)
    {

        $period = $periode;
        $periodeinput = DB::table('payrollinput')->where('nip', '=', $id)->where('periode', '=', $period);
        $periodehistory = DB::table('payrollhistory')->where('nip', '=', $id)->where('periode', '=', $period);
//        if ($periodeinput !== $month && $periodehistory !== $month) {
//            return redirect('home')->with('alert', 'Slip gaji anda siap.');
//        } else {
        if (Auth::user()->division === 'HRD' || Auth::user()->division === 'PARTNER') {
            $employees = MasterEmployee::where('nip', '=', $id)->first();
            $payrollhistory = MasterPayrollHistory::where('nip', '=', $id)->where('periode', '=', $period)->first();
            $payrollinput = MasterPayrollInput::where('nip', '=', $id)->where('periode', '=', $period)->first();
            view()->share('employees', $employees);
            view()->share('payrollhistory', $payrollhistory);
            view()->share('payrollinput', $payrollinput);
            view()->share('id', $id);
            $earningtotal =
                $payrollhistory->jumlahupahtetapaktual +
                $payrollhistory->jumlahthaktual +
                $payrollhistory->jumlahlembur +
                $payrollhistory->jumlahtransportasi +
                $payrollhistory->jumlahuangmakanlembur +
                $payrollhistory->jumlahope +
                $payrollhistory->jumlahklaimdibayarkan +
                $payrollinput->jumlahklaimpengobatan +
                $payrollinput->tunjanganhariraya +
                $payrollinput->insentif +
                $payrollinput->bonus +
                $payrollinput->insentifpenghargaan +
                $payrollinput->koreksipenambahan;
            $deductiontotal =
                $payrollinput->pembayaranterlebihdahulu +
                $payrollinput->bpjsketenagakerjaan +
                $payrollinput->bpjspensiun +
                $payrollinput->bpjskesehatan +
                $payrollinput->pphpasal21 +
                $payrollinput->pembayaranpinjaman +
                $payrollinput->koreksipengurangan;
            $payrollhistory->takehomepay = $earningtotal - $deductiontotal;
            $takehomepay = $payrollhistory->takehomepay;
            $total =
                $takehomepay +
                $payrollinput->pencairanpinjaman +
                $payrollinput->pengembaliandeposit;
//        $id = $request->only(['id']);
            return view('pdfview', ['id' => $id])->with('id', $id)
                ->with('earningtotal', $earningtotal)
                ->with('periode', $periode)
                ->with('deductiontotal', $deductiontotal)
                ->with('takehomepay', $takehomepay)
                ->with('total', $total);
//        $id = $request->only(['id']);

        } else {

            return redirect('home')->with('alert', 'Anda tidak dapat mengakses halaman tersebut');
        }
//        }
    }

    public function auth()
    {

    }

    public function requestleavelist()
    {
        $user = Auth::user()->admin;
        $nip = Auth::user()->nip;
        $employees = DB::table('masteremployee')->where('nip', '=', $nip)->get();
        $employee = DB::table('masteremployee')->where('nip', '=', $nip)->first();
        $division = $employee->divisi;
        $getinchargestatus = DB::table('masteremployee')->where('nip', '=', $nip)->first();
        $inchargestatus = $getinchargestatus->inchargestatus;
        $type1s = DB::table('leaverequest')
            ->where('bymanager', '=', null)
            ->where('statuscuti', '=', null)
            ->where('divisi', '=', $division)
            ->where('leaverequesttype', '=', 1)->get();
        $type2s = DB::table('leaverequest')
            ->where('bypartner', '=', null)
            ->where('statuscuti', '=', null)
            ->where('divisi', '=', $division)
            ->where('leaverequesttype', '=', 2)->get();
        $type3s = DB::table('leaverequest')
            ->where('bymanager', '=', null)
            ->where('statuscuti', '=', null)
            ->where('divisi', '=', $division)
            ->where('leaverequesttype', '=', 3)->get();
        $type4s = DB::table('leaverequest')
            ->where('bymanager', '=', 1)
            ->where('statuscuti', '=', null)
            ->where('leaverequesttype', '=', 3)->get();
        $type5s = DB::table('leaverequest')
            ->where('bypartner', '=', null)
            ->where('statuscuti', '=', null)
            ->where('leaverequesttype', '=', 2)->get();
        $type6s = DB::table('leaverequest')->where('statuscuti', '=', null)->get();

        $countrequest = DB::table('leaverequest')->count();
        $leaverequests = DB::table('leaverequest')->where('statuscuti', '=', null)->paginate(10);
        $aprrovedrequest = LeaveRequest::where('statuscuti', '=', 'approved')->sum('jumlahhari');
        $manualinputcuti = DB::table('manualinput')->where('nip', '=', $nip)->sum('modifyleave');
        $jatahcutiawal = DB::table('manualinput')->where('modifyleave', '>', 0)->where('modifystatus', '=', 1)->where('nip', '=', $nip)->sum('modifyleave');
        $manualinputcutiplus = DB::table('manualinput')->where('modifyleave', '>', 0)->where('modifystatus', '=', 2)->where('nip', '=', $nip)->sum('modifyleave');
        $manualinputcutiminus = DB::table('manualinput')->whereRaw('modifyleave < 0')->where('nip', '=', $nip)->sum('modifyleave');

        $availableleave = 0 - $aprrovedrequest + $manualinputcuti;
        $checkdivisions = DB::table('leaverequest')->where('divisi', '=', $division)->get();
//        $nipbydivisions = $checkdivisions->nip;
//        $leaverequestbydivisions = DB::table('masteremployee')->where('nip', '=', $nipbydivisions)->get();
        $timereports = DB::table('mastertimereports')->paginate(7);
        return view('adminrequestleavelist', ['leaverequests' => $leaverequests], ['approvedrequest' => $aprrovedrequest])
            ->with('employees', $employees)
            ->with('availableleave', $availableleave)
            ->with('countrequest', $countrequest)
            ->with('timereports', $timereports)
            ->with('checkdivisions', $checkdivisions)
            ->with('type1s', $type1s)
            ->with('type2s', $type2s)
            ->with('type3s', $type3s)
            ->with('type4s', $type4s)
            ->with('type5s', $type5s)
            ->with('type6s', $type6s)
            ->with('inchargestatus', $inchargestatus);
    }

    public function detailcuti($id)
    {
        $leaverequests = DB::table('leaverequest')->where('id', '=', $id)->first();
        return view('leaverequestdetail', ['leaverequests' => $leaverequests])
            ->with('leaverequests', $leaverequests);
    }

    public function declinerequestform($nip, $id)
    {
        $employees = DB::table('masteremployee')->where('nip', '=', $nip)->first();
        $leaverequestdetails = DB::table('leaverequest')->where('id', '=', $id)->first();
        return view('declinerequest', ['employees' => $employees], ['leaverequestdetails' => $leaverequestdetails])
            ->with('nip', $nip)
            ->with('id', $id);
    }

    public function declinerequest(Request $request, $nip, $id)
    {
        $leaveapproval = LeaveRequest::find($id);

        $authnip = Auth::user()->nip;
        $getinchargestatus = DB::table('masteremployee')->where('nip', '=', $authnip)->first();
        $inchargestatus = $getinchargestatus->inchargestatus;

        if ($inchargestatus == 0) {
            return redirect('home');
        } elseif ($inchargestatus == 1 && Auth::user()->admin == 2 && Auth::user()->division == 'HRD') {
            $leaveapproval->byhrd = 1;
            $this->validate($request, [
                'ketbyhrd' => '',
            ]);
            $leaveapproval->niphrd = $authnip;
            $leaveapproval->ketbyhrd = $request->keteranganapproval;
            $leaveapproval->hrdapprovaldate = Carbon::now();
            $leaveapproval->statuscuti = "declined";
            $leaveapproval->update();
            return redirect('home');
        } elseif ($inchargestatus == 1 && $leaveapproval->leaverequesttype == 1) {
            $leaveapproval->bymanager = 1;
            $this->validate($request, [
                'ketbymanager' => '',
            ]);
            $leaveapproval->nipmanager = $authnip;
            $leaveapproval->ketbymanager = $request->keteranganapproval;
            $leaveapproval->managerapprovaldate = Carbon::now();
            $leaveapproval->statuscuti = "declined";
            $leaveapproval->update();
            return redirect('home');
        } elseif ($inchargestatus == 2 && $leaveapproval->leaverequesttype == 2) {
            $leaveapproval->bypartner = 1;
            $this->validate($request, [
                'ketbypartner' => '',
            ]);
            $leaveapproval->nippartner = $authnip;
            $leaveapproval->ketbypartner = $request->keteranganapproval;
            $leaveapproval->partnerapprovaldate = Carbon::now();
            $leaveapproval->statuscuti = "declined";
            $leaveapproval->update();
            return redirect('home');
        } elseif ($inchargestatus == 1 && $leaveapproval->leaverequesttype == 3) {
            $leaveapproval->bymanager = 1;
            $this->validate($request, [
                'ketbymanager' => '',
            ]);
            $leaveapproval->nipmanager = $authnip;
            $leaveapproval->ketbymanager = $request->keteranganapproval;
            $leaveapproval->managerapprovaldate = Carbon::now();
            $leaveapproval->statuscuti = "declined";
            $leaveapproval->update();
            return redirect('home');
        } elseif ($inchargestatus == 2 && $leaveapproval->leaverequesttype == 3) {
            $leaveapproval->bypartner = 1;
            $this->validate($request, [
                'ketbypartner' => '',
            ]);
            $leaveapproval->nippartner = $authnip;
            $leaveapproval->ketbypartner = $request->keteranganapproval;
            $leaveapproval->partnerapprovaldate = Carbon::now();
            $leaveapproval->statuscuti = "declined";
            $leaveapproval->update();
            return redirect('home');
        }
    }

    public function approverequestform($nip, $id)
    {
        $employees = DB::table('masteremployee')->where('nip', '=', $nip)->first();
        $leaverequestdetails = DB::table('leaverequest')->where('id', '=', $id)->first();
        return view('approverequest', ['employees' => $employees], ['leaverequestdetails' => $leaverequestdetails])
            ->with('nip', $nip)
            ->with('id', $id);
    }

    public function addnote($nip, $id)
    {
        $employees = DB::table('masteremployee')->where('nip', '=', $nip)->first();
        $leaverequestdetails = DB::table('leaverequest')->where('id', '=', $id)->first();
        return view('addnote', ['employees' => $employees], ['leaverequestdetails' => $leaverequestdetails])
            ->with('nip', $nip)
            ->with('id', $id);
    }

    public function submitnote(Request $request, $nip, $id)
    {
        $leaveapproval = LeaveRequest::find($id);

        $leaveapproval->ketbyhrd = $request->keteranganapproval;

        $leaveapproval->update();
        return redirect()->route('leavelist');

    }

    public function approverequest(Request $request, $nip, $id)
    {
        $leaveapproval = LeaveRequest::find($id);

        $authnip = Auth::user()->nip;
        $getinchargestatus = DB::table('masteremployee')->where('nip', '=', $authnip)->first();
        $inchargestatus = $getinchargestatus->inchargestatus;
        if ($inchargestatus == 0) {
            return redirect('home');
        } elseif ($inchargestatus == 1 && Auth::user()->admin == 2 && Auth::user()->division == 'HRD') {
            $leaveapproval->byhrd = 1;
            $this->validate($request, [
                'ketbyhrd' => '',
            ]);
            $leaveapproval->niphrd = $authnip;
            $leaveapproval->ketbyhrd = $request->keteranganapproval;
            $leaveapproval->hrdapprovaldate = Carbon::now();
            $leaveapproval->statuscuti = "approved";
            $leaveapproval->update();
            return redirect('home');
        } elseif ($inchargestatus == 1 && $leaveapproval->leaverequesttype == 1) {
            $leaveapproval->bymanager = 1;
            $this->validate($request, [
                'ketbymanager' => '',
            ]);
            $leaveapproval->nipmanager = $authnip;
            $leaveapproval->ketbymanager = $request->keteranganapproval;
            $leaveapproval->managerapprovaldate = Carbon::now();
            $leaveapproval->statuscuti = "approved";
            $leaveapproval->update();
            return redirect('home');

//        }elseif($inchargestatus == 2){
//            $leaveapproval -> byhrd = 1;
//            $this->validate($request,[
//                'ketbyhrd' => '',
//            ]);
//            $leaveapproval -> niphrd = $authnip;
//            $leaveapproval -> ketbyhrd = $request -> keteranganapproval;
//            $leaveapproval -> hrdapprovaldate = Carbon::now();
//            $leaveapproval -> update();
//            return redirect('home');
//        }
        } elseif ($inchargestatus == 2 && $leaveapproval->leaverequesttype == 2) {
            $leaveapproval->bypartner = 1;
            $this->validate($request, [
                'ketbypartner' => '',
            ]);
            $leaveapproval->nippartner = $authnip;
            $leaveapproval->ketbypartner = $request->keteranganapproval;
            $leaveapproval->partnerapprovaldate = Carbon::now();
            $leaveapproval->statuscuti = "approved";
            $leaveapproval->update();
            return redirect('home');
        } elseif ($inchargestatus == 1 && $leaveapproval->leaverequesttype == 3) {
            $leaveapproval->bymanager = 1;
            $this->validate($request, [
                'ketbymanager' => '',
            ]);
            $leaveapproval->nipmanager = $authnip;
            $leaveapproval->ketbymanager = $request->keteranganapproval;
            $leaveapproval->managerapprovaldate = Carbon::now();
            $leaveapproval->statuscuti = "approved";
            $leaveapproval->update();
            return redirect('home');
        }
        // } elseif ($inchargestatus == 2 && $leaveapproval->leaverequesttype == 3) {
        //     $leaveapproval->bypartner = 1;
        //     $this->validate($request, [
        //         'ketbypartner' => '',
        //     ]);
        //     $leaveapproval->nippartner = $authnip;
        //     $leaveapproval->ketbypartner = $request->keteranganapproval;
        //     $leaveapproval->partnerapprovaldate = Carbon::now();
        //     $leaveapproval->statuscuti = "approved";
        //     $leaveapproval->update();
        //     return redirect('home');
        // }

        return redirect('/home');
    }

    public function search(Request $request)
    {

        $employees = MasterEmployee::all()->sortBy('nip');
        // Sets the parameters from the get request to the variables.
        $name = $request->searchname;
        // Perform the query using Query Builder
        $employees = DB::table('masteremployee')
            ->where('nama', 'like', '%' . $name . '%')
            ->paginate(10);

        return view('manualinput', ['employees' => $employees])
            ->with('employees', $employees);
    }

    public function dashboard(Request $request)
    {

        // $employeestatus = DB::table('masteremployee')->where('masteremployee.nip', '=', Auth::user()->nip)->get();
        // if($employeestatus->status == 'RESIGN'){
        //     Auth::logout();
        // }
        $minusregularhours = DB::table('mastertimereports')
            ->select(DB::raw('SUM(mastertimereports.normalhours) as NH'), 'date')
            ->groupBy('nip', 'date')->where('nip', Auth::user()->nip)->get();

        $lastmonth = Carbon::now()->subMonth()->format('m');
        $topfivecompanies = DB::table('mastertimereports')
            ->join('masterclients', 'mastertimereports.clientid', '=', 'masterclients.id')
            ->select(DB::raw('sum(mastertimereports.overtimes) - sum(mastertimereports.ineffectiverules) -
             sum(mastertimereports.editineffective) as totalhour'), 'masterclients.id as idclient', 'masterclients.clientname as nama')
//            ->select(DB::raw('sum(mastertimereports.overtimes) as totalhour'), 'masterclients.id as idclient', 'masterclients.clientname as nama')
            ->groupBy('mastertimereports.clientid')
            ->orderBy('totalhour', 'desc')
            ->where('masterclients.id', '!=', '999')
            ->whereMonth('mastertimereports.date', $lastmonth)
            ->take(5)
            ->get();
        $topthrees = DB::table('mastertimereporthead')
            ->join('mastertimereports', 'mastertimereporthead.id', '=', 'mastertimereports.timereportheadid')
            ->join('masteremployee', 'mastertimereports.nip', '=', 'masteremployee.nip')
//            ->select(DB::raw('sum(mastertimereporthead.total_hour) as totalhour'), 'mastertimereporthead.user_nip', 'masteremployee.nama as nama')
            ->select(DB::raw('sum(mastertimereports.overtimes) - sum(mastertimereports.ineffectiverules) -
             sum(mastertimereports.editineffective) as totalhour'), 'mastertimereports.nip', 'masteremployee.nama as nama')
            ->groupBy('mastertimereports.nip')
            ->orderBy('totalhour', 'desc')
            ->whereMonth('report_date', $lastmonth)
            ->take(5)
            ->get();
        $bottomthrees = DB::table('mastertimereporthead')
            ->join('mastertimereports', 'mastertimereporthead.id', '=', 'mastertimereports.timereportheadid')
            ->join('masteremployee', 'mastertimereports.nip', '=', 'masteremployee.nip')
            ->select(DB::raw('sum(mastertimereporthead.total_hour) as totalhour'), 'mastertimereporthead.user_nip', 'masteremployee.nama as nama')
            ->groupBy('mastertimereporthead.user_nip')
            ->orderBy('totalhour', 'asc')
            ->whereMonth('report_date', $lastmonth)
            ->take(5)
            ->get();
        $maxperiod = DB::table('payrollhistory')->max('periode');
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
        if (\request()->has('city')) {
            $results->where('kota', '=', \request('kota'));
        }
        if (\request()->has('institusi')) {
            $results->where('institusi', '=', \request('institusi'));
        }
        if (\request()->has('periode')) {
            $results->where('periode', '=', \request('periode'));
        }

        $results->where('periode', '=', $maxperiod);

        $collections = $results
            ->get();

        $thisyear = Carbon::now()->year;
        $data = DB::table('mastertimereports')
            ->select(DB::raw('sum(overtimes) - sum(ineffectiverules) - sum(editineffective) as total, date'))
            ->whereYear('date', $thisyear)
            ->groupBy('date')
            ->orderBy('date')
            ->get();

        $array[] = ['Report Date', 'Total OT'];
        foreach ($data as $key => $value) {
            $array[++$key] = [$value->date, (int)$value->total];
        }

        $greetings = "";
        $emotionalgreetings = "";
        $emoticoncode = "";

        // date_default_timezone_get('Asia/Jakarta');
        $time = date("H");

        $timezone = date("e");
        if ($time < "12") {
            $greetings = "Good morning";
            $emotionalgreetings = "have a nice day!";
            $emoticoncode = 1;
        } elseif ($time >= "12" && $time < "17") {
            $greetings = "Good afternoon";
            $emotionalgreetings = "stay focus!";
            $emoticoncode = 2;
        } elseif ($time >= "17" && $time < "22") {
            $greetings = "Good evening";
            $emotionalgreetings = "keep the hard work!";
            $emoticoncode = 3;
        } elseif ($time >= "22") {
            $greetings = "Good night";
            $emotionalgreetings = "what are you doing so lately?";
            $emoticoncode = 4;
        }


        $user = Auth::user()->admin;
        $nip = Auth::user()->nip;
        $id = Auth::id();
        $getuser = DB::table('users2')->where('id', '=', $id)->first();
        $type = $getuser->logintype;
        $employee = DB::table('masteremployee')->where('nip', '=', $nip)->first();

        if($employee->status == "RESIGN"){
            Auth::logout();
            return redirect('/login');
        }
        $manualinputcuti = DB::table('manualinput')->where('nip', '=', $nip)->sum('modifyleave');
        $jatahcutiawal = DB::table('manualinput')->where('modifyleave', '>', 0)->where('modifystatus', '=', 1)->where('nip', '=', $nip)->sum('modifyleave');
        $manualinputcutiplus = DB::table('manualinput')->where('modifyleave', '>', 0)->where('modifystatus', '=', 2)->where('nip', '=', $nip)->sum('modifyleave');
        $manualinputcutiminus = DB::table('manualinput')->whereRaw('modifyleave < 0')->where('nip', '=', $nip)->sum('modifyleave');

        if ($user == 0 || $user == 1) {
            $employees = DB::table('masteremployee')->where('nip', '=', $nip)->get();
            $employee = DB::table('masteremployee')->where('nip', '=', $nip)->first();
            $division = $employee->divisi;
            $countrequest = DB::table('leaverequest')->count();
            $leaverequests = LeaveRequest::all();
//        $leaverequestsjoints = DB::table('leaverequest')
//            ->get();
//        $sumlrtype1= DB::table('leaverequest')->where('leaverequesttype', '=', 1)->sum('leaverequesttype');
//        $sumlrtype2= DB::table('leaverequest')->where('leaverequesttype', '=', 2)->sum('leaverequesttype');

            $type1s = DB::table('leaverequest')
                ->where('bymanager', '=', null)
                ->where('statuscuti', '=', null)
                ->where('divisi', '=', $division)
                ->where('leaverequesttype', '=', 1)->get();
            $type2s = DB::table('leaverequest')
                ->where('bypartner', '=', null)
                ->where('statuscuti', '=', null)
                ->where('divisi', '=', $division)
                ->where('leaverequesttype', '=', 2)->get();
            $type3s = DB::table('leaverequest')
                ->where('bymanager', '=', null)
                ->where('statuscuti', '=', null)
                ->where('divisi', '=', $division)
                ->where('leaverequesttype', '=', 3)->get();
            $type4s = DB::table('leaverequest')
                ->where('bymanager', '=', 1)
                ->where('statuscuti', '=', null)
                ->where('leaverequesttype', '=', 3)->get();
            $type6s = DB::table('leaverequest')->where('statuscuti', '=', null)->get();
//        $type3byhrds= DB::table('leaverequest')
//            ->where('bymanager', '=', 1)
//            ->where('statuscuti', '=', null)
//            ->where('leaverequesttype', '=', 3)->get();
//        $type3bypartners= DB::table('leaverequest')
//            ->where('byhrd', '=', 1)
//            ->where('statuscuti', '=', null)
//            ->where('leaverequesttype', '=', 3)->get();
//        $type2byhrds= DB::table('leaverequest')
//            ->where('byhrd', '=', null)
//            ->where('statuscuti', '=', null)
//            ->where('leaverequesttype', '=', 2)->get();
//        $type2bypartners= DB::table('leaverequest')
//            ->where('byhrd', '=', 1)
//            ->where('statuscuti', '=', null)
//            ->where('leaverequesttype', '=', 2)->get();
//        $type1bypartners= DB::table('leaverequest')
//            ->where('bypartner', '=', null)
//            ->where('statuscuti', '=', null)
//            ->where('leaverequesttype', '=', 1)->get();

//
//        $sumlrtype3= DB::table('leaverequest')->where('leaverequesttype', '=', 3)->sum('leaverequesttype');
//        $totalsumtypes = $sumlrtype1 + $sumlrtype2 + $sumlrtype3;

            $getinchargestatus = DB::table('masteremployee')->where('nip', '=', $nip)->first();
            $inchargestatus = $getinchargestatus->inchargestatus;
            $approvedrequest = DB::table('leaverequest')
                ->where('nip', '=', $nip)
                ->where('statuscuti', '=', 'approved')
                ->sum('jumlahhari');
            $waitingforapproval = DB::table('leaverequest')
                ->where('nip', '=', $nip)
                ->where('statuscuti', '=', null)
                ->sum('jumlahhari');
            $availableleave = 0 - $approvedrequest + $manualinputcuti;
            $totalrequest = LeaveRequest::sum('jumlahhari');

            $checkdivisions = DB::table('leaverequest')->where('divisi', '=', $division)->get();
//        $nipbydivisions = $checkdivisions->nip;
//        $leaverequestbydivisions = DB::table('masteremployee')->where('nip', '=', $nipbydivisions)->get();
            $timereports = DB::table('mastertimereports')
                ->join('masteremployee', 'mastertimereports.nip', '=', 'masteremployee.nip')
                ->paginate(7);
            $counttimereports = DB::table('mastertimereports')->count();
            $month = Carbon::now()->month;
            $periode = DB::table('payrollhistory')->where('nip', '=', $nip)->where('periode', '=', $month)->pluck('periode')->implode('');
            $listbyperiodes = DB::table('payrollhistory')->where('nip', '=', $nip)->get();
            return view('home', compact('leaverequests', 'timereports', 'minusregularhours'))
                ->with('month', $month)
                ->with('periode', $periode)
                ->with('listbyperiodes', $listbyperiodes)
                ->with('employees', $employees)
                ->with('availableleave', $availableleave)
                ->with('approvedrequest', $approvedrequest)
                ->with('countrequest', $countrequest)
                ->with('inchargestatus', $inchargestatus)
                ->with('waitingforapproval', $waitingforapproval)
                ->with('counttimereports', $counttimereports)
                ->with('checkdivisions', $checkdivisions)
                ->with('manualinputcuti', $manualinputcuti)
                ->with('jatahcutiawal', $jatahcutiawal)
                ->with('manualinputcutiplus', $manualinputcutiplus)
                ->with('manualinputcutiminus', $manualinputcutiminus)
                ->with('type', $type)
                ->with('division', $division)
                ->with('type1s', $type1s)
                ->with('type2s', $type2s)
                ->with('type3s', $type3s)
                ->with('type4s', $type4s)
                ->with('type6s', $type6s)
                ->with('totalrequest', $totalrequest)
                ->with('greetings', $greetings)
                ->with('emotionalgreetings', $emotionalgreetings)
                ->with('emoticoncode', $emoticoncode);

        } elseif ($user == 2) {
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
                ->first();
            $totalworkhours = DB::table('mastertimereports')
                ->join('masterclients', 'mastertimereports.clientid', '=', 'masterclients.id')
                ->select('masterclients.clientname as clientid', 'masterclients.id as id', DB::raw('normalhours + overtimes as totals'))
                ->groupBy('clientid')->paginate(10);
            $employees = DB::table('masteremployee')->where('nip', '=', $nip)->get();
            $employee = DB::table('masteremployee')->where('nip', '=', $nip)->first();
            $division = $employee->divisi;
            $totalrequest = LeaveRequest::sum('jumlahhari');
            $type1s = DB::table('leaverequest')
                ->where('bymanager', '=', null)
                ->where('statuscuti', '=', null)
                ->where('divisi', '=', $division)
                ->where('leaverequesttype', '=', 1)->get();
            $type2s = DB::table('leaverequest')
                ->where('bypartner', '=', null)
                ->where('statuscuti', '=', null)
                ->where('leaverequesttype', '=', 2)->get();
            $type3s = DB::table('leaverequest')
                ->where('bymanager', '=', null)
                ->where('statuscuti', '=', null)
                ->where('divisi', '=', $division)
                ->where('leaverequesttype', '=', 3)->get();
            $type4s = DB::table('leaverequest')
                ->where('bymanager', '=', 1)
                ->where('statuscuti', '=', null)
                ->where('leaverequesttype', '=', 3)->get();
            $type6s = DB::table('leaverequest')
                ->where('statuscuti', '=', null)->get();
            $getinchargestatus = DB::table('masteremployee')->where('nip', '=', $nip)->first();
            $inchargestatus = $getinchargestatus->inchargestatus;
            $approvedrequest = DB::table('leaverequest')
                ->where('nip', '=', $nip)
                ->where('statuscuti', '=', 'approved')
                ->sum('jumlahhari');
            $availableleave = 0 - $approvedrequest + $manualinputcuti;
            $checkdivisions = DB::table('leaverequest')->where('divisi', '=', $division)->get();
            $timereports = DB::table('mastertimereports')
                ->leftJoin('masteremployee', 'mastertimereports.nip', '=', 'masteremployee.nip')
                ->orderBy('date', 'desc')
//            ->groupBy('mastertimereports.nip')
                ->paginate(5);
            $month = Carbon::now()->month;
            $periode = DB::table('payrollhistory')->where('nip', '=', $nip)->where('periode', '=', $month)->pluck('periode')->implode('');
            $listbyperiodes = DB::table('payrollhistory')->where('nip', '=', $nip)->get();
            return view('adminhome', compact('collections', 'timereports', 'type', 'topthrees', 'bottomthrees', 'topfivecompanies', 'maxperiod', 'lastmonth', 'minusregularhours'))
                ->with('month', $month)
                ->with('periode', $periode)
                ->with('listbyperiodes', $listbyperiodes)
                ->with('nip', $nip)
                ->with('type', $type)
                ->with('manualinputcuti', $manualinputcuti)
                ->with('jatahcutiawal', $jatahcutiawal)
                ->with('manualinputcutiplus', $manualinputcutiplus)
                ->with('manualinputcutiminus', $manualinputcutiminus)
                ->with('division', $division)
                ->with('employees', $employees)
                ->with('approvedrequest', $approvedrequest)
                ->with('availableleave', $availableleave)
                ->with('checkdivisions', $checkdivisions)
                ->with('inchargestatus', $inchargestatus)
                ->with('type1s', $type1s)
                ->with('type2s', $type2s)
                ->with('type3s', $type3s)
                ->with('type4s', $type4s)
                ->with('type6s', $type6s)
                ->with('totalrequest', $totalrequest)
                ->with('totalworkhours', $totalworkhours)
                ->with('totals', $totals)
                ->with('greetings', $greetings)
                ->with('emotionalgreetings', $emotionalgreetings)
                ->with('emoticoncode', $emoticoncode)
                ->with('overtimearrays', json_encode($array));

        }
    }
}

