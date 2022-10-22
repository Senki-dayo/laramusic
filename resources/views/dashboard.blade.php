<?php
    $name = Auth::user()->name;
?>

<x-app-layout>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('おすすめ曲一覧') }}
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    ようこそ、{{ $name }}さん。
                </div>
            </div>
        </div>
    </div>

    {{-- データ読み込み チートシート --}}
    <div class="hidden">
    <p>曲名データ：{{$songs['tracks'][0]['name']}}</p>
    <p>歌手データ：{{$songs['tracks'][0]['artists'][0]['name']}}</p>
    <p>画像データ：{{$songs['tracks'][0]['album']['images'][2]['url']}}</p>
    <p>音声データ：{{$songs['tracks'][0]['preview_url']}}</p>
    <p>トラックID:{{$songs['tracks'][0]['id']}}</p>
    </div>

    <div class="py-3">
        <div class="max-w-7xl mx-auto sm:w-10/12 md:w-8/10 lg:w-8/12">
          <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 bg-white border-b border-gray-200">
              <table class="text-left w-full border-collapse">

                <thead>
                  <tr>
                    <th class="py-3 px-6 bg-grey-lightest font-bold text-lg text-grey-dark border-b border-grey-light">あなたにおすすめの楽曲</th>
                  </tr>
                </thead>

                <tbody>
                  @foreach ($songs['tracks'] as $song)
                  <tr class="hover:bg-grey-lighter">
                    <td class="py-4 px-6 border-b border-grey-light">
                        <form action="{{ route('song.store') }}" method="POST">
                            @csrf

                            {{-- データ転送用 --}}
                            <input class="hidden" type="text" name="song" value={{$song['name']}}>
                            <input class="hidden" type="text" name="artist" value={{$song['artists'][0]['name']}}>
                            <input class="hidden" type="text" name="image_url" value={{$song['album']['images'][2]['url']}}>
                            <input class="hidden" type="text" name="music_url" value={{$song['preview_url']}}>
                            <input class="hidden" type="text" name="track_id" value={{$songs['tracks'][0]['id']}}>
                            {{-- SpotifyのtrackIDだけをDBに保存したほうが良いかも？ --}}
                            {{-- SpotifyAPI(無料版)の接続制限も気になるのでとりあえず保留で。 --}}

                            {{-- データ表示用 --}}
                            <style>
                                .container {
                                    justify-content : space-between;
                                }
                            </style>

                            <div class="flex container">
                                <div class="w-1/6">
                                <img class="w-16 h-16" src={{$song['album']['images'][2]['url']}}>
                                </div>

                                <div class="w-1/3">
                                <h3 class="text-left font-bold text-lg text-grey-dark" name="song" id="song">{{$song['name']}}</h3>
                                <h3 class="text-left font-bold text-lg text-grey-dark">{{$song['artists'][0]['name']}}</h3>
                                </div>

                                <div class="w-5/12">
                                <audio controls src={{$song['preview_url']}}></audio>
                                </div>

                                <div class="w-1/12">
                                <button type="submit" class="rounded-md mt-2 px-2 py-2 font-medium tracking-widest text-white bg-red-500 shadow-lg focus:outline-none hover:bg-red-600 hover:shadow-none">
                                    登録
                                </button>
                                </div>
                            </div>
                        </form>
                    </td>
                  </tr>
                  @endforeach
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>

</x-app-layout>
