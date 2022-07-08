<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class MasterUser extends Authenticatable
{
    use Notifiable;

    public $table = 'users';

    protected $fillable = [
        'name', 'nip', 'logintype', 'email'
//        'admin',
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];
}


//class User extends Authenticatable
//{}
