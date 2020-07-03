<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
    * @return array
     */
    public function toArray($request)
    {
        return [

            'name'    => $this->name,
            'email'   => $this->email,

            'profile' => new ProfileResource($this->profile),

            'follows_count'   => $this->follows->count(),
            'followers_count' => $this->followers->count(),

            'show_url' => route('users.show',['user' => $this->id,'name' => $this->slugyName()]), 
            
        ];
    }
}
