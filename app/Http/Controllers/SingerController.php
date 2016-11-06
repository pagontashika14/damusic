<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Singer;
use App\Http\Requests;
use Validator;
use App\Helper\StringHelper;
use DB;
use App\Helper\FillError;

class SingerController extends Controller
{
	public function index($code) {
		
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
		$lower_text = strtolower(StringHelper::VnStringFilter($text));
		$r = array();
		foreach (Singer::cursor() as $singer) {
			$stage_name = $singer->stage_name;
			$query = strtolower(StringHelper::VnStringFilter($stage_name));
			similar_text($query,$lower_text,$percent);
			$sin = ['id' => $singer->id, 'text' => $stage_name, 'percent' => $percent];
			$count = count($r);
			if ($count < 5) {
				$i = 0;
				for (; $i < $count; $i++) { 
					if ($sin['percent'] >= $r[$i]['percent']) {
						break;
					}
				}
				$temp = array();
				for ($j=$count-1; $j >= $i; $j--) { 
					array_push($temp,array_pop($r));
				}
				array_push($r, $sin);
				$countT = count($temp);
				for ($j=0; $j < $countT; $j++) { 
					array_push($r, array_pop($temp));
				}
			} else {
				$i = 0;
				for (; $i < 5; $i++) { 
					if ($sin['percent'] >= $r[$i]['percent']) {
						break;
					}
				}
				if ($i == 5) {
					continue;
				}
				$temp = array();
				for ($j=$count-1; $j >= $i; $j--) { 
					array_push($temp,array_pop($r));
				}
				array_push($r, $sin);
				$countT = count($temp);
				for ($j=0; $j < $countT - 1; $j++) { 
					array_push($r, array_pop($temp));
				}
			}
		}
		return $r;
	}

	public function insert(Request $request){
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
			]);
		return $singer;
	}

	public function update(Request $request) {

	}

	public function delete(Request $request) {
		
	}
}
