<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Deal extends Model
{
    use HasFactory;

    protected $fillable = [
    	'name',
    	'category',
    	'sub_category',
    	'food_items',
    	'discount',
    	'max_discount',
    	'min_order',
    	'start_date',
    	'end_date',
    	'apply_for',
    	'usages',
    	'status'
    ];

    public function getCategories($ids)
    {
        $c = [];
        $categories = Category::withTrashed()->whereIn('id', explode(',', $ids))->get();
        if(count($categories) > 0) {
            foreach ($categories as $category) {
                array_push($c, $category->name);
            }
            return implode(', ', $c);
        }else {
            return 'N/A';
        }
    }

    public function getSubCategories($ids)
    {
        $s = [];
        $sub_categories = Category::withTrashed()->whereIn('id', explode(',', $ids))->get();
        if(count($sub_categories) > 0) {
            foreach ($sub_categories as $sub_category) {
                array_push($s, $sub_category->name);
            }
            return implode(', ', $s);
        }else {
            return 'N/A';
        }
    }

    public function getFoodItems($ids)
    {
        $f = [];
        $items = FoodItem::withTrashed()->whereIn('id', explode(',', $ids))->get();
        if(count($items) > 0) {
            foreach ($items as $item) {
                array_push($f, $item->name);
            }
            return implode(', ', $f);
        }else {
            return 'N/A';
        }
    }


}
