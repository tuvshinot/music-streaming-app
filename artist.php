<?php
    include("includes/includedFiles.php");

    if(isset($_GET['id'])) {
        $artistId = $_GET['id'];
    } else {
        header("Location : index.php");
    }

    $artist = new Artist($con, $artistId);

?>

<div class="entityInfo borderBottom">
    <div class="centerSection">
        <div class="artistInfo">
            <h1 class="artistName"><?php echo $artist->getName();?></h1>

            <div class="headerButtons">
                <button class="button green" onclick="playFirstSong()">Play</button>
            </div>
        </div>
    </div>
</div>

<div class="trackListContainer borderBottom">
    <h2>Songs</h2>
        <ul class="trackList">
            <?php 
                $songsIdArray = $artist->getSongsIds();
                $i = 1;

                foreach($songsIdArray as $songId) {

                    if($i > 5) {
                        break;
                    }

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

<div class="gridViewContainer">
        <h2>Albums</h2>
	<?php 
		$albumQuery = mysqli_query($con, "SELECT * FROM albums WHERE artists='$artistId'");
		
		// get album from db
		while($row = mysqli_fetch_array($albumQuery)) {
			echo 
			"<div class='gridViewItem'>
			<span role='link' tabindex='0' onclick='openPage(\"album.php?id=" . $row['id'] . "\")'>
					<img src='" . $row['artworkPath'] . "'>
					<div class='gridViewInfo'>"
					. $row['title'] .
					"</div>
				</span>
			</div>";
		}
	?>
</div>


<nav class="optionMenu">
    <input type="hidden" class="songId">
    <?php echo Playlist::getPlaylistDropdown($con, $userLoggedIn->getUsername()); ?>
    <div class="item">item 2</div>
    <div class="item">item 3</div>
</nav>