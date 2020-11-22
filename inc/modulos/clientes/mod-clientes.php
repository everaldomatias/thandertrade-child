<?php

// Archive of the module Galeria de Imagens
// [0]
// [1] CPT and Taxonomy
// [2] ACF or Fields
// [2] Functions
//

//
// [1] CPT and Taxonomy
//

function clientes_post_type() {

	$labels = array(
		'name'                => _x( 'Fornecedores', 'Post Type General Name', 'odin' ),
		'singular_name'       => _x( 'Fornecedor', 'Post Type Singular Name', 'odin' ),
		'menu_name'           => __( 'Fornecedores', 'odin' ),
		'parent_item_colon'   => __( 'Parent Item', 'odin' ),
		'all_items'           => __( 'Todos os itens', 'odin' ),
		'view_item'           => __( 'Ver Item', 'odin' ),
		'add_new_item'        => __( 'Adicionar novo item', 'odin' ),
		'add_new'             => __( 'Adicionar novo', 'odin' ),
		'edit_item'           => __( 'Editar Item', 'odin' ),
		'update_item'         => __( 'Atualizar Item', 'odin' ),
		'search_items'        => __( 'Buscar item', 'odin' ),
		'not_found'           => __( 'Não encontrado', 'odin' ),
		'not_found_in_trash'  => __( 'Não encontrado no lixo', 'odin' ),
	);
	$args = array(
		'label'               => __( 'cliente', 'odin' ),
		'description'         => __( 'Cadastro dos Fornecedores.', 'odin' ),
		'labels'              => $labels,
		'supports'            => array( 'title', 'thumbnail' ),
		'hierarchical'        => false,
		'public'              => true,
		'show_ui'             => true,
		'show_in_menu'        => true,
		'show_in_nav_menus'   => true,
		'show_in_admin_bar'   => true,
		'menu_position'       => 6,
		'menu_icon'           => 'dashicons-screenoptions',
		'can_export'          => true,
		'has_archive'         => false,
		'exclude_from_search' => true,
		'publicly_queryable'  => true,
		'capability_type'     => 'post',
	);
	register_post_type( 'clientes', $args );
}
add_action( 'init', 'clientes_post_type', 0 );

//
// [2] ACF or Fields
//

//
// [3] Functions
//

/**
 * Adicionando CSS e JS para o Slick Slider
 */
function clientes_scripts() {
	wp_enqueue_script(	'slick', 			get_stylesheet_directory_uri() . '/inc/modulos/clientes/assets/js/slick/slick.min.js',		array(), '1.5.6',	true	);
	wp_enqueue_style( 	'slick', 			get_stylesheet_directory_uri() . '/inc/modulos/clientes/assets/js/slick/slick.css'										);
	wp_enqueue_style( 	'style-clientes',	get_stylesheet_directory_uri() . '/inc/modulos/clientes/assets/css/style-clientes.css'										);
	wp_enqueue_script(	'custom-slick',		get_stylesheet_directory_uri() . '/inc/modulos/clientes/assets/js/slick/custom-slick.js',	array(), '', 		true	);
}
add_action( 'wp_enqueue_scripts', 'clientes_scripts' );

/*
 * Função para imprimir o loop dos Fornecedores
 */
function loop_clientes( $args, $class = 'col-sm-2', $size = 'thumbnail' ) {

	// Force the CPT for Query
	$args['post_type'] = "clientes";

	// Query
	$query_clientes = new WP_Query( $args );
		echo '<ul class="slick-slider list-clientes">';

	// Loop
	while ( $query_clientes->have_posts() ) {
		$query_clientes->the_post();
		echo '<li class="' . $class . '">' . get_the_post_thumbnail( get_the_ID(), $size ) . '</li><!-- ' . $class . ' -->';
	}
		echo '</ul><!-- slick-slider list-clientes -->';
	
	// Reset Query
	wp_reset_postdata();
}