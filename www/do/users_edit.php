<?php
include(dirname(__FILE__).'/_private.php');
$tpl = new Template();



$db = Db::inst();

$user = $_REQUEST['username'];
if (!$db->exists($user))
{
	alert('Unable to find user');
	redirect(BASEURL.'/do/users.php');
}


$row = $db->get($user);
if (!$row)
{
	alert('Unable to find user');
	redirect(BASEURL.'/do/users.php');
}
$tpl->row = $row;




$tpl->content = $tpl->fetch(basename(__FILE__));
echo $tpl->fetch('template.php');
