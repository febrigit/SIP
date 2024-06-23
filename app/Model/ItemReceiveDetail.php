<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use DB;
use App\User;
use App\Model\ItemReceive;
use App\Model\Item;

class ItemReceiveDetail extends Model
{
    use SoftDeletes;

    protected $table = 'item_receive_details';
    //

    public function itemReceive() {
        return $this->hasOne(ItemReceive::class, 'id', 'item_receive_id')->withTrashed();
    }

    public function item() {
        return $this->hasOne(Item::class, 'id', 'item_id')->withTrashed();
    }
}
