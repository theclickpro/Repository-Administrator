<?php
include(dirname(__FILE__).'/../../common.php');

// Base URL
$uri = '';
if (preg_match('/^(.*?)\/do\/.*\.php/', $_SERVER['REQUEST_URI'], $match))
{
	$uri = $match[1];
}
define('BASEURL', $uri);


session_start();



