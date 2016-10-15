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

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:api');

Route::group(['middleware' => 'auth:api'], function () {
    Route::get('/users/{user}', function (App\User $user) {

	    return $user;
	});
});
Route::get('test',function (){
	$user = App\User::where('email','pagontashika14@gmail.com')
					->with('roles')
					->first();
    return $user;
});
Route::post('login','UserController@login');
Route::post('register','UserController@register');