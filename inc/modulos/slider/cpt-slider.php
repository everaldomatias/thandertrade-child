<?php
// CUSTOM POST TYPE -> SLIDER
function slider_post_type() {

	$labels = array(
		'name'                => _x( 'Sliders', 'Post Type General Name', 'text_domain' ),
		'singular_name'       => _x( 'Slider', 'Post Type Singular Name', 'text_domain' ),
		'menu_name'           => __( 'Slider', 'text_domain' ),
		'parent_item_colon'   => __( 'Parent Item', 'text_domain' ),
		'all_items'           => __( 'Todos os itens', 'text_domain' ),
		'view_item'           => __( 'Ver Item', 'text_domain' ),
		'add_new_item'        => __( 'Adicionar novo item', 'text_domain' ),
		'add_new'             => __( 'Adicionar novo', 'text_domain' ),
		'edit_item'           => __( 'Editar Item', 'text_domain' ),
		'update_item'         => __( 'Atualizar Item', 'text_domain' ),
		'search_items'        => __( 'Buscar item', 'text_domain' ),
		'not_found'           => __( 'Não encontrado', 'text_domain' ),
		'not_found_in_trash'  => __( 'Não encontrado no lixo', 'text_domain' ),
	);
	$args = array(
		'label'               => __( 'slider', 'text_domain' ),
		'description'         => __( 'Cadastro das imagens do slider.', 'text_domain' ),
		'labels'              => $labels,
		'supports'            => array( 'title', 'thumbnail', 'page-attributes', ),
		'hierarchical'        => false,
		'public'              => true,
		'show_ui'             => true,
		'show_in_menu'        => true,
		'show_in_nav_menus'   => false,
		'show_in_admin_bar'   => true,
		'menu_position'       => 5,
		'menu_icon'           => 'dashicons-format-gallery',
		'can_export'          => true,
		'has_archive'         => false,
		'exclude_from_search' => true,
		'publicly_queryable'  => true,
		'capability_type'     => 'post',
	);
	register_post_type( 'slider', $args );

}

add_action( 'init', 'slider_post_type', 0 );