<?php
include(dirname(__FILE__).'/_private.php');
$tpl = new Template();



$repo = @$_REQUEST['repo'];
$type = @$_REQUEST['type'];

$obj = repo_Factory::getInstance($type, $repo);


if (!$obj->exists())
{
	alert('Could not find repository');
	redirect(BASEURL.'/do/repos.php');
}


$tpl->repo = $obj;



$tpl->content = $tpl->fetch(basename(__FILE__));
echo $tpl->fetch('template.php');
