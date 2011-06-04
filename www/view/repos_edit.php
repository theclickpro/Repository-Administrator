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
<?php $repo = $this->repo; ?>
<table class="form">
	<tr>
		<th>Repository:</th>
		<td>
			<b><?php echo htmlspecialchars($repo->getName())?></b>
			<input type="hidden" name="repository" value="<?php echo htmlspecialchars($repo->getName())?>" />
		</td>
	</tr>
	<tr>
		<th>Import code:</th>
		<td>
			<code><?php echo htmlspecialchars($repo->checkoutStr())?></code>
		</td>
	</tr>
	<tr>
		<th>Checkout/Clone:</th>
		<td>
			<code><?php echo htmlspecialchars($repo->importStr())?></code>
		</td>
	</tr>
	<tr>
		<th>Disk path:</th>
		<td>
			<code><?php echo htmlspecialchars($repo->repositoryPath())?></code>
		</td>
	</tr>
	<tr>
		<td colspan="2">&nbsp;</td>
	</tr>
	<tr>
		<th>Remove:</th>
		<td><input type="button" value="Remove" class="button-delete" onclick="deleteRepo();" /></td>
	</tr>
	<tr>
		<td colspan="2">&nbsp;</td>
	</tr>

	<tr>
		<td colspan="2" style="text-align:right;"><input type="submit" value="&laquo;&nbsp;Back" onclick="goBack()"/></td>
	</tr>
</table>

<script type="text/javascript">
function goBack()
{
	window.location = '<?php echo BASEURL?>/do/repos.php';
}
function deleteRepo()
{
	if (confirm('Are you sure you want to delete this repository?'))
	{
		window.location = '<?php echo BASEURL?>/do/repos_delete.php?repo=<?php echo urlencode($repo->getName())?>&type=<?php echo urlencode($repo->getType())?>';
	}
}
</script>
