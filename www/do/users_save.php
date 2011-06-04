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


$_SESSION['sess']['admin'] = true;

$username = $_REQUEST['username'];
$pass = $_POST['password'];
$admin = @$_POST['admin'];

if ($username != $_SESSION['sess']['username'] && !isAdmin())
{
	alert('Permission denied');
	redirect(BASEURL.'/do/users.php');
}


try
{
	User::update($_SESSION['sess']['username'], $username, $pass, "".$_POST['password_confirm'], $admin);
	alert('User updated');
	redirect(BASEURL.'/do/users.php');
}
catch (Exception $e)
{
	alert($e->getMessage());
	redirect(BASEURL.'/do/users_edit.php?username='. urlencode($username));
}


