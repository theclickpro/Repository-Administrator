<?php

include(dirname(__FILE__).'/_public.php');

$_SESSION['sess']['logged'] = false;

redirect(BASEURL.'/do/login.php');

