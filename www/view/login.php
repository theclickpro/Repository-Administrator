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
*/
?>
<br />
<br />
<br />
<br />
<form action="<?php echo BASEURL?>/do/dologin.php" method="post">
<table class="form">
	<tr>
		<th>Username:</th>
		<td><input type="text" value="" name="username" /></td>
	</tr>
	<tr>
		<th>Password:</th>
		<td><input type="password" value="" name="password" /></td>
	</tr>

	<tr>
		<td colspan="2" style="text-align:right;"><input type="submit" value="Login" /></td>
	</tr>
</table>
</form>
