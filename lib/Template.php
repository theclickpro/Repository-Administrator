<?php
class Template
{
	private $vars = array();


	public function __set($k, $v)
	{
		$this->vars[$k] = $v;
	}

	public function __get($k)
	{
		return @$this->vars[$k];
	}

	public function fetch($tplfile)
	{
		ob_start();
		include(PATH.'/www/view/' . $tplfile);
		return ob_get_clean();
	}
}
