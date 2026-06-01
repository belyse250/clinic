<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class VerifyAuthentication
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
        // Allow login, register, and home pages for unauthenticated users
        $publicPaths = ['/', '/login', '/register'];
        if (in_array($request->path(), $publicPaths)) {
            return $next($request);
        }

        // If user is not authenticated, redirect to login
        if (!Auth::check()) {
            return redirect()->route('login')->with('message', 'Please log in to access this page.');
        }

        return $next($request);
    }
}
