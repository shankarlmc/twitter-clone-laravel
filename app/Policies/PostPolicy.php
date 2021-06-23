<?php

namespace App\Policies;

use App\Post;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class PostPolicy
{
    use HandlesAuthorization;
    /**
     * determine user have rights to delete ost or not
     * if the user is owner of post then he/she can delete post
     */
    public function delete(User $user, Post $post)
    {
        return $user->id === $post->user_id;
    }
}
