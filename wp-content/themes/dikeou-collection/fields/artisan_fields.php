<?php

if(function_exists("register_field_group"))
	{
		register_field_group(array (
			'id' => 'acf_artist-post-options',
			'title' => 'Artist Post Options',
			'fields' => array (
				array(
					'key' => 'artist_post_artist_statement',
					'label' => 'Artist Statement',
					'name' => 'artist_statement',
					'type' => 'wysiwyg',
					'toolbar' => 'full',
					'tabs' => 'all',
					'media_upload' => 1
				),
				array(
					'key' => 'artist_post_curator_statement',
					'label' => 'Curator Statement',
					'name' => 'curator_statement',
					'type' => 'wysiwyg',
					'toolbar' => 'full',
					'tabs' => 'all',
					'media_upload' => 1
				),
				array(
					'key' => 'artist_post_artist_site_url',
					'label' => 'Artist Site URL',
					'name' => 'site_url',
					'type' => 'text'
				),
				array(
					'key' => 'artist_post_zing_links',
					'label' => 'Zing Magazine Links',
					'name' => 'zing_links',
					'layout' => 'row',
					'type' => 'repeater',
					'button_label' => 'Add Link',
					'sub_fields' => array(
						array(
							'key' => 'artist_post_zing_link_text',
							'name' => 'zing_link_text',
							'label' => 'Link Text',
							'type' => 'text'
						),
						array(
							'key' => 'artist_post_zing_link_url',
							'name' => 'zing_link_url',
							'label' => 'Link URL',
							'type' => 'text'
						)
					)
				),
				array(
					'key' => 'artist_post_galleries',
					'label' => 'Galleries',
					'name' => 'artist_galleries',
					'type' => 'repeater',
					'layout' => 'row',
					'button_label' => 'Add Gallery',
					'sub_fields' => array(
						array(
							'key' => 'artist_post_gallery_slide',
							'type' => 'repeater',
							'name' => 'artist_gallery_slide',
							'label' => 'Slide',
							'button_label' => 'Add Slide',
							'layout' => 'row',
							'sub_fields' => array(
								array(
									'key' => 'artist_post_gallery_slide_image',
									'type' => 'image',
									'label' => 'Slide Image',
									'return_format' => 'id',
									'library' => 'all',
									'max_size' => '2MB'
								),
								array(
									'key' => 'artist_post_gallery_slide_title',
									'label' => 'Slide Title',
									'type' => 'text',
									'name' => 'artist_gallery_slide_title',
								),
								array(
									'key' => 'artist_post_gallery_slide_caption',
									'label' => 'Slide Caption',
									'type' => 'wysiwyg',
									'name' => 'artist_gallery_slide_caption',
									'tabs' => 'visual',
									'toolbar' => 'basic',
									'media_upload' => 0
								)
							)
						)
					)
				)
			),
			'location' => array (
				array (
					array (
						'param' => 'post_type',
						'operator' => '==',
						'value' => 'artist',
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