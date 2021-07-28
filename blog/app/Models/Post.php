<?php

namespace App\Models;

use App\Models\Like;
use App\Models\User;
use App\Models\Comments;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Post extends Model
{
    use HasFactory;

    protected $fillable = [
        'body'
    ];

    public function liked(User $user)
    {

        return $this->likes->contains('user_id', $user->id);
    }

    public function user()
    {

        return $this->belongsTo(user::class);
    }

    public function likes()
    {
        return $this->hasMany(Like::class);
    }

    public function comments()
    {
        return $this->hasMany(Comments::class);
    }
}
