<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use DB;
use App\User;
use App\Model\Role;
use App\Model\Permission;

class RolePermission extends Model
{
    use SoftDeletes;

    protected $table = 'role_permissions';

    public function createdBy() {
        return $this->hasOne(User::class, 'id', 'created_by')->withTrashed();
    }

    public function updatedBy() {
        return $this->hasOne(User::class, 'id', 'updated_by')->withTrashed();
    }

    public function role() {
        return $this->hasOne(Role::class, 'id', 'role_id')->withTrashed();
    }

    public function permission() {
        return $this->hasOne(Permission::class, 'id', 'permission_id')->withTrashed();
    }
}
