<?php
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


