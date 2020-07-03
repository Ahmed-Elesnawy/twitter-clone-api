<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    protected $fillable = [
    	'phone',
    	'user_id',
    	'photo'
    ];



    /**
    * Model Relations
    *
    */

    public function user()
    {
    	return $this->belongsTo(User::class);
    }


    /**
    * Model Methods 
    *
    */


    public function photoPath()
    {
        return url('storage/'.$this->photo);
    }
}
