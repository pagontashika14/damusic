<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;
use App\Http\Requests;
use App\User;
use App\Role;
use App\Helper\FillError;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;
use Auth;

class UserController extends Controller
{
    public function login(Request $request) {
    	$email = $request->email;
    	$password = $request->password;
    	$validator = Validator::make($request->all(), [
            'email' => 'required|email|max:255',
            'password' => 'required|min:6',
        ]);
    	if ($validator->fails()) {
    		$errors = $validator->errors();
		    return FillError::Validation($errors);
		}
		$user = User::where('email','=',$email)
				->with('roles')
				->first();
		if ($user == null) {
			return FillError::Validation([
				'email'=>['Không tồn tại email.']
			]);
		}
		if (!Hash::check($password,$user->password)) {
			return FillError::Validation([
				'password'=>['Password không đúng.']
			]);
		}
		$user->remember_token = Carbon::now()->addHours(2)->toDateTimeString();
		$user->api_token = bcrypt($user->email.$user->remember_token);
		$user->save();
		return response($user)->cookie(
			'api_token', $user->api_token, 120
		);
    }

	public function logout(Request $request) {
		$user = Auth::user();
		$user->remember_token = Carbon::now()->subSeconds(1)->toDateTimeString();
		$user->save();
	}

    public function register(Request $request) {
    	$data = $request->all();
    	$validator = Validator::make($data, [
            'name' => 'required|max:255',
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|min:6',
        ]);
    	if ($validator->fails()) {
    		$errors = $validator->errors();
		    return FillError::Validation($errors);
		}
		$user = $this->create($data);
		$role = Role::where('name','member')->first();
		$user->roles()->attach($role->id);
    	return $user;
    }

    public function create($data){
    	$user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
            'api_token' => bcrypt($data['email'])
        ]);
    	return $user;
    }

	
}
