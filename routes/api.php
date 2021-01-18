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
Route::post('logout', 'AuthController@logout')->middleware('api.JwtAuthenticate');


Route::prefix('polls')->group(function () {
    Route::post('create', 'PollsController@createPoll')->middleware(['api.JwtAuthenticate','api.AdminMiddleware']);
    Route::get('get/{id}', 'PollsController@getPoll')->middleware(['api.JwtAuthenticate','api.AdminMiddleware']);

});

Route::group(['middleware' => ['api.JwtAuthenticate' ], 'prefix' => 'answer'],function(){
    Route::post('create/{poll_id}', 'AnswerController@createAnswer');
    Route::get('get/{poll_id}', 'AnswerController@getUserAnswer');
    Route::post('update','AnswerController@updateUserAnswer');

});
