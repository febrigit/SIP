<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use DB;

class Funding extends Model
{
    use SoftDeletes;

    protected $table = 'fundings';
    //


}
