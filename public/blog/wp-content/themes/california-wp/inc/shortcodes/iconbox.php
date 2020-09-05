<?php

function webnus_iconbox( $attributes, $content = null ) {

	extract(shortcode_atts(array(
				"type"=>'0',
				'icon_title'=>'',
				'icon_link_url'=>'',
				'icon_link_text'=>'',
				"icon_name"=>'',
				"icon_size"=>'',
				"icon_color"=>'',
				"title_color"=>'',
				"content_color"=>'',
				"link_color"=>'',
				"icon_image"=>'',
		), $attributes));
	ob_start();


	switch ($type) {
		case '17':
			$iconbox_style = ( !empty($icon_color) ) ? ' style="color: ' . $icon_color . '"' : '' ;
			if ($type!=0)
			echo '<article class="icon-box' .$type. '" ' . $iconbox_style . '>';
			else
			echo '<article class="icon-box">';

			if(!empty($icon_name) && $icon_name != 'none') {
				if(!empty($icon_link_url))			
					echo '<div class="icon-wrap" style="background-color:'.$icon_color.'"><a href='.$icon_link_url.'>'. do_shortcode(  "[icon name='$icon_name' size='$icon_size' color='$icon_color']" ).'</a></div>';
				else 
					echo  '<div class="icon-wrap" style="background-color:'.$icon_color.'">'.do_shortcode(  "[icon name='$icon_name' size='$icon_size' color='$icon_color']" ).'</div>';
			} elseif(!empty($icon_image)) {
		
				if(is_numeric($icon_image)){
					
					$icon_image = wp_get_attachment_url( $icon_image );
				
				}
				
				if(!empty($icon_link_url))
					echo "<a href='$icon_link_url'>" . '<img src="'.$icon_image.'" />' . '</a>' ;
				else
					echo '<img src="'.$icon_image.'" />';	
				
			}
		break;
		
		default:
			if ($type!=0)
			echo '<article class="icon-box'.$type.'">';
			else
			echo '<article class="icon-box">';

			if(!empty($icon_name) && $icon_name != 'none') {
				if(!empty($icon_link_url))
					echo "<a href='$icon_link_url'>"  . do_shortcode(  "[icon name='$icon_name' size='$icon_size' color='$icon_color']" ).'</a>';
				else
					echo  do_shortcode(  "[icon name='$icon_name' size='$icon_size' color='$icon_color']" );
			} elseif(!empty($icon_image)) {
		
				if(is_numeric($icon_image)){
					
					$icon_image = wp_get_attachment_url( $icon_image );
				
				}
				
				if(!empty($icon_link_url))
					echo "<a href='$icon_link_url'>" . '<img src="'.$icon_image.'" />' . '</a>' ;
				else
					echo '<img src="'.$icon_image.'" />';	
				
			}
		break;
	}			
	
		$title_style = !empty($title_color)?' style="color:'.$title_color.'"':'';
		echo '<h4'.$title_style.'>' . $icon_title . '</h4>';
	
?><?php
		 $content_style = !empty($content_color)?' style="color:'.$content_color.'"':'';
      	 echo '<p'.$content_style.'>'.do_shortcode($content) .'</p>' ;
		 $link_style = !empty($link_color)?' style="color:'.$link_color.'"':'';
		 echo (!empty($icon_link_url) &&  (!empty($icon_link_text)) )?"<a".$link_style." class=\"magicmore\" href=\"{$icon_link_url}\">{$icon_link_text}</a>":'';
       	     
      ?></article><?php	
$out = ob_get_contents();
ob_end_clean();
$out = str_replace('<p></p>','',$out);
	
	return $out;
 }
 add_shortcode('iconbox', 'webnus_iconbox');
 
 

 
?>