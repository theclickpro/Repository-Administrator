<h2>User Listing</h2>

<br />
<input type="button" class="button-new" value="Create User" onclick="window.location='<?php echo BASEURL?>/do/users_new.php'"/>
<br />
<br />

<table class="listing">
<tr>
	<th>Username</th>
	<th>Admin</th>
	<?php if (isAdmin()) : ?>
	<th>Edit</th>
	<th>Delete</th>
	<?php endif; ?>
</tr>
<?php
	$users = $this->users;
	if (count($users) < 1)
	{
		$span = (isAdmin() ? 4 : 2);
		echo '<tr><td colspan="'.$span.'"><p>This list is empty</p></td></tr>';
	}
	foreach ($users as $row)
	{
		$is_admin = ($row['admin'] == 1 ? 'Yes' : 'No');

		echo ' <tr>
		<td>'.htmlspecialchars($row['username']).'</td>
		<td>'.$is_admin.'</td>';

		if (isAdmin())
		{
			echo '<td><a href="'.BASEURL.'/do/users_edit.php?username='.urlencode($row['username']).'">Edit</a></td>';
			echo '<td><a onclick="if (confirm(\'Are you sure you want to delete user '.htmlspecialchars($row['username']).'\')){ window.location=\''.BASEURL.'/do/users_delete.php?username='.urlencode($row['username']).'\'; }" href="javascript:;">Delete</a></td>';
		}
		echo '</tr>';
	}
?>
</table>

