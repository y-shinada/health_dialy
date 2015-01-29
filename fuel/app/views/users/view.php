<h2>Viewing <span class='muted'>#<?php echo $user->id; ?></span></h2>

<p>
	<strong>Login id:</strong>
	<?php echo $user->login_id; ?></p>
<p>
	<strong>Password:</strong>
	<?php echo $user->password; ?></p>
<p>
	<strong>Name:</strong>
	<?php echo $user->name; ?></p>
<p>
	<strong>Deleted at:</strong>
	<?php echo $user->deleted_at; ?></p>
<p>
	<strong>Deleted:</strong>
	<?php echo $user->deleted; ?></p>

<?php echo Html::anchor('users/edit/'.$user->id, 'Edit'); ?> |
<?php echo Html::anchor('users', 'Back'); ?>