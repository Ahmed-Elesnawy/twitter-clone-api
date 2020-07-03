<?php

namespace App\Http\Controllers\API\V1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;


use App\Http\Resources\UserResource;

class UserController extends Controller
{
    public function show(User $user,$name)
    {
    	return new UserResource($user);
    }
}
