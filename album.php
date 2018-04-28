<?php

include("includes/includedFiles.php");

if(isset($_GET['id'])) {
    $albumId = $_GET['id'];
} else {
    header("Location : index.php");
}

    // first album query
    $album = new Album($con, $albumId);
    // get artits name using $album artist id
    $artist = $album->getArtist();

    // display
    // echo $album->getTitle() . "<br>";
    // echo $artist->getName(); // see those name , artis from db
?>

    <div class="entityInfo">
        <div class="leftSection">
            <img src="<?php echo $album->getArtworkPath();?>">
        </div>
        <div class="rightSection">
            <h2><?php echo $album->getTitle(); ?></h2>
            <p>By <?php echo $artist->getName(); ?></p>
            <p><?php echo $album->getNumberOfSongs(); ?> Songs in this Album</p>
        </div>        
    </div>
    <div class="trackListContainer">
        <ul class="trackList">
            <?php 
                $songsIdArray = $album->getSongsIds();
                $i = 1;

                foreach($songsIdArray as $songId) {
                    $albumSong = new Song($con, $songId);
                    $albumArtist = $albumSong->getArtist();

                    echo 
                    "<li class='tracklistRow'>
                        <div class='trackCount'>
                            <img class='play' src='assets/images/icon/play-white.png' onclick='setTrack(\"" . $albumSong->getId() . "\", tempPlaylist, true)'>
                            <span class='trackNumber'>$i</span>
                        </div>
                        <div class='trackInfo'>
                            <span class='trackName'>" . $albumSong->getTitle() . "</span>
                            <span class='artistName'>" . $albumArtist->getName() . "</span>
                        </div>
                        <div class='trackOptions'>
                            <input type='hidden' class='songId' value='".$albumSong->getId() . "'>
                            <img class='optionsButton' src='assets/images/icon/more.png' onclick='showOptionMenu(this)'>
                        </div>
                        <div class='trackDuration'>
                            <span class='duration'>" . $albumSong->getDuration() . "</span>
                        </div>
                    </li>";

                    $i++;
                }
            ?>
            <script>
                var tempSongIds = '<?php echo json_encode($songsIdArray); ?>';
                tempPlaylist = JSON.parse(tempSongIds);
            </script>
        </ul>
    </div>

    <nav class="optionMenu">
        <input type="hidden" class="songId">
        <?php echo Playlist::getPlaylistDropdown($con, $userLoggedIn->getUsername()); ?>
        <div class="item">item 2</div>
        <div class="item">item 3</div>
    </nav>


