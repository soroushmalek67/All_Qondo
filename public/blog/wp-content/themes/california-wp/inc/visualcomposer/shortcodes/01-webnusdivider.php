<?php

vc_map( array(
    "name" =>"Webnus Divider",
    "base" => "webnus-divider",
	"description" => "separator with title and icon",
	"icon" => "webnus_divider",
    "category" => __( 'Webnus Shortcodes', 'WEBNUS_TEXT_DOMAIN' ),
    "params" => array(
		   array(
				"type" => "dropdown",
				"heading" => __( "Type", 'WEBNUS_TEXT_DOMAIN' ),
				"param_name" => "type",
				"value" => array(
					"Type 1"=>"1", // Center + Icon
					"Type 2"=>"2", // Center + Icon
					"Type 3"=>"3", // Left
					"Type 4"=>"4", // Left
					"Type 5"=>"5", // Center + Icon
					"Type 6"=>"6", // Left + Icon + Desc
					"Type 7"=>"7", // Left
					"Type 8"=>"8", // Center + Icon + Desc
			),
			"description" => __( "Title Type", 'WEBNUS_TEXT_DOMAIN')
			),			
						
			array(
				'type' => 'textfield',
				'heading' => __( 'Title Part 1', 'WEBNUS_TEXT_DOMAIN' ),
				'param_name' => 'lspan',
				'value'=>'',
				'description' => __( 'Enter the first span text ', 'WEBNUS_TEXT_DOMAIN')
			),
			
			array(
				'type' => 'textfield',
				'heading' => __( 'Title Part 2', 'WEBNUS_TEXT_DOMAIN' ),
				'param_name' => 'rspan',
				'value'=>'',
				'description' => __( 'Enter the second span text', 'WEBNUS_TEXT_DOMAIN')
			),	

            array(
				"type"=>'textarea',
				"heading"=>__('Description', 'WEBNUS_TEXT_DOMAIN'),
				"param_name"=> "description",
				"value"=>"",
				"description" => __( "Enter the description text", 'WEBNUS_TEXT_DOMAIN'),
				"dependency" => array('element'=>'type','value'=>array('6','8')),
			),			
					
            array(
				"type"=>'colorpicker',
				"heading"=>__('Color', 'WEBNUS_TEXT_DOMAIN'),
				"param_name"=> "color",
				"value"=>"",
				"description" => __( "Select color for icon and second span", 'WEBNUS_TEXT_DOMAIN')
				
			),
			
            array(
                "type" => "iconfonts",
                "heading" => __( "Icon", 'WEBNUS_TEXT_DOMAIN' ),
                "param_name" => "icon",
                'value'=>'',
                "description" => __( "Select Icon", 'WEBNUS_TEXT_DOMAIN'),
				"dependency" => array('element'=>'type','value'=>array('1','2','5','6','8')),
            ),
           
        ),
		
        
    ) );


?>