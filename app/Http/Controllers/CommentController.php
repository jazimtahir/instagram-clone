<?php

namespace App\Http\Controllers;

use Auth;
use App\Post;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function index(Post $post)
    {
        return response()->json($post->comments()->with('user.profile')->latest()->get());
    }

    public function store(Request $request,  Post $post)
    {
        $data = request()->validate([
            'body' => 'required | max:100',
        ]);
        $user_id =  auth('api')->user()->id;
        $comment = $post->comments()->create([
            'body' => $data['body'],
            'user_id' => $user_id,
        ]);

        $comment->load('user.profile');

        return $comment->toJson();
    }
}
