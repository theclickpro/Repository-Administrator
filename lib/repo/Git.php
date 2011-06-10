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
class repo_Git implements repo_Repo
{
	private $name;
	private $uri;
	private $dir;
	private $git;

	public function __construct($name) {
		$this->name = $name;
		$cfg = App::getRepoCfg();
		$this->uri	= $cfg['git']['uri'];
		$this->dir	= $cfg['git']['dir'];
		$this->git	= $cfg['git']['git'];
	}

	public function getName() { return $this->name; }
	public function getType() { return repo_Factory::TYPE_GIT; }

	public function create()
	{
		$name = $this->name;

		$git = $this->git;
		$env = App::env();

		$new = escapeshellcmd("{$this->dir}/$name");

		if (is_dir($new))
		{
			throw new Exception('Repository with the same name already exists');
		}

		exec("$env -i $git init --bare $new");
	}

	public function checkoutStr()
	{
		return  'git clone ' . $this->getUrl() .' '. $this->name;
	}

	public function importStr()
	{
		return  'git push ' . $this->getUrl() .' master';
	}

	public function repositoryPath()
	{
		return "{$this->dir}/{$this->name}";
	}

	public function getUrl()
	{
		return $this->uri . '/' . $this->name;
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
		$new = escapeshellcmd( $trashDir .'/'. repo_Factory::TYPE_GIT .'_'. $this->name .'-'. date('YmdHis') .'_'. rand() );

		exec("mv $cur $new");
	}
}
