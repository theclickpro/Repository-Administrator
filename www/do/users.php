<?php
include(dirname(__FILE__).'/_private.php');

$tpl = new Template();


$db = Db::inst('users');

$res = $db->getAll();


$array = array();
while ($row = $res->fetch())
{
	$array[] = $row;
}


$tpl->users = $array;

$tpl->content = $tpl->fetch(basename(__FILE__));
echo $tpl->fetch('template.php');
