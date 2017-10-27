<?php

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

Route::resource('/participants', 'Api\ParticipantController')->middleware('cors');
Route::resource('/challenges', 'Api\ChallengeController')->middleware('cors');
