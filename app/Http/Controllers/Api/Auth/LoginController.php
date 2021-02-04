<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

use App\Models\UserModel;
use App\User;

class LoginController extends Controller
{
    use AuthenticatesUsers;

    public function login(Request $request) {
        $creds = $request->only(['email', 'password']);
        $remember = $request->only(['remember'])['remember'];

        if (!$token = auth()->attempt($creds, $remember)) {
           return response()->json(['error'=>true, 'message'=>'Incorect creds!', '$remember' => $remember], 401);
        }

        $user = User::where('email', $creds['email'])->first();

        if ($remember) {
            $user->setRememberToken($token = Str::random(60));
        } else {
            $user->setRememberToken(null);
        }

        return response()->json([
            'user'=>$user, 
            'remember_token'=>$user->getRememberToken()
        ], 200);
    }

    public function refresh() {
        try{
            $token = auth()->refresh();
        } catch (\Tymon\JWTAuth\Exceptions\TokenInvalidException  $e) {
            return response()->json(['error'=>true, 'message'=>$e->getMessage()], 401);
        }
        return response()->json(['token'=>$token], 200);
    }

    public function getData() {
        try{
            $token = auth()->refresh();
        } catch (\Tymon\JWTAuth\Exceptions\TokenInvalidException  $e) {
            return response()->json(['error'=>true, 'message'=>$e->getMessage()], 401);
        }
        return response()->json(['token'=>$token], 200);
    }

    public function register(Request $request) {
        // $password = bcrypt($request->userPassword);
        // $request->merge([
        //     'password' => $password,
        // ]);
        // $newUser = UserModel::create($request->all());

        $data = $request->all();
        

        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);

        // return response()->json([$request, $data], 200);
    }

}