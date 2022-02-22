<?php
include("includes/includedFiles.php");

if(isset($_GET['id'])) {
	$artistId = $_GET['id'];
}
else {
	header("Location: index.php");
}

$artist = new Artist($con, $artistId);
?>

<div class="entityInfo borderBottom">

	<div class="centerSection">

		<div class="artistInfo">

			<h1 class="artistName"><?php echo $artist->getName(); ?></h1>

			<div class="headerButtons">
				<button class="button green" onclick="playFirstSong()">PLAY</button>
			</div>

		</div>

	</div>

</div>


<div class="tracklistContainer borderBottom">
	<h2>SONGS</h2>
	<ul class="tracklist">
		
		<?php
		$SongArray = $artist->getSongIds();
        include("includes/Tracks.php")
		?>


	</ul>
</div>

<div class="AlbumsContainer">
	<h2>ALBUMS</h2>
	<?php
		$albumQuery = mysqli_query($con, "SELECT * FROM album WHERE artistid='$artistId'");

		while($row = mysqli_fetch_array($albumQuery)) {
			



			echo "<div class='gridViewItem'>
					<span role='link' tabindex='0' onclick='openPage(\"album.php?id=" . $row['albumid'] . "\")'>
						<img src='" . $row['coverart'] . "'>

						<div class='AlbumInfo'>"
							. $row['albumname'] .
						"</div>
					</span>

				</div>";



		}
	?>

</div>
