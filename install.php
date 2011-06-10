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
include(dirname(__FILE__).'/common.php');

function ask($str, $possible_ansers=array(), $def = '') {
	$ans = "#####@i909230####";
	//
	while (!in_array($ans, $possible_ansers))
	{
		echo "$str ";
		$ans = strtolower(trim(fgets(STDIN)));

		//
		if (empty($ans)) { $ans = $def; }

		//
		if (empty($possible_ansers)) { return $ans; }
	}
	return $ans;
}

function getExecPath($poss, $nfq)
{
	foreach ($poss as $p)
	{
		if (is_executable($p)) { return $p; }
	}
	return ask($nfq);
}



//
// Get install path
//
$dpath = '/srv/repoadmin';
$dpath = ask("\nSpecify the path where you want to install RepoAdmin.
Hit enter to accept the default path (Default: $dpath):", array(), $dpath);


//
// Enable GIT
//
$gitEnabled = true;
$tmp = ask("\nDo you want to enable GIT repository support? (Yes/No/Y/N, Default Yes) : ", array('y', 'yes', 'no', 'n'), 'y');
if ($tmp[0] == 'n')
{
	$gitEnabled = false;
}

//
// Enable SVN
//
$svnEnabled = true;
$tmp = ask("\nDo you want to enable SVN repository support? (Yes/No/Y/N, Default Yes) : ", array('y', 'yes', 'no', 'n'), 'y');
if ($tmp[0] == 'n')
{
	$svnEnabled = false;
}

if (!$svnEnabled && !$gitEnabled)
{
	die("\nERROR: You must enable at least one repository type.\n");
}


//
// Check installation directory
//
if (is_dir($dpath) || is_file($dpath))
{
	die("\nERROR: The path $dpath already exists. Please specify a diferent path.\n");
}
$basedir = dirname($dpath);
if (!is_writable($basedir))
{
	die("\nERROR: Insuficient permissions to create directory $dpath.  did you try with sudo?\n");
}



//
// Start installation
//
echo "\n\nInstalling\n";
$curDir = realpath(dirname(__FILE__));

echo "Creating directory $dpath...";
mkdir($dpath, 0755);
echo "Done\n";


//
//
echo "Copying content ...";
shell_exec("cp -R $curDir/* $dpath");
echo "Done\n";


//
// Setup DB
//
Db::setStorageDir("$dpath/data/db");
$db = Db::inst('users');
$db->set('admin', 
	array(
		'username'=>'admin',
		'password'=>md5('admin'),
		'admin'=>'1',
	)
);



//
// custom config file
//
file_put_contents($dpath.'/config.php', getConfigFile($dpath, $gitEnabled, $svnEnabled));






echo "\n\nInstallation finished.\n";
echo "\n
####################################################################

1. Add the following to your apache configuration:

	Alias /repoadmin $dpath
";
if ($gitEnabled)
{
echo "\tSetEnv GIT_PROJECT_ROOT $dpath/data/git
	SetEnv GIT_HTTP_EXPORT_ALL
	ScriptAlias /git/ /usr/lib/git-core/git-http-backend/
	<Location /git>
		AuthType Basic
		AuthName \"Git\"
		AuthUserFile $dpath/password
		Require valid-user
	</Location>\n";
}
if ($svnEnabled)
{
echo "\t<Location /svn>
		DAV svn
		SVNParentPath $dpath/data/svn
		AuthType Basic
		AuthName \"SVN\"
		AuthUserFile $dpath/password
		Require valid-user
	</Location>\n";
}
echo "
2. Edit the $dpath/config.php to make any necessary adjustments.

3. A temporary admin account has been created. You should login and
   and change the password.
	Username: admin
	Password: admin

4. Point your browser to: http://your-domain.tld/repoadmin

####################################################################
";



function getConfigFile($dpath, $git, $svn)
{
$output = <<<ENDS
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

//error_reporting(E_ALL);

//
// Display Application Title
//
\$CFG['app_name'] 			= 	'Repository Admnistrator';

//
// Path to password file to store repository passwords
//
\$CFG['password_file'] 			= 	'$dpath/password';

//
// Path to env command
//
\$CFG['env']				= 	'/usr/bin/env';

// 
//  Path to htpasswd command from apache
// 
\$CFG['htpasswd'] 			= 	"/usr/bin/htpasswd";

//
// Git
//
//   Apache configuration to enable Git repository:
//
//	SetEnv GIT_PROJECT_ROOT $dpath/data/git
//	SetEnv GIT_HTTP_EXPORT_ALL
//	ScriptAlias /git/ /usr/lib/git-core/git-http-backend/
//	<Location /git>
//		AuthType Basic
//		AuthName \"Git\"
//		AuthUserFile $dpath/password
//		Require valid-user
//	</Location>
//
//
ENDS;
if ($git) {
$output .= <<<ENDS
\$CFG['repos']['git']['git']		= 	'/usr/bin/git';
\$CFG['repos']['git']['uri']		= 	'http://localhost/git';
\$CFG['repos']['git']['dir']		= 	'$dpath/data/git';

ENDS;
}
else
{
$output .= <<<ENDS
//\$CFG['repos']['git']['git']		= 	'/usr/bin/git';
//\$CFG['repos']['git']['uri']		= 	'http://localhost/git';
//\$CFG['repos']['git']['dir']		= 	'$dpath/data/git';

ENDS;
}

$output .= <<<ENDS

//
// Subversion 
//
//   Apache configuration to enable Subversion repository:
//
//	<Location /svn>
//		DAV svn
//		SVNParentPath $dpath/data/svn
//		AuthType Basic
//		AuthName \"SVN\"
//		AuthUserFile $dpath/password
//		Require valid-user
//	</Location>
//
ENDS;
if ($svn)
{
$output .= <<<ENDS
\$CFG['repos']['svn']['uri']		= 	'http://localhost/svn';
\$CFG['repos']['svn']['svnadmin']	= 	'/usr/bin/svnadmin';
\$CFG['repos']['svn']['dir']		= 	'$dpath/data/svn';

ENDS;
}
else
{
$output .= <<<ENDS
//\$CFG['repos']['svn']['uri']		= 	'http://localhost/svn';
//\$CFG['repos']['svn']['svnadmin']	= 	'/usr/bin/svnadmin';
//\$CFG['repos']['svn']['dir']		= 	'$dpath/data/svn';

ENDS;
}



$output .= <<<ENDS

//
// Trash Directory.
//	All deleted repositories will be first moved here.
//
\$CFG['trash']				=	"$dpath/trash";


//
// Application Data storage directory
//
\$CFG['storage']			=	'$dpath/data/db';

ENDS;

return $output;
}
