<?php

namespace App\Helper;

use Illuminate\Support\Facades\Response;

class FillError {
	public static function Validation($error){
		return Response::json([
			'message' => 'Lỗi xác nhận',
		    'data' => $error
		], 422);
	}

	public static function Authorization($error){
		return Response::json([
			'message' => 'Cấm',
		    'data' => $error
		], 423);
	}
}