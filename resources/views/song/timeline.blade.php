<x-app-layout>
    <x-slot name="header">
      <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        {{ __('タイムライン') }}
      </h2>
    </x-slot>

    <div class="py-3">
        <div class="max-w-7xl mx-auto sm:w-10/12 md:w-8/10 lg:w-8/12">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 bg-white border-b border-gray-200">
                <table class="text-left w-full border-collapse">

                <thead>
                    <tr>
                    <th class="py-3 px-6 bg-grey-lightest font-bold text-lg text-grey-dark border-b border-grey-light">最近の活動</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach ($songs as $song)
                    <tr class="hover:bg-grey-lighter">
                    <td class="py-4 px-6 border-b border-grey-light">
                        <p>{{$song->created_at}}</p>
                        <p class="mb-4"><b>{{$song->user->name}}</b>さんが新しい楽曲を登録しました。</p>
                        {{-- わかりやすい変数に格納 --}}
                        <?php
                        $title = $song->song;
                        $artist = $song->artist;
                        $image_url = $song->image_url;
                        $music_url = $song->music_url;
                        $track_id = $song->track_id;
                        $user_id = $song->user->id;
                        ?>
                        {{-- 登録フォームの表示 --}}
                        @include("components.resister-form")

                        <style>
                            .tag {
                                display: inline-block;
                                margin: .5em .5em 0 0;
                                padding: .4em;
                                line-height: 1;
                                text-decoration: none;
                                color: black;
                                background-color: #fff;
                                border: 1px solid black;
                                border-left: 5px solid black;
                            }
                        </style>

                        <div class="flex">
                            @foreach($song->tags as $tag)
                            <div class="tag">
                                {{$tag->tag_title}}
                            </div>
                            @endforeach
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
