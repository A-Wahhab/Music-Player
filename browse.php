<?php
include("includes/includedfiles.php");

?>
<div id="mainPage">
<h1 class = "BrowseTitle"> You Might Like These Albums </h1>


<div class = "AlbumsContainer">
<?php
		$albumQuery = mysqli_query($con, "SELECT * FROM album ORDER BY RAND() LIMIT 10");

		while($row = mysqli_fetch_array($albumQuery)) {
			echo "<div role='link' tabindex='0' onclick='openPage(\"album.php?id=" . $row['albumid'] . "\")' class='Album'>
				
						<img src='" . $row['coverart'] . "'>
						<div class='AlbumInfo'>"
							. $row['albumname'] .
						"</div>
				</div>";
		}
	?>

</div>
</div>
