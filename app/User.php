<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;

/**
* Model class untuk user, authenticable yang artinya objek ini digunakan untuk login
*
* @author Putu Wira Astika Dharma
* @version 10/04/2016
*/
class User extends Authenticatable
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];
}
