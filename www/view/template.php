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
*/?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html>
<head>
<title><?php echo App::name();?></title>
<link rel="stylesheet" type="text/css" href="<?php echo BASEURL?>/view/template.css" media="screen" />
<script type="text/javascript" src="<?php echo BASEURL?>/view/jquery.js" media="screen"></script>
</head>
<body>
<div id="page">
	<div id="header">
		<h1><?php echo App::name();?></h1>
		<?php if (isLogged()) : ?>
		<div id="header_info">Logged in as <b><?php echo $_SESSION['sess']['username']; ?></b>&nbsp;&nbsp;(<a href="<?php echo BASEURL?>/do/logout.php">Logout</a>)
		</div>
		<?php endif;?>
	</div>
	<div id="middle">
		<?php if (isLogged()) : ?>
		<div id="left_menu">
		<ul>
			<li><a href="<?php echo BASEURL?>/do/repos.php">Repositories</a></li>
			<li><a href="<?php echo BASEURL?>/do/users.php">Users</a></li>
			<li><a href="<?php echo BASEURL?>/do/perm.php">Permissions</a></li>
			<li>&nbsp;</li>
			<li><a href="<?php echo BASEURL?>/do/users_edit.php?username=<?php echo $_SESSION['sess']['username']?>">My Password</a></li>
			<!--li>&nbsp;</li>
			<li><a href="<?php echo BASEURL?>/do/help.php">Help</a></li-->
		</ul>
		</div>
		<?php endif;?>


		<div id="content">
			<?php $msg = getAlert(); if ($msg) : ?>
			<div class="alert"><?php echo $msg?></div>
			<?php endif; ?>

			<?php echo  $this->content ?>
		</div>
	</div>
	<div id="footer"></div>
</div>
</body>
</html>
