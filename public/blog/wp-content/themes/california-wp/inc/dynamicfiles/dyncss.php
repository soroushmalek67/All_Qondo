<?php
ob_start();

$thm_options = get_option('webnus_options');

/*
 * Header Style
*/

if($thm_options['webnus_container_width'])
{
	$w_value = trim ($thm_options['webnus_container_width']);
	if($w_value){
		if(substr($w_value,-2,2)!="px"){$w_value.='px';};
		echo "#wrap .container {max-width:{$w_value};}\n\n";
	}
}

if($thm_options['webnus_header_padding_top'])
{
	$w_value = trim ($thm_options['webnus_header_padding_top']);
	if($w_value){
		if(substr($w_value,-2,2)!="px"){$w_value.='px';};
		echo "#header {padding-top:{$w_value};}\n\n";
	}
}

if($thm_options['webnus_header_padding_bottom'])
{
	$w_value = trim ($thm_options['webnus_header_padding_bottom']);
	if($w_value){
		if(substr($w_value,-2,2)!="px"){$w_value.='px';};
		echo "#header {padding-bottom:{$w_value};}\n\n";
	}
}

/*
 * Custom Fonts For P,H Tags
*/
$w_custom_font1_src = $w_custom_font2_src = $w_custom_font3_src ='';

//custom-font-1 font-face

  if(isset($thm_options['webnus_custom_font1_eot']) && $thm_options['webnus_custom_font1_eot']!='')
    $w_custom_font1_src[] = "url('{$thm_options['webnus_custom_font1_eot']}?#iefix') format('embedded-opentype')";
  if(isset($thm_options['webnus_custom_font1_woff']) && $thm_options['webnus_custom_font1_woff']!='')   
    $w_custom_font1_src[] = "url('{$thm_options['webnus_custom_font1_woff']}') format('woff')";
  if(isset($thm_options['webnus_custom_font1_ttf']) && $thm_options['webnus_custom_font1_ttf']!='')
    $w_custom_font1_src[] = "url('{$thm_options['webnus_custom_font1_ttf']}') format('truetype')";

if($w_custom_font1_src !='')
{
  $w_custom_font1_src= implode(",\n",$w_custom_font1_src);
  echo "@font-face {
  font-family: 'custom-font-1';
  font-style: normal;
  font-weight: normal;
  src: {$w_custom_font1_src};\n}\n";
}

//custom-font-2 font-face

  if(isset($thm_options['webnus_custom_font2_eot']) && $thm_options['webnus_custom_font2_eot']!='')
    $w_custom_font2_src[] = "url('{$thm_options['webnus_custom_font2_eot']}?#iefix') format('embedded-opentype')";
  if(isset($thm_options['webnus_custom_font2_woff']) && $thm_options['webnus_custom_font2_woff']!='')   
    $w_custom_font2_src[] = "url('{$thm_options['webnus_custom_font2_woff']}') format('woff')";
  if(isset($thm_options['webnus_custom_font2_ttf']) && $thm_options['webnus_custom_font2_ttf']!='')
    $w_custom_font2_src[] = "url('{$thm_options['webnus_custom_font2_ttf']}') format('truetype')";

if($w_custom_font2_src !='')
{
  $w_custom_font2_src= implode(",\n",$w_custom_font2_src);
  echo "@font-face {
  font-family: 'custom-font-2';
  font-style: normal;
  font-weight: normal;
  src: {$w_custom_font2_src};\n}\n";
}

//custom-font-3 font-face

  if(isset($thm_options['webnus_custom_font3_eot']) && $thm_options['webnus_custom_font3_eot']!='')
    $w_custom_font3_src[] = "url('{$thm_options['webnus_custom_font3_eot']}?#iefix') format('embedded-opentype')";
  if(isset($thm_options['webnus_custom_font3_woff']) && $thm_options['webnus_custom_font3_woff']!='')   
    $w_custom_font3_src[] = "url('{$thm_options['webnus_custom_font3_woff']}') format('woff')";
  if(isset($thm_options['webnus_custom_font3_ttf']) && $thm_options['webnus_custom_font3_ttf']!='')
    $w_custom_font3_src[] = "url('{$thm_options['webnus_custom_font3_ttf']}') format('truetype')";

if($w_custom_font3_src !='')
{
  $w_custom_font3_src= implode(",\n",$w_custom_font3_src);
  echo "@font-face {
  font-family: 'custom-font-3';
  font-style: normal;
  font-weight: normal;
  src: {$w_custom_font3_src};\n}\n";
}


// p-font select

if(isset($thm_options['webnus_p_font']) && $thm_options['webnus_p_font']!='')
{
	if ($thm_options['webnus_p_font'] == 'typekit-font-1')
	  $thm_options['webnus_p_font'] = $thm_options['webnus_typekit_font1'];
	if ($thm_options['webnus_p_font'] == 'typekit-font-2')
	  $thm_options['webnus_p_font'] = $thm_options['webnus_typekit_font2'];
	if ($thm_options['webnus_p_font'] == 'typekit-font-3')
	  $thm_options['webnus_p_font'] = $thm_options['webnus_typekit_font3'];
	echo "p { font-family: {$thm_options['webnus_p_font']};}\n";
}


// heading-font select

if(isset($thm_options['webnus_heading_font']) && $thm_options['webnus_heading_font']!='')
{
	if ($thm_options['webnus_heading_font'] == 'typekit-font-1')
	  $thm_options['webnus_heading_font'] = $thm_options['webnus_typekit_font1'];
	if ($thm_options['webnus_heading_font'] == 'typekit-font-2')
	  $thm_options['webnus_heading_font'] = $thm_options['webnus_typekit_font2'];
	if ($thm_options['webnus_heading_font'] == 'typekit-font-3')
	  $thm_options['webnus_heading_font'] = $thm_options['webnus_typekit_font3'];
	echo "h1, h2, h3, h4, h5, h6 { font-family: {$thm_options['webnus_heading_font']};}\n";
}


// body-font select

if(isset($thm_options['webnus_body_font']) && $thm_options['webnus_body_font']!='')
{
	if ($thm_options['webnus_body_font'] == 'typekit-font-1')
	  $thm_options['webnus_body_font'] = $thm_options['webnus_typekit_font1'];
	if ($thm_options['webnus_body_font'] == 'typekit-font-2')
	  $thm_options['webnus_body_font'] = $thm_options['webnus_typekit_font2'];
	if ($thm_options['webnus_body_font'] == 'typekit-font-3')
	  $thm_options['webnus_body_font'] = $thm_options['webnus_typekit_font3'];
	echo "body { font-family: {$thm_options['webnus_body_font']};}\n";
}


// menu-font select

if(isset($thm_options['webnus_menu_font']) && $thm_options['webnus_menu_font']!='')
{
	if ($thm_options['webnus_menu_font'] == 'typekit-font-1')
	  $thm_options['webnus_menu_font'] = $thm_options['webnus_typekit_font1'];
	if ($thm_options['webnus_menu_font'] == 'typekit-font-2')
	  $thm_options['webnus_menu_font'] = $thm_options['webnus_typekit_font2'];
	if ($thm_options['webnus_menu_font'] == 'typekit-font-3')
	  $thm_options['webnus_menu_font'] = $thm_options['webnus_typekit_font3'];
	echo "#nav a { font-family: {$thm_options['webnus_menu_font']};}\n";
}


/* header menu font size */

$webnus_topnav_font_size = $webnus_options->webnus_topnav_font_size(); 
if( !empty($webnus_topnav_font_size) ){
	echo "ul#nav * { font-size:{$webnus_topnav_font_size}; }\n";
}
$webnus_topnav_letter_spacing = $webnus_options->webnus_topnav_letter_spacing(); 
if( !empty($webnus_topnav_letter_spacing) ){
	echo "ul#nav * { letter-spacing:{$webnus_topnav_letter_spacing}; }\n";
}
$webnus_topnav_line_height = $webnus_options->webnus_topnav_line_height(); 
if( !empty($webnus_topnav_line_height) ){	
	echo "ul#nav * { line-height:{$webnus_topnav_line_height}; }\n";	
}



/*  P */

$webnus_p_font_size = $webnus_options->webnus_p_font_size(); 
if( !empty($webnus_p_font_size) )
{
	echo "p { font-size:{$webnus_p_font_size}; }\n";
}
$webnus_p_letter_spacing = $webnus_options->webnus_p_letter_spacing(); 
if( !empty($webnus_p_letter_spacing) ){
	echo "p { letter-spacing:{$webnus_p_letter_spacing}; }\n";
}
$webnus_p_line_height = $webnus_options->webnus_p_line_height(); 
if( !empty($webnus_p_line_height) ){
	echo "p { line-height:{$webnus_p_line_height}; }\n";
}

$webnus_p_font_color = $webnus_options->webnus_p_font_color(); 
if( !empty($webnus_p_font_color) ){
	echo "p { color:{$webnus_p_font_color}; }\n";
}


/*  H1 */

$webnus_h1_font_size = $webnus_options->webnus_h1_font_size(); 
if( !empty($webnus_h1_font_size) ){
	echo "h1 { font-size:{$webnus_h1_font_size}; }\n";
}
$webnus_h1_letter_spacing = $webnus_options->webnus_h1_letter_spacing(); 
if( !empty($webnus_h1_letter_spacing) ){
	echo "h1 { letter-spacing:{$webnus_h1_letter_spacing}; }\n";
}
$webnus_h1_line_height = $webnus_options->webnus_h1_line_height(); 
if( !empty($webnus_h1_line_height) ){
	echo "h1 { line-height:{$webnus_h1_line_height}; }\n";
}

$webnus_h1_font_color = $webnus_options->webnus_h1_font_color(); 
if( !empty($webnus_h1_font_color) ){	
	echo "h1 { color:{$webnus_h1_font_color}; }\n";	
}



/*  H2 */

$webnus_h2_font_size = $webnus_options->webnus_h2_font_size(); 
if( !empty($webnus_h2_font_size) ){	
	echo "h2 { font-size:{$webnus_h2_font_size}; }\n";	
}
$webnus_h2_letter_spacing = $webnus_options->webnus_h2_letter_spacing(); 
if( !empty($webnus_h2_letter_spacing) ){	
	echo "h2 { letter-spacing:{$webnus_h2_letter_spacing}; }\n";	
}
$webnus_h2_line_height = $webnus_options->webnus_h2_line_height(); 
if( !empty($webnus_h2_line_height) ){
	echo "h2 { line-height:{$webnus_h2_line_height}; }\n";
}

$webnus_h2_font_color = $webnus_options->webnus_h2_font_color(); 
if( !empty($webnus_h2_font_color) ){
	echo "h2 { color:{$webnus_h2_font_color}; }\n";	
}


/*  H3 */

$webnus_h3_font_size = $webnus_options->webnus_h3_font_size(); 
if( !empty($webnus_h3_font_size) ){
	echo "h3 { font-size:{$webnus_h3_font_size}; }\n";
}
$webnus_h3_letter_spacing = $webnus_options->webnus_h3_letter_spacing(); 
if( !empty($webnus_h3_letter_spacing) ){	
	echo "h3 { letter-spacing:{$webnus_h3_letter_spacing}; }\n";
}
$webnus_h3_line_height = $webnus_options->webnus_h3_line_height(); 
if( !empty($webnus_h3_line_height) ){	
	echo "h3 { line-height:{$webnus_h3_line_height}; }\n";	
}

$webnus_h3_font_color = $webnus_options->webnus_h3_font_color(); 
if( !empty($webnus_h3_font_color) ){
	echo "h3 { color:{$webnus_h3_font_color}; }\n";
}



/*  H4 */

$webnus_h4_font_size = $webnus_options->webnus_h4_font_size(); 
if( !empty($webnus_h4_font_size) ){
	echo "h4 { font-size:{$webnus_h4_font_size}; }\n";	
}
$webnus_h4_letter_spacing = $webnus_options->webnus_h4_letter_spacing(); 
if( !empty($webnus_h4_letter_spacing) ){
	echo "h4 { letter-spacing:{$webnus_h4_letter_spacing}; }\n";
	
}
$webnus_h4_line_height = $webnus_options->webnus_h4_line_height(); 
if( !empty($webnus_h4_line_height) ){
	echo "h4 { line-height:{$webnus_h4_line_height}; }\n";
}

$webnus_h4_font_color = $webnus_options->webnus_h4_font_color(); 
if( !empty($webnus_h4_font_color) ){
	echo "h4 { color:{$webnus_h4_font_color}; }\n";
}



/*  H5 */

$webnus_h5_font_size = $webnus_options->webnus_h5_font_size(); 
if( !empty($webnus_h5_font_size) ){	
	echo "h5 { font-size:{$webnus_h5_font_size}; }\n";	
}
$webnus_h5_letter_spacing = $webnus_options->webnus_h5_letter_spacing(); 
if( !empty($webnus_h5_letter_spacing) ){	
	echo "h5 { letter-spacing:{$webnus_h5_letter_spacing}; }\n";	
}
$webnus_h5_line_height = $webnus_options->webnus_h5_line_height(); 
if( !empty($webnus_h5_line_height) ){	
	echo "h5 { line-height:{$webnus_h5_line_height}; }\n";	
}

$webnus_h5_font_color = $webnus_options->webnus_h5_font_color(); 
if( !empty($webnus_h5_font_color) ){
	
	echo "h5 { color:{$webnus_h5_font_color}; }\n";	
}



/*  H6 */

$webnus_h6_font_size = $webnus_options->webnus_h6_font_size(); 
if( !empty($webnus_h6_font_size) ){
	echo "h6 { font-size:{$webnus_h6_font_size}; }\n";
}
$webnus_h6_letter_spacing = $webnus_options->webnus_h6_letter_spacing(); 
if( !empty($webnus_h6_letter_spacing) ){
	echo "h6 { letter-spacing:{$webnus_h6_letter_spacing}; }\n";
}
$webnus_h6_line_height = $webnus_options->webnus_h6_line_height(); 
if( !empty($webnus_h6_line_height) ){
	echo "h6 { line-height:{$webnus_h6_line_height}; }\n";
}

$webnus_h6_font_color = $webnus_options->webnus_h6_font_color(); 
if( !empty($webnus_h6_font_color) ){
	echo "h6 { color:{$webnus_h6_font_color}; }\n";
}






/*
 * Color Skin Style Generator
 */

 /* Link Color */
 if($thm_options['webnus_link_color'])
 	echo "a {color:{$thm_options['webnus_link_color']};}\n\n";
 if($thm_options['webnus_hover_link_color'])
 	echo "a:hover {color:{$thm_options['webnus_hover_link_color']};}\n\n";	
 if($thm_options['webnus_visited_link_color'])
 	echo "a:visited {color:{$thm_options['webnus_visited_link_color']};}\n\n";	
 
 
 
 /* == Menu Colors ------------------ */
 
if($thm_options['webnus_menu_link_color'])	
	echo "#wrap #nav a { color:{$thm_options['webnus_menu_link_color']};}\n\n";

if($thm_options['webnus_menu_hover_link_color'])
	echo "#wrap #nav a:hover, #wrap  #nav li:hover > a{color:{$thm_options['webnus_menu_hover_link_color']};}\n\n";

if($thm_options['webnus_menu_selected_link_color'])
	echo "#wrap #nav li.current > a, #wrap #nav li.current ul li a:hover, #wrap #nav li.active > a {color:{$thm_options['webnus_menu_selected_link_color']};}\n\n";
	
if($thm_options['webnus_menu_selected_border_color'])
	echo "#wrap #nav > li.current:after {background:{$thm_options['webnus_menu_selected_border_color']};}\n\n";

if($thm_options['webnus_resoponsive_menu_icon_color'])
	echo "#wrap #header.sm-rgt-mn #menu-icon span.mn-ext1, #wrap #header.sm-rgt-mn #menu-icon span.mn-ext2, #wrap #header.sm-rgt-mn #menu-icon span.mn-ext3 {color:{$thm_options['webnus_resoponsive_menu_icon_color']};}\n\n";



/* == Icon Box Colors---------------------- */


if(isset($thm_options['webnus_iconbox_base_color']) && $thm_options['webnus_iconbox_base_color']!='')
{
	echo "#wrap .icon-box  i, #wrap  .icon-box1  i, #wrap .icon-box2 i, #wrap  .icon-box3  i, #wrap  .icon-box4 i, #wrap  .icon-box5 i , #wrap  .icon-box7  i { color:{$thm_options['webnus_iconbox_base_color']};}\n\n";
}

/* learn more link color */

if(isset($thm_options['webnus_learnmore_link_color']) && $thm_options['webnus_learnmore_link_color']!='')
{
	echo "#wrap a.magicmore { color:{$thm_options['webnus_learnmore_link_color']};}\n";
}
/* learn more hover link color */

if(isset($thm_options['webnus_learnmore_hover_link_color']) && $thm_options['webnus_learnmore_hover_link_color']!='')
{
	echo "#wrap a.magicmore:hover { color:{$thm_options['webnus_learnmore_hover_link_color']};}\n";
}




/* == Portfolio Colors---------------------- */


/* portfolio filter links color + border color */
if(isset($thm_options['webnus_portfolio_filter_links_color']) && $thm_options['webnus_portfolio_filter_links_color']!='')
{
	echo "#wrap nav.primary .portfolioFilters a { color:{$thm_options['webnus_portfolio_filter_links_color']};}\n";
}
if(isset($thm_options['webnus_portfolio_filter_links_border_color']) && $thm_options['webnus_portfolio_filter_links_border_color']!='')
{
	echo "#wrap nav.primary .portfolioFilters a { border-color:{$thm_options['webnus_portfolio_filter_links_border_color']};}\n";
}
/* portfolio filter links hover color + border color */

if(isset($thm_options['webnus_portfolio_filter_links_hover_color']) && $thm_options['webnus_portfolio_filter_links_hover_color']!='')
{
	echo "#wrap nav.primary .portfolioFilters a:hover {  color:{$thm_options['webnus_portfolio_filter_links_hover_color']};}\n";
}
if(isset($thm_options['webnus_portfolio_filter_links_hover_border_color']) && $thm_options['webnus_portfolio_filter_links_hover_border_color']!='')
{
	echo "#wrap nav.primary .portfolioFilters a:hover {  border-color:{$thm_options['webnus_portfolio_filter_links_hover_border_color']};}\n";
}

/* portfolio filter links color selected + border color */
if(isset($thm_options['webnus_portfolio_filter_selected_links_color']) && $thm_options['webnus_portfolio_filter_selected_links_color']!='')
{
	echo "#wrap nav.primary .portfolioFilters a.selected, #wrap nav.primary ul li a:active {  color:{$thm_options['webnus_portfolio_filter_selected_links_color']}; }\n";
}

if(isset($thm_options['webnus_portfolio_filter_selected_links_border_color']) && $thm_options['webnus_portfolio_filter_selected_links_border_color']!='')
{
	echo "#wrap nav.primary .portfolioFilters a.selected, #wrap nav.primary ul li a:active {  border-color:{$thm_options['webnus_portfolio_filter_selected_links_border_color']}; }\n";
}



/* portfolio item zoom link color */

if(isset($thm_options['webnus_portfolio_item_zoom_link_color']) && $thm_options['webnus_portfolio_item_zoom_link_color']!='')
{
	echo ".zoomex2 a { color:{$thm_options['webnus_portfolio_item_zoom_link_color']};}\n";
}
/* portfolio item zoom link border color */
if(isset($thm_options['webnus_portfolio_item_zoom_link_border_color']) && $thm_options['webnus_portfolio_item_zoom_link_border_color']!='')
{
	echo ".zoomex2 a i { border-color:{$thm_options['webnus_portfolio_item_zoom_link_border_color']};}\n";
}


/* portfolio item zoom link hover color + border color */
if(isset($thm_options['webnus_portfolio_item_zoom_link_hover_color']) && $thm_options['webnus_portfolio_item_zoom_link_hover_color']!='')
{
	echo "#wrap .zoomex2 a:hover i { color:{$thm_options['webnus_portfolio_item_zoom_link_hover_color']};  }\n";
}
if(isset($thm_options['webnus_portfolio_item_zoom_link_hover_border_color']) && $thm_options['webnus_portfolio_item_zoom_link_hover_border_color']!='')
{
	echo "#wrap .zoomex2 a:hover i { border-color:{$thm_options['webnus_portfolio_item_zoom_link_hover_border_color']};  }\n";
}




/* contact form */

if(isset($thm_options['webnus_contactform_button_color']) && $thm_options['webnus_contactform_button_color']!='')
{
	echo "#wrap #footer .footer-in .contact-inf button {background-color:{$thm_options['webnus_contactform_button_color']};}\n";
}

if(isset($thm_options['webnus_contactform_button_hover_color']) && $thm_options['webnus_contactform_button_hover_color']!='')
{
	echo "#wrap #footer .footer-in .contact-inf button:hover {background-color:{$thm_options['webnus_contactform_button_hover_color']};}\n";
}




/* scroll to top */

if(isset($thm_options['webnus_scroll_to_top_hover_background_color']) && $thm_options['webnus_scroll_to_top_hover_background_color']!='')
{
	echo "#wrap #scroll-top a:hover {background-color:{$thm_options['webnus_scroll_to_top_hover_background_color']};}\n";
}






/* == Our Process Icon Colors------------------------------ */

/* our process icon color + border color += background color */
if(isset($thm_options['webnus_ourprocess_icon_color']) && $thm_options['webnus_ourprocess_icon_color']!='')
{
	echo "#wrap .our-process-item i { color:{$thm_options['webnus_ourprocess_icon_color']};}\n";
}

if(isset($thm_options['webnus_ourprocess_border_color']) && $thm_options['webnus_ourprocess_border_color']!='')
{
	echo "#wrap .our-process-item i { border-color:{$thm_options['webnus_ourprocess_border_color']};}\n";
}

if(isset($thm_options['webnus_ourprocess_background_color']) && $thm_options['webnus_ourprocess_background_color']!='')
{
	echo "#wrap .our-process-item i { background-color:{$thm_options['webnus_ourprocess_background_color']};} \n";
}

/* our process icon hover color + border color += background color */

if(isset($thm_options['webnus_ourprocess_hover_icon_color']) && $thm_options['webnus_ourprocess_hover_icon_color']!='')
{
	echo "#wrap .our-process-item:hover i { color:{$thm_options['webnus_ourprocess_hover_icon_color']};  } \n";
}
if(isset($thm_options['webnus_ourprocess_hover_border_color']) && $thm_options['webnus_ourprocess_hover_border_color']!='')
{
	echo "#wrap .our-process-item:hover i { border-color:{$thm_options['webnus_ourprocess_hover_border_color']};  } \n";
}
if(isset($thm_options['webnus_ourprocess_hover_background_color']) && $thm_options['webnus_ourprocess_hover_background_color']!='')
{
	echo "#wrap .our-process-item:hover i { background-color:{$thm_options['webnus_ourprocess_hover_background_color']};  } \n";
}




/*
 * Blog Loop And Single Blog Styles
 * 
 */
/* All Posts Title Font-family */
$webnus_blog_title_font_family = $webnus_options->webnus_blog_title_font_family(); 
if( !empty($webnus_blog_title_font_family) ){
	echo ".blog-post h4, .blog-post h1, .blog-post h3, .blog-line h4, .blog-single-post h1 { font-family:$webnus_blog_title_font_family;}\n";
}

/* Blog Loop Title font-size */
$webnus_blog_loop_title_font_size = $webnus_options->webnus_blog_loop_title_font_size(); 
if( !empty($webnus_blog_loop_title_font_size) ){
	echo ".blog-post h3 { font-size:{$webnus_blog_loop_title_font_size};}\n";
}

/* Blog Loop Title line-height */
$webnus_blog_loop_title_line_height = $webnus_options->webnus_blog_loop_title_line_height(); 
if( !empty($webnus_blog_loop_title_line_height) ){
	echo ".blog-post h3 { line-height:{$webnus_blog_loop_title_line_height};}\n";
}

/* Blog Loop Title font-weight */
$webnus_blog_loop_title_font_weight = $webnus_options->webnus_blog_loop_title_font_weight(); 
if( !empty($webnus_blog_loop_title_font_weight) ){
	echo ".blog-post h3 { font-weight:{$webnus_blog_loop_title_font_weight};}\n";
}

/* Blog Loop Title letter-spacing */
$webnus_blog_loop_title_letter_spacing = $webnus_options->webnus_blog_loop_title_letter_spacing(); 
if( !empty($webnus_blog_loop_title_letter_spacing) ){
	echo ".blog-post h3 { letter-spacing:{$webnus_blog_loop_title_letter_spacing};}\n";
}

/* Blog Loop Title color */
$webnus_blog_loop_title_color = $webnus_options->webnus_blog_loop_title_color(); 
if( !empty($webnus_blog_loop_title_color) ){
	echo ".blog-post h3, .blog-post h3 a { color:$webnus_blog_loop_title_color;}\n";
}


/* Blog Loop Title hover color */
$webnus_blog_loop_title_hover_color = $webnus_options->webnus_blog_loop_title_hover_color(); 
if( !empty($webnus_blog_loop_title_hover_color) )
{
	echo ".blog-post h3 a:hover { color:$webnus_blog_loop_title_hover_color;}\n";
}

/***** Blog Single Title Font Options *****/

/* Single post Title font-size */

$webnus_blog_single_post_title_font_size = $webnus_options->webnus_blog_single_post_title_font_size(); 
if( !empty($webnus_blog_single_post_title_font_size) )
{
	echo ".blog-single-post h1 { font-size:{$webnus_blog_single_post_title_font_size};}\n";
}


/* Single post Title line-height */

$webnus_blog_single_title_line_height = $webnus_options->webnus_blog_single_title_line_height(); 
if( !empty($webnus_blog_single_title_line_height) )
{
	echo ".blog-single-post h1 { line-height:{$webnus_blog_single_title_line_height};}\n";
}


/* Single post Title font-weight */

$webnus_blog_single_title_font_weight = $webnus_options->webnus_blog_single_title_font_weight(); 
if( !empty($webnus_blog_single_title_font_weight) )
{
	echo ".blog-single-post h1 { font-weight:{$webnus_blog_single_title_font_weight};}\n";
}

/* Single post Title letter-spacing */

$webnus_blog_single_title_letter_spacing = $webnus_options->webnus_blog_single_title_letter_spacing(); 
if( !empty($webnus_blog_single_title_letter_spacing) )
{
	echo ".blog-single-post h1 { letter-spacing:{$webnus_blog_single_title_letter_spacing};}\n";
}


/* Single post Title color */

$webnus_blog_single_title_color = $webnus_options->webnus_blog_single_title_color(); 
if( !empty($webnus_blog_single_title_color) )
{
	echo ".blog-single-post h1 { color:$webnus_blog_single_title_color;}\n";
}


/* Topbar background color */

$topbar_background = $webnus_options->webnus_topbar_background_color();

if(!empty($topbar_background))
	echo ".top-bar { background-color:$topbar_background; }\n";

	
/* footer background color */
$footer_background = $webnus_options->webnus_footer_background_color();

if(!empty($footer_background))
	echo "#wrap #footer { background-color:$footer_background; }\n";

$footer_bottom_background = $webnus_options->webnus_footer_bottom_background_color();

if(!empty($footer_bottom_background))
	echo "#wrap #footer .footbot { background-color:$footer_bottom_background; }\n";



if( $thm_options['webnus_custom_color_skin_enable'] ) { ?>

	/* == TextColors
	---------------- */
	.colorskin-custom #nav a:hover, .colorskin-custom #nav li:hover > a, .colorskin-custom #nav ul li a:hover, .colorskin-custom #nav li.current ul li a:hover, .colorskin-custom .nav-wrap2 #nav ul li a:hover, .colorskin-custom .nav-wrap2.darknavi #nav ul li a:hover, .colorskin-custom #nav ul li.current > a, .colorskin-custom #nav ul li:hover > a, .colorskin-custom nav.primary .portfolioFilters a:hover, .colorskin-custom .zoomex2 a:hover i, .colorskin-custom .latestposts-seven .wrap-date-icons h3.latest-date, .colorskin-custom .latestposts-seven .latest-content .latest-author a, .colorskin-custom .latestposts-seven .latest-content .latest-title a:hover, .colorskin-custom .jcarousel-next:hover, .colorskin-custom .jcarousel-next:active, .colorskin-custom .jcarousel-prev:hover, .colorskin-custom .jcarousel-prev:active, .colorskin-custom .w-divider7 h4, #wrap.colorskin-custom .wpb_accordion .wpb_accordion_wrapper .ui-state-active a, #wrap.colorskin-custom .wpb_accordion .wpb_accordion_wrapper .wpb_accordion_header a:hover, .colorskin-custom .colorf, .colorskin-custom .w-divider8 i, .colorskin-custom .w-pricing-table .price-footer a:hover, .colorskin-custom .max-counter.t-counter:hover .max-count, .colorskin-custom .blox.dark .max-counter.t-counter:hover .max-count, .colorskin-custom .dark-content .max-counter.t-counter:hover .max-count, .woocommerce .colorskin-custom  nav.woocommerce-pagination ul li a, .colorskin-custom h6.blog-date a:hover, .colorskin-custom h6.blog-cat a:hover, .colorskin-custom h6.blog-author a:hover, .colorskin-custom .blog-post a:hover, .colorskin-custom .blog-author span, .colorskin-custom .blog-line p a:hover, .colorskin-custom a.readmore:hover:after,
	.colorskin-custom a.magicmore, .colorskin-custom .icon-box3:hover i, .colorskin-custom .icon-box5:hover h4, .colorskin-custom .icon-box8 i, .colorskin-custom .icon-box14 i, .colorskin-custom .blox.dark .icon-box15 i, .colorskin-custom .blox.dark .icon-box15 h4, .colorskin-custom .blox.dark .icon-box15 a.magicmore, .colorskin-custom .icon-box16 i, .colorskin-custom .icon-box16 a.magicmore, .colorskin-custom .blox.dark .icon-box16 a.magicmore, .colorskin-custom .icon-box18 h4, .colorskin-custom .icon-box19 i, .colorskin-custom .icon-box19 a.magicmore, .colorskin-custom .icon-box20 i, .colorskin-custom .icon-box21 i, .colorskin-custom .icon-box21 a.magicmore, .colorskin-custom .icon-box23 i, .colorskin-custom .icon-box24 i, .colorskin-custom .icon-box24 a.magicmore:hover, .colorskin-custom .icon-box25 i
	{ color: <?php echo $thm_options['webnus_custom_color_skin']; ?>}


	/* == Backgrounds
	----------------- */
	.colorskin-custom #header.sm-rgt-mn #menu-icon span.mn-ext1, .colorskin-custom #header.sm-rgt-mn #menu-icon span.mn-ext2, .colorskin-custom #header.sm-rgt-mn #menu-icon span.mn-ext3,
	.colorskin-custom #nav > li.current:after, .colorskin-custom nav.primary ul li a:active, .colorskin-custom #scroll-top a:hover, .colorskin-custom #footer .tagcloud a:hover, .colorskin-custom #footer .side-list li:hover img, .colorskin-custom .toggle-top-area .side-list li:hover img, .colorskin-custom .max-hero h5:before, .colorskin-custom .icon-box22:hover a.magicmore, .colorskin-custom .callout a.callurl:hover, .colorskin-custom .max-counter.t-counter:hover i.icon-counter, .colorskin-custom .colorb, .colorskin-custom .side-list li:hover img, .single .woo-template .colorskin-custom span.onsale, .woocommerce .colorskin-custom ul.products li.product .onsale, .colorskin-custom .postmetadata h6.blog-views span, .colorskin-custom .blog-post.blgtyp2 .comments-number-x2 span, #wrap.colorskin-custom .contact-inf i, .colorskin-custom .widget_shopping_cart_content p.buttons a.button,
	.colorskin-custom .icon-box1 i, .colorskin-custom .icon-box1 img, .colorskin-custom .icon-box4:hover i, .colorskin-custom .icon-box5:hover i, .colorskin-custom .icon-box6 i, .colorskin-custom .icon-box7:hover i, .colorskin-custom .icon-box8:hover i, .colorskin-custom .icon-box11:hover i, .colorskin-custom .icon-box13 a.magicmore:hover, .colorskin-custom .icon-box18 i, .colorskin-custom .icon-box20:hover i, .colorskin-custom .icon-box21:hover i, .colorskin-custom .icon-box22 i, .colorskin-custom .icon-box23:hover, .colorskin-custom .icon-box24:hover i, .colorskin-custom .icon-box25:hover i, #wrap.colorskin-custom .footer-in .contact-inf button, .colorskin-custom .max-counter.m-counter:hover .max-count, .colorskin-custom .blox.dark .max-counter.m-counter:hover .max-count, .colorskin-custom .dark-content .max-counter.m-counter:hover .max-count
	{ background-color: <?php echo $thm_options['webnus_custom_color_skin']; ?>}


	/* == BorderColors
	------------------ */
	.colorskin-custom nav.primary .portfolioFilters a.selected, .colorskin-custom nav.primary ul li a:active, .colorskin-custom .our-clients-wrap.crsl ul.our-clients img:hover, .colorskin-custom #footer .footer-in h5.subtitle:after, .colorskin-custom .w-divider7 h3:after, .colorskin-custom .our-team-sacramento h5:after, .colorskin-custom .max-counter.t-counter:hover i.icon-counter, .colorskin-custom .max-counter.t-counter .max-count:after, .colorskin-custom .subtitle-four:after, .colorskin-custom .widget h4.subtitle:after, .colorskin-custom h6.h-sub-content, .colorskin-custom .max-title2:after, .colorskin-custom .max-title4:after, .colorskin-custom .sidebar-line span, .colorskin-custom a.readmore:hover,
	.colorskin-custom .icon-box8:hover i, .colorskin-custom .icon-box11:hover i, .colorskin-custom .icon-box21:hover i, .colorskin-custom .icon-box16 a.magicmore:after, .colorskin-custom .blox.dark .icon-box16 a.magicmore:after, .colorskin-custom .max-counter.m-counter:hover .max-count, .colorskin-custom .blox.dark .max-counter.m-counter:hover .max-count, .colorskin-custom .dark-content .max-counter.m-counter:hover .max-count
	{ border-color: <?php echo $thm_options['webnus_custom_color_skin']; ?>}


<?php } 


/*
 * Custom CSS
*/
echo strip_tags($webnus_options->webnus_custom_css());

	$out = $GLOBALS['webnus_dyncss'] = '';
	$out = ob_get_contents();
	$out = preg_replace('!/\*[^*]*\*+([^/][^*]*\*+)*/!', '', $out);
	$GLOBALS['webnus_dyncss'] = str_replace(array("\r\n", "\r", "\n", "\t", '    '), '', $out);
	ob_end_clean();

?>