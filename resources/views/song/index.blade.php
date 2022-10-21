<x-app-layout>
    <x-slot name="header">
      <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        {{ __('あなたの楽曲を一覧表示') }}
      </h2>
    </x-slot>

    <div class="py-3">
        <div class="max-w-7xl mx-auto sm:w-10/12 md:w-8/10 lg:w-8/12">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 bg-white border-b border-gray-200">
                <table class="text-left w-full border-collapse">

                <thead>
                    <tr>
                    <th class="py-3 px-6 bg-grey-lightest font-bold text-lg text-grey-dark border-b border-grey-light">
                        {{-- 曲の絞り込み機能 --}}
                        <form class="flex" action="{{ route('song.search') }}" method = "GET">
                            @csrf
                            <div class="selectdiv">
                                <label>
                                    <select name="tag_title">
                                        <option>指定しない</option>
                                        @foreach ($tags as $tag)
                                        <option>{{$tag->tag_title}}</option>
                                        @endforeach
                                    </select>
                                </label>
                            </div>
                            <button type="submit" class="btn ml-2 mt-2 rounded-md px-1 py-1 text-xs font-light tracking-widest text-white bg-green-500 shadow-lg focus:outline-none hover:bg-green-700 hover:shadow-none">
                                この条件で絞り込む
                            </button>
                        </form>
                        @if ($searched != null)
                        <p>絞り込み条件：{{$searched}}</p>
                        @endif
                    </th>
                    </tr>
                </thead>

                <tbody>
                    @foreach ($songs as $index => $song)
                    <tr class="hover:bg-grey-lighter">
                    <td class="py-4 px-6 border-b border-grey-light">

                        {{-- 曲の情報の表示 --}}
                        <form action="{{ route('song.destroy',$song->id) }}" method="POST">
                            @method('delete')
                            @csrf
                            <div class="flex container">
                                <div class="w-1/6">
                                <img class="w-16 h-16" src={{$song->image_url}}>
                                </div>
                                <div class="w-1/3">
                                <h3 class="text-left font-bold text-lg text-grey-dark" name="song" id="song">{{$song->song}}</h3>
                                <h3 class="text-left font-normal text-lg text-grey-dark">{{$song->artist}}</h3>
                                </div>
                                <div class="w-5/12">
                                <audio controls src={{$song->music_url}}></audio>
                                </div>
                                <div class="w-1/12">
                                <button type="submit" class="rounded-md mt-2 px-2 py-2 font-medium tracking-widest text-white bg-gray-700 shadow-lg focus:outline-none hover:bg-gray-800 hover:shadow-none">
                                    削除
                                </button>
                                </div>
                            </div>
                        </form>

                        {{-- 登録するタグの表示 --}}
                        <div class="mt-2">
                            <form class="flex" action="{{ route('categorized.store') }}" method = "POST">
                                @csrf
                                <select class="hidden" name="song">
                                    <option>{{$song->song}}</option>
                                </select>

                                <div class="selectdiv">
                                    <label>
                                        <select name="tag_title">
                                            <option selected>Select Tag</option>
                                            @foreach ($tag_units[$index] as $tag)
                                            <option>{{$tag->tag_title}}</option>
                                            @endforeach
                                        </select>
                                    </label>
                                </div>
                                <button type="submit" class="btn ml-2 mt-2 rounded-md px-1 py-1 text-xs font-light tracking-widest text-white bg-green-500 shadow-lg focus:outline-none hover:bg-green-700 hover:shadow-none">
                                    追加
                                </button>
                            </form>
                        </div>

                        {{-- 登録済みタグの表示 --}}
                        <div class="flex">
                            @foreach($song->tags as $tag)
                            <form action="{{ route('untags', ['song' => $song->id ,'tag' => $tag->id]) }}" method="POST">
                                @method('delete')
                                @csrf
                                <div class="tag">
                                    {{$tag->tag_title}}
                                    <button type="submit" class="rounded-full px-1 text-xs font-light tracking-widest text-white bg-red-500 shadow-lg focus:outline-none hover:bg-red-700 hover:shadow-none">
                                        X
                                    </button>
                                </div>
                            </form>
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


<style>
    .container {
        justify-content : space-between;
    }

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

    .btn {
        height: 25px;
    }

    .selectdiv {
    position: relative;
    float: left;
    min-width: 150px;
    }

    select::-ms-expand {
    display: none;
    }

    .selectdiv:after {
    content: '<>';
    font: 16px "Consolas", monospace;
    color: #333;
    -webkit-transform: rotate(90deg);
    -moz-transform: rotate(90deg);
    -ms-transform: rotate(90deg);
    transform: rotate(90deg);
    right: 5px;
    top: 6px;
    padding: 0 0 2px;
    border-bottom: 1px solid #999;
    position: absolute;
    pointer-events: none;
    }

    .selectdiv select {
    -webkit-appearance: none;
    -moz-appearance: none;
    appearance: none;
    display: block;
    width: 100%;
    max-width: 320px;
    height: 30px;
    float: right;
    margin: 5px 0px;
    padding: 0px 24px;
    font-size: 16px;
    line-height: 1.75;
    color: #333;
    background-color: #ffffff;
    background-image: none;
    border: 1px solid #cccccc;
    -ms-word-break: normal;
    word-break: normal;
    }
</style>
