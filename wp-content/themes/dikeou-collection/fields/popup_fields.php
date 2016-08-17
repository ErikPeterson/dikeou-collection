<?php

if(function_exists("register_field_group"))
{
	register_field_group(array (
		'id' => 'acf_pop-up-fields',
		'title' => 'Pop Up Fields',
		'fields' => array (
			array (
				'key' => 'field_57b39b03f51e3',
				'label' => 'Pop Up Slides',
				'name' => 'pop_up_slides',
				'type' => 'repeater',
				'sub_fields' => array (
					array (
						'key' => 'field_57b39b2af51e4',
						'label' => 'Image',
						'name' => 'image',
						'type' => 'image',
						'required' => 1,
						'column_width' => '',
						'save_format' => 'object',
						'preview_size' => 'thumbnail',
						'library' => 'all',
					),
					array (
						'key' => 'field_57b39b5ff51e5',
						'label' => 'Slide Title',
						'name' => 'title',
						'type' => 'text',
						'column_width' => '',
						'default_value' => '',
						'placeholder' => '',
						'prepend' => '',
						'append' => '',
						'formatting' => 'none',
						'maxlength' => '',
					),
					array (
						'key' => 'field_57b39ba8f51e7',
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
				'layout' => 'table',
				'button_label' => 'Add Row',
			),
		),
		'location' => array (
			array (
				array (
					'param' => 'page',
					'operator' => '==',
					'value' => '1373',
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
