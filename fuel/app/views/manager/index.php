<h2>Welcome to Need My Bingo</h2>

<p>Need My Bingo is a way to make your own bingo boards on the fly and use them (for let's say a class)</p>
<h3>Categories</h3>
<p>These are the different categories to choose from in order to find a game, or make your own.</p>
<?php foreach($categories as $category) { ?>
	<h4><?=$category->name?></h4>
	<ul class="game_list">
		<?php for($x=1; $x<6; $x++) { 
			if(!isset($category->types[$x])) 
				break;
		?>
		<li><a href="/type/<?=$category->types[$x]->id?>"><?=$category->types[$x]->name?></a></li>
		<?php } ?>
		<?php if(count($category->types) > 6) {?>
		<p><a href="/category/<?=$category->id?>"><?=$category->name?></a></p>
		<?php } ?>
	</ul>
<?php } ?>