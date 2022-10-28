<?php
    $name = Auth::user()->name;
?>

<x-app-layout>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('おすすめ曲一覧') }}
        </h2>
    </x-slot>

    <div class="py-3">
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
                    <th class="py-3 px-6 bg-grey-lightest font-bold text-lg text-grey-dark border-b border-grey-light">あなたにおすすめの楽曲</th>
                  </tr>
                </thead>

                <tbody>
                  @foreach ($songs['tracks'] as $song)
                  <tr class="hover:bg-grey-lighter">
                    <td class="py-4 px-6 border-b border-grey-light">
                        {{-- わかりやすい変数に格納 --}}
                        <?php
                        $title = $song['name'];
                        $artist = $song['artists'][0]['name'];
                        $image_url = $song['album']['images'][2]['url'];
                        $music_url = $song['preview_url'];
                        $track_id = $song['id'];
                        $user_id = null;
                        ?>
                        {{-- 登録フォームの表示 --}}
                        @include("components.resister-form")
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
