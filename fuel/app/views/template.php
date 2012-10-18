<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title><?php echo $title; ?></title>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>
	<script>

		function heartbeat() {
			hash = document.URL.split('/').pop();
			$.post('/game/update/'+hash, function(data) {
				console.log(data.moves);
				lis = '';
				for(i in data.players)
				{
					lis += "<li>"+data.players[i]+"</li>";
				}
				$('#players').html(lis);
				$('.selected').removeClass('selected');
				for(i in data.moves)
				{
					if($('td[data-square='+data.moves[i]+']').length > 0)
					{
						var td = $('td[data-square='+data.moves[i]+']');
						row = td.data('row');
						column = td.data('column');
						td.addClass('selected');
						chosen[row][column] = 1;
					}
				}
				if(!data.winner)
				{
					win_check();
				}
				else if(username != data.winner)
				{
					clearInterval(beat);
					alert(data.winner+" won!");
				}

			}, 'json');
		}

		function row_check() {
			win = true;
			for(i in chosen)
			{
				win = true;
				for(j in chosen[i])
				{
					if(chosen[i][j] == 0) {
						win = false;
					}
				}
				if(win == true) { break; }
			}
			return win;
		}
		function diagnoal_check_right() {
			win = true;
			for(i = 0; i < chosen.length; i++)
			{
				if(chosen[i][i] == 0)
				{
					win = false;
				}
			}
			return win;
		}
		function column_check() {
			win = true;
			for(i = 0; i < chosen.length; i++)
			{
				win=true;
				for(j = 0; j < chosen[i].length; j++)
				{
					if(chosen[j][i] == 0)
					{
						win = false;
					}
				}
				if(win == true) { break; }
			}
			return win;
		}
		function diagnoal_check_left() {
			win = true;
			for(i = chosen.length-1; i >= 0; i--)
			{
				if(chosen[chosen.length - 1 - i][i] == 0)
				{
					win = false;
				}
			}
			return win;
		}
		function win_check() {
			if(row_check() || column_check() || diagnoal_check_left() || diagnoal_check_right())
			{
				hash = document.URL.split('/').pop();
				$.post('/game/winner/'+hash, { 'winner' : username }, function() {
					alert('You are the winner!');
				});
			}
		}
		username = "<?=Session::get('username')?>";
		chosen = Array(
			Array(0,0,0,0,0), 
			Array(0,0,0,0,0), 
			Array(0,0,0,0,0),
			Array(0,0,0,0,0), 
			Array(0,0,0,0,0)
		);

		$(document).ready(function() {
			heartbeat();
			beat = setInterval(heartbeat, 1000);
			$('td').each(function() {
				row = $(this).data('row');
				column = $(this).data('column');
				if(chosen[row][column] == 1)
				{
					$(this).addClass('selected');
				}
			});
			$('td').click(function () {
				clearInterval(beat);
				row = $(this).data('row');
				column = $(this).data('column');
				square = $(this).data('square');
				if(!$(this).hasClass('selected'))
				{
					$(this).addClass('selected');
					chosen[row][column] = 1;
					hash = document.URL.split('/').pop();
					$.post('/game/move/'+hash, {'square' : square});
				}
				else
				{
					$(this).removeClass('selected');
					chosen[row][column] = 0;
					$.post('/game/unmove/'+hash, {'square' : square});
				}
				beat = setInterval(heartbeat, 1000);

			});
		});
	</script>
	<style>
		td {
			width: 150px;
			height: 150px;
			text-align: center;
			font-weight: bold;
		}
		table {
			border-collapse: collapse;
			margin: 0 auto;
		}
		.selected {
			background: #A00;
		}
	</style>
</head>
<body>
	<div class="container">
		<div class="row">
			<div class="span16">
				<h1><?php echo $title; ?></h1>
				<hr>
<?php if (Session::get_flash('success')): ?>
				<div class="alert-message success">
					<p>
					<?php echo implode('</p><p>', e((array) Session::get_flash('success'))); ?>
					</p>
				</div>
<?php endif; ?>
<?php if (Session::get_flash('error')): ?>
				<div class="alert-message error">
					<p>
					<?php echo implode('</p><p>', e((array) Session::get_flash('error'))); ?>
					</p>
				</div>
<?php endif; ?>
			</div>
			<div>
			<p>User: <?=Session::get('username')?></p>
			<p><a href="/user/logout">Logout</a></p>

<?php echo $content; ?>
			</div>
		</div>
		<footer>
		</footer>
	</div>
</body>
</html>
