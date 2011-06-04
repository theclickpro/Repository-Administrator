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
include(dirname(__FILE__).'/www/common.php');

$errors = array();

//
// Check Storage Dir
//
$dir = App::storageDir();
if (is_dir($dir))
{
	if (!is_writable($dir))
	{
	$errors[] = "$dir must be writable or owned by web server. Try:
	chown apache:apache $dir
	chmod o+w $dir
";
	}
}
else
{
	$errors[] = "$dir does not exsts.  Try:
	mkdir -p $dir
	or
	chmod o+w $dir
";
}


$file = App::envCmd();
if (!is_executable($file))
{
	$errors[] = "path to 'env' command is invalid \"$file\". Adjust the path in the config file.";
}


$file = App::passwordFile();
if (file_exists($file))
{
	if (!is_writable($file))
	{
	$errors[] = "$file must be writable or owned by web server. Try:
	chown apache:apache $file
	or
	chmod o+w $file
";
	}
}
else
{
	$errors[] = "$file does not exists. Try:
	touch $file
	chmod o+w $file
";
}


//
// Display errors
//
if (!empty($errors))
{
	foreach ($errors as $error)
	{
		echo "==============================\n";
		echo $error;
		echo "\n";
	}
}



$db = Db::inst();
$db->set('admin', 
	array(
		'username'=>'admin',
		'password'=>md5('admin'),
		'admin'=>'1',
	)
);


