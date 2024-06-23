<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use DB;
use App\User;
use App\Model\ItemReceiveDetail;

class ItemReceive extends Model
{
    use SoftDeletes;

    protected $table = 'item_receives';
    //

    public function createdBy() {
        return $this->hasOne(User::class, 'id', 'created_by')->withTrashed();
    }

    public function submittedBy() {
        return $this->hasOne(User::class, 'id', 'submitted_by')->withTrashed();
    }

    public function itemReceiveDetail() {
        return $this->hasMany(ItemReceiveDetail::class, 'item_receive_id');
    }
}
