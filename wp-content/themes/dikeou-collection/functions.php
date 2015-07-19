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
		'supports' => array('title', 'editor', 'custom-fields', 'thumbnail')
 		)
	);

	include_once(plugin_dir_path(__FILE__).'fields/event_fields.php');
}

function add_actions(){
	add_theme_support( 'post-thumbnails' );
	add_filter('get_twig', 'twig_functions');
	add_filter('acf/settings/show_admin', '__return_false');
	add_filter('acf/location/rule_types', 'add_choices');
	add_filter('acf/location/rule_values/page_name', 'add_page_name_rule');
	add_filter('acf/location/rule_match/page_name', 'add_page_name_match', 10, 3);
	add_action('init', 'create_post_types');
	add_action('after_setup_theme', 'image_sizes');
	add_filter( 'show_admin_bar', '__return_false' );
}

function twig_functions($twig){
	$twig->addFilter('date_link', new Twig_Filter_Function('format_date_link'));
	return $twig;
}

function format_date_link($string){
	$output = '<a href="/events/?date=' . $string . '">' . preg_replace('/(\d{4})(\d{2})(\d{2})/', '\2/\3/\1', $string) . '</a>';
	return $output;
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
	add_image_size('header', 1400, 0, false);
	add_image_size('event', 600, 600, array('center', 'center'));
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

	Timber::add_route('/events', function(){
		$params = $_GET;
		if(array_key_exists('date', $params)){
			$query = array(
				'post_type' => 'event',
				'no_paging' => true,
				'caller_get_posts' => 1,
				'posts_per_page' => -1,
				'orderby' => 'title',
				'meta_key' => 'event_date',
				'meta_value' => $params['date'],

			);
			Timber::load_template('events-by-date.php', $query);
		} else {
			$now = date('Ym');
			$page = array_key_exists('month', $params) ? $params['month'] : $now;
			$events_data = get_events_by_ordinal_month($page);
			if(!$events_data) return Timber::load_template('single.php', false, 404);
			$query = $events_data[0];
			$params['next_page'] = $events_data[1];
			$params['prev_page'] = $events_data[2];
			Timber::load_template('events-paged.php', $query, 200, $params);
		}
	});

	Timber::add_route('/events/:event_slug', function($params){
		$query = array(
			'name' => $params['event_slug'],
			'post_type' => 'event',
			'posts_per_page' => 1,
			'caller_get_posts' => 1
		);
		
		Timber::load_template('event.php', $query);
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

function get_events_by_ordinal_month($page){
	global $wpdb;
	
	$current = new DateTime(preg_replace("/(\d{4})({\d{2})/", '\1-\2-01', $page));
	$this_month = $current->format('Ym');

	$last_month = clone $current;
	$last_month -> sub(new DateInterval('P1M'));
	$last_month = $last_month -> format('Ym');

	$next_month = clone $current;
	$next_month -> add(new DateInterval('P1M'));
	$next_month = $next_month->format('Ym');

	$query = array(
		'post_type' => 'event',
		'numberposts' => -1,
		'order' => 'DESC',
		'orderby' => 'meta_value',
		'meta_query' => array(
			array(
			'compare' => 'REGEXP',
			'key' => 'event_date',
			'value' => '^'. $this_month
			),
		),
	);

	return [$query, $next_month, $last_month];
}

function chop_year_month($date){
	return substr($date, 0, 6);
}


function init(){
	draw_routes();
	add_actions();
}

init();