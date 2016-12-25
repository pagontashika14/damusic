<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Singer;
use App\Http\Requests;
use Validator;
use App\Helper\StringHelper;
use DB;
use App\Helper\FillError;
use Auth;

class SingerController extends Controller
{
	public function index($id) {
		return Singer::where('id',$id)->with('image','nation')->first();
	}

	public function searchExactly(Request $request){
		$text = $request->text;
		$result = Singer::select('id','stage_name')
		->where(DB::raw('lower(stage_name)'),'like',DB::raw('lower(\'%'.$text.'%\')'))
		->take(5)
		->get();
		return $result;
	}

	public function searchSimilar(Request $request){
		$text = $request->search;
		$length = $request->length ? $request->length : 5;
		$singers = Singer::select(DB::raw('id,stage_name as text,similarity(stage_name, \''.$text.'\') as percent'))
                        ->orderBy('percent','desc')
						->take($length)
                        ->get();
        return $singers;
	}

	public function searchFull(Request $request){
		$text = $request->text;
		$singers = Singer::select(DB::raw('*,similarity(stage_name, \''.$text.'\') as sml'))
						->with('image','nation')
                        ->orderBy('sml','desc')
						->paginate(8);
        return $singers;
	}

	public function insert(Request $request){
		$role = $request->auth_user_role;
		if($role > 2) {
			$errors = ['authorization' => ['Bạn không đủ quyền']];
            return FillError::Authorization($errors);
		}
		$validator = Validator::make($request->all(), [
			'stage_name' => 'required',
			'nation_id' => 'required|integer'
			]);
		if ($validator->fails()) {
			$errors = $validator->errors();
			return FillError::Validation($errors);
		}
		$singer = $this->create($request);
		return $singer;
	}

	public function create(Request $request) {
		
		$singer = Singer::create([
			'stage_name' => $request->stage_name,
			'name' => $request->name,
			'birthday' => $request->birthday,
			'nation_id' => $request->nation_id,
			'description' => $request->description,
			'image_id' => $request->image_id
			]);
		return $singer;
	}

	public function update(Request $request) {

	}

	public function delete(Request $request) {
		
	}
}
