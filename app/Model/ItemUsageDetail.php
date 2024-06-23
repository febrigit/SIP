<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use DB;
use App\User;
use App\Model\ItemUsage;
use App\Model\Item;

class ItemUsageDetail extends Model
{
    use SoftDeletes;

    protected $table = 'item_usage_details';
    //

    public function itemUsage() {
        return $this->hasOne(ItemUsage::class, 'id', 'item_usage_id')->withTrashed();
    }

    public function item() {
        return $this->hasOne(Item::class, 'id', 'item_id')->withTrashed();
    }
}
