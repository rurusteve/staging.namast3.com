<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MasterTask extends Model
{
    public $table = 'mastertasks';

    public function timereports()
    {
        return $this->hasMany(TimeReport::class, 'task', 'id');
    }
}
