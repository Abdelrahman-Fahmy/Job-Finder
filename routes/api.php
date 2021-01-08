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
Route::get('/job/{id}', 'ApiController@job');

Route::post('/job', 'ApiController@jobstore');
Route::post('/token', 'TokenController@get_token');

Route::group(['middleware'=>'auth:api'],function(){
    Route::get('/jobs', 'ApiController@jobs');
});

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
