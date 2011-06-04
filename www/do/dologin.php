<?php
include(dirname(__FILE__).'/_public.php');

//
$db = Db::inst('users');
$user = $_POST['username'];
$pass = md5($_POST['password']);

//
$row = $db->get($user);
if (!$row || @$row['password'] != $pass)
{
	alert('Invalid credentials');
	redirect(BASEURL.'/do/login.php');
}

//
$_SESSION['sess'] = array();
$_SESSION['sess']['logged'] = true;
$_SESSION['sess']['username'] = $user;
$_SESSION['sess']['admin'] = ($row['admin'] == 1 ? true : false );

//
redirect(BASEURL.'/do/repos.php');


