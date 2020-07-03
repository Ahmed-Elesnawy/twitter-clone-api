<?php

namespace App\Http\Controllers\API\V1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Tweet;

class LikeController extends Controller
{

    public function like(Tweet $tweet)
    {
    	auth()->user()->likedTweets()->toggle($tweet);

    	return response()->json([
    		'status' => true,
    		'liked'  => $tweet->likedBy(auth()->user()),
    	]);
    }
}
