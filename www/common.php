<?php
error_reporting(E_ALL);

define('PATH', dirname(__FILE__));
include(dirname(__FILE__).'/config.php');

function classLoader($class)
{
	$class = str_replace('_', '/', $class);
	$php = PATH . '/lib/' . $class . '.php';
	if (is_file($php))
	{
		include($php);
	}
}

spl_autoload_register('classLoader');

App::loadConfig(PATH.'/config.php');

function alert($msg)
{
	$_SESSION['sess']['alert'] = $msg;
}
function getAlert()
{
	$msg = @$_SESSION['sess']['alert'];
	unset($_SESSION['sess']['alert']);
	if (!$msg) return false;

	return $msg;
}

function redirect($rd)
{
	header("Location: $rd");
	exit;
}

function isLogged()
{
	$ret = @$_SESSION['sess']['logged'];
	if ($ret == true)
	{
		return true;
	}

	return false;
}

function isAdmin()
{
	$ret = @$_SESSION['sess']['admin'];
	if ($ret == true)
	{
		return true;
	}

	return false;
}

