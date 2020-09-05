<?php
GLOBAL $webnus_options;
$topbar_leftcontent = $webnus_options->webnus_header_topbar_leftcontent();
$topbar_rightcontent = $webnus_options->webnus_header_topbar_rightcontent();
?>

<section class="top-bar">
<div class="container">

	<div class="<?php echo ($topbar_leftcontent==3)? 'socialfollow' : 'top-links'; ?> lftflot">
	<?php
	switch($topbar_leftcontent){
			case 1:
				if(has_nav_menu('header-top-menu')){
				$menuParameters = array(
					'theme_location'  => 'header-top-menu',
					'container'       => false,
					'echo'            => false,
					'items_wrap'      => '%3$s',
					'depth'           => 0,
				);
				echo strip_tags(wp_nav_menu( $menuParameters ), '<a>' );
				}
			break;
			case 2:
				echo '<h6><i class="fa-envelope-o"></i>'. esc_html($webnus_options->webnus_topbar_email()) .'</h6> <h6><i class="fa-phone"></i>'. esc_html($webnus_options->webnus_topbar_phone()).'</h6>';
			break;
			case 3:
				get_template_part('parts/topbar','social' );
			break;
			case 4:
				$left_tagline = $webnus_options -> webnus_top_left_tagline();
				echo ($left_tagline)?esc_html($left_tagline):'';
			break;
			case 5:		
				do_action('icl_language_selector');
			break;
	 }
	?>
	</div>

	<div class="<?php echo ( $topbar_rightcontent==3 )? 'socialfollow' : 'top-links'; ?> rgtflot">
	<?php
	switch($topbar_rightcontent){
			case 1:
				if(has_nav_menu('header-top-menu')){
				$menuParameters = array(
					'theme_location'  => 'header-top-menu',
					'container'       => false,
					'echo'            => false,
					'items_wrap'      => '%3$s',
					'depth'           => 0,
				);
				echo strip_tags(wp_nav_menu( $menuParameters ), '<a>' );
				}
			break;
			case 2:
				echo '<h6><i class="fa-envelope-o"></i>'. esc_html($webnus_options->webnus_topbar_email()) .'</h6> <h6><i class="fa-phone"></i>'. esc_html($webnus_options->webnus_topbar_phone()).'</h6>';
			break;
			case 3:
				get_template_part('parts/topbar','social' );
			break;
			case 4:
				$right_tagline = $webnus_options -> webnus_top_right_tagline();
				echo ($right_tagline)?esc_html($right_tagline):'';
			break;
			case 5:		
				do_action('icl_language_selector');
			break;
	 }
	?>
	</div>
	
</div>
</section>