<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PromotionalBanner extends Model
{
    use HasFactory;

    protected $fillable = [
    	'name',
    	'image',
    	'position',
    	'text_required',
    	'text',
    	'applications',
    	'remark',
    	'status',
    ];
}
