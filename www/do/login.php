<?php
include(dirname(__FILE__).'/_public.php');

$tpl = new Template();

$tpl->content = $tpl->fetch('login.php');
echo $tpl->fetch('template.php');


