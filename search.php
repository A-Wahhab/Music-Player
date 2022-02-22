<?php
include("includes/includedFiles.php");

if(isset($_GET['term'])) {
	$term = urldecode($_GET['term']);
}
else {
	$term = "";
}
?>

<div class="searchContainer">

	<h4>Search for an artist, album or song</h4>
	<input type="text" class="searchInput" value="<?php echo $term; ?>" placeholder="Start typing..." onfocus="this.value = this.value">

</div>

<script>

$(".searchInput").focus();

$(function() {
	
	$(".searchInput").keyup(function() {
		clearTimeout(timer);

		timer = setTimeout(function() {
			var val = $(".searchInput").val();
			openPage("search.php?term=" + val);
		}, 2000);

	})


})

</script>

<?php if($term == "") exit(); ?>

<div class="tracklistContainer borderBottom">
	<h2>SONGS</h2>
	<ul class="tracklist">
		
		<?php
		$songsQuery = mysqli_query($con, "SELECT songsid FROM songs WHERE title LIKE '$term%' LIMIT 10");

		if(mysqli_num_rows($songsQuery) == 0) {
			echo "<span class='noResults'>No songs found matching " . $term . "</span>";
		}else {
            $SongArray = array();
            $i = 1;
            while($row = mysqli_fetch_array($songsQuery)) {
    
                if($i > 15) {
                    break;
                }    
                array_push($SongArray, $row["songsid"]);    
                $i++;
            }
            include("includes/Tracks.php");    
        }

		?>
	</ul>
</div>


<div class="artistsContainer borderBottom">

	<h2>ARTISTS</h2>

	<?php
	$artistsQuery = mysqli_query($con, "SELECT artistid FROM artist WHERE artistname LIKE '$term%' LIMIT 10");
	
	if(mysqli_num_rows($artistsQuery) == 0) {
		echo "<span class='noResults'>No artists found matching " . $term . "</span>";
	}
    else {
        while($row = mysqli_fetch_array($artistsQuery)) {

            $artistFound = new Artist($con, $row['artistid']);
    
            echo "<div class='searchResultRow'>
                    <div class='artistName'>
    
                        <span role='link' tabindex='0' onclick='openPage(\"artist.php?id=" . $artistFound->getId() ."\")'>
                        "
                        . $artistFound->getName() .
                        "
                        </span>
    
                    </div>
    
                </div>";
    
        }
    
    }


	?>

</div>

<div class="AlbumsContainer">
	<h2>ALBUMS</h2>
	<?php
		$albumQuery = mysqli_query($con, "SELECT * FROM album WHERE albumname LIKE '$term%' LIMIT 10");

		if(mysqli_num_rows($albumQuery) == 0) {
			echo "<span class='noResults'>No albums found matching " . $term . "</span>";
		}

		while($row = mysqli_fetch_array($albumQuery)) {

			echo  "<div role='link' tabindex='0' onclick='openPage(\"album.php?id=" . $row['albumid'] . "\")' class='Album'>
                        <img src='" . $row['coverart'] . "'>
                        <div class='AlbumInfo'>"
                            . $row['albumname'] .
                        "</div>
                </div>";



		}
	?>

</div>









