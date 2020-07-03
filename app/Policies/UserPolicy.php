<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class UserPolicy
{
    use HandlesAuthorization;

   

   public function update($authUser,$user)
   {
     return $authUser->id === $user->profile->id,
   }
}
