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
?>
<h2>Apache Configuration</h2>
<p>This configuration has been tested in Ubuntu Linux with Apache 2, but it should work in must modern distros.</p>

<h3>prerequisites</h3>
<ul>
	<li>Apache 2</li>
	<li>mod_php5 (libapache2-mod-php5 in Ubuntu)</li>
	<li>
		for Git
		<ul>
			<li>Git 1.6.6 or later</li>
		</ul>
	</li>
	<li>
		for Subversion
		<ul>
			<li>Subversion 1.6.6 or later</li>
			<li>Subversion server modules for Apache. (libapache2-svn in Ubuntu)</li>
		</ul>
	</li>
</ul>



<h3>Installation</h3>
Download the latest version of RepoMan from repom


<h3>Enable GIT over HTTP in Apache</h3>

<?php ob_start(); ?>
SetEnv GIT_PROJECT_ROOT /srv/repoman/git
SetEnv GIT_HTTP_EXPORT_ALL
ScriptAlias /git/ /usr/lib/git-core/git-http-backend/
<Location /git>
	AuthType Basic
	AuthName "Git"
	AuthUserFile /srv/repoman/password
	Require valid-user
</Location>
<?php $code = ob_get_clean(); ?>
<pre class="code"><code><?php echo htmlspecialchars($code); ?></code></pre>




<h3>Enable Subversion over HTTP in Apache</h3>
<?php ob_start(); ?>
<Location /svn>
	DAV svn
	SVNParentPath /srv/repoman/svn
	AuthType Basic
	AuthName "SVN"
	AuthUserFile /srv/repoman/password
	Require valid-user
</Location>
<?php $code = ob_get_clean(); ?>

<pre class="code"><code><?php echo htmlspecialchars($code); ?></code></pre>

