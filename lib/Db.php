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
class Db
{
	private static $db = array();
	private static $storageDir = '';

	public static function setStorageDir($dir) { self::$storageDir = $dir; }

	/**
	 * 
	 * @param string $coll
	 * @return Db
	 */
	public static function inst($coll)
	{
		if (!empty(self::$db[$coll]))
		{
			return self::$db[$coll];
		}

		$parent = self::$storageDir;
		if (!is_dir($parent))
		{
			throw new Exception('Storage dir "'.$parent.'" does not exists.  Please create storage dir and make it writable by the web server.');
		}
		else if (!is_writable($parent))
		{
			throw new Exception('Storage dir "'.$parent.'" is not writable.  Please make the directory writable by the web server.');
		}
		
		$storageDir = "$parent/$coll";
		if (!is_dir($storageDir)) {
			$ret = mkdir($storageDir);
			if (!$ret)
			{
				throw new Exception('Not able to create "'.$storageDir.'" make sure '.$parent.' is writable by the web server.');
			}
		}

		self::$db[$coll] = new Db($storageDir);
		return self::$db[$coll];
	}

	protected $dir;
	protected function __construct($dir)
	{
		$this->dir = $dir;
	}


	protected function _strip($k) {
		$allowed = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789.-_';
		$len = strlen($k);
		$n = '';
		for ($i=0; $i < $len; $i++)
		{
			$c = $k[$i];
			if (strpos($allowed, $c) !== false)
			{
				$n .= $c;
			}
		}

		if ($n != $k) {
			throw new Exception('Invalid character in DB Key');
		}

		return $n;
	}
	protected function _file($k)
	{
		return $this->dir."/" . $this->_strip($k);
	}

	public function exists($k)
	{
		return is_file($this->_file($k));
	}

	public function set($k, $arr=array())
	{
		$file = $this->_file($k);
		$row = array();
		if ($this->exists($k))
		{
			$row = unserialize(file_get_contents($file));
		}

		$row = array_merge($row, $arr);

		file_put_contents($file, serialize($row) );
	}
	public function get($k)
	{
		$file = $this->_file($k);
		if (!is_file($file)) {
			return false;
		}
		return unserialize(file_get_contents($file));
	}

	public function getVal($k, $col)
	{
		$file = $this->_file($k);
		$row = unserialize(file_get_contents($file));
		return @$row[$col];
	}

	public function delete($k)
	{
		$file = $this->_file($k);
		unlink($file);
	}

	/**
	 *
	 * @return DbRes 
	 */
	public function getAll()
	{
		return new DbRes($this->dir);
	}

	/**
	 *
	 * @return array
	 */
	public function getAllAsArr()
	{
		$ret = array();
		$res = $this->getAll();
		while ($row = $res->fetch())
		{
			$ret[] = $row;
		}

		return $ret;
	}
}

class DbRes
{
	protected $dir;
	protected $res;

	public function __construct($dir)
	{
		$this->dir = $dir;
		$this->res = opendir($dir);
	}

	public function fetch()
	{
		do {
			$file = readdir($this->res);
			if (!$file) {
				return false;
			}
		} while ($file == '.' || $file == '..');

		return unserialize(file_get_contents("{$this->dir}/$file"));
	}

	public function __destruct()
	{
		if ($this->res)
		{
			closedir($this->res);
		}
	}
}

