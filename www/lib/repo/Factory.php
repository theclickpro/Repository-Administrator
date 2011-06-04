<?php
class repo_Factory
{
	const TYPE_SVN = 'svn';
	const TYPE_GIT = 'git';

	public function getInstance($type, $name)
	{
		if (self::TYPE_SVN == $type)
		{
			$repo = new repo_Svn($name);
		}
		else if (self::TYPE_GIT == $type)
		{
			$repo = new repo_Git($name);
		}
		else
		{
			throw new repo_UnknownRepo('Unsuported repository');
		}

		return $repo;
	}

	public static function getAvailableTypes()
	{
		$cfg = App::getRepoCfg();
		return array_keys($cfg);
	}

	public static function getRepos()
	{
		$avail = self::getAvailableTypes();
		$cfg = App::getRepoCfg();

		// get repository parent directories
		$paths = array();
		foreach ($avail as $av)
		{
			$dir = $cfg[$av]['dir'];
			$paths[ $dir ] = $av;
		}


		// get available repositories in each directory
		$repos = array();
		foreach ($paths as $path => $type)
		{
			$d = opendir($path);
			while ($f = readdir($d))
			{
				if ($f == '.' || $f == '..') continue;

				$repos[$f] = $type;
			}
			closedir($d);
		}
		return $repos;
	}

	public static function getTrashed()
	{
		$path = App::trashDir();

		$repos = array();
		$d = opendir($path);
		while ($f = readdir($d))
		{
			if ($f == '.' || $f == '..') continue;

			$repos[] = $f;
		}
		closedir($d);
		return $repos;
	}
}
