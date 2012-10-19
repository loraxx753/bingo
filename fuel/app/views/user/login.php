<div id="login">
	<?php if(isset($login_error) > 0) { ?>
	<ul class="error">
		<li><?=$login_error;?></li>
	</ul>
	<?php } ?>
	<?php if(isset($success)) { ?>
		<ul class="success">
			<li><?=$success?></li>
		</ul>
	<?php } ?>
	<form action="/user/login" method="post">
		<ul> 
			<li><input type="text" name="username" <?=(isset($login_error)) ? "value='$username'" : '' ?> placeholder="Username" /></li>
			<li><input type="password" name="password" placeholder="Password" /></li>
			<li><input type="submit" name="login" value="Login" /></li>
		</ul>
	</form>
</div>