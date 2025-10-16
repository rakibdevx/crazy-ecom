<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ChildCategory extends Model
{
    protected $guarded = [];

    public function subcategory()
    {
        return $this->belongsTo(SubCategory::class, 'sub_categories_id');
    }

    public function category()
    {
        return $this->hasOneThrough(Category::class, SubCategory::class, 'id', 'id', 'sub_categories_id', 'category_id');
    }

}
