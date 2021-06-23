<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $fillable = [
        'body',
    ];
    /**
     * To check whether the user liked the page or not
     */
    public function likedBy(User $user)
    {
        return $this->likes->contains('user_id', $user->id);
    }
    /**
     * The post belongs to the user
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    /**
     * The post and like relationship
     */
    public function likes()
    {
        return $this->hasMany(Like::class);
    }
}
