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

<form action="<?php echo BASEURL?>/do/repos_create.php" method="post">
<table class="form">
	<tr>
		<td colspan="2"><p>You are about to create a new repository.  A repository name must be provided. Allowed characters are:</p>
			<ul>
				<li>Lower case letters, characters from a...z</li>
				<li>Upper case letters, characters from A...Z</li>
				<li>Numbers</li>
				<li>Underscore (_)</li>
				<li>Dash (-)</li>
				<li>Period (.)</li>
			</ul>
		</td>
	</tr>
	<tr>
			<?php
			$types = repo_Factory::getAvailableTypes();
			if (count($types) > 1)
			{
				echo '<th>Repository Type:</th>
					<td>
				';
				$i = 0;
				foreach ($types as $type)
				{
					$i++;
					echo '<label for="type'.$i.'"><input type="radio" name="type" id="type'.$i.'" value="'.$type.'" />'.strtoupper($type).'</label><br />'."\n";
				}

				echo '</td>';
			}
			else
			{
				$type = $types[0];
				echo '<td coslpan="2">&nbsp;<input type="hidden" value="'.$type.'" name="type" /></td>';
			}
			?>
	</tr>
	<tr>
		<td colspan="2">&nbsp;</td>
	</tr>
	<tr>
		<th>Repository Name:</th>
		<td>
			<input type="text" name="repo" value="<?php echo $this->repo?>" />
		</td>
	</tr>

	<tr>
		<td colspan="2" style="text-align:right;"><input type="submit" value="Create"/></td>
	</tr>
</table>
</form>

