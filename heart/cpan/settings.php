<?php
# Authorization:
require_once CPANEL_DIR.'/login.php';
# Head:
require_once CPANEL_DIR.'/head.php';
# Top:
require_once CPANEL_DIR.'/top.php';


function show_Params()
{
//	echo "<br>ext = ".$par['ua_ext'];
//	echo "<br>W = ".$par['img_w'];
//	echo "<br>menu_W = ".$par['img_menu_w'];
	require_once ENGINE_DIR.'/inc/config.php';
	?>
		<h2 align="center">Парметры для конфигурирования</h2>
		<form method="post" action="<?=$_SERVER['SCRIPT_NAME']?>?action=cfg">
		
		<table align="center" border="0" cellpadding="0" cellspacing="0" width="70%" 
		style=" border-color:#FFFFFF; border-style:solid; border-width:2px" bgcolor="#DDDDDD">
		<tr><td>
		
			<table border="0" cellpadding="10" cellspacing="0" width="100%" class="cp">
			<tr><td><b>Файлы, допустимые для загрузки на сервер</b></td><td width="50%">
			<input type="text" name="upload_allow" maxlength="256" value="<?=$config['upload_allow']?>" style="width:100%" class="bbc">
			</td></tr></table>
		
		</td></tr>
		</table>
		<br>

		<table align="center" border="0" cellpadding="0" cellspacing="0" width="70%" 
		style=" border-color:#FFFFFF; border-style:solid; border-width:2px" bgcolor="#DDDDDD"><tr><td>
		
		<table border="0" cellpadding="10" cellspacing="0" width="100%" class="cp">
		<tr><td><b>Размер уменьшеного изображения в тексте </b></td><td width="50%">
		<input type="text" name="img_w" maxlength="256" value="<?=$config['img_w']?>" style="width:20%" class="bbc">
		&nbsp; x &nbsp;
		<input type="text" name="img_h" maxlength="256" value="<?=$config['img_h']?>" style="width:20%" class="bbc">
		&nbsp; (высота Х ширина)
		</td></tr></table>
		
		</td></tr></table>
		<br>

		<table align="center" border="0" cellpadding="0" cellspacing="0" width="70%" 
		style=" border-color:#FFFFFF; border-style:solid; border-width:2px" bgcolor="#DDDDDD"><tr><td>

		<table border="0" cellpadding="10" cellspacing="0" width="100%" class="cp">
		<tr><td><b>Размер уменьшеного изображения в анонсах </b></td><td width="50%">
		<input type="text" name="img_x" maxlength="256" value="<?=$config['img_x']?>" style="width:20%" class="bbc">
		&nbsp; x &nbsp;
		<input type="text" name="img_y" maxlength="256" value="<?=$config['img_y']?>" style="width:20%" class="bbc">
		&nbsp; (высота Х ширина)
		</td></tr></table>
		
		</td></tr></table>
		<br>

<!--
//'img_dir' => ROOT_DIR.'/images/',

		<table align="center" border="0" cellpadding="0" cellspacing="0" width="70%" 
		style=" border-color:#FFFFFF; border-style:solid; border-width:2px" bgcolor="#DDDDDD">
		<tr><td>
		
			<table border="0" cellpadding="10" cellspacing="0" width="100%" class="cp">
			<tr><td><b>Папка рисунков</b></td><td width="50%">
			<input type="text" name="img_dir" maxlength="256" value="<?=$config['img_dir']?>" style="width:100%" class="bbc">
			</td></tr></table>
		
		</td></tr>
		</table>
		<br>
-->
		<table align="center" border="0" cellpadding="0" cellspacing="0" width="70%"><tr><td>
		<input type="hidden" name="module" value="cfg">
		<input type="submit" name="doSend" value="Отправить" class="bbc">
		</td></tr></table>

		</form>
	<?
}


function save_Params()
{
	global $httpquery;
	if (!empty($httpquery->request['doSend']))
	{
		$pArr['upload_allow'] = $httpquery->request['upload_allow'];
		$pArr['img_w'] = $httpquery->request['img_w'];
		$pArr['img_h'] = $httpquery->request['img_h'];
		$pArr['img_x'] = $httpquery->request['img_x'];
		$pArr['img_y'] = $httpquery->request['img_y'];
		
		$find[] 	= "'\r'";
		$replace[] 	= "";
		$find[] 	= "'\n'";
		$replace[] 	= "";

		$handler = @fopen( ENGINE_DIR.'/inc/config.php','w' );
		if ($handler)
		{
			fwrite($handler, "<?php \n\n//Configurations\n\n\$config = array (\n\n");
			foreach($pArr as $name => $value)
			{
				$value = trim(stripslashes($value));
				$value = htmlspecialchars($value, ENT_QUOTES);
				$value = preg_replace($find,$replace,$value);
	    		fwrite($handler, "'{$name}' => \"{$value}\",\n\n");
			}
			fwrite($handler, ");\n\n?>");
			fclose($handler);
		}
		else
			echo_message("Невозможно сохранить пареметры.");
	}
//echo "<pre>";
//print_r($file);
//echo "</pre>";
}
	save_Params();
	show_Params();

# Foot:
require_once CPANEL_DIR.'/foot.php';

die();

/*
<?

$config = array (

'img_x' => 150,

'img_y' => 200,

'upload_allow' => "jpg, gif, png",

);

?>
*/
?>