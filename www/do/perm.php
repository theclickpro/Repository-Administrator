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

//
//
//
if (!isAdmin())
{
	alert('You are not allowed to access permissions');
	redirect(BASEURL.'/do/repos.php');
}

//
//
//
$groupArr	= Db::inst('group')->getAllAsArr();
$aclArr		= Db::inst('acl')->getAllAsArr();
$userArr	= Db::inst('users')->getAllAsArr();

$userList	= array();
foreach ($userArr as $user)
{
	$userList[] = $user['username'];
}


//
//
$tpl->aclArr = $aclArr;
//echo '<pre>'; print_r($aclArr); exit;
$tpl->groupArr = $groupArr;
$tpl->userList = $userList;
$tpl->repos = repo_Factory::getRepos();
$tpl->enable_acl = Acl::isEnabled();


//
//
//
$tpl->content = $tpl->fetch(basename(__FILE__));
echo $tpl->fetch('template.php');
