<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
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
        'name',
        'username',
        'email', 
        'password',
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
     * Create a user has many post relation
     * to the post model
     */
    public function posts()
    {
        return $this->hasMany(Post::class);
    }
    /**
     * user and post like relationship
     */
    public function likes()
    {
        return $this->hasMany(Like::class);
    }
    /**
     * user has one profile
     */
    public function profile()
    {
        return $this->hasOne(Profile::class);
    }
}
