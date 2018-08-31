<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \App\Sport as Sports;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $sports = Sports::all();

        return view('home', ['sports' => $sports]);
    }
}
