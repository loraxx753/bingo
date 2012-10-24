<ul class="game_list">
<?php foreach($types as $type) { ?>
	<li><a href="/type/<?=$type->id?>"><?=$type->name?></a></li>
<?php } ?>