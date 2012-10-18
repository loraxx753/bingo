<p>There are <?=count($games)?> games in progress</p>

<?php 
if(count($games) > 0) { 
	echo "<ul>";
	$count = 1;
	foreach($games as $game) {
	?>
	<li>Game <?=$count++?> 
		<?php if($game->winner) { ?>
		<a href="/game/play/<?=Crypt::encode($game->id)?>">View Completed Game</a>
		<?php } else { ?>
		<?=(in_array(Session::get('username'), $game->players)) ? '<a href="/game/play/'.Crypt::encode($game->id).'">Resume Game</a>' : '<a href="/game/join/'.Crypt::encode($game->id).'">Join Game</a>'?> </li>
	<?php } 
	}
	echo "</ul>";
}?>


<p><a href="game/create">Create Game</a></p>
