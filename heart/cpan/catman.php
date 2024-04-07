<?PHP
# Authorization:
require_once CPANEL_DIR.'/login.php';
# Head:
require_once CPANEL_DIR.'/head.php';
# Top:
require_once CPANEL_DIR.'/top.php';

if ( $httpquery->request['edt'] )
{
	$cArr = $db->query( 'SELECT * FROM '.PREFIX.'_category WHERE id = '.$httpquery->request['edt'].' LIMIT 1' );
	//echo '<pre>'; print_r($cArr); echo '</pre>';
	showForm( $cArr[0]['name'], $cArr[0]['rusname'], $cArr[0]['ord'], $httpquery->request['edt'] );
}
else
{
	showForm();
}

if ( $httpquery->request['del'] )
{
	$manager->del( PREFIX.'_category', 'id = '.$httpquery->request['del'] );
}

if ( $httpquery->request['doSend'] && $httpquery->request['cname'] )
{
	$pArr['name'] = '\''.$httpquery->request['cname'].'\'';
	$pArr['rusname'] = '\''.$httpquery->request['crusname'].'\'';
	$pArr['ord'] = $httpquery->request['ord'];
	if ( !$httpquery->request['upd'] )
	{
		$manager->add( PREFIX.'_category', $pArr );
	}
	else
	{
		$manager->upd( PREFIX.'_category', $pArr, 'id = '.$httpquery->request['upd'] );
	}
}

showCats();

function showForm( $cname='', $crusname='', $ord=1, $upd = FALSE )
{
	global $db;
	
	if ($ord === 1)
	{
		$aCArr = $db->query( 'SELECT MAX(id) FROM '.PREFIX.'_category' );
		$ord = ($aCArr[0]["MAX(id)"] === 0) ? 1 : $aCArr[0]["MAX(id)"] + 1;
	}
	
	?>
		<form method="post" action="<?=$_SERVER['SCRIPT_NAME']?>?action=cat">
		<table align="center" border="0" cellpadding="0" cellspacing="0" width="70%" 
		style="border-color:#FFFFFF; border-style:solid; border-width:2px" bgcolor="#DDDDDD">
			<tr style="font-weight:bold;text-align:center">
				<td> Название категории (англ.) </td>
				<td> Название категории (рус.) </td>
				<td> Сортировка </td>
			</tr>
			<tr align=center>
				<td width="30%">
					<input type="text" name="cname" maxlength="256" value="<?=$cname?>" style="width:95%;text-align:center" class="bbc">
				</td>
				<td width="30%">
					<input type="text" name="crusname" maxlength="256" value="<?=$crusname?>" style="width:95%;text-align:center" class="bbc">
				</td>
				<td width="30%">
					<input type="text" name="ord" maxlength="256" value="<?=$ord?>" style="width:70%;text-align:center" class="bbc">
				</td>
			</tr>
		</table>
		<center>
			<input type="hidden" name="upd" value="<?=$upd?>">
			<input type="submit" name="doSend" value="Отправить" class="bbc">
		</center>
		</form>
	<?
}

function getCats()
{
	global $db;
	$cArr = $db->query( 'SELECT * FROM '.PREFIX.'_category ORDER BY ord' );
	//echo '<pre>'; print_r($cArr); echo '</pre>';
	return $cArr;
}

function showCats()
{
	$cArr = getCats();
	?>
		<p></p>
		<table align="center" border="0" cellpadding="0" cellspacing="0" width="40%" 
		style=" border-color:#FFFFFF; border-style:solid; border-width:2px;" bgcolor="#DDDDDD">
	<?
	$i = 1;
	if ( $cArr )
	foreach ( $cArr as $key => $val )
	{
		?>
				<tr>
					<td width="7%" align="center" style="padding:3px;">
						<font style="font-size:11px; font-family:Verdana;"><?=$val['ord']?></font>
					</td>
					<td width="30%">
						<a href="<?=$_SERVER['SCRIPT_NAME']?>?action=cat&edt=<?=$val['id']?>" class="cp" title="Редактировать"><?=$val['name']?></a>
					</td>
					<td width="30%">
						<a href="<?=$_SERVER['SCRIPT_NAME']?>?action=cat&edt=<?=$val['id']?>" class="cp" title="Редактировать"><?=$val['rusname']?></a>
					</td>
					<td align="center">
						<a href="<?=$_SERVER['SCRIPT_NAME']?>?action=cat&del=<?=$val['id']?>" class="cp" title="Удалить">[x]</a>
					</td>
				</tr>
		<?
		++$i;
	}
	?>
		</table>
	<?
}

# Foot:
require_once CPANEL_DIR.'/foot.php';

die();

?>