<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MasterEmployee extends Model
{
    public $table = 'masteremployee';

    public function group()
    {
        return $this->belongsTo(Group::class, 'divisi', 'id');
    }

    public function user()
    {
        $this->belongsTo(User::class, 'nip', 'nip');
    }
}

