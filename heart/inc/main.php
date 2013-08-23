<?php
/*
 *  FireTrotHeart
 *  Version 3.0 
 */


require_once dirname(__FILE__).'/init_engine.php';

$aMonth = array(1 => 'Января','Февраля','Марта','Апреля','Мая','Июня','Июля','Августа','Сентября','Октября','Ноября','Декабря');

$skin = 'GlobalStar';

define( 'CACHE_TIME', '0' ); // секунд
define( 'LISTBLOCK_WIDTH', '35%' );
define( 'LISTBLOCK_MAX_COUNT', '25' );
define( 'SHORT_POST_LENGTH', '200' );

$tpl->relative_path = 'templates' . SLASH . $skin;
$tpl->absolute_path = ROOT_DIR . SLASH . 'templates' . SLASH . $skin;
//define( 'TEMPLATE_DIR', $tpl->dir );

$tpl->load('main.tpl');
$tpl->set( '{THEME}', $tpl->relative_path );
$tpl->set('{TITLE}', 'GLOBAL STAR');

// Для показа контента
$dataPost = null;
$dataCategory = null;
$dataCategoryManualList = null;

//echo '<pre>'; print_r($httpquery); echo '</pre>';

// Default category
if (!$httpquery->request['shw'])
	$httpquery->request['shw'] = 'about';
	
if ($httpquery->request['pid'])
{
	// Пытаемся получить ID
	$pID = intval($httpquery->request['pid']);
	
	if ($pID)
	{
		// Получаем запись
		$dataPost = GetPostByID($pID); //echo '<pre>'; print_r($dataPost); echo '</pre>';
		ShowHtmlContent($dataPost, $skin);
		
		// For menu
		if (count($dataPost) > 0)
		{
			$dataCat = GetCategoryByID($dataPost[0]['cat_id']); //echo '<pre>'; print_r($dataCat); echo '</pre>';
			if (count($dataCat) > 0)
				$httpquery->request['shw'] = $dataCat[0]['name'];
		}
	}
	else
		{ ErrorException(404); }
}
else
{
	// Получаем категорию
	$dataCategory = GetCategoryByName($httpquery->request['shw']); //echo '<pre>'; print_r($dataCategory); echo '</pre>';
	
	if (count($dataCategory))
	{
		switch ($dataCategory[0]['name'])
		{
			case 'dj':
			case 'pj':
			case 'tpj':
			case 'mc':
				$IsMultiPage = true;
				break;
			default:
				$IsMultiPage = false;
				break;
		}
		
		if ($IsMultiPage)
		{
			// Выводим список постов
			$dataPosts = GetPosts($dataCategory[0]['id']); //echo '<pre>'; print_r($dataPosts); echo '</pre>';
			
			$strPosts = '<div style="font-family:Tahoma;">Sorry, page is empty.</div>';
			if (count($dataPosts) > 0)
			{
				// Divide in two columns
				
				
				$strPostsLeft = '';
				$strPostsRight = '';
				$nCnt = 0;
				foreach ($dataPosts as $dataPost)
				{
					//echo '<pre>'; print_r($dataPost); echo '</pre>';
					$tpl_cont = new fth_template;
					$tpl_cont->relative_path = 'templates' . SLASH . $skin;
					$tpl_cont->absolute_path = ROOT_DIR . SLASH . 'templates' . SLASH . $skin;
					$tpl_cont->load('autolist.tpl');
					$tpl_cont->set('{PID}', stripslashes($dataPost['id']));
					$tpl_cont->set('{TITLE}', stripslashes($dataPost['head']));
					$tpl_cont->set('{IMAGE}', stripslashes($dataPost['xfield6']));
					$tpl_cont->set('{SHORT_CONTENT}', stripslashes($dataPost['xfield5']));
					$tpl_cont->compile('content');
					
					if (!($nCnt%2))
						$strPostsLeft .= $tpl_cont->result['content'];
					else 
						$strPostsRight .= $tpl_cont->result['content'];
					
					$tpl_cont->clear();
					
					$nCnt++;
				}
				
				$strPosts = '<table><tr><td valign="top">'.$strPostsLeft.'</td><td valign="top">'.$strPostsRight.'</td></tr></table>';
			}
			// set data
			$tpl->set('{CONTENT}', $strPosts);
		}
		else 
		{
			// Получаем запись
			$dataPost = GetPostByCategoryID($dataCategory[0]['id']);
			ShowHtmlContent($dataPost, $skin);
		}
	}
	else
		{  ErrorException(404); }	
}
	
// Menu - set active item
$tpl->set('{ABOUT_ACTIVE}', '');
$tpl->set('{DJ_ACTIVE}', '');
$tpl->set('{PJ_ACTIVE}', '');
$tpl->set('{TPJ_ACTIVE}', '');
$tpl->set('{MC_ACTIVE}', '');
$tpl->set('{CONTACTS_ACTIVE}', '');
$tpl->set('{'.strtoupper($httpquery->request['shw']).'_ACTIVE}', '2');


function ErrorException($errorID = 0, $errorInfo = '')
{
	global $tpl;
	$errorMessage = '';
	
	switch ($errorID)
	{
		case 404:
			$errorMessage = '<h1>404</h1><h5>Страница не найдена</h5>';
			break;
		default:
			$errorMessage = '<h1>XXX</h1><h5>Неизвесная ошибка</h5>';
			break;
	}
	
	$errorMessage .= $errorInfo;
	
	$tpl->set('{LISTBLOCK_WIDTH}', '0');
	$tpl->set('{LISTBLOCK}', '');
	$tpl->set('{CONTENT}', $errorMessage);
}

function SetListBlock($dataCategory, $dataCategoryManualList, $skin, $aMonth)
{
	global $tpl;
	global $httpquery;
	global $db;
	global $IsMultiPage;
	
	$dataCategoryTmp = $dataCategory;
	
	if ($IsMultiPage)
	{
		// Содержимое списка
		$listContent = '';
		$listWidth = LISTBLOCK_WIDTH;
		
		if (count($dataCategoryManualList) > 0)
		{
			// Получаем запись
			$dataList = GetPostByCategoryID($dataCategoryManualList[0]['id']);
			
			if (count($dataCategoryManualList) > 0)
			{
				$listContent = stripslashes($dataList[0]['post']);
			}
			else
				{ $listContent = 'Пустой список'; }
		}
		else
		{
			if (!$httpquery->request['pid'])
			{
				if ($dataCategory[0]['name'] == 'main')
				{
					$dataCategory = GetCategoryByName('afisha');
				}
				
				// Получаем N-записей категории
				$query = 'SELECT * FROM '.PREFIX.'_post WHERE cat_id = '.$dataCategory[0]['id'].' ORDER BY IFNULL(date_pub,0) DESC LIMIT '.LISTBLOCK_MAX_COUNT;
				$dataMultiPost = $db->query( $query, CACHE_TIME ); //echo '<pre>'; print_r($dataMultiPost); echo '</pre>';
				
				// Формируем автоматический спсок
				if (count($dataMultiPost) > 0)
				{
					foreach ($dataMultiPost as $value)
					{
						$tpl_cont = new fth_template;
						$tpl_cont->relative_path = 'templates' . SLASH . $skin;
						$tpl_cont->absolute_path = ROOT_DIR . SLASH . 'templates' . SLASH . $skin;
						$tpl_cont->load('autolist.tpl');
						
						$tpl_cont->set('{THEME}', $tpl->relative_path);
						$tpl_cont->set('{PID}', $value['id']);
						$tpl_cont->set('{TITLE}', stripslashes($value['head']));
						$tpl_cont->set('{IMAGE}', stripslashes($value['xfield6']));
						
						if (!$value['date_pub'])
						{
							$tpl_cont->set('{DATETIME}', '');
						}
						else
						{
							$tpl_datetime = new fth_template;
							$tpl_datetime->relative_path = 'templates' . SLASH . $skin;
							$tpl_datetime->absolute_path = ROOT_DIR . SLASH . 'templates' . SLASH . $skin;
							$tpl_datetime->load('datetime.tpl');
							$tpl_datetime->set('{DATETIME_YEAR}', date("Y", strtotime($value['date_pub'])));
							$tpl_datetime->set('{DATETIME_MONTH}', $aMonth[date("n", strtotime($value['date_pub']))]);
							$tpl_datetime->set('{DATETIME_DAY}', date("d", strtotime($value['date_pub'])));
							$tpl_datetime->set('{DATETIME_HOUR}', date("H", strtotime($value['date_pub'])));
							$tpl_datetime->set('{DATETIME_MINUTE}', date("i", strtotime($value['date_pub'])));
							$tpl_datetime->compile('datetime');
							$tpl_cont->set('{DATETIME}', $tpl_datetime->result['datetime']);
							$tpl_datetime->clear();
						}
						
						$tpl_cont->set('{SHORT_CONTENT}', stripslashes($value['xfield5']));
						$tpl_cont->compile('autolist');
						$listContent .= $tpl_cont->result['autolist'];
						$tpl_cont->clear();
					}
					$listWidth = (($dataCategoryTmp[0]['name'] == 'main') ? LISTBLOCK_WIDTH : '100%');
				}
				else
					{ $listContent = 'Пустой список'; }
			}
		}
		
		// Заполняем блок-список
		$tpl_cont = new fth_template;
		$tpl_cont->relative_path = 'templates' . SLASH . $skin;
		$tpl_cont->absolute_path = ROOT_DIR . SLASH . 'templates' . SLASH . $skin;
		$tpl_cont->load('listblock.tpl');
		$tpl_cont->set('{LISTBLOCK_CONTENT}', $listContent);
		$tpl_cont->compile('listblock');
		$tpl->set('{LISTBLOCK_WIDTH}', $listWidth);
		$tpl->set('{LISTBLOCK}', $tpl_cont->result['listblock']);
		$tpl_cont->clear();
	}
	else
	{
		// Иначе - затираем список
		$tpl->set('{LISTBLOCK_WIDTH}', '0');
		$tpl->set('{LISTBLOCK}', '');
	}

	// Возврат	
	if ($dataCategoryTmp[0]['name'] == 'main')
	{ $IsMultiPage = false; }
}

function GetPostByID($pID)
{
	global $db;
	
	// Получаем категорию
	$query = 'SELECT * FROM '.PREFIX.'_post WHERE id = '.$pID.' ORDER BY date_add DESC LIMIT 1';
	$data = $db->query( $query, CACHE_TIME ); //echo '<pre>'; print_r($data); echo '</pre>';
		
	return $data;
}
function GetPostByCategoryID($catID)
{
	global $db;
	
	// Получаем категорию
	$query = 'SELECT * FROM '.PREFIX.'_post WHERE cat_id = '.$catID.' ORDER BY date_add DESC LIMIT 1';
	$data = $db->query( $query, CACHE_TIME ); //echo '<pre>'; print_r($data); echo '</pre>';
	
	return $data;
}
function GetPosts($catID)
{
	global $db;
	
	// Получаем категорию
	$query = 'SELECT * FROM '.PREFIX.'_post WHERE cat_id = '.$catID.' ORDER BY ord LIMIT 1000';
	$data = $db->query( $query, CACHE_TIME ); //echo '<pre>'; print_r($data); echo '</pre>';
	
	return $data;
}


function GetCategoryByID($catID)
{
	global $db;
	
	// Получаем категорию
	$query = 'SELECT * FROM '.PREFIX.'_category WHERE id = '.$catID;
	$data = $db->query( $query, CACHE_TIME ); //echo '<pre>'; print_r($data); echo '</pre>';
	
	return $data;
}
function GetCategoryByName($catName)
{
	global $db;
	
	// Получаем категорию
	$query = 'SELECT * FROM '.PREFIX.'_category WHERE name = \''.$catName.'\' ORDER BY id LIMIT 1';
	$data = $db->query( $query, CACHE_TIME ); //echo '<pre>'; print_r($data); echo '</pre>';
	//$data = $db->query( $query, CACHE_TIME ); //echo '<pre>'; print_r($data); echo '</pre>';
	
	return $data;
}

function ShowHtmlContent($dataPost, $skin)
{
	global $tpl;
	
	if (count($dataPost) > 0)
	{
		//echo '<pre>'; print_r($dataPost); echo '</pre>';
		$tpl_cont = new fth_template;
		$tpl_cont->relative_path = 'templates' . SLASH . $skin;
		$tpl_cont->absolute_path = ROOT_DIR . SLASH . 'templates' . SLASH . $skin;
		$tpl_cont->load('content.tpl');
		$tpl_cont->set('{POST_TITLE}', stripslashes($dataPost[0]['head']));
		$tpl_cont->set('{POST_CONTENT}', stripslashes($dataPost[0]['post']));
		$tpl_cont->compile('content');
		$tpl->set('{CONTENT}', $tpl_cont->result['content']);
		$tpl_cont->clear();
	}
	else
		{  ErrorException(404); }
}

#region Footer
	
	$query = 'SELECT * FROM '.PREFIX.'_post WHERE id = ';
	$queryCat = 'SELECT id FROM '.PREFIX.'_category WHERE name = \''. 'partners' .'\' LIMIT 1';
	$cidArr = $db->query( $queryCat );
	$cat_id = $cidArr[0]['id'];
	if ( intval($cat_id) )
	{
		$idArr = $db->query( 'SELECT id FROM '.PREFIX.'_post WHERE cat_id = '.$cat_id );
		$cont = '';
		if ($idArr)
			foreach ($idArr as $value)
			{
				$tpl_cont = new fth_template;
				$tpl_cont->relative_path = 'templates' . SLASH . $skin;
				$tpl_cont->absolute_path = ROOT_DIR . SLASH . 'templates' . SLASH . $skin;
				$content->getContent( $query.$value['id'], false );
				$tpl_cont->load('foot.tpl');
				$tpl_cont->set('{FOOT_CONTENT}', stripslashes($content->data['post']));
				$tpl_cont->compile('foot');
				$cont .= $tpl_cont->result['foot'];
				$tpl_cont->clear();
			}
	}
	$cont = str_replace('{THEME}', $tpl->relative_path, $cont);
	$tpl->set('{FOOTER}', $cont);
	
#endregion

$tpl->compile('main');
echo $tpl->result['main'];

require_once ENGINE_DIR.'/inc/stop_engine.php';
?>