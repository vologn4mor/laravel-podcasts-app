<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Podcast;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (Auth::user()->role === 'admin') {
            $users = User::paginate(50);
            $podcasts = Podcast::paginate(50);
            $comments = Comment::paginate(50);
            return view('admin', compact('users', 'podcasts', 'comments'));
        } else {
            return to_route('home');
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if (Auth::user()->role === 'admin') {
            if (isset($request->user)) {
                $user = User::findOrFail($request->user);
                $user->delete();
                return to_route('admin');
            }
            if (isset($request->podcast)) {
                $podcast = Podcast::findOrFail($request->podcast);
                $podcast->delete();
                return to_route('admin');
            }
            if (isset($request->comment)) {
                $comment = Comment::findOrFail($request->comment);
                $comment->delete();
                return to_route('admin');
            }
        } else {
            return to_route('home');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
