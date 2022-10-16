<?php
    // dd($albums);
    // dd($recommendations);
    $name = Auth::user()->name;

    class Song
    {
        public $title = "";
        public $artist = "";
        public $description = "";
    }

    $songs = array();

    $songs[0] = new Song();
    $songs[0]->title = "Title1";
    $songs[0]->artist = "Taro";
    $songs[0]->description = "It's fun!!";

    $songs[1] = new Song();
    $songs[1]->title = "Title2";
    $songs[1]->artist = "Jiro";
    $songs[1]->description = "It's sad!!";

    $songs[2] = new Song();
    $songs[2]->title = "Title3";
    $songs[2]->artist = "Saburo";
    $songs[2]->description = "It's good!!";

?>

<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
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
                  @foreach ($recommendations->tracks as $track)
                  <tr class="hover:bg-grey-lighter">
                    <td class="py-4 px-6 border-b border-grey-light">
                        <div class="flex">
                            <div>
                                {{-- <p class="text-left text-grey-dark">{{$track->artist}}</p> --}}
                                <h3 class="text-left font-bold text-lg text-grey-dark">{{$track->name}}</h3>
                            </div>
                            {{-- <div class="ml-8 items-center">
                                <p class="text-grey-dark">{{$album->description}}</p>
                            </div> --}}
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
