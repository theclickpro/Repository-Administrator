<?php
interface repo_Repo
{
	public function getName();
	public function create();
	public function getUrl();
	public function getType();
	public function exists();
	public function delete();
	public function checkoutStr();
	public function repositoryPath();
	public function importStr();
}
