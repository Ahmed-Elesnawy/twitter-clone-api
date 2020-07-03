\<?php

namespace App\Policies;

use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class TweetPolicy
{
    use HandlesAuthorization;


    public function update($user,$tweet)
    {
        return $user->id === $tweet->user_id;
    }


    public function delete($user,$tweet)
    {
    	return $user->id === $tweet->user_id;
    }
}
