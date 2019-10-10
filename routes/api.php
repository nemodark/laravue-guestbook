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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});


Route::get('/guests', 'GuestController@index');
Route::get('/guests/edit/{id}', 'GuestController@show');

Route::post('/guests/add', 'GuestController@store');
Route::put('/guests/update/{id}', 'GuestController@update');
Route::delete('/guests/delete/{id}', 'GuestController@delete');