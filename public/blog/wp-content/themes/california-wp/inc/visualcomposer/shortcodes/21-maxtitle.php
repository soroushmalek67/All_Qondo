<?php

vc_map( array(
        "name" =>"Webnus MaxTitle",
        "base" => "maxtitle",
		"description" => "MaxTitle",
        "category" => __( 'Webnus Shortcodes', 'WEBNUS_TEXT_DOMAIN' ),
        "icon" => "icon-wpb-maxtitle",
        "params" => array(
						array(
							"type" => "dropdown",
							"heading" => __( "Type", 'WEBNUS_TEXT_DOMAIN' ),
							"param_name" => "type",
							"value" => array(
								"Maxtitle 1"=>"1",
								"Maxtitle 2"=>"2",
								"Maxtitle 3"=>"3",
								"Maxtitle 4"=>"4",
								"Maxtitle 5"=>"5",
								"Maxtitle 6"=>"6",
								"Maxtitle 7"=>"7",
								
						),
						"description" => __( "Title Type", 'WEBNUS_TEXT_DOMAIN')
						),
						array(
							"type" => "dropdown",
							"heading" => __( "Heading", 'WEBNUS_TEXT_DOMAIN' ),
							"param_name" => "heading",
							"value" => array(
								"h1"=>"1",
								"h2"=>"2",
								"h3"=>"3",
								"h4"=>"4",
								"h5"=>"5",
								"h6"=>"6",			
						),
						'std' => '2',
						"description" => __( "Just for SEO", 'WEBNUS_TEXT_DOMAIN')
						),
						array(
							"type" => "textfield",
							"heading" => __( "Title", 'WEBNUS_TEXT_DOMAIN' ),
							"param_name" => "content",
							"value" => array('Title'),
							"description" => __( "Enter the title", 'WEBNUS_TEXT_DOMAIN')
						),
						
           
        ),
		
        
    ) );


?>