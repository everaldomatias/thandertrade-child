<?php
/**
 * HTML Template Email
 *
 * @package YITH Woocommerce Request A Quote
 * @version 1.0.0
 * @since   1.0.0
 * @author  AGP Agência
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

echo $email_heading . "\n\n";

echo sprintf( __( 'You have received a quote request from %s. The request is the following:', 'ywraq' ), $raq_data['user_name'] ) . "\n\n";

echo "****************************************************\n\n";

do_action( 'yith_ywraq_email_before_raq_table', $raq_data );

echo "\n";

if( ! empty( $raq_data['raq_content'] ) ):
    foreach( $raq_data['raq_content'] as $item ):

        if( isset( $item['variation_id']) ){
            $product = wc_get_product( $item['variation_id'] );
        }else{
            $product = wc_get_product( $item['product_id'] );
        }

        echo $product->post->post_title . ' '. yith_ywraq_get_product_meta($item, false) . ' | ';
        echo $item['quantity'];
        echo ' '.WC()->cart->get_product_subtotal( $product, $item['quantity'] );
        echo "\n";
    endforeach;
endif;

echo "\n****************************************************\n\n";

do_action( 'yith_ywraq_email_after_raq_table', $raq_data );

if( ! empty( $raq_data['user_message']) ){

    echo __( 'Customer message', 'ywraq' ) . "\n";

    echo $raq_data['user_message']. "\n\n";
}

echo __( 'Customer details', 'ywraq' ) . "\n";

echo __( 'Name:', 'ywraq' ); echo $raq_data['user_name'] . "\n";
echo __( 'Razão Social:', 'ywraq' ); echo $raq_data['rqa_social'] . "\n";
echo __( 'Email:', 'ywraq' ); echo $raq_data['user_email'] . "\n";
echo __( 'Telefone:', 'ywraq' ); echo $raq_data['rqa_phone'] . "\n";

echo "\n****************************************************\n\n";

echo apply_filters( 'woocommerce_email_footer_text', get_option( 'woocommerce_email_footer_text' ) );