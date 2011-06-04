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



