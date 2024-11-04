<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FuncionDelSito extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(){
        return view('index');
    }

    public function about(){
        return view('about');
    }

    public function post(){
        return view('post');
    }

    public function contact(){
        return view('contact');
    }

}
