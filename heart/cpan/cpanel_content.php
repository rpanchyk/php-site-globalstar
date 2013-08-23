<?
# Authorization:
require_once CPANEL_DIR.'/login.php';

# Cpanel handler:
require_once CPANEL_DIR.'/cpanel_content_handle.php';

# Head:
require_once CPANEL_DIR.'/head.php';
# Top:
require_once CPANEL_DIR.'/top.php';

# JavaScript:
# Default menu color:
$colorDef = "#DDDDDD";
require_once CPANEL_DIR.'/menu_color_chng.php';
?>

<font class="cp_default">

<table border="0" cellpadding="2" cellspacing="2" align="center" width="95%">
	<tr>
		<td>
			<table border="0" width="100%" cellpadding="15" cellspacing="0">
				<tr style="cursor:pointer" onClick="location.href='cp.php?action=cat'">
					<td align="right" width="20%" bgcolor="#FFFFFF">
						<img src="heart/cpan/cp_images/cat_type.png" border="0">
					</td>
					<td bgcolor="<?=$colorDef?>"
					onMouseOver="mOverBg(this)"
					onMouseOut="mOutBg(this)">
						<h1> Категории </h1>
						Управление типами категорий
					</td>
				</tr>
			</table>
		</td>
	</tr>

	<tr><td>&nbsp;</td></tr>

	<tr>
		<td>
			<table border="0" width="100%" cellpadding="15" cellspacing="0">
				<tr style="cursor:pointer" onClick="location.href='cp.php?action=pst'">
					<td align="right" width="20%" bgcolor="#FFFFFF">
						<img src="heart/cpan/cp_images/post.png" border="0">
					</td>
					<td bgcolor="<?=$colorDef?>"
					onMouseOver="mOverBg(this)"
					onMouseOut="mOutBg(this)">
						<h1> Контент </h1>
						Управление содержимым сайта
					</td>
				</tr>
			</table>
		</td>
	</tr>

<!--
	<tr><td>&nbsp;</td></tr>

	<tr>
		<td>
			<table border="0" width="100%" cellpadding="15" cellspacing="0">
				<tr style="cursor:pointer" onClick="location.href='cpanel.php?action=mlr'">
					<td align="right" width="20%" bgcolor="#FFFFFF">
						<img src="<?=CPANEL_DIR?>/cp_images/email.png" border="0">
					</td>
					<td bgcolor="<?=$colorDef?>"
					onMouseOver="mOverBg(this)"
					onMouseOut="mOutBg(this)">
						<h1> Рассылка сообщений </h1>
						Уведомеление подписчиков о радостном событии ;-)
					</td>
				</tr>
			</table>
		</td>
	</tr>
-->
	<tr><td>&nbsp;</td></tr>

	<tr>
		<td>
			<table border="0" width="100%" cellpadding="15" cellspacing="0">
				<tr style="cursor:pointer" onClick="location.href='cp.php?action=cfg'">
					<td align="right" width="20%" bgcolor="#FFFFFF">
						<img src="heart/cpan/cp_images/set.png" border="0">
					</td>
					<td bgcolor="<?=$colorDef?>"
					onMouseOver="mOverBg(this)"
					onMouseOut="mOutBg(this)">
						<h1> Настройки </h1>
						Конфигурирование системы
					</td>
				</tr>
			</table>
		</td>
	</tr>

	<tr><td>&nbsp;</td></tr>

	<tr>
		<td>
			<table border="0" width="100%" cellpadding="15" cellspacing="0">
				<tr style="cursor:pointer" onClick="location.href='cp.php?action=acc'">
					<td align="right" width="20%" bgcolor="#FFFFFF">
						<img src="heart/cpan/cp_images/private.png" border="0">
					</td>
					<td bgcolor="<?=$colorDef?>"
					onMouseOver="mOverBg(this)"
					onMouseOut="mOutBg(this)">
						<h1> Сменить данные для входа </h1>
						Изменение имени и/или пароля администратора
					</td>
				</tr>
			</table>
		</td>
	</tr>

</table>
<br>
</font>


<?
# Foot:
require_once CPANEL_DIR.'/foot.php';
?>