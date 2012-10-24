<?php if (isset($moves)) {
	echo "<script>";
	foreach($moves as $row => $columns)
	{
		foreach ($columns as $column => $value)
		{
			echo "chosen[$row][$column] = $value;\n";
		}
	}
	echo "</script>";
}?>
<section>
	<?php $row = 0; $column = 0; ?>

	<table class="game_board">
	<tr>
	<?php foreach($squares as $square)  { ?>
		<?php if($column > 4)
		{
			$row++;
			$column = 0;
			echo "</tr><tr>";
		}
		if($column == 2 && $row == 2) { echo "<td data-row='".$row."' data-column='".$column."'' data-square='free'>FREE SPACE</td>"; $column++;} ?>
		<td data-row='<?=$row?>' data-column='<?=$column?>' data-square="<?=$square->id?>"><?=$square->value?></td>
	<?php 
		$column++;
	} ?>
	</tr>
	</table>
</section><aside>
	<div id="current_players">
		<h3>People Currently Playing</h3>
		<ul id="players">
			<?php foreach ($players as $player) { ?>
			<li><?=$player?></li>
			<?php } ?>
		</ul>
	</div>
	<div id="chat">

	</div>
	<input type="text" name="chat_input" id="chat_input" placeholder="Start typing..." />
</aside>
