<?php
include("includes/includedfiles.php");


if(isset($_GET['id'])) {
	$albumId = $_GET['id'];
}
else {
	header("Location: index.php");
}
$album = new Albums($con, $_GET['id']);
$artist = $album->getArtist();
$artistId = $artist->getId();
?>

<div id="AlbumPage">
	<div class="entityInfo">

		<div class="leftSection">
			<img src="<?php echo $album->getcoverArt(); ?>">
		</div>

		<div class="rightSection">
			<h2><?php echo $album->getTitle(); ?></h2>
			<p role="link" tabindex="0" onclick="openPage('artist.php?id=<?php echo $artistId; ?>')">By
				<?php echo $artist->getName(); ?></p>
			<p><?php echo $album->getNumberOfSongs(); ?> songs</p>

		</div>

	</div>
	<div class="tracklistContainer">
		<ul class="tracklist">
			<?php
				$SongArray = $album->getSongIds();
				include("includes/Tracks.php")
			?>
		</ul>
	</div>
</div>
