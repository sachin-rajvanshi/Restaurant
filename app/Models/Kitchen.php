<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class Kitchen extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
    	'branch_id',
    	'name',
    	'chef_name',
    	'status'
    ];
}
