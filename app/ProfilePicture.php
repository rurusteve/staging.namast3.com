<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProfilePicture extends Model
{
    public $table = 'profilepicture';

    protected $fillable = [
        'nip',
        'picture'
    ];
}
