<form action="{{ route('song.store') }}" method="POST">
    @csrf

    {{-- データ転送用 --}}
    <input class="hidden" type="text" name="song" value={{$song['name']}}>
    <input class="hidden" type="text" name="artist" value={{$song['artists'][0]['name']}}>
    <input class="hidden" type="text" name="image_url" value={{$song['album']['images'][2]['url']}}>
    <input class="hidden" type="text" name="music_url" value={{$song['preview_url']}}>
    <input class="hidden" type="text" name="track_id" value={{$song['id']}}>

    {{-- データ表示用 --}}
    <div class="flex container">
        @include('components.song_show_API')
        <div class="w-1/12">
        <button type="submit" class="rounded-md mt-2 px-2 py-2 font-medium tracking-widest text-white bg-red-500 shadow-lg focus:outline-none hover:bg-red-600 hover:shadow-none">
            登録
        </button>
        </div>
    </div>
    <style>
        .container {
            justify-content : space-between;
        }
    </style>
</form>
