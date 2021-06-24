<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class PasswordHistory extends Model
{
    use HasFactory;

    protected $fillable = [
    	'user_id',
    	'perform_by',
    	'event'
    ];

     /**
     * Get User Data
     */
    public function getUser($id) {
        $user = User::find($id);
        return $user;
    }
}
