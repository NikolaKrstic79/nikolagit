<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class RegisterController extends Controller
{
    /**
     *
     * @return \Illuminate\View\View
     */
    public function showEmailForm()
    {
        return view('emailForm');
    }

    /**
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\View\View
     */
    public function submitEmail(Request $request)
    {
        // Validate the email
        $request->validate([
            'email' => 'required|email',
        ]);

        return view('register', ['email' => $request->input('email')]);
    }
}
