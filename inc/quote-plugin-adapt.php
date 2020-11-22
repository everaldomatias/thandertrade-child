<?php 

	add_action( 'wp_enqueue_scripts', 'deregister_plugin_js' );
	function deregister_plugin_js(){
			wp_deregister_script( 'yith_ywraq_frontend' );
			wp_enqueue_script( 'yith_ywraq_frontend', get_stylesheet_directory_uri().'/assets/js/yith-woocommerce-request-a-quote-frontend-adapt.js',  array( 'jquery' ), '1.0', true );
			 $localize_script_args = array(
                'ajaxurl'            => admin_url( 'admin-ajax.php' ),
                'no_product_in_list' => __( 'Sua lista de Orçamentos está vazia no momento!', 'yith-woocommerce-request-a-quote' )
            );
            wp_localize_script( 'yith_ywraq_frontend', 'ywraq_frontend', $localize_script_args );
	}

?>