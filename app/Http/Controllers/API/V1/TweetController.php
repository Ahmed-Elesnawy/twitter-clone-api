<?php

namespace App\Http\Controllers\API\V1;

use App\Models\Tweet;
use App\Models\Hashtag;
use App\Http\Requests\TweetRequest;
use App\Http\Controllers\Controller;
use App\Http\Resources\TweetResource;
use App\Services\TweetService;
use App\Traits\ApiResponseTrait;
use Symfony\Component\HttpFoundation\Response;


class TweetController extends Controller
{


    use ApiResponseTrait;

    private $tweetService;

    public function __construct(TweetService $service)
    {
        $this->middleware('jwt')->except(['index','show']);


        $this->tweetService = $service;
    }
    



    public function index()
    {
        $tweets = Tweet::with('user')
                 ->latest();

        if ( request()->has('search') and !empty(request()->search) )

        {
            $tweets = $tweets->where('title','like','%'. request()->search .'%')
                             ->orWhere('content','like','%'. request()->search .'%');
        }

        $tweets = $tweets->paginate(10);

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
            $attributes['photo'] = $this->tweetService->uploadPhoto($request);
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

        $data = $request->except(['photo']);
        

        if ( $request->hasFile('photo') )
        {
            $data['photo'] = $this->tweetService->updatePhoto($request,$tweet->photo);
        }

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





    

}
