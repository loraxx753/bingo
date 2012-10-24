<div id="admin">
	<h2>Admin Panel</h2>

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

	<p>Welcome to the Admin Panel. Access different options below.</p>

	<h3 class="inline">Manage Catagories</h3>
	<form class="inline" action="admin/category/add" method="post">
		<ul class="inline">
			<li class="inline"><label for="name">Add: </label><input type="text" id="name" name="name"/><input type="submit" value="Add"/></li>
		</ul>
	</form>
	<ul>
	<?php foreach ($catagories as $category) { ?>
		<li><?=$category->name?>
			<ul>
				<li><a href="/admin/category/delete/<?=$category->id?>">Remove</a></li>
			</ul>
		</li>
		<?php } ?>
	</ul>

	<h3>Manage Users</h3>
	<table class="user_table">
		<tr>
			<th>Username</th>
			<th>Email</th>
			<th>Role</th>
			<th>Options</th>
		</tr>
	<?php foreach ($users as $user) { ?>
		<tr>
			<td class="user"><?=$user->username?></td> 
			<td class="email"><?=$user->email?></td>
			<td><?=Inflector::singularize($groups[$user->group]['name'])?></td>
			<td>
			<?php if($user->group < 100) { ?>
				<a href="#">Ban</a>
				<a href="#">Promote</a>
			<?php } ?>
				<a href="#">Demote</a>
				<a href="#">Reset Password</a>
			</td>
		</tr>
		<?php } ?>
	</table>
</div>