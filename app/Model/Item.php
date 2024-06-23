<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use DB;
use App\User;
use App\Model\Position;
use App\Model\Unit;

class Item extends Model
{
    use SoftDeletes;

    protected $table = 'items';
    //

    public function createdBy() {
        return $this->hasOne(User::class, 'id', 'created_by')->withTrashed();
    }

    public function position() {
        return $this->hasOne(Position::class, 'id', 'position_id')->withTrashed();
    }

    public function unit() {
        return $this->hasOne(Unit::class, 'id', 'unit_id')->withTrashed();
    }
}
