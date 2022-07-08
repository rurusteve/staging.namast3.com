<?php

namespace App\Http\Controllers;

use App\MasterClient;
use App\MasterManualInput;
use App\MasterTask;
use App\LeaveRequest;
use App\User;
use App\MasterEmployee;
use App\DeletedLeaveRequest;
use App\Division;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class AdministratorController extends Controller
{
    public function indexclients(){
        $clients = DB::table('masterclients')->where('institusi', 'MSId')->get();
        return view('clientsadministration', ['clients' => $clients]);
    }
    public function indexclientsolis(){
        $clients = DB::table('masterclients')->where('institusi', 'Solis')->get();
        return view('clientsadministrationsolis', ['clients' => $clients]);
    }
    public function indextasks(){
        $tasks = DB::table('mastertasks')->orderBy('activities', 'asc')->get();
        return view('tasksadministration', ['tasks' => $tasks]);
    }
    public function indexdivisions(){
        $divisions = Division::all();
        return view('divisions', ['divisions' => $divisions]);
    }
    public function createclients(){
        return view('inputclient');
    }
    public function createtasks(){
        return view('inputtask');
    }
    public function createdivisions(){
        return view('inputdivision');
    }
    public function insertclients(Request $request){
        $clients = new MasterClient();
        $this->validate($request,[
            'clientname' => '',
            'clientcode' => '',
            'engagementdate' => '',
            'engagementperiod' => '',
            'location' => '',
            'fee' => '',
            'keterangan' => '',
            'institusi' => ''
        ]);
        $clients->clientname = $request->clientname;
        $clients->clientcode = $request->clientcode;
        $clients->engagementtype = $request->engagementtype;
        $clients->engagementperiodstart = Carbon::parse($request->engagementdatestart);
        $clients->engagementperiod = Carbon::parse($request->engagementdate);
        $clients->location = $request->location;
        $clients->fee = $request->fee;
        $clients->keterangan = $request->keterangan;
        $clients->institusi = $request->institusi;
        $clients->branch = $request->branch;
        $clients->keterangan = $request->keterangan;

        $clients->save();
        return redirect()->back();
    }
    public function inserttasks(Request $request){
        $tasks = new MasterTask();
        $this->validate($request,[
            'taskname' => '',
            'activities' => ''
        ]);

        $tasks->taskname = $request->taskname;
        $tasks->division = $request->division;
        $tasks->activities = $request->activities;

        $tasks->save();
        return redirect()->back();
    }

    public function insertdivision(Request $request){
        $division = new Division();

        $division->name = $request->name;
        $division->code = $request->code;
        $division->branch_id = $request->branch;

        $division->save();

        return redirect()->route('administration.timereport.divisionlist');
    }

    public function deletedivision($id) {
        $clients = Division::where('id', $id)->first();
        $clients->delete();
        return redirect()->route('administration.timereport.divisionlist');
    }

    public function deleteclient($id) {
        $clients = MasterClient::where('id', $id)->first();
        $clients -> delete();
        return redirect('/administration/timereport/clients/msid');
    }
    public function clientdetail($id) {
        $clients = MasterClient::where('id', $id)->first();
        return view('clientdetail', ['clients' => $clients]);
    }
    public function editclient($id) {
        $clients = MasterClient::where('id', $id)->first();
        return view('editclient', ['clients' => $clients]);
    }
    public function updateclient(Request $request,$id) {
        $clients = MasterClient::where('id', $id)->first();

        $this->validate($request,[
            'clientname' => '',
            'clientcode' => '',
            'engagementdate' => '',
            'engagementperiod' => '',
            'engagementperiodstart' => '',
            'location' => '',
            'fee' => '',
            'keterangan' => '',
            'institusi' => '',
            'feenonrupiah'
        ]);
        $clients->clientname = $request->clientname;
        $clients->clientcode = $request->clientcode;
        $clients->engagementtype = $request->engagementtype;
        $clients->engagementperiod = Carbon::parse($request->engagementperiod);
        $clients->engagementperiodstart = Carbon::parse($request->engagementperiodstart);
        $clients->location = $request->location;
        $clients->fee = $request->fee;
        $clients->feenonrupiah = $request->feenonrupiah;
        $clients->keterangan = $request->keterangan;
        $clients->institusi = $request->institusi;
        $clients->branch = $request->branch;

        $clients->save();
        return redirect('/administration/timereport/'.$id.'/detail');
    }
    public function deletetask($id) {
        $clients = MasterTask::where('id', $id)->first();
        $clients -> delete();
        return redirect('/administration/timereport/tasks');
    }
    public function bulkleave(Request $request){
        $insertmanuals = DB::table('masteremployee')
            ->where('tanggalbergabung', '<=', Carbon::now()->subDays(365)->toDateTimeString())
            ->get();
        $this->validate($request,[
            'modifyleave' => '',
            'keteranganpenambahancuti' => '',
            'tanggalmulaicuti' => '',
            'tanggalakhircuti' => ''
        ]);
        foreach ($insertmanuals as $insertmanual) {
            $data[] = [
                'jumlahhari' => $request -> modifyleave,
                'nip' => $insertmanual->nip,
                'nama' => $insertmanual->nama,
                'tanggalmulaicuti' => Carbon::parse($request -> tanggalmulaicuti),
                'tanggalakhircuti' => Carbon::parse($request -> tanggalakhircuti),
                'keterangan' => $request -> keteranganpenambahancuti,
                'jeniscuti' => 99,
                'statuscuti' => 'approved',
                'bypartner' => 1,
                'divisi' => $insertmanual->divisi,
                'leaverequesttype' => 99,
                'ketbypartner' => $request -> keteranganpenambahancuti
            ];
        }
        LeaveRequest::insert($data);
        return redirect('manualinput')->with('success', 'Cuti massal: '.$request -> keteranganpenambahancuti.' tanggal '. Carbon::parse($request -> tanggalmulaicuti)->format('d').' - '.Carbon::parse($request -> tanggalakhircuti)->format('d F').' telah berhasil dimasukkan kedalam record');
    }

    public function bulkleavesurplus(Request $request){
        $insertmanuals = DB::table('masteremployee')->get();
        foreach ($insertmanuals as $insertmanual) {
            $data[] = [
                'modifyleave' => $request->modifyleave,
                'modifystatus' => 1,
                'nip' => $insertmanual->nip,
                'keteranganpenambahancuti' => $request -> keteranganpenambahancuti,
            ];
        }
        MasterManualInput::insert($data);
        return redirect('manualinput')->with('success', 'Cuti massal: '.$request -> keteranganpenambahancuti.' tanggal '. Carbon::parse($request -> tanggalmulaicuti)->format('d').' - '.Carbon::parse($request -> tanggalakhircuti)->format('d F').' telah berhasil dimasukkan kedalam record');
    }

    public function listuser()
    {
        $users = DB::table('users2')->get();
        return view('hrd.listuser', compact('users'));
    }
    public function adduserform()
    {
        return view('hrd.adduser');
    }

    public function adduser(Request $request)
    {
        $user = new User();

        $user->nip = $request->nip;
        $user->email = $request->email;
        $user->name = $request->name;
        $user->contact = $request->contact;
        $user->division = $request->division;
        $user->logintype = $request->logintype;
        $user->admin = $request->admin;
        $user->password = Hash::make($request->password);
        $user->save();

        return redirect('/home');
    }
    public function teammanagementindex()
    {
        $groups = MasterEmployee::groupBy('divisi')->select(DB::raw('COUNT(NIP) as countmember'), 'masteremployee.*', DB::raw('SUM(inchargestatus) as countincharge'))->where('divisi', '!=', 'PARTNER')->get();
        $employees = MasterEmployee::leftJoin('groups', 'masteremployee.divisi', '=', 'groups.id')->select('masteremployee.id as id', 'groups.name as groupName', 'masteremployee.*')->get();
        return view('hrd.teammanagement', compact('groups', 'employees'));
    }
    public function teammanagementmove(Request $request, $nip) {
        $employees = MasterEmployee::where('nip', $nip)->first();
        $employees->divisi = $request->divisi;
        $employees->save();
        return redirect('/teammanagement');
    }
    public function teammanagementchangeincharge(Request $request, $nip) {
        $employees = MasterEmployee::where('nip', $nip)->first();
        $employees->inchargestatus = $request->inchargestatus;
        $employees->save();
        return redirect('/teammanagement');
    }
    public function manualinputindex()
    {

        $employees = DB::table('masteremployee')->get();
        $aprrovedrequest = LeaveRequest::where('statuscuti', '=', 'approved')->sum('jumlahhari');
        $totalrequest = LeaveRequest::sum('jumlahhari');


        return view('manualinput', ['employees' => $employees])
            ->with('approvedrequest', $aprrovedrequest)
            ->with('totalrequest', $totalrequest);
    }

    public function manualinputdetail($id)
    {
        $countrequest = DB::table('leaverequest')->count();
        $leaverequests = DB::table('leaverequest')->paginate(10);
        $aprrovedrequest = LeaveRequest::where('nip', '=', $id)->where('statuscuti', '=', 'approved')->sum('jumlahhari');
        $modifyleave = MasterManualInput::where('nip', '=', $id)->sum('modifyleave');
        $availableleave = 0 - $aprrovedrequest + $modifyleave;
        $employees = MasterEmployee::where('nip', '=', $id)->first();

        return view('manualinputdetail', ['leaverequests' => $leaverequests], ['approvedrequest' => $aprrovedrequest])
            ->with('availableleave', $availableleave)
            ->with('countrequest', $countrequest)
            ->with('employees', $employees)
            ->with('modifyleave', $modifyleave);
    }

    public function manualinputmodify(Request $request, $id)
    {
        $manualinputs = new MasterManualInput();

        $this->validate($request, [
            'penambahancuti' => 'required',
            'nip' => '',
            'keteranganpenambahancuti' => '',
            'modifystatus' => '',
        ]);
        $manualinputs->modifyleave = $request->penambahancuti;
        $manualinputs->nip = $id;
        $manualinputs->keteranganpenambahancuti = $request->keteranganpenambahancuti;
        $manualinputs->modifystatus = $request->modifystatus;
        $manualinputs->save();
        return redirect('/manualinput')
            ->with('alert', 'Leave addition/substraction was successfully inputed');
    }

    public function leavelist(Request $request)
    {

        $from = $request->startdate;
        $to = $request->enddate;
        $statusrequest = $request->status;


        $approvedlists = DB::table('leaverequest')
            ->join('masteremployee', 'leaverequest.nip','masteremployee.nip')->select('leaverequest.*', 'masteremployee.*', 'leaverequest.id as id', 'leaverequest.created_at as created_at')->orderBy('leaverequest.created_at', 'desc')->get();
        $employees = null;
        return view('approvedlist', ['approvedlists' => $approvedlists])
            ->with('statusrequest', $statusrequest)
            ->with('from', $from)
            ->with('to', $to)
            ->with('employees', $employees);
    }
    public function leavelistnip(Request $request, $nip)
    {

        $from = $request->startdate;
        $to = $request->enddate;
        $statusrequest = $request->status;

//        if ($statusrequest === 'null') {
//            if ($request->has('_token')) {
//                if ($from === null || $to == null) {
//                    $approvedlists = DB::table('leaverequest')->where('statuscuti', '!=', $statusrequest)->paginate(50);
//                } else {
//                    $approvedlists = DB::table('leaverequest')->where('statuscuti', '!=', $statusrequest)->whereBetween('managerapprovaldate', [$from, $to])->paginate(50);
//                }
//            } else {
//                $approvedlists = DB::table('leaverequest')->where('statuscuti', '!=', $statusrequest)->paginate(50);
//            }
//        } elseif ($statusrequest === 'approved' || $statusrequest === 'declined') {
//            if ($request->has('_token')) {
//                if ($from == null || $to == null) {
//                    $approvedlists = DB::table('leaverequest')->where('statuscuti', '=', $statusrequest)->paginate(50);
//                } else {
//                    $approvedlists = DB::table('leaverequest')->where('statuscuti', '=', $statusrequest)->whereBetween('managerapprovaldate', [$from, $to])->paginate(50);
//                }
////                $approvedlists = DB::table('leaverequest')->where('statuscuti', '=', $statusrequest)->whereBetween('managerapprovaldate', [$from, $to])->paginate(50);
//            } else {
//                $approvedlists = DB::table('leaverequest')->where('statuscuti', '=', $statusrequest)->paginate(50);
//            }
//        } elseif ($statusrequest !== 'approved' || $statusrequest !== 'declined' || $statusrequest !== 'null') {
//            $approvedlists = DB::table('leaverequest')->where('statuscuti', '!=', null)->paginate(50);
//
//        }
        $manualinputs = DB::table('manualinput')->where('nip', $nip)->get();
        $approvedlists = DB::table('leaverequest')
            ->join('masteremployee', 'leaverequest.nip','masteremployee.nip')->where('statuscuti', '!=', null)
            ->orderBy('leaverequest.created_at', 'desc')
            ->where('leaverequest.nip', $nip)
            ->get();
        $countrequest = DB::table('leaverequest')->count();
        $leaverequests = DB::table('leaverequest')->paginate(10);
        $aprrovedrequest = LeaveRequest::where('nip', '=', $nip)->where('statuscuti', '=', 'approved')->sum('jumlahhari');
        $modifyleave = MasterManualInput::where('nip', '=', $nip)->sum('modifyleave');
        $employees = MasterEmployee::where('nip', '=', $nip)->first();
        $jatahcutiawal = DB::table('manualinput')->where('modifyleave', '>', 0)->where('modifystatus', '=', 1)->where('nip', '=', $nip)->sum('modifyleave');
        $manualinputcutiplus = DB::table('manualinput')->where('modifyleave', '>', 0)->where('modifystatus', '=', 2)->where('nip', '=', $nip)->sum('modifyleave');
        $manualinputcutiminus = DB::table('manualinput')->whereRaw('modifyleave < 0')->where('modifystatus', '=', 2)->where('nip', '=', $nip)->sum('modifyleave');
        $availableleave = $jatahcutiawal - $manualinputcutiplus + $manualinputcutiminus - $aprrovedrequest;
        $keteranganinputcutiplus = DB::table('manualinput')->where('modifyleave', '>', 0)->where('modifystatus', '=', 2)->where('nip', '=', $nip)->get();
        $keteranganinputcutiminus = DB::table('manualinput')->whereRaw('modifyleave < 0')->where('modifystatus', '=', 2)->where('nip', '=', $nip)->get();


        return view('approvedlist', compact('manualinputs'), ['approvedlists' => $approvedlists], ['leaverequests' => $leaverequests], compact('keteranganinputcutiminus', 'keteranganinputcutiplus'))
            ->with('statusrequest', $statusrequest)
            ->with('from', $from)
            ->with('to', $to)
            ->with('approvedrequest', $aprrovedrequest)
            ->with('availableleave', $availableleave)
            ->with('countrequest', $countrequest)
            ->with('employees', $employees)
            ->with('modifyleave', $modifyleave)
            ->with('jatahcutiawal', $jatahcutiawal)
            ->with('manualinputcutiplus', $manualinputcutiplus)
            ->with('manualinputcutiminus', $manualinputcutiminus);
    }
    public function destroyleave($id)
    {
        $leaverequests = DB::table('leaverequest')->where('id', $id)->first();

        $deletedleaverequests = new DeletedLeaveRequest();

        $deletedleaverequests->deletedid	=  $id;
        $deletedleaverequests->nip	= $leaverequests->nip;
        $deletedleaverequests->nama	= $leaverequests->nama;
        $deletedleaverequests->jumlahhari	= $leaverequests->jumlahhari;
        $deletedleaverequests->tanggalmulaicuti	= $leaverequests->tanggalmulaicuti;
        $deletedleaverequests->tanggalakhircuti	= $leaverequests->tanggalakhircuti;
        $deletedleaverequests->keterangan	= $leaverequests->keterangan;
        $deletedleaverequests->jeniscuti	= $leaverequests->jeniscuti;
        $deletedleaverequests->filename	= $leaverequests->filename;
        $deletedleaverequests->lampiranpenugasan	= $leaverequests->lampiranpenugasan;
        $deletedleaverequests->statuscuti	= $leaverequests->statuscuti;
        $deletedleaverequests->deletedleaverequesttype	= $leaverequests->leaverequesttype;
        $deletedleaverequests->divisi	= $leaverequests->divisi;
        $deletedleaverequests->bypartner	= $leaverequests->bypartner;
        $deletedleaverequests->nippartner	= $leaverequests->nippartner;
        $deletedleaverequests->ketbypartner	= $leaverequests->ketbypartner;
        $deletedleaverequests->partnerapprovaldate	= $leaverequests->partnerapprovaldate;
        $deletedleaverequests->bymanager	= $leaverequests->bymanager;
        $deletedleaverequests->nipmanager	= $leaverequests->nipmanager;
        $deletedleaverequests->ketbymanager	= $leaverequests->ketbymanager;
        $deletedleaverequests->managerapprovaldate= $leaverequests->managerapprovaldate;
            $deletedleaverequests->deletedby = Auth::user()->nip;


        $deletedleaverequests->save();
        $deletedleaverequestdata = DB::table('deletedleaverequest')->where('deletedid', $id)->first();

        $leaverequest = DB::table('leaverequest')->where('id', $id);
        $leaverequest->delete();
        return redirect('/leave/list')->with('success', 'Data cuti '.$deletedleaverequestdata->nama.' pada tanggal '.$deletedleaverequestdata->tanggalmulaicuti.' - '.$deletedleaverequestdata->tanggalakhircuti.' berhasil dihapus');
    }


}
