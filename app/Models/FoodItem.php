<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;
use App\Models\FoodVariant;

class FoodItem extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
    	'category_id',
    	'sub_category_id',
    	'name',
    	'slug',
    	'remark',
    	'meta_title',
    	'keyword',
    	'description',
    	'stock',
    	'inventory',
    	'cod',
    	'home_delivery',
    	'takeaway',
    	'status',
        'favourite',
        'delivery_time'
    ];

    public function getGallery() {
        return $this->hasMany(FoodGallery::class, 'food_id', 'id')->orderBy('id', 'DESC');
    }

    public function getVarients() {
        return $this->hasMany(FoodVariant::class, 'food_id', 'id');
    }

    public function getCategory() {
        return $this->belongsTo(Category::class, 'category_id', 'id');
    }

    public function getSubCategory() {
        return $this->belongsTo(Category::class, 'sub_category_id', 'id');
    }

    public function getHighestPriceVarient($id) {
        $picked = FoodVariant::where('food_id', $id)->orderBy('price', 'DESC')->first();
        return $picked;
    }

    public function getHighestStockVarient($id) {
        $picked = FoodVariant::where('food_id', $id)->orderBy('stock_quantity', 'DESC')->first();
        return $picked;
    }
}
