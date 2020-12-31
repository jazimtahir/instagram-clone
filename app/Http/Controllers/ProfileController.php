<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;

class ProfileController extends Controller
{
    public function index($user)
    {
        $user = User::where('username', $user) -> firstOrFail();

        $follow = (auth()->user()) ? auth()->user()->following->contains($user->id) : false;
        return view('profile.index', [
            'user' => $user,
            'follow' => $follow,
        ]);
    }

    public function edit($user)
    {
        $user = User::where('username', $user) -> firstOrFail();
        $this->authorize('update', $user->profile);
        return view('profile.edit', compact('user'));
    }

    public function update($user)
    {
        $user = User::where('username', $user) -> firstOrFail();

        $this->authorize('update', $user->profile);

        $data = request()->validate([
            'title' => 'required',
            'description' => 'required',
            'url' => 'url | nullable',
            'image' => 'image | nullable',
        ]);
        $imgPath = '';
        if (request('image'))
        {

            if (($user->profile->image != NULL) && isset($data['image']))
            {
                Storage::disk('public')->delete($user->profile->image);
            }
            $imgPath = $data['image']->store('profile', 'public');

            $image = Image::make(public_path("storage/{$imgPath}"))->fit(1000, 1000);
            $image->save();
            auth()->user()->profile->update(array_merge(
                $data,
                ['image' => $imgPath]
            ));
        }
        else
        {
            auth()->user()->profile->update($data);
        }

        return redirect('/' . $user->username);
    }

    public function profilePicDelete(User $user)
    {
        Storage::disk('public')->delete($user->profile->image);
        auth()->user()->profile->update(['image' => NULL]);
        return redirect('/' . $user->username);
    }
}
