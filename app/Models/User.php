<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\Access\Auhtorizable as AuthorizableContract;
use Illuminate\Contracts\Auth\Authenticable as AuthenticableContract;
use Tymon\JWTAuth\Contracts\JWTSubject;

//use App\Traits\Uuids;

class User extends Authenticatable implements JWTSubject
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'uuid'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'id',
        'password',
        'remember_token',
    ];

    /**
     * Get the route key for the model
     */

     //public function getKeyName(){
     //    return 'uuid';
     //}

     /**
      * Get the JWT Identifier key
      */
     public function getJWTIdentifier(){
         return $this->getKey();
     }

     /**
      * Get the JWT Custom Claims
      */
     public function getJWTCustomClaims(){
        return [];
    }

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    //Gets the transaction the user has added
    public function transactions(){
        return $this->hasMany('App\Models\Transaction');
    }
}
