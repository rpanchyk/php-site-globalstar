<?php

@error_reporting(E_ALL ^E_NOTICE);

define( 'FIRETROTHEART', true );
define( 'SLASH', '/' );
define( 'ROOT_DIR', dirname(__FILE__).'/../..' );
define( 'ENGINE_DIR', ROOT_DIR . SLASH . 'heart' );
define( 'CACHE_DIR', ENGINE_DIR . SLASH . 'cache' );
define( 'CPANEL_DIR', ENGINE_DIR . SLASH . 'cpan' );
define( 'UPLOAD_DIR', ROOT_DIR . SLASH . 'upload' );

require_once ENGINE_DIR.'/inc/dbconfig.php';

require_once ENGINE_DIR.'/classes/exception.class.php';
require_once ENGINE_DIR.'/classes/mysql.class.php';
require_once ENGINE_DIR.'/classes/httpquery.class.php';
require_once ENGINE_DIR.'/classes/templates.class.php';
require_once ENGINE_DIR.'/classes/db2html.class.php';
require_once ENGINE_DIR.'/classes/manager.class.php';
require_once ENGINE_DIR.'/classes/mailer.class.php';

require_once ENGINE_DIR.'/functions/get_postlist.func.php';
require_once ENGINE_DIR.'/functions/echo_message.func.php';

$ex = new fth_exception;

$db = new fth_mysql;

$httpquery = new fth_httpquery;

$manager = new fth_manager;

$tpl = new fth_template;

$content = new db2html;

@session_start();

?>