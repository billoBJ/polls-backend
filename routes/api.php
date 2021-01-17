<?php

use Illuminate\Http\Request;
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
Route::post('login', 'AuthController@login');
Route::post('logout', 'AuthController@logout');
Route::get('user', 'AuthController@getUser');


Route::prefix('polls')->group(function () {
    Route::post('create', 'PollsController@createPoll');
    Route::get('get/{id}', 'PollsController@getPoll');

});

