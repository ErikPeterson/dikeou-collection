<?php
draw_routes();

define( 'ACF_LITE' , true );

include_once(plugin_dir_path(__FILE__).'../../plugins/advanced-custom-fields/acf.php');
include_once(plugin_dir_path(__FILE__).'../../plugins/acf-repeater/acf-repeater.php');

function create_post_types(){
	create_artist_post_type();
	create_contact_page();
	create_events_post_type();
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

function create_contact_page(){
	include_once(plugin_dir_path(__FILE__).'fields/contact_fields.php');
}

function create_events_post_type(){
	register_post_type('event',
		array(
		'public' => true,
		'has_archive' => true,
		'label' => 'Events',
		'show_in_menu' => true,
		'description' => 'Event pages',
		'supports' => array('title', 'editor', 'custom-fields')
 		)
	);

	include_once(plugin_dir_path(__FILE__).'fields/event_fields.php');
}

function add_actions(){
	add_filter('acf/settings/show_admin', '__return_false');
	add_filter('acf/location/rule_types', 'add_choices');
	add_filter('acf/location/rule_values/page_name', 'add_page_name_rule');
	add_filter('acf/location/rule_match/page_name', 'add_page_name_match', 10, 3);
	add_action('init', 'create_post_types');
	add_action('after_setup_theme', 'image_sizes');
	add_filter( 'show_admin_bar', '__return_false' );
}

function add_choices($choices){
	$choices['Page']['page_name'] = 'Page Name';

	return $choices;
}

function add_page_name_rule($choices){
	$posts = Timber::get_posts(array(
		'post_type' => 'page',
		'posts_per_page' => -1
		));
	
	if($posts)
	{
		foreach( $posts as $post ){
			$choices[$post->post_name] = $post->post_name;
		}
	}

	return $choices;
}

function add_page_name_match($match, $rule, $options){
	$post = Timber::get_post($options['post_id']);
	$selected_post = $rule['value'];
	if($rule['operator'] == "=="){
		$match = ($post->post_name == $selected_post);
	}

	return $match;
}

function image_sizes(){
	add_image_size('slide_full', 0, 800, false);
}

function draw_routes(){
	Timber::add_route('/artists', function(){
		$query = array(
			'post_type' => 'artist',
			'no_paging' => true,
			'caller_get_posts' => 1,
			'posts_per_page' => -1,
			'order' => 'ASC',
			'orderby' => 'title'
			);

		Timber::load_template('artists.php', $query);
	});

	Timber::add_route('/artists/:artist_slug', function($params){
		$query = array(
			'name' => $params['artist_slug'],
			'post_type' => 'artist',
			'posts_per_page' => 1,
			'caller_get_posts' => 1
		);
		
		Timber::load_template('artist.php', $query);
	});

	Timber::add_route('/contact', function(){
		$query = array(
			'post_type' => 'page',
			'page_name' => 'contact',
			'posts_per_page' => 1
		);

		Timber::load_template('contact_page.php', $query);
	});

	Timber::add_route('/about', function(){
		$query = array(
			'post_type' => 'page',
			'page_name' => 'about',
			'posts_per_page' => 1
		);

		Timber::load_template('about_page.php', $query);
	});
}


function init(){
	draw_routes();
	add_actions();
}

init();