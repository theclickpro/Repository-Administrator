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
include(dirname(__FILE__).'/_admin.php');

$group = $_POST['group'];
$user = $_POST['username'];
if (empty($user)) { redirect(BASEURL.'/do/perm.php'); }

//
//
//
$db = Db::inst('group');


try
{
	$groupRow = $db->get($group);
	$groupRow['users'][] = $user;
	//print_r($groupRow); exit;
	$db->set($group, $groupRow);
}
catch (Exception $e)
{
	alert('Not able to create group name ' . $group . ' : '. $e->getMessage());
	redirect(BASEURL.'/do/perm.php');
}

Acl::generate();

redirect(BASEURL . '/do/perm.php');