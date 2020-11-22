<?php

/**
 * Thander Trade Customizer
 * ==============================================================================
 */

/* Painel */
Kirki::add_panel( 'thandertrade', [
    'priority'    => 10,
    'title'       => esc_attr__( 'Thander Trade', 'thandertrade' ),
    'description' => esc_attr__( 'Configurações gerais a nível de desenvolvimento.', 'thandertrade' ),
    'capability'  => 'update_core'
] );

/* Seção Publicidade */
Kirki::add_section( 'publicity', [
    'title'          => __( 'Publicidade', 'thandertrade' ),
    'panel'          => 'thandertrade', // Not typically needed.
    'priority'       => 10,
    'capability'     => 'update_core',
    'theme_supports' => '', // Rarely needed.
] );

/* Campos */
Kirki::add_field( 'kirki_custom_config', [
    'type'        => 'image',
    'settings'    => 'image_publicity',
    'label'       => esc_html__( 'Banner 1', 'thandertrade' ),
    'description' => esc_html__( 'Imagem para o banner 1 de publicidade na Home.', 'thandertrade' ),
    'section'     => 'publicity',
    'default'     => '',
] );
Kirki::add_field( 'kirki_custom_config', [
    'type'          => 'link',
    'settings'      => 'link_publicity',
    'label'         => esc_html__( 'Link 1', 'thandertrade' ),
    'description'   => esc_html__( 'Link para o banner 1 de publicidade na Home.', 'thandertrade' ),
    'section'       => 'publicity',
    'priority'      => 10,
] );
Kirki::add_field( 'kirki_custom_config', [
    'type'        => 'image',
    'settings'    => 'image_publicity_2',
    'label'       => esc_html__( 'Banner 2', 'thandertrade' ),
    'description' => esc_html__( 'Imagem para o banner 2 de publicidade na Home.', 'thandertrade' ),
    'section'     => 'publicity',
    'default'     => '',
] );
Kirki::add_field( 'kirki_custom_config', [
    'type'          => 'link',
    'settings'      => 'link_publicity_2',
    'label'         => esc_html__( 'Link 2', 'thandertrade' ),
    'description'   => esc_html__( 'Link para o banner 2 de publicidade na Home.', 'thandertrade' ),
    'section'       => 'publicity',
    'priority'      => 10,
] );

/* Seção Contatos */
Kirki::add_section( 'contatos', array(
    'title'          => __( 'Informações de Contato', 'thandertrade' ),
    'panel'          => 'thandertrade', // Not typically needed.
    'priority'       => 10,
    'capability'     => 'update_core',
    'theme_supports' => '', // Rarely needed.
) );

/* Campos */
Kirki::add_field( 'kirki_custom_config', array(
    'type'          => 'text',
    'settings'      => 'telefone',
    'label'         => __( 'Telefone Fixo', 'odin' ),
    'section'       => 'contatos',
    'priority'      => 10,
) );
Kirki::add_field( 'kirki_custom_config', array(
    'type'          => 'text',
    'settings'      => 'telefone_mobile',
    'label'         => __( 'Celular', 'odin' ),
    'section'       => 'contatos',
    'description'   => esc_attr__( 'Esse número será utilizado como contato principal via celular.', 'odin' ),
    'priority'      => 10,
) );
Kirki::add_field( 'kirki_custom_config', array(
    'type'          => 'text',
    'settings'      => 'email',
    'label'         => __( 'E-mail', 'odin' ),
    'section'       => 'contatos',
    'priority'      => 10,
) );
Kirki::add_field( 'kirki_custom_config', array(
    'type'          => 'text',
    'settings'      => 'endereco',
    'label'         => __( 'Endereço', 'odin' ),
    'section'       => 'contatos',
    'sanitize_callback' => 'wp_kses_post',
    'priority'      => 10,
) );

/* Seção Redes Sociais */
Kirki::add_section( 'social', array(
    'title'          => __( 'Redes Sociais', 'odin' ),
    'panel'          => 'thandertrade', // Not typically needed.
    'priority'       => 10,
    'capability'     => 'update_core',
    'theme_supports' => '', // Rarely needed.
) );
Kirki::add_field( 'kirki_custom_config', array(
    'type'          => 'text',
    'settings'      => 'facebook',
    'label'         => __( 'Facebook', 'odin' ),
    'section'       => 'social',
    'priority'      => 10,
) );
Kirki::add_field( 'kirki_custom_config', array(
    'type'          => 'text',
    'settings'      => 'instagram',
    'label'         => __( 'Instagram', 'odin' ),
    'section'       => 'social',
    'priority'      => 10,
) );

/* Seção Footer */
Kirki::add_section( 'footer', [
    'title'          => __( 'Rodapé', 'thandertrade' ),
    'panel'          => 'thandertrade', // Not typically needed.
    'priority'       => 10,
    'capability'     => 'update_core',
    'theme_supports' => '', // Rarely needed.
] );

/* Campos */
Kirki::add_field( 'kirki_custom_config', [
    'type'        => 'image',
    'settings'    => 'image_footer',
    'label'       => esc_html__( 'Banner do Rodapé', 'thandertrade' ),
    'description' => esc_html__( 'Imagem para o rodapé.', 'thandertrade' ),
    'section'     => 'footer',
    'default'     => '',
] );
