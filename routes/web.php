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
    //ここから下はAPIの準備

    // $session = new SpotifyWebAPI\Session(
    //     env('SPOTIFY_CLIENT_ID'),
    //     env('CLIENT_SECRET')
    // );

    $api = new SpotifyWebAPI\SpotifyWebAPI();

    // やりかた1. code からやる
    // $session->requestAccessToken($_GET['code']);
    // $api->setAccessToken($session->getAccessToken());

    // やりかた2. refreshToken からやる
    // $session->refreshAccessToken('AQBFrvddB3Yix-ZdUOWO56k0zh7MRAAC0wRNKn1NnUMO6Fs3DZEHLrIeQM6kUM8cwaUjHlIl0SoCRN4tgXkFu3mwiFDR7cb9Ed4l947Hy0Kzlrs0hqbdX6vf0H-CPXXS6GU');
    // $accessToken = $session->getAccessToken();
    // $refreshToken = $session->getRefreshToken();
    // $api->setAccessToken($accessToken);

    // やりかた3. accessToken からやる
    $api->setAccessToken('BQC0GKf65vdqcM8ag80I09oRwzVN0YLR1x3909zWHY422VRpEQOrMsi2sFcUZmaD-hG-JgDhgwQkZ1vURxOi0YJ_NgsJ2R83pGk8Yztjr9N8KlpyYf-Pflg_MrKfPqBtQNfPs0c2tozOwMxlBIzADCqh-k0fEfnYtspEH_JHPJ2Vc7l1-m-dUXn3vCEfXFBX1K2f7rVxWxsxvKbQVcvBrGtAgTXRYMEhplmhJMfKfKu4i-B8BrFCKK0zhsYmC6y2B3phi3pDqBLkbF48Dho0Dg');

    // ここから下は曲の取得をするところ

    // 任意のアーティストの楽曲をまとめて取得
    // $albums = $api->getArtistAlbums('6n4SsAp5VjvIBg3s9QCcPX');
    // return view('dashboard', compact('albums'));

    // 任意の曲から、おすすめの曲をまとめて取得
    $seedTracks = ['55Ww4Pa1iIQMhh0MLMetjo', '1CAIveeC0CUY0KbENoNU3X'];
    $recommendations = $api->getRecommendations([
        'seed_tracks' => $seedTracks,
    ]);
    return view('dashboard', compact('recommendations'));


})->middleware(['auth', 'verified'])->name('dashboard');

require __DIR__.'/auth.php';
