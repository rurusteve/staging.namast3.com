<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

    protected $table = 'users2';

    protected $fillable = [
        'nip', 'name', 'email', 'logintype', 'admin', 'password', 'contact', 'division'
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];

    public function data()
    {
        $this->hasOne(MasterEmployee::class, 'nip', 'nip');
    }
}
