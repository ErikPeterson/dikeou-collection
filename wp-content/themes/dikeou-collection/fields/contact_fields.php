<?php

if(function_exists("register_field_group"))
{
	register_field_group(array (
		'id' => 'acf_contact',
		'title' => 'Contact',
		'fields' => array (
			array (
				'key' => 'field_55a322d7ff5bb',
				'label' => 'Contact Content',
				'name' => 'contact_content',
				'type' => 'wysiwyg',
				'instructions' => 'Use H3 for sub-headings',
				'default_value' => '<h3>Email: </h3>
				<a href="mailto:devon@dikeoucollection.org">Devon - Curator</a><br />
				<a href="mailto:sarah@dikeoucollection.org">Sarah - Management</a><br />
				<a href="mailto:stanley@dikeoucollection.org">Stanley - Appointments</a>
				
				<h3>Hours</h3>
				<p>Wed-Fri, 11am-5pm or by appointment.<br />
				For appointments or other inquiries, please<br />
				call (303) 623-3001, or email <a href="mailto:info@dikeoucollection.org">info@dikeoucollection.org</a></p>',
				'toolbar' => 'full',
				'media_upload' => 'no',
			),
			array (
				'key' => 'field_55a3234cff5bc',
				'label' => 'Location Content',
				'name' => 'location_content',
				'type' => 'wysiwyg',
				'instructions' => 'Use H3 for sub-headings.',
				'default_value' => '<h3>The Colorado Building</h3>
				<p>1615 California St. (at 15th St.) Suit 515<br>
				Denver, CO 80202
				</p>
				<p>Parking available on 15th and Stout at commercial parking lots</p>',
				'toolbar' => 'full',
				'media_upload' => 'no',
			),
			array (
				'key' => 'field_55a3234dff5bc',
				'label' => 'Alt Location Content',
				'name' => 'location_content_alt',
				'type' => 'wysiwyg',
				'instructions' => 'Use H3 for sub-headings.',
				'default_value' => '<h3>Dikeou Pop-Up: Colfax</h3><p>312 East Colfax Avenue<br>Denver, CO 80203</p><p>By appointment</p><p>Parking available on Grants St behind the Newhouse Hotel at the commercial parking lots</p>',
				'media_upload' => 'no',
			),
			array (
				'key' => 'field_55a3237fff5bd',
				'label' => 'Internship Content',
				'name' => 'internship_content',
				'type' => 'wysiwyg',
				'default_value' => '',
				'toolbar' => 'full',
				'media_upload' => 'yes',
			),
		),
		'location' => array (
			array (
				array (
					'param' => 'page_name',
					'operator' => '==',
					'value' => 'contact',
					'order_no' => 0,
					'group_no' => 0,
				),
			),
		),
		'options' => array (
			'position' => 'acf_after_title',
			'layout' => 'no_box',
			'hide_on_screen' => array (
			),
		),
		'menu_order' => 0,
	));
}
