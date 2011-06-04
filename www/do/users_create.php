<?php
include(dirname(__FILE__).'/_private.php');


$username = trim($_REQUEST['username']);
$pass = $_POST['password'];
$admin = (@$_POST['admin'] == 1 ? 1 : 0);

if (!isAdmin())
{
	alert('You must be an admin to create new users');
	redirect(BASEURL.'/do/users.php');
}


try
{
	User::create($username, $pass, $_POST['password_confirm'], $admin);
	alert('User has been created');
	redirect(BASEURL.'/do/users.php');
}
catch (Exception $e)
{
	alert($e->getMessage());
	$tpl = new Template();
	$tpl->username = $username;
	$tpl->admin = $admin;
	$tpl->content = $tpl->fetch('users_new.php');
	echo $tpl->fetch('template.php');
}
