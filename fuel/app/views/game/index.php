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

	<table border="1">
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
</section>
<aside>
	<h3>People Currently Playing:</h3>
	<ul>
		<li><a href="/game/leave/<?=Uri::segment(3)?>">Leave Game</a></li>
	</ul>

	<ul id="players">
		<?php foreach ($players as $player) { ?>
		<li><?=$player?></li>
		<?php } ?>
	</ul>
</aside>
