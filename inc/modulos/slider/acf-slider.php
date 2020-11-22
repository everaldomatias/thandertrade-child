<?php
// CUSTOM FIELDS -> SLIDER
if( function_exists( "register_field_group" ) )
{
	register_field_group(array (
		'id' => 'acf_slider-options',
		'title' => 'Slider Options',
		'fields' => array (
			array (
				'key' => 'field_56fd2dce04b63',
				'label' => 'Atenção',
				'name' => '',
				'type' => 'message',
				'message' => '<span style="color:red">As imagens anexadas ao slider devem possuir uma dimensão exara de <strong>1580 x 800px.</strong></span>',
			),
			array (
				'key' => 'field_56fbf7ab2448d',
				'label' => 'Descrição do Slider',
				'name' => 'sl-bn-desc',
				'type' => 'text',
				'default_value' => '',
				'placeholder' => '',
				'prepend' => '',
				'append' => '',
				'formatting' => 'html',
				'maxlength' => '',
			),
			array (
				'key' => 'field_56fbf7be2448e',
				'label' => 'Link do Slider',
				'name' => 'sl-bn-link',
				'type' => 'text',
				'default_value' => '',
				'placeholder' => '',
				'prepend' => '',
				'append' => '',
				'formatting' => 'html',
				'maxlength' => '',
			),
			array (
				'key' => 'field_56fbf7cc2448f',
				'label' => 'Abrir link em outra janela',
				'name' => 'sl_target',
				'type' => 'true_false',
				'instructions' => 'Marque essa opção caso o link do slider deva abrir em uma nova janela.',
				'message' => '',
				'default_value' => 0,
			),
			array (
				'key' => 'field_57d7fcb1de5a1',
				'label' => 'É um vídeo?',
				'name' => 'is_video',
				'type' => 'true_false',
				'instructions' => 'Marque esse campo caso o conteúdo seja um vídeo',
				'message' => '',
				'default_value' => 0,
			),
			array (
				'key' => 'field_57d7f85dbf3f7',
				'label' => 'Código embed do vídeo',
				'name' => 'embed_code',
				'type' => 'textarea',
				'conditional_logic' => array (
					'status' => 1,
					'rules' => array (
						array (
							'field' => 'field_57d7fcb1de5a1',
							'operator' => '==',
							'value' => '1',
						),
					),
					'allorany' => 'all',
				),
				'default_value' => '',
				'placeholder' => '',
				'maxlength' => '',
				'rows' => 2,
				'formatting' => 'br',
			),
		),
		'location' => array (
			array (
				array (
					'param' => 'post_type',
					'operator' => '==',
					'value' => 'slider',
					'order_no' => 0,
					'group_no' => 0,
				),
			),
		),
		'options' => array (
			'position' => 'acf_after_title',
			'layout' => 'default',
			'hide_on_screen' => array (
				0 => 'custom_fields',
			),
		),
		'menu_order' => 0,
	));
}
