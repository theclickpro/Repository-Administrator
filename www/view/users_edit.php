<?php
	$row = $this->row;
?>
<form method="post" action="<?php echo BASEURL?>/do/users_save.php">
<table class="form">
	<tr>
		<th>Username:</th>
		<td>
			<input type="text" disabled="disabled" name="username_view" value="<?php echo htmlspecialchars($row['username'])?>" />
			<input type="hidden" name="username" value="<?php echo htmlspecialchars($row['username'])?>" />
		</td>
	</tr>
	<tr>
		<th>Password:</th>
		<td><input type="password" name="password" value="" /></td>
	</tr>
	<tr>
		<th>Confirm Password:</th>
		<td><input type="password" name="password_confirm" value="" /></td>
	</tr>

	<?php if ( isAdmin() ) : ?>
	<tr>
		<th>Admin:</th>
		<td><input type="checkbox" name="admin" value="1" <?php if ($row['admin'] == 1) echo ' checked="checked" '; ?><?php
			if ($row['username'] == $_SESSION['sess']['username'])
			{
				echo ' disabled="disabled" ';
			}
		?>/></td>
	</tr>
	<?php endif; ?>
	<tr>
		<td colspan="2" style="text-align:right;"><input type="submit" value="Save" /></td>
	</tr>
</table>
</form>
