<?php

namespace App\Observers;

class UserObserver
{
    public function created($user)
    {
    	$user->profile()->create();
    }
}
