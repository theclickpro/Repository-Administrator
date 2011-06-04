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
