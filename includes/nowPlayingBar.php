<?php 
    $songQuery = mysqli_query($con, "SELECT * FROM songs ORDER BY RAND() LIMIT 10");
    $resultArray = array();
    
    while($row = mysqli_fetch_array($songQuery)) {
        array_push($resultArray, $row['id']);
    }

    $jsonArray = json_encode($resultArray);
?>


<script>
    $(document).ready(function() {
      var newPlaylist = <?php echo $jsonArray; ?>;
      audioElement = new Audio();
      setTrack(newPlaylist[0], newPlaylist, false);
      updateVolumeProgressBar(audioElement.audio);

        // prevent from default stuff highlighting
      $("#nowPlayingBarContainer").on("mousedown touchstart mousemove touchmove", function(e) {
          e.preventDefault();
      });
      
    //   console.log(currentPlaylist)

        $(".playbackBar .progressBar").mousedown(function() {
            mouseDown = true;
        });

        $(".playbackBar .progressBar").mousemove(function(e) {
            if(mouseDown) {
                //set time of song, depending on position of mouse
                timeFromOffset(e, this);
            } 
        });

        $(".playbackBar .progressBar").mouseup(function(e) {
            timeFromOffset(e, this);
        });


        /// volume bar stuff
        $(".volumeBar .progressBar").mousedown(function() {
            mouseDown = true;
        });

        $(".volumeBar .progressBar").mousemove(function(e) {
            
            if(mouseDown) {
               var percentage = e.offsetX / $(this).width();

               if(percentage >=0 && percentage <=1) {
                    audioElement.audio.volume = percentage;
               }
            } 
        });

        $(".volumeBar .progressBar").mouseup(function(e) {
            var percentage = e.offsetX / $(this).width();

               if(percentage >=0 && percentage <=1) {
                    audioElement.audio.volume = percentage;
               }
        });

        $(document).mouseup(function() {
            mouseDown = false;
        });
    });

function timeFromOffset(mouse, progresBar){
    var percentage = mouse.offsetX / $(progresBar).width() * 100;
    var seconds = audioElement.audio.duration * (percentage / 100);
    audioElement.setTime(seconds);
}

function previousSong() {

    if(audioElement.audio.currentTime >=3 || currentIndex == 0) {
        audioElement.setTime(0);
    } else {
        currentIndex--;
        setTrack(currentPlaylist[currentIndex], currentPlaylist, true);
    }
}

function nextSong() {

    if(repeat) {
        audioElement.setTime(0);
        playSong();
        return;
    }
    // not last song
    if(currentIndex == currentPlaylist.length - 1) {
        currentIndex = 0;
    } else {
        currentIndex++;
    }

    var trackToPlay = shuffle ? shufflePlaylist[currentIndex]:currentPlaylist[currentIndex];
    setTrack(trackToPlay, currentPlaylist, true);
}

function setRepeat() {
    repeat = !repeat;
    var imageName = repeat ? "repeat-active.png":"repeat.png";
    $(".controlButton.repeat img").attr("src", "assets/images/icon/" + imageName);
}

function setMute() {
    audioElement.audio.muted = !audioElement.audio.muted;
    var imageName = audioElement.audio.muted ? "volume-mute.png":"volume.png";
    var imageTitle = audioElement.audio.muted ? "unmute":"mute";
    
    $(".controlButton.volume img").attr("src", "assets/images/icon/" + imageName);
    $(".controlButton.volume img").attr("title", imageTitle);
}

function setShuffle() {
    shuffle = !shuffle;
    var imageName = shuffle ? "shuffle-active.png":"shuffle.png";
    var imageTitle = audioElement.audio.muted ? "unmute":"mute";
    $(".controlButton.shuffle img").attr("src", "assets/images/icon/" + imageName);

    if(shuffle) {
        // randomize playlist
        shuffleArray(shufflePlaylist);
        currentIndex = shufflePlaylist.indexOf(audioElement.currentlyPlaying.id);

    } else {
        //shuffle has been deactivated
        //go back to regularplaylist
        currentIndex = currentPlaylist.indexOf(audioElement.currentlyPlaying.id);
    }
}

function shuffleArray(a) {
    var j, x, i;
    for (i = a.length - 1; i > 0; i--) {
        j = Math.floor(Math.random() * (i + 1));
        x = a[i];
        a[i] = a[j];
        a[j] = x;
    }
    // return a;
}

function setTrack(trackId, newPlaylist, play) {
    
    if(newPlaylist != currentPlaylist) {
        currentPlaylist = newPlaylist;
        shufflePlaylist = currentPlaylist.slice();
        shuffleArray(shufflePlaylist);
    }

    if(shuffle) {
        currentIndex = shufflePlaylist.indexOf(trackId);
    } else {
        currentIndex = currentPlaylist.indexOf(trackId);
    }
    pauseSong();
    
    $.post("includes/handlers/ajax/getSongJson.php", { songId:trackId }, function(data) {
        
        // see above we passed tarckId
        var track = JSON.parse(data);
        // console.log(track);
        $(".trackInfo .trackName span").text(track.title);
        

        // get artist via ajax call via id of artist
        $.post("includes/handlers/ajax/getArtistJson.php", { artistId:track.artists }, function(data) {
            var artist = JSON.parse(data);
            // console.log(artist);
            $(".trackInfo .artistName span").text(artist.name);
            $(".trackInfo .artistName span").attr("onclick", "openPage('artist.php?id=" + artist.id+ "')");
        });

        // get album-> artwork via ajax call via id of artist
        $.post("includes/handlers/ajax/getAlbumJson.php", { albumId:track.album }, function(data) {
            var album = JSON.parse(data);
            // console.log(album);
            $(".content1 .albumLink img").attr("src", album.artworkPath);
            $(".content1 .albumLink img").attr("onclick", "openPage('album.php?id=" + album.id+ "')");
            $("trackInfo .trackName span").attr("onclick", "openPage('album.php?id=" + album.id+ "')");
        });


        audioElement.setTrack(track);
        // playSong();
        if(play) {
            playSong();
        }
    });
}

function playSong() {

    if(audioElement.audio.currentTime == 0) {
        // console.log("Updated time");
        $.post("includes/handlers/ajax/updatePlays.php", {songId:audioElement.currentlyPlaying.id});
    } 

    $(".controlButton.play").hide();
    $(".controlButton.pause").show();
    audioElement.play();
}

function pauseSong() {
    $(".controlButton.play").show();
    $(".controlButton.pause").hide();
    audioElement.pause();
}

</script>

<div id="nowPlayingBarContainer">
    <div id="nowPlayingBar">
        <div id="nowPlayingLeft">
            <div class="content1">
                <span class="albumLink">
                    <img role="link" tabindex="0" src="assets/images/placeholder.jpg" class="albumArtWork" alt="placeholder">
                </span>
                <div class="trackInfo">
                    <span class="trackName">
                        <span role="link" tabindex="0" ></span>
                    </span>
                    <span class="artistName">
                        <span role="link" tabindex="0" ></span>
                    </span>
                </div>
            </div>
        </div>
        <div id="nowPlayingCenter">
            <div class="content playerControls">
                <div class="buttons">
                    <button class="controlButton shuffle" title="Shuffle " onclick="setShuffle()">
                        <img src="assets/images/icon/shuffle.png" alt="Shuffle">
                    </button>
                    <button class="controlButton previous" title="Previous " onclick="previousSong()">
                        <img src="assets/images/icon/previous.png" alt="previous">
                    </button>
                    <button class="controlButton play" title="Play" onclick="playSong()">
                        <img src="assets/images/icon/play.png" alt="play">					
                    </button>
                    <button class="controlButton pause" title="Pause" style="display:none;" onclick="pauseSong()">
                        <img src="assets/images/icon/pause.png" alt="pause">
                    </button>
                    <button class="controlButton next" title="Next " onclick="nextSong()">
                        <img src="assets/images/icon/next.png" alt="next">
                    </button>
                    <button class="controlButton repeat" title="Repeat" onclick="setRepeat()">
                        <img src="assets/images/icon/repeat.png" alt="repeat">
                    </button>
                </div>
                <div class="playbackBar">
                    <span class="progressTime current">0.00</span>
                    <div class="progressBar">
                        <div class="progressBarBg">
                            <div class="progress"></div>
                        </div>
                    </div>
                    <span class="progressTime remaining">0.00</span>
                </div>
            </div>
        </div>
        <div id="nowPlayingRight">
            <div class="volumeBar">
                <button class="controlButton volume" title="mute" onclick="setMute()">
                    <img src="assets/images/icon/volume.png" alt="Volume">
                </button>
                <div class="progressBar">
                    <div class="progressBarBg">
                        <div class="progress"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>