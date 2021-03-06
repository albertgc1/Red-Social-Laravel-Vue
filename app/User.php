<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'first_name', 'last_name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function getRouteKeyName()
    {
        return 'name';
    }

    public function avatar()
    {
        return 'https://iupac.org/wp-content/uploads/2018/05/default-avatar.png';
    }

    /*public function getAvatarAttribute()
    {
        return $this->avatar();
    }*/
    
    public function link()
    {
        return route('users.show', $this);
    }

    public function statuses()
    {
        return $this->hasMany(Status::class);
    }
}
