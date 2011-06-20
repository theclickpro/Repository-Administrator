<?/*

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
class Acl
{
	public static function isEnabled()
	{
		$db = Db::inst('pref');
		if (!$db->exists("acl"))
		{
			return false;
		}

		$acl = $db->get('acl');
		if (!isset($acl['enabled']))
		{
			return false;
		}

		return $acl['enabled'];
	}

	public static function disable()
	{
		$db = Db::inst('pref');
		$acl = $db->get('acl');
		$acl['enabled'] = false;
		$db->set('acl', $acl);
	}
	public static function enable()
	{
		$db = Db::inst('pref');
		$acl = $db->get('acl');
		$acl['enabled'] = true;
		$db->set('acl', $acl);
	}

	public static function generate()
	{
		if (self::isEnabled())
		{
			$ret = file_put_contents(PATH.'/acl.conf', self::_genEnabledAcl());
		}
		else
		{
			$ret = file_put_contents(PATH.'/acl.conf', self::_genDisabledAcl());
		}

		return $ret;
	}

	private static function _genDisabledAcl()
	{
		$txt = "\n";
		$txt .= "[/]\n";
		$txt .= "* = rw\n";
		$txt .= "\n";
		return $txt;
	}

	private static function _genEnabledAcl()
	{
		$groupArr	= Db::inst('group')->getAllAsArr();
		$aclArr		= Db::inst('acl')->getAllAsArr();

		$txt = "\n";

		$txt .= "[groups]\n";
		foreach ($groupArr as $group)
		{
			$name = $group['group'];
			//echo '<pre>'; print_r($group); exit;
			$txt .= "$name = " . implode(', ', $group['users']) . "\n";
		}
		$txt .= "\n";
		$txt .= "\n";

		foreach ($aclArr as $acl)
		{
			$repo = $acl['repository'];
			foreach ($acl['paths'] as $path => $users)
			{
				$txt .= "[$repo:$path]\n";
				foreach ($users as $user => $al)
				{
					$txt .= "$user = $al\n";
				}
			}
		}
		$txt .= "\n";

		return $txt;
	}
}



