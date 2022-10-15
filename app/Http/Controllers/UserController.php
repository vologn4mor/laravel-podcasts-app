<?php

namespace App\Http\Controllers;

use App\Models\Podcast;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rules\File;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = User::findOrfail(Auth::user()->id);
        $podcasts = Podcast::where('user_id', Auth::user()->id)->latest()->paginate(3);
        $user = [
            'name' => $data->name,
            'id' => $data->id,
            'email' => $data->email,
            'created_at' => $data->created_at,
            'podcasts' => $podcasts,
            'image' => $data->user_image,
            'about' => $data->about
        ];
        return view('profile', compact('user'));
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data = User::findOrfail($id);
        $podcasts = Podcast::where('user_id', $id)->paginate(3);
        $user = [
            'name' => $data->name,
            'id' => $data->id,
            'email' => $data->email,
            'created_at' => $data->created_at,
            'podcasts' => $podcasts,
            'image' => $data->user_image,
            'about' => $data->about
        ];
        return view('profile', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit()
    {
        $user = User::findOrFail(Auth::user()->id);
        // dd($user);
        return view('profileEdit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $request->validate([
            'name' => 'required|min:3',
            'about' => 'min:5|nullable',
            'image' => ['nullable', File::types(['gif', 'png', 'jpeg'])]
        ]);

        $image = $request->file('image');

        if (isset($image)) {
            $imagePath = Storage::disk('local')->put('images/', $image);
            User::findOrFail(Auth::user()->id)->update([
                'user_image' => explode('//', $imagePath)[1],
            ]);
        }

        $usernameCheck = User::where('name', '=', $request->name)->get();
        if (count($usernameCheck)) {
            return to_route('profile')->with('error', true);
        }

        User::findOrFail(Auth::user()->id)->update([
            'name' => $request->name,
            'about' => $request->about,
        ]);

        return to_route('profile');

        // dd($request);
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
