<?php
/*
	Error processing class
*/

if ( !defined( 'FIRETROTHEART' ) )
{
	die( '<h4> Hacking attempt! </h4>' );
}

class fth_exception
{
	var $message = '';
	
	function print_ex($message)
	{
		echo "<font class=\"red_b\"\"> ".$message." </font>";
	}

	function die_ex($message)
	{
		die($message);
	}
	
	function hack_ex()
	{
		die( '<h4> Hacking attempt! </h4>' );
	}
}

?>