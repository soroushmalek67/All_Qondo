<?php
function related_works_shortcode($attributes){
	extract(shortcode_atts(array(
	"title" => __('Related Works','WEBNUS_TEXT_DOMAIN'),
	), $attributes));
	$post_id = get_the_ID();
	$terms = get_the_terms( $post_id , 'portfolio_category' );
	if(is_array($terms)){
		$category_filter = array();
		foreach($terms as $term){
			$category_filter[] = $term->slug;
		}
	}else $category_filter=array();
	$wpbp = new WP_Query(array( 'post_type' => 'portfolio', 'taxonomy' => 'portfolio_category','post__not_in' => array($post_id) , 'posts_per_page' =>10,
	'tax_query' => array(array(	'taxonomy' => 'portfolio_category','field'    => 'slug','terms'    => $category_filter,	)), ));
	ob_start();
?>
	<div class="vertical-space1"></div>
	</section>
	<section class="related-works">
		<div class="container">
			<div class="clear"></div>
			<div class="col-md-12">
			<h4 class="subtitle">
			<?php echo esc_html($title); ?>
			</h4>
			</div>
			<ul id="latest-projects" class="crsl">
				<?php 
				if ($wpbp->have_posts()) :
				while ($wpbp->have_posts()) : $wpbp->the_post();
				?>
				<li class="portfolio-item">	
				<a href="<?php the_permalink(); ?>"> <?php get_the_image( array( 'meta_key' => array( 'thumbnail', 'thumbnail' ), 'size' => 'blog2_thumb' ) ); ?>
				<h5><strong>
				<?php the_title(); ?>
				</strong></h5></a> <p>
				<?php echo get_the_date('d M Y') ?> - <?php
				$terms = get_the_terms(get_the_id(), 'portfolio_category' );
				$terms_slug_str = '';
				if ($terms && ! is_wp_error($terms)) :
					$term_slugs_arr = array();
					foreach ($terms as $term) {
						$term_slugs_arr[] = '<a href="'. get_term_link($term, 'portfolio_category') .'">' . $term->name . '</a>';
					}
					$terms_slug_str = join( ", ", $term_slugs_arr);
				endif;
					echo $terms_slug_str;
				?>
				</p>						
				</li>
				<?php 
				endwhile;
				endif;
				wp_reset_query();
				?>
			</ul>
		</div>
	</section>
	<section class="container">
	<div class="vertical-space2"></div>
	<?php
	$out = ob_get_contents();
	ob_end_clean();
	return $out;
}
add_shortcode("related_works", 'related_works_shortcode');
?>