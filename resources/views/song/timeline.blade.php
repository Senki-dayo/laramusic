<x-app-layout>
    <x-slot name="header">
      <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        {{ __('曲一覧') }}
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

                        <form action="{{ route('song.store') }}" method="POST">
                            @csrf

                            {{-- データ転送用 --}}
                            <input class="hidden" type="text" name="song" value={{$song->song}}>
                            <input class="hidden" type="text" name="artist" value={{$song->artist}}>
                            <input class="hidden" type="text" name="image_url" value={{$song->image_url}}>
                            <input class="hidden" type="text" name="music_url" value={{$song->music_url}}>
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
                                <img class="w-16 h-16" src={{$song->image_url}}>
                                </div>

                                <div class="w-1/3">
                                <h3 class="text-left font-bold text-lg text-grey-dark" name="song" id="song">{{$song->song}}</h3>
                                <h3 class="text-left font-bold text-lg text-grey-dark">{{$song->artist}}</h3>
                                </div>

                                <div class="w-5/12">
                                <audio controls src={{$song->music_url}}></audio>
                                </div>

                                @if($song->user->id !== Auth::id())
                                <div class="w-1/12">
                                <button type="submit" class="rounded-md mt-2 px-2 py-2 font-medium tracking-widest text-white bg-black shadow-lg focus:outline-none hover:bg-gray-900 hover:shadow-none">
                                    登録
                                </button>
                                </div>
                                @else
                                <div class="w-1/12">
                                </div>
                                @endif

                            </div>
                        </form>

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
