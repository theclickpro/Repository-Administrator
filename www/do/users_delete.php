<?php
include(dirname(__FILE__).'/_private.php');


if (!isAdmin())
{
	alert('You must be an admin to delete users');
	redirect(BASEURL.'/do/users.php');
}

//
$username = $_REQUEST['username'];
if ($username == $_SESSION['sess']['username'])
{
	alert('You can not delete your own username');
	redirect(BASEURL.'/do/users.php');
}



$db = Db::inst();

if (!$db->exists($username))
{
	alert('Unable to find user');
	redirect(BASEURL.'/do/users.php');
}

$row = $db->get($username);
if (!$row)
{
	alert('Unable to find user');
	redirect(BASEURL.'/do/users.php');
}

$db->delete($username);

//
//
$htpasswd	= App::htpasswdCmd();
$password_file	= App::passwordFile();

$arg_user = escapeshellarg($username);

exec("$htpasswd -D $password_file $arg_user");


alert('Username "'.$username.'" has been deleted');
redirect(BASEURL.'/do/users.php');
