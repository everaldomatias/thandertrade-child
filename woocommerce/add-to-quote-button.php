<?php
/**
 * Add to Quote button template
 *
 * @package YITH Woocommerce Request A Quote
 * @since   1.0.0
 * @author  Yithemess
 */
global $product;
?>

<input type="number" name="quantity" min="1" max="<?php echo esc_attr( $product->get_stock_quantity() );?>" id="woocommerce-qty-number" value="1">
<a href="#" class="<?php echo $class ?>" data-product_id="<?php echo $product_id ?>" data-wp_nonce="<?php echo $wpnonce ?>">
	<?php echo $label ?>
</a>
<img src="<?php echo esc_url( YITH_YWRAQ_ASSETS_URL.'/images/wpspin_light.gif' ) ?>" class="ajax-loading" alt="loading" width="16" height="16" style="visibility:hidden" />