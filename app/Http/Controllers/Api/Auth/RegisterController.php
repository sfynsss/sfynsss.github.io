<?php

namespace App\Http\Controllers\Api\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use App\User;

class RegisterController extends Controller
{
	public function register(Request $request)
	{
		$validate = Validator::make($request->all(), [
			'name' => ['required', 'string', 'max:255'],
			'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
			'password' => ['required', 'string', 'min:6', 'confirmed'],
		]);

		if ($validate->fails()) {
			$errors = $validate->errors()->all();
			return response(['statusCode' => 401, 'message' => $errors[0]], 401);
		} else {
			$user = User::create([
				'name' => $request->name,
				'email' => $request->email,
				'password' => bcrypt($request->password),
				'role' => '0',
			]);

			if ($user) {
				$accessToken = $user->createToken('authToken')->accessToken;

				return response(['user' => $user, 'access_token' => $accessToken]);
			} else {
				return response(['statusCode' => 401, 'message' => "Register Error !!!"], 401);
			}
		}
	}
}
