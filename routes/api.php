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
    $result = App\Singer::where('id','=',9)->with('image')->first();
	return $result;
});
Route::post('login','UserController@login');
Route::post('register','UserController@register');
Route::group(['prefix' => 'audio'], function () {
    Route::post('upload','AudioController@upload');
    Route::get('index/{code}','AudioController@index');
    Route::get('random','AudioController@getRandomAudio');
});
Route::group(['prefix' => 'nation'], function () {
    Route::get('search','NationController@search');
});
Route::group(['prefix' => 'singer'], function () {
    Route::get('/{id}', 'SingerController@index');
    Route::get('search','SingerController@searchSimilar');
    Route::post('insert','SingerController@insert');
});
Route::group(['prefix' => 'image'], function () {
    Route::get('/{code}','ImageController@index');
   Route::post('upload','ImageController@upload');
});
Route::group(['prefix' => 'type'], function () {
   Route::get('search','TypeController@search');
   Route::post('insert','TypeController@insert');
});