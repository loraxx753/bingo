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
<form action="/user/register" method="post" id="register">
	<ul>
		<li><label>Username: </label> <input type="text" name="username" /></li>
		<li><label>Password: </label> <input type="password" name="password" /></li>
		<li><label>Re-type Password: </label> <input type="password" name="password2" /></li>
		<li><label>Email: </label> <input type="text" name="email" /></li>
		<li><input type="submit" name="register" value="Register" /></li>
	</ul>
</form>