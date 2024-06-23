<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use DB;
use App\User;

class Unit extends Model
{
    use SoftDeletes;

    protected $table = 'units';
    //

    // public function createdBy() {
    //     return $this->hasOne(User::class, 'id', 'created_by')->withTrashed();
    // }

}
