<?php

namespace App\Http\Middleware;

// use App\AuthToken;
use App\User;
use Closure;

class TokenAuth
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $_auth_token = $request->header('X-Auth-Token', null);;

        if ($_auth_token)
        {
            // $_token = AuthToken::find($_auth_token);
            $_token = User::where('remember_token', $_auth_token)->first();
            if (!$_token) 
                // abort('401', 'No such token. Request a new one.');
                return response()->json(['token'=>$_auth_token, 'user'=>$_token], 200);
        }
        else
            abort('401', 'No auth token provided');

        // return $_token;
        $request['user'] = $_token;
        return $next($request);
    }
}