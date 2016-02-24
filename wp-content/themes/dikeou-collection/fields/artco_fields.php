<?php

if(function_exists("register_field_group"))
{
	register_field_group(array (
		'id' => 'acf_art-co-fields',
		'title' => 'ART-CO Fields',
		'fields' => array (
			array (
				'key' => 'field_55b45a0477044',
				'label' => 'Artist Content',
				'name' => 'artist_content',
				'type' => 'wysiwyg',
				'default_value' => '',
				'toolbar' => 'basic',
				'media_upload' => 'no',
			),
			array (
				'key' => 'field_55b45a2577045',
				'label' => 'ART-CO Slide',
				'name' => 'slides',
				'type' => 'repeater',
				'sub_fields' => array (
					array (
						'key' => 'field_55b45afb7704a',
						'label' => 'Image',
						'name' => 'image',
						'type' => 'image',
						'column_width' => '',
						'save_format' => 'object',
						'preview_size' => 'thumbnail',
						'library' => 'all',
					),
					array (
						'key' => 'field_udBEh_PIXaHsPharFunLRw',
						'label' => 'Slide Caption',
						'name' => 'caption',
						'type' => 'wysiwyg',
						'column_width' => '',
						'default_value' => '',
						'toolbar' => 'basic',
						'media_upload' => 'no',
					),
				),
				'row_min' => '',
				'row_limit' => '',
				'layout' => 'row',
				'button_label' => 'Add Slide',
			),
		),
		'location' => array (
			array (
				array (
					'param' => 'post_type',
					'operator' => '==',
					'value' => 'artco',
					'order_no' => 0,
					'group_no' => 0,
				),
			),
		),
		'options' => array (
			'position' => 'normal',
			'layout' => 'no_box',
			'hide_on_screen' => array (
			),
		),
		'menu_order' => 0,
	));
}
