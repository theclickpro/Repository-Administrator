<?php
include(dirname(__FILE__).'/_common.php');

// session
if (@$_SESSION['sess']['logged'] !== true)
{
	redirect(BASEURL.'/do/login.php');
}

