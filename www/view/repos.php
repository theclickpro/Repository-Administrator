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


