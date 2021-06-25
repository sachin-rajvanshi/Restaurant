<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ingredient extends Model
{
    use HasFactory;

    protected $fillable = [
    	'food_id',
    	'type',
    	'name',
    	'price',
    	'status',
    	'remark'
    ];
}
