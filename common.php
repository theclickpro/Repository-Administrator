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

function get_files_in_dir($dir)
{
	$files = array();
	$d = opendir($dir);
	while ($f = readdir($d))
	{
		if ($f == '.' || $f == '..' || $f == '.keep') continue;
		$files[] = $f;
	}
	closedir($d);

	return $files;
}

