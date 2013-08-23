<?PHP
/*
	Manipulation DB data
*/

if ( !defined( 'FIRETROTHEART' ) )
{
	$ex->hack_ex();
}

class fth_manager
{
	var $log = '';
	
	function add( $table, $paramArr )
	{
		global $db;
		$fieldsStr = '';
		$valuesStr = '';
		
		foreach ( $paramArr as $key => $val )
		{
			$fieldsStr .= $key.',';
			$valuesStr .= $val.',';
		}
		
		// delete last coma:
		$fieldsStr = substr( $fieldsStr, 0, strlen($fieldsStr)-1 );
		$valuesStr = substr( $valuesStr, 0, strlen($valuesStr)-1 );
		
		// forming query string:
		$query = 'INSERT INTO '.$table.' ('.$fieldsStr.') VALUES ('.$valuesStr.')';
		
		// make query:
		$result = $db->query( $query );
	}
	
	function upd( $table, $paramArr, $where )
	{
		global $db;
		$setStr = '';
		
		foreach ( $paramArr as $key => $val )
		{
			$setStr .= $key.' = '.$val.',';
		}
		
		// delete last coma:
		$setStr = substr( $setStr, 0, strlen($setStr)-1 );
		
		// forming query string:
		$query = 'UPDATE '.$table.' SET '.$setStr.' WHERE '.$where;
		
		// make query:
		$result = $db->query( $query );
	}
	
	function del( $table, $where )
	{
		global $db;
		// forming query string:
		$query = 'DELETE FROM '.$table.' WHERE '.$where;
		// make query:
		$result = $db->query( $query );
		
	}	
}

?>