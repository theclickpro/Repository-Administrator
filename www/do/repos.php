<?php
include(dirname(__FILE__).'/_private.php');
$tpl = new Template();



$tpl->repos = repo_Factory::getRepos();
$tpl->trashed = repo_Factory::getTrashed();



$tpl->content = $tpl->fetch(basename(__FILE__));
echo $tpl->fetch('template.php');
