<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;
use App\Http\Requests;
use App\Type;
use App\Helper\FillError;
use DB;

class TypeController extends Controller
{
    public function index($code) {
		
	}

	public function search(){
		return Type::orderBy('name')->get();
	}

	public function searchSimilar(Request $request){
		$text = $request->search;
		$length = $request->length ? $request->length : 5;
		$singers = Type::select(DB::raw('id,name as text,similarity(name, \''.$text.'\') as percent'))
                        ->orderBy('percent','desc')
						->take($length)
                        ->get();
        return $singers;
	}

	public function insert(Request $request){
		$validator = Validator::make($request->all(), [
			'name' => 'required|unique:types'
			]);
		if ($validator->fails()) {
			$errors = $validator->errors();
			return FillError::Validation($errors);
		}
		$type = $this->create($request);
		return $type;
	}

	public function create(Request $request) {	
		$type = Type::create([
			'name' => $request->name,
			]);
		return $type;
	}

	public function update(Request $request) {

	}

	public function delete(Request $request) {
		
	}
}
