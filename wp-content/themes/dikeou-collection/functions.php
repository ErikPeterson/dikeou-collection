<?php
draw_routes();

define( 'ACF_LITE' , true );

include_once(plugin_dir_path(__FILE__).'../../plugins/advanced-custom-fields/acf.php');
include_once(plugin_dir_path(__FILE__).'../../plugins/acf-repeater/acf-repeater.php');

function create_post_types(){
	create_artist_post_type();
	create_contact_page();
	create_events_post_type();
	create_artco_post_type();
}

function create_artist_post_type(){
	register_post_type('artist',
		array(
		'public' => true,
		'has_archive' => true,
		'label' => 'Artists',
		'show_in_menu' => true,
		'description' => 'Artist pages',
		'supports' => array('title', 'custom-fields')
	));

	include_once(plugin_dir_path(__FILE__).'fields/artist_fields.php');
}

function create_artco_post_type(){
	register_post_type('art-co',
		array(
		'public' => true,
		'has_archive' => true,
		'label' => 'ART-CO',
		'show_in_menu' => true,
		'description' => 'ART-CO Submitted Pages',
		'supports' => array('title', 'custom-fields', 'editor')
	));

	include_once(plugin_dir_path(__FILE__).'fields/artco_fields.php');
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
		'supports' => array('title', 'editor', 'custom-fields', 'thumbnail'),

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
	add_action('admin_menu', 'remove_menus');
}

function remove_menus () {
	remove_menu_page('edit.php');
	remove_menu_page('edit-comments.php');
	remove_menu_page('themes.php');
	remove_menu_page('plugins.php');
	remove_menu_page('tools.php');
	remove_submenu_page('options-general.php', 'options-writing.php');
	remove_submenu_page('options-general.php', 'options-reading.php');
	remove_submenu_page('options-general.php', 'options-discussion.php');
	remove_submenu_page('options-general.php', 'options-media.php');
	remove_submenu_page('options-general.php', 'options-permalink.php');
}

function add_choices($choices){
	$choices['Page']['page_name'] = 'Page Name';

	return $choices;
}

function twig_functions($twig){
	$twig->addFilter('date_link', new Twig_Filter_Function('format_date_link'));
	return $twig;
}

function format_date_link($string){
	$output = '<a href="/events/?date=' . $string . '">' . preg_replace('/(\d{4})(\d{2})(\d{2})/', '\2/\3/\1', $string) . '</a>';
	return $output;
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

			$query = $events_data[0];
			$params['this_page'] = $page;
			$params['next_page'] = $events_data[1];
			$params['prev_page'] = $events_data[2];
			Timber::load_template('events-paged.php', $query, 200, $params);
		}
	});


	Timber::add_route('/blog', function(){

		$params = $_GET;

		Timber::load_template('blog.php', false, 200, $params);
	});

	Timber::add_route('/artco-submission', function(){
		Timber::load_template('artcosubmission.php');
	});

	Timber::add_route('/artco-submit', function(){
		$params = $_REQUEST;
		$nonce = $params['_wpnonce'];
		
		if( ! wp_verify_nonce($nonce)){
		 error_log($nonce);
		 exit;
		}
		
		try{
			$image_ids = images_from_params($_FILES);
			$artist_content = wpautop(strip_tags($params['post_artist_information']));

			$options = array(
				'post_title' => strip_tags($params['post_title']),
				'post_name' => sanitize_title($params['post_title']),
				'post_excerpt' => "",
				'post_status' => 'draft',
				'post_type' => 'art-co',
				'post_content' => $params['post_content']
			); 
			
			$post_id = wp_insert_post($options);
					
			if($post_id == 0){
				return Timber::load_template('artcofailed.php');
			}
			$params = array();
			$params['post_id'] = $post_id;
			$params['image_ids'] = $image_ids;
			$params['artist_content'] = $artist_content;

			Timber::load_template('artcosubmitted.php', false, 200, $params);
		} catch(Exception $e){
			Timber::load_template('artcofailed.php');
		}

	});
}

function images_from_params($params){
	$i = 1;
	$images = array();
	$upload_dir = wp_upload_dir();
	$base_path = $upload_dir['path'];

	while(array_key_exists('post_image_' . $i, $params)){
		$image = $params["post_image_" . $i];
		
		if(! image_ok($image) ){
			$i++;
			continue;
		}
		
		$base_name = $image['name'];
		$destination = $base_path . $base_name;
		
		if(!move_uploaded_file( $image['tmp_name'], $destination) ){
			$i++;
			continue;
		};

		$filetype = wp_check_filetype($destination, null);

		$attachment = array(
			'guid' => $upload_dir['url'] . '/' . $base_name,
			'post_mime_type' => $filetype['type'],
			'post_title' => preg_replace( '/\.[^.]+$/', '', $base_name),
			'post_content' => '',
			'post_status' => 'inherit'
		);

		$id = wp_insert_attachment($attachment, $destination);
		array_push( $images, $id );

		$i++;
	}

	return $images;	
}

function image_ok($image){
	$has_name = array_key_exists('name', $image);
	$has_tmp_name = array_key_exists('tmp_name', $image);
	$is_small_enough = $image['size'] <= 1000000;

	return $has_name && $has_tmp_name && $is_small_enough;
}

function get_events_by_ordinal_month($page){
	global $wpdb;
	$current = new DateTime(preg_replace("/(\d{4})(\d{2})/", '\1-\2-01', $page));
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