<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class checkLogin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next) // : Response
    {
        // dd(auth()->user()->status);
        
        $user_status = ['admin', 'writer'];
        
        if( !in_array(auth()->user()->status, $user_status) ) {
           
            Auth::logout();
            return redirect()->route('login');
        }
        return $next($request);
    }
}
