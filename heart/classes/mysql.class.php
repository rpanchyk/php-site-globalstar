<?php
/**
 * FireTrotHeart
 * All rights reserved
 *
 * Class for working with MySQL DataBase
 */

if ( !defined( 'FIRETROTHEART' ) )
{
	$ex->hack_ex();
}

class fth_mysql
{
	/**
	 * DB variables
	*/ 
	var $db_id = false;
	var $connected = false;
	var $mysql_error = '';
	var $mysql_version = '';
	var $mysql_error_num = 0;
	var $query_id = false;
	/**
	 * CACHE variables
	*/ 
	var $filename;
	var $ttl = 0;
	var $data_ts;
	var $ResultData=array();
	/**
	 * LOG variable
	*/ 
	var $log = '';
	
	/**
	 * Connect to DB
		*/
	function connect($db_user, $db_pass, $db_name, $db_location='localhost', $show_error=1)
	{
		if(!$this->db_id = @mysql_connect($db_location, $db_user, $db_pass)) {
			if($show_error == 1) {
				$this->display_error(mysql_error(), mysql_errno());
			} else {
				return false;
			}
		} 
		
		if(!@mysql_select_db($db_name, $this->db_id)) {
			if($show_error == 1) {
				$this->display_error(mysql_error(), mysql_errno());
			} else {
				return false;
			}
		}
		
		$this->mysql_version = mysql_get_server_info();
		
		if(!defined('COLLATE'))
		{ 
			define ('COLLATE', 'cp1251');
		}
		
		if (version_compare($this->mysql_version, '4.1', ">=")) mysql_query("/*!40101 SET NAMES '" . COLLATE . "' */");
		
		$this->connected = true;
		
		return true;
	}
	
	/**
	 * Get data from DB or Cache and return data array
		*/
	function query($query, $ttl=0, $dir=CACHE_DIR, $filename='', $show_error=true)
	{
		if(!$this->connected) $this->connect(DBUSER, DBPASS, DBNAME, DBHOST);
		if($this->connected) $this->log .= '<hr> Connected to DB';
		
		$this->ttl = $ttl;
		$this->filename = $filename;
		
		$data = '';
		unset( $this->ResultData );
		
		if ($this->ttl == "0") 
		{
			if ( !$this->getFromDB($query, $show_error) ) { $this->log .= '<br> getFromDB() -> Return FALSE'; return false; }
			return $this->getResultData();
		} 
		else 
		{
			if (strlen(trim($this->filename)) == 0) { $this->filename = MD5($query); }
			$this->filename = $dir.'/db_'.$this->filename;
			$this->getFile_ts();
			if ((time() - $this->data_ts) >= $this->ttl) 
			{
				if ( !$this->getFromDB($query, $show_error) ) { $this->log .= '<br> getFromDB() -> Return FALSE'; return false; }
				$data = $this->getResultData();
				if ( !$this->saveToCache( $this->ResultData ) ) { $this->log .= '<br> saveToCache() -> Return FALSE'; return false; }
				return $data;
			} 
			else 
			{
				return $this->getFromCache();
			}
		}
	}
	
	/**
	 * Get query ID
		*/
	function getFromDB($query, $show_error=true)
	{
		$this->log .= '<br> call getFromDB($query)... when ttl = '.$this->ttl;
		if(!($this->query_id = mysql_query($query, $this->db_id) )) 
		{
			$this->mysql_error = mysql_error();
			$this->mysql_error_num = mysql_errno();
			if($show_error) {
				$this->display_error($this->mysql_error, $this->mysql_error_num, $query);
			}
		}
		return $this->query_id;
	}
	
	/**
	 * Get data from DB and return data array
		*/
	function getResultData()
	{
		$this->log .= '<br> call getResultData()...';
		$nr = @mysql_num_rows($this->query_id);
		for ($i=0; $i<$nr; $i++)
		{
			$this->ResultData[$i]= mysql_fetch_assoc($this->query_id);
		}
		return $this->ResultData;
	}
	
	/**
	 * Get file info
		*/
	function getFile_ts() 
	{
		$this->log .= '<br> call getFile_ts() for file: '.$this->filename;
		if (!file_exists($this->filename)) 
		{
			$this->data_ts = 0;
			return false;
		}
		$this->data_ts = filemtime($this->filename);
		return true;
	}
	
	/**
	 * Save data to Cache
		*/
	function saveToCache($data) 
	{
		$this->log .= '<br> call saveToCache()...';
		if (!$fp=@fopen($this->filename,'w')) { return false; }
		@flock($fp, LOCK_EX);
		if (!@fwrite($fp, serialize($data))) 
		{
			fclose($fp);
			return false;
		}
		fclose($fp);
		return true;
	}
	
	/**
	 * Get data from Cache
		*/
	function getFromCache() 
	{
		$this->log .= '<br> call getFromCache()...';
		if ( @$fp=fopen($this->filename, 'r') ) { flock($fp, LOCK_SH); }
		if ( !($x = file_get_contents($this->filename)) ) { return false; }
		if ( !($this->ResultData = unserialize($x)) ) { return false; }
		//echo '<pre>'; print_r($this->ResultData); echo '</pre>';
		return $this->ResultData;
	}
	
	/**
	 * Make safety data
		*/
	function safesql( $source )
	{
		if ($this->db_id) return mysql_real_escape_string ($source, $this->db_id);
		else return mysql_escape_string($source);
	}
	
	/**
	 * Free result memory
		*/
	function free( $query_id = '' )
	{
		if ($query_id == '') $query_id = $this->query_id;
		@mysql_free_result($query_id);
	}
	
	/**
	 * Close MySQL connection
		*/
	function close()
	{
		@mysql_close($this->db_id);
	}
	
	/**
	 * Show MySQL error
		*/
	function display_error($error, $error_num, $query = '')
	{
		if($query) {
			// Safify query
			$query = preg_replace("/([0-9a-f]){32}/", "********************************", $query); // Hides all hashes
			$query_str = "$query";
		}
		
		echo '<?xml version="1.0" encoding="iso-8859-1"?>
				<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
				<html xmlns="http://www.w3.org/1999/xhtml">
				<head>
				<title>MySQL Fatal Error</title>
				<meta http-equiv="Content-Type" content="text/html; charset=windows-1251" />
				<style type="text/css">
				<!--
				body {
				font-family: Verdana, Arial, Helvetica, sans-serif;
				font-size: 10px;
				font-style: normal;
				color: #000000;
				}
				-->
				</style>
				</head>
				<body>
				<font size="4">MySQL Error!</font> 
				<br />------------------------<br />
				<br />
				
				<u>The Error returned was:</u> 
				<br />
				<strong>'.$error.'</strong>
				
				<br /><br />
				</strong><u>Error Number:</u> 
				<br />
				<strong>'.$error_num.'</strong>
				<br />
				<br />
				
				<textarea name="" rows="15" cols="60" wrap="virtual">'.$query_str.'</textarea><br />
				</body>
				</html>';
		
		exit();
	}
}
?>