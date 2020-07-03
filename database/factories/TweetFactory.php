<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\User;
use App\Models\Tweet;
use Illuminate\Support\Str;
use Faker\Generator as Faker;

$factory->define(Tweet::class, function (Faker $faker) {
    return [
        'title'   => $faker->sentence,
        'slug'    => Str::slug($faker->sentence), 
        'content' => $faker->paragraph,
        'user_id' => function(){
            return User::all()->random();
        },
    ];
});
