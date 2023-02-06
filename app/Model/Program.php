<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use DB;
use App\User;

class Program extends Model
{
    use SoftDeletes;

    protected $table = 'programs';
    //

    public function pm() {
        return $this->hasOne(User::class, 'id', 'pm_id');
    }

}
