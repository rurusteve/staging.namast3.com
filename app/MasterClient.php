<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MasterClient extends Model
{
	protected $guarded = [];
    protected $hidden = ['created_at', 'updated_at'];

    public $table = 'masterclients';
    public $fillable = [
        'clientname',
        'engagementperiod',
        'clientcode',
        'location',
        'institusi',
        'branch',
        'engagementtype',
        'keterangan',
        'fee',
    ];    
}
