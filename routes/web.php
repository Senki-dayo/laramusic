<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SongController;
use App\Http\Controllers\FavoriteController;
use App\Http\Controllers\FollowController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\TagController;
use App\Http\Controllers\CategorizedController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// get -> 情報を取得するとき
// post -> 情報を登録するとき
// put -> 情報の登録のうち、特に情報を更新するとき
// delete -> 情報の登録のうち、特に情報を削除するとき

Route::group(['middleware' => 'auth'], function () {
    // SpotifyAPIを通した、キーワードから曲を検索する機能
    Route::get('/song/search/input', [SearchController::class, 'create'])->name('search.input');
    Route::get('/song/search/result', [SearchController::class, 'index'])->name('search.result');
    // タグから曲を検索する機能
    Route::get('/song/search', [SongController::class, 'search'])->name('song.search');
    // タイムライン機能
    Route::get('/song/timeline', [SongController::class, 'timeline'])->name('song.timeline');
    // ユーザを検索する機能
    Route::get('user/search/input', [FollowController::class, 'search'])->name('follow-search.input');
    Route::get('user/search/result', [FollowController::class, 'index'])->name('follow-search.result');
    // ユーザを表示、フォローする機能
    Route::get('user/{user}', [FollowController::class, 'show'])->name('follow.show');
    Route::get('user/{user}/edit', [FollowController::class, 'edit'])->name('follow.edit');
    Route::put('user/{user}/update', [FollowController::class, 'update'])->name('follow.update');
    Route::post('user/{user}/follow', [FollowController::class, 'store'])->name('follow');
    Route::post('user/{user}/unfollow', [FollowController::class, 'destroy'])->name('unfollow');
    // 曲の機能
    Route::resource('song', SongController::class);
    // タグの機能
    Route::resource('tag',TagController::class);
    // 曲に対してタグを付け外しする機能
    Route::delete('categorized/{song}/{tag}', [CategorizedController::class, 'destroy'])->name('untags');
    Route::resource('categorized',CategorizedController::class);
});

Route::get('/', function () {
    return view('welcome');
});
Route::get('/dashboard', function () {
    //おすすめの曲
    $seed = SpotifySeed::addTracks('55Ww4Pa1iIQMhh0MLMetjo', '1CAIveeC0CUY0KbENoNU3X');
    $songs = Spotify::recommendations($seed)->get();
    return view('dashboard',compact('songs'));
})->middleware(['auth', 'verified'])->name('dashboard');

require __DIR__.'/auth.php';
