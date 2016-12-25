<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;
use App\Http\Requests;
use App\User;
use App\Playlist;
use App\Helper\FillError;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;
use DB;

class PlaylistController extends Controller
{
    public function index(Request $request) {
        return Playlist::where('code',$request->code)->with('audio.singers','audio.links','user')->first();
    }

    public function getPlaylistByUser(Request $request) {
        return Playlist::where('user_id',$request->auth_user_id)->with('image')->get();
    }

    public function create(Request $request) {
        $code = bcrypt($request->name.$request->user_id);
        $playlist = Playlist::create([
			'code' => $code,
			'name' => $request->name,
			'user_id' => $request->auth_user_id,
			'image_id' => $request->image_id,
			'description' => $request->description,
			]);
		return $playlist;
    }

    public function addAudio(Request $request) {
        $check = Playlist::where('id',$request->playlist_id)
                            ->where('user_id',$request->auth_user_id)
                            ->first();
        if(!$check) {
            $errors = ['authorization' => ['Bạn không đủ quyền']];
            return FillError::Authorization($errors);
        }
        DB::table('audio_playlist')->insert([
            'audio_id' => $request->audio_id,
            'playlist_id' => $request->playlist_id,
            'create_time' => Carbon::now()->toDateTimeString(),
        ]);
        return response(['success' => true]);
    }
}
