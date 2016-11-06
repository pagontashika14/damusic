<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Nation;
use App\Http\Requests;
use Validator;

class NationController extends Controller
{
	public function index($code) {
		
	}

	public function search(){
		return Nation::orderBy('name')->get();
	}

	public function insert(Request $request){
		// $validator = Validator::make($request->all(), [
		// 	'stage_name' => 'required',
		// 	'nation_id' => 'required|integer'
		// 	]);
		// if ($validator->fails()) {
		// 	$errors = $validator->errors();
		// 	return FillError::Validation($errors);
		// }
		// $singer = $this->create($request);
		// return $singer;
	}

	public function create(Request $request) {
		
		// $singer = Singer::create([
		// 	'stage_name' => $request->stage_name,
		// 	'name' => $request->name,
		// 	'birthday' => $request->birthday,
		// 	'nation_id' => $request->nation_id,
		// 	]);
		// return $singer;
	}

	public function update(Request $request) {

	}

	public function delete(Request $request) {
		
	}
}
