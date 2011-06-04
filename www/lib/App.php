<?php
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
