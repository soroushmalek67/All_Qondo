<?php
/*
Template Name: Portfolio Masonry
*/
get_header();
GLOBAL $webnus_options;

?>
<section id="main-content-pin" class="portfolio-pin">
<hr class="vertical-space1">
<div class="container">

<div id="pin-content">
<?php
$page = (get_query_var('paged')) ? get_query_var('paged') : 1;
$args = array(
	   'orderby'=>'date',
	   'order'=>'desc',
	   'post_type'=>'portfolio',
	   'paged' => $page,
	   'posts_per_page'=>18
); 
query_posts($args);
 
if (have_posts()) : while (have_posts()) : the_post();
?>
<article  class="pin-box entry -item">
<div class="img-item">
<?php get_the_image( array( 'meta_key' => array( 'Full', 'Full' ), 'size' => 'Full' ) );?>
</div>
<div class="pin-ecxt">
<h6 class="blog-date"><?php echo get_the_date('d M Y');?> </h6>
<h4><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h4>

</div>
<div class="pin-ecxt2">
<h6 class="blog-cat-tline"><?php 

				$terms = get_the_terms(get_the_id(), 'portfolio_category' );
				$terms_slug_str = '';
				//var_dump($terms);
				if ($terms && ! is_wp_error($terms)) :
					$term_slugs_arr = array();
					foreach ($terms as $term) {
						$term_slugs_arr[] = '<a href="'. get_term_link($term, 'portfolio_category') .'">' . $term->name . '</a>';
					}
					$terms_slug_str = join( ", ", $term_slugs_arr);
				endif;
				echo $terms_slug_str;

			?> </h6>
</div>

</article>


</article>
<?php 
endwhile;
endif;

?>

</div><!-- end-pin-content -->

<div class="vertical-space2"></div>

</div>  
</section><!-- end-main-content-pin -->
<?php  wp_reset_query(); // Reset the Query Loop 
get_footer();
?>