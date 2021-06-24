<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;
use App\Models\User;

class User extends Authenticatable
{
    use HasFactory, Notifiable, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'role',
        'username',
        'profile_photo',
        'name',
        'email',
        'mobile_number',
        'phone_number',
        'dob',
        'gender',
        'address',
        'about_me',
        'website',
        'manager_name',
        'country_id',
        'state_id',
        'city_id',
        'date_of_open',
        'facebook',
        'twitter',
        'youtube',
        'linkedin',
        'marital_status',
        'email_verified_at',
        'mobile_verified_at',
        'company_name',
        'user_status',
        'password',
        'deleted_at',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * Get User Attached Documents
     */
    public function getDocuments() {
        return $this->hasMany(UserDocument::class, 'user_id', 'id');
    }

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

    /**
     * Get SMS History
     */
    public function getSmsHistory() {
        return $this->hasMany(SmsHistory::class, 'user_id', 'id');
    }

    /**
     * Get Email History
     */
    public function getEmailHistory() {
        return $this->hasMany(EmailHistory::class, 'user_id', 'id');
    }

    /**
     * Get Password Update History
     */
    public function getPasswordHistory() {
        return $this->hasMany(PasswordHistory::class, 'user_id', 'id');
    }

}
