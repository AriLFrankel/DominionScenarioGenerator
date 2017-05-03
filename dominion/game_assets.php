<?php 
include("inc/cards.php");
$pageTitle = "Game Assets";
include("inc/header.php");
?>


<div class="content__game_assets col-sm-10 col-sm-offset-1">
	<ul style="list-style-type:none">
		<?php foreach ($decks as $key => $value) {
			echo "<li class='game_assets_link'><a href='downloads/". $value .".pdf' download = '".ucwords($value)." rules.pdf'>".ucwords($value)." Game Assets</a></li>"
			;}?>
	</ul>
</div>
