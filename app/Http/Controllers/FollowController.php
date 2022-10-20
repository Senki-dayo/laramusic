<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;
use App\Models\User;
use Auth;
use App\Http\Controllers\FollowController;

class FollowController extends Controller
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
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(User $user)
    {
    Auth::user()->followings()->attach($user->id);
    return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
    // ターゲットユーザのデータ
    $user = User::find($id);
    // ターゲットユーザのフォロワー一覧
    $followers = $user->followers;
    // ターゲットユーザのフォローしている人一覧
    $followings  = $user->followings;

    return view('user.show', compact('user', 'followers', 'followings'));
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::find($id);
        return view('user.edit', compact('user'));
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
        'name' => 'required | max:191',
        'email' => 'required',
    ]);
    //バリデーション:エラー
    if ($validator->fails()) {
        return redirect()
        ->route('follow.edit', $id)
        ->withInput()
        ->withErrors($validator);
    }
    //データ更新処理
    $result = User::find($id)->update($request->all());
    return redirect()->route('follow.show', $id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
    Auth::user()->followings()->detach($user->id);
    return redirect()->back();
    }
}
