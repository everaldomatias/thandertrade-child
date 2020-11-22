<?php
/*
* ARQUIVO PRINCIPAL DO MÓDULO DE SLIDER.
* BASEADO NO FLEXSLIDER (http://flexslider.woothemes.com/)
* O SLIDER É CHAMADO PELA FUNÇÃO JS NO ARQUIVO FOOTER.PHP, LINHA 22.
*/

// REQUIRE FILES
require_once('functions-slider.php'); // FUNCTIONS
require_once('cpt-slider.php'); // CUSTOM POST TYPE
require_once('acf-slider.php'); // ADVANCED CUSTOM FIELDS

// ENQUEUE SCRIPT
function flexslider_scripts()
{	
	$template_url = get_template_directory_uri();
	if ( file_exists( get_stylesheet_directory() . '/inc/modulos/slider' ) ) {
		$template_url = get_stylesheet_directory_uri();
	}
	$template_url = apply_filters( 'agp_slider_template_url', $template_url );
    wp_enqueue_style( 'style-slider', $template_url . '/inc/modulos/slider/assets/css/slider-style.css' );
    wp_register_script( 'flexslider-jquery', $template_url . '/inc/modulos/slider/jquery.flexslider.js', array( 'jquery' ) );
    wp_register_script( 'custom-flexslider', $template_url . '/inc/modulos/slider/custom-flexslider.js', array( 'jquery') );
    if( is_front_page() || defined( 'LOAD_AGP_SLIDER' ) ) {
		wp_enqueue_script( 'flexslider-jquery' );
		wp_enqueue_script( 'custom-flexslider' );
	}
}
add_action( 'wp_enqueue_scripts', 'flexslider_scripts' );
