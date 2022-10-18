<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;
use Illuminate\Validation\Rule;
use App\Models\Tag;
use Auth;
use App\Models\User;

class TagController extends Controller
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
        return view('tag.create');
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
    $rules1 = [
        'tag_title' => 'required | max:191',
    ];

    $rules2 = [
        'tag_title' =>
            Rule::unique('tags')->where(function ($query) {
                return $query->where('user_id', Auth::id());
            }),
    ];

    $validator = Validator::make($request->all(), $rules1);
    // バリデーション:エラー
    if ($validator->fails()) {
        return redirect()
        ->route('tag.create')
        ->withInput()
        ->withErrors($validator);
    }

    $validator = Validator::make($request->all(), $rules2);
    // バリデーション:エラー
    if ($validator->fails()) {
        return redirect()
        ->route('tag.create')
        ->withInput()
        ->withErrors($validator);
    }

    // create()は最初から用意されている関数
    // 戻り値は挿入されたレコードの情報
    $data = $request->merge(['user_id' => Auth::user()->id])->all();
    $result = Tag::create($data);
    // ルーティング「tag.index」にリクエスト送信（一覧ページに移動）
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
