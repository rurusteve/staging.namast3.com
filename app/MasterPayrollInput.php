<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MasterPayrollInput extends Model
{
    public $table = 'payrollinput';

    public $fillable = [
        'nip' ,
        'jumlahharihadir',
        'haridalamsebulan',
        'jumlahkehadirandalamjam',
        'jumlahjamlemburinput',
        'potonganpp',
        'jumlahlemburtidakefektif',
        'jumlahharilembursebulan',
        'jumlahharilembur',
        'jumlahharibermalam',
        'jumlahopeinput',
        'jumlahklaimpengobatan',
        'jumlahklaimakumulasiinput',
        'tunjanganhariraya',
        'insentif',
        'bonus',
        'insentifpenghargaan',
        'pencairanpinjaman',
        'pengembaliandeposit',
        'pembayaranpinjaman',
        'pemotongandeposit',
        'penaltikerja',
        'pembayaranterlebihdahulu',
        'iurankoperasi',
        'bpjsketenagakerjaan',
        'bpjspensiun',
        'bpjskesehatan',
        'pphpasal21',
        'koreksipengurangan',
        'koreksipenambahan',
        'telahdibayarsebelumnya',
        'periode',
        'exceptional'
        ];
}
