<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class CheckRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next,$role): Response
    {
        $user = Auth::user();

        if (Auth::check() && Auth::user()->role->role == $role) {
            return $next($request);
        }

        // Optionally, redirect or abort with a 403 Forbidden status
        return redirect('/')->with('error', 'Unauthorized Access');
    }
}
