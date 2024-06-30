<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use DB;
use App\User;

class Category extends Model
{
    use SoftDeletes;

    protected $table = 'categories';

    public function createdBy() {
        return $this->hasOne(User::class, 'id', 'created_by')->withTrashed();
    }

    public function updatedBy() {
        return $this->hasOne(User::class, 'id', 'updated_by')->withTrashed();
    }

}
