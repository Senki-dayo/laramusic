<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Song;
use Auth;
use App\Models\User;
use App\Models\Tag;

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
        
        // create()は最初から用意されている関数
        // 戻り値は挿入されたレコードの情報
        $data = $request->merge(['user_id' => Auth::user()->id])->all();
        $result = Song::create($data);
        // ルーティング「todo.index」にリクエスト送信（一覧ページに移動）
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
    public function destroy($id)
    {
        //
    }
}
