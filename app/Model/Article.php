<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use DB;
use App\User;
use App\Model\Category;

class Article extends Model
{
    use SoftDeletes;

    protected $table = 'articles';

    public function createdBy() {
        return $this->hasOne(User::class, 'id', 'created_by')->withTrashed();
    }

    public function updatedBy() {
        return $this->hasOne(User::class, 'id', 'updated_by')->withTrashed();
    }

    public function category() {
        return $this->hasOne(Category::class, 'id', 'category_id')->withTrashed();
    }

    public function user() {
        return $this->hasOne(User::class, 'id', 'user_id')->withTrashed();
    }
}
