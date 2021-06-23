<?php

namespace App\Http\Controllers;

use App\Post;
use Illuminate\Http\Request;
use App\User;

class ProfileController extends Controller
{
    public function index(User $user)
    {
        $posts = Post::orderBy('created_at','desc')->where('user_id', $user->id )->paginate(10);

        return view('profile.index', [
            'user' => $user,
            'posts' => $posts,
        ]);
    }
}
