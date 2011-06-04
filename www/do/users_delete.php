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
	alert('You must be an admin to delete users');
	redirect(BASEURL.'/do/users.php');
}

//
$username = $_REQUEST['username'];
if ($username == $_SESSION['sess']['username'])
{
	alert('You can not delete your own username');
	redirect(BASEURL.'/do/users.php');
}



$db = Db::inst('users');

if (!$db->exists($username))
{
	alert('Unable to find user');
	redirect(BASEURL.'/do/users.php');
}

$row = $db->get($username);
if (!$row)
{
	alert('Unable to find user');
	redirect(BASEURL.'/do/users.php');
}

$db->delete($username);

//
//
$htpasswd	= App::htpasswdCmd();
$password_file	= App::passwordFile();

$arg_user = escapeshellarg($username);

exec("$htpasswd -D $password_file $arg_user");


alert('Username "'.$username.'" has been deleted');
redirect(BASEURL.'/do/users.php');
