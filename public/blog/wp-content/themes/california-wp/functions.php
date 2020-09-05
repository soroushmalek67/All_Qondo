<?php
load_theme_textdomain('WEBNUS_TEXT_DOMAIN', get_template_directory().'/languages');


/******************************/
/*
/*		Walker Nav Menu
/*
/******************************/

class webnus_description_walker extends Walker_Nav_Menu{
	function start_el(&$output, $item, $depth=0, $args=array(),$current_object_id=0){
		$this->curItem = $item;
		$indent = ( $depth ) ? str_repeat( "\t", $depth ) : '';
		$class_names = $value = '';
		$classes = empty( $item->classes ) ? array() : (array) $item->classes;
		$classes[] = 'menu-item-' . $item->ID;
		$class_names = join( ' ', apply_filters( 'nav_menu_css_class', array_filter( $classes ), $item, $args ) );
		$class_names = $class_names ? ' class="' . esc_attr( $class_names ) . '"' : '';
		$id = apply_filters( 'nav_menu_item_id', 'menu-item-'. $item->ID, $item, $args );
		$id = $id ? ' id="' . esc_attr( $id ) . '"' : '';
		$is_mega_menu = '';
		if('page'  == $item->object){
			$post_obj = get_post( $item->object_id, 'OBJECT' );
			$is_mega = get_post_meta($item->object_id,'_is_mega_menu',true);
			if(!empty($is_mega) && $is_mega['is_mega_menu'] == 'yes')
				$is_mega_menu .= ' mega ';
		}
		$output .= $indent . '<li' . $id . $value . $class_names .'>';
		$atts = array();
		$atts['title']  = ! empty( $item->attr_title ) ? $item->attr_title : '';
		$atts['target'] = ! empty( $item->target )     ? $item->target     : '';
		$atts['rel']    = ! empty( $item->xfn )        ? $item->xfn        : '';
		$atts['href']   = ! empty( $item->url )        ? $item->url        : '';
		$atts = apply_filters( 'nav_menu_link_attributes', $atts, $item, $args );
		$attributes = '';
		$item_output = '';
		foreach ( $atts as $attr => $value ) {
			if ( ! empty( $value ) ) {
				$value = ( 'href' === $attr ) ? esc_url( $value ) : esc_attr( $value );
				$attributes .= ' ' . $attr . '="' . $value . '"';
			}
		}
		if('page'  == $item->object){
			$post_obj = get_post( $item->object_id, 'OBJECT' );
			$is_mega = get_post_meta($item->object_id,'_is_mega_menu',true);
			if(!empty($is_mega) && $is_mega['is_mega_menu'] == 'yes')
				$item_output .= do_shortcode($post_obj->post_content);
			else {
				$item_output .= $args->before;
				/** colorize categories in menu */
				$color ='';
				if ($item->object == 'category'){
					$cat_data = get_option("category_$item->object_id");
					$color = (!empty($cat_data['catBG']))?'style="color:'. $cat_data['catBG'] .'"':'';
				}
				$item_output .= '<a '. $color . $attributes. ' data-description="' .$item->description .'">';
				/** This filter is documented in wp-includes/post-template.php */
				if(!empty($item->icon))
				$item_output .= '<i class="'.$item->icon.'"></i>';
				$item_output .= $args->link_before . apply_filters( 'the_title', $item->title, $item->ID ) . $args->link_after;
				$item_output .= '</a>';
				$item_output .= $args->after;
			}
		}
		else{
		$item_output .= $args->before;
		$item_output .= '<a '. $attributes. ' data-description="' .$item->description .'">';
		/** This filter is documented in wp-includes/post-template.php */
		if(!empty($item->icon))
		$item_output .= '<i class="'.$item->icon.'"></i>';
		$item_output .= $args->link_before . apply_filters( 'the_title', $item->title, $item->ID ) . $args->link_after;
		$item_output .= '</a>';
		$item_output .= $args->after;
		}
		$output .= apply_filters( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args );
	}
}

include_once('inc/init.php');
include_once get_template_directory(). '/inc/visualcomposer/init.php';

$webnus_options = new webnus_options();

function theme_slug_setup() {
   add_theme_support( 'title-tag' );
}
add_action( 'after_setup_theme', 'theme_slug_setup' );

add_theme_support( 'woocommerce' );
add_theme_support('post-thumbnails');

//add_filter('show_admin_bar', '__return_false');
add_filter('excerpt_length', 'webnus_excerpt_length', 999);
add_filter('widget_text', 'do_shortcode');


function webnus_excerpt_length($len) {
    GLOBAL $webnus_options;
    return $webnus_options->webnus_blog_excerpt_len();
}

function webnus_excerpt_more($more) {
    global $post, $webnus_options;
    return '... <br><br><a class="readmore" href="' . get_permalink($post->ID) . '">' . $webnus_options->webnus_blog_readmore_text() . '</a>';
}

add_filter('excerpt_more', 'webnus_excerpt_more');

function webnus_limit_content($string, $word_limit)
{
  $words = explode(' ', $string, ($word_limit + 1));
  if(count($words) > $word_limit)
  array_pop($words);
  return implode(' ', $words);
}

/******************************/
/*
/*		Register Menus
/*
/******************************/

function webnus_register_menus() {
    register_nav_menus(
            array(
                'header-menu' => __('Header Menu', 'WEBNUS_TEXTDOMAIN'),
				'duplex-menu-left' => __('Duplex Menu - Left', 'WEBNUS_TEXTDOMAIN'),
				'duplex-menu-right' => __('Duplex Menu - Right', 'WEBNUS_TEXTDOMAIN'),
                'footer-menu' => __('Footer Menu', 'WEBNUS_TEXTDOMAIN'),
                'header-top-menu' => __('Topbar Menu', 'WEBNUS_TEXTDOMAIN'),
				'onepage-header-menu' => __('Onepage Header Menu', 'WEBNUS_TEXTDOMAIN'),
				
            )
    );
	
}

add_action('init', 'webnus_register_menus');

/******************************/
/*
/*		Header Assets
/*
/******************************/

include_once get_template_directory() . '/inc/dynamicfiles/dyncss.php';

function webnus_script_loader(){
	
	GLOBAL $webnus_options;
	
	/***************************************/
	/*			Main style.css
	/***************************************/
	
	$main_style_uri = ($webnus_options->webnus_css_minifier())?get_template_directory_uri().'/css/master-min.php':get_template_directory_uri().'/css/master.css';

	wp_register_style( 'main-style', $main_style_uri );
	wp_enqueue_style('main-style');
	
	/******************************/
	/*
	/*		Select Template
	/*
	/******************************/

	$w_template = ($webnus_options->webnus_template_select() != '')? get_template_directory_uri().'/css/style-'.$webnus_options->webnus_template_select().'.css':''; 
	wp_register_style( 'template-style', $w_template );
	wp_enqueue_style('template-style');

	/***************************************/
	/*			Dynamic Css dyncss.php
	/***************************************/
	if ( $GLOBALS['webnus_dyncss'] ) {
		wp_enqueue_style('webnus-dynamic-styles',get_template_directory_uri() . '/css/dyncss.css');
		wp_add_inline_style( 'webnus-dynamic-styles', $GLOBALS['webnus_dyncss']);
	}

	
	/***************************************/
	/*			Google fonts
	/***************************************/
	
	wp_register_style( 'google_fonts_css', $webnus_options->webnus_get_google_fonts() );
	wp_enqueue_style('google_fonts_css');
	
	
	/***************************************/
	/*			Default Google Font
	/***************************************/
	
	$protocol = is_ssl() ? 'https' : 'http';
	wp_enqueue_style( 'gfont-default', "$protocol://fonts.googleapis.com/css?family=Roboto:100,300,400,500,700%7CDomine:400,700" );
	if($webnus_options->webnus_template_select() == 'malibu')
		wp_enqueue_style( 'gfont-malibu', "$protocol://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700" );
	elseif($webnus_options->webnus_template_select() == 'sacramento')
		wp_enqueue_style( 'gfont-sacramento', "$protocol://fonts.googleapis.com/css?family=Montserrat:400,700" );
	elseif($webnus_options->webnus_template_select() == 'berkeley')
		wp_enqueue_style( 'gfont-berkeley', "$protocol://fonts.googleapis.com/css?family=Oswald:400,700" );
	elseif($webnus_options->webnus_template_select() == 'riverside')
		wp_enqueue_style( 'gfont-riverside', "$protocol://fonts.googleapis.com/css?family=Dosis:400,700" );
	elseif($webnus_options->webnus_template_select() == 'irvine')
		wp_enqueue_style( 'gfont-riverside', "$protocol://fonts.googleapis.com/css?family=Raleway:300,400,500,600,700" );
	
	
	/***************************************/
	/*			Comment Reply JS
	/***************************************/

	if ( is_singular() && $webnus_options->webnus_allow_comments_on_page() )
		wp_enqueue_script( 'comment-reply' );
	
	
	/***************************************/
	/*			flex & prettyphoto
	/***************************************/
	
}
add_action('wp_enqueue_scripts', 'webnus_script_loader');



/***************************************/
/*			Login
/***************************************/

	function webnus_login() {
	global $user_ID, $user_identity, $user_level;
	function webnus_logout_redirect($logouturl, $redir){
        return $logouturl . '&amp;redirect_to=http://'.esc_attr($_SERVER['HTTP_HOST']).esc_attr($_SERVER['REQUEST_URI']);
    }
	add_filter('logout_url', 'webnus_logout_redirect', 10, 2);;
	if ($user_ID) : ?>
		<div id="user-logged">
			<span class="author-avatar"><?php echo get_avatar( $user_ID, $size = '60'); ?></span>
			<div class="user-welcome"><?php _e('Welcome','WEBNUS_TEXT_DOMAIN'); ?> <strong><?php echo esc_html($user_identity) ?></strong></div>
			<ul class="logged-links">
				<li><a href="<?php echo home_url() ?>/wp-admin/"><?php _e('Dashboard','WEBNUS_TEXT_DOMAIN'); ?> </a></li>
				<li><a href="<?php echo home_url() ?>/wp-admin/profile.php"><?php _e('My Profile','WEBNUS_TEXT_DOMAIN'); ?> </a></li>
				<li><a href="<?php echo wp_logout_url(); ?>"><?php _e('Logout','WEBNUS_TEXT_DOMAIN'); ?> </a></li>	
			</ul>
			<div class="clear"></div>
		</div>
	<?php else: ?>
		<div id="user-login">
			<form name="loginform" id="loginform" action="<?php echo home_url() ?>/wp-login.php" method="post">
				<p id="login-user"><input type="text" name="log" id="log" value="<?php _e('Username','WEBNUS_TEXT_DOMAIN'); ?>" onfocus="if (this.value == '<?php _e('Username','WEBNUS_TEXT_DOMAIN'); ?>') {this.value = '';}" onblur="if (this.value == '') {this.value = '<?php _e('Username','WEBNUS_TEXT_DOMAIN'); ?>';}"  size="33" /></p>
				<p id="login-pass"><input type="password" name="pwd" id="pwd" value="<?php _e('Password','WEBNUS_TEXT_DOMAIN'); ?>" onfocus="if (this.value == '<?php _e('Password','WEBNUS_TEXT_DOMAIN'); ?>') {this.value = '';}" onblur="if (this.value == '') {this.value = '<?php _e('Password','WEBNUS_TEXT_DOMAIN'); ?>';}" size="33" /></p>
				<input type="submit" name="submit" value="<?php _e('Log in','WEBNUS_TEXT_DOMAIN') ?>" class="login-button" />
				<label for="rememberme"><input name="rememberme" id="rememberme" type="checkbox" checked="checked" value="forever" /> <?php _e('Remember Me','WEBNUS_TEXT_DOMAIN'); ?></label>
				<input type="hidden" name="redirect_to" value="<?php echo esc_attr($_SERVER['REQUEST_URI']); ?>"/>
			</form>
			<ul class="login-links">
				<?php if ( get_option('users_can_register') ) : ?><?php echo wp_register() ?><?php endif; ?>
				<li><a href="<?php echo home_url() ?>/wp-login.php?action=lostpassword"><?php _e('Lost your password?','WEBNUS_TEXT_DOMAIN'); ?></a></li>
			</ul>
		</div>
	<?php endif;
}


/******************************/
/*
/*		Footer Assets
/*
/******************************/
	
function webnus_footer_script_loader(){
	GLOBAL $webnus_options;
	wp_enqueue_script(
            'doubletab', get_template_directory_uri() . '>/js/jquery.plugins.js',  array( 'jquery' ), null, true
    );
	if(!is_single())
		wp_enqueue_script(
				'msaonry', get_template_directory_uri() . '/js/jquery.masonry.min.js', array( 'jquery' ), null, true
			);
	if($webnus_options->webnus_news_ticker())
		wp_enqueue_script(
				'ticker', get_template_directory_uri() . '/js/jquery.ticker.js', array( 'jquery' ), null, true
		);
    wp_enqueue_script(
            'custom_script', get_template_directory_uri() . '/js/california-custom.js', array( 'jquery' ), null, true
		);
}
add_action('wp_enqueue_scripts', 'webnus_footer_script_loader');


/***************************************/
/*			JavaScripts API
/***************************************/

add_action('wp_enqueue_scripts', 'webnus_api', 10);
function webnus_api() {
	// youtube
	wp_register_script( 'youtube-api', get_template_directory_uri() . '/js/youtube-api.js', array(), false, false);
}


/***************************************/
/*			Page Background 
/***************************************/
function webnus_page_background_override(){
GLOBAL $webnus_page_options_meta;
$meta = $webnus_page_options_meta->the_meta();
if(!empty( $meta )){
	$bgcolor =  isset($meta['webnus_page_options'][0]['background_color'])?$meta['webnus_page_options'][0]['background_color']:null;
	$bgimage =  isset($meta['webnus_page_options'][0]['the_page_bg'])?$meta['webnus_page_options'][0]['the_page_bg']:null;
	$bgpercent =  isset($meta['webnus_page_options'][0]['bg_image_100'])?$meta['webnus_page_options'][0]['bg_image_100']:null;
	$bgrepeat =  isset($meta['webnus_page_options'][0]['bg_image_repeat'])?$meta['webnus_page_options'][0]['bg_image_repeat']:null;
			$out = "";
			$out .= '<style type="text/css" media="screen">';
			$out .='body{ ';	
				if(!empty($bgcolor)){
					$out .= "background-image:url('');background-color:{$bgcolor};";
				}
				if(!empty($bgimage))
				{
					if($bgrepeat == 1)
						$out .=  " background-image:url('{$bgimage}'); background-repeat:repeat;";
					else if($bgrepeat==2)
						$out .=  " background-image:url('{$bgimage}'); background-repeat:repeat-x;";
					else if($bgrepeat==3)
						$out .=  " background-image:url('{$bgimage}'); background-repeat:repeat-y;";
					else if($bgrepeat==0)
					{
						if($bgpercent)
							$out .=  " background-image:url('{$bgimage}'); background-repeat:no-repeat; background-size:100% auto; ";
						else
							$out .=  " background-image:url('{$bgimage}'); background-repeat:no-repeat; ";		
					}
				}
			if($bgpercent == 'yes' && !empty($bgimage)) 
			$out .= 'background-size:cover;-webkit-background-size: cover;
					-moz-background-size: cover;
					-o-background-size: cover; background-attachment:fixed;
					background-position:center; ';
			$out .= ' } </style>';
	echo $out;
	}
}
function webnus_wphead_action(){
	GLOBAL $webnus_options;
	global $post;
	echo $webnus_options->webnus_background_image_style();
	echo esc_html($webnus_options->webnus_space_before_head());
	$w_adobe_typekit = ltrim ($webnus_options->webnus_typekit_id());
    if(isset($w_adobe_typekit ) && !empty($w_adobe_typekit ))
        echo '<script src="//use.typekit.net/'.$w_adobe_typekit.'.js"></script><script>try{Typekit.load();}catch(e){}</script>';
	if(!is_404() && isset($post))
		webnus_page_background_override(); // referred to up
}
add_action('wp_head', 'webnus_wphead_action');


/******************************/
/*
/*		Add Color Picker
/*
/******************************/

add_action( 'admin_enqueue_scripts', 'webnus_enqueue_color_picker' );
function webnus_enqueue_color_picker( $hook_suffix ) {
    wp_enqueue_style( 'wp-color-picker' );
	wp_enqueue_style( 'jquery-ui-core' );
	wp_enqueue_script( 'jquery-ui-core' ,null,null,null,false);
	wp_enqueue_style( 'thickbox' );
	wp_enqueue_script( 'thickbox' );
    wp_enqueue_script( 'my-script-handle', get_template_directory_uri().'/inc/nc-options/color.js', array( 'wp-color-picker' ), false, true );
}


add_action('admin_enqueue_scripts', 'webnus_base64_include_js');
function webnus_base64_include_js(){
    wp_enqueue_script(
            'base64', get_template_directory_uri() . '/js/base64.js', null, null, true
    );
}

/******************************/
/*
/*		Custom Admin Logo
/*
/******************************/

function webnus_custom_login_logo() {
    GLOBAL $webnus_options;
    $logo = $webnus_options->webnus_admin_login_logo();
    if(isset($logo) && !empty($logo))
    {
        echo '<style type="text/css">'.
             'h1 a { background-image:url('.$logo.') !important; }'.
         '</style>';
    }
}
add_action( 'login_head', 'webnus_custom_login_logo' );

/******************************/
/*
/*		Images Size
/*
/******************************/

$portfolio_image_width = $webnus_options->webnus_portfolio_image_width();
$portfolio_image_height = $webnus_options->webnus_portfolio_image_height();

add_image_size("portfolio_full", $portfolio_image_width, $portfolio_image_height, true);

// Theme Thumbs
add_image_size("home_lfb", 720 ,406, true);
add_image_size("blog2_thumb", 420,390, true);
add_image_size("lfb_thumb", 140,110, true);
add_image_size("latestfromblog", 720,388, true);
add_image_size("blog_timeline",380,302, true);
add_image_size("portfolio_thumb",720,549, true);
add_image_size("tabs-img", 64, 62, true);
add_image_size("latest-cover", 680, 520, true);

// IconFonts Style
add_action( 'admin_enqueue_scripts', 'webnus_iconfonts_enqueue' );
function webnus_iconfonts_enqueue( $hook_suffix ) {
   wp_enqueue_style(
            'iconfonts-style', get_template_directory_uri() . '/inc/iconfonts/style.css', null, null
    );
  wp_enqueue_style(
            'iconfonts-style-gen', get_template_directory_uri() . '/inc/iconfonts/custom.css', null, null
   );
}

if (!isset($content_width))
    $content_width = 940;
if (false)
    wp_link_pages(); 
if(false){
    posts_nav_link();
    paginate_links();
    the_tags();
    get_post_format(0);
}
if (function_exists('add_theme_support')) {
    add_theme_support('automatic-feed-links');	
    add_theme_support( 'post-formats', array( 'aside','gallery', 'link', 'quote','image','video','audio' ) );
}


// Add Theme option to Toolbar
function add_webnus_admin_bar_link() {
	global $wp_admin_bar;
	if ( !is_super_admin() || !is_admin_bar_showing() )
		return;
	$wp_admin_bar->add_menu( array(
	'id' => 'webnus_themeoption_link',
	'title' => __( 'Webnus Theme Option','WEBNUS_TEXT_DOMAIN'),
	'href' => site_url().'/wp-admin/themes.php?page=webnus_theme_options',
	) );
}
add_action('admin_bar_menu', 'add_webnus_admin_bar_link',25);



// Woocommerce js error hack
add_action( 'wp_enqueue_scripts', 'webnus_custom_frontend_scripts' );
function webnus_custom_frontend_scripts() {
	if (class_exists('Woocommerce')) {
		global $post, $woocommerce;
		$suffix = defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG ? '' : '.min';
		if(file_exists($woocommerce->plugin_path() . '/assets/js/jquery-cookie/jquery.cookie'.$suffix.'.js'))
		{
			rename($woocommerce->plugin_path() . '/assets/js/jquery-cookie/jquery.cookie'.$suffix.'.js', $woocommerce->plugin_path() . '/assets/js/jquery-cookie/jquery_cookie'.$suffix.'.js');	
		}
		wp_deregister_script( 'jquery-cookie' ); 
		wp_register_script( 'jquery-cookie', $woocommerce->plugin_url() . '/assets/js/jquery-cookie/jquery_cookie'.$suffix.'.js', array( 'jquery' ), '1.3.1', true );
	}
}


function setViews($postID) {
    $count_key = 'webnus_views';
    $count = get_post_meta($postID, $count_key, true);
    if($count==''){
        $count = 0;
        delete_post_meta($postID, $count_key);
        add_post_meta($postID, $count_key, '0');
    }else{
        $count++;
        update_post_meta($postID, $count_key, $count);
    }
    return $count;
}
function getViews($postID) {
    $count_key = 'webnus_views';
    $count = get_post_meta($postID, $count_key, true);
    if($count==''){
        $count = 0;
        delete_post_meta($postID, $count_key);
        add_post_meta($postID, $count_key, '0');
	}
    return $count;
}



if(function_exists('vc_set_as_theme')){
	add_action('init','webnus_set_vc_as_theme');
}
function webnus_set_vc_as_theme(){
	vc_set_as_theme($notifier = false);	
}


	
// Open Graph
add_action('wp_head', 'add_fb_open_graph_tags');
function add_fb_open_graph_tags() {
	if (is_single()) {
		global $post;
		if(get_the_post_thumbnail($post->ID, 'thumbnail')) {
			$thumbnail_id = get_post_thumbnail_id($post->ID);
			$thumbnail_object = get_post($thumbnail_id);
			$image = $thumbnail_object->guid;
		} else {	
			$image = ''; // Change this to the URL of the logo you want beside your links shown on Facebook
		}
		//$description = get_bloginfo('description');
		$description = my_excerpt( $post->post_content, $post->post_excerpt );
		$description = strip_tags($description);
		$description = str_replace("\"", "'", $description);
?>
<meta property="og:title" content="<?php the_title(); ?>" />
<meta property="og:type" content="article" />
<meta property="og:image" content="<?php echo $image; ?>" />
<meta property="og:url" content="<?php the_permalink(); ?>" />
<meta property="og:description" content="<?php echo $description ?>" />
<meta property="og:site_name" content="<?php echo get_bloginfo('name'); ?>" />
<?php 	}
}
function my_excerpt($text, $excerpt){
    if ($excerpt) return $excerpt;
    $text = strip_shortcodes( $text );
    $text = apply_filters('the_content', $text);
    $text = str_replace(']]>', ']]&gt;', $text);
    $text = strip_tags($text);
    $excerpt_length = apply_filters('excerpt_length', 55);
    $excerpt_more = apply_filters('excerpt_more', ' ' . '[...]');
    $words = preg_split("/[\n
	 ]+/", $text, $excerpt_length + 1, PREG_SPLIT_NO_EMPTY);
    if ( count($words) > $excerpt_length ) {
            array_pop($words);
            $text = implode(' ', $words);
            $text = $text . $excerpt_more;
    } else {
            $text = implode(' ', $words);
    }
    return apply_filters('wp_trim_excerpt', $text, $excerpt);
}


// MIMETYPE fonts
add_filter('upload_mimes', 'webnus_custom_font_mimes');
function webnus_custom_font_mimes ( $existing_mimes=array() ) {
	$existing_mimes['woff'] = 'application/x-font-woff';
	$existing_mimes['ttf'] = 'application/x-font-ttf';
	$existing_mimes['eot'] = 'application/vnd.ms-fontobject"';
	$existing_mimes['svg'] = 'image/svg+xml"';
	return $existing_mimes;
}


// Function that validates a field's length.
if ( ! function_exists( 'webnus_validate_length' ) ) {
	function webnus_validate_length( $fieldValue, $minLength ) {
		// First, remove trailing and leading whitespace
		return ( strlen( trim( $fieldValue ) ) > $minLength );
	}
}


?>