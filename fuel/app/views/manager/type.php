<h2><?=$type?></h2>
<ul class="games">
	<li>There <?=(count($games) == 1) ? "is ".count($games)." game " : "are ".count($games)." games "?>in progress</li>
	<li><a href="/game/create/<?=$type_id?>">Create Game</a></li>
</ul>
<?php 
if(count($games) > 0) { 
	echo "<ul class='game_list'>";
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