{{-- APIから得た楽曲表示部分 --}}
<div class="w-1/6">
<img class="w-16 h-16" src={{$song['album']['images'][2]['url']}}>
</div>
<div class="w-1/3">
<h3 class="text-left font-bold text-lg text-grey-dark" name="song" id="song">{{$song['name']}}</h3>
<h3 class="text-left font-bold text-lg text-grey-dark">{{$song['artists'][0]['name']}}</h3>
</div>
<div class="w-5/12">
<audio controls src={{$song['preview_url']}}></audio>
</div>
