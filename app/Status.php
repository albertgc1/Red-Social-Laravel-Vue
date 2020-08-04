<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Status extends Model
{
    protected $fillable = [
    	'body', 'user_id'
    ];

    public function user()
    {
    	return $this->belongsTo(User::class);
    }

    public function likes()
    {
    	return $this->hasMany(Like::class);
    }
}
