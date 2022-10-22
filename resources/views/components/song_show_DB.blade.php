{{-- DBから得た楽曲表示部分 --}}
<?php
$title = $song->song;
$artist = $song->artist;
$image_url = $song->image_url;
$music_url = $song->music_url;
?>
@include('components.song_show')
