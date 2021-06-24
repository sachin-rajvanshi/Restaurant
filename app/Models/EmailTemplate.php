<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EmailTemplate extends Model
{
    use HasFactory;

    protected $fillable = [
    	'image',
    	'name',
    	'code',
    	'subject',
    	'template',
    	'button',
    	'button_html',
    	'status'
    ];
}
