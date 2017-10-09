<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Carbon\Carbon;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'username', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    //RELATIONSHIP
    public function chats()
    {
        return $this->belongsToMany('App\Models\Chat');
    }

    //Carbon parse for created date accessor
    public function getCreatedAtAttribute($value)
    {
        return Carbon::parse($value);
    }

    // set the username to lowercase Mutator
    public function setUserNameAttribute($value)
    {
        $this->attributes['username'] = strtolower($value);
    }

    // Hashing the password Mutator
    public function setPasswordAttribute($value)
    {
        $this->attributes['password'] = bcrypt($value);
    }

    // Custom method to know if the user is new
    public function isNew()
    {
        if(Carbon::parse($this->attributes['created_at'])->diffInHours(Carbon::now()) <= 12) {
            return true;
        }else{
            return false;
        }
    }
}
