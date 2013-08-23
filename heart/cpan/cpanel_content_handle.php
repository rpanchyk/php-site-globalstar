<?php
# Authorization:
require_once CPANEL_DIR.'/login.php';

if (!empty($httpquery->request['action']))
{
	switch ($httpquery->request['action'])
	{
	case 'cat':
		require_once CPANEL_DIR.'/catman.php';
		break;
	case 'pst':
		require_once CPANEL_DIR.'/postman.php';
		break;
	case 'cfg':
		require_once CPANEL_DIR.'/settings.php';
		break;
	case 'acc':
		require_once CPANEL_DIR.'/access.php';
		break;
	default:
		//require_once(ENGINE_DIR."/category.php");
	  	//exit();
		break;
	}
}
?>