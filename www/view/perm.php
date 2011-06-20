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

<label><input type="checkbox" name="enable_acl" id="enable_acl" <?php if ($this->enable_acl) { echo ' checked="checked" '; } ?>/>Enable Access Control List</label>
<br />
<br />
<fieldset id="acl_config">
	<legend>ACL Config</legend>

	<h3>Groups</h3>
	<form action="<?php echo BASEURL?>/do/perm_group_add.php" method="post">
	<table><tr>
	<td><input type="text" name="group" value="" style="width:70px;" /></td>
	<td><input type="submit" value="Add" /></td>
	</tr></table>
	</form>
	<table class="listing">
	<tr>
		<th>Group</th>
		<th>Users</th>
	</tr>
	<?php
		$span = 2;
		$groupArr = $this->groupArr;
		if (count($groupArr) < 1)
		{
			echo '<tr><td colspan="'.$span.'"><p>This list is empty</p></td></tr>';
		}

		foreach ($groupArr as $group)
		{
			echo '<tr>
			<td>'.htmlspecialchars($group['group']).'
			<a onclick="return confirm(\'Are you sure you want to delete '.htmlspecialchars($group['group'], ENT_QUOTES).' group?\');" href="'.BASEURL.'/do/perm_group_del.php?group='.urlencode($group['group']).'" style="color:red;">(x)</a>
			</td>
			<td>
				<table>';
				foreach ($group['users'] as $user)
				{
					echo '<tr><td>'.htmlspecialchars($user).'</td><td>
			<a onclick="return confirm(\'Are you sure you want to remove user '.htmlspecialchars($user,ENT_QUOTES).' from '.htmlspecialchars($group['group'], ENT_QUOTES).' group?\');" href="'.BASEURL.'/do/perm_group_userdel.php?group='.urlencode($group['group']).'&username='.urlencode($user).'" style="color:red;">(x)</a></td></tr>';
				}

			echo'
				<tr>
					<td colspan="2">
						<form method="post" action="'.BASEURL.'/do/perm_group_useradd.php">
						<input type="hidden" name="group" value="'.$group['group'].'" />
						<select name="username">
						<option value=""> - </option>
						';
						foreach ($this->userList as $user)
						{
							if (in_array($user, $group['users'])) { continue; }
							
							$user = htmlspecialchars($user);
							echo '<option value="'.$user.'">'.$user.'</option>';
						}
						echo'
						</select>
						<input type="submit" value="Add" />
						</form>
					</td>
				</tr>
				</table>
			</td>
			</tr>';
		}
	?>
	</table>

	<br />
	<br />
	<br />

	<h3>Repository ACL</h3>
	<form action="<?php echo BASEURL?>/do/perm_repo_add.php" method="post">
	<table class="form">
	<tr>
	<th>Repository</th>
	<th>Path</th>
	<th>&nbsp;</th>
	</tr>
	<tr>
	<td>
		<select name="repo">
		<option value="">-</option>
		<?php
		foreach ($this->repos as $repo_name => $repo_type)
		{
			$repo_name = htmlspecialchars($repo_name);
			echo '<option value="'.$repo_name.'">'.$repo_name.'</option>';
		}
		?>
		</select>
	</td>
	<td><input type="text" name="path" value="" style="width:70px;"/></td>
	<td><input type="submit" value="Add" /></td>
	</tr>
	</table>
	</form>
	<br />
	<br />
	<table class="listing">
	<tr>
		<th>Repository:Path</th>
		<th>Access Level</th>
	</tr>
	<?php
		$span = 3;
		$aclArr = $this->aclArr;
		if (count($aclArr) < 1)
		{
			echo '<tr><td colspan="'.$span.'"><p>This list is empty</p></td></tr>';
		}

		//
		// Create group list
		//
		$groupList = array();
		foreach ($this->groupArr as $group) { $groupList[] = '@'.$group['group']; }

		//
		//
		//
		foreach ($aclArr as $acl)
		{
			foreach ($acl['paths'] as $path => $users)
			{
				echo '<tr>
				<td> '.$acl['repository'].':'.$path.'
					
		<a onclick="return confirm(\'Are you sure you want to remove path '.
		htmlspecialchars($acl['repository'].':'.$path,ENT_QUOTES).' from ACL?\');" href="'.BASEURL.'/do/perm_repo_del.php?repo='.urlencode($acl['repository'])
							.'&path='.urlencode($path).'" style="color:red;">(x)</a>
					</td>
				<td>
					<table>
					';
					foreach ($users as $user => $perm)
					{
						echo '<tr>
						<td>'.htmlspecialchars($user).' = '.htmlspecialchars($perm).'</td>
						<td>
	<a onclick="return confirm(\'Are you sure you want to remove permission for '.
	htmlspecialchars($user,ENT_QUOTES).'?\');" href="'.BASEURL.'/do/perm_repo_userdel.php?repo='.urlencode($acl['repository'])
							.'&path='.urlencode($path).'&username='.urlencode($user).'" style="color:red;">(x)</a>
						</td>
						</tr>';
					}
				echo'
					<tr>
						<td colspan="2">
						<form method="post" action="'.BASEURL.'/do/perm_repo_useradd.php">
						<input type="hidden" value="'.htmlspecialchars($acl['repository'], ENT_QUOTES).'" name="repo" />
						<input type="hidden" value="'.htmlspecialchars($path, ENT_QUOTES).'" name="path" />
						'.userExcOpts('username',
							array_merge($groupList, $this->userList),
							array_keys($users)
						).'
						'.opts('perm', array('rw'=>'rw', 'r'=>'r')).'
						<input type="submit" value="add" />
						</form>
						</td>
					</tr>
					</table>
				</td>
				</tr>';
			}
		}
	?>
	</table>
</fieldset>




<?php
function userExcOpts($name, $userList, $userExclude)
{
	$map = array(''=>'-', '*'=>'*');
	foreach ($userList as $user)
	{
		if (in_array($user, $userExclude)) { continue; }
		$map[$user] = $user;
	}

	return opts($name, $map);

	return $html;
}
function opts($name, $opts)
{
	$html = '<select name="'.$name.'">';
	foreach ($opts as $k => $v)
	{
		$html .= '<option value="'.htmlspecialchars($k, ENT_QUOTES).'">'.htmlspecialchars($v, ENT_QUOTES).'</option>';
	}
	$html .= '</select>';

	return $html;
}
?>


<script type="text/javascript">
$(document).ready(function() {
	var aclEnabled = $('#enable_acl').attr('checked');
	if (aclEnabled) {
		$('#acl_config').show();
	} else {
		$('#acl_config').hide();
	}

	$('#enable_acl').click(function(){
		var aclEnabled = $('#enable_acl').attr('checked');
		if (aclEnabled) {
			$.post('<?php echo BASEURL; ?>/do/perm_enabled.php', {'enable':1});
			$('#acl_config').show();
		} else {
			$.post('<?php echo BASEURL; ?>/do/perm_enabled.php', {'enable':0});
			$('#acl_config').hide();
		}
	});
});
</script>