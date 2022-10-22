{{-- DBから得た楽曲表示部分 --}}
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
