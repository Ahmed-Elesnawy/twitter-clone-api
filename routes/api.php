<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/




Route::prefix('v1')->group(function(){



	// Tweets Routes 

    Route::apiResource('users','UserController')->except(['store','index','show']);

    Route::get('users/{user}/{name}','UserController@show')->name('users.show');

    Route::post('users/{user}/follow','FollowController@follow')->name('users.follow');

    Route::put('users/{user}/update','ProfileController@updateProfile')->name('users.update')->middleware('jwt');

    // Tweets Routes 

    Route::apiResource('tweets','TweetController');

    Route::post('tweets/{tweet}/like','LikeController@like')->name('tweets.like')->middleware('jwt');

    Route::post('tweets/{tweet}/retweet','RetweetController@retweet')->name('tweets.retweet')->middleware('jwt');


    // Auth Routes 

    Route::post('register','AuthController@register');
    Route::post('login', 'AuthController@login');
    Route::post('logout', 'AuthController@logout');
    Route::post('refresh', 'AuthController@refresh');
    Route::post('me', 'AuthController@me');


});



