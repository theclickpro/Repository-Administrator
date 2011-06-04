<?php
include(dirname(__FILE__).'/_private.php');


$_SESSION['sess']['admin'] = true;

$username = $_REQUEST['username'];
$pass = $_POST['password'];
$admin = @$_POST['admin'];

if ($username != $_SESSION['sess']['username'] && !isAdmin())
{
	alert('Permission denied');
	redirect(BASEURL.'/do/users.php');
}


try
{
	User::update($_SESSION['sess']['username'], $username, $pass, "".$_POST['password_confirm'], $admin);
	alert('User updated');
	redirect(BASEURL.'/do/users.php');
}
catch (Exception $e)
{
	alert($e->getMessage());
	redirect(BASEURL.'/do/users_edit.php?username='. urlencode($username));
}


