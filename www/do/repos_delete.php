<?php
include(dirname(__FILE__).'/_private.php');

if (!isAdmin())
{
	alert('You must be an admin to delete');
	redirect(BASEURL.'/do/repos.php');
}


//
$repo = @$_REQUEST['repo'];
$type = @$_REQUEST['type'];

$obj = repo_Factory::getInstance($type, $repo);


if (!$obj->exists())
{
	alert('Could not find repository');
	redirect(BASEURL.'/do/repos.php');
}


$obj->delete();



alert('Repository has been moved to the trash directory ');
redirect(BASEURL.'/do/repos.php');



