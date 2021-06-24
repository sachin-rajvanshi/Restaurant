<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FoodVariant extends Model
{
    use HasFactory;

    protected $fillable = [
    	'food_id',
    	'quantity_id',
    	'price',
    	'discount',
    	'final_price',
    	'stock_quantity'
    ];

    public function getQuantity()
    {
    	return $this->belongsTo(Quantity::class, 'quantity_id', 'id');
    }
}
