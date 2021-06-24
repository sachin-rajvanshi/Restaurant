<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
    	'parent_id',
    	'image',
    	'name',
    	'slug',
    	'remark',
    	'meta_title',
    	'meta_keywords',
    	'meta_Description',
    	'status'
    ];

    public function getSubCategories($id) {
        $sub_categories = Category::where('parent_id', $id)->get();
        return $sub_categories;
    }
}
