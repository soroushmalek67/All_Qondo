<?php
	get_header();
	GLOBAL $webnus_options;
	$sidebar = $webnus_options->webnus_blog_sidebar();
	$template = $webnus_options->webnus_blog_template();
	$last_time = get_the_time(' F Y'); $i=1; $flag = false; //timeline
	if ($template == 3 || $template == 4) // disabled sidebar in masonry or timeline
		$sidebar = 'none';
?>
	
	
<?php // start headline		
	if($webnus_options->webnus_blog_page_title_enable() == 1 ){
		echo'<section id="headline"><div class="container"><h3>'. $webnus_options->webnus_blog_page_title() .'</h3></div></section>';
	} // end headline ?>


<?php // start main content
	if($template == 1 || $template == 2){
		echo '<section class="container page-content" ><hr class="vertical-space2">';
		if ($sidebar == 'left' || $sidebar == 'both')
			get_sidebar('bleft');
		if ($sidebar == 'both')
				$class='col-md-6 cntt-w';
		elseif ($sidebar == 'right' || $sidebar == 'left')
				$class='col-md-9 cntt-w';
		else // none sidebar
				$class='col-md-12 omega';	
		echo '<section class="'. $class .'">';
	}else if ($template == 3){ 
		echo'<section id="main-content-pin"><div class="container"><div id="pin-content">';
	}else if ($template == 4){ 
		echo'<section id="main-timeline"><div class="container"><div id="tline-content">';
	} // end main content ?>
	

<?php // start query
	$args = array( 'category_name' => 'featured' );
	query_posts($args);	
	if(have_posts()):
		while( have_posts() ): the_post();
			if($sidebar == 'both')
				get_template_part('parts/blogloop','bothsidebar');
			else{
				switch($template){
					case 2:
						get_template_part('parts/blogloop','type2');
					break;
					case 3:
						get_template_part('parts/blogloop','masonry');
					break;
					case 4:
						get_template_part('parts/blogloop','timeline');
					break;
					default:
						get_template_part('parts/blogloop'); //type 1
					break;
				}
			}
		endwhile;
	else:
		get_template_part('blogloop-none');
	endif;
	wp_reset_query();
	// end featured query and start all query
	$paged = ( get_query_var('paged') ) ? get_query_var('paged') : 1;
	$idObj = get_category_by_slug('featured'); 
	$id=array();
	if($idObj)
	$id = $idObj->term_id;
	query_posts(array('category__not_in' => array( $id ), 'paged'=>$paged));
	if(have_posts()):
		while( have_posts() ): the_post();
			if( $sidebar == 'both')
				get_template_part('parts/blogloop','bothsidebar');
			else{
				switch($template){
					case 2:
						get_template_part('parts/blogloop','type2');
					break;
					case 3:
						get_template_part('parts/blogloop','masonry');
					break;
					case 4:
						get_template_part('parts/blogloop','timeline');
					break;
					default:
						get_template_part('parts/blogloop'); //type 1
					break;
				}
			}
		endwhile;
	else:
		get_template_part('blogloop-none');
	endif;
	
	if($template == 4) // for timeline
		echo'<div class="tline-topdate enddte">'. get_the_time(' F Y') .'</div></div>';

	wp_reset_query();
// end query ?>


<?php if($template == 3 || $template == 4)
	echo '</div>'; ?>

	<div class="vertical-space3"></div>

<?php if(function_exists('wp_pagenavi')){
		wp_pagenavi();
		echo '<hr class="vertical-space">';
	} ?>

</section>

<?php if ($sidebar == 'right' || $sidebar == 'both')
	get_sidebar('bright'); ?>

<?php if($template == 1 || $template == 2)
	echo '</section>'; ?>


<?php get_footer(); ?>