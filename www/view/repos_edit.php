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
