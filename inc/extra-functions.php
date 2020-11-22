<?php

/**
 * 
 * Remove default CSS printed by admin bar
 * 
 * @author 		Everaldo Matias <http://everaldomatias.github.io>
 * @version 	0.1
 * @since 		22/01/2019
 * @return 		void
 *
 */

add_action( 'get_header', 'remove_css_from_admin_bar' );

if ( ! function_exists( 'remove_css_from_admin_bar' ) ) {
	function remove_css_from_admin_bar() {
		remove_action( 'wp_head', '_admin_bar_bump_cb' );
	}
}

/**
 * 
 * Create breadcrumb menu
 * 
 * @author 		Everaldo Matias <http://everaldomatias.github.io>
 * @version 	0.1
 * @since 		21/01/2019
 * @return 		html
 * 
 */

if ( ! function_exists( 'the_breadcrumb' ) ) {

	function the_breadcrumb( string $sep = ' > ' ) {

		global $wp_query;

	    if ( ! is_front_page() ) {
		
			// Start the breadcrumb with a link to your homepage
	        echo '<div class="breadcrumbs">';
	       
	        echo '<a href="' . get_option( 'home' ) . '">';
				bloginfo( 'name' ); 
	        echo '</a>' . $sep;
		
			// Check if the current page is a category, an archive or a single page. If so show the category or archive name.
	        if ( is_category() || is_singular( array( 'page', 'attachment', 'post' ) ) ) {

	            the_category( 'title_li=' );

	        } elseif ( is_post_type_archive() ) {

				echo '<span class="-current-page">';
				post_type_archive_title();
				echo '</span>';

	        } elseif ( is_singular() && ! is_singular( array( 'page', 'attachment', 'post' ) ) ) {
	        	
	        	global $post;

	        	// Get post type
	        	$get_post_type_slug = get_post_type();
	        	$get_post_type = get_post_type_object( $get_post_type_slug );
	        	$get_post_type_name = esc_attr( $get_post_type->labels->name );

	        	echo '<a href="' . get_post_type_archive_link( $get_post_type_slug ) . '">' . esc_attr( $get_post_type_name ) . '</a>';

	        } elseif ( is_archive() || is_single() ) {

	            if ( is_day() ) {

	                printf( __( '%s', 'odin' ), get_the_date() );

	            } elseif ( is_month() ) {

	                printf( __( '%s', 'odin' ), get_the_date( _x( 'F Y', 'monthly archives date format', 'odin' ) ) );

	            } elseif ( is_year() ) {

	                printf( __( '%s', 'odin' ), get_the_date( _x( 'Y', 'yearly archives date format', 'odin' ) ) );

	            } elseif ( is_tax() ) {

	            	global $post;
	            	
					// Get post type
	            	$get_post_type_slug = get_post_type();
		        	$get_post_type = get_post_type_object( $get_post_type_slug );
		        	$get_post_type_name = esc_attr( $get_post_type->labels->name );

					// Get taxonomy and term
					$get_term = get_term_by( 'slug', get_query_var( 'term' ), get_query_var( 'taxonomy' ) );
	            	$get_taxonomy = get_taxonomy( $get_term->taxonomy );
	            	$get_taxonomy_name = esc_attr( $get_taxonomy->labels->singular_name );

	            	echo '<a href="' . get_post_type_archive_link( $get_post_type_slug ) . '">' . esc_attr( $get_post_type_name ) . '</a>';
					echo $sep . $get_taxonomy_name . $sep;
					echo '<span class="-current-page">';
					echo $get_term->name;
					echo '</span>'; 

	            } elseif ( $wp_query->query_vars['produtos'] == 'ambientes' ) {

	            	echo '<span class="-current-page">';
	            	_e( 'Ambientes', 'odin' );
	            	echo '</span>';

	            } else {

	                _e( 'Blog Archives', 'odin' );

	            }
	        }
		
			// If the current page is a single post, show its title with the separator
	        if ( is_single() ) {
				echo $sep;
				echo '<span class="-current-page">';
				the_title();
				echo '</span>';
	        }
		
			// If the current page is a static page, show its title.
	        if ( is_page() ) {
	            echo '<span class="-current-page">';
				the_title();
				echo '</span>';
	        }
		
			// if you have a static page assigned to be you posts list page. It will find the title of the static page and display it. i.e Home >> Blog
	        if ( is_home() ){

	            global $post;
	            $page_for_posts_id = get_option( 'page_for_posts' );
	            
	            if ( $page_for_posts_id ) { 
	                $post = get_page( $page_for_posts_id );
	                setup_postdata( $post );
	                echo '<span class="-current-page">';
					the_title();
					echo '</span>';
	                rewind_posts();
	            }

	        }

	        echo '</div><!-- /.breadcrumbs -->';

	    }
	}

}

/**
 * 
 * Print custom date on credits footer
 * 
 * @author 		Everaldo Matias <http://everaldomatias.gitlab.io>
 * @version 	0.1
 * @since 		08/02/2019
 * @return 		string
 * @param 		string $date_create_site date of creation site
 * 
 */

if ( ! function_exists( 'agp_footer_date' ) ) {
	function agp_footer_date( $date_create_site ) {
		$date = date( 'Y' );
		if ( $date > esc_attr( $date_create_site ) ) {
			return $date_create_site . ' ~ ' . $date;
		} else {
			return $date;
		}
	}
}

if ( ! function_exists( 'agp_debug_hooks' ) ) {

	function agp_debug_hooks( $hook ) {
		global $wp_filter;
		echo '<pre>';
		var_dump( $wp_filter[ $hook ] );
		echo '</pre>';
	}

}


/**
 * 
 * Debug all registered image sizes
 * 
 * @author 		Everaldo Matias <http://everaldo.dev>
 * @version 	0.1
 * @since 		19/03/2019
 * @global 		array $_wp_additional_image_sizes
 * @return 		void
 * @param 		string $date_create_site date of creation site
 * 
 */
function agp_get_all_image_sizes() {
	global $_wp_additional_image_sizes;
	$image_sizes = array();
	$default_image_sizes = array( 'thumbnail', 'medium', 'large' );
	 
	foreach ( $default_image_sizes as $size ) {
		$image_sizes[$size]['width']	= intval( get_option( "{$size}_size_w") );
		$image_sizes[$size]['height']	= intval( get_option( "{$size}_size_h") );
		$image_sizes[$size]['crop']		= get_option( "{$size}_crop" ) ? get_option( "{$size}_crop" ) : false;
	}
	
	if ( isset( $_wp_additional_image_sizes ) && count( $_wp_additional_image_sizes ) )
		$image_sizes = array_merge( $image_sizes, $_wp_additional_image_sizes );
		
	echo "<pre>";
	var_dump( $image_sizes );
	echo "</pre>";
}

function agp_add_button_product() {
	echo '<span class="button-product">Mais Informações</span>';
}

add_action( 'woocommerce_after_shop_loop_item_title', 'agp_add_button_product', 10 );

