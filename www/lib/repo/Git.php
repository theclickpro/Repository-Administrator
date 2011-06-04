<?php
class repo_Git implements repo_Repo
{
	private $name;
	private $uri;
	private $dir;
	private $git;

	public function __construct($name) {
		$this->name = $name;
		$cfg = App::getRepoCfg();
		$this->uri = $cfg['git']['uri'];
		$this->dir = $cfg['git']['dir'];
		$this->git = $cfg['git']['git'];
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
