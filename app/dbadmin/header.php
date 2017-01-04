<head>
	<title>Quansis Systems</title>
	<link rel="stylesheet" type="text/css" href="admin.css">
</head>
<body>
	<div class="header">
		<div class="loginbox"><?php
	if ($login->user)
	{
	?>
	Hello <?= $login->user['name_first'] ?> <?= $login->user['name_last'] ?><br />
	<a href="<?= $_SERVER['SCRIPT_NAME'] ?>?logout=1">Power Off</a>
	<?php
	}
	else
	{
	?>
	<form method="post" action="<?= $_SERVER['SCRIPT_NAME'] ?>">
		email<input name="u" /><br />
		Password<input name="p" /><br />
		<input type="submit" value="Login" />
	</form>
	<?php
	}
	?>
		</div>
	</div>
