<?PHP
# Authorization:
require_once CPANEL_DIR.'/login.php';
# Head:
require_once CPANEL_DIR.'/head.php';
# Top:
require_once CPANEL_DIR.'/top.php';

# JavaScript:
# Default menu color:
$colorDef = "#DDDDDD";
require_once CPANEL_DIR.'/menu_color_chng.php';
?>

<table align="center" cellpadding="2" cellspacing="2" border="0" width="95%">
<tr>
	<td width="20%" valign="top">
		<table align="center" cellpadding="10" cellspacing="2" border="0" width="95%">
		<?
			$cArr = $db->query( 'SELECT * FROM '.PREFIX.'_category ORDER BY ord' );
			//echo '<pre>'; print_r($cArr); echo '</pre>';
			if (count($cArr))
			{
				foreach ( $cArr as $val )
				{
					?>
						<tr style="cursor:pointer" onClick="location.href='<?=$_SERVER['SCRIPT_NAME']?>?action=pst&id=<?=$val['id']?>'">
							<td bgcolor="<?=$colorDef?>"
							onMouseOver="mOverBg(this)"
							onMouseOut="mOutBg(this)">
								<b><?=$val['rusname']?></b>
							</td>
						</tr>
					<?
				}
			}
		?>
		</table>
	</td>

	<td valign="top">
	
	<?php
	//echo '<pre>'; print_r($httpquery->request); echo '</pre>';
	// New Post
	if (!empty($httpquery->request['action']) && !empty($httpquery->request['doNewPost']))
	{
		editPost_form(intval($httpquery->request['cat_id']));
	}

	// Process Post
	if (
		!empty($httpquery->request['action']) && 
		$httpquery->request['action'] == 'pst' &&
		!empty($httpquery->request['id'])
		)
	{
		if ( intval($httpquery->request['edt_id']) )
		{
			// update
			editPost_form(intval($httpquery->request['id']), intval($httpquery->request['edt_id']));
		}
		if ( intval($httpquery->request['del_id']) && empty($httpquery->request['delete']) )
		{
			// delete
			?>
			<script type="text/javascript">
				if ( window.confirm('Удалить запись ?')==true )
					{ window.document.location.href="<?= ($_SERVER['SCRIPT_NAME'].'?action=pst&id='.$httpquery->request['id'].'&del_id='.$httpquery->request['del_id'].'&delete=y') ?>"; }
			</script>
			<?
		}
		if ( intval($httpquery->request['del_id']) && $httpquery->request['delete'] == 'y')
			$manager->del(PREFIX.'_post', 'id = '.intval($httpquery->request['del_id']));
	}
	
	if (!empty($httpquery->request['action']) && !empty($httpquery->request['id']))
	{
		$catArr = $db->query( 'SELECT id FROM '.PREFIX.'_category WHERE id = \''.$httpquery->request['id'].'\' LIMIT 1' );
		if (intval($catArr[0]['id']))
		{
			// Show post list
			$query = 'SELECT id,head,date_edit,ord FROM '.PREFIX.'_post WHERE cat_id = '.$catArr[0]['id'].' ORDER BY ord,head';
			$postArr = $db->query( $query );
			listPost_form($catArr[0]['id'], $postArr);
		}
	}
	else
	{
		echo '<h2 align=center>Добро пожаловать в раздел редактирования содержимого сайта.</h2>';
	}
	?>
	</td>

</tr>
</table>

<?
# Foot:
require_once CPANEL_DIR.'/foot.php';

function editPost_form($cat_id = 0, $id = 0)
{
	?>
	<script type="text/javascript">
	$url = 'http://<?=$_SERVER['SERVER_NAME']?>:<?=$_SERVER['SERVER_PORT']?>/heart/tiny_mce/editor.php?cat_id=<?=$cat_id?>&id=<?=$id?>';
	$h = window.screen.availHeight - 160;
	$w = window.screen.availWidth - 100;
	$l = (window.screen.availWidth - $w) / 2;
	$t = (window.screen.availHeight - $h) / 2;
	$param = "toolbar=0, scrollbars=1, height="+$h+", width="+$w+", top="+$t+", left="+$l;
	//window.open($url, 'editor', $param);
	window.open($url, "_blank");

	setTimeout(function() { window.document.location.href="<?= ($_SERVER['SCRIPT_NAME'].'?action=pst&id='.$cat_id) ?>"; }, 200);
	
	</script>
	<?
}

function listPost_form($cat_id, $pArr)
{
	?>
		<form method="post" action="<?=$_SERVER['SCRIPT_NAME']?>?action=pst">
			<input type="hidden" name="cat_id" value="<?=$cat_id?>">
			<input type="submit" name="doNewPost" value="Добавить" class="bbc">
		</form>
		<div>&nbsp;</div>
	<?
	if (!$pArr)
		return;
	global $httpquery;
	?>	
	<table align="left" cellpadding="2" cellspacing="2" border="0" width="100%"
	style="border: 1px solid #C1DAD7;font: 10px Verdana;">
	<tr style="font-weight:bold;text-align:center;background-color:#3CB371;color:#FFF;">
		<td width="1%">ORDER</td>
		<td width="1%">EDIT</td>
		<td>Название</td>
		<td width="10%">Просмотр</td>
		<td width="10%">Дата создания</td>
		<td width="10%">Удалить</td>
	</tr>
	<?
	$i=0;
	foreach ($pArr as $value)
	{
		if ($i % 2)	{$bgcolor = 'FDF5E6';} else	{$bgcolor = 'FFE4B5';}
		echo '<tr style="background-color:#'.$bgcolor.'">';
		echo '<td align="center">'.$value['ord'].'</td>';
		echo '<td align="center" nowrap>'.'<a href="'.$_SERVER['SCRIPT_NAME'].'?action=pst&id='.$httpquery->request['id'].'&edt_id='.$value['id'].'" class="cp" title="Редактировать"><img src="heart/cpan/cp_images/edit.gif" border="0" /></a>'.'</td>';
		echo '<td style="cursor:pointer;" title="Редактировать" onclick=\'javascript:window.document.location.href="'.$_SERVER['SCRIPT_NAME'].'?action=pst&id='.$httpquery->request['id'].'&edt_id='.$value['id'].'";\'>'.'<a href="'.$_SERVER['SCRIPT_NAME'].'?action=pst&id='.$httpquery->request['id'].'&edt_id='.$value['id'].'" class="cp" title="Редактировать">'.$value['head'].'</a>'.'</td>';
		echo '<td align="center" nowrap>'.'<a href="index.php?pid='.$value['id'].'" class="cp" title="Вид на сайте (откроется в новом окне)" target="_blank"><img src="heart/cpan/cp_images/preview.gif" border="0" /></a>'.'</td>';
		echo '<td align="center" nowrap>'.$value['date_edit'].'</td>';
		echo '<td align="center">'.'<a href="'.$_SERVER['SCRIPT_NAME'].'?action=pst&id='.$httpquery->request['id'].'&del_id='.$value['id'].'" class="cp" title="Удалить"><img src="heart/cpan/cp_images/delete.gif" border="0" /></a>'.'</td>';
		echo '</tr>';
		
		(++$i);
	}
	echo '</table>';
}

die();
?>