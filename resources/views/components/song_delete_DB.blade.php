<form action="{{ route('song.destroy',$song->id) }}" method="POST">
    @method('delete')
    @csrf
    <div class="flex container">
        @include('components.song_show_DB')
        <div class="w-1/12">
        <button type="submit" class="rounded-md mt-2 px-2 py-2 font-medium tracking-widest text-white bg-gray-700 shadow-lg focus:outline-none hover:bg-gray-800 hover:shadow-none">
            削除
        </button>
        </div>
    </div>
</form>
