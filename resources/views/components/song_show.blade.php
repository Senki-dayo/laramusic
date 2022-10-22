{{-- 楽曲表示部分 --}}
<div class="w-1/6">
<img class="w-16 h-16" src={{$image_url}}>
</div>
<div class="w-1/3">
<h3 class="text-left font-bold text-lg text-grey-dark" name="song" id="song">{{$title}}</h3>
<h3 class="text-left font-bold text-lg text-grey-dark">{{$artist}}</h3>
</div>
<div class="w-5/12">
<audio controls src={{$music_url}}></audio>
</div>
