<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html>
<head>
<title><?php echo App::name();?></title>
<link rel="stylesheet" type="text/css" href="<?php echo BASEURL?>/view/template.css" media="screen" />
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
			<li><a href="<?php echo BASEURL?>/do/users_edit.php?username=<?php echo $_SESSION['sess']['username']?>">My Password</a></li>
			<li>&nbsp;</li>
			<li><a href="<?php echo BASEURL?>/do/help.php">Help</a></li>
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
