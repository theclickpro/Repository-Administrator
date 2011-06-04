<?php
include(dirname(__FILE__).'/_private.php');
$tpl = new Template();


if (!isAdmin())
{
	alert('You are not allowed to create users');
	redirect(BASEURL.'/do/users.php');
}




$tpl->content = $tpl->fetch(basename(__FILE__));
echo $tpl->fetch('template.php');
