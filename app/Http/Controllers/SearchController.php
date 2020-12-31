<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use DB;
use Illuminate\Database\Eloquent\Builder;

class SearchController extends Controller
{
    public function search(Request $request)
    {
    	$users = [];
    	$results=DB::table('users')->where('username','LIKE','%'.$request->keywords."%")->get();
    	foreach ($results as $user) {
    		$users[] = User::with('profile')->findorfail($user->id);
    	}
        return response()->json($users);
         
    }
}
