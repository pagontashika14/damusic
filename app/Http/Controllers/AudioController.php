<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use File;
use App\Helper\FillError;
use App\Audio;
use App\AudioLink;
use App\Singer;
use Validator;

class AudioController extends Controller
{
	public $audio_path;
    public function __construct()
    {
        $this->audio_path = storage_path().'/app/audio/';
    }
    public function index($code){
        $audio = Audio::where('code',$code)->with('singers','nation','links')->first();
        return $audio;
    }
    public function getAudio($code){
        $files = File::glob($this->audio_path.$code.'.*');
        if (count($files) > 0) {
            return response()->file($files[0]);
        }
        else {
            $errors = ['file_not_found' => ['Không tồn tại file']];
            return FillError::Validation($errors);
        }
	}
	public function createAudio($code,$name,$nation_id) {
		$audio = Audio::create([
            'code' => $code,
            'name' => $name,
            'nation_id' => $nation_id
        ]);
    	return $audio;
	}
	public function createLink($audio_id,$name) {
		$link = AudioLink::create([
            'audio_id' => $audio_id,
            'name' => $name
        ]);
    	return $link;
	}
    public function upload(Request $request) {
    	$file = $request->file('audio');
    	$ext = $file->getClientOriginalExtension();
    	if ( $ext == 'mp3') {
    		$name = md5(File::get($file->getRealPath()));
    		if (count(File::glob($this->audio_path.$name.'.mp3')) > 0) {
    			$errors = ['file_exists' => ['File đã tồn tại.']];
    			return FillError::Validation($errors);
    		}
    		$code = $request->code;
    		$link = '/audio/'.$name;
    		if ($code == null) {
    			$validator = Validator::make($request->all(), [
		            'name' => 'required',
		            'nation_id' => 'required|integer',
                    'singers' => 'required',
                    'types' => 'requiredq'
		        ]);
		    	if ($validator->fails()) {
		    		$errors = $validator->errors();
				    return FillError::Validation($errors);
				}
    			$code = $name;
    			$audio = $this->createAudio($code,$request->name,$request->nation_id);
    			$audio_link = $this->createLink($audio->id,$link);
                $singers = $request->singers;
                foreach($singers as $singer) {
                    $audio->singers()->attach($singer);
                }
                $types = $request->types;
                foreach($types as $type) {
                    $audio->types()->attach($type);
                }
    		}
    		else {
    			$audio = Audio::where('code',$code)->first();
    			$audio_link = $this->createLink($audio->id,$link);
    		}
    		$file->storeAs('audio',$name.'.'.$ext);
    		return $code;
    	}
    	else {
    		$errors = ['file_type' => ['Không phải định dạng mp3.']];
    		return FillError::Validation($errors);
    	}
    }
}
