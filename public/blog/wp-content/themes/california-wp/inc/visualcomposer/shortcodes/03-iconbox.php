<?php

vc_map( array(
        "name" =>"Webnus Iconbox",
        "base" => "iconbox",
        "description" => "Icon + text article",
		"icon" => "webnus_iconbox",
        "category" => __( 'Webnus Shortcodes', 'WEBNUS_TEXT_DOMAIN' ),
        "params" => array(
            array(
                "type" => "dropdown",
                "heading" => __( "Type", 'WEBNUS_TEXT_DOMAIN' ),
                "param_name" => "type",
                "value" => array(
				"Type 0"=>'0',
				"Type 1"=>'1',
				"Type 2"=>'2',
				"Type 3"=>'3',
				"Type 4"=>'4',
				"Type 5"=>'5',
				"Type 6"=>'6',
				"Type 7"=>'7',
				"Type 8"=>'8',
				"Type 9"=>'9',
				"Type 10"=>'10',
				"Type 11"=>'11',
				"Type 12"=>'12',
				"Type 13"=>'13',
				"Type 14"=>'14',
				"Type 15"=>'15',
				"Type 16"=>'16',
				"Type 17"=>'17',
				"Type 18"=>'18',
				"Type 19"=>'19',
				"Type 20"=>'20',
				"Type 21"=>'21',
				"Type 22"=>'22',
				"Type 23"=>'23',
				"Type 24"=>'24',
				"Type 25"=>'25',
				),
                "description" => __( "Select Iconbox Type", 'WEBNUS_TEXT_DOMAIN')
            ),
             array(
				"type"=>'textfield',
				"heading"=>__('Title', 'WEBNUS_TEXT_DOMAIN'),
				"param_name"=> "icon_title",
				"value"=>"",
				"description" => __( "IconBox Title", 'WEBNUS_TEXT_DOMAIN')
			),
			
			array(
				"type"=>'colorpicker',
				"heading"=>__('Title color (leave bank for default color)', 'WEBNUS_TEXT_DOMAIN'),
				"param_name"=> "title_color",
				"value"=>"",
				"description" => __( "Select title color", 'WEBNUS_TEXT_DOMAIN')
			),
			
            array(
				"type"=>'textarea',
				"heading"=>__('Content', 'WEBNUS_TEXT_DOMAIN'),
				"param_name"=> "content",
				"value"=>"",
				"description" => __( "IconBox Content Goes Here", 'WEBNUS_TEXT_DOMAIN')	
			),

			array(
				"type"=>'colorpicker',
				"heading"=>__('Content color (leave bank for default color)', 'WEBNUS_TEXT_DOMAIN'),
				"param_name"=> "content_color",
				"value"=>"",
				"description" => __( "Select content color", 'WEBNUS_TEXT_DOMAIN')
			),
			
			
			 array(
				"type"=>'textfield',
				"heading"=>__('Link Text', 'WEBNUS_TEXT_DOMAIN'),
				"param_name"=> "icon_link_text",
				"value"=>"",
				"description" => __( "IconBox Link Text", 'WEBNUS_TEXT_DOMAIN'),	
			),


			 array(
				"type"=>'textfield',
				"heading"=>__('Link URL', 'WEBNUS_TEXT_DOMAIN'),
				"param_name"=> "icon_link_url",
				"value"=>"",
				"description" => __( "IconBox Link URL (http://example.com)", 'WEBNUS_TEXT_DOMAIN'),	
			),

			array(
				"type"=>'colorpicker',
				"heading"=>__('Link color (leave bank for default color)', 'WEBNUS_TEXT_DOMAIN'),
				"param_name"=> "link_color",
				"value"=>"",
				"description" => __( "Select link color", 'WEBNUS_TEXT_DOMAIN')
			),
			
            array(
				"type"=>'textfield',
				"heading"=>__('Icon Size (leave blank for default size)', 'WEBNUS_TEXT_DOMAIN'),
				"param_name"=> "icon_size",
				"value"=>"",
				"description" => __( "Icon size in px format, Example: 16px", 'WEBNUS_TEXT_DOMAIN')
				
			),
			array(
				"type"=>'colorpicker',
				"heading"=>__('Icon color (leave bank for default color)', 'WEBNUS_TEXT_DOMAIN'),
				"param_name"=> "icon_color",
				"value"=>"",
				"description" => __( "Select icon color", 'WEBNUS_TEXT_DOMAIN')
				
			),

            array(
                "type" => "attach_image",
                "heading" => __( "Image", 'WEBNUS_TEXT_DOMAIN' ),
                "param_name" => "icon_image",
                'value'=>'',
                "description" => __( "Select Image instead of Icon", 'WEBNUS_TEXT_DOMAIN')
            ),
			
            array(
                "type" => "iconfonts",
                "heading" => __( "Icon", 'WEBNUS_TEXT_DOMAIN' ),
                "param_name" => "icon_name",
                'value'=>'',
                "description" => __( "Select Icon", 'WEBNUS_TEXT_DOMAIN')
            ),
           
        ),
		
        
    ) );


?>