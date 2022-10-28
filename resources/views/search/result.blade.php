<x-app-layout>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('キーワード検索した曲を一覧表示') }}
        </h2>
    </x-slot>

    <div class="py-3">
        <div class="max-w-7xl mx-auto sm:w-10/12 md:w-8/10 lg:w-8/12">
          <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 bg-white border-b border-gray-200">
              <table class="text-left w-full border-collapse">

                <thead>
                  <tr>
                    <th class="py-3 px-6 bg-grey-lightest font-bold text-lg text-grey-dark border-b border-grey-light">検索結果  "{{$keyword}}"</th>
                  </tr>
                </thead>

                <tbody>
                  @foreach ($songs['tracks']['items'] as $song)
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
                  </tr>
                  @endforeach
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>

</x-app-layout>
