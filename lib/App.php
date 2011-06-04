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
class App
{
	private static $app_name;
	private static $password_file;
	private static $htpasswd;
	private static $trash;
	private static $storage;
	private static $env;


	private static $repos = array();


	public static function loadConfig($confFile)
	{
		include($confFile);

		self::$app_name 		= 	$CFG['app_name'];
		self::$password_file 		= 	$CFG['password_file'];
		self::$htpasswd 		= 	$CFG['htpasswd'];
		self::$env			=	$CFG['env'];
		self::$trash			=	$CFG['trash'];
		self::$storage			=	$CFG['storage'];

		self::$repos			= 	$CFG['repos'];
	}



	public static function name() { return self::$app_name; }

	public static function passwordFile() { return self::$password_file; }
	public static function storageDir() { return self::$storage; }
	public static function trashDir() { return self::$trash; }
	public static function htpasswdCmd() { return self::$htpasswd; }

	public static function env() { return self::$env; }


	public function getRepoCfg()
	{
		return self::$repos;
	}


}
