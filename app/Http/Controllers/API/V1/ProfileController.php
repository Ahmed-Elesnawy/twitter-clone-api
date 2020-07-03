<?php

namespace App\Http\Controllers\API\V1;

use App\Http\Controllers\Controller;

use App\Http\Requests\ProfileRequest;

use App\Http\Resources\ProfileResource;

use App\Models\User;

use Storage;



class ProfileController extends Controller
{
    public function updateProfile(User $user,ProfileRequest $request)
    {
    	$data = $request->only('phone');

    	if ( $request->hasFile('photo') )
    	{
    		$path = $request->file('photo')->store('users','public');

    		$data['photo'] = $path;
    	}

    	$user->profile()->update($data);

    	return new ProfileResource($user);
    }
}
