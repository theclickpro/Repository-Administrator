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
			foreach (get_files_in_dir($path) as $f)
			{
				$repos[$f] = $type;
			}
		}
		return $repos;
	}

	public static function getTrashed()
	{
		$path = App::trashDir();

		$repos = array();
		foreach (get_files_in_dir($path) as $f)
		{
			$repos[] = $f;
		}
		return $repos;
	}
}
