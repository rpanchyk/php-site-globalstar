<?
# Authorization:
require_once CPANEL_DIR.'/login.php';
# Head:
require_once CPANEL_DIR.'/head.php';
# Top:
require_once CPANEL_DIR.'/top.php';
?>

<h2 align="center">Смена имени/пароля администратора сайта</h2>

<?
function get_accessParam()
{
	global $db, $httpquery, $member_db;

	if ( $httpquery->request['doChng'] )
	{
		if ( is_good($httpquery->request['curr_log']) && is_good($httpquery->request['curr_pass']) )
		{
			//echo 'session_user = '.$_SESSION['fth_u_name'];
			//echo '<br>$_COOKIE[fth_u_name] = '.$_COOKIE['fth_u_name'];
			//$accArr = $db->query('SELECT * FROM '.PREFIX.'_user WHERE login=\''.$db->safesql($_SESSION['fth_u_name']).'\' LIMIT 1');
			$accArr = $db->query('SELECT * FROM '.PREFIX.'_user WHERE login=\''.$db->safesql($member_db).'\' LIMIT 1');
			
			$acc['uid']  = $accArr[0]['id'];
			$acc['user'] = $accArr[0]['login']; //echo '<br>$acc[user] = '.$acc['user'];
			$acc['pass'] = $accArr[0]['password']; //echo '<br>$acc[pass] = '.$acc['pass'];
			
			if ($acc['user'] == $httpquery->request['curr_log'] && $acc['pass'] == md5($httpquery->request['curr_pass']))
			{
				# login change:
				if (is_good($httpquery->request['new_log']))
				{	
					$result = $db->query('UPDATE '.PREFIX.'_user SET login=\''.$httpquery->request['new_log'].'\' WHERE id='.$acc['uid'].' LIMIT 1');
					if ($result)
						echo_message('<br><center>Имя пользователя успешно изменено :)</center>');
				}
				else
					echo_message('<br><center>Имя пользователя задано в неправильном формате!</center>');
				# password change:
				if (is_good($httpquery->request['new_pass']))
				{	
					$result = $db->query('UPDATE '.PREFIX.'_user SET password=\''.md5($httpquery->request['new_pass']).'\' WHERE id='.$acc['uid'].' LIMIT 1');
					if ($result)
						echo_message('<br><center>Пароль пользователя успешно изменен :)</center>');
				}
				else
					echo_message('<br><center>Пароль пользователя задан в неправильном формате!</center>');
			}
			else
				echo_message("<br><center>Неправильные данные текущего логина/пароля!");
		}
	}
}


function show_accessParam()
{
	?>
		<form method="post" action="<?=$_SERVER['SCRIPT_NAME']?>?action=acc">
		<table align="center" border="0" cellpadding="0" cellspacing="0" width="70%" 
		style=" border-color:#FFFFFF; border-style:solid; border-width:2px" bgcolor="#DDDDDD"><tr><td>
		<table border="0" cellpadding="10" cellspacing="0" width="100%" class="cp">
		<tr><td><b>Текущий логин администратора</b></td><td width="50%">
		<input type="text" name="curr_log" maxlength="256" value="" style="width:100%" class="bbc">
		</td></tr></table></td></tr></table>
		<br>
		<table align="center" border="0" cellpadding="0" cellspacing="0" width="70%" 
		style=" border-color:#FFFFFF; border-style:solid; border-width:2px" bgcolor="#DDDDDD"><tr><td>
		<table border="0" cellpadding="10" cellspacing="0" width="100%" class="cp">
		<tr><td><b>Текущий пароль администратора</b></td><td width="50%">
		<input type="password" name="curr_pass" maxlength="256" value="" style="width:100%" class="bbc">
		</td></tr></table></td></tr></table>
		<br>
		<br>
		<table align="center" border="0" cellpadding="0" cellspacing="0" width="70%" 
		style=" border-color:#FFFFFF; border-style:solid; border-width:2px" bgcolor="#DDDDDD"><tr><td>
		<table border="0" cellpadding="10" cellspacing="0" width="100%" class="cp">
		<tr><td><b>Новый логин администратора</b></td><td width="50%">
		<input type="text" name="new_log" maxlength="256" value="" style="width:100%" class="bbc">
		</td></tr></table></td></tr></table>
		<br>
		<table align="center" border="0" cellpadding="0" cellspacing="0" width="70%" 
		style=" border-color:#FFFFFF; border-style:solid; border-width:2px" bgcolor="#DDDDDD"><tr><td>
		<table border="0" cellpadding="10" cellspacing="0" width="100%" class="cp">
		<tr><td><b>Новый пароль администратора</b></td><td width="50%">
		<input type="password" name="new_pass" maxlength="256" value="" style="width:100%" class="bbc">
		</td></tr></table></td></tr></table>
		<br>

		<table align="center" border="0" cellpadding="0" cellspacing="0" width="70%"><tr><td>
		<input type="hidden" name="module" value="acc">
		<input type="submit" name="doChng" value="Отправить" class="bbc">
		</td></tr></table>
		</form>
	<?
}


function is_good($value)
{
	if ($value == '' || !preg_match("/^[a-zA-Z0-9]+$/", $value))
		return 0;
	return 1;
}


get_accessParam();
show_accessParam();


# Foot:
require_once CPANEL_DIR.'/foot.php';

die();

?>