<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\User;

class AuthController extends Controller
{
    public function authMe($remember_token) {
        $user = User::where('remember_token', $remember_token)->first();

        if($user) {
            // $token = $user->auth()->retrieveByToken($user['id'], $remember_token);

            // return response()->json($user, 200);
            return response()->json([
                // 'token'=>$token, 
                // 'rememberMe'=> $token,
                'remember_token'=> $remember_token,
                'user'=>$user
                ], 200);
        } else {
            return response()->json(['error'=>true, 'message'=>'Нет токена'], 200);
        }
    }
}
