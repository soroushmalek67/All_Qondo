<?php
/**
 * This file represents an example of the code that themes would use to register
 * the required plugins.
 *
 * It is expected that theme authors would copy and paste this code into their
 * functions.php file, and amend to suit.
 *
 * @package    TGM-Plugin-Activation
 * @subpackage Example
 * @version    2.4.1
 * @author     Thomas Griffin
 * @author     Gary Jones
 * @copyright  Copyright (c) 2011, Thomas Griffin
 * @license    http://opensource.org/licenses/gpl-2.0.php GPL v2 or later
 * @link       https://github.com/thomasgriffin/TGM-Plugin-Activation
 */

require_once get_template_directory() . '/inc/plugins/plugin-activator/class-tgm-plugin-activation.php';

add_action( 'tgmpa_register', 'webnus_register_required_plugins' );
function webnus_register_required_plugins() {
	$plugins = array(
		
		array(
			'name' 		=> 'Woocommerce',
			'slug' 		=> 'woocommerce',
			'required' 	=> false,
		),
		
		array(
			'name' 		=> 'Webnus Portfolio',
			'slug' 		=> 'webnus-portfolio',
			'required' 	=> true,
			'source'    => get_template_directory() . '/inc/plugins/webnus-portfolio.zip',
			'force_activation'      => false,
			'force_deactivation'    => false,
		),

		array(
			'name' 		=> 'Contact Form 7',
			'slug' 		=> 'contact-form-7',
			'required' 	=> false,
		),

 		array(
            'name'       => 'Social Count Plus',
            'slug'       => 'social-count-plus',
            'required'   => false,
        ),
		
		array(
			'name'       => 'WP Review',
			'slug'       => 'wp-review',
			'required'   => false,
		),
		
		array(
			'name'                  => 'Slider Revolution',
			'slug'                  => 'revslider',
			'source'                => get_template_directory() . '/inc/plugins/revslider.zip',
			'required'              => false,
		),
		
		array(
			'name'                  => 'Layer Slider',
			'slug'                  => 'LayerSlider',
			'source'                => get_template_directory() . '/inc/plugins/layerslider.zip',
			'required'              => false,
		),	
			
		array(
			'name'                  => 'Visual Composer',
			'slug'                  => 'js_composer',
			'source'                => get_template_directory() . '/inc/plugins/js_composer.zip',
			'required'              => true,
		),
		
		array(
			'name'                  => 'Templatera',
			'slug'                  => 'templatera',
			'source'                => get_template_directory() . '/inc/plugins/templatera.zip',
			'required'              => false,
		),	
		
		array(
			'name'                  => 'Envato Wordpress Toolkit',
			'slug'                  => 'envato-wordpress-toolkit',
			'source'                => get_template_directory() . '/inc/plugins/envato-wordpress-toolkit.zip',
			'required'              => false,
		),	
		
		array(
            'name'                  => 'Kakapo Custom sidebar',
            'slug'                  => 'kakapo',
            'source'                => get_template_directory() . '/inc/plugins/kakapo.zip',
            'required'              => false,
        ),

	);
	

	$config = array(
		'id'           => 'tgmpa',                 // Unique ID for hashing notices for multiple instances of TGMPA.
		'default_path' => '',                      // Default absolute path to bundled plugins.
		'menu'         => 'tgmpa-install-plugins', // Menu slug.
		'parent_slug'  => 'themes.php',            // Parent menu slug.
		'capability'   => 'edit_theme_options',    // Capability needed to view plugin install page, should be a capability associated with the parent menu used.
		'has_notices'  => true,                    // Show admin notices or not.
		'dismissable'  => true,                    // If false, a user cannot dismiss the nag message.
		'dismiss_msg'  => '',                      // If 'dismissable' is false, this message will be output at top of nag.
		'is_automatic' => false,                   // Automatically activate plugins after installation or not.
		'message'      => '',                      // Message to output right before the plugins table.
	);

	tgmpa( $plugins, $config );

}
if(function_exists('vc_set_as_theme')) vc_set_as_theme( $disable_updater = true );