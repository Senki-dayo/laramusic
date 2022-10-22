{{-- APIから得た楽曲表示部分 --}}
<?php
$title = $song['name'];
$artist = $song['artists'][0]['name'];
$image_url = $song['album']['images'][2]['url'];
$music_url = $song['preview_url'];
?>
@include('components.song_show')
