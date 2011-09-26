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
<h2>Access Control List</h2>
<br />
<br />
<table>
<tr>
	<td>
		<form action="<?php echo BASEURL; ?>/do/perm_save.php" method="post">
		<fieldset id="acl_config">

			<legend>ACL Config</legend>
			<div style="text-align:right;">
				<input type="submit" value="Save" />
			</div>

			<textarea id="acl_conf" name="acl_conf" style="width:500px;height:400px;" wrap="off"><?php echo htmlspecialchars($this->acl_conf); ?></textarea>

			<div style="text-align:right;">
				<input type="submit" value="Save" />
			</div>
		</fieldset>
		</form>
	</td>
	<td style="vertical-align:top;">
		<fieldset id="acl_config">
			<legend>Users</legend>
			<ul>
			<?php foreach($this->userList as $username)
			{
				echo '<li>'.$username.'</li>';
			} ?>
			</ul>
		</fieldset>
	</td>
</tr>
</table>


