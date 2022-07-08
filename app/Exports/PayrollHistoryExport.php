<?php

namespace App\Exports;

use App\MasterEmployee;
use App\MasterPayrollHistory;
use App\TimeReport;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\FromView;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithHeadings;

class PayrollHistoryExport implements FromCollection, WithHeadings
{

    use Exportable;
    
    private $fileName = 'payrollhistory.xlsx';

    public function sendPara($request)
    {
        $this->request = $request;

        return $this;
    }

    public function collection()
    {
        $results =  MasterPayrollHistory::query()
            ->leftJoin('payrollinput', 'payrollhistory.nip', '=', 'payrollinput.nip')
            ->leftJoin('masteremployee', 'masteremployee.nip', '=', 'payrollinput.nip');

        if ($this->request->has('institusi')) {
            $results->where('institusi', 'like', $this->request->institusi);
        }
        if ($this->request->has('kota')) {
            $results->where('kota', 'like', $this->request->kota);
        }
        if ($this->request->has('status')) {
            $results->where('status', 'like', $this->request->status);
        }
        if ($this->request->has('positionid')) {
            $results->where('positionid', 'like', $this->request->positionid);
        }
        if ($this->request->has('grade')) {
            $results->where('grade', 'like', $this->request->grade);
        }
        if ($this->request->has('group')) {
            $results->where('grup', 'like', $this->request->group);
        }
        if ($this->request->has('periode')) {
                $results->where('payrollhistory.periode', 'like', $this->request->periode);
                $results->where('payrollinput.periode', 'like', $this->request->periode);
        }
      
        
        $collection = $results->select(
                'masteremployee.nip',
                'masteremployee.nama',
                'masteremployee.institusi',
                'masteremployee.kota',
                'masteremployee.tanggalbergabung',
                'masteremployee.status',
                'masteremployee.positionid',
                'masteremployee.lembur',
                'masteremployee.grade',
                'masteremployee.grup',
                'masteremployee.norek',
                'masteremployee.npwp',
                'payrollhistory.crossceknpwp',
                'masteremployee.statusptkp',
                'payrollinput.jumlahharihadir',
                'payrollinput.haridalamsebulan',
                'payrollhistory.persenkehadiran',
                'masteremployee.gajipokok',
                'masteremployee.tunjanganjabatan',
                'masteremployee.tunjangankesehatan',
                'masteremployee.tunjanganlain',
                'payrollhistory.jumlahupahtetap',
                'payrollhistory.jumlahupahtetapaktual',
                'payrollhistory.persenupah',
                'payrollhistory.jumlahkehadirandalamhari',
                'masteremployee.tarifthhari',
                'payrollhistory.jumlahthaktual',
                'payrollhistory.tariflembur',
                'payrollinput.jumlahjamlemburinput',
                'payrollinput.potonganpp',
                'payrollinput.jumlahlemburtidakefektif',
                'payrollhistory.jumlahjamlembur',
                'payrollhistory.jumlahlembur',
                'payrollinput.jumlahharilembursebulan',
                'masteremployee.tariftransportasi',
                'payrollhistory.jumlahtransportasi',
                'payrollinput.jumlahharilembur',
                'masteremployee.tarifmakanlembur',
                'payrollhistory.jumlahuangmakanlembur',
                'payrollinput.jumlahharibermalam',
                'payrollinput.jumlahopeinput',
                'payrollhistory.jumlahope',
                'payrollinput.jumlahklaimpengobatan',
                // 'masteremployee.persenbpjskesehatan',
                // 'payrollhistory.jumlahklaimdibayarkan',
                // 'payrollinput.jumlahklaimakumulasiinput',
                // 'payrollhistory.jumlahklaimakumulasi',
                'payrollhistory.persenklaim',
                'payrollinput.tunjanganhariraya',
                'payrollinput.insentif',
                'payrollinput.bonus',
                // 'payrollinput.insentifpenghargaan',
                'payrollinput.koreksipenambahan',
                'payrollhistory.jumlahpenghasilantidaktetap',
                'payrollhistory.jumlahpenghasilantidakrutin',
                'payrollhistory.penghasilanbruto',
                // 'payrollinput.pencairanpinjaman',
                // 'payrollinput.pengembaliandeposit',
                // 'payrollhistory.jumlahpinjamandandeposit',
                // 'payrollinput.pembayaranpinjaman',
                // 'payrollinput.pemotongandeposit',
                // 'payrollinput.penaltikerja',
                'payrollinput.pembayaranterlebihdahulu',
                // 'payrollinput.iurankoperasi',
                'payrollinput.bpjsketenagakerjaan',
                'payrollinput.bpjspensiun',
                'payrollinput.bpjskesehatan',
                'payrollhistory.jumlahbpjs',
                'payrollinput.pphpasal21',
                'payrollinput.koreksipengurangan',
                'payrollhistory.jumlahpemotongan',
                'payrollhistory.takehomepay',
//                'payrollhistory.crossceknpwp',
                'payrollhistory.penghasilanbulanan',
                'payrollhistory.bpjsketenagakerjaan054',
                'payrollhistory.BPJSkesehatan',
                'payrollhistory.jumlahpenghasilanrutin',
                'payrollhistory.jumlahpenghasilanrutindisetahunkan',
                'payrollhistory.penghasilantidakrutin',
                'payrollhistory.penghasilanbrutodisetahunkan',
                'payrollhistory.biayajabatan',
                'payrollhistory.bpjsketenagakerjaan2',
                'payrollhistory.bpjspensiun1',
                'payrollhistory.jumlahpemotongandisetahunkan',
                'payrollhistory.pkp',
                'payrollhistory.ptkp',
                'payrollhistory.pkppotong',
                'payrollhistory.pkppembulatan',
                'payrollhistory.lapis',
                'payrollhistory.pajakpenghasilan',
                'payrollinput.telahdibayarsebelumnya',
                'payrollhistory.kurangbayar',
                'payrollhistory.pphbulanberkaitan',
                'payrollhistory.periode'
            )->get();


            return $collection;
    }
    public function headings(): array
    {
        return [
            '            NIP',
            'NAMA KARYAWAN',
            'INSTITUSI',
            'KOTA',
            'TANGGAL BERGABUNG',
//            ' PERIODE BERGABUNG (BULAN) ',
            ' STATUS ',
            'POSISI',
            'LEMBUR',
            'GRADE',
            'GRUP',
            'NO REKENING',
            'NPWP',
            'CROSS CEK NPWP',
            'STATUS UNTUK PTKP',
            ' JUMLAH HARI HADIR ',
            ' JUMLAH HARI SEBULAN',
            // '    %',
            '    GAJI POKOK',
            'TUNJANGAN JABATAN',
            'TUNJANGAN MAKAN DAN TRANSPORT',
            'TUNJANGAN LAIN-LAIN',
            'JUMLAH UPAH TETAP',
            'JUMLAH UPAH TETAP AKTUAL',
            '    %',
//            '    JUMLAH KEHADIRAN (DALAM JAM)',
            'JUMLAH KEHADIRAN (DALAM HARI)',
            'TARIF TH PER HARI',
            'JUMLAH TH AKTUAL',
            'TARIF LEMBUR',
            'JUMLAH JAM LEMBUR',
            'POTONGAN SESUAI PP',
            'LEMBUR TIDAK EFEKTIF/ OVER BUDGET',
            'JUMLAH JAM LEMBUR',
            'JUMLAH LEMBUR',
            ' JUMLAH HARI LEMBUR LEWAT >21.00 WIB ',
            ' TARIF TRANSPORTASI ',
            'JUMLAH TRANSPORTASI >21.00 WIB',
            ' JUMLAH HARI LEMBUR ',
            ' TARIF UANG MAKAN LEMBUR ',
            'JUMLAH UANG MAKAN LEMBUR',
            ' JUMLAH HARI BERMALAM ',
            ' TARIF OPE ',
            'JUMLAH OPE',
            ' JUMLAH KLAIM PENGOBATAN',
            '    %',
            // '    JUMLAH KLAIM YANG DIBAYARKAN',
            // ' JUMLAH KLAIM AKUMULASI SD. BULAN LALU ',
            // ' JUMLAH KLAIM AKUMULASI SD. BULAN INI',
            '    % KLAIM ',
            'TUNJANGAN HARI RAYA',
            'INSENTIF',
            'BONUS',
            // 'INSENTIF PENGHARGAAN',
            'KOREKSI',
            'JUMLAH PENGHASILAN TIDAK TETAP',
            'JUMLAH PENGHASILAN TIDAK RUTIN',
            'PENGHASILAN BRUTO',
            // 'PENCAIRAN PINJAMAN',
            // 'PENGEMBALIAN DEPOSIT',
            // 'JUMLAH',
            // 'PEMBAYARAN PINJAMAN',
            // 'PEMOTONGAN DEPOSIT',
            // 'PENALTI KARENA KESALAHAN KERJA/RESIGN',
            'PEMBAYARAN TERLEBIH DAHULU',
            // 'IURAN KOPERASI',
            'BPJS         KETENAGA KERJAAN 2%',
            '    BPJS         PENSIUN 1%',
            '    BPJS         KESEHATAN',
            'JUMLAH BPJS',
            'PPH PASAL 21',
            'KOREKSI',
            'JUMLAH PEMOTONGAN',
            'TAKE HOME PAY',
//            'OCBC',
//            'BPJS         KETENAGA KERJAAN 6,24%',
//            '    BPJS         PENSIUN 3%',
//            '    BPJS         KESEHATAN 5%',
//            '    JUMLAH',
//            'DIPOTONG',
//            'NET',
//            'BPJS         KETENAGA KERJAAN 0,54%',
//            '    NPWP',
//            'PERIODE KERJA',
            'PENGHASILAN BULANAN',
            'BPJS KETENAGAKERJAAN 0,54%',
            '    BPJS KESEHATAN',
            'JUMLAH PENGHASILAN RUTIN',
            'JUMLAH PENGHASILAN RUTIN (DISETAHUNKAN)',
            'PENGHASILAN TIDAK RUTIN',
            'PENGHASILAN BRUTO',
            'BIAYA JABATAN',
            'BPJS KETENAGAKERJAAN 2%',
            '    BPJS PENSIUN 1%',
            '    JUMLAH PEMOTONGAN (DISETAHUNKAN)',
            'PKP',
            'PTKP',
            'PKP',
            'PKP PEMBULATAN',
            'LAPIS',
            'PAJAK PENGHASILAN',
            'TELAH DIBAYAR SEBELUMNYA',
            'KURANG BAYAR',
            'PPH BULAN BERKAITAN',
            'Periode'


//
//            '{Skip}',
//            'NIP',
//            'Nama',
//            'Cross Cek NPWP',
//            '% Kehadiran',
//            'Jumlah Upah Tetap',
//            'Jumlah Upah Tetap Aktual',
//            '% Upah',
//            'Cek % Upah',
//            'Jumlah Kehadiran (Dalam Hari)',
//            'Julah TH Aktual',
//            'Tarif Lembur',
//            'Jumlah Jam Lembur',
//            'Jumlah Lembur',
//            'Jumlah Transportasi > 21.00 WIB',
//            'Jumlah Uang Makan Lembur',
//            'Jumlah OPE',
//            'Jumlah Klaim yang Dibayarkan',
//            'Jumlah Klaim Akumulasi sd. Bulan Ini',
//            '% Klaim',
//            'Jumlah Penghasilan Tidak Tetap',
//            'Jumlah Penghasilan Tidak Rutin',
//            'Jumlah Pinjaman dan Deposit',
//            'Jumlah BPJS',
//            'Jumlah Pemotongan',
//            'Take Home Pay',
//            'Penghasilan Bulanan',
//            'BPJS Ketenagakerjaan 0,54%',
//            'BPJS Kesehatan',
//            'Jumlah Penghasilan Rutin',
//            'Jumlah Penghasilan Rutin (Disetahunkan)',
//            'Penghasilan Tidak Rutin',
//            'Penghasilan Bruto',
//            'Penghasilan Bruto (Disetahunkan)',
//            'Biaya Jabatan',
//            'BPJS Ketenagakerjaan 2%',
//            'BPJS Pensiun 1%',
//            'Jumlah Pemotongan (Disetahunkan)',
//            'PKP',
//            'PTKP',
//            'PKP Potong',
//            'PKP Pembulatan',
//            'Lapis',
//            'Pajak Penghasilan',
//            'Telah Dibayar Sebelumnya',
//            'Kurang Bayar',
//            'PPH Bulan Berkaitan',
//
//            '[Slip] Earning Total',
//            '[Slip] Deduction Total',
//            '[Slip] Total',
//            '[Sistem] Periode Payroll',
//
//            '[Sistem] created_at',
//            '[Sistem] updated_at',
//
//            'Jumlah Hari Hadir',
//            'Jumlah Hari Sebulan',
//            'Jumlah Kehadiran (Dalam Jam)',
//            'Jumlah Jam Lembur',
//            'Potongan Sesuai PP',
//            'Lembur Tidak Efektif / Over Budget',
//            'Jumlah Hari Lembur Lewat > 21.00 WIB',
//            'Jumlah Hari Lembur',
//            'Jumlah Hari Bermalam',
//            'Tarif OPE',
//            'Jumlah Klaim Pengobatan',
//            'Jumlah Klaim Akumulasi sd. Bulan Lalu',
//            'Tunjangan Hari Raya',
//            'Insentif',
//            'Bonus',
//            'Insentif Penghargaan',
//            'Pencairan Pinjaman',
//            'Pengembalian Deposit',
//            'Pembayaran Pinjaman',
//            'Pemotongan Deposit',
//            'Penalti Karena Kesalahan Kerja/Resign',
//            'Pembayaran Terlebih Dahulu',
//            'Iuran Koperasi',
//            'BPJS Ketenagakerjaan 2%',
//            'BPJS Pensiun 1%',
//            'BPJS Kesehatan',
//            'PPH Pasal 21',
//            'Koreksi Pengurangan',
//            'Koreksi Penambahan',
//            '[Sistem] Status Proses Payroll',
//
//            'Institusi',
//            'Kota',
//            'Tanggal Bergabung',
//            'Status',
//            'Posisi',
//            'Lembur',
//            'Grade',
//            'Grup',
//            'Kode Divisi',
//            '[Sistem] In Charge Status',
//            'No Rekening',
//            'NPWP',
//            'Status Untuk PTKP',
//            'Gaji Pokok',
//            'Tunjangan Jabatan',
//            'Tunjangan Makan dan Transport',
//            'Tunjangan Lain-lain',
//            'Tarif TH Per Hari',
//            'Tarif Transportasi',
//            'Tarif Uang Makan Lembur',
//            '% Klaim Pengobatan'

        ];
    }
}

