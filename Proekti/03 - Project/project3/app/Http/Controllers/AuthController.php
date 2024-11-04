<?php

namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    public function showRegistrationForm()
    {
        return view('register');
    }

    public function register(Request $request)
    {
        // Validate the form data
        $validator = Validator::make($request->all(), [
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6',
        ]);

        if ($validator->fails()) {
            // Redirect back to the registration form with errors
            return redirect()->back()->withErrors($validator)->withInput();
        }

        // Create the user without 'name'
        $user = User::create([
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        // Log the user in
        Auth::login($user);

        // Redirect to the choose plan page
        return redirect()->route('signup');
    }

    public function showLoginForm()
    {
        return view('login');
    }

    public function login(Request $request)
    {
        // Validate the form data
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            // If login successful, redirect to intended page
            return redirect()->intended('signup');
        }

        // If login fails, redirect back to the login form with errors
        return redirect()->back()->withErrors([
            'email' => 'These credentials do not match our records.',
        ])->withInput();
    }
}
