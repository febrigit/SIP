<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use DB;
use App\User;
use App\Model\Item;
use App\Model\ItemReceive;
use App\Model\ItemUsage;
use App\Model\StockAdjustment;
use App\Model\StockOpname;
use Auth;

class ItemLog extends Model
{
    use SoftDeletes;

    protected $table = 'item_logs';
    protected $appends = ['transaction_code'];

    public function createdBy() {
        return $this->hasOne(User::class, 'id', 'created_by')->withTrashed();
    }

    public function item() {
        return $this->hasOne(Item::class, 'id', 'item_id')->withTrashed();
    }

    public function storeLog($data, $ref = '', $ref_id = '') {
        DB::beginTransaction();
        try {
            $res = new ItemLog();
            
            if ($data->first_stock) {
                $first_stock = $data->first_stock;
                $last_stock = $data->last_stock;
            } else {
                $item = Item::find($data->item_id);
                $first_stock = $item->stock;
                $last_stock = $item->stock + $data->qty;
            }

            $res->item_id = $data->item_id;
            $res->first_stock = $first_stock;
            $res->last_stock = $last_stock;
            $res->qty = $data->qty;
            $res->created_by = Auth::user()->id;

            $res->ref = $ref;
            $res->ref_id = $ref_id;

            $res->save();

            DB::commit();
            return $res;
        } catch (Exception $e) {
            DB::rollback();
            return $e->getMessage();
        }
    }

    public function getTransactionCodeAttribute () {
        if ($this->ref == 'ItemReceive') $data = ItemReceive::find($this->ref_id);
        if ($this->ref == 'ItemUsage') $data = ItemUsage::find($this->ref_id);
        if ($this->ref == 'StockAdjustment') $data = StockAdjustment::find($this->ref_id);
        if ($this->ref == 'StockOpname') $data = StockOpname::find($this->ref_id);

        return $data ? $data->code : '-';
    }

}
