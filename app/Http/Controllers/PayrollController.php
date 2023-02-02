<?php

namespace App\Http\Controllers;

use App\DeletedEmployee;
use App\DeletedHistory;
use App\DeletedPayrollInput;
use App\Exports\PayrollCalculationExport;
use App\Group;
use App\Division;
use App\EmployeeHistory;
use App\EmployeePosition;
use App\MasterPayrollHistory;
use App\MasterPayrollInput;
use App\OldSalaries;
use App\User;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\MasterEmployee;
use App\MasterEmployeeHistory;
use App\Positions;
use App\TimeReport;
use Illuminate\Support\Facades\Hash;

use function App\getEndPeriod;
use function App\getStartPeriod;

//use Vinkla\Hashids\Facades\Hashids;


class PayrollController extends Controller
{


    public function salaryslip(Request $request)
    {

        $employees = MasterEmployee::all();
        $count = MasterEmployee::count();

        return view('employeedatabase', ['employees' => $employees])->with('count', $count);
    }

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function home()
    {
        return view('hrd.payroll.payrollhome');
    }

    public function index(Request $request)
    {

        $results = DB::table('masteremployee')->select(DB::raw("DATEDIFF(NOW(),tanggalbergabung) AS datediff"), 'masteremployee.*');

        if (\request()->has('institusi')) {
            $results->where('institusi', \request('institusi'));
        }
        if (\request()->has('status')) {
            $results->where('status', \request('status'))->get();
        }
        if (\request()->has('tanggalbergabung')) {
            $results->orderBy('tanggalbergabung', 'desc', \request('tanggalbergabung'))->get();
        }
        if (\request()->has('orderstatus')) {
            $results->orderBy('status', 'asc', \request('orderstatus'))->get();
        }
        if (\request()->has('nama')) {
            $results->orderBy('nama', 'asc', \request('nama'))->get();
        }
        if (\request()->has('nip')) {
            $results->orderBy('nip', 'desc', \request('nip'))->get();
        }
        if (\request()->has('positionid')) {
            $results->orderBy('positionid', 'asc', \request('positionid'))->get();
        }
        if (\request()->has('kota')) {
            $results->orderBy('kota', 'asc', \request('kota'))->get();
        }
        $statuses = DB::table('masteremployee')->groupBy('status')->where('status', 'not like', '%/%')->get();
        $employees = $results->get();
        return view('employeedatabase', compact('employees', 'statuses'));
    }

    public function payrollhistoryindex(Request $request)
    {


        $thismonth = Carbon::now('m');
        $month = Carbon::now('m');

        $periodes = DB::table('payrollhistory')->groupBy('periode')->get();

        if (\request('period')) {
            $employees = DB::table('payrollhistory')->where('periode', '=', \request('period'))->get();
            $count = MasterEmployee::count();
        } else {
            $employees = DB::table('payrollhistory')->where('periode', '=', $thismonth)->get();
            $count = MasterEmployee::count();
        }
        return view('hrd.payroll.payrollhistory', compact('employees', 'periodes', 'count', 'thismonth'));
    }

    public function deletepayrollinput($id)
    {
        $payrollinput = MasterPayrollInput::find($id);
        $deletedpayrollinput = new DeletedPayrollInput();

        $inputhistory = MasterPayrollInput::where('id', '=', $id)->first();
        $name = Auth::user()->name;

        $deletedpayrollinput->admin = $name;
        $deletedpayrollinput->nip = $inputhistory->nip;
        $deletedpayrollinput->jumlahharihadir = $inputhistory->jumlahharihadir;
        $deletedpayrollinput->haridalamsebulan = $inputhistory->haridalamsebulan;
        $deletedpayrollinput->jumlahkehadirandalamjam = $inputhistory->jumlahkehadirandalamjam;
        $deletedpayrollinput->jumlahjamlemburinput = $inputhistory->jumlahjamlemburinput;
        $deletedpayrollinput->potonganpp = $inputhistory->potonganpp;
        $deletedpayrollinput->jumlahlemburtidakefektif = $inputhistory->jumlahlemburtidakefektif;
        $deletedpayrollinput->jumlahharilembursebulan = $inputhistory->jumlahharilembursebulan;
        $deletedpayrollinput->jumlahharilembur = $inputhistory->jumlahharilembur;
        $deletedpayrollinput->jumlahharibermalam = $inputhistory->jumlahharibermalam;
        $deletedpayrollinput->jumlahopeinput = $inputhistory->jumlahopeinput;
        $deletedpayrollinput->jumlahklaimpengobatan = $inputhistory->jumlahklaimpengobatan;
        $deletedpayrollinput->jumlahklaimakumulasiinput = $inputhistory->jumlahklaimakumulasiinput;
        $deletedpayrollinput->tunjanganhariraya = $inputhistory->tunjanganhariraya;
        $deletedpayrollinput->insentif = $inputhistory->insentif;
        $deletedpayrollinput->bonus = $inputhistory->bonus;
        $deletedpayrollinput->insentifpenghargaan = $inputhistory->insentifpenghargaan;
        $deletedpayrollinput->pencairanpinjaman = $inputhistory->pencairanpinjaman;
        $deletedpayrollinput->pengembaliandeposit = $inputhistory->pengembaliandeposit;
        $deletedpayrollinput->pembayaranpinjaman = $inputhistory->pembayaranpinjaman;
        $deletedpayrollinput->pemotongandeposit = $inputhistory->pemotongandeposit;
        $deletedpayrollinput->penaltikerja = $inputhistory->penaltikerja;
        $deletedpayrollinput->pembayaranterlebihdahulu = $inputhistory->pembayaranterlebihdahulu;
        $deletedpayrollinput->iurankoperasi = $inputhistory->iurankoperasi;
        $deletedpayrollinput->bpjsketenagakerjaan = $inputhistory->bpjsketenagakerjaan;
        $deletedpayrollinput->bpjspensiun = $inputhistory->bpjspensiun;
        $deletedpayrollinput->bpjskesehatan = $inputhistory->bpjskesehatan;
        $deletedpayrollinput->pphpasal21 = $inputhistory->pphpasal21;
        $deletedpayrollinput->koreksipengurangan = $inputhistory->koreksipengurangan;
        $deletedpayrollinput->koreksipenambahan = $inputhistory->koreksipenambahan;
        $deletedpayrollinput->periode = $inputhistory->periode;
        $deletedpayrollinput->telahdibayarsebelumnya = $inputhistory->telahdibayarsebelumnya;

        $deletedpayrollinput->save();

        $payrollinput->delete();
        return redirect('/payroll/run/');
    }

    public function runpayrollindex(Request $request)
    {

        if (\request()->has('period')) {
            $thismonth = \request('period');
        } else {
            $thismonth = Carbon::now('m');
        }

        $inputs = MasterEmployee::join('payrollinput', 'masteremployee.nip', '=', 'payrollinput.nip')
            ->join('statuses', 'masteremployee.nip', '=', 'statuses.nip')
            ->select(
                'masteremployee.id as id',
                'masteremployee.nip as nip',
                'masteremployee.kota as kota',
                'masteremployee.institusi as institusi',
                'masteremployee.nama as nama',
                'payrollinput.payrollcheck as payrollcheck',
                'payrollinput.id as inputid',
                'payrollinput.*',
                'statuses.id as statusid',
                'statuses.*'
            )
            ->where('payrollinput.periode', '=', $thismonth)
            ->where('statuses.period', '=', $thismonth);

        // ->where('payrollinput.jumlahharihadir', '>', 0);
        if (\request()->has('belumdiproses')) {
            $inputs->where('payrollcheck', '=', NULL);
        }
        if (\request()->has('sudahdiproses')) {
            $inputs->where('payrollcheck', '=', 'done');
        }
        if (\request()->has('tanggalbergabung')) {
            $inputs->orderBy('tanggalbergabung', \request('tanggalbergabung'));
        }
        if (\request()->has('nama')) {
            $inputs->orderBy('nama', \request('nama'));
        }
        $employees = $inputs->get();
        $count = MasterEmployee::count();
        $hitung = DB::table('masteremployee')
            ->join('payrollinput', 'masteremployee.nip', '=', 'payrollinput.nip')
            ->count();
        if ($request->has('download')) {
            $pdf = PDF::loadView('pdfview');
            return $pdf->download('pdfview.pdf');
        }

        return view('runpayrollhome', compact('employees', 'count', 'thismonth', 'hitung'));
    }


    public function payrollingall($period)
    {
        $payroll = MasterPayrollHistory::payrollingAll($period, $submit = true);
        // $payroll->submitPayroll($payroll['phistory'], $payroll['datathismonth'])
        return redirect()->back();
    }

    public function simulatePayrollingAll($period)
    {
        return (new PayrollCalculationExport((int)$period))->download('payroll-' . Carbon::now() . '-.xlsx');
    }

    public function payrolling($nip, $month, $nama)
    {

        // $month = 7;
        $month = Carbon::now('m');
        $thismonth = Carbon::now('m');
        $employees = MasterPayrollInput::where('periode', $month)->where('payrollcheck', NULL)->get();

        $phistory = new MasterPayrollHistory();
        $employeepayrolldata = MasterEmployee::where('nip', '=', $nip)->first();
        $datathismonth = MasterPayrollInput::where('nip', '=', $nip)->where('periode', $month)->first();
        $checkhistory = MasterPayrollHistory::where('nip', '=', $nip)->where('periode', $month)->first();

        if ($employeepayrolldata == null) {
        } else {
            // check if already exist in payroll history
            if ($checkhistory == null || $checkhistory == "" || $checkhistory == " ") {

                $phistory->nip = $employeepayrolldata->nip;
                $phistory->nama = $employeepayrolldata->nama;
                $phistory->gaji = $employeepayrolldata->gajipokok;
                $phistory->tunjanganjabatan = $employeepayrolldata->tunjanganjabatan;
                $phistory->tunjanganmakandantransport = $employeepayrolldata->tunjangankesehatan;
                $phistory->tunjanganlain = $employeepayrolldata->tunjanganlain;
                $phistory->tariftransportasi = $employeepayrolldata->tariftransportasi;
                $phistory->tarifmakanlembur = $employeepayrolldata->tarifmakanlembur;
                if (
                    $employeepayrolldata->npwp === null ||
                    $employeepayrolldata->npwp === 0 ||
                    $employeepayrolldata->npwp === '0' ||
                    $employeepayrolldata->npwp === '' ||
                    $employeepayrolldata->npwp === ' '
                ) {
                    $phistory->crossceknpwp = 0;
                } else {
                    $phistory->crossceknpwp = 1;
                }
                if ($datathismonth->jumlahharihadir == 0 || $datathismonth->jumlahharihadir == NULL) {
                } else {
                    $phistory->persenkehadiran = $datathismonth->jumlahharihadir / $datathismonth->haridalamsebulan * 100;
                    $phistory->jumlahupahtetap = $employeepayrolldata->gajipokok + $employeepayrolldata->tunjanganjabatan +
                        $employeepayrolldata->tunjangankesehatan + $employeepayrolldata->tunjanganlain;
                    $phistory->jumlahupahtetapaktual = $phistory->persenkehadiran * $phistory->jumlahupahtetap / 100;
                    if ($employeepayrolldata->lembur == 'Y') {
                        $phistory->tariflembur = floor(($employeepayrolldata->gajipokok / 173) * 2);
                    } else {
                        $phistory->tariflembur = 0;
                    }
                    $phistory->jumlahjamlembur = $datathismonth->jumlahjamlemburinput - $datathismonth->potonganpp -
                        $datathismonth->jumlahlemburtidakefektif;
                    if ($employeepayrolldata->lembur == 'Y') {
                        $phistory->jumlahlembur = $phistory->tariflembur * $phistory->jumlahjamlembur;
                    } elseif ($employeepayrolldata->lembur == 'N') {
                        $phistory->jumlahlembur = 0;
                    }
                    $phistory->jumlahtransportasi = $datathismonth->jumlahharilembursebulan * $employeepayrolldata->tariftransportasi;
                    $phistory->jumlahuangmakanlembur = $datathismonth->jumlahharilembur * $employeepayrolldata->tarifmakanlembur;
                    $phistory->jumlahope = $datathismonth->jumlahharibermalam * $datathismonth->jumlahopeinput;

                    $phistory->persenklaim = $phistory->jumlahklaimakumulasi / $employeepayrolldata->gajipokok * 100;
                    $phistory->jumlahpenghasilantidaktetap =
                        $datathismonth->koreksipenambahan -
                        $datathismonth->exceptional +
                        $datathismonth->jumlahklaimpengobatan +

                        $phistory->jumlahope +
                        $phistory->jumlahuangmakanlembur +
                        $phistory->jumlahtransportasi +
                        $phistory->jumlahlembur;
                    $phistory->jumlahpenghasilantidakrutin =
                        $datathismonth->insentif +
                        $datathismonth->bonus +
                        $datathismonth->tunjanganhariraya;
                    $phistory->penghasilanbruto =
                        $phistory->jumlahupahtetapaktual +
                        $phistory->jumlahpenghasilantidaktetap +
                        $phistory->jumlahpenghasilantidakrutin;
                    $bpjsketenagakerjaan64persen =
                        $datathismonth->bpjsketenagakerjaan / (2 / 100) * (6.24 / 100);
                    $phistory->BPJSketenagakerjaan054 =
                        $bpjsketenagakerjaan64persen / (6.24 / 100) * (0.54 / 100);
                    $phistory->jumlahbpjs =
                        $datathismonth->bpjsketenagakerjaan +
                        $datathismonth->bpjspensiun +
                        $datathismonth->bpjskesehatan;
                    $phistory->jumlahpemotongan =
                        $datathismonth->koreksipengurangan +
                        $datathismonth->pphpasal21 +
                        $phistory->jumlahbpjs +
                        $datathismonth->pembayaranterlebihdahulu +
                        $datathismonth->pemotonganpinjaman;
                    $phistory->penghasilanbulanan =
                        $phistory->penghasilanbruto -
                        $phistory->jumlahpenghasilantidakrutin;
                    $phistory->BPJSkesehatan = $datathismonth->bpjskesehatan / (1 / 100) * (4 / 100);
                    $phistory->jumlahpenghasilanrutin =
                        $phistory->penghasilanbulanan +
                        $phistory->BPJSketenagakerjaan054 +
                        $phistory->BPJSkesehatan;

                    if (
                        $employeepayrolldata->tanggalresign == '0000-00-00' ||
                        $employeepayrolldata->tanggalresign == ' ' ||
                        $employeepayrolldata->tanggalresign == '' ||
                        $employeepayrolldata->tanggalresign == NULL
                    ) {
                        $phistory->jumlahpenghasilanrutindisetahunkan =  $phistory->jumlahpenghasilanrutin * 12;
                    } else {
                        $phistory->jumlahpenghasilanrutindisetahunkan =  $phistory->jumlahpenghasilanrutin * date('n', strtotime($employeepayrolldata->tanggalresign));
                    }

                    $phistory->penghasilantidakrutin = $phistory->jumlahpenghasilantidakrutin;
                    $phistory->penghasilanbrutodisetahunkan = $phistory->jumlahpenghasilanrutindisetahunkan + $phistory->penghasilantidakrutin;
                    if (($phistory->penghasilanbrutodisetahunkan * (5 / 100) / 12) > 500000) {
                        $phistory->biayajabatan = 12 * 500000;
                    } else {
                        $phistory->biayajabatan = $phistory->penghasilanbrutodisetahunkan * (5 / 100);
                    }

                    $phistory->BPJSketenagakerjaan2 = $datathismonth->bpjsketenagakerjaan;
                    $phistory->BPJSpensiun1 = $datathismonth->bpjspensiun;
                    $phistory->jumlahpemotongandisetahunkan = $phistory->biayajabatan + (12 * ($phistory->BPJSketenagakerjaan2 + $phistory->BPJSpensiun1));
                    $phistory->pkp = $phistory->penghasilanbrutodisetahunkan - $phistory->jumlahpemotongandisetahunkan;

                    if ($employeepayrolldata->statusptkp == 'K/IL0') {
                        $phistory->ptkp = 112500000;
                    } elseif ($employeepayrolldata->statusptkp == 'K/IL1') {
                        $phistory->ptkp = 117000000;
                    } elseif ($employeepayrolldata->statusptkp == 'K/IL2') {
                        $phistory->ptkp = 121500000;
                    } elseif ($employeepayrolldata->statusptkp == 'K/IL3') {
                        $phistory->ptkp = 126000000;
                    } elseif ($employeepayrolldata->statusptkp == 'KL0') {
                        $phistory->ptkp = 58500000;
                    } elseif ($employeepayrolldata->statusptkp == 'KL1') {
                        $phistory->ptkp = 63000000;
                    } elseif ($employeepayrolldata->statusptkp == 'KL2') {
                        $phistory->ptkp = 67500000;
                    } elseif ($employeepayrolldata->statusptkp == 'KL3') {
                        $phistory->ptkp = 72000000;
                    } elseif ($employeepayrolldata->statusptkp == 'KP0') {
                        $phistory->ptkp = 54000000;
                    } elseif ($employeepayrolldata->statusptkp == 'KP1') {
                        $phistory->ptkp = 54000000;
                    } elseif ($employeepayrolldata->statusptkp == 'KP2') {
                        $phistory->ptkp = 54000000;
                    } elseif ($employeepayrolldata->statusptkp == 'KP3') {
                        $phistory->ptkp = 54000000;
                    } elseif ($employeepayrolldata->statusptkp == 'TL0') {
                        $phistory->ptkp = 54000000;
                    } elseif ($employeepayrolldata->statusptkp == 'TL1') {
                        $phistory->ptkp = 58500000;
                    } elseif ($employeepayrolldata->statusptkp == 'TL2') {
                        $phistory->ptkp = 63000000;
                    } elseif ($employeepayrolldata->statusptkp == 'TL3') {
                        $phistory->ptkp = 67500000;
                    } elseif ($employeepayrolldata->statusptkp == 'TP0') {
                        $phistory->ptkp = 54000000;
                    } elseif ($employeepayrolldata->statusptkp == 'TP1') {
                        $phistory->ptkp = 58500000;
                    } elseif ($employeepayrolldata->statusptkp == 'TP2') {
                        $phistory->ptkp = 63000000;
                    } elseif ($employeepayrolldata->statusptkp == 'TP3') {
                        $phistory->ptkp = 67500000;
                    }
                    if (($phistory->ptkp - $phistory->pkp) > 0) {
                        $phistory->pkppotong = 0;
                    } else {
                        $phistory->pkppotong = $phistory->pkp - $phistory->ptkp;
                    }
                    $phistory->pkppembulatan = floor($phistory->pkppotong / 1000) * 1000;
                    //=IF(CY7<50000001,1,IF(AND(CY7>50000000,CY7<250000001),2,IF(AND(CY7>250000000,CY7<500000001),3,4)))


                    if ($phistory->pkppembulatan <= 50000000) {
                        $phistory->lapis = 1;
                    } elseif ($phistory->pkppembulatan >= 50000001 && $phistory->pkppembulatan <= 250000000) {
                        $phistory->lapis = 2;
                    } elseif ($phistory->pkppembulatan >= 250000001 && $phistory->pkppembulatan <= 500000000) {
                        $phistory->lapis = 3;
                    } elseif ($phistory->pkppembulatan >= 500000001) {
                        $phistory->lapis = 4;
                    };
                    $phistory->lapis;
                    $phistory->pajakpenghasilan;
                    if ($phistory->crossceknpwp === 1) {
                        if ($phistory->lapis === 1) {
                            $phistory->pajakpenghasilan = ($phistory->pkppembulatan * (5 / 100));
                        } elseif ($phistory->lapis === 2) {
                            $phistory->pajakpenghasilan = (2500000 + ($phistory->pkppembulatan - 50000000) * (15 / 100));
                        } elseif ($phistory->lapis === 3) {
                            $phistory->pajakpenghasilan = (32500000 + ($phistory->pkppembulatan - 250000000) * (25 / 100));
                        } elseif ($phistory->lapis === 4) {
                            $phistory->pajakpenghasilan = (95000000 + ($phistory->pkppembulatan - 500000000) * (30 / 100));
                        }
                    } elseif ($phistory->crossceknpwp === 0) {
                        if ($phistory->lapis === 1) {
                            $phistory->pajakpenghasilan = ($phistory->pkppembulatan * (5 / 100)) * (120 / 100);
                        } elseif ($phistory->lapis === 2) {
                            $phistory->pajakpenghasilan = (2500000 + ($phistory->pkppembulatan - 50000000) * (15 / 100)) * (120 / 100);
                        } elseif ($phistory->lapis === 3) {
                            $phistory->pajakpenghasilan = (32500000 + ($phistory->pkppembulatan - 250000000) * (25 / 100)) * (120 / 100);
                        } elseif ($phistory->lapis === 4) {
                            $phistory->pajakpenghasilan = (95000000 + ($phistory->pkppembulatan - 500000000) * (30 / 100)) * (120 / 100);
                        }
                    }
                    if($phistory->penghasilanbruto === 0){
                        dd($employeepayrolldata);
                    }
                    $phistory->persenupah = (($phistory->jumlahupahtetapaktual / $phistory->penghasilanbruto) * 100);
                    if ($phistory->persenupah >= 75) {
                        $phistory->cekpersenupah = "Y";
                    } else {
                        $phistory->cekpersenupah = "N";
                    }
                    $phistory->telahdibayarsebelumnya = $datathismonth->telahdibayarsebelumnya;
                    $phistory->kurangbayar = $phistory->pajakpenghasilan - $phistory->telahdibayarsebelumnya;
                    $phistory->PPHbulanberkaitan = $phistory->kurangbayar / (13 - $month);
                    $phistory->periode = $month;

                    $earningtotal =
                        $phistory->jumlahupahtetapaktual +
                        // $phistory->jumlahthaktual +
                        $phistory->jumlahlembur +
                        $phistory->jumlahtransportasi +
                        $phistory->jumlahuangmakanlembur +
                        $phistory->jumlahope +
                        $phistory->jumlahklaimdibayarkan +
                        $datathismonth->jumlahklaimpengobatan +
                        $datathismonth->tunjanganhariraya +
                        $datathismonth->insentif +
                        $datathismonth->bonus +
                        // $datathismonth->insentifpenghargaan +
                        $datathismonth->koreksipenambahan;
                    $deductiontotal =
                        $datathismonth->pembayaranterlebihdahulu +
                        $datathismonth->bpjsketenagakerjaan +
                        $datathismonth->bpjspensiun +
                        $datathismonth->bpjskesehatan +
                        $datathismonth->pphpasal21 +
                        // $datathismonth->penaltikerja +
                        // $datathismonth->pembayaranpinjaman +
                        $datathismonth->koreksipengurangan;


                    $phistory->takehomepay = ($earningtotal - $deductiontotal);
                    // $datathismonth->pencairanpinjaman +
                    // $datathismonth->pengembaliandeposit;
                    $total =
                        $phistory->takehomepay;
                    // $datathismonth->pencairanpinjaman +
                    // $datathismonth->pengembaliandeposit;
                    $phistory->earningtotal = $earningtotal;
                    $phistory->deductiontotal = $deductiontotal;
                    $phistory->total = $total;
                    $phistory->gajipokok = $employeepayrolldata->gajipokok;;

                    $datathismonth->payrollcheck = 'done';

                    $phistory->save();
                    $datathismonth->update();
                    return redirect()->back()->with('success', $employeepayrolldata->nama . ' payroll has been processed');
                }
            } else {
                return redirect()->back()->with('failure', $employeepayrolldata->nama . ' payroll process failure. Please check if the data of ' . $employeepayrolldata->nama . ' is duplicate or the payroll input data is corrupted');
            }
        }
    }

    public function create()
    {
        $groups = Group::all();
        $positions = Positions::all();
        return view('hrd.payroll.inputemployee', compact('groups', 'position'));
    }

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function input(Request $request)
    {

        $this->validate($request, [
            'nip' => 'required',
            'nama' => 'required',
            'institusi' => 'required',
            'kota' => 'required',
            'tanggalbergabung' => 'required',
            'status' => 'required',
            'positionid' => 'required',
            'lembur' => 'required',
            'grade' => 'required',
            'grup' => 'required',
            'divisi' => '',
            'inchargestatus' => '',
            'norek' => 'required',
            'npwp' => 'required',
            'statusptkp' => 'required',
            'gajipokok' => 'required',
            'tunjanganjabatan' => 'required',
            'tunjangankesehatan' => 'required',
            'tunjanganlain' => 'required',
            'tarifthhari' => 'required',
            'tariftransportasi' => 'required',
            'tarifmakanlembur' => 'required',
            'persenbpjskesehatan' => ''
        ]);

        if (MasterEmployee::where('nip', '=', $request->nip)->exists()) {
            return redirect('/user/payrollandlogin/form')->with('alert', 'Data with NIP: ' . $request->nip . ' is existed already');
        }

        $employee = new MasterEmployee();
        $employee->nip = $request->nip;
        $employee->nama = $request->nama;
        $employee->institusi = $request->institusi;
        $employee->kota = $request->kota;
        $employee->tanggalbergabung = Carbon::parse($request->tanggalbergabung);
        $employee->status = $request->status;
        $employee->lembur = $request->lembur;
        $employee->grade = $request->grade;
        $employee->grup = $request->grup;
        $employee->divisi = $request->divisi;
        $employee->inchargestatus = $request->inchargestatus;
        $employee->norek = $request->norek;
        $employee->npwp = $request->npwp;
        $employee->statusptkp = $request->statusptkp;
        $employee->gajipokok = $request->gajipokok;
        $employee->tunjanganjabatan = $request->tunjanganjabatan;
        $employee->tunjangankesehatan = $request->tunjangankesehatan;
        $employee->tunjanganlain = $request->tunjanganlain;
        $employee->tarifthhari = $request->tarifthhari;
        $employee->tariftransportasi = $request->tariftransportasi;
        $employee->tarifmakanlembur = $request->tarifmakanlembur;
        $employee->persenbpjskesehatan = $request->persenbpjskesehatan;

        $user = new User();

        $user->nip = $request->nip;
        $user->email = $request->email;
        $user->name = $request->nama;
        $user->contact = $request->contact;
        $user->division = $request->division;
        $user->logintype = $request->logintype;
        $user->admin = $request->admin;
        $user->password = Hash::make($request->password);
        $user->save();

        //        if($employee -> grade = 'P-1A'){
        //            $posid = '1';
        //        }elseif ($employee -> grade = 'P-1B') {
        //            $posid = '2';
        //        }elseif ($employee -> grade = 'P-2A') {
        //            $posid = '3';
        //        }elseif ($employee -> grade = 'P-2B') {
        //            $posid = '4';
        //        }elseif ($employee -> grade = 'P-3A') {
        //            $posid = '5';
        //        }elseif ($employee -> grade = 'P-3B') {
        //            $posid = '6';
        //        }elseif ($employee -> grade = 'P-4A') {
        //            $posid = '7';
        //        }elseif ($employee -> grade = 'P-4B') {
        //            $posid = '8';
        //        }elseif ($employee -> grade = 'P-5A') {
        //            $posid = '9';
        //        }elseif ($employee -> grade = 'P-5B') {
        //            $posid = '10';
        //        }elseif ($employee -> grade = 'P-5C') {
        //            $posid = '11';
        //        }elseif ($employee -> grade = 'P-6A') {
        //            $posid = '12';
        //        }elseif ($employee -> grade = 'P-6B') {
        //            $posid = '13';
        //        }elseif ($employee -> grade = 'P-6C') {
        //            $posid = '14';
        //        }elseif ($employee -> grade = 'P-6D') {
        //            $posid = '15';
        //        }elseif ($employee -> grade = 'A-1A') {
        //            $posid = '16';
        //        }elseif ($employee -> grade = 'A-1B') {
        //            $posid = '17';
        //        }elseif ($employee -> grade = 'A-2A') {
        //            $posid = '18';
        //        }elseif ($employee -> grade = 'A-3A') {
        //            $posid = '19';
        //        }elseif ($employee -> grade = 'A-4A') {
        //            $posid = '20';
        //        }elseif ($employee -> grade = 'A-4B') {
        //            $posid = '21';
        //        }elseif ($employee -> grade = 'A-5A') {
        //            $posid = '22';
        //        }elseif ($employee -> grade = 'A-5B') {
        //            $posid = '23';
        //        }elseif ($employee -> grade = 'A-5C') {
        //            $posid = '24';
        //        }
        //        else{
        //            $posid = '99';
        //        }

        //        if(\request()->has('kota')){
        //            $employees = MasterEmployee::orderBy('kota', 'asc', \request('kota'))->paginate(10);
        //            $count = MasterEmployee::count();
        //        }else {
        //            $employees = DB::table('masteremployee')->paginate(10);
        //
        //            $count = MasterEmployee::count();
        //        }
        $employee->positionid = $request->positionid;
        $employee->save();
        return view('successinput');
    }

    public function resign(Request $request, $id)
    {
        $this->validate($request, [
            'tanggalresign' => 'required|date',
        ]);

        $employees = MasterEmployee::find($id);
        $employees->status = 'RESIGN';
        $employees->tanggalresign = $request->tanggalresign;

        $employees->update();
        return redirect('/payroll/data/');
    }

    public function changegroup(Request $request, $id)
    {
        $this->validate($request, [
            'changegroup' => 'required',
        ]);

        $employees = DB::table('masteremployee')->where('id', $id)->first();

        $change = DB::table('users2')->where('nip', $employees->nip);

        $change->update(
            ['logintype' => $request->changegroup]
        );
        return redirect('/payroll/data/');
    }


    public function edit($id)
    {
        $employees = MasterEmployee::find($id);
        $groups = Group::all();
        $divisions = Division::all();
        $positions = EmployeePosition::all();
        $user = DB::table('users2')->where('nip', $employees->nip)->first();
        return view('editemployeepayrolldata', compact('employees', 'user', 'groups', 'divisions', 'positions'));
    }

    public function update(Request $request, $id)
    {
        $employees = MasterEmployee::find($id);

        $user = User::where('nip', $employees->nip)->first();
        $users = User::find($user->id);
        $users->nip = $request->nip;
        $users->update();

        $employees->nip = $request->nip;
        $employees->nama = $request->nama;
        $employees->institusi = $request->institusi;
        $employees->kota = $request->kota;
        $employees->tanggalbergabung = Carbon::parse($request->tanggalbergabung);
        $employees->status = $request->status;

        if ($request->status !== 'resign' || $request->status !== 'Resign' || $request->status !== 'RESIGN') {
            $employees->tanggalresign = 'null';
        }
        $employees->positionid = $request->positionid;
        $employees->lembur = $request->lembur;
        $employees->grade = $request->grade;
        $employees->norek = $request->norek;
        $employees->divisi = $request->divisi;
        $employees->npwp = $request->npwp;
        $employees->statusptkp = $request->statusptkp;

        $history = $employees->getAttributes();
        unset($history['id']);
        EmployeeHistory::forceCreate($history);
        $employees->update();

        return redirect('/payroll/data/' . $id . '/edit')->with('alert', 'Data has been updated');
    }

    public function deletepayrollhistory($id)
    {
        $history = MasterPayrollHistory::find($id);
        $deletedpayrollhistory = new DeletedHistory();

        $datahistory = MasterPayrollHistory::where('id', '=', $id)->first();
        $name = Auth::user()->name;

        $deletedpayrollhistory->adminnip = $name;
        $deletedpayrollhistory->nip = $datahistory->nip;
        $deletedpayrollhistory->nama = $datahistory->nama;
        $deletedpayrollhistory->crossceknpwp = $datahistory->crossceknpwp;
        $deletedpayrollhistory->persenkehadiran = $datahistory->persenkehadiran;
        $deletedpayrollhistory->jumlahupahtetap = $datahistory->jumlahupahtetap;
        $deletedpayrollhistory->jumlahupahtetapaktual = $datahistory->jumlahupahtetapaktual;
        $deletedpayrollhistory->persenupah = $datahistory->persenupah;
        $deletedpayrollhistory->cekpersenupah = $datahistory->cekpersenupah;
        $deletedpayrollhistory->jumlahkehadirandalamhari = $datahistory->jumlahkehadirandalamhari;
        $deletedpayrollhistory->jumlahthaktual = $datahistory->jumlahthaktual;
        $deletedpayrollhistory->tariflembur = $datahistory->tariflembur;
        $deletedpayrollhistory->jumlahjamlembur = $datahistory->jumlahjamlembur;
        $deletedpayrollhistory->jumlahlembur = $datahistory->jumlahlembur;
        $deletedpayrollhistory->jumlahtransportasi = $datahistory->jumlahtransportasi;
        $deletedpayrollhistory->jumlahuangmakanlembur = $datahistory->jumlahuangmakanlembur;
        $deletedpayrollhistory->jumlahope = $datahistory->jumlahope;
        $deletedpayrollhistory->jumlahklaimdibayarkan = $datahistory->jumlahklaimdibayarkan;
        $deletedpayrollhistory->jumlahklaimakumulasi = $datahistory->jumlahklaimakumulasi;
        $deletedpayrollhistory->persenklaim = $datahistory->persenklaim;
        $deletedpayrollhistory->jumlahpenghasilantidaktetap = $datahistory->jumlahpenghasilantidaktetap;
        $deletedpayrollhistory->jumlahpenghasilantidakrutin = $datahistory->jumlahpenghasilantidakrutin;
        $deletedpayrollhistory->jumlahpinjamandandeposit = $datahistory->jumlahpinjamandandeposit;
        $deletedpayrollhistory->jumlahbpjs = $datahistory->jumlahbpjs;
        $deletedpayrollhistory->jumlahpemotongan = $datahistory->jumlahpemotongan;
        $deletedpayrollhistory->takehomepay = $datahistory->takehomepay;
        $deletedpayrollhistory->penghasilanbulanan = $datahistory->penghasilanbulanan;
        $deletedpayrollhistory->BPJSketenagakerjaan054 = $datahistory->BPJSketenagakerjaan054;
        $deletedpayrollhistory->BPJSkesehatan = $datahistory->BPJSkesehatan;
        $deletedpayrollhistory->jumlahpenghasilanrutin = $datahistory->jumlahpenghasilanrutin;
        $deletedpayrollhistory->jumlahpenghasilanrutindisetahunkan = $datahistory->jumlahpenghasilanrutindisetahunkan;
        $deletedpayrollhistory->penghasilantidakrutin = $datahistory->penghasilantidakrutin;
        $deletedpayrollhistory->penghasilanbruto = $datahistory->penghasilanbruto;
        $deletedpayrollhistory->penghasilanbrutodisetahunkan = $datahistory->penghasilanbrutodisetahunkan;
        $deletedpayrollhistory->biayajabatan = $datahistory->biayajabatan;
        $deletedpayrollhistory->BPJSketenagakerjaan2 = $datahistory->BPJSketenagakerjaan2;
        $deletedpayrollhistory->BPJSpensiun1 = $datahistory->BPJSpensiun1;
        $deletedpayrollhistory->jumlahpemotongandisetahunkan = $datahistory->jumlahpemotongandisetahunkan;
        $deletedpayrollhistory->PKP = $datahistory->PKP;
        $deletedpayrollhistory->PTKP = $datahistory->PTKP;
        $deletedpayrollhistory->PKPpotong = $datahistory->PKPpotong;
        $deletedpayrollhistory->PKPpembulatan = $datahistory->PKPpembulatan;
        $deletedpayrollhistory->lapis = $datahistory->lapis;
        $deletedpayrollhistory->pajakpenghasilan = $datahistory->pajakpenghasilan;
        $deletedpayrollhistory->telahdibayarsebelumnya = $datahistory->telahdibayarsebelumnya;
        $deletedpayrollhistory->kurangbayar = $datahistory->kurangbayar;
        $deletedpayrollhistory->PPHbulanberkaitan = $datahistory->PPHbulanberkaitan;
        $deletedpayrollhistory->earningtotal = $datahistory->earningtotal;
        $deletedpayrollhistory->deductiontotal = $datahistory->deductiontotal;
        $deletedpayrollhistory->total = $datahistory->total;
        $deletedpayrollhistory->periode = $datahistory->periode;
        $deletedpayrollhistory->save();
        $history->delete();
        return redirect('/payroll/history');
    }

    public function destroy($id)
    {
        $employees = MasterEmployee::find($id);
        $deletedemployee = new DeletedEmployee();
        $dataemployee = MasterEmployee::where('id', '=', $id)->first();

        $deletedemployee->id = $id;
        $deletedemployee->nip = $dataemployee->nip;
        $deletedemployee->nama = $dataemployee->nama;
        $deletedemployee->institusi = $dataemployee->institusi;
        $deletedemployee->kota = $dataemployee->kota;
        $deletedemployee->tanggalbergabung = Carbon::parse($dataemployee->tanggalbergabung);
        $deletedemployee->status = $dataemployee->status;
        $deletedemployee->lembur = $dataemployee->lembur;
        $deletedemployee->grade = $dataemployee->grade;
        $deletedemployee->grup = $dataemployee->grup;
        $deletedemployee->divisi = $dataemployee->divisi;
        $deletedemployee->inchargestatus = $dataemployee->inchargestatus;
        $deletedemployee->norek = $dataemployee->norek;
        $deletedemployee->npwp = $dataemployee->npwp;
        $deletedemployee->statusptkp = $dataemployee->statusptkp;
        $deletedemployee->gajipokok = $dataemployee->gajipokok;
        $deletedemployee->tunjanganjabatan = $dataemployee->tunjanganjabatan;
        $deletedemployee->tunjangankesehatan = $dataemployee->tunjangankesehatan;
        $deletedemployee->tunjanganlain = $dataemployee->tunjanganlain;
        $deletedemployee->tarifthhari = $dataemployee->tarifthhari;
        $deletedemployee->tariftransportasi = $dataemployee->tariftransportasi;
        $deletedemployee->tarifmakanlembur = $dataemployee->tarifmakanlembur;
        $deletedemployee->persenbpjskesehatan = $dataemployee->persenbpjskesehatan;

        $deletedemployee->save();
        $employees->delete();
        return redirect('/payroll/history');
    }


    public function increaseform($id)
    {
        $employees = DB::table('masteremployee')->where('id', $id)->first();
        return view('hrd.payroll.increasesalary', compact('employees'));
    }

    public function increaseprocess(Request $request, $id)
    {
        $olddata = DB::table('masteremployee')->where('id', $id)->first();
        $oldsalaries = new OldSalaries();
        $oldsalaries->nip = $olddata->nip;
        $oldsalaries->statusptkp = $olddata->statusptkp;
        $oldsalaries->gajipokok = $olddata->gajipokok;
        $oldsalaries->tunjanganjabatan = $olddata->tunjanganjabatan;
        $oldsalaries->tunjangankesehatan = $olddata->tunjangankesehatan;
        $oldsalaries->tunjanganlain = $olddata->tunjanganlain;
        $oldsalaries->tarifthhari = $olddata->tarifthhari;
        $oldsalaries->tariftransportasi = $olddata->tariftransportasi;
        $oldsalaries->tarifmakanlembur = $olddata->tarifmakanlembur;
        $oldsalaries->persenbpjskesehatan = $olddata->persenbpjskesehatan;
        $oldsalaries->save();

        $employees = MasterEmployee::find($id);
        $employees->statusptkp = $request->statusptkp;
        $employees->gajipokok = $request->gajipokok;
        $employees->tunjanganjabatan = $request->tunjanganjabatan;
        $employees->tunjangankesehatan = $request->tunjangankesehatan;
        $employees->tunjanganlain = $request->tunjanganlain;
        $employees->tarifthhari = $request->tarifthhari;
        $employees->tariftransportasi = $request->tariftransportasi;
        $employees->tarifmakanlembur = $request->tarifmakanlembur;
        $employees->persenbpjskesehatan = $request->persenbpjskesehatan;
        $employees->update();


        return redirect('/payroll/data');
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
        $thismonth = 7;

        return view('payroll/run/', ['employees' => $employees])
            ->with('employees', $employees)
            ->with('thismonth', $thismonth);
    }

    public function searchemployee(Request $request)
    {

        $employees = MasterEmployee::all()->sortBy('nip');
        // Sets the parameters from the get request to the variables.
        $name = $request->searchname;
        // Perform the query using Query Builder
        $employees = DB::table('masteremployee')
            ->where('nama', 'like', '%' . $name . '%')
            ->paginate(10);
        $employees->appends(['nama' => $name]);
        $thismonth = Carbon::now('m');
        $count = MasterEmployee::count();
        $role = Auth::user()->role;

        return view('employeedatabase', ['employees' => $employees])
            ->with('employees', $employees)
            ->with('thismonth', $thismonth)
            ->with('count', $count)
            ->with('role', $role);
    }

    public function searchmanualrunpayroll(Request $request)
    {

        if (\request()->has('period')) {
            $thismonth = \request('period');
        } else {
            $thismonth = Carbon::now('m');
        }

        $employees = MasterEmployee::all()->sortBy('nip');
        // Sets the parameters from the get request to the variables.
        $name = $request->searchname;
        // Perform the query using Query Builder
        $employees = DB::table('masteremployee')
            ->join('payrollinput', 'masteremployee.nip', '=', 'payrollinput.nip')
            ->select(
                'masteremployee.id as id',
                'masteremployee.nip as nip',
                'masteremployee.kota as kota',
                'masteremployee.institusi as institusi',
                'masteremployee.nama as nama',
                'payrollinput.payrollcheck as payrollcheck',
                'payrollinput.id as inputid'
            )
            ->where('nama', 'like', '%' . $name . '%')
            ->where('periode', $thismonth)
            ->paginate(10);
        $hitung = DB::table('masteremployee')
            ->join('payrollinput', 'masteremployee.nip', '=', 'payrollinput.nip')
            ->count();
        //        $employees = DB::table('masteremployee')

        //            ->where('institusi', \request('institusi'))->where('periode', '=', $thismonth)->paginate(10);
        $employees->appends(['nama' => $name]);

        $count = MasterEmployee::count();
        $role = Auth::user()->role;

        return view('runpayrollhome', ['employees' => $employees])
            ->with('employees', $employees)
            ->with('thismonth', $thismonth)
            ->with('count', $count)
            ->with('role', $role)
            ->with('hitung', $hitung);
    }

    public function searchmanualpayrollhistory(Request $request)
    {
        $thismonth = Carbon::now('m');
        $employees = MasterPayrollHistory::all()->sortBy('nip');
        // Sets the parameters from the get request to the variables.
        $name = $request->searchname;
        // Perform the query using Query Builder
        $employees = DB::table('payrollhistory')
            ->where('nama', 'like', '%' . $name . '%')
            //            ->where('periode', $thismonth)
            ->orderBy('periode', 'desc')
            ->paginate(10);
        $employees->appends(['nama' => $name]);

        $count = MasterPayrollHistory::count();
        $role = Auth::user()->role;

        return view('hrd.payroll.payrollhistory', ['employees' => $employees])
            ->with('employees', $employees)
            ->with('thismonth', $thismonth)
            ->with('count', $count)
            ->with('role', $role);
    }

    public function koreksiinput()
    {
        $employees = DB::table('masteremployee')
            ->join('payrollinput', 'masteremployee.nip', '=', 'payrollinput.nip')
            ->join('payrollhistory', 'masteremployee.nip', '=', 'payrollhistory.nip')
            ->paginate(10);
        $employees->currentPage(); // Current page number
        $employees->total(); // Total items
        $employees->perPage(); // Per page
        $count = MasterPayrollHistory::count();

        return view('koreksiinput', ['employees' => $employees])->with('count', $count);
    }

    public function koreksiinputview($id)
    {
        $employees = MasterPayrollHistory::where('id', '=', $id)->first();
        return view('koreksiinputview', ['employees', $employees])
            ->with('employees', $employees);
    }

    public function deletepayrollinputthismonth($period)
    {
        if ($period !== null || $period !== "") {
            $thismonth = $period;
        } else {
            $thismonth = Carbon::now('m');
        }

        $employees = DB::table('payrollinput')->where('periode', '=', $thismonth)->delete();
        // MasterPayrollInput::where('periode', '=', $thismonth);
        // $employees->delete();
        return redirect('/payroll/run/')->with('alert', 'Payroll Input Bulan ' . $period . ' Berhasil Dihapus');
    }

    public function deletepayrollinputthismonthsmj($period)
    {
        if ($period !== null || $period !== "") {
            $thismonth = $period;
        } else {
            $thismonth = Carbon::now('m');
        }

        $employees = DB::table('payrollinput')->join('masteremployee', 'payrollinput.nip', '=', 'masteremployee.nip')->where('periode', '=', $thismonth)->where('institusi', '=', 'solis')->where('kota', '=', 'jakarta');
        $employees->delete();
        return redirect('/payroll/run/')->with('alert', 'Payroll Input Solis Jakarta Bulan ' . $period . ' Berhasil Dihapus');
    }

    public function deletepayrollinputthismonthmsj($period)
    {
        if ($period !== null || $period !== "") {
            $thismonth = $period;
        } else {
            $thismonth = Carbon::now('m');
        }

        $employees = DB::table('payrollinput')->join('masteremployee', 'payrollinput.nip', '=', 'masteremployee.nip')->where('periode', '=', $thismonth)->where('institusi', '=', 'msid')->where('kota', '=', 'jakarta');
        $employees->delete();
        return redirect('/payroll/run/')->with('alert', 'Payroll Input MSId Jakarta Bulan ' . $period . ' Berhasil Dihapus');
    }

    public function deletepayrollinputthismonthsmb($period)
    {
        if ($period !== null || $period !== "") {
            $thismonth = $period;
        } else {
            $thismonth = Carbon::now('m');
        }
        $employees = DB::table('payrollinput')->join('masteremployee', 'payrollinput.nip', '=', 'masteremployee.nip')->where('periode', '=', $thismonth)->where('institusi', '=', 'solis')->where('kota', '=', 'batam');
        $employees->delete();
        return redirect('/payroll/run/')->with('alert', 'Payroll Input Solis Batam Bulan ' . $period . ' Berhasil Dihapus');
    }

    public function deletepayrollinputthismonthmsb($period)
    {
        if ($period !== null || $period !== "") {
            $thismonth = $period;
        } else {
            $thismonth = Carbon::now('m');
        }
        $employees = DB::table('payrollinput')->join('masteremployee', 'payrollinput.nip', '=', 'masteremployee.nip')->where('periode', '=', $thismonth)->where('institusi', '=', 'msid')->where('kota', '=', 'batam');
        $employees->delete();
        return redirect('/payroll/run/')->with('alert', 'Payroll Input MSId Batam Bulan ' . $period . ' Berhasil Dihapus');
    }

    public function deletepayrollhistorythismonth($period)
    {
        if ($period !== null || $period !== "") {
            $thismonth = $period;
        } else {
            $thismonth = Carbon::now('m');
        }
        $employees = DB::table('payrollhistory')->where('periode', '=', $thismonth)->delete();
        // $employees = MasterPayrollHistory::where('periode', '=', $thismonth);
        // $employees->delete();
        return redirect('/payroll/history')->with('alert', 'Data Payroll History Bulan ' . $period . ' Berhasil Dihapus');
    }

    public function deletepayrollhistorythismonthsmj($period)
    {
        if ($period !== null || $period !== "") {
            $thismonth = $period;
        } else {
            $thismonth = Carbon::now('m');
        }
        $employees = DB::table('payrollhistory')->join('masteremployee', 'payrollhistory.nip', '=', 'masteremployee.nip')->where('periode', '=', $thismonth)->where('institusi', '=', 'solis')->where('kota', '=', 'jakarta');
        $employees->delete();
        return view('hrd.payroll.payrollhistory')->with('alert', 'Data Payroll History Solis Jakarta Bulan ' . $period . ' Berhasil Dihapus');
    }

    public function deletepayrollhistorythismonthmsj($period)
    {
        if ($period !== null || $period !== "") {
            $thismonth = $period;
        } else {
            $thismonth = Carbon::now('m');
        }
        $employees = DB::table('payrollhistory')->join('masteremployee', 'payrollhistory.nip', '=', 'masteremployee.nip')->where('periode', '=', $thismonth)->where('institusi', '=', 'msid')->where('kota', '=', 'jakarta');
        $employees->delete();
        return redirect('hrd.payroll.payrollhistory')->with('alert', 'Data Payroll History MSId Jakarta Bulan ' . $period . ' Berhasil Dihapus');
    }

    public function deletepayrollhistorythismonthsmb($period)
    {
        if ($period !== null || $period !== "") {
            $thismonth = $period;
        } else {
            $thismonth = Carbon::now('m');
        }
        $employees = DB::table('payrollhistory')->join('masteremployee', 'payrollhistory.nip', '=', 'masteremployee.nip')->where('periode', '=', $thismonth)->where('institusi', '=', 'solis')->where('kota', '=', 'batam');
        $employees->delete();
        return view('hrd.payroll.payrollhistory')->with('alert', 'Data Payroll History Solis Batam Bulan ' . $period . ' Berhasil Dihapus');
    }

    public function deletepayrollhistorythismonthmsb($period)
    {
        if ($period !== null || $period !== "") {
            $thismonth = $period;
        } else {
            $thismonth = Carbon::now('m');
        }
        $employees = DB::table('payrollhistory')->join('masteremployee', 'payrollhistory.nip', '=', 'masteremployee.nip')->where('periode', '=', $thismonth)->where('institusi', '=', 'msid')->where('kota', '=', 'batam');
        $employees->delete();
        return view('hrd.payroll.payrollhistory')->with('alert', 'Data Payroll History MSId Batam Bulan ' . $period . ' Berhasil Dihapus');
    }

    public function exportPDF()
    {
        $data = MasterItem::get()->toArray();
        return Excel::create('itsolutionstuff_example', function ($excel) use ($data) {
            $excel->sheet('mySheet', function ($sheet) use ($data) {
                $sheet->fromArray($data);
            });
        })->download("pdf");
    }

    public function payslips($year)
    {
        $user = Auth::user()->admin;
        $nip = Auth::user()->nip;
        $id = Auth::id();
        $getuser = DB::table('users2')->where('id', '=', $id)->first();
        $type = $getuser->logintype;

        if ($year == '2022') {
            $listbyperiodes = DB::table('payrollhistory')->where('nip', '=', $nip)->get();
        } elseif ($year == '2021') {
            $listbyperiodes = DB::table('payrollhistory2021')->where('nip', '=', $nip)->get();
        } elseif ($year == '2020') {
            $listbyperiodes = DB::table('payrollhistory2020')->where('nip', '=', $nip)->get();
        } elseif ($year == '2019') {
            $listbyperiodes = DB::table('payrollhistory2019')->where('nip', '=', $nip)->get();
        }

        return view('payslips', compact('listbyperiodes', 'year'));
    }

    public function pdfview(Request $request)
    {
        $month = $request->only('periode');
        $id = implode(' ', $request->only('id'));
        $historyid = implode(' ', $request->only('historyid'));
        $historyperiod = MasterPayrollHistory::where('id', '=', $historyid)->first();
        $periode = date("m", strtotime($historyperiod));

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
        //        $encoded_id = Hashids::encode($id);
    }
}
