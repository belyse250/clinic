<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class EnsureSessionValid
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Check if this is a request to a protected route and user is not authenticated
        if ($request->route() && Auth::guard()->check() === false) {
            // Check if route requires authentication
            $middlewares = $request->route()->middleware();
            
            if (in_array('auth', $middlewares)) {
                // Ensure session data for unauthenticated users is cleared
                if (session()->has('logout_success')) {
                    session()->forget('logout_success');
                }
            }
        }

        return $next($request);
    }
}
