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
<h2>Repository Listing</h2>

<input type="button" class="button-new" value="Create Repository" onclick="window.location='<?php echo BASEURL?>/do/repos_new.php'"/>
<br />

<table class="listing">
<tr>
	<th>Repository</th>
	<th>Type</th>
	<th>URI</th>
	<?php if (isAdmin()) : ?>
	<th>&nbsp;</th>
	<?php endif; ?>
</tr>
<?php
	$repos = $this->repos;
	if (count($repos) < 1)
	{
		$span = (isAdmin() ? 4 : 3);
		echo '<tr><td colspan="'.$span.'"><p>This list is empty</p></td></tr>';
	}

	foreach ($repos as $repo => $type)
	{
		$obj = repo_Factory::getInstance($type, $repo);

		echo '<tr>
		<td>'.htmlspecialchars($repo).'</td>
		<td>'.strtoupper($type).'</td>
		<td><small>'.$obj->getUrl().'</small></td>';

		if (isAdmin())
		{
			echo '<td><a href="'.BASEURL.'/do/repos_edit.php?repo='.urlencode($repo).'&type='.urlencode($type).'">View</a></td>';
		}

		echo '</tr>';
	}
?>
</table>



<br />
<br />

<h2>Trashed Repositories</h2>

<p>To recover any of the trashed repositories you must gain access to the shell and move them manually.</p>

<table class="listing">
<tr>
	<th>Repository</th>
	<?php if (isAdmin()) : ?>
	<th>Delete</th>
	<?php endif; ?>
</tr>
<?php
	$trashed = $this->trashed;
	if (count($trashed) < 1)
	{
		$span = (isAdmin() ? 2 : 1);
		echo '<tr><td colspan="'.$span.'"><p>This list is empty</p></td></tr>';
	}
	foreach ($trashed as $repo)
	{
		echo '<tr>
		<td>'.htmlspecialchars($repo).'</td>';

		if (isAdmin())
		{
			echo '<td><a onclick="if(confirm(\'Are you sure you want to delete this repository?\')) { window.location=\''.BASEURL.'/do/repos_delete_trash.php?repo='.urlencode($repo).'\';}" href="javascript:;">Delete</a></td>';
		}

		echo '</tr>';
	}
?>
</table>


