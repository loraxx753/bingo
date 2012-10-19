function heartbeat() {
	hash = document.URL.split('/').pop();
	$.post('/game/update/'+hash, function(data) {
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
	$('#chat_input').keypress(function(e) {
		if(e.which == 13)
		{
			$this = $(this);
			text = $(this).val();
			hash = document.URL.split('/').pop();
			$.post('/game/chat/'+hash, {'text' : text}, function(data) {
				$this.val('');
				$('#chat').html(data);
			});
		}
	});
});
