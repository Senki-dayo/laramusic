<?php
    $name = Auth::user()->name;

    // dd($songs);
    // dd($songs['tracks'][0]['album']['images'][2]['url']);
    // dd($songs['tracks'][0]);
    // dd($image[0]['url']);
    // dd($track);
?>

<x-app-layo_ut>
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

    <div class="py-3">
        <div class="max-w-7xl mx-auto sm:w-10/12 md:w-8/10 lg:w-8/12">
          <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 bg-white border-b border-gray-200">
              <table class="text-left w-full border-collapse">
                <thead>
                  <tr>
                    <th class="py-3 px-6 bg-grey-lightest font-bold text-lg text-grey-dark border-b border-grey-light">注目の楽曲</th>
                  </tr>
                </thead>
                <tbody>
                    <p>曲名データ：{{$songs['tracks'][0]['name']}}</p>
                    <p>歌手データ：{{$songs['tracks'][0]['artists'][0]['name']}}</p>
                     {{--歌手は複数いるかもなの忘れないように  --}}
                    <p>画像データ：{{$songs['tracks'][0]['album']['images'][2]['url']}}</p>
                    <p>音声データ：{{$songs['tracks'][0]['preview_url']}}</p>
                    <p>トラックID:{{$songs['tracks'][0]['id']}}</p>
                    <?php

                        $track = Spotify::track('5m1i6hq7dmRlp3c1utE48L')->get();
                        // $track = Spotify::track($songs['tracks'][0]['id'])->get();
                        // dd($track);
                    ?>
                  @foreach ($songs['tracks'] as $song)
                  <tr class="hover:bg-grey-lighter">
                    <td class="py-4 px-6 border-b border-grey-light">
                        <div class="flex">
                            <div>
                                <img class="w-16 h-16" src={{$song['album']['images'][2]['url']}}>
                                <h3 class="text-left font-bold text-lg text-grey-dark">{{$song['artists'][0]['name']}}</h3>
                                <h3 class="text-left font-bold text-lg text-grey-dark">{{$song['name']}}</h3>
                                <audio controls src={{$song['preview_url']}}></audio>
                            </div>
                        </div>
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
