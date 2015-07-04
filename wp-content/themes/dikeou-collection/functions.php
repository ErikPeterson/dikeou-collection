<?php
draw_routes();

define( 'ACF_LITE' , true );

include_once(plugin_dir_path(__FILE__).'../../plugins/advanced-custom-fields/acf.php');
include_once(plugin_dir_path(__FILE__).'../../plugins/acf-repeater/acf-repeater.php');

function create_post_types(){
	create_artist_post_type();
}

function create_artist_post_type(){
	register_post_type('artist',
		array(
		'public' => true,
		'has_archive' => true,
		'label' => 'Artists',
		'show_in_menu' => true,
		'description' => 'Artist pages',
		'supports' => array('title', 'editor', 'custom-fields')
 		)
	);

	include_once(plugin_dir_path(__FILE__).'fields/artist_fields.php');

}

function add_actions(){
	add_filter('acf/settings/show_admin', '__return_false');
	add_action('init', 'create_post_types');
}

function draw_routes(){
	Timber::add_route('/artists/:artist_slug', function($params){
		$query = array(
			'name' => $params['artist_slug'],
			'post_type' => 'artist',
			'posts_per_page' => 1,
			'caller_get_posts' => 1
		);
		
		Timber::load_template('artist.php', $query);
	});
}


function init(){
	draw_routes();
	add_actions();
}

init();