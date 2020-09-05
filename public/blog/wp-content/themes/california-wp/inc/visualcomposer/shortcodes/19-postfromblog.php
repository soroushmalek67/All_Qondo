<?php
vc_map( array(
        'name' =>'Webnus Post From Blog',
        'base' => 'postblog',
        "icon" => "webnus_postfromblog",
		"description" => "Single Post",
        'category' => __( 'Webnus Shortcodes', 'WEBNUS_TEXT_DOMAIN' ),
        'params' => array(
						array(
							'type' => 'textfield',
							'heading' => __( 'Post ID', 'WEBNUS_TEXT_DOMAIN' ),
							'param_name' => 'post',
							'value'=>'',
							'description' => __( 'type your post id', 'WEBNUS_TEXT_DOMAIN')
						), 
					),    
		) );
?>