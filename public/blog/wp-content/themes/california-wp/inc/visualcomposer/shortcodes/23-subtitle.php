<?php

vc_map( array(
        "name" =>"Webnus SubTitle",
        "base" => "subtitle",
		"description" => "SubTitle",
        "category" => __( 'Webnus Shortcodes', 'WEBNUS_TEXT_DOMAIN' ),
        "icon" => "webnus_subtitle1",
        "params" => array(
						array(
							"type" => "dropdown",
							"heading" => __( "Type", 'WEBNUS_TEXT_DOMAIN' ),
							"param_name" => "type",
							"value" => array(
								"Subtitle 1"=>"1",
								"Subtitle 2"=>"2",
								"Subtitle 3"=>"3",									
								"Subtitle 4"=>"4",
								"Subtitle 5"=>"5",
							),
						"description" => __( "Title Type", 'WEBNUS_TEXT_DOMAIN')
						),
						array(
							"type" => "textarea",
							"heading" => __( "Title", 'WEBNUS_TEXT_DOMAIN' ),
							"param_name" => "content",
							"value" => array('Title'),
							"description" => __( "Enter the title", 'WEBNUS_TEXT_DOMAIN')
						),
						
           
        ),
		
        
    ) );


?>