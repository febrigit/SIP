<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use DB;
use App\User;

class Role extends Model
{
    use SoftDeletes;

    protected $table = 'roles';

    public function createdBy() {
        return $this->hasOne(User::class, 'id', 'created_by')->withTrashed();
    }

    public function updatedBy() {
        return $this->hasOne(User::class, 'id', 'updated_by')->withTrashed();
    }

    public function permissions() {
        return $this->hasMany(RolePermission::class, 'role_id');
    }
}
