<?php
$hideheader = '';
GLOBAL $webnus_options;
if( is_page())
{
GLOBAL $webnus_page_options_meta;
@$hideheader_meta = (isset($webnus_page_options_meta))?$webnus_page_options_meta->the_meta():null;
$hideheader =(isset($hideheader_meta) && is_array($hideheader_meta) && isset($hideheader_meta['webnus_page_options'][0]['maxone_hideheader']))?$hideheader_meta['webnus_page_options'][0]['maxone_hideheader']:null;
}
?>


<header id="header"  class="horizontal-w <?php
$menu_icon = $webnus_options->webnus_header_menu_icon();
$menu_type = $webnus_options->webnus_header_menu_type();
if(!empty($menu_icon)) echo 'sm-rgt-mn ';
if($menu_type==9) echo 'box-menu ';
echo ($hideheader == 'yes')? 'hi-header ' : '';
echo ' '.$webnus_options->webnus_header_color_type()
 ?>">
	<div  class="container">
		<?php
		$logo_alignment = $webnus_options->webnus_header_logo_alignment();
		if( 1 == $logo_alignment ) {
			echo '<div class="col-md-3 logo-wrap">';
		} elseif( 2 == $logo_alignment ) {
			echo '<div class="col-md-3 cntmenu-leftside"></div><div class="col-md-6 logo-wrap center">';
		} elseif( 3 == $logo_alignment ) {
			echo '<div class="col-md-3 logo-wrap right">';
		}
		?>
			<div class="logo">
<?php
/* Check if there is one logo exists at least. */
$has_logo = false;

$logo ='';
$logo_width = '';

$transparent_logo = '';
$transparent_logo_width = '150';

$sticky_logo = '';
$sticky_logo_width = '150';

$logo = $webnus_options->webnus_logo();
$logo_width = preg_replace('#[^0-9]#','',strip_tags($webnus_options->webnus_logo_width()));

$transparent_logo = $webnus_options->webnus_transparent_logo();
$transparent_logo_width = preg_replace('#[^0-9]#','',strip_tags($webnus_options->webnus_transparent_logo_width()));

$sticky_logo = $webnus_options->webnus_sticky_logo();
$sticky_logo_width = preg_replace('#[^0-9]#','',strip_tags($webnus_options->webnus_sticky_logo_width()));

if( !empty($logo) || !empty($transparent_logo) || !empty($sticky_logo) ) $has_logo = true;
if((TRUE === $has_logo))
{
if(!empty($logo))
	echo '<a href="'.esc_url(home_url( '/' )).'"><img src="'.esc_url($logo).'" width="'. (!empty($logo_width)?$logo_width:"150"). '" id="img-logo-w1" alt="logo" class="img-logo-w1"></a>';

if(!empty($transparent_logo))
	echo '<a href="'.esc_url(home_url( '/' )).'"><img src="'.esc_url($transparent_logo).'" width="'. (!empty($transparent_logo_width)?$transparent_logo_width:"150"). '" id="img-logo-w2" alt="logo" class="img-logo-w2"></a>';
else 
	echo '<a href="'.esc_url(home_url( '/' )).'"><img src="'.esc_url($logo).'" width="'. (!empty($transparent_logo_width)?$transparent_logo_width:$logo_width). '" id="img-logo-w2" alt="logo" class="img-logo-w2"></a>';
if(!empty($sticky_logo))
	echo '<span class="logo-sticky"><a href="'.esc_url(home_url( '/' )).'"><img src="'.esc_url($sticky_logo).'" width="'. (!empty($sticky_logo_width)?$sticky_logo_width:"150"). '" id="img-logo-w3" alt="logo" class="img-logo-w3"></a></span>';
else 
	echo '<span class="logo-sticky"><a href="'.esc_url(home_url( '/' )).'"><img src="'.esc_url($logo).'" width="'. (!empty($sticky_logo_width)?$sticky_logo_width:$logo_width). '" id="img-logo-w3" alt="logo" class="img-logo-w3"></a></span>'; 
}else{ ?>
<h1 id="site-title"><a href="<?php echo esc_url(home_url( '/' )); ?>"><?php bloginfo( 'name' ); ?></a>

<span class="site-slog">
<a href="<?php echo esc_url(home_url( '/' )); ?>">
<?php             
	$slogan = $webnus_options->webnus_slogan();
	if( empty($slogan))
		bloginfo( 'description' );
	else
		echo esc_html($slogan);                      
?>
</a>
</span></h1>
<?php } ?>
		</div></div>
	<?php
		switch($logo_alignment){
			case 1:
				echo '<div class="col-md-9 alignright"><hr class="vertical-space" />';
			break;
			case 2:
				echo '<div class="col-md-3 right-side">';
			break;
			case 3:
				echo '<div class="col-md-9 left-side"><hr class="vertical-space" />';
			break;
			default:
			echo '';
		}
			$logo_rightside = $webnus_options->webnus_header_logo_rightside();
			if( 1 == $logo_rightside ){
			?>
				<form action="<?php echo esc_url(home_url( '/' )); ?>" method="get">
				<input name="s" type="text" placeholder="<?php _e('Search...','WEBNUS_TEXT_DOMAIN') ?>" class="header-saerch" >
				</form>
			<?php }
			elseif(2 == $logo_rightside)
			{ ?>
				<h6><i class="fa-envelope-o"></i> <?php echo esc_html($webnus_options->webnus_header_email()); ?></h6>
				<h6><i class="fa-phone"></i> <?php echo esc_html($webnus_options->webnus_header_phone()); ?></h6>
			<?php }
			elseif(3 == $logo_rightside)
			{
				dynamic_sidebar('header-advert');
				if(is_active_sidebar('woocommerce_header'))
				dynamic_sidebar('woocommerce_header');
			}
			?>
		</div>
	</div>
	<hr class="vertical-space" />
	<nav id="nav-wrap" class="nav-wrap2 <?php if( 3==$logo_alignment ) echo 'left'; elseif( 2==$logo_alignment ) echo 'center'; ?> <?php 
		
		switch($menu_type){
			case 2:
				echo 'mn4';
				break;
			case 3:
				echo 'mn4 darknavi';
				break;
			case 5:
				echo 'darknavi';
				break;
			default:
				echo '';
		}
	?>">
		<div class="container">	
			<?php
					if(is_page_template('page-onepage.php'))
					{
					
					if ( has_nav_menu( 'onepage-header-menu' ) ) { 
						
						wp_nav_menu( array( 'theme_location' => 'onepage-header-menu', 'container' => 'false', 'menu_id' => 'nav', 'depth' => '5', 'fallback_cb' => 'wp_page_menu', 'items_wrap' => '<ul id="%1$s">%3$s</ul>',  'walker' => new webnus_description_walker() ) );
					}
					}
					else{
					if ( has_nav_menu( 'header-menu' ) ) { 
						wp_nav_menu( array( 'theme_location' => 'header-menu', 'container' => 'false', 'menu_id' => 'nav', 'depth' => '5', 'fallback_cb' => 'wp_page_menu', 'items_wrap' => '<ul id="%1$s">%3$s</ul>',  'walker' => new webnus_description_walker() ) );
					}
					}
			?>
		</div>
	</nav>
	<!-- /nav-wrap -->
	
</header>
<!-- end-header -->