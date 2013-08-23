<?php
if ( !defined( 'FIRETROTHEART' ) )
{
  die( '<h4> Hacking attempt! </h4>' );
}

$is_logged = FALSE;
global $member_db;

if (isset($httpquery->request['action']) AND $httpquery->request['action'] == 'logout') 
{
	logout_func();
}

if ( isset($httpquery->request['doLogin']) && $httpquery->request['login_name'])
{
	$userName = $httpquery->request['login_name'];
	$userPass = md5( $httpquery->request['login_pass'] );

	if ( !preg_match("/[\||\'|\"|\!]/", $userPass) ) 
	{
		$passArr = $db->query('SELECT password FROM '.PREFIX.'_user WHERE login=\''.$httpquery->request['login_name'].'\' LIMIT 1');
		$dbPass = $passArr[0]['password'];
		if ( $dbPass == $userPass )
		{
			setcookie( 'fth_u_name', $userName, time()+3600*24*30*12 );
			setcookie( 'fth_u_pass', $dbPass,   time()+3600*24*30*12 );
			@session_register('fth_u_name');
			@session_register('fth_u_pass');
			$_SESSION['fth_u_name'] = $userName;
			$_SESSION['fth_u_pass'] = $userPass;
			$member_db = $_SESSION['fth_u_name'];
			$is_logged = TRUE;
		}
	}
} 
elseif ( isset($_SESSION['fth_u_name']) ) 
{
	$passArr = $db->query('SELECT password FROM '.PREFIX.'_user WHERE login=\''.$db->safesql($_SESSION['fth_u_name']).'\' LIMIT 1');
	if ( $dbPass = $passArr[0]['password'] )
		if ( $dbPass == $_SESSION['fth_u_pass'] )
		{
			$member_db = $_SESSION['fth_u_name'];
			$is_logged = TRUE;
		}
} 
elseif ( $_COOKIE['fth_u_name'] && $_COOKIE['fth_u_pass'] ) 
{
	$passArr = $db->query('SELECT password FROM '.PREFIX.'_user WHERE login=\''.$db->safesql($_COOKIE['fth_u_name']).'\' LIMIT 1');
	if ( $dbPass = $passArr[0]['password'] )
		if ( $dbPass == $_COOKIE['fth_u_pass'] )
		{
			$member_db = $_COOKIE['fth_u_name'];
			$is_logged = TRUE;
		}
}

if ( $is_logged == FALSE ) 
{
	logout_func();
}

function login_form()
{
	# Head:
	require_once CPANEL_DIR.'/head.php';
	?>
		<br>
		<h4 align="center">Login, please...</h4>
		<form method="post" action="<?=$_SERVER['SCRIPT_NAME']?>?action=login">
		<table align="center" border="0" cellpadding="0" cellspacing="0" width="25%" 
		style=" border-color:#FFFFFF; border-style:solid; border-width:2px" bgcolor="#DDDDDD">
		<tr>
			<td>
				<table border="0" cellpadding="10" cellspacing="0" width="100%" class="cp">
					<tr>
						<td>
							<b>Name</b></td><td width="50%">
							<input type="text" name="login_name" maxlength="50" value="" style="width:100%" class="bbc">
						</td>
					</tr>
					<tr>
						<td>
							<b>Password</b></td><td>
							<input type="password" name="login_pass" maxlength="50" value="" style="width:100%" class="bbc">
						</td>
					</tr>
				</table>
			</td>
		</tr>
		</table>
		<br>
		<div align="center"> <input type="submit" name="doLogin" value="Enter to system" class="bbc"> </div>
		</form>
	<?
	# Foot:
	require_once CPANEL_DIR.'/foot.php';
}

function logout_func()
{
	global $userName;
	global $userPass;
	$userName = '';
	$userPass = '';
	setcookie( 'fth_u_name', "", 0 );
	setcookie( 'fth_u_pass', "", 0 );
	@session_destroy();
	@session_unset();
	login_form();
	die();
}

function check_login($username, $md5_password)
{
    global $member_db, $db, $user_group, $lang;

	if ($username == "" OR $md5_password == "") return false;

	$result = FALSE;

	$username 	  = $db->safesql($username);
	$md5_password = md5($md5_password);

	$res = $db->query("SELECT * FROM " . PREFIX . "_user where login='$username' and password='$md5_password' LIMIT 1");
	$member_db = $res[0]['login'];

	$db->free();
	return $result;
}
?>