<?php
use Illuminate\Http\Request;
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
Route::get('/tests', function () {
    return view('test');
})->middleware('AuthApiKey');

Route::get('/', function () {
    return view('home');
});

Route::get('/login', function (Request $request) {
    return view('login',['current_link' => $request->current_link]);
})->name('login')->middleware('rtc');

Route::get('/logout', function (Request $request) {
    $userController = new App\Http\Controllers\UserController;
    $userController->logout($request);
    return redirect('/');
})->middleware('AuthApi');

Route::get('/upload-audio', function () {
    return view('upload-audio');
})->middleware('AuthApi');

Route::get('/play-audio/{code}', function ($code) {
    return view('play-audio',['code' => $code]);
});

Route::get('/search', function (Request $request) {
    return view('search',['text' => $request->text]);
});

Route::get('/singer/{id}', function ($id) {
    return view('singer',['id' => $id]);
});

Route::get('audio/{code}', 'AudioController@getAudio')->middleware('AuthApiKey');