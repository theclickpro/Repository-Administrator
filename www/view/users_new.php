<form method="post" action="<?php echo BASEURL?>/do/users_create.php">
<table class="form">
	<tr>
		<th>Username:</th>
		<td>
			<input type="text" name="username" value="<?php echo htmlspecialchars($this->username)?>" />
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

	<tr>
		<th>Admin:</th>
		<td><input type="checkbox" name="admin" value="1" <?php if (@$_POST['admin'] == 1) echo ' checked="checked" '; ?> /></td>
	</tr>
	<tr>
		<td colspan="2" style="text-align:right;"><input type="submit" value="Save" /></td>
	</tr>
</table>
</form>
