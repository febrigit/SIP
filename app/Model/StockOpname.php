<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use DB;
use App\User;
use App\Model\StockOpnameDetail;

class StockOpname extends Model
{
    use SoftDeletes;

    protected $table = 'stock_opnames';
    //

    public function createdBy() {
        return $this->hasOne(User::class, 'id', 'created_by')->withTrashed();
    }

    public function submittedBy() {
        return $this->hasOne(User::class, 'id', 'submitted_by')->withTrashed();
    }

    public function stockOpnameDetail() {
        return $this->hasMany(StockOpnameDetail::class, 'stock_opname_id');
    }
}
