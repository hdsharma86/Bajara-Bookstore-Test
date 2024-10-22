<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class CustomerAuth
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {   
        if (Auth::guard('customer')->check()) {
            if($request->route()->uri == 'login' || $request->route()->uri == 'register'){
                return redirect()->route('user-dashboard');
            }
            return $next($request);
        }
        return redirect()->route('login');
    }
}
