<?php

namespace App\Http\Controllers;

use App\Post;
use Illuminate\Http\Request;

class LikeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function store(Post $post)
    {
        return auth()->user()->liked()->toggle($post->id);
    }
}
