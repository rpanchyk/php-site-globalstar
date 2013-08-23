<?php
/*
	Data operation on filesystem level
*/

if ( !defined( 'FIRETROTHEART' ) )
{
	$ex->hack_ex();
}

class fth_filesystem
{
	function get_filelist($dir, $file_key = "")
	{
		//if (chdir($dir))
		//{
		$files = scandir($dir, 1);
		$key = 0;
		/*
		//			$show_th = 0;
					foreach ($files as $value)
					{
						if (preg_match("#_th_#is", $value)
						{
							$show_th = $value;
						}
		//				echo "<pre>";
		//				print_r($matches);
		//				echo "</pre>";
					}
		*/
		foreach ($files as $value)
		{
			//echo '<br>- '.$value.'<br>';
			$show = preg_match("#".$file_key."#is", $value);
			if ( 
				(file_exists($dir.$value)) && 
					($show) && 
					($value !=".") && 
					($value !="..") 
				)
			{ //echo '<br>*';
				$file_arr['id'][$key] = $key;
				$file_arr['name'][$key] = $value;
				$file_arr['size'][$key] = @number_format((filesize($value)/1024), 1, '.', '');
				$file_arr['date_add'][$key] = @date ("d-F-Y H:i:s", filemtime($value));
				++$key;
			}
		}
		return $file_arr;
		/*}
		else
		{
			return 0;
		}*/
	}
	
	function file_is_image($file)
	{
		# Find extention:
		$fileExt = strrchr( $file, "." );
		# Compare extention:
		if ( preg_match("/jpg|gif|png/i",$fileExt) ) {return 1;} else {return 0;}
	}
}
?>