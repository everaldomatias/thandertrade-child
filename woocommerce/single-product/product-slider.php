<?php
/**
 * Single Product Slider
 *
 * @author 		AGP Agência
 * @package 	WooCommerce/Templates
 * @version     1.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

global $post, $product, $woocommerce;

$attachment_ids = $product->get_gallery_image_ids();
?>
<?php if ( $attachment_ids ): ?>
	<div id="single-slider" class="slider single">
	    	<?php 
				foreach ( $attachment_ids as $attachment_id ){
					$thumb_url = wp_get_attachment_image_src( $attachment_id,'square-thumbnail', true );

					echo '<img src='. $thumb_url[0].' />';
				}
			?>
	</div><!-- .flexslider -->
<?php else : ?>
	<div class="thumb">
		<?php the_post_thumbnail( 'square-thumbnail' ); ?>
	</div>
<?php endif ?>