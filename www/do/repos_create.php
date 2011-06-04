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

