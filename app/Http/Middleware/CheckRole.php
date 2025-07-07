<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class CheckRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, $role)
    {
        if (!Auth::check()) {
           
            // User is not logged in
            return redirect()->route('login');
        }

        if (Auth::user()->role != $role) {
            // User does not have the required role
            Auth::logout(); // Optionally log the user out
            return redirect()->route('login')->withErrors([
                'message' => 'You are not authorized to access this page.'
            ]);
        }

        return $next($request);
    }
}
