<?php
/**
 * Loop do Slider.
 *
 * @since 1.0.0
 */
function loop_slider( $args = array() ) {

	// If $args empty, set default values for Query
	if ( empty( $args ) ) {
		$args = array(
	    	'post_type' => 'slider',
	    	'order' => 'ASC',
	    	'orderby' => 'menu_order',
	    	'posts_per_page' => 5
		);
	} else {
		// Force the CPT for Query
		$args[ "post_type" ] = 'slider';
	}

	$sliders = new WP_Query( $args );
	if ( $sliders->have_posts() ) :	?>
		<section id="main-slider" class="flexslider">
	        <ul class="slides">
	            <?php while ( $sliders->have_posts() ) : $sliders->the_post(); ?>
	            <?php $is_video = get_post_meta( get_the_ID(), 'is_video', true );?>
	            <?php
	            if ( has_post_thumbnail() && $is_video != 1 ) :
	                $thumb_id = get_post_thumbnail_id();
	                $thumb_url = wp_get_attachment_image_src( $thumb_id, 'full', true );
	            endif;
	            ?>
	            <li class="each">

	            	<?php if( $link = get_field('sl-bn-link') ): ?>

		            	<?php if( get_field( 'sl_target' ) == 1 ) {
	                		$target = '_blank';
	                	} else {
	                		$target = '_self';
	                	} ?>

		            	<a href="<?php echo esc_url( $link ); ?>" target="<?php echo $target; ?>">
		                	<figure>
			                    <?php if( $bn_desc = get_field( 'sl-bn-desc' ) ): ?>
			                    	<?php if ( $is_video == 1 ) : ?>
			                    		<?php echo get_post_meta( get_the_ID(), 'embed_code', true );?>
				                    <?php else : ?>
				                    	<img src="<?php echo esc_url( $thumb_url[0] ); ?>" alt="<?php echo apply_filters( 'the_content', $bn_desc ); ?>">
				                	<?php endif;?>
				                    <figcaption>
				                    	<h2 class="cor-font"><?php echo apply_filters( 'the_content', $bn_desc ); ?></h2>
				                    </figcaption>

				                <?php else: ?>
			                    	<?php if ( $is_video == 1 ) : ?>
			                    		<?php echo get_post_meta( get_the_ID(), 'embed_code', true );?>
				                    <?php else : ?>
					                	<img src="<?php echo esc_url( $thumb_url[0] ); ?>" alt="<?php bloginfo( 'name' ); ?>">
				                	<?php endif;?>
								<?php endif; ?>
		                    </figure>
		                </a>

		            <?php else: ?>

	                	<figure>
		                    <?php if( $bn_desc = get_field( 'sl-bn-desc' ) ): ?>

			                    <?php if ( $is_video == 1 ) : ?>
			                    	<?php echo get_post_meta( get_the_ID(), 'embed_code', true );?>
				             	<?php else : ?>
				                   	<img src="<?php echo esc_url( $thumb_url[0] ); ?>" alt="<?php echo apply_filters( 'the_content', $bn_desc ); ?>">
				                <?php endif;?>
				                <figcaption>
				                   	<h2 class="cor-font"><?php echo apply_filters( 'the_content', $bn_desc ); ?></h2>
				                </figcaption>

			                <?php else: ?>

			                   	<?php if ( $is_video == 1 ) : ?>
			                    	<?php echo get_post_meta( get_the_ID(), 'embed_code', true );?>
				                <?php else : ?>
					                <img src="<?php echo esc_url( $thumb_url[0] ); ?>" alt="<?php bloginfo( 'name' ); ?>">
				                <?php endif;?>

							<?php endif; ?>
	                    </figure>

	            </li><!-- each -->
	            <?php endif; ?>
	            <?php endwhile; ?>
	            <?php wp_reset_postdata(); ?>
	        </ul><!-- .slides -->
	    </section><!-- .flexslider -->
    <?php
    	endif;
}
