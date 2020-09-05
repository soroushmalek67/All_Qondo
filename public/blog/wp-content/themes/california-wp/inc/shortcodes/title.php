<?php

  // Subtitle
 function webnus_subtitle ($atts, $content = null) {
 	extract(shortcode_atts(array(
 	'type'      => '1'
 	
						), $atts));

$out= '';
	switch($type){
		case 1:
		 	$out = '<h4 class="subtitle">';
		 	$out .= do_shortcode($content);
		 	$out .= '</h4>';
		break;
		case 2:
			$out =  '<div class="title">';
			$out .= '<h4>'. do_shortcode($content) .'</h4>';
			$out .= '</div>';			
		break;
		case 3:
			$out =  '<div class="sub-content">';
			$out .= '<h6 class="h-sub-content">'. do_shortcode($content) .'</h6>';
			$out .= '</div>';			
		break;
		case 4:
		
			$out =  '<div class="subtitle-four"><h4>'. do_shortcode($content) .'</h4></div>';		
		break;
		case 5:
			$out =  '<div class="sub-title"><h4>'. do_shortcode($content) .'</h4></div>';		
		break;
	}
 	return $out;
 }
 add_shortcode('subtitle','webnus_subtitle');




/*  bigtitle */


function bigtitle_shortcode ($atts, $content = null) {
	extract(shortcode_atts(array(
	'title'      => ''
						), $atts));

	
	$out = '<h2 class="mex-title">'. $content .'</h2>';
	
	return $out;
}

add_shortcode('big_title','bigtitle_shortcode');






function bigtitle2_shortcode ($atts, $content = null) {
	extract(shortcode_atts(array(
	'title'      => '',
	
						), $atts));

	
	$out = '<h2 class="mex-title">'. $content .'</h2>';
	
	return $out;
}
add_shortcode('big_title2','bigtitle2_shortcode');

function webnus_title($atts, $content)
{
	extract(shortcode_atts(array(
	'type'      => '4',

	), $atts));

	$out = '<h'.$type.'><strong>'.$content.'</strong></h'.$type.'>';
	return $out;
}

add_shortcode('title', 'webnus_title');



 // Max Title


function maxtitle_shortcode ($atts, $content = null) {
	extract(shortcode_atts(array(
	'type'      => '',
	'heading'  			=>'2',
						), $atts));
						
		$out = '<div class="max-title'.$type.'"><h' .$heading.'>'. $content .'</h2></div>';	
	
	return $out;
}
add_shortcode('maxtitle','maxtitle_shortcode');





?>