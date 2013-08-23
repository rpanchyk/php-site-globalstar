<?php
/* Working with templates */

if ( !defined( 'FIRETROTHEART' ) )
{
	$ex->hack_ex();
}

class fth_template
{	
	var $relative_path = null;
	var $absolute_path = null;
	var $data = null;
	var $elements = array();
	var $result = array();
	
	// Gets content
	function load($filepath) 
	{
		$this->data = file_get_contents($this->absolute_path.'/'.$filepath);
		
		$inc = "{include=";
		while (strpos($this->data, $inc) !== false)
		{
			preg_match("#".$inc."['\"](.+?)['\"]\\}#ies", $this->data, $arr);
			foreach ($arr as $value)
			{
				$file = $this->absolute_path.'/'.preg_replace("#".$inc."['\"](.+?)['\"]\\}#is", "\\1", $value);
				$this->data = str_replace($value, file_get_contents($file), $this->data);
			}
		}
		
		/*
		$php = '<?php';
		if (strpos($this->data, $php) !== false)
		{
			preg_match_all("#".$php."(.+?)\\?>#ies", $this->data, $arr);
			//echo '<pre>'; print_r($arr); echo '</pre>';
			if (count($arr) > 1)
				foreach ($arr[1] as $value)
					eval($value);
		}
		*/
	}
	
	// Fill array of vars
	function set($name , $var)	
	{
		if (is_array($var) && count($var))
		{
			foreach ($var as $key => $key_var)
			{
				$this->set($key , $key_var);
			}
		}
		else 
		{
			$this->elements[$name] = $var;
		}
	}
	
	// Replace values from elements array & fill result array
	function compile($name)
	{
		foreach ($this->elements as $key => $value)
		{
			$this->data = str_replace($key, $value, $this->data);
		}
		$this->result[$name] = $this->data;
	}
	
	// Clear
	function clear() 
	{
		$relative_path = '';
		$absolute_path = '';
		$this->data = '';
		$this->elements = array();
		$this->result = array();
	}
}
?>