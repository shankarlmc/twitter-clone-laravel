<?php

namespace App\Http\Controllers;

use App\Post;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        // $posts = Post::paginate(2);
        $posts = Post::orderBy('created_at','desc')->with(['user','likes'])->paginate(10);
        return view('home.index', [
            'posts' => $posts
        ]);
    }
}
