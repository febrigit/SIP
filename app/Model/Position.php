<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use DB;
use App\User;

class Position extends Model
{
    use SoftDeletes;

    protected $table = 'positions';
    //

}
