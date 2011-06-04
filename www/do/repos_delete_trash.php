<?php
include(dirname(__FILE__).'/_private.php');

if (!isAdmin())
{
	alert('You must be an admin to delete trash');
	redirect(BASEURL.'/do/repos.php');
}

$repo = @$_REQUEST['repo'];

if (!in_array($repo, repo_Factory::getTrashed()))
{
	alert('Could not find repository');
	redirect(BASEURL.'/do/repos.php');
}

$repo_trash = App::trashDir();

//
$argRepo = escapeshellcmd($repo);
if (is_dir("$repo_trash/$argRepo"))
{
	exec("rm -fr $repo_trash/$argRepo");
}


alert("Repository has been permanently deleted from filesystem ($repo_trash/$argRepo)");
redirect(BASEURL.'/do/repos.php');



