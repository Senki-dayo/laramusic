<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;
use App\Models\Song;
use App\Models\User;
use App\Models\Tag;
use Auth;

class CategorizedController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $songs = Song::query()
            ->where('user_id', Auth::id())
            ->orderBy('updated_at', 'desc')
            ->get();
        $tags = Tag::query()
            ->where('user_id', Auth::id())
            ->orderBy('updated_at', 'desc')
            ->get();
        return view('categorized.create', compact('songs', 'tags'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // バリデーション
        $validator = Validator::make($request->all(), [
            'tag_title' => 'required',
        ]);
        // バリデーション:エラー
        if ($validator->fails()) {
            return redirect()
            ->route('song.index')
            ->withInput()
            ->withErrors($validator);
        }

        $song = Song::query()
            ->where('user_id',Auth::id())
            ->where('song', $request->input('song'))
            ->first();
        $tag = Tag::query()
            ->where('user_id',Auth::id())
            ->where('tag_title', $request->input('tag_title'))
            ->first();
        $song->tags()->attach($tag->id);
        return redirect()->route('song.index');
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
    public function destroy($song_id,$tag_id)
    {
        $song = Song::find($song_id);
        $song->tags()->detach($tag_id);
        return redirect()->route('song.index');
    }
}
