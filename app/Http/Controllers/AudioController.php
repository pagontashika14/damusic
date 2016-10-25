<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use File;
use App\Helper\FillError;
use App\Audio;
use App\AudioLink;

class AudioController extends Controller
{
	public function create($code,$name,$nation_id) {
		$audio = Image::create([
            'code' => $code,
            'name' => $name,
            'nation_id' => $nation_id
        ]);
    	return $audio;
	}
    public function upload(Request $request) {
    	$file = $request->file('audio');
    	$audio_path = storage_path().'/app/audios/';
    	echo $audio_path;
    	$ext = $file->getClientOriginalExtension();
    	if ( $ext == 'mp3') {
    		$code = md5(File::get($file->getRealPath()));
    		if (count(File::glob($audio_path.$code.'.mp3')) > 0) {
    			$errors = ['file_exists' => ['File đã tồn tại.']];
    			return FillError::Validation($errors);
    		}
    	}
    	else {
    		$errors = ['file_type' => ['Không phải định dạng mp3.']];
    		return FillError::Validation($errors);
    	}
   		// $path = $file->store('audio');
   		// echo base64_encode($file);
   		// echo '<br>';
   		// echo $path;
   		// echo md5(File::get($file->getRealPath()));
    }
}
