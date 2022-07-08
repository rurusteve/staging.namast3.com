<?php

namespace App\Exports;

use App\MasterPayrollHistory;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class PayrollCalculationExport implements FromCollection, WithHeadings
{
    /**
     * @return \Illuminate\Support\Collection
     */
    use Exportable;

    private $period;

    public function __construct(int $period = null)
    {
        $this->period = $period;
    }

    public function collection()
    {
        $payrolls = MasterPayrollHistory::payrollingAll($this->period);
        $data = [];
        foreach ($payrolls as $payroll) {
            $sorted =  [
                "nip" => $payroll["nip"],
                "nama" => $payroll["nama"],
                "jumlahharihadir" => strval($payroll["jumlahharihadir"]),
                "haridalamsebulan" => strval($payroll["haridalamsebulan"]),
                "persenkehadiran" => strval($payroll["persenkehadiran"]),
                "gajipokok" => strval($payroll["gajipokok"]),
                "tunjanganjabatan" => strval($payroll["tunjanganjabatan"]),
                "tunjanganmakandantransport" => strval($payroll["tunjanganmakandantransport"]),
                "tunjanganlain" => strval($payroll["tunjanganlain"]),
                "jumlahupahtetap" => strval($payroll["jumlahupahtetap"]),
                "jumlahupahtetapaktual" => strval($payroll["jumlahupahtetapaktual"]),
                "tariflembur" => strval($payroll["tariflembur"]),
                "jumlahjamlembur" => strval($payroll["jumlahjamlembur"]),
                "potonganpp" => strval($payroll["potonganpp"]),
                "jumlahlemburtidakefektif" => strval($payroll["jumlahlemburtidakefektif"]),
                "jumlahharilembur" => strval($payroll["jumlahharilembur"]),
                "jumlahharilembursebulan" => strval($payroll["jumlahharilembursebulan"]),
                "tariftransportasi" => strval($payroll["tariftransportasi"]),
                "jumlahtransportasi" => strval($payroll["jumlahtransportasi"]),
                "tarifmakanlembur" => strval($payroll["tarifmakanlembur"]),
                "jumlahuangmakanlembur" => strval($payroll["jumlahuangmakanlembur"]),
                "jumlahharibermalam" => strval($payroll["jumlahharibermalam"]),
                "jumlahopeinput" => strval($payroll["jumlahopeinput"]),
                "jumlahope" => strval($payroll["jumlahope"]),
                "jumlahklaimpengobatan" => strval($payroll["jumlahklaimpengobatan"]),
                "tunjanganhariraya" => strval($payroll["tunjanganhariraya"]),
                "insentif" => strval($payroll["insentif"]),
                "bonus" => strval($payroll["bonus"]),
                "koreksipengurangan" => strval($payroll["koreksipengurangan"]),
                "jumlahpenghasilantidaktetap" => strval($payroll["jumlahpenghasilantidaktetap"]),
                "jumlahpenghasilantidakrutin" => strval($payroll["jumlahpenghasilantidakrutin"]),
                "penghasilanbruto" => strval($payroll["penghasilanbruto"]),
                "pembayaranterlebihdahulu" => strval($payroll["pembayaranterlebihdahulu"]),
                "bpjsketenagakerjaan" => strval($payroll["bpjsketenagakerjaan"]),
                "bpjspensiun" => strval($payroll["bpjspensiun"]),
                "bpjskesehatan" => strval($payroll["bpjskesehatan"]),
                "jumlahbpjs" => strval($payroll["jumlahbpjs"]),
                "pphpasal21" => strval($payroll["pphpasal21"]),
                "koreksipenambahan" => strval($payroll["koreksipenambahan"]),
                "jumlahpemotongan" => strval($payroll["jumlahpemotongan"]),
                "takehomepay" => strval($payroll["takehomepay"]),
                "total"=>strval($payroll["total"]),
            ];
            array_push($data, $sorted);
        }

        return collect($data);

    }

    public function headings(): array
    {
        return [
            "NIP",
            "Nama",
            "Jumlah Hari Hadir",
            "Jumlah Hari dalam Sebulan",
            "Persen Kehadiran",
            "Gaji Pokok",
            "Tunjangan Jabatan",
            "Tunjangan Harian",
            "Tunjangan Lain",
            "Jumlah Upah Tetap",
            "Jumlah Upah Tetap Aktual",
            "Tarif Lembur",
            "Jumlah Jam Lembur",
            "Potongan PP",
            "Jumlah Lembur Tidak Efektif",
            "Jumlah Hari Lembur",
            "Jumlah Hari Lembur > 21",
            "Tarif Transportasi",
            "Jumlah Transportasi",
            "Tarif Makan Lembur",
            "Jumlah Uang Makan Lembur",
            "Jumlah Hari Bermalam",
            "Tarif OPE",
            "Jumlah OPE",
            "Jumlah Klaim Pengobatan",
            "THR",
            "Insentif",
            "Bonus",
            "Koreksi Pengurangan",
            "Jumlah Penghasilan Tidak Tetap",
            "Jumlah Penghasilan Tidak Rutin",
            "Penghasilan Bruto",
            "Pembayaran Terlebih Dahulu",
            "BPJS Ketenagakerjaan",
            "BPJS Pensiun",
            "BPJS Kesehatan",
            "Jumlah BPJS",
            "PPH Pasal 21",
            "Koreksi Penambahan",
            "Jumlah Pemotongan",
            "Take Home Pay",
            "Total",
        ];
    }

}
