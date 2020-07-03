<?php

namespace App\Http\Controllers\API\V1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Http\Resources\TweetResource;

use App\Models\Tweet;


class RetweetController extends Controller
{
    


    public function retweet(Tweet $tweet)
    {

    	$tweet = auth()->user()->tweets()->create([

    		'title'      => $tweet->title,
    		'content'    => $tweet->content,
    		'parent_id'  => $tweet->id,
    		'photo'      => $tweet->photo,
    		'retweet_at' => now(), 

    	]); /* Or Use Replicate Method */



    	return new TweetResource($tweet);


    }
}
