<?php

use Illuminate\Http\Request;

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

Route::middleware('auth:api')->post('/vote', 'VoteController@send');
Route::middleware('auth:api')->get('/options', 'VoteController@options');
Route::middleware('auth:api')->get('/votes', 'VoteController@user_votes');
Route::middleware('auth:api')->get('/voted', 'VoteController@voted');



