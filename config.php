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

error_reporting(E_ALL);

//
$CFG['app_name'] 			= 	'Repository Admnistrator';

//
$CFG['password_file'] 			= 	dirname(__FILE__).'/password';

//
$CFG['env']				= 	'/usr/bin/env';

// apache
$CFG['htpasswd'] 			= 	"/usr/bin/htpasswd";

// svn
$CFG['repos']['svn']['uri']		= 	'http://dev.theclickpro.com/svn';
$CFG['repos']['svn']['svnadmin']	= 	'/usr/bin/svnadmin';
$CFG['repos']['svn']['dir']		= 	dirname(__FILE__) .'/data/svn';

//
$CFG['repos']['git']['git']		= 	'/usr/bin/git';
$CFG['repos']['git']['uri']		= 	'http://dev.theclickpro.com/git';
$CFG['repos']['git']['dir']		= 	dirname(__FILE__) .'/data/git';


$CFG['trash']				=	dirname(__FILE__)."/trash";
$CFG['storage']				=	dirname(__FILE__).'/data/db';


