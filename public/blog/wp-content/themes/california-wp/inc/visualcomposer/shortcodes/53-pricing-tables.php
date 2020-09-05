<?php

vc_map( array(
	'name' =>'Webnus Pricing Tables',
	'base' => 'pricing-tables',
	'description' => 'Pricing Tables',
	'icon' => 'webnus_pricingtable',
	'category' => __( 'Webnus Shortcodes', 'WEBNUS_TEXT_DOMAIN' ),       
	'params'=>array(

		array(
			'type' => 'textfield',
			'heading' => __( 'Title', 'WEBNUS_TEXT_DOMAIN' ),
			'param_name' => 'title',
			'value' => '',
			'description' => __( 'Pricing Table Title', 'WEBNUS_TEXT_DOMAIN'),
		),

		array(
			'type' => 'textfield',
			'heading' => __( 'Price', 'WEBNUS_TEXT_DOMAIN' ),
			'param_name' => 'price',
			'value' => '$10',
			'description' => __( 'Pricing Table Price', 'WEBNUS_TEXT_DOMAIN'),
		),

		array(
			'type' => 'textfield',
			'heading' => __( 'Period', 'WEBNUS_TEXT_DOMAIN' ),
			'param_name' => 'period',
			'value' => 'Month',
			'description' => __( 'Pricing Table Period', 'WEBNUS_TEXT_DOMAIN'),
		),

		array(
			"type"=>'textfield',
			"heading"=>__('Link Text', 'WEBNUS_TEXT_DOMAIN'),
			"param_name"=> "link_text",
			"value"=>"",
			"description" => __( "Link Text", 'WEBNUS_TEXT_DOMAIN'),	
		),

		array(
			"type"=>'textfield',
			"heading"=>__('Link URL', 'WEBNUS_TEXT_DOMAIN'),
			"param_name"=> "link_url",
			"value"=>"",
			"description" => __( "Link URL (http://example.com)", 'WEBNUS_TEXT_DOMAIN'),	
		),

		array(
			'type' => 'checkbox',
			'heading' => __( 'Featured Plan', 'WEBNUS_TEXT_DOMAIN' ),
			'param_name' => 'featured',
			'value' => array( __( 'Yes', 'js_composer' ) => ' w-featured' ),
			'description' => __( 'Pricing Tables Featured Plan', 'WEBNUS_TEXT_DOMAIN'),
		),

		array(
			'type' => 'textfield',
			'heading' => __( 'Row 1', 'WEBNUS_TEXT_DOMAIN' ),
			'param_name' => 'row1',
			'value' => '',
			'description' => __( 'Pricing Tables Row 1', 'WEBNUS_TEXT_DOMAIN'),
		),

		array(
			'type' => 'textfield',
			'heading' => __( 'Row 2', 'WEBNUS_TEXT_DOMAIN' ),
			'param_name' => 'row2',
			'value' => '',
			'description' => __( 'Pricing Tables Row 2', 'WEBNUS_TEXT_DOMAIN'),
		),

		array(
			'type' => 'textfield',
			'heading' => __( 'Row 3', 'WEBNUS_TEXT_DOMAIN' ),
			'param_name' => 'row3',
			'value' => '',
			'description' => __( 'Pricing Tables Row 3', 'WEBNUS_TEXT_DOMAIN'),
		),

		array(
			'type' => 'textfield',
			'heading' => __( 'Row 4', 'WEBNUS_TEXT_DOMAIN' ),
			'param_name' => 'row4',
			'value' => '',
			'description' => __( 'Pricing Tables Row 4', 'WEBNUS_TEXT_DOMAIN'),
		),

		array(
			'type' => 'textfield',
			'heading' => __( 'Row 5', 'WEBNUS_TEXT_DOMAIN' ),
			'param_name' => 'row5',
			'value' => '',
			'description' => __( 'Pricing Tables Row 5', 'WEBNUS_TEXT_DOMAIN'),
		),

		array(
			'type' => 'textfield',
			'heading' => __( 'Row 6', 'WEBNUS_TEXT_DOMAIN' ),
			'param_name' => 'row6',
			'value' => '',
			'description' => __( 'Pricing Tables Row 6', 'WEBNUS_TEXT_DOMAIN'),
		),

		array(
			'type' => 'textfield',
			'heading' => __( 'Row 7', 'WEBNUS_TEXT_DOMAIN' ),
			'param_name' => 'row7',
			'value' => '',
			'description' => __( 'Pricing Tables Row 7', 'WEBNUS_TEXT_DOMAIN'),
		),

)));
?>