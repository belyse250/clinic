<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LogoutController extends Controller
{
    public function store(Request $request)
    {
        // Store user ID before logout for session cleanup
        $userId = Auth::id();
        
        // Logout the user
        Auth::logout();
        
        // Invalidate current session
        $request->session()->invalidate();
        
        // Flush all session data
        $request->session()->flush();
        
        // Regenerate CSRF token
        $request->session()->regenerateToken();
        
        return redirect('/');
    }
}
