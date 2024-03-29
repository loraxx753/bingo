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
		if(determined == false && data.winner != false)
		{
			determined = true;
			if(username != data.winner)
			{
				end_game(data.winner+" won!");
			}
			else
			{
				end_game("You are the winner!");
			}
		}
		if(data.chat != false)
		{
			if(prev_chat.length < data.chat.length)
			{
				$('#chat').html(data.chat.join(''));
				$("#chat").animate({ scrollTop: $("#chat")[0].scrollHeight });
			}
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
		winner = true;
		$.post('/game/winner/'+hash, { 'winner' : username }, function() {
			end_game('You are the winner!');
		});
	}
}

function end_game(wintext){
	$('table').before("<p class='wintext'>"+wintext+"</p>");
	$('td').unbind('click');
}
chosen = Array(
	Array(0,0,0,0,0), 
	Array(0,0,0,0,0), 
	Array(0,0,0,0,0),
	Array(0,0,0,0,0), 
	Array(0,0,0,0,0)
);
determined = false;
var prev_chat = Array();

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
		win_check();
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
				prev_chat = data;
				$('#chat').html(data.join(''));
				$("#chat").animate({ scrollTop: $("#chat")[0].scrollHeight });
			}, 'json');
		}
	});
});
