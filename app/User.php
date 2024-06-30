<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;
use DB;
use Auth;
use App\Model\Role;

class User extends Authenticatable
{
    use Notifiable, SoftDeletes;

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

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];



    public function createdBy() {
        return $this->hasOne(User::class, 'id', 'created_by')->withTrashed();
    }

    public function updatedBy() {
        return $this->hasOne(User::class, 'id', 'updated_by')->withTrashed();
    }

    public function deletedBy() {
        return $this->hasOne(User::class, 'id', 'deleted_by')->withTrashed();
    }

    public function role() {
        return $this->hasOne(Role::class, 'id', 'role_id')->withTrashed();
    }
}
