<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LogInController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.login');
    }

    // Other methods like login()...
}

