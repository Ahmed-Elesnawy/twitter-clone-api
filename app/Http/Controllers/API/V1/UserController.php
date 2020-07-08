<?php

namespace App\Http\Controllers\API\V1;

use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;
use App\Models\User;




class UserController extends Controller
{
    public function show(User $user,$name)
    {
    	return new UserResource($user);
    }
}
