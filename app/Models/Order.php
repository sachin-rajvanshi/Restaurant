<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory, Notifiable;

    protected $fillable = [
    	'order_id',
    	'invoice_id',
    	'user_id',
    	'coupon_id',
    	'cart',
    	'name',
    	'email',
    	'mobile_number',
    	'country_id',
    	'state_id',
    	'city_id',
    	'address',
    	'total_amount',
    	'offer_amount',
    	'discount',
    	'tax_amount',
    	'tax_percent',
    	'discount_amount',
    	'payment_method',
    	'delivery_type',
    	'status',
    	'device_info',
    ];
}
