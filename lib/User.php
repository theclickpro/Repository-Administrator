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
class User
{
	public static function create($username, $pass, $confirm_pass, $admin)
	{
		$db = Db::inst('users');

		$admin = (int) $admin;
		if ($admin != 1) $admin = -1;

		//
		// Validation
		//
		$error = false;

		if (empty($username))
		{
			$error = 'Username must not be empty';
		}

		if (!$error)
		{
			$allowed = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890';
			$len = strlen($username);
			for ($i = 0; $i < $len; $i++)
			{
				$c = $username[$i];
				if (strpos($allowed, $c) === false)
				{
					$error = 'Invalid username.  Username can only contain letters, numbers.';
					break;
				}
			}
		}

		if (!$error)
		{
			if (empty($pass))
			{
				$error = 'Password must not be blank';
			}
		}

		if (!$error)
		{
			if ($pass != $confirm_pass)
			{
				$error = 'Password and Password Confirmation do not match';
			}
		}

		if (!$error)
		{
			$count = $db->exists($username);
			if ($count)
			{
				$error = 'User "'.$username.'" already exists';
			}
		}



		if ($error)
		{
			throw new Exception($error);
		}


		//
		//
		$db->set($username,
			array(
			'username'=>$username,
			'password'=>md5($pass),
			'admin'=> $admin
			)
		);


		//
		//
		$htpasswd	= App::htpasswdCmd(); 
		$password_file	= App::passwordFile();

		$arg_user = escapeshellarg($username);
		$arg_pass = escapeshellarg($pass);

		// update svn
		if(!file_exists("$password_file"))
		{
			exec("$htpasswd -cmb $password_file $arg_user $arg_pass"); 
		} else {
			exec("$htpasswd -bm $password_file $arg_user $arg_pass"); 
		}
	}

	public static function update($me, $user, $pass, $confirm_pass, $admin)
	{
		$db = Db::inst('users');

		$amIAdmin = $db->getVal($me, 'admin');
		if ($amIAdmin == 1)  { $amIAdmin = true; } else { $amIAdmin = false; }


		$count = $db->exists($user);
		if (!$count)
		{
			throw new Exception('Username "'.$user.'" not found');
		}


		//
		$htpasswd = App::htpasswdCmd();
		$password_file = App::passwordFile();

		$updateFields = array();

		if (!empty($pass))
		{
			if ($pass != $confirm_pass)
			{
				throw new Exception('Password and Password Confirmation do not match');
			}
			$md5Pass = md5($pass); 
			$updateFields['password'] = $md5Pass;
		}

		//
		if ($amIAdmin && $user != $me)
		{
			$admin = ($admin == 1 ? 1 : 0);
			$updateFields['admin'] = $admin;
		}

		$db->set($user, $updateFields);


		$arg_user = escapeshellarg($user);
		$arg_pass = escapeshellarg($pass);

		// update svn
		if(!file_exists("$password_file"))
		{
			exec("$htpasswd -cmb $password_file $arg_user $arg_pass"); 
		} else {
			exec("$htpasswd -bm $password_file $arg_user $arg_pass"); 
		}
	}
}

