<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/

Route::get('/', function () {
    return view('home');
});

Route::get('/login', function () {
    return view('login');
});

Route::get('/upload-audio', function () {
    return view('upload-audio');
});

Route::get('/play-audio/{code}', function ($code) {
    return view('play-audio',['code' => $code]);
});

Route::get('/audio/{code}', 'AudioController@getAudio');

Route::get('/images/{code}','ImageController@index');