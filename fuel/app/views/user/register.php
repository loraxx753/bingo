<?php if(isset($error) > 0) { ?>
<ul class="error">
	<?php foreach($error as $item) { ?>
	<li><?=$item;?></li>
	<?php } ?>
</ul>
<?php } ?>
<?php if(isset($success)) { ?>
	<ul class="success">
		<li><?=$success?></li>
	</ul>
<?php } ?>
<form action="/user/register" method="post">
	<p><label>Username: </label> <input type="text" name="username" /></p>
	<p><label>Password: </label> <input type="password" name="password" /></p>
	<p><label>Re-type Password: </label> <input type="password" name="password2" /></p>
	<p><label>Email: </label> <input type="text" name="email" /></p>
	<p><input type="submit" name="register" value="Register" /></p>
</form>