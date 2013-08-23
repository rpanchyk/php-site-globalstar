<?
/**
 * Check http data & Create array from it & delete REQUEST array
 */

if ( !defined( 'FIRETROTHEART' ) )
{
	$ex->hack_ex();
}

class fth_httpquery {
	
	var $request = '';
	var $time = 0;
	
	function __construct()
	{
		global $db;
		
		if ($_REQUEST)
		foreach ( $_REQUEST as $key => $val )
		{
			if ( !is_array($key) )
			{
				//echo 'httpBefore = '.$val.'<br>';
				$this->request[$key] = $db->safesql( $val );
				//echo 'httpAfter = '.$val.'<br>';
			}
			else
				die('DIE: $_REQUEST contains an array! What i\'ve to do?');
		}
		
		unset( $_REQUEST );
		
		//echo '<pre>'; print_r( $httpquery ); echo '</pre>'; 
	}
}

?>