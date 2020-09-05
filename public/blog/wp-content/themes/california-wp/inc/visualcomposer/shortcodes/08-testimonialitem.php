<?php

class WPBakeryShortCode_testimonial_item extends WPBakeryShortCode {

    /*
     * Thi methods returns HTML code for frontend representation of your shortcode.
     * You can use your own html markup.
     *
     * @param $atts - shortcode attributes
     * @param @content - shortcode content
     *
     * @access protected
     *
     * @return string
     */

    protected function content($atts, $content = null) {

		extract(shortcode_atts(array(
	 	
		'img'=>'',
		'name'=>'',
		'subtitle' => '',
		'first_social'=>'twitter',
		'first_url'=>'',
		'second_social'=>'facebook',
		'second_url'=>'',
		'third_social'=>'google-plus',
		'third_url'=>'',
		'fourth_social'=>'linkedin',
		'fourth_url'=>''
		), $atts));
		

		if(is_numeric($img)){ $img = wp_get_attachment_url( $img ); }
			
		$out = "<li>";
		$out .= "<div class=\"testimonial\">";		  
		$out .= "<div class=\"testimonial-content\">";		 
		$out .= "<h4><q>".$content."</q></h4>";			
		$out .= "<div class=\"testimonial-arrow\"></div>";			  
		$out .= "</div>";			  
		$out .= "<div class=\"testimonial-brand\">";
		if(!empty($img)) $out .= "<img src=\"".$img."\" alt=\"".$name."\">";		
		$out .= "<h5><strong>".$name."</strong><br>";			
		$out .= "<em>".$subtitle."</em></h5>";			  
		
		if ( $first_url || $second_url ||  $third_url || $fourth_url ) :
		$out .= "<div class=\"social-testimonial\"><ul>";
			if(!empty($first_url))
				$out .= '<li class="first-social"><a href="'. $first_url .'"><i class="fa-'. $first_social .'"></i></a></li>';
			if(!empty($second_url))
				$out .= '<li class="second-social"><a href="'. $second_url .'"><i class="fa-'. $second_social .'"></i></a></li>';
			if(!empty($third_url))
				$out .= '<li class="third-social"><a href="'. $third_url .'"><i class="fa-'. $third_social .'"></i></a></li>';
			if(!empty($fourth_url))
				$out .= '<li class="fourth-social"><a href="'. $fourth_url .'"><i class="fa-'. $fourth_social .'"></i></a></li>';
		$out .= "</ul></div>";
		endif;

		$out .= "</div>";
		$out .= "</div>";
		$out .= "</li>";	
		
	return $out;
}

}
vc_map( array(
        "name" =>"Webnus Testimonial Item",
        "base" => "testimonial_item",
		"description" => "Testimonials slider",
        "category" => __( 'Webnus Shortcodes', 'WEBNUS_TEXT_DOMAIN' ),
        "icon" => "webnus_testimonialitem",
        "content_element" => true,
   		"as_child" => array('only' => 'testimonial_slider'), // Use only|except 
        'params'=>array(
							
					array(
							'type' => 'textfield',
							'heading' => __( 'Name', 'WEBNUS_TEXT_DOMAIN' ),
							'param_name' => 'name',
							'value'=>'Name',
							'description' => __( 'Enter the Testimonial Name', 'WEBNUS_TEXT_DOMAIN')
					),
					array(
							'type' => 'attach_image',
							'heading' => __( 'Image', 'WEBNUS_TEXT_DOMAIN' ),
							'param_name' => 'img',
							'value'=>'http://',
							'description' => __( 'Testimonial Image', 'WEBNUS_TEXT_DOMAIN')
					),
					array(
							'type' => 'textfield',
							'heading' => __( 'Subtitle', 'WEBNUS_TEXT_DOMAIN' ),
							'param_name' => 'subtitle',
							'value'=>'',
							'description' => __( 'Testimonial Subtitle', 'WEBNUS_TEXT_DOMAIN')
					),
					array(
							'type' => 'textarea',
							'heading' => __( 'Content', 'WEBNUS_TEXT_DOMAIN' ),
							'param_name' => 'content',
							'value' => '',
							'description' => __( 'Enter the Testimonial content text', 'WEBNUS_TEXT_DOMAIN')
					),

					array(
							'type' => 'dropdown',
							'heading' => __( 'First Social Name', 'WEBNUS_TEXT_DOMAIN' ),
							'param_name' => 'first_social',
							 'value' => array(
								"Twitter"=>'twitter',
								"Facebook"=>'facebook',
								"Google Plus"=>'google-plus',
								"Vimeo"=>'vimeo',
								"Dribbble"=>'dribbble',
								"Youtube"=>'youtube',
								"Youtube"=>'youtube',
								"Pinterest"=>'pinterest',
								"LinkedIn"=>'linkedin',
								"Instagram"=>'instagram',
									),
								'std' => 'twitter',
							'description' => __( 'Select Social Name', 'WEBNUS_TEXT_DOMAIN'),
					),

					array(
							'type' => 'textfield',
							'heading' => __( 'First Social URL', 'WEBNUS_TEXT_DOMAIN' ),
							'param_name' => 'first_url',
							'value'=>'',
							'description' => __( 'First social URL', 'WEBNUS_TEXT_DOMAIN'),
					),

					array(
							'type' => 'dropdown',
							'heading' => __( 'Second Social Name', 'WEBNUS_TEXT_DOMAIN' ),
							'param_name' => 'second_social',
							 'value' => array(
								"Twitter"=>'twitter',
								"Facebook"=>'facebook',
								"Google Plus"=>'google-plus',
								"Vimeo"=>'vimeo',
								"Dribbble"=>'dribbble',
								"Youtube"=>'youtube',
								"Youtube"=>'youtube',
								"Pinterest"=>'pinterest',
								"LinkedIn"=>'linkedin',
								"Instagram"=>'instagram',
									),
								'std' => 'facebook',

							'description' => __( 'Select Social Name', 'WEBNUS_TEXT_DOMAIN'),
					),

					array(
							'type' => 'textfield',
							'heading' => __( 'Second Social URL', 'WEBNUS_TEXT_DOMAIN' ),
							'param_name' => 'second_url',
							'value'=>'',
							'description' => __( 'Second social URL', 'WEBNUS_TEXT_DOMAIN'),
					),


					array(
							'type' => 'dropdown',
							'heading' => __( 'Third Social Name', 'WEBNUS_TEXT_DOMAIN' ),
							'param_name' => 'third_social',
							 'value' => array(
								"Twitter"=>'twitter',
								"Facebook"=>'facebook',
								"Google Plus"=>'google-plus',
								"Vimeo"=>'vimeo',
								"Dribbble"=>'dribbble',
								"Youtube"=>'youtube',
								"Youtube"=>'youtube',
								"Pinterest"=>'pinterest',
								"LinkedIn"=>'linkedin',
								"Instagram"=>'instagram',
									),
								'std' => 'Google Plus',
							'description' => __( 'Select Social Name', 'WEBNUS_TEXT_DOMAIN'),
					),

					array(
							'type' => 'textfield',
							'heading' => __( 'Third Social URL', 'WEBNUS_TEXT_DOMAIN' ),
							'param_name' => 'third_url',
							'value'=>'',
							'description' => __( 'Third social URL', 'WEBNUS_TEXT_DOMAIN'),
					),

					array(
							'type' => 'dropdown',
							'heading' => __( 'Fourth Social Name', 'WEBNUS_TEXT_DOMAIN' ),
							'param_name' => 'fourth_social',
							 'value' => array(
								"Twitter"=>'twitter',
								"Facebook"=>'facebook',
								"Google Plus"=>'google-plus',
								"Vimeo"=>'vimeo',
								"Dribbble"=>'dribbble',
								"Youtube"=>'youtube',
								"Youtube"=>'youtube',
								"Pinterest"=>'pinterest',
								"LinkedIn"=>'linkedin',
								"Instagram"=>'instagram',
								),
								'std' => 'Google Plus',
							'description' => __( 'Select Social Name', 'WEBNUS_TEXT_DOMAIN'),
					),

					array(
							'type' => 'textfield',
							'heading' => __( 'Fourth Social URL', 'WEBNUS_TEXT_DOMAIN' ),
							'param_name' => 'fourth_url',
							'value'=>'',
							'description' => __( 'Fourth social URL', 'WEBNUS_TEXT_DOMAIN'),
					),

		),
		
        
    ) );


?>