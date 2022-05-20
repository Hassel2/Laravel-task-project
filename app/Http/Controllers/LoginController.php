<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
	public function login(Request $request) {
		$credentials = $request->only('email', 'password');

		if (!Auth::attempt($credentials)) {
			return response()->json([
				'message' => 'You cannot sign with those credentials',
				'errors' => 'Unauthorised'
			], 401);
		}

		$user = Auth::user();
		$response['token_type'] = "Bearer";
		$response['token'] = $user->createToken('Tasker')->accessToken;

		return $this->sendResponse($response,"User login succesfully.");
	}
}
