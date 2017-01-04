<?php
require_once('config.php');

if (param('email', ''))
{
	//$permission = $database->insert_array(array('js'=>0, 'jp'=>0, 'admin'=>1, 'sales'=>1), 'permissions');
	$permission = $database->insert_array(array('js'=>0, 'jp'=>0, 'admin'=>0, 'sales'=>0), 'permissions');
	//print_r($permission);
	print_r ($login->newuser(array(
		'email'=>param('email', ''),
		'password'=>param('password', ''),
		'name_first'=>param('name_first', ''),
		'permission_id'=>$permission['id'])
		)
	);
}
?>
<form action="#" method="POST">
	user email <input name="email" /><br />
	password <input name="password" /><br />
	name_first <input name="name_first" /><br />
	<input type="submit" />	
</form>
