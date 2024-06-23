<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use DB;
use App\User;
use App\Model\StockOpname;
use App\Model\Item;

class StockOpnameDetail extends Model
{
    use SoftDeletes;

    protected $table = 'stock_opname_details';
    //

    public function stockOpname() {
        return $this->hasOne(StockOpname::class, 'id', 'stock_opname_id')->withTrashed();
    }

    public function item() {
        return $this->hasOne(Item::class, 'id', 'item_id')->withTrashed();
    }
}
