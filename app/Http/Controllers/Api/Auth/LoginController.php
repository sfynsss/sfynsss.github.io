<?php

namespace App\Http\Controllers\Api\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class LoginController extends Controller
{
    public function login(Request $request)
    {
    	$validate = $request->validate([
    		'email'		=> 'email|required',
    		'password'	=> 'required'
    	]);

    	if (!auth()->attempt($validate)) {
    		return response(['message' => 'invalid credentials']);
    	}

    	$accessToken = auth()->user()->createToken('authToken')->accessToken;

    	return response(['user' => auth()->user(), 'access_token' => $accessToken]);
    }
}
