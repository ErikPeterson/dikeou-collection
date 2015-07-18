<?php

if(function_exists("register_field_group"))
{
	register_field_group(array (
		'id' => 'acf_event-fields',
		'title' => 'Event Fields',
		'fields' => array (
			array (
				'key' => 'field_55a59f02d3fa8',
				'label' => 'Event Date',
				'name' => 'event_date',
				'type' => 'date_picker',
				'instructions' => 'Choose the date of the event.',
				'required' => 1,
				'date_format' => 'yymmdd',
				'display_format' => 'dd/mm/yy',
				'first_day' => 1,
			),
			array (
				'key' => 'field_55a5a0b6d3fa9',
				'label' => 'Event Video URL',
				'name' => 'video_url',
				'type' => 'text',
				'instructions' => 'Enter the full URL for the event video, if one is available',
				'default_value' => '',
				'placeholder' => '',
				'prepend' => '',
				'append' => '',
				'formatting' => 'none',
				'maxlength' => '',
			),
			array (
				'key' => 'field_55a5a0f8d3faa',
				'label' => 'Event Galleries',
				'name' => 'event_galleries',
				'type' => 'repeater',
				'sub_fields' => array (
					array (
						'key' => 'field_55a5a126d3fab',
						'label' => 'Gallery Slides',
						'name' => 'slides',
						'type' => 'repeater',
						'column_width' => '',
						'sub_fields' => array (
							array (
								'key' => 'field_55a5a16dd3fac',
								'label' => 'Slide Image',
								'name' => 'image',
								'type' => 'image',
								'required' => 1,
								'column_width' => '',
								'save_format' => 'id',
								'preview_size' => 'thumbnail',
								'library' => 'all',
							),
							array (
								'key' => 'field_55a5a1add3fad',
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
								'key' => 'field_55a5a1c4d3fae',
								'label' => 'Slide Caption',
								'name' => 'caption',
								'type' => 'wysiwyg',
								'column_width' => '',
								'default_value' => '',
								'toolbar' => 'basic',
								'media_upload' => 'no',
							),
						),
						'row_min' => 1,
						'row_limit' => '',
						'layout' => 'row',
						'button_label' => 'Add Slide',
					),
				),
				'row_min' => '',
				'row_limit' => '',
				'layout' => 'row',
				'button_label' => 'Add Gallery',
			),
		),
		'location' => array (
			array (
				array (
					'param' => 'post_type',
					'operator' => '==',
					'value' => 'event',
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
