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
Route::group(['middleware' => 'auth'], function () {
    Route::get('/song/search/input', [SearchController::class, 'create'])->name('search.input');
    Route::get('/song/search/result', [SearchController::class, 'index'])->name('search.result');
    Route::get('/song/timeline', [SongController::class, 'timeline'])->name('song.timeline');
    Route::get('user/{user}', [FollowController::class, 'show'])->name('follow.show');
    Route::get('user/{user}/edit', [FollowController::class, 'edit'])->name('follow.edit');
    Route::put('user/{user}/update', [FollowController::class, 'update'])->name('follow.update');
    Route::post('user/{user}/follow', [FollowController::class, 'store'])->name('follow');
    Route::post('user/{user}/unfollow', [FollowController::class, 'destroy'])->name('unfollow');
    Route::post('song/{song}/favorites', [FavoriteController::class, 'store'])->name('favorites');
    Route::post('song/{song}/unfavorites', [FavoriteController::class, 'destroy'])->name('unfavorites');
    Route::resource('song', SongController::class);
    Route::resource('tag',TagController::class);
    Route::get('categorized/{song}/{tag}', [CategorizedController::class, 'destroy'])->name('untags');
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

    //ID Sample
    //track 1CAIveeC0CUY0KbENoNU3X
    //track 5m1i6hq7dmRlp3c1utE48L (track_imageあり)

    //おすすめの曲
    $seed = SpotifySeed::addTracks('55Ww4Pa1iIQMhh0MLMetjo', '1CAIveeC0CUY0KbENoNU3X');
    $songs = Spotify::recommendations($seed)->get();



    $image = Spotify::playlistCoverImage('37i9dQZF1DZ06evNZXIDEU')->get();
    // $image = Spotify::trackCoverImage('1CAIveeC0CUY0KbENoNU3X')->get();
    $track = Spotify::track('1CAIveeC0CUY0KbENoNU3X')->get();

    return view('dashboard',compact('songs','image','track'));
})->middleware(['auth', 'verified'])->name('dashboard');

require __DIR__.'/auth.php';
