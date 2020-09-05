<?php
function webnus_blog($attributes, $content = null){
	extract(shortcode_atts(array(
	'type'=>'1',
	'category'=>'',
	'count'=>5,
	), $attributes));
	ob_start();
	$paged = ( is_front_page() ) ? 'page' : 'paged' ;
	$args = array(
		   'orderby'=>'date',
		   'order'=>'desc',
		   'post_type'=>'post',
		   'paged' => get_query_var($paged),
		   'category_name' => $category,
		   'posts_per_page'=> $count,
	); 
	query_posts($args);
	GLOBAL $webnus_options;

	if (have_posts()) : while (have_posts()) : the_post();
		get_template_part('parts/blogloop', ($type=='2')?'type2':'');
	endwhile;
	endif;

	if(function_exists('wp_pagenavi')) {
		wp_pagenavi();
	}

	$out = ob_get_contents();
	ob_end_clean();	
	wp_reset_query( array('query' => $args ) );
	return $out;
}
add_shortcode("blog", "webnus_blog");
?>