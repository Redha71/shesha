<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ChildSubCategory extends Model
{
    use HasFactory;
    protected $fillable = [
        'childsubcategory_name_en',
        'childsubcategory_name_ar',
        'childsubcategory_slug_en',
        'childsubcategory_slug_ar',
        'category_id',
        'subcategory_id',
    ];
    public function subcategory()
    {
        return $this->belongsTo(SubCategory::class, 'subcategory_id', 'id');
    }
    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id', 'id');
    }
}
