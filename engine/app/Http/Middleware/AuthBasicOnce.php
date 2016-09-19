<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class AuthBasicOnce
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
        $credential = [
                'email' => $request->getUser(),
                'password' => $request->getPassword(),
            ];
        if(Auth::once($credential)){
            return $next($request);
        }
        $headers = ['WWW-Authenticate' => 'Basic'];
        return response()->make('Invalid credentials.', 401, $headers);

    }
}
