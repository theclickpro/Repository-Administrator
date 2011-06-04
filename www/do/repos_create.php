<?php
include(dirname(__FILE__).'/_private.php');
$tpl = new Template();



if (!isAdmin())
{
	alert('You are not allowed to create repositories');
	redirect(BASEURL.'/do/repos.php');
}


//
$repo = @$_REQUEST['repo'];

//
$error = false;
if (empty($repo))
{
	$error = 'Repository name can not be empty';
}


//
// check name
//
if (!$error)
{
	$allowed = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890-_.';
	$len = strlen($repo);
	for ($i=0; $i < $len; $i++)
	{
		$c = $repo[$i];
		if (strpos($allowed, $c) === false)
		{
			$error = 'Invalid repository name.  Repository name can only contain letters, numbers, dashes(-), underscores (_) and periods (.)';
			break;
		}
	}
}

//
// check name
//
if (!$error)
{
	if (in_array($repo, array_keys(repo_Factory::getRepos())))
	{
		$error = 'A repository with the same name already exists.';
	}
}


try
{
	$repoobj = repo_Factory::getInstance(''.@$_POST['type'], $repo);
}
catch (repo_UnknownRepo $e)
{
	$error = 'You must select a repository type';
}

try
{
	$repoobj->create();
}
catch (Exception $e)
{
	$error = $e->getMessage();
}


//
if (!$error)
{

	alert('New repository created');
	redirect(BASEURL.'/do/repos.php');
}
else
{
	alert($error);
	$tpl->repo = $repo;
	$tpl->content = $tpl->fetch('repos_new.php');
	echo $tpl->fetch('template.php');
}

