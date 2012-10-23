<?php if($error = Session::get_flash('error')) { ?>
<ul class="error">
	<?php foreach($error as $item) { ?>
	<li><?=$item;?></li>
	<?php } ?>
</ul>
<?php } ?>
<?php if($success = Session::get_flash('success')) { ?>
	<ul class="success">
	<?php foreach($success as $item) { ?>
	<li><?=$item;?></li>
	<?php } ?>
	</ul>
<?php } ?>

<?php $info = Session::get_flash('info'); ?>
<form action="/user/register" method="post" id="register">
	<ul>
		<li><label>Username: </label> <input type="text" name="username" <?=($info) ? 'value="'.$info['username'].'"' : '' ?> /></li>
		<li><label>Password: </label> <input type="password" name="password" /></li>
		<li><label>Re-type Password: </label> <input type="password" name="password2" /></li>
		<li><label>Email: </label> <input type="text" name="email" <?=($info) ? 'value="'.$info['email'].'"' : '' ?>/></li>
		<li><input type="submit" name="register" value="Register" /></li>
	</ul>
</form>