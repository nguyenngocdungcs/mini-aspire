<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Tymon\JWTAuth\Contracts\JWTSubject;

class User extends Authenticatable implements JWTSubject
{
    const ROLE_ADMIN = 1;
    const ROLE_USER = 2;

    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'role_id', 'email_verified_at',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'bonus_point' => 'float',

    ];

    /**
     * Get the identifier that will be stored in the subject claim of the JWT.
     *
     * @return mixed
     */
    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    /**
     * Return a key value array, containing any custom claims to be added to the JWT.
     *
     * @return array
     */
    public function getJWTCustomClaims()
    {
        return [];
    }

    public function hasPermission($actionName)
    {
        $permissions = config("roles.permissions")[$this->role_id];
        if (is_null($permissions)) {
            return true;
        }

        $permissions = array_merge(config("roles.none_authorize_actions"), $permissions);
        if (in_array($actionName, $permissions)) {
            return true;
        }

        // If action name is a.b, we should check if user has permission a.*
        $actionArray = explode('.', $actionName);
        $key = $actionArray[0];
        $actionAllItem = count($actionArray) > 1 ? $key . ".*" : null;
        return in_array($actionAllItem, $permissions);
    }
}
