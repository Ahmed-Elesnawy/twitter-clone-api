<?php

namespace App\Http\Resources;

use App\Http\Resources\UserResource;
use Illuminate\Http\Resources\Json\JsonResource;

class TweetResource extends JsonResource
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

            'title'        => $this->title,
            'slug'         => $this->slug,
            'content'      => $this->content,
            'photo_path'   => $this->hasPhoto() ? $this->photoPath() : null,
            'created'      => $this->createdFormat(),
            'timesince'    => $this->timesince(),
            'retweeted'    => $this->isRetweeted(),
            
            'likes_count'  => $this->usersLiked->count(),

            'show_url'     => route('tweets.show',$this->slug),

            'user'         => new UserResource($this->user),

        ];
    }
}
