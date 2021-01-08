<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

/* admin routes */


Route::group(['middleware' => 'auth'],function(){


    Route::get('/admin', 'HomeController@admin')->middleware('can:admin');
    
    Route::get('/admin/categories', 'CategoryController@index')->middleware('can:admin');

    Route::get('/admin/categories/create', 'CategoryController@create')->middleware('can:admin');

    Route::post('/admin/categories', 'CategoryController@store')->middleware('can:admin');

    Route::get('/admin/categories/{id}/edit', 'CategoryController@edit')->middleware('can:admin');

    Route::put('/admin/categories/{id}', 'CategoryController@update')->middleware('can:admin');

    Route::delete('/admin/categories/{id}', 'CategoryController@destroy')->middleware('can:admin');

    
    


});


/**/ 



Route::get('/', 'HomeController@show');
Route::get('/profile/edit', 'HomeController@edit');
Route::post('/job/apply', 'jobController@apply')->middleware('can:employee');
Route::post('/job/like', 'jobController@like')->middleware('can:employee');
Route::put('/profile/edit/{id}', 'HomeController@update');

Route::get('/contact', 'HomeController@contact')->middleware('can:notadmin');
Route::post('/contact', 'HomeController@send')->middleware('can:notadmin');;
Route::get('/jobs', 'JobController@index');
Route::get('/jobs/apply/list', 'JobController@applylist')->middleware('can:employee');
Route::get('/jobs/posted/list', 'JobController@postedlist')->middleware('can:employer');
Route::get('/job/{id}/appliers', 'JobController@appliers')->middleware('can:employer');
Route::get('/jobs/liked/list', 'JobController@likedlist')->middleware('can:employee');
Route::get('/job/create', 'JobController@create')->middleware('can:employer');
Route::post('/job', 'JobController@store')->middleware('can:employer');
Route::get('/job/{id}', 'JobController@show');
Route::get('/jobs/{id}', 'JobController@catfilter');
Route::get('/download/{file}', 'Homecontroller@downloadcv');
Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
