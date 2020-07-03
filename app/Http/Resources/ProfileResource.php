<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ProfileResource extends JsonResource
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

            'phone'      => $this->phone,
            'photo'      => $this->photo,
            'photo_path' => is_null($this->photo) ? null : $this->photoPath(), 

        ];
    }
}
