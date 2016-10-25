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

Route::group(['middleware' => 'auth:api'], function () {
    Route::get('/user', function (Request $request) {
    	$id = Auth::user()->id;
    	$user = App\User::where('id',$id)
					->with('roles')
					->first();
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
Route::group(['prefix' => 'upload'], function () {
    Route::post('audio','AudioController@upload');
    Route::post('image','ImageController@upload');
});