<?php

namespace App\Http\Controllers\API\V1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\User;



class FollowController extends Controller
{
	public function __construct()
	{
		$this->middleware('jwt');
	}

    public function follow(User $user)
    {
    	auth()->user()->follows()->toggle($user);


    	return response()->json([
    		'status'   => true
    		'follow'   => auth()->user()->isFollow($user),
    		'unfollow' => auth()->user()->isFollow($user),
    	]);
    }
}
