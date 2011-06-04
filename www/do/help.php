<?php
include(dirname(__FILE__).'/_private.php');
$tpl = new Template();


$tpl->content = $tpl->fetch(basename(__FILE__));
echo $tpl->fetch('template.php');
