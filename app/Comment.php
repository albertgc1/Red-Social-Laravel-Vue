<?php

namespace App;

use App\Traits\HasLikes;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasLikes;

    protected $fillable = [
        'body', 'status_id', 'user_id'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
