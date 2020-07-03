<?php

namespace App\Observers;


use Illuminate\Support\Str;
use App\Services\TweetService;
class TweetObserver
{

	private $tweetService;

	public function __construct(TweetService $tweetService)
	{
		$this->tweetService = $tweetService;
	}

    public function creating($tweet)
    {
    	$tweet->slug = Str::slug($tweet->title);
    }


    public function updating($tweet)
    {
    	$tweet->slug = Str::slug($tweet->title);
    }


    public function deleted($tweet)
    {
    	$this->tweetService->deleteFile($tweet->photo);
    }
}
