<?php
//
$CFG['app_name'] 		= 	'Repository Admnistrator';

//
$CFG['password_file'] 		= 	dirname(__FILE__).'/password';

//
$CFG['env']			= 	'/usr/bin/env';


// apache
$CFG['htpasswd'] 		= 	"/usr/bin/htpasswd";

// svn
$CFG['repos']['svn']['uri']	= 	'http://dev.theclickpro.com/svn';
$CFG['repos']['svn']['svnadmin']	= 	'/usr/bin/svnadmin';
$CFG['repos']['svn']['dir']	= 	dirname(__FILE__) .'/data/svn';

//
$CFG['repos']['git']['git']	= 	'/usr/bin/git';
$CFG['repos']['git']['uri']	= 	'http://dev.theclickpro.com/git';
$CFG['repos']['git']['dir']	= 	dirname(__FILE__) .'/data/git';



$CFG['trash']			=	dirname(__FILE__)."/trash";
$CFG['storage']			=	dirname(__FILE__).'/data/db';


