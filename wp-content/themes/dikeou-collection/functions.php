<?php

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
}

function add_actions(){
	add_action('init', 'create_post_types');
}

function draw_routes(){
	Timber::add_route('artists/:artist_slug', function($params){
		$artist_slug = $params['artist_slug'];
		Timber::load_template('artist.php', $artist_slug);
	});
}


function init(){
	draw_routes();
	add_actions();
}

init();