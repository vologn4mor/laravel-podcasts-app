<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Podcast;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rules\File;

class PodcastController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('uploadPodcast');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|min:3|max:255',
            'about' => 'required|min:3',
            'image' => ['required', File::types(['gif', 'png', 'jpeg'])],
            'podcast' => ['required', File::types(['mp3', 'wav'])],
        ]);

        $image = $request->file('image');
        $podcast = $request->file('podcast');

        $imagePath = Storage::disk('local')->put('images/', $image);
        $podcastPath = Storage::disk('local')->put('podcasts/', $podcast);

        Podcast::create([
            'name' => $request->name,
            'podcast_file' => explode('//', $podcastPath)[1],
            'podcast_img' => explode('//', $imagePath)[1],
            'about' => $request->about,
            'user_id' => Auth::user()->id,
        ]);

        return to_route('profile')->with('success', true);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data = Podcast::findOrFail($id);
        $comments = Comment::where('podcast_id', $id)->latest()->paginate(5);
        return view('showPodcast', compact('data', 'comments'));
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
