<?php

namespace App\Http\Controllers\API\V1;

use App\Models\Tweet;
use App\Models\Hashtag;
use App\Http\Requests\TweetRequest;
use App\Http\Controllers\Controller;
use App\Http\Resources\TweetResource;
use App\Traits\ApiResponseTrait;
use Symfony\Component\HttpFoundation\Response;


class TweetController extends Controller
{

    use ApiResponseTrait;

    public function __construct()
    {
        $this->middleware('jwt')->except(['index','show']);
    }
    



    public function index()
    {
        $tweets = Tweet::with('user')
                 ->latest()
                 ->paginate(10);

        return TweetResource::collection($tweets);
    }

    
    public function show(Tweet $tweet)
    {
        return new TweetResource($tweet);
    }


    public function store(TweetRequest $request)
    {

        $attributes = $request->validated();

        if ( $request->hasFile('photo') )
        {
            $attributes['photo'] = $this->uploadPhoto($request);
        }

        $tweet = auth()->user()->tweets()->create($attributes);

        return new TweetResource($tweet);
    }



    public function update(Tweet $tweet,TweetRequest $request)
    {
        
        if ( !auth()->user()->can('update',$tweet) )
        {
            return $this->successResponse('Authorization Error',401);
        }

        $tweet->update($request->validated());
        
        return new TweetResource($tweet);
    }



    public function destroy(Tweet $tweet)
    {

        if ( !auth()->user()->can('delete',$tweet) )
        {
            return $this->successResponse('Authorization Error',401);
        }

        $tweet->delete();

        return $this->successResponse('Tweet Deleted!');
    }





    protected function uploadPhoto($request)
    {
        return $request->file('photo')->store('tweets','public');
    }

}
