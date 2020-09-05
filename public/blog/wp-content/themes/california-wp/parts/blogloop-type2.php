<article id="post-<?php the_ID(); ?>" <?php post_class('blog-post blgtyp2'); ?>>

<?php
	GLOBAL $webnus_options;
	$featured_enable = $webnus_options->webnus_blog_featuredimage_enable();
	$post_format = get_post_format(get_the_ID());
	if(!$post_format) $post_format = 'standard';
	$content = get_the_content();
	global $featured_video;
	$meta_video = $featured_video->the_meta();
?>

<?php // Post Thumbnail
if( !empty($featured_enable) && $post_format != 'aside' && $post_format != 'quote' && $post_format != 'link' && (has_post_thumbnail() || !empty($meta_video))) { ?>
	 <div class="col-md-4 alpha">
		<?php if($post_format  == 'video' || $post_format == 'audio') {
					$pattern = '\\[' . '(\\[?)' . "(video|audio)" . '(?![\\w-])' . '(' . '[^\\]\\/]*' . '(?:' . '\\/(?!\\])' . '[^\\]\\/]*' . ')*?' . ')' . '(?:' . '(\\/)' . '\\]' . '|' . '\\]' . '(?:' . '(' . '[^\\[]*+' . '(?:' . '\\[(?!\\/\\2\\])' . '[^\\[]*+' . ')*+' . ')' . '\\[\\/\\2\\]' . ')?' . ')' . '(\\]?)';
					preg_match('/'.$pattern.'/s', $post->post_content, $matches);
					if( (is_array($matches)) && (isset($matches[3])) && ( ($matches[2] == 'video') || ('audio'  == $post_format)) && (isset($matches[2]))) {
					$video = $matches[0];
					echo do_shortcode($video);
					$content = preg_replace('/'.$pattern.'/s', '', $content);
					} elseif( (!empty( $meta_video )) && (!empty($meta_video['the_post_video'])) ) {
					echo do_shortcode($meta_video['the_post_video']);
					}
			} elseif( 'gallery'  == $post_format) {
					$pattern = '\\[' . '(\\[?)' . "(gallery)" . '(?![\\w-])' . '(' . '[^\\]\\/]*' . '(?:' . '\\/(?!\\])' . '[^\\]\\/]*' . ')*?' . ')' . '(?:' . '(\\/)' . '\\]' . '|' . '\\]' . '(?:' . '(' . '[^\\[]*+' . '(?:' . '\\[(?!\\/\\2\\])' . '[^\\[]*+' . ')*+' . ')' . '\\[\\/\\2\\]' . ')?' . ')' . '(\\]?)';
					preg_match('/'.$pattern.'/s', $post->post_content, $matches);
					if( (is_array($matches)) && (isset($matches[3])) && ($matches[2] == 'gallery') && (isset($matches[2]))) {
					$ids = (shortcode_parse_atts($matches[3]));				
					if(is_array($ids) && isset($ids['ids'])) { $ids = $ids['ids']; }
					echo do_shortcode('[vc_gallery img_size= "full" type="flexslider_fade" interval="3" images="'.$ids.'" onclick="link_image" custom_links_target="_self"]');
					$content = preg_replace('/'.$pattern.'/s', '', $content);}
			} else {
					get_the_image( array( 'meta_key' => array( 'thumbnail', 'thumbnail' ), 'size' => 'blog2_thumb' ) ); }
		?>
		<br>
	</div>
	<div class="col-md-8 omega">
<?php } else { ?>
	<div class="col-md-11 omega">
<?php } ?>
		
		
<div class="au-avatar-box">
	<?php if($webnus_options->webnus_blog_meta_gravatar_enable()) { ?>	
		<div class="au-avatar"><?php echo get_avatar( get_the_author_meta( 'user_email' ), 90 ); ?></div>
	<?php } ?>
	<?php if($webnus_options->webnus_blog_meta_author_enable() ) { ?>	
		<h6 class="blog-author"><strong><?php _e('by','WEBNUS_TEXT_DOMAIN'); ?></strong> <?php the_author_posts_link(); ?> </h6>
	<?php } ?>
</div>

	
<?php // Post Title
if( $webnus_options->webnus_blog_posttitle_enable() && $post_format !='aside' && $post_format !='quote') { 	
	if( 'link' == $post_format ) {
		preg_match('/\b(?:(?:https?|ftp):\/\/|www\.)[-a-z0-9+&@#\/%?=~_|!:,.;]*[-a-z0-9+&@#\/%=~_|]/i', $content,$matches);
		$content = preg_replace('/\b(?:(?:https?|ftp):\/\/|www\.)[-a-z0-9+&@#\/%?=~_|!:,.;]*[-a-z0-9+&@#\/%=~_|]/i','', $content,1);
		$link ='';
		if(isset($matches) && is_array($matches)) $link = $matches[0]; ?>
			<h3><a href="<?php echo esc_url($link); ?>"><?php the_title() ?></a></h3>
	<?php }	else { ?>
		<h3><a href="<?php the_permalink(); ?>"><?php the_title() ?></a></h3>
	<?php }
} ?>

	 <div class="postmetadata">
		<h6 class="blog-date"><strong><?php the_time('d') ?></strong> <?php the_time('M Y') ?></h6>
		<?php if( 1 == $webnus_options->webnus_blog_meta_category_enable() ) { ?>
		<h6 class="blog-cat"><strong><?php _e('in','WEBNUS_TEXT_DOMAIN'); ?></strong> <?php the_category(', ') ?> </h6>
		<?php } ?>
		<?php if( 1 == $webnus_options->webnus_blog_meta_comments_enable() ) { ?>
		<h6 class="blog-comments"> <?php comments_number(  ); ?> </h6>
		<?php } ?>
		<?php if( 1 == $webnus_options->webnus_blog_meta_views_enable() ) { ?>
		<h6 class="blog-views"> <i class="fa-eye"></i><span><?php echo getViews(get_the_ID()); ?></span> </h6>
		<?php } ?>
	 </div>

	<?php // Post Content
		if($post_format == 'quote' ) echo '<blockquote>';
		if($webnus_options->webnus_blog_excerptfull_enable()){
			apply_filters('the_content',$content);}
		else{
			echo '<p>'.get_the_excerpt().'</p>';}
		if($post_format == 'quote') echo '</blockquote>';
		if($post_format == ('quote') || $post_format == 'aside' )
			echo '<a class="readmore" href="'. get_permalink( get_the_ID() ) . '">' . __('View Post', 'WEBNUS_TEXT_DOMAIN') . '</a>';
	?>
		
	</div>
<br class="clear">
</article>