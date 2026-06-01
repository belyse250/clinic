<?php

namespace App\Http\Controllers;

use App\Models\RestaurantUser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class RestaurantAuthController extends Controller
{
    // Show login form
    public function showLogin()
    {
        return view('restaurant.auth.login');
    }

    // Process login
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'username' => 'required|string',
            'password' => 'required|string',
        ]);

        $user = RestaurantUser::where('username', $credentials['username'])->first();

        if ($user && Hash::check($credentials['password'], $user->password)) {
            auth('restaurant')->login($user);
            $request->session()->regenerate();

            return redirect()->route('restaurant.dashboard')->with('success', 'Logged in successfully');
        }

        return back()->withErrors([
            'username' => 'Invalid credentials',
        ]);
    }

    // Logout
    public function logout(Request $request)
    {
        auth('restaurant')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('restaurant.login')->with('success', 'Logged out successfully');
    }

    // Show registration form (optional, for staff registration)
    public function showRegister()
    {
        return view('restaurant.auth.register');
    }

    // Process registration
    public function register(Request $request)
    {
        $validated = $request->validate([
            'username' => 'required|string|unique:restaurant_users',
            'password' => 'required|string|min:8|confirmed',
            'name' => 'required|string|max:255',
        ]);

        RestaurantUser::create([
            'username' => $validated['username'],
            'password' => Hash::make($validated['password']),
            'name' => $validated['name'],
            'role' => 'staff',
            'status' => 'active',
        ]);

        return redirect()->route('restaurant.login')
            ->with('success', 'Registration successful. Please log in.');
    }
}
