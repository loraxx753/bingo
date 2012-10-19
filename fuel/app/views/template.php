<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title><?php echo $title; ?></title>
	<?=(isset($js)) ? Asset::js($js) : ''?>
	<script>
		username = "<?=Session::get('username')?>";
	</script>
<?=Asset::css(array('http://fonts.googleapis.com/css?family=Archivo+Narrow:400,700', 'game.css'))?>
</head>
<body>
	<header>
		<h1>Novatnak Bingo</h1>
		<ul>
		<?php if (Session::get('username')) { ?>
			<?php if(Uri::segment(1) == 'game' && Uri::segment(2) == 'play') { ?>
			<li class="leave"><a href="/game/leave/<?=Uri::segment(3)?>">Leave Game</a></li>
			<?php } ?>
			<li><?=Session::get('username')?></li>
			<li><a href="/user/logout">Logout</a></li>
		<?php } else { ?>
			<li><a href="/user/login">Login</a></li>
			<li><a href="/user/register">Register</a></li>
		<?php } ?>
		</ul>
	</header>

<?php echo $content; ?>
	<footer>
	</footer>
	</div>
</body>
</html>
