<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class LeaveRequest extends Model
{
    public $table = 'leaverequest';
    protected $fillable = [
        'filename',
        'lampiranpenugasan',
        'nip',
        'nama',
        'jumlahhari',
        'tanggalmulaicuti',
        'tanggalakhircuti',
        'keterangan',
        'jeniscuti',
        'filename',
        'lampiranpenugasan',
        'statuscuti',
        'leaverequesttype',
        'divisi',
        'bypartner',
        'nippartner',
        'ketbypartner',
        'partnerapprovaldate',
        'bymanager',
        'nipmanager',
        'ketbymanager',
        'managerapprovaldate',
        'created_at',
        'updated_at',
    ];

}
