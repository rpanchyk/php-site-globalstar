<?php
@error_reporting(E_ALL ^E_NOTICE);
define( 'FIRETROTHEART', true );
define( 'SLASH', '/' );
define( 'ROOT_DIR', dirname(__FILE__).'/../..' );
define( 'ENGINE_DIR', ROOT_DIR . SLASH . 'heart' );
require_once ENGINE_DIR.'/inc/dbconfig.php';
require_once ENGINE_DIR.'/classes/exception.class.php';
require_once ENGINE_DIR.'/classes/mysql.class.php';
require_once ENGINE_DIR.'/classes/httpquery.class.php';

$ex = new fth_exception;
$db = new fth_mysql;
$httpquery = new fth_httpquery;

if ( intval($httpquery->request['shw']) )
{
	switch ( intval($httpquery->request['shw']) )
	{
		case 1: // feedback
			require_once ENGINE_DIR . SLASH . 'mod' . SLASH . 'sendmail.php';
			break;
		case 2: // online order
			
			break;
		default:
			$ex->hack_ex();
			break;
	}
}

die();
?>