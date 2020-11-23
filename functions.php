<?php
/**
 * Includes
 */

add_theme_support( 'wc-product-gallery-zoom' );
add_theme_support( 'wc-product-gallery-lightbox' );
add_theme_support( 'wc-product-gallery-slider' );
/**
 * Theme Dependences.
 */
require_once get_stylesheet_directory() . '/inc/dependences.php';
/**
 * Extra Functions.
 */
require_once get_stylesheet_directory() . '/inc/extra-functions.php';
/**
 * Custom Kirki.
 */
if ( class_exists( 'Kirki' ) ) {
	require_once get_stylesheet_directory() . '/inc/custom-kirki.php';	
}
/**
 * Hooks
 */
// Add font awesome */
function add_font_awesome() {
	echo '<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">';
}
add_action( 'wp_head', 'add_font_awesome' );
/**
 * Remove metaboxes
 */
add_action( 'add_meta_boxes', 'storefront_child_remove_metaboxes', 50 );
/**
 * General
 *
 * @see  storefront_child_removes()
 */
add_action( 'init', 'storefront_child_removes' );
/**
 * Header
 *
 * @see  storefront_child_custom_header()
 */
add_action( 'storefront_header', 'storefront_product_search', 30 );
add_action( 'storefront_header', 'storefront_child_custom_header', 40 );
add_action( 'storefront_header', 'storefront_product_search', 40 );
function storefront_child_custom_header() {
	echo '<div class="contacts">
		<div class="shipping">
			<i class=""><img src="'. get_stylesheet_directory_uri() .'/assets/images/delivery-purple.png" /></i>
			<span>Frete*<div>grátis</div></span>
		</div>
		<span class="telphone">
			<i class="fas fa-phone"></i>
			<div>Televendas (11) 4666-8797</div>
		</span>
 	</div>';
}
/**
 * CSS
 */
function odin_enqueue_scripts() {
	$template_url = get_stylesheet_directory_uri();
	// Loads child stylesheet.
	wp_enqueue_style( 'child-style', $template_url . '/assets/css/style.css', array(), null, 'all' );
	// Loads slick stylesheet from CDN
	wp_enqueue_style( 'slick', '//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css', array(), null, 'all' );
	// Loads slick js from CDN
	wp_enqueue_script( 'slick', '//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js', array( 'jquery' ), null, true );
	// Loads main js
	wp_enqueue_script( 'child-main', $template_url . '/assets/js/main.js', array(), null, true );
}
add_action( 'wp_enqueue_scripts', 'odin_enqueue_scripts', 1 );
function add_bootstrap() {
	echo '<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css" integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous">';
}
add_action( 'wp_footer', 'add_bootstrap' );
/**
 * Slider
 */
require_once get_stylesheet_directory() . '/inc/modulos/slider/mod-slider.php';
add_action( 'storefront_before_content', 'loop_slider', 10 );
/**
 * Clientes/Fornecedores
 */
require_once get_stylesheet_directory() . '/inc/modulos/clientes/mod-clientes.php';
/**
 * Functions
 */
function storefront_child_remove_product_tabs( $tabs ) {
    unset( $tabs['description'] );      		// Remove the description tab
    //unset( $tabs['reviews'] ); 					// Remove the reviews tab
    //unset( $tabs['additional_information'] );  	// Remove the additional information tab
    return $tabs;
}
function storefront_child_remove_metaboxes() {
	remove_meta_box( 'postexcerpt', 'product', 'normal' );
}
/**
 * Remove actions
 */
if ( ! function_exists( 'storefront_child_removes' ) ) {
	/**
	 * Remove functions and filters from hooks
	 * 
	 * @author 		Everaldo Matias <http://everaldomatias.github.io>
	 * @version 	0.2
	 * @since 		14/12/2018
	 * @see   		https://codex.wordpress.org/Function_Reference/remove_action
	 * @return 		void
	 * 
	 */
	function storefront_child_removes() {
		/**
		 * Remove default product search from header
		 */
		//remove_action( 'storefront_header', 'storefront_product_search', 40 );
		
		/**
		 * Remove default cart from menu
		 */
		remove_action( 'storefront_header', 'storefront_header_cart', 60 );
		/**
		 * Remove default content on home
		 */
		remove_action( 'homepage', 'storefront_homepage_content', 10 );
		/**
		 * Remove products by category on home
		 */
		remove_action( 'homepage', 'storefront_product_categories', 20 );
		/**
		 * Remove recents products on home
		 */
		remove_action( 'homepage', 'storefront_recent_products', 30 );
		/**
		 * Remove featured products on home
		 */
		remove_action( 'homepage', 'storefront_featured_products', 40 );
		/**
		 * Remove popular products on home
		 */
		remove_action( 'homepage', 'storefront_popular_products', 50 );
		/**
		 * Remove on sale products on home
		 */
		remove_action( 'homepage', 'storefront_on_sale_products', 60 );
		/**
		 * Remove on best selling products on home
		 */
		remove_action( 'homepage', 'storefront_best_selling_products', 70 );
		/**
		 * Remove footer itens
		 */
		remove_action( 'storefront_footer', 'storefront_footer_widgets', 10 );
		remove_action( 'storefront_footer', 'storefront_credit', 20 );
		/**
		 * Remove WooCommerce tabs
		 */
		add_filter( 'woocommerce_product_tabs', 'storefront_child_remove_product_tabs', 98 );
	}
}
/**
 * Home
 */
if ( ! function_exists( 'content_home_template' ) ) {
	/**	
	 * Include template home
	 */
	function content_home_template() {
		require_once get_stylesheet_directory() . '/woocommerce/content-home-template.php';
	}
	
	add_action( 'homepage', 'content_home_template', 10 );
}
/**
 * Add popular products on Home
 */
//add_action( 'homepage_popular_products', 'storefront_best_selling_products', 10 );
add_filter( 'storefront_best_selling_products_shortcode_args','custom_storefront_best_product_per_page' );
// Featured Featured Products per page
function custom_storefront_best_product_per_page( $args ) {
	$args['per_page'] = 8;
	return $args;
}
/**
 * Register menus
 */
function storefront_child_setup_features() {
	register_nav_menus(
		array(
			'sidebar-home-menu' => __( 'Sidebar Home Menu', 'storefront' ),
			'footer-menu' => __( 'Footer Menu', 'storefront' )
		)
	);
}
add_action( 'after_setup_theme', 'storefront_child_setup_features' );
if ( ! function_exists( 'content_home_template' ) ) {
	/**
	 * Add cart icon and count to header if Woo is active
	 * 
	 * @author 		Everaldo Matias <http://everaldomatias.github.io>
	 * @version 	0.1
	 * @since 		15/02/2019
	 * @return 		html
	 * 
	 */
	function storefront_child_woo_cart_count() {
	 
	    if ( in_array( 'woocommerce/woocommerce.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) ) ) {
	 
	        $count = WC()->cart->cart_contents_count; ?>
	        <a class="cart-contents" href="<?php echo WC()->cart->get_cart_url(); ?>" title="<?php _e( 'View your shopping cart' ); ?>">
	        	<?php if ( $count > 0 ) : ?>
	            	<span class="cart-contents-count"><?php echo esc_html( $count ); ?></span>
	            <?php endif; ?>
			</a>
			<?php
	    }
	 
	}
	add_action( 'storefront_header_cart', 'storefront_child_woo_cart_count' );
	
}
/**
 * Footer
 */
if ( ! function_exists( 'storefront_child_footer' ) ) {
	function storefront_child_footer() { ?>
		<div class="column-footer-first">
			<?php
			$image_footer = get_theme_mod( 'image_footer' );
			if ( $image_footer ) {
				echo '<img src="' . esc_url( $image_footer ) .'">';
			} else {
				echo '<img src="' . get_stylesheet_directory_uri() . '/assets/images/logo.png" alt="">';
			}
			?>
		</div><!-- /.column-footer-first -->
		<div class="column-footer-second">
			<nav class="footer-main-navigation nopadding" role="navigation">
                <?php
                    wp_nav_menu(
                        array(
                            'theme_location' => 'footer-menu',
                            'depth'          => 1,
                            'container'      => false
                        )
                    );
                ?>
            </nav><!-- .navbar-collapse -->
		</div><!-- /.column-footer-second -->
		<div class="column-footer-third">
			
			<?php
			
			/* Return custom infos */
			$telefone = get_theme_mod( 'telefone' );
			$telefone_mobile = get_theme_mod( 'telefone_mobile' );
			$email = get_theme_mod( 'email' );
			$endereco = get_theme_mod( 'endereco' );
			$replace_phone = ['(', ')',' ', '-', '/', '.', '_'];
			$cripto_email = antispambot( $email );
			if ( ! empty( $endereco ) ) {
				echo '<span class="endereco">' . esc_attr( $endereco ) . '</span> <i class="fas fa-map-marker-alt"></i><br />';
			}
			if ( ! empty( $telefone ) ) {
				echo '<span class="telefone"> <a href="tel:' . str_replace( $replace_phone, '', $telefone ) . '">' . esc_attr( $telefone ) . '</a></span> <i class="fas fa-phone"></i> <br />';
			}
			if ( ! empty( $telefone_mobile ) ) {
				echo '<span class="telefone-mobile"> <a href="tel:' . str_replace( $replace_phone, '', $telefone_mobile ) . '">' . esc_attr( $telefone_mobile ) . '</a></span> <i class="fas fa-phone"></i> <br />';
			}
			if ( ! empty( $email ) ) {
				echo '<span class="email"> <a href="mailto:' . esc_attr( $cripto_email ) . '">' . esc_attr( $cripto_email ) . '</a></span> <i class="fas fa-envelope"></i> <br />';
			}
			?>
		</div><!-- /.column-footer-third -->
	<?php }
	add_action( 'storefront_footer', 'storefront_child_footer', 10 );
}
if ( ! function_exists( 'storefront_child_credits' ) ) {
	function storefront_child_credits() {
		?>
		<div class="credits">
			<span class="date"><?php echo agp_footer_date( '2017' ); ?></span>
			<span class="site-name"><?php bloginfo( 'name' ); ?></span>
			<span class="copyright">Todos os Direitos Reservados.</span>
			<span class="agp">Desenvolvido por <a href="https://agpagencia.com.br">AGP Agência</a>.</span>
		</div><!-- /.credits -->
		<div class="-fullpage-loading">
			<img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/loading-icon.gif" alt="loading_thander_trade" />
		</div>
		<?php
	}
	add_action( 'storefront_after_footer', 'storefront_child_credits' );
}
include ('inc/quote-plugin-adapt.php');
// fomulário e mapa
/* Adiciona a quantidade de itens no orçamento, no menu */
function add_qtd_itens_menu() {
	$quote = YITH_Request_Quote()->get_raq_for_session();
	$total = 0;
	foreach ( $quote as $item ) {
		$qtd = $item['quantity'];
		$total = $total + $qtd;
	}
	if ( $total > 0 ) {
		return '<span class="qtd-items-quote">' . $total . '</span>';
	}
}
add_filter( 'wp_nav_menu_items', 'your_custom_menu_item', 10, 2 );
function your_custom_menu_item ( $items, $args ) {
    if ( $args->theme_location == 'primary' ) {
        $items .= '<li id="menu-item-90" class="fas fa-shopping-cart menu-item menu-item-type-post_type menu-item-object-page menu-item-90"><a href="' . esc_url( home_url( 'orcamento' ) ) . '">Orçamento' . add_qtd_itens_menu() . '</a></li>';
    }
    return $items;
}

add_action( 'homepage_popular_products', 'loop_products_view' );

function loop_products_view() {
	?>
<section class="storefront-product-section storefront-most-viewed" aria-label="Produtos mais vendidos">
<h2 class="section-title">Mais vendidos</h2>
<ul class="woocommerce columns-4 products">
	<?php
		$args = array(
			'post_type' => 'product',
			'posts_per_page' => 8,
			'meta_query' => array(
					array(
						'key' => 'count_view',
						'type' => 'numeric',
					)
				),
			'orderby' => array(
				'count_view' => 'DESC'
			),
			);
		$loop = new WP_Query( $args );
		if ( $loop->have_posts() ) {
			while ( $loop->have_posts() ) : $loop->the_post();
				wc_get_template_part( 'content', 'product' );
			endwhile;
		} else {
			echo __( 'Nenhum produto encontrado!' );
		}
		wp_reset_postdata();
	?>
</ul><!--/.products-->
</section>

<?php
}

add_action( 'no_products_in_list', 'storefront_child_custom_no_products_in_list' );
function storefront_child_custom_no_products_in_list() {
	echo '<span class="no_products_in_list">Sua lista de Orçamentos está vazia no momento! <a href="' . esc_url( home_url( 'produtos' ) ) . '">Clique aqui para voltar à lista de produtos!</a>.</span>';
}

/**
 * Redireciona o acesso de algumas páginas `['cart', 'checkout', 'carrinho']` para o orçamento
 *
 * @return void
 */
function tt_redirect_cart() {
	if (!is_admin() && is_page(['cart', 'checkout', 'carrinho'])) {
		wp_redirect(home_url('orcamento'));
		exit;
	}
}
add_action('pre_get_posts', 'tt_redirect_cart');