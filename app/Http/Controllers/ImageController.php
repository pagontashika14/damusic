<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Image;
use File;
use App\Helper\FillError;
use Validator;

class ImageController extends Controller
{
    public $image_path;
    public function __construct()
    {
        $this->image_path = storage_path().'/app/images/';
    }

	public function index($code){
        $files = File::glob($this->image_path.$code.'.*');
        if (count($files)) {
            //return '/images/'.$code;
            return response()->file($files[0]);
        }
        else {
            $errors = ['file_not_found' => ['Không tồn tại file']];
            return FillError::Validation($errors);
        }
	}
    public function create($name) {
        $tmp = Image::where('name',$name)->get();
        if (count($tmp)>0) {
            return $tmp[0];
        }
		$image = Image::create([
            'name' => $name,
        ]);
    	return $image;
	}
    public function upload(Request $request) {
    	$file = $request->file('image');
    	$ext = $file->getClientOriginalExtension();
    	if ( $ext == 'jpg' || $ext == 'png') {
    		$name = md5(File::get($file->getRealPath()));
            $link = '/api/image/index/'.$name;
            $this->create($link);
            $file->storeAs('images', $name.'.'.$ext);
    		return $link;
    	}
    	else {
    		$errors = ['file_type' => ['Không phải định dạng jpg hoặc png.']];
    		return FillError::Validation($errors);
    	}
    }
}
