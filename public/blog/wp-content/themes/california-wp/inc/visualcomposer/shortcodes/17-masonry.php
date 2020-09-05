<?php

vc_map( array(
        'name' =>'Webnus Masonry',
        'base' => 'masonry',
		"description" => "Blog Masonry",
        'category' => __( 'Webnus Shortcodes', 'WEBNUS_TEXT_DOMAIN' ),
        "icon" => "webnus_masonry",
		'params'=>array(
				array(
					'type' => 'dropdown',
					'heading' => __( 'Category', 'WEBNUS_TEXT_DOMAIN' ),
					'param_name' => 'category',
					'value'=>$category_slug_array,
					'description' => __( 'Select specific category, leave blank to show all categories.', 'WEBNUS_TEXT_DOMAIN')
				),
				array(
					'type' => 'textfield',
					'heading' => __( 'Post Count', 'WEBNUS_TEXT_DOMAIN' ),
					'param_name' => 'count',
					'value' => '',
					'description' => __( 'Number of post(s) to show', 'WEBNUS_TEXT_DOMAIN')
					),
					
		)
        
    ) );


?>