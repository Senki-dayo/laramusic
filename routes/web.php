<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SongController;
use App\Http\Controllers\FavoriteController;
use App\Http\Controllers\FollowController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\TagController;
use App\Http\Controllers\CategorizedController;
// use Spotify;

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
Route::group(['middleware' => 'auth'], function () {
    Route::get('/song/search/input', [SearchController::class, 'create'])->name('search.input');
    Route::get('/song/search/result', [SearchController::class, 'index'])->name('search.result');
    Route::get('/song/timeline', [SongController::class, 'timeline'])->name('song.timeline');
    Route::get('user/{user}', [FollowController::class, 'show'])->name('follow.show');
    Route::post('user/{user}/follow', [FollowController::class, 'store'])->name('follow');
    Route::post('user/{user}/unfollow', [FollowController::class, 'destroy'])->name('unfollow');
    Route::post('song/{song}/favorites', [FavoriteController::class, 'store'])->name('favorites');
    Route::post('song/{song}/unfavorites', [FavoriteController::class, 'destroy'])->name('unfavorites');
    Route::get('/song/mypage', [SongController::class, 'mydata'])->name('song.mypage');
    Route::resource('song', SongController::class);
    Route::resource('tag',TagController::class);
    Route::resource('categorized',CategorizedController::class);

});

Route::get('/', function () {
    return view('welcome');
});
Route::get('/dashboard', function () {
    // $songs = Spotify::albumTracks('0GDxYVgLWDfGYgPUbuZonO')->get();
    // $seed = SpotifySeed::setGenres(['gospel', 'pop', 'funk'])
    //     ->setTargetValence(1.00)
    //     ->setSpeechiness(0.3, 0.9)
    //     ->setLiveness(0.3, 1.0);
    $seed = SpotifySeed::addTracks('55Ww4Pa1iIQMhh0MLMetjo', '1CAIveeC0CUY0KbENoNU3X');
    $songs = Spotify::recommendations($seed)->get();
    return view('dashboard',compact('songs'));
})->middleware(['auth', 'verified'])->name('dashboard');

require __DIR__.'/auth.php';
