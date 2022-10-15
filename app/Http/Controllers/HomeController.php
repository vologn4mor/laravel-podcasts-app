<?php

namespace App\Http\Controllers;

use App\Models\Podcast;
use App\Models\User;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $podcasts = Podcast::orderBy('id', 'desc')->take(3)->get();
        $users = User::orderBy('id', 'desc')->take(3)->get();
        return view('home', compact('podcasts', 'users'));
    }
}
