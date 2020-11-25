<?php

namespace App\Http\Controllers;

use App\Rules\MatchOldPassword;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function editPassword()
    {
        return view('auth.passwords.edit');
    }

    public function updatePassword(Request $request, User $user)
    {
        $request->validate([
            'currentPassword' => ['required', new MatchOldPassword()],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
        auth()->user()->update(['password'=> Hash::make($request->password)]);
        return redirect('/' . $user->username)->with('message', 'Password Changed Successfully!');;
    }
}
