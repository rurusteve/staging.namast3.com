<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MasterBiodata extends Model
{
    public $table = 'masterbiodata';

    public $fillable = [
        'nip',
        'tempatlahir',
        'tanggallahir',
        'nohp',
        'nomorkontakdarurat',
        'namakontakdarurat',
        'emailpribadi',
        'domisili',
        'kodepos',
        'nik',
        'agama',
        'statussipil',
        'namapasangan',
        'tanggallahirpasangan',
        'jumlahanak',
        'pendidikanterakhir',
        'universitas',
        'bpjskes',
        'bpjstk',
        'asuransi',
        'riwayatpenyakit'
    ];
}
