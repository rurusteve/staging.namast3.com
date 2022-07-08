<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MasterItem extends Model
{
    public $table = 'items';
    public $fillable = ['title','description'];

}
