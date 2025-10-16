<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SubCategory extends Model
{
    protected $guarded = [];

    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }

    public function childcategories()
    {
        return $this->hasMany(ChildCategory::class, 'sub_category_id');
    }
}
