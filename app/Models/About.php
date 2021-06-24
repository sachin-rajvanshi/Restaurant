<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class About extends Model
{
    use HasFactory;

    protected $fillable = [
    	'heading',
    	'title',
        'tag_one',
        'tag_two',
    	'section_one_image',
    	'section_one_description',
    	'section_two_image',
    	'section_two_description',
    	'food_items',
    	'clients_daily',
    	'years_of_experience',
    	'fresh_halal',
    ];
}
