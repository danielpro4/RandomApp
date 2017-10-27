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

use App\User;

Route::get('/', function () {
    return view('index');
});

Route::group(['prefix' => 'admin'], function() {
    Route::get('/', 'UsersController@index')->name('users.all');
});

Route::group(['prefix' => 'admin/users'], function () {

    Route::get('/', 'UsersController@index')->name('users.all');
    Route::get('create', 'UsersController@create')->name('user.create');
    Route::post('create', 'UsersController@store');
    Route::get('{user}', 'UsersController@view')->name('user.view');
    Route::get('{user}/edit', 'UsersController@edit')->name('user.edit');
    Route::post('{user}/edit', 'UsersController@update');
    Route::delete('{user}', 'UsersController@destroy')->name('user.delete');
});

Route::group(['prefix' => 'admin/participants'], function () {

    Route::get('/', 'ParticipantController@index')->name('participants.all');
    Route::get('create', 'ParticipantController@create')->name('participant.create');
    Route::post('create', 'ParticipantController@store');
    Route::get('{participant}', 'ParticipantController@view')->name('participant.view');
    Route::get('{participant}/edit', 'ParticipantController@edit')->name('participant.edit');
    Route::post('{participant}/edit', 'ParticipantController@update');
    Route::delete('{participant}', 'ParticipantController@destroy')->name('participant.delete');

    //Route::post('status', 'ActiveUsersController@store')->name('user.activate');
    //Route::delete('status/{id}', 'ActiveUsersController@destroy')->name('user.deactivate');
    //Route::get('{user}/run', 'ExecuteUsersController@index')->name('user.run');
});


Route::get('/email', function () {
    $participant = User::findOrFail(1);
    return view('emails.challenge')->with(['participant' => $participant, 'challenge' => $participant->challenges->first()]);
});
