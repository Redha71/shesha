<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubSubCategory extends Model
{
    use HasFactory;
    protected $fillable = [
        'category_id',
        'subcategory_id',
        'childsubcategory_name_en',
        'childsubcategory_name_ar',
        'childsubcategory_slug_en',
        'childsubcategory_slug_ar',
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
