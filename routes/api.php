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
Route::post('test',function (Request $request){

	return $request->all();
});
Route::post('login','UserController@login');
Route::post('register','UserController@register');
Route::group(['prefix' => 'upload'], function () {
    Route::post('upload','AudioController@upload');
});
Route::group(['prefix' => 'nation'], function () {
    Route::get('search','NationController@search');
});
Route::group(['prefix' => 'singer'], function () {
    Route::get('search','SingerController@searchSimilar');
    Route::post('insert','SingerController@insert');
});
Route::group(['prefix' => 'image'], function () {
   Route::post('upload','ImageController@upload');
});
Route::group(['prefix' => 'type'], function () {
   Route::get('search','TypeController@search');
   Route::post('insert','TypeController@insert');
});