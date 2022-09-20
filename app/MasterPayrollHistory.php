<?php

namespace App;

use Carbon\Carbon;
use Exception;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class MasterPayrollHistory extends Model
{
    
    public $table = 'payrollhistory';

    static public function payrollingAll(int $period, bool $submit = false)
    {
        if ($period !== null || $period !== "") {
            $thismonth = $period;
            $month = $period;
        } else {
            $thismonth = Carbon::now('m');
            $month = Carbon::now('m');
        }

        $employees = MasterPayrollInput::where('periode', $month)->where('payrollcheck', NULL)->get();

        $duplicates = MasterPayrollInput::where('periode', $month)
        ->orderBy('id', 'asc')
        ->groupBy('nip')
        ->havingRaw('count(*) > 1')
        ->get();

        $duplicatesid = array_column($duplicates->toArray(), 'id');

        $todelete = array_map(function ($item) {
            return $item;
        }, $duplicatesid);

        MasterPayrollInput::whereIn('id', $duplicatesid)->delete();

        $calculatedPayroll = [];

        foreach ($employees as $p) {
           try{
            $phistory = new MasterPayrollHistory();
            $employeepayrolldata = MasterEmployee::where('nip', '=', trim($p->nip))->first();
            $datathismonth = MasterPayrollInput::where('nip', '=', $p->nip)->where('periode', $month)->first();
            $checkhistory = MasterPayrollHistory::where('nip', '=', $p->nip)->where('periode', $month)->first();
            $checkstatuses = Statuses::where('period', $month)->where('is_report_locked', TRUE)->where('nip', $p->nip)->first();
            $start_period = getStartPeriod((int)$period);
            $end_period = getEndPeriod((int)($period));

            $weekdays = $start_period->diffInDaysFiltered(function(Carbon $date) {
                return $date->isWeekend();
            }, $end_period);

            $timereport = TimeReport::whereBetween('date', [$start_period->format('Y-m-d'), $end_period->format('Y-m-d')])
            ->where('nip', $p->nip);
            // ->where('approved_by_incharge', TRUE)
            // ->where('approved_by_hr', TRUE)
            // ->where('approved_by_partner', TRUE);

            $normalhours = $timereport->sum('normalhours');
            $ineffectivehours = $timereport->sum('ineffectivehours');
            $editineffective = $timereport->sum('editineffective');

            if (empty($datathismonth->haridalamsebulan)) {
                $datathismonth->haridalamsebulan = $end_period->diffInDays($start_period) + 1;
            }

            if (empty($datathismonth->jumlahharihadir)) {                
                $jumlahharihadir = TimeReport::whereBetween('date', [$start_period->format('Y-m-d'), $end_period->format('Y-m-d')])
                ->where('nip', $p->nip)
                // ->where('approved_by_incharge', TRUE)
                // ->where('approved_by_hr', TRUE)
                ->groupBy('date')->count();

                $datathismonth->jumlahharihadir = $datathismonth->haridalamsebulan;

                if ($weekdays != $jumlahharihadir) {
                    $datathismonth->jumlahharihadir = $datathismonth->haridalamsebulan - ($weekdays - $jumlahharihadir);
                }
            }

            if (empty($datathismonth->jumlahjamlemburinput)) {
                $datathismonth->jumlahjamlemburinput = $timereport->sum('overtimes');
            }

            if (empty($datathismonth->potonganpp)) {
                $datathismonth->potonganpp = $timereport->sum('ineffectiverules');
            }

            if (empty($datathismonth->jumlahlemburtidakefektif)) {
                $datathismonth->jumlahlemburtidakefektif = $timereport->sum('editineffective');
            }

            if (empty($datathismonth->jumlahharilembur)) {
                $harilembursebulan = TimeReport::whereBetween('date', [$start_period->format('Y-m-d'), $end_period->format('Y-m-d')])
                ->groupBy('date')
                ->where('nip', $p->nip)
                ->where('approved_by_incharge', TRUE)
                ->where('approved_by_hr', TRUE)
                ->where('overtimes', '>', 0)
                ->get();
                $datathismonth->jumlahharilembur = count($harilembursebulan);
            }

            if (empty($datathismonth->jumlahharilembursebulan)) {
                $datathismonth->jumlahharilembursebulan = $timereport->sum('lateovertime');
            }

            if (empty($datathismonth->jumlahharibermalam)) {
                $datathismonth->jumlahharibermalam = $timereport->where('is_business_trip', TRUE)->count();
            }

            if (!empty($employeepayrolldata) && empty($checkhistory) && !empty($checkstatuses)) {
                // check if already exist in payroll history
                if (empty($checkhistory)) {
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

                    $phistory->persenkehadiran = $datathismonth->jumlahharihadir / $datathismonth->haridalamsebulan * 100;
                    $phistory->jumlahupahtetap = $employeepayrolldata->gajipokok + $employeepayrolldata->tunjanganjabatan +
                        $employeepayrolldata->tunjangankesehatan + $employeepayrolldata->tunjanganlain;
                    $phistory->jumlahupahtetapaktual = $phistory->persenkehadiran * $phistory->jumlahupahtetap / 100;
                    // $phistory->jumlahkehadirandalamhari = $datathismonth->jumlahkehadirandalamjam / 8;
                    // $phistory->jumlahthaktual = $phistory->jumlahkehadirandalamhari * $employeepayrolldata->tarifthhari;
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

                    // if (empty($datathismonth->jumlahopeinput)) {
                    //     $phistory->jumlahope = $datathismonth->jumlahharibermalam * $employeepayrolldata->tarifthhari;
                    // } else {
                    $phistory->jumlahope = $datathismonth->jumlahharibermalam * $datathismonth->jumlahopeinput;
                    // }

                    // $phistory->jumlahklaimdibayarkan = $datathismonth->jumlahklaimpengobatan * $employeepayrolldata->persenbpjskesehatan / 100;
                    // $phistory->jumlahklaimakumulasi = $phistory->jumlahklaimdibayarkan + $datathismonth->jumlahklaimakumulasiinput;
                    $phistory->persenklaim = $phistory->jumlahklaimakumulasi / $employeepayrolldata->gajipokok * 100;
                    $phistory->jumlahpenghasilantidaktetap =
                        $datathismonth->koreksipenambahan -
                        $datathismonth->exceptional +
                        $datathismonth->jumlahklaimpengobatan +
                        // $datathismonth->insentifpenghargaan +
                        // $phistory -> jumlahklaimyangdibayarkan
                        $phistory->jumlahope +
                        $phistory->jumlahuangmakanlembur +
                        $phistory->jumlahtransportasi +
                        // $phistory->jumlahthaktual +
                        $phistory->jumlahlembur;
                    $phistory->jumlahpenghasilantidakrutin =
                        $datathismonth->insentif +
                        $datathismonth->bonus +
                        $datathismonth->tunjanganhariraya;
                    $phistory->penghasilanbruto =
                        $phistory->jumlahupahtetapaktual +
                        $phistory->jumlahpenghasilantidaktetap +
                        $phistory->jumlahpenghasilantidakrutin;
                    // $phistory->jumlahpinjamandandeposit =
                    // $datathismonth->pencairanpinjaman +
                    // $datathismonth->pengembaliandeposit;
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
                        // $datathismonth->penaltikerja +
                        // $datathismonth->pemotongandeposit +
                        $datathismonth->pemotonganpinjaman;
                    // $datathismonth->pembayaranpinjaman;

                    //        $phistory->takehomepay =
                    //            $phistory->penghasilanbruto +
                    //            $phistory->jumlahpinjamandandeposit -
                    //            $phistory->jumlahpemotongan;

                    //_________________________________________//

                    $phistory->penghasilanbulanan =
                        $phistory->penghasilanbruto -
                        $phistory->jumlahpenghasilantidakrutin;

                    $phistory->BPJSkesehatan = $datathismonth->bpjskesehatan / (1 / 100) * (4 / 100);
                    // $phistory -> BPJSketenagakerjaan054
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

                    // =IF(CQ7*5%/CJ7>500000,CJ7*500000,CQ7*5%)
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
                    // if ($phistory->lapis === 1) {
                    //     $phistory->pajakpenghasilan = ($phistory->pkppembulatan * (5 / 100));
                    // } elseif ($phistory->lapis === 2) {
                    //     $phistory->pajakpenghasilan = (2500000 + ($phistory->pkppembulatan - 50000000) * (15 / 100)) * (120 / 100);
                    // } elseif ($phistory->lapis === 3) {
                    //     $phistory->pajakpenghasilan = (32500000 + ($phistory->pkppembulatan - 250000000) * (25 / 100)) * (120 / 100);
                    // } elseif ($phistory->lapis === 4) {
                    //     $phistory->pajakpenghasilan = (95000000 + ($phistory->pkppembulatan - 500000000) * (30 / 100)) * (120 / 100);
                    // };
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
                    $phistory->persenupah = ($phistory->jumlahupahtetapaktual / $phistory->penghasilanbruto) * 100;
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

                    // $datathismonth->update();
                    if($submit){
                        DB::transaction(function () use ($phistory, $datathismonth) {
                            $datathismonth->payrollcheck = 'done';
                            $datathismonth->update();
                            $phistory->save();
                        });
                    }else{
                        $merged = array_merge($datathismonth->toArray(), $phistory->toArray());
                        array_push($calculatedPayroll, $merged);
                    }
                }
            }
           }
           catch (Exception $e){
                continue;
           }
        }

        if(!$submit){
            return $calculatedPayroll;
        }else{
            return;
        }
    }
}
