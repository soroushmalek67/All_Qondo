<?php

class WPBakeryShortCode_testimonial_slider extends WPBakeryShortCodesContainer {

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
		"type" => '',		
		), $atts));


		$out = '<div class="testimonials-slider-w flexslider ts-'.$type.'">';
		$out .= '<ul class="slides">';
		$out .= do_shortcode( $content );
		$out .= '</ul></div>';
	
	return $out;
}

}




vc_map( array(
    "name" => "Webnus Testimonial Slider",
    "base" => "testimonial_slider",
    "category" => __( 'Webnus Shortcodes', 'WEBNUS_TEXT_DOMAIN' ),
    "icon" => "webnus_testimonialslider",
    "as_parent" => array('only' => 'testimonial_item'), // Use only|except attributes to limit child shortcodes (separate multiple values with comma)
    "content_element" => true,
    
    "params" => array(
        // add params same as with any other content element
		 array(
			"type" => "dropdown",
			"heading" => __( "Type", 'WEBNUS_TEXT_DOMAIN' ),
			"param_name" => "type",
			"value" => array(
				"Mono"=>"mono",
				"Di"=>"di",
				"Tri"=>"tri",
                "Tetra"=>"tetra",       
				"Penta"=>"penta",		
			),
			"description" => __( "Select Image", 'WEBNUS_TEXT_DOMAIN')
		), 
    ),
    "js_view" => 'VcColumnView'
) );




?>