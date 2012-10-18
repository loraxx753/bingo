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
	<p><label>Username: </label> <input type="text" name="username" <?=(isset($login_error)) ? "value='$username'" : '' ?> /></p>
	<p><label>Password: </label> <input type="password" name="password" /></p>
	<p><input type="submit" name="login" value="Login" /></p>
</form>