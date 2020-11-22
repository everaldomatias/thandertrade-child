<?php
/**
 * The template for displaying product content in the single-product.php template
 *
 * Override this template by copying it to yourtheme/woocommerce/content-single-product.php
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     1.6.4
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}
?>
<?php
	/**
	 * woocommerce_before_single_product hook
	 *
	 * @hooked wc_print_notices - 10
	 */
	 do_action( 'woocommerce_before_single_product' );
	 if ( post_password_required() ) {
	 	echo get_the_password_form();
	 	return;
	 }
?>
<div itemscope itemtype="<?php echo woocommerce_get_product_schema(); ?>" id="product-<?php the_ID(); ?>" <?php post_class(); ?>>
		<div class="summary">
			<?php
				do_action( 'woocommerce_before_single_product_summary' );
				do_action( 'woocommerce_single_product_summary' );
			?>
		</div><!-- .summary -->
	<?php
		/**
		 * woocommerce_after_single_product_summary hook
		 *
		 * @hooked woocommerce_output_product_data_tabs - 10
		 * @hooked woocommerce_upsell_display - 15
		 * @hooked woocommerce_output_related_products - 20 (Removido)
		 */
		do_action( 'woocommerce_after_single_product_summary' );

		/**
		 * Product view counter
		 * @since 06/11/2019
		 */
		$id = get_the_ID();

		$old_count_view_IP = get_post_meta( $id, 'count_view_IP', true );
		$new_count_view_IP = $_SERVER['REMOTE_ADDR'];
		
		if ( empty( $old_count_view_IP ) || $old_count_view_IP != $new_count_view_IP ) {

			update_post_meta( $id, 'count_view_IP', $new_count_view_IP, $old_count_view_IP );

			$old_count_view = get_post_meta( $id, 'count_view', true );
			$new_count_view = intval( $old_count_view ) + 1;
			update_post_meta( $id, 'count_view', $new_count_view, $old_count_view );

		}

	?>
	<meta itemprop="url" content="<?php the_permalink(); ?>" />
</div><!-- #product-<?php the_ID(); ?> -->
<?php do_action( 'woocommerce_after_single_product' ); ?>
