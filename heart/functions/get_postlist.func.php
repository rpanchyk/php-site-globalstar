<?php
# Post-list
function get_postlist($cat_id)
{
	if (!intval($cat_id))
		return;
		
	global $db;

	$pArr = $db->query( 'SELECT id,head,date_add FROM '.PREFIX.'_post WHERE cat_id = '.$cat_id.' ORDER BY id DESC' );
	
	for ( $i=0; $i < count($pArr); ++$i )
	{
		$pList['id'][] 		= $pArr[$i]['id'];
		$pList['head'][] 	= stripslashes($pArr[$i]['head']);
		$pList['date'][] 	= stripslashes($pArr[$i]['date_add']);
	}

return @$pList;
}
?>