<?php

namespace App\Http\Controllers;

use App\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;

class PostController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
//        dd(auth()->user()->liked);
        $user = auth()->user()->following()->pluck('profiles.user_id');
        $posts = Post::whereIn('user_id', $user)->with('user')->latest()->paginate(5);
//        $posts = Post::whereIn('user_id', $user)->orderBy('created_at', 'DESC')->get();
        return view('post.index', compact('posts'));
    }

    public function create()
    {
        return view('post.create');
    }

    public function show(Post $post){
        $follow = (auth()->user()) ? auth()->user()->following->contains($post->user->id) : false;

        return view('post.show', compact('post', 'follow'));
    }

    public function store()
    {
        $data = request()->validate([
            'caption' => 'required',
            'file' => 'required | image',
        ]);

//        $data['image'] = $data['file'];
//        unset($data['file']);

        $imgPath = $data['file']->store('uploads', 'public');

        $image = Image::make(public_path("storage/{$imgPath}"))->fit(1200, 1200);
        $image->save();

        auth()->user()->posts()->create([
            'caption' => $data['caption'],
            'image' => $imgPath,
        ]);

        return redirect('/' . auth()->user()->username);
    }

    public function edit(Post $post)
    {
        $this->authorize('update', $post->user->profile);
        return view('post.edit', compact('post'));
    }

    public function update(Post $post)
    {
        $this->authorize('update', $post->user->profile);
        $data = request()->validate([
            'caption' => 'required',
        ]);
        //dd($data);
//        auth()->user()->post->update($data);
        $post->caption = $data['caption'];
        $post->save();
        return redirect('/p/' . $post->id);
    }

    public function destroy(Post $post)
    {
        $this->authorize('update', $post->user->profile);
        Storage::disk('public')->delete($post->image);
        $post->delete();
        return redirect('/' . $post->user->username);
    }
}
