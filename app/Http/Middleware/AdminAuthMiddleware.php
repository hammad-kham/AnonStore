<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class AdminAuthMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        //check if Admin exist in admin guard
        if (Auth::guard('admin')->check()) {
            //return next mean do next action
            return $next($request);
        }else
    {
        // Redirect to login page if the admin is not authenticated
        return redirect()->route('admin.login');
        
    }
       
    }
}
