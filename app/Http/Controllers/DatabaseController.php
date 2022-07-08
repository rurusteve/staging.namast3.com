<?php

namespace App\Http\Controllers;

use App\DatabaseAnak;
use App\DeletedBiodata;
use App\Exports\DatasExport;
use App\Exports\DatasExportAllTimes;
use App\File;
use App\Imports\DatasImport;
use App\Imports\EmployeeBiodataImport;
use App\Imports\EmployeePayrollDataImport;
use App\MasterBiodata;
use App\ProfilePicture;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\MasterEmployee;
use Illuminate\Support\Facades\Storage;
use Maatwebsite\Excel\Excel;

class DatabaseController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function account($id)
    {

        $employees = MasterEmployee::find($id);
        $nip = $employees->nip;
        $biodatas = MasterBiodata::where('nip', '=', $nip)->first();
        $countbiodatas = MasterBiodata::where('nip', '=', $nip)->count();
        $files = File::where('nip', '=', $nip)->orderBy('created_at', 'DESC')
            ->paginate(30);
        $childs = DatabaseAnak::where('nip', '=', $nip)->get();
        $jumlahanak = DatabaseAnak::where('nip', '=', $nip)->count();
        $profiles = ProfilePicture::where('nip', '=', $nip)->orderBy('created_at', 'DESC')->first();
        $checkprofilepicture = ProfilePicture::where('nip', '=', $nip)->count();
        return view('account', compact('employees'), compact('files'), compact('biodatas'), ['profiles',$profiles])
            ->with('profiles', $profiles)
            ->with('biodatas', $biodatas)
            ->with('checkprofilepicture', $checkprofilepicture)
            ->with('childs', $childs)
            ->with('jumlahanak', $jumlahanak)
            ->with('countbiodatas', $countbiodatas);
    }

    public function biodatadetail($id)
    {

        $biodatas = MasterBiodata::find($id);
        $nip = $biodatas->nip;
        $employees = MasterEmployee::where('nip', '=', $nip)->first();
        return view('biodatadetail', ['biodatas' => $biodatas], ['employees' => $employees])->with('employees', $employees);
    }

    public function home()
    {
        return view('biodatahome');
    }

    public function index()
    {
        $biodatas = DB::table('masteremployee')->join('masterbiodata', 'masteremployee.nip', '=', 'masterbiodata.nip')->get();
//        $biodatas = DB::table('masterbiodata')
//            ->join('masteremployee', 'masterbiodata.nip', '=', 'masteremployee.nip')
//            ->get()
//            ->paginate(10);
        $role = Auth::user()->role;
        $count = MasterBiodata::count();

        return view('employeebiodata', ['biodatas' => $biodatas])
            ->with('count', $count)
            ->with('role', $role);
    }

    public function create()
    {
        return view('hrd.biodata.inputbiodata');
    }

    public function input(Request $request)
    {
        $biodata = new MasterBiodata();
        $this->validate($request, [
            'nip' => 'required',
            'tempatlahir' => 'required',
            'tanggallahir' => 'required',
            'nohp' => '',
            'nomorkontakdarurat' => '',
            'namakontakdarurat' => '',
            'emailpribadi' => '',
            'domisili' => '',
            'kodepos' => '',
            'nik' => '',
            'agama' => '',
            'statussipil' => '',
            'namapasangan' => '',
            'tanggallahirpasangan' => '',
            'jumlahanak' => '',
            'pendidikanterakhir' => '',
            'universitas' => '',
            'bpjskes' => '',
            'kodebpjskes' => '',
            'bpjstk' => '',
            'kodebpjstk' => '',
            'asuransi' => '',
            'riwayatpenyakit' => '',
        ]);

        $biodata->nip = $request->nip;
        $biodata->tempatlahir = $request->tempatlahir;
        $biodata->tanggallahir = Carbon::parse($request->tanggallahir);
        $biodata->nohp = $request->nohp;
        $biodata->nomorkontakdarurat = $request->nomorkontakdarurat;
        $biodata->namakontakdarurat = $request->namakontakdarurat;
        $biodata->emailpribadi = $request->emailpribadi;
        $biodata->domisili = $request->domisili;
        $biodata->kodepos = $request->kodepos;
        $biodata->nik = $request->nik;
        $biodata->agama = $request->agama;
        $biodata->statussipil = $request->statussipil;
        $biodata->namapasangan = $request->namapasangan;
        $biodata->tanggallahirpasangan = Carbon::parse($request->tanggallahirpasangan);
        $biodata->jumlahanak = $request->jumlahanak;
        $biodata->pendidikanterakhir = $request->pendidikanterakhir;
        $biodata->universitas = $request->universitas;
        $biodata->bpjskes = $request->bpjskes;
        $biodata->kodebpjskes = $request->kodebpjskes;
        $biodata->bpjstk = $request->bpjstk;
        $biodata->kodebpjstk = $request->kodebpjstk;
        $biodata->asuransi = $request->asuransi;
        $biodata->riwayatpenyakit = $request->riwayatpenyakit;
        $biodata->jeniskelamin = $request->jeniskelamin;
        $biodata->noijazah = $request->noijazah;


        $biodata->save();
//        $fetchedUser = MasterBiodata::find($biodata->id);
//        var_dump($fetchedUser);
        return view('/employeebiodata');
    }

    public function edit($id)
    {
        $biodatas = MasterBiodata::find($id);

        return view('editemployeebiodata', ['biodatas' => $biodatas])->with('biodatas', $biodatas);
    }

    public function update(Request $request, $id)
    {

        $biodatas = MasterBiodata::find($id);
        $biodatas->nip = $request->nip;
        $biodatas->tempatlahir = $request->tempatlahir;
        $biodatas->tanggallahir = Carbon::parse($request->tanggallahir);
        $biodatas->nohp = $request->nohp;
        $biodatas->nomorkontakdarurat = $request->nomorkontakdarurat;
        $biodatas->namakontakdarurat = $request->namakontakdarurat;
        $biodatas->emailpribadi = $request->emailpribadi;
        $biodatas->domisili = $request->domisili;
        $biodatas->kodepos = $request->kodepos;
        $biodatas->nik = $request->nik;
        $biodatas->agama = $request->agama;
        $biodatas->statussipil = $request->statussipil;
        $biodatas->namapasangan = $request->namapasangan;
        $biodatas->tanggallahirpasangan = Carbon::parse($request->tanggallahirpasangan);
        $biodatas->jumlahanak = $request->jumlahanak;
        $biodatas->pendidikanterakhir = $request->pendidikanterakhir;
        $biodatas->universitas = $request->universitas;
        $biodatas->bpjskes = $request->bpjskes;
        $biodatas->bpjstk = $request->bpjstk;
        $biodatas->asuransi = $request->asuransi;
        $biodatas->riwayatpenyakit = $request->riwayatpenyakit;
        $biodatas->jeniskelamin = $request->jeniskelamin;
                $biodatas->noijazah = $request->noijazah;


        $biodatas->update();
        return redirect('/employeebiodata');
    }

    public function destroy($id)
    {
        $employees = MasterEmployee::find($id);

        $employees->delete();
        return redirect('/employeebiodata');
    }

    public function deletefile($id, $emid)
    {
        $file = File::find($id);
        $file->delete();
        return redirect('/account/'.$emid.'/detail');
    }

    public function destroybiodata($id)
    {
        $biodatastroy = MasterBiodata::find($id);
        $biodatas = new DeletedBiodata();
        $dataemployee = MasterBiodata::where('id', '=', $id)->first();

        $biodatas->nip = $dataemployee -> nip;
        $biodatas->tempatlahir = $dataemployee -> tempatlahir;
        $biodatas->tanggallahir = $dataemployee -> tanggallahir;
        $biodatas->nohp = $dataemployee -> nohop;
        $biodatas->nomorkontakdarurat = $dataemployee -> nomorkontakdarurat;
        $biodatas->namakontakdarurat = $dataemployee -> namakontakdarurat;
        $biodatas->emailpribadi = $dataemployee -> emailpribadi;
        $biodatas->domisili = $dataemployee -> domisili;
        $biodatas->kodepos = $dataemployee -> kodepos;
        $biodatas->nik = $dataemployee -> nik;
        $biodatas->agama = $dataemployee -> agama;
        $biodatas->statussipil = $dataemployee -> statussipil;
        $biodatas->namapasangan = $dataemployee -> namapasangan;
        $biodatas->tanggallahirpasangan = $dataemployee -> tanggallahirpasangan;
        $biodatas->jumlahanak = $dataemployee -> jumlahanak;
        $biodatas->pendidikanterakhir = $dataemployee -> pendidikanterakhir;
        $biodatas->universitas = $dataemployee -> universitas;
        $biodatas->bpjskes = $dataemployee -> bpjskes;
        $biodatas->bpjstk = $dataemployee -> bpjstk;
        $biodatas->asuransi = $dataemployee -> asuransi;
        $biodatas->riwayatpenyakit = $dataemployee -> riwayatpenyakit;
        $biodatas->jeniskelamin = $dataemployee -> jeniskelamin;

            $biodatas->save();
        $biodatastroy->delete();
        return redirect('/employeebiodata');
    }

    public function downloadsummary(Request $request)
    {
//        switch ($request->input('action')) {
//            case 'xls':
//                return (new PayrollHistoryExport())->sendPara($request)->download();
//                break;
//            case 'print':
//                $results = MasterPayrollHistory::query()
//                    ->join('masteremployee', 'payrollhistory.nip', '=', 'masteremployee.nip')
//                    ->join('payrollinput', 'payrollhistory.nip', '=', 'payrollinput.nip');
//
//                if ($request->has('institusi')) {
//                    $results->where('institusi', '=', $request->institusi);
//                }
//                if ($request->has('kota')) {
//                    $results->where('kota', '=', $request->kota);
//                }
//                if ($request->has('status')) {
//                    $results->where('status', '=', $request->status);
//                }
//                if ($request->has('positionid')) {
//                    $results->where('positionid', '=', $request->positionid);
//                }
//                if ($request->has('grade')) {
//                    $results->where('grade', '=', $request->grade);
//                }
//                if ($request->has('group')) {
//                    $results->where('grup', '=', $request->group);
//                }
//                if ($request->has('period')) {
//
//                    $results->where('payrollhistory.periode', '=', $request->period);
//                }
//                $collections = $results->get();
//
//                return view('print.payrolldata', compact('collections', 'request'));
//                break;
//        }



        return \Maatwebsite\Excel\Facades\Excel::download(new DatasExportAllTimes(), 'alltimesummary.xlsx');

    }
    public function downloaddata(Request $request)
    {
        return (new DatasExport())->sendPara($request)->download('Payroll History-' . date('F', mktime(0, 0, 0, $request -> periode, 10)).'.xlsx');
//        return \Maatwebsite\Excel\Facades\Excel::download(new DatasExport(), 'summarythismonth.xlsx')->sendPara($request);

    }
    public function downloadtemplatepenugasan($path)
    {
        return Storage::download($path);
    }
    public function importdata(Request $request)
    {
        \Maatwebsite\Excel\Facades\Excel::import(new DatasImport(), request()->file('templatepayrollinput'));
        return redirect('/payroll/run')->with('success', 'All good!');
    }
    public function importdataemployeepayroll(Request $request)
    {
        \Maatwebsite\Excel\Facades\Excel::import(new EmployeePayrollDataImport(), request()->file('templateemployeepayrolldata'));
        return redirect('/employeedatabase')->with('success', 'All good!');
    }
    public function importdataemployeebiodata(Request $request)
    {
        \Maatwebsite\Excel\Facades\Excel::import(new EmployeeBiodataImport(), request()->file('templateemployeebiodata'));
        return redirect('/employeebiodata')->with('success', 'All good!');
    }
}
