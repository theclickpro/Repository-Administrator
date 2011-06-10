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
// Display Application Title
//
$CFG['app_name'] 			= 	'RepoAdmin';

//
// Path to password file to store repository passwords
//
$CFG['password_file'] 			= 	dirname(__FILE__).'/password';

//
// Path to env command
//
$CFG['env']				= 	'/usr/bin/env';

// 
//  Path to htpasswd command from apache
// 
$CFG['htpasswd'] 			= 	"/usr/bin/htpasswd";

//
// Git
//
//   Apache configuration to enable Git repository:
//
//	SetEnv GIT_PROJECT_ROOT /srv/repoadmin/data/git
//	SetEnv GIT_HTTP_EXPORT_ALL
//	ScriptAlias /git/ /usr/lib/git-core/git-http-backend/
//	<Location /git>
//		AuthType Basic
//		AuthName \"Git\"
//		AuthUserFile /srv/repoadmin/password
//		Require valid-user
//	</Location>
//
//
$CFG['repos']['git']['git']		= 	'/usr/bin/git';
$CFG['repos']['git']['uri']		= 	'http://dev.theclickpro.com/git';
$CFG['repos']['git']['dir']		= 	dirname(__FILE__) .'/data/git';

//
// Subversion 
//
//   Apache configuration to enable Subversion repository:
//
//	<Location /svn>
//		DAV svn
//		SVNParentPath /srv/repoadmin/data/svn
//		AuthType Basic
//		AuthName \"SVN\"
//		AuthUserFile /srv/repoadmin/password
//		Require valid-user
//	</Location>
//
$CFG['repos']['svn']['uri']		= 	'http://dev.theclickpro.com/svn';
$CFG['repos']['svn']['svnadmin']	= 	'/usr/bin/svnadmin';
$CFG['repos']['svn']['dir']		= 	dirname(__FILE__) .'/data/svn';


//
// Trash Directory.
//	All deleted repositories will be first moved here.
//
$CFG['trash']				=	dirname(__FILE__)."/trash";

//
// Application Data storage directory
//
$CFG['storage']				=	dirname(__FILE__).'/data/db';


