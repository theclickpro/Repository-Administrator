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

$repo = $_GET['repo'];
$path = $_GET['path'];
$user = $_GET['username'];

//
//
//
$db = Db::inst('acl');

try
{
	$repoRow = $db->get($repo);
	unset($repoRow['paths'][$path][$user]);
	$db->set($repo, $repoRow);
}
catch (Exception $e)
{
	alert('Not able to create group name ' . $group . ' : '. $e->getMessage());
	redirect(BASEURL.'/do/perm.php');
}

Acl::generate();

redirect(BASEURL . '/do/perm.php');