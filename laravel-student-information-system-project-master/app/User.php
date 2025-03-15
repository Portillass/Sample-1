<?php

namespace App;

use Illuminate\Auth\Authenticatable;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Foundation\Auth\Access\Authorizable;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;
use Bican\Roles\Traits\HasRoleAndPermission;
use Bican\Roles\Contracts\HasRoleAndPermission as HasRoleAndPermissionContract;

/**
 * Class User
 * @package App
 */
class User extends \Eloquent implements AuthenticatableContract, AuthorizableContract, CanResetPasswordContract, HasRoleAndPermissionContract
{
    use Authenticatable, Authorizable, CanResetPassword;

    use HasRoleAndPermission {
        HasRoleAndPermission ::can insteadof Authorizable;
    }


    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'users';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['username', 'password'];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = ['password', 'remember_token'];

    /**
     * Student relationship
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function student()
    {

        return $this->hasOne('App\Student', 'user_id');

    }

    /**
     * Lecturer relationship
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function lecturer()
    {

        return $this->hasOne('App\Lecturer', 'user_id');

    }
}
