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

Route::group(['middleware' => 'AuthApi'], function () {
    Route::get('/user', function (Request $request) {
    	$id = Auth::user()->id;
    	$user = App\User::where('id',$id)
					->with('roles')
					->first();
	    return $user;
	});
});
// Route::get('test',function (Request $request){
//     dd($request->cookie('laravel_session'));
//     $result = App\Audio::where('code','=','c5fcf94651a430d62ef00b8ef24a186d')->with('singers.image')->first();
//     //$result = App\Singer::where('id','=',9)->with('image')->first();
// 	return $result;
// });
Route::post('test',function (Request $request){
    return $request->all();
});

Route::post('login','UserController@login');
Route::post('logout','UserController@logout')->middleware('AuthApi');
Route::post('register','UserController@register');

Route::group(['prefix' => 'audio'], function () {
    Route::post('upload','AudioController@upload');
    Route::get('index/{code}','AudioController@index');
    Route::get('random','AudioController@getRandomAudio');
    Route::get('add_view/{code}','AudioController@addView');
    Route::get('month_top','AudioController@getTopAudioOfMonth');
    Route::get('month_top/nation/{id}','AudioController@getTopAudioOfMonthByNation');
    Route::get('search','AudioController@searchSimilar');
});
Route::group(['prefix' => 'nation'], function () {
    Route::get('search','NationController@search');
});
Route::group(['prefix' => 'singer'], function () {
    Route::get('index/{id}', 'SingerController@index');
    Route::get('search','SingerController@searchSimilar');
    Route::post('insert','SingerController@insert')->middleware('AuthApi');
    Route::get('searchfull','SingerController@searchFull');
});
Route::group(['prefix' => 'image'], function () {
    Route::get('search','ImageController@search');
    Route::get('index/{code}','ImageController@index');
   Route::post('upload','ImageController@upload');
});
Route::group(['prefix' => 'type'], function () {
   Route::get('search','TypeController@search');
   Route::get('searchFull','TypeController@searchSimilar');
   Route::post('insert','TypeController@insert');
});

Route::group(['prefix' => 'banner'], function () {
   Route::get('get','BannerController@index');
   Route::post('insert','BannerController@index')->middleware('AuthApi');
});

Route::group(['prefix' => 'playlist'], function () {
    Route::get('get','PlaylistController@index');
    Route::post('insert','PlaylistController@create')->middleware('AuthApi');
    Route::post('add_audio','PlaylistController@addAudio')->middleware('AuthApi');
    Route::get('getPlaylistByUser','PlaylistController@getPlaylistByUser')->middleware('AuthApi');
});