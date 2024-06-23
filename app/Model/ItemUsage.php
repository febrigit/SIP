<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use DB;
use App\User;
use App\Model\ItemUsageDetail;

class ItemUsage extends Model
{
    use SoftDeletes;

    protected $table = 'item_usages';
    //

    public function createdBy() {
        return $this->hasOne(User::class, 'id', 'created_by')->withTrashed();
    }

    public function submittedBy() {
        return $this->hasOne(User::class, 'id', 'submitted_by')->withTrashed();
    }

    public function itemUsageDetail() {
        return $this->hasMany(ItemUsageDetail::class, 'item_usage_id');
    }
}
