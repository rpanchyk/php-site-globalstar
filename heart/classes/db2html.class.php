<?

/**
 * Parsing html data for presenting in content
*/
class db2html
{
	var $data = '';
	
	function getContent( $query, $doImgRealSize=true )
	{
		global $db;
		$data = $db->query( $query );
		$this->data = $data[0];
		
		//echo '<pre>'; print_r( $this->resultData ); echo '</pre>';
		if ( $doImgRealSize )
		{
			$this->data['post'] = $this->imgRealSize_parse( $this->data['post'] );
		}
		//echo '<br>'.$query;
		//echo '<pre>'; print_r( $this->resultData ); echo '</pre>';
		return $this->data;
	}
	
	function imgRealSize_parse( $post, $pic_align = 'left' )
	{
		?>
		<!-- OPEN NEW WINDOW (b) -->
		<SCRIPT type="text/javascript">
		<!-- 
		function openWindow($newUrl, $newWind, $h, $w)
		{
		var win1;
		$h = $h + 30;
		$w = $w + 20;
		$param = "toolbar=0,scrollbars=0,height="+$h+",width="+$w+", left=0";
		//$param = "toolbar=0,scrollbars,height="+$h+",width="+$w;
		win1=window.open('', $newWind,$param)
		win1.document.write("<title>"+$newUrl+"</title>");
		win1.document.write("<body>");
		$newUrl = "./uploads/"+$newUrl;
		win1.document.write("<center><img src="+$newUrl+" border=0 onClick='window.close();' alt='Click to close'></center>");
		win1.document.write("</body>");
		win1.focus();
		}
		//-->
		</SCRIPT>
		<!-- OPEN NEW WINDOW (e) -->
		<?php
		
		if ( !$post ) { return false; }
		$post = stripslashes($post);
		# Make possible to view BIG images:
		preg_match_all("#<img src=(.+?) (.+?)>#is", $post, $matches);
		for( $i=0; $i<count($matches[1]); ++$i )
		{
			$file_small = basename( $matches[1][$i] );
			$file_big = preg_replace( "#(.+?)_th_(.+?)#is", "\\1_\\2", $file_small );
			
			if ( $size_img = @getimagesize(UPLOAD_DIR."/".$file_big) )
			{
				if ( ($size_img[0] > IMG_W || $size_img[1] > IMG_W) )
				{	
					$post = preg_replace( 	
							"#<img src=".$matches[1][$i]."(.*?)>#is", 
							"<a href=\"javascript:openWindow('".$file_big."', 'my_wind', ".$size_img[1].", ".$size_img[0].");\" title=\"Истинный размер\"><img align=".$pic_align." src=\"".'/uploads'."/".$file_small."\" \\1></a>", 
							$post
							);
				}
			}
		}
		return $post;
	}
	
}
?>