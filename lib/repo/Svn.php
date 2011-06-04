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
class repo_Svn implements repo_Repo
{
	private $name;
	private $dir;
	private $uri;
	private $svnadmin;

	public function __construct($name) {
		$this->name = $name;
		$cfg = App::getRepoCfg();
		$this->dir = $cfg['svn']['dir'];
		$this->uri = $cfg['svn']['uri'];
		$this->svnadmin = $cfg['svn']['svnadmin'];
	}

	public function getName() { return $this->name; }
	public function getType() { return repo_Factory::TYPE_SVN; }

	public function create()
	{
		$name = $this->name;
		$svnadmin = $this->svnadmin;
		$env = App::env();

		$new = escapeshellcmd("{$this->dir}/$name");

		if (is_dir($new))
		{
			throw new Exception('Repository with the same name already exists');
		}

		exec("$env -i $svnadmin create $new");
	}

	public function getUrl()
	{
		return $this->uri . '/' . $this->name;;
	}

	public function checkoutStr()
	{
		return  'svn checkout ' . $this->getUrl() . '/trunk ' . $this->name;
	}
	public function importStr()
	{
		return  'svn import ' . $this->getUrl();
	}

	public function repositoryPath()
	{
		return "{$this->dir}/{$this->name}";
	}

	public function exists()
	{
		$dir = $this->dir . '/' . $this->name;
		return is_dir($dir);
	}

	public function delete()
	{
		$trashDir = App::trashDir();

		$cur = escapeshellcmd("{$this->dir}/{$this->name}");
		$new = escapeshellcmd( $trashDir .'/'. repo_Factory::TYPE_SVN .'_'. $this->name .'-'. date('YmdHis') .'_'. rand() );

		exec("mv $cur $new");
	}
}
