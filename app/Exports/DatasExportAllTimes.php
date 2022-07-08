<?php

namespace App\Exports;

use App\MasterPayrollHistory;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;


class DatasExportAllTimes implements FromCollection, WithHeadings
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {

        return MasterPayrollHistory::join('payrollinput', 'payrollhistory.nip', '=', 'payrollinput.nip')
            ->join('masteremployee', 'masteremployee.nip', '=', 'payrollinput.nip')
            ->get();
    }

    public function headings(): array
    {
        return [

            '{Skip}',
            'NIP',
            'Nama',
            'Cross Cek NPWP',
            '% Kehadiran',
            'Jumlah Upah Tetap',
            'Jumlah Upah Tetap Aktual',
            '% Upah',
            'Cek % Upah',
            'Jumlah Kehadiran (Dalam Hari)',
            'Julah TH Aktual',
            'Tarif Lembur',
            'Jumlah Jam Lembur',
            'Jumlah Lembur',
            'Jumlah Transportasi > 21.00 WIB',
            'Jumlah Uang Makan Lembur',
            'Jumlah OPE',
            'Jumlah Klaim yang Dibayarkan',
            'Jumlah Klaim Akumulasi sd. Bulan Ini',
            '% Klaim',
            'Jumlah Penghasilan Tidak Tetap',
            'Jumlah Penghasilan Tidak Rutin',
            'Jumlah Pinjaman dan Deposit',
            'Jumlah BPJS',
            'Jumlah Pemotongan',
            'Take Home Pay',
            'Penghasilan Bulanan',
            'BPJS Ketenagakerjaan 0,54%',
            'BPJS Kesehatan',
            'Jumlah Penghasilan Rutin',
            'Jumlah Penghasilan Rutin (Disetahunkan)',
            'Penghasilan Tidak Rutin',
            'Penghasilan Bruto',
            'Penghasilan Bruto (Disetahunkan)',
            'Biaya Jabatan',
            'BPJS Ketenagakerjaan 2%',
            'BPJS Pensiun 1%',
            'Jumlah Pemotongan (Disetahunkan)',
            'PKP',
            'PTKP',
            'PKP Potong',
            'PKP Pembulatan',
            'Lapis',
            'Pajak Penghasilan',
            'Telah Dibayar Sebelumnya',
            'Kurang Bayar',
            'PPH Bulan Berkaitan',

            '[Slip] Earning Total',
            '[Slip] Deduction Total',
            '[Slip] Total',
            '[Sistem] Periode Payroll',

            '[Sistem] created_at',
            '[Sistem] updated_at',

            'Jumlah Hari Hadir',
            'Jumlah Hari Sebulan',
            'Jumlah Kehadiran (Dalam Jam)',
            'Jumlah Jam Lembur',
            'Potongan Sesuai PP',
            'Lembur Tidak Efektif / Over Budget',
            'Jumlah Hari Lembur Lewat > 21.00 WIB',
            'Jumlah Hari Lembur',
            'Jumlah Hari Bermalam',
            'Tarif OPE',
            'Jumlah Klaim Pengobatan',
            'Jumlah Klaim Akumulasi sd. Bulan Lalu',
            'Tunjangan Hari Raya',
            'Insentif',
            'Bonus',
            'Insentif Penghargaan',
            'Pencairan Pinjaman',
            'Pengembalian Deposit',
            'Pembayaran Pinjaman',
            'Pemotongan Deposit',
            'Penalti Karena Kesalahan Kerja/Resign',
            'Pembayaran Terlebih Dahulu',
            'Iuran Koperasi',
            'BPJS Ketenagakerjaan 2%',
            'BPJS Pensiun 1%',
            'BPJS Kesehatan',
            'PPH Pasal 21',
            'Koreksi Pengurangan',
            'Koreksi Penambahan',
            '[Sistem] Status Proses Payroll',

            'Institusi',
            'Kota',
            'Tanggal Bergabung',
            'Status',
            'Posisi',
            'Lembur',
            'Grade',
            'Grup',
            'Kode Divisi',
            '[Sistem] In Charge Status',
            'No Rekening',
            'NPWP',
            'Status Untuk PTKP',
            'Gaji Pokok',
            'Tunjangan Jabatan',
            'Tunjangan Makan dan Transport',
            'Tunjangan Lain-lain',
            'Tarif TH Per Hari',
            'Tarif Transportasi',
            'Tarif Uang Makan Lembur',
            '% Klaim Pengobatan'

        ];
    }
}
