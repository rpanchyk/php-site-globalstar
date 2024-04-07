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
require_once ENGINE_DIR.'/classes/manager.class.php';
$ex = new fth_exception;
$db = new fth_mysql;
$httpquery = new fth_httpquery;
$manager = new fth_manager;


//$action = 'http://'.$_SERVER['SERVER_NAME'].':'.$_SERVER['SERVER_PORT'].'/cp.php?action=pst';
$action = $_SERVER['SCRIPT_NAME'];

if (intval($httpquery->request['id']))
{
	$pArr = $db->query( 'SELECT * FROM '.PREFIX.'_post WHERE id = '.$httpquery->request['id'].' LIMIT 1' );
	//$cArr = $db->query( 'SELECT * FROM '.PREFIX.'_category WHERE id = '.$pArr[0]['cat_id'].' LIMIT 1' );
}

$cArr = $db->query( 'SELECT * FROM '.PREFIX.'_category WHERE id = '.intval($httpquery->request['cat_id']).' LIMIT 1' );
$select_category = '<select name="category">';
if (intval($cArr[0]['id']))
	{ $select_category .= '<option value="'.$cArr[0]['id'].'">'.$cArr[0]['rusname'].'</option>'; }

$catArr = $db->query('SELECT * FROM '.PREFIX.'_category');
//echo '<pre>'; print_r($catArr); echo '</pre>';
foreach ( $catArr as $value )
{
	if ($value['id'] != $cArr[0]['id'])
		$select_category .= '<option value="'.$value['id'].'">'.$value['rusname'].'</option>';
}
$select_category .= '</select>';

$title = 'Редактирование записи';
$head = ($pArr[0]['head']) ? stripslashes($pArr[0]['head']) : '';
$post = ($pArr[0]['post']) ? stripslashes($pArr[0]['post']) : 'Текст записи';
$image = ($pArr[0]['xfield6']) ? stripslashes($pArr[0]['xfield6']) : '';
$short_post = ($pArr[0]['xfield5']) ? stripslashes($pArr[0]['xfield5']) : '';
$datetime = ($pArr[0]['date_pub']) ? stripslashes($pArr[0]['date_pub']) : '';
$ord = ($pArr[0]['ord']) ? stripslashes($pArr[0]['ord']) : '';

// Date in the past
header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
header("Cache-Control: no-cache");
header("Pragma: no-cache");
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Language" content="ru-ru">
<meta http-equiv="content-type" content="text/html;charset=windows-1251" />
<title><?=$title?></title>
<!-- TinyMCE -->
<script type="text/javascript" src="tiny_mce.js"></script>
<script type="text/javascript">
	tinyMCE.init({
		// General options
		mode : "exact",
		elements : "post",
		theme : "advanced",
		plugins : "safari,pagebreak,style,layer,table,save,advhr,advimage,advlink,emotions,iespell,inlinepopups,insertdatetime,preview,media,searchreplace,print,contextmenu,paste,directionality,fullscreen,noneditable,visualchars,nonbreaking,xhtmlxtras,template",

		language: "en",
		// Theme options
		theme_advanced_buttons1 : "-save,newdocument,|,bold,italic,underline,strikethrough,|,justifyleft,justifycenter,justifyright,justifyfull,styleselect,formatselect,fontselect,fontsizeselect",
		theme_advanced_buttons2 : "cut,copy,paste,pastetext,pasteword,|,search,replace,|,bullist,numlist,|,outdent,indent,blockquote,|,undo,redo,|,link,unlink,anchor,image,cleanup,help,code,|,insertdate,inserttime,preview,|,forecolor,backcolor",
		theme_advanced_buttons3 : "tablecontrols,|,hr,removeformat,visualaid,|,sub,sup,|,charmap,emotions,iespell,media,advhr,|,print,|,ltr,rtl,|,fullscreen",
		theme_advanced_buttons4 : "insertlayer,moveforward,movebackward,absolute,|,styleprops,|,cite,abbr,acronym,del,ins,attribs,|,visualchars,nonbreaking,template,pagebreak",
		theme_advanced_toolbar_location : "top",
		theme_advanced_toolbar_align : "left",
		theme_advanced_statusbar_location : "bottom",
		theme_advanced_resizing : true,
		
		extended_valid_elements : "hr[class|width|size|noshade]",
		file_browser_callback : "ajaxfilemanager",
		paste_use_dialog : false,
		theme_advanced_resizing : true,
		theme_advanced_resize_horizontal : true,
		apply_source_formatting : true,
		force_br_newlines : true,
		force_p_newlines : false,
		forced_root_block : 'div',

		// Example content CSS (should be your site CSS)
		content_css : "css/content.css",

		// Drop lists for link/image/media/template dialogs
		template_external_list_url : "lists/template_list.js",
		external_link_list_url : "lists/link_list.js",
		external_image_list_url : "lists/image_list.js",
		media_external_list_url : "lists/media_list.js"
	});
	
	function ajaxfilemanager(field_name, url, type, win) {
		var ajaxfilemanagerurl = "plugins/ajaxfilemanager/ajaxfilemanager.php";
		switch (type) {
			case "image":
				break;
			case "media":
				break;
			case "flash": 
				break;
			case "file":
				break;
			default:
				return false;
		}
		tinyMCE.activeEditor.windowManager.open({
			url: "plugins/ajaxfilemanager/ajaxfilemanager.php",
			width: 782,
			height: 440,
			inline : "yes",
			close_previous : "no"
		},{
			window : win,
			input : field_name
		});
	}
</script>

<script type="text/javascript">
	// Картинка
	tinyMCE.init({
		// General options
		mode : "exact",
		elements : "image",
		theme : "advanced",
		plugins : "safari,pagebreak,style,layer,table,save,advhr,advimage,advlink,emotions,iespell,inlinepopups,insertdatetime,preview,media,searchreplace,print,contextmenu,paste,directionality,fullscreen,noneditable,visualchars,nonbreaking,xhtmlxtras,template",

		language: "en",
		// Theme options
		theme_advanced_buttons1 : "justifyleft,justifycenter,justifyright,justifyfull,|,cut,copy,paste,pastetext,pasteword,|,outdent,indent,|,undo,redo,|,link,unlink,image,cleanup,code,|,preview,emotions,iespell,media",
		theme_advanced_buttons2 : "",
		theme_advanced_buttons3 : "",
		theme_advanced_buttons4 : "",
		theme_advanced_toolbar_location : "top",
		theme_advanced_toolbar_align : "left",
		theme_advanced_statusbar_location : "bottom",
		theme_advanced_resizing : true,
		
		extended_valid_elements : "hr[class|width|size|noshade]",
		file_browser_callback : "ajaxfilemanager",
		paste_use_dialog : false,
		theme_advanced_resizing : true,
		theme_advanced_resize_horizontal : true,
		apply_source_formatting : true,
		force_br_newlines : true,
		force_p_newlines : false,
		forced_root_block : 'div',

		// Example content CSS (should be your site CSS)
		content_css : "css/content.css",

		// Drop lists for link/image/media/template dialogs
		template_external_list_url : "lists/template_list.js",
		external_link_list_url : "lists/link_list.js",
		external_image_list_url : "lists/image_list.js",
		media_external_list_url : "lists/media_list.js"
	});
	
	function ajaxfilemanager(field_name, url, type, win) {
		var ajaxfilemanagerurl = "plugins/ajaxfilemanager/ajaxfilemanager.php";
		switch (type) {
			case "image":
				break;
			case "media":
				break;
			case "flash": 
				break;
			case "file":
				break;
			default:
				return false;
		}
		tinyMCE.activeEditor.windowManager.open({
			url: "plugins/ajaxfilemanager/ajaxfilemanager.php",
			width: 782,
			height: 440,
			inline : "yes",
			close_previous : "no"
		},{
			window : win,
			input : field_name
		});
	}
</script>

<script type="text/javascript">
	// Короткая новость
	tinyMCE.init({
		// General options
		mode : "exact",
		elements : "short_post",
		theme : "advanced",
		plugins : "safari,pagebreak,style,layer,table,save,advhr,-advimage,advlink,emotions,iespell,inlinepopups,insertdatetime,preview,media,searchreplace,print,contextmenu,paste,directionality,fullscreen,noneditable,visualchars,nonbreaking,xhtmlxtras,template",

		language: "en",
		// Theme options
		theme_advanced_buttons1 : "justifyleft,justifycenter,justifyright,justifyfull,|,cut,copy,paste,pastetext,pasteword,|,outdent,indent,|,undo,redo,|,link,unlink,-image,cleanup,code,|,preview,emotions,iespell,media",
		theme_advanced_buttons2 : "",
		theme_advanced_buttons3 : "",
		theme_advanced_buttons4 : "",
		theme_advanced_toolbar_location : "top",
		theme_advanced_toolbar_align : "left",
		theme_advanced_statusbar_location : "bottom",
		theme_advanced_resizing : true,
		
		extended_valid_elements : "hr[class|width|size|noshade]",
		file_browser_callback : "ajaxfilemanager",
		paste_use_dialog : false,
		theme_advanced_resizing : true,
		theme_advanced_resize_horizontal : true,
		apply_source_formatting : true,
		force_br_newlines : true,
		force_p_newlines : false,
		forced_root_block : 'div',

		// Example content CSS (should be your site CSS)
		content_css : "css/content.css",

		// Drop lists for link/image/media/template dialogs
		template_external_list_url : "lists/template_list.js",
		external_link_list_url : "lists/link_list.js",
		external_image_list_url : "lists/image_list.js",
		media_external_list_url : "lists/media_list.js"
	});
</script>
<!-- /TinyMCE -->

</head>
<body>
<?
if (empty($httpquery->request['doSend']))
{
?>
<form method="post" action="<?=$action?>">
	<input type="submit" name="doSend" value="Отправить" />
	<div>&nbsp;</div>

	<table align="center" border="0" cellpadding="0" cellspacing="0" width="100%" 
	style="border-color:#EEEEEE; border-style:solid; border-width:2px" bgcolor="#FFFFFF">
	
	<tr style="text-align:center">
		<td> 
			<table align="center" border="0" cellpadding="0" cellspacing="0" width="100%">
			<tr> 
				<td width="10%">Название</td> 
				<td style="text-align:left"><input type="text" name="head" maxlength="256" value="<?=$head?>" style="width:99%"></td> 
			</tr>
			</table>
		</td>
	</tr>
	<tr style="text-align:center">
		<td> 
			<table border="0" cellpadding="0" cellspacing="0" width="100%">
			<tr> 
				<td width="10%">Категория</td> 
				<td style="text-align:left" width="10%"><?=$select_category?></td>
				<td width="20%">Порядок (не обязательно)</td> 
				<td style="text-align:left"><input type="text" name="ord" maxlength="11" value="<?=$ord?>" style="width:20%"></td>
			</tr>
			</table>
		</td>
	</tr>
	<tr style="font-weight:bold;text-align:center">
		<td>
			<textarea id="post" name="post" rows="25" cols="80" style="width:99%;"><?=$post?></textarea>
		</td>
	</tr>
	
	</table>
	<?
		if ($cArr[0]['name'] != 'abour' && $cArr[0]['name'] != 'contacts')
		{
		?>
		<div>&nbsp;</div>
		<table align="center" border="0" cellpadding="0" cellspacing="0" width="100%" 
		style="border-color:#EEEEEE; border-style:solid; border-width:2px" bgcolor="#FFFFFF">
			<tr>
				<td>
					<div align="left">Картинка:</div>
					<textarea id="image" name="image" rows="10" cols="50" style="width:99%;"><?=$image?></textarea>
				</td>
			</tr>
		</table>
		<div>&nbsp;</div>
		<table align="center" border="0" cellpadding="0" cellspacing="0" width="100%" 
		style="border-color:#EEEEEE; border-style:solid; border-width:2px" bgcolor="#FFFFFF">
			<tr>
				<td>
					<div align="left">Короткая новость:</div>
					<textarea id="short_post" name="short_post" rows="10" cols="50" style="width:99%;"><?=$short_post?></textarea>
				</td>
			</tr>
		</table>
		<?
		}
	?>
	
	<div>&nbsp;</div>
	<input type="hidden" name="id" value="<?=intval($httpquery->request['id'])?>">
	<input type="submit" name="doSend" value="Отправить" />
</form>
<?
}
else
{
	if (!empty($httpquery->request['doSend']) && intval($httpquery->request['id']))
	{
		// Update
		$paramArr = array();
		$id = $httpquery->request['id'];
		$paramArr['parent_id'] = '0';
		$paramArr['cat_id'] = $httpquery->request['category'];
		$paramArr['head'] = '\''.trim($httpquery->request['head']).'\'';
		$paramArr['post'] = '\''.trim($httpquery->request['post']).'\'';
		$paramArr['xfield5'] = '\''.trim($httpquery->request['short_post']).'\'';
		$paramArr['xfield6'] = '\''.trim($httpquery->request['image']).'\'';
		$paramArr['date_edit'] = 'CURRENT_TIMESTAMP';
		if (!empty($httpquery->request['ord']))
			$paramArr['ord'] = $httpquery->request['ord'];
		
		if ($httpquery->request['datetime_year'] &&
			$httpquery->request['datetime_month'] &&
			$httpquery->request['datetime_day'] &&
			$httpquery->request['datetime_hour'] &&
			$httpquery->request['datetime_minute']
		)
		{
			$paramArr['date_pub'] = '\''.date("Y-m-d H:i:s", mktime($httpquery->request['datetime_hour'], $httpquery->request['datetime_minute'], 0,
				$httpquery->request['datetime_month'], $httpquery->request['datetime_day'], $httpquery->request['datetime_year'])).'\'';
		}
		else
		{
			$paramArr['date_pub'] = 'NULL';
			if ($cArr[0]['name'] == 'afisha')
				echo 'Время не было указано.';
		}
		
		if (
				$id && 
				$paramArr['cat_id'] && 
				$paramArr['head'] && 
				$paramArr['post']
			)
		{
			$manager->upd(PREFIX.'_post', $paramArr, 'id = '.$id);
		}
	}
	else
	{
		// Add
		$paramArr = array();
		$paramArr['parent_id'] = '0';
		$paramArr['cat_id'] = $httpquery->request['category'];
		$paramArr['head'] = '\''.trim($httpquery->request['head']).'\'';
		$paramArr['post'] = '\''.trim($httpquery->request['post']).'\'';
		$paramArr['xfield5'] = '\''.trim($httpquery->request['short_post']).'\'';
		$paramArr['xfield6'] = '\''.trim($httpquery->request['image']).'\'';
		$paramArr['date_add'] = 'CURRENT_TIMESTAMP';
		$paramArr['date_edit'] = 'CURRENT_TIMESTAMP';

		if ($httpquery->request['datetime_year'] &&
				$httpquery->request['datetime_month'] &&
				$httpquery->request['datetime_day'] &&
				$httpquery->request['datetime_hour'] &&
				$httpquery->request['datetime_minute']
			)
		{
			$paramArr['date_pub'] = '\''.date("Y-m-d H:i:s", mktime($httpquery->request['datetime_hour'], $httpquery->request['datetime_minute'], 0,
						$httpquery->request['datetime_month'], $httpquery->request['datetime_day'], $httpquery->request['datetime_year'])).'\'';
		}
		else
		{
			$paramArr['date_pub'] = 'NULL';
			if ($cArr[0]['name'] == 'afisha')
				echo 'Время не было указано.';
		}
		
		if (
				$paramArr['cat_id'] && 
				$paramArr['head'] && 
				$paramArr['post']
			)
		{
			$manager->add(PREFIX.'_post', $paramArr);
		}		
	}
	?>
	<script type="text/javascript">
	
	$w = 300;
	$h = 250;
	window.resizeTo($w, $h);
	$l = (window.screen.availWidth - $w) / 2;
	$t = (window.screen.availHeight - $h) / 2;
	window.moveTo($l,$t);
	
	</script>
	<center>
		<h5>Операция завершена</h5>
		<br>
		<input type="button" onclick="javascript:window.close()" value="Закрыть" />
	</center>
	<?
}
?>
</body>
</html>
