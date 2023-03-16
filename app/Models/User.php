<?php

namespace App\Models;

use Tymon\JWTAuth\Contracts\JWTSubject;
// use Illuminate\Contracts\Auth\Authenticatable;
use Jenssegers\Mongodb\Auth\User as Authenticatable;


class User extends Authenticatable implements JWTSubject
{
    protected $connection = 'mongodb';
    protected $collection = 'users';
    
    protected $fillable = [
        'name', 'email', 'password',
    ];
    
    protected $hidden = [
        'password', 'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function getJWTIdentifier() {
        return $this->getKey();
    }

    /**
     * Return a key value array, containing any custom claims to be added to the JWT.
     *
     * @return array
     */
    public function getJWTCustomClaims() {
        return [];
    }    

}
