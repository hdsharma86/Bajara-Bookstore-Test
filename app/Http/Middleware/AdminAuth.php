<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class AdminAuth
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (Auth::guard('admin')->check()) {
            if($request->route()->uri == 'livewire-admin/login' || $request->route()->uri == 'livewire-admin'){
                return redirect()->route('livewire-admin.dashboard');
            }
            return $next($request);
        }
        return redirect()->route('livewire-admin.login');
        //return $next($request);
    }
}
