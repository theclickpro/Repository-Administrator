<?php
class Db
{
	private static $db = null;
	public static function inst($coll)
	{
		if (!is_null(self::$db))
		{
			return self::$db;
		}

		$parent = App::storageDir();
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
			throw new Exception('Storage dir "'.$storageDir.'" does not exists');
		}

		self::$db = new Db($storageDir);
		return self::$db;
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
			throw new Exception('Invalid DB Key');
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

	public function getAll()
	{
		return new DbRes($this->dir);
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

