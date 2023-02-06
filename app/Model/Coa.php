<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use DB;

class Coa extends Model
{
    use SoftDeletes;

    protected $table = 'coa';
    //


}
