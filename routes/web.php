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
    // $songs = Spotify::artistAlbums('37i9dQZF1DZ06evNZXIDEU')->get();
    // $songs = Spotify::artist('0TnOYISbd1XYRBk9myaseg')->get();
    $songs = Spotify::albumTracks('0GDxYVgLWDfGYgPUbuZonO')->get();
    return view('dashboard',compact('songs'));
})->middleware(['auth', 'verified'])->name('dashboard');

require __DIR__.'/auth.php';
