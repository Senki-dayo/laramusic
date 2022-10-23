<form action="{{ route('song.store') }}" method="POST">
    @csrf

    {{-- データ転送用 --}}
    <input class="hidden" type="text" name="song" value={{$song->song}}>
    <input class="hidden" type="text" name="artist" value={{$song->artist}}>
    <input class="hidden" type="text" name="image_url" value={{$song->image_url}}>
    <input class="hidden" type="text" name="music_url" value={{$song->music_url}}>

    {{-- データ表示用 --}}
    <div class="flex container">
        @include('components.song_show_DB')
        </div>
        <div class="w-1/12">
        </div>
    </div>
    <style>
        .container {
            justify-content : space-between;
        }
    </style>
</form>
