<?php
/*
Copyright 2011 Ricardo Ramirez, The ClickPro.com LLC

This file is part of Repository Administrator.

Repository Administrator is free software: you can redistribute it and/or modify
it under the terms of the GNU General Public License as published by
the Free Software Foundation, either version 3 of the License, or
(at your option) any later version.

Repository Administrator is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with Repository Administrator.  If not, see <http://www.gnu.org/licenses/>.
*/?>
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
