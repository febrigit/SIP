<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use DB;
use App\User;
use App\Model\Item;

class StockAdjustment extends Model
{
    use SoftDeletes;

    protected $table = 'stock_adjustments';
    //

    public function createdBy() {
        return $this->hasOne(User::class, 'id', 'created_by')->withTrashed();
    }
    
    public function item() {
        return $this->hasOne(Item::class, 'id', 'item_id')->withTrashed();
    }
}
