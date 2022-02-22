<?php 
include("includes/includedfiles.php");

if (isset($_GET['id'])){
    $currentPlaylist = $playlists->getPlaylist($_GET['id']);
}
else {

    if (sizeof($playlistsAll) > 0){
        $currentPlaylist = $playlistsAll[0];
    }else{
        $currentPlaylist =array();
    }
}

?>
<div id="MusicPage">
<?php if (sizeof($currentPlaylist) <= 0){
        echo "No Playlists";
        exit();
    }?>
    <div class="PlaylistViewContainer">
        <div class="PlaylistView">
        <h1> <?php echo $currentPlaylist['playlistname'] ?></h1>
        <div class='tracklistContainer'>
            <ul class='tracklist'>
                <?php $SongArray = $playlists->getSongs($currentPlaylist['playlistid']);
                                if (sizeof($SongArray) > 0){
                                    include('includes/Tracks.php');
                                }
                                else{
                                    echo "No Songs";
                                }
                            ?>
            </ul>
        </div>
        </div>
    </div>
    <div class="PlaylistsContainer">
        <h2>Playlists</h2>
        <div class="Playlists">
            <?php 
            foreach($playlists->getPlaylists() as $playlist){
                echo "
                    <div onclick='openPage(\"yourMusic.php?id=" . $playlist['playlistid'] . "\")' class = 'playlist' data-playlistid = '".$playlist['playlistid']."'>
                        <img src = 'assets/images/artwork/clearday.jpg'></img>
                        <div class = 'details'>
                            <h3>".$playlist['playlistname']. "</h3>
                            <p>".$playlist['SongNumber']." Songs</p>
                        </div>
                        
                    </div>";
            }
        ?>
        </div>
    </div>
</div>
<script>
function showPlaylist(target){
    let PlaylistId = target.getAttribute("data-playlistid");
    openPage("yourMusic.php");
}

</script>