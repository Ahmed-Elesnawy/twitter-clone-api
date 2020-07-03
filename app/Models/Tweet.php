<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tweet extends Model
{
    protected $fillable = [

      'title',
      'slug',
      'content',
      'photo',
      'user_id',
      'parent_id',
      'retweet_at',
      'is_published'
      
    ];
    

    /**
     * Models Relations 
     */

    public function user()
    {
      return $this->belongsTo(User::class);
    }


    public function usersLiked()
    {
        return $this->belongsToMany(User::class,'user_tweet','tweet_id','user_id');
    }

    


    /**
     * Models Methods
     * 
     */

    public function timesince()
    {
      return $this->created_at->diffForHumans();
    }

    public function createdFormat()
    {
      return $this->created_at->toDatetimeString();
    }

    public function photoPath()
    {
      return url('storage/'.$this->photo);
    }

    public function isRetweeted()
    {
      return !is_null($this->parent_id);
    }

    public function hasPhoto()
    {
      return !is_null($this->photo);
    }

    public function likedBy($user)
    {
      return $this->usersLiked->contains($user);
    }

    /**
     * Model Getters
     * 
     */
    
    public function getRouteKeyName()
    {
        return 'slug';
    }
}
