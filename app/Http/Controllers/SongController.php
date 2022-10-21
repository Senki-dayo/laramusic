<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Validator;
use App\Models\Song;
use App\Models\User;
use App\Models\Tag;
use Auth;

class SongController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // 自分の登録曲を全て取得
        $songs = Song::query()
            ->where('user_id',Auth::id())
            ->orderby('updated_at','desc')
            ->get();


        $tag_units = [];
        foreach($songs as $song){
            $tags_id = $song->tags
                ->pluck('id');
            $tag_unit = Tag::query()
                ->where('user_id',Auth::id())
                ->whereNotIn('id',$tags_id)
                ->get();
            array_push($tag_units, $tag_unit);
        }

        // $tag_title = "面白い";
        // $tag_id = Tag::query()
        //     ->where('user_id',Auth::id())
        //     ->where('tag_title',$tag_title)
        //     ->value('id');

        // $song_id = DB::table('song_tag')
        //     ->where('tag_id',$tag_id)
        //     ->pluck('song_id');

        // $songs = Song::query()
        //     ->where('user_id',Auth::id())
        //     ->whereIn('id',$song_id)
        //     ->get();

        return view('song.index',compact('songs','tag_units'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('song.create');
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
        'song' => 'required | max:191',
    ]);
    // バリデーション:エラー
    if ($validator->fails()) {
        return redirect()
        ->route('song.create')
        ->withInput()
        ->withErrors($validator);
    }
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
    $song = Song::find($id);
    return view('song.show', compact('song'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
    $song = Song::find($id);
    return view('song.edit', compact('song'));
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
      //バリデーション
      $validator = Validator::make($request->all(), [
        'song' => 'required | max:191',
        'description' => 'required',
      ]);
      //バリデーション:エラー
      if ($validator->fails()) {
        return redirect()
          ->route('song.edit', $id)
          ->withInput()
          ->withErrors($validator);
      }
      //データ更新処理
      $result = Song::find($id)->update($request->all());
      return redirect()->route('song.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
    $result = Song::find($id)->delete();
    return redirect()->route('song.index');
    }

    public function timeline()
    {
    // フォローしているユーザを取得する
    $followings = User::find(Auth::id())->followings->pluck('id')->all();
    $songs = Song::query()
        ->where('user_id', Auth::id())
        ->orWhereIn('user_id', $followings)
        ->orderBy('updated_at', 'desc')
        ->get();
    return view('song.timeline', compact('songs'));
    }
}
