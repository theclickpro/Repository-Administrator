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
include(dirname(__FILE__).'/_public.php');

//
$db = Db::inst('users');
$user = $_POST['username'];
$pass = md5($_POST['password']);

//
$row = $db->get($user);
if (!$row || @$row['password'] != $pass)
{
	alert('Invalid credentials');
	redirect(BASEURL.'/do/login.php');
}

//
$_SESSION['sess'] = array();
$_SESSION['sess']['logged'] = true;
$_SESSION['sess']['username'] = $user;
$_SESSION['sess']['admin'] = ($row['admin'] == 1 ? true : false );

//
redirect(BASEURL.'/do/repos.php');


