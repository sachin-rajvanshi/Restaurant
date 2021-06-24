<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AddressBook extends Model
{
    use HasFactory;

    protected $fillable = [
    	'user_id',
    	'type',
    	'country_id',
    	'state_id',
    	'city_id',
    	'address',
    	'pincode',
        'mobile_number',
    	'set_as_default'
    ];

    /**
     * Get Country
     */
    public function getCountry() {
        return $this->belongsTo(Country::class, 'country_id', 'id');
    }

    /**
     * Get State
     */
    public function getState() {
        return $this->belongsTo(State::class, 'state_id', 'id');
    }

    /**
     * Get City
     */
    public function getCity() {
        return $this->belongsTo(City::class, 'city_id', 'id');
    }
}
