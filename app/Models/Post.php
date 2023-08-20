<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    // Define the relationship with the User model
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Define the relationship with the PostLike model
    public function likes()
    {
        return $this->hasMany(PostLike::class);
    }

    // Define the relationship with the PostComment model
    public function comments()
    {
        return $this->hasMany(PostComment::class);
    }

    // Define an accessor to get the count of comments
    public function getCommentsCountAttribute()
    {
        return $this->comments()->count();
    }

    // Define an accessor to get the count of likes
    public function getLikesCountAttribute()
    {
        return $this->likes()->count();
    }
}
