<?php

include("includes/includedFiles.php");

    if(isset($_GET['id'])) {
        $playlistId = $_GET['id'];
    } else {
        header("Location : index.php");
    }

    $playlist = new Playlist($con, $playlistId);
    $owner = new User($con, $playlist->getOwner());
?>

    <div class="entityInfo">
        <div class="leftSection">
            <div class="playlistImage">
                 <img src="assets/images/icon/playlist.png">
            </div>
        </div>
        <div class="rightSection">
            <h2><?php echo $playlist->getName(); ?></h2>
            <p>By <?php echo $playlist->getOwner(); ?></p>
            <p><?php echo $playlist->getNumberOfSongs(); ?> Songs in this Album</p>
            <button class="button" onclick="deletePlaylist('<?php echo $playlistId; ?>')">DELETE PLAYLIST</button>
        </div>        
    </div>
    <div class="trackListContainer">
        <ul class="trackList">
            <?php 
                $songsIdArray = $playlist->getSongsIds();
                $i = 1;

                foreach($songsIdArray as $songId) {
                    $playlistSong = new Song($con, $songId);
                    $songArtist = $playlistSong->getArtist();

                    echo 
                    "<li class='tracklistRow'>
                        <div class='trackCount'>
                            <img class='play' src='assets/images/icon/play-white.png' onclick='setTrack(\"" . $playlistSong->getId() . "\", tempPlaylist, true)'>
                            <span class='trackNumber'>$i</span>
                        </div>
                        <div class='trackInfo'>
                            <span class='trackName'>" . $playlistSong->getTitle() . "</span>
                            <span class='artistName'>" . $songArtist->getName() . "</span>
                        </div>
                        <div class='trackOptions'>
                            <input type='hidden' class='songId' value='".$playlistSong->getId() . "'>
                            <img class='optionsButton' src='assets/images/icon/more.png' onclick='showOptionMenu(this)'>
                        </div>
                        <div class='trackDuration'>
                            <span class='duration'>" . $playlistSong->getDuration() . "</span>
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
    <div class="item" onclick="removeFromPlaylist(this, '<?php echo $playlistId; ?>')">Remove song</div>
</nav>