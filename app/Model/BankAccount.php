<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use DB;

class BankAccount extends Model
{
    use SoftDeletes;

    protected $table = 'bank_accounts';
    //


}
